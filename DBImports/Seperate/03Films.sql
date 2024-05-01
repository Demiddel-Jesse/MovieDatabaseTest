-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 01, 2024 at 11:35 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `FilmBibliotheek`
--

-- --------------------------------------------------------

--
-- Dumping data for table `Films`
--

INSERT INTO `Films` (`id`, `title`, `sortTitle`, `description`, `runtime`, `releaseDate`, `coverImage`, `genreId`, `categoryId`, `ratingId`) VALUES
(3, 'Eternal Night of the Fabled Mind', 'Eternal Night of the Fabled Mind', 'A troubled genius navigates dreams to unlock his forgotten past, finding dark secrets that could alter reality.', 110, '1995-07-15', '~/img/EternalNightoftheFabledMind.png', 12, 2, 3),
(4, 'Whispers from the Shadow Grove', 'Whispers from the Shadow Grove', 'In a mystical forest, a young girl uncovers ancient spirits conspiring, as nature itself whispers chilling tales.', 95, NULL, NULL, NULL, NULL, 5),
(5, 'Beyond the Horizon\'s Edge', 'Beyond the Horizon\'s Edge', NULL, 140, '1992-05-08', '~/img/BeyondtheHorizonsEdge.png', 5, 3, 8),
(6, 'The Last Symphony of Mr. Peterson', 'Last Symphony of Mr. Peterson, The', 'An aging composer struggles to complete his final masterpiece while grappling with his fading memory and legacy.', NULL, '2010-11-03', NULL, 1, NULL, 6),
(7, 'Dance of the Autumn Fireflies', 'Dance of the Autumn Fireflies', 'As autumn arrives, two old lovers reunite, their past illuminated by the dance of fireflies, uncovering unresolved feelings.', 100, '2008-10-27', '~/img/DanceoftheAutumnFireflies.png', 14, 1, 1),
(8, 'Echoes of the Lost Empire', 'Echoes of the Lost Empire', NULL, 130, '1997-04-14', '~/img/EchoesoftheLostEmpire.png', 9, 4, 7),
(9, 'The Clockmaker\'s Daughter', 'Clockmaker\'s Daughter, The', 'A gifted young woman inherits her father\'s clock shop, discovering magical clocks with the power to alter time.', 105, NULL, NULL, 14, 2, 4),
(10, 'Journey to the Whispering Isles', 'Journey to the Whispering Isles', 'A crew of adventurers sets sail to mystical islands rumored to hold the secrets to eternal youth.', NULL, '2016-06-02', '~/img/JourneytotheWhisperingIsles.png', 11, NULL, 2),
(11, 'The Bookstore at the End of the World', 'Bookstore at the End of the World, The', 'A quirky loner runs a bookstore where the books predict the future but faces closure from ominous forces.', 90, '1994-03-23', '~/img/BookstoreattheEndoftheWorld.png', 2, 3, 8),
(12, 'Mirrors in the Fog', 'Mirrors in the Fog', NULL, 75, '1996-12-11', '~/img/MirrorsintheFog.png', 8, 4, 1),
(13, 'Tales from the Sapphire Coast', 'Tales from the Sapphire Coast', 'A coastal village tells stories of a mythical sapphire mermaid whose tears turn into pearls but at a dire cost.', 115, NULL, NULL, 3, 2, 6),
(14, 'A Thief in the Night’s Embrace', 'Thief in the Night’s Embrace, A', 'A notorious thief falls in love during a heist but must choose between love and a perfect escape.', 80, '2011-08-30', '~/img/ThiefintheNightsEmbrace.png', 6, 4, 3),
(15, 'The Secret Lives of Time Travelers', 'Secret Lives of Time Travelers, The', NULL, NULL, '2014-05-17', '~/img/SecretLivesofTimeTravelers.png', NULL, NULL, 4),
(16, 'Chasing the Stars Beyond', 'Chasing the Stars Beyond', 'A group of teenagers embark on a cosmic adventure chasing after a comet, only to find themselves stranded in space.', 150, '2020-01-25', NULL, 4, 2, 7),
(17, 'Shadows Over the Crimson Lake', 'Shadows Over the Crimson Lake', 'A journalist investigates strange occurrences around a lake that turns crimson at night, uncovering a ghostly legend.', 88, NULL, NULL, NULL, 3, 5),
(18, 'The Legend of the Golden Clock', 'Legend of the Golden Clock, The', NULL, 125, '2007-12-05', '~/img/LegendoftheGoldenClock.png', 7, NULL, 2),
(19, 'The Gardener of Forgotten Blossoms', 'Gardener of Forgotten Blossoms, The', NULL, 70, '1993-02-18', '~/img/GardenerofForgottenBlossoms.png', NULL, 4, 8),
(20, 'The Silence of the White City', 'Silence of the White City, The', NULL, NULL, '2002-04-07', NULL, 12, 3, 6),
(21, 'Beneath the Midnight Sun', 'Beneath the Midnight Sun', 'Under the Arctic sun, an isolated community faces profound mysteries rooted in ancient Viking myths.', NULL, '2004-09-12', '~/img/BeneaththeMidnightSun.png', 5, 2, 1),
(22, 'The Oracle of Forgotten Myths', 'Oracle of Forgotten Myths, The', 'A librarian stumbles upon a forgotten oracle that can answer any question, but each answer comes with perilous consequences.', 180, '2019-02-15', '~/img/OracleofForgottenMyths.png', NULL, 4, 4),
(23, 'The Lighthouse at Dawn’s End', 'Lighthouse at Dawn’s End, The', 'An old sea captain and his granddaughter maintain a mysterious lighthouse, discovering its key role in guiding ghost ships.', 110, '2009-08-28', '~/img/LighthouseatDawnsEnd.png', 1, 3, 7),
(24, 'The Last Days of Atlantis', 'Last Days of Atlantis, The', 'Scholars investigate the ruins of Atlantis, finding technologies that could change the modern world, sparking a deadly race.', 160, '1998-06-19', NULL, 8, 1, 3),
(25, 'Midnight in the Garden of Dreams', 'Midnight in the Garden of Dreams', 'A cursed garden traps visitors in eternal midnight, where dreams and reality blend, challenging their deepest fears.', 103, '2013-03-05', '~/img/MidnightintheGardenofDreams.png', NULL, 2, 5),
(26, 'The Phantom of the Opera House', 'Phantom of the Opera House, The', 'A famous opera singer encounters a ghost claiming to protect her against a looming threat within the opera house.', 77, '2015-07-13', '~/img/PhantomoftheOperaHouse.png', 14, 3, 8),
(27, 'Secrets of the Desert Wind', 'Secrets of the Desert Wind', 'Amidst swirling desert sands, a treasure hunter unearths an ancient city, awakening secrets best left hidden.', NULL, '1999-11-02', NULL, 11, 4, 2),
(28, 'The Prince of Storms', 'Prince of Storms, The', 'In a realm dominated by storms, a young prince must harness the power of tempests to save his kingdom.', 122, '2012-12-09', '~/img/PrinceofStorms.png', 3, NULL, 6),
(29, 'The Artisan’s Key', 'Artisan’s Key, The', 'A master locksmith creates a key that unlocks any door, leading him into a world of intrigue and espionage.', 113, '2021-10-18', NULL, 13, 2, 1),
(30, 'Letters to the Winter Sky', 'Letters to the Winter Sky', 'A heartbroken poet sends letters to the sky, each carrying wishes that start to mysteriously come true.', 84, '2000-01-07', NULL, 4, 4, 7),
(31, 'The Fortress of Solitude', 'Fortress of Solitude, The', NULL, 92, '1990-08-24', '~/img/FortressofSolitude.png', NULL, NULL, 5),
(32, 'The Enchantress of Florence', 'Enchantress of Florence, The', 'In Renaissance Italy, a mysterious woman uses her enchanting powers to influence the city’s most powerful figures.', 108, NULL, NULL, 6, 3, 4),
(33, 'The Velvet Queen', 'Velvet Queen, The', 'A once-famous actress dons the persona of the Velvet Queen to revive her career, but at what cost?', NULL, '2006-05-20', '~/img/VelvetQueen.png', 7, 2, 2),
(34, 'The Iron Heart', 'The Iron Heart', 'In a dystopian future, a rebel with a mechanical heart leads a revolt against a tyrannical government.', 104, '2018-03-29', '~/img/IronHeart.png', 14, 4, 3),
(35, 'The Heir of the Forgotten Castle', 'Heir of the Forgotten Castle, The', 'The last descendant of a royal line must find his ancestors\' castle and claim his birthright among supernatural challenges.', 102, '2017-09-01', '~/img/HeiroftheForgottenCastle.png', NULL, 1, 8),
(36, 'The Sunken City Chronicles', 'Sunken City Chronicles, The', 'A group of explorers find an underwater city, but unlocking its treasures could mean their survival or demise.', 89, NULL, NULL, 12, 2, 1),
(37, 'The Bridge Between Worlds', 'The Bridge Between Worlds', 'A scientist discovers a portal to parallel universes and must navigate a war between worlds to save her family.', 123, '2014-02-14', NULL, 5, NULL, 7),
(38, 'The Archives of the Impossible', 'Archives of the Impossible, The', NULL, NULL, NULL, '~/img/ArchivesoftheImpossible.png', 11, 1, 6),
(39, 'The Wolves of Winter’s Hollow', 'Wolves of Winter’s Hollow, The', 'In a village haunted by dire wolves, a young hunter uncovers ancient secrets that could either save or doom his people.', 86, '1999-08-15', NULL, 2, 4, 4),
(40, 'The Sorcerer’s Mirror', 'Sorcerer’s Mirror, The', NULL, 79, '2007-10-25', '~/img/SorcerersMirror.png', NULL, 2, 5),
(41, 'The Cathedral in the Sea', 'Cathedral in the Sea, The', 'A cathedral submerged under the sea holds the key to an ancient prophecy, attracting monks and mercenaries alike.', 114, '2015-05-11', NULL, 3, 3, 2),
(42, 'The Last Breath of Summer', 'Last Breath of Summer, The', 'A community struggles with strange seasonal changes, culminating in a summer that threatens to be its last.', 101, '2018-07-08', NULL, 10, 4, 8);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
