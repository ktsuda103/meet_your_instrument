<?php

/**
 * お気に入り一覧を取得
 * @param $dbhデータベースハンドル、$user_id ログインしているユーザーのID
 * return array
 */
 function get_favorite($dbh,$user_id){
     try{
         $stmt = $dbh->prepare('SELECT f.id as favorite_id,i.* FROM favorites as f join items as i ON f.item_id = i.id where f.user_id=?');
         $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
         $stmt->execute();
         $favorites = $stmt->fetchAll(PDO::FETCH_ASSOC);
         return $favorites;
     } catch(PDOException $e) {
         return false;
     }
 }
 
 /**
  * お気に入りを削除
  * 
  * 
  */ 
  function delete_favorite($dbh,$favorite_id){
      try{
          $stmt = $dbh->prepare('DELETE FROM favorites WHERE id=?');
          $stmt->bindValue(1,$favorite_id,PDO::PARAM_INT);
          $stmt->execute();
          return 'お気に入りを削除しました。';
      } catch(PDOException $e) {
          return false;
      }
  }