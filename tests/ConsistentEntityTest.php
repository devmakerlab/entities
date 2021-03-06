<?php

namespace Tests;

use Tests\Artifacts\SuperCat;
use DevMakerLab\ConsistentEntity;
use PHPUnit\Framework\TestCase;
use DevMakerLab\Exceptions\UnconsistentEntityException;

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

        $attributes = [
            'name' => 'Not a super cat',
            'power' => 'Sleep',
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
            'age' => 20,
        ];

        $cat = new SuperCat($attributes);

        $this->assertInstanceOf(ConsistentEntity::class, $cat);
        $this->assertEquals($attributes['name'], $cat->name);
        $this->assertEquals($attributes['power'], $cat->power);
    }
}
