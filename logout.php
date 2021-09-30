<?php
session_start();
require_once './conf/const.php';
require_once './model/common.php';
require_once './model/logout.php';
$session = $_SESSION;
session_check($session);

if(isset($_COOKIE['PHPSESSID'])){
    $_SESSION = [];
    
    logout();
    
    session_destroy();
    
    header("Location:login.php");
    exit;
}

include './view/logout.php';