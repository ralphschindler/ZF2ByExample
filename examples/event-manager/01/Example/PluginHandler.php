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
            $this->eventManager->attach('init', array($plugin, 'onInit'));
        }
        if (method_exists($plugin, 'onPreDispatch')) {
            $this->eventManager->attach('preDispatch', array($plugin, 'onPreDispatch'));
        }
        if (method_exists($plugin, 'onPostDispatch')) {
            $this->eventManager->attach('postDispatch', array($plugin, 'onPostDispatch'));
        }
        
    }
    
    public function notify($event)
    {
        $this->eventManager->trigger($event, $this);
    }
    
}
