<?php

namespace Tests;

use Tests\Artifacts\God;
use Tests\Artifacts\Hooman;
use Tests\Artifacts\Pantheon;
use PHPUnit\Framework\TestCase;
use Entities\Exceptions\UnexpectedEntityException;

class ConsistentEntityListTest extends TestCase
{
    /** @test */
    public function can_make_a_expected_entity_list()
    {
        $god = new God(['name' => 'Hades']);

        $pantheon = new Pantheon([$god]);

        $this->assertCount(1, $pantheon);
        $this->assertContains($god, $pantheon);
    }

    /** @test */
    public function cant_make_an_unexpected_entity_list()
    {
        $hooman = new Hooman(['name' => 'John']);

        $this->expectException(UnexpectedEntityException::class);

        $pantheon = new Pantheon([$hooman]);
    }

    /** @test */
    public function can_add_expected_entity()
    {
        $god = new God(['name' => 'Ares']);

        $pantheon = new Pantheon([]);

        $pantheon[] = $god;

        $this->assertCount(1, $pantheon);
        $this->assertContains($god, $pantheon);
    }

    /** @test */
    public function cant_add_unexpected_entity()
    {
        $hooman = new Hooman(['name' => 'John']);

        $pantheon = new Pantheon([]);

        $this->expectException(UnexpectedEntityException::class);

        $pantheon[] = $hooman;
    }
}
