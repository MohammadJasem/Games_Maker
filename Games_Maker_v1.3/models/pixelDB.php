<?php

class pixelDB extends model{
//--------------------------------------------------------//

	public function __construct(){
		parent::__construct();
	}
//--------------------------------------------------------//
	public function addPixel($dataToSave){
		$data = [
			'state_id'			=>	$dataToSave['stateId'],
			'row'				=>	$dataToSave['row'],
			'cell'				=>	$dataToSave['cell'],
			'group_code'		=>	$dataToSave['groupCode'],
			'content_type'		=>	$dataToSave['contentType'],
			'text_color'		=>	$dataToSave['textColor'],
			'font_family'		=>	$dataToSave['fontFamily'],
		];
		if($dataToSave['contentType']=='IMG')
			$data['content'] = $dataToSave['imgContent'];
		elseif($dataToSave['contentType']=='PNT')
			$data['content'] = $dataToSave['pntContent'];
		else//LBL
			$data['content'] = $dataToSave['lblContent'];

		$this->db->insert('state_pixel',$data);
		return $this->db->id();
	}
//--------------------------------------------------------//
	public function updatePixel($dataToSave,$pixelId){
		$data = [
			'state_id'			=>	$dataToSave['stateId'],
			'row'				=>	$dataToSave['row'],
			'cell'				=>	$dataToSave['cell'],
			'group_code'		=>	$dataToSave['groupCode'],
			'content_type'		=>	$dataToSave['contentType'],
			'text_color'		=>	$dataToSave['textColor'],
			'font_family'		=>	$dataToSave['fontFamily'],
		];
		if($dataToSave['contentType']=='IMG')
			$data['content'] = $dataToSave['imgContent'];
		elseif($dataToSave['contentType']=='PNT')
			$data['content'] = $dataToSave['pntContent'];
		else//LBL
			$data['content'] = $dataToSave['lblContent'];
			
		$this->db->update('state_pixel',$data,['state_pixel_id'=>$pixelId]);
		return $this->db->id();
	}
//--------------------------------------------------------//
	public function deletePixel($statePixelId = '',$stateId = ''){
	    if($statePixelId != '')
		    $this->db->delete('state_pixel',['state_pixel_id'=>$statePixelId]);
	    if($stateId != '')
		    $this->db->delete('state_pixel',['state_id'=>$stateId]);
	}
//--------------------------------------------------------//
	public function getStatePixel($stateId,$row='',$cell='',$contentType='',$statePixelId='',$groupCode='',$orderByRow=false,$exceptpixelId=''){//contentType = IMG , LBL
		$cols = ['state_pixel_id','state_id','row','cell','group_code','content_type','content','text_color','font_family'];
		$where = [];
		if($stateId!=='')
			$where['state_id'] = $stateId;
		if($row!=='')
			$where['row'] = $row;
		if($cell!=='')
			$where['cell'] = $cell;
		if($contentType!=='')
			$where['content_type'] = $contentType;
		if($statePixelId!=='')
			$where['state_pixel_id'] = $statePixelId;
		if($groupCode!=='')
			$where['group_code'] = $groupCode;
		if($exceptpixelId!=='')
			$where['group_code'] = $exceptpixelId;

        $orderBy = '';
		if($orderByRow)
            $orderBy = 'row DESC';

		$this->db->select('state_pixel',$cols,$where,'',$orderBy);

		return $this->db->result_array();
	}
//--------------------------------------------------------//
}