<?php

namespace Entities;

abstract class Entity
{
    public function __construct(array $attributes)
    {
        foreach (get_object_vars($this) as $key => $value) {
            $this->$key = isset($attributes[$key]) ? $attributes[$key] : null;
        }
    }
}
