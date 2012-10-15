[![Build Status](https://secure.travis-ci.org/digitalpioneers/FacebookTestuserBundle.png)](http://travis-ci.org/digitalpioneers/FacebookTestUserBundle)


FacebookTestuserBundle
======================

This bundle manages facebook test users. The Bundle offers functionality for adding, deleting, listing and modifying
test users. It is also possible to add Friendships between test users.

The Bundle is intended to help testing Facebook enabled applications.


Examples
--------

```php
$provider = new FacebookTestuserProvider(new new Facebook(array(
                                                         'appId'  => '344617158898614',
                                                         'secret' => '6dc8ac871858b34798bc2488200e503d',
                                                       )));

// add a new Testuser

$user1 = $provider->addTestUser();
$user2 = $provider->addTestUser();

echo($user1->getAccessToken());
echo($user1->getLoginURL());
echo($user1->getFacebookId());

$provider->addUserFriendship($user1, $user2); // makes a friend request and confirms it

/**
 * @var $users array
 */
$users = $provider->getTestUsers(); // array of all users

$provider->deleteTestUser($user1);
$provider->deleteAllTestUsers();

$provider->changeTestUserName($user1, 'Sepp H.');

$provider->changeTestUserPassword($user1, 'topsecret');

```
