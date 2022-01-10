<?php

namespace App\DataFixtures;

use App\Entity\MangaCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MangaCategoryFixtures extends Fixture 
{
    public function load(ObjectManager $manager): void
        {
            $mangaCategoriesArray = [
                'Kodomo',
                'Shonen',
                'Shojo',
                'Seinen',
                'Josei'
            ];

            for($i = 0; $i < count($mangaCategoriesArray); $i++){
            $mangaCategory = new MangaCategory();
            $mangaCategory->setName($mangaCategoriesArray[$i]);

            $manager->persist($mangaCategory);

            $this->setReference('mangaCategory_' . $i, $mangaCategory);
        }
        $manager->flush();
    }
    
}


