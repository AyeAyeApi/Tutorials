<?php
/**
 * Say hello to Aye Aye
 * @author Daniel Mason
 * @copyright Daniel Mason, 2013
 */

namespace AyeAye\Tutorial\HelloWorld;


use AyeAye\Api\Controller;

class HelloWorldController extends Controller {

	public function getAyeAyeAction($name = 'Captain') {
		return "Aye Aye $name";
	}

} 