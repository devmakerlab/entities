<?php

namespace Entities;

use Entities\Exceptions\UnexpectedEntityException;

abstract class ConsistentEntityList extends EntityList
{
    protected string $expectedType;

    public function push(Entity $entity, $offset = null): void
    {
        if ($this->hasUnexpectedType($entity)) {
            throw new UnexpectedEntityException();
        }

        parent::push($entity, $offset);
    }

    protected function hasUnexpectedType(Entity $entity): bool
    {
        return ! $entity instanceof $this->expectedType;
    }
}
