<?php

function _main_() {
    simple_autoloader_register('My', __DIR__);
    
    $configValues = new Zend\Config\Ini(__DIR__ . '/di-config.ini', 'production');
    $diConfig = new Zend\Di\Configuration($configValues->di);
    $di = new Zend\Di\Di(null, null, $diConfig);
    $im = $di->instanceManager();
    
    
    $c = $di->get('my-repository', array('dbAdapter' => 'my-dbAdapter'));
    echo $c . PHP_EOL . PHP_EOL;
    
    $d = $di->get('my-repository');
    echo $d . PHP_EOL . PHP_EOL;
    
    $e = $di->get('my-repository', array('dbAdapter' => 'my-dbAdapter'));
    echo $e . PHP_EOL . PHP_EOL;
    
    $f = $di->get('my-repository');
    echo $f . PHP_EOL . PHP_EOL;
    
    
    echo 'Is it the same object (c && d): ';
    var_dump(($c === $d)); 
    echo PHP_EOL;
    
    echo 'Is it the same object (c && e): ';
    var_dump(($c === $e)); 
    echo PHP_EOL;
    
    echo 'Is it the same object (d && f): ';
    var_dump(($d === $f)); 
    echo PHP_EOL;
    
}
