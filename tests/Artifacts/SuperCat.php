<?php

namespace Tests\Artifacts;

use Entities\Entity;
use Entities\Consistency;

class SuperCat extends Entity
{
    use Consistency;

    public $name;
    public $power;
}
