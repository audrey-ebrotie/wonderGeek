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
            $userPicturesArray = [
                'https://cdn-icons-png.flaticon.com/512/1752/1752772.png',
                'https://cdn-icons-png.flaticon.com/512/189/189000.png',
                'https://cdn-icons-png.flaticon.com/512/528/528111.png',
                'https://cdn-icons-png.flaticon.com/512/924/924874.png',
                'https://cdn-icons-png.flaticon.com/512/3393/3393852.png',
                'https://cdn-icons-png.flaticon.com/512/435/435048.png',
                'https://cdn-icons-png.flaticon.com/512/452/452539.png',
                'https://cdn-icons-png.flaticon.com/512/528/528107.png',
                'https://cdn-icons-png.flaticon.com/512/1674/1674292.png',
                'https://cdn-icons-png.flaticon.com/512/1674/1674291.png',
                'https://cdn-icons-png.flaticon.com/512/1120/1120972.png',
                'https://cdn-icons-png.flaticon.com/512/306/306772.png',
                'https://cdn-icons-png.flaticon.com/512/501/501299.png',
                'https://cdn-icons-png.flaticon.com/512/1880/1880988.png',
                'https://cdn-icons-png.flaticon.com/512/4352/4352117.png',
                'https://cdn-icons-png.flaticon.com/512/477/477154.png',
                'https://cdn-icons-png.flaticon.com/512/2941/2941796.png',
                'https://cdn-icons-png.flaticon.com/512/2579/2579243.png',
                'https://cdn-icons-png.flaticon.com/512/2534/2534553.png',
                'https://cdn-icons-png.flaticon.com/512/2213/2213713.png',
                'https://cdn-icons-png.flaticon.com/512/6530/6530866.png',
                'https://cdn-icons-png.flaticon.com/512/3819/3819167.png',
                'https://cdn-icons-png.flaticon.com/512/6595/6595509.png',
                'https://cdn-icons-png.flaticon.com/512/6595/6595454.png',
                'https://cdn-icons-png.flaticon.com/512/5793/5793587.png',
                'https://cdn-icons-png.flaticon.com/512/597/597566.png',
                'https://cdn-icons-png.flaticon.com/512/892/892721.png',
                'https://cdn-icons-png.flaticon.com/512/2503/2503183.png',
                'https://cdn-icons-png.flaticon.com/512/1487/1487231.png'
            ];

            $faker = Factory::create('fr_FR');

            for($nbrUsers = 1; $nbrUsers <= 500; $nbrUsers++){

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

            if($nbrUsers % 5)
                $user->setProfile($profile);
            else
                $user->setProfile(NULL);

            if($nbrUsers % 3)
                $user->setLevel($level);
            else
                $user->setLevel(NULL);

            $user->setCity($faker->city());
            $user->setPicture($faker->randomElement($userPicturesArray));

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
                UserLevelFixtures::class
            ];
        }
}


