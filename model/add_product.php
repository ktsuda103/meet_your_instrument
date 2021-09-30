<?php
/**
 * 商品名の確認
 * $param $name
 * return str
 */
 function validate_name($name){
    if(!preg_replace('/\A[\p{C}\p{Z}]++|[\p{C}\p{Z}]++\z/u', '', $name)){
        return '商品名を入力してください。';
    }
 }



/**
 * 楽器種類の確認
 * $param $type
 * return str
 */
 function validate_type($type){
    if(empty($type)){
        return '楽器の種類を選択してください。';
    }
 }

 
 /**
  * 商品を追加する
  * $param $dbh ,　入力した値
  * return str
  */
function add_item_data($dbh,$user_data,$name,$price,$img,$publish_status,$stock,$type,$comment){
    try{
        $stmt = $dbh->prepare('INSERT INTO items SET user_id=?, name=?, price=?, img=?, status=?, stock=?, type=?, comment=?, createdatetime=NOW()');
        $stmt->bindValue(1, $user_data['id'], PDO::PARAM_INT);
        $stmt->bindValue(2, $name, PDO::PARAM_STR);
        $stmt->bindValue(3, $price, PDO::PARAM_INT);
        $stmt->bindValue(4, $img, PDO::PARAM_STR);
        $stmt->bindValue(5, $publish_status, PDO::PARAM_INT);
        $stmt->bindValue(6, $stock, PDO::PARAM_INT);
        $stmt->bindValue(7, $type, PDO::PARAM_STR);
        $stmt->bindValue(8, $comment, PDO::PARAM_STR);
        $stmt->execute();
        return true;
    } catch(PDOException $e) {
        return false;
    }
}