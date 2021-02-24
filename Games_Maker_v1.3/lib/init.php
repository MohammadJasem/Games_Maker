<?php

include_once ROOT.'\vendor\autoload.php';

use Philo\Blade\Blade;

global $base_url,$blade;
$base_url = 'http://'.$_SERVER['SERVER_NAME'].'/Games_Maker_v1.3/';

$views = ROOT . '/resources/views';
$cache = ROOT . '/resources/cache';
$blade = new Blade($views, $cache);

//-----------------------------------------------------//
function url($path){
    global $base_url;
    echo $base_url.'assets/'.$path;
}
//-----------------------------------------------------//
function js($path){
    global $base_url;
    echo $base_url.'resources/js/'.$path;
}
//-----------------------------------------------------//
function view($viewPath,$arrParam=[]){
    global $blade;
    echo $blade->view()->make($viewPath,$arrParam)->render();
}
//-----------------------------------------------------//
function redirect($uri){
    header("LOCATION:".$uri);
}
//-----------------------------------------------------//
function route($uri){
    global $base_url;
    echo ($base_url.'webroot/'.$uri);
}
//-----------------------------------------------------//
spl_autoload_register(function($className)
{
    $lib_path = ROOT.DS.'lib'.DS.strtolower($className).'.class.php';
    $controllers_path = ROOT.DS.'controllers'.DS.$className.'.php';
    $models_path = ROOT.DS.'models'.DS.$className.'.php';
    if(file_exists($lib_path)){
        require_once($lib_path);
    }elseif(file_exists($models_path)){
        require_once($models_path);
    }elseif(file_exists($controllers_path)){
        require_once($controllers_path);
    }else{
        throw new Exception('Failed to include class: '.$className);
    }
});
require_once('routing.php');