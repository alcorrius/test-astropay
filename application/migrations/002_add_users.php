<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Migration_Add_users extends CI_Migration
{

    private $_create = [
        'CREATE TABLE `users` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) NOT NULL,
              `cpf` varchar(15) NOT NULL,
              `email` varchar(255) NOT NULL,
              `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;'
    ];

    private $_drop = [
        'DROP TABLE IF EXISTS `users`;'
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