<?php

namespace Internal\Usecase;

use Swoole\WebSocket\Server;
use Internal\Contract\Context;

class WebSocket extends Server
{
    /**
     * @var Context
     */
    private $context;
    private static $instance;

    const ONSTART   = "start";
    const ONOPEN    = "open";
    const ONCLOSE   = "close";
    const ONMESSAGE = "message";

    public static function initWebSocket(
        string $host,
        int $port,
        Context $context
    ) {
        if (empty(self::$instance)) {
            self::$instance = new self($host, $port);
            self::$instance->setContext($context);
        }

        return self::$instance;
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
}
