-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `carte`;
CREATE TABLE `carte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(60) NOT NULL,
  `passwd` varchar(60) NOT NULL,
  `cumul` int(11) NOT NULL,
  `date_valide` datetime NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `carte` (`id`, `nom`, `passwd`, `cumul`, `date_valide`, `date_creation`) VALUES
(1,	'Jean',	'$2y$10$h0o2POjeB6LMiIsnl5263eKibEHYsWsWkpx2mW1hSbszrev05BGJq',	6,	'2018-01-09 16:43:09',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `categorie` (`id`, `nom`, `description`) VALUES
(1,	'bio12',	'sandwichs ingrédients bio et locaux'),
(2,	'végétarien',	'sandwichs végétariens - peuvent contenir des produits laitiers'),
(3,	'traditionnel',	'sandwichs traditionnels : jambon, pâté, poulet etc ..'),
(4,	'chaud',	'sandwichs chauds : américain, burger, '),
(5,	'veggie',	'100% Veggie'),
(16,	'world',	'Tacos, nems, burritos, nos sandwichs du monde entier');

DROP TABLE IF EXISTS `commande`;
CREATE TABLE `commande` (
  `id` varchar(80) NOT NULL,
  `nom` varchar(80) NOT NULL,
  `mail` varchar(80) NOT NULL,
  `date` varchar(80) NOT NULL,
  `heure` varchar(80) NOT NULL,
  `etat` int(11) NOT NULL DEFAULT 1,
  `token` varchar(255) DEFAULT NULL,
  `carte` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carte` (`carte`),
  CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`carte`) REFERENCES `carte` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `commande` (`id`, `nom`, `mail`, `date`, `heure`, `etat`, `token`, `carte`, `created_at`, `updated_at`) VALUES
('02044dd4-05cf-11e8-8fb9-c936ddbc93c0',	'zdfzf',	'zdzfzf',	'10-10-2020',	'10:20',	1,	'd3b971bcc17ce465ffa868db04b2497607563a7747183506b9920fca6357cdcc',	NULL,	'2018-01-30 15:05:28',	'2018-01-30 15:05:28'),
('0de6fefa-e4c6-11e7-9237-d3c9327f12bc',	'testnom',	'test@test.fr',	'0000-00-00',	'00:00:00',	1,	'ebf870c716e3fb399ba50e7bc28971e811a991b600b1ebced7a7452f6c0e34b5',	NULL,	NULL,	NULL),
('1',	'test',	'zfzfzfz',	'0000-00-00',	'00:00:00',	0,	NULL,	NULL,	NULL,	NULL),
('16c248ca-05cf-11e8-bd47-f90fea143e43',	'jean mizqfzqfqzfzqf',	'jm@gmal.com',	'07-12-2017',	'12:30',	1,	'e0383d83debba6560b9b1f83380aad358ac047a75f257119940cd3e4359361be',	NULL,	'2018-01-30 15:06:03',	'2018-01-30 15:06:03'),
('2',	'jean',	'jm@gmal.com',	'07-12-2019',	'12:30',	1,	'5a3253c040411',	NULL,	NULL,	'2018-01-30 15:16:46'),
('307a80ea-e4c6-11e7-bfb9-adbecf1255c8',	'jean mi',	'jm@gmail.com',	'7-12-2018',	'12:30',	1,	'7b0b8fc2469804f5ff808d3a1394e2308a914cf28bd17dc71106cd1a104d1017',	NULL,	NULL,	NULL),
('34535864-f550-11e7-8bcf-cbd354ef0616',	'jean mi',	'jm@gmail.com',	'7-12-2018',	'12:30',	1,	'a9885adb0471bc441b06f3c61a20bd43057c85db6a9f12ceb5af6c1cbba26b37',	NULL,	NULL,	NULL),
('56606a84-e4c8-11e7-b05a-11b0121c4e96',	'testnom',	'test@test.fr',	'20-12-2017',	'14:20',	1,	'f471bfaa9b7da720ba616217f34d1a56f18e2ce9a3da5df64bb4cb1a306a58ed',	NULL,	NULL,	NULL),
('6143bcda-e4c8-11e7-9afb-5d047c98e818',	'testnom',	'test@test.fr',	'20-12-2017',	'14:20',	1,	'733c490afa24a84bbe9e47b3f740f1a07338c60ecc24120da33aec50cdf976bd',	NULL,	NULL,	NULL),
('6257ab2c-e4c8-11e7-bf85-0334a6d52c2e',	'testnom',	'test@test.fr',	'20-12-2017',	'14:20',	1,	'c9b46eafb89655c7a92387c872c22a5bfd220de2792eb43df156ae0707a8c5fb',	NULL,	NULL,	NULL),
('7a34166a-e4c6-11e7-94eb-6f965c22b01b',	'testnom',	'test@test.fr',	'0000-00-00',	'00:00:00',	1,	'e035d2b1462cc1b5935567fdbc5d841ce94395fe01246c8307738219b47461cd',	NULL,	NULL,	NULL),
('abd90832-e4c7-11e7-b7d4-eb345a0346f2',	'testnom',	'test@test.fr',	'20-12-2017',	'14:20',	1,	'4251e0ff202660285e6325ebb26ec55b8f69bac6496236cbea3d67063d59252a',	NULL,	NULL,	NULL),
('b37ca5ba-05d0-11e8-ae96-6929a53b463d',	'jean',	'jm@gmal.com',	'07-12-2019',	'12:30',	1,	'f24eece74a4471bfc7ef17fa2f38b3d8a8485d8f46893ece21e37335df7d347a',	NULL,	'2018-01-30 15:17:35',	'2018-01-30 15:17:35');

