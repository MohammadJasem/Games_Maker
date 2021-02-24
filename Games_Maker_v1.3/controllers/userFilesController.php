<?php

class userFilesController extends controller{
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
    public function getUserImages(){
        $userId = $_COOKIE['userId'];

        //============================================//
        $imagesDir = 'http://localhost'.REPO_URI.DS.$_COOKIE['username'].DS.'files'.DS.'imgs';
        //============================================//
        $gameImages = $this->userFileDB->getUserFile($userId,'','IMAGE');

        $imageSelectHtml = '<option value=""></option>';
        for($i=0;$i<count($gameImages);$i++){
            $imagePath = $imagesDir.DS.$gameImages[$i]['file_name'].'.'.$gameImages[$i]['file_ext'];
            $imageSelectHtml .= '<option value="'.$gameImages[$i]['file_id'].'" imagePath="'.$imagePath.'">'.$gameImages[$i]['file_name'].'</option>';
        }
        $stateBckGrnd = '';
        if(isset($this->request['stateId'])){
            $stateId = $this->request['stateId'];
            $stateBckGrnd = $this->gameStateDb->getStateBackground($stateId);
        }
        $this->response['stateBckGrnd'] = $stateBckGrnd;
        $this->response['imageSelectHtml'] = $imageSelectHtml;

    }
//--------------------------------------------------------------//
    public function uploadUserFile(){
        if (!empty($_FILES)){
            $tmpFile = $_FILES['gameFile']['tmp_name'];
            move_uploaded_file($tmpFile,TMP_FILES.DS.$_FILES['gameFile']['name']);
        }
        echo TMP_FILES.DS.$_FILES['gameFile']['name'];
    }
//--------------------------------------------------------------//
    public function saveUserFiles(){
        $data = $this->request;
        //==================================================//
        $fileTmpName = explode('[]',$data['gameFile'])[0];
        //==================================================//
        $fileDir = $gamesDir = REPO.DS.$_COOKIE['username'].DS.'files';
        //==================================================//
        $fileType = $data['fileType'];
        $fileName = $data['fileName'];
        if($fileType=='IMAGE')
            $dirType = 'imgs';
        elseif($fileType=='AUDIO')
            $dirType = 'audio';
        elseif($fileType=='FONT')
            $dirType = 'fonts';
        $fileDir = $fileDir.DS.$dirType;
        if($fileTmpName){
            $userId = $_COOKIE['userId'];
            $fileExt = pathinfo($fileTmpName, PATHINFO_EXTENSION);
            $fileNewPath = $fileDir.DS.$fileName.'.'.$fileExt;
            rename($fileTmpName,$fileNewPath);
            $this->userFileDB->addUserFile($userId,$fileName,$fileExt,$fileType);
        }
    }
//----------------------------------------------------------------------------//
}
?>