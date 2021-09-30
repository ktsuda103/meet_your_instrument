<?php
session_start();
require_once './conf/const.php';
require_once './model/common.php';
require_once './model/item_detail.php';
require_once './model/item_list.php';

$session = $_SESSION;
session_check($session);

$dbh = dbconnect();
$id = $_GET['id'];
$process_kind = get_post_data('process_kind');
$user_data = get_user_data($dbh,$session['user_id']);
if(check_request_method() && $process_kind === 'add_cart'){
    $amount = select_cart($dbh, $user_data['id'], $id);
    $message['add'] = add_cart($dbh,$user_data['id'],$id,$amount['amount']);
}

$item_data = get_one_item_data($dbh,$id);
$user_data = get_user_data($dbh, $session['user_id']);


include './view/item_detail.php';