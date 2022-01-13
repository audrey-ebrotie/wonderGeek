<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
        {
            $faker = Factory::create('fr_FR');
            $roles[] = 'ROLE_USER';

            for($nbrUsers = 1; $nbrUsers <= 500; $nbrUsers++){

            $avatar = $this->getReference('avatar_' . $faker->numberBetween(1, 20));
            $profile = $this->getReference('userProfile_' . $faker->numberBetween(1, 3));
            $level = $this->getReference('userLevel_' . $faker->numberBetween(1, 4));
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

            if($nbrUsers % 5)
                $user->setProfile($profile);
            else
                $user->setProfile(NULL);

            if($nbrUsers % 3)
                $user->setLevel($level);
            else
                $user->setLevel(NULL);

            $user->setCity($faker->city());
            $user->setPicture($avatar);

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
                UserProfileFixtures::class,
                UserLevelFixtures::class,
                AvatarFixtures::class
            ];
        }
}


