<?php

namespace Tests;

use Tests\Artifacts\SuperCat;
use Entities\ConsistentEntity;
use PHPUnit\Framework\TestCase;
use Entities\Exceptions\UnconsistentEntityException;

class ConsistentEntityTest extends TestCase
{
    /** @test */
    public function cant_make_unconsistent_entity()
    {
        $attributes = [
            'name' => 'Not a super cat',
        ];

        $this->expectException(UnconsistentEntityException::class);

        $cat = new SuperCat($attributes);
    }

    /** @test */
    public function can_make_consistent_entity()
    {
        $attributes = [
            'name' => 'Grumpy Cat',
            'power' => 'Grumpy',
        ];

        $cat = new SuperCat($attributes);

        $this->assertInstanceOf(ConsistentEntity::class, $cat);
        $this->assertEquals($attributes['name'], $cat->name);
        $this->assertEquals($attributes['power'], $cat->power);
    }
}
