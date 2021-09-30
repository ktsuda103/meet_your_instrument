<?php
session_start();
require_once './conf/const.php';
require_once './model/common.php';
$session = $_SESSION;
session_check($session);


include './view/login.php';