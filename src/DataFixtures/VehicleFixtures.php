<?php

namespace App\DataFixtures;

use App\Vehicle\Domain\Car;
use App\Vehicle\Domain\Truck;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class VehicleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach (self::getVehicles() as $id => $data) {
            switch($data['class']) {
                case Car::class:
                    $vehicle = new Car($id, $data['manufacturer'], $data['model'], $data['seats']);
                    break;
                case Truck::class:
                    $vehicle = new Truck($id, $data['manufacturer'], $data['model'], $data['load']);
                    break;
                default:
                    continue;
            }
            $manager->persist($vehicle);
            $this->addReference($id, $vehicle);
        }

        $manager->flush();
    }

    private static function getVehicles(): array
    {
        return [
            'clio' => [
                'class'        => Car::class,
                'manufacturer' => 'Renault',
                'model'        => 'Clio 2',
                'seats'        => 5,
            ],
            'cox' => [
                'class'        => Car::class,
                'manufacturer' => 'Volkswagen',
                'model'        => 'Coccinelle',
                'seats'        => 4,
            ],
            'polo' => [
                'class'        => Car::class,
                'manufacturer' => 'Volkswagen',
                'model'        => 'Polo',
                'seats'        => 5,
            ],
            'ateam' => [
                'class'        => Truck::class,
                'manufacturer' => 'GMC',
                'model'        => 'Vandura',
                'load'         => 1000,
            ],
            'dumb' => [
                'class'        => Truck::class,
                'manufacturer' => 'Ford',
                'model'        => 'Econoline',
                'load'         => 600,
            ],
            'fear' => [
                'class'        => Truck::class,
                'manufacturer' => 'Corbitt',
                'model'        => '50SD6',
                'load'         => 5000,
            ],
        ];
    }
}
