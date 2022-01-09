<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Event;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EventFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
        {
            $eventPicturesArray = [
                'https://www.presse-citron.net/app/uploads/2021/06/netflix-geeked-week-summer-game-fest-2021.jpeg',
                'https://www.presse-citron.net/app/uploads/2021/05/koch-media-e3-conference.jpeg',
                'https://images.ctfassets.net/s5n2t79q9icq/114xMnrR6RiLD15UxL8LYZ/ca73ec9fe59f654a150b543e05979181/Meta-Homepage.jpg',
                'https://data.1freewallpapers.com/download/dota-2-1280x720.jpg',
                'https://www.presse-citron.net/app/uploads/2020/04/e3-online.jpg',
                'https://i0.wp.com/www.nintendo-town.fr/wp-content/uploads/2019/04/H2x1_NSwitch_MortalKombat11_image1600w.jpg?fit=1600%2C800&ssl=1',
                'https://www.realite-virtuelle.com/wp-content/uploads/2020/11/pokemon-go-milliard-revenus.jpg',
                'https://www.manga-news.com/public/images/events/geek-unchained-4.jpg',
                'https://github.com/audrey-ebrotie/wonderGeek/blob/develop/public/img/events/encheres_geek.jpeg',
                'https://img.redbull.com/images/c_limit,w_1500,h_1000,f_auto,q_auto/redbullcom/2019/11/08/fc0f91de-3998-4be5-b50e-96d8d9e0cd45/lol-10-ans-league-of-legends',
                'https://fr.web.img2.acsta.net/newsv7/20/06/30/12/28/5740456.jpg',
                'https://www.miraigamers.com/wp-content/uploads/2021/07/Yu-Gi-Oh-Master-Duel-arrive-sur-tous-les-supports-pret-pour-le-Duel.jpg'
            ];


            $faker = Factory::create('fr_FR');

            for($nbrEvents = 1; $nbrEvents <= 100; $nbrEvents++){
                $place = $this->getReference('place_' . $faker->numberBetween(1, 100));
                $owner = $this->getReference('user_' . $faker->numberBetween(1, 500));
                $eventCategory = $this->getReference('eventCategory_' . $faker->numberBetween(1, 6));

                $event = new Event();

                $event->setName($faker->words(mt_rand(3,10), true));
                $event->setDescription($faker->text(300));

                $event->setPicture($faker->randomElement($eventPicturesArray));

                $event->setStartAt($faker->dateTimeBetween('-1 week', '+6 months'));

                $startDate = $event->getStartAt();
                $event->setEndAt($faker->dateTimeBetween($startDate, $startDate->format('Y-m-d H:i:s').'+3 days'));
                
                $event->setCapacity($faker->numberBetween(NULL, 500));

                if($nbrEvents % 5)
                    $event->setPlace($place);
                else
                    $event->setPlace(NULL);

                $event->setOwner($owner);
                $event->setCategory($eventCategory);
            
                $manager->persist($event);

                $this->setReference('event_' . $nbrEvents, $event);
            }
            $manager->flush();
        }

        public function getDependencies()
        {
            return [
                UserFixtures::class,
                PlaceFixtures::class,
                EventCategoryFixtures::class,
            ];
        }
}


