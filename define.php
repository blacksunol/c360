<?php
define("LOCALHOST","localhost");
define("USERNAME","netsovn_phimanh");
define("PASSWORD","phimanh");
define("DATABASE","netsovn_phimanh");
define('APPLICATION_PATH', dirname(__FILE__));
define('ADMIN_PATH', APPLICATION_PATH . '/admin');
define('HELPER_PATH', APPLICATION_PATH . '/helper');
define('PUBLIC_PATH', APPLICATION_PATH . '/public');
define('FILE_PATH', PUBLIC_PATH . '/files');
define('UPLOAD_PATH', APPLICATION_PATH . '/public/upload');
define('SCRIPT_PATH', APPLICATION_PATH . '/public/scripts');


define('APPLICATION_URL','http://'.$_SERVER['SERVER_NAME'].'/demo/phimanh');
define('ADMIN_URL', APPLICATION_URL . '/admin');
define('HELPER_URL', APPLICATION_URL . '/helper');
define('PUBLIC_URL', APPLICATION_URL . '/public');
define('TEMPLATE_URL', APPLICATION_URL . '/templates');
define('FILE_URL', PUBLIC_URL . '/files');
define('UPLOAD_URL', APPLICATION_URL . '/public/upload');
define('SCRIPT_URL', APPLICATION_URL . '/public/scripts');
?>