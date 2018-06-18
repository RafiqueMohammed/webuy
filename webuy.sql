-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 18, 2018 at 12:40 PM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `webuy`
--
CREATE DATABASE IF NOT EXISTS `webuy` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `webuy`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_created_on`) VALUES
(1, 'Mobile', '2018-06-15 19:14:54'),
(2, 'PlayStation 4', '2018-06-15 19:15:04'),
(3, 'PlayStation 3', '2018-06-15 19:15:14'),
(4, 'XBox', '2018-06-15 19:15:26'),
(5, 'Nintendo Games DVD', '2018-06-15 19:15:46'),
(6, 'Movies BlueRay DVD', '2018-06-15 19:16:04'),
(7, 'Tablets', '2018-06-15 19:16:24'),
(8, 'Laptops', '2018-06-15 19:16:31'),
(9, 'Fashion Apparels', '2018-06-15 19:16:52');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_user_id` int(11) NOT NULL,
  `order_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_user_id`, `order_on`) VALUES
(5, 1, '2018-06-17 20:15:06'),
(10, 1, '2018-06-17 20:20:08'),
(11, 1, '2018-06-17 20:21:14'),
(12, 1, '2018-06-17 20:22:14'),
(13, 1, '2018-06-17 20:28:40'),
(14, 1, '2018-06-17 20:28:54'),
(15, 1, '2018-06-17 20:29:55'),
(16, 1, '2018-06-17 20:33:38'),
(17, 1, '2018-06-17 20:34:55'),
(18, 1, '2018-06-17 23:00:26');

-- --------------------------------------------------------

--
-- Table structure for table `orders_list`
--

CREATE TABLE `orders_list` (
  `ol_id` int(11) NOT NULL,
  `ol_product_id` int(11) NOT NULL,
  `ol_order_id` int(11) NOT NULL,
  `ol_added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders_list`
--

INSERT INTO `orders_list` (`ol_id`, `ol_product_id`, `ol_order_id`, `ol_added_on`) VALUES
(1, 6, 5, '2018-06-17 20:15:06'),
(2, 13, 5, '2018-06-17 20:15:06'),
(3, 11, 5, '2018-06-17 20:15:06'),
(9, 6, 10, '2018-06-17 20:20:08'),
(10, 13, 10, '2018-06-17 20:20:08'),
(11, 11, 10, '2018-06-17 20:20:08'),
(12, 6, 11, '2018-06-17 20:21:14'),
(13, 13, 11, '2018-06-17 20:21:14'),
(14, 11, 11, '2018-06-17 20:21:14'),
(15, 6, 12, '2018-06-17 20:22:14'),
(16, 13, 12, '2018-06-17 20:22:14'),
(17, 11, 12, '2018-06-17 20:22:14'),
(18, 6, 13, '2018-06-17 20:28:40'),
(19, 13, 13, '2018-06-17 20:28:40'),
(20, 11, 13, '2018-06-17 20:28:40'),
(21, 6, 14, '2018-06-17 20:28:54'),
(22, 13, 14, '2018-06-17 20:28:54'),
(23, 11, 14, '2018-06-17 20:28:54'),
(24, 8, 15, '2018-06-17 20:29:55'),
(25, 4, 16, '2018-06-17 20:33:38'),
(26, 1, 17, '2018-06-17 20:34:55'),
(27, 3, 18, '2018-06-17 23:00:26'),
(28, 9, 18, '2018-06-17 23:00:26'),
(29, 13, 18, '2018-06-17 23:00:26');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(100) NOT NULL,
  `product_description` text NOT NULL,
  `product_image` varchar(150) NOT NULL,
  `product_category` int(11) DEFAULT NULL,
  `product_price` varchar(8) NOT NULL,
  `deleted` enum('true','false') NOT NULL DEFAULT 'false',
  `product_added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_description`, `product_image`, `product_category`, `product_price`, `deleted`, `product_added_on`) VALUES
