<?php
/**
 *  POSTで受け取った値を取得
 * $param $key
 * return str
 */ 
function get_post_data($key){
    $str = '';
    if(isset($_POST[$key])){
        $str = $_POST[$key];
    }
    return $str;
}

/**
 * エスケープ処理
 * $param $str  
 * return str エスケープした値
 */ 
function h($str){
    return htmlspecialchars($str, ENT_QUOTES, 'utf-8');
}

/**
 * データベース接続
 * $param void
 * return obj データベースハンドル
 */ 
function dbconnect(){
    try{
    $dbh = new PDO(DSN,DB_USER,DB_PASSWORD,array(OPTION));
    } catch(PDOException $e) {
        return false;
    }
    return $dbh;
}

/**
 * REQUEST_METHODがPOSTの時
 * $param void
 * return bool
 */ 
function check_request_method(){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        return true;
    }
    return false;
}

/**
 * ユーザーIDの確認
 * $param $user_id
 * return str
 */
 function validate_user_id($user_id){
    if(!preg_replace('/\A[\p{C}\p{Z}]++|[\p{C}\p{Z}]++\z/u', '', $user_id)){
        return 'ユーザーIDを入力してください。';
    } elseif(!preg_match('/^(?=.*?[a-z])(?=.*?\d)[a-z\d]{6,}$/i', $user_id)){
        return 'ユーザーIDは6文字以上の半角英数字で入力してください。';
    }
 }
 
/**
 * パスワードの確認
 * $param $password
 * return str
 */
 function validate_password($password){
    if(!preg_match('/^(?=.*?[a-z])(?=.*?\d)[a-z\d]{6,}$/i', $password)){
        return 'パスワードは6文字以上の半角英数字で入力してください。';
    }
 }
 
 /**
  * 画像の確認
  * $param $img
  * return str
  */ 
  function validate_img($file){
    if(is_uploaded_file($file['img']['tmp_name'])){
        $extension = pathinfo($file['img']['name'], PATHINFO_EXTENSION);
        if($extension === 'jpg' || $extension === 'jpeg' || $extension === 'png' || $extension === 'JPG' || $extension === 'JPEG' || $extension === 'PNG'){
            $img = sha1(uniqid(mt_rand(),true)).'.'.$extension;
            if(is_file('./img/'.$img) !== true){
                if(move_uploaded_file($file['img']['tmp_name'], './img/'.$img) !== true){
                    return [1,'ファイル保存に失敗しました。'];
                }
            } else {
                return [1,'ファイル保存に失敗しました。もう一度お試しください。'];
            }
        } else {
            return [1,'拡張子はJPGまたはPNGを使用してください。'];
        }
    } else {
        return [1,'ファイルを選択してください。'];
    }
    return [2,$img];
 }
 
 /**
  * 在庫数のバリデーション
  * $param $stock
  * return str
  */ 
  function validate_stock($stock){
     if(!preg_match('/^[0-9]+$/', $stock)){
         return '個数は0以上の整数を指定してください。';
     }
  }
  
  /**
 * 価格の確認
 * $param $price
 * return int
 */
 function validate_price($price){
    if(!preg_match('/^[0-9]+$/', $price)){
        return '価格は0以上の整数を指定してください。';
    }
 }
 
  
  /**
 * ステータスの確認
 * $param $publish_status
 * return int
 */
 function validate_publish_status($publish_status){
    if($publish_status !== '0' && $publish_status !== '1'){
        return 'ステータスは公開または非公開を選択してください。';
    }
 }
 
 /**
  * エラーチェック
  * $param $errors
  * return bool
  */
  function count_error($errors){
      if(count($errors) ===  0){
          return true;
      } else {
          return false;
      }
  }
  
  /**
   * セッションチェック
   * $param $session
   * 
   */ 
  function session_check($session){
    if(empty($session)){
        header('Location:login_form.php');
    }
  }
  
 /**
 * ユーザーデータの取得
 * $param $dbh データベースハンドル, $session セッションの値
 * return array
 */ 
function get_user_data($dbh,$id){
   try{
       $stmt = $dbh->prepare('SELECT * FROM users WHERE user_id=?');
       $stmt->bindvalue(1, $id, PDO::PARAM_STR);
       $stmt->execute();
       $user_data = $stmt->fetch();
       return $user_data;
   } catch(PDOException $e){
       return false;
   }
}

