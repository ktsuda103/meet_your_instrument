<?php 
session_start();
require_once './conf/const.php';
require_once './model/common.php';
require_once './model/history.php';
$session = $_SESSION;
session_check($session);

$dbh = dbconnect();
$user_data = get_user_data($dbh,$session['user_id']);

$histories = get_history($dbh,$user_data['id']);

include './view/history.php';