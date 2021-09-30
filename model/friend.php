<?php
/**
  * 友達データを取得
  * $param $dbhデータベース　$user_id ログインしているユーザーのID
  * return array
  */ 
  function get_friends($dbh,$user_id){
      try{
          $stmt = $dbh->prepare('SELECT u.*,f.id as friend_id FROM friends as f JOIN users as u ON f.other_user_id=u.id WHERE f.user_id=?');
          $stmt->bindValue(1,$user_id,PDO::PARAM_INT);
          $stmt->execute();
          $friends = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $friends;
      } catch(PDOException $e) {
          return false;
      }
  }
  
  /**
   * 友達データを削除
   * $param $dbh データベースハンドル,$id 友達データのID
   * return str
   */ 
   function delete_friend($dbh,$id){
     try{
       $stmt = $dbh->prepare('DELETE FROM friends WHERE id=?');
       $stmt->bindValue(1,$id,PDO::PARAM_INT);
       $stmt->execute();
       return '友達を削除しました。';
     } catch(PDOException $e) {
       return false;
     }
   }