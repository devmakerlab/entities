<?php

namespace Tests\Artifacts;

use Entities\EntityList;

class People extends EntityList
{
    protected string $expectedType = Hooman::class;
}
