<?php

namespace App\DataFixtures;

use App\Person\Domain\Person;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PersonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        foreach (self::getPersons() as $id => $data) {
            $vehicles = [];
            foreach ($data['vehicles'] as $vehicle) {
                $vehicles[] = $this->getReference($vehicle);
            }

            $person = new Person($id, $data['name'], $data['title'], $data['birth'], $this->getReference($data['pet']), $vehicles);
            $manager->persist($person);
            $this->addReference($id, $person);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            AnimalFixtures::class,
            VehicleFixtures::class,
        );
    }

    private static function getPersons(): array
    {
        return [
            'duffy' => [
                'name'  => 'Patrick Duffy',
                'title' => Person::TITLE_MR,
                'birth' => new \DateTime('1949-03-17 00:00:00'),
                'pet'   => 'rintintin',
                'vehicles' => [
                    'cox',
                    'fear',
                ],
            ],
            'chuck' => [
                'name'  => 'Chuck Norris',
                'title' => Person::TITLE_MR,
                'birth' => new \DateTime('1940-03-10 00:00:00'),
                'pet'   => 'baloo',
                'vehicles' => [
                    'ateam',
                ],
            ],
            'milano' => [
                'name'  => 'Alyssa Milano',
                'title' => Person::TITLE_MRS,
                'birth' => new \DateTime('1972-12-19 00:00:00'),
                'pet'   => 'felix',
                'vehicles' => [
                    'clio',
                ],
            ],
        ];
    }
}