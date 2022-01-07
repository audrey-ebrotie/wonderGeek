-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : jeu. 06 jan. 2022 à 22:29
-- Version du serveur : 5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `wonderGeek`
--

-- --------------------------------------------------------

--
-- Structure de la table `board_game`
--

CREATE TABLE `board_game` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `board_game_category`
--

CREATE TABLE `board_game_category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `board_game_category`
--

INSERT INTO `board_game_category` (`id`, `name`) VALUES
(1, 'Jeu de dés'),
(2, 'Jeu d\'adresse'),
(3, 'Jeu d\'ambiance'),
(4, 'Jeu de cartes'),
(5, 'Jeu de plateau'),
(6, 'Jeu de mémoire'),
(7, 'Jeu de connaissance'),
(8, 'Jeu de lettres'),
(9, 'Jeu de logique'),
(10, 'Jeu de pions'),
(11, 'Jeu d\'enquête'),
(12, 'Jeu de coopération'),
(13, 'Jeu de bluff'),
(14, 'Jeu de stratégie'),
(15, 'Jeu de gestion'),
(16, 'Jeu de hasard'),
(17, 'Jeu de rôle');

-- --------------------------------------------------------

--
-- Structure de la table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reference` binary(16) NOT NULL COMMENT '(DC2Type:uuid)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comic`
--

CREATE TABLE `comic` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comic_category`
--

CREATE TABLE `comic_category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comic_category`
--

INSERT INTO `comic_category` (`id`, `name`) VALUES
(1, 'Action / Aventure'),
(2, 'Humoristique'),
(3, 'Fantastique'),
(4, 'Heroic Fantasy'),
(5, 'Policier / Enquête'),
(6, 'Historique'),
(7, 'Horreur'),
(8, 'Arts Martiaux'),
(9, 'Musical'),
(10, 'Romance'),
(11, 'Science Fiction'),
(12, 'Sports'),
(13, 'Espionnage'),
(14, 'Steampunk'),
(15, 'Superhero'),
(16, 'Ados'),
(17, 'Guerre'),
(18, 'Western');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220106115344', '2022-01-06 11:55:50', 1060);

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `place_id` int(11) DEFAULT NULL,
  `owner_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_at` datetime NOT NULL,
  `end_at` datetime NOT NULL,
  `capacity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `event_category`
--

