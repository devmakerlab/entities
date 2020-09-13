<?php

namespace Tests;

use Entities\Entity;
use Tests\Artifacts\Hooman;
use PHPUnit\Framework\TestCase;

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
        $this->assertTrue($entity->isConsistent());
    }

    /** @test */
    public function can_have_an_inconsistent_entity()
    {
        $attributes = [
            'name' => 'Casper',
        ];

        $entity = new Hooman($attributes);

        $this->assertInstanceOf(Entity::class, $entity);
        $this->assertFalse($entity->isConsistent());
    }

    /** @test */
    public function can_update_an_entity()
    {
        $attributes = [
            'name' => 'Jesse Bruce Pinkman',
            'age' => 24,
            'job' => 'Dealer',
            'nickname' => 'none',
        ];

        $entity = new Hooman($attributes);

        $this->assertInstanceOf(Entity::class, $entity);

        $oneYearLater = [
            'age' => 25,
            'job' => 'Alchemist',
            'nickname' => 'Cap \'n Cook',
        ];

        $entity->update($oneYearLater);

        $this->assertObjectNotHasAttribute('nickname', $entity);
        $this->assertEquals($oneYearLater['age'], $entity->age);
        $this->assertEquals($oneYearLater['job'], $entity->job);
        $this->assertEquals($attributes['name'], $entity->name);
    }
}
