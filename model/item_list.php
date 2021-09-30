<?php
/**
 * カートからデータを取得
 * $param $dbh データベースハンドル,$user_id　選択したアイテムのユーザーid , $item_id　選択したアイテムのid
 * return str
 */
function select_cart($dbh, $user_id, $item_id){
    try{
        $stmt = $dbh->prepare('SELECT amount FROM carts WHERE user_id=? AND item_id=?');
        $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
        $stmt->bindValue(2, $item_id, PDO::PARAM_INT);
        $stmt->execute();
        $amount = $stmt->fetch();
        return $amount;
    } catch(PDOException $e) {
        return false;
    }
}

/**
 * ストックの値を取得
 * $param $dbh データベースハンドル ,$item_id 選択した商品のid
 * return
 */
 function get_item_stock($dbh,$item_id){
    try{
        $stmt = $dbh->prepare('SELECT stock FROM items WHERE id=?');
        $stmt->bindValue(1, $item_id, PDO::PARAM_INT);
        $stmt->execute();
        $stock = $stmt->fetch();
        return $stock;
    } catch(PDOException $e) {
        return false;
    }
 }

/**
 * カートに商品を追加,更新
 * $param $dbh データベースハンドル,$user_id　選択したアイテムのユーザーid , $item_id　選択したアイテムのid
 * return str
 */
function add_cart($dbh,$user_id,$item_id,$amount){
    if((int)$amount === 0){
        try{
            $stmt = $dbh->prepare('INSERT INTO carts SET user_id=?, item_id=?, amount=?, createdatetime=NOW()');
            $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
            $stmt->bindValue(2, $item_id, PDO::PARAM_INT);
            $stmt->bindValue(3, 1, PDO::PARAM_INT);
            $stmt->execute();
            
            return 'カートに追加しました。';
        } catch(PDOException $e) {
            return false;
        }
    } elseif((int)$amount > 0) {
        try{
            $stmt = $dbh->prepare('UPDATE carts SET amount=?, updatedatetime=NOW() WHERE user_id=? AND item_id=?');
            $stmt->bindValue(1, (int)$amount+1, PDO::PARAM_INT);
            $stmt->bindValue(2, $user_id, PDO::PARAM_INT);
            $stmt->bindValue(3, $item_id, PDO::PARAM_INT);
            $stmt->execute();
            
            return 'カートを更新しました。';
        } catch(PDOException $e) {
            return false;
        }
    }
}
/**
 * お気に入り
 * $param $dbh データベースハンドル,$user_id　選択したアイテムのユーザーid , $item_id　選択したアイテムのid
 * return str
 */ 
   function add_favorite($dbh,$user_id,$item_id){
       try{
           $stmt = $dbh->prepare('INSERT INTO favorites SET user_id=?, item_id=?, created_at=NOW()');
           $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
           $stmt->bindValue(2, $item_id, PDO::PARAM_INT);
           $stmt->execute();
           
           return 'お気に入り登録しました。';
       } catch(PDOException $e) {
           return false;
       }
   }
   
