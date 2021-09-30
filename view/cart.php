<!DOCKTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ショッピングカートページ</title>
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
            <!-- メインコンテンツ -->
            <main>
                <div class="row">
                    <div class="col-md-4 pr-0">
                        <div class="card m-0">
                            <div class="card-header">検索</div>
                            <div class="card-body my-card-body">
                                <?php if(!empty($message['add'])): ?>
                                    <div class="alert alert-success" role="alert">
                                        <?php echo $message['add']; ?>
                                    </div>
                                <?php endif; ?>
                                <form method="post" action="item_list.php">
                                    <input type="hidden" name="process_kind" value="search">
                                    <div class="form-group">
                                        <?php if(isset($number)): ?>
                                        <p>検索結果:<?php echo $number['cnt']; ?>件</p>
                                        <?php endif; ?>
                                        <label for="keyword">キーワード検索</label>
                                        <input class="form-control" type="text" id="keyword" name="keyword" placeholder="キーワードを入力してください">
                                    </div>
                                    <div class="form-group">
                                        <label for="type">楽器種類検索</label>
                                        <select class="form-control" type="text" id="type" name="type">
                                            <option value=''>選択してください</option>
                                            <option value="弦楽器">弦楽器</option>
                                            <option value="木管楽器">木管楽器</option>
                                            <option value="金管楽器">金管楽器</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">検索</button>
                                    </div>
                                </form>
                                <?php if(!empty($message['search'])): ?>
                                    <p><?php echo $message['search']; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="container">
                            <?php if(!empty($message['update_amount'])): ?>
                                <p class="done"><?php echo $message['update_amount']; ?></p>
                            <?php endif; ?>
                            <?php if(!empty($message['delete_cart'])): ?>
                                <p class="done"><?php echo $message['delete_cart']; ?></p>
                            <?php endif; ?>
                            <?php if(!empty($message['buy'])): ?>
                                <p class="done"><?php echo $message['buy']; ?></p>
                            <?php endif; ?>
                            <h3 class="title">ショッピングカート</h3>
                            <div class="cart_item_list_head row">
                                <span class="col-2">写真</span>
                                <span class="col-6">商品名</span>
                                <span class="col-2">価格</span>
                                <span class="col-2">数量</span>    
                            </div>
                            
                            <!-- カートの中身 -->
                            <?php if(!empty($carts_data)): ?>
                                <div class="cart_item_list row">
                                    <?php foreach($carts_data as $cart_data): ?>
                                        <?php if($cart_data['user_id'] === $user_data['id']): ?>
                                        <img src="./img/<?php echo h($cart_data['img']); ?>" class="img-fluid col-2">
                                        <span class="col-4"><?php echo h($cart_data['name']); ?></span>
                                        <form class="col-2" method="post">
                                            <input type="hidden" name="process_kind" value="delete_cart">
                                            <input type="hidden" name="id" value="<?php echo h($cart_data['id']); ?>">
                                            <button type="submit" class="btn btn-secondary">削除</button>
                                        </form>    
                                        <span class="col-2">¥<?php echo number_format(h($cart_data['price'])); ?></span>
                                        <form class="col-2 form-group" method="post">
                                            <input type="hidden" name="process_kind" value="update_amount">
                                            <input type="hidden" name="id" value="<?php echo h($cart_data['id']); ?>">
                                            <input type="text" class="form-control" name="amount" value="<?php echo h($cart_data['amount']); ?>">
                                            <button type="submit" class="btn btn-secondary">変更</button>
                                        </form>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    
                                </div>
                                
                                <div class="row">
                                    <?php if(!empty($carts_data)): ?>
                                        <p class="offset-8 col-4">合計：¥<?php echo number_format($sum); ?></p>
                                    <?php endif; ?>
                                    <form class="offset-8 col-4" method="post">
                                        <input type="hidden" name="process_kind" value="buy">
                                        <button type="submit" class="btn btn-warning w-100">購入する</button>
                                    </form>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-danger w-100" role="alert">
                                    カートは空です。
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>            
            </main>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js"></script>
    </body>
    
</html>