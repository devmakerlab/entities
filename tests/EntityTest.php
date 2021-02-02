<?php

namespace Tests;

use Entities\Entity;
use Tests\Artifacts\Car;
use Tests\Artifacts\Hooman;
use PHPUnit\Framework\TestCase;
use Tests\Artifacts\Train;

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

    /** @test */
    public function can_convert_an_entity_to_array()
    {
        $properties = [
            'name' => 'Bobby',
            'age' => 17,
            'country' => 'Quebec',
        ];

        $bob = new Hooman($properties);

        $this->assertEquals($properties, $bob->toArray());
    }

    /** @test */
    public function can_have_an_entiy_depending_to_another()
    {
        $jacky = new Hooman(['name' => 'Jacky', 'age' => 42]);
        $car = new Car(['name' => 'Renault Tuning', 'owner' => $jacky]);

        $this->assertEquals($jacky, $car->owner);
    }

    /** @test */
    public function can_convert_an_entity_with_dependencies_to_array()
    {
        $jacky = new Hooman(['name' => 'Jacky', 'age' => 42]);
        $car = new Car(['name' => 'Renault Tuning', 'owner' => $jacky]);

        $expected = [
            'name' => 'Renault Tuning',
            'owner' => [
                'name' => 'Jacky',
                'age' => 42,
                'country' => null,
            ],
        ];

        $this->assertEquals($expected, $car->toArray());
    }

    /** @test */
    public function can_convert_an_entity_to_json()
    {
        $properties = [
            'name' => 'Bobby',
            'age' => 17,
            'country' => 'Quebec',
        ];

        $bob = new Hooman($properties);

        $expected = '{"name":"Bobby","age":17,"country":"Quebec"}';

        $this->assertEquals($expected, $bob->toJson());
    }

    /** @test */
    public function can_convert_an_entity_with_dependencies_to_json()
    {
        $jacky = new Hooman(['name' => 'Jacky', 'age' => 42]);
        $car = new Car(['name' => 'Renault Tuning', 'owner' => $jacky]);

        $expected = '{"name":"Renault Tuning","owner":{"name":"Jacky","age":42,"country":null}}';

        $this->assertEquals($expected, $car->toJson());
    }

    /** @test */
    public function can_convert_an_entity_depending_to_others_in_array()
    {
        $passengers = [
            new Hooman(['name' => 'Jacky', 'age' => 42]),
            new Hooman(['name' => 'Dora', 'age' => 31]),
        ];

        $train = new Train(['name' => 'TGV 8874', 'passengers' => $passengers]);

        $expected = [
            'name' => 'TGV 8874',
            'passengers' => [
                [
                    'name' => 'Jacky',
                    'age' => 42,
                    'country' => null,
                ],
                [
                    'name' => 'Dora',
                    'age' => 31,
                    'country' => null,
                ],
            ],
        ];

        $this->assertEquals($expected, $train->toArray());
    }
}
