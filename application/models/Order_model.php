<?php

/**
 * Created by PhpStorm.
 * User: alcorrius
 * Date: 18.07.17
 * Time: 21:30
 */
class Order_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    protected $table = 'orders';

    public function insert_order($user_id, $amount)
    {
        $data = array();
        $data['user_id'] = $user_id;
        $data['amount'] = $amount;

        $this->db->insert($this->table, $data);

        return $this->db->insert_id();
    }

    public function update_order($id, $status_id, $transaction_id, $confirm_id = null, $confirm_transaction_id = null)
    {
        $data = array();
        $data['status_id'] = $status_id;
        $data['transaction_id'] = $transaction_id;
        $data['confirm_id'] = $confirm_id;
        $data['confirm_transaction_id'] = $confirm_transaction_id;

        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }
}