<?php

namespace App\DataFixtures;


use App\Entity\Manga;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class MangaFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
        {
            $mangaPicturesArray = [
                'https://images-na.ssl-images-amazon.com/images/I/91tYV+R03kL.jpg',
                'https://images-na.ssl-images-amazon.com/images/I/918Ai9a893L.jpg',
                'https://images-na.ssl-images-amazon.com/images/I/91yiBtD0imL.jpg',
                'https://images-na.ssl-images-amazon.com/images/I/91OuigKWs+L.jpg',
                'https://fr.web.img5.acsta.net/pictures/21/02/16/12/45/5319199.jpg',
                'https://images-na.ssl-images-amazon.com/images/I/913g8zhpCYL.jpg',
                'https://images-na.ssl-images-amazon.com/images/I/81H14PAKlPL.jpg',
                'https://images-na.ssl-images-amazon.com/images/I/81mWACgHKxL.jpg',
                'https://images-na.ssl-images-amazon.com/images/I/818SKXrgHaL.jpg',
                'https://images-na.ssl-images-amazon.com/images/I/91hcXocudXL.jpg',
                'https://images-na.ssl-images-amazon.com/images/I/81dfhgbb2qL.jpg',
                'https://images-na.ssl-images-amazon.com/images/I/91xNW4qPPfL.jpg',
                'https://www.gbposters.com/media/catalog/product/cache/2/image/9df78eab33525d08d6e5fb8d27136e95/f/a/fairy-tail-quad-maxi-poster-1.133.jpg',
                'https://images-na.ssl-images-amazon.com/images/I/71FH4o9mO3S.jpg',
                'https://images-na.ssl-images-amazon.com/images/I/91a19RuprqL.jpg',
                'https://images-na.ssl-images-amazon.com/images/I/81Z5oMQHqaL.jpg',
                'https://images-na.ssl-images-amazon.com/images/I/71V1kRB2fTL.jpg',
                'https://images-na.ssl-images-amazon.com/images/I/61BhDFVSCTL.jpg',
                'https://images-na.ssl-images-amazon.com/images/I/81VDeAyH1GL.jpg',
                'https://images-na.ssl-images-amazon.com/images/I/81YMjfFuX6L.jpg',
                'https://images-na.ssl-images-amazon.com/images/I/71LrevXJ4UL.jpg',
                'https://www.pika.fr/sites/default/files/images/livres/couv/9782811607135-T.jpg',
                'https://images-na.ssl-images-amazon.com/images/I/71iPhxzPaoL.jpg',
                'https://m.media-amazon.com/images/I/81zUMXGbNGL._AC_SL1500_.jpg'
            ];

            $faker = Factory::create('en_US');

            for($nbrMangas = 1; $nbrMangas <= 100; $nbrMangas++){
                $mangaCategory = $this->getReference('mangaCategory_' . $faker->numberBetween(1, 4));

                $manga = new Manga();

                $manga->setName($faker->words(mt_rand(1,4), true));
                $manga->setDescription($faker->text(300));
                $manga->setPicture($faker->randomElement($mangaPicturesArray));
                $manga->setCategory($mangaCategory);

                $authorFirstName = $faker->firstName;
                $authorLastName = $faker->lastName;
                $author = $authorFirstName . ' ' . $authorLastName;
                $manga->setAuthor($author);
            
                $manager->persist($manga);

                $this->setReference('manga_' . $nbrMangas, $manga);
            }
            $manager->flush();
        }

        public function getDependencies()
        {
            return [
                MangaCategoryFixtures::class
            ];
        }
}


