<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';
require_once MODEL_PATH . 'cart.php';

function insert_history($db, $user_id){
    $sql = "
    INSERT INTO
      history(
        user_id
      )
    VALUES(?)
    ";
    return execute_query($db, $sql,[$user_id]);
}
  
function insert_detail($db,$history_id,$item_id,$amount,$price){
    $sql = "
    INSERT INTO
      detail(
        history_id,
        item_id,
        amount,
        price
      )
    VALUES(?, ?, ?, ?)
    ";
    return execute_query($db, $sql,[$history_id,$item_id,$amount,$price]);
}