<?php

class authController extends controller{

	public $userDb;
	public function __construct(){
		parent::__construct();
		$this->userDb = new userDB();
	}
//--------------------------------------------------------------------//
	public function logout(){
		setcookie('userId','',0);
		setcookie('gameId','',0);
		setcookie('username','',0);
		setcookie('fullname','',0);
		return redirect('login');
	}
//--------------------------------------------------------------------//
	public function login(){
		if(isset($_COOKIE['username']))
			return redirect('home');
		else
			return view('login');
	}
//--------------------------------------------------------------------//
	public function loginUser(){
		$data = $this->request;
		$login = $errorMsg = '';
		$errors = $this->validation($data);
		$username = $data['username'];
		$password = $data['password'];
		if(isset($username))
			$userInfo = $this->userDb->getUser('',$username);
		if($userInfo){
			$userId = $userInfo[0]['user_id'];
			if($password!=''){
				if($password==$userInfo[0]['password'])
					$login = 'Y';
				else
					$errorMsg = 'The password is incorrect';
			}
		}else
			$errorMsg = 'The username ('.$username.') is not exist';

		if($login=='Y'){
			setcookie('userId',$userId,time() +86400);
			setcookie('username',$username,time()+86400);
			setcookie('fullname',$userInfo[0]['first_name'].' '.$userInfo[0]['last_name'],time() +86400);
			return redirect('home');
		}else
			return view('login',['errors'=>$errors,'data'=>$data,'errorMsg'=>$errorMsg]);
	}
//--------------------------------------------------------------------//
	public function register(){
		if(isset($_COOKIE['username']))
			return redirect('home');
		else
			return view('register');
	}
//--------------------------------------------------------------------//
	public function registerUser(){
		$data = $this->request;
		$register = $errorMsg = '';
		$errors = $this->validation($data);
		$username = $data['username'];
		if(isset($username))
			$userInfo = $this->userDb->getUser('',$username);

		if($userInfo){
			$errorMsg = 'The username ('.$username.') is exist. Username should be unique';
		}else{
			if(empty($errors)){
				if($data['password']==$data['confirm_password']){
					$register = 'Y';
					self::createUserFiles($username);
				}else
					$errorMsg = 'The Password and Confirm Password are not matched';
				
			}
		}
		if($register=='Y'){
			$userId = $this->userDb->addUser($data);
			setcookie('userId',$userId,time() +86400);
			setcookie('username',$username,time() +86400);
			setcookie('fullname',$data['firstname'].' '.$data['lastname'],time() +86400 );

			return redirect('home');
		}else
			return view('register',['errors'=>$errors,'data'=>$data,'errorMsg'=>$errorMsg]);
		
	}
//--------------------------------------------------------------------//
	private function createUserFiles($userName){
		$userDir = REPO.DS.$userName;
		$gameDir = $userDir.DS.'Games';
		$filesDir = $userDir.DS.'files';
		$imgsDir = $filesDir.DS.'imgs';
		$audioDir = $filesDir.DS.'audio';
		$fontsDir = $filesDir.DS.'fonts';
		$paintsDir = $filesDir.DS.'paints';

		if(!file_exists($userDir))
			mkdir($userDir);

		if(!file_exists($gameDir))
			mkdir($gameDir);

		if(!file_exists($filesDir))
			mkdir($filesDir);

		if(!file_exists($imgsDir))
			mkdir($imgsDir);

		if(!file_exists($audioDir))
			mkdir($audioDir);

		if(!file_exists($fontsDir))
			mkdir($fontsDir);

		if(!file_exists($paintsDir))
			mkdir($paintsDir);

	}	
//--------------------------------------------------------------------//	
}