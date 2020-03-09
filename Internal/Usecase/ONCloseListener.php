<?php

namespace Internal\Usecase;

class ONCloseListener implements \Internal\Contract\Event
{
    public function listen(\Internal\Usecase\WebSocket $ws, int $fd)
    {
        $context = $ws->getContext();
        print_r($context->all());

        echo "Good bye: {$fd}\n";
    }
}
