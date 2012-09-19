<?php

namespace linodp\FacebookTestuserBundle;

use \linodp\FacebookTestuserBundle\Facebook\FacebookTestuserProvider;

class Tests extends \PHPUnit_Framework_TestCase
{
    public function testDummy()
    {
        $this->markTestIncomplete('Test is included (Ohai Travis)');
    }

    public function testAddUser()
    {
        $responseObject = new \StdClass();
        $responseObject->id = "123456789";
        $responseObject->access_token = "AAAFDYEhyggUBANfZBz1hw1cXYuZB7bvKCzfzOXnbg5BAUGYBlIjZRAbESlIb4Du7OSqynWK3Ei6HN5Yd4MM7BVjWiOUZAq21WaRHDBtkYktVI4nqfAC";
        $responseObject->login_url = "https://www.facebook.com/platform/test_account_login.php?user_id=100004388823587&n=NV6dedtx9oDj6WL";
        $responseObject->email = "testuser@foobar.edu";
        $responseObject->password = "5555105";

        $fbmock = $this->getMockBuilder('Facebook')
            ->disableOriginalConstructor()
            ->getMock();

        $fbmock->expects($this->once())->method('api')->will($this->returnValue(json_encode($responseObject)));

        $provider = new FacebookTestuserProvider($fbmock);

        $response = $provider->addTestUser(true, null, null, null);

        $this->assertEquals(json_encode($responseObject), json_encode($response));
    }

    public function testDeleteUser()
    {
        $this->markTestIncomplete('tbd');
    }
}
