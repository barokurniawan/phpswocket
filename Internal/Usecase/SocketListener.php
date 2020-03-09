<?php

namespace Internal\Usecase;

use Internal\Contract\Event;

class SocketListener implements \Internal\Contract\SocketListener
{
    private static $instance;
    private $mapListener = [];

    public static function newSocketListener()
    {
        if (empty(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function onStartListener(Event $event)
    {
        $this->map(WebSocket::ONSTART, $event);
    }

    public function onCloseListener(Event $event)
    {
        $this->map(WebSocket::ONCLOSE, $event);
    }

    public function onOpenListener(Event $event)
    {
        $this->map(WebSocket::ONOPEN, $event);
    }

    public function onMessageListener(Event $event)
    {
        $this->map(WebSocket::ONMESSAGE, $event);
    }

    public function map(string $key, Event $event)
    {
        $this->mapListener[$key] = $event;
        return $this;
    }

    /**
     * @return Event[]
     */
    public function getListeners()
    {
        return $this->mapListener;
    }
}