/**
 * 他のユーザーデータの取得
 * $param $dbh データベースハンドル, $id 取得したいユーザーのid
 * return array
 */ 
function get_other_user_data($dbh,$id){
   try{
       $stmt = $dbh->prepare('SELECT * FROM users WHERE id=?');
       $stmt->bindvalue(1, $id, PDO::PARAM_STR);
       $stmt->execute();
       $user_data = $stmt->fetch();
       return $user_data;
   } catch(PDOException $e){
       return false;
   }
}

/**
 * 全てのアイテムデータを取得
 * $param $dbh
 * return array
 */
 function get_all_item_data($dbh){
    try{
        $stmt = $dbh->prepare('SELECT * FROM items ORDER BY createdatetime DESC');
        $stmt->execute();
        $items_data = $stmt->fetchAll();
        return $items_data;
    } catch(PDOException $e) {
        return false;
    }
 }
 
 /**
  * キーワードで検索
  * $param $dbh データベースハンドル, $keyword キーワード
  * return array
  */
  function search_keyword($dbh,$keyword){
      try{
          $stmt = $dbh->prepare('SELECT * FROM items WHERE name LIKE ?');
          $stmt->bindValue(1, '%'.$keyword.'%', PDO::PARAM_STR);
          $stmt->execute();
          $items_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $items_data;
      } catch(PDOException $e) {
          return false;
      }
  }
  
 /**
  * キーワードで検索した結果件数
  * $param $dbh データベースハンドル, $keyword キーワード
  * return str
  */
  function get_number_keyword($dbh,$keyword){
      try{
          $stmt = $dbh->prepare('SELECT COUNT(*) as cnt FROM items WHERE name LIKE ? AND status=1');
          $stmt->bindValue(1, '%'.$keyword.'%', PDO::PARAM_STR);
          $stmt->execute();
          $number = $stmt->fetch(PDO::FETCH_ASSOC);
          return $number;
      } catch(PDOException $e) {
          return false;
      }
  }
  
  /**
   * 楽器種類で検索
   * $param $dbh データベースハンドル、$type 楽器種類 
   * return array
   */
function search_type($dbh, $type){
    try{
        $stmt = $dbh->prepare('SELECT * FROM items WHERE type=? ORDER BY createdatetime DESC');
        $stmt->bindValue(1, $type, PDO::PARAM_STR);
        $stmt->execute();
        $items_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $items_data;
    } catch(PDOException $e) {
        return false;
    }
}
  /**
   * 楽器種類で検索した結果件数
   * $param $dbh データベースハンドル、$type 楽器種類 
   * return array
   */
function get_number_type($dbh, $type){
    try{
        $stmt = $dbh->prepare('SELECT COUNT(*) as cnt FROM items WHERE type=? AND status=1');
        $stmt->bindValue(1, $type, PDO::PARAM_STR);
        $stmt->execute();
        $number = $stmt->fetch(PDO::FETCH_ASSOC);
        return $number;
    } catch(PDOException $e) {
        return false;
    }
}

 /**
   * 楽器種類とキーワードで検索
   * $param $dbh データベースハンドル、$type 楽器種類 
   * return array
   */
function search_keyword_type($dbh, $keyword, $type){
    try{
        $stmt = $dbh->prepare('SELECT * FROM items WHERE type=? AND name LIKE ? ORDER BY createdatetime DESC');
        $stmt->bindValue(1, $type, PDO::PARAM_STR);
        $stmt->bindValue(2, '%'.$keyword.'%', PDO::PARAM_STR);
        $stmt->execute();
        $items_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $items_data;
    } catch(PDOException $e) {
        return false;
    }
}

 /**
   * 楽器種類で検索した結果件数
   * $param $dbh データベースハンドル、$type 楽器種類 
   * return array
   */
function get_number_keyword_type($dbh,$keyword, $type){
    try{
        $stmt = $dbh->prepare('SELECT COUNT(*) as cnt FROM items WHERE type=? AND name LIKE ? AND status=1');
        $stmt->bindValue(1, $type, PDO::PARAM_STR);
        $stmt->bindValue(2, '%'.$keyword.'%', PDO::PARAM_STR);
        $stmt->execute();
        $number = $stmt->fetch(PDO::FETCH_ASSOC);
        return $number;
    } catch(PDOException $e) {
        return false;
    }
}

