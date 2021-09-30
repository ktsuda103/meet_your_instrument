<?php
session_start();
require_once './conf/const.php';
require_once './model/common.php';
require_once './model/favorite.php';
require_once './model/item_list.php';
$session = $_SESSION;
session_check($session);

//配列を定義
$message = [];

//DB接続
$dbh = dbconnect();

$user_data = get_user_data($dbh,$session['user_id']);
$process_kind = get_post_data('process_kind');



if(check_request_method() && $process_kind === 'add_cart'){
    $user_id = $user_data['id'];
    $item_id = get_post_data('item_id');
    
    $amount = select_cart($dbh, $user_id, $item_id);
    
    $message['add'] = add_cart($dbh,$user_id,$item_id,$amount['amount']);
  
}

if(check_request_method() && $process_kind === 'delete_favorite'){
    $favorite_id = get_post_data('favorite_id');
    $message['delete_favorite'] = delete_favorite($dbh,$favorite_id);
}

$favorites = get_favorite($dbh,$user_data['id']);

include './view/favorite.php';