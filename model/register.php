<?php

function add_user_data($dbh,$user_data){
    try{
    $stmt = $dbh->prepare('INSERT INTO users SET user_id=?, img=?, password=?, email=?, createdatetime=NOW()');
    $stmt->bindvalue(1, $user_data['user_id'], PDO::PARAM_STR);
    $stmt->bindvalue(2, $user_data['img'], PDO::PARAM_STR);
    $stmt->bindvalue(3, sha1($user_data['password']), PDO::PARAM_STR);
    $stmt->bindvalue(4, $user_data['email'], PDO::PARAM_STR);
    $result = $stmt->execute();
    
    return $result;
    } catch(PDOException $e){
        return false;
    }
}