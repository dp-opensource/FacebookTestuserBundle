<?php

namespace digitalpioneers\FacebookTestuserBundle\Facebook;

class FacebookTestUser
{
    private $access_token;
    private $login_url;
    private $facebook_id;

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
        $this->facebook_id = $data['id'];
        $this->access_token = $data['access_token'];
        $this->login_url = $data['login_url'];
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
     * Returns the Login-URL which can be used to login as the test user
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

    public function equals(FacebookTestUser $user){
        if($this->facebook_id == $user->getFacebookId())
        {
            return true;
        }
    }
}
