<?php

namespace Tests\Artifacts;

use Entities\ConsistentEntityList;

class Pantheon extends ConsistentEntityList
{
    protected string $entity = God::class;
}
