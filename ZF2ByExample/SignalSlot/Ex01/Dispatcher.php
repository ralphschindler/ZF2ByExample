<?php

namespace ZF2ByExample\SignalSlot\Ex01;

class Dispatcher
{
    
    protected $pluginHandler;
    
    public function __construct($pluginHandler = null)
    {
        $this->pluginHandler = (isset($pluginHandler)) ? $pluginHandler : new PluginHandler();
        
        // init
        $this->pluginHandler->notify('init');
    }
    
    public function getPluginHandler()
    {
        return $this->pluginHandler;
    }
    
    public function dispatch()
    {
        // predispatch
        $this->pluginHandler->notify('preDispatch');
        
        echo 'Dispatcher is dispatching' . PHP_EOL;
        
        // postdispatch
        $this->pluginHandler->notify('postDispatch');
    }
    
    
}