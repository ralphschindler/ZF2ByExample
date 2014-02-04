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
        $this->eventManager = new \Zend\EventManager\EventManager;
    }
    
    public function register(PluginHandler\PluginHandlerInterface $plugin)
    {
        if ($plugin instanceof PluginHandler\OnInitInterface) {
            $this->eventManager->attach('init', array($plugin, 'onInit'));
        }
        if ($plugin instanceof PluginHandler\OnPreDispatchInterface) {
            $this->eventManager->attach('preDispatch', array($plugin, 'onPreDispatch'));
        }
        if ($plugin instanceof PluginHandler\OnPostDispatchInterface) {
            $this->eventManager->attach('postDispatch', array($plugin, 'onPostDispatch'));
        }
        
    }
    
    public function notify($event)
    {
        $this->eventManager->trigger($event, $this);
    }
    
}
