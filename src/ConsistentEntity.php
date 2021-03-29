<?php

namespace DevMakerLab;

use DevMakerLab\Exceptions\UnconsistentEntityException;
use ReflectionProperty;

abstract class ConsistentEntity extends Entity
{
    protected function setAttributes(array $attributes): void
    {
        parent::setAttributes($attributes);

        if (! $this->isConsistent()) {
            throw new UnconsistentEntityException();
        }
    }

    protected function isConsistent(): bool
    {
        foreach (get_class_vars(get_class($this)) as $key => $value) {
            $property = new ReflectionProperty($this, $key);
            if (! $property->isInitialized($this) || is_null($this->$key)) {
                return false;
            }
        }

        return true;
    }
}
