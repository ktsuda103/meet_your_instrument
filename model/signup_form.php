<?php
 /**
  * メールアドレスの確認
  * $param $email
  * return str
  */ 
  function validate_email($email){
    if(!preg_match('/^[a-zA-Z0-9_.+-]+@([a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]*\.)+[a-zA-Z]{2,}$/', $email)){
        return 'メールアドレスの形式が違います。';
    }
 }
 
 /**
  * メールアドレスの重複チェック
  * $param $dbh,$email
  * return str
  */ 
 function check_duplicate_email($dbh,$email){
    try{                                                                                                                            
        $stmt = $dbh->prepare('SELECT COUNT(email) as cnt FROM users WHERE email=?');
        $stmt->bindValue(1, $email, PDO::PARAM_STR);
        $stmt->execute();
        $users_email = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e){
        return 'データ取得失敗';
    }
    if($users_email['cnt'] > 0){
        return 'そのメールアドレスはすでに使われています。';
    }
 }
 /**
  * ユーザーIDの重複チェック
  * $param $dbh,$user_id
  * return str
  */ 
 function check_duplicate_user_id($dbh,$user_id){
    try{                                                                                                                            
        $stmt = $dbh->prepare('SELECT COUNT(user_id) as cnt FROM users WHERE user_id=?');
        $stmt->bindValue(1, $user_id, PDO::PARAM_STR);
        $stmt->execute();
        $users_id = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e){
        return 'データ取得失敗';
    }
    if($users_id['cnt'] > 0){
        return 'そのユーザーIDはすでに使われています。';
    }
 }
 
 /**
  * 
  * 
  * 
  */
  function check_user_name($dbh){
      try{
          $stmt = $dbh->prepare('SELECT user_id FROM users');
          $stmt->execute();
          $users_id = $stmt->fetchAll(PDO::FETCH_ASSOC);
         return $users_id;
      } catch(PDOException $e) {
          return false;
      }
  }