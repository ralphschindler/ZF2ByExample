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
            $this->eventManager->attach('init', $plugin, 'onInit');
        }
        if ($plugin instanceof PluginHandler\OnPreDispatchInterface) {
            $this->eventManager->attach('preDispatch', $plugin, 'onPreDispatch');
        }
        if ($plugin instanceof PluginHandler\OnPostDispatchInterface) {
            $this->eventManager->attach('postDispatch', $plugin, 'onPostDispatch');
        }
        
    }
    
    public function notify($event)
    {
        $this->eventManager->trigger($event, $this);
    }
    
}
