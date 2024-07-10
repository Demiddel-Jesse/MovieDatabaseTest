START TRANSACTION;

--
-- Database: "FilmBibliotheek"
--
--------------------------------
--
-- Insert for "Genres"
--

CREATE TABLE IF NOT EXISTS "Genres" (
  "id" SERIAL PRIMARY KEY,
  "name" VARCHAR(255) NOT NULL);

INSERT INTO "Genres" ("name")
VALUES
  ('Crime'),
  ('Fantasy'),
  ('Legal'),
  ('Medical'),
  ('Military'),
  ('Mystery'),
  ('Romance'),
  ('Sci-fi'),
  ('Slasher'),
  ('Documentary'),
  ('Drama'),
  ('Drama'),
  ('Drama'),('Drama'),
  ('Drama'),('Drama'),('Drama'),('Drama'),('Drama'),
  ('Thriller');

--------------------------------
--
-- Insert for "Ratings"
--

CREATE TABLE IF NOT EXISTS "Ratings" (
  "id" SERIAL PRIMARY KEY,
  "name" VARCHAR(255) NOT NULL,
  "description" VARCHAR(255) DEFAULT NULL);

INSERT INTO "Ratings" ( "name", "description") VALUES
('G', NULL),
('PG', NULL),
('PG-13', NULL),
('NC-17', NULL),
('NC-17', NULL),
('NC-17', NULL),
('NC-17', NULL),
('NC-17', NULL),
('M', NULL);


CREATE TABLE IF NOT EXISTS "Users" (
  "id" SERIAL PRIMARY KEY,
  "username" VARCHAR(255) NOT NULL,
  "password" VARCHAR(255) NOT NULL,
  "email" VARCHAR(255) NOT NULL,
  "admin" SMALLINT NOT NULL
);

INSERT INTO "Users" ("username", "password", "email", "admin") VALUES
('joskeVer', '$2y$10$oJG1KfFRPTBl4cfud1bSluZGuGFRbt.8VoP4U.hY1/CFkfSURzUfq', 'joske@mail.com', 1),
('jeffreyVer', '$2y$10$mQygmtwhoI1NpgPUGFcN0uaWj253EAauvSTP47xg6o8yFV3zV6vHy', 'jeffrey@mail.com', 0);

--------------------------------
--
-- Insert for "Films"
--

CREATE TABLE IF NOT EXISTS "Films" (
  "id" SERIAL PRIMARY KEY,
  "title" VARCHAR(255) NOT NULL,
  "sortTitle" VARCHAR(255) NOT NULL,
  "description" TEXT,
  "runtime" INT DEFAULT NULL,
  "releaseDate" DATE DEFAULT NULL,
  "coverImage" VARCHAR(255) DEFAULT NULL,
  "genreId" INT DEFAULT NULL,
  "categoryId" INT DEFAULT NULL,
  "ratingId" INT DEFAULT NULL
  -- CONSTRAINT "fk_Films_Genres" FOREIGN KEY ("genreId") REFERENCES "Genres"("id"),
  -- CONSTRAINT "fk_Films_Categories" FOREIGN KEY ("categoryId") REFERENCES "Categories"("id"),
  -- CONSTRAINT "fk_Films_Ratings" FOREIGN KEY ("ratingId") REFERENCES "Ratings"("id")
);

