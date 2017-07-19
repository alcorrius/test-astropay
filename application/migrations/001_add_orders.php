<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Migration_Add_orders extends CI_Migration
{

    private $_create = [
        'CREATE TABLE `orders` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `user_id` int(11) NOT NULL,
              `amount` varchar(255) NOT NULL,
              `status_id` TINYINT(2),
              `transaction_id` INT(11),
              `confirm_id` TINYINT(2),
              `confirm_transaction_id` INT(11),
              `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;'
    ];

    private $_drop = [
        'DROP TABLE IF EXISTS `orders`;'
    ];

    public function up()
    {
        $this->down();
        foreach ($this->_create as $table) {
            $this->db->query($table);
        }
    }

    public function down()
    {
        foreach ($this->_drop as $table) {
            $this->db->query($table);
        }
    }


}