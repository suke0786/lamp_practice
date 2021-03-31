<!DOCTYPE html>
<html lang='ja'>
<head>
    <?php include VIEW_PATH . 'templates/head.php'; ?>
    <title>購入履歴</title>
    <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'index.css'); ?>">
</head>
<body>
    <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
    <h1>購入履歴</h1>

    <div class="container">
        <?php include VIEW_PATH . 'templates/messages.php'; ?>

        <?php //if(count($carts) > 0){　ここに$history>0を作る ?>
        
            <table>
                <thead>
                    <tr>
                        <th>注文番号</th>
                        <?php if($user['name'] === 'admin'){?>
                        <th>購入者ID</th>
                        <?php } ;?>
                        <th>購入日時</th>
                        <th>合計金額</th>
                    </tr>
                </thead>
                <thbody>
                <?php foreach ($history as $history) {?>
                    <form action='detail.php' method="post">
                        <tr>
                            <th><?php print $history['history_id'];?></th>
                            <?php if($user['name'] === 'admin'){?>
                            <th><?php print $history['user_id'];?></th>
                            <?php } ;?>
                            <th><?php print $history['purchase_datetime'];?></th>
                            <th><?php print $total_price[$history['history_id']];?></th>
                            <th><input type="hidden" name='history_id' value="<?php print $history['history_id'];?>"></th>
                            <th><input type="submit" name="detail" value="購入明細"></th>
                        </tr>
                    </form>
                    <?php } ;?>
                </thbody>
            </table>
    
    </div>
</body>
</html>