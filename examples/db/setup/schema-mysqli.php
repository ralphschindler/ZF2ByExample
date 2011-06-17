<?php

$ini = new Zend\Config\Ini(__DIR__ . '/../config-mysqli.ini');

$config = $ini->db->driver->connectionParams->toArray();
$mysqli = new Mysqli(
    null,
    $config['username'],
    $config['password'],
    $config['dbname']
);

$mysqli->query(<<<EOS
CREATE TABLE IF NOT EXISTS `artist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `history` text,
  PRIMARY KEY (`id`)
)
EOS
);

$mysqli->query(<<<EOS
INSERT INTO `artist` (`id`, `name`, `history`) VALUES
(1, 'Foo Artist', 'This is the history of artist foo.'),
(2, 'Bar Artist', NULL);
EOS
);