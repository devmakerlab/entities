<?php

namespace Tests\Artifacts;

use DevMakerLab\ConsistentEntity;

class SuperCat extends ConsistentEntity
{
    public string $name;
    public string $power;
    public ?int $age = null;
}
