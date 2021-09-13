-- Adminer 4.8.0 MySQL 5.5.5-10.5.11-MariaDB-1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `category` (`id`, `name`, `image`) VALUES
(1,	'Legos',	'slide1.png'),
(2,	'Figurines',	'slide2.png'),
(3,	'Bobbleheads',	'slide3.png'),
(4,	'DevToys',	'slide4.png');

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210511143700',	'2021-05-11 16:37:16',	69),
('DoctrineMigrations\\Version20210525093908',	'2021-05-25 11:39:50',	53),
('DoctrineMigrations\\Version20210525124022',	'2021-05-25 14:41:50',	126),
('DoctrineMigrations\\Version20210531111352',	'2021-05-31 13:14:05',	70),
('DoctrineMigrations\\Version20210531112550',	'2021-05-31 13:26:02',	69),
('DoctrineMigrations\\Version20210531112948',	'2021-05-31 13:30:00',	87);

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` smallint(6) DEFAULT NULL COMMENT '1=available, 2=unavailable, 3=new',
  `price` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D34A04AD12469DE2` (`category_id`),
  CONSTRAINT `FK_D34A04AD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `product` (`id`, `category_id`, `name`, `description`, `image`, `status`, `price`) VALUES
(1,	1,	'Ant-man',	'Ant-Man vs... well, some evil dude tryin\' get Ant-Man ! Evil dude and yellow cone not included.',	'lego-ant-man.jpeg',	3,	9.99),
(2,	1,	'Batman',	'Legendary DC comics misunderstood and depressive superhero. Armed with his mighty batwings equiped with flaming jet pack and the \"batpnel\" (bat grapnel), this dark vigilante is dead serious when it comes to catching bad guys! ',	'lego-batman.jpeg',	3,	9.99),
(3,	1,	'Batman Vs Superman',	'Two for the price of one! It\'s always a real treat to watch these two lovebirds argue over and over about the dumbest things -- they simply just can\'t get along ! Hilarious.',	'lego-batman-vs-superman.jpeg',	3,	9.99),
(4,	1,	'The Beatles',	'You\'ve probably enjoyed their tunes, now you can enjoy their sense of humour. This comical retelling of the Beatles walking across Abbey Road in Star Wars  costumes will have you smiling all day long. Can\'t put a price on that. ',	'lego-beatles.jpeg',	3,	9.99),
(5,	1,	'Guy in Chicken Suit',	'A true office classic! Especially if you work in open spaces. This will go over huge with your coworkers. A real conversation starter. A guy dressed in a chicken suit? There\'s got to be a story behind that. And now, it\'s up to you to tell that story. So go nuts!',	'lego-chickend-man.jpeg',	NULL,	9.99),
(6,	1,	'GoT Matches?',	'Based on the popular book series A Song of Matches and Fire Safety. Kids, don\'t play with matches. Matches produce fire and fire is dangerous. Even if you think you\'re a dragon. There are no such things as dragons.',	'lego-got.jpeg',	NULL,	9.99),
(7,	1,	'Interstellar',	'Based on the popular Christoper Nolan space flick. Wormholes, blackholes and plotholes. Looks like this little fella\' still trying to figure out how to effectively rebuild a tesseract. Oh and, was that whole Matt Damon bit really necessary?',	'lego-interstellar.jpeg',	NULL,	9.99),
(8,	1,	'Rocket Man',	'BANG! That is all. Thank you. ',	'lego-rocket-man.jpeg',	NULL,	9.99),
(9,	1,	'Out Cold',	'If you\'re like Sheryl, you probably enjoy a nice ski trip in the Rockies and Rocky Road-style ice cream to top it all off after a nice day\'s glide-a-gogo. But you can\'t always afford it. That\'s why we\'re giving away this figurine for FREE. So start saving up! You\'re going to A-S-P-E-N. Just kidding. We really do need the money to pay for this very expensive website.',	'lego-ski.jpeg',	NULL,	9.99),
(10,	1,	'SpongeBob SquarePants',	'Based on the surrealist animated television series about a flamboyant sea sponge and his dim-witted starfish buddy Patrick Star.',	'lego-spongebob.jpeg',	NULL,	9.99),
(11,	1,	'Star Wars Combo Pack',	'Obi-Wan, Yoda and a Stormtrooper. For a limited time only. Force not included. Images are shown for representational purposes only. Do not expect this to happen for real.',	'lego-starwars.jpeg',	NULL,	9.99),
(12,	1,	'Myley The Unicorn',	'Watch out, she\'s a wrecking ball. And as you know, nothing breaks like a heart.',	'lego-unicorn.jpeg',	4,	9.99),
(13,	2,	'Captain America',	'6-INCH-SCALE COLLECTIBLE FIGURE: Captain America Civil War figure with shield, inspired by the character from Marvel Entertainement. Iron Man and Ant-Man figures not included.',	'fig-captainamerica.jpeg',	3,	19.99),
(14,	2,	'The Incredible Hulk',	'6-INCH-SCALE COLLECTIBLE FIGURE: The Incredible Hulk figure comes with extremely bad temper but will nonetheless bring joy into your work life, inspired by the character from Marvel Entertainement.',	'fig-hulk.jpeg',	3,	19.99),
(15,	2,	'Superman',	'6-INCH-SCALE COLLECTIBLE FIGURE: Superman figure, inspired by the character from DC comics.',	'fig-superman.jpeg',	3,	19.99),
(16,	2,	'Spider-Man',	'6-INCH-SCALE COLLECTIBLE FIGURE: Spiderman, inspired by the Stan Lee created character from Marvel Entertainement.',	'fig-spiderman.jpeg',	3,	19.99),
(17,	2,	'Justice League Combo Pack',	'6-INCH-SCALE COLLECTIBLE FIGURES: Superman, Batman and Wonder Woman inspired by the characters from Marvel Entertainement and the Zack Snyder film.',	'fig-justiceleague.jpeg',	NULL,	19.99),
(18,	2,	'Stormtrooper',	'5-INCH-SCALE COLLECTIBLE FIGURE: Stormtrooper figure, inspired by characters from the Star Wars franchise.',	'fig-stormtrooper.jpeg',	NULL,	19.99),
(19,	2,	'Galactic Empire Combo Pack',	'5-INCH-SCALE COLLECTIBLE FIGURES: Darth Vador figure with lightsaber and Stormtrooper figure with  BlasTech E-11 blaster rifle, inspired by characters from the Star Wars franchise.',	'fig-starwars.jpeg',	NULL,	19.99),
(20,	2,	'Mecha Robot AI',	'He talks, he walks, he sings. Plug it directly to your computer with included USB cable. Intellectual programming possible up to 4 different modes: Science, History, Politics and Pop Culture.',	'fig-robot.jpeg',	NULL,	19.99),
(21,	2,	'Super Mario 64',	'Based on the popular platform game developed and published by Nintendo.',	'fig-mario.jpeg',	4,	19.99),
(22,	2,	'Mario Kart 64',	'Based on the popular platform game developed and published by Nintendo.',	'fig-mariokart.jpeg',	NULL,	19.99),
(23,	2,	'Piranha Plant',	'Based on the popular platform game developed and published by Nintendo.',	'fig-piranhaplant.jpeg',	NULL,	19.99),
(24,	2,	'Sonic the Hedgehog',	'Based on the popular platform game developed by Sonic Team and published by Sega. Miles \"Tails\" Prower not included. Each sold separately. ',	'fig-sonic.jpeg',	4,	19.99),
(25,	3,	'Albert Einstein',	'Bobbleheads are a desk\'s centerpiece. Choose the bobblehead that best suits your own very special personality.',	'bh-einstein.jpeg',	NULL,	14.99),
(26,	3,	'Green Gus',	'Bobbleheads are a desk\'s centerpiece. Choose the bobblehead that best suits your own very special personality.',	'bh-gus-green.jpeg',	NULL,	14.99),
(27,	3,	'Michael Myers',	'Bobbleheads are a desk\'s centerpiece. Choose the bobblehead that best suits your own very special personality.',	'bh-michael-myers.jpeg',	NULL,	14.99),
(28,	3,	'James Brown',	'Bobbleheads are a desk\'s centerpiece. Choose the bobblehead that best suits your own very special personality.',	'bh-james-brown.jpeg',	NULL,	14.99),
(29,	3,	'Wenger',	'Bobbleheads are a desk\'s centerpiece. Choose the bobblehead that best suits your own very special personality.',	'bh-wenger.jpeg',	NULL,	14.99),
(30,	3,	'Russel Brand',	'Bobbleheads are a desk\'s centerpiece. Choose the bobblehead that best suits your own very special personality.',	'bh-russelbrand.jpeg',	4,	14.99),
(31,	3,	'Twin Peaks Agent Cooper',	'Bobbleheads are a desk\'s centerpiece. Choose the bobblehead that best suits your own very special personality.',	'bh-twinpeaks.jpeg',	NULL,	14.99),
(32,	3,	'The Boys Homelander',	'Bobbleheads are a desk\'s centerpiece. Choose the bobblehead that best suits your own very special personality.',	'bh-theboys.jpeg',	NULL,	14.99),
(33,	3,	'Green Arrow',	'Bobbleheads are a desk\'s centerpiece. Choose the bobblehead that best suits your own very special personality.',	'bh-greenlantern.jpeg',	NULL,	14.99),
(34,	3,	'Star Wars Combo Pack',	'Bobbleheads are a desk\'s centerpiece. Choose the bobblehead that best suits your own very special personality.',	'bh-starwars.jpeg',	NULL,	14.99),
(35,	3,	'Stormtrooper',	'Bobbleheads are a desk\'s centerpiece. Choose the bobblehead that best suits your own very special personality.',	'bh-stoormtrooper.jpeg',	NULL,	14.99),
(36,	3,	'Gorilla',	'Bobbleheads are a desk\'s centerpiece. Choose the bobblehead that best suits your own very special personality.',	'bh-gorilla.jpeg',	NULL,	14.99),
(37,	4,	'Batduck',	'Every developer knows a plastic duck is a go-to when it comes to wrapping your mind around peculiar concepts. All you need to do is try explaining it out loud back to this custom made Batduck and it will all finally make perfect sense. ',	'dev-batduck.jpeg',	NULL,	9.99),
(38,	4,	'Hyper Rubik\'s Cube',	'Try solving this baby in under a minute and train your brain for the most complex programming algorithms. Passed the 60-second mark, the cubelets switch colors and you have to start all over again !',	'dev-hyperubikscube.jpeg',	NULL,	8.99),
(39,	4,	'Stormtrooper Stressfree Plant',	'Feeling stress out? This plant will help you relax. Plants have that power. Especially when they grown out of a Stormtrooper\'s head.',	'dev-stormtrooperplant.jpeg',	NULL,	12.99),
(40,	4,	'Linux Toys',	'it\'s Linux or nothing else.',	'dev-linux.jpeg',	NULL,	14.99),
(41,	4,	'Punching Ball',	'This is a must have for \"bug free\" days. No error message for too long most definitely means something\'s awfully wrong with your code. Before you delete everything and start over from scratch, free your nerves on this beautiful, hand-made punching ball before you doing anything rash. After all, maybe your code is just perfect. Is it possible you\'ve become so good at coding that it has suddenly become bug free? Yes, it\'s possible. Is it probable? Ha ha, no. Your code is full of bugs.',	'dev-punchingball.jpeg',	NULL,	29.99),
(42,	4,	'Motivational Neon Sign',	'Motivation is key. This will look fantastic on the wall right above your desk. It really sets the tone for the day.',	'dev-neon.jpeg',	NULL,	39.99),
(43,	4,	'Inspirational Mug',	'Writer\'s block is a very common theme amoung developers. This mug will remind you exactly what to do when you\'re experiencing writer\'s block. It\'s that simple. ',	'dev-mug.jpeg',	NULL,	12.99),
(44,	4,	'Kermit the Frog',	'Some developers find the plastic duck routine not always efficient and prefer something a little more interactive. Like having a real conversation with a puppet. And what better puppet than a Muppet? Surely Kermit will do the trick. Based on the character created by Jim Hanson.',	'dev-kermit.jpeg',	NULL,	29.99);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `lastname`, `firstname`, `created_at`, `updated_at`) VALUES
(13,	'john@rambo.com',	'[\"ROLE_USER\"]',	'$argon2id$v=19$m=65536,t=4,p=1$O2RGCzdY7YeMCbU6a0D2HA$0Scnb3cxwqQGeNBpw4W8j4wdmH3Vbl6X+1hmPWoH0rQ',	'Rambo',	'John',	'2021-05-31 10:58:17',	'2021-06-02 16:34:35');

-- 2021-09-13 12:11:48