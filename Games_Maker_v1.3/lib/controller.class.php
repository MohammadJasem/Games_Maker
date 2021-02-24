<?php

class controller{
//------------------------------------------------------------//
	public $response;
	public $request;
//------------------------------------------------------------//
	public function __construct(){
		$this->response = array();
		$this->request = $_POST;
	}
//------------------------------------------------------------//
	public function recurse_copy($src,$dst) {
        $dir = opendir($src);
        @mkdir($dst);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    $this->recurse_copy($src . '/' . $file,$dst . '/' . $file);
                }
                else {
                    copy($src . '/' . $file,$dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }
//------------------------------------------------------------//
	public function validation($inputs){
		$errors = array();
		foreach ($inputs as $key => $input) {
			if(!$input)
				$errors[$key] = 'This field is required';
			
		}
		return $errors;
	}
//------------------------------------------------------------//
	public function delete_directory($dirPath) {
        if (! is_dir($dirPath))
            throw new InvalidArgumentException("$dirPath must be a directory");
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/')
            $dirPath .= '/';
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file)
            if (is_dir($file))
                self::delete_directory($file);
            else
                unlink($file);
        rmdir($dirPath);
	}
//------------------------------------------------------------//
}