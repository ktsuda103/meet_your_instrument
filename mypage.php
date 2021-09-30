<?php
session_start();
require_once './conf/const.php';
require_once './model/common.php';
require_once './model/mypage.php';
$session = $_SESSION;
session_check($session);
$message = [];

$dbh = dbconnect();
$process_kind = get_post_data('process_kind');

if(check_request_method() && $process_kind === 'update_stock'){
    $id = get_post_data('id');
    $stock = get_post_data('stock');
    $message['stock'] = validate_stock($stock);
    $message = array_filter($message);
    if(empty($message)){
        $message['stock'] = change_stock($dbh,$stock,$id);
    }
}

if(check_request_method() && $process_kind === 'update_publish_status'){
    $id = get_post_data('id');
    $publish_status = get_post_data('publish_status');
    $message['publish_status'] = validate_publish_status($publish_status);
    $message = array_filter($message);
    if(empty($message)){
        $message['publish_status'] = change_publish_status($dbh,$publish_status,$id);
    }
        
    }

if(check_request_method() && $process_kind === 'delete_item_data'){
    $id = get_post_data('id');
    $message['delete'] = delete_item_data($dbh,$id);
}

$user_data = get_user_data($dbh,$session['user_id']);
$items_data = get_all_item_data($dbh);

include './view/mypage.php';