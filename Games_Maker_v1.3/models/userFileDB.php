<?php

class userFileDB extends model{
//--------------------------------------------------------//

    public function __construct(){
        parent::__construct();
    }
//--------------------------------------------------------//
    public function addUserFile($userId,$fileName,$fileExt,$fileType){
        $data = [
            'user_id'		=>	$userId,
            'file_name'		=>	$fileName,
            'file_ext'		=>	$fileExt,
            'file_type'		=>	$fileType,
        ];
        $this->db->insert('user_files',$data);
        return $this->db->id();
    }
//--------------------------------------------------------//
    public function getUserFile($userId,$fileId='',$fileType=''){
        $cols = ['file_id','file_name','file_ext','file_type'];
        $where = [];
        if($userId!='')
            $where['user_id'] = $userId;
        if($fileId!='')
            $where['file_id'] = $fileId;
        if($fileType!='')
            $where['file_type'] = $fileType;


        $this->db->select('user_files',$cols,$where);

        return $this->db->result_array();
    }
//--------------------------------------------------------//
}