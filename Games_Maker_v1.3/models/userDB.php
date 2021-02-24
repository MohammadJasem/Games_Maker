<?php

class userDB extends model{
//--------------------------------------------------------//

	public function __construct(){
		parent::__construct();
	}
//--------------------------------------------------------//	
	public function addUser($dataToSave){
		$data = [
			'first_name'	=>	$dataToSave['firstname'],
			'last_name'		=>	$dataToSave['lastname'],
			'user_name'		=>	$dataToSave['username'],
			'password'		=>	$dataToSave['password'],
		];
		$this->db->insert('users',$data);
		return $this->db->id();
	}
//--------------------------------------------------------//
	public function getUser($userId='',$userName){
		$cols = ['user_id','first_name','last_name','user_name','password'];
		$where = [];
		if($userId!='')
			$where['user_id'] = $userId;
		if($userName!='')
			$where['user_name'] = $userName;

		$this->db->select('users',$cols,$where);

		return $this->db->result_array();
	}	
//--------------------------------------------------------//	
}