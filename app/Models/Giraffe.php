<?php


namespace App\Models;


/**
 * Class Giraffe
 * @package App\Models
 */
class Giraffe extends Animal
{
    /**
     * Giraffe constructor.
     * @param float $health
     * @param bool $isAlive
     */
    public function __construct(float $health = 1.0, bool $isAlive = true)
    {
        parent::__construct($health, $isAlive);
        $this->healthLimitToLive = 50/100;
        $this->healthLimitToWalk = 50/100;
    }
}
