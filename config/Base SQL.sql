-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 09 fév. 2019 à 10:28
-- Version du serveur :  5.7.21
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `chapo` varchar(512) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(100) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `date_added` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_fk` (`author`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `title`, `chapo`, `content`, `author`, `picture`, `date_added`) VALUES
(69, 'Berger Australien, le chien qu\'il vous faut ?', 'Vous souhaitez accueillir un Berger Australien dans votre famille ? Est-ce la bonne race de chien pour vous ? Découvrez notre dossier pour vous aider à faire votre choix.', 'Le berger australien est un chien avant tout gentil, doux et adorable. Cependant comme tout chien, il a besoin d’une éducation ferme. Éduquer son chien c’est l’aimer. Le berger australien est une race faite pour des propriétaires ayant une expérience avec les chiens. Le berger australien dans un appartement risque d’être malheureux. Il a besoin d’espace pour se dépenser.\r\nPar ailleurs, ce chien demande qu’on lui accorde du temps et de l’affection. Le berger australien est très sportif. Pour son activité physique, promenades, jeux … sont à prévoir et cela demande du temps et également de l’énergie de la part des maîtres.\r\nConcernant la catégorie, le berger australien n’est pas classé. Cela dit il fera un chien de garde parfait.\r\nAvec les enfants, si son éducation a été faite avec brio, il n’y aura aucun souci, il adore les enfants et aime jouer avec eux. Sa douceur, sa gentillesse reste une des caractéristiques de sa personnalité.\r\nUn chiot berger australien fera certainement des bêtises. Tout chiot explore, teste ses maîtres et son environnement. Découvrir le monde qui l’entoure et apprendre des règles ne se fait pas du jour au lendemain pour un chiot. \r\n \r\nUne chiot berger australien se fera les dents, goûtera aux choses qui l’entoure (attention à le mettre à l’abri des dangers comme les produits toxiques). Mais comme tout « enfant », un chiot doit être recadré pour lui assurer une santé mentale seine. \r\nPour un chiot, sauter sur les gens, mordiller... reste un jeu, ainsi il faudra lui apprendre positivement les règles. Il reste évident que ce n’est pas en tapant ou battant un chien que ce dernier apprendra plus vite. Bien au contraire, ce type de violence mettra à mal une bonne éducation et n’assurera pas une bonne santé mentale au chien. Une éducation au « clic » est conseillée.', 'deux', 'chiot1.jpg', '2018-12-27'),
(70, 'Passe-moi… le schtroumpf !', 'Lors d\'un repas en 1957, Peyo aurait demandé à Franquin de lui passer une salière dont il ne parvenait pas à se rappeler le nom, et qu\'il aurait donc appelée un schtroumpf (« Passe-moi… le schtroumpf ! »)', 'Au début de l\'année 1958, Peyo réfléchit au scénario de la nouvelle histoire de Johan et Pirlouit. Son idée est d\'utiliser les mauvais talents musicaux de Pirlouit, un peu comme dans le conte Le Joueur de flûte de Hamelin. Il a pour idée de départ de mettre dans les mains de Pirlouit une flûte enchantée. L\'histoire, qui commence sa publication en mai 1958 seulement trois semaines après la fin du récit précédent, a pour titre La Flûte à six trous. Comme prévu, l\'ouverture de l\'histoire multiplie les gags de Pirlouit et sa flûte magique qui fait danser tous ceux qui l\'entendent. Ce début d\'histoire est permis, car Peyo, avec l\'accord de Dupuis, est désormais passé au format soixante planches et non plus quarante-quatre comme auparavant. Dans la suite de son histoire, il a l\'idée d\'intégrer les créateurs de cette fameuse flûte et de réutiliser les petits lutins roses coiffés d\'un bonnet à fleur dont il s\'était servi pour une ébauche de court-métrage d\'animation pendant son passage chez CBA. Pour les nommer, il a l\'idée de ressortir le mot qui l\'avait bien amusé avec André Franquin quelques mois auparavant. C\'est Nine, sa femme, qui a l\'idée d\'utiliser du bleu pour colorier ses petites créatures.\r\n\r\nLa découverte de ces nouveaux personnages par les lecteurs se fait progressivement. Tout d\'abord des yeux qui observent les héros, puis le langage Schtroumpf est dévoilé, ensuite une main bleue et enfin les personnages apparaissent aux lecteurs. Les Schtroumpfs ne font pas tout de suite l\'unanimité chez l\'éditeur, toujours inquiet que la censure française puisse frapper le journal : le langage schtroumpf est notamment pointé du doigt. Peyo doit le rassurer en affirmant que cette création est éphémère et va être utilisée durant quelques planches seulement, le temps pour les personnages de construire une nouvelle flûte enchantée.\r\n\r\nLa nouvelle histoire de Johan et Pirlouit, commence sa publication en avril 1959 et a pour titre La Guerre des sept fontaines. Elle aborde le thème de la vie après la mort. L\'utilisation de la magie dans la première partie du récit va contraindre Peyo à réutiliser des personnages tirés d\'autres épisodes. Comme l\'enchanteur Homnibus a déjà été utilisé, il va rechercher la sorcière Rachel et le Grand Schtroumpf, rompant sa promesse de ne plus utiliser les Schtroumpfs.', 'deux', 'schtrumpth.jpg', '2018-12-27'),
(71, 'Elon Musk : des Superchargeurs pour l’Europe', 'L’année 2018 n’est pas encore terminée mais Tesla a déjà pris de bonnes résolutions. Dans un tweet daté du 26 décembre 2018, Elon Musk a enfilé son costume du Père Noël pour promettre une grande extension de son réseau de Superchargeurs en Europe en 2019.', 'Tesla a besoin d’étendre son réseau de Superchargeurs car il lancera sa Model 3 en Europe dans les mois à venir. La voiture électrique « abordable » est amenée à rencontrer un franc succès et aura besoin de plus en plus de moyens de faire le plein rapidement (30/40 minutes pour 80 %).\r\nOn rappellera néanmoins que les Superchargeurs ne fonctionnent qu’avec les voitures Tesla. Une restriction qui pourrait être levée à l’avenir, si les autres acteurs du marché acceptent de s’associer. En novembre dernier, Auto Express expliquait que Tesla allait se plier à la norme européenne de recharge CCS — via un port compatible sur la Model 3 et un adaptateur pour la Model S et le Model X. Une preuve d’ouverture aux solutions de recharge tierces.\r\nD’après le site officiel du constructeur américain, il y a actuellement 1 386 stations de Superchargeurs dans le monde, pour 11 583 bornes (dont plus de 3 500 en Europe). Et sur la partie Europe et Moyen-Orient, on peut voir que plusieurs ouvertures sont prévues sur le Vieux Continent.', 'deux', 'supercharging.jpg', '2018-12-27'),
(73, 'La pleine saison des huîtres bat son plein', 'Aliment tonique et complet, l’huître recèle de multiples trésors essentiels pour la santé : fer,  magnésium, calcium, sélénium, phosphore, sodium, fluor, iode, potassium, etc...', 'Saviez-vous que l’ostréiculture joue un rôle positif pour l’environnement ? L’ostréiculture participe au maintien des bons états sanitaires et écologiques du milieu marin. Les eaux ostréicoles sont situées dans des zones protégées pour permettre la protection de la vie, la croissance et la reproduction des stocks et des populations conchylicoles. Les coquillages, et en particulier les huîtres, font partie intégrante des écosystèmes estuariens et côtiers, alors pourquoi s’en priver ?\r\nOubliez les mois en R et même si on peut savourer des huîtres tout au long de l’année, c’est en ce moment, durant les fêtes de fin d’année, que la consommation reste la plus importante. En décembre, par exemple, plus de la moitié du volume annuel de production sera consommée entraînant l’embauche de près de 10 000 saisonniers dans l’ensemble des régions de production !\r\nÉlevée en milieu naturel, puisant les éléments nutritifs dont elle a besoin dans l’eau de mer, l’huître est une source exceptionnelle de bienfaits (lire ci-contre). En plus d’être un produit doté de qualités nutritives uniques, l’huître est aussi digeste et très légère : seulement 70 calories pour 8 huîtres environ. Comment bien acheter ses huîtres ? Primo, rendez-vous chez un écailler ou un poissonnier, il vous prodiguera les meilleurs conseils et vous orientera au meiux. Si vous achetez vos coquillages en bourriches, toutes les informations utiles se retrouvent sur les étiquettes, à savoir : le nom de l’établissement de production, le numéro d’agrément d’expédition, la date de conditionnement, l’origine, l’appellation et le calibre (plus le numéro est grand, plus l’huître est petite et inversement). Enfin, sachez que vous pourrez conserver vos huîtres enter 5°C et 10°C jusqu’à 10 jours à compter de la date de conditionnement.', 'deux', 'plateau-huitres.jpg', '2018-12-27'),
(82, 'La course à pieds, tout un art de vivre', 'Depuis longtemps, tout le monde sait que courir fait du bien, mais savez vous pourquoi ?', 'Vous le savez si vous courez, les bienfaits de la course à pied sont énormes ! Alors si certains se demandent pourquoi courir… Je vais les aider à répondre à cette question par la positive ! En tant que coureur, pas besoin d’arguments on sent les bienfaits du running dans notre corps, dans notre esprit. Mais à l’heure de débuter la course à pied, si je devais convaincre les débutants avec quelques arguments …\r\n\r\nVoici les bienfaits de la course à pied que je citerais assurément ! Des choses que vous avez sûrement déjà lues mais qui sont aujourd’hui en train d’être prouvées une par une par la science… Ce n’est donc pas seulement l’avis d’un coureur qui veut convaincre tout le monde de s’y mettre… Même si c’est quand même mon objectif au fond !\r\n\r\nLe running au service de la santé !\r\nLe sport est bon pour la santé en général, tout le monde le sait. La course à pied est un de ces sports aux avantages multiples qui permettent d’avoir une santé de fer. Ce n’est pas par hasard si en moyenne les coureurs sont moins malades que les autres malgré des entraînements hivernaux dans le froid ou sous la pluie ! À noter que le système immunitaire se renforce particulièrement quand on court lentement, lors de nos footings en endurance fondamentale.\r\n\r\nSans aller dans les détails, de nombreuses études ont maintenant prouvé les bienfaits de la course à pied sur la santé cardiaque ou l’hypertension. On muscle son coeur, on active la circulation sanguine ce qui accélère tout un tas de processus internes bénéfiques pour le corps. Aujourd’hui on est même capable de conseiller à des asthmatiques, des personnes souffrant d’arthrose ou encore de diabète de se mettre à la course à pied… Les études scientifiques se multiplient et montrent que la course à pied est préventif vis à vis de beaucoup de maladie… Et peut même avoir un effet curatif dans certains cas… \r\n\r\n', 'deux', 'balade.JPG', '2019-02-09');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `date_added` date NOT NULL,
  `article_id` int(11) NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_article_id` (`article_id`),
  KEY `fk_user` (`pseudo`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `pseudo`, `content`, `date_added`, `article_id`, `valide`) VALUES
