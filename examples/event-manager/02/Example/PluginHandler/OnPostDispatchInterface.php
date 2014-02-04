<?php

namespace Example\PluginHandler;

interface OnPostDispatchInterface extends PluginHandlerInterface
{
    public function onPostDispatch();
}