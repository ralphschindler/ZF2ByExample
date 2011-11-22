<?php


function _main_() {
    simple_autoloader_register('My', __DIR__);
    
	$compiler = new Zend\Di\Definition\CompilerDefinition();
    $compiler->addDirectory(__DIR__ . '/My/');
    $compiler->compile();
    $definition = $compiler->toArrayDefinition()->toArray();

	$arrayDefinition = new Zend\Di\Definition\ArrayDefinition($definition);
    $definitionList = new Zend\Di\DefinitionList($arrayDefinition);
    $di = new Zend\Di\Di($definitionList);
    
    $dbAdapter = new My\DbAdapter('foo', 'bar');
    //$di->getInstanceManager()->setProperty('My\Mapper', 'dbAdapter', $dbAdapter);
    $a = $di->get('My\RepositoryA', array('dbAdapter' => $dbAdapter));
    echo $a . PHP_EOL;
    echo 'Hash for dbAdapter injected: ' . spl_object_hash($dbAdapter) . PHP_EOL;
}
