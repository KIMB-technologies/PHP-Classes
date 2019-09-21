<?php
defined('KIMB-Classes') or die('Invalid Endpoint');

/** 
 * KIMB-technologies
 * https://github.com/KIMB-technologies/
 * 
 * (c) 2019 KIMB-technologies 
 * 
 * released under the terms of MIT License
 * https://opensource.org/licenses/MIT
 */

/**
 * A abstract cache, store values by key.
 */
abstract class Cache {

	/**
	 * Add or set a single value in the cache.
	 * @param $key the key of the value
	 * @param $value the value
	 * @param $ttl time in seconds until values expire (0 => don't remove)
	 * @return successful
	 */
	abstract public function addValue( string $key, string $value, int $ttl = 0 ) : bool;

	/**
	 * Add or set a array in the cache.
	 * @param $key the key of the list
	 * @param $array the array to store
	 * @param $ttl time in seconds until values expire (0 => don't remove)
	 * @return successful
	 */
	abstract public function addArray( string $key, array $array, int $ttl = 0 ) : bool;

	/**
	 * Add or set a array in the cache.
	 * @param $key the key of the list
	 * @param $array the array to store
	 * @param $arrayKey the key in the array where to store
	 * @param $ttl time in seconds until values expire (0 => don't remove)
	 * @return successful
	 */
	abstract public function addArrayKey( string $key, string $arrayKey, string $value, int $ttl = 0 ) : bool;

	/**
	 * Remove a key and its values
	 * @param $key the key to remove
	 * @return removed?
	 */
	abstract public function removeKey( string $key ) : bool;

	/**
	 * Check if a key exists
	 * @param $key the key to check
	 * @return exists?
	 */
	abstract public function isKey( string $key ) : bool;

	/**
	 * Get the value stored at this key (array or single value).
	 * @param $key the key
	 * @return the value
	 */
	abstract public function getKey( string $key );

	/**
	 * Get value in a array by its keys.
	 * @param $key the storage key of the array
	 * @param $arrayKey the key in the stored array
	 * @return the string value
	 */
	abstract public function getArrayKey( string $key, string $arrayKey ) : string;

	/**
	 * Like getKey(), but will call $callback if key does not exists and
	 * save the return of $callback in the cache, using the provided $ttl.
	 * @param $key the key 
	 * @param $callback a callback to get the value at $key
	 * @param $ttl time in seconds until values expires, if added via callback (0 => don't remove)
	 * @return the value (new or cached one)
	 */
	public function getCachedKey( string $key, callable $callback, int $ttl = 0) {
		if( $this->isKey( $key ) ){
			return $this->getKey($key);
		}
		else{
			$value = $callback();
			$this->addArray( $key, $value, $ttl );
			return $value;
		}
	}

	/**
	 * Like getKey(), but will call $callback if key does not exists and
	 * save the return of $callback in the cache, using the provided $ttl.
	 * @param $key the key 
	 * @param $callback a callback to get the value at $key
	 * @param $ttl time in seconds until values expires, if added via callback (0 => don't remove)
	 * @return the value (new or cached one)
	 */
	public function getCachedArray( string $key, callable $callback, int $ttl = 0) {
		if( $this->isKey( $key ) ){
			return $this->getKey($key);
		}
		else{
			$value = $callback();
			$this->addValue( $key, $value, $ttl );
			return $value;
		}
	}
}

?>