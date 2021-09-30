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
            
            <main>
                <div class="row">
                    <!-- 検索フォーム -->
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
                        <div class="card">
                            <div class="card-header">
                                <div><?php echo h($item_data['name']); ?></div>
                            </div>
                            <div class="card-body my-card-body">
                                <div class="row">
                                    <img src="./img/<?php echo h($item_data['img']); ?>" class="img-fluid big-item-image col-md-6">
                                    <div class="col-md-6">
                                        <p class="price">価格：¥<?php echo number_format(h($item_data['price'])); ?></p>
                                    <p>在庫数：<?php echo h($item_data['stock']); ?>台</p>
                                    <p>楽器種類：<?php echo h($item_data['type']); ?></p>
                                    <p>備考：<?php echo h($item_data['comment']); ?></p>
                                    <?php if($item_data['user_id'] !== $user_data['id']): ?>
                                        <?php if($item_data['stock'] === '0'): ?>
                                        <p class="btn btn-danger w-50">売り切れです！</p>
                                        
                                        <?php else: ?>
                                        <form method="post" class="d-inline">
                                            <input type="hidden" name="process_kind" value="add_cart">
                                            <input type="hidden" name="user_id" value="<?php echo h($item_data['user_id']); ?>">
                                            <input type="hidden" name="item_id" value="<?php echo h($item_data['id']); ?>">
                                            <button class="btn btn-warning w-50">カートに入れる</button>
                                        </form>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <!-- 出品者のページ -->
                                     <a href="./user.php?id=<?php echo h($item_data['user_id']); ?>" class="d-block w-50 btn btn-info">出品者のページへ</a>  
                                    </div>
                                    
                                </div>
                                    
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