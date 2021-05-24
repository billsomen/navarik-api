<?php


namespace App\Models;


/**
 * Class Simulator
 * @package App\Models
 */
class Simulator {
    /**
     * @var Simulator|null
     */
    private static ?Simulator $instance = null;
    /**
     * @var Zoo
     */
    private Zoo $zoo;

    /**
     * Simulator constructor.
     */
    private function __construct()
    {
        $this->zoo = new Zoo();
    }

    /**
     * @return Simulator
     */
    public static function getInstance(): Simulator
    {
        if (self::$instance == null)
        {
            self::$instance = new Simulator();
        }

        return self::$instance;
    }

    /**
     * @return Zoo
     */
    public function getZoo(): Zoo
    {
        return $this->zoo;
    }

    /**
     *
     */
    public function initializeZoo(): void
    {
        $this->zoo = new Zoo();
    }
}
