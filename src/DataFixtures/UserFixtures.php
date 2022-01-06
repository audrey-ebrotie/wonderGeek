<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
        {
            $faker = Factory::create('fr_FR');

            for($nbrUsers = 1; $nbrUsers <= 10; $nbrUsers++){
            $user = new User();

            $user->setUsername($faker->userName());
            $user->setEmail($faker->email());
                $password = password_hash($faker->password(), PASSWORD_BCRYPT);
            $user->setPassword($password);
            $user->setBirthdate($faker->dateTimeBetween('-60 years', '-13 years'));

            $manager->persist($user);
        }
        $manager->flush();
    }
}


