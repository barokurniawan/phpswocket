<?php

namespace Internal\Usecase;

class ONRequest implements \Internal\Contract\Event
{
    public function listen(\Swoole\Http\Request $request, \Swoole\Http\Response $response)
    {
        $response->header("Content-Type", "text/plain");
        $response->end("Hello World\n");
    }
}
