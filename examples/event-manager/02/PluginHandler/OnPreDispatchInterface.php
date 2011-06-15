<?php

namespace Example\PluginHandler;

interface OnPreDispatchInterface extends PluginHandlerInterface
{
    public function onPreDispatch();
}