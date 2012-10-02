<?php

namespace digitalpioneers\FacebookTestuserBundle\Facebook;

class FacebookTestUser
{
    private $access_token;
    private $login_url;
    private $facebook_id;
    private $password;
    private $email;

    public function __construct($user)
    {
        $this->fillUserData($user);
    }

    /**
     * Methods fills user object with facebook data
     * @param $data Facebook provided array with test user data
     */
    protected function fillUserData($data)
    {

        if (is_array($data)) {
            $this->facebook_id = $data['id'];
            $this->access_token = $data['access_token'];
            $this->login_url = $data['login_url'];

            // password is returned one time after creating the user.
            // if the password is not saved separately, it can be changed
            // login is always possible via token or url
            if (array_key_exists('password', $data)) {
                $this->password = $data['password'];
            }
            if (array_key_exists('email', $data)) {
                $this->email = $data['email'];
            }
        } else {

            $this->facebook_id = $data->id;
            $this->access_token = $data->access_token;
            $this->login_url = $data->login_url;

            if (isset($data->password)) {
                $this->password = $data->password;
            }

            if (isset($data->email)) {
                $this->email = $data->email;
            }
        }

    }

    /**
     * Returns the users facebook id
     * @return mixed
     */
    public function getFacebookId()
    {
        return $this->facebook_id;
    }

    /**
     * Returns the Login-URL which can be used to login as the test user without a password
     * @return mixed
     */
    public function getLoginURL()
    {
        return $this->login_url;
    }

    /**
     * Returns the users access token.
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * This will only work after the creation of the user, save your passwords or change it
     * @return mixed Test user password
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param FacebookTestUser $user
     * @return bool
     */
    public function equals(FacebookTestUser $user)
    {
        if ($this->facebook_id == $user->getFacebookId()) {
            return true;
        }
    }
}
