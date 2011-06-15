<?php


function _main_() {
    simple_autoloader_register('My', __DIR__);
    
    $compiler = new Zend\Di\Definition\Compiler();
    $compiler->addCodeScannerDirectory(new Zend\Code\Scanner\DirectoryScanner(__DIR__ . '/My/'));
    $definition = $compiler->compile();
    
    $di = new Zend\Di\DependencyInjector();
    $di->setDefinition($definition);
    
    $dbAdapter = new My\DbAdapter('foo', 'bar');
    //$di->getInstanceManager()->setProperty('My\Mapper', 'dbAdapter', $dbAdapter);
    $c = $di->get('My\RepositoryA', array('dbAdapter' => $dbAdapter));
    echo $c . PHP_EOL;
    echo 'Hash for dbAdapter injected: ' . spl_object_hash($dbAdapter) . PHP_EOL;
}
