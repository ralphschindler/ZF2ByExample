<?php

namespace ZF2ByExample\SignalSlot\Ex02;

class MyPlugin implements PluginHandler\OnInitInterface, PluginHandler\OnPostDispatchInterface
{
    public function onInit()
    {
        echo 'I am running during init' . PHP_EOL;
    }
    
    public function onPostDispatch()
    {
        echo 'I am running during post-dispatch' . PHP_EOL;
    }
}