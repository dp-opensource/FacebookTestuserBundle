<?php

namespace digitalpioneers\FacebookTestuserBundle\Facebook;

class FacebookTestImplementation extends \BaseFacebook
{
    private $valueStore;

    protected function setPersistentData($key, $value)
    {
        $this->valueStore[$key] = $value;
    }

    protected function getPersistentData($key, $default=false)
    {
        return $this->valueStore[$key];
    }

    protected function clearPersistentData($key)
    {
        $this->valueStore[$key] = null;
    }

    protected function clearAllPersistentData()
    {
        $this->valueStore = array();
    }
}