INSERT INTO "Films" ("title", "sortTitle", "description", "runtime", "releaseDate", "coverImage", "genreId", "categoryId", "ratingId") VALUES
('Eternal Night of the Fabled Mind','Eternal Night of the Fabled Mind','A troubled genius navigates dreams to unlock his forgotten past, finding dark secrets that could alter reality.', 110,'1995-07-15','~/img/EternalNightoftheFabledMind.png', 12, 2, 3),
('Whispers from the Shadow Grove','Whispers from the Shadow Grove','In a mystical forest, a young girl uncovers ancient spirits conspiring, as nature itself whispers chilling tales.', 95, NULL, NULL, NULL, NULL, 5),
('Beyond the Horizons Edge','Beyond the Horizons Edge', NULL, 140,'1992-05-08','~/img/BeyondtheHorizonsEdge.png', 5, 3, 8),
('The Last Symphony of Mr. Peterson','Last Symphony of Mr. Peterson, The','An aging composer struggles to complete his final masterpiece while grappling with his fading memory and legacy.', NULL,'2010-11-03', NULL, 1, NULL, 6),
('Dance of the Autumn Fireflies','Dance of the Autumn Fireflies','As autumn arrives, two old lovers reunite, their past illuminated by the dance of fireflies, uncovering unresolved feelings.', 100,'2008-10-27','~/img/DanceoftheAutumnFireflies.png', 14, 1, 1),
('Echoes of the Lost Empire','Echoes of the Lost Empire', NULL, 130,'1997-04-14','~/img/EchoesoftheLostEmpire.png', 9, 4, 7),
('The Clockmakers Daughter','Clockmakers Daughter, The','A gifted young woman inherits her fathers clock shop, discovering magical clocks with the power to alter time.', 105, NULL, NULL, 14, 2, 4),
('Journey to the Whispering Isles','Journey to the Whispering Isles','A crew of adventurers sets sail to mystical islands rumored to hold the secrets to eternal youth.', NULL,'2016-06-02','~/img/JourneytotheWhisperingIsles.png', 11, NULL, 2),
('The Bookstore at the End of the World','Bookstore at the End of the World, The','A quirky loner runs a bookstore where the books predict the future but faces closure from ominous forces.', 90,'1994-03-23','~/img/BookstoreattheEndoftheWorld.png', 2, 3, 8),
('Mirrors in the Fog','Mirrors in the Fog', NULL, 75,'1996-12-11','~/img/MirrorsintheFog.png', 8, 4, 1),
('Tales from the Sapphire Coast','Tales from the Sapphire Coast','A coastal village tells stories of a mythical sapphire mermaid whose tears turn into pearls but at a dire cost.', 115, NULL, NULL, 3, 2, 6),
('A Thief in the Night’s Embrace','Thief in the Night’s Embrace, A','A notorious thief falls in love during a heist but must choose between love and a perfect escape.', 80,'2011-08-30','~/img/ThiefintheNightsEmbrace.png', 6, 4, 3),
('The Secret Lives of Time Travelers','Secret Lives of Time Travelers, The', NULL, NULL,'2014-05-17','~/img/SecretLivesofTimeTravelers.png', NULL, NULL, 4),
('Chasing the Stars Beyond','Chasing the Stars Beyond','A group of teenagers embark on a cosmic adventure chasing after a comet, only to find themselves stranded in space.', 150,'2020-01-25', NULL, 4, 2, 7),
('Shadows Over the Crimson Lake','Shadows Over the Crimson Lake','A journalist investigates strange occurrences around a lake that turns crimson at night, uncovering a ghostly legend.', 88, NULL, NULL, NULL, 3, 5),
('The Legend of the Golden Clock','Legend of the Golden Clock, The', NULL, 125,'2007-12-05','~/img/LegendoftheGoldenClock.png', 7, NULL, 2),
('The Gardener of Forgotten Blossoms','Gardener of Forgotten Blossoms, The', NULL, 70,'1993-02-18','~/img/GardenerofForgottenBlossoms.png', NULL, 4, 8),
('The Silence of the White City','Silence of the White City, The', NULL, NULL,'2002-04-07', NULL, 12, 3, 6),
('Beneath the Midnight Sun','Beneath the Midnight Sun','Under the Arctic sun, an isolated community faces profound mysteries rooted in ancient Viking myths.', NULL,'2004-09-12','~/img/BeneaththeMidnightSun.png', 5, 2, 1),
('The Oracle of Forgotten Myths','Oracle of Forgotten Myths, The','A librarian stumbles upon a forgotten oracle that can answer any question, but each answer comes with perilous consequences.', 180,'2019-02-15','~/img/OracleofForgottenMyths.png', NULL, 4, 4),
('The Lighthouse at Dawn’s End','Lighthouse at Dawn’s End, The','An old sea captain and his granddaughter maintain a mysterious lighthouse, discovering its key role in guiding ghost ships.', 110,'2009-08-28','~/img/LighthouseatDawnsEnd.png', 1, 3, 7),
('The Last Days of Atlantis','Last Days of Atlantis, The','Scholars investigate the ruins of Atlantis, finding technologies that could change the modern world, sparking a deadly race.', 160,'1998-06-19', NULL, 8, 1, 3),
('Midnight in the Garden of Dreams','Midnight in the Garden of Dreams','A cursed garden traps visitors in eternal midnight, where dreams and reality blend, challenging their deepest fears.', 103,'2013-03-05','~/img/MidnightintheGardenofDreams.png', NULL, 2, 5),
('The Phantom of the Opera House','Phantom of the Opera House, The','A famous opera singer encounters a ghost claiming to protect her against a looming threat within the opera house.', 77,'2015-07-13','~/img/PhantomoftheOperaHouse.png', 14, 3, 8),
('Secrets of the Desert Wind','Secrets of the Desert Wind','Amidst swirling desert sands, a treasure hunter unearths an ancient city, awakening secrets best left hidden.', NULL,'1999-11-02', NULL, 11, 4, 2),
('The Prince of Storms','Prince of Storms, The','In a realm dominated by storms, a young prince must harness the power of tempests to save his kingdom.', 122,'2012-12-09','~/img/PrinceofStorms.png', 3, NULL, 6),
('The Artisan’s Key','Artisan’s Key, The','A master locksmith creates a key that unlocks any door, leading him into a world of intrigue and espionage.', 113,'2021-10-18', NULL, 13, 2, 1),
('Letters to the Winter Sky','Letters to the Winter Sky','A heartbroken poet sends letters to the sky, each carrying wishes that start to mysteriously come true.', 84,'2000-01-07', NULL, 4, 4, 7),
('The Fortress of Solitude','Fortress of Solitude, The', NULL, 92,'1990-08-24','~/img/FortressofSolitude.png', NULL, NULL, 5),
('The Enchantress of Florence','Enchantress of Florence, The','In Renaissance Italy, a mysterious woman uses her enchanting powers to influence the city’s most powerful figures.', 108, NULL, NULL, 6, 3, 4),
('The Velvet Queen','Velvet Queen, The','A once-famous actress dons the persona of the Velvet Queen to revive her career, but at what cost?', NULL,'2006-05-20','~/img/VelvetQueen.png', 7, 2, 2),
('The Iron Heart','The Iron Heart','In a dystopian future, a rebel with a mechanical heart leads a revolt against a tyrannical government.', 104,'2018-03-29','~/img/IronHeart.png', 14, 4, 3),
('The Heir of the Forgotten Castle','Heir of the Forgotten Castle, The','The last descendant of a royal line must find his ancestors castle and claim his birthright among supernatural challenges.', 102,'2017-09-01','~/img/HeiroftheForgottenCastle.png', NULL, 1, 8),
('The Sunken City Chronicles','Sunken City Chronicles, The','A group of explorers find an underwater city, but unlocking its treasures could mean their survival or demise.', 89, NULL, NULL, 12, 2, 1),
('The Bridge Between Worlds','Bridge Between Worlds, The','A scientist discovers a portal to parallel universes and must navigate a war between worlds to save her family.', 123,'2014-02-14', NULL, 5, NULL, 7),
('The Archives of the Impossible','Archives of the Impossible, The', NULL, NULL, NULL,'~/img/ArchivesoftheImpossible.png', 11, 1, 6),
('The Wolves of Winter’s Hollow','Wolves of Winter’s Hollow, The','In a village haunted by dire wolves, a young hunter uncovers ancient secrets that could either save or doom his people.', 86,'1999-08-15', NULL, 2, 4, 4),
('The Sorcerer’s Mirror','Sorcerer’s Mirror, The', NULL, 79,'2007-10-25','~/img/SorcerersMirror.png', NULL, 2, 5),
('The Cathedral in the Sea','Cathedral in the Sea, The','A cathedral submerged under the sea holds the key to an ancient prophecy, attracting monks and mercenaries alike.', 114,'2015-05-11', NULL, 3, 3, 2),
('The Last Breath of Summer','Last Breath of Summer, The','A community struggles with strange seasonal changes, culminating in a summer that threatens to be its last.', 101,'2018-07-08', NULL, 10, 4, 8),
('The Secret of the Midnight Sun', 'Secret of the Midnight Sun, The', 'An expedition to the Arctic uncovers an ancient artifact with mysterious powers.', 120, '2016-01-15', '~/img/SecretoftheMidnightSun.png', 7, 3, 4),
('Whispers of the Old Forest', 'Whispers of the Old Forest', 'A group of hikers gets lost in a forest and discovers a hidden civilization.', 95, '2017-05-20', '~/img/WhispersoftheOldForest.png', 6, 2, 5),
('Echoes from the Abyss', 'Echoes from the Abyss', 'A deep-sea diving team encounters strange phenomena and creatures in the ocean depths.', 110, '2019-11-01', '~/img/EchoesfromtheAbyss.png', 5, 4, 6),
('Mystery of the Forgotten Temple', 'Mystery of the Forgotten Temple', 'Archaeologists uncover a forgotten temple with ancient secrets that challenge their understanding of history.', 130, '2018-04-12', '~/img/MysteryoftheForgottenTemple.png', 8, 3, 7),
('Beneath the Shadow of the Mountain', 'Beneath the Shadow of the Mountain', 'A climber’s journey leads to a hidden village with a dark past and mystical guardians.', 115, '2017-10-30', '~/img/BeneaththeShadowoftheMountain.png', 7, 4, 5),
('Journey to the Lost City', 'Journey to the Lost City', 'An adventurer sets out to find a mythical city said to hold unimaginable treasures.', 140, '2015-03-05', '~/img/JourneytotheLostCity.png', 9, 2, 6),
('The Guardian of the Forest', 'Guardian of the Forest, The', 'A young woman discovers she is the guardian of a mystical forest threatened by dark forces.', 105, '2014-09-27', '~/img/GuardianoftheForest.png', 6, 3, 4),
('The Chronicles of the Enchanted Island', 'Chronicles of the Enchanted Island, The', 'A shipwrecked sailor finds an island where magic is real and time stands still.', 120, '2020-12-18', '~/img/ChroniclesoftheEnchantedIsland.png', 10, 1, 5),
('The Legend of the Crystal Cavern', 'Legend of the Crystal Cavern, The', 'Explorers uncover a cavern filled with crystals that have strange and powerful properties.', 115, '2016-06-14', '~/img/LegendoftheCrystalCavern.png', 5, 4, 7),
('Shadows of the Forgotten World', 'Shadows of the Forgotten World', 'An ancient curse awakens, threatening to plunge the world into darkness.', 130, '2019-08-21', '~/img/ShadowsoftheForgottenWorld.png', 8, 2, 6),
('The Treasure of the Haunted Pirate Ship', 'Treasure of the Haunted Pirate Ship, The', 'A group of treasure hunters discovers a pirate ship haunted by its undead crew.', 95, '2021-05-10', '~/img/TreasureoftheHauntedPirateShip.png', 7, 3, 5);


