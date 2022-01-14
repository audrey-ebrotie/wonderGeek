<?php

namespace App\DataFixtures;

use App\Entity\Platform;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PlatformFixtures extends Fixture 
{
    public function load(ObjectManager $manager): void
        {
            $platformsArray = [
                'Playstation 4',
                'Playstation 5',
                'Xbox One',
                'Xbox Series',
                'Nintendo Switch',
                'PC',
                'MAC',
                'Stadia',
                'Wii U'
            ];

            for($i = 0; $i < count($platformsArray); $i++){

            $platform = new Platform();

            $platform->setName($platformsArray[$i]);

            $manager->persist($platform);

            $this->setReference('platform_' . $i, $platform);
        }
        $manager->flush();
    }
    
}


