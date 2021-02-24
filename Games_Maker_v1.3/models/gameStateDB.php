<?php

class gameStateDB extends model{
//--------------------------------------------------------//

	public function __construct(){
		parent::__construct();
	}
//--------------------------------------------------------//
	public function addGameState($stateName,$stateOrder,$gameId,$is_default = ''){
		$data = [
			'game_id'		=>	$gameId,
			'state_name'	=>	$stateName,
			'shown_name'	=>	$stateName,
			'state_order'	=>	$stateOrder,
			'is_default'	=>	$is_default
		];
		$this->db->insert('game_states',$data);
		return $this->db->id();
	}
//--------------------------------------------------------//	
	public function updateGameState($stateName,$stateOrder,$gameStateId,$gameId,$is_default = ''){
		$data = [
			'game_id'		=>	$gameId,
			'shown_name'	=>	$stateName,
			'state_order'	=>	$stateOrder,
			'is_default'	=>	$is_default
		];
		$this->db->update('game_states',$data,['state_id'=>$gameStateId]);
		return $this->db->id();
	}
//--------------------------------------------------------//
	public function deleteGameState($gameStateId = '',$gameId = ''){
		if($gameStateId != '')
			$this->db->delete('game_states',['state_id'=>$gameStateId]);
		if($gameId != '')
			$this->db->delete('game_states',['game_id'=>$gameId]);
	}
//--------------------------------------------------------//
	public function getGameState($gameStateId='',$gameId='',$stateOrder=''){
		$cols = ['state_id','game_id','state_name','shown_name','state_order','is_default'];
		$where = [];
		if($gameStateId!='')
			$where['state_id'] = $gameStateId;
		if($gameId!='')
			$where['game_id'] = $gameId;
		if($stateOrder!='')
			$where['state_order'] = $stateOrder;
		
		$orderBy = 'state_order ASC';
		$this->db->select('game_states',$cols,$where,'',$orderBy);

		return $this->db->result_array();
	}
//--------------------------------------------------------//
    public function addImgState($state_id,$file_id,$set_as_btn,$img_type){
        $data = [
            'state_id'	=>	$state_id,
            'file_id'   =>	$file_id,
            'set_as_btn'=>	$set_as_btn,
            'img_type'	=>	$img_type
        ];
        $this->db->insert('state_img',$data);
        return $this->db->id();
    }
//--------------------------------------------------------//
    public function deleteImgState($state_img_id = '',$state_id= ''){
        if($state_img_id != '')
            $this->db->delete('state_img',['state_img_id'=>$state_img_id]);
        if($state_id != '')
            $this->db->delete('state_img',['state_id'=>$state_id]);
    }
//--------------------------------------------------------//
    public function updateImgState($state_img_id,$state_id,$file_id,$set_as_btn,$img_type){//img_type= I , C
        $data = [
            'state_id'		=>	$state_id,
            'file_id'   =>	$file_id,
            'set_as_btn'	=>	$set_as_btn,
            'img_type'	=>	$img_type
        ];
        $this->db->update('state_img',$data,['state_img_id'=>$state_img_id]);
        return $this->db->id();
    }
//--------------------------------------------------------//
    public function getStateBackground($state_id){
        $cols = ['state_img_id','state_id','file_id','set_as_btn','img_type'];//img_type= I , C
        $where = [];
        $where['state_id'] = $state_id;
        $this->db->select('state_img',$cols,$where);
        return $this->db->result_array();
    }
//--------------------------------------------------------//	
}