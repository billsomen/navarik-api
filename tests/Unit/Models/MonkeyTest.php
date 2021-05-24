<?php

namespace Models;

use App\Models\Monkey;
use PHPUnit\Framework\TestCase;

class MonkeyTest extends TestCase
{

    public function test__construct()
    {
        $animal = new Monkey();
        $deadAnimal = new Monkey(.2, false);

        $this->assertEquals(1.0, $animal->isAlive());
        $this->assertEquals(.3, $animal->getHealthLimitToLive());
        $this->assertEquals(.3, $animal->getHealthLimitToWalk());
        $this->assertTrue($animal->isAlive());
        $this->assertFalse($deadAnimal->isAlive());
    }

    public function testReduceHealth()
    {
        $animal = new Monkey();
        $animal->reduceHealth(.1);

        $this->assertEquals(.9, $animal->getHealth());
        $this->assertTrue($animal->isAlive());

        $animal->reduceHealth(.8);
        $this->assertEquals(.1, $animal->getHealth());
        $this->assertFalse($animal->isAlive());
    }
}
