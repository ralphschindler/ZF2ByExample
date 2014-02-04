<?php

function _main_() {
    simple_autoloader_register('My', __DIR__);
    
    if (!file_exists(__DIR__ . '/di-definition.php')) {
        echo 'COMPILING DEFINITION (run again to delete di-definition.php)' . PHP_EOL;
        $compiler = new Zend\Di\Definition\CompilerDefinition();
        $compiler->addDirectory(__DIR__ . '/My/');
        $compiler->compile();
        $definition = $compiler->toArrayDefinition()->toArray();
        file_put_contents(__DIR__ . '/di-definition.php', '<?php return ' . var_export($definition, true) . ';');
    } else {
        echo 'USING DEFINITION (and unlinking it)' . PHP_EOL;
        $definition = include __DIR__ . '/di-definition.php';
        unlink(__DIR__ . '/di-definition.php');
    }
    
    
    $arrayDefinition = new Zend\Di\Definition\ArrayDefinition($definition);
    $definitionList = new Zend\Di\DefinitionList($arrayDefinition);
    $di = new Zend\Di\Di($definitionList);
    $di->instanceManager()->setParameters('My\DbAdapter', array('username' => 'foo'));
    $di->instanceManager()->setParameters('My\DbAdapter', array('password' => 'bar'));
    $a = $di->get('My\RepositoryA');
    echo $a . PHP_EOL;
}
