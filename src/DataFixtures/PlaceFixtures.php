<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Place;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PlaceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
        {
            $faker = Factory::create('fr_FR');

            for($nbrPlaces = 1; $nbrPlaces <= 50; $nbrPlaces++){
            $place = new Place();

            $place->setName($faker->company());
            $place->setStreet($faker->streetAddress());
            $place->setCity($faker->city());
            $place->setZipcode($faker->postcode());
            $place->setCountry('FR');

            $manager->persist($place);
        }
        $manager->flush();
    }
}


