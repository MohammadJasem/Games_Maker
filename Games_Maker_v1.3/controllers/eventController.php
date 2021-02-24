<?

class eventController extends controller{

	public $gameDb;
	public $gameStateDb;
	public $userFileDB;
	public $pixelDB;
	public $userpaintsDB;
	public function __construct(){
		parent::__construct();
		$this->gameDb = new gameDB();
		$this->gameStateDb = new gameStateDB();
		$this->userFileDB = new userFileDB();
		$this->pixelDB = new pixelDB();
		$this->userpaintsDB = new userPaintsDB();
	}
//----------------------------------------------------------------------------//
//----------------------------------------------------------------------------//
}