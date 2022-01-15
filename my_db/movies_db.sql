-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2018 at 05:56 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movies_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`) VALUES
(1, 'Drama'),
(2, 'Action'),
(3, 'History'),
(4, 'Mystery');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `movie_id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `cover` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `director` varchar(20) NOT NULL,
  `year` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `stars` varchar(80) NOT NULL,
  `trailer` varchar(50) DEFAULT NULL,
  `storyline` varchar(5000) DEFAULT NULL,
  `price` float NOT NULL,
  `stock_quantity` int(255) NOT NULL DEFAULT '0',
  `hot` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`movie_id`, `name`, `description`, `cover`, `category_id`, `director`, `year`, `duration`, `stars`, `trailer`, `storyline`, `price`, `stock_quantity`, `hot`) VALUES
(1, 'V for Vendetta', 'In a future British tyranny, a shadowy freedom fighter, known only by the alias of V, plots to overthrow it with the help of a young woman.', '../my_images/v_for_vendetta.jpg', 1, 'James McTeigue', 2005, 132, 'Hugo Weaving, Natalie Portman, Rupert Graves', 'https://www.youtube.com/embed/lSA7mAHolAw', 'Tells the story of Evey Hammond and her unlikely but instrumental part in bringing down the fascist government that has taken control of a futuristic Great Britain. Saved from a life and death situation by a man in a Guy Fawkes mask who calls himself V, she learns a general summary of V s past and, after a time, decides to help him bring down those who committed the atrocities that led to Britain being in the shape that it is in.', 9.99, 34, 4),
(2, 'A Beautiful Mind', 'After John Nash, a brilliant but asocial mathematician, accepts secret work in cryptography, his life takes a turn for the nightmarish.', '../my_images/a_beautiful_mind.jpg', 1, 'Ron Howard', 2001, 135, 'Russell Crowe, Ed Harris, Jennifer Connelly', 'https://www.youtube.com/embed/WFJgUm7iOKw', 'From the heights of notoriety to the depths of depravity, John Forbes Nash, Jr. experienced it all. A mathematical genius, he made an astonishing discovery early in his career and stood on the brink of international acclaim. But the handsome and arrogant Nash soon found himself on a painful and harrowing journey of self discovery. After many years of struggle, he eventually triumphed over his tragedy, and finally,  late in life, received the Nobel Prize.', 12.99, 9, 5),
(3, 'The Best Offer', 'A master auctioneer becomes obsessed with an extremely reclusive heiress who collects fine art.', '../my_images/the_best_offer.jpg', 1, 'Giuseppe Tornatore', 2013, 131, 'Geoffrey Rush, Jim Sturgess, Sylvia Hoeks', 'https://www.youtube.com/embed/zJGleGyahC8', 'In the world of high end art auctions and antiques, Virgil Oldman is an elderly and esteemed but eccentric genius art-expert, known and appreciated by the world. Oldman is hired by a solitary young heiress, Claire Ibbetson, to auction off the large collection of art and antiques left to her by her parents. For some reason, Claire always refuses to be seen in person. Robert aids Oldman in restoring and reassembling some odd mechanical parts he finds amongst Claire s belongings, while also giving him advice on how to befriend her and deal with his feelings towards her. Also a friend of Oldman, Billy Whistler helps him to acquire a secret private collection of master paintings.', 11.99, 39, 2),
(4, 'Schindler''s List', 'In Poland during World War II, Oskar Schindler gradually becomes concerned for his Jewish workforce after witnessing their persecution by the Nazis.', '../my_images/schindlers_list.jpg', 3, 'Steven Spielberg', 1993, 195, 'Liam Neeson, Ralph Fiennes, Ben Kingsley', 'https://www.youtube.com/embed/gG22XNhtnoY', 'Oskar Schindler is a vainglorious and greedy German businessman who becomes an unlikely humanitarian amid the barbaric German Nazi reign when he feels compelled to turn his factory into a refuge for Jews. Based on the true story of Oskar Schindler who managed to save about 1100 Jews from being gassed at the Auschwitz concentration camp, it is a testament to the good in all of us.', 14.99, 43, 1),
(5, 'The Eagle', 'In Roman-ruled Britain, a young Roman soldier endeavors to honor his father s memory by finding his lost legion s golden emblem.', '../my_images/the_eagle.jpg', 3, 'Kevin Macdonald', 2011, 114, 'Channing Tatum, Jamie Bell, Donald Sutherland', 'https://www.youtube.com/embed/3TLYO2I5kgw', 'In 140 AD, twenty years after the unexplained disappearance of the entire Ninth Legion in the mountains of Scotland, young centurion Marcus Aquila (Tatum) arrives from Rome to solve the mystery and restore the reputation of his father, the commander of the Ninth. Accompanied only by his British slave Esca (Bell), Marcus sets out across Hadrian''s Wall into the uncharted highlands of Caledonia - to confront its savage tribes, make peace with his father s memory, and retrieve the lost legion s golden emblem, the Eagle of the Ninth.', 8.99, 0, 0),
(6, 'Gladiator', 'When a Roman general is betrayed and his family murdered by an emperor s corrupt son, he comes to Rome as a gladiator to seek revenge.', '../my_images/gladiator.jpg', 3, 'Ridley Scott', 2000, 155, 'Russell Crowe, Joaquin Phoenix, Connie Nielsen', 'https://www.youtube.com/embed/Q-b7B8tOAQU', 'Maximus is a powerful Roman general, loved by the people and the aging Emperor, Marcus Aurelius. Before his death, the Emperor chooses Maximus to be his heir over his own son, Commodus, and a power struggle leaves Maximus and his family condemned to death. The powerful general is unable to save his family, and his loss of will allows him to get captured and put into the Gladiator games until he dies. The only desire that fuels him now is the chance to rise to the top so that he will be able to look into the eyes of the man who will feel his revenge.', 14.99, 21, 1),
(7, 'Inception', 'A thief, who steals corporate secrets through use of dream-sharing technology, is given the inverse task of planting an idea into the mind of a CEO.', '../my_images/inception.jpg', 2, 'Christopher Nolan', 2010, 148, 'Leonardo DiCaprio, Joseph Gordon-Levitt, Ellen Page', 'https://www.youtube.com/embed/YoHD9XEInc0', 'Dom Cobb is a skilled thief, the absolute best in the dangerous art of extraction, stealing valuable secrets from deep within the subconscious during the dream state, when the mind is at its most vulnerable. Cobb s rare ability has made him a coveted player in this treacherous new world of corporate espionage, but it has also made him an international fugitive and cost him everything he has ever loved. Now Cobb is being offered a chance at redemption. One last job could give him his life back but only if he can accomplish the impossible - inception. Instead of the perfect heist, Cobb and his team of specialists have to pull off the reverse: their task is not to steal an idea but to plant one. If they succeed, it could be the perfect crime. But no amount of careful planning or expertise can prepare the team for the dangerous enemy that seems to predict their every move. An enemy that only Cobb could have seen coming.', 16.99, 7, 4),
(8, 'Interstellar', 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity s survival.', '../my_images/interstellar.jpg', 4, 'Christopher Nolan', 2014, 169, 'Matthew McConaughey, Anne Hathaway, Jessica Chastain', 'https://www.youtube.com/embed/Lm8p5rlrSkY', 'In the near future, Earth has been devastated by drought and famine, causing a scarcity in food and extreme changes in climate. When humanity is facing extinction, a mysterious rip in the space-time continuum is discovered, giving mankind the opportunity to widen its lifespan. A group of explorers must travel beyond our solar system in search of a planet that can sustain life. The crew of the Endurance are required to think bigger and go further than any human in history as they embark on an interstellar voyage into the unknown. Coop, the pilot of the Endurance, must decide between seeing his children again and the future of the human race.', 15.99, 35, 0),
(9, 'Ex Machina', 'A young programmer is selected to participate in a ground-breaking experiment in synthetic intelligence by evaluating the human qualities of a breath-taking humanoid A.I.', '../my_images/ex_machina.jpg', 4, 'Alex Garland', 2015, 108, 'Alicia Vikander, Domhnall Gleeson, Oscar Isaac', 'https://www.youtube.com/embed/PI8XBKb6DQk', 'Caleb, a 26 year old programmer at the world s largest internet company, wins a competition to spend a week at a private mountain retreat belonging to Nathan, the reclusive CEO of the company. But when Caleb arrives at the remote location he finds that he will have to participate in a strange and fascinating experiment in which he must interact with the world s first true artificial intelligence, housed in the body of a beautiful robot girl.', 12.99, 33, 1),
(10, 'Mr. Nobody', 'A boy stands on a station platform as a train is about to leave. Should he go with his mother or stay with his father? Infinite possibilities arise from this decision. As long as he doesn t choose, anything is possible.', '../my_images/mr_nobody.jpg', 4, 'Jaco Van Dormael', 2009, 141, 'Jared Leto, Sarah Polley, Diane Kruger', 'https://www.youtube.com/embed/vXf3gVYXlHg', 'In the year 2092, one hundred eighteen year old Nemo is recounting his life story to a reporter. He is less than clear, often times thinking that he is only thirty-four years of age. But his story becomes more confusing after he does focus on the fact of his current real age. He tells of his life at three primary points in his life: at age nine (when his parents divorced), age sixteen and age thirty-four. The confusing aspect of the story is that he tells of alternate life paths, often changing course with the flick of a decision at each of those ages. One life path has him ultimately married to Elise, a depressed woman who never got over the unrequited love she had for a guy named Stefano when she was a teenager and who asked Nemo to swear that when she died he would sprinkle her ashes on Mars. A second life path has him married to Jean. Their life is one of luxury but one also of utter boredom. And a third life path has him in a torrid romance with his step-sister Anna, the two who,...', 10.99, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `movies_ids` varchar(1024) NOT NULL,
  `movies_names` varchar(1024) NOT NULL,
  `movies_price` varchar(1024) NOT NULL,
  `movies_quantity` varchar(1024) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(80) NOT NULL,
  `total_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `movies_ids`, `movies_names`, `movies_price`, `movies_quantity`, `user_id`, `user_name`, `total_price`) VALUES
(1, '2, 1', 'A Beautiful Mind, V for Vendetta', '12.99, 9.99', '1, 1', 7, 'panos', 22.98),
(2, '1, 2, 3', 'V for Vendetta, A Beautiful Mind, The Best Offer', '9.99, 12.99, 11.99', '1, 1, 1', 7, 'panos', 34.97),
(3, '2, 1, 4, 6', 'A Beautiful Mind, V for Vendetta, Schindler, Gladiator', '12.99, 9.99, 14.99, 14.99', '1, 1, 1, 1', 7, 'panos', 52.96),
(4, '9', 'Ex Machina', '12.99', '1', 1, 'Margy', 12.99),
(5, '2, 7', 'A Beautiful Mind, Inception', '12.99, 16.99', '1, 1', 7, 'panos', 29.98),
(6, '1, 2, 3', 'V for Vendetta, A Beautiful Mind, The Best Offer', '9.99, 12.99, 11.99', '1, 1, 1', 7, 'panos', 34.97),
(7, '7', 'Inception', '16.99', '2', 3, 'KyriazisGGOP', 33.98),
(8, '7', 'Inception', '16.99', '1', 4, 'Telelele', 16.99);

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `rate_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`rate_id`, `movie_id`, `user_id`, `rate`) VALUES
(1, 1, 1, 7),
(3, 1, 4, 5),
(4, 1, 3, 5),
(5, 7, 7, 7),
(6, 2, 7, 7),
(7, 3, 7, 6),
(8, 4, 7, 8),
(9, 5, 7, 6),
(10, 6, 7, 8),
(11, 8, 7, 8),
(12, 9, 7, 5),
(13, 10, 7, 7),
(14, 1, 7, 7),
(15, 2, 3, 5),
(16, 2, 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review` varchar(1024) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `movie_id`, `user_id`, `review`) VALUES
(1, 1, 7, 'Great movie!'),
(2, 1, 1, 'Absolutely great cast, i rated 7'),
(3, 1, 3, 'A great movie indeed, I don''t know what what Telelele is talking about.'),
(4, 1, 4, 'This movie could have been better...');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(80) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `email` varchar(80) NOT NULL,
  `sex` varchar(20) NOT NULL,
  `age` int(11) NOT NULL DEFAULT '0',
  `proffesion` varchar(80) DEFAULT NULL,
  `type` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `name`, `surname`, `email`, `sex`, `age`, `proffesion`, `type`) VALUES
(1, 'Margy', '1234', 'Argyro', 'Maurogiorgou', 'margy@unipi.gr', 'Female', 24, 'Lab Teacher', 0),
(3, 'KyriazisGGOP', '1234', 'Dimos', 'Kyriazis', 'Kyrizis@unipi.gr', 'Male', 32, 'University Proffesor', 0),
(4, 'Telelele', '1234', 'Orestis', 'telelis', 'telelis@unipi.gr', 'Male', 33, 'University Proffesor', 0),
(7, 'panos', '1234', 'Panagiotis', 'Stathopoulos', 'panagiotisstathopoulos1@gmail.com', 'Male', 21, 'University Student', 0),
(8, 'admin', 'admin', '0', '0', '0', '0', 0, NULL, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `viewrate`
--
CREATE TABLE `viewrate` (
`movie_id` int(11)
,`counts` bigint(21)
,`AVGrates` decimal(14,4)
);

-- --------------------------------------------------------

--
-- Structure for view `viewrate`
--
DROP TABLE IF EXISTS `viewrate`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewrate`  AS  select `rate`.`movie_id` AS `movie_id`,count(`rate`.`user_id`) AS `counts`,avg(`rate`.`rate`) AS `AVGrates` from `rate` group by `rate`.`movie_id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`movie_id`),
  ADD KEY `fk_movie_category` (`category_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`rate_id`),
  ADD UNIQUE KEY `movie_id` (`movie_id`,`user_id`),
  ADD KEY `fk_rate_USER` (`user_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD UNIQUE KEY `movie_id` (`movie_id`,`user_id`),
  ADD KEY `fk_review_user` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `rate`
--
ALTER TABLE `rate`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `movie`
--
ALTER TABLE `movie`
  ADD CONSTRAINT `fk_movie_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `rate`
--
ALTER TABLE `rate`
  ADD CONSTRAINT `FK_RATE_MOVIES` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`movie_id`),
  ADD CONSTRAINT `fk_rate_USER` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `FK_review_MOVIES` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`movie_id`),
  ADD CONSTRAINT `fk_review_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
