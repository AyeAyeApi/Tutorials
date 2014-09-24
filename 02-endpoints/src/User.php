<?php
/**
 * Create and log in as users
 * @author Daniel Mason
 * @copyright Daniel Mason, 2013
 */

namespace AyeAye\Tutorial\Endpoints;


use AyeAye\Api\Controller;
use AyeAye\Api\Exception;
use AyeAye\Tutorial\Cache;

/**
 * User control
 * @package AyeAye\Tutorial\Controllers
 */
class User extends Controller {

    /**
     * Add a new user
     * @param string $username Their username
     * @param string $password Their password
     * @return string
     * @throws Exception
     */
    public function putUserAction($username, $password) {
        if(!$username || !$password) {
            throw new Exception('You must specify a username and password');
        }

        $user = [
            'username' => $username,
            'password' => $this->getPasswordHash($password),
        ];
        $cache = new Cache(__DIR__.'/../files/users');

        $cache->setValueForKey('user-'.$username, $user);

        return "OK";
    }

    /**
     * Login as a user and get a token
     * @param string $username The user you wish to log in as
     * @param string $password That users password
     * @return string
     * @throws Exception
     */
    public function getLoginTokenAction($username, $password) {
        if(!$username || !$password) {
            throw new Exception('You must specify a username and password', 400);
        }

        $cache = new Cache(__DIR__.'/../files/users');
        $user = $cache->getValueForKey('user-'.$username);

        if(is_array($user) && $user['password'] === $this->getPasswordHash($password)) {
            $user['token'] = sha1(mt_rand()); // Note, this isn't a safe way to create tokens
            $cache->setValueForKey('user-'.$username, $user);
            return $user['token'];
        }

        throw new Exception("Invalid username or password", 401);

    }

    /**
     * Check if a user is logged in
     * @param string $username The user who is logged in
     * @param string $token The token that has been given to that user for this session
     * @return bool
     * @throws Exception
     */
    public function getIsLoggedInAction($username, $token) {
        if(!$username || !$token) {
            throw new Exception('You must specify a username and token');
        }

        $cache = new Cache(__DIR__.'/../files/users');
        $user = $cache->getValueForKey('user-'.$username);

        if(is_array($user) && $user['token'] === $token) {
            return true;
        }
        return false;
    }

    /**
     * Create a password hash
     * @param $password
     * @return string
     */
    public function getPasswordHash($password) {
        return hash('sha256', $password);
    }

}