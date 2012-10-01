<?php

namespace digitalpioneers\FacebookTestuserBundle\Tests;

use digitalpioneers\FacebookTestuserBundle\Facebook\FacebookTestuserProvider;
use digitalpioneers\FacebookTestuserBundle\Facebook\FacebookTestImplementation;


class IntegrationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \digitalpioneers\FacebookTestuserBundle\Facebook\FacebookTestuserProvider $provider
     */
    private $provider;

    public function setUp()
    {
        $this->provider = new FacebookTestuserProvider(
            new FacebookTestImplementation(array('appId' => '355143471235589', 'secret' => 'cc9af49ab5681667fe197c3a41b00716'))
        );
    }

    public function testGetUsersWithoutUsers(){
        $this->provider->deleteAllTestUsers();
        $users = $this->provider->getTestUsers();
        $this->assertEquals(0,count($users));
    }

    public function testDeleteUsers()
    {
        $this->provider->deleteAllTestUsers();
        $users = $this->provider->getTestUsers();
        $this->assertEquals(0,count($users));
    }

    public function testAddUser()
    {
        $this->provider->deleteAllTestUsers();
        $this->provider->addTestUser();
        $users = $this->provider->getTestUsers();
        $this->assertEquals(1,count($users));
    }
}
