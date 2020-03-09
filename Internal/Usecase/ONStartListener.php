<?php

namespace Internal\Usecase;

class ONStartListener implements \Internal\Contract\Event
{
    public function listen(\Internal\Usecase\WebSocket $ws)
    {
        $context = $ws->getContext();
        $context->set("host", $ws->host);
        echo "served: ws://{$ws->host}:{$ws->port} \n";
    }
}
