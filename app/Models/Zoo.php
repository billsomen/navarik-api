<?php


namespace App\Models;

define('ELEPHANT', 'ELEPHANT');
define('MONKEY', 'MONKEY');
define('GIRAFFE', 'GIRAFFE');
define('JSON_FILE_NAME', 'database/zoo.json');


/**
 * Class Zoo
 * @package App\Models
 */
class Zoo
{
    /**
     * @var int
     */
    private int $time;
    /**
     * @var array
     */
    private array $animals;

    /**
     * Zoo constructor.
     */
    public function __construct()
    {
        $manifest = [
            MONKEY => 5,
            GIRAFFE => 5,
            ELEPHANT => 5
        ];

        $this->time = 0;
        $this->animals = $this->factoryOfAnimals($manifest);

        try {
            if (!file_exists(JSON_FILE_NAME)) {
                $zoo = Zoo::prepare($this->animals, $this->time);
                $json = json_encode($zoo);

                file_put_contents(JSON_FILE_NAME, $json);
            }
        } catch (\Exception $exception)
        {
            print_r('ERROR');
            echo "Error - {$exception->getMessage()}";
        }
    }

    /**
     * @param array $manifest
     * @return array
     */
    public static function factoryOfAnimals(array $manifest) : array
    {
        $animals = [];
        foreach ($manifest as $type => $count){
            $animals[$type] = [];
            foreach (range(0, $count-1) as $i){
                try {
                    $animals[$type][$i] = self::buildAnimal($type);
                } catch (\Exception $e) {
                    echo "Exception: ". $e;
                }
            }
        }

        return $animals;
    }

    /**
     * @param string $type
     * @param float $health
     * @param bool $isAlive
     * @return Animal
     */
    public static function buildAnimal(string $type, float $health = 1.0, bool $isAlive = true): Animal
    {
        switch ($type){
            case ELEPHANT:
            {
                return new Elephant($health, $isAlive);
            }
            case MONKEY:
            {
                return new Monkey($health, $isAlive);
            }
            case GIRAFFE:
            {
                return new Giraffe($health, $isAlive);
            }
            default:
            {
                return new Animal($health, $isAlive);
            }
        }
    }

    /**
     * @return array
     */
    public function feedAnimals(): array
    {
        $states = [];
        foreach ($this->animals as $type => $animalList) {
            $health = rand(10, 25) / 100;
            foreach ($animalList as $key => $animal){
                $animal->increaseHealth($health);
                $states[$type." - ".$key] = $animal->getState();
            }
        }

        return $states;
    }

    /**
     * @return array
     */
    public function incrementTime(): array
    {
        $states = [];
        foreach ($this->animals as $type => $animalList) {
            foreach ($animalList as $key => $animal){
                $health = rand(0, 20) / 100;
                $animal->reduceHealth($health);
                $states[$type." - ".$key] = $animal->getState();
            }
        }
        $this->time++;

        return $states;
    }

    /**
     * @return array
     */
    public function getAnimals(): array
    {
        return $this->animals;
    }

    /**
     * @return int
     */
    public function getTime(): int
    {
        return $this->time;
    }

    /**
     * @param array $data
     * @param int $time
     * @return array
     */
    public static function prepare(array $data, int $time): array{
        $animals = [];

        foreach ($data as $type => $animalList) {
            $animals[$type] = [];
            foreach ($animalList as $key => $animal) {
                $animals[$type][$key]['health'] = $animal->getHealth();
                $animals[$type][$key]['isAlive'] = $animal->isAlive();
                $animals[$type][$key]['state'] = $animal->getState();
            }
        }

        return [
            "time" => $time,
            "animals" => $animals
        ];
    }

    /**
     * @return array
     */
    public function save(): array
    {
        $zoo = Zoo::prepare($this->getAnimals(), $this->getTime());
        $json = json_encode($zoo);

        try {
            file_put_contents(JSON_FILE_NAME, $json);
        } catch (\Exception $exception){
            print_r($exception);
        }

        return $zoo;
    }

    /**
     * @return array
     */
    public function load(): array
    {
        try {
            $string = file_get_contents(JSON_FILE_NAME);
            $json = json_decode($string, true);

            if (count($json)){
                if (count($json['animals']) > 0){
                    $this->animals = [];
                }
                $this->time = $json["time"];
                foreach ($json["animals"] as $type => $animalList) {
                    $this->animals[$type] = [];
                    foreach ($animalList as $key => $animalData) {
                        $this->animals[$type][$key] = self::buildAnimal($type, $animalData["health"], $animalData["isAlive"]);
                    }
                }
            }
            return $json;
        } catch (\Exception $exception)
        {
            echo "Error - {$exception->getMessage()}";
            return [];
        }
    }
}
