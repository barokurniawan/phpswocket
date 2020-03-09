<?php

namespace Internal\Contract;

interface Context
{
    public function get(string $key);

    public function set(string $key, $value);

    public function all();
}
