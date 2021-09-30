<!DOCKTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>商品管理ページ</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="stylesheet" href="./style.css">
       
    </head>
    <body>
        <header>
            <!-- ナビゲーション -->
            <nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">
                <h1><a href="#" class="navbar-brand">中古楽器オンライン</a></h1>
                <button class="navbar-toggler" data-toggle="collapse" data-target="#mainNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNav"> 
                    <ul class="navbar-nav">
                        <li class="nav-item"><a href="item_list.php" class="nav-link">商品一覧画面</a></li>
                        <li class="nav-item"><a href="mypage.php" class="nav-link">マイページ</a></li>
                        <li class="nav-item"><a href="cart.php" class="nav-link">カート</a></li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><p class="nav-link">ようこそ<?php echo $session['user_id'] ?>さん</p></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">ログアウト</a></li>
                    </ul>
                </div>
            </nav>
        </header>    
            
        <main class="container">
            <h2>出品する</h2>
            <?php if(check_request_method() && $result): ?>
                <p class="text-center done">出品ありがとうございました！</p>
                <p class="text-center done">商品登録が完了しました。</p>
            <?php endif; ?>
            <!-- 出品 -->
            <form class="add_product" enctype="multipart/form-data" method="post">
                <div class="form-group">
                    <label for="product_name">商品名<span class="attension small"> ※必須入力</span></label>
                    <input class="form-control" type="text" id="name" name="name" value="<?php echo h($name); ?>">
                    <?php if(!empty($errors['name'])): ?>
                        <p class="error"><?php echo $errors['name']; ?></p>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="price">価格<span class="attension small"> ※必須入力</span></label>
                    <input class="form-control" type="text" id="price" name="price" value="<?php echo h($price); ?>">
                    <?php if(!empty($errors['price'])): ?>
                        <p class="error"><?php echo $errors['price']; ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="stock">個数<span class="attension small"> ※必須入力</span></label>
                    <input class="form-control" type="text" id="stock" name="stock" value="<?php echo h($stock); ?>">
                    <?php if(!empty($errors['stock'])): ?>
                        <p class="error"><?php echo $errors['stock']; ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="product_img">商品画像<span class="attension small"> ※必須入力</span></label>
                    <input type="file" id="img" name="img">
                    <?php if(!empty($errors['img'])): ?>
                        <p class="error"><?php echo $errors['img']; ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="type">楽器の種類</label>
                    <select class="form-select" id="type" name="type">
                        <option value="弦楽器">弦楽器</option>
                        <option value="木管楽器">木管楽器</option>
                        <option value="金管楽器">金管楽器</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="publish_status">ステータス</label>
                    <select class="form-select" id="publish_status" name="publish_status">
                        <option value="0">非公開</option>
                        <option value="1">公開</option>
                    </select>
                    <?php if(!empty($errors['publish_status'])): ?>
                        <p class="error"><?php echo $errors['publish_status']; ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="comment">備考</label>
                    <textarea class="form-control" id="comment" name="comment"><?php echo h($comment); ?></textarea>
                </div>
                <button class="btn btn-warning" type="submit">出品する</button>
            </form>
        </main>
        
        
        
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js"></script>
    </body>
    
</html>