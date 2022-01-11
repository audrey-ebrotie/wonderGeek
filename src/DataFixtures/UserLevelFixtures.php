<?php

namespace App\DataFixtures;

use App\Entity\UserLevel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserLevelFixtures extends Fixture 
{
    public function load(ObjectManager $manager): void
        {
            $userLevelsArray = [
                'Débutant',
                'Occasionnel',
                'Intermédiaire',
                'Confirmé', 
                'Professionnel'
            ];

            for($i = 0; $i < count($userLevelsArray); $i++){
            $userLevel = new UserLevel();
            $userLevel->setName($userLevelsArray[$i]);

            $manager->persist($userLevel);

            $this->setReference('userLevel_' . $i, $userLevel);
        }
        $manager->flush();
    }
    
}


