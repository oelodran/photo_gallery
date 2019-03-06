<?php
/**
 * Created by PhpStorm.
 * User: leona
 * Date: 5.3.2019.
 * Time: 13:14
 */
ob_start(); // turn on output buffering

// Assign file paths to PHP constants
define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("PUBLIC_PATH", PROJECT_PATH . '/public');
define("SHARED_PATH", PRIVATE_PATH . '/shared');

// Assign the root URL to a PHP constant
// Can dynamically find everything in URL up to "/public"
$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define("WWW_ROOT", $doc_root);

require_once ('functions.php');
require_once ('db_credentials.php');
require_once ('database_functions.php');

// -> All classes in directory
foreach(glob('classes/*.php') as $file) {
    require_once($file);
}

// Autoload classes definitions
function my_autoload($class) {
    if(preg_match('/\A\w+\Z/', $class)) {
        include('classes/' . $class . '.php');
    }
}
spl_autoload_register('my_autoload');

$database = db_connect();