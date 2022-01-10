<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Event;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    // const DATA = [
    //     [
    //         'firstname' => "John",
    //         'favorites' => [
    //             'comics' => ['comic_3'],
    //         ]
    //     ]
    // ];

    public function load(ObjectManager $manager): void
        {
            $faker = Factory::create('fr_FR');
            $roles[] = 'ROLE_USER';

            for($nbrUsers = 1; $nbrUsers <= 500; $nbrUsers++){

            $favVideoGame = $this->getReference('videoGame_' . $faker->numberBetween(1, 100));
            $favBoardGame = $this->getReference('boardGame_' . $faker->numberBetween(1, 100));
            $favComic = $this->getReference('comic_' . $faker->numberBetween(1, 100));
            $favManga = $this->getReference('manga_' . $faker->numberBetween(1, 100));

            $user = new User();

            $user->setUsername($faker->userName());
            $user->setEmail($faker->unique()->email());
                $password = password_hash($faker->password(), PASSWORD_BCRYPT);
            $user->setPassword($password);
            $user->setBirthdate($faker->dateTimeBetween('-60 years', '-13 years'));
            $user->setRoles($roles);

            if($nbrUsers % 3){
                $user->addFavoriteVideoGame($favVideoGame);
            } else {
                NULL;
            }

            if($nbrUsers % 7){
                $user->addFavoriteBoardGame($favBoardGame);
            } else {
                NULL;
            }

            if($nbrUsers % 4){
                $user->addFavoriteComic($favComic);
            } else {
                NULL;
            }

            if($nbrUsers % 5){
                $user->addFavoriteManga($favManga);
            } else {
                NULL;
            }

            $manager->persist($user);

            $this->setReference('user_' . $nbrUsers, $user);
        }
        $manager->flush();
    }

    public function getDependencies()
        {
            return [
                VideoGameFixtures::class,
                BoardGameFixtures::class,
                ComicFixtures::class,
                MangaFixtures::class,
            ];
        }
}


