<?php

namespace Tests;

use Entities\Entity;
use Tests\Artifacts\Hooman;
use PHPUnit\Framework\TestCase;
use Tests\Artifacts\SuperCat;

class EntityTest extends TestCase
{
    /** @test */
    public function can_make_an_entity()
    {
        $attributes = [
            'name' => 'Walter Hartwell White',
            'age' => 50,
            'job' => 'Alchemist',
            'nickname' => 'Heisenberg',
        ];

        $entity = new Hooman($attributes);

        $this->assertInstanceOf(Entity::class, $entity);
        $this->assertEquals($attributes['name'], $entity->name);
        $this->assertEquals($attributes['age'], $entity->age);
        $this->assertEquals($attributes['job'], $entity->job);
        $this->assertNull($entity->country);
        $this->assertObjectNotHasAttribute('nickname', $entity);
    }

    /** @test */
    public function can_make_a_consistent_entity()
    {
        $attributes = [
            'name' => 'Grumpy Cat',
            'power' => 'Grumpy',
        ];

        $entity = new SuperCat($attributes);

        $this->assertInstanceOf(Entity::class, $entity);
        $this->assertEquals($attributes['name'], $entity->name);
        $this->assertEquals($attributes['power'], $entity->power);
        $this->assertTrue($entity->isConsistent());

        $attributes = [
            'name' => 'Not a super cat',
        ];

        $entity = new SuperCat($attributes);

        $this->assertFalse($entity->isConsistent());
    }
}
