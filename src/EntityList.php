<?php

namespace Entities;

use Countable;
use ArrayAccess;
use ArrayIterator;
use IteratorAggregate;

abstract class EntityList implements Countable, ArrayAccess, IteratorAggregate
{
    /**
     * @var array
     */
    protected $entities = [];

    /**
     * @var string
     */
    protected $expectedType;

    /**
     * EntityList constructor.
     *
     * @param array $entities
     * @throws \Entities\UnexpectedEntityException
     */
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

    /**
     * True if given entity has expected type
     *
     * @param \Entities\Entity $entity
     * @return bool
     */
    protected function hasExceptedType(Entity $entity)
    {
        return $entity instanceof $this->expectedType;
    }

    /**
     * Filter entities who's not consistent
     *
     * @return self
     */
    public function getConsistentEntities()
    {
        $consistentEntities = array_filter($this->entities, function (Entity $entity) {
            return $entity->isConsistent();
        });

        return new static($consistentEntities);
    }

    /**
     * Filter entities who's consistent
     *
     * @return self
     */
    public function getInconsistentEntities()
    {
        $inconsistentEntities = array_filter($this->entities, function (Entity $entity) {
            return ! $entity->isConsistent();
        });

        return new static($inconsistentEntities);
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
