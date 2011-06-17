<?php

// Defint the ZF2 Path
define('ZF_PATH', realpath(__DIR__ . '/../ZFGit/library/'));

// error_reporting & display_errors
error_reporting(32767);
ini_set('display_errors', 1);

// bootstrap
simple_autoloader_register('Zend', ZF_PATH);

$exampleToRun = $_SERVER['argv'][1];

if (strpos($exampleToRun, '.php') === false) {
    $exampleToRun = rtrim($exampleToRun, '\\/') . DIRECTORY_SEPARATOR . '_main_.php';
}

include __DIR__ . DIRECTORY_SEPARATOR . ltrim($exampleToRun, '\\/');

if (strpos($exampleToRun, '_main_.php') !== false) {
    _main_();
}



/**
 * Functions
 */

function simple_autoloader_register($namespace, $directory, $checkFile = false) {
    spl_autoload_register(function ($class) use ($namespace, $directory, $checkFile) {
        if (strpos($class, $namespace . '\\') !== 0) return;
        $file = rtrim($directory, '\\/') . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
        if ($checkFile && !file_exists($file)) return;
        return include $file;
    });
}
