<?php

use M1\Env\Parser;
use Internal\Usecase\Context;
use Internal\Usecase\ONRequest;
use Internal\Usecase\WebSocket;
use Internal\Usecase\ONOpenListener;
use Internal\Usecase\SocketListener;
use Internal\Usecase\ONCloseListener;
use Internal\Usecase\ONStartListener;
use Internal\Usecase\ONMessageListener;

require_once __DIR__ . "/vendor/autoload.php";

$env = Parser::parse(file_get_contents(".env"));
$socketListener = SocketListener::newSocketListener();
$socketListener->onStartListener(new ONStartListener);
$socketListener->onOpenListener(new ONOpenListener);
$socketListener->onMessageListener(new ONMessageListener);
$socketListener->onCloseListener(new ONCloseListener);
$socketListener->onRequestListener(new ONRequest);

/**
 * form user
 * 
 * form master ODT
 */

$ws = WebSocket::initWebSocket(
    $env['SERVER_ADDR'],
    $env['SERVER_PORT'],
    new Context,
    $socketListener
);

$ws->serve();
