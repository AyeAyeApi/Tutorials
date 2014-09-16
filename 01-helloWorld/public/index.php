<?php
/**
 * Entry point into API
 * @author Daniel Mason
 * @copyright Daniel Mason, 2014
 */

require_once '../../vendor/autoload.php';

use \AyeAye\Api\Api;
use \AyeAye\Tutorial\HelloWorld\HelloWorldController;

$api = new Api(new HelloWorldController);
$api->go()->respond();

// This line makes curl a little easier to deal with
echo PHP_EOL;