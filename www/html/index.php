<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'history.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$token = get_csrf_token();

$db = get_db_connect();
$user = get_login_user($db);

$items = get_open_items($db);

$items_ranking = get_ranking_items($db);

include_once VIEW_PATH . 'index_view.php';