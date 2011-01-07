<?php

namespace ZF2ByExample\SignalSlot\Ex02;

class PluginHandler
{
    /**
     * @var Zend\SignalSlot\Signals
     */
    protected $signalSlot = null;
    
    public function __construct()
    {
        $this->signalSlot = new \Zend\SignalSlot\Signals;
    }
    
    public function register(PluginHandler\PluginHandlerInterface $plugin)
    {
        if ($plugin instanceof PluginHandler\OnInitInterface) {
            $this->signalSlot->connect('init', $plugin, 'onInit');
        }
        if ($plugin instanceof PluginHandler\OnPreDispatchInterface) {
            $this->signalSlot->connect('preDispatch', $plugin, 'onPreDispatch');
        }
        if ($plugin instanceof PluginHandler\OnPostDispatchInterface) {
            $this->signalSlot->connect('postDispatch', $plugin, 'onPostDispatch');
        }
        
    }
    
    public function notify($event)
    {
        $this->signalSlot->emit($event);
    }
    
}
