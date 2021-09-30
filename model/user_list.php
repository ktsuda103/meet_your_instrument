<?php
/**
 * 全てのユーザーデータの取得
 * $param $dbh データベースハンドル
 * return array
 */ 
function get_all_user_data($dbh){
   try{
       $stmt = $dbh->prepare('SELECT user_id,createdatetime FROM users');
       $stmt->execute();
       $users_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
       return $users_data;
   } catch(PDOException $e){
       return false;
   }
}