<?php

class pixelController extends controller{

	public $gameDb;
	public $gameKeyDb;
	public $gameStateDb;
	public $userFileDB;
	public $pixelDB;
	public $eventDB;
	public $userpaintsDB;
	public function __construct(){
		parent::__construct();
		$this->gameDb = new gameDB();
		$this->gameKeyDb = new gameKeyDB();
		$this->gameStateDb = new gameStateDB();
		$this->userFileDB = new userFileDB();
		$this->pixelDB = new pixelDB();
		$this->eventDB = new eventDB();
		$this->userpaintsDB = new userPaintsDB();
	}
//------------------------------------------------------------------------------//
	public function savePixel(){
		$data = $this->request;
		$pixelId = $data['pixelId'];
		$stateId = $data['stateId'];
		$groupCode = $data['groupCode'];
        $saveEvent = true;
		$groupPixels = $this->pixelDB->getStatePixel($stateId,'','','','',$groupCode);
		if($groupPixels)
		    $saveEvent = false;
		if($pixelId!=''){
			$isDeleteContent = $data['isDeleteContent'];
			if($isDeleteContent=='T'){
				$this->pixelDB->deletePixel($pixelId);
				$this->eventDB->deleteEvent('',$groupCode);
			}else{
				$this->pixelDB->updatePixel($data,$pixelId);
				$pixelEvent = $this->eventDB->getEvents($stateId,$groupCode);
				if($pixelEvent){
					if($data['eventNameCode']!='')
						$this->eventDB->updateEvent($pixelEvent[0]['event_id'],$data,$stateId);
				}else {
				    if($saveEvent)
                        $this->eventDB->addEvent($data, $stateId);
                }
			}
		}else{
			if($data['contentType']==='LBL'){
				$content = $data['lblContent'];
				$cell = $data['cell'];
				$lblArr = str_split($content);
				for($i=0;$i<count($lblArr);$i++){
					$data['lblContent'] =  $lblArr[$i];
					$data['cell'] = $cell;
					$this->pixelDB->addPixel($data);
					$cell++;
				}
			}else
			    $this->pixelDB->addPixel($data);

			if($data['eventNameCode']!='' && $saveEvent)
				$this->eventDB->addEvent($data,$stateId);
		}

		$this->updateStatePixelOnGame($stateId);
		$this->updateStateEventsOnGame($stateId);
	}
//------------------------------------------------------------------------------//
	public function getPixelData(){
		$pixelId = $this->request['pixelId'];
		$stateId = $this->request['stateId'];
		$pixelData = $this->pixelDB->getStatePixel($stateId,'','','',$pixelId);
        $eventData = '';
        if($pixelData[0]['content_type'] != 'LBL')
		    $eventData = $this->eventDB->getEvents($stateId,$pixelData[0]['group_code']);
		if($eventData != '')
            $this->response['eventData'] = $eventData;

		$this->response['pixelData'] = $pixelData;
	}
//------------------------------------------------------------------------------//
	public function getStatePixels(){
		$userId = $_COOKIE['userId'];
		$stateId = $this->request['stateId'];
		$gameInfo = $this->gameDb->getGame($_COOKIE['gameId']);
		$gameWidth = $gameInfo[0]['game_width'];
		$gameHeight = $gameInfo[0]['game_height'];
		$statePixels = [];
		for($i = 0;$i <$gameHeight;$i++){//row , [0 -> 23]
            for($j = 0;$j <$gameWidth;$j++){//cell , [0 -> 48]
				$pixelData = $this->pixelDB->getStatePixel($stateId,$i,$j);
				if($pixelData){
					$contentType = $pixelData[0]['content_type'];
					$pixelId = $pixelData[0]['state_pixel_id'];
					if($contentType=='IMG'){
						$imgId = $pixelData[0]['content'];
	 					$imageInfo = $this->userFileDB->getUserFile($userId,$imgId);
	 					$imageName = $imageInfo[0]['file_name'];
	    				$imageExt = $imageInfo[0]['file_ext'];
	        			$imgDir = REPO_URI.'/'.$_COOKIE['username'].'/files/imgs/'.$imageName.'.'.$imageExt;
	        			$statePixels[$i][$j]['id'] = $pixelId;
	        			$statePixels[$i][$j]['type'] = 'IMG';
	        			$statePixels[$i][$j]['val'] = '<img src="'.$imgDir.'" style="width: 20px;">';
	        		}elseif($contentType=='PNT'){
        				$paintId = $pixelData[0]['content'];
        				$paintInfo = $this->userpaintsDB->getPaint('',$paintId);
        				$paintName = $paintInfo[0]['paint_name'];
        				$imgDir = REPO_URI.'/'.$_COOKIE['username'].'/files/paints/'.$paintName.'.png';
        				$statePixels[$i][$j]['id'] = $pixelId;
        				$statePixels[$i][$j]['type'] = 'PNT';
						$statePixels[$i][$j]['val'] = '<img src="'.$imgDir.'" style="width: 20px;">';
	        		}elseif($contentType=='LBL'){
	        			$textColor = $pixelData[0]['text_color'];
	        			$fontFamily = $pixelData[0]['font_family'];
	        			$statePixels[$i][$j]['id'] = $pixelId;
						$statePixels[$i][$j]['type'] = 'LBL';
						$statePixels[$i][$j]['val'] = '<span style="font:bold 22px '.$fontFamily.';color:'.$textColor.';text-align:center">'.$pixelData[0]['content'].'</span>';
	        		}
				}else{
					$statePixels[$i][$j]['id'] = '';
					$statePixels[$i][$j]['type'] = '';
					$statePixels[$i][$j]['val'] = '';
        		}
            }
		}
		$stateBackgroundInfo = $this->gameStateDb->getStateBackground($stateId);
		$imgPath = $backgroundColor = $setAsBtn = '';
		if($stateBackgroundInfo){
			$imgType = $stateBackgroundInfo[0]['img_type'];
			if($imgType=='I'){
				$imageInfo = $this->userFileDB->getUserFile('', $stateBackgroundInfo[0]['file_id']);
		        $imageName = $imageInfo[0]['file_name'];
		        $imageExt = $imageInfo[0]['file_ext'];
		        $imgPath = REPO_URI . '/' . $_COOKIE['username'] . '/files/imgs/' . $imageName . '.' . $imageExt;
		    }else{//C
		    	$backgroundColor = '#'.$stateBackgroundInfo[0]['file_id'];
		    }
		    $setAsBtn = $stateBackgroundInfo[0]['set_as_btn'];
		}
	    $this->response['imgPath'] = $imgPath;
        $this->response['setAsBtn'] = $setAsBtn;
        $this->response['backgroundColor'] = $backgroundColor;
		$this->response['gameWidth'] = $gameWidth;
		$this->response['gameHeight'] = $gameHeight;
		$this->response['statePixels'] = $statePixels;
	}
//------------------------------------------------------------------------------//
	private function updateStatePixelOnGame($stateId){
		$stateInfo = $this->gameStateDb->getGameState($stateId);
		$gameInfo = $this->gameDb->getGame($_COOKIE['gameId']);
        $gameDir = REPO.DS.$_COOKIE['username'].DS.'Games'.DS.$gameInfo[0]['game_name'].'_'.$gameInfo[0]['dimension'].'_'.$gameInfo[0]['game_ver'];
        $scriptPath = $gameDir.DS.'assets'.DS.'js'.DS.$stateInfo[0]['state_name'].'.js';
        $scriptContent = file_get_contents($scriptPath);
        //==========================================================//
		$pixelData = $this->pixelDB->getStatePixel($stateId);
		$filesLoad = "\n";
		for($i=0;$i<count($pixelData);$i++){
			$contentType = $pixelData[$i]['content_type'];
			$content = $pixelData[$i]['content'];
			if($contentType=='IMG'){
				$imageInfo = $this->userFileDB->getUserFile('', $content);
	            $imageName = $imageInfo[0]['file_name'];
	            $imageExt = $imageInfo[0]['file_ext'];
                $imgDir = REPO_URI . '/' . $_COOKIE['username'] .'/Games/'.$gameInfo[0]['game_name'].'_'.$gameInfo[0]['dimension'].'_'.$gameInfo[0]['game_ver']. '/assets/img/' . $imageName . '.' . $imageExt;
                $fileLoadContent = 'game.load.image("' . $imageName . '", "' . $imgDir . '");';
                $fileDir = REPO.DS.$_COOKIE['username'].DS.'files'.DS.'imgs'.DS.$imageName.'.'.$imageExt;
                $gameImageDir = $gameDir.DS.'assets'.DS.'img'.DS.$imageName.'.'.$imageExt;
                copy($fileDir,$gameImageDir);
			}elseif($contentType=='PNT'){
				$paintInfo = $this->userpaintsDB->getPaint('',$content);
				$paintName = $paintInfo[0]['paint_name'];
                $imgDir = REPO_URI . '/' . $_COOKIE['username'] .'/Games/'.$gameInfo[0]['game_name'].'_'.$gameInfo[0]['dimension'].'_'.$gameInfo[0]['game_ver']. '/assets/img/' . $paintInfo[0]['paint_name'] . '.png';
                $fileLoadContent = 'game.load.image("' . $paintName . '", "' . $imgDir . '");';
                $fileDir = REPO.DS.$_COOKIE['username'].DS.'files'.DS.'paints'.DS.$paintName.'.png';
                $gameImageDir = $gameDir.DS.'assets'.DS.'img'.DS.$paintName.'.png';
                copy($fileDir,$gameImageDir);
			}
			$filesLoad .= "\t".$fileLoadContent."\n";
		}
		$scriptContentArr = explode('//PAINTS', $scriptContent);
        $scriptContentArr[1] = "//PAINTS\n" . $filesLoad . "//PAINTS";
        $scriptContent = implode("", $scriptContentArr);
        //======================================================//
        $pixelsContent = "\n";
        $globalCodeVar = "";
        for($i=0;$i<count($pixelData);$i++){
			$contentType = $pixelData[$i]['content_type'];
			$content = $pixelData[$i]['content'];
			$textColor = $pixelData[$i]['text_color'];
			$fontFamily = $pixelData[$i]['font_family'];
			$row = $pixelData[$i]['row'] * 20;
			$cell = $pixelData[$i]['cell'] * 20;
			if($contentType=='IMG'){
				$imageInfo = $this->userFileDB->getUserFile('', $content);
	            $imageName = $imageInfo[0]['file_name'];
	            $spriteName = $imageName.'Sprite_'.$row.$cell;
                $globalCodeVar .= "var ".$spriteName.";\n";
	            $pixel = ' '.$spriteName.' = game.add.sprite('.$cell.','.$row.',"' . $imageName . '");';
	            $pixel .= "\n\t";
	            $pixel .= $spriteName.'.scale.setTo(0.3125, 0.3125);';
			}elseif($contentType=='PNT'){
				$paintInfo = $this->userpaintsDB->getPaint('',$content);
				$paintName = $paintInfo[0]['paint_name'];
				$spriteName = $paintName.'Sprite_'.$row.$cell;
                $globalCodeVar .= "var ".$spriteName.";\n";
				$pixel = ' '.$spriteName.' = game.add.sprite('.$cell.','.$row.',"' . $paintName . '");';
	            $pixel .= "\n\t";
	            $pixel .= $spriteName.'.scale.setTo(0.3125, 0.3125);';
			}else{//LBL
				$pixel = 'textStyle_Key = {font: "bold 25px '.$fontFamily.'",fill: "'.$textColor.'",align: "center"};';
				$pixel .= "\n\t";
        		$pixel .= 'textStyle_Value = {font:"bold 25px '.$fontFamily.'",fill: "'.$textColor.'",align: "center" };';
        		$pixel .= "\n\t";
                $globalCodeVar .= "var textValue_".$row.$cell.";\n";
				$pixel .= 'textValue_'.$row.$cell.' = game.add.text('.$cell.','.$row.',"'.$content.'",textStyle_Key);';
			}
			$pixelsContent .= "\t".$pixel."\n";
		}
        //======================================================//
        $scriptContentArr = explode('//GLOBAL_MOVING_GROUP_CODE', $scriptContent);
        $scriptContentArr[1] .= "//GLOBAL_MOVING_GROUP_CODE\n" . $globalCodeVar . "//GLOBAL_MOVING_GROUP_CODE";
        $scriptContent = implode("", $scriptContentArr);

        $scriptContentArr = explode('//PIXELS', $scriptContent);
        $scriptContentArr[1] = "//PIXELS\n" . $pixelsContent . "//PIXELS";
        $scriptContent = implode("", $scriptContentArr);
        //======================================================//
        $infoFile = fopen($scriptPath, "w");
        fwrite($infoFile, $scriptContent);
        fclose($infoFile);
        //======================================================//
	}
//------------------------------------------------------------------------------//
	public function updateStateEventsOnGame($stateId){
		$stateInfo = $this->gameStateDb->getGameState($stateId);
		$gameInfo = $this->gameDb->getGame($_COOKIE['gameId']);
		$gameWidth = $gameInfo[0]['game_width'];
		$gameHeight = $gameInfo[0]['game_height'];
        $gameDir = REPO.DS.$_COOKIE['username'].DS.'Games'.DS.$gameInfo[0]['game_name'].'_'.$gameInfo[0]['dimension'].'_'.$gameInfo[0]['game_ver'];
        $scriptPath = $gameDir.DS.'assets'.DS.'js'.DS.$stateInfo[0]['state_name'].'.js';
        $scriptContent = file_get_contents($scriptPath);
        //==========================================================//
		$eventData = $this->eventDB->getEvents($stateId);
		//==========================================================//
		$eventsFunctions = "\n";
		$eventsCalls = "\n";
		$eventsUpdateCalls = "\n";
        $globalCodeVar = "";
		for($i=0;$i<count($eventData);$i++){
			$eventCode = $eventData[$i]['event_code'];
            $groupCode = $eventData[$i]['group_code'];
			$pixelData = $this->pixelDB->getStatePixel($stateId,'','','','',$groupCode);
			$row = $pixelData[0]['row'] * 20;
			$cell = $pixelData[0]['cell'] * 20;
			if($pixelData[0]['content_type']==='IMG'){
				$imageInfo = $this->userFileDB->getUserFile('', $pixelData[0]['content']);
	            $imgName = $imageInfo[0]['file_name'];
	            $cloneName = $imgName;
	            $spriteName = $imgName.'Sprite_'.$row.$cell;
			}elseif($pixelData[0]['content_type']=='PNT'){
				$paintInfo = $this->userpaintsDB->getPaint('',$pixelData[0]['content']);
				$imgName = $paintInfo[0]['paint_name'];
                $cloneName = $imgName;
				$spriteName = $imgName.'Sprite_'.$row.$cell;
			}
            $eventFilePath = '';
            $eventBody = '';
			if($eventCode != 'FXD_PSN' && $eventCode != 'FXD_PSN_DSTR') {
                $eventFilePath = GM_FILES . DS . $eventCode . '.js';
                $eventBody = file_get_contents($eventFilePath);
            }
            $eventss = $this->eventDB->getEvents($stateId,'','RNDM_PSN');
            $string = '';
            if(!empty($eventss) && ($eventCode==='MOVING_COLLISION' || $eventCode==='MOVING_COLLISION_VAR'))
                $string = 'var moveRandomly = true;';
			elseif(empty($eventss) && ($eventCode==='MOVING_COLLISION' || $eventCode==='MOVING_COLLISION_VAR'))
                $string = 'var moveRandomly = false;';
            $eventBody = str_replace('//DEF_RAND', $string, $eventBody);
			if($eventCode==='RNDM_PSN'){
				$excPixel_XY = $this->getExcPixel_XY($stateId,$groupCode);
				$eventFuncName = 'randomPosition_'.$row.$cell;
				$eventBody = str_replace('RANDOM_POSITION',$eventFuncName , $eventBody);
				$eventBody = str_replace('GAME_WIDTH', $gameWidth, $eventBody);
				$eventBody = str_replace('GAME_HIEGHT', $gameHeight, $eventBody);
				$eventBody = str_replace('PIXEL_SPRITE_NAME', $imgName, $eventBody);
				$eventBody = str_replace('PIXEL_SPRITE_VAR', $spriteName, $eventBody);
				$eventBody = str_replace('//PIXEL_ARR', $excPixel_XY, $eventBody);

				$eventsFunctions .= $eventBody."\n";
				$eventsCalls .= $spriteName.".destroy();\n".$eventFuncName."();\n";
			}elseif($eventCode==='MOVING'){
			    $groupCode = $pixelData[0]['group_code'];
                $objectToMoveGroup = 'objectToMove_'.$groupCode;
			    $gameKeyArrStr = $this->getGameKeysArr();
                $pixelsArrStr = $this->getGroupPixels($stateId,$groupCode,$objectToMoveGroup);
                $eventFuncName = 'moving_'.$row.$cell;
                $eventBody = str_replace('MOVING',$eventFuncName , $eventBody);
                $eventBody = str_replace('//GAME_KEYS',$gameKeyArrStr , $eventBody);
                $eventBody = str_replace('OBJECT_TO_MOVE_GROUP',$objectToMoveGroup , $eventBody);

                $fxdPsnData = $this->eventDB->getEvents($stateId,'','FXD_PSN');
                if($fxdPsnData != '') {
                    $fxdPsnDataStr = $this->getGroupPixels($stateId, $fxdPsnData[0]['group_code'], 'FIXED_OBJECT_CNT_DSTR');
                    $eventBody = str_replace('//DEF_FIXED_OBJECT_CNT_DSTR', $fxdPsnDataStr, $eventBody);
                }


                $eventsFunctions .= $eventBody."\n";
                $eventsUpdateCalls .= $eventFuncName."();\n";
                $eventsCalls .= $pixelsArrStr."\n";
			}elseif($eventCode==='MOVING_COLLISION'){
                $collisiedPixelId = $eventData[$i]['collisied_pixel_id'];
                $collisiedPixelData = $this->pixelDB->getStatePixel($stateId,'','','',$collisiedPixelId);
                $rowC = $collisiedPixelData[0]['row'] * 20;
                $cellC = $collisiedPixelData[0]['cell'] * 20;
                if($collisiedPixelData[0]['content_type']==='IMG'){
                    $imageInfo = $this->userFileDB->getUserFile('', $collisiedPixelData[0]['content']);
                    $imgName = $imageInfo[0]['file_name'];
                    $spriteName = $imgName.'Sprite_'.$rowC.$cellC;
                }elseif($collisiedPixelData[0]['content_type']=='PNT'){
                    $paintInfo = $this->userpaintsDB->getPaint('',$collisiedPixelData[0]['content']);
                    $imgName = $paintInfo[0]['paint_name'];
                    $spriteName = $imgName.'Sprite_'.$rowC.$cellC;
                }
                $globalCodeVar .= "var ".$spriteName.";\n";
                $groupCode = $pixelData[0]['group_code'];
                $objectToMoveGroup = 'objectToMove_'.$groupCode;
                $gameKeyArrStr = $this->getGameKeysArr();
                $pixelsArrStr = $this->getGroupPixels($stateId,$groupCode,$objectToMoveGroup);
                $eventFuncName = 'moving_'.$row.$cell;
                $eventBody = str_replace('MOVING',$eventFuncName , $eventBody);

                $eventFuncName1 = 'randomPosition_'.$rowC.$cellC;
                $eventBody = str_replace('RANDOM_POSITION',$eventFuncName1 , $eventBody);

                $eventBody = str_replace('//GAME_KEYS',$gameKeyArrStr , $eventBody);
                $eventBody = str_replace('OBJECT_TO_MOVE_GROUP',$objectToMoveGroup , $eventBody);
                $eventBody = str_replace('OBJECT_TO_MOVE_CLONE',$cloneName , $eventBody);
                $eventBody = str_replace('COLLISIED_PIXEL',$spriteName , $eventBody);
                $eventBody = str_replace('GAME_WIDTH', $gameWidth, $eventBody);
                $eventBody = str_replace('GAME_HIEGHT', $gameHeight, $eventBody);


                $fxdPsnData = $this->eventDB->getEvents($stateId,'','FXD_PSN');
                if($fxdPsnData != '') {
                    $fxdPsnDataStr = $this->getGroupPixels($stateId, $fxdPsnData[0]['group_code'], 'FIXED_OBJECT_CNT_DSTR');
                    $eventBody = str_replace('//DEF_FIXED_OBJECT_CNT_DSTR', $fxdPsnDataStr, $eventBody);
                }

                $fxdPsnData = $this->eventDB->getEvents($stateId,'','FXD_PSN_DSTR');
                if($fxdPsnData != '') {
                    $fxdPsnDataStr = $this->getGroupPixels($stateId, $fxdPsnData[0]['group_code'], 'FIXED_OBJECT_CN_DSTR');
                    $eventBody = str_replace('//DEF_FIXED_OBJECT_CN_DSTR', $fxdPsnDataStr, $eventBody);
                }

                $eventsFunctions .= $eventBody."\n";
                $eventsUpdateCalls .= $eventFuncName."();\n";
                $eventsCalls .= $pixelsArrStr."\n";
            }elseif($eventCode==='MOVING_COLLISION_VAR'){//VAR_NAME , RESULT_PIXEL
                $collisiedPixelId = $eventData[$i]['collisied_pixel_id'];
                $collisiedPixelData = $this->pixelDB->getStatePixel($stateId,'','','',$collisiedPixelId);
                $rowC = $collisiedPixelData[0]['row'] * 20;
                $cellC = $collisiedPixelData[0]['cell'] * 20;
                if($collisiedPixelData[0]['content_type']==='IMG'){
                    $imageInfo = $this->userFileDB->getUserFile('', $collisiedPixelData[0]['content']);
                    $imgName = $imageInfo[0]['file_name'];
                    $spriteName = $imgName.'Sprite_'.$rowC.$cellC;
                }elseif($collisiedPixelData[0]['content_type']=='PNT'){
                    $paintInfo = $this->userpaintsDB->getPaint('',$collisiedPixelData[0]['content']);
                    $imgName = $paintInfo[0]['paint_name'];
                    $spriteName = $imgName.'Sprite_'.$rowC.$cellC;
                }
                $globalCodeVar .= "var ".$spriteName.";\n";
                //==========================================================//
                $resultPixelId = $eventData[$i]['result_pixel'];
                $resultPixelData = $this->pixelDB->getStatePixel($stateId,'','','',$resultPixelId);
                $rowR = $resultPixelData[0]['row'] * 20;
                $cellR = $resultPixelData[0]['cell'] * 20;
                $resultPixelName = 'textValue_'.$rowR.$cellR;
                //===========================================================//
                $groupCode = $pixelData[0]['group_code'];
                $objectToMoveGroup = 'objectToMove_'.$groupCode;
                $gameKeyArrStr = $this->getGameKeysArr();
                $pixelsArrStr = $this->getGroupPixels($stateId,$groupCode,$objectToMoveGroup);
                $eventFuncName = 'moving_'.$row.$cell;
                $eventBody = str_replace('MOVING',$eventFuncName , $eventBody);

                $eventFuncName1 = 'randomPosition_'.$rowC.$cellC;
                $eventBody = str_replace('RANDOM_POSITION',$eventFuncName1 , $eventBody);
                $eventBody = str_replace('//GAME_KEYS',$gameKeyArrStr , $eventBody);
                $eventBody = str_replace('OBJECT_TO_MOVE_GROUP',$objectToMoveGroup , $eventBody);
                $eventBody = str_replace('OBJECT_TO_MOVE_CLONE',$cloneName , $eventBody);
                $eventBody = str_replace('COLLISIED_PIXEL',$spriteName , $eventBody);
                $eventBody = str_replace('GAME_WIDTH', $gameWidth, $eventBody);
                $eventBody = str_replace('GAME_HIEGHT', $gameHeight, $eventBody);

                $eventBody = str_replace('RESULT_PIXEL', $resultPixelName, $eventBody);


                $fxdPsnData = $this->eventDB->getEvents($stateId,'','FXD_PSN');
                if($fxdPsnData != '') {
                    $fxdPsnDataStr = $this->getGroupPixels($stateId, $fxdPsnData[0]['group_code'], 'FIXED_OBJECT_CNT_DSTR');
                    $eventBody = str_replace('//DEF_FIXED_OBJECT_CNT_DSTR', $fxdPsnDataStr, $eventBody);
                }

                $fxdPsnData = $this->eventDB->getEvents($stateId,'','FXD_PSN_DSTR');
                if($fxdPsnData != '') {
                    $fxdPsnDataStr = $this->getGroupPixels($stateId, $fxdPsnData[0]['group_code'], 'FIXED_OBJECT_CN_DSTR');
                    $eventBody = str_replace('//DEF_FIXED_OBJECT_CN_DSTR', $fxdPsnDataStr, $eventBody);
                }

                $eventsFunctions .= $eventBody."\n";
                $eventsUpdateCalls .= $eventFuncName."();\n";
                $eventsCalls .= $pixelsArrStr."\n";
			}
		}
        $globalCodeVar .= $this->getGlobalGroupCodeVars($stateId);
		//==========================================================//
        $scriptContentArr = explode('//GLOBAL_MOVING_GROUP_CODE', $scriptContent);
        $scriptContentArr[1] = "//GLOBAL_MOVING_GROUP_CODE\n" . $globalCodeVar . "//GLOBAL_MOVING_GROUP_CODE";
        $scriptContent = implode("", $scriptContentArr);

		$scriptContentArr = explode('//F_CALL_EVENTS', $scriptContent);
        $scriptContentArr[1] = "//F_CALL_EVENTS\n" . $eventsCalls . "//F_CALL_EVENTS";
        $scriptContent = implode("", $scriptContentArr);

        $scriptContentArr = explode('//F_CALL_UPDATE_FUNC', $scriptContent);
        $scriptContentArr[1] = "//F_CALL_UPDATE_FUNC\n" . $eventsUpdateCalls . "//F_CALL_UPDATE_FUNC";
        $scriptContent = implode("", $scriptContentArr);

        $scriptContentArr = explode('//EVENTS_FUNCTIONS', $scriptContent);
        $scriptContentArr[1] = "//EVENTS_FUNCTIONS\n" . $eventsFunctions . "//EVENTS_FUNCTIONS";
        $scriptContent = implode("", $scriptContentArr);

        $infoFile = fopen($scriptPath, "w");
        fwrite($infoFile, $scriptContent);
        fclose($infoFile);
        //==========================================================//
	}
//------------------------------------------------------------------------------//
    private function getGlobalGroupCodeVars($stateId){
        $globalCodeVar = "\n";
        $pixelsGroupCodeArr = [];
        $pixelData = $this->pixelDB->getStatePixel($stateId);
        for($i=0;$i<count($pixelData);$i++){
            if($pixelData[$i]['group_code']){
                if(!in_array($pixelData[$i]['group_code'],$pixelsGroupCodeArr))
                    array_push($pixelsGroupCodeArr,$pixelData[$i]['group_code']);
            }
        }
        for($i=0;$i<count($pixelsGroupCodeArr);$i++)
            $globalCodeVar .= "var objectToMove_".$pixelsGroupCodeArr[$i].";\n";

        return $globalCodeVar;
    }
//------------------------------------------------------------------------------//
    public function getPixels(){
        $stateId = $this->request['stateId'];
        $groupCode = $this->request['groupCode'];
        $exceptPxlSameGC = $this->request['exceptPxlSameGC'];
        $withHtml = $this->request['withHtml'];
        $pixelType = $this->request['pixelType'];
        if($pixelType=='CLD') {
            $pixelsData = $this->pixelDB->getStatePixel($stateId, '', '', '', '', '', true);
            if ($exceptPxlSameGC == 'T')
                foreach ($pixelsData as $key => $pixel)
                    if ($pixel['group_code'] == $groupCode || $pixel['content_type'] == 'LBL')
                        unset($pixelsData[$key]);

            $pixelsData = array_values($pixelsData);
            if($withHtml == 'T') {
                $selectHtml = '<option value=""></option>';
                for ($i = 0; $i < count($pixelsData); $i++)
                    $selectHtml .= '<option value="' . $pixelsData[$i]['state_pixel_id'] . '">' . $pixelsData[$i]['group_code'] . '</option>';
            }
        }elseif($pixelType=='RLT'){
            $pixelsData = $this->pixelDB->getStatePixel($stateId, '', '', 'LBL', '', '', true);
            $pixelsData = array_values($pixelsData);
            if($withHtml == 'T') {
                $selectHtml = '<option value=""></option>';
                for ($i = 0; $i < count($pixelsData); $i++)
                    $selectHtml .= '<option value="' . $pixelsData[$i]['state_pixel_id'] . '">' . $pixelsData[$i]['content'] . '</option>';
            }
        }


        $this->response['pixelsData'] = $pixelsData;
        $this->response['pixelsHtml'] = $selectHtml;
    }
//------------------------------------------------------------------------------//
    private function getGroupPixels($stateId,$groupCode,$objectToMoveGroup){
	    if($groupCode != '')
	        $pixelsData = $this->pixelDB->getStatePixel($stateId,'','','','',$groupCode,true);
	    $pixelsArrStr = $objectToMoveGroup.' = [';
	    for($i=0;$i<count($pixelsData);$i++){
            $contentType = $pixelsData[$i]['content_type'];
            $content = $pixelsData[$i]['content'];
            $row = $pixelsData[$i]['row'] * 20;
            $cell = $pixelsData[$i]['cell'] * 20;
            if($contentType=='IMG'){
                $imageInfo = $this->userFileDB->getUserFile('', $content);
                $imageName = $imageInfo[0]['file_name'];
                $spriteName = $imageName.'Sprite_'.$row.$cell;
            }elseif($contentType=='PNT'){
                $paintInfo = $this->userpaintsDB->getPaint('',$content);
                $paintName = $paintInfo[0]['paint_name'];
                $spriteName = $paintName.'Sprite_'.$row.$cell;
            }
            $pixelsArrStr .= $spriteName;
            if(($i+1)!=count($pixelsData))
                $pixelsArrStr .= ',';
        }
        $pixelsArrStr .= '];';
	    return $pixelsArrStr;
    }
//------------------------------------------------------------------------------//
    private function getGameKeysArr(){
        $gameKeyArr = $this->gameKeyDb->getGameKeys($_COOKIE['gameId']);
        $gameKeyArrStr = 'var keys = {';
        for($i=0;$i<count($gameKeyArr);$i++){
            $keyName = $gameKeyArr[$i]['key_name'];
            $active = $gameKeyArr[$i]['active'];
            $gameKeyArrStr .= $keyName.":'".$active."'";
            if(($i+1)!=count($gameKeyArr))
                $gameKeyArrStr .= ',';
        }
        $gameKeyArrStr .= '};';
        return $gameKeyArrStr;
    }
//------------------------------------------------------------------------------//
	private function getExcPixel_XY($stateId,$groupCode){
		$pixelData = $this->pixelDB->getStatePixel($stateId);
		$excPixel = $this->pixelDB->getStatePixel($stateId,'','','','',$groupCode);
		$pixelArrStr = 'var pixelArr = [';
		for($i=0;$i<count($pixelData);$i++){
			if($pixelData[$i]['state_pixel_id']!=$excPixel[0]['state_pixel_id']){
				$x = $pixelData[$i]['cell'] * 20;
				$y = $pixelData[$i]['row'] * 20;
				$pixelArrStr .= '['.$x.','.$y.']';
				if(($i+1)!=count($pixelData))
					$pixelArrStr .= ',';
			}
		}
		$pixelArrStr .= '];';
		return $pixelArrStr;
	}
//------------------------------------------------------------------------------//
}