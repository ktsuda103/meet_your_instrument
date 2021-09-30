<?php 
/**
 * 友達登録
 * $param $dbhデータベースハンドル,$user_id　ログインしているユーザーのID、$other_user_id 相手のユーザーID
 * return str
 */ 
 function add_friend($dbh,$user_id,$other_user_id){
     try{
         $stmt = $dbh->prepare('INSERT INTO friends SET user_id=?, other_user_id=?');
         $stmt->bindValue(1,$user_id,PDO::PARAM_INT);
         $stmt->bindValue(2,$other_user_id,PDO::PARAM_INT);
         $stmt->execute();
         return '友達に追加しました。';
     } catch(PDOException $e) {
         return false;
     }
 }
 
 /**
  * すでに登録されているか確認
  * 
  * 
  */ 
  function check_friend($dbh,$user_id,$other_user_id){
   try{
    $stmt = $dbh->prepare('SELECT id FROM friends WHERE user_id=? AND other_user_id=?');
    $stmt->bindValue(1,$user_id,PDO::PARAM_INT);
    $stmt->bindValue(2,$other_user_id,PDO::PARAM_INT);
    $stmt->execute();
    $friend = $stmt->fetch();
    return $friend;
   } catch(PDOException $e){
    return false;
   }
  }