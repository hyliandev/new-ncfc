<?php

class Event extends Model {
	public function __construct($id = false){
		parent::__construct('ncfc_events', 'eid', $id, [
			'begin_date',
			'end_date',
		]);
	}
	
	public static function Current(){
		
	}
}

?>