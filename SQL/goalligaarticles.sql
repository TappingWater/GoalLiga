-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 03, 2019 at 03:48 PM
-- Server version: 5.6.45
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `goalligaarticles`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `club` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `body` text NOT NULL,
  `notify` tinyint(1) NOT NULL,
  `comments` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `dislikes` int(11) NOT NULL,
  `author_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `author`, `club`, `img`, `date`, `body`, `notify`, `comments`, `likes`, `dislikes`, `author_id`) VALUES
(1, 'Hazard scores debut goal', 'ChanakaP', 'Atletico Madrid', 'https://images.daznservices.com/di/library/GOAL/80/ee/eden-hazard-sergio-ramos-real-madrid_12rqze76t8rph144xd42mfsybg.jpg?t=-1606818675&quality=60&w=1600', '2019-11-01 05:32:31', 'Real Madrid fans had been critical of Eden Hazard for not scoring or assisting yet this season, but the Belgian forward provided the goods in stylistic fashion to get off the mark on Matchday 8 against second-place Granada.\r\n\r\nPreaching patience was key when it came to Eden Hazard, who had shown flashes of brilliance since debuting in the lineup post-injury against Levante a few weeks ago. But Hazard didn\'t provide an end product for Real Madrid in several games, failing to score, assist, or otherwise truly impose himself on a game like a nine-figure transfer should.\r\n\r\nBut the former Chelsea superstar slowly started to put it all together in the first half against Granada. This was a crucial game for Real, who had recently suffered a humiliating 2-2 draw to Clb Brugge in front of their home supporters.\r\n\r\nReal got off the mark early against the team one point behind them in the table, and Hazard finished off the half in style with a wonderful chip to beat Granadaï¿½s quality goalkeeper Rui Silva.\r\n\r\nThat is an absolutely splendid finish from Hazard, who showed his individual quality with this goal. What a way to score your first goal in a Real Madrid kit ï¿½ and at the Bernabeu against the team directly behind Real in the table, no less.\r\n\r\nHazard had been popping up in central areas and on the right in this game, as Zinedine Zidane unleashed a more involved Hazard against Granada. His confidence is visibly growing, as evidenced by his excellent goal, in addition to his dangerous ball to Gareth Bale that could have resulted in a penalty for Los Blancos.\r\n\r\nIt will be exciting to see what Hazard does next, and this goal will be huge in relieving the pressure from the fans and from the player onto himself. Hazard is world class, and this goal is a reminder of what he can do.', 0, 3, 40, 3, 1),
(2, '\r\nDiego Costa could leave Atletico Madrid', 'ChanakaP', 'Atletico Madrid', 'https://e1.365dm.com/19/07/768x432/skysports-diego-costa-costa_4729408.jpg?20190727072420', '2019-11-01 05:37:29', 'Atletico Madrid forward Diego Costa is reportedly unhappy at the club and is keen to move to the Chinese Super League.\r\n\r\nAccording to El Mundo (h/t Football Espana), the former Chelsea man isn\'t content with his contract in comparison to star striker Antoine Griezmann.\r\n\r\nCosta is said to earn around $8.5 million ($7.6 million) every year with the Madrid outfit, whereas the new deal Griezmann signed in the summer sees him take home a staggering €25 million (£22.25 million).\r\n\r\nIt\'s added that Costa has asked his agent to look into possible destinations for him as a result, most notably a January move to China. However, despite Costa\'s discontent at the Wanda Metropolitano, he will not actively push for a move away from the club.\r\n\r\nCosta is in his second spell at Atletico, having arrived at the club from Chelsea last season. He was only permitted to play from January onwards, though, as the Madrid outfit were serving a transfer ban.\r\n\r\nAlthough Costa has been his typically bullish self at the point of the attack, the goals have dried up for him.\r\n\r\nHe\'s on the longest goalscoring drought of his career, with the stalemate against Madrid the latest fixture in which he\'s failed to hit the back of the net in the league.', 0, 34, 240, 23, 1),
(3, '\r\nReal madrid interested in Van De Beek', 'ChanakaP', 'Real Madrid', 'https://images.daznservices.com/di/library/GOAL/b8/a8/donny-van-de-beek-ajax_swob720tsahlzvw2thzzf2ji.jpg?t=1443790044&quality=60&w=1600', '2019-11-01 05:34:36', '\r\n\r\nDonny van de Beek has said there is \"a very good chance\" he will stay at Ajax despite interest from Real Madrid. \r\n\r\nThe 22-year-old recently confirmed to Fox Sports (h/t Carlos Forjanes of AS) the Spanish giants \"are interested\" in signing him.\r\n\r\nHe has emerged as a midfield target for Los Blancos after moves for Manchester United\'s Paul Pogba and Tottenham Hotspur\'s Christian Eriksen failed to materialise.\r\n\r\nBut it now looks as though Real could miss out on Van de Beek also after he said he could well remain at Ajax, per Ziggo Sport (h/t Goal\'s Joe Wright):\r\n\r\n\"[Real are] a fantastic club, but Ajax are too. I\'ve nothing to complain about in that regard. There\'s a very good chance I\'ll continue playing here, but nothing is certain yet.\"\r\n\r\nThe Dutchman added that he hopes his future will be resolved soon as he is \"a bit fed up with all the questions about it.\"\r\n\r\nVan de Beek played a key role in Ajax\'s superb 2018-19 season, where they won the Eredivisie for the first time since 2014 and made the semi-finals of the UEFA Champions League.', 0, 6, 20, 1, 1),
(4, 'FIFA insist Lionel Messi\'s award for best men\'s player was not rigged', 'ChanakaP', 'FC Barcelona', 'https://images.daznservices.com/di/library/GOAL/67/2c/anil-murthy-valencia_1p3y6tmebkqy21ww5oti0u82e6.jpg?t=-1577036611&quality=60&w=1600', '2019-11-01 05:36:13', 'FIFA insists the voting process for The Best awards was entirely above board after claims it was fixed in favour of Barcelona star Lionel Messi.\r\n\r\nThe Argentinian won the vote at the ceremony in Milan on Monday night ahead of Juventus superstar Cristiano Ronaldo and Liverpool defender Virgil van Dijk.\r\nDelegates and players connected to various federations claimed their votes were either not counted or had been changed.\r\n\r\nA statement from football\'s world governing body released on Friday afternoon read: \"FIFA has been disappointed to see a number of reports in the media questioning the integrity of the voting process for the awards.\r\n\r\n\"These reports are unfair and misleading. The voting procedure for each of the awards is supervised and monitored by an independent observer, in this case PricewaterhouseCoopers (PwC) Switzerland.\"\r\n\r\nThe statement added that member associations had been asked to submit forms both electronically and as hard copies.\r\n\r\n\"The written documents must also be signed by the responsible persons of the association as well as by the persons authorised to vote,\" the statement continued.', 0, 3, 49, 2, 1),
(6, 'Carlos Puyol rejects Barcelona sporting director role', 'ChanakaP', 'Real Madrid', 'https://e2.365dm.com/16/01/768x432/carles-puyol-barcelona_3397679.jpg?20160111100554', '2019-11-01 05:40:03', 'Former Barcelona captain Carles Puyol has rejected the chance to rejoin the club as a general manager in place of Pep Segura who left in July by mutual consent.\r\n\r\nPresident Josep Maria Bartomeu said this month he was hopeful of convincing Puyol to return to Camp Nou, where he played as a defender for his entire career, between 1999 and 2014.\r\n\r\n\"After thinking about it a lot I decided not to accept the club\'s offer,\" Puyol said on Twitter on Wednesday.\r\n\r\n\"It was not an easy decision, I always said I would like to return to the place I consider my home, but various personal projects I find myself immersed in at the moment would stop me from giving the exclusive dedication this role deserves.\"\r\n\r\nPuyol would have worked at Barca alongside sporting director Eric Abidal and director of youth football Patrick Kluivert, both former team mates. test2\r\n\r\n\r\nRead more at https://www.thestar.com.my/sport/football/2019/09/26/puyol-rejects-barcelona-sporting-director-role#zRS3f1xmzv64Uaha.99fdf', 0, 34, 240, 23, 1),
(20, 'first post', 'james123', 'Real Madrid', 'https://e00-marca.uecdn.es/assets/multimedia/imagenes/2019/11/13/15736749654454.jpg', '2019-11-16 11:03:49', 'test', 0, 0, 0, 0, 20);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_type` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `story_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_type`, `date_created`, `user_id`, `story_id`) VALUES
(5, 1, '0000-00-00 00:00:00', 1, 1),
(6, 2, '0000-00-00 00:00:00', 1, 2),
(7, 3, '0000-00-00 00:00:00', 1, 0),
(8, 11, '0000-00-00 00:00:00', 7, NULL),
(9, 12, '2019-11-16 06:02:00', 7, NULL),
(10, 1, '0000-00-00 00:00:00', 1, 2),
(11, 2, '2019-11-16 06:26:57', 1, 3),
(12, 3, '2019-11-16 06:27:01', 1, NULL),
(13, 11, '2019-11-16 08:24:13', 0, NULL),
(15, 11, '2019-11-16 08:29:22', 15, NULL),
(21, 2, '2019-11-16 10:17:12', 1, 6),
(25, 11, '2019-11-16 10:30:38', 19, NULL),
(26, 1, '2019-11-16 10:32:04', 19, 14),
(27, 2, '2019-11-16 10:32:23', 19, 14),
(28, 3, '2019-11-16 10:32:41', 19, NULL),
(29, 1, '2019-11-16 10:32:56', 19, 15),
(30, 12, '2019-11-16 10:33:29', 19, NULL),
(31, 3, '2019-11-16 10:33:47', 1, NULL),
(37, 3, '2019-11-16 10:38:17', 1, NULL),
(39, 3, '2019-11-16 10:47:23', 19, NULL),
(40, 11, '2019-11-16 11:02:46', 20, NULL),
(41, 1, '2019-11-16 11:03:49', 20, 20),
(42, 2, '2019-11-16 11:04:12', 20, 20),
(44, 3, '2019-11-16 11:05:01', 20, NULL),
(45, 11, '2019-11-16 11:05:27', 20, NULL),
(50, 3, '2019-11-16 23:43:08', 20, NULL),
(74, 3, '2019-11-28 22:44:29', 20, 0),
(119, 11, '2019-11-29 14:18:26', 29, 0),
(120, 12, '2019-11-29 14:56:46', 15, 0),
(121, 2, '2019-11-29 15:05:18', 1, 6),
(122, 2, '2019-11-29 15:09:18', 1, 6),
(124, 3, '2019-11-29 15:09:47', 1, 0),
(126, 3, '2019-11-29 15:10:48', 1, 0),
(130, 11, '2019-11-30 15:52:00', 33, 0),
(132, 3, '2019-12-01 00:41:48', 1, 0),
(134, 3, '2019-12-01 01:22:25', 1, 0),
(136, 3, '2019-12-01 01:30:29', 1, 0),
(138, 3, '2019-12-01 01:35:19', 1, 0),
(141, 12, '2019-12-01 15:08:39', 30, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0',
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `favoriteClub` varchar(40) NOT NULL,
  `firstName` varchar(40) NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`, `date_registered`, `favoriteClub`, `firstName`, `lastName`, `email`) VALUES
(1, 'ChanakaP', 'password', 1, '2019-11-15 04:13:24', '', '', '', ''),
(7, 'ca', 'casdsa', 1, '2019-11-15 07:31:36', 'Real Madrid', 'Chanaka', 'Perera', 'dsads'),
(8, 'adsd', 'adasdsa', 0, '2019-11-15 07:33:52', 'Real Madrid', '', '', 'dasd'),
(15, 'new', 'new', 0, '2019-11-16 08:29:22', 'Real Madrid', 'new1', 'new2', 'new@rma'),
(19, 'new123', 'new', 1, '2019-11-16 10:30:38', 'Real Madrid', 'caasdsa', 'casdsadsa', 'new123@gam'),
(20, 'james123', 'face', 1, '2019-11-16 11:02:46', 'Real Madrid', 'james', '123', 'james123@gmail.com'),
(29, 'test', 'test', 0, '2019-11-29 14:18:26', 'Real Madrid', 'test', 'test', 'test'),
(30, 'dsd', 'sd', 1, '2019-11-30 13:25:39', 'Real Madrid', 'sd', 'ds', 'ds'),
(33, 'ggggggggggggggggg', 'gggggggggggg', 0, '2019-11-30 15:52:00', 'FC Barcelona', 'gggggggggggggg', 'ggggggggggg', 'gggggggggggg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`user_id`),
  ADD KEY `articleID` (`story_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
