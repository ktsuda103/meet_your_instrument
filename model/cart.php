<?php
/**
 * カートのデータを取得
 * $param $dbh
 * return array
 */
 function get_cart_data($dbh,$user_data){
    try{
        $stmt = $dbh->prepare('SELECT carts.id, carts.item_id, carts.user_id, carts.amount, items.name, items.price, items.img, items.stock  FROM carts JOIN items ON carts.item_id = items.id WHERE carts.user_id=?');
        $stmt->bindValue(1, $user_data['id'], PDO::PARAM_INT);
        $stmt->execute();
        $carts_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $carts_data;
    } catch(PDOException $e) {
        return false;
    }
 }
 
 /**
  * カートの合計金額算出
  * $param $dbh データベースハンドル, $cart_data foreachで回したカートのデータ
  * return str
  */ 
  function calculate_sum_price($dbh,$cart_data){
    return $cart_data['price']*$cart_data['amount'];
  }
  
  /**
   * カートの個数のチェック
   * $param $amount
   * return str
   */ 
   function validate_amount($amount){
       if(!preg_match('/^[0-9]+$/',$amount)){
           return '個数は0以上の数字で入力してください。';
       }
   }
  
  /**
   * カートの数量を変更
   * $param $dbh データベースハンドル、 $cart_id 選択したカートのid, $amount 入力した数量
   * return str
   */ 
   function update_amount($dbh,$cart_id,$amount){
       try{
           $stmt = $dbh->prepare('UPDATE carts SET amount=?,updatedatetime=NOW() WHERE id=?');
           $stmt->bindValue(1, (int)$amount, PDO::PARAM_INT);
           $stmt->bindValue(2, $cart_id, PDO::PARAM_INT);
           $stmt->execute();
           return '数量を変更しました。';
       } catch(PDOException $e) {
           return false;
       }   
   }
   
   /**
    * カートを削除
    * $param $dbh データベースハンドル, $cart_id　選択したカートのID
    * return str
    */ 
    function delete_cart($dbh,$cart_id){
        try{
            $stmt = $dbh->prepare('DELETE FROM carts WHERE id=?');
            $stmt->bindValue(1, (int)$cart_id, PDO::PARAM_INT);
            $stmt->execute();
            return 'カートを削除しました。';
        } catch(PDOException $e) {
            return false;
        }
    }
    
    
    /**
     * 購入処理　カートのデータを削除→在庫数を減らす
     * $param $dbh, $cart_data, $user_data
     * return bool 
     */
     function buy($dbh,$carts_data,$user_data){
            $dbh->beginTransaction();
            try{
                
                $stmt = $dbh->prepare('DELETE FROM carts WHERE user_id=?');
                $stmt->bindValue(1, (int)$user_data['id'], PDO::PARAM_INT);
                $stmt->execute();
                foreach($carts_data as $cart_data){
                    $stmt = $dbh->prepare('UPDATE items SET stock=?, updatedatetime=NOW() WHERE id=?');
                    $stmt->bindValue(1, (int)$cart_data['stock']-(int)$cart_data['amount'], PDO::PARAM_INT);
                    $stmt->bindValue(2, $cart_data['item_id'], PDO::PARAM_INT);
                    $stmt->execute();
                    
                    $stmt = $dbh->prepare('INSERT INTO histories SET user_id=?, item_id=?, created_at=NOW()');
                    $stmt->bindValue(1,$cart_data['user_id'],PDO::PARAM_INT);
                    $stmt->bindValue(2,$cart_data['item_id'],PDO::PARAM_INT);
                    $stmt->execute();
                }
                $dbh->commit();
                return true;
            } catch(PDOException $e) {
                $dbh->rollback();
                return false;
            }
     }
     
     /**
      * 合計数取得
      * $param $carts_data カートの全てのデータ
      * return array
      */ 
     function sum_amount($carts_data){
         $amount = [];
         foreach($carts_data as $cart_data){
            $amount[] = $cart_data['amount'];    
         }
         return $amount;
     }
     