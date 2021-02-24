<?php

class buildGameController extends controller{
//--------------------------------------------------------------//
	public $gameDb;
	public $gameStateDb;
	public function __construct(){
		parent::__construct();
		$this->gameDb = new gameDB();
		$this->gameStateDb = new gameStateDB();
	}
//--------------------------------------------------------------//
	public function index(){
		if(isset($_COOKIE['userId'])){
			$gameInfo = $this->gameDb->getGame($_COOKIE['gameId']);
			$gameStates = $this->gameStateDb->getGameState('',$_COOKIE['gameId']);
			return view('buildGame',[
				'userName'		=>	$_COOKIE['username'],
				'gameName'		=>	$gameInfo[0]['game_name'],
				'gameFullName'	=>	$gameInfo[0]['game_name'].'_'.$gameInfo[0]['dimension'].'_'.$gameInfo[0]['game_ver'],
				'userFullName'	=>	$_COOKIE['fullname'],
				'gameStates'	=>	$gameStates,
				'gameWidth'		=>	$gameInfo[0]['game_width'],
				'gameHeight'	=>	$gameInfo[0]['game_height'],
                'firstStateId'  =>  $gameStates[0]['state_id'],
                'firstStateName'=>  $gameStates[0]['shown_name'],
			]);
		}else
			return redirect('login');
	}
//--------------------------------------------------------------//
	public function saveGameSettings(){
		$data = $this->request;
		//========================================//
		$gameId = $_COOKIE['gameId'];
		$gameInfo = $this->gameDb->getGame($gameId);
		$gameName = $gameInfo[0]['game_name'];
        $dimension = $gameInfo[0]['dimension'];
        $gameVer = $gameInfo[0]['game_ver'];
        $gameFullName = $gameName.'_'.$dimension.'_'.$gameVer;
		$gamesDir = REPO.DS.$_COOKIE['username'].DS.'Games';
		$gameDir = $gamesDir.DS.$gameFullName;
		//========================================//
		$gameOptionPath = GM_FILES.DS.'game_options.js';
		$content = file_get_contents($gameOptionPath);
		$content = str_replace('GAME_WIDTH_VAL' , $data['game_width']*20 , $content);
		$content = str_replace('GAME_HEIGHT_VAL' , $data['game_height']*20 , $content);
		$content = str_replace('LOCAL_STORAGE_NAME_VAL' , $data['local_storage_name'] , $content);
		//======================================================//
		$scriptPath = $gameDir.DS.'assets'.DS.'js'.DS.'main.js';
		$scriptContent = file_get_contents($scriptPath);
		$scriptContentArr = explode('//OPTIONS', $scriptContent);
		$scriptContentArr[1] = "//OPTIONS\n".$content."\n//OPTIONS";
		$scriptContent = implode("", $scriptContentArr);

		$infoFile = fopen($scriptPath, "w");
		fwrite($infoFile, $scriptContent);
		fclose($infoFile);
		//=============================================//
		$this->gameDb->saveGameSettings($data,$gameId);
		//=============================================//
		$controller = new pixelController();
		$gameStates = $this->gameStateDb->getGameState('',$_COOKIE['gameId']);
		for($i=0;$i<count($gameStates);$i++){
			$controller->updateStateEventsOnGame($gameStates[$i]['state_id']);
		}
		//=============================================//
	}
//--------------------------------------------------------------//
	public function getGameSettings(){
		$gameId = $_COOKIE['gameId'];
		$gameInfo = $this->gameDb->getGame($gameId);

		$this->response['game_width'] = $gameInfo[0]['game_width'];
		$this->response['game_height'] = $gameInfo[0]['game_height'];
		$this->response['local_storage_name'] = $gameInfo[0]['local_storage_name'];
	}
//--------------------------------------------------------------//
}