--------------------------------
--
-- Insert for "UserListsLines"
--

CREATE TABLE IF NOT EXISTS "ListTypes" (
  "id" SERIAL PRIMARY KEY,
  "name" VARCHAR(255) NOT NULL
);

INSERT INTO "ListTypes" ("name") VALUES
('nog te bekijken'),
('bekeken'),
('aan het bekijken'),
('dropped');

CREATE TABLE IF NOT EXISTS "UserListsLines" (
  "id" SERIAL,
  "UserId" INT NOT NULL,
  "FilmId" INT NOT NULL,
  "rating" DECIMAL(3,1) DEFAULT NULL,
  "ListTypesId" INT NOT NULL,
  PRIMARY KEY ( "UserId", "FilmId"),
  CONSTRAINT "fk_UserListsLines_Films" FOREIGN KEY ("FilmId") REFERENCES "Films"("id"),
  CONSTRAINT "fk_UserListsLines_Users" FOREIGN KEY ("UserId") REFERENCES "Users"("id"),
  CONSTRAINT "fk_UserListsLines_ListTypes" FOREIGN KEY ("ListTypesId") REFERENCES "ListTypes"("id")
);

INSERT INTO "UserListsLines" ("UserId", "FilmId", "rating", "ListTypesId") VALUES
( 1, 3, 0.0, 1),
( 1, 4, 2.0, 2),
( 1, 5, 7.0, 3),
( 1, 6, 4.5, 4),
( 1, 7, 0.0, 1),
( 1, 8, 5.5, 2),
( 1, 9, 2.5, 3),
( 1, 10, 6.0, 4),
( 1, 11, 0.0, 1),
( 1, 12, 1.0, 2),
( 1, 13, 3.5, 3),
( 1, 14, 10.0, 4),
( 1, 15, 0.0, 1),
( 1, 16, 6.5, 2),
( 1, 17, 8.0, 3),
( 1, 18, 3.0, 4),
( 1, 19, 0.0, 1),
( 1, 20, 2.0, 2),
( 1, 21, 7.5, 3),
( 1, 22, 1.0, 4),
( 1, 23, 0.0, 1),
( 1, 24, 7.0, 2),
( 1, 25, 0.0, 3),
( 1, 26, 6.5, 4),
( 1, 27, 0.0, 1),
( 1, 28, 8.5, 2),
( 1, 29, 2.5, 3),
( 1, 30, 4.0, 4),
( 1, 31, 0.0, 1),
( 1, 32, 1.0, 2),
( 1, 33, 3.5, 3),
( 1, 34, 10.0, 4),
( 1, 35, 0.0, 1),
( 1, 36, 7.5, 2),
( 1, 37, 5.0, 3),
( 1, 38, 8.5, 4),
( 1, 39, 0.0, 1),
( 1, 40, 1.5, 2),
( 1, 41, 2.0, 3),
( 1, 42, 9.5, 4),
( 2, 3, 0.0, 1),
( 2, 4, 4.5, 2),
( 2, 5, 6.5, 3),
( 2, 6, 3.0, 4),
( 2, 7, 0.0, 1),
( 2, 8, 1.0, 2),
( 2, 9, 2.5, 3),
( 2, 10, 0.0, 4),
( 2, 11, 0.0, 1),
( 2, 12, 5.5, 2),
( 2, 13, 7.0, 3),
( 2, 14, 2.5, 4),
( 2, 15, 0.0, 1),
( 2, 16, 6.0, 2),
( 2, 17, 3.5, 3),
( 2, 18, 4.5, 4),
( 2, 19, 0.0, 1),
( 2, 20, 5.0, 2),
( 2, 21, 0.0, 3),
( 2, 22, 1.0, 4),
( 2, 23, 0.0, 1),
( 2, 24, 7.5, 2),
( 2, 25, 4.0, 3),
( 2, 26, 8.5, 4);

