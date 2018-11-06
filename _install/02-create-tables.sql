CREATE TABLE IF NOT EXISTS `task` (
    `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `username` varchar(255) NOT NULL DEFAULT '',
    `email` varchar(255) NOT NULL DEFAULT '',
    `comments` text,
    `image` varchar(255) NOT NULL DEFAULT '',
    `status` boolean NOT NULL DEFAULT false
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `admin` (
    `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `login` varchar(255) NOT NULL DEFAULT '',
    `password` varchar(255) NOT NULL DEFAULT '',
    `email` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 
