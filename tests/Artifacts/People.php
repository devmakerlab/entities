<?php

namespace Tests\Artifacts;

use Entities\EntityList;

class People extends EntityList
{
    /**
     * @var string
     */
    protected $expectedType = Hooman::class;
}
