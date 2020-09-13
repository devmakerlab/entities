<?php

namespace Entities;

abstract class Entity
{
    public function __construct(array $attributes)
    {
        $this->setAttributes($attributes);
    }

    public function update(array $attributes): void
    {
        $this->setAttributes($attributes);
    }

    private function setAttributes(array $attributes): void
    {
        foreach (get_object_vars($this) as $key => $value) {
            $this->$key = isset($attributes[$key]) ? $attributes[$key] : $this->$key;
        }
    }
}
