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

function get_user_history($db,$user_id) {
  $sql = "
    SELECT 
      history.history_id,
      history.purchase_datetime,
      detail.amount,
      detail.price
    FROM
      history
    JOIN
      detail
    ON
      history.history_id = detail.history_id
    WHERE
      user_id = ?
    ";
    return fetch_all_query($db,$sql,[$user_id]);
}

function sum_history($history) {
  for($i=1; $i<=count($history); $i++){
    $total_price = array();
    foreach($history as $histories) {
      $id_price = 0;
      if($i = $histories['history_id']){
          $id_price += $histories['price'] * $histories['amount'];
      }
      $total_price += array($histories['history_id']=>$id_price);
    }
  }
  return $total_price;
}
