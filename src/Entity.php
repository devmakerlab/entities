<?php

namespace DevMakerLab;

use ArrayAccess;

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
        $attributes = [];

        foreach (get_object_vars($this) as $key => $value) {
            if ($value instanceof Entity) {
                $attributes[$key] = $value->toArray();

                continue;
            }

            if ($this->isTraversable($value)) {
                $attributes[$key] = array_map(function ($row) {
                    if ($row instanceof Entity) {
                        return $row->toArray();
                    }

                    return $row;
                }, $value);

                continue;
            }

            $attributes[$key] = $value;
        }

        return $attributes;
    }

    public function toJson(int $options = 0): string
    {
        return json_encode($this->toArray(), $options);
    }

    protected function setAttributes(array $attributes): void
    {
        foreach (get_class_vars(static::class) as $key => $value) {
            if (isset($attributes[$key])) {
                $this->$key = $attributes[$key];
            }
        }
    }

    protected function isTraversable($value): bool
    {
        return is_array($value) || $value instanceof ArrayAccess;
    }
}
