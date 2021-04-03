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

function get_user_history($db,$user_name,$user_id) {
  if($user_name !== 'admin') {
    $sql = "
      SELECT 
        history.history_id,
        history.purchase_datetime,
        sum(detail.amount * detail.price)
      FROM
        history
      JOIN
        detail
      ON
        history.history_id = detail.history_id
      WHERE
        user_id = ?
      GROUP BY
        history.history_id
      ";
      return fetch_all_query($db,$sql,[$user_id]);
  } else {
    $sql = "
    SELECT 
      history.history_id,
      history.purchase_datetime,
      sum(detail.amount * detail.price)
    FROM
      history
    JOIN
      detail
    ON
      history.history_id = detail.history_id
    GROUP BY 
      history.history_id
      ";
      return fetch_all_query($db,$sql);
    }
}

function get_user_detail($db,$history_id) {
  $sql = "
    SELECT 
      history.history_id,
      history.purchase_datetime,
      sum(detail.amount * detail.price)
    FROM
      history
    JOIN
      detail
    ON
      history.history_id = detail.history_id
    WHERE
      history.history_id = ?
    GROUP BY
      detail.history_id
    ";
    return fetch_all_query($db,$sql,[$history_id]);
}

function get_history_detail($db,$history_id){
  $sql = "
    SELECT 
      items.name,
      detail.amount,
      detail.price
    FROM
      detail
    INNER JOIN
      items
    ON
      detail.item_id = items.item_id
    WHERE
      history_id = ?
    ";
  return fetch_all_query($db,$sql,[$history_id]);
}

function get_ranking_items($db) {
  $sql = "
  SELECT 
    sum(detail.amount), 
    items.name 
  FROM 
    detail 
  JOIN 
    items
  ON 
    detail.item_id = items.item_id 
  GROUP BY 
    detail.item_id 
  ORDER BY 
    sum(amount) 
  DESC LIMIT 3
  ";
  return fetch_all_query($db,$sql);
}

