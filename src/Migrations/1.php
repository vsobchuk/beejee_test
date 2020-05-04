<?php
//does not makes sence to play here will classes and extensions - it will take more time and text ;)
//for test task it is ok, for PROD its not :)
require __DIR__ .'/../../vendor/autoload.php';

$pdo = \Core\DB\MySQL::getInstance()->getPdo();
$sql = <<<EOT
CREATE TABLE task (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_name` varchar (64) NOT NULL,
  `email` varchar (512) NOT NULL,
  `instructions` text NOT NULL,
  `is_completed` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
);

CREATE TABLE user (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` varchar (64) NOT NULL,
  `pass` varchar (64) NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO user (login, pass) VALUES ("admin", "202cb962ac59075b964b07152d234b70");
EOT;

var_dump($pdo->exec($sql));