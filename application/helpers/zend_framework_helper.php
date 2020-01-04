<?php
// For Windows

/*ini_set("include_path", ini_get("include_path").PATH_SEPARATOR.str_replace("/", "\\", BASEPATH)."zend_libraries\\");
require_once ('Zend/Loader.php');*/


// For Non-Windows
ini_set("include_path", ini_get("include_path").PATH_SEPARATOR.BASEPATH."/zend_libraries/");
require_once 'Zend/Loader.php';

?>