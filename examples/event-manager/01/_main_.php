<?php

function _main_() {
    global $autoloader;
    $autoloader->registerNamespace('Example', __DIR__);
    
    $ph = new Example\PluginHandler();
    $ph->register(new Example\MyPlugin());
    
    $sd = new Example\Dispatcher($ph);
    $sd->dispatch();

}