DROP TABLE IF EXISTS `item`;
CREATE TABLE `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commande` varchar(80) NOT NULL,
  `id_taille_sandwich` int(11) NOT NULL,
  `id_sandwich` int(11) NOT NULL,
  `qte` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_commande` (`id_commande`),
  KEY `id_taille_sandwich` (`id_taille_sandwich`),
  KEY `id_sandwich` (`id_sandwich`),
  CONSTRAINT `item_ibfk_1` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id`),
  CONSTRAINT `item_ibfk_2` FOREIGN KEY (`id_taille_sandwich`) REFERENCES `taille_sandwich` (`id`),
  CONSTRAINT `item_ibfk_3` FOREIGN KEY (`id_sandwich`) REFERENCES `sandwich` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `item` (`id`, `id_commande`, `id_taille_sandwich`, `id_sandwich`, `qte`) VALUES
(1,	'0de6fefa-e4c6-11e7-9237-d3c9327f12bc',	1,	4,	4),
(2,	'0de6fefa-e4c6-11e7-9237-d3c9327f12bc',	1,	4,	4),
(3,	'0de6fefa-e4c6-11e7-9237-d3c9327f12bc',	1,	4,	4),
(4,	'0de6fefa-e4c6-11e7-9237-d3c9327f12bc',	1,	4,	4),
(5,	'0de6fefa-e4c6-11e7-9237-d3c9327f12bc',	1,	4,	4),
(6,	'0de6fefa-e4c6-11e7-9237-d3c9327f12bc',	1,	4,	4),
(7,	'0de6fefa-e4c6-11e7-9237-d3c9327f12bc',	1,	4,	4),
(8,	'0de6fefa-e4c6-11e7-9237-d3c9327f12bc',	1,	4,	4);

