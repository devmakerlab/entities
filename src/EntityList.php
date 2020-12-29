<?php

namespace Entities;

use Countable;
use ArrayAccess;
use ArrayIterator;
use IteratorAggregate;

abstract class EntityList implements Countable, ArrayAccess, IteratorAggregate
{
    protected array $entities = [];

    public function __construct(array $entities)
    {
        foreach ($entities as $entity) {
            $this->add($entity);
        }
    }

    public function add(Entity $entity, $offset = null): void
    {
        if (is_null($offset)) {
            $this->entities[] = $entity;
        } else {
            $this->entities[$offset] = $entity;
        }
    }

    public function all(): array
    {
        return $this->entities;
    }

    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->entities);
    }

    public function offsetGet($offset)
    {
        return $this->entities[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->add($value, $offset);
    }

    public function offsetUnset($offset)
    {
        unset($this->entities[$offset]);
    }

    public function count(): int
    {
        return count($this->entities);
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->entities);
    }
}
