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

    protected function setAttributes(array $attributes): void
    {
        foreach (get_class_vars(static::class) as $key => $value) {
            $this->$key = isset($attributes[$key]) ? $attributes[$key] : $this->$key;
        }
    }
}
