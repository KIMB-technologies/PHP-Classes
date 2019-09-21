<?php
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
 * Reader class, can be used with redis or json or both. Using both means
 * all saves are done using the json, but queries are processed by redis.
 * 
 * A index is a array/ path of strings. Like the branches of a tree.
 * One part of a index must not contain ".".
 */
class Reader {
	
	/**
	 * Changes the data path, the prefix for all data e.g. the path on filesystem
	 * @param $path the new path (optional)
	 * @return the current path
	 */
	public static function changePath( string $path = '' ) : string {
		RedisReader::changePath($path);
		return JSONReader::changePath($path);
	}

	/**
	 * Deletes a storage datasets e.g. a json file
	 * @param $name dataset to delete
	 * @return deleted?
	 */
	public static function deleteSet( string $name ) : bool{
		return RedisReader::deleteSet($name)
			&& JSONReader::deleteSet($name);
	}

	private $json, $redis;

	/**
	 * Create a Reader and Saver
	 * 	Will combine Redis and JSON
	 * 	=> Redis for speed in reading etc.
	 * 	=> JSON for persistance
	 * @param $name the name of the dataset to open
	 * @param $lockex shall the dataset be locked exclusive? (optional)
	 * @param $otherPath give a other path than the default one (optional)
	 */
	public function __construct( string $name, bool $lockex = false, string $otherPath = ''){
		$this->redis = new RedisStore( $name, $lockex, $otherPath );
		$this->json = new JSONReader( $name, $lockex, $otherPath );
	}

	/**
	 * Returns the array of this dataset
	 * @return the array
	 */
	public function getArray() : array {
		return $this->redis->getArray();
	}

	/**
	 * Sets the array of this dataset
	 * @param $array the array to set
	 */
	public function setArray( array $data ) : void {
		$this->redis->setArray($data);
		$this->json->setArray($data);
	}

	/**
	 * Print the array
	 */
	public function output() : void {
		print_r( $this->getArray() );
	}

	/**
	 * Checks if a key has a value.
	 * @param $index array of indexes, the index
	 * @param $value the value need at index
	 * @return $value and value at $index matches, or $index exists
	 */
	public function isValue( array $index, $value = null ) : bool {
		return $this->redis->isValue( $index, $value );
	}

	/**
	 * Fetch a value by the index
	 * @param $index the array of indexes, the index
	 * @param $exception throw an exception if index not found, or return false (optional)
	 * @return the value or false
	 */
	public function getValue( array $index, bool $exception = false ){
		return $this->redis->getValue( $index, $exception );
	}

	/**
	 * Search a value.
	 * @param $index $index the array of indexes, the index 
	 * @param $value the value to search
	 * @param $column search a colum, name here or null (optional)
	 * @return like array_search(), the first found index or false
	 */
	public function searchValue( $index, $value, $column = null ){
		return $this->redis->searchValue($index, $value, $column);
	}

	/**
	 * Set a value.
	 * @param $index array of indexes, the index
	 * @param $value the value to set
	 */
	public function setValue( array $index, $value ) : void {
		$this->redis->setValue($index, $value);
		$this->redis->setValue($index, $vale);
	}

	/**
	 * Get the inner RedisReader
	 * @return the RedisReader
	 */
	public function getRedis() : RedisReader {
		return $this->redis;
	}

	/**
	 * Get the inner JSONReader
	 * @return the JSONReader
	 */
	public function getJSON() : JSONReader {
		return $this->json;
	}
}

?>