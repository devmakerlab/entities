<?php

namespace Tests\Artifacts;

use Entities\Entity;

class Hooman extends Entity
{
    public string $name;
    public int $age;
    public string $job;
    public ?string $country = null;
}
