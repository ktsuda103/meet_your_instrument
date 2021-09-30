<?php
session_start();
require_once './conf/const.php';
require_once './model/common.php';
require_once './model/signup_form.php';

$errors = [];
$user_id = '';
$password = '';
$email = '';

if(check_request_method()){
    //POSTの値を取得
    $user_id = get_post_data('user_id');
    $password = get_post_data('password');
    $email = get_post_data('email');
    $file = $_FILES;
    
    
    //バリデーション
    $errors['user_id'] = validate_user_id($user_id);
    $errors['password'] = validate_password($password);
    $errors['email'] = validate_email($email);
    //メールアドレスの重複チェック
    $dbh = dbconnect();
    $errors['users_email'] = check_duplicate_email($dbh,$email);
    //ユーザーIDの重複チェック
    $errors['users_id'] = check_duplicate_user_id($dbh,$user_id);
    
    //画像ファイルチェック
    list($status,$content) = validate_img($file);
    if($status === 1){
        $errors['img'] = $content;
    } else {
        $img = $content;
    }
    $errors = array_filter($errors);
    
    if(empty($errors)){
        
        $_SESSION['user_id'] = $user_id;
        $_SESSION['password'] = $password;
        $_SESSION['email'] = $email;
        $_SESSION['img'] = $img;
        header('Location:register.php');
        exit();
    }

    
} 


include './view/signup_form.php';