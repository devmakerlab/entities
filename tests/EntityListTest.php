<?php

namespace Tests;

use DevMakerLab\Entity;
use DevMakerLab\EntityList;
use Tests\Artifacts\Hooman;
use Tests\Artifacts\People;
use PHPUnit\Framework\TestCase;

class EntityListTest extends TestCase
{
    /** @test */
    public function can_make_entitylist()
    {
        $entityJohn = new Hooman([
            'name' => 'John',
        ]);

        $entityBob = new Hooman([
            'name' => 'Bob',
        ]);

        $entityList = new People([$entityJohn]);

        $entityList[] = $entityBob;

        $this->assertInstanceOf(EntityList::class, $entityList);
        $this->assertCount(2, $entityList);
        $this->assertContains($entityBob, $entityList);
        $this->assertContains($entityJohn, $entityList);
        $this->assertCount(2, $entityList->all());
    }

    /** @test */
    public function can_add_entity()
    {
        $firstEntity = new Hooman([
            'name' => 'First',
            'age' => 25,
        ]);

        $secondEntity = new Hooman([
            'name' => 'Second',
            'age' => 25,
        ]);

        $thirdEntity = new Hooman([
            'name' => 'Third',
            'age' => 25,
        ]);

        $entityList = new People([$firstEntity]);

        $entityList[] = $secondEntity;
        $entityList[2] = $thirdEntity;

        $this->assertCount(3, $entityList);
        $this->assertContains($firstEntity, $entityList);
        $this->assertContains($secondEntity, $entityList);
        $this->assertContains($thirdEntity, $entityList);
    }

    /** @test */
    public function can_remove_entity()
    {
        $entity = new Hooman([
            'name' => 'First',
            'age' => 25,
        ]);

        $entityList = new People([$entity]);

        unset($entityList[0]);

        $this->assertCount(0, $entityList);
    }

    /** @test */
    public function can_check_entity()
    {
        $entity = new Hooman([
            'name' => 'First',
            'age' => 25,
        ]);

        $entityList = new People([]);

        $this->assertFalse(isset($entityList[0]));

        $entityList[] = $entity;

        $this->assertTrue(isset($entityList[0]));
    }

    /** @test */
    public function can_get_entity()
    {
        $entity = new Hooman([
            'name' => 'First',
            'age' => 25,
        ]);

        $entityList = new People([$entity]);

        $entityGrab = $entityList[0];

        $this->assertEquals($entity, $entityGrab);
    }

    /** @test */
    public function can_convert_entitylist_to_array()
    {
        $entities = [
            new Hooman(['name' => 'First', 'age' => 25]),
            new Hooman(['name' => 'Second', 'age' => 12]),
        ];

        $people = new People($entities);

        $expected = [
            ['name' => 'First', 'age' => 25, 'country' => null],
            ['name' => 'Second', 'age' => 12, 'country' => null],
        ];

        $this->assertEquals($expected, $people->toArray());
    }

    /** @test */
    public function can_convert_entitylist_to_json()
    {
        $entities = [
            new Hooman(['name' => 'First', 'age' => 25]),
            new Hooman(['name' => 'Second', 'age' => 12]),
        ];

        $people = new People($entities);

        $expected = '[{"name":"First","age":25,"country":null},{"name":"Second","age":12,"country":null}]';

        $this->assertEquals($expected, $people->toJson());
    }

    /** @test */
    public function can_get_specific_entity_property()
    {
        $entities = [
            new Hooman(['name' => 'First', 'age' => 25]),
            new Hooman(['name' => 'Second', 'age' => 12]),
        ];

        $people = new People($entities);

        $expected = [
            ['name' => 'First'],
            ['name' => 'Second'],
        ];

        $this->assertEquals($expected, $people->only('name'));
    }

    /** @test */
    public function can_sort_by_entity_property()
    {
        $people = new People([
            new Hooman(['name' => 'First', 'age' => 25]),
            new Hooman(['name' => 'Second', 'age' => 12]),
        ]);

        $expected = new People([
            new Hooman(['name' => 'Second', 'age' => 12]),
            new Hooman(['name' => 'First', 'age' => 25]),
        ]);

        $this->assertEquals($expected, $people->sortBy('age'));
    }

    /** @test */
    public function can_filter_list_using_callback()
    {
        $people = new People([
            $adult = new Hooman(['name' => 'First', 'age' => 25]),
            new Hooman(['name' => 'Second', 'age' => 12]),
        ]);

        $callback = function (Hooman $entity) {
            if ($entity->age > 21) {
                return $entity->age;
            }
        };

        $filteredPeople = $people->filter($callback);

        $this->assertEquals($filteredPeople, [$adult]);
    }

    /** @test */
    public function can_filter_using_key_value()
    {
        $adultAge = 21;

        $people = new People([
            $adult = new Hooman(['name' => 'First', 'age' => 21]),
            new Hooman(['name' => 'Second', 'age' => 12]),
        ]);

        $filteredPeople = $people->filter('age', $adultAge);

        $this->assertEquals($filteredPeople, [$adult]);
    }

    /** @test */
    public function can_pluck_all_entity_property()
    {
        $firstName = 'First';
        $secondName = 'Second';

        $people = new People([
            new Hooman(['name' => $firstName, 'age' => 25]),
            new Hooman(['name' => $secondName, 'age' => 12]),
        ]);

        $peopleNames = $people->pluck('name');

        $this->assertEquals($peopleNames, [$firstName, $secondName]);
    }

    /** @test */
    public function can_group_by_entity_property()
    {
        $grandPaAge = 82;
        $adultAge = 21;
        $babyAge = 3;

        $grandPaHooman = new Hooman(['name' => 'Adult', 'age' => $grandPaAge]);
        $adultHooman = new Hooman(['name' => 'Adult', 'age' => $adultAge]);
        $babyHooman = new Hooman(['name' => 'Baby', 'age' => $babyAge]);

        $people = new People([
            $grandPaHooman,
            $adultHooman,
            $adultHooman,
            $babyHooman,
        ]);

        $groupedPeopleByAge = $people->groupBy('age');

        $family = [
            $grandPaAge => [$grandPaHooman],
            $adultAge => [$adultHooman, $adultHooman],
            $babyAge => [$babyHooman]
        ];

        $this->assertEquals($groupedPeopleByAge, $family);
    }
}