--------------------------------
--
-- Insert for "Actors"
--

CREATE TABLE IF NOT EXISTS "Actors" (
  "id" SERIAL PRIMARY KEY,
  "firstName" VARCHAR(255) NOT NULL,
  "lastName" VARCHAR(255) NOT NULL,
  "image" BYTEA
);

INSERT INTO "Actors" ( "firstName", "lastName", "image") VALUES
('Julie','Dixon', NULL);
INSERT INTO "Actors" ( "firstName", "lastName", "image") VALUES
('Ginger','Santos', NULL);
INSERT INTO "Actors" ( "firstName", "lastName", "image") VALUES
('Katherine','Watts', NULL),
('Ross','Houston', NULL),
('Mayra','Chapman', NULL),
('Tiffany','Barton', NULL),
('Clay','Owens', NULL),
('Merle','Decker', NULL),
('Lillie','Horn', NULL),
('Melinda','Hurst', NULL);
INSERT INTO "Actors" ( "firstName", "lastName", "image") VALUES
('Cassie','FitzGerald', NULL);
INSERT INTO "Actors" ( "firstName", "lastName", "image") VALUES
('Gretchen','Ramos', NULL);
INSERT INTO "Actors" ( "firstName", "lastName", "image") VALUES
('Agnes','McLean', NULL);
INSERT INTO "Actors" ( "firstName", "lastName", "image") VALUES
('Christie','Erwin', NULL),
('Laurel','Donnelly', NULL);
INSERT INTO "Actors" ( "firstName", "lastName", "image") VALUES
('Hal','Jennings', NULL);
INSERT INTO "Actors" ( "firstName", "lastName", "image") VALUES
('Gerard','Perez', NULL),
('Carla','Daly', NULL),
('Brett','Buckley', NULL);
INSERT INTO "Actors" ( "firstName", "lastName", "image") VALUES
('Ray','Cordova', NULL);
INSERT INTO "Actors" ( "firstName", "lastName", "image") VALUES
('Tracey','Norman', NULL),
('Dennis','Nicholson', NULL),
('Denise','Gleason', NULL),
('Kristi','Fischer', NULL);
INSERT INTO "Actors" ( "firstName", "lastName", "image") VALUES
('Mike','Waller', NULL);
INSERT INTO "Actors" ( "firstName", "lastName", "image") VALUES
('Terri','Escobar', NULL),
('Arlene','Wyatt', NULL),
('Al','English', NULL);
INSERT INTO "Actors" ( "firstName", "lastName", "image") VALUES
('Ruth','Gibson', NULL);
INSERT INTO "Actors" ( "firstName", "lastName", "image") VALUES
('Sonja','Malone', NULL),
('Douglas','Torres', NULL),
('Gerardo','Burns', NULL);
INSERT INTO "Actors" ( "firstName", "lastName", "image") VALUES
('Marisa','Ross', NULL);
INSERT INTO "Actors" ( "firstName", "lastName", "image") VALUES
('Nora','Maddox', NULL),
('Allen','Stanley', NULL),
('Kathryn','Ball', NULL),
('Muriel','Weber', NULL),
('Claire','Mead', NULL),
('Bonita','Brady', NULL);
INSERT INTO "Actors" ( "firstName", "lastName", "image") VALUES
('Nicolas','Cooper', NULL);
INSERT INTO "Actors" ( "firstName", "lastName", "image") VALUES
('Krystal','Fuller', NULL),
('Eileen','Meadows', NULL),
('Mickey','Brock', NULL),
('Tyler','Finn', NULL);
INSERT INTO "Actors" ( "firstName", "lastName", "image") VALUES
('Ellen','Burns',  NULL);
INSERT INTO "Actors" ( "firstName", "lastName", "image") VALUES
('Angelina','Jefferson', NULL),
('Mario','Ochoa', NULL),
('Bruce','Rivera', NULL),
('Nancy','Riley', NULL),
('Miguel','Wyatt', NULL),
('Edith','Edwards', NULL);
INSERT INTO "Actors" ( "firstName", "lastName", "image") VALUES
('Pauline','Weber', NULL);
INSERT INTO "Actors" ( "firstName", "lastName", "image") VALUES
('Peter','Kuhn', NULL),
('Julius','Park', NULL),
('Wade','Byers', NULL);
INSERT INTO "Actors" ( "firstName", "lastName", "image") VALUES
('Bernard','Marks', NULL);
INSERT INTO "Actors" ( "firstName", "lastName", "image") VALUES
('Kelli','Rocha', NULL),
('Joey','Hubbard', NULL);
INSERT INTO "Actors" ( "firstName", "lastName", "image") VALUES
('Stephen','Houston', NULL);
INSERT INTO "Actors" ( "firstName", "lastName", "image") VALUES
('Olivia','Callahan', NULL),
('Clarence','Schneider', NULL),
('Cindy','Horn', NULL),
('Eugene','Young', NULL);
INSERT INTO "Actors" ( "firstName", "lastName", "image") VALUES
('Gustavo','Ortega', NULL);
INSERT INTO "Actors" ( "firstName", "lastName", "image") VALUES
('Nina','Myers', NULL),
('Clara','Combs', NULL),
('Frank','Lucas', NULL),
('John', 'Doe', NULL),
('Jane', 'Smith', NULL),
('Alice', 'Johnson', NULL),
('Robert', 'Brown', NULL),
('Emily', 'Davis', NULL),
('Michael', 'Miller', NULL),
('Sarah', 'Wilson', NULL),
('David', 'Moore', NULL),
('Laura', 'Taylor', NULL),
('James', 'Anderson', NULL);

