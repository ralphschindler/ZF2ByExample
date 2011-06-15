<?php

namespace Example;

class PluginHandler
{
    /**
     * @var Zend\EventManager\EventManager
     */
    protected $eventManager = null;
    
    public function __construct()
    {
        $this->eventManager = new \Zend\EventManager\EventManager();
    }
    
    public function register($plugin)
    {
        if (method_exists($plugin, 'onInit')) {
            $this->eventManager->attach('init', $plugin, 'onInit');
        }
        if (method_exists($plugin, 'onPreDispatch')) {
            $this->eventManager->attach('preDispatch', $plugin, 'onPreDispatch');
        }
        if (method_exists($plugin, 'onPostDispatch')) {
            $this->eventManager->attach('postDispatch', $plugin, 'onPostDispatch');
        }
        
    }
    
    public function notify($event)
    {
        $this->eventManager->trigger($event, $this);
    }
    
}
