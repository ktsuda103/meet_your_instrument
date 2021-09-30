<?php
session_start();
require_once './conf/const.php';
require_once './model/common.php';
require_once './model/login_form.php';

$errors =  [];
$user_id = '';
$password = '';

if(check_request_method()){
    $user_id = get_post_data('user_id');
    $password = get_post_data('password');
    
    //バリデーション
    $errors['user_id'] = validate_user_id($user_id);
    $errors['password'] = validate_password($password);
    $dbh = dbconnect();
    $errors = array_filter($errors);
    if(count_error($errors)){
        $errors['check_login'] = check_login($dbh,$user_id,$password);
    }
    $errors = array_filter($errors);
    if(count_error($errors)){
        $_SESSION['user_id'] = $user_id;
        header('Location:item_list.php');
    }
}



include './view/login_form.php';