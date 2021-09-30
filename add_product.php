<?php
session_start();
require_once './conf/const.php';
require_once './model/common.php';
require_once './model/add_product.php';
$session = $_SESSION;
session_check($session);


$errors = [];
$message = [];
//変数を定義
$name = '';
$price = '';
$stock = '';
$comment = '';
//商品追加判定のため
$result = false;

if(check_request_method()){
    //POSTのデータを取得
    $name = get_post_data('name');
    $price = get_post_data('price');
    $stock = get_post_data('stock');
    $file = $_FILES;
    $type = get_post_data('type');
    $publish_status = get_post_data('publish_status');
    $comment = get_post_data('comment');
    
    //バリデーション
    $errors['name'] = validate_name($name);
    $errors['price'] = validate_price($price);
    $errors['stock'] = validate_stock($stock);
    
    list($status,$content) = validate_img($file);
    if($status === 1){
        $errors['img'] = $content;
    } else {
        $img = $content;
    }
    $errors['type'] = validate_type($type);
    $errors['publish_status'] = validate_publish_status($publish_status);
    
    $errors = array_filter($errors);
    
    //データベースにデータを追加
    if(count_error($errors)){
        $dbh = dbconnect();
        $user_data = get_user_data($dbh,$session['user_id']);
        $result = add_item_data($dbh,$user_data,$name,$price,$img,$publish_status,$stock,$type,$comment);
    }
}


include './view/add_product.php';