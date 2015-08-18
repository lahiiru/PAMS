<?php
/*
 * @Author: Lahiru
 * Auto Loads classes from /X/Classes folder
 * X should be change appropiately to the hosting environment.
 * This includes checklogin page which checks for active session.
 * Therefore no need to require 'checklogin.php' manually.
 * 
 */
include_once $_SERVER['DOCUMENT_ROOT']."Dropbox/checklogin.php";
function __autoload($class_name) {
    $f=$_SERVER['DOCUMENT_ROOT']."Dropbox/Classes/".$class_name . '.php';
    if(file_exists($f)){
    include $_SERVER['DOCUMENT_ROOT']."Dropbox/Classes/".$class_name . '.php';
    }  else {
            if ((class_exists($class_name,FALSE)) || (strpos($class_name, 'PHPExcel') !== 0)) {
            //    Either already loaded, or not a PHPExcel class request
            return FALSE;
        }

        $pClassFilePath = PHPEXCEL_ROOT .
                          str_replace('_',DIRECTORY_SEPARATOR,$class_name) .
                          '.php';

        if ((file_exists($pClassFilePath) === FALSE) || (is_readable($pClassFilePath) === FALSE)) {
            //    Can't load
            return FALSE;
        }

        require($pClassFilePath);    
    }
}
?>