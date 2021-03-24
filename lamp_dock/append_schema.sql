CREATE TABLE history (
 history_id INT AUTO_INCREMENT,
 user_id INT(10) NOT NULL,
 item_id INT(10) NOT NULL,
 amount INT(10) NOT NULL,
 purchase_datetime DATETIME DEFAULT CURRENT_TIMESTAMP,
 primary key(history_id)
);