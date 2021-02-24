<?php

class gameStateController extends controller{
//--------------------------------------------------------------//
	public $gameDb;
	public $gameStateDb;
	public $userFileDB;
	public function __construct(){
		parent::__construct();
		$this->gameDb = new gameDB();
		$this->gameStateDb = new gameStateDB();
		$this->userFileDB = new userFileDB();
	}
//--------------------------------------------------------------//
    public function saveGameStates(){
        $gameId = $_COOKIE['gameId'];
        $data = $this->request;
        $stateIds = $data['state_id'];
        $stateNames = $data['state_name'];
        $stateOrders = $data['state_order'];
        $isDefaults = $data['is_default'];
        for($i=1;$i<count($stateNames);$i++){
            if($stateIds[$i]!=''){
                $this->gameStateDb->updateGameState($stateNames[$i],$stateOrders[$i],$stateIds[$i],$gameId,$isDefaults[$i]);
                $this->updateGameStatesLinks($gameId);
            }else{
                //==========================================//
                $gamesDir = REPO.DS.$_COOKIE['username'].DS.'Games';
                $gameInfo = $this->gameDb->getGame($gameId);
                $gameDir = $gamesDir.DS.$gameInfo[0]['game_name'].'_'.$gameInfo[0]['dimension'].'_'.$gameInfo[0]['game_ver'];
                $newGmStatePath = $gameDir.DS.'assets'.DS.'js'.DS.$stateNames[$i].'.js';
                $gmStatePath = GM_FILES.DS.'game_state.js';
                copy($gmStatePath,$newGmStatePath);
                //==========================================//
                $content = file_get_contents($newGmStatePath);
                $content = str_replace('GAME_STATE_NAME' , $stateNames[$i] , $content);
                $infoFile = fopen($newGmStatePath, "w");
                fwrite($infoFile, $content);
                fclose($infoFile);
                //==========================================//
                $this->gameStateDb->addGameState($stateNames[$i],$stateOrders[$i],$gameId,$isDefaults[$i]);
                //==========================================//
                $this->updateGameStatesLinks($gameId);
                //==========================================//
            }
        }
    }
//--------------------------------------------------------------//
    public function getGameStates(){
        $gameId = $_COOKIE['gameId'];
        $gameStates = $this->gameStateDb->getGameState('',$gameId);
        $this->response['gameStates'] = $gameStates;
    }
//--------------------------------------------------------------//
    private function updateGameStatesLinks($gameId){
        $gameStates = $this->gameStateDb->getGameState('',$gameId);
        //================================================//
        $gamesDir = REPO.DS.$_COOKIE['username'].DS.'Games';
        $gameInfo = $this->gameDb->getGame($gameId);
        $gameDir = $gamesDir.DS.$gameInfo[0]['game_name'].'_'.$gameInfo[0]['dimension'].'_'.$gameInfo[0]['game_ver'];
        $jsDir = $gameDir.DS.'assets'.DS.'js';
        $mainScriptPath = $jsDir.DS.'main.js';
        $mainScriptContent = file_get_contents($mainScriptPath);
        $mainScriptContentArr = explode('//GAME_STATES_ADD', $mainScriptContent);
        $mainScriptContentArr[1] = "//GAME_STATES_ADD\n";
        //===============================================//
        $indexPath = $gameDir.DS.'index.html';
        $indexContent = file_get_contents($indexPath);
        $indexContentArr = explode('<!--GAME_STATE_SCRIPTS-->', $indexContent);
        $indexContentArr[1] = "<!--GAME_STATE_SCRIPTS-->\n";
        //===============================================//
        for($i=0;$i<count($gameStates);$i++){
            $stateName = $gameStates[$i]['state_name'];
            $mainScriptContentArr[1] .= "game.state.add('".$stateName."', ".$stateName.");\n";

            $indexContentArr[1] .= "<script type='text/javascript' src='assets/js/".$stateName.".js'></script>\n";
        }
        //================================================//
        $mainScriptContentArr[1] .= "//GAME_STATES_ADD";
        $mainScriptContent = implode("", $mainScriptContentArr);
        $infoFile = fopen($mainScriptPath, "w");
        fwrite($infoFile, $mainScriptContent);
        fclose($infoFile);
        //===============================================//
        $indexContentArr[1] .= "<!--GAME_STATE_SCRIPTS-->";
        $indexContent = implode("", $indexContentArr);
        $infoFile = fopen($indexPath, "w");
        fwrite($infoFile, $indexContent);
        fclose($infoFile);
        //===============================================//
    }
//--------------------------------------------------------------//
    public function deleteGameState(){
        $gameId = $_COOKIE['gameId'];
        $stateId = $this->request['stateId'];
        $gameState = $this->gameStateDb->getGameState($stateId);
        $gamesDir = REPO.DS.$_COOKIE['username'].DS.'Games';
        $gameInfo = $this->gameDb->getGame($gameId);
        $gameDir = $gamesDir.DS.$gameInfo[0]['game_name'].'_'.$gameInfo[0]['dimension'].'_'.$gameInfo[0]['game_ver'];
        //=========================================//
        $stateFilePath = $gameDir.DS.'assets'.DS.'js'.DS.$gameState[0]['state_name'].'.js';
        unlink($stateFilePath);
        //==========================================//
        $this->gameStateDb->deleteGameState($stateId);
        $this->updateGameStatesLinks($gameId);
    }
//--------------------------------------------------------------//
	public function setStateBackground(){
        $userId = $_COOKIE['userId'];
        $gameId = $_COOKIE['gameId'];
		$imageId = $this->request['imgId'];
        $setAsbtn = $this->request['setAsbtn'];
        $stateId = $this->request['stateId'];
        $img_type = $this->request['imgType'];
        $imgStateId = $this->request['img_state_id'];
		$stateInfo = $this->gameStateDb->getGameState($stateId);
		if($img_type == 'C') {
            $colorArr = explode('#', $imageId);
            $imageId = $colorArr[1];
        }
		if($imgStateId != '')
		    $this->gameStateDb->updateImgState($imgStateId,$stateId,$imageId,$setAsbtn,$img_type);
        else
            $this->gameStateDb->addImgState($stateId,$imageId,$setAsbtn,$img_type);
        $gameInfo = $this->gameDb->getGame($_COOKIE['gameId']);
        $gameDir = REPO.DS.$_COOKIE['username'].DS.'Games'.DS.$gameInfo[0]['game_name'].'_'.$gameInfo[0]['dimension'].'_'.$gameInfo[0]['game_ver'];
        $scriptPath = $gameDir.DS.'assets'.DS.'js'.DS.$stateInfo[0]['state_name'].'.js';
        $scriptContent = file_get_contents($scriptPath);
        if($img_type == 'I') {
            $imageInfo = $this->userFileDB->getUserFile($userId, $imageId);
            $imageName = $imageInfo[0]['file_name'];
            $imageExt = $imageInfo[0]['file_ext'];
            $imgDir = REPO_URI . '/' . $_COOKIE['username'] .'/Games/'.$gameInfo[0]['game_name'].'_'.$gameInfo[0]['dimension'].'_'.$gameInfo[0]['game_ver']. '/assets/img/' . $imageName . '.' . $imageExt;
            //======================================================//
            $fileLoadContent = 'game.load.image("' . $imageName . '", "' . $imgDir . '");';
            $scriptContentArr = explode('//BCKGRND', $scriptContent);
            $scriptContentArr[1] = "//BCKGRND\n\t" . $fileLoadContent . "\n//BCKGRND";
            $scriptContent = implode("", $scriptContentArr);
            //======================================================//
            if ($setAsbtn == 'F') {
                $fileLoadContent = "this.add.sprite(0,0,'" . $imageName . "');";
                $scriptContentArr = explode('//STBCKGRND', $scriptContent);
                $scriptContentArr[1] = "//STBCKGRND\n\t" . $fileLoadContent . "\n//STBCKGRND";
                $scriptContent = implode("", $scriptContentArr);
            } else {
                $fileLoadContent = "this.add.button(game.world.centerX, game.world.centerY, '" . $imageName . "', this.nextState, this).anchor.set(0.5);";
                $scriptContentArr = explode('//STBCKGRND', $scriptContent);
                $scriptContentArr[1] = "//STBCKGRND\n\t" . $fileLoadContent . "\n//STBCKGRND";
                $scriptContent = implode("", $scriptContentArr);
            }
            $fileDir = REPO.DS.$_COOKIE['username'].DS.'files'.DS.'imgs'.DS.$imageName.'.'.$imageExt;
            $gameImageDir = $gameDir.DS.'assets'.DS.'img'.DS.$imageName.'.'.$imageExt;
            copy($fileDir,$gameImageDir);
        }else{
            $scriptContentArr = explode('//BCKGRND', $scriptContent);
            $scriptContentArr[1] = "//BCKGRND\n\t\n//BCKGRND";
            $scriptContent = implode("", $scriptContentArr);
            $fileLoadContent = "game.stage.backgroundColor = '#".$imageId."';";
            $scriptContentArr = explode('//STBCKGRND', $scriptContent);
            $scriptContentArr[1] = "//STBCKGRND\n\t" . $fileLoadContent . "\n//STBCKGRND";
            $scriptContent = implode("", $scriptContentArr);
        }
        $gameStates = $this->gameStateDb->getGameState('', $gameId);
        if ($stateInfo[0]['state_order'] == 10000)
            $nextStateOrder = 1;
        else
            $nextStateOrder = $stateInfo[0]['state_order'] + 1;
        $nextState = $this->gameStateDb->getGameState('', $gameId, $nextStateOrder);
        $fileLoadContent = "this.state.start('" . $nextState[0]['state_name'] . "');";
        $scriptContentArr = explode('//NXTSTATE', $scriptContent);
        $scriptContentArr[1] = "//NXTSTATE\n\t" . $fileLoadContent . "\n//NXTSTATE";
        $scriptContent = implode("", $scriptContentArr);

        $infoFile = fopen($scriptPath, "w");
        fwrite($infoFile, $scriptContent);
        fclose($infoFile);
	}
//----------------------------------------------------------------------------//
    public function getStateBackground(){
	    $stateId = $this->request['stateId'];
        $data = $this->gameStateDb->getStateBackground($stateId);
    }
//----------------------------------------------------------------------------//
    public function getState(){
        $stateId = $this->request['stateId'];
        $stateData = $this->gameStateDb->getGameState($stateId);
        $this->response['stateData'] = $stateData;
    }
//----------------------------------------------------------------------------//
    public function getNextState(){
        $gameId = $_COOKIE['gameId'];
        $stateId = $this->request['stateId'];
        $stateData = $this->gameStateDb->getGameState($stateId);
        $statesArr = [];
        $statesArr['currentStateId'] = $stateData[0]['state_id'];
        $statesArr['currentStateName'] = $stateData[0]['shown_name'];
        $statesArr['currentStateOrder'] = $stateData[0]['state_order'];
        $states = $this->gameStateDb->getGameState('',$gameId);
        if($statesArr['currentStateOrder'] == 10000){
            $statesArr['NextStateId'] = $states[0]['state_id'];
            $statesArr['NextStateName'] = $states[0]['shown_name'];
            $statesArr['NextStateOrder'] = $states[0]['state_order'];
        }else
            for ($i=0;$i<count($states);$i++)
                if($states[$i]['state_order'] == $statesArr['currentStateOrder']+1){
                    $statesArr['NextStateId'] = $states[$i]['state_id'];
                    $statesArr['NextStateName'] = $states[$i]['shown_name'];
                    $statesArr['NextStateOrder'] = $states[$i]['state_order'];
                }
        $this->response['statesData'] = $statesArr;
    }
//----------------------------------------------------------------------------//
}
?>