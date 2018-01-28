CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `username` varchar(512) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `executed` tinyint(2) NOT NULL DEFAULT '0',
  `text` text CHARACTER SET latin1 NOT NULL,
  `image` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;