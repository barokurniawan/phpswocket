<?php

namespace Internal\Usecase;

use Swoole\WebSocket\Server;
use Internal\Contract\Context;
use Internal\Contract\SocketListener;

class WebSocket extends Server
{
    /**
     * @var Context
     */
    private $context;

    /**
     * @var SocketListener
     */
    private $listener;

    private static $instance;

    const ONSTART   = "start";
    const ONOPEN    = "open";
    const ONCLOSE   = "close";
    const ONMESSAGE = "message";
    const ONREQUEST = "request";

    public static function initWebSocket(
        string $host,
        int $port,
        Context $context,
        SocketListener $socketListener
    ) {
        if (empty(self::$instance)) {
            self::$instance = new self($host, $port);
            self::$instance->setContext($context);
            self::$instance->setListener($socketListener);
        }

        return self::$instance;
    }

    public function serve()
    {
        foreach ($this->listener->getListeners() as $key => $event) {
            $this->on($key, function (...$args) use ($event) {
                $event->listen(...$args);
            });
        }

        return $this->start();
    }

    /**
     * Get the value of context
     *
     * @return Context
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * Set the value of context
     *
     * @param   Context  $context  
     *
     * @return  self
     */
    private function setContext(Context $context)
    {
        $this->context = $context;

        return $this;
    }

    /**
     * Get the value of listener
     *
     * @return SocketListener
     */
    public function getListener()
    {
        return $this->listener;
    }

    /**
     * Set the value of listener
     *
     * @param   SocketListener  $listener  
     *
     * @return  self
     */
    public function setListener(SocketListener $listener)
    {
        $this->listener = $listener;

        return $this;
    }
}
