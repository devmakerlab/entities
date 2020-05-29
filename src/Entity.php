<?php

namespace Entities;

abstract class Entity
{
    /**
     * Entity constructor.
     * 
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        foreach (get_object_vars($this) as $key => $value) {
            $this->$key = isset($attributes[$key]) ? $attributes[$key] : null;
        }
    }

    /**
     * True if an entity is consistent
     *
     * @return bool
     */
    abstract public function isConsistent();
}
