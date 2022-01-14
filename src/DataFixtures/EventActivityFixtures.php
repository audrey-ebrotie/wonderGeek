<?php

namespace App\DataFixtures;

use App\Entity\EventActivity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EventActivityFixtures extends Fixture 
{
    public function load(ObjectManager $manager): void
        {
            $eventActivitiesArray = [
                'Jeux vidéos',
                'Jeux de société',
                'Mangas',
                'Comics',
                'Toutes activités'
            ];

            for($i = 0; $i < count($eventActivitiesArray); $i++){
            $eventActivity = new EventActivity();
            $eventActivity->setName($eventActivitiesArray[$i]);

            $manager->persist($eventActivity);

            $this->setReference('eventActivity_' . $i, $eventActivity);
        }
        $manager->flush();
    }
    
}


