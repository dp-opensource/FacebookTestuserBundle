<?php

namespace digitalpioneers\FacebookTestuserBundle\Tests;

use \digitalpioneers\FacebookTestuserBundle\Facebook\FacebookTestuserProvider;
use \digitalpioneers\FacebookTestuserBundle\Facebook\FacebookTestUser;

class Tests extends \PHPUnit_Framework_TestCase
{
    private $fbmock;

    public function setUp()
    {
        $this->fbmock = $this->getMockForAbstractClass('BaseFacebook', array('355143471235589', 'cc9af49ab5681667fe197c3a41b00716'),'', false, true, true, array('api'));
    }

    /**
     * Tests the creation of a Facebook test user against a mock
     */
    public function testAddTestUser()
    {
        $responseObject = new \StdClass();
        $responseObject->id = "123456789";
        $responseObject->access_token = "AAAFDYEhyggUBANfZBz1hw1cXYuZB7bvKCzfzOXnbg5BAUGYBlIjZRAbESlIb4Du7OSqynWK3Ei6HN5Yd4MM7BVjWiOUZAq21WaRHDBtkYktVI4nqfAC";
        $responseObject->login_url = "https://www.facebook.com/platform/test_account_login.php?user_id=100004388823587&n=NV6dedtx9oDj6WL";
        $responseObject->email = "testuser@foobar.edu";
        $responseObject->password = "5555105";
        $expectedUserObject = new FacebookTestUser($responseObject);

        $this->fbmock->expects($this->once())->method('api')->will($this->returnValue($responseObject));

        $provider = new FacebookTestuserProvider($this->fbmock);

        $response = $provider->addTestUser();

        $this->assertEquals($expectedUserObject, $response);
    }

    /**
     * Tests removing a Facebook test user against a mock
     */
    public function testDeleteTestUser()
    {
        $user = new FacebookTestUser(array('id' => '12345', 'access_token' => 'abcdef', 'login_url' => 'http://www.facebook.com'));

        $this->fbmock->expects($this->once())->method('api')->with('12345', 'DELETE')->will($this->returnValue('true'));

        $provider = new FacebookTestuserProvider($this->fbmock);

        $response = $provider->deleteTestUser($user);

        $this->assertEquals($response, 'true');
    }

    /**
     * Tests a call to change the test users name
     */
    public function testChangeTestUserName()
    {

        $user = new FacebookTestUser(array('id' => '12345', 'access_token' => 'abcdef', 'login_url' => 'http://www.facebook.com'));

        $this->fbmock->expects($this->once())->method('api')->with('12345', 'POST')->will($this->returnValue('true'));

        $provider = new FacebookTestuserProvider($this->fbmock);

        $response = $provider->changeTestUserName($user, 'Elmer J. Fudd');

        $this->assertEquals($response, 'true');
    }

    /**
     * Tests a call to change the test users password
     */
    public function testChangeTestUserPassword()
    {

        $user = new FacebookTestUser(array('id' => '12345', 'access_token' => 'abcdef', 'login_url' => 'http://www.facebook.com'));

        $this->fbmock->expects($this->once())->method('api')->with('12345', 'POST')->will($this->returnValue('true'));

        $provider = new FacebookTestuserProvider($this->fbmock);

        $response = $provider->changeTestUserPassword($user, 'secret');

        $this->assertEquals($response, 'true');
    }

    /**
     * Tests a call to get all available test users
     */
    public function testGetTestUsers()
    {

        $responseObject = array();
        $responseObject['data'] = array();
        $responseObject['data'][0] = array();
        $responseObject['data'][0]['id']= '12345';
        $responseObject['data'][0]['access_token'] = 'abcdef';
        $responseObject['data'][0]['login_url'] = 'http://facebook.com';

        $responseArray = array(new FacebookTestUser(array('id' => '12345', 'access_token' => 'abcdef', 'login_url' => 'http://facebook.com')));


        $this->fbmock->expects($this->any())->method('getAppId')->will($this->returnValue('355143471235589'));
        $this->fbmock->expects($this->once())->method('api')->will($this->returnValue($responseObject));

        $provider = new FacebookTestuserProvider($this->fbmock);

        $response = $provider->getTestUsers();
        $this->assertEquals($responseArray, $response);

    }

}
