<?php

// Defint the ZF2 Path
define('ZF_PATH', __DIR__ . '/../ZFGit/library/');

// error_reporting & display_errors
error_reporting(32767);
ini_set('display_errors', 1);

// bootstrap
$autoloaderFile = ZF_PATH . 'Zend/Loader/StandardAutoloader.php'; 
if (stream_resolve_include_path($autoloaderFile) === false && file_exists($autoloaderFile) === false) {
    die('You must first set the ZF_PATH constant to your ZF2 library');
}
require_once $autoloaderFile;
$autoloader = new Zend\Loader\StandardAutoloader;
$autoloader->register();

$exampleToRun = $_SERVER['argv'][1];

if (strpos($exampleToRun, '_main_.php') === false) {
    $exampleToRun = rtrim($exampleToRun, '\\/') . DIRECTORY_SEPARATOR . '_main_.php';
}

include __DIR__ . DIRECTORY_SEPARATOR . ltrim($exampleToRun, '\\/');
_main_();
