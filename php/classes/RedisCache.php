<?php
defined('KIMB-Classes') or die('Invalid Endpoint');

/** 
 * KIMB-technologies
 * https://github.com/KIMB-technologies/
 * 
 * (c) 2019 KIMB-technologies 
 * 
 * released under the terms of GNU Public License Version 3
 * https://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * A class to cache values using redis,
 * can be used with JSONReader
 */
class RedisCache extends Reader {

	/**
	 * Deletes a storage datasets e.g. a json file
	 * @param $name dataset to delete
	 * @return deleted?
	 */
	public static function deleteSet( string $name ) : bool {
		return false;
	}

	/**
	 * Redis Settings
	 */
	private $host = '127.0.0.1',
		$port = 6379,
		$auth = null;

	/**
	 * Set the details of the redis server.
	 * @param $host the host of the server (default 127.0.0.1)
	 * @param $port the port to use (default 6379)
	 * @param $auth the password to use (default no auth)
	 */
	public static function setRedisServer($host, $port = 6379, $auth = null){
		self::$host = $host;
		self::$port = $port;
		self::$auth = $auth;
	}

	/**
	 * Redis connection
	 */
	private $redis, $prefix;

	public function __construct($filename, $otherpath = ''){
		$this->redis = new Redis();
		$this->redis->pconnect(self::$host, self::$port);
		if( !empty(self::$auth) ){
			$this->redis->auth(self::$auth);
		}

		// the path and filename is used as 
		$this->prefix = base64_encode(
				hash(
					'sha512',
					(empty($otherpath) ? self::$path : $otherpath . '/' ). $filename . '.json',
					true
				)
			);
	}

	private function getKeyFromIndex(array $index) : string {
		$i = array_filter( $index, function ($value){
			return !is_null( $value ) && (
					( is_string( $value ) && strlen( $value ) > 0 ) 
					|| ( is_numeric( $value ) )
				);
		});
		// <sha512 as filename>:<key>:<key>:<key>(: if append value, else no :)
		return $this->prefix . ':' . implode( ':', $i ) . (end($index) == null ? ':' : '');
	}

	/**
	 * Returns the array of this dataset
	 * @return the array
	 */
	public function getArray() : array {
		return [];
	}

	/**
	 * Sets the array of this dataset
	 * @param $array the array to set
	 */
	public function setArray( array $data ) : void {
		
	}

	/**
	 * Checks if a key has a value.
	 * @param $index array of indexes, the index
	 * @param $value the value need at index
	 * @return $value and value at $index matches, or $index exists
	 */
	public function isValue( array $index, $value = null ) : bool {
		return false;
	}

	/**
	 * Fetch a value by the index
	 * @param $index the array of indexes, the index
	 * @param $exception throw an exception if index not found, or return false (optional)
	 * @return the value or false
	 */
	public function getValue( array $index, bool $exception = false ) {

	}

	/**
	 * Search a value.
	 * @param $index $index the array of indexes, the index 
	 * @param $value the value to search
	 * @param $column search a colum, name here or null (optional)
	 * @return like array_search(), the first found index or false
	 */
	public function searchValue( $index, $value, $column = null ) {

	}

	/**
	 * Set a value.
	 * @param $index array of indexes, the index
	 * @param $value the value to set
	 */
	public function setValue( array $index, $value ) : void {

	}

	/**
	 * Set a timeout for the value at index
	 * @param $index array of indexes, the index
	 * @param $timeout the time to live in seconds
	 */
	public function setTimeout(array $index, int $timeout) : void {

	}

	/**
	 * Imports a JSONReader into the RedisCache
	 * @param $reader the json reader to import
	 */
	public function importJSON(JSONReader $reader){

	}
}
?>
