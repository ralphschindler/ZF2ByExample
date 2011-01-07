<?php

namespace ZF2ByExample\SignalSlot\Ex02\PluginHandler;

interface OnPostDispatchInterface extends PluginHandlerInterface
{
    public function onPostDispatch();
}