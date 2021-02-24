<?php

class gameKeysController extends controller{
//--------------------------------------------------------------//
	public $gameDb;
	public $gameKeyDb;
	public function __construct(){
		parent::__construct();
		$this->gameDb = new gameDB();
		$this->gameKeyDb = new gameKeyDB();
	}
//--------------------------------------------------------------//
	public function saveGameKeys(){
		$keys = $this->request['keys'];
		$gameId = $_COOKIE['gameId'];
		for($i=0;$i<count($keys);$i++){
			$this->gameKeyDb->saveGameKeys($keys[$i],$gameId);
		}
	}
//--------------------------------------------------------------//
	public function getGameKeys(){
		$gameId = $_COOKIE['gameId'];
		$gameKeys = $this->gameKeyDb->getGameKeys($gameId);
		$this->response['gameKeys'] = $gameKeys;
	}
//--------------------------------------------------------------//
}