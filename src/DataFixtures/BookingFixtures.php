<?php

namespace App\DataFixtures;

use App\Entity\Booking;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class BookingFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
        {
            $faker = Factory::create('fr_FR');

            for($nbrBookings = 1; $nbrBookings <= 50; $nbrBookings++){
                $user = $this->getReference('user_' . $faker->numberBetween(1, 500));
                $event = $this->getReference('event_' . $faker->numberBetween(1, 100));

                $booking = new Booking();

                $booking->setUser($user);
                $booking->setEvent($event);
                $booking->setReference($faker->uuid());
            
                $manager->persist($booking);
            }
            $manager->flush();
        }

        public function getDependencies()
        {
            return [
                EventFixtures::class,
                UserFixtures::class
            ];
        }
}