--------------------------------
--
-- Insert for "ActorsFilmsLines"
--

CREATE TABLE IF NOT EXISTS "ActorsFilmsLines" (
  "id" SERIAL,
  "ActorId" INT NOT NULL,
  "FilmId" INT NOT NULL,
  PRIMARY KEY ( "ActorId", "FilmId"),
  CONSTRAINT "fk_ActorsFilmsLines_Actors" FOREIGN KEY ("ActorId") REFERENCES "Actors"("id"),
  CONSTRAINT "fk_ActorsFilmsLines_Films" FOREIGN KEY ("FilmId") REFERENCES "Films"("id")
);

INSERT INTO "ActorsFilmsLines" ("ActorId", "FilmId") VALUES
( 5, 2),
( 6, 3),
( 7, 4),
( 8, 5),
( 9, 6),
( 10, 7),
( 11, 8),
( 12, 9),
( 13, 10),
( 14, 11),
( 15, 12),
( 16, 13),
( 17, 14),
( 18, 15),
( 19, 16),
( 20, 17),
( 21, 18),
( 22, 19),
( 23, 20),
( 24, 21),
( 25, 22),
( 26, 23),
( 27, 24),
( 28, 25),
( 29, 26),
( 30, 27),
( 31, 28),
( 32, 29),
( 33, 30),
( 34, 31),
( 35, 32),
( 36, 33),
( 37, 34),
( 38, 35),
( 39, 36),
( 40, 37),
( 41, 38),
( 42, 39),
( 43, 40),
( 44, 41),
( 45, 42),
( 46, 1),
( 47, 2),
( 48, 3),
( 49, 4),
( 50, 5),
( 51, 6),
( 52, 7),
( 53, 8),
( 54, 9),
( 55, 10),
( 56, 11),
( 57, 12),
( 58, 13),
( 59, 14),
( 60, 15),
( 61, 16),
( 62, 17),
( 63, 18),
( 64, 19),
( 65, 20),
( 66, 21),
( 67, 22),
( 68, 23),
( 69, 24),
( 70, 25),
( 71, 26),
( 1, 27),
( 2, 28),
( 3, 29),
( 5, 31),
( 6, 32),
( 7, 33),
( 8, 34),
( 9, 35),
( 10, 36),
( 11, 37),
( 12, 38),
( 13, 39),
( 14, 40),
( 15, 41),
( 16, 42),
( 17, 1),
( 18, 2),
( 19, 3),
( 20, 4),
( 21, 5),
( 22, 6),
( 23, 7),
( 24, 8),
( 25, 9),
( 26, 10),
( 27, 11),
( 28, 12),
( 29, 13),
( 30, 14),
( 31, 15),
( 32, 16),
( 33, 17),
( 34, 18),
( 35, 19),
( 36, 20),
( 37, 21),
( 38, 22),
( 39, 23),
( 40, 24),
( 41, 25),
( 42, 26),
( 43, 27),
( 44, 28),
( 45, 29),
( 46, 30),
( 47, 31),
( 48, 32),
( 49, 33),
( 50, 34),
( 51, 35),
( 52, 36),
( 53, 37),
( 54, 38),
( 55, 39),
( 56, 40),
( 57, 41),
( 58, 42),
( 59, 1),
( 60, 2),
( 61, 3),
( 62, 4),
( 63, 5),
( 64, 6),
( 65, 7),
( 66, 8),
( 67, 9),
( 68, 10),
( 69, 11),
( 70, 12),
( 71, 13),
( 1, 14),
( 2, 15),
( 3, 16),
( 5, 18),
( 6, 19),
( 7, 20),
( 8, 21),
( 9, 22),
( 10, 23),
( 11, 24),
( 12, 25),
( 13, 26),
( 14, 27),
( 15, 28),
( 16, 29),
( 17, 30),
( 18, 31),
( 19, 32),
( 20, 33),
( 21, 34),
( 22, 35),
( 23, 36),
( 24, 37),
( 25, 38),
( 26, 39),
( 27, 40),
( 28, 41),
( 29, 42),
( 30, 1),
( 31, 2),
( 32, 3),
( 33, 4),
( 34, 5),
( 35, 6),
( 36, 7),
( 37, 8),
( 38, 9),
( 39, 10),
( 40, 11),
( 41, 12),
( 42, 13),
( 43, 14),
( 44, 15),
( 45, 16),
( 46, 17),
( 47, 18),
( 48, 19),
( 49, 20),
( 50, 21),
( 51, 22),
( 52, 23),
( 53, 24),
( 54, 25),
( 55, 26),
( 56, 27),
( 57, 28),
( 58, 29),
( 59, 30),
( 60, 31),
( 61, 32);

