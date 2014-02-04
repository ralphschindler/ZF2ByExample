<?php

function _main_() {
    simple_autoloader_register('My', __DIR__, true);
    
    if (!class_exists('My\DiDefinition', true)) {
        echo 'COMPILING DEFINITION (and writing to disk at My\DiDefinition.php)' . PHP_EOL;
        $compiler = new Zend\Di\Definition\CompilerDefinition();
        $compiler->addDirectory(__DIR__ . '/My/');
        $compiler->compile();
        $codeGenerator = new Zend\Code\Generator\FileGenerator();
        $codeGenerator->setClass(($class = new Zend\Code\Generator\ClassGenerator()));
        $method = new Zend\Code\Generator\MethodGenerator('__construct');
        $method->setBody('parent::__construct(' . var_export($compiler->toArrayDefinition()->toArray(), true) . ');');
        $class->setNamespaceName('My');
        $class->setName('DiDefinition');
        $class->setExtendedClass('\Zend\Di\Definition\ArrayDefinition');
        $class->setMethod($method);
        file_put_contents(__DIR__ . '/My/DiDefinition.php', $codeGenerator->generate());
        unset($compiler, $definition, $codeGenerator, $class);
    } else {
        echo 'USING DEFINITION' . PHP_EOL;
    }
    
    $definition = new My\DiDefinition();
    $definitionList = new Zend\Di\DefinitionList(array($definition));
    $di = new Zend\Di\Di($definitionList);
    $di->instanceManager()->setParameters('My\DbAdapter', array('username' => 'foo'));
    $di->instanceManager()->setParameters('My\DbAdapter', array('password' => 'bar'));
    $a = $di->get('My\RepositoryA');
    echo $a . PHP_EOL;
    
}

