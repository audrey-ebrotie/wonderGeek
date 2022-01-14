<?php

namespace App\DataFixtures;

use App\Entity\ComicCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ComicCategoryFixtures extends Fixture 
{
    public function load(ObjectManager $manager): void
        {
            $comicCategoriesArray = [
                'Action / Aventure',
                'Humoristique',
                'Fantastique',
                'Heroic Fantasy',
                'Policier / Enquête',
                'Historique',
                'Horreur',
                'Arts Martiaux',
                'Musical',
                'Romance',
                'Science Fiction',
                'Sports',
                'Espionnage',
                'Steampunk',
                'Superhero',
                'Ados',
                'Guerre',
                'Western'
            ];

            for($i = 0; $i < count($comicCategoriesArray); $i++){
            $comicCategory = new ComicCategory();
            $comicCategory->setName($comicCategoriesArray[$i]);

            $manager->persist($comicCategory);

            $this->setReference('comicCategory_' . $i, $comicCategory);
        }
        $manager->flush();
    }
    
}


