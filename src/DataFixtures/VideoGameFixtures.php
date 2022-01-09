<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\VideoGame;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class VideoGameFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
        {
            $videoGamePicturesArray = [
                'https://image.jeuxvideo.com/medias-sm/163396/1633959248-729-jaquette-avant.gif',
                'https://image.jeuxvideo.com/medias/163664/1636636223-8849-jaquette-avant.jpg',
                'https://image.jeuxvideo.com/medias/163187/1631865000-7055-jaquette-avant.jpg',
                'https://image.jeuxvideo.com/medias/159542/1595423317-2836-jaquette-avant.png',
                'https://image.jeuxvideo.com/medias/163299/1632989599-6459-jaquette-avant.gif',
                'https://image.jeuxvideo.com/medias/159403/1594028554-187-jaquette-avant.jpg',
                'https://image.jeuxvideo.com/medias/163881/1638806697-8764-jaquette-avant.gif',
                'https://letempscompere.fr/wp-content/uploads/2021/08/KyBRbcz5wCqPrdr7QFfUniEg-2048x1536.webp',
                'https://image.jeuxvideo.com/medias/163129/1631285061-4363-jaquette-avant.jpg',
                'https://image.jeuxvideo.com/medias/161277/1612766574-6606-jaquette-avant.png',
                'https://image.jeuxvideo.com/medias/163342/1633418743-1593-jaquette-avant.gif',
                'https://image.jeuxvideo.com/medias/163214/1632142889-7692-jaquette-avant.jpg',
                'https://image.jeuxvideo.com/medias/163161/1631607413-3853-jaquette-avant.jpg',
                'https://image.jeuxvideo.com/medias/163154/1631541998-5162-jaquette-avant.jpg',
                'https://image.jeuxvideo.com/medias/163708/1637080607-7753-jaquette-avant.gif',
                'https://image.jeuxvideo.com/medias/163353/1633528483-9809-jaquette-avant.jpg',
                'https://image.jeuxvideo.com/medias/163214/1632143636-6808-jaquette-avant.jpg',
                'https://image.jeuxvideo.com/medias/163299/1632989749-6428-jaquette-avant.gif',
                'https://image.jeuxvideo.com/medias/163335/1633353168-8875-jaquette-avant.gif',
                'https://image.jeuxvideo.com/medias/163154/1631535511-3744-jaquette-avant.jpg',
                'https://media.senscritique.com/media/000020040912/source_big/Resident_Evil_Village.png',
                'https://image.jeuxvideo.com/medias/161616/1616164719-8684-jaquette-avant.jpg',
                'https://image.jeuxvideo.com/medias/148285/1482854953-4348-jaquette-avant.jpg',
                'https://image.jeuxvideo.com/images/jaquettes/00027602/jaquette-league-of-legends-pc-cover-avant-g.jpg',
                'https://image.jeuxvideo.com/medias/151689/1516893501-9622-jaquette-avant.jpg',
                'https://image.jeuxvideo.com/medias/149432/1494322310-8900-jaquette-avant.jpg',
                'https://paradoxetemporel.fr/wp-content/uploads/2020/06/jaquette-the-last-of-us-part-2.jpg',
                'https://global-img.gamergen.com/red-dead-redemption-2-pc-mediamarkt_0900909672.jpg',
                'https://image.jeuxvideo.com/medias/150166/1501664378-9988-jaquette-avant.jpg',
                'https://image.jeuxvideo.com/medias/142247/1422469608-7141-jaquette-avant.jpg',
                'https://image.jeuxvideo.com/medias/152899/1528990462-7760-jaquette-avant.jpg',
                'https://image.jeuxvideo.com/medias/163162/1631620218-5546-jaquette-avant.gif',
                'https://image.jeuxvideo.com/medias/158826/1588264397-5261-jaquette-avant.jpg',
                'https://image.jeuxvideo.com/images/jaquettes/00048634/jaquette-les-sims-4-pc-cover-avant-g-1409904702.jpg'
            ];

            $faker = Factory::create('fr_FR');

            for($nbrGames = 1; $nbrGames <= 100; $nbrGames++){
                $platform1 = $this->getReference('platform_1');
                $platform2 = $this->getReference('platform_2');
                $platform3 = $this->getReference('platform_3');
                $platform4 = $this->getReference('platform_4');
                $platform5 = $this->getReference('platform_5');
                $platform6 = $this->getReference('platform_6');
                $platform7 = $this->getReference('platform_7');
                $platform8 = $this->getReference('platform_8');
                $videoGameCategory = $this->getReference('videoGameCategory_' . $faker->numberBetween(1, 19));

                $videoGame = new VideoGame();

                $videoGame->setName($faker->words(mt_rand(1,4), true));
                $videoGame->setDescription($faker->text(300));
                $videoGame->setPicture($faker->randomElement($videoGamePicturesArray));
                $videoGame->setCategory($videoGameCategory);

                $randomNbr = mt_rand(1, 10);

                switch ($randomNbr) {
                    case 1:
                        $videoGame->addPlatform($platform1);
                        break;
                    case 2:
                        $videoGame->addPlatform($platform1);
                        $videoGame->addPlatform($platform2);
                        break;
                    case 3:
                        $videoGame->addPlatform($platform1);
                        $videoGame->addPlatform($platform2);
                        $videoGame->addPlatform($platform3);
                        break;
                    case 4:
                        $videoGame->addPlatform($platform1);
                        $videoGame->addPlatform($platform2);
                        $videoGame->addPlatform($platform3);
                        $videoGame->addPlatform($platform4);
                        break;
                    case 5:
                        $videoGame->addPlatform($platform1);
                        $videoGame->addPlatform($platform2);
                        $videoGame->addPlatform($platform3);
                        $videoGame->addPlatform($platform4);
                        $videoGame->addPlatform($platform5);
                        break;
                    case 6:
                        $videoGame->addPlatform($platform1);
                        $videoGame->addPlatform($platform2);
                        $videoGame->addPlatform($platform3);
                        $videoGame->addPlatform($platform4);
                        $videoGame->addPlatform($platform5);
                        $videoGame->addPlatform($platform6);
                        break;
                    case 7:
                        $videoGame->addPlatform($platform1);
                        $videoGame->addPlatform($platform2);
                        $videoGame->addPlatform($platform3);
                        $videoGame->addPlatform($platform4);
                        $videoGame->addPlatform($platform5);
                        $videoGame->addPlatform($platform6);
                        $videoGame->addPlatform($platform7);
                        break;
                    case 8:
                        $videoGame->addPlatform($platform1);
                        $videoGame->addPlatform($platform2);
                        $videoGame->addPlatform($platform3);
                        $videoGame->addPlatform($platform4);
                        $videoGame->addPlatform($platform5);
                        $videoGame->addPlatform($platform6);
                        $videoGame->addPlatform($platform7);
                        $videoGame->addPlatform($platform8);
                        break;
                    case 9:
                        $videoGame->addPlatform($platform8);
                    case 10:
                        $videoGame->addPlatform($platform5);
                        $videoGame->addPlatform($platform6);
                        $videoGame->addPlatform($platform1);
                        $videoGame->addPlatform($platform2);
                    default:
                        $videoGame->addPlatform($platform4);
                        $videoGame->addPlatform($platform7);
                    
                }
                $manager->persist($videoGame);

                $this->setReference('videoGame_' . $nbrGames, $videoGame);
            }
            $manager->flush();
        }

        public function getDependencies()
        {
            return [
                VideoGameCategoryFixtures::class,
                PlatformFixtures::class
            ];
        }
}