--------------------------------
--
-- Insert for "Directors"
--

CREATE TABLE IF NOT EXISTS "Directors" (
  "id" SERIAL PRIMARY KEY,
  "firstName" VARCHAR(255) NOT NULL,
  "lastName" VARCHAR(255) NOT NULL,
  "image" BYTEA
);

INSERT INTO "Directors" ( "firstName", "lastName", "image") VALUES
('Carolyn','Wallace', NULL);
INSERT INTO "Directors" ( "firstName", "lastName", "image") VALUES
('Bobby','Michael', NULL);
INSERT INTO "Directors" ( "firstName", "lastName", "image") VALUES
('Michele','Gibson', NULL);
INSERT INTO "Directors" ( "firstName", "lastName", "image") VALUES
('Megan','Proctor', NULL);
INSERT INTO "Directors" ( "firstName", "lastName", "image") VALUES
('Leigh','Dunbar', NULL),
('Cristina','Johnson', NULL);
INSERT INTO "Directors" ( "firstName", "lastName", "image") VALUES
('Leah','Stokes', NULL);
INSERT INTO "Directors" ( "firstName", "lastName", "image") VALUES
('Marvin','Walker', NULL);
INSERT INTO "Directors" ( "firstName", "lastName", "image") VALUES
('Heidi','Hawkins', NULL);
INSERT INTO "Directors" ( "firstName", "lastName", "image") VALUES
('Hazel','Munoz', NULL);
INSERT INTO "Directors" ( "firstName", "lastName", "image") VALUES
('Charlene','Miranda', NULL),
('Hugh','Daly', NULL),
('Alice', 'Johnson', NULL),
('Robert', 'Brown', NULL),
('Emily', 'Davis', NULL),
('Michael', 'Miller', NULL),
('Sarah', 'Wilson', NULL),
('David', 'Moore', NULL),
('Laura', 'Taylor', NULL);

