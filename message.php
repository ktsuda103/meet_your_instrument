<?php
session_start();
require_once './conf/const.php';
require_once './model/common.php';
require_once './model/message.php';
if(isset($_SESSION)){
    $session = $_SESSION;
}

session_check($session);
//配列を定義
$message = [];
$comments_data = [];
//POSTの値を取得
$comment = get_post_data('comment');
$process_kind = get_post_data('process_kind');
//バリデーション
if(check_request_method() && $process_kind === 'message'){
$message['comment'] = validate_comment($comment);
}
//DB接続
$dbh = dbconnect();
//自分のユーザーデータを取得
$user_data = get_user_data($dbh,$session['user_id']);
//ユーザーIDから相手のユーザーデータを取得
$id = $_GET['id'];
$other_user_data = get_other_user_data($dbh,$id);

$message = array_filter($message);
if(empty($message)){
    if(check_request_method() && $process_kind === 'message'){
        $message['comment'] = add_post($dbh,$user_data,$other_user_data,$comment);
    }
}
//DBの値を取得
$comments_data = get_comment($dbh,$user_data,$other_user_data);


include './view/message.php';