<?php
/**
 * Create and log in as users
 * @author Daniel Mason
 * @copyright Daniel Mason, 2013
 */

namespace AyeAye\Tutorial\Controllers;


use AyeAye\Api\Controller;
use AyeAye\Api\Exception;
use AyeAye\Tutorial\Cache;

/**
 * User control
 * @package AyeAye\Tutorial\Controllers
 */
class Content extends Controller {

    public function getContentsAction($count = 1) {
        $count = (int)$count;

        $cache = new Cache(__DIR__.'/../files/contents');
        $contents = $cache->getValueForKey('contents');

        if(!is_array($contents)) {
            $contents = [];
        }

        $totalContent = count($contents);
        if($count > $totalContent) {
            $count = $totalContent;
        }

        return array_slice($contents, -$count, $count);
    }

    public function putContentAction($username, $token, $content) {

        // Check if the user is logged in before allowing them to enter content
        $userController = new User();
        $isLoggedIn = $userController->getIsLoggedInAction($username, $token);
        if(!$isLoggedIn) {
            throw new Exception("Not authorized. Please log in to acquire an access token", 401);
        }

        $cache = new Cache(__DIR__.'/../files/contents');
        $contents = $cache->getValueForKey('contents');

        if(!is_array($contents)) {
            $contents = [];
        }

        $contents[] = [
            'content' => $content,
            'username' => $username,
            'date' => date('Y-m-d H:i:s'),
        ];

        $cache->setValueForKey('contents', $contents);

        return "OK";

    }

}