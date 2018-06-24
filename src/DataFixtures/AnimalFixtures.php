<?php

namespace App\DataFixtures;

use App\Animal\Domain\Dog;
use App\Animal\Domain\Cat;
use App\Animal\Domain\Bear;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AnimalFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach (self::getAnimals() as $id => $data) {
            $animal = new $data['class']($id, $data['name']);
            $manager->persist($animal);
            $this->addReference($id, $animal);
        }

        $manager->flush();
    }

    private static function getAnimals(): array
    {
        return [
            'rintintin' => [
                'class' => Dog::class,
                'name' => 'Rintintin',
            ],
            'felix' => [
                'class' => Cat::class,
                'name' => 'Felix',
            ],
            'baloo' => [
                'class' => Bear::class,
                'name' => 'Baloo',
            ],
        ];
    }
}