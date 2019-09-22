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
 * A class to cache values using redis,
 * can be used with JSONReader
 */
class RedisCache /*extends Cache*/ {

	/**
	 * Redis Settings
	 */
	private static $host = '127.0.0.1',
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

	private $redis, $prefix;

	/**
	 * Generate a storage
	 * @param $group The storage group, a prefix for the key.
	 */
	public function __construct($group){
		$this->redis = new Redis();
		$this->redis->pconnect(self::$host, self::$port);
		if( !empty(self::$auth) ){
			$this->redis->auth(self::$auth);
		}

		if( !$this->redis->ping() ){
			throw new Exception('Unable to connect to Redis Server!');
		}

		$this->prefix = base64_encode(hash('sha512', strtolower($group), true)) . ':';
	}

	/**
	 * Generate the key for some storage.
	 * @param $key the key
	 * @return the full key
	 */
	private function generateKey( string $key ) : string {
		return $this->prefix . str_replace( ':', '', $key );
	}

	/**
	 * Remove the entire storage Group.
	 */
	public function removeGroup() : bool {
		$dels = array();
		$lenpref = strlen($this->prefix);
		$iterator = NULL;
		do {
			$keys = $this->redis->scan($iterator);
			if ($keys !== FALSE) {
				$dels = array_merge( $dels, array_filter( $keys, function( $k ) use ($lenpref){
					return substr($k, 0, $lenpref) == $this->prefix;
				}));
			}
		} while ($iterator > 0);
		return $this->redis->unlink($dels) == count($dels);
	}

	// # # # # #
	// Key => Value 
	// # # # # #

	/**
	 * Does the key exist?
	 * @param $key The key.
	 * @param $value The value to store.
	 * @param The time to live for the value.
	 * @return The value
	 */
	public function set( string $key, string $value, int $ttl = 0 ): bool {
		$r = $this->redis->set( $this->generateKey($key), $value );
		if( $ttl !== 0){
			$this->redis->expire($this->generateKey($key), $ttl);	
		}
		return $r;
	}

	/**
	 * Does the key exists?
	 * @param $key The key.
	 * @return The value
	 */
	public function get( string $key ) : string {
		return $this->redis->get($this->generateKey($key));
	}

	/**
	 * Does the key exists?
	 * @param $key The key.
	 * @return exists?
	 */
	public function keyExists(string $key) : bool {
		return $this->redis->exists($this->generateKey($key));
	}

	// # # # # #
	// Key => Array (HashMap)
	// # # # # #

	/**
	 * Sets an array into the cache.
	 * 	We do a json_encode on deep arrays!
	 * @param $key The key of the array
	 * @param $array The array 
	 * @param $ttl The time to live for the array (0 => always)
	 * @return successful stored?
	 */
	public function arraySet( string $key, array $array, int $ttl = 0 ) : bool {
		$key = $this->generateKey($key);

		$d = array();
		foreach( $array as $k => $v ){
			$d[strval($k)] = json_encode( $v );
		}
		$r = $this->redis->hMSet( $key, $d);
		if( $ttl !== 0){
			$this->redis->expire($key, $ttl);	
		}
		return $r;
	}

	/**
	 * Gets an array from the cache.
	 * @param $key The key of the array
	 * @return the array
	 */
	public function arrayGet( string $key ) : array {
		return array_map( function ($v){
				return json_decode($v, true);
			}, $this->redis->hGetAll($this->generateKey($key))
		);
	}

	/**
	 * Check an array for a key.
	 * @param $key The key of the array
	 * @param $arrayKey The key of the value in the array
	 * @return Does the key exist?
	 */
	public function arrayKeyExists(string $key, string $arrayKey ) : bool {
		return $this->redis->hExists($this->generateKey($key), strval($arrayKey));
	}

	/**
	 * Get value of a key of an array.
	 * @param $key The key of the array
	 * @param $arrayKey The key of the value in the array
	 * @return The value
	 */
	public function arrayKeyGet(string $key, string $arrayKey ) {
		return json_decode( $this->redis->hGet($this->generateKey($key), strval($arrayKey)), true);
	}

	/**
	 * Set the value of one key in an array.
	 * @param $key The key of the array
	 * @param $arrayKey The key of the value in the array
	 * @param $value The value to store
	 * @param $ttl The time to live for the entire array (0 => always)
	 * @return successful stored?
	 */
	public function arrayKeySet(string $key, string $arrayKey, $value, int $ttl = 0 ) : bool {
		$r = $this->redis->hSet( $this->generateKey($key), strval($arrayKey), json_encode($value));
		if( $ttl !== 0){
			$this->redis->expire($this->generateKey($key), $ttl);	
		}
		return $r;
	}
}
?>
