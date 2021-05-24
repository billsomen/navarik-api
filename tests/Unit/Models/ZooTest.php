<?php

namespace Models;

use App\Models\Zoo;
use PHPUnit\Framework\TestCase;

class ZooTest extends TestCase
{

    public function testGetAnimals()
    {
        $zoo = new Zoo();
        $animals = $zoo->getAnimals();

        $this->assertCount(3, $animals);
        $this->assertCount(5, $animals[ELEPHANT]);
        $this->assertCount(5, $animals[MONKEY]);
        $this->assertCount(5, $animals[GIRAFFE]);
    }

    public function testFactoryOfAnimals()
    {
        $manifest = [
            MONKEY => 2,
            GIRAFFE => 1,
            ELEPHANT => 3
        ];

        $animals = Zoo::factoryOfAnimals($manifest);
        $totalHealth = ZooTest::getTotalAnimalsHealthHelper($animals);

        $this->assertCount(3, $animals);
        $this->assertEquals(6*1.0, $totalHealth);

    }

    public function testBuildAnimal()
    {
        $elephant = Zoo::buildAnimal(ELEPHANT);
        $monkey = Zoo::buildAnimal(MONKEY, .8);
        $giraffe = Zoo::buildAnimal(GIRAFFE, .4, false);

        $this->assertEquals(1.0, $elephant->getHealth());
        $this->assertEquals(.7, $elephant->getHealthLimitToLive());
        $this->assertEquals(.7, $elephant->getHealthLimitToWalk());
        $this->assertTrue($elephant->isAlive());

        $this->assertEquals(.8, $monkey->getHealth());
        $this->assertEquals(.3, $monkey->getHealthLimitToLive());
        $this->assertTrue($monkey->isAlive());

        $this->assertEquals(.4, $giraffe->getHealth());
        $this->assertEquals(.5, $giraffe->getHealthLimitToLive());
        $this->assertFalse($giraffe->isAlive());
    }

    public function testLoad()
    {
        // Already covered by BuildAnimal
    }

    public function prepare()
    {
        $manifest = [
            MONKEY => 1,
            GIRAFFE => 1
        ];

        $time = 0;
        $animals = Zoo::factoryOfAnimals($manifest);
        $expectedMonkey = $animals[MONKEY][0];
        $expectedGiraffe = $animals[GIRAFFE][0];

        $formatted = Zoo::prepare($animals, $time);
        $currentMonkey = $formatted['animals'][MONKEY][0];
        $currentGiraffe = $formatted['animals'][GIRAFFE][0];

        $this->assertEquals($time, $formatted['time']);

        $this->assertEquals($expectedMonkey->getHealth(), $currentMonkey['health']);
        $this->assertEquals($expectedMonkey->isAlive(), $currentMonkey['isAlive']);
        $this->assertEquals($expectedMonkey->getState(), $currentMonkey['state']);

        $this->assertEquals($expectedGiraffe->getHealth(), $currentGiraffe['health']);
        $this->assertEquals($expectedGiraffe->isAlive(), $currentGiraffe['isAlive']);
        $this->assertEquals($expectedGiraffe->getState(), $currentGiraffe['state']);
    }

    public function testSave()
    {
        // Already covered by PrepareTest
    }

    public static function getTotalAnimalsHealthHelper(array $animalList) : float{
        $zooTotalHealth = 0;
        foreach ($animalList as $animals){
            foreach ($animals as $animal){
                $zooTotalHealth += $animal->getHealth();
            }
        }

        return $zooTotalHealth;
    }

    public function testFeedAnimals()
    {
        $zoo = new Zoo();

        $zoo->incrementTime();
        $aZooTotalHealth = ZooTest::getTotalAnimalsHealthHelper($zoo->getAnimals());

        $zoo->feedAnimals();
        $currentZooTotalHealth = ZooTest::getTotalAnimalsHealthHelper($zoo->getAnimals());

        $this->assertGreaterThanOrEqual($aZooTotalHealth, $currentZooTotalHealth);
    }

    public function testIncrementTime()
    {
        $zoo = new Zoo();
        $aZooTotalHealth = ZooTest::getTotalAnimalsHealthHelper($zoo->getAnimals());

        $zoo->incrementTime();
        $currentZooTotalHealth = ZooTest::getTotalAnimalsHealthHelper($zoo->getAnimals());

        $this->assertLessThanOrEqual($aZooTotalHealth, $currentZooTotalHealth);
    }

    public function testGetTime()
    {
        $zoo = new Zoo();
        $zoo->incrementTime();
        $zoo->incrementTime();

        $this->assertEquals(2, $zoo->getTime());
    }

    public function test__construct()
    {
        $zoo = new Zoo();
        $animals = $zoo->getAnimals();

        $this->assertEquals(0, $zoo->getTime());
        $this->assertCount(3, $animals);
        $this->assertTrue(file_exists(JSON_FILE_NAME));
    }
}
