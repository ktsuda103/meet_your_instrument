<?php
session_start();
require_once './conf/const.php';
require_once './model/common.php';
require_once './model/user.php';


$session = $_SESSION;
session_check($session);

$process_kind = get_post_data('process_kind');
$id = $_GET['id'];

$dbh = dbconnect();
 //他ユーザーの情報
$other_user_data = get_other_user_data($dbh,$id);

//商品の情報
$items_data = get_all_item_data($dbh);
//自分の情報
$user_data = get_user_data($dbh,$session['user_id']);

if($user_data['id'] === $other_user_data['id']){
    header('Location:mypage.php');
    exit();
}


if(check_request_method() && $process_kind === 'add_friend'){
    $friend = check_friend($dbh,$user_data['id'],$id);
    if(empty($friend)){
     $message['add_friend'] = add_friend($dbh,$user_data['id'],$id);
    } else {
     $message['add_friend'] = 'すでに登録されています。';
    }
        
}

include './view/user.php';