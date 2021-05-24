<?php

namespace Models;

use App\Models\Giraffe;
use PHPUnit\Framework\TestCase;

class GiraffeTest extends TestCase
{

    public function test__construct()
    {
        $animal = new Giraffe();
        $deadAnimal = new Giraffe(.3, false);

        $this->assertEquals(1.0, $animal->isAlive());
        $this->assertEquals(.5, $animal->getHealthLimitToLive());
        $this->assertEquals(.5, $animal->getHealthLimitToWalk());
        $this->assertTrue($animal->isAlive());
        $this->assertFalse($deadAnimal->isAlive());
    }

    public function testReduceHealth()
    {
        $animal = new Giraffe();
        $animal->reduceHealth(.1);

        $this->assertEquals(.9, $animal->getHealth());
        $this->assertTrue($animal->isAlive());

        $animal->reduceHealth(.5);
        $this->assertEquals(.4, $animal->getHealth());
        $this->assertFalse($animal->isAlive());
    }
}
