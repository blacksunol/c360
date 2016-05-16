<?php
// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH',
              realpath(dirname(__FILE__) . '/application'));


// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV',
              (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV')
                                         : 'developer'));

set_include_path(implode(PATH_SEPARATOR, array(
    dirname(__FILE__) . '/library',
	get_include_path(),
)));
define("HOST","localhost");
define("USERNAME","root");
define("PASSWORD","root");
define("DATABASE","vietkhanh");
//Duong dan den thu muc chua cac tap tin config
define('APPLICATION_PATHFILE', dirname(__FILE__));
define('PUBLIC_PATH', dirname(__FILE__) . '/public');
define('LIBRARY_PATH', dirname(__FILE__) . '/library');
define('TEMPLATE_PATH', PUBLIC_PATH . '/templates');
define('FILE_PATH', PUBLIC_PATH . '/files');
define('SCRIPTS_PATH', PUBLIC_PATH . '/scripts');
define('CONFIG_PATH',APPLICATION_PATH . '/configs');
//Duong dan URL 

define('APPLICATION_URL','http://'.$_SERVER['SERVER_NAME'].'/vietkhanh');
define('PUBLIC_URL', APPLICATION_URL . '/public');
define('TEMPLATE_URL', PUBLIC_URL . '/templates');
define('TEMPLATE_FRONTEND_URL', TEMPLATE_URL . '/vietkhanh');
define('FILE_URL', PUBLIC_URL . '/files');
define('FILE_URLL', PUBLIC_URL . '/files');
define('SCRIPTS_URL', PUBLIC_URL . '/scripts');
define('JS_URL', PUBLIC_URL . '/js');
define('ROUTE',true);
define('APPLICATION_KEY','ss_' . md5('localhost'));
define('TRANGCHU',77);
