<?php

namespace Models;

use App\Models\Elephant;
use PHPUnit\Framework\TestCase;

class ElephantTest extends TestCase
{

    public function test__construct()
    {
        $animal = new Elephant();
        $deadAnimal = new Elephant(.5, false);

        $this->assertEquals(1.0, $animal->isAlive());
        $this->assertEquals(.7, $animal->getHealthLimitToLive());
        $this->assertEquals(.7, $animal->getHealthLimitToWalk());
        $this->assertTrue($animal->isAlive());
        $this->assertFalse($deadAnimal->isAlive());
    }

    public function testReduceHealthStillAlive()
    {
        $animal = new Elephant();
        $animal->reduceHealth(.36);

        $this->assertEquals(.64, $animal->getHealth());
        $this->assertTrue($animal->isAlive());
        $this->assertFalse($animal->canWalk());

        $animal->increaseHealth(.16);

        $this->assertEquals(.80, $animal->getHealth());
        $this->assertTrue($animal->isAlive());
        $this->assertTrue($animal->canWalk());
    }

    public function testReduceHealthWillDie()
    {
        $animal = new Elephant();
        $animal->reduceHealth(.36);

        $this->assertEquals(.64, $animal->getHealth());
        $this->assertTrue($animal->isAlive());
        $this->assertFalse($animal->canWalk());

        $animal->reduceHealth(.16);

        $this->assertEquals(.48, $animal->getHealth());
        $this->assertFalse($animal->isAlive());
        $this->assertFalse($animal->canWalk());
    }
}
