<?php

namespace Tests\Artifacts;

use Entities\Entity;

class Car extends Entity
{
    public string $name;
    public Hooman $owner;
}
