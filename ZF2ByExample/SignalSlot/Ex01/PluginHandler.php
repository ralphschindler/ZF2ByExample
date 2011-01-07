<?php

namespace ZF2ByExample\SignalSlot\Ex01;

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
    
    public function register($plugin)
    {
        if (method_exists($plugin, 'onInit')) {
            $this->signalSlot->connect('init', $plugin, 'onInit');
        }
        if (method_exists($plugin, 'onPreDispatch')) {
            $this->signalSlot->connect('preDispatch', $plugin, 'onPreDispatch');
        }
        if (method_exists($plugin, 'onPostDispatch')) {
            $this->signalSlot->connect('postDispatch', $plugin, 'onPostDispatch');
        }
        
    }
    
    public function notify($event)
    {
        $this->signalSlot->emit($event);
    }
    
}
