<?php

namespace Entities;

use Entities\Exceptions\UnconsistentEntityException;

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
        foreach (get_object_vars($this) as $key => $value) {
            if (is_null($this->$key)) {
                return false;
            }
        }

        return true;
    }
}
