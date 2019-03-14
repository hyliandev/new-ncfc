<?php

class Model {
	protected
		$data,
		$required_values,
		$primary_key,
		$primary_value,
		$table
	;
	
	public function __construct($table, $primary_key, $primary_value = false, $required_values = []){
		$this->table = $table;
		
		$this->primary_key = $primary_key;
		
		$this->data = [];
		
		if(!empty($primary_value)){
			$this->primary_value = $primary_value;
			
			$this->Load();
		}
		
		$this->$required_values = $required_values;
	}
	
	public static function Delete($table, $primary_key, $primary_value){
		global $db;
		
		$sql = "DELETE FROM $table WHERE $primary_key = $primary_value;";
		
		$db->query($sql);
	}
	
	public static function FetchIDs($IDs){
		$ret = [];
		
		foreach($IDs as $ID){
			$class = static::class;
			
			$ret[] = new $class($ID);
		}
		
		return $ret;
	}
	
	public static function FetchQuery($table, $primary_key, $_where = [], $_limit = false, $page = 1){
		global $db;
		
		$where = [];
		
		foreach($_where as $key => $value){
			$value = assocToQueryString($value);
			
			if($value !== false){
				$where[] = $key . ' = ' . $value;
			}
		}
		
		$limit = '';
		
		if(!empty($_limit)){
			$limit = " LIMIT ";
			
			if($page > 1){
				$limit .= ($_limit * ($page - 1)) . ",";
			}
			
			$limit .= " " . $_limit;
		}
		
		$sql = "SELECT " . $primary_key . " FROM " . $table . (!empty($where) ? " WHERE " . implode(' AND ', $where) : '') . $limit;
		
		$query = $db->query($sql);
		
		$IDs = [];
		
		while($row = $db->fetch_array($query)){
			$IDs[] = $row['pid'];
		}
		
		return static::FetchIDs($IDs);
	}
	
	public function Destroy(){
		Model::Delete($this->table, $this->primary_key, $this->primary_value);
	}
	
	public function Get($key){
		if(empty($this->data[$key])){
			return false;
		}
		
		return $this->data[$key];
	}
	
	protected function Load(){
		global $db;
		
		if(empty($this->primary_key) || empty($this->primary_value)){
			die('fake');
			return false;
		}
		
		$query = $db->query("SELECT * FROM " . $this->table . " WHERE " . $this->primary_key . " = " . $this->primary_value . ";");
		
		$query = $db->fetch_array($query);
		
		foreach($query as $key => $value){
			if($key == $this->primary_key){
				continue;
			}
			
			$this->data[$key] = $value;
		}
	}
	
	public function Save(){
		global $db;
		
		foreach($this->required_values as $value){
			if(empty($this->data[$required_values])){
				throw new Exception('Not all required values are filled in');
			}
		}
		
		if(empty($this->primary_value)){
			$sql = "INSERT INTO " . $this->table . " ( {keys} ) VALUES ( {values} );";
			
			$sql = str_replace('{keys}', implode(',', array_keys($this->data)), $sql);
			
			$values = [];
			foreach($this->data as $value){
				$value = assocToQueryString($value);
				
				if(!empty($value)){
					$values[] = $value;
				}
			}
			
			$sql = str_replace('{values}', implode(',', $values), $sql);
		}else{
			$sql = "UPDATE " . $this->table . " SET {values} WHERE " . $this->primary_key . " = " . $this->primary_value . ";";
			
			$values = [];
			foreach($this->data as $key => $value){
				$value = assocToQueryString($value);
				
				if(!empty($value)){
					$values[] = $value;
				}
			}
			
			$sql = str_replace('{values}', implode(',', $values), $sql);
		}
		
		$db->query($sql);
	}
	
	public function Set($key, $value){
		$this->data[$key] = $value;
	}
	
	public function SetMulti($assoc){
		foreach($assoc as $key => $value){
			$this->Set($key, $value);
		}
	}
}

?>