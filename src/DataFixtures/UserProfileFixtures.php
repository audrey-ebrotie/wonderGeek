<?php

namespace App\DataFixtures;

use App\Entity\UserProfile;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserProfileFixtures extends Fixture 
{
    public function load(ObjectManager $manager): void
        {
            $userProfilesArray = [
                'Gamer',
                'Joueur de jeux de société',
                'Lecteur de mangas',
                'Lecteur de comics'
            ];

            for($i = 0; $i < count($userProfilesArray); $i++){
            $userProfile = new UserProfile();
            $userProfile->setName($userProfilesArray[$i]);

            $manager->persist($userProfile);

            $this->setReference('userProfile_' . $i, $userProfile);
        }
        $manager->flush();
    }
    
}


