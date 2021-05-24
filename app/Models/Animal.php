<?php


namespace App\Models;


define('IS_DEAD', "Is dead");
define('IS_ALIVE', "Is alive");
define('CAN_WALK', "Can walk");
define('CAN_NOT_WALK', "Can not walk");

/**
 * Class Animal
 * @package App\Models
 */
class Animal
{
    /**
     * @var float|mixed
     */
    protected float $health;
    /**
     * @var float|int
     */
    protected float $healthLimitToWalk;
    /**
     * @var float|int
     */
    protected float $healthLimitToLive;
    /**
     * @var string
     */
    protected string $state;
    /**
     * @var bool
     */
    protected bool $isAlive;

    /**
     * Animal constructor.
     * @param float $health
     * @param bool $isAlive
     */
    public function __construct(float $health = 1.0, bool $isAlive = true)
    {
        $this->health = $health;
        $this->isAlive = $isAlive;
        $this->healthLimitToLive = 0;
        $this->healthLimitToWalk = 0;
    }

    /**
     * @return float
     */
    public function getHealth(): float
    {
        return $this->health;
    }

    /**
     * @return bool
     */
    public function isAlive(): bool
    {
        return $this->isAlive;
    }

    /**
     * @return bool
     */
    public function canWalk(): bool
    {
        return $this->health > $this->healthLimitToWalk;
    }

    /**
     * @param float $health
     */
    public function reduceHealth(float $health): void
    {
        $this->health -= $health;

        if ($this->health < 0){
            $this->health = 0;
        }
        $this->isAlive = $this->health > $this->healthLimitToLive;
    }

    /**
     * @param float $health
     */
    public function increaseHealth(float $health): void
    {
        if ($this->isAlive){
            $this->health += $health;

            if ($this->health > 1.0){
                $this->health = 1.0;
            }
        }
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        $state = ($this->canWalk() ? CAN_WALK : CAN_NOT_WALK). " - ";
        $state .= ($this->isAlive() ? IS_ALIVE : IS_DEAD) . ".";

        return $state;
    }

    /**
     * @return float|int
     */
    public function getHealthLimitToWalk()
    {
        return $this->healthLimitToWalk;
    }

    /**
     * @return float|int
     */
    public function getHealthLimitToLive()
    {
        return $this->healthLimitToLive;
    }

}
