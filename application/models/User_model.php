<?php

/**
 * Created by PhpStorm.
 * User: alcorrius
 * Date: 18.07.17
 * Time: 21:30
 */
class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    protected $table = 'users';

    public function check_is_user_exist($email)
    {
        $this->load->database();
        $query = $this->db->get_where($this->table, array('email' => $email));
        return $query->row();
    }

    public function insert_user()
    {
        $data = array();
        $data['name'] = $_POST['name'];
        $data['cpf'] = $_POST['cpf'];
        $data['email'] = $_POST['email'];

        $this->db->insert($this->table, $data);

        return $this->db->insert_id();
    }

    public function update_user($id)
    {
        $data = array();
        $data['name'] = $_POST['name'];
        $data['cpf'] = $_POST['cpf'];
        $data['email'] = $_POST['email'];

        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }
}