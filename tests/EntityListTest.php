<?php

namespace Tests;

use Entities\EntityList;
use Tests\Artifacts\Hooman;
use Tests\Artifacts\People;
use PHPUnit\Framework\TestCase;

class EntityListTest extends TestCase
{
    /** @test */
    public function can_make_entity_list()
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
        $this->assertCount(2, $entityList->toArray());
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
}
