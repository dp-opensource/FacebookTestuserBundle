<?php

namespace digitalpioneers\FacebookTestuserBundle\Facebook;

use digitalpioneers\FacebookTestuserBundle\Facebook\FacebookTestUser;

/**
 * This class encapsulates the facebook api and provides the core functionality
 */
class FacebookTestuserProvider
{
    private $facebook;

    public function __construct(\BaseFacebook $facebook)
    {
        $this->facebook = $facebook;

    }

    /**
     * Returns a list of facebook test users registered with the application
     * @return array
     */
    public function getTestUsers()
    {
        $data =  $this->facebook->api($this->facebook->getAppId().'/accounts/test-users', 'GET', array());
        $users = array();
        if(is_array($data) && array_key_exists('data', $data)) // data is valid
        {
            foreach($data['data'] as $user)
            {
                $users[] = new FacebookTestUser($user);
            }
        }
        return $users;
    }

    /**
     * Deletes a test user from the application
     * @param FacebookTestUser $user
     * @return mixed
     */
    public function deleteTestUser(FacebookTestUser $user)
    {
        return $this->facebook->api($user->getFacebookId(), 'DELETE', array());
    }

    /**
     * Deletes all test users from the application
     */
    public function deleteAllTestUsers()
    {
        $users = $this->getTestUsers();
        foreach($users as $user)
        {
            $this->deleteTestUser($user);
        }
    }


    /**
     * Adds a test user to the application
     * @param bool $installed true if the application is installed for the new user
     * @param string $name User name
     * @param string $locale locale
     * @param string $permissions Special permissions for the app
     * @return mixed
     */
    public function addTestUser($installed = true, $name = '', $locale = '', $permissions = '')
    {
        $params = array();
        if(!$installed)
        {
            $params['installed'] = 'false';
        }

        if(!empty($name))
        {
            $params['name'] = $name;
        }

        if(!empty($locale))
        {
            $params['locale'] = $locale;
        }

        if(!empty($permissions))
        {
            $params['permissions'] = $permissions;
        }


        $response = $this->facebook->api($this->facebook->getAppId().'/accounts/test-users', 'POST', $params);
        return new FacebookTestUser($response);
    }

    /**
     * Changes the test user name
     * @param FacebookTestUser $testUser
     * @param $newName
     * @return true or false
     */
    public function changeTestUserName(FacebookTestUser $testUser, $newName)
    {
        return $this->facebook->api($testUser->getFacebookId(), 'POST', array('name' => $newName));
    }

    /**
     * Changes the test user password
     * @param FacebookTestUser $testUser
     * @param $newPassword
     * @return true or false
     */
    public function changeTestUserPassword(FacebookTestUser $testUser, $newPassword)
    {
        return $this->facebook->api($testUser->getFacebookId(), 'POST', array('password' => $newPassword));
    }

    /**
     * Establishes a friendship between $user1 and $user2
     * @param FacebookTestUser $user1
     * @param FacebookTestUser $user2
     * @return true or false
     */
    public function addUserFriendship(FacebookTestUser $user1, FacebookTestUser $user2)
    {
        $requestResult = $this->facebook->api($user1->getFacebookId() . '/friends/' . $user2->getFacebookId(), 'POST', array('access_token' => $user1->getAccessToken()));
        $confirmResult = $this->facebook->api($user2->getFacebookId() . '/friends/' . $user1->getFacebookId(), 'POST', array('access_token' => $user2->getAccessToken()));
        return $requestResult && $confirmResult;
    }

}
