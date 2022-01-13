<?php

namespace App\DataFixtures;

use App\Entity\Avatar;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AvatarFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
        {
            $avatarsArray = [
                'https://cdn-icons-png.flaticon.com/512/1752/1752772.png',
                'https://cdn-icons.flaticon.com/png/512/1211/premium/1211015.png?token=exp=1641899224~hmac=3a28f8e149a633bcf6812e2b4d7d6b08',
                'https://cdn-icons.flaticon.com/png/512/663/premium/663097.png?token=exp=1641899224~hmac=446cfd4b7676c1308cbd1a3ecbdc873a',
                'https://cdn-icons-png.flaticon.com/512/189/189000.png',
                'https://cdn-icons-png.flaticon.com/512/528/528111.png',
                'https://cdn-icons-png.flaticon.com/512/924/924874.png',
                'https://cdn-icons-png.flaticon.com/512/3393/3393852.png',
                'https://cdn-icons.flaticon.com/png/512/2423/premium/2423830.png?token=exp=1641899421~hmac=08269d202be75908dc10a7f02ca0d797',
                'https://cdn-icons.flaticon.com/png/512/4218/premium/4218368.png?token=exp=1641899519~hmac=0bcfc455c9c4c1133d983b08a50346c4',
                'https://cdn-icons.flaticon.com/png/512/2520/premium/2520865.png?token=exp=1641899519~hmac=dd214a475e4fdbc17f353ae828106d7e',
                'https://cdn-icons-png.flaticon.com/512/435/435048.png',
                'https://cdn-icons-png.flaticon.com/512/452/452539.png',
                'https://cdn-icons-png.flaticon.com/512/528/528107.png',
                'https://cdn-icons-png.flaticon.com/512/871/871366.png',
                'https://cdn-icons-png.flaticon.com/512/1674/1674292.png',
                'https://cdn-icons-png.flaticon.com/512/1674/1674291.png',
                'https://cdn-icons.flaticon.com/png/512/1090/premium/1090806.png?token=exp=1641899702~hmac=54cf59726506b8ed7f77b4bba23bdda4',
                'https://cdn-icons-png.flaticon.com/512/1120/1120972.png',
                'https://cdn-icons.flaticon.com/png/512/2671/premium/2671422.png?token=exp=1641899777~hmac=5ab4dd5190ff90327964da4573142588',
                'https://cdn-icons.flaticon.com/png/512/1985/premium/1985783.png?token=exp=1641899777~hmac=467dad371dbd0417fc9f459b8fcfa7d0',
                'https://cdn-icons-png.flaticon.com/512/306/306772.png'
            ];

            $faker = Factory::create();

            for($i = 0; $i < count($avatarsArray); $i++){
                $avatar = new Avatar();
                $avatar->setPicture($avatarsArray[$i]);
    
                $manager->persist($avatar);
    
                $this->setReference('avatar_' . $i, $avatar);
            }
            $manager->flush();
        }
}


