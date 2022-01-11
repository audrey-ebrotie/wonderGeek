<?php

namespace App\DataFixtures;

use App\Entity\BoardGame;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class BoardGameFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
        {
            $boardGamePicturesArray = [
                'https://cdn3.philibertnet.com/520955-thickbox_default/unlock-game-adventures.jpg',
                'https://cdn2.philibertnet.com/523790-thickbox_default/micromacro-crime-city.jpg',
                'https://cdn3.philibertnet.com/515898-thickbox_default/7-wonders-architects.jpg',
                'https://cdn3.philibertnet.com/516145-thickbox_default/nouvelles-contrees.jpg',
                'https://cdn2.philibertnet.com/456053-thickbox_default/skyjo.jpg',
                'https://cdn2.philibertnet.com/524668-thickbox_default/les-aventures-de-robin-des-bois.jpg',
                'https://cdn3.philibertnet.com/353015-thickbox_default/codenames-vf.jpg',
                'https://cdn3.philibertnet.com/472228-thickbox_default/the-crew.jpg',
                'https://cdn2.philibertnet.com/522703-thickbox_default/terraforming-mars.jpg',
                'https://cdn1.philibertnet.com/521033-thickbox_default/kingdomino-origins.jpg',
                'https://cdn2.philibertnet.com/513139-thickbox_default/assassin-s-creed-valhalla-orlog-dice-game.jpg',
                'https://cdn3.philibertnet.com/515976-thickbox_default/world-of-warcraft-wrath-of-the-lich-king-a-pandemic-system-board-game.jpg',
                'https://cdn1.philibertnet.com/343934-thickbox_default/7-wonders-duel.jpg',
                'https://cdn2.philibertnet.com/516468-thickbox_default/saint-seiya-le-jeu-de-deckbuilding-poseidon.jpg',
                'https://cdn3.philibertnet.com/525941-thickbox_default/harry-potter-bataille-a-poudlard-extension-sortileges-et-potions.jpg',
                'https://cdn2.philibertnet.com/516904-thickbox_default/le-seigneur-des-anneaux-voyages-en-terre-du-milieu-guerre-ouverte.jpg',
                'https://cdn1.philibertnet.com/494838-thickbox_default/marvel-champions-le-jeu-de-cartes-convoitise-galactique.jpg',
                'https://cdn3.philibertnet.com/503205-thickbox_default/magic-the-gathering-horizons-du-modern-2-bundle.jpg',
                'https://cdn2.philibertnet.com/305958-thickbox_default/uno.jpg',
                'https://cdn1.philibertnet.com/375938-thickbox_default/monopoly-classique.jpg',
                'https://cdn2.philibertnet.com/527633-thickbox_default/scrabble-deluxe.jpg'
            ];

            $faker = Factory::create('fr_FR');

            for($nbrGames = 1; $nbrGames <= 100; $nbrGames++){
                $boardGameCategory = $this->getReference('boardGameCategory_' . $faker->numberBetween(1, 16));

                $boardGame = new BoardGame();

                $boardGame->setName($faker->words(mt_rand(1,4), true));
                $boardGame->setDescription($faker->text(600));
                $boardGame->setPicture($faker->randomElement($boardGamePicturesArray));
                $boardGame->setCategory($boardGameCategory);
            
                $manager->persist($boardGame);

                $this->setReference('boardGame_' . $nbrGames, $boardGame);
            }
            $manager->flush();
        }

        public function getDependencies()
        {
            return [
                BoardGameCategoryFixtures::class
            ];
        }
}


