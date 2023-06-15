-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 07 avr. 2023 à 13:12
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `recettecuisine`
--
DROP DATABASE IF EXISTS recettecuisine;
create database recettecuisine;
use recettecuisine;
-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
  `ID_ingredient` int NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  `photo` text NOT NULL,
  PRIMARY KEY (`ID_ingredient`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`ID_ingredient`, `nom`, `photo`) VALUES
(1, 'eggs', 'eggs.png'),
(2, 'chocolat', 'chocolat.png'),
(3, 'unsweetened powder', 'unsweetened cocoa powder.jpg'),
(4, 'sugar', 'sugar.jpg'),
(5, 'salt', 'salt.jpg'),
(7, 'Corn syrup', 'cornsyrop.jpg'),
(8, 'Vanilla', 'vanilla.jpg'),
(9, 'Cream cheese', 'creamcheese.jpg'),
(10, ' Heavy cream', 'Heavy cream.jpg'),
(11, 'Banana', 'banana.jpg'),
(12, 'butter', 'butter.jpg'),
(13, 'cream thawed', 'tub whipped cream thawed.jpg'),
(14, 'Pudding Layer', 'Pudding Layer.png'),
(15, 'milk', 'milk.jpg'),
(16, 'cornstarch', 'cup cornstarch.jpg'),
(17, 'graham crackers', 'graham crackercrumbs.jpg'),
(18, 'all-purpose flour', 'all-purpose flour.jpg'),
(19, 'baking powder', 'tsp baking powder.jpg'),
(20, 'cocoa powder', 'unsweetened cocoa powder.jpg'),
(21, 'Oreo cookies', 'oreo.jpg'),
(22, 'Pinch of Salt', 'salt.jpg'),
(23, 'coffee powder', 'coffeepowder.jpg'),
(24, 'olive oil', 'oliveoil.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `listesingredients`
--

DROP TABLE IF EXISTS `listesingredients`;
CREATE TABLE IF NOT EXISTS `listesingredients` (
  `ID_ingredient` int NOT NULL,
  `ID_recette` int NOT NULL,
  `Qte` varchar(10) DEFAULT NULL,
  `mesure` varchar(50) DEFAULT NULL,
  KEY `fk_ingredient_listesIngredients` (`ID_ingredient`),
  KEY `fk_recette_listesIngredients` (`ID_recette`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `listesingredients`
--

INSERT INTO `listesingredients` (`ID_ingredient`, `ID_recette`, `Qte`, `mesure`) VALUES
 (1, 1, '', ''),
 (1, 2, '2', ''),
 (2, 1, '', ''),
 (2, 2, '8', 'oz'),
 (3, 1, '', ''),
 (4, 2, '2', 'tablespoon'),
 (4, 3, '3/4', 'oz'),
 (4, 4, '75', 'grams'),
 (5, 1, ' 1/2', 'tsp'),
 (5, 2, ' 1/2', ''),
 (5, 3, ' 1/8', 'tsp'),
 (5, 4, ' pinch', 'tsp'),
 (12, 1, '8', 'tbsp'),
 (12, 2, '2', ''),
 (12, 3, '5', 'oz'),
 (12, 4, '50', 'grams'),
 (7, 3, '3/4', 'oz'),
 (7, 3, '50', 'gram'),
 (8, 1, '1', 'tbsp'),
 (8, 2, '1', 'cup'),
 (8, 4, '2', 'teaspoon'),
 (9, 1, '24', 'oz'),
 (9, 2, '8', 'oz'),
 (10, 1, '3/4', 'cup'),
 (10, 4, '500', 'ml'),
 (11, 2, '2', 'cup'),
 (12, 2, '8', 'oz'),
 (13, 2, '', ''),
 (14, 2, '2', 'cup'),
 (14, 4, '60', 'ml'),
 (15, 2, '1/4', 'cup'),
 (15, 4, '25', 'gram'),
 (16, 2, '1/2', 'cup'),
 (17, 3, '1/4', 'oz'),
 (18, 2, '2', 'tablespoon'),
 (19, 1, '1/3', 'cup'),
 (19, 3, '3/4', 'oz'),
 (19, 4, '50', 'grams'),
 (20, 1, '1/2', 'cups'),
 (20, 4, '28', ''),
 (22, 4, ' ', ''),
 (23, 4, ' 2', 'teaspoon'),
 (24, 4, ' 2', 'teasponn'),
 (2, 5, ' ', ''),
 (3, 5, ' ', ''),
 (12, 5, ' ', ''),
 (4, 5, ' ', ''),
 (9, 5, ' ', ''),
 (14, 5, ' ', ''),
 (1, 12, ' ', ''),
 (2, 12, ' ', ''),
 (3, 12, ' ', ''),
 (4, 12, ' ', ''),
 (10, 12, ' ', ''),
 (12, 12, ' ', ''),
 (5, 6, ' ', ''),
 (24,6 , ' ', ''),
 (5,7 , ' ', ''),
 (22,7 , ' ', ''),
 (24,7, ' ', ''),
 (5,8 , ' ', ''),
 (22,8 , ' ', ''),
 (5,9 , ' ', ''),
 (22,9 , ' ', ''),
 (24,9, ' ', ''),
 (1,10, ' ', ''),
 (5,10, ' ', ''),
 (12,10, ' ', ''),
 (9,10, ' ', ''),
 (1,11, ' ', ''),
 (5,11, ' ', ''),
 (12,11, ' ', ''),
 (18,11, ' ', ''),
 (9,12, ' ', ''),
 (9,12, ' ', ''),
 (9,12, ' ', ''),
 (9,12, ' ', ''),
 (9,12, ' ', '');

-- --------------------------------------------------------
--
-- Structure de la table `listescategorie`
--

DROP TABLE IF EXISTS `listescategorie`;
CREATE TABLE IF NOT EXISTS `listescategorie` (
  `ID_categorie` int NOT NULL,
  `ID_recette` int NOT NULL,
  KEY `fk_categorie_listescategorie` (`ID_categorie`),
  KEY `fk_recette_listescategorie` (`ID_recette`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `listescategorie`
--

INSERT INTO `listescategorie` (`ID_categorie`, `ID_recette`) VALUES
(1, 1),
(4, 1),
(1, 2),
(4, 2),
(1, 3),
(4, 3),
(1, 4),
(4, 4),
(1, 5),
(4, 5),
(2, 6),
(3, 6),
(2, 7),
(3, 7),
(2, 8),
(3, 8),
(2, 9),
(3, 9),
(2, 10),
(3, 10),
(2, 11),
(4, 12),
(1, 12),
(4, 13),
(4, 14);


-- --------------------------------------------------------
--
-- Structure de la table `listestag`
--

DROP TABLE IF EXISTS `listestag`;
CREATE TABLE IF NOT EXISTS `listestag` (
`ID_tag` int NOT NULL,
`ID_recette` int NOT NULL,
 KEY `fk_tag_listestag` (`ID_tag`),
 KEY `fk_recette_listestag` (`ID_recette`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `listestag`
--

INSERT INTO `listestag` (`ID_tag`, `ID_recette`) VALUES
(1,1),
(2,1),
(3,1),
(4,1);
-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

DROP TABLE IF EXISTS `recette`;
CREATE TABLE IF NOT EXISTS `recette` (
  `ID_recette` int NOT NULL AUTO_INCREMENT,
  `titre` text NOT NULL,
  `photo` text NOT NULL,
  `description` TEXT,

  PRIMARY KEY (`ID_recette`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `recette`
--


INSERT INTO `recette` (`ID_recette`, `titre`, `photo`,`description`) VALUES
-- LES DESSERTS --
(1, 'Triple Chocolate Cheesecake', 'Triple_Chocolate_Cheesecake.jpeg','Ce gâteau au fromage triple chocolat doux et crémeux est un must pour tout amateur de chocolat. Complété par une délicieuse croûte de biscuits Oreo et garni d’une riche ganache au chocolat, c’est vraiment le gâteau au fromage parfait!
Vous aimez le gâteau au fromage autant que moi? Alors essayez mon gâteau au fromage sans cuisson ou mes petits cupcakes au fromage!'),
(2, 'Banana Pudding Dessert', 'Banana_Pudding_Dessert.png','Le Banana Pudding Dessert est un dessert américain populaire qui se compose d\'une couche de biscuits à la vanille, une couche de bananes en tranches, une couche de crème pudding à la vanille, et une couche de crème fouettée légèrement sucrée.
Les biscuits à la vanille sont généralement disposés dans un plat de service en couches, suivis des bananes en tranches. Le pudding à la vanille est alors versé sur les bananes et les biscuits, formant une troisième couche. La crème fouettée est ensuite étalée sur le dessus de la couche de pudding, ajoutant une touche de douceur légèrement sucrée.
Le dessert est souvent réfrigéré pendant plusieurs heures pour que les saveurs se mélangent et que les biscuits deviennent légèrement imbibés du pudding. Il est souvent servi comme dessert de fin de repas ou pour des occasions spéciales telles que les fêtes de fin d\'année ou les barbecues d\'été.'),
(3, 'Ultimate Fudgy Chocolate Brownies', 'ultimate-fudgy-chocolate-brownies.jpg','Les Ultimate Fudgy Chocolate Brownies sont des brownies ultra-gourmands, riches en chocolat, moelleux à l\'intérieur et légèrement croquants sur le dessus.
Ils sont fabriqués à partir d\'ingrédients simples tels que du beurre, du sucre, des œufs, de la farine et du cacao en poudre de qualité. Ces ingrédients sont mélangés pour former une pâte dense et lisse, puis du chocolat noir fondu est ajouté pour intensifier la saveur de chocolat.
La pâte à brownie est ensuite cuite au four jusqu\'à ce qu\'elle soit cuite mais encore légèrement humide à l\'intérieur. Le résultat final est un brownie fondant et délicieux, parfait pour satisfaire les envies de chocolat.
Les Ultimate Fudgy Chocolate Brownies sont souvent servis comme dessert pour les occasions spéciales ou simplement pour satisfaire une envie de chocolat. Ils peuvent être accompagnés d\'une boule de glace à la vanille ou d\'un verre de lait froid pour une expérience gustative encore plus satisfaisante.'),
(4, 'NO BAKE DARK CHOCOLATE TART', 'no-bake-chocolate-tart-1.jpg','La No Bake Dark Chocolate Tart est une tarte au chocolat riche et crémeuse qui ne nécessite pas de cuisson au four. Elle est souvent préparée à partir d\'une croûte de biscuits émiettés mélangée à du beurre fondu pour former la base.
Pour la garniture, du chocolat noir fondu est mélangé à de la crème épaisse pour créer une ganache au chocolat lisse et veloutée. Cette ganache est ensuite versée sur la croûte de biscuits et lissée pour une finition uniforme.
La tarte est ensuite réfrigérée pendant plusieurs heures jusqu\'à ce que la ganache soit ferme et que la croûte soit croquante. Elle peut être servie telle quelle ou décorée avec des fruits frais, de la crème fouettée ou des copeaux de chocolat.
La No Bake Dark Chocolate Tart est un dessert indulgent et facile à préparer, parfait pour les occasions spéciales ou pour satisfaire une envie de chocolat. Elle est également idéale pour les jours chauds d\'été, car elle ne nécessite pas de cuisson au four et peut être préparée à l\'avance.'),
(5, 'Pudding Layer', 'pudding.jpg','La No Bake Dark Chocolate Tart est une tarte au chocolat riche et crémeuse qui ne nécessite pas de cuisson au four. Elle est souvent préparée à partir d\'une croûte de biscuits émiettés mélangée à du beurre fondu pour former la base.
Pour la garniture, du chocolat noir fondu est mélangé à de la crème épaisse pour créer une ganache au chocolat lisse et veloutée. Cette ganache est ensuite versée sur la croûte de biscuits et lissée pour une finition uniforme.
La tarte est ensuite réfrigérée pendant plusieurs heures jusqu\'à ce que la ganache soit ferme et que la croûte soit croquante. Elle peut être servie telle quelle ou décorée avec des fruits frais, de la crème fouettée ou des copeaux de chocolat.
La No Bake Dark Chocolate Tart est un dessert indulgent et facile à préparer, parfait pour les occasions spéciales ou pour satisfaire une envie de chocolat. Elle est également idéale pour les jours chauds d\'été, car elle ne nécessite pas de cuisson au four et peut être préparée à l\'avance.'),
-- LES PLATS CHAUDS  --
(6, 'Petits croustillants chèvres et olives', 'petits_croustillants.png','Les Petits croustillants chèvres et olives sont des amuse-bouches salés et croquants, souvent servis comme entrée ou apéritif lors de repas ou de fêtes.
Ils sont généralement préparés à partir de feuilles de pâte filo croustillantes, qui sont coupées en petits carrés ou triangles. Sur chaque carré de pâte, une cuillère à café de fromage de chèvre est déposée, puis une olive noire est placée sur le dessus. La pâte est ensuite repliée et tordue pour former un petit paquet croustillant et doré.
Les Petits croustillants chèvres et olives sont souvent cuits au four jusqu\'à ce qu\'ils soient dorés et croustillants. Ils peuvent être servis chauds ou tièdes et sont souvent accompagnés d\'une sauce à base de yaourt, de miel ou de vinaigrette pour ajouter une touche de saveur.
Ce petit plat est apprécié pour sa texture croustillante, son goût salé et savoureux et pour sa présentation élégante. Il est parfait pour impressionner vos invités lors de fêtes ou de dîners et pour ajouter une touche de sophistication à votre menu.'),
(7, 'Marlyzen, cuisine revisitée', 'marlyzen.jpg','Le Marlyzen est un restaurant qui propose une cuisine revisitée, c\'est-à-dire une cuisine traditionnelle avec une touche de modernité et d\'originalité.
Les plats proposés sont souvent élaborés à partir d\'ingrédients de qualité et de saison, et sont présentés de manière créative et esthétique. Les recettes classiques sont revisitées avec des techniques de cuisson innovantes et des associations de saveurs inattendues.
Le menu du Marlyzen peut inclure des plats tels que des escalopes de foie gras poêlées avec une gelée de coing et une sauce au vin rouge, ou des Saint-Jacques grillées avec une purée de panais et une émulsion de jus de citron vert.
Les desserts sont également une partie importante du menu, avec des créations uniques telles que des tartes aux fruits revisitées, des sorbets originaux et des desserts à base de chocolat.
Le Marlyzen est un lieu idéal pour les amateurs de gastronomie qui cherchent à découvrir de nouvelles saveurs et de nouvelles expériences culinaires. La cuisine revisitée offre une expérience gustative inoubliable, avec des plats à la fois élégants et savoureux qui mélangent tradition et modernité.'),
(8, 'Blanquette de filet mignon aux petits légumes', 'Blanquette_de_filet_mignon.png','La blanquette de filet mignon aux petits légumes est un plat traditionnel de la cuisine française. Il s\'agit d\'un ragoût à base de filet mignon de porc coupé en morceaux, cuit lentement avec des légumes tels que des carottes, des navets, des oignons, des champignons, et des herbes aromatiques.
La préparation commence généralement par une étape de dorure de la viande, qui est cuite dans un peu de beurre ou d\'huile pour lui donner une couleur dorée. Ensuite, les légumes sont ajoutés, coupés en morceaux de taille similaire pour une cuisson homogène. Le tout est ensuite recouvert d\'un bouillon de volaille ou de légumes et laissé mijoter à feu doux pendant environ une heure, jusqu\'à ce que la viande soit tendre et les légumes bien cuits.
Pour finir, une sauce blanche à base de crème fraîche, de jaune d\'œuf et de jus de citron est ajoutée pour donner une texture onctueuse et une saveur légèrement acidulée à la blanquette.
Ce plat est souvent servi accompagné de riz, de pâtes ou de pommes de terre, et peut être agrémenté de quelques herbes fraîches pour plus de fraîcheur. La blanquette de filet mignon aux petits légumes est un plat réconfortant et savoureux, parfait pour les repas en famille ou pour se réchauffer par temps frais.'),
(9, 'Filet mignon de porc caramélisé à la sauce soja', 'Filet_mignon_de_porc.jpg','Le filet mignon de porc caramélisé à la sauce soja est un plat délicieux et facile à préparer proposé par Les Délices Légers de Zabou. Il s\'agit d\'un plat asiatique qui marie des saveurs sucrées et salées.
La recette commence par la préparation d\'une marinade à base de sauce soja, de miel, de gingembre frais râpé, d\'ail et de poivre. Le filet mignon est alors mariné dans ce mélange pendant plusieurs heures, afin d\'imprégner la viande des saveurs.
Une fois la viande marinée, elle est cuite dans une poêle avec un peu d\'huile d\'olive jusqu\'à ce qu\'elle soit dorée et croustillante. Ensuite, la marinade est ajoutée à la poêle et la viande est cuite à feu doux pendant environ 10 minutes, jusqu\'à ce que la sauce épaississe et caramélise légèrement.
Le filet mignon de porc caramélisé à la sauce soja est souvent accompagné de riz blanc ou de nouilles chinoises pour un plat complet et équilibré. Les notes sucrées et salées de la sauce soja et du miel, ainsi que les arômes de gingembre et d\'ail, se marient parfaitement avec la tendreté de la viande pour offrir un plat savoureux et gourmand.
Cette recette est une option légère et saine pour les amateurs de cuisine asiatique qui cherchent à préparer un plat rapide et facile à la maison.'),

-- LES ENTREES SUCREES/SALEES --
(10, 'Cheesecake au saumon fumé', 'Cheesecake_au_saumon.jpg','Le cheesecake au saumon fumé est un plat savoureux qui marie le goût crémeux et doux du cheesecake avec le goût salé et fumé du saumon. Pour préparer cette recette, on commence par préparer la base du cheesecake avec des biscuits émiettés et du beurre fondu, que l\'on étale dans le fond d\'un moule à gâteau.
Ensuite, on prépare la garniture en mélangeant du fromage frais, du fromage blanc, des œufs, de la crème fraîche, du jus de citron et du sel. On ajoute ensuite des morceaux de saumon fumé coupés en petits dés dans le mélange. On verse ensuite la préparation sur la base de biscuits et on fait cuire le tout au four pendant environ 30 minutes.
Le cheesecake au saumon fumé est généralement servi froid, décoré avec des feuilles de laitue, des tranches de concombre ou de tomate et des brins d\'aneth. C\'est une recette originale et délicieuse qui peut être servie en entrée ou en plat principal accompagné d\'une salade verte.'),
(11, 'Cookies salés aux tomates et chorizo', 'Cookies-sales.jpg','Les cookies salés aux tomates séchées et chorizo sont une version salée des cookies classiques, avec une touche de saveurs méditerranéennes. Pour préparer cette recette, on commence par mélanger de la farine, de la levure chimique et du paprika fumé dans un bol.
Dans un autre bol, on mélange du beurre fondu, un œuf, des tomates séchées coupées en petits morceaux, du chorizo coupé en dés et du parmesan râpé. On ajoute ensuite le mélange de farine et on mélange jusqu\'à obtenir une pâte homogène.
On forme ensuite des boules de pâte que l\'on dépose sur une plaque de cuisson recouverte de papier sulfurisé. On enfourne le tout pendant environ 15 minutes à 180°C, jusqu\'à ce que les cookies soient dorés et légèrement croustillants.
Les cookies salés aux tomates séchées et chorizo peuvent être servis en apéritif ou en accompagnement d\'une salade verte. C\'est une recette facile à préparer et délicieuse, qui plaira aux amateurs de saveurs méditerranéennes.'),
(12, 'CROUSTILLANT CHOCO NOISETTE', 'CROUSTILLANT-CHOCO-NOISETTE.jpg','Le croustillant choco noisette est un dessert délicieux et croquant, qui marie le goût sucré du chocolat avec le goût noisette. Pour préparer cette recette, on commence par mélanger du chocolat noir fondu avec du beurre fondu et des noisettes concassées.
On ajoute ensuite des corn flakes écrasés dans le mélange et on mélange le tout jusqu\'à obtenir une texture croustillante. On étale ensuite le mélange dans un moule à gâteau tapissé de papier sulfurisé et on place le tout au réfrigérateur pour que le mélange durcisse.
Le croustillant choco noisette peut être servi en dessert accompagné d\'une boule de glace à la vanille ou en goûter accompagné d\'une tasse de thé ou de café. C\'est une recette facile à préparer et délicieuse, qui plaira aux amateurs de chocolat et de noisettes.'),
(13, 'Tropézienne vanille et framboises', 'tropezienne-vanille-framboises.jpg','La tarte tropézienne est un dessert classique de la cuisine provençale qui est composé d\'une brioche garnie de crème pâtissière à la vanille et de framboises fraîches. Pour préparer cette recette, on commence par préparer la pâte à brioche en mélangeant de la farine, de la levure, du sucre et des œufs dans un bol. On ajoute ensuite du beurre fondu et on pétrit la pâte jusqu\'à obtenir une texture lisse et élastique.
On laisse ensuite la pâte reposer pendant environ une heure avant de l\'étaler sur une plaque de cuisson et de la faire cuire au four pendant environ 20 minutes, jusqu\'à ce qu\'elle soit dorée.
Pendant ce temps, on prépare la crème pâtissière en mélangeant du lait, du sucre, des jaunes d\'œufs et de la vanille dans une casserole. On fait chauffer le tout à feu doux en remuant constamment, jusqu\'à ce que la crème épaississe. On laisse ensuite refroidir la crème avant de l\'étaler sur la brioche refroidie.
On ajoute ensuite des framboises fraîches sur la crème pâtissière et on saupoudre le tout de sucre glace. La tarte tropézienne à la vanille et aux framboises est généralement servie froide et coupée en tranches. C\'est une recette délicieuse et estivale qui plaira aux amateurs de desserts légers et fruités.'),
(14, 'Bavarois Poire', 'Bavarois-Poire.jpg','Le bavarois poire est un dessert frais et léger, qui combine une mousse à la poire, un sablé breton croustillant et une sauce caramel onctueuse. Pour préparer cette recette, on commence par préparer la mousse à la poire en mixant des poires en purée dans un blender. On ajoute ensuite du sucre, de la gélatine ramollie et de la crème fouettée dans le blender et on mixe le tout jusqu\'à obtenir une texture légère et mousseuse.
On prépare ensuite le sablé breton en mélangeant de la farine, du sucre, des jaunes d\'œufs et du beurre dans un bol. On étale ensuite la pâte obtenue sur une plaque de cuisson et on la fait cuire au four jusqu\'à ce qu\'elle soit dorée et croustillante.
Enfin, on prépare la sauce caramel en faisant chauffer du sucre dans une casserole à feu moyen jusqu\'à ce qu\'il fonde et devienne liquide. On ajoute ensuite de la crème liquide et du beurre dans la casserole et on remue le tout jusqu\'à obtenir une texture lisse et onctueuse.
Pour assembler le dessert, on étale le sablé breton sur le fond d\'un moule à charnière et on verse la mousse à la poire par-dessus. On place le tout au réfrigérateur pendant quelques heures, jusqu\'à ce que la mousse soit prise. On démoule ensuite le bavarois et on ajoute la sauce caramel sur le dessus, en laissant couler sur les bords. Le bavarois poire, sablé breton et sauce caramel onctueuse est un dessert élégant et délicieux, qui plaira aux amateurs de desserts fruités et gourmands.');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `ID_categorie` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`ID_categorie`, `nom`) VALUES
(1, 'Dessert'),
(2, 'Salé'),
(3, 'Chaud'),
(4, 'Sucré');


-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `ID_tag` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_tag`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`ID_tag`, `nom`) VALUES
(1, 'detente'),
(2, 'ete'),
(3, 'sunshine'),
(4, 'Sucré');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `listesingredients`
--
ALTER TABLE `listesingredients`
  ADD CONSTRAINT `fk_ingredient_listesIngredients` FOREIGN KEY (`ID_ingredient`) REFERENCES `ingredient` (`ID_ingredient`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_recette_listesIngredients` FOREIGN KEY (`ID_recette`) REFERENCES `recette` (`ID_recette`) ON DELETE CASCADE;

--
-- Contraintes pour la table `listestag`
--
ALTER TABLE `listestag`
  ADD CONSTRAINT `fk_tag_listestag` FOREIGN KEY (`ID_tag`) REFERENCES `tag` (`ID_tag`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_recette_listestag` FOREIGN KEY (`ID_recette`) REFERENCES `recette` (`ID_recette`) ON DELETE CASCADE;


--
-- Contraintes pour la table `listescategorie`
--
ALTER TABLE `listescategorie`
  ADD CONSTRAINT `fk_recette_listescategorie` FOREIGN KEY (`ID_recette`) REFERENCES `recette` (`ID_recette`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_categorie_listescategorie` FOREIGN KEY (`ID_categorie`) REFERENCES `categorie` (`ID_categorie`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

/*
select titre, photo from recette where ID_recette in (
    select ID_recette from recette where titre like "%sugar%"
    UNION
    select ID_recette from listesingredients inner join ingredient A using (ID_ingredient) where A.nom like "%sugar%"
    );
*/





















