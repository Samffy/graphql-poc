<?php

namespace App\Common\Infra\Repository;

use App\Person\Domain\Person;
use App\Vehicle\Domain\Car;
use App\Vehicle\Domain\Truck;

class DataRepository
{
    /**
     * @var array
     */
    private static $data = [];

    public static function init()
    {
        $cars = [
            'clio' => new Car('clio', 'Renault', 'Clio 2', 5),
            'cox'  => new Car('cox', 'Volkswagen', 'Coccinelle', 4),
            'polo' => new Car('polo', 'Volkswagen', 'Polo', 5),
        ];

        $trucks = [
            'ateam' => new Truck('ateam', 'GMC', 'Vandura', 1000),
            'dumb'  => new Truck('dumb', 'Ford', 'Econoline', 600),
            'fear'  => new Truck('fear', 'Corbitt', '50SD6', 5000),
        ];

        $persons = [
            'duffy'  => new Person('duffy', 'Patrick Duffy', Person::TITLE_MR, new \DateTime('1949-03-17 00:00:00')),
            'chuck'  => new Person('chuck', 'Chuck Norris', Person::TITLE_MR, new \DateTime('1940-03-10 00:00:00')),
            'milano' => new Person('milano', 'Alyssa Milano', Person::TITLE_MRS, new \DateTime('1972-12-19 00:00:00')),
        ];

        self::$data = [
            'persons' => $persons,
            'cars' => $cars,
            'trucks' => $trucks,
            'vehicles' => array_merge($cars, $trucks),
            'person_has_vehicles' => [
                'duffy'  => [
                    $cars['cox'],
                    $trucks['fear'],
                ],
                'chuck'  => [
                    $trucks['ateam'],
                ],
                'milano' => [
                    $cars['clio'],
                ],
            ]
        ];
    }

    /**
     * @return array
     */
    public static function getPersons()
    {
        self::init();

        return self::$data['persons'];
    }

    /**
     * @return array
     */
    public static function getTrucks()
    {
        self::init();

        return self::$data['trucks'];
    }

    /**
     * @return array
     */
    public static function getCars()
    {
        self::init();

        return self::$data['cars'];
    }

    /**
     * @return array
     */
    public static function getVehicles()
    {
        self::init();

        return self::$data['vehicles'];
    }

    /**
     * @return array
     */
    public static function getVehiclesByPersons()
    {
        self::init();

        return self::$data['person_has_vehicles'];
    }
}
