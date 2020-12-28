<?php

namespace Tests\Artifacts;

use Entities\ConsistentEntityList;

class Pantheon extends ConsistentEntityList
{
    protected string $expectedType = God::class;
}
