<?php
/**
 * Stores data in a file to be used between visits without relying on DB or SESSION
 * @author Daniel Mason
 * @copyright Daniel Mason, 2014
 */

namespace AyeAye\Tutorial;


class Cache
{

    /**
     * The name of the cache file
     * @var string
     */
    protected $cacheFile;

    /**
     * The cache data
     * @var array
     */
    protected $data = [];

    /**
     * Construct or retrieve a cache of data from the given file
     * @param string $file
     */
    public function __construct($file)
    {
        $this->cacheFile = $file;
        if(is_file($file)) {
            $this->data = json_decode(file_get_contents($file), true);
        }
    }

    /**
     * Saves the cache when the object is destroyed
     */
    public function __destruct()
    {
        $this->saveCache();
    }

    /**
     * Save data to the cache, if there is any data to save it will delete the file to clean up
     */
    public function saveCache()
    {
        if (!$this->data) {
            return $this->deleteCache();
        }
        file_put_contents($this->cacheFile, json_encode($this->data));
        return $this;
    }

    /**
     * Deletes all of the data and the cache file
     * @return $this
     */
    public function deleteCache()
    {
        $this->data = [];
        if (is_file($this->cacheFile)) {
            unlink($this->cacheFile);
        }
        return $this;
    }

    /**
     * Gets all of the data
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Get the value for a given key
     * @param $key
     * @return mixed|null
     */
    public function getValueForKey($key)
    {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }
        return null;
    }

    /**
     * Set the value for a given key
     * @param $key
     * @param $value
     * @return $this
     */
    public function setValueForKey($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

} 