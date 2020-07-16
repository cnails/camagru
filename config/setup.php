<?php
    include("database.php");

    try {
        $db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec("CREATE DATABASE IF NOT EXISTS camagru; USE camagru");
    } catch(PDOException $e) {
        echo "Error while creating database - ".$e->getMessage();
        die();
    }

    $postTable = "CREATE TABLE IF NOT EXISTS `post` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `author` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
        `likes` int(11) NOT NULL,
        `comments` int(11) NOT NULL,
        `img` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB;";

    $comTable = "CREATE TABLE IF NOT EXISTS `comments` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `post_id` int(11) NOT NULL,
        `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
        `author` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB;";
      
      $userTable = "CREATE TABLE IF NOT EXISTS `user` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
        `pwd` varchar(130) COLLATE utf8mb4_unicode_ci NOT NULL,
        `email` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `confirm` tinyint(1) DEFAULT NULL,
        `token` varchar(105) COLLATE utf8mb4_unicode_ci NOT NULL,
        `notif` tinyint(1) NOT NULL,
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB;";

        $notifTable = "CREATE TABLE IF NOT EXISTS `notif` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `user_id` int(11) NOT NULL,
            `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
            `author` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
            `post_id` int(11) NOT NULL,
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB;";

    $db->exec($userTable . $comTable . $postTable . $notifTable);
    echo "Database was created";
?>
