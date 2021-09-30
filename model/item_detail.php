<?php
/**
 * 選択したアイテムデータを取得
 * $param $dbh　,$id 選択したアイテムのid
 * return array
 */
 function get_one_item_data($dbh,$id){
    try{
        $stmt = $dbh->prepare('SELECT * FROM items WHERE id=?');
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $item_data = $stmt->fetch();
        return $item_data;
    } catch(PDOException $e) {
        return false;
    }
 }