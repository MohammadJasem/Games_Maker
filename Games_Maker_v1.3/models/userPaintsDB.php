<?php

class userPaintsDB extends model{
//--------------------------------------------------------//

    public function __construct(){
        parent::__construct();
    }
//--------------------------------------------------------//
    public function addPaint($dataToSave){
        $data = [
            'user_id'		=>	$dataToSave['userId'],
            'paint_name'	=>	$dataToSave['paintName'],
            'paint_colors'	=>	$dataToSave['paintColors'],
        ];
        $this->db->insert('user_paints',$data);
        return $this->db->id();
    }
//--------------------------------------------------------//
    public function updatePaint($paintId,$paintName,$paintColors){
        $data = [
            'paint_name'	=>	$paintName,
            'paint_colors'	=>	$paintColors,
        ];
        $this->db->update('user_paints',$data,['paint_id'=>$paintId]);
        return $this->db->id();
    }
//--------------------------------------------------------//
    public function getPaint($userId='',$paintId=''){
        $cols = ['paint_id','user_id','paint_name','paint_colors'];
        $where = [];
        if($userId!='')
            $where['user_id'] = $userId;
        if($paintId!='')
            $where['paint_id'] = $paintId;

        $this->db->select('user_paints',$cols,$where);

        return $this->db->result_array();
    }
//--------------------------------------------------------//
    public function deletePaint($userId='',$paintId=''){
        if($userId != '')
            $this->db->delete('user_paints',['user_id'=>$userId]);
        if($paintId != '')
            $this->db->delete('user_paints',['paint_id'=>$paintId]);
    }
//--------------------------------------------------------//
}