CREATE TABLE `event_category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `event_category`
--

INSERT INTO `event_category` (`id`, `name`) VALUES
(1, 'Salon grand public'),
(2, 'Partie en ligne'),
(3, 'Partie en local (LAN Party)'),
(4, 'Tournoi'),
(5, 'Meeting'),
(6, 'Vente aux enchères');

-- --------------------------------------------------------

--
-- Structure de la table `manga`
--

CREATE TABLE `manga` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `manga`
--

INSERT INTO `manga` (`id`, `category_id`, `name`, `description`, `picture`, `author`) VALUES
(1, 2, 'L\'Attaque des Titans', 'L’œuvre de Hajime Isayama est absolument grandiose. Le mangaka nous emmène au cœur d’une cité entièrement protégée par des remparts dans un monde ravagé par les Titans, des créatures gigantesques qui détruisent l’humanité. Une intrigue à couper le souffle, ponctuée de scènes d’horreur, de sentiments et de notes d’espoir.', 'https://images-na.ssl-images-amazon.com/images/I/91tYV+R03kL.jpg', 'Hajime Isayama'),
(2, 2, 'One Piece', 'Ce manga mythique né en 1997 est sans aucun doute le plus célèbre au monde. Avec plus de 480 millions ce shonen signé Eiichirō Oda est le plus vendu de toute l’histoire du manga. Compilée en 98 volumes, l’histoire du pirate Luffy et de son équipage bat tous les records de la BD japonaise !', 'https://images-na.ssl-images-amazon.com/images/I/918Ai9a893L.jpg', 'Eiichirō Oda'),
(3, 2, 'Naruto', 'Avec plus de 250 millions d’exemplaires vendus, Naruto fait partie du Top 3 des meilleurs mangas. Le shonen créé par Masashi Kishimoto rencontre un succès remarquable peu après sa sortie en 1999. Avec ses 72 albums, les aventures de l’orphelin ninja au caractère espiègle feront le bonheur de nombreux adolescents et adultes nostalgiques.', 'https://images-na.ssl-images-amazon.com/images/I/91yiBtD0imL.jpg', 'Masashi Kishimoto'),
(4, 2, 'Hunter X Hunter', 'Ce shonen signé Yoshihiro Togashi fait partie des meilleurs mangas japonais. Prépublié en 1998, il comprend 36 volumes aujourd’hui. Gon rêve de devenir hunter comme son père. Cette distinction réservée à l’élite nécessite de passer par un examen annuel extrêmement sélectif et dangereux. Le suspense est terrible !', 'https://images-na.ssl-images-amazon.com/images/I/91OuigKWs+L.jpg', 'Yoshihiro Togashi'),
(5, 2, 'My Hero Academia', 'Ce manga de Koshei Horikoshi, sorti en 2014 nous plonge dans l’univers fantastique des super-héros à travers le personnage de Izuku Midoriya. Un mélange de culture japonaise et de comics américain qui séduira les fans de combats héroïques.', 'https://fr.web.img5.acsta.net/pictures/21/02/16/12/45/5319199.jpg', 'Koshei Horikoshi'),
(6, 2, 'Dragon Ball', 'Impossible de ne pas se souvenir de Dragon Ball, le manga culte d’Akira Toriyama qui a marqué plusieurs générations depuis 1984. Ce shonen raconte l’histoire de Son Goku, un petit garçon doté d’une force légendaire, en quête de 7 boules de cristal capables d’exaucer n’importe quel vœu une fois réunies. Avec l’aide de ses amis, il va combattre de nombreux adversaires. Véritable phénomène, Dragon Ball est le manga le plus vendu au monde juste après l’indétrônable One Piece. Par ailleurs, il est classé 3e meilleur manga de tous les temps au Japon.', 'https://images-na.ssl-images-amazon.com/images/I/913g8zhpCYL.jpg', 'Akira Toriyama'),
(7, 2, 'Demon Slayer', 'Connu également sous le nom de Kimetsu no Yaiba au Japon, le shonen de Koyoharu Gotōg, raconte l’histoire d’un jeune marchand qui tente de sauver sa petite sœur transformée en démon. Avec plus de 150 millions de tirages, Demon Slayer est l’un des mangas les plus vendus au monde. Un shonen classique avec un style graphique original, à lire absolument.', 'https://images-na.ssl-images-amazon.com/images/I/81H14PAKlPL.jpg', 'Koyoharu Gotōg'),
(8, 2, 'Jojo\'s Bizarre Adventure', 'Ce manga paru en 1986 est un chef d’œuvre de Hirohiki Araki qui compte de nombreux fans au Japon. Jojo est issu d’une noble famille anglaise. Alors que son frère adoptif tente de lui voler son héritage, il va tout faire pour l’en empêcher. Avec 98 tomes, la saga nous fait voyager à travers le monde et les époques. On se retrouve dans des univers totalement différents à travers les héros de la lignée de Jojo. Ce shonen plaira aux amateurs de combats stratégiques.', 'https://images-na.ssl-images-amazon.com/images/I/81mWACgHKxL.jpg', 'Hirohiki Araki'),
(9, 4, 'Berserk', 'Berserk (1990) est un seinen créé par Kentaro Miura qui nous immerge dans un univers fantastique à l’époque médiévale. Suivez les aventures de Guts, un guerrier rattaché à une troupe de mercenaires, décidé à retrouver sa liberté. Ce manga au style graphique remarquable, réjouira les adultes fans de dark fantasy.', 'https://images-na.ssl-images-amazon.com/images/I/818SKXrgHaL.jpg', 'Kentaro Miura'),
(10, 2, 'Death Note', 'Death Note (2003) est un shonen manga de Tsugumi Oba, illustré par Takeshi Obata. La BD raconte l’histoire d’un jeune homme qui trouve un carnet au pouvoir étrange… celui de provoquer la mort. Ce mélange de thriller et de fantastique offre une intrigue absolument saisissante. Pour les adeptes des mangas policiers.', 'https://images-na.ssl-images-amazon.com/images/I/91hcXocudXL.jpg', 'Tsugumi Oba'),
(11, 2, 'Bleach', 'Avec une collection de 74 tomes, cette série manga de Tite Kubo apparue en 2002 n’a pas fini de régaler les amateurs de shonen. Bleach c’est l’histoire d’un adolescent d’apparence ordinaire qui devient chasseur de démons. Avec 120 millions de volumes écoulés, il fait partie des hits mangas.', 'https://images-na.ssl-images-amazon.com/images/I/81dfhgbb2qL.jpg', 'Tite Kubo'),
(12, 2, 'Dr Stone', 'Dr Stone est un manga post apocalyptique conçu par le scénariste japonais Riichiro Ingaki et le talentueux dessinateur Boichi. Paru en 2017 dans le magazine de prépublication qui a lancé Dragon Ball, ce manga est un véritable succès. Un lycéen se réveille dans un monde entièrement fossilisé. Avec l’aide de son ami Senku, il va reconstruire l’humanité.', 'https://images-na.ssl-images-amazon.com/images/I/91xNW4qPPfL.jpg', 'Riichiro Ingaki'),
(13, 2, 'Fairy Tail', 'Fairy Tail (2006) est un manga à succès de Hiro Mashima qui réunit 63 tomes, 328 épisodes, deux films d’animation et plusieurs OAV. Alors qu’elle tentait de rejoindre la plus grande guildes de magie, Lucy se retrouve piégée. Au programme une bonne dose de magie, de l’aventure, des esprits et des personnages tout à fait bluffant. Fairy Tail et son univers féérique enchantera les fans de magie.', 'https://www.gbposters.com/media/catalog/product/cache/2/image/9df78eab33525d08d6e5fb8d27136e95/f/a/fairy-tail-quad-maxi-poster-1.133.jpg', 'Hiro Mashima'),
(14, 2, 'Moriarty the Patriot', 'Cette série de manga apparue en 2016 et imaginée par Ryōsuke Takeuchi emballera les fans de Sherlok Holmes. Sous les traits de Hikaru Miyoshi, Moriarty nous embarque au 19e siècle à Londres dans un univers mystérieux. Au sein d’une famille d’aristocrates, Albert adopte deux orphelins… une histoire où les complots se mêlent au rêve d’une société meilleure.', 'https://images-na.ssl-images-amazon.com/images/I/71FH4o9mO3S.jpg', 'Ryōsuke Takeuchi'),
(15, 2, 'Seven Deadly Sins', 'Ce shonen manga de 41 volumes est un petit bijou de Nakaba Susuki paru en 2012 et adapté en série animée. Les épisodes de la quatrième saison sont diffusés aujourd’hui sur Netflix. L’histoire est celle d’une jeune fille qui tente de retrouver 7 chevaliers légendaires pour sauver le royaume. Une histoire fantastique pleine d’aventure avec des dessins magnifiques.', 'https://images-na.ssl-images-amazon.com/images/I/91a19RuprqL.jpg', 'Nakaba Susuki'),
(16, 3, 'Ascendance of a Bookworm', 'Cette web-série de 2013 éditée en light novel puis adaptée en manga sous le nom de « La petite faiseuse de livre », relate la vie d’Urano Motosu, une jeune fille passionnée de lecture, qui suite à un terrible accident se réincarne dans la peau d’une petite fille de l’époque médiévale. Privée de livre, elle ne se laisse pas abattre pour autant. Ce shojo de Miya Kazuki est un isekai original qui ravira les amoureux de livres.', 'https://images-na.ssl-images-amazon.com/images/I/81Z5oMQHqaL.jpg', 'Miya Kazuki'),
(17, 2, 'Full Metal Alchemist', 'Ce manga culte de Hiromu Arakawa sorti en 2001 raconte l’histoire de deux frères prêts à tout pour faire revenir leur mère décédée. Pour arriver à leurs fins, ils vont utiliser l’alchimie, mais l’expérience tourne au fiasco. FMA est un shonen à la fois complexe et plein de rebondissements qui enchantera les amateurs d’aventure et d’univers fantastique.', 'https://images-na.ssl-images-amazon.com/images/I/71V1kRB2fTL.jpg', 'Hiromu Arakawa'),
(18, 4, 'Erased', 'Sorti en  2012, Erased est un seinen de 8 volumes écrit et dessiné par Key Sanbe. Un mangaka qui peine à lancer sa carrière possède un don surprenant lui permettant de remonter dans le temps avant qu’un drame ne se produise. Erased et son suspens insoutenable rendront accro les amateurs de thriller.', 'https://images-na.ssl-images-amazon.com/images/I/61BhDFVSCTL.jpg', 'Key Sanbe'),
(19, 2, 'GTO', 'GTO (1997) est un manga shonen imaginé par Toru Fujisawa qui comprend une collection de 25 tomes. Un professeur au passé discutable va amadouer une classe réputée difficile avec ses méthodes inhabituelles. En plus d’être particulièrement drôle, GTO traite de sujets plus profonds telles que l’intégration sociale ou les problèmes familiaux dans les milieux défavorisés.', 'https://images-na.ssl-images-amazon.com/images/I/81VDeAyH1GL.jpg', 'Toru Fujisawa'),
(20, 3, 'Nana', 'Ce shojo manga imaginé par Ai Yazawa est un véritable régal pour les passionnés de musique et de romance. Nana est une série de manga compilé en 21 volumes qui raconte l’amitié entre deux filles très différentes dont le destin va se croiser. Ce manga aborde la dépendance affective, l’amour et la complexité des relations à travers des personnages touchants.', 'https://images-na.ssl-images-amazon.com/images/I/81YMjfFuX6L.jpg', 'Ai Yazawa'),
(21, 4, 'One Punch Man', 'One Punch man est un manga en ligne, crée par One en 2009 avant d’être illustré par le dessinateur Yusuke Murata. Saitama est un homme triste jusqu’au jour où il se décide à devenir un super-héros. Depuis 20012, la saga compte aujourd‘hui 25 volumes. Dès sa sortie, cette série truffée d’humour rencontre un franc succès. Elle ravira les amateurs d’ironie mordante.', 'https://images-na.ssl-images-amazon.com/images/I/71LrevXJ4UL.jpg', 'ONE, Yusuke Murata'),
(22, 2, 'Sword Art Online', 'SAO (2012) est un manga shonen inspiré du light novel de Reki Kawahara. En 2022, Kirito se retrouve coincé à l’intérieur d’un jeu vidéo en réalité virtuelle. Il devra terminer le jeu pour s’en sortir indemne. L’aspect futuriste et l’univers du gaming enchantera les lecteurs geek à coup sûr !', 'https://images-na.ssl-images-amazon.com/images/I/91dG6fKO33L.jpg', 'Reki Kawahara'),
(23, 3, 'Skip Beat', 'Yoshiki Nakamura nous raconte l’histoire de Kyoko, une jeune fille généreuse trahie par son ami d’enfance devenu célèbre grâce à elle. Elle va alors devoir se hisser au rang de star à son tour pour assouvir sa vengeance. Sorti en 2002, ce shojo hilarant et bourré de suspense compte aujourd’hui 46 albums.', 'https://images-na.ssl-images-amazon.com/images/I/81e2eg-Q3HL.jpg', 'Yoshiki Nakamura'),
(24, 5, 'Happy Marriage ?!', 'Chiwa Takanashi, 22 ans, aucun petit ami connu, est une employée de bureau “presque banale”…Mais pour rembourser les dettes de son père, elle mène une double vie, travaillant le soir dans un bar à hôtesses. Un jour, son secret est dévoilé, et soudain… la voilà mariée! Entre mariage de raison et sentiments contradictoires, Chiwa va découvrir du jour au lendemain les joies et les galères de la vie de couple!', 'https://images-na.ssl-images-amazon.com/images/I/81d+qAy+U2L.jpg', 'Maki Enjōji'),
(25, 5, 'Nodame Cantabile', 'Shin\'ichi Chiaki est le fils d\'un célèbre pianiste de stature internationale. C\'est aussi l\'élève le plus doué de l\'université de musique où il étudie le piano en 3e année. Il rêve de partir en Europe étudier la direction d\'orchestre. Malheureusement, il est coincé au Japon ! C\'est là qu\'il fait la connaissance de Nodame, une jeune fille excentrique qui a fait de son appartement une vraie décharge publique... Pourtant, elle montre un talent certain pour le piano... L\'histoire de ces deux jeunes mélomanes ne fait que commencer...', 'https://images-na.ssl-images-amazon.com/images/I/81LYH+R6mUL.jpg', 'Tomoko Ninomiya'),
(26, 5, 'Les Fleurs du Passé', 'Hazuki est tombé sous le charme d\'une jeune fleuriste de 30 ans, Rokka. Incapable de lui faire part de ses sentiments, il se contente d\'aller chaque jour lui acheter une plante, se satisfaisant de ce maigre contact qu\'il a avec elle.\r\nLassé de cette situation et de l’impressionnante collection de plantes s\'entassant dans son appartement, il va voir la chance lui sourire lorsque Rokka cherchera de l\'aide pour tenir sa boutique. Se faisant immédiatement engager, Hazuki, ravi, se dit que son rêve devient enfin réalité.\r\nMais ce qu\'il n\'aurait jamais pu prévoir, c\'est qu\'un concurrent inattendu lui barre la route vers son idylle. En effet, Hazuki va se rendre compte que l\'objet de ses désirs est hanté par le fantôme de son ex-mari, Shimao, et qu\'il est le seul à pouvoir le voir et l\'entendre...\r\nComment Hazuki surmontera-t-il l\'intrusion d\'un fantôme dans ses efforts pour construire une relation amoureuse ? Rokka est-elle vraiment capable de retrouver l\'amour après la perte de son mari ? Et quelle douleur peut bien ressentir Shimao en assistant à une romance naissante entre sa femme et un autre homme ?...', 'https://www.journaldujapon.com/wp-content/uploads/2014/05/1_nojdj11.jpg', 'Kawachi Haruka'),
(27, 1, 'Mirumo de Pon', 'Kaede reçoit un jour une tasse Mug sous laquelle figure cette mention: \"Mirumo exauce tous vos voeux d\'amour\". N\'y croyant pas trop, elle qui est secrètement amoureuse d\'un garçon de son lycée, s\'essaie quand même à invoquer le génie de l\'Amour. À sa grande surprise, un petit lutin espiègle aux joues toutes roses et au bonnet bleu sort de la tasse... Mirumo a des pouvoirs magiques mais on dirait que, par pure malice, il s\'arrange pour ne pas écouter les voeux de Kaede!', 'https://images-na.ssl-images-amazon.com/images/I/81T2hiMFiSL.jpg', 'Hiromu Shinozuka'),
(28, 3, 'Sailor Moon', 'Usagi est une jeune fille de 14 ans comme tant d\'autres : elle aime dormir, jouer aux jeux vidéo, elle pleure pour un oui ou pour un non et elle ne se passionne pas pour ses études. Mais un beau jour, elle croise le chemin de Luna, un chat doué de parole qui va la transformer en une jolie justicière : Sailor Moon ! La voilà investie de plusieurs missions : elle doit identifier ses alliées, retrouver le légendaire Cristal d\'Argent et protéger une certaine princesse… tout en luttant contre de mystérieux ennemis qui sont eux aussi à la recherche du fabuleux cristal aux pouvoirs fantastiques !', 'https://www.pika.fr/sites/default/files/images/livres/couv/9782811607135-T.jpg', 'Naoko Takeuchi'),
(29, 1, 'Pokémon - La Grande Aventure', 'Six mois se sont écoulés depuis la catastrophe, impliquant Kyogre et Groudon. Rouge et Bleu embarquent pour les Îles de Sevii sur les traces du Professeur Chen. Ils vont être témoins d\'une terrible tragédie dont est victime leur amie Verte. C\'est le début d\'une nouvelle grande aventure où nos héros vont devoir déjouer le sombre complot d\'un vieil ennemi qu\'ils pensaient disparu...', 'https://images-na.ssl-images-amazon.com/images/I/71iPhxzPaoL.jpg', 'Hidenori Kusaka'),
(30, 1, 'Beyblade Metal Fusion', 'Ginga est un blader au cœur ardent qui aime affronter des adversaires de taille. Pour sauver Kenta, enlevé par la bande des \"Chasseurs de têtes\", il accepte de relever le défi de leur leader, Kyôya. Après un combat particulièrement ardu, voilà qu\'apparaît Ryûga, le chef de la mystérieuse organisation de la \"Nébuleuse Noire\" qui tua le père de Ginga, afin de s\'emparer de la toupie interdite, la terrible L-drago. Confronté à son ennemi juré, et brûlant de se venger, notre jeune héros va devoir rassembler toutes ses forces pour terrasser ce nouvel adversaire !', 'https://m.media-amazon.com/images/I/81zUMXGbNGL._AC_SL1500_.jpg', 'Takafumi Adachi');

-- --------------------------------------------------------

--
-- Structure de la table `manga_category`
--

CREATE TABLE `manga_category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `manga_category`
--

