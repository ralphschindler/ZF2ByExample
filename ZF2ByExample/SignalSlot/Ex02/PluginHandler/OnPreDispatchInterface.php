<?php

namespace ZF2ByExample\SignalSlot\Ex02\PluginHandler;

interface OnPreDispatchInterface extends PluginHandlerInterface
{
    public function onPreDispatch();
}