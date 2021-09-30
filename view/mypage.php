<!DOCKTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>マイページ</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="stylesheet" href="./style.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

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
                <div class="col-md-8 pl-0">
                    <div class="card m-0">
                        <div class="card-header">あなたのページ</div>
                        <div class="card-body">
                            <img src="./img/<?php echo $user_data['img']; ?>" class="icon-image">
                            <div>
                                <p class="user_data">ユーザID：<?php echo $user_data['user_id']; ?></p>
                                <p class="user_data">メールアドレス：<?php echo $user_data['email']; ?></p>
                                <div class="row">
                                    <ul class="col-md-4">
                                        <li><a href="history.php" class="d-block"><i class="fas fa-history mr-2"></i>購入一覧</a></li>
                                        <li><a href="add_product.php" class="d-block"><i class="fas fa-store mr-2"></i>出品する</a></li>
                                        <li><a href="user_list.php"  class="d-block">ユーザー一覧ページへ</a></li>
                                    </ul>
                                    <ul class="col-md-4">
                                        <li><a href="favorite.php" class="d-block"><i class="fas fa-heart mr-2"></i>お気に入り</a></li>
                                        <li><a href="friend.php" class="d-block"><i class="fas fa-user-friends mr-2"></i>友達一覧</a></li>    
                                    </ul>
                                </div>
                            </div>
                            <hr>
                            <h4>出品した商品</h4>
                            <?php if(!empty($message['delete'])): ?>
                                <p class="done"><?php echo $message['delete']; ?></p>
                            <?php endif; ?>
                            <?php if(!empty($message['stock'])): ?>
                                <p class="done"><?php echo $message['stock']; ?></p>
                            <?php endif; ?>
                            <?php if(!empty($message['publish_status'])): ?>
                                <p class="done"><?php echo $message['publish_status']; ?></p>
                            <?php endif; ?>
                                        
                            <div class="row">
                                <?php foreach($items_data as $item_data): ?>
                                <?php if($user_data['id'] === $item_data['user_id']): ?>
                                <div class="card col-md-4">
                                    <div class="card-header">
                                        <div class="d-inline"><?php echo h($item_data['name']); ?></div>
                                        <form method="post" class="d-inline">
                                            <input type="hidden" name="process_kind" value="delete_item_data">
                                            <input type="hidden" name="id" value="<?php echo h($item_data['id']); ?>">
                                            <input type="submit" value="&#xf1f8;" class="fas" style="border: none;">
                                        </form>
                                    </div>
                                    <div class="card-body text-center">
                                        <img src="./img/<?php echo h($item_data['img']); ?>" class="img-fluid item-image">
                                    </div>
                                    <div class="card-footer">
                                        <p class="card-text price">価格：¥<?php echo number_format(h($item_data['price'])); ?></p>
                                        <!-- 詳細ページへ -->
                                        <form action="item_detail.php" method="post">
                                            <input type="hidden" name="id" value="<?php echo h($item_data['id']); ?>">
                                            <button type="submit" class="btn btn-info w-100">詳細</button>
                                        </form>
                                        
                                        <form method="post">
                                            <input type="hidden" name="process_kind" value="update_stock">
                                            <input type="hidden" name="id" value="<?php echo h($item_data['id']); ?>">
                                            <input type="text" value="<?php echo h($item_data['stock']); ?>" name="stock">個
                                            <button type="submit" class="btn btn-warning">変更する</button>
                                        </form>
                                        
                                        <form method="post">
                                            <input type="hidden" name="process_kind" value="update_publish_status">
                                            <input type="hidden" name="id" value="<?php echo h($item_data['id']); ?>">
                                            <?php if($item_data['status'] === '0'): ?>
                                                <button type="submit" class="d-block w-100 btn btn-secondary">非公開→公開</button>
                                                <input type="hidden" name="publish_status" value="1">
                                            <?php endif; ?>
                                            <?php if($item_data['status'] === '1'): ?>    
                                                <button type="submit" class="d-block w-100 btn btn-warning">公開→非公開</button>
                                                <input type="hidden" name="publish_status" value="0">
                                            <?php endif; ?>    
                                        </form>
                                        
                                    </div>
                                </div> 
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </main>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js"></script>
    </body>
    
</html>