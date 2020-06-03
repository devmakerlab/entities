<?php

namespace Tests\Artifacts;

use Entities\Entity;

class Hooman extends Entity
{
    public $name;
    public $age;
    public $job;
    public $country;

    public function isConsistent()
    {
        return ! is_null($this->name) && ! is_null($this->age);
    }
}
