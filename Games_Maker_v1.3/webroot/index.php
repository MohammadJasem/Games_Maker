<?php

define('DS',DIRECTORY_SEPARATOR);
define('ROOT',dirname(dirname(__FILE__)));
define('REPO',dirname(ROOT).DS.'games_repositories');
define('TMP_FILES',ROOT.DS.'storage'.DS.'tmp');
define('REPO_URI','/games_repositories');
define('GM_FILES',dirname(ROOT).DS.'Game_Maker_Files');
define('ROOT_URI', str_replace('index.php','',$_SERVER['SCRIPT_NAME']));

require_once(ROOT.DS.'lib'.DS.'init.php');
