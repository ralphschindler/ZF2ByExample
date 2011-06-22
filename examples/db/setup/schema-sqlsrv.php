<?php

$ini = new Zend\Config\Ini(__DIR__ . '/../config-sqlsrv.ini');

$config = $ini->db->driver->connectionParams->toArray();
$sqlsrv = sqlsrv_connect('.\SQLEXPRESS', $config);

sqlsrv_query($sqlsrv, 'DROP TABLE artist');

$q = sqlsrv_query($sqlsrv, <<<EOS
CREATE TABLE artist (
  [id] INT NOT NULL IDENTITY,
  [name] NVARCHAR(255) NOT NULL,
  [history] TEXT,
  PRIMARY KEY ([id])
)
EOS
);

$q = sqlsrv_query($sqlsrv, <<<EOS
INSERT INTO artist ([name], [history]) VALUES
('Foo Artist', 'This is the history of artist foo.'),
('Bar Artist', NULL);
EOS
);

var_dump($q); var_dump(sqlsrv_errors());
