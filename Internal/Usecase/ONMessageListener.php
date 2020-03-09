<?php

namespace Internal\Usecase;

class ONMessageListener implements \Internal\Contract\Event
{
    public function listen(\Internal\Usecase\WebSocket $ws, \Swoole\WebSocket\Frame $frame)
    {
        $context = $ws->getContext();
        $context->set("onmessage:fd", $frame->fd);

        echo "received message: {$frame->data}\n";

        //reply client message
        $ws->push($frame->fd, json_encode(["hello", time()]));
    }
}
