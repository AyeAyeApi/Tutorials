<?php
/**
 * Say hello to Aye Aye
 * @author Daniel Mason
 * @copyright Daniel Mason, 2013
 */

namespace AyeAye\Tutorial\Controllers;


use AyeAye\Api\Controller;

class Index extends Controller {

	public $children = [
        'users' => '\AyeAye\Tutorial\Controllers\User',
        'content' => '\AyeAye\Tutorial\Controllers\Content',
    ];

} 