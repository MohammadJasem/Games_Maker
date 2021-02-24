<?php

class gamesController extends controller{
//--------------------------------------------------------------//
	public $gameDb;
	public $gameStateDb;
	public $pixelDb;
	public $eventDb;
	public $gameKeyDb;
	public $zipArchive;
	public function __construct(){
		parent::__construct();
		$this->gameDb = new gameDB();
		$this->gameStateDb = new gameStateDB();
		$this->pixelDb = new pixelDB();
		$this->eventDb = new eventDB();
		$this->gameKeyDb = new gameKeyDB();
		$this->zipArchive = new ZipArchive();
	}
//--------------------------------------------------------------//
	public function index(){
		if(isset($_COOKIE['userId'])){
			$username = $_COOKIE['username'];
            $userGames = $this->gameDb->getGame('',$_COOKIE['userId']);
            for ($i=0;$i<count($userGames);$i++){
                $gameName = $userGames[$i]['game_name'];
                $dimension = $userGames[$i]['dimension'];
                $gameVer = $userGames[$i]['game_ver'];
                $gameFullName = $gameName.'_'.$dimension.'_'.$gameVer;
                $userGames[$i]['gameFullName'] = $gameFullName;
                $userGames[$i]['gamePath'] = 'http://localhost'.REPO_URI.'/'.$username.'/Games/'.$gameFullName.'/index.html';
                $userGames[$i]['gameLogoPath'] = 'http://localhost'.REPO_URI.'/'.$username.'/Games/'.$gameFullName.'/assets/img/game_logo.png';
            }
			return view('home',['userGames'=>$userGames]);
		}else
			return redirect('login');
	}
//--------------------------------------------------------------//
	public function addGame(){
		$data = $this->request;
		$gamesDir = REPO.DS.$_COOKIE['username'].DS.'Games';
		$gameName = $data['game_name'];
		$dimension = $data['dimension'];
		$gameVer = $data['game_ver'];
		$userGames = $this->gameDb->getGame('',$_COOKIE['userId'],$gameName,$dimension,$gameVer);
		$gameDir = $gamesDir.DS.$gameName.'_'.$dimension.'_'.$gameVer;
		if($userGames){
			$this->response['exist'] = 'Y';
		}else{
			$gameId = $this->gameDb->addGame($data,$_COOKIE['userId']);
			$this->recurse_copy(GM_FILES.DS."origin_game".DS,$gameDir.DS);
			//============================================//
			$indexPath = $gameDir.DS.'index.html';
			$indexContent = file_get_contents($indexPath);
	        $indexContent = str_replace('GAME_NAME' , $gameName , $indexContent);
            $gameFullName = $gameName.'_'.$dimension.'_'.$gameVer;
	        $indexContent = str_replace('USER_NAME',$_COOKIE['username'],$indexContent);
            $indexContent = str_replace('GAME_FULL_NAME',$gameFullName,$indexContent);
	        $infoFile = fopen($indexPath, "w");
	        fwrite($infoFile, $indexContent);
	        fclose($infoFile);
	        $this->gameStateDb->addGameState('Menu',1,$gameId,'Y');
	        $this->gameStateDb->addGameState('StartGame',2,$gameId,'Y');
	        $this->gameStateDb->addGameState('FinalState',10000,$gameId,'Y');
	        $this->response['exist'] = 'N';
	        $this->response['gameId'] = $gameId;
    	}
    	// print_r($data);exit();
        if(array_key_exists("gameLogo",$data))
            $this->saveGameLogo($data);
	}
//--------------------------------------------------------------//
	public function deleteGame(){
		$gameId = $this->request['gameId'];
		$gameInfo = $this->gameDb->getGame($gameId);
		$states = $this->gameStateDb->getGameState('',$gameId);
		for($i=0;$i<count($states);$i++){
		    $this->gameStateDb->deleteImgState('',$states[$i]['state_id']);
		    $this->pixelDb->deletePixel('',$states[$i]['state_id']);
		    $this->eventDb->deleteEvent($states[$i]['state_id']);
        }
		$this->gameStateDb->deleteGameState('',$gameId);
		$this->gameKeyDb->deleteGameKeys($gameId);
		$this->gameDb->deleteGame($gameId);
		$gamesDir = REPO.DS.$_COOKIE['username'].DS.'Games';
		$gameFullName = $gameInfo[0]['game_name'].'_'.$gameInfo[0]['dimension'].'_'.$gameInfo[0]['game_ver'];
		$this->delete_directory($gamesDir.DS.$gameFullName);
	}
//--------------------------------------------------------------//
	public function getGame(){
		$gameId = $this->request['gameId'];
		$gameInfo = $this->gameDb->getGame($gameId);
		$this->response['game_name'] = $gameInfo[0]['game_name'];
		$this->response['dimension'] = $gameInfo[0]['dimension'];
		$this->response['game_ver'] = $gameInfo[0]['game_ver'];
	}
//--------------------------------------------------------------//
	public function updateGame(){
		$data = $this->request;
		$gameId = $data['gameId'];
		$gameInfo = $this->gameDb->getGame($gameId);
		$gamesDir = REPO.DS.$_COOKIE['username'].DS.'Games';
		$gameFullName = $gameInfo[0]['game_name'].'_'.$gameInfo[0]['dimension'].'_'.$gameInfo[0]['game_ver'];
		$gameDir = $gamesDir.DS.$gameFullName;
		//================================//
		$gameName = $data['game_name'];
		$dimension = $data['dimension'];
		$gameVer = $data['game_ver'];
		$userGames = $this->gameDb->getGame('',$_COOKIE['userId'],$gameName,$dimension,$gameVer);
		if($userGames){
			if($userGames[0]['game_id']!=$gameId)
				$exist = 'Y';
			else
				$exist = 'N';
		}else
			$exist = 'N';


		if($exist == 'N'){
			$newGameDir = $gamesDir.DS.$gameName.'_'.$dimension.'_'.$gameVer;
			//================================//
			$indexPath = $gameDir.DS.'index.html';
			$indexContent = file_get_contents($indexPath);
	        $indexContent = preg_replace('#<title>(.*?)</title>#' ,'<title>'.$gameName.'</title>',$indexContent);
	        $indexContent = str_replace('USER_NAME',$_COOKIE['username'],$indexContent);
	        $indexContent = str_replace('GAME_FULL_NAME',$gameFullName,$indexContent);
	        $infoFile = fopen($indexPath, "w");
	        fwrite($infoFile, $indexContent);
	        fclose($infoFile);
			//================================//
			rename($gameDir,$newGameDir);
			//================================//
			$this->gameDb->updateGame($data,$gameId,$_COOKIE['userId']);
		}else
			$this->response['exist'] = 'Y';
		if($data['gameLogo'] != '')
            $this->saveGameLogo($data);
	}
//--------------------------------------------------------------//
    private function saveGameLogo($data){
        $fileTmpName = explode('[]',$data['gameLogo'])[0];
        //==================================================//
        $gamesDir = REPO.DS.$_COOKIE['username'].DS.'Games';
        $gameFullName = $data['game_name'].'_'.$data['dimension'].'_'.$data['game_ver'];
        $imgDir = $gamesDir.DS.$gameFullName.DS.'assets'.DS.'img';
        //==================================================//
        if($fileTmpName){
            $fileExt = pathinfo($fileTmpName, PATHINFO_EXTENSION);
            $fileNewPath = $imgDir.DS.'game_logo.png';
            rename($fileTmpName,$fileNewPath);
            $fileNewPathIco = $imgDir.DS.'game_logo.ico';
            copy($fileNewPath,$fileNewPathIco);
        }

    }
//--------------------------------------------------------------//
    public function uploadGameLogo(){
        if (!empty($_FILES)){
            $tmpFile = $_FILES['gameLogo']['tmp_name'];
            move_uploaded_file($tmpFile,TMP_FILES.DS.$_FILES['gameLogo']['name']);
        }
        echo TMP_FILES.DS.$_FILES['gameLogo']['name'];
    }
//--------------------------------------------------------------//
    public function exportGame(){
        $gameId = $this->request['gameId'];
        $gameInfo = $this->gameDb->getGame($gameId);
        $gameFullName = $gameInfo[0]['game_name'].'_'.$gameInfo[0]['dimension'].'_'.$gameInfo[0]['game_ver'];
        $dir = REPO.DS.$_COOKIE['username'].DS.'Games'.DS.$gameFullName;
        $zip_file = $gameFullName.'.zip';
        $rootPath = realpath($dir);
        $this->zipArchive->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($rootPath),
            RecursiveIteratorIterator::LEAVES_ONLY
        );
        foreach ($files as $name => $file)
            if (!$file->isDir()){
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);
                $this->zipArchive->addFile($filePath, $relativePath);
            }
        $this->zipArchive->close();
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($zip_file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($zip_file));
        readfile($zip_file);
    }
//--------------------------------------------------------------//
}