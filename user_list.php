<?php
session_start();
require_once './conf/const.php';
require_once './model/common.php';
require_once './model/user_list.php';

$session = $_SESSION;
session_check($session);

$dbh = dbconnect();
$users_data = get_all_user_data($dbh);


include './view/user_list.php';