<!DOCKTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>詳細画面</title>
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
                <p class="text-center thanks">ご購入ありがとうございました！</p>
                <p class="text-center thanks">商品購入が完了しました。</p>
                <hr>
                <?php foreach($carts_data as $cart_data): ?>
                    <div class="cart_item_list_head row">
                        <span class="col-2">写真</span>
                        <span class="col-6">商品名</span>
                        <span class="col-2">価格</span>
                        <span class="col-2">数量</span>    
                    </div>
                    <div class="row">
                    <img src="./img/<?php echo h($cart_data['img']); ?>" class="img-fluid col-2">
                    <span class="col-6"><?php echo h($cart_data['name']); ?></span>
                    
                    
                    <span class="col-2">¥<?php echo number_format(h($cart_data['price'])); ?></span>
                    <span class="col-2"><?php echo h($cart_data['amount']); ?></span>
                    </div>
                    <hr>
                    
                    <?php endforeach; ?>
                    <div class="row">
                        <p class="offset-8 col-2">合計：¥<?php echo number_format($sum); ?></p>
                        <p class="col-2"><?php echo($sum_amount); ?>個</p>
                    </div>
                <a href="item_list.php" class="d-block text-center">商品一覧へ</a>
            </main>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js"></script>
    </body>
    
</html>