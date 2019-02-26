-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 26 fév. 2019 à 17:37
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cards`
--

INSERT INTO `cards` (`id`, `name_fr`, `name`, `card_type`, `quantity`, `family`, `atk`, `def`, `level`, `text`, `property`, `url`) VALUES
(1, 'Dragon Étincelant', 'Luster Dragon', 'monster', 1, 'wind', 1900, 1600, 4, 'A very beautiful dragon covered with sapphire. It does not like fights, but has incredibly high attack power.', '', 'https://vignette2.wikia.nocookie.net/yugioh/images/3/3a/LusterDragon-SDKS-EN-C-1E.png'),
(2, 'Sentinelle de la Cloche de Feu', 'Flamvell Guard', 'monster', 1, 'fire', 100, 2000, 1, 'A Flamvell guardian who commands fire with his will. His magma-hot barrier protects his troops from intruders.', '', 'https://vignette4.wikia.nocookie.net/yugioh/images/2/2c/FlamvellGuard-SDBE-EN-C-1E.png'),
(3, 'Obelisk, le Tourmenteur', 'Obelisk the Tormentor', 'monster', 1, 'divine', 4000, 4000, 10, 'Requires 3 Tributes to Normal Summon (cannot be Normal Set). This card\'s Normal Summon cannot be negated. When Normal Summoned, cards and effects cannot be activated. Cannot be targeted by Spells, Traps, or card effects. Once per turn, during the End Phase, if this card was Special Summoned: Send it to the Graveyard. You can Tribute 2 monsters; destroy all monsters your opponent controls. This card cannot declare an attack the turn this effect is activated.', '', 'https://vignette4.wikia.nocookie.net/yugioh/images/d/d9/ObelisktheTormentor-MVPC-EN-GScR-LE.png'),
(4, 'Goldd, Wu-Lord du Monde Ténébreux', 'Goldd, Wu-Lord of Dark World', 'monster', 1, 'dark', 2300, 1400, 5, 'If this card is discarded to the Graveyard by a card effect: If it was discarded from your hand to your Graveyard by an opponent\'s card effect, you can target up to 2 cards your opponent controls; Special Summon this card from the Graveyard, then destroy those targets (if any).', '', 'https://vignette2.wikia.nocookie.net/yugioh/images/f/fd/GolddWuLordofDarkWorld-PGLD-EN-GUR-1E.png'),
(5, 'Slifer, le Dragon Céleste', 'Slifer the Sky Dragon', 'monster', 1, 'divine', 0, 0, 10, 'Requires 3 Tributes to Normal Summon (cannot be Normal Set). This card\'s Normal Summon cannot be negated. When Normal Summoned, cards and effects cannot be activated. Once per turn, during the End Phase, if this card was Special Summoned: Send it to the GY. Gains 1000 ATK and DEF for each card in your hand. If a monster(s) is Normal or Special Summoned to your opponent\'s field in Attack Position: That monster(s) loses 2000 ATK, then if its ATK has been reduced to 0 as a result, destroy it.', '', 'https://vignette2.wikia.nocookie.net/yugioh/images/0/04/SlifertheSkyDragon-MVP1-EN-GUR-1E.png'),
(6, 'Le Dragon Ailé de Râ', 'The Winged Dragon of Ra', 'monster', 1, 'divine', 0, 0, 10, 'Cannot be Special Summoned. Requires 3 Tributes to Normal Summon (cannot be Normal Set). This card\'s Normal Summon cannot be negated. When Normal Summoned, other cards and effects cannot be activated. When this card is Normal Summoned: You can pay LP so that you only have 100 left; this card gains ATK and DEF equal to the amount of LP paid. You can pay 1000 LP, then target 1 monster on the field; destroy that target.', '', 'https://vignette4.wikia.nocookie.net/yugioh/images/c/c5/TheWingedDragonofRa-LDK2-EN-UR-LE.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
