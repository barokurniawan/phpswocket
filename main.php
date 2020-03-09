<?php

use Internal\Usecase\Context;
use Internal\Usecase\WebSocket;

require_once __DIR__ . "/vendor/autoload.php";

$ws = WebSocket::initWebSocket(
    "127.0.0.1",
    3000,
    new Context
);

$ws->on(WebSocket::ONSTART, function (\Internal\Usecase\WebSocket $ws) {
    $context = $ws->getContext();
    $context->set("hmm", $ws->host);

    echo "served: ws://{$ws->host}:{$ws->port} \n";
});

$ws->on(WebSocket::ONOPEN, function (\Internal\Usecase\WebSocket $ws, Swoole\Http\Request $request) {
    $context = $ws->getContext();
    $context->set("asd", $request->fd);

    echo "connection open: {$request->fd}\n";
});

$ws->on(WebSocket::ONMESSAGE, function (\Internal\Usecase\WebSocket $ws, Swoole\WebSocket\Frame $frame) {
    $context = $ws->getContext();
    $context->set("fsvc", $frame->fd);
    echo "received message: {$frame->data}\n";
    $ws->push($frame->fd, json_encode(["hello", time()]));
});

$ws->on(WebSocket::ONCLOSE, function (\Internal\Usecase\WebSocket $ws, int $fd) {
    echo "Good bye: {$fd}\n";
});

$ws->start();
