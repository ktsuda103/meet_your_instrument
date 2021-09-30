<?php
/**
 * ステータスの変更
 * $param $dbh データベースハンドル, $publish_status 更新後のステータス, $id 選択したアイテムのid
 * 
 */ 
function change_stock($dbh,$stock,$id){
    try{
        $stmt = $dbh->prepare('UPDATE items SET stock=?, updatedatetime=NOW() WHERE id=?');
        $stmt->bindValue(1, $stock, PDO::PARAM_INT);
        $stmt->bindValue(2, $id, PDO::PARAM_INT);
        $stmt->execute();
        return '在庫数を変更しました。';
    } catch(PDOException $e) {
        return false;
    }
}


/**
 * ステータスの変更
 * $param $dbh データベースハンドル, $publish_status 更新後のステータス, $id 選択したアイテムのid
 * 
 */ 
function change_publish_status($dbh,$publish_status,$id){
    try{
        $stmt = $dbh->prepare('UPDATE items SET status=?, updatedatetime=NOW() WHERE id=?');
        $stmt->bindValue(1, $publish_status, PDO::PARAM_INT);
        $stmt->bindValue(2, $id, PDO::PARAM_INT);
        $stmt->execute();
        return 'ステータスを変更しました。';
    } catch(PDOException $e) {
        return false;
    }
}

/**
 * 出品したデータの削除
 * $param $dbh データベースハンドル、 $id
 * return
 */ 
 function delete_item_data($dbh,$id){
    try{
        $stmt = $dbh->prepare('DELETE FROM items WHERE id=?');
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return '商品を削除しました。';
    } catch(PDOException $e) {
        return false;
    }
 }