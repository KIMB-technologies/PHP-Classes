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
 * Reader class, the JSONReader and RedisCache provide the same functionality
 * defined here.
 * 
 * A index is a array/ path of strings. Like the branches of a tree.
 * One part of a index must not contain ":".
 */
abstract class Reader {

	/**
	 * Path where the JSON files are located, in redis used as key prefix
	 */
	private static $path = __DIR__.'/';
	
	/**
	 * Changes the data path, the prefix for all data e.g. the path on filesystem
	 * @param $path the new path (optional)
	 * @return the current path
	 */
	public static function changePath( string $path = '' ) : string {
		//got new path
		if( !empty( $path ) ){
			// if no slash at the end, add one
			if( substr( $path , -1 ) != '/' ){
				$path = $path.'/';
			}
			// change path
			self::$path = $path;
		}
		// return the current path
		return self::$path;
	}

	/**
	 * Deletes a storage datasets e.g. a json file
	 * @param $name dataset to delete
	 * @return deleted?
	 */
	abstract public static function deleteSet( string $name ) : bool;

	/**
	 * Returns the array of this dataset
	 * @return the array
	 */
	abstract public function getArray() : array;

	/**
	 * Sets the array of this dataset
	 * @param $array the array to set
	 */
	abstract public function setArray( array $data ) : void;

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
	abstract public function isValue( array $index, $value = null ) : bool;

	/**
	 * Fetch a value by the index
	 * @param $index the array of indexes, the index
	 * @param $exception throw an exception if index not found, or return false (optional)
	 * @return the value or false
	 */
	abstract public function getValue( array $index, bool $exception = false );

	/**
	 * Search a value.
	 * @param $index $index the array of indexes, the index 
	 * @param $value the value to search
	 * @param $column search a colum, name here or null (optional)
	 * @return like array_search(), the first found index or false
	 */
	abstract public function searchValue( $index, $value, $column = null );

	/**
	 * Set a value.
	 * @param $index array of indexes, the index
	 * @param $value the value to set
	 */
	abstract public function setValue( array $index, $value ) : void;
}

?>