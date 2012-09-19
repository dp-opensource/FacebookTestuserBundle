<?php

namespace digitalpioneers\FacebookTestuserBundle\Facebook;

class FacebookTestuserProvider
{
    private $facebook;

    public function __construct(\BaseFacebook $facebook)
    {
        $this->facebook = $facebook;
    }

    public function getTestUsers()
    {
        return json_decode($this->facebook->api($this->facebook->getAppId().'/accounts/test-users', 'GET', array()));
    }

    public function deleteTestUser($testUserId)
    {
        return $this->facebook->api($testUserId, 'DELETE', array());
    }


    public function addTestUser($installed, $name, $locale, $permissions)
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

        return json_decode($this->facebook->api($this->facebook->getAppId().'/accounts/test-users', 'POST', $params));
    }

    public function changeTestUserName($testUserId, $newName)
    {
        return $this->facebook->api($testUserId, 'POST', array('name' => $newName));
    }

    public function changeTestUserPassword($testUserId, $newPassword)
    {
        return $this->facebook->api($testUserId, 'POST', array('password' => $newPassword));
    }

}
