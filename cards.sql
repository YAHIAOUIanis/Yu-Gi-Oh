-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 26 mars 2019 à 21:17
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `yugiohusers`
--

-- --------------------------------------------------------

--
-- Structure de la table `cards`
--

DROP TABLE IF EXISTS `cards`;
CREATE TABLE IF NOT EXISTS `cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_fr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `family` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `atk` int(11) NOT NULL,
  `def` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `text` longtext COLLATE utf8mb4_unicode_ci,
  `property` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cards`
--

INSERT INTO `cards` (`id`, `name_fr`, `name`, `card_type`, `quantity`, `family`, `atk`, `def`, `level`, `text`, `property`, `url`) VALUES
(1, 'Cylindre Magique', 'Magic Cylinder', 'trap', 1, '', 0, 0, 0, 'When an opponent\'s monster declares an attack: Target the attacking monster; negate the attack, and if you do, inflict damage to your opponent equal to its ATK.', 'Normal', 'https://vignette2.wikia.nocookie.net/yugioh/images/8/87/MagicCylinder-SDMY-EN-C-1E.png'),
(2, 'Néos, HÉROS Élémentaire', 'Elemental HERO Neos', 'monster', 1, 'light', 2500, 2000, 7, 'A new Elemental HERO has arrived from Neo-Space! When he initiates a Contact Fusion with a Neo-Spacian his unknown powers are unleashed.', '', 'https://vignette3.wikia.nocookie.net/yugioh/images/5/5e/ElementalHERONeos-SDHS-EN-C-1E.png'),
(3, 'Tyrrano-Infinité', 'Tyranno Infinity', 'monster', 1, 'earth', 0, 0, 4, 'The original ATK of this card is the number of your banished Dinosaur-Type monsters x 1000.', '', 'https://vignette3.wikia.nocookie.net/yugioh/images/3/3b/TyrannoInfinity-SR04-EN-C-1E.png'),
(4, 'Ingénieur Rouages Ancients', 'Ancient Gear Engineer', 'monster', 1, 'earth', 1500, 1500, 5, 'Negate any Trap effects that target this card, and if you do, destroy that Trap Card. If this card attacks, your opponent cannot activate any Spell/Trap Cards until the end of the Damage Step. At the end of the Damage Step, if this card attacked: Target 1 Spell/Trap Card your opponent controls; destroy that target.', '', 'https://vignette1.wikia.nocookie.net/yugioh/images/b/b5/AncientGearEngineer-SR03-EN-C-1E.png'),
(5, 'Moissonneur d\'Esprit', 'Spirit Reaper', 'monster', 1, 'dark', 300, 200, 3, 'Cannot be destroyed by battle. After resolving a card effect that targets this face-up card, destroy this card. When this card inflicts battle damage to your opponent by a direct attack: Discard 1 random card from their hand.', '', 'https://vignette1.wikia.nocookie.net/yugioh/images/1/19/SpiritReaper-PGLD-EN-GUR-1E.png'),
(6, 'Double Coston', 'Double Coston', 'monster', 1, 'dark', 1700, 1650, 4, 'This card can be treated as 2 Tributes for the Tribute Summon of a DARK monster.', '', 'https://vignette3.wikia.nocookie.net/yugioh/images/d/d8/DoubleCoston-YSYR-EN-C-1E.png'),
(7, 'Poisson aux 7 Couleurs', '7 Colored Fish', 'monster', 1, 'water', 1800, 800, 4, 'A rare rainbow fish that has never been caught by mortal man.', '', 'https://vignette4.wikia.nocookie.net/yugioh/images/8/80/7ColoredFish-GLD1-EN-C-LE.png'),
(8, 'Pot de Cupidité', 'Pot of Greed', 'spell', 1, '', 0, 0, 0, 'Draw 2 cards.', 'Normal', 'https://vignette4.wikia.nocookie.net/yugioh/images/f/f2/PotofGreed-YGLD-EN-C-1E.png'),
(9, 'Reine Insecte', 'Insect Queen', 'monster', 1, 'earth', 2200, 2400, 7, 'This card gains 200 ATK for each Insect monster on the field. Cannot declare an attack unless you Tribute 1 monster. Once per turn, during the End Phase, if this card destroyed an opponent\'s monster by battle this turn: Special Summon 1 \"Insect Monster Token\" (Insect/EARTH/Level 1/ATK 100/DEF 100) in Attack Position.', '', 'https://vignette1.wikia.nocookie.net/yugioh/images/f/f3/InsectQueen-DPBC-EN-C-1E.png'),
(10, 'Gaïa le Chevalier Implacable Rapide', 'Swift Gaia the Fierce Knight', 'monster', 1, 'dark', 2300, 2100, 7, 'If this is the only card in your hand, you can Normal Summon it without Tributing.', '', 'https://vignette4.wikia.nocookie.net/yugioh/images/a/aa/SwiftGaiatheFierceKnight-AP08-EN-C-UE.png'),
(11, 'Dragon Noir aux Yeux Rouges', 'Red-Eyes B. Dragon', 'monster', 1, 'dark', 2400, 2000, 7, 'A ferocious dragon with a deadly attack.', '', 'https://vignette2.wikia.nocookie.net/yugioh/images/4/47/RedEyesBDragon-LDK2-EN-C-1E.png'),
(12, 'Béhémoth à Deux Têtes', 'Twin-Headed Behemoth', 'monster', 1, 'wind', 1500, 1200, 3, 'During the End Phase, if this card is in the GY because it was destroyed on the field and sent there this turn: You can Special Summon this card, but its ATK/DEF become 1000. You can only use this effect of \"Twin-Headed Behemoth\" once per Duel.', '', 'https://vignette1.wikia.nocookie.net/yugioh/images/8/84/TwinHeadedBehemoth-SDMY-EN-C-1E.png'),
(13, 'Dragon Armé LV5', 'Armed Dragon LV5', 'monster', 1, 'wind', 2400, 1700, 5, 'You can send 1 monster from your hand to the GY, then target 1 monster your opponent controls with ATK less than or equal to the sent monster\'s ATK; destroy that target. During the End Phase, if this card destroyed a monster by battle this turn: You can send this card to the GY; Special Summon 1 \"Armed Dragon LV7\" from your hand or Deck.', '', 'https://vignette4.wikia.nocookie.net/yugioh/images/6/6b/ArmedDragonLV5-LCYW-EN-C-1E.png'),
(14, 'Dragon de la Nuit Blanche', 'White Night Dragon', 'monster', 1, 'water', 3000, 2500, 8, 'During either player\'s turn, when a Spell/Trap Card that targets this card is activated: Negate the activation, and if you do, destroy it. When another face-up monster you control is targeted for an attack: You can send 1 Spell/Trap Card you control to the Graveyard; change the attack target to this card.', '', 'https://vignette1.wikia.nocookie.net/yugioh/images/2/2f/WhiteNightDragon-SR02-EN-C-1E.png'),
(15, 'Polymérisation', 'Polymerization', 'spell', 1, '', 0, 0, 0, 'Fusion Summon 1 Fusion Monster from your Extra Deck, using monsters from your hand or field as Fusion Material.', 'Normal', 'https://vignette1.wikia.nocookie.net/yugioh/images/3/30/Polymerization-SDMY-EN-C-1E.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
