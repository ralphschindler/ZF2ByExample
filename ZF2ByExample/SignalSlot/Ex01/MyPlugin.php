<?php

namespace ZF2ByExample\SignalSlot\Ex01;

class MyPlugin
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