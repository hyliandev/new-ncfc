<?php

class Brand extends Model {
	public function __construct($id = false){
		parent::__construct('ncfc_brands', 'uid', $id, [ 'title', ]);
	}
	
	public function Save(){
		if(empty($this->data['slug'])){
			$this->data['slug'] = slug($this->data['title']);
		}
		
		if(empty($this->data['added_date'])){
			$this->data['added_date'] = time();
		}
		
		parent::Save();
	}
}

?>