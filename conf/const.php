<?php
define('DB_NAME', 'onlineShop'); //DBの名前
define('DB_USER', 'root'); //DBのユーザ名
define('DB_PASSWORD', 'root'); //DBのパスワード
define('DSN', 'mysql:dbname='.DB_NAME.';host=localhost;charset=utf8'); //Mysqlのdsn
define('DB_CHARSET', 'SET NAMES utf8mb4'); //Mysqlの文字コード
define('OPTION', 'PDO::MYSQL_ATTR_INIT_COMMAND => DB_CHARSET,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES => false');//option