INSERT INTO `manga_category` (`id`, `name`) VALUES
(1, 'Kodomo'),
(2, 'Shonen'),
(3, 'Shojo'),
(4, 'Seinen'),
(5, 'Josei');

-- --------------------------------------------------------

--
-- Structure de la table `place`
--

CREATE TABLE `place` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `place`
--

INSERT INTO `place` (`id`, `name`, `street`, `zipcode`, `city`, `country`) VALUES
(1, 'Lemaire', '38, chemin Marques', '90158', 'Leger', 'FR'),
(2, 'Morel Allain S.A.R.L.', '64, impasse Bonneau', '24 384', 'Mace-sur-Mendes', 'FR'),
(3, 'Perez', '64, rue de Gros', '94488', 'Bousquet', 'FR'),
(4, 'Letellier', '20, impasse de Robert', '27584', 'Toussaint', 'FR'),
(5, 'Thibault Girard SAS', '77, rue Adrien Torres', '98 419', 'Didier', 'FR'),
(6, 'Chevalier SA', '721, place de Colin', '22 593', 'Tessier-sur-Chartier', 'FR'),
(7, 'Philippe', '71, place de Leleu', '15859', 'Huetnec', 'FR'),
(8, 'Dufour', 'rue François Buisson', '40 113', 'Adam', 'FR'),
(9, 'Faivre', '81, rue Samson', '71 174', 'PhilippeVille', 'FR'),
(10, 'Leleu S.A.', '65, rue Lacombe', '81194', 'Lopes-sur-Fabre', 'FR'),
(11, 'Richard SARL', '12, rue Margaud Delahaye', '96 379', 'Gimenezboeuf', 'FR'),
(12, 'Descamps Martineau SAS', 'rue Marianne Pereira', '95 373', 'Jacquesnec', 'FR'),
(13, 'Daniel Perez SA', 'impasse de Bodin', '82 063', 'RobinBourg', 'FR'),
(14, 'Lacroix Chauveau et Fils', '6, rue Margaud Coste', '61697', 'Riou', 'FR'),
(15, 'Delannoy Rey S.A.S.', '295, avenue Sébastien Thomas', '53969', 'Lelievre', 'FR'),
(16, 'Etienne Chartier S.A.R.L.', '9, avenue de Blanc', '68 682', 'Pelletier', 'FR'),
(17, 'Jacob Dumont S.A.R.L.', '1, chemin Célina Ferrand', '09 573', 'GuillotBourg', 'FR'),
(18, 'Prevost', '30, rue Aurore Carre', '19 776', 'Lebreton-sur-Gillet', 'FR'),
(19, 'Schneider', '47, rue de Durand', '56 464', 'Meunier-sur-Jean', 'FR'),
(20, 'Pelletier', '96, boulevard de Rocher', '91 478', 'Renaud', 'FR'),
(21, 'Voisin Andre SAS', '96, impasse de Lejeune', '47128', 'Mace', 'FR'),
(22, 'Gaudin SARL', 'rue Collet', '79 408', 'Charrier-sur-Mer', 'FR'),
(23, 'Benoit', '58, boulevard Guillaume Nicolas', '32 713', 'Bazin-la-Forêt', 'FR'),
(24, 'Blondel', '82, place de Lelievre', '51938', 'GillesBourg', 'FR'),
(25, 'Guillet Bonnin S.A.S.', '84, chemin de Guilbert', '82 908', 'Guyot', 'FR'),
(26, 'Mathieu', '91, rue Pierre Dubois', '25876', 'Gillet', 'FR'),
(27, 'Tanguy', 'rue Roger Pelletier', '13 358', 'BoulangerVille', 'FR'),
(28, 'Hoarau', '6, impasse Henri Dumont', '18 176', 'Antoine-sur-Mer', 'FR'),
(29, 'Antoine Pottier SAS', '32, chemin de Ribeiro', '50 781', 'Arnaud', 'FR'),
(30, 'Meunier', 'impasse Hamon', '52989', 'Colin-la-Forêt', 'FR'),
(31, 'Delmas SA', '265, rue de Baudry', '54 629', 'Auger', 'FR'),
(32, 'Aubry Lacombe SAS', '76, chemin de Gay', '27136', 'Paris', 'FR'),
(33, 'Dupuy', '71, rue de Grondin', '83290', 'Bodin', 'FR'),
(34, 'Vallet', '9, rue de Bigot', '88 256', 'Bourgeois-les-Bains', 'FR'),
(35, 'Seguin', 'rue de Pierre', '83 534', 'Goncalves', 'FR'),
(36, 'Martineau', '64, rue Vincent Dupre', '98 379', 'MichelBourg', 'FR'),
(37, 'Bernier Salmon S.A.S.', 'chemin Pauline Boulanger', '61619', 'Renard-sur-Aubert', 'FR'),
(38, 'Moreau', 'boulevard Monique Fontaine', '54174', 'RodriguesVille', 'FR'),
(39, 'Mercier', 'chemin Lecomte', '45 119', 'Julien', 'FR'),
(40, 'Delorme S.A.R.L.', '48, rue Ribeiro', '56316', 'Lenoir', 'FR'),
(41, 'Bernier Bousquet S.A.S.', '52, place Denis Remy', '04527', 'Sauvagenec', 'FR'),
(42, 'Marechal', '565, avenue Adélaïde Caron', '40 168', 'Da Silva-sur-Jacquot', 'FR'),
(43, 'Voisin SAS', 'avenue Marin', '21373', 'Sauvage-les-Bains', 'FR'),
(44, 'Neveu', '34, rue Jean Descamps', '48 187', 'LacroixVille', 'FR'),
(45, 'Dupuy SARL', '10, chemin Anne Hubert', '52 870', 'Picard-les-Bains', 'FR'),
(46, 'Navarro', 'rue Marc Baron', '14 952', 'Parent', 'FR'),
(47, 'Picard', '6, chemin Robert Lesage', '02690', 'Roux', 'FR'),
(48, 'Delmas', '640, rue Barbier', '06094', 'Hubertnec', 'FR'),
(49, 'Renault S.A.S.', 'boulevard de Georges', '88530', 'Hubert-la-Forêt', 'FR'),
(50, 'Guilbert', 'chemin Gilles Schmitt', '87965', 'PonsVille', 'FR');

-- --------------------------------------------------------

--
-- Structure de la table `platform`
--

CREATE TABLE `platform` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `platform`
--