(127, 'deux', 'quel chien adorable', '2018-12-27', 69, 1),
(129, 'deux', 'vive les schroumpfs', '2018-12-28', 70, 0),
(130, 'deux', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus bibendum vel nisl et condimentum. Cras suscipit ipsum eu leo ultricies, at blandit dui dictum.', '2018-12-29', 82, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `login` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`login`, `pass`, `name`, `email`, `admin`) VALUES
('admin', 'pass', 'Administrateur', '', 1),
('deux', '$2y$10$ad00m9BOS1tfSEU59mGUoO111c1SsFUV3x0HveBenjU.pg9JbmyJC', 'deux', 'deux@perrotin.eu', 1),
('dimanche', '$2y$10$is03RV4Eq..zL4ahYqGtjertdt8mRcSLe20hKA8QbqGnffaLaEedi', 'dimanche', 'dimanche', 0),
('dix', '$2y$10$fjDEubDKMnvd.Bw26oJyo.JueMBtABJbKI6yQEVcaBMW5fj0suU.a', 'dix', 'dix', 0),
('huit', '$2y$10$ZqppHAeZldI6pJ7fKTFpN.ElhPAHbXlqMKY2NRFzgMlEraTTu9vou', 'huit', 'huit', 0),
('j', '$2y$10$CFgZpwYdPq04JhJG0lnL1Os20M06m9HpzrX3ZJdB99mU08qCcgKq6', 'j', 'j@gmail.com', 0),
('jacques', '$2y$10$VdBRYH8ja8Fa9hRTvc3fceYFZ45CH7R4rkydzOmV4X0kX7itjkW8S', 'LAFITTE', 'j.lafitte@f1.com', 0),
('jeudi', '$2y$10$5uo66ClEES0s2nOxKhVztux7vhvFhNwhUyTg7EtZlakbyCTVPZaVC', 'jeudi', 'jeudi', 0),
('jeudi1', '$2y$10$NCDDlapx2GI8gGg8MzLqaea.H/JhTzTIa6Bjfz5aZA8GkzT34WCcC', 'jeudi1', 'jeudi1', 0),
('jeudi2', '$2y$10$.5cdLWNoF5Yn2GnR8I.cZ.QR3fpMVALhNdT99UI4jpJO1yxGUUvpW', 'jeudi2', 'jeudi1', 0),
('jeudi3', '$2y$10$nv382o3XU9jddgUcS8NRdeL1K3ZxKzF8TLyqR7/KYYXjgk0Fdwuai', 'jeudi3', 'jeudi3', 0),
('k', '$2y$10$jTk8tjC4OcqZkylhIWGxr.E5a0WniT1q1z0n69NuJoUSe0JsBitt6', 'karim', 'k', 0),
('Karim', '$2y$10$Vbt65RG1fNt/1qSgtz/9UeYtp2Be7DCUoJwM2/HD8NxIpeE0RBvg2', 'karim', 'k', 0),
('luc', '$2y$10$YzEEiDZ0jCu9tWNVTIWlXekbSZkvmI8rz4YLlJb7o56O3QBv9CMRC', 'plamendon', 'plamendon', 0),
('lundi', '$2y$10$vJIz2F7C5aUlfz2xb7nvlOf.B06N2O0sqGms8TNBUtcQPnfod8xLa', 'lundi', 'lundi@sfr.fr', 0),
('m', '$2y$10$tkjlTjK0KWD6zq1nC/j0zeO4pdkdTq4tHjhu.0zkX/Kkgt.nQxxdq', 'm', 'm', 0),
('mardi', '$2y$10$aCgVQYnuBPFxEzCTe4i6neAB4OrARcxSCnTCx3oxnA3E2nsMoU6dG', 'mardi', 'mardi@li.fr', 0),
('mercredi', '$2y$10$VklbKIyX/FZQE0isPC313.ZtCLVDub8U5H/mTeLBFdYVg7kdZNx9O', 'mercredi', 'mercredi@fr', 1),
('moi', '$2y$10$RQcmGH2/lk2SiLc.gUOjWuNSltX60ldslYEtoWXaq0IVvNWL2mSjy', 'moi', 'moi@gmail.com', 1),
('p.newman', '$2y$10$/rxvVCdbeO4CE77UvX6H/On7YI2N8FIdnowrE/6JqkdrPJGLOFr8i', 'NEWMAN Paul', 'paul_newman@gmail.com', 0),
('pierre', '$2y$10$EXf8D4TzEzKNRYvZOZJL../YwoxCg7toWIt2C4tPZP.fBd5y5UnFS', 'ponce', 'pierr@ponse.com', 0),
('test2', '$2y$10$W1M.pe6PiUFZSoByLnvn0eENQmNvgBOvQPFNqrYzLMQDtXsux4hHO', 'test2', 'test2', 1),
('u', '$2y$10$LOJwlrC0bU0ufMFMgjyr..TdtEqoz5BtseGscxHnDL2Q8yK.yjO/m', 'u', 'uuu@pol', 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `user_fk` FOREIGN KEY (`author`) REFERENCES `user` (`login`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_article_id` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`pseudo`) REFERENCES `user` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
