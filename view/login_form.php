<!DOCKTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ログインページ</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="stylesheet" href="./style.css">
       
    </head>
    <body>
        <header>
            <!-- ナビゲーション -->
            <nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">
                <h1><a href="#" class="navbar-brand">中古楽器オンライン</a></h1>
                <button class="navbar-toggler" data-toggle="collapse" data-target="mainNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNav"> 
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a href="login_form.php" class="nav-link">ログイン</a></li>
                        <li class="nav-item"><a href="signup_form.php" class="nav-link">新規登録</a></li>
                    </ul>
                </div>
            </nav>
            
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">ログイン</div>
                            <div class="card-body">
                                <form method="post">
                                    <div class="form-group form-row">
                                        <label class="col-md-3 col-form-label text-md-right" for="user_id">ユーザーID</label>
                                        <input class="col-md-6 form-control" type="text" id="user_id" name="user_id" value="<?php echo h($user_id); ?>"> 
                                        <?php if(!empty($errors['user_id'])): ?>
                                            <p class="offset-md-3 error"><?php echo $errors['user_id']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="form-group form-row">
                                        <label class="col-md-3 col-form-label text-md-right" for="password">パスワード</label>
                                        <input class="col-md-6 form-control" type="password" id="password" name="password" value="<?php echo h($password); ?>">    
                                        <?php if(!empty($errors['password'])): ?>
                                            <p class="offset-md-3 error"><?php echo $errors['password']; ?></p>
                                        <?php endif; ?>
                                        <?php if(!empty($errors['check_login'])): ?>
                                            <p class="offset-md-3 error"><?php echo $errors['check_login']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group form-row">
                                        <div class="offset-md-3 col-md-9">
                                            <button type="submit" class="btn btn-primary">ログイン</button>    
                                        </div>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>    
        </header>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js"></script>
    </body>
    
</html>