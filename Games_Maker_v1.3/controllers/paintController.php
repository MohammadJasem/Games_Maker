<?php

class paintController extends controller{
//--------------------------------------------------------------//
    public $userpaintsDB;
    public $gameDb;
    public function __construct(){
        parent::__construct();
        $this->userpaintsDB = new userPaintsDB();
        $this->gameDb = new gameDB();
    }
//--------------------------------------------------------------//
    public function paint(){
        if(isset($_COOKIE['userId'])){
            $gameInfo = $this->gameDb->getGame($_COOKIE['gameId']);
            return view('paint',[
                'paintId'           =>  '',
                'pixelsColorArr'    =>  '',
                'paint_name'    =>  '',
                'userName'		=>	$_COOKIE['username'],
                'gameName'		=>	$gameInfo[0]['game_name'],
                'gameFullName'	=>	$gameInfo[0]['game_name'].'_'.$gameInfo[0]['dimension'].'_'.$gameInfo[0]['game_ver'],
                'userFullName'	=>	$_COOKIE['fullname'],
            ]);
        }else
            return redirect('login');
    }
//----------------------------------------------------------------------------//
    public function editPaint(){
        $paintId = $_COOKIE['paintId'];
        $paint = $this->userpaintsDB->getPaint('',$paintId);
        $paintColors = $paint[0]['paint_colors'];
        $pixelsColorArr = $tmpRow = [];
        //=========================================================//
        $paintColors = explode('-',$paintColors);
        $count = 0;
        $takeCell = $takeRow = true;
        foreach ($paintColors as $color){
            $count++;
            if($takeCell && $count == 1)
                $r = $color;
            if($takeCell && $count == 2)
                $g = $color;
            if($count == 3){
                if($takeCell) {
                    $b = $color;
                    array_push($tmpRow, 'rgb(' . $r . ', ' . $g . ', ' . $b . ')');
                    if(count($tmpRow) == 32){
                        if($takeRow) {
                            array_push($pixelsColorArr, $tmpRow);
                            $takeRow = false;
                        }else
                            $takeRow = true;
                        $tmpRow = [];
                    }
                    $takeCell = false;
                }else
                    $takeCell = true;
                $count = 0;
            }
        }
        //=========================================================//
        $gameInfo = $this->gameDb->getGame($_COOKIE['gameId']);
        return view('paint',[
            'paintId'           =>  $paintId,
            'pixelsColorArr'    =>  $pixelsColorArr,
            'paint_name'    =>  $paint[0]['paint_name'],
            'userName'		=>	$_COOKIE['username'],
            'gameName'		=>	$gameInfo[0]['game_name'],
            'gameFullName'	=>	$gameInfo[0]['game_name'].'_'.$gameInfo[0]['dimension'].'_'.$gameInfo[0]['game_ver'],
            'userFullName'	=>	$_COOKIE['fullname'],
        ]);
    }
//----------------------------------------------------------------------------//
    public function savePaint2Image(){
        $data['paintName'] = $this->request['paint_name'];
        $data['paintColors'] = $this->request['paint_colors'];
        $data['userId'] = $_COOKIE['userId'];
        $data['paintId'] = $this->request['paintId'];
        $isAdd = $this->request['isAdd'];
        if($isAdd == 1)
            $this->userpaintsDB->addPaint($data);
        else
            $this->userpaintsDB->updatePaint($data['paintId'],$data['paintName'],$data['paintColors']);

        //==============================================================//
        $imageName = $data['paintName'].".png";
        $imagePath = REPO.DS.$_COOKIE['username'].DS.'files'.DS.'paints'.DS.$imageName;
        $imageSrc = $this->request['imageSrc'];
        
        file_put_contents($imagePath,file_get_contents("data://".$imageSrc));
        //==============================================================//
    }
//----------------------------------------------------------------------------//
    public function deletePaint(){
        $paintId = $this->request['paintId'];
        $this->userpaintsDB->deletePaint('',$paintId);
    }
//----------------------------------------------------------------------------//
    public function getUserPaintsList(){
        $userId = $_COOKIE['userId'];
        $userPaints = $this->userpaintsDB->getPaint($userId);
        $this->response['userpaints'] = $userPaints;
    }
//----------------------------------------------------------------------------//
    public function getUserPaintsImages(){
        $userId = $_COOKIE['userId'];
        $userPaints = $this->userpaintsDB->getPaint($userId);
        $paintsDir = REPO_URI.DS.$_COOKIE['username'].DS.'files'.DS.'paints';
        $selectHtml = '<option value=""></option>';
        for($i=0;$i<count($userPaints);$i++){
            $imagePath = $paintsDir.DS.$userPaints[$i]['paint_name'].'.png';
            $selectHtml .= '<option value="'.$userPaints[$i]['paint_id'].'" imagePath="'.$imagePath.'">'.$userPaints[$i]['paint_name'].'</option>';
        }
        $this->response['selectHtml'] = $selectHtml;
    }
//----------------------------------------------------------------------------//
}
?>