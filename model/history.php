<?php 
/**
 * 購入履歴を取得
 * $param $dbh データベースハンドル、$user-id ログインしているユーザーのID
 * return array
 */ 
 function get_history($dbh,$user_id){
     try{
         $stmt = $dbh->prepare('SELECT i.*,h.created_at FROM histories as h JOIN items as i ON h.item_id=i.id WHERE h.user_id=?');
         $stmt->bindValue(1,$user_id,PDO::PARAM_INT);
         $stmt->execute();
         $histories = $stmt->fetchAll(PDO::FETCH_ASSOC);
         return $histories;
     } catch(PDOException $e) {
         return false;
     }
 }