INSERT INTO `platform` (`id`, `name`) VALUES
(1, 'Playstation 4'),
(2, 'Playstation 5'),
(3, 'Xbox One'),
(4, 'Xbox Series'),
(5, 'Nintendo Switch'),
(6, 'PC'),
(7, 'MAC'),
(8, 'Stadia'),
(9, 'Wii U');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `username`, `birthdate`) VALUES
(1, 'thibault.lejeune@gmail.com', '[]', '$2y$10$QdV08Zq0JxoOcEFdXUlpIOglIBWmo3y54Pn6TPR.TEpODMC0e3ojq', 'garnier.martin', '2008-01-17'),
(2, 'legall.aurelie@riviere.fr', '[]', '$2y$10$aMCNm0zEYHNsa/HWA5rkP.E6KUgbm9Efwa9wmJAIF2MndOMcdI/yW', 'vblanc', '1988-01-11'),
(3, 'raymond36@courtois.fr', '[]', '$2y$10$KHy1bXVgzRykGrMHY4uxjumtWhB.eB9pYDsYdLIf5C3j.KM86UAcO', 'adelaide01', '1987-06-21'),
(4, 'marechal.lucy@fouquet.com', '[]', '$2y$10$ckhv.gjQtuPr0FrjjDd4mugxCzfjxYhmQ3iir50OGwVt9w.gAA30C', 'roux.aurelie', '1996-11-17'),
(5, 'gabriel58@tele2.fr', '[]', '$2y$10$oFXrZovmxrGW.KVybuq4Y.MdMrLa43Aksy6Bcj6kHCv9aCoIIYOyG', 'valette.augustin', '1992-02-13'),
(6, 'letienne@pages.fr', '[]', '$2y$10$ZDmaM8N9BggkGzZS/sloyerenTta5Q0blw4UMSznQO5cvSM5f4MIy', 'breton.leon', '1976-03-15'),
(7, 'gilbert81@sfr.fr', '[]', '$2y$10$M2rrgresNVRNY7VrcG4.aO6/7jhjPDoXBWO0kag9ODetYxQI0IeQ.', 'delaunay.victoire', '1985-09-11'),
(8, 'frederic.denis@legros.fr', '[]', '$2y$10$37syUhn5O0zENP50.6WwgeIdUmgztvwjlununoaC75JkruALuNfRO', 'jacqueline05', '1980-12-15'),
(9, 'pgaudin@maillot.fr', '[]', '$2y$10$XDUohctCaYohAGVg392MKulJJdXKr8X6S7msIXLNUlEU1kX8JDxbi', 'nathalie.bourdon', '1968-01-08'),
(10, 'cmallet@dbmail.com', '[]', '$2y$10$PWhcw0JWUmihoRIlz21D1u7dpgdCTl0bEO/cS83WqgYCBGaRN..eq', 'michelle.dupuy', '2001-06-07'),
(11, 'rene.hoareau@gmail.com', '[]', '$2y$10$LBv4aRZyHUJDv4mePbZM6ukReJ.zIZc4sys9JYdYCifLxzUx2EyTW', 'daniel.gabrielle', '1969-04-16'),
(12, 'pierre65@bigot.fr', '[]', '$2y$10$lxBPwh02MdXbs9F8TfRJr.nXGJZhph2enRTPkMMCKpqHwfjGRx972', 'elise89', '1971-04-19'),
(13, 'theodore39@free.fr', '[]', '$2y$10$Bbp7DT2M.9uK.CuVCT/H9OxO/H2c.Ce6osRp9zDa.wsxuIyol.Hqi', 'josette85', '2008-06-28'),
(14, 'mblondel@delorme.org', '[]', '$2y$10$u2IlWAZHk4YcLcy/8RYXtOy.U1tmdQmUHJqSriICR3adt9HNOtXfi', 'vincent.weiss', '1999-06-19'),
(15, 'gerard.gros@club-internet.fr', '[]', '$2y$10$H20nprUJkB5IJ0hGvoqKF.8NBlBazpQfsNs7iwi/5Q33H0pZf5QX.', 'nbenard', '2008-08-03'),
(16, 'genevieve11@jourdan.com', '[]', '$2y$10$i5nZcrsVsHN/spxzrKfDruw34hQCGnD71uJ5/OnF7BRv4I3pXxPsS', 'margaud.seguin', '1971-10-21'),
(17, 'jbourdon@orange.fr', '[]', '$2y$10$2t4fD9i4O0yQvBBhKYcCN.S2KcZnqGXFhUDKlK6bvyykDhVpFF/5q', 'smartinez', '2001-08-02'),
(18, 'roland.daniel@yahoo.fr', '[]', '$2y$10$rtrQjEodkcWIXJol4I5eYOwhb2DblAVUHB2/jOQdGFnriNEPjLxsq', 'ulevy', '1966-05-19'),
(19, 'bouvet.hugues@yahoo.fr', '[]', '$2y$10$tKuSBpxHa4OKVzF84HdLPusyGn.ujtuov7yR0eH249cCzAYEMUj4e', 'theodore.lenoir', '1981-05-11'),
(20, 'arnaude51@launay.fr', '[]', '$2y$10$uoYs1Hmp.ADGdD5VcqKtUO9iZVyUp573NrD3f7hqDVO6aMfMknUgm', 'marguerite.lefebvre', '2005-01-29'),
(21, 'brigitte.lacombe@lucas.org', '[]', '$2y$10$6r5VZ4qUJhlMbSdOA2MQQukI7y5AUDjL0nF7Bmnket5OHhSPsqDpG', 'sylvie75', '2006-05-02'),
(22, 'thibault.leger@besnard.com', '[]', '$2y$10$YJQ.12pOihjXU6lMduKfyeetMWGVHaSFXYyUCsrsTfXmSzoAfBqIu', 'lucy80', '1986-05-10'),
(23, 'brunet.lucie@tele2.fr', '[]', '$2y$10$WhPsyGOkWW7aOle.BeQxt.2geD5PcaIhc6/EO/D1oJPfdvU27nWMK', 'mallet.olivier', '1981-03-12'),
(24, 'turpin.antoinette@orange.fr', '[]', '$2y$10$E8JZCiaYrCqlJwL/kFlUz.p903TppVHviE3dKHs24Yekpv0ov4kla', 'barbier.camille', '2000-10-03'),
(25, 'laure32@leveque.fr', '[]', '$2y$10$ZMBmu8ZzkSzIWRAaAObkcegVcR0mekNfFCzAv2xqErYS0Ymlx0v.e', 'leveque.denis', '1970-06-06'),
(26, 'emilie.pires@jacquet.com', '[]', '$2y$10$89k2yfllBlpUoNY7UPnOme6W7YYTpIEmA7vYfXb.hEQASlp7BbOYi', 'xmartin', '1973-10-20'),
(27, 'ofaure@sfr.fr', '[]', '$2y$10$bHM4fjLjiEPhwoIWyXDFQOZZaV/GnDeeI0.fAqtzfUmFGYD56wuv6', 'dgros', '1986-10-17'),
(28, 'capucine.vaillant@laposte.net', '[]', '$2y$10$2JFwgAijrGyi2oFDEZlBhe65QKmlJRtOGsmkJeUOJRhpeY2syy9ky', 'gerard.marcel', '1985-09-05'),
(29, 'cgomes@orange.fr', '[]', '$2y$10$j96EZxawNGLU0yRBpmZjd.C1c7aOsd7kZKQ42/eMGu2fje/KltlCu', 'frederique29', '1988-02-27'),
(30, 'elefevre@live.com', '[]', '$2y$10$p.KaG9z7zz/J/WaGm6lI6OJa.QYcLRAxUxbZ/51c1Gjwryw08im5a', 'lucas74', '1968-03-17'),
(31, 'martins.christine@noos.fr', '[]', '$2y$10$zUeW8oMyP3I/5pIPdixSW.DEfkEAwDRGaes6m2jcqqWtub82Iy7Ye', 'hoareau.joseph', '2004-08-06'),
(32, 'stephanie.gilles@tele2.fr', '[]', '$2y$10$/caCi.AiliTFN/pTyge04umoOsTAxlZe.njO5wik8Tya6Wc3SULNW', 'dperrier', '2002-07-26'),
(33, 'isaac52@live.com', '[]', '$2y$10$92kq5SBXY5NRsfyYDVZ/bee4ausfpDux2mL2fR8Kcqaauv4SCLFjC', 'maurice.roland', '1994-07-21'),
(34, 'thierry.madeleine@morvan.com', '[]', '$2y$10$OPaTQX0VixzVaAB.CTvrm.jT.0YMTixQEzdBJObGgpVnfdBmNF6nm', 'pottier.margot', '2001-03-08'),
(35, 'andre.zacharie@rousseau.net', '[]', '$2y$10$eZs8T4Au9CGtqjSXcO.AgecAwiy8YPE4NqLemxXDfyaOb7hLtMWb.', 'martinez.benjamin', '1992-12-25'),
(36, 'odette.ledoux@noos.fr', '[]', '$2y$10$IN/2A2n1TBcGnzUa2tgVvOnw24P1FUbZqjKu7N6EBL9t8jf0p4dlC', 'franck.vallee', '1976-12-23'),
(37, 'christiane.julien@hotmail.fr', '[]', '$2y$10$piSum3bt3pnBspZnOXt6HOzKBKZKg3CIOi7zbglEANTQIKbtKIysC', 'vincent.roger', '1995-05-21'),
(38, 'margaux73@fernandez.com', '[]', '$2y$10$V/GdiekKDkUGcl7bkngRH.DCTVtTvHS0m3IBmmDXn5jIIHHRsCLgO', 'alfred44', '1984-08-23'),
(39, 'pauline.maillard@noos.fr', '[]', '$2y$10$.xRuQ4ntxf9p0YvdOzPfyugOlQDQ0grgSZmqIGt0rcMkofiOO5q4C', 'roger13', '2008-05-08'),
(40, 'alexandria.besnard@live.com', '[]', '$2y$10$BWQbG0iehqOcnWIz9jV3r.2xa/Q81SYf4w3WYUcKV.covRJ4cX1dq', 'vmace', '2002-04-08'),
(41, 'lefort.claire@dbmail.com', '[]', '$2y$10$vPhCLgthBVLjZ8/JhMXwTen0NaO/Mc/2F16sbJreNcbu48IYoIOjy', 'bouvet.isabelle', '1972-09-09'),
(42, 'christelle.garnier@guichard.com', '[]', '$2y$10$Ohn0fMtsUPCW8/cL0Ugrm.q77HpgWHcz3UEEAxoSe5oGKJGUpQqrO', 'navarro.pierre', '2006-04-24'),
(43, 'lejeune.guillaume@tele2.fr', '[]', '$2y$10$ZnH0Ce5ISmTVbvfHf9RoO.xjQKWmMZ.tEfKFIwLsoMAoBMfBDjzaK', 'andree.delannoy', '1987-07-06'),
(44, 'emarie@live.com', '[]', '$2y$10$9GNBUEzs.4QUIBvCL3cOjulL9dsKsjT70Jy4S7.IDluysOe9PCQkq', 'nicole.delattre', '1977-08-26'),
(45, 'maurice66@orange.fr', '[]', '$2y$10$xW6EjDZz05rTDyyyo4H/fe1nhkp5o9CSCs9zTNZ/iRDYWJZ9Q2MXO', 'tristan72', '1992-09-28'),
(46, 'capucine.fernandez@hoareau.fr', '[]', '$2y$10$EHMnMWecbdTVBUgrFCr2XOo2OUBsTNajrDPU3g4rudB6yPMn9cxuq', 'emmanuel.leger', '2005-01-28'),
(47, 'alice.gauthier@laposte.net', '[]', '$2y$10$lyPzkap1INEAxCDiz/KPG.6OC6hwB6IRp3A5P30m5g8xl2XarY/Se', 'fleury.christophe', '1988-09-29'),
(48, 'eugene.pelletier@rodrigues.com', '[]', '$2y$10$AjaonsRJYResLP0zXuopjeNNTof3hZdjOxxNchbxE7GobYubSYOHe', 'suzanne19', '1996-12-19'),
(49, 'claude41@tele2.fr', '[]', '$2y$10$1fBpiVJ8lQIN94MYI2wE0uyEj3APcXf1uZfgs1SimOLpwCGLQERLm', 'alexandria.mahe', '1972-04-11'),
(50, 'hortense90@allard.com', '[]', '$2y$10$dZFQgjv6tvg1fniNtRYX4.ucgLCRLGYpVMdBBwRqV9sLT3A44LS7a', 'georges.marie', '1965-01-22');

