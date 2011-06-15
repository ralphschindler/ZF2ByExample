<?php

function _main_() {
    global $autoloader;
    
    $autoloader->registerNamespace('My', __DIR__ . '/My/');
    
    if (!class_exists('My\DiDefinition', true)) {
        echo 'COMPILING DEFINITION (and writing to disk at My\DiDefinition.php)' . PHP_EOL;
        $compiler = new Zend\Di\Definition\Compiler();
        $compiler->addCodeScannerDirectory(new Zend\Code\Scanner\DirectoryScanner(__DIR__ . '/My/'));
        $definition = $compiler->compile();
        $codeGenerator = new Zend\CodeGenerator\Php\PhpFile();
        $codeGenerator->setClass(($class = new Zend\CodeGenerator\Php\PhpClass()));
        $class->setNamespaceName('My');
        $class->setName('DiDefinition');
        $class->setExtendedClass('\Zend\Di\Definition\ArrayDefinition');
        $class->setMethod(array(
        	'name' => '__construct',
            'body' => 'parent::__construct(' . var_export($definition->toArray(), true) . ');'
        ));
        file_put_contents(__DIR__ . '/My/DiDefinition.php', $codeGenerator->generate());
    
        unset($compiler, $definition, $codeGenerator, $class, $method);
    } else {
        echo 'USING DEFINITION' . PHP_EOL;
    }
    
    $definition = new My\DiDefinition();
    
    
    $di = new Zend\Di\DependencyInjector;
    $di->setDefinition($definition);
    $di->getInstanceManager()->setProperty('My\DbAdapter', 'username', 'foo');
    $di->getInstanceManager()->setProperty('My\DbAdapter', 'password', 'bar');
    $c = $di->get('My\RepositoryA');
    echo $c . PHP_EOL;
    
}

