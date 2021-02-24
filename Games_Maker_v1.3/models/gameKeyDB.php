<?php

class gameKeyDB extends model{
//--------------------------------------------------------//

	public function __construct(){
		parent::__construct();
	}
//--------------------------------------------------------//
	public function saveGameKeys($dataToSave,$gameId){
		$keyId = $dataToSave['keyId'];
		$data = [
			'game_id'		=>	$gameId,
			'key_name'		=>	$dataToSave['keyName'],
			'key_code'		=>	$dataToSave['keyCode'],
			'active'		=>	$dataToSave['active']
		];
		if($keyId!='')
			$this->db->update('game_key',$data,['game_key_id'=>$keyId]);
		else
			$this->db->insert('game_key',$data);
		return $this->db->id();
	}
//--------------------------------------------------------//
	public function getGameKeys($gameId,$active=''){
		$cols = ['game_key_id','game_id','key_name','key_code','active'];
		$where = [];
		
		if($gameId!=='')
			$where['game_id'] = $gameId;
		if($active!=='')
			$where['active'] = $active;
		
		$this->db->select('game_key',$cols,$where);

		return $this->db->result_array();
	}
//--------------------------------------------------------//
    public function deleteGameKeys($gameId){
        $where = [];
        $where['game_id'] = $gameId;
        $this->db->delete('game_key',$where);
    }
}