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
        $this->setAttributes($attributes);
    }

    /**
     * True if an entity is consistent
     *
     * @return bool
     */
    abstract public function isConsistent();

    /**
     * Update an entity's attributes
     * It ignores unknown attributes
     *
     * @param array $attributes
     */
    public function update(array $attributes)
    {
        $this->setAttributes($attributes);
    }

    /**
     * Set entity's attributes
     *
     * @param array $attributes
     */
    private function setAttributes(array $attributes)
    {
        foreach (get_object_vars($this) as $key => $value) {
            $this->$key = isset($attributes[$key]) ? $attributes[$key] : $this->$key;
        }
    }
}
