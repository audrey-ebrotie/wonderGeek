<?php

namespace App\DataFixtures;

use App\Entity\EventCategory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class EventCategoryFixtures extends Fixture 
{
    public function load(ObjectManager $manager): void
        {
            $eventCategoriesArray = [
                'Convention',
                'Partie en ligne',
                'Partie en local (LAN Party)',
                'Tournoi',
                'Meeting',
                'Vente aux enchères / troc',
                'Conférence',
            ];

            for($i = 0; $i < count($eventCategoriesArray); $i++){
            $eventCategory = new EventCategory();
            $eventCategory->setName($eventCategoriesArray[$i]);

            $manager->persist($eventCategory);

            $this->setReference('eventCategory_' . $i, $eventCategory);
        }
        $manager->flush();
    }
    
}


