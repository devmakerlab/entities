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
            $this->push($entity);
        }
    }

    public function push(Entity $entity, $offset = null): void
    {
        if (is_null($offset)) {
            $this->entities[] = $entity;
        } else {
            $this->entities[$offset] = $entity;
        }
    }

    public function toArray(): array
    {
        return $this->entities;
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
     * @throws \Entities\Exceptions\UnexpectedEntityException
     */
    public function offsetSet($offset, $entity)
    {
        $this->push($entity);
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
