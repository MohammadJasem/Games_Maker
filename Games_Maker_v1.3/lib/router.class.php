<?php

class Router{

	protected static $routeFound = false;
//-----------------------------------------------------------//
	public function get($thisUri,$callback){
		if(!self::$routeFound){
			$uri = str_replace(ROOT_URI, "/",$_SERVER['REQUEST_URI']);
			$method = $_SERVER['REQUEST_METHOD'];
			if($uri==$thisUri && $method=='GET'){
				self::$routeFound = true;
				if(is_callable($callback))
					$callback();
				else{
					$callbackArr = explode('@',$callback);
					$controller = new $callbackArr[0]();
					$method = $callbackArr[1];
					if(method_exists($controller,$method)){
						$controller->$method();	
					}
				}
			}
		}
	}
//-----------------------------------------------------------//
	public function post($thisUri,$callback){
		if(!self::$routeFound){
			$uri = str_replace(ROOT_URI, "/",$_SERVER['REQUEST_URI']);
			$method = $_SERVER['REQUEST_METHOD'];
			if($uri==$thisUri && $method=='POST'){
				self::$routeFound = true;
				if(is_callable($callback))
					$callback();
				else{
					$callbackArr = explode('@',$callback);
					$controller = new $callbackArr[0]();
					$method = $callbackArr[1];
					if(method_exists($controller,$method)){
						$controller->$method();
						echo json_encode($controller->response);
					}
				}
			}
		}
	}
//-----------------------------------------------------------//
	public function notFound_404(){
		if(!self::$routeFound)
			return view('errors/404');
	}
//-----------------------------------------------------------//
}