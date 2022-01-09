<?php

namespace App\DataFixtures;

use App\Entity\VideoGameCategory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class VideoGameCategoryFixtures extends Fixture 
{
    public function load(ObjectManager $manager): void
        {
            $videoGameCategoriesArray = [
                'FPS / TPS',
                'Combat',
                'RTS',
                'Simulation',
                'Plateforme',
                'RPG',
                'MMORPG',
                'Sandbox',
                'MOBA',
                'Battle Royals',
                'Action / Aventure',
                'Beat Them All',
                'Puzzlers',
                'Réflexion',
                'Survival Horror',
                'Hack’n’slash',
                'Party Games',
                'Rythme',
                'Course',
                'Sports'
            ];

            for($i = 0; $i < count($videoGameCategoriesArray); $i++){
            $videoGameCategory = new VideoGameCategory();
            $videoGameCategory->setName($videoGameCategoriesArray[$i]);

            $manager->persist($videoGameCategory);

            $this->setReference('videoGameCategory_' . $i, $videoGameCategory);
        }
        $manager->flush();
    }
    
}


