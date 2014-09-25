<?php
/**
 * Say hello to Aye Aye
 * @author Daniel Mason
 * @copyright Daniel Mason, 2013
 */

namespace AyeAye\Tutorial\OtherTricks;


use AyeAye\Api\Controller;

class Index extends Controller {

	protected $children = [
        'coffee' => '\AyeAye\Tutorial\OtherTricks\Coffee',
    ];

    protected $ignoreChildren = [
        'coffee'
    ];

} 