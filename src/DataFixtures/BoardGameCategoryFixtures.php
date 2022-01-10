<?php

namespace App\DataFixtures;

use App\Entity\BoardGameCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BoardGameCategoryFixtures extends Fixture 
{
    public function load(ObjectManager $manager): void
        {
            $boardGameCategoriesArray = [
                'Jeu de dés',
                'Jeu d\'adresse',
                'Jeu d\'ambiance',
                'Jeu de cartes',
                'Jeu de plateau',
                'Jeu de mémoire',
                'Jeu de connaissance',
                'Jeu de lettres',
                'Jeu de logique',
                'Jeu de pions',
                'Jeu d\'enquête',
                'Jeu de coopération',
                'Jeu de bluff',
                'Jeu de stratégie',
                'Jeu de gestion',
                'Jeu de hasard',
                'Jeu de rôle'
            ];

            for($i = 0; $i < count($boardGameCategoriesArray); $i++){
            $boardGameCategory = new BoardGameCategory();
            $boardGameCategory->setName($boardGameCategoriesArray[$i]);

            $manager->persist($boardGameCategory);

            $this->setReference('boardGameCategory_' . $i, $boardGameCategory);
        }
        $manager->flush();
    }
    
}


