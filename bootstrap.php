<?php

require_once 'Zend/Loader/StandardAutoloader.php';

$autoloader = new Zend\Loader\StandardAutoloader();
$autoloader->registerNamespace('ZF2ByExample', __DIR__ . DIRECTORY_SEPARATOR . 'ZF2ByExample');
$autoloader->register();
