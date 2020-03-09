<?php

namespace Internal\Usecase;

class Context implements \Internal\Contract\Context
{
    private $bucket = [];

    public function get(string $key)
    {
        return $this->bucket[$key];
    }

    public function set(string $key, $value)
    {
        $this->bucket[$key] = $value;
        return $this;
    }

    public function all()
    {
        return $this->bucket;
    }
}
