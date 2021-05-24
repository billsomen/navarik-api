<?php

namespace Models;

use App\Models\Animal;
use PHPUnit\Framework\TestCase;

class AnimalTest extends TestCase
{

    public function testIsAlive()
    {
        $animal = new Animal();
        $animal->reduceHealth(1);

        $this->assertFalse($animal->isAlive());

        // If an animal is dead, feeding it should not awake him :)

        $animal->increaseHealth(.9);
        $this->assertGreaterThanOrEqual(.0, $animal->getHealth());
        $this->assertFalse($animal->isAlive());
    }

    public function testCanWalk()
    {
        $animal = new Animal();
        $animal->reduceHealth(1);

        $this->assertFalse($animal->canWalk());

        // If an animal is dead, feeding it should not awake him :)

        $animal->increaseHealth(.9);
        $this->assertGreaterThanOrEqual(0.0, $animal->getHealth());
        $this->assertFalse($animal->canWalk());
    }

    public function testIncreaseHealth()
    {
        $animal = new Animal(.5);
        $animal->increaseHealth(.1);

        $this->assertEquals(.6, $animal->getHealth());

        $animal->increaseHealth(.9);

        $this->assertEquals(1.0, $animal->getHealth());
    }

    public function testGetState()
    {
        $animal = new Animal(.5);
        $deadAnimal = new Animal(.0, false);
        $livingState = "Can walk - Is alive.";
        $deadState = "Can not walk - Is dead.";

        $this->assertEquals($livingState, $animal->getState());
        $this->assertEquals($deadState, $deadAnimal->getState());
    }

    public function test__construct()
    {
        $animal = new Animal(.5);
        $deadAnimal = new Animal(.5, false);

        $this->assertEquals(.5, $animal->isAlive());
        $this->assertEquals(.0, $animal->getHealthLimitToLive());
        $this->assertEquals(.0, $animal->getHealthLimitToWalk());
        $this->assertTrue($animal->isAlive());
        $this->assertFalse($deadAnimal->isAlive());
    }

    public function testGetHealth()
    {
        $animal = new Animal(.5);
        $deadAnimal = new Animal(.0, false);

        $this->assertEquals(.5, $animal->getHealth());
        $this->assertEquals(.0, $deadAnimal->getHealth());
    }

    public function testReduceHealth()
    {
        $animal = new Animal(.5);
        $animal->reduceHealth(.1);

        $this->assertEquals(.4, $animal->getHealth());

        $animal->reduceHealth(.5);
        $this->assertEquals(.0, $animal->getHealth());
        $this->assertFalse($animal->isAlive());
    }
}
