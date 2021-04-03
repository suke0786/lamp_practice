<!DOCTYPE html>
<html lang='ja'>
<head>
    <?php include VIEW_PATH . 'templates/head.php'; ?>
    <title>購入明細</title>
    <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'index.css'); ?>">
</head>
<body>
    <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
    <h1>購入明細</h1>
    
    <div class="container">
        <?php include VIEW_PATH . 'templates/messages.php'; ?>

        <?php //if(count($carts) > 0){　ここに$history>0を作る ?>
        
        <div class='history'>
            <table>
                <thead>
                    <tr>
                        <th>注文番号</th>
                        <th>購入日時</th>
                        <th>合計金額</th>
                    </tr>
                </thead>
                <thbody>
                <?php foreach ($history as $history) {?>
                        <tr>
                            <th><?php print $history['history_id'];?></th>
                            <th><?php print $history['purchase_datetime'];?></th>
                            <th><?php print $history["sum(detail.amount * detail.price)"];?></th>
                        </tr>
                    <?php } ;?>
                </thbody>
            </table>
        </div>
    
        <table>
            <thead>
                <tr>
                    <th>商品名</th>
                    <th>購入価格</th>
                    <th>購入数</th>
                    <th>小計</th>
                </tr>
            </thead>
            <thbody>
            <?php foreach ($detail as $detail) {?>
                    <tr>
                        <th><?php print $detail['name'];?></th>
                        <th><?php print $detail['price'];?></th>
                        <th><?php print $detail['amount'];?></th>
                        <th><?php print $detail['amount'] * $detail['price'];?></th>
                    </tr>
                <?php } ;?>
            </thbody>
        </table>
    </div>
</body>
</html>