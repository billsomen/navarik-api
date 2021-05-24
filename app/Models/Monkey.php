<?php


namespace App\Models;


/**
 * Class Monkey
 * @package App\Models
 */
class Monkey extends Animal
{
    /**
     * Monkey constructor.
     * @param float $health
     * @param bool $isAlive
     */
    public function __construct(float $health = 1.0, bool $isAlive = true)
    {
        parent::__construct($health, $isAlive);
        $this->healthLimitToLive = 30/100;
        $this->healthLimitToWalk = 30/100;
    }
}
