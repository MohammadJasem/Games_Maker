<?php

class gameDB extends model{
//--------------------------------------------------------//

	public function __construct(){
		parent::__construct();
	}
//--------------------------------------------------------//	
	public function addGame($dataToSave,$userId){
		$data = [
			'user_id'		=>	$userId,
			'game_name'		=>	$dataToSave['game_name'],
			'game_ver'		=>	$dataToSave['game_ver'],
			'dimension'		=>	$dataToSave['dimension'],
			'local_storage_name' => 'test'
		];
		$this->db->insert('games',$data);
		return $this->db->id();
	}
//--------------------------------------------------------//
	public function updateGame($dataToSave,$gameId,$userId){
		$data = [
			'user_id'		=>	$userId,
			'game_name'		=>	$dataToSave['game_name'],
			'game_ver'		=>	$dataToSave['game_ver'],
			'dimension'		=>	$dataToSave['dimension'],
		];
		$this->db->update('games',$data,['game_id'=>$gameId]);
		return $this->db->id();
	}
//--------------------------------------------------------//
	public function saveGameSettings($dataToSave,$gameId){
		$data = [
			'game_width'			=>	$dataToSave['game_width'],
			'game_height'			=>	$dataToSave['game_height'],
			'local_storage_name'	=>	$dataToSave['local_storage_name'],
		];
		$this->db->update('games',$data,['game_id'=>$gameId]);
		return $this->db->id();
	}
//--------------------------------------------------------//
	public function deleteGame($gameId){
		$this->db->delete('games',['game_id'=>$gameId]);
	}
//--------------------------------------------------------//
	public function getGame($gameId='',$userId='',$gameName='',$ver='',$dimension=''){
		$cols = ['game_id','user_id','game_name','game_ver','dimension','game_width','game_height','local_storage_name'];
		$where = [];
		if($gameId!='')
			$where['game_id'] = $gameId;
		if($userId!='')
			$where['user_id'] = $userId;
		if($gameName!='')
			$where['game_name'] = $gameName;
		if($ver!='')
			$where['game_ver'] = $ver;
		if($dimension!='')
			$where['dimension'] = $dimension;
		

		$this->db->select('games',$cols,$where);

		return $this->db->result_array();
	}	
//--------------------------------------------------------//

//--------------------------------------------------------//
}