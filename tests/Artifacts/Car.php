<?php

namespace Tests\Artifacts;

use DevMakerLab\Entity;

class Car extends Entity
{
    public string $name;
    public Hooman $owner;
}
