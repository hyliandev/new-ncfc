<?php

class User extends Model {
	public function __construct($id = false){
		parent::__construct('mybb_users', 'uid', $id, [
			'username',
			'password',
			'salt',
			'email',
		]);
	}
}

?>