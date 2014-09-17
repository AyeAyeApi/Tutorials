<?php
/**
 * Say hello to Aye Aye
 * @author Daniel Mason
 * @copyright Daniel Mason, 2014
 */

namespace AyeAye\Tutorial\Endpoints;


use AyeAye\Api\Controller;
use AyeAye\Api\Exception;

class EndpointController extends Controller {

	/**
	 * A simple test end point
	 * @return string
	 */
	public function getTestAction() {
		return "This is a test";
	}

	/**
	 * An end point that demonstrates multi-word names
	 * @return string
	 */
	public function getLongerNameAction() {
		return "This is a longer name";
	}

	/**
	 * Save some information to a cache file
	 * @param $key
	 * @param $value
	 * @throws Exception
	 */
	public function postInformationAction($key, $value) {
		if(!$key || !$value) {
			throw new Exception("You must specify parameters 'key' and 'value'", 400);
		}
		$cache = new Cache('../files/cache');
		$cache->setValueForKey($key, $value);
		return "OK";
	}

	/**
	 * Retrieve previously saved information from the cache file
	 * @param $key
	 * @return mixed
	 * @throws Exception
	 */
	public function getInformationAction($key) {
		if(!$key) {
			throw new Exception("You must specify parameter 'key'", 400);
		}
		$cache = new Cache('../files/cache');
		return $cache->getValueForKey($key);
	}

	/**
	 * Delete saved information from the cache file
	 * @return mixed
	 * @throws Exception
	 */
	public function getAllInformationAction() {
		$cache = new Cache('../files/cache');
		return $cache->getData();
	}

	/**
	 * Delete saved information from the cache file
	 * @return mixed
	 * @throws Exception
	 */
	public function deleteAllInformationAction() {
		$cache = new Cache('../files/cache');
		$cache->deleteCache();
		return "OK";
	}

} 