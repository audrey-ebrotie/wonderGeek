<?php

namespace App\DataFixtures;

use App\Entity\Comic;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ComicFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
        {
            $comicPicturesArray = [
                'https://c8.alamy.com/compfr/t27dd2/italie-1973-premiere-edition-de-marvel-comic-books-couvrir-de-captain-america-t27dd2.jpg',
                'https://terrigen-cdn-dev.marvel.com/content/prod/1x/avengers50_infinitysaga_variant.jpg',
                'https://cdnb.artstation.com/p/assets/images/images/012/822/497/large/alex-loken-cover.jpg?1536692282&dl=1',
                'https://static.wikia.nocookie.net/marveldatabase/images/d/d8/Deadpool_Vol_3_1.jpg/revision/latest?cb=20191227043225',
                'https://mlpnk72yciwc.i.optimole.com/cqhiHLc.WqA8~2eefa/w:auto/h:auto/q:75/https://bleedingcool.com/wp-content/uploads/2020/09/TWDDLX01_Adams-Cover.jpg',
                'https://www.dccomics.com/sites/default/files/imce/2021/11-NOV/BM_Cv118_1in25_var_618447d1a5e754.72998228.jpg',
                'https://www.gamespot.com/a/uploads/original/1562/15626911/3002107-5032115-04-variant.jpg',
                'https://www.hallmark.com/dw/image/v2/AALB_PRD/on/demandware.static/-/Sites-hallmark-master/default/dw8ba9f1e5/images/finished-goods/Marvel-The-Amazing-SpiderMan-Comic-Book-Cover-Fathers-Day-Card-root-599FHE8966_PV.1.FHE8966.jpg_Source_Image.jpg?sw=1920',
                'https://shop.sergiobonelli.it/resizer/1000/-1/true/1491832832859.jpg--le_dieci_tribu___martin_mystere_350_cover.jpg?1491832835000',
                'https://cdn2.originalcomics.fr/26776/buffy-contre-les-vampires-saison-8-tome-1-vf.jpg',
                'https://images-na.ssl-images-amazon.com/images/S/cmx-images-prod/Item/279507/279507._SX1280_QL80_TTD_.jpg',
                'https://bddi.2dcom.fr/LocalImageExists.php?ean=9782811215620&isize=full&gencod=3027166420000&key=DimetGmAYGQEsjiN',
                'https://images.omerlocdn.com/resize?url=https%3A%2F%2Fgcm.omerlocdn.com%2Fproduction%2Fglobal%2Ffiles%2Fimage%2Fb4ddd4dd-70a1-4977-8a46-559f77b48ccc.jpg&width=1200&type=jpeg&stripmeta=true',
                'https://images-na.ssl-images-amazon.com/images/I/81KsPBgzmtL.jpg',
                'https://cdn001.tintin.com/public/tintin/img/static/the-shooting-star/the-shooting-star.jpg',
                'https://i0.wp.com/www.superpouvoir.com/wp-content/uploads/2021/04/Action-Comics-1033-cov-Sampere.jpg?resize=970%2C1491&ssl=1',
                'https://cdn-products.eneba.com/resized-products/5jDEHg3wge1U7YZJVCOM2BTq98NC5lraxlc__mT3bIg_350x200_3x-0.jpeg',
                'https://images-na.ssl-images-amazon.com/images/I/71aGRDbG9WL.jpg'
            ];

            $faker = Factory::create('en_US');

            for($nbrComics = 1; $nbrComics <= 100; $nbrComics++){
                $comicCategory = $this->getReference('comicCategory_' . $faker->numberBetween(1, 17));

                $comic = new Comic();

                $comic->setName($faker->words(mt_rand(1,4), true));
                $comic->setDescription($faker->text(600));
                $comic->setPicture($faker->randomElement($comicPicturesArray));
                $comic->setCategory($comicCategory);

                $authorFirstName = $faker->firstName;
                $authorLastName = $faker->lastName;
                $author = $authorFirstName . ' ' . $authorLastName;
                $comic->setAuthor($author);
            
                $manager->persist($comic);

                $this->setReference('comic_' . $nbrComics, $comic);
            }
            $manager->flush();
        }

        public function getDependencies()
        {
            return [
                ComicCategoryFixtures::class
            ];
        }
}


