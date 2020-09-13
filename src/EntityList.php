<?php

namespace Entities;

use Countable;
use ArrayAccess;
use ArrayIterator;
use IteratorAggregate;

abstract class EntityList implements Countable, ArrayAccess, IteratorAggregate
{
    protected array $entities = [];

    protected string $expectedType;

    public function __construct(array $entities)
    {
        foreach ($entities as $entity) {
            if ($this->hasExceptedType($entity)) {
                $this->entities[] = $entity;

                continue;
            }

            throw new UnexpectedEntityException();
        }
    }

    public function getConsistentEntities(): self
    {
        if ($this->notUseConsistency()) {
            return $this;
        }

        $consistentEntities = array_filter($this->entities, function (Entity $entity) {
            return $entity->isConsistent();
        });

        return new static($consistentEntities);
    }

    public function getInconsistentEntities(): self
    {
        if ($this->notUseConsistency()) {
            return new static([]);
        }

        $inconsistentEntities = array_filter($this->entities, function (Entity $entity) {
            return ! $entity->isConsistent();
        });

        return new static($inconsistentEntities);
    }

    protected function hasExceptedType(Entity $entity): bool
    {
        return $entity instanceof $this->expectedType;
    }

    protected function notUseConsistency(): bool
    {
        return ! in_array(Consistency::class, class_uses($this->expectedType), true);
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->entities);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->entities[$offset];
    }

    /**
     * @param mixed $offset
     * @param $entity
     * @throws \Entities\UnexpectedEntityException
     */
    public function offsetSet($offset, $entity)
    {
        if (! $this->hasExceptedType($entity)) {
            throw new UnexpectedEntityException();
        }

        if (is_null($offset)) {
            $this->entities[] = $entity;
        } else {
            $this->entities[$offset] = $entity;
        }
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->entities[$offset]);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->entities);
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->entities);
    }
}
