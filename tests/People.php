<?php

namespace Tests;

use Entities\Entity;
use Entities\EntityList;

class People extends EntityList
{
    /**
     * True if given entity has expected type
     *
     * @param \Entities\Entity $entity
     * @return bool
     */
    protected function hasExceptedType(Entity $entity)
    {
        return $entity instanceof Hooman;
    }
}
