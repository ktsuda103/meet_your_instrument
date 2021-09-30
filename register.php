<?php
session_start();
require_once './conf/const.php';
require_once './model/common.php';
require_once './model/register.php';

if(isset($_SESSION)){
    $user_data = $_SESSION;
    $dbh = dbconnect();
    add_user_data($dbh,$user_data);
}

$_SESSION = [];
session_destroy();

include './view/register.php';