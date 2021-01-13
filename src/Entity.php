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

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    protected function setAttributes(array $attributes): void
    {
        foreach (get_class_vars(static::class) as $key => $value) {
            if (isset($attributes[$key])) {
                $this->$key = $attributes[$key];
            }
        }
    }
}
