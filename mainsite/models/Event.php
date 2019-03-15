<?php

class Event extends Model {
	public function __construct($id = false){
		parent::__construct('ncfc_events', 'eid', $id, [
			'begin_date',
			'end_date',
		]);
	}
	
	public static function Current(){
		global $db;
		
		$query = $db->query("SELECT eid FROM ncfc_events WHERE begin_date < " . time() . " AND end_date > " . time() . " LIMIT 1;");
		
		$query = $db->fetch_array($query);
		
		if(empty($query['eid'])){
			return false;
		}
		
		return new Event($query['eid']);
	}
}

?>