<?php

namespace Internal\Usecase;

class ONOpenListener implements \Internal\Contract\Event
{
    public function listen(\Internal\Usecase\WebSocket $ws, \Swoole\Http\Request $request)
    {
        $context = $ws->getContext();
        $context->set("onopen:fd", $request->fd);
        echo "connection open: {$request->fd}\n";
    }
}
