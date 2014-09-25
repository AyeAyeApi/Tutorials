<?php
/**
 * Coffee Pot Controller
 * @author Daniel Mason
 * @copyright Daniel Mason, 2014
 */

namespace AyeAye\Tutorial\OtherTricks;

use AyeAye\Api\Controller;
use AyeAye\Api\Exception;

/**
 * User control
 * @package AyeAye\Tutorial\Controllers
 */
class Coffee extends Controller {

    public function getIndexAction() {
        throw new Exception(418);
    }

}