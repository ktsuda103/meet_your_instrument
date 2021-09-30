<?php

/**
 * パスワードをチェック
 * $param $dbh データベースハンドル, $password 入力したパスワードの値
 * return 
 */
 function check_login($dbh,$user_id,$password){
    try{
        $stmt = $dbh->prepare('SELECT COUNT(password) as cnt FROM users WHERE user_id=? AND password=?');
        $stmt->bindValue(1, $user_id, PDO::PARAM_STR);
        $stmt->bindValue(2, sha1($password), PDO::PARAM_STR);
        $stmt->execute();
        $users_password = $stmt->fetch();
    }catch(PDOException $e){
        return false;
    }    
    if($users_password['cnt'] === '0'){
        return 'ユーザーIDまたはパスワードが間違っています。';
    }
 }