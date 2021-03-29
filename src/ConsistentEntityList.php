<?php

namespace DevMakerLab;

use DevMakerLab\Exceptions\UnexpectedEntityException;

abstract class ConsistentEntityList extends EntityList
{
    protected string $entity;

    public function add(Entity $entity, $offset = null): void
    {
        if ($this->hasUnexpectedType($entity)) {
            throw new UnexpectedEntityException();
        }

        parent::add($entity, $offset);
    }

    protected function hasUnexpectedType(Entity $entity): bool
    {
        return ! $entity instanceof $this->entity;
    }
}
