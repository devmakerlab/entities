<?php

namespace Tests\Artifacts;

use DevMakerLab\Entity;

class Hooman extends Entity
{
    public string $name;
    public int $age;
    public string $job;
    public ?string $country = null;
}
