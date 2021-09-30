<?php
session_start();
require_once './conf/const.php';
require_once './model/common.php';
require_once './model/friend.php';
$session = $_SESSION;
session_check($session);
$message = [];

$process_kind = get_post_data('process_kind');
$dbh = dbconnect();
$user_data = get_user_data($dbh,$session['user_id']);


$friend_id = get_post_data('friend_id');

if(check_request_method() && $process_kind === 'delete_friend'){
    $message['delete_friend'] = delete_friend($dbh,$friend_id);
}

$friends = get_friends($dbh,$user_data['id']);

include './view/friend.php';