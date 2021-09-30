<?php
session_start();
require_once './conf/const.php';
require_once './model/common.php';
require_once './model/item_list.php';
$session = $_SESSION;
session_check($session);
$message = [];

$dbh = dbconnect();
$items_data = get_all_item_data($dbh);
$process_kind = get_post_data('process_kind');
$user_data = get_user_data($dbh,$session['user_id']);

if(check_request_method() && $process_kind === 'add_cart'){
    $user_id = $user_data['id'];
    $item_id = get_post_data('item_id');
    
    $amount = select_cart($dbh, $user_id, $item_id);
    
    $message['add'] = add_cart($dbh,$user_id,$item_id,$amount['amount']);
  
}

if(check_request_method() && $process_kind === 'search'){
    $keyword = get_post_data('keyword');
    
    $type = get_post_data('type');
    
    if(!empty($keyword) && !empty($type)){
        $items_data = search_keyword_type($dbh,$keyword,$type);
        $number = get_number_keyword_type($dbh,$keyword,$type);
    } elseif(!empty($keyword)){
        $items_data = search_keyword($dbh,$keyword);
        $number = get_number_keyword($dbh,$keyword);
    } elseif(!empty($type)){
        $items_data = search_type($dbh,$type);
        $number = get_number_type($dbh,$type);
    }

}

if(check_request_method() && $process_kind === 'favorite'){
    $user_id = $user_data['id'];
    $item_id = get_post_data('item_id');
    $message['favorite'] = add_favorite($dbh,$user_id,$item_id);
}


include './view/item_list.php';