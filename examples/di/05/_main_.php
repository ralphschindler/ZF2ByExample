<?php

function _main_() {
    simple_autoloader_register('My', __DIR__);
    
    $di = new Zend\Di\Di();
    $im = $di->instanceManager();
    
    $im->addAlias('my-repository', 'My\RepositoryA');
    $im->addAlias('my-mapper', 'My\Mapper');
    $im->addAlias('my-dbAdapter', 'My\DbAdapter');
    
    $im->setParameters('My\DbAdapter', array('username' => 'readonlyuser', 'password' => 'bar'));
    
    $im->addTypePreference('my-repository', 'my-mapper');
    $im->addTypePreference('my-mapper', 'my-dbAdapter');
    
    // another alias
    $im->addAlias('my-rwDbAdapter', 'My\DbAdapter', array('username' => 'readwriteuser'));
    
    $c = $di->get('my-repository', array('dbAdapter' => 'my-rwDbAdapter'));
    echo $c . PHP_EOL . PHP_EOL;
    
    $d = $di->get('my-repository');
    echo $d . PHP_EOL . PHP_EOL;
    
    $e = $di->get('my-repository');
    echo $e . PHP_EOL . PHP_EOL;
    
    $f = $di->get('my-repository', array('dbAdapter' => 'my-rwDbAdapter'));
    echo $f . PHP_EOL . PHP_EOL;

}
