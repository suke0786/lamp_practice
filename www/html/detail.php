<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';
require_once MODEL_PATH . 'history.php';

session_start();

if(is_logined() === false) {
    redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);
$history_id = $_POST['history_id'];

$history = get_user_detail($db,$history_id);

$detail = get_history_detail($db,$history_id);

$total_price = sum_history($history);


include_once VIEW_PATH . 'detail_view.php';