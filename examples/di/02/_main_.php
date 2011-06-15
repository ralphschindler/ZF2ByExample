<?php

function _main_() {
    global $autoloader;
    $autoloader->registerNamespace('My', __DIR__ . '/My/');
    
    if (!file_exists(__DIR__ . '/di-definition.php')) {
        echo 'COMPILING DEFINITION (run again to delete di-definition.php)' . PHP_EOL;
        $compiler = new Zend\Di\Definition\Compiler();
        $compiler->addCodeScannerDirectory(new Zend\Code\Scanner\DirectoryScanner(__DIR__ . '/My/'));
        $definition = $compiler->compile();
        file_put_contents(__DIR__ . '/di-definition.php', '<?php return ' . var_export($definition->toArray(), true) . ';');
    } else {
        echo 'USING DEFINITION (and unlinking it)' . PHP_EOL;
        $definition = new Zend\Di\Definition\ArrayDefinition(include __DIR__ . '/di-definition.php');
        unlink(__DIR__ . '/di-definition.php');
    }
    
    
    $di = new Zend\Di\DependencyInjector;
    $di->setDefinition($definition);
    $di->getInstanceManager()->setProperty('My\DbAdapter', 'username', 'foo');
    $di->getInstanceManager()->setProperty('My\DbAdapter', 'password', 'bar');
    $c = $di->get('My\RepositoryA');
    echo $c . PHP_EOL;
}