--------------------------------
--
-- Insert for "DirectorsFilmsLines"
--

CREATE TABLE IF NOT EXISTS "DirectorsFilmsLines" (
  "id" SERIAL PRIMARY KEY,
  "DirectorId" INT NOT NULL,
  "FilmId" INT NOT NULL,
  CONSTRAINT "fk_DirectorsFilmsLines_Directors" FOREIGN KEY ("DirectorId") REFERENCES "Directors"("id"),
  CONSTRAINT "fk_DirectorsFilmsLines_Films" FOREIGN KEY ("FilmId") REFERENCES "Films"("id")
);

INSERT INTO "DirectorsFilmsLines" ("DirectorId", "FilmId") VALUES
( 3, 3),
( 4, 4),
( 5, 5),
( 6, 6),
( 7, 7),
( 8, 8),
( 9, 9),
( 10, 10),
( 11, 11),
( 12, 12),
( 13, 13),
( 14, 14),
( 15, 15),
( 1, 16),
( 2, 17),
( 3, 18),
( 4, 19),
( 5, 20),
( 6, 21),
( 7, 22),
( 8, 23),
( 9, 24),
( 10, 25),
( 11, 26),
( 12, 27),
( 13, 28),
( 14, 29),
( 15, 30),
( 1, 31),
( 2, 32),
( 3, 33),
( 4, 34),
( 5, 35),
( 6, 36),
( 7, 37),
( 8, 38),
( 9, 39),
( 10, 40),
( 11, 41),
( 12, 42);


COMMIT;