(1, 'OnePlus 5T', '20MP+16MP primary dual camera and 16MP front facing camera\r\n15.26 centimeters (6.01-inch) capacitive touchscreen FHD Full Optic AMOLED 18:9 display with 2160 x 1080 pixels resolution. Cover Glass:2.5D Corning Gorilla Glass 5\r\nOxygenOS based on Android 7.1.1 Nougat with Qualcomm Snapdragon 835 octa core processor\r\n6 GB RAM, 64 GB internal memory and dual nano SIM dual-standby (4G+4G)\r\n3300mAH lithium Polymer battery with Dash Charge technology\r\nFace Unlock, Fingerprint scanner, all-metal unibody and NFC enabled\r\n1 year manufacturer warranty for device and in-box accessories including batteries from the date of purchase', 'be11951ce9146503.jpg', 1, '34000', 'false', '2018-06-15 19:21:56'),
(2, 'OnePlus 6', '20MP+16MP primary dual camera with OIS, Super Slow motion, Portrait mode and 16MP front facing camera\r\n15.95 centimeters (6.28-inch) FHD+ Full Optic AMOLED 19:9 display with 2280 x 1080 pixels resolution. 2.5D Corning Gorilla Glass 5\r\nOxygenOS based on Android Oreo 8.1 with Qualcomm Snapdragon 845 octa core processor\r\n6 GB RAM, 64 GB internal memory and dual nano SIM dual-standby (4G+4G)\r\n3300mAH lithium Polymer battery with Dash Charge technology\r\nFace Unlock, Fingerprint scanner, Water Resistant, Glass back and NFC enabled\r\n1 year manufacturer warranty for device and in-box accessories including batteries from the date of purchase', 'c46a92c1bf1ace35.jpg', 1, '38000', 'false', '2018-06-15 19:23:31'),
(3, 'Assassin\'s Creed', 'Experience the mysteries of ancient Egypt - Uncover lost tombs, explore the pyramids, and discover the secrets of mummies, the gods, and the last pharaohs.\r\nAn origin story - Start here, at the very beginning, with the never-before-told origin story of Assassin\'s Creed. You are Bayek, a protector of Egypt whose personal story will lead to the creation of the Assassin\'s Brotherhood.\r\nEmbrace action-RPG - Experience a completely new way to fight as you loot and use over one hundred weapons with different characteristics and rarities. Enjoy deep RPG progression mechanics, choose your preferred abilities and challenge your skills against unique and powerful bosses.\r\nEach quest is a memorable adventure - Pick and tackle quests at your own will and pace - each of them tells an intense and emotional story full of colorful characters and meaningful objectives\r\nExplore a full country - From deserts to lush oasis, from the Mediterranean Sea to the tombs of Giza, fight your way against dangerous factions and wild beasts as you explore this gigantic and unpredictable land', '2f3ed9d75d389cb4.jpg', 2, '1300', 'false', '2018-06-15 19:25:42'),
(4, 'Assassin\'s Creed PS3', 'Experience the mysteries of ancient Egypt - Uncover lost tombs, explore the pyramids, and discover the secrets of mummies, the gods, and the last pharaohs.\r\nAn origin story - Start here, at the very beginning, with the never-before-told origin story of Assassin\'s Creed. You are Bayek, a protector of Egypt whose personal story will lead to the creation of the Assassin\'s Brotherhood.\r\nEmbrace action-RPG - Experience a completely new way to fight as you loot and use over one hundred weapons with different characteristics and rarities. Enjoy deep RPG progression mechanics, choose your preferred abilities and challenge your skills against unique and powerful bosses.\r\nEach quest is a memorable adventure - Pick and tackle quests at your own will and pace - each of them tells an intense and emotional story full of colorful characters and meaningful objectives\r\nExplore a full country - From deserts to lush oasis, from the Mediterranean Sea to the tombs of Giza, fight your way against dangerous factions and wild beasts as you explore this gigantic and unpredictable land', 'a2212beb3c310d77.jpg', 3, '1000', 'false', '2018-06-15 19:26:17'),
(5, 'Call of Duty - PS4', 'Call of Duty returns to its roots with Call of Duty: WWII-a breathtaking experience that redefines World War II for a new gaming generation\r\nCall of Duty: WWII creates the definitive World War II next generation experience across three different game modes: Campaign, Multiplayer and Co-Operative\r\nFeaturing stunning visuals, the Campaign transports players to the European theatre as they engage in an all-new Call of Duty story set in iconic World War II battles. Land in Normandy on D-Day and battle across Europe through iconic locations in history\'s most monumental war\r\nMultiplayer marks a return to original, boots-on-the ground Call of Duty gameplay. Authentic weapons and traditional run-and-gun action immerse you in a vast array of World War II-themed locations. Experience classic Call of Duty combat, the bonds of camaraderie and the unforgiving nature of war against a global power throwing the world into tyranny', '23e45e28518aa3cf.jpg', 2, '2300', 'false', '2018-06-15 19:28:56'),
(6, 'Batman: Arkham City (PS3)', 'Developed By Rocksteady Studios, Batman: Arkham City Builds Upon The Intense, Atmospheric Foundation Of Batman: Arkham Asylum, Sending Players Soaring Into Arkham City, The New Maximum Security \"Home\" For All Of Gotham City\'S Thugs, Gangsters And Insane Criminal Masterminds. Set Inside The Heavily Fortified Walls Of A Sprawling District In The Heart Of Gotham City, This Highly Anticipated Sequel Introduces A Brand-New Story That Draws Together A New All-Star Cast Of Classic Characters And Murderous Villains From The Batman Universe, As Well As A Vast Range Of New And Enhanced Gameplay Features To Deliver The Ultimate Experience As The Dark Knight. Batman: Arkham City Is The Follow-Up To The Award-Winning Hit Video Game Batman: Arkham Asylum And Delivers An Authentic And Gritty Batman Experience Become The Dark Knight: Batman: Arkham City Delivers A Genuinely Authentic Batman Experience With Advanced, Compelling Gameplay On Every Level: High-Impact Street Brawls, Nail-Biting Stealth, Multifaceted Forensic Investigation, Epic Super-Villain Encounters And Unexpected Glimpses Into Batman\'S Tortured Psychology Advanced Freeflow Combat: Batman Faces Highly Coordinated, Simultaneous Attacks From Every Direction As Arkham\'S Gangs Bring Heavy Weapons And All-New Ai To The Fight, But Batman Steps It Up With Twice The Number Of Combat Animations And Double The Range Of Attacks, Counters And Takedowns New Gadgets: Batman Has Access To New Gadgets Such As The Cryptographic Sequencer V2 And Smoke Pellets, As Well As New Functionality For Existing Gadgets That Expand The Range Of Batman\'S Abilities Without Adding Extra Weight To His Utility Belt New Story: Five-Time Emmy-Award-Winner Paul Dini Returns To Pen A Brand-New Story For Batman: Arkham City, Taking Gamers Deep Inside The Diseased Heart Of Gotham Arkham Has Moved', '888b267a11c5e561.jpg', 3, '1200', 'false', '2018-06-15 19:30:33'),
(7, 'Watch Dogs 2 (PS4)', 'Explore a massive and dynamic open world - Experience an incredible variety of gameplay possibilities.\r\nHack everything- Every person, vehicle and connected device can be hacked. Take control of drones, cars, cranes and more to use them as your weapon.\r\nConnect with friends - Play Co-op and Player vs. Player activities in a seamless shared world.\r\nYou are in CTRL - Develop your skills and combine hacking, weapons and stealth to complete missions in ways that suit your playstyle.\r\nWelcome to the San Francisco Bay - Experience the winding streets of San Francisco, the vibrant neighborhoods of Oakland and cutting edge Silicon Valley.', '051a63275873277e.jpg', 2, '1600', 'false', '2018-06-15 19:31:55'),
(8, 'Call of Duty: WWII (Xbox One)', 'Call of Duty returns to its roots with Call of Duty: WWII-a breathtaking experience that redefines World War II for a new gaming generation\r\nCall of Duty: WWII creates the definitive World War II next generation experience across three different game modes: Campaign, Multiplayer and Co-Operative\r\nFeaturing stunning visuals, the Campaign transports players to the European theatre as they engage in an all-new Call of Duty story set in iconic World War II battles. Land in Normandy on D-Day and battle across Europe through iconic locations in history\'s most monumental war\r\nMultiplayer marks a return to original, boots-on-the ground Call of Duty gameplay. Authentic weapons and traditional run-and-gun action immerse you in a vast array of World War II-themed locations. Experience classic Call of Duty combat, the bonds of camaraderie and the unforgiving nature of war against a global power throwing the world into tyranny', '39202955ed70596d.jpg', 4, '3150', 'false', '2018-06-15 19:33:09'),
(9, 'Tomb Raider - (PS3)', 'Online only and requires a PlayStation Plus membership\r\nAn incredible story set within a newly-imagined, always-connected universe filled with action and adventure\r\nCreate your character, forge your legend by defeating powerful foes, earn unique, customizable weapons, gear and vehicles\r\nUnprecedented variety of FPS gameplay that redefines the genre and breaks traditional conventions of story, cooperative and competitive multiplayer modes\r\n31 Gb Updates needed for playing the game.', '1507450e49e8d493.jpg', 3, '2840', 'false', '2018-06-15 19:34:34'),
(10, 'Assassin\'s Creed Origins (Xbox One)', 'Experience the mysteries of ancient Egypt - Uncover lost tombs, explore the pyramids, and discover the secrets of mummies, the gods, and the last pharaohs.\r\nAn origin story - Start here, at the very beginning, with the never-before-told origin story of Assassin\'s Creed. You are Bayek, a protector of Egypt whose personal story will lead to the creation of the Assassin\'s Brotherhood.\r\nEmbrace action-RPG - Experience a completely new way to fight as you loot and use over one hundred weapons with different characteristics and rarities. Enjoy deep RPG progression mechanics, choose your preferred abilities and challenge your skills against unique and powerful bosses.\r\nEach quest is a memorable adventure - Pick and tackle quests at your own will and pace - each of them tells an intense and emotional story full of colorful characters and meaningful objectives\r\nExplore a full country - From deserts to lush oasis, from the Mediterranean Sea to the tombs of Giza, fight your way against dangerous factions and wild beasts as you explore this gigantic and unpredictable land', '47d3595cb78ec5e0.jpg', 4, '3390', 'false', '2018-06-15 19:35:50'),
(11, 'Lenovo Tab4 10 Tablet (10.1 inch,16GB,Wi-Fi + 4G LTE) Slate Black', 'Sim card slot: 1 (Only for data connectivity, no voice calling option available)\r\n5MP Auto Focus rear camera and 2MP front facing camera\r\n25.654 centimeters (10.1 inch) HD IPS 10 point multi-touch capacitive touchscreen with 1280 x 800 pixels resolution\r\nAndroid v7.0 Nougat operating system with 1.4GHz 64-bit Qualcomm Snapdragon MSM8917 quad core processor, 2GB RAM, 16GB internal memory and single SIM (Data Only)\r\n7000mAH lithium-ion battery providing talk-time of 10 hours\r\n1 year manufacturer warranty for device and 6 months manufacturer warranty for in-box accessories including batteries from the date of purchase', '4bd31fc724c313d4.jpg', 7, '15350', 'false', '2018-06-15 19:37:05'),
(12, 'Dragon Ball Xenoverse 2(Nintendo Switch)', 'Switch specific controls and functionality, for example perform the Kamehameha and Spirit Bomb with the Joy Con Motion Controls\r\n6 player local play mode (additional Nintendo Switch units are required)\r\nUse individual Joy-Con controllers to play the game with a friend locally\r\nRelive the Dragon Ball story by time traveling and protecting historic moments in the Dragon Ball Universe\r\nMore in-depth Avatar creation system and battle adjustments compared to DRAGON BALL XENOVERSE', 'dfd9b2f75db4bcc4.jpg', 5, '3900', 'false', '2018-06-15 19:38:18'),
(13, 'Apple MJLQ2HN/A 15.4-inch Laptop (Core i7/16GB/256GB/Mac OS/Integrated Graphics)', 'Intel core_i7 processor\r\n16GB DDR3 SDRAM\r\n256GB hard drive\r\n15.4-inch screen, Intel Integrated Graphics\r\nMac OS operating system\r\n2.0kg laptop', 'e297d3b67988a6dc.jpg', 8, '144990', 'false', '2018-06-15 19:39:48');

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `staff_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('admin','staff') NOT NULL,
  `staff_created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`staff_id`, `username`, `password`, `role`, `staff_created_on`) VALUES
(1, 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'admin', '2018-06-15 19:14:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(80) NOT NULL,
  `address` varchar(250) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `user_created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `address`, `email`, `password`, `mobile`, `user_created_on`) VALUES
(1, 'Angelina Lily', 'California', 'angel.lily@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '+198234567890', '2018-06-09 20:55:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_user_id` (`order_user_id`);

--
-- Indexes for table `orders_list`
--
ALTER TABLE `orders_list`
  ADD PRIMARY KEY (`ol_id`),
  ADD KEY `ol_product_id` (`ol_product_id`),
  ADD KEY `ol_order_id` (`ol_order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_category` (`product_category`),
  ADD KEY `deleted` (`deleted`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile` (`mobile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders_list`
--
ALTER TABLE `orders_list`
  MODIFY `ol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`order_user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `orders_list`
--
ALTER TABLE `orders_list`
  ADD CONSTRAINT `orders_list_fk_order` FOREIGN KEY (`ol_order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `orders_list_fk_product` FOREIGN KEY (`ol_product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `product_cat_fk` FOREIGN KEY (`product_category`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL ON UPDATE CASCADE;
