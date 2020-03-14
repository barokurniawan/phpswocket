<?php

namespace Internal\Contract;

interface SocketListener
{
    public function onStartListener(Event $event);

    public function onCloseListener(Event $event);

    public function onOpenListener(Event $event);

    public function onMessageListener(Event $event);

    /**
     * listen to http request
     */
    public function onRequestListener(Event $event);

    public function map(string $key, Event $event);

    /**
     * @return Event[]
     */
    public function getListeners();
}
