<?php

namespace Tests;

use Entities\Entity;

class God extends Entity
{
    public $name;

    public function isConsistent()
    {
        return ! is_null($this->name);
    }
}
