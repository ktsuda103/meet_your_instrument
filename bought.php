<?php
session_start();
require_once './conf/const.php';
require_once './model/common.php';
require_once './model/cart.php';

$session = $_SESSION;
session_check($session);

$dbh = dbconnect();
if(isset($session['carts_data'])){
    $sum_amount = $session['sum_amount'];
    //カートのデータ
    $carts_data = $session['carts_data'];
    //合計金額
    foreach($carts_data as $cart_data){
        $sum[] = calculate_sum_price($dbh,$cart_data);
    }
    $sum = array_sum($sum);
    $_SESSION['carts_data'] = null;
} else {
    header('Location:cart.php');
    exit();
}


include './view/bought.php';