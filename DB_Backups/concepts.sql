-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2025 at 10:15 PM
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
-- Database: `concepts`
--

-- --------------------------------------------------------

--
-- Table structure for table `adjectives`
--

CREATE TABLE `adjectives` (
  `adjID` int(11) NOT NULL,
  `adjName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adjectives`
--

INSERT INTO `adjectives` (`adjID`, `adjName`) VALUES
(1, 'Freezing');

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `attrID` int(11) NOT NULL,
  `attrName` varchar(20) NOT NULL,
  `attrClass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`attrID`, `attrName`, `attrClass`) VALUES
(1, 'Fire', 'Major'),
(2, 'Earth', 'Major'),
(3, 'Water', 'Major'),
(4, 'Air', 'Major'),
(5, 'Time', 'Major'),
(6, 'Space', 'Major'),
(7, 'Metal', 'Minor'),
(8, 'Crystal', 'Minor'),
(9, 'Deep', 'Minor'),
(10, 'Demon', 'Minor'),
(11, 'Radiant', 'Minor'),
(12, 'Sky', 'Minor'),
(13, 'Light', 'Minor'),
(14, 'Shadow', 'Minor'),
(15, 'Necro', 'Minor'),
(16, 'Lightning', 'Minor'),
(17, 'Blood', 'Minor'),
(18, 'Ice', 'Minor'),
(19, 'Drak Fire', 'Minor'),
(20, 'Sun', 'Minor'),
(21, 'Moon', 'Minor'),
(22, 'Psychic', 'Special'),
(23, 'Force', 'Special'),
(24, 'Runic', 'Special'),
(25, 'Alchemy', 'Special'),
(26, 'Sealing', 'Special'),
(27, 'Nature', 'Special');

-- --------------------------------------------------------

--
-- Table structure for table `biomes`
--

CREATE TABLE `biomes` (
  `biomeID` int(11) NOT NULL,
  `biomeName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `biomes`
--

INSERT INTO `biomes` (`biomeID`, `biomeName`) VALUES
(1, 'Tundra');

-- --------------------------------------------------------

--
-- Table structure for table `clan`
--

CREATE TABLE `clan` (
  `clanID` int(25) NOT NULL,
  `clanName` varchar(25) NOT NULL,
  `clanClass` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clan`
--

INSERT INTO `clan` (`clanID`, `clanName`, `clanClass`) VALUES
(1, 'Klax', 'Fighter'),
(2, 'Friss', 'Noble'),
(3, 'Sharp', 'Hunter'),
(4, 'Hondo', 'Magic'),
(5, 'Frel', 'Nomad'),
(9, 'Duwar', 'Crafting'),
(12, 'Kulane', 'Hunting'),
(13, 'Swifall', 'Fighter');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `classID` int(11) NOT NULL,
  `className` varchar(20) NOT NULL,
  `classType` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`classID`, `className`, `classType`) VALUES
(1, 'Artificer', 'Caster'),
(2, 'Barbarian', 'Martial'),
(3, 'Bard', 'Mixed'),
(4, 'Beast Hunter', 'Martial'),
(5, 'Cleric', 'Caster'),
(6, 'Druid', 'Caster'),
(7, 'Fighter', 'Martial'),
(8, 'Monk', 'Martial'),
(9, 'Paladin', 'Mixed'),
(10, 'Ranger', 'Martial'),
(11, 'Rogue', 'Martial'),
(12, 'Sorcerer', 'Caster'),
(13, 'Warlock', 'Caster'),
(14, 'Wizard', 'Caster'),
(15, 'Hero', 'One who walks toward');

-- --------------------------------------------------------

--
-- Table structure for table `evolution`
--

CREATE TABLE `evolution` (
  `evolID` int(25) NOT NULL,
  `evolName` varchar(25) NOT NULL,
  `evolType` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evolution`
--

INSERT INTO `evolution` (`evolID`, `evolName`, `evolType`) VALUES
(1, 'Muscles', 'physical'),
(2, 'Speed', 'physical'),
(3, 'Intellect', 'physical'),
(4, 'Runes', 'magical'),
(5, 'Manifest', 'magical'),
(6, 'Spirit', 'magical');

-- --------------------------------------------------------

--
-- Table structure for table `familiars`
--

CREATE TABLE `familiars` (
  `famID` int(11) NOT NULL,
  `famName` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `familiars`
--

INSERT INTO `familiars` (`famID`, `famName`) VALUES
(1, 'Bat'),
(2, 'Bear'),
(3, 'Beetle'),
(4, 'Bull'),
(5, 'Cat'),
(6, 'Centipede'),
(7, 'Chicken'),
(8, 'Chocobo'),
(9, 'Crab'),
(10, 'Crocodile'),
(11, 'Deer'),
(12, 'Dog'),
(13, 'Duck'),
(14, 'Elephant'),
(15, 'Fox'),
(16, 'Plant'),
(17, 'Horse'),
(18, 'Humanoid'),
(19, 'Lizard'),
(20, 'Mantis'),
(21, 'Monkey'),
(22, 'Mouse'),
(23, 'Narwhal'),
(24, 'Octopus'),
(25, 'Owl'),
(26, 'Parrot'),
(27, 'Pig'),
(28, 'Rabbit'),
(29, 'Raccoon'),
(30, 'Rhino'),
(31, 'Robin'),
(32, 'Scorpion'),
(33, 'Shark'),
(34, 'Slug'),
(35, 'Snail'),
(36, 'Snake'),
(37, 'Spider'),
(38, 'Squid'),
(39, 'Stego'),
(40, 'Trike'),
(41, 'Turtle'),
(42, 'Wasp'),
(43, 'Woodpecker'),
(44, 'Bee'),
(45, 'Wyrm');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `featID` int(11) NOT NULL,
  `featName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`featID`, `featName`) VALUES
(1, 'Cabin');

-- --------------------------------------------------------

--
-- Table structure for table `modweapon`
--

CREATE TABLE `modweapon` (
  `modID` int(11) NOT NULL,
  `weaponName` varchar(25) NOT NULL,
  `weaponParts` int(11) NOT NULL,
  `partOne` varchar(25) NOT NULL,
  `partTwo` varchar(25) NOT NULL,
  `partThr` varchar(25) NOT NULL,
  `partFour` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modweapon`
--

INSERT INTO `modweapon` (`modID`, `weaponName`, `weaponParts`, `partOne`, `partTwo`, `partThr`, `partFour`) VALUES
(1, 'Axe', 4, 'Handle', 'Grip', 'Main Head', 'Back Head'),
(2, 'Bow', 4, 'Core', 'Top Limb', 'Bot Limb', 'String'),
(3, 'Club', 3, 'Handle', 'Grip', 'Head', ''),
(4, 'Crossbow', 3, 'Body', 'Limbs', 'String', ''),
(5, 'Dagger', 4, 'Hilt', 'Pommel', 'Guard', 'Blade'),
(6, 'Maul', 4, 'Handle', 'Grip', 'Main Head', 'Sub Head'),
(7, 'Polearm', 4, 'Body', 'Main Head', 'Back Head', 'Top Head'),
(8, 'Spear', 3, 'Body', 'Grip', 'Head', ''),
(9, 'Staff', 4, 'Body', 'Grip', 'Top Head', 'Bot Head'),
(10, 'Sword', 4, 'Hilt', 'Pommel', 'Guard', 'Blade'),
(11, 'Whip', 3, 'Hilt', 'Coil', 'Tip', '');

-- --------------------------------------------------------

--
-- Table structure for table `names`
--

CREATE TABLE `names` (
  `userID` int(11) NOT NULL,
  `userName` varchar(26) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `names`
--

INSERT INTO `names` (`userID`, `userName`) VALUES
(1, 'Douglas'),
(2, 'Tiska'),
(3, 'Aina'),
(4, 'Danni'),
(5, 'Drake'),
(6, 'Shaed'),
(7, 'Eliana'),
(8, 'Andrew'),
(9, 'Theresa'),
(10, 'Kyle'),
(11, 'Logan'),
(12, 'Dylan'),
(13, 'Peter'),
(14, 'Josh'),
(15, 'Fred'),
(16, 'Daphne'),
(17, 'Shaggy'),
(18, 'Velma'),
(19, 'Scooby'),
(20, 'Shoto'),
(21, 'Izuku'),
(22, 'Katsuki'),
(23, 'Momo'),
(24, 'Tsu'),
(25, 'Gojo'),
(26, 'Itadori'),
(27, 'D\'Anthony'),
(28, 'Ronnell'),
(29, 'Rob'),
(30, 'Melissa');

-- --------------------------------------------------------

--
-- Table structure for table `poketypes`
--

CREATE TABLE `poketypes` (
  `pokeID` int(11) NOT NULL,
  `pokeType` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `poketypes`
--

INSERT INTO `poketypes` (`pokeID`, `pokeType`) VALUES
(1, 'None'),
(2, 'Normal'),
(3, 'Fire'),
(4, 'Water'),
(5, 'Grass'),
(6, 'Electric'),
(7, 'Ice'),
(8, 'Fighting'),
(9, 'Poison'),
(10, 'Ground'),
(11, 'Flying'),
(12, 'Psychic'),
(13, 'Bug'),
(14, 'Rock'),
(15, 'Ghost'),
(16, 'Dark'),
(17, 'Dragon'),
(18, 'Steel'),
(19, 'Fairy');

-- --------------------------------------------------------

--
-- Table structure for table `races`
--

CREATE TABLE `races` (
  `raceID` int(11) NOT NULL,
  `raceName` varchar(25) NOT NULL,
  `raceDesc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `races`
--

INSERT INTO `races` (`raceID`, `raceName`, `raceDesc`) VALUES
(1, 'Aarakocra', 'Blank'),
(2, 'Aasimar', 'Blank'),
(3, 'Bugbear', 'Blank'),
(4, 'Centaur', 'Blank'),
(5, 'Changeling', 'Blank'),
(6, 'Dragonborn', 'Blank'),
(7, 'Dwarf', 'Blank'),
(8, 'Elf', 'Blank'),
(9, 'Firbolg', 'Blank'),
(10, 'Geckoi', 'Blank'),
(11, 'Genasi', 'Blank'),
(12, 'Gnome', 'Blank'),
(13, 'Goblin', 'Blank'),
(14, 'Goliath', 'Blank'),
(15, 'Grung', 'Blank'),
(16, 'Halfling', 'Blank'),
(17, 'Hobgoblin', 'Blank'),
(18, 'Human', 'Blank'),
(19, 'Illithari', 'Blank'),
(20, 'Kalashtar', 'Blank'),
(21, 'Kenku', 'Blank'),
(22, 'Kobold', 'Blank'),
(23, 'Liardfolk', 'Blank'),
(24, 'Loxodon', 'Blank'),
(25, 'Mimic', 'Blank'),
(26, 'Minotaur', 'Blank'),
(27, 'Orc', 'Blank'),
(28, 'Satyr', 'Blank'),
(29, 'Simic', 'Blank'),
(30, 'Tabaxi', 'Blank'),
(31, 'Tearn', 'Blank'),
(32, 'Tiefling', 'Blank'),
(33, 'Tortle', 'Blank'),
(34, 'Triton', 'Blank'),
(35, 'Vedalken', 'Blank'),
(36, 'Warforged', 'Blank'),
(37, 'Yozai', 'Blank'),
(38, 'Yuan-Ti', 'Blank'),
(39, 'Thri-Kreen', 'Blank'),
(40, 'Dryad', 'Blank'),
(41, 'Naiad', 'Blank');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adjectives`
--
ALTER TABLE `adjectives`
  ADD PRIMARY KEY (`adjID`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`attrID`);

--
-- Indexes for table `biomes`
--
ALTER TABLE `biomes`
  ADD PRIMARY KEY (`biomeID`);

--
-- Indexes for table `clan`
--
ALTER TABLE `clan`
  ADD PRIMARY KEY (`clanID`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`classID`);

--
-- Indexes for table `evolution`
--
ALTER TABLE `evolution`
  ADD PRIMARY KEY (`evolID`);

--
-- Indexes for table `familiars`
--
ALTER TABLE `familiars`
  ADD PRIMARY KEY (`famID`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`featID`);

--
-- Indexes for table `modweapon`
--
ALTER TABLE `modweapon`
  ADD PRIMARY KEY (`modID`);

--
-- Indexes for table `names`
--
ALTER TABLE `names`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `poketypes`
--
ALTER TABLE `poketypes`
  ADD PRIMARY KEY (`pokeID`);

--
-- Indexes for table `races`
--
ALTER TABLE `races`
  ADD PRIMARY KEY (`raceID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `attrID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `clan`
--
ALTER TABLE `clan`
  MODIFY `clanID` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `classID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `evolution`
--
ALTER TABLE `evolution`
  MODIFY `evolID` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `familiars`
--
ALTER TABLE `familiars`
  MODIFY `famID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `modweapon`
--
ALTER TABLE `modweapon`
  MODIFY `modID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `names`
--
ALTER TABLE `names`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `poketypes`
--
ALTER TABLE `poketypes`
  MODIFY `pokeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `races`
--
ALTER TABLE `races`
  MODIFY `raceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
