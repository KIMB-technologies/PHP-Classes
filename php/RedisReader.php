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

class RedisReader extends Reader {

	
	/**
	 * Changes the data path, the prefix for all data e.g. the path on filesystem
	 * @param $path the new path (optional)
	 * @return the current path
	 */
	public static function changePath( string $path = '' ) : string {
		// ToDo
	}
	
	/**
	 * Deletes a storage datasets e.g. a json file
	 * @param $name dataset to delete
	 * @return deleted?
	 */
	public static function deleteSet( string $name ) : bool{
		// ToDo
	}

	/**
	 * Set redis connection details.
	 */
	public static function setRedisConnect(){
		// ToDo
	}
	
	/**
	 * Create a Redis Reader and Saver
	 * @param $name the name of the dataset to open
	 * @param $lockex shall the dataset be locked exclusive? (optional)
	 * @param $otherPath give a other path than the default one (optional)
	 */
	public function __construct( string $name, bool $lockex = false, string $otherPath = ''){
		// ToDo
	}
	
	/**
	 * Returns the array of this dataset
	 * @return the array
	 */
	public function getArray() : array {
		// ToDo
	}
	
		/**
		 * Sets the array of this dataset
		 * @param $array the array to set
		 */
		public function setArray( array $data ) : void {
			// ToDo
		}
	
		
		/**
		 * Checks if a key has a value.
		 * @param $index array of indexes, the index
		 * @param $value the value need at index
		 * @return $value and value at $index matches, or $index exists
		 */
		public function isValue( array $index, $value = null ) : bool {
			// ToDo
		}
	
		/**
		 * Fetch a value by the index
		 * @param $index the array of indexes, the index
		 * @param $exception throw an exception if index not found, or return false (optional)
		 * @return the value or false
		 */
		public function getValue( array $index, bool $exception = false ){
			// ToDo
		}
	
		/**
		 * Search a value.
		 * @param $index $index the array of indexes, the index 
		 * @param $value the value to search
		 * @param $column search a colum, name here or null (optional)
		 * @return like array_search(), the first found index or false
		 */
		public function searchValue( $index, $value, $column = null ){
			// ToDo
		}
	
		/**
		 * Set a value.
		 * @param $index array of indexes, the index
		 * @param $value the value to set
		 */
		public function setValue( array $index, $value ) : void {
			// ToDo
		}
}
?>
