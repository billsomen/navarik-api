<?php

namespace Models;

use App\Models\Simulator;
use PHPUnit\Framework\TestCase;

class SimulatorTest extends TestCase
{

    public function testGetInstance()
    {
        $simulator1 = Simulator::getInstance();
        $simulator2 = Simulator::getInstance();

        $this->assertTrue($simulator1 === $simulator2);
    }

    public function testGetZoo()
    {
        $simulator1 = Simulator::getInstance();
        $zoo1 = $simulator1->getZoo();

        $zoo1->incrementTime();

        $simulator2 = Simulator::getInstance();
        $zoo2 = $simulator2->getZoo();

        $this->assertTrue($zoo1 === $zoo2);
    }

    public function testInitializeZoo()
    {
        $simulator = Simulator::getInstance();
        $simulator->initializeZoo();

        $zoo = $simulator->getZoo();
        $zoo->incrementTime();

        $this->assertTrue($zoo->getTime() == 1);

        $simulator->initializeZoo();
        $zoo = $simulator->getZoo();

        $this->assertTrue($zoo->getTime() == 0);
    }
}