DROP TABLE IF EXISTS `sand2cat`;
CREATE TABLE `sand2cat` (
  `sand_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `sand2cat` (`sand_id`, `cat_id`) VALUES
(4,	3),
(4,	4),
(5,	3),
(5,	1),
(6,	4),
(6,	16);

DROP TABLE IF EXISTS `sandwich`;
CREATE TABLE `sandwich` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `type_pain` text NOT NULL,
  `img` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `sandwich` (`id`, `nom`, `description`, `type_pain`, `img`) VALUES
(4,	'le bucheron',	'un sandwich de bucheron : frites, fromage, saucisse, steack, lard grillé, mayo',	'baguette campagne',	NULL),
(5,	'jambon-beurre',	'le jambon-beurre traditionnel, avec des cornichons',	'baguette',	NULL),
(6,	'fajitas poulet',	'fajitas au poulet avec ses tortillas de mais, comme à Puebla',	'tortillas',	NULL),
(7,	'le forestier',	'un bon sandwich au gout de la forêt',	'pain complet',	NULL),
(10,	'ab-fuga',	'Et tenetur praesentium nulla facere officia et. Consequatur quasi aperiam qui enim vel. Maiores nemo dolor aliquid et architecto ea voluptas at.',	'tortillas',	NULL),
(11,	'vitae-in',	'Sed consequatur nobis est. Et et cupiditate ipsam sequi earum sint non. Qui incidunt magnam tempora quas eum qui.',	'pain complet',	NULL),
(12,	'impedit-qui',	'Aut aut rem exercitationem voluptates qui. Qui soluta aut minus dolor est. Sequi cum quos vel placeat.',	'baguette',	NULL),
(13,	'similique-sed',	'Rerum ipsa nihil et aut possimus. Autem et aut eos odit. Maxime consequuntur nemo facilis atque culpa et.',	'mie',	NULL),
(14,	'qui-corporis',	'Asperiores velit ut voluptatem magni et voluptatem. Illum aut possimus iste. Beatae ut ipsa aut dolores mollitia explicabo molestias.',	'mie',	NULL),
(15,	'nihil-qui',	'Veritatis voluptatem culpa et et autem itaque. Quos neque in aut esse facere consequuntur. Ab in repellat ut voluptatem ullam fugiat odit.',	'tortillas',	NULL),
(16,	'sapiente-soluta',	'Vel tempore est quae velit. Adipisci delectus itaque molestias voluptatem numquam libero libero accusamus. Aut delectus blanditiis non ab consequatur.',	'baguette campagne',	'img/c83871837e68cc38e6fb7fd0b904bb59.png'),
(17,	'tempore-omnis',	'Ut qui perferendis est expedita aut iste. Illo id libero impedit sunt. Ut aliquid et qui unde at est.',	'tortillas',	NULL),
(18,	'mollitia-omnis',	'Est reiciendis a illo voluptate. Expedita soluta autem iure. Voluptatum id nemo quos optio recusandae quia iure.',	'mie',	'img/7589799de870ef7f71a6173879c53130.png'),
(19,	'quo-est',	'Voluptatibus accusamus dolorem velit assumenda. Quo dolor ab autem deserunt necessitatibus et. Quisquam quas voluptas et quas perspiciatis aut rerum.',	'mie',	NULL),
(20,	'aperiam-voluptas',	'Quae neque iusto fugiat omnis non alias dolore voluptatem. Beatae praesentium adipisci et corrupti accusamus nesciunt ullam vel. Et repudiandae asperiores quo impedit perspiciatis possimus accusantium.',	'mie',	NULL),
(21,	'quis-dolorem',	'Qui numquam possimus fugiat et quaerat. Nobis sapiente porro aliquam et. Quam voluptas qui iste et reprehenderit.',	'baguette',	NULL),
(22,	'adipisci-sed',	'Vero blanditiis quis non iusto dolor incidunt. Sint temporibus vitae dolore veniam. Necessitatibus molestias vel aut eius non.',	'mie',	NULL),
(23,	'minima-et',	'Ullam quia sequi consequatur commodi. Quam rem fugit tenetur quo incidunt et. Illo consequatur est cupiditate consectetur fugit quo.',	'baguette campagne',	'img/7fd2633c08937135a935d2bdd1348949.png'),
(24,	'dolor-perspiciatis',	'Incidunt laudantium illo esse molestiae magnam. Eum quia facere hic dolorem doloribus assumenda. Recusandae quae nesciunt provident voluptatum molestiae voluptatem vitae.',	'baguette',	NULL),
(25,	'ducimus-sunt',	'Consequatur maiores reiciendis unde. Consequuntur nihil aliquam explicabo aut magnam et. Natus unde quia quia molestias.',	'pain complet',	NULL),
(26,	'laborum-ad',	'Beatae non reiciendis expedita itaque cupiditate odit rerum consequuntur. Exercitationem earum voluptatem accusantium ipsam dolore mollitia non inventore. Iure dolor velit asperiores optio optio non iure.',	'pain complet',	NULL),
(27,	'accusantium-omnis',	'Est ut et id perferendis placeat cumque. Provident qui perspiciatis in in distinctio. Ea sit nihil nihil.',	'baguette campagne',	'img/5842d14c195888425c82fd1d7f135516.png'),
(28,	'beatae-quaerat',	'Vero vero tempore veniam aut. Repellat itaque velit illum consequatur sint eos. Delectus eos sunt dolorum autem blanditiis eius quis dolores.',	'tortillas',	NULL),
(29,	'ea-qui',	'Dolore quod dicta ut quisquam placeat. Deleniti velit eius quis sit sunt neque architecto. Perspiciatis quae voluptas tenetur qui at sunt vel.',	'mie',	NULL),
(30,	'expedita-quo',	'Nostrum quia qui voluptatum ad. Delectus omnis eveniet modi. Qui dolorem soluta consequuntur iusto.',	'pain complet',	NULL),
(31,	'laboriosam-eos',	'Neque sit molestiae necessitatibus voluptas ad voluptatem voluptatem. Corporis inventore nam et dolorem odit ea quisquam enim. Pariatur ad dolorem laborum voluptatem.',	'tortillas',	NULL),
(32,	'quod-deleniti',	'Eligendi aut atque id quia. Unde sed doloremque suscipit ut quia ipsam. Ipsa aliquid quidem et in enim exercitationem voluptatum sequi.',	'mie',	'img/114d1c2d4c030dc1118bc16cbe2b05cc.png'),
(33,	'sit-enim',	'Ea veritatis facere debitis aperiam adipisci corporis et. Eum libero asperiores atque voluptatem. Distinctio assumenda illo est soluta voluptatem ea expedita.',	'tortillas',	NULL),
(34,	'mollitia-ipsum',	'Molestiae voluptatem in impedit praesentium autem ex. Doloribus explicabo magni dolor consequuntur cupiditate aliquid voluptate. Corporis nulla voluptatem dolor ut aut facilis minima.',	'pain complet',	NULL),
(35,	'modi-cum',	'Et nihil qui vero non facilis quasi. Libero ut est qui non quos. Voluptates voluptatem quia quasi sit id dolor quaerat.',	'tortillas',	NULL),
(36,	'dolorum-aut',	'Sequi dolorem quas sed nostrum. Non quas molestias et sunt aliquam tenetur mollitia corrupti. Ut sit libero rem magni.',	'pain complet',	'img/1dc4d4bcfccd4735194236f04d4d1f66.png'),
(37,	'itaque-natus',	'Dolorem architecto dolorem et. Et voluptatum fugiat voluptas quia saepe sed dolore. Non esse quia ea.',	'pain complet',	'img/742673b0d81bc75f520f472c8566d3b7.png'),
(38,	'unde-qui',	'Voluptatem autem expedita non molestias. Magni accusantium harum adipisci iste eum. Reprehenderit suscipit est nihil et esse id perferendis quo.',	'baguette',	NULL),
(39,	'architecto-minus',	'Non ut aperiam dolore excepturi velit voluptatum. Tenetur nihil reprehenderit voluptatem voluptates non. Debitis magni explicabo sit.',	'baguette campagne',	NULL),
(40,	'laudantium-voluptates',	'Consequatur reprehenderit ut ipsa in et reprehenderit eum. Incidunt dolores sed odit et corporis dignissimos omnis. Autem nihil vero odio repellendus voluptas ipsam.',	'baguette',	'img/c2d740de94f7d483bdde260494ab67fc.png'),
(41,	'corrupti-sapiente',	'Saepe omnis harum temporibus. Enim quia qui at et aut reiciendis saepe non. Ex assumenda totam expedita qui voluptatem eveniet totam.',	'mie',	NULL),
(42,	'et-nesciunt',	'Dolor culpa distinctio harum ut. Consequatur quis soluta id nemo. Ea alias eum est earum.',	'mie',	NULL),
(43,	'sit-dolor',	'Aliquam autem et non. Error quia et sed at dolores repellendus. Libero quia repellat debitis minus est.',	'tortillas',	'img/cdc30e3970df46144adfa63e7e6b1595.png'),
(44,	'voluptas-rerum',	'Ipsum perspiciatis nihil eos sint. Voluptas voluptate non ut laborum molestiae. Veritatis beatae cupiditate non optio.',	'baguette',	'img/a317714831e45c52deee048a48b1c892.png'),
(45,	'consectetur-commodi',	'Vero ut consequatur voluptas in et maxime. Distinctio vitae totam voluptatum debitis in consectetur recusandae. Facilis nihil sed voluptatem delectus quod minus facere provident.',	'tortillas',	NULL),
(46,	'minima-omnis',	'Eos autem deserunt assumenda magni suscipit. Ut ut qui porro et. Quos consequatur mollitia veniam vitae.',	'pain complet',	'img/991594dbfc3736a9c2622cf00112399f.png'),
(47,	'est-modi',	'Ex veritatis fugit temporibus ipsa alias velit a et. Qui voluptas aut ipsam quidem nostrum odit cumque praesentium. Velit expedita reiciendis commodi ea cupiditate aut.',	'baguette',	NULL),
(48,	'inventore-in',	'Dolorem cumque molestiae voluptate error ut vero. Aut exercitationem dicta dicta nihil sapiente porro. Consequatur iure enim velit impedit nisi sunt.',	'baguette',	NULL),
(49,	'temporibus-ipsam',	'Consequatur maiores id tenetur. Rerum quos mollitia similique sint omnis autem enim. Exercitationem necessitatibus aspernatur sequi aperiam minus.',	'tortillas',	NULL),
(50,	'perspiciatis-dolorum',	'Quas numquam minus cumque perferendis non quisquam. A magnam aut aut sint. Alias rem aut a nam.',	'baguette campagne',	NULL),
(51,	'molestiae-ratione',	'Ut velit similique dolorum blanditiis. Doloribus sint ipsa esse in eligendi possimus. Omnis laboriosam ipsum praesentium voluptatem.',	'mie',	'img/07fb4b5dc6a0425929a4b877205cebb3.png'),
(52,	'veniam-voluptas',	'Quisquam dolores minus tempora dolores rem officia dolor ratione. Tenetur nemo quis veniam consequuntur rerum incidunt voluptas velit. Sed eius est id inventore odio.',	'baguette',	NULL),
(53,	'est-vero',	'Aut aut aliquam odit minus corrupti omnis eos. Omnis et repellendus quis dolorum. Modi non ratione accusantium.',	'tortillas',	NULL),
(54,	'repellendus-vitae',	'Sint est incidunt esse officia consequuntur dolorum. Vitae ut non ab voluptas officia expedita adipisci. Autem qui harum sint recusandae.',	'pain complet',	NULL),
(55,	'eligendi-eius',	'Ea consequatur quis dicta sit sed. Cumque illo dolores ab molestiae non blanditiis. Sit eum unde ratione explicabo repudiandae.',	'mie',	NULL),
(56,	'nihil-maiores',	'Id nesciunt aut dolorem ea repudiandae. Voluptatem quia et officiis et. Maxime sit enim ex ad aut velit.',	'pain complet',	NULL),
(57,	'eaque-nostrum',	'Enim fuga sequi quis aspernatur. Rerum beatae vel aliquam qui nihil id. Illum doloribus culpa ad praesentium ex.',	'baguette campagne',	NULL),
(58,	'nulla-consequuntur',	'Omnis consequatur quod possimus. Autem harum possimus harum laborum eligendi qui. Eligendi et dolorem id dolores.',	'baguette',	'img/83916726e811c8de722d057d02812fdd.png'),
(59,	'ipsum-impedit',	'Vero libero rem voluptas qui. Inventore similique itaque neque explicabo autem. Voluptatibus aperiam qui qui hic sunt et.',	'pain complet',	'img/b047421fe8adcb89b8a0d938f29eb6da.png'),
(60,	'odio-quis',	'Est consequatur quasi inventore rerum. Aliquam fuga dolor id adipisci delectus. Vero quo ut enim dignissimos et doloribus quis dolores.',	'pain complet',	NULL),
(61,	'laboriosam-ut',	'Aut adipisci maxime ut sed temporibus. Delectus repellat sint expedita et maiores. Voluptatem dolores rerum vel molestias velit sed modi deleniti.',	'baguette',	'img/ed392cf0faa69cc967d6ac8d9b9cbfb4.png'),
(62,	'officiis-ducimus',	'Rerum explicabo ducimus culpa dolores. Asperiores error illo maxime qui libero modi est. Sit eum recusandae aut et quos.',	'baguette',	NULL),
(63,	'aperiam-et',	'Tempore sequi est eos facere soluta voluptatem recusandae. Necessitatibus aliquid quae necessitatibus rerum maiores enim in. Vel voluptatem ut delectus.',	'tortillas',	NULL),
(64,	'ut-laboriosam',	'Voluptatem et quae molestiae aut et voluptas. Ducimus non culpa quia voluptas non debitis. Eos velit laborum dolor.',	'tortillas',	'img/16d085eb2d4d8730f8c07be498ceee64.png'),
(65,	'sunt-minus',	'Quos officia ea provident. Reprehenderit sunt et aspernatur minima facere quod nulla. Cupiditate aliquid numquam architecto laborum tempora in est.',	'baguette',	'img/d8df6f4d770664f76a847ebcf395f1fa.png'),
(66,	'laboriosam-qui',	'Nemo commodi voluptas rerum molestiae ut assumenda dolor. Aut qui aut nemo aliquam facilis consectetur. Quidem possimus aut est corporis qui voluptas suscipit.',	'pain complet',	NULL),
(67,	'rem-doloribus',	'Nobis voluptates commodi autem et beatae tempore. Ut sit natus recusandae eum recusandae. Qui temporibus ipsam dolores dolor esse quod.',	'pain complet',	NULL),
(68,	'eius-vel',	'Accusamus aspernatur harum enim deleniti est. Officiis consequuntur sapiente expedita commodi laboriosam recusandae. Debitis repellat et voluptas eos ipsam.',	'pain complet',	NULL),
(69,	'quia-quas',	'Assumenda doloremque ut explicabo aut esse et vero. Et accusamus explicabo debitis est consectetur. Quisquam voluptas dicta aperiam laboriosam sit.',	'pain complet',	'img/52ab422d125a222a57986dfbec5c64f8.png'),
(70,	'sit-expedita',	'Quo perspiciatis tempora et quis reprehenderit esse sapiente. Mollitia illo repellendus culpa et. Deserunt pariatur voluptatem pariatur autem quidem aut rem.',	'baguette',	'img/e112e7284b1258058776999219be05c0.png'),
(71,	'molestiae-minima',	'Dolorem cupiditate maxime quia aut autem et libero. Ducimus qui qui fugit sed voluptatem odit atque iusto. Error iste at eum consequuntur qui et.',	'pain complet',	NULL),
(72,	'beatae-suscipit',	'Asperiores voluptatem excepturi velit et. Rerum molestiae cumque quas tenetur et eveniet. Quaerat optio autem earum omnis sequi voluptas.',	'baguette campagne',	'img/12b3f9d041d62611d539fbebf2eda05a.png'),
(73,	'dicta-sint',	'Ea maxime id temporibus rem enim. Aut dolor sed asperiores illum nesciunt quisquam ut. Animi sed sed autem quia beatae non.',	'baguette',	NULL),
(74,	'ut-praesentium',	'Et magnam omnis amet nesciunt consectetur ipsa. Ratione magni sed possimus ut sed. At sit perferendis eos commodi voluptas omnis minus fugiat.',	'mie',	NULL),
(75,	'doloribus-non',	'Est assumenda voluptas hic possimus recusandae repellat quis. Eum dignissimos libero illo illum id illum earum. Molestiae quibusdam hic iusto non.',	'baguette',	'img/c8ff58e7a299d8d01b1a69ac2cb7f5a5.png'),
(76,	'aut-iusto',	'Explicabo quia quia officiis. Pariatur quam qui nostrum ut inventore. Rerum corporis voluptatum illum expedita quam neque fugit.',	'tortillas',	NULL),
(77,	'nihil-debitis',	'Veniam sed ullam quasi quibusdam. Et illo sit dicta possimus. Eum praesentium esse a ipsa dolor neque deleniti quia.',	'pain complet',	NULL),
(78,	'tenetur-debitis',	'Exercitationem fuga eaque ex autem libero. Necessitatibus totam aut est molestiae. Voluptatem suscipit laboriosam est qui natus qui nemo.',	'mie',	'img/548dbc719a32fb75e627bb5ec88c1efe.png'),
(79,	'error-aut',	'Quos qui officia voluptatem alias. Aut optio corrupti corrupti velit fugit. Voluptatem et neque omnis doloribus accusamus facilis.',	'pain complet',	NULL),
(80,	'dolorem-dolorem',	'Soluta et labore delectus quisquam et ullam et. Vel unde delectus qui modi. Distinctio et ex sint qui dolor eos blanditiis libero.',	'baguette campagne',	'img/38853c71a4167ee6e3f6bf0433cca2b5.png'),
(81,	'et-odit',	'Sunt et laudantium ducimus qui et excepturi ratione sit. Ab maxime labore sed ipsam officiis. Sit saepe autem incidunt et omnis nulla odio enim.',	'mie',	'img/960684bbdef89b240b5fa221493f60ba.png'),
(82,	'nostrum-eligendi',	'Nostrum rerum voluptas quia repellendus et odio libero. Ipsa aliquid ipsum eligendi porro consequuntur nisi assumenda. Quam ratione reiciendis non vitae deserunt distinctio.',	'mie',	'img/916e5a135ebc72c38de6f2fe35bc211a.png'),
(83,	'nesciunt-distinctio',	'Ipsam ratione at consequuntur modi ut. Ex odio sint molestiae id at quam cumque. Dolor laborum alias a repellat dolor qui et.',	'mie',	NULL),
(84,	'magni-autem',	'In beatae eos dolorem aliquam est vero iste. Harum adipisci velit quod impedit fugiat. Exercitationem repellat asperiores dolor officiis laboriosam facilis id.',	'baguette campagne',	NULL),
(85,	'sit-impedit',	'Deserunt cumque animi dolores iure. Et delectus non assumenda officia id dignissimos. Est velit quasi eum facilis accusamus.',	'mie',	'img/151d76856fb9fa716fdede9b57ea00ec.png'),
(86,	'maxime-ut',	'Ducimus aut sed facere ratione. Quia voluptatibus iusto voluptatem quod. Atque vel iure repellendus ipsum sed exercitationem recusandae.',	'baguette campagne',	'img/f12957e5266616b1d7532323cc2de738.png'),
(87,	'odit-illum',	'Inventore accusantium qui est totam quis. Voluptates sit reprehenderit debitis officiis et et aut. Saepe atque qui quae quod velit.',	'mie',	'img/886718da90e0bb0167bd3cae8e8fbebb.png'),
(88,	'in-est',	'Et omnis molestiae vitae hic qui corrupti. Sit suscipit quo non architecto dolores deserunt. Eum minus sed quis.',	'baguette campagne',	NULL),
(89,	'ipsum-hic',	'Sit quam culpa sit sapiente magni voluptas nihil. Eaque architecto provident aperiam aliquid voluptatem. Quod minus maxime et ut aliquid quis consectetur.',	'baguette',	'img/4fe256dfeadfaa91951e6a81fd40921b.png'),
(90,	'rerum-magnam',	'Qui ut est distinctio aliquid. Velit voluptatem aliquam odit. Numquam magni consequuntur fugiat amet dolor asperiores.',	'tortillas',	NULL),
(91,	'aspernatur-hic',	'Dolorum eos consequatur blanditiis expedita dolores. Modi ut deserunt libero in veritatis repellat et. Nostrum nesciunt aut voluptatum minus qui exercitationem tempora aut.',	'baguette campagne',	NULL),
(92,	'placeat-consequuntur',	'Reprehenderit nihil eum quidem nostrum maiores. Beatae placeat et voluptas ducimus voluptatum adipisci blanditiis aliquid. Sit fuga adipisci sequi autem sit voluptates.',	'pain complet',	'img/e8a000fbe0bb1a78b9d2119fea1047a6.png'),
(93,	'reiciendis-sint',	'Atque praesentium rerum numquam. Id ut et consequatur dolorem. Rerum eum necessitatibus officia rerum sed minus quia.',	'pain complet',	NULL),
(94,	'sint-aut',	'Nam dicta in repudiandae et recusandae distinctio. Sunt deleniti nesciunt eveniet impedit beatae blanditiis nisi. Molestias deserunt iusto reiciendis ut dolorem.',	'pain complet',	NULL),
(95,	'distinctio-ad',	'Sunt in aut at corrupti. Quaerat nihil explicabo sapiente aut adipisci. Cupiditate dicta voluptas quibusdam nihil accusamus et.',	'baguette campagne',	NULL),
(96,	'voluptas-molestiae',	'Voluptatum omnis optio ad odio ratione quos magnam. Illum et qui non iure. Dicta itaque quos harum quo quo omnis.',	'tortillas',	'img/5fcb5797776b4acddcc3114599050d06.png'),
(97,	'et-at',	'Inventore necessitatibus et autem voluptatibus quia eos. Molestias eaque voluptatum velit cum nulla repellat ut sit. Animi ut doloribus laudantium modi.',	'tortillas',	NULL),
(98,	'rerum-pariatur',	'Et quae minus ipsa illum. Voluptas eligendi sit et praesentium assumenda beatae dolorum. Culpa exercitationem ducimus deserunt incidunt.',	'tortillas',	NULL),
(99,	'voluptatibus-tempora',	'Repellat exercitationem aspernatur expedita delectus autem quibusdam iure. Assumenda ut natus pariatur dolorem eos architecto qui reprehenderit. Quam sit natus magnam similique maxime.',	'baguette',	'img/1e794d57abb56ea407a77c56bcc37197.png'),
(100,	'explicabo-quia',	'Est necessitatibus sit inventore. Nihil culpa eos quaerat ipsa rem modi facere. At aut sed nesciunt inventore est ut.',	'pain complet',	'img/4f96a002444be86d244e4f7159a29dc6.png'),
(101,	'ducimus-voluptates',	'Dolorem dolorum adipisci ut in. Esse et consequatur tenetur dolor. Asperiores dolorem facilis voluptatum recusandae.',	'mie',	'img/44fbc36c5ec08cc6c3c0e49272c5c684.png'),
(102,	'consequatur-aspernatur',	'Qui aliquam voluptas et et sit quo. Mollitia iusto dolorum natus ut sed vitae nihil ut. Nostrum aperiam dolore corporis placeat.',	'baguette',	NULL),
(103,	'aspernatur-commodi',	'In ut et voluptatem ad non necessitatibus omnis. Id aliquam praesentium nam. Laborum animi illum delectus est explicabo id quis.',	'mie',	'img/f33bdb70d55794baf46aa398386853b2.png'),
(104,	'eaque-similique',	'Distinctio et et repellat dolores qui nihil. Quia nobis et eius vel. Autem assumenda magnam qui qui placeat.',	'mie',	'img/10062116ad39a09919a97f41a1a13f2b.png'),
(105,	'dolores-facilis',	'Sit et modi eligendi eum modi quia provident. Qui dolor rerum repellat voluptates. Voluptas eligendi sint nihil iusto eum.',	'mie',	NULL),
(106,	'eos-omnis',	'Sunt culpa sapiente temporibus dolorum aspernatur omnis. Et unde sed aspernatur est. Quisquam dolorum velit natus perspiciatis ut.',	'pain complet',	'img/8e4971b29216225b039f07ffcf8c964d.png'),
(107,	'asperiores-inventore',	'Atque ad eos a beatae. Doloribus nemo ipsam dolore vero. Maiores nam porro sit.',	'tortillas',	NULL),
(108,	'velit-est',	'Quia sit qui eaque doloremque mollitia eveniet aut excepturi. Ut sed velit doloribus. Quia qui dolor velit quo nostrum debitis perferendis.',	'baguette',	NULL),
(109,	'ipsum-in',	'Ipsa occaecati nam dolores autem assumenda. Et nihil odit ut nihil et aut ut. Rem et ut adipisci fugit voluptatem.',	'baguette campagne',	NULL),
(110,	'dolores-voluptatem',	'Delectus et deleniti libero blanditiis iste beatae. Consequatur ut ut magni iure qui accusantium id. Corporis illum illum aut atque tenetur aut.',	'baguette',	NULL),
(111,	'non-dolor',	'Sunt non porro facere maiores. Enim porro voluptate nostrum aliquam facilis. Sed aut blanditiis qui.',	'pain complet',	'img/f660903077e0dbd42af9ebad86b31373.png'),
(112,	'et-rerum',	'Quidem exercitationem est suscipit omnis. Numquam dignissimos cumque porro voluptatem. Placeat cum sequi dolorum voluptates consectetur repellat quidem.',	'baguette',	NULL),
(113,	'aut-dolorem',	'Consequuntur temporibus dolor quibusdam iure fuga est. Ut unde suscipit corrupti odio dolores velit. Aut aut quis qui non dolorem voluptatem qui.',	'tortillas',	NULL),
(114,	'accusamus-voluptas',	'Rerum et in quis voluptas. Hic fugiat nobis maxime suscipit eligendi rerum. Dolorum officia nihil asperiores ipsa.',	'pain complet',	NULL),
(115,	'est-excepturi',	'Sunt voluptatem est autem dolorem qui expedita. Dolores qui quis nam et officiis dolor. Sunt ratione quia in at est omnis temporibus.',	'tortillas',	NULL),
(116,	'délice de la mer',	'le bon sandwich au saumon',	'mie',	NULL),
(117,	'qzfzq',	'qzfqzf',	'qzf',	''),
(118,	'qzfqs',	'fsfsfsfsf',	'dg',	''),
(119,	'qzf',	'sfsfsfsf',	'sf',	''),
(120,	'qzfq',	'ssf',	'sdsf',	'');

DROP TABLE IF EXISTS `taille_sandwich`;
CREATE TABLE `taille_sandwich` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `taille_sandwich` (`id`, `nom`, `description`) VALUES
(1,	'petite faim',	'le sandwich rapide pour les petites faims, même si elles sont sérieuses'),
(2,	'complet',	'le sandwich taille optimale pour un casse-croûte à toute heure'),
(3,	'grosse faim',	'à partager, ou pour les affamés'),
(4,	'ogre',	'pour les faims d\'ogres, et encore ....');

DROP TABLE IF EXISTS `tarif`;
CREATE TABLE `tarif` (
  `taille_id` int(11) NOT NULL,
  `sand_id` int(11) NOT NULL,
  `prix` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tarif` (`taille_id`, `sand_id`, `prix`) VALUES
(1,	4,	6.00),
(2,	4,	6.50),
(3,	4,	7.00),
(4,	4,	8.00),
(1,	5,	3.50),
(2,	5,	4.00),
(3,	5,	5.00),
(4,	5,	6.00),
(1,	6,	5.00),
(2,	6,	7.00),
(3,	6,	9.00),
(4,	6,	12.00);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id`, `pseudo`, `password`) VALUES
(1,	'Jean',	'$2y$10$h0o2POjeB6LMiIsnl5263eKibEHYsWsWkpx2mW1hSbszrev05BGJq');

-- 2018-01-30 16:59:32
