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

        $hooman = new Hooman($attributes);

        $this->assertInstanceOf(Entity::class, $hooman);
        $this->assertEquals($attributes['name'], $hooman->name);
        $this->assertEquals($attributes['age'], $hooman->age);
        $this->assertEquals($attributes['job'], $hooman->job);
        $this->assertEquals(null, $hooman->country);
        $this->assertObjectNotHasAttribute('nickname', $hooman);
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

        $hooman = new Hooman($attributes);

        $this->assertInstanceOf(Entity::class, $hooman);

        $oneYearLater = [
            'age' => 25,
            'job' => 'Alchemist',
            'nickname' => "Cap 'n Cook",
        ];

        $hooman->update($oneYearLater);

        $this->assertObjectNotHasAttribute('nickname', $hooman);
        $this->assertEquals($oneYearLater['age'], $hooman->age);
        $this->assertEquals($oneYearLater['job'], $hooman->job);
        $this->assertEquals($attributes['name'], $hooman->name);
    }
}
