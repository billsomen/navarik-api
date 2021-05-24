<?php


namespace App\Models;


/**
 * Class Elephant
 * @package App\Models
 */
class Elephant extends Animal
{
    /**
     * Elephant constructor.
     * @param float $health
     * @param bool $isAlive
     */
    public function __construct(float $health = 1.0, bool $isAlive = true)
    {
        parent::__construct($health, $isAlive);

        $this->healthLimitToLive = 70/100;
        $this->healthLimitToWalk = 70/100;
    }

    /**
     * @param float $health
     */
    public function reduceHealth(float $health): void
    {
        $previousHealth = $this->health;
        $this->health -= $health;

        if ($this->health < 0){
            $this->health = 0;
        }

        if ($this->isAlive){
            $this->isAlive = $previousHealth >= $this->healthLimitToLive || $this->health > $this->healthLimitToLive;
        }
    }
}