-- --------------------------------------------------------

--
-- Structure de la table `user_board_game`
--

CREATE TABLE `user_board_game` (
  `user_id` int(11) NOT NULL,
  `board_game_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user_comic`
--

CREATE TABLE `user_comic` (
  `user_id` int(11) NOT NULL,
  `comic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user_manga`
--

CREATE TABLE `user_manga` (
  `user_id` int(11) NOT NULL,
  `manga_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user_video_game`
--

CREATE TABLE `user_video_game` (
  `user_id` int(11) NOT NULL,
  `video_game_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `video_game`
--

CREATE TABLE `video_game` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `video_game`
--

INSERT INTO `video_game` (`id`, `category_id`, `name`, `description`, `picture`) VALUES
(1, 6, 'Pokémon Diamant Étincelant / Perle Scintillante', 'Pokémon Diamant Étincelant / Perle Scintillante est un remake de Pokémon Version Diamant / Perle sorti sur Nintendo DS. Avec un nouveau style graphique plutôt enfantin, les joueurs peuvent découvrir ou redécouvrir la région de Sinnoh et retrouver les Pokémons de la quatrième génération.\r\n\r\nSortie : 19 nov. 2021\r\n\r\nSupport : Switch', 'https://image.jeuxvideo.com/medias-sm/163396/1633959248-729-jaquette-avant.gif'),
(2, 1, 'Battlefield 2042', 'Battlefield 2042 est un jeu de tir à la première personne multijoueur ancré dans un futur dystopique. Deux nations mènent une guerre totale, les Etats-Unis et la Russie. Trois modes de jeux sont proposés : All-Out Warfare (128 joueurs sur PS5/Xbox Series, 64 sur PS4/Xbox One), Hazard Zone et Mode Portal.\r\n\r\nSortie : 19 nov. 2021\r\n\r\nSupports : PC, PS5, Xbox Series, PS4, Xbox One', 'https://image.jeuxvideo.com/medias/163664/1636636223-8849-jaquette-avant.jpg'),
(3, 20, 'Forza Horizon 5', 'Forza Horizon 5 est un jeu de course en monde ouvert développé par Playground Games. Il prend place dans les villes et magnifiques décors du Mexique. Le jeu propose aussi bien des courses solo que des épreuves compétitives et collaboratives en ligne.\r\n\r\nSortie : 09 nov. 2021\r\n\r\nSupports : PC, Xbox Series, Xbox One', 'https://image.jeuxvideo.com/medias/163187/1631865000-7055-jaquette-avant.jpg'),
(4, 1, 'Halo Infinite', 'Halo Infinite est un FPS développé par 343 Industries. L\'épisode fait la suite directe de Halo 5. On suit les aventures de Master Chief, qui est récupéré dans l\'espace par un personnage, avant de découvrir le Halo détruit.\r\n\r\nSortie : 08 déc. 2021\r\n\r\nSupports : PC, Xbox Series, Xbox One', 'https://image.jeuxvideo.com/medias/159542/1595423317-2836-jaquette-avant.png'),
(5, 1, 'Call of Duty : Vanguard', 'Call of Duty : Vanguard est le dernier ajout de la célèbre licence de jeux de tirs, Call of Duty. Celui-ci nous plonge au coeur des affrontements de la Seconde Guerre mondiale, et particulièrement ceux ayant lieu en Europe et dans le Pacifique.\r\n\r\nSortie : 05 nov. 2021\r\n\r\nSupports : PC, PS5, Xbox Series, PS4, Xbox One', 'https://image.jeuxvideo.com/medias/163299/1632989599-6459-jaquette-avant.gif'),
(6, 6, 'New World', 'Sculptez votre propre destin dans New World, un jeu massivement multijoueur en monde ouvert, situé sur une terre maudite, un monde en évolution selon les saisons, la météo, et l\'heure de la journée. Regroupez vous pour traquer des monstres et bâtir des civilisations florissantes, ou pour survivre face à des terreurs surnaturelles et des bandits meurtriers.\r\n\r\nSortie : 28 sept. 2021\r\n\r\nSupport : PC', 'https://image.jeuxvideo.com/medias/159403/1594028554-187-jaquette-avant.jpg'),
(7, 11, 'The Matrix Awakens', 'The Matrix Awakens est une démo technique réalisée sous le moteur Unreal Engine 5. Celle-ci vous plonge dans l\'univers de Matrix et vous fait vivre diverses séquences d\'actions effrénées extrêmement réalistes.\r\n\r\nSortie : 10 déc. 2021\r\n\r\nSupports : PS5, Xbox Series', 'https://image.jeuxvideo.com/medias/163881/1638806697-8764-jaquette-avant.gif'),
(8, 6, 'Eldest Souls', 'Eldest Souls est un action-RPG Souls-like en pixel art, développé par Fallen Flag Studio et édité par United Label. Les anciens dieux se sont libérés de leur emprisonnement et sont déterminés à en découdre avec les hommes. Le seul rempart face à la destruction de la civilisation est un chevalier qui devra les exterminer tous.\r\n\r\nSortie : 29 juil. 2021\r\n\r\nSupports : PC, PS5, Xbox Series, Switch, PS4, Xbox ONE', 'https://letempscompere.fr/wp-content/uploads/2021/08/KyBRbcz5wCqPrdr7QFfUniEg-2048x1536.webp'),
(9, 11, 'Les Gardiens de la Galaxie', 'Les Gardiens de la Galaxie est un jeu d\'action purement solo mais mettant en scène l\'ensemble des Gardiens de la Galaxie face à une menace pesant sur la galaxie. Il s\'agit d\'une histoire originale, dans un univers que Eidos Montréal s\'est réapproprié (notamment le chara-design). L\'aspect narratif sera donc mis en avant et les choix de dialogues et d\'actions du joueurs auront des conséquences sur la suite de son aventure.\r\n\r\nSortie : 26 oct. 2021\r\n\r\nSupports : PC, PS5, Xbox Series, Switch, PS4, Xbox ONE', 'https://image.jeuxvideo.com/medias/163129/1631285061-4363-jaquette-avant.jpg'),
(10, 7, 'Final Fantasy XIV : Endwalker', 'Final Fantasy XIV : Endwalker est la quatrième extension du jeu éponyme. Il s\'agit d\'un MMORPG (jeu de rôle massivement multijoueur) ancré dans l\'univers des Final Fantasy. Dans Endwalker, il est possible de voyager à travers l\'île de Thavnair, Garlemald et même la Lune. Deux nouvelles classes font leur apparition : le sage (soigneur) et le faucheur (DPS de mêlée). La race des hommes Viéras est également disponible.\r\n\r\nSortie : 07 déc. 2021\r\n\r\nSupports : PC, PS5, PS4, MAC', 'https://image.jeuxvideo.com/medias/161277/1612766574-6606-jaquette-avant.png'),
(11, 11, 'Astérix & Obélix : Baffez-les Tous !', 'Astérix & Obélix : Baffez-les Tous ! est une nouvelle adaptation vidéoludique de la célèbre série de BD de Goscinny et Uderzo. Il invite le joueur à parcourir les environnements emblématiques de la saga aux commandes des deux irréductibles Gaulois pour y affronter des flopées d\'ennemis en tout genre.\r\n\r\nSortie : 02 déc. 2021\r\n\r\nSupports : PC, Switch, PS4, Xbox One', 'https://image.jeuxvideo.com/medias/163342/1633418743-1593-jaquette-avant.gif'),
(12, 11, 'Kena : Bridge of Spirits', 'Kena : Bridge of Spirits est un jeu d\'aventure vous plongeant dans un monde de magie. Vous y incarnez Kena, une aventurière qui entreprend un périple afin de découvrir les secrets d\'une communauté cachée près d\'un temple sacré...\r\n\r\nSortie : 21 sept. 2021\r\n\r\nSupports : PC, PS5, PS4', 'https://image.jeuxvideo.com/medias/163214/1632142889-7692-jaquette-avant.jpg'),
(13, 1, 'Far Cry 6', 'Far Cry 6 est un FPS qui se déroule sur l\'île tropicale fictive de Yara. Vous incarnez Dani Rojas, un membre de la guérilla locale qui lutte contre le régime oppressif du dictateur du pays, Anton Castillo, qui prépare son fils à prendre sa suite. Pour vous aider dans votre combat, vous pouvez compter sur vos alliés les Amigos et fabriquer vos propres armes et véhicules.\r\n\r\nSortie : 07 oct. 2021\r\n\r\nSupports : PC, PS5, Xbox Series, PS4, Xbox One', 'https://image.jeuxvideo.com/medias/163161/1631607413-3853-jaquette-avant.jpg'),
(14, 21, 'FIFA 22', 'FIFA 22 est une simulation de football éditée par Electronic Arts. Comme chaque saison, le jeu offre son lot d\'améliorations techniques pour toujours plus de réalisme ainsi que des animations et des comportements toujours plus poussés. Les modes carrière et Ultimate Team disposent également de nouveaux ajouts.\r\n\r\nSortie : 01 oct. 2021\r\n\r\nSupports : PC, PS5, Xbox Series, Switch, PS4, Xbox ONE, Stadia\r\n', 'https://image.jeuxvideo.com/medias/163154/1631541998-5162-jaquette-avant.jpg'),
(15, 6, 'Ruined King : A League of Legends Story', 'Ruined King est un jeu développé par Airship Syndicate (Darksiders Genesis, Battle Chasers) et édité par Riot Forge. RPG solo doté d\'un système de combat au tour par tour, le titre prend place dans deux régions du monde de Runeterra : Bilgewater et les Îles Obscures. Six champions sont réunis pour affronter un ennemi commun : Miss Fortune, Illaoi, Braum, Yasuo, Ahri et Pyke.\r\n\r\nSortie : 16 nov. 2021\r\n\r\nSupports : PC, PS5, Xbox Series, Switch, PS4, Xbox ONE\r\n', 'https://image.jeuxvideo.com/medias/163708/1637080607-7753-jaquette-avant.gif'),
(16, 4, 'Farming Simulator 22', 'Ce nouvel opus de la série de simulation fermière s\'installe dans la lignée de ses prédécesseurs, avec quelques nouveautés. De nouvelles cartes, de nouvelles plantations, de nouvelles machines et de nouvelles marques y sont disponibles pour mieux développer votre ferme, que ce soit seul ou à plusieurs.', 'https://image.jeuxvideo.com/medias/163353/1633528483-9809-jaquette-avant.jpg'),
(17, 3, 'Age of Empires IV', 'Age of Empires IV sur PC est un jeu de stratégie qui appartient à la célèbre saga de stratégie. Il vous sera possible de prendre part à des batailles historiques avec des armées possédant leurs propres caractéristiques.\r\n\r\nSortie : 28 oct. 2021\r\n\r\nSupport : PC', 'https://image.jeuxvideo.com/medias/163214/1632143636-6808-jaquette-avant.jpg'),
(18, 6, 'Shin Megami Tensei V', 'Shin Megami Tensei V est un jeu de rôle exclusif à la Nintendo Switch. Le jeu prend place dans un univers post-apocalyptique dans lequel le joueur incarne un étudiant devant faire face à des forces démoniaques dans un Tokyo ravagé.\r\n\r\nSortie : 12 nov. 2021\r\n\r\nSupport : Switch\r\n', 'https://image.jeuxvideo.com/medias/163604/1636037252-5188-jaquette-avant.gif'),
(19, 11, 'Metroid Dread', 'Présenté comme \"Metroid 5\", Metroid Dread est le nouvel opus de la célèbre licence de Nintendo, en 2,5D. L\'héroïne Samus Aran devra faire face à une nouvelle menace, au sein d\'une aventure qui fait beaucoup penser aux premiers épisodes de la série.\r\n\r\nSortie : 08 oct. 2021\r\n\r\nSupport : Switch\r\n', 'https://image.jeuxvideo.com/medias/163299/1632989749-6428-jaquette-avant.gif'),
(20, 4, 'Jurassic World Evolution 2', 'Jurassic World Evolution 2 est un jeu de gestion ancré dans le monde de la célèbre licence aux dinosaures. Par rapport au premier opus, il est possible d\'y trouver de nouveaux bâtiments, de nouveaux outils de gestion et créatifs et plus de 75 espèces préhistoriques (dont des reptiles volants et marins). Un mode \"Théorie du chaos\" permet de revivre des moments inspirés des films Jurassic Park et World, avec quelques rebondissements.\r\n\r\nSortie : 09 nov. 2021\r\n\r\nSupports : PC, PS5, Xbox Series, PS4, Xbox One', 'https://image.jeuxvideo.com/medias/163336/1633356069-9512-jaquette-avant.jpg'),
(21, 11, 'Len\'s Island', 'Len\'s Island est un jeu d\'action-aventure dans lequel vous devez prospérer sur la mystérieuse île de Len. Construisez votre maison, occupez-vous de vos potagers et explorez les nombreux donjons occupés par des créatures dangereuses.\r\n\r\nSortie : 26 nov. 2021\r\n\r\nSupport : PC, MAC', 'https://image.jeuxvideo.com/medias/163949/1639486247-6110-jaquette-avant.jpg'),
(22, 1, 'Lemnis Gate', 'Lemnis Gate est un FPS multijoueur développé par Raftloop Games et édité par Frontier Foundry. Le gameplay du titre se base sur le tour par tour et l\'intégration de boucles temporelles où deux joueurs contrôlent 5 personnages chacun.\r\n\r\nSortie : 03 août 2021\r\n\r\nSupports : PC, PS5, Xbox Series, PS4, Xbox One\r\n\r\n\r\n', 'https://image.jeuxvideo.com/medias/163335/1633353729-3549-jaquette-avant.jpg'),
(23, 21, 'Riders Republic', 'Nouveau jeu du studio du jeu de sports extrêmes Steep, Riders Republic nous embarque dans un univers déjanté où les biens nommés Riders règnent en maître. Ski, vélo en montagnes, snowboard, wingsuit, et même rocket suit seront de mise dans ce titre orienté multijoueur. Les décors sont variés et certains parc nationaux provenant des Etats-Unis y sont même fidèlement reproduit.\r\n\r\nSortie : 28 oct. 2021\r\n\r\nSupports : PC, PS5, Xbox Series, PS4, Xbox One\r\n', 'https://image.jeuxvideo.com/medias/163905/1639045516-5502-jaquette-avant.gif'),
(24, 18, 'Mario Party Superstars', 'Mario Party Superstars est un party-game qui porte bien son nom, puisqu\'il réunit plus d\'une centaine de mini-jeux issus de tous les épisodes de la série, dont la Nintendo 64 ! Le titre est jouable seul ou bien en multijoueur local et en ligne.\r\n\r\nSortie : 29 oct. 2021\r\n\r\nSupport : Switch\r\n', 'https://image.jeuxvideo.com/medias/163335/1633353168-8875-jaquette-avant.gif'),
(25, 21, 'NBA 2K22', 'NBA 2K22 est une simulation de basket-ball éditée par 2K Games et développée par Visual Concepts. Le jeu permet une immersion complète au sein de la NBA et, plus généralement, dans le monde professionnel du basket avec toutes les équipes et joueurs qui composeront la saison 2021-2022.\r\n\r\nSortie : 10 sept. 2021\r\n\r\nSupports : PC, PS5, Xbox Series, Switch, PS4, Xbox ONE, Stadia\r\n', 'https://image.jeuxvideo.com/medias/163154/1631535511-3744-jaquette-avant.jpg'),
(26, 15, 'Resident Evil Village', 'Resident Evil Village est un survival-horror. Se déroulant quelques années après Resident Evil 7 Biohazard, il met en scène Ethan Winters, sa femme Mia et Chris Redfield, le héros légendaire de la série Resident Evil. L\'action est en vue à la première personne et le joueur incarne un Ethan désemparé et brisé qui se retrouve confronté à des monstruosités dans un village.\r\n\r\nSortie : 07 mai 2021\r\n\r\nSupports : PC, PS5, Xbox Series, PS4, Xbox One, Stadia\r\n', 'https://media.senscritique.com/media/000020040912/source_big/Resident_Evil_Village.png'),
(27, 15, 'Five Nights at Freddy’s : Security Breach', 'Five Nights at Freddy’s : Security Breach est le neuvième épisode de la saga. Reprenant certaines bases des anciens titres, ce nouvel opus va changer quelques aspects de la formule, et va même proposer au joueur de se balader librement à travers le centre commercial dans lequel il est coincé.\r\n\r\nSortie : 16 déc. 2021\r\n\r\nSupports : PC, PS5, Xbox Series, PS4, Xbox One\r\n', 'https://image.jeuxvideo.com/medias/163595/1635946903-6394-jaquette-avant.gif'),
(28, 4, 'Animal Crossing : New Horizons', 'Animal Crossing : New Horizons vous emmène de nouveau dans le monde mignon d\'Animal Crossing, sur Nintendo Switch. Cultivez votre potager, pêchez, et faites votre vie avec vos compagnons en temps réel grâce à l\'horloge de la console.\r\n\r\nSortie : 20 mars 2020\r\n\r\nSupport : Switch\r\n', 'https://image.jeuxvideo.com/medias/161616/1616164719-8684-jaquette-avant.jpg'),
(29, 9, 'Dota 2', 'DOTA 2 est la suite du célèbre DOTA, pionner d\'un genre de jeux à part entière dans le domaine de la stratégie, le MOBA. Deux équipes de cinq joueurs s\'affrontent dans des parties de courte durée (30 minutes en moyenne). Le principe est de se frayer un chemin jusqu\'à la forteresse ennemie afin de la détruire, le tout en choisissant parmi plus d\'une centaine de personnages différents.\r\n\r\nSortie : 09 juil. 2013\r\n\r\nSupports : PC, MAC', 'https://image.jeuxvideo.com/medias/148285/1482854953-4348-jaquette-avant.jpg'),
(30, 9, 'League of Legends', 'Inspiré du mod DotA (Defense of the Ancients) de Warcraft III, League of Legends est un MOBA, une arène de bataille en ligne multijoueur. Dans le mode classique, deux équipes de cinq joueurs s\'affrontent dans des parties qui durent en moyenne entre 40 minutes et dont l\'objectif est de détruire la base ennemie. Évoluant dans un univers heroic-fantasy, chaque joueur incarne un champion différent, aux capacités uniques, qu\'il choisit à chaque début de partie. Des modes aléatoires sont également présents, ainsi que des événements saisonniers qui apportent un souffle de nouveauté.\r\n\r\nSortie : 27 oct. 2009\r\n\r\nSupports : PC, MAC', 'https://image.jeuxvideo.com/images/jaquettes/00027602/jaquette-league-of-legends-pc-cover-avant-g.jpg'),
(32, 12, 'God of War', 'Dans ce nouvel épisode de God Of War, le héros évoluera dans un monde aux inspirations nordiques, très forestier et montagneux. Dans ce beat-them-all, un enfant accompagnera le héros principal, pouvant apprendre des actions du joueur, et même gagner de l\'expérience.\r\n\r\nSortie : 20 avr. 2018\r\n\r\nSupports : PC, PS4', 'https://image.jeuxvideo.com/medias/151689/1516893501-9622-jaquette-avant.jpg'),
(33, 11, 'The Legend of Zelda : Breath of the Wild', 'The Legend of Zelda : Breath of the Wild est un jeu d\'action/aventure. Link se réveille d\'un sommeil de 100 ans dans un royaume d\'Hyrule dévasté. Il lui faudra percer les mystères du passé et vaincre Ganon, le fléau. L\'aventure prend place dans un gigantesque monde ouvert et accorde ainsi une part importante à l\'exploration. Le titre a été pensé pour que le joueur puisse aller où il veut dès le début, s\'éloignant de la linéarité habituelle de la série.\r\n\r\nSortie : 03 mars 2017\r\n\r\nSupports : Switch, Wii U', 'https://image.jeuxvideo.com/medias/149432/1494322310-8900-jaquette-avant.jpg'),
(34, 11, 'The Last of Us Part II', 'Au centre de l\'intrigue du premier volet, nous retrouvons à nouveau Joel et Ellie plus déterminés que jamais à éradiquer les infectés jusqu\'au dernier. Se déroulant à nouveau dans un monde post apocalyptique, le duo toujours aussi soudé devra prendre les décisions qui s\'imposent afin de survivre un seul jour de plus à cette pandémie.\r\n\r\nSortie : 19 juin 2020\r\n\r\nSupport : PS4', 'https://paradoxetemporel.fr/wp-content/uploads/2020/06/jaquette-the-last-of-us-part-2.jpg'),
(35, 11, 'Red Dead Redemption II', 'Suite du précédent volet multi récompensé, Red Dead Redemption II nous permet de nous replonger sur PS4 dans une ambiance western synonyme de vastes espaces sauvages et de villes malfamées. L\'histoire se déroule en 1899, avant le premier Red Dead Redemption, au moment où Arthur Morgan doit fuir avec sa bande à la suite d\'un braquage raté.\r\n\r\nSortie : 26 oct. 2018\r\n\r\nSupports : PC, PS4, Xbox One, Stadia', 'https://global-img.gamergen.com/red-dead-redemption-2-pc-mediamarkt_0900909672.jpg'),
(36, 5, 'Super Mario Odyssey', 'Super Mario Odyssey est un jeu de plate-forme sur Switch où la princesse Peach a été enlevée par Bowser. Pour la sauver, Mario quitte le royaume Champignon à bord de l\'Odyssey. Accompagné de Chappy, son chapeau vivant, il doit parcourir différents royaumes et faire tout pour vaincre, une nouvelle fois, le terrible Bowser.\r\n\r\nSortie : 27 oct. 2017\r\n\r\nSupport : Switch', 'https://image.jeuxvideo.com/medias/150166/1501664378-9988-jaquette-avant.jpg'),
(37, 20, 'Forza Horizon 3', 'Jeu de course en monde ouvert, Forza Horizon 3 vous donne accès à des centaines de véhicules. Le joueur pourra arpenter à toute vitesse les paysages d\'Australie. De très nombreuses épreuves sont au programme et les pilotes du monde entier peuvent s\'affronter dans les mêmes conditions que dans le mode solo. Le jeu est en Xbox Play Anywhere, ce qui signifie qu\'une même clé est activable sur Windows 10 comme sur Xbox One.\r\n\r\nSortie : 27 sept. 2016\r\n\r\nSupports : PC, Xbox One', 'https://m.media-amazon.com/images/I/61euzllOIUS._AC_SL1000_.jpg'),
(38, 11, 'Uncharted 4 : A Thief\'s End', 'Quatrième opus de la série de jeu d\'action/aventure à succès de Naughty Dog, Uncharted 4 A Thief\'s End vous permet d\'incarner Nathan Drake pour la première fois sur PS4. Le célèbre explorateur devra révéler le complot qui se cache derrière un légendaire trésor de pirates.\r\n\r\nSortie : 10 mai 2016\r\n\r\nSupports : PC, PS4', 'https://image.jeuxvideo.com/medias/146281/1462807289-2712-jaquette-avant.jpg'),
(39, 6, 'Dark Souls III', 'Développé par From Software, Dark Souls 3 est un action RPG particulièrement exigeant. L\'environnement, très peu accueillant, ravira les amateurs de challenges corsés. Vous y combattrez de gigantesques ennemis, qui ne feront qu\'une bouchée de vous.\r\n\r\nSortie : 12 avr. 2016\r\n\r\nSupports : PC, PS4, Xbox One', 'https://image.jeuxvideo.com/medias/146728/1467275384-5543-jaquette-avant.jpg'),
(40, 6, 'The Witcher 3 : Wild Hunt', 'The Witcher 3 : Wild Hunt est un Action-RPG se déroulant dans un monde ouvert. Troisième épisode de la série du même nom, inspirée des livres du polonais Andrzej Sapkowski, cet opus relate la fin de l\'histoire de Geralt de Riv.\r\n\r\nSortie : 19 mai 2015\r\n\r\nSupports : PC, PS5, Xbox Series, Switch, PS4, Xbox ONE', 'https://image.jeuxvideo.com/medias/142247/1422469608-7141-jaquette-avant.jpg'),
(41, 8, 'Minecraft', 'Jeu bac à sable indépendant et pixelisé dont le monde infini est généré aléatoirement, Minecraft permet au joueur de récolter divers matériaux, d\'élever des animaux et de modifier le terrain selon ses choix, en solo ou en multi (via des serveurs). Il doit également survivre en se procurant de la nourriture et en se protégeant des monstres qui apparaissent la nuit et dans des donjons. Il peut également monter de niveau afin d\'acheter des enchantements.\r\n\r\nSortie : 18 nov. 2011\r\n\r\nSupports : PC, Switch, PS4, Xbox One, Wii U', 'https://image.jeuxvideo.com/medias/148285/1482845269-1018-jaquette-avant.jpg'),
(42, 12, 'Bayonetta', 'Bayonetta est un Beat\'em all mettant en scène la puissante et magnifique sorcière du même nom. Celle-ci doit combattre de nombreux ennemis, souvent colossaux, envoyés par le ciel dans des mises en scène particulièrement impressionnantes.\r\n\r\nSortie : 08 janv. 2010\r\n\r\nSupports : PC, Switch, PS4, Xbox One, Wii U', 'https://image.jeuxvideo.com/medias/149192/1491919670-7548-jaquette-avant.jpg'),
(43, 2, 'Injustice 2', 'Injustice 2 est un jeu de combat, jouable en solo ou en multi qui réunit plusieurs personnages de l\'univers DC Comics tels que Batman, Superman, Harley Quinn, Wonder Woman, Solomon Grundy ou encore Flash. Ses héros et vilains se battent à travers des duels dynamiques.\r\n\r\nSortie : 18 mai 2017\r\n\r\nSupports : PC, PS4, Xbox One', 'https://image.api.playstation.com/cdn/UP1018/CUSA10992_00/yvD6OvUcyKOjdWMRwWAtJuZ7tKWQ6VHv.png'),
(44, 2, 'Mortal Kombat 11 : Aftermath', 'L\'extension Aftermath de Mortal Kombat 11 poursuit le récit du mode Histoire, ajoute trois combattants au roster (Fujin, Sheeva, RoboCop), des arènes ainsi que de nouvelles manières de terminer un combat avec les \"Stage Fatalities\" et les \"Friendships\".\r\n\r\nSortie : 26 mai 2020\r\n\r\nSupports : PC, Switch, PS4, Xbox One, Stadia', 'https://image.jeuxvideo.com/medias/158877/1588769550-1906-jaquette-avant.jpg'),
(45, 2, 'Dead or Alive 6', 'Dead or Alive 6 est un jeu de combat développé par Koei Tecmo. Ce dernier signe un nouvel opus d\'une licence très appréciée et marque le retour de nombreux personnages de la série ainsi que l\'arrivée de nouvelles têtes.\r\n\r\nSortie : 01 mars 2019\r\n\r\nSupports : PC, PS4, Xbox One', 'https://image.jeuxvideo.com/medias/153000/1529998968-2332-jaquette-avant.jpg'),
(46, 2, 'SoulCalibur VI', 'SoulCalibur VI sur PS4 est un jeu de combat qui prend place en 1586. Vous pourrez jouer de très nombreux personnages à travers des combats sans pitié. Cet épisode introduit le Reversal Edge, qui est une technique autant offensive que défensive, permettant de bloquer des attaques.\r\n\r\nSortie : 19 oct. 2018\r\n\r\nSupports : PC, PS4, Xbox One', 'https://image.jeuxvideo.com/medias/152899/1528990462-7760-jaquette-avant.jpg'),
(47, 17, 'Diablo II : Resurrected', 'Diablo II : Resurrected est la remasterisation du hack\'n\'slash culte Diablo II et de son extension Lord of Destruction. Cette version remise aux goûts présente de nouveaux graphismes ultra détaillés, des cinématiques retravaillées et une bande son améliorée, tandis que le gameplay et les systèmes du jeu d’origine sont identiques à ceux de l’époque.\r\n\r\nSortie : 23 sept. 2021\r\n\r\nSupports : PC, PS5, Xbox Series, Switch, PS4, Xbox ONE', 'https://image.jeuxvideo.com/medias/163293/1632926824-300-jaquette-avant.gif'),
(48, 10, 'Fortnite', 'Fortnite est un Tower-Defense orienté sandbox. Les joueurs se réunissent en équipe et doivent crafter armes et pièges pour ensuite construire une forteresse et la défendre contre les nombreux monstres qui viendront l\'assaillir.\r\n\r\nSortie : 25 juil. 2017\r\n\r\nSupports : PC, PS5, Xbox Series, Switch, PS4, Xbox ONE, MAC', 'https://image.jeuxvideo.com/medias/163162/1631620218-5546-jaquette-avant.gif'),
(49, 6, 'Assassin\'s Creed Valhalla', 'Assassin\'s Creed Valhalla est un RPG en monde ouvert se déroulant pendant l\'âge des vikings. Vous incarnez Eivor, un viking du sexe de votre choix qui a quitté la Norvège pour trouver la fortune et la gloire en Angleterre. Raids, construction et croissance de votre colonie, mais aussi personnalisation du héros ou de l\'héroïne sont au programme de cet épisode.\r\n\r\nSortie : 10 nov. 2020\r\n\r\nSupports : PC, PS5, Xbox Series, PS4, Xbox One, Stadia', 'https://image.jeuxvideo.com/medias/158826/1588264397-5261-jaquette-avant.jpg'),
(50, 4, 'Les Sims 4', 'Les Sims 4 est une simulation de vie qui permet au joueur de créer ses personnages et de les faire évoluer dans un univers qu\'il customise lui-même. Ce nouvel épisode fait apparaître les émotions qui sont déterminantes dans le ressenti et l\'évolution des sims. Celles-ci dépendent de leur environnement. Les sims peuvent désormais effectuer plusieurs tâches en même temps, contrairement aux autres épisodes.\r\n\r\nSortie : 04 sept. 2014\r\n\r\nSupports : PC, PS4, Xbox One, MAC', 'https://image.jeuxvideo.com/images/jaquettes/00048634/jaquette-les-sims-4-pc-cover-avant-g-1409904702.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `video_game_category`
--

CREATE TABLE `video_game_category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `video_game_category`
--

INSERT INTO `video_game_category` (`id`, `name`) VALUES
(1, 'FPS / TPS'),
(2, 'Combat'),
(3, 'RTS'),
(4, 'Simulation'),
(5, 'Plateformes'),
(6, 'RPG'),
(7, 'MMORPG'),
(8, 'Sandbox'),
(9, 'MOBA'),
(10, 'Battle Royals'),
(11, 'Action / Aventure'),
(12, 'Beat Them All'),
(13, 'Puzzlers'),
(14, 'Réflexion'),
(15, 'Survival Horror'),
(17, 'Hack’n’slash'),
(18, 'Party Games'),
(19, 'Rythme'),
(20, 'Course'),
(21, 'Sports');

-- --------------------------------------------------------

--
-- Structure de la table `video_game_platform`
--

CREATE TABLE `video_game_platform` (
  `video_game_id` int(11) NOT NULL,
  `platform_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `board_game`
--
ALTER TABLE `board_game`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F9BD68AF12469DE2` (`category_id`);

--
-- Index pour la table `board_game_category`
--
ALTER TABLE `board_game_category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E00CEDDE71F7E88B` (`event_id`),
  ADD KEY `IDX_E00CEDDEA76ED395` (`user_id`);

--
-- Index pour la table `comic`
--
ALTER TABLE `comic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5B7EA5AA12469DE2` (`category_id`);

--
-- Index pour la table `comic_category`
--
ALTER TABLE `comic_category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3BAE0AA712469DE2` (`category_id`),
  ADD KEY `IDX_3BAE0AA7DA6A219` (`place_id`),
  ADD KEY `IDX_3BAE0AA77E3C61F9` (`owner_id`);

--
-- Index pour la table `event_category`
--
ALTER TABLE `event_category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `manga`
--
ALTER TABLE `manga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_765A9E0312469DE2` (`category_id`);

--
-- Index pour la table `manga_category`
--
ALTER TABLE `manga_category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `platform`
--
ALTER TABLE `platform`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- Index pour la table `user_board_game`
--
ALTER TABLE `user_board_game`
  ADD PRIMARY KEY (`user_id`,`board_game_id`),
  ADD KEY `IDX_5EDAAE43A76ED395` (`user_id`),
  ADD KEY `IDX_5EDAAE43AC91F10A` (`board_game_id`);

--
-- Index pour la table `user_comic`
--
ALTER TABLE `user_comic`
  ADD PRIMARY KEY (`user_id`,`comic_id`),
  ADD KEY `IDX_B9BC5EF2A76ED395` (`user_id`),
  ADD KEY `IDX_B9BC5EF2D663094A` (`comic_id`);

--
-- Index pour la table `user_manga`
--
ALTER TABLE `user_manga`
  ADD PRIMARY KEY (`user_id`,`manga_id`),
  ADD KEY `IDX_9498655BA76ED395` (`user_id`),
  ADD KEY `IDX_9498655B7B6461` (`manga_id`);

--
-- Index pour la table `user_video_game`
--
ALTER TABLE `user_video_game`
  ADD PRIMARY KEY (`user_id`,`video_game_id`),
  ADD KEY `IDX_83DBAABCA76ED395` (`user_id`),
  ADD KEY `IDX_83DBAABC16230A8` (`video_game_id`);

--
-- Index pour la table `video_game`
--
ALTER TABLE `video_game`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_24BC6C5012469DE2` (`category_id`);

--
-- Index pour la table `video_game_category`
--
ALTER TABLE `video_game_category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `video_game_platform`
--
ALTER TABLE `video_game_platform`
  ADD PRIMARY KEY (`video_game_id`,`platform_id`),
  ADD KEY `IDX_996C03DD16230A8` (`video_game_id`),
  ADD KEY `IDX_996C03DDFFE6496F` (`platform_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `board_game`
--
ALTER TABLE `board_game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `board_game_category`
--
ALTER TABLE `board_game_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `comic`
--
ALTER TABLE `comic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `comic_category`
--
ALTER TABLE `comic_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `event_category`
--
ALTER TABLE `event_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `manga`
--
ALTER TABLE `manga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `manga_category`
--
ALTER TABLE `manga_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `place`
--
ALTER TABLE `place`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `platform`
--
ALTER TABLE `platform`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `video_game`
--
ALTER TABLE `video_game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `video_game_category`
--
ALTER TABLE `video_game_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `board_game`
--
ALTER TABLE `board_game`
  ADD CONSTRAINT `FK_F9BD68AF12469DE2` FOREIGN KEY (`category_id`) REFERENCES `board_game_category` (`id`);

--
-- Contraintes pour la table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `FK_E00CEDDE71F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  ADD CONSTRAINT `FK_E00CEDDEA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `comic`
--
ALTER TABLE `comic`
  ADD CONSTRAINT `FK_5B7EA5AA12469DE2` FOREIGN KEY (`category_id`) REFERENCES `comic_category` (`id`);

--
-- Contraintes pour la table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `FK_3BAE0AA712469DE2` FOREIGN KEY (`category_id`) REFERENCES `event_category` (`id`),
  ADD CONSTRAINT `FK_3BAE0AA77E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_3BAE0AA7DA6A219` FOREIGN KEY (`place_id`) REFERENCES `place` (`id`);

--
-- Contraintes pour la table `manga`
--
ALTER TABLE `manga`
  ADD CONSTRAINT `FK_765A9E0312469DE2` FOREIGN KEY (`category_id`) REFERENCES `manga_category` (`id`);

--
-- Contraintes pour la table `user_board_game`
--
ALTER TABLE `user_board_game`
  ADD CONSTRAINT `FK_5EDAAE43A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_5EDAAE43AC91F10A` FOREIGN KEY (`board_game_id`) REFERENCES `board_game` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user_comic`
--
ALTER TABLE `user_comic`
  ADD CONSTRAINT `FK_B9BC5EF2A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B9BC5EF2D663094A` FOREIGN KEY (`comic_id`) REFERENCES `comic` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user_manga`
--
ALTER TABLE `user_manga`
  ADD CONSTRAINT `FK_9498655B7B6461` FOREIGN KEY (`manga_id`) REFERENCES `manga` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_9498655BA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user_video_game`
--
ALTER TABLE `user_video_game`
  ADD CONSTRAINT `FK_83DBAABC16230A8` FOREIGN KEY (`video_game_id`) REFERENCES `video_game` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_83DBAABCA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `video_game`
--
ALTER TABLE `video_game`
  ADD CONSTRAINT `FK_24BC6C5012469DE2` FOREIGN KEY (`category_id`) REFERENCES `video_game_category` (`id`);

--
-- Contraintes pour la table `video_game_platform`
--
ALTER TABLE `video_game_platform`
  ADD CONSTRAINT `FK_996C03DD16230A8` FOREIGN KEY (`video_game_id`) REFERENCES `video_game` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_996C03DDFFE6496F` FOREIGN KEY (`platform_id`) REFERENCES `platform` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
