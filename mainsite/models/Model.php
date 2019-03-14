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
		
		if(!empty($primary_value)){
			$this->primary_value = $primary_value;
		}
		
		if(!empty($required_values)){
			$this->required_values = $required_values;
		}
	}
	
	public static function Delete($table, $primary_key, $primary_value){
		$sql = "DELETE FROM $table WHERE $primary_key = $primary_value;";
		
		die($sql);
	}
	
	public function Destroy(){
		Model::Delete($this->table, $this->primary_key, $this->primary_value);
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
				if(is_numeric($value)){
					$values[] = $value;
				}elseif(is_string($value)){
					$values[] = "'" . $db->escape_string($value) . "'";
				}
			}
			
			$sql = str_replace('{values}', implode(' AND ', $values), $sql);
		}else{
			$sql = "UPDATE " . $this->table . " SET {values} WHERE " . $this->primary_key . " = " . $this->primary_value;
			
			$values = [];
			foreach($this->data as $key => $value){
				if(is_numeric($value)){
					$value = $value;
				}elseif(is_string($value)){
					$value = "'" . $db->escape_string($value) . "'";
				}else{
					continue;
				}
				
				$key . ' = ' . $value;
			}
			
			$sql = str_replace('{values}', implode(',', $values), $sql);
		}
		
		die($sql);
	}
	
	public function Set($key, $value){
		$this->data[$key] = $value;
	}
}

?>