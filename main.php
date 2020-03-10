<?php

use Internal\Usecase\Context;
use Internal\Usecase\ONRequest;
use Internal\Usecase\WebSocket;
use Internal\Usecase\ONOpenListener;
use Internal\Usecase\SocketListener;
use Internal\Usecase\ONCloseListener;
use Internal\Usecase\ONStartListener;
use Internal\Usecase\ONMessageListener;

require_once __DIR__ . "/vendor/autoload.php";

$socketListener = SocketListener::newSocketListener();
$socketListener->onStartListener(new ONStartListener);
$socketListener->onOpenListener(new ONOpenListener);
$socketListener->onMessageListener(new ONMessageListener);
$socketListener->onCloseListener(new ONCloseListener);
$socketListener->onRequestListener(new ONRequest);

$ws = WebSocket::initWebSocket(
    "127.0.0.1",
    3000,
    new Context,
    $socketListener
);

$ws->serve();
