<?php

function _main_() {
    simple_autoloader_register('Example', __DIR__);
    
    $ph = new Example\PluginHandler();
    $ph->register(new Example\MyPlugin());
    
    $sd = new Example\Dispatcher($ph);
    $sd->dispatch();
}