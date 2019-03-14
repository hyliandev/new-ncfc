<?php

class NewsPost extends Model {
	public function __construct($id){
		parent::__construct('mybb_posts', 'pid', $id, [
			'tid',
			'fid',
			'subject',
			'uid',
			'username',
			'dateline',
			'message',
			'ipaddress',
			'longipaddress',
			'posthash',
		]);
	}
	
	public function Author(){
		if(empty($this->Get('uid'))){
			return false;
		}
		
		return $this->Get('uid');
		
		// return new User($this->data['uid']);
	}
}

?>