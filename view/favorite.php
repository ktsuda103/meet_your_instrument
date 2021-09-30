<!DOCKTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>お気に入り</title>
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
                <!-- 検索フォーム -->
                <div class="row">
                    <div class="col-md-4 pr-0">
                        <div class="card m-0">
                            <div class="card-header">検索</div>
                            <div class="card-body my-card-body">
                                <?php if(!empty($message['add'])): ?>
                                    <div class="alert alert-success text-left" role="alert">
                                        <?php echo $message['add']; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if(!empty($message['delete_favorite'])): ?>
                                    <div class="alert alert-success" role="alert">
                                        <?php echo $message['delete_favorite']; ?>
                                    </div>
                                <?php endif; ?>
                        
                                <form method="post">
                                    <input type="hidden" name="process_kind" value="search">
                                    <div class="form-group">
                                        <?php if(isset($number)): ?>
                                            <div class="alert alert-success" role="alert">
                                                検索結果:<?php echo $number['cnt']; ?>件
                                            </div>
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
                                    <div class="alert alert-success" role="alert">
                                        <p><?php echo $message['search']; ?></p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- お気に入り一覧 -->
                    
                    <div class="col-md-8 pl-0">
                        <h1 class="title">お気に入り一覧</h1>
                        <div class="container">
                            <div class="row">
                            <?php if(!empty($favorites)): ?>
                                <?php foreach($favorites as $favorite): ?>
                                <div class="card col-md-4">
                                    <div class="card-header">
                                        <?php echo h($favorite['name']); ?>
                                        <form method="post" class="d-inline">
                                            <input type="hidden" name="process_kind" value="delete_favorite">
                                            <input type="hidden" name="favorite_id" value="<?php echo h($favorite['favorite_id']); ?>">
                                            <input type="submit" value="&#xf1f8;" class="fas icon">
                                        </form>
                                        <!-- カートに追加 -->
                                        <?php if((int)$favorite['stock'] > 0): ?>
                                        <form method="post" class="d-inline">
                                            <input type="hidden" name="process_kind" value="add_cart">
                                            <input type="hidden" name="user_id" value="<?php echo h($favorite['user_id']); ?>">
                                            <input type="hidden" name="item_id" value="<?php echo h($favorite['id']); ?>">
                                            <input type="submit" value="&#xf217;" class="fas icon">
                                        </form>
                                        <?php else: ?>
                                        <div class="small d-inline" style="color: red;">売り切れ</div>
                                        <?php endif; ?>
                                        
                                    </div>
                                    <div class="card-body">
                                        <img src="./img/<?php echo h($favorite['img']); ?>" class="img-fluid item-image">
                                    </div>
                                    <div class="card-footer">
                                        <p class="card-text">価格：¥<?php echo number_format(h($favorite['price'])); ?></p>
                                        
                                        <!-- 詳細ページへ -->
                                        <form action="item_detail.php" method="post">
                                            <input type="hidden" name="id" value="<?php echo h($favorite['id']); ?>">
                                            <button type="submit" class="d-block w-100 btn btn-info">詳細</button>
                                        </form>
                                        <!-- 出品者のページ -->
                                        <form action="user.php" method="post">
                                            <input type="hidden" name="user_id" value="<?php echo h($favorite['user_id']); ?>">
                                            <button type="submit" class="d-block w-100 btn btn-info">出品者のページ</button>
                                        </form>
                                        
                                        
                                    </div>
                                </div>    
                                <?php endforeach; ?>
                            <?php else: ?>
                            <div class="alert alert-danger w-100" role="alert">
                                お気に入り登録されている商品はありません。
                            </div>
                            <?php endif; ?>
                        </div>
                        </div>
                        
                    </div>
                </div>
            </main>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js"></script>
    </body>
    
</html>