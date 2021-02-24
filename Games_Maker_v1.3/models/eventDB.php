<?php

class eventDB extends model{
//--------------------------------------------------------//
	public function __construct(){
		parent::__construct();
	}
//--------------------------------------------------------//
	public function addEvent($dataToSave,$stateId){
		$data = [
			'state_id'			=>	$stateId,
            'group_code'		=>	$dataToSave['groupCode'],
			'event_code'		=>	$dataToSave['eventNameCode'],
		];
		if(isset($dataToSave['collisiedPixelCode']))
		    $data['collisied_pixel_id'] = $dataToSave['collisiedPixelCode'];
        if(isset($dataToSave['resultPixelCode']))
            $data['result_pixel'] = $dataToSave['resultPixelCode'];

		$this->db->insert('event',$data);
		return $this->db->id();
	}
//--------------------------------------------------------//
	public function updateEvent($eventId,$dataToSave,$stateId){
		$data = [
			'state_id'			=>	$stateId,
			'group_code'		=>	$dataToSave['groupCode'],
			'event_code'		=>	$dataToSave['eventNameCode'],
		];
        if(isset($dataToSave['collisiedPixelCode']))
            $data['collisied_pixel_id'] = $dataToSave['collisiedPixelCode'];
        if(isset($dataToSave['resultPixelCode']))
            $data['result_pixel'] = $dataToSave['resultPixelCode'];

		$this->db->update('event',$data,['event_id'=>$eventId]);
		return $this->db->id();
	}
//--------------------------------------------------------//
	public function getEvents($stateId,$group_code='',$event_code=''){
		$cols = ['event_id','state_id','group_code','event_code','collisied_pixel_id','result_pixel'];
		$where = [];
		if($stateId!=='')
			$where['state_id'] = $stateId;
		if($group_code!=='')
			$where['group_code'] = $group_code;
		if($event_code!=='')
			$where['event_code'] = $event_code;
		
		$this->db->select('event',$cols,$where);

		return $this->db->result_array();
	}
//--------------------------------------------------------//
	public function deleteEvent($stateId,$groupCode=''){
		$where = [];
		if($stateId!=='')
			$where['state_id'] = $stateId;
		if($groupCode!=='')
			$where['group_code'] = $groupCode;
		$this->db->delete('event',$where);
	}
//--------------------------------------------------------//
}