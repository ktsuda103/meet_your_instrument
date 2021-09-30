<?php
/**
 * コメントのチェック
 * 
 * 
 */ 
 function validate_comment($comment){
     if(!preg_replace('/\A[\p{C}\p{Z}]++|[\p{C}\p{Z}]++\z/u', '', $comment)){
         return 'メッセージを入力してください。';
     }
 }

/**
 * メッセージをDBに登録
 * $param $dbh データベースハンドル、$user_data 自分のデータ、$other_user_data 相手のデータ , $comment　入力したコメント
 * return str | bool
 */ 
 function add_post($dbh,$user_data,$other_user_data,$comment){
    try{
        $stmt = $dbh->prepare('INSERT INTO posts SET user_id=?, destination_user_id=?, comment=?, createdatetime=NOW()');
        $stmt->bindValue(1, $user_data['id'], PDO::PARAM_INT);
        $stmt->bindValue(2, $other_user_data['id'], PDO::PARAM_INT);
        $stmt->bindValue(3, $comment, PDO::PARAM_STR);
        $stmt->execute();
        return 'メッセージを送信しました。';
    } catch(PDOException $e) {
        return false;
    }
 }
 
 /**
  * データベースからメッセージを取得
  * $param $dbh データベースハンドル, $user_data 自分のデータ, $other_user_data 相手のデータ
  * return array
  */ 
  function get_comment($dbh,$user_data,$other_user_data){
      try{
          $stmt = $dbh->prepare('SELECT p.user_id, p.destination_user_id,p.comment,p.createdatetime,u.user_id,u.img FROM posts as p JOIN users as u ON p.user_id=u.id WHERE (p.user_id=? AND p.destination_user_id=?) OR (p.user_id=? AND p.destination_user_id=?) ORDER BY p.createdatetime DESC');
          $stmt->bindValue(1, $user_data['id'], PDO::PARAM_INT);
          $stmt->bindValue(2, $other_user_data['id'], PDO::PARAM_INT);
          $stmt->bindValue(3, $other_user_data['id'], PDO::PARAM_INT);
          $stmt->bindValue(4, $user_data['id'], PDO::PARAM_INT);
          $stmt->execute();
          $comments_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $comments_data;
      } catch(PDOException $e) {
          return false;
      }
  }