<?php
session_start();
require_once './conf/const.php';
require_once './model/common.php';
require_once './model/cart.php';
$session = $_SESSION;
session_check($session);
//配列を定義
$sum = [];
$message = [];
//postの値を取得
$process_kind = get_post_data('process_kind');
$cart_id = get_post_data('id');
$amount = get_post_data('amount');
//DB接続
$dbh = dbconnect();
$user_data = get_user_data($dbh,$session['user_id']);



//数量変更
if(check_request_method() && $process_kind === 'update_amount'){
    $message['update_amount'] = validate_amount($amount);
    $message = array_filter($message);
    if(empty($message)){
        $message['update_amount'] = update_amount($dbh,$cart_id,$amount);
    }
}
//削除
if(check_request_method() && $process_kind === 'delete_cart'){
    $message['delete_cart'] = delete_cart($dbh,$cart_id);
}


$carts_data = get_cart_data($dbh,$user_data);
//合計数を取得
$array_amount = sum_amount($carts_data);
$sum_amount = array_sum($array_amount);
//合計金額を取得
if(!empty($carts_data)){
    foreach($carts_data as $cart_data){
        $price[] = calculate_sum_price($dbh,$cart_data);
    }
    $sum = array_sum($price);
}

//購入
if(check_request_method() && $process_kind === 'buy'){
    
    if(empty($carts_data)){
           $message['buy'] = 'カートが空です。';
    } else {
        foreach($carts_data as $cart_data){
            if((int)$cart_data['stock'] < (int)$cart_data['amount']){
                $message['buy'] = '在庫が足りません！';
            }
        }
        if(empty($message)){
            $result = buy($dbh,$carts_data,$user_data);
            if ($result) {
                $_SESSION['carts_data'] = $carts_data;
                $_SESSION['sum_amount'] = $sum_amount;
                header('Location:bought.php');
                exit;
            } else {
                $message[] = '購入処理に失敗しました。';
            }
        }
    }
}

include './view/cart.php';