<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: alcorrius
 * Date: 18.07.17
 * Time: 14:40
 */
class Cart extends CI_Controller
{
    public function index()
    {
        $this->load->view('general/header');
        $this->load->view('cart');
        $this->load->view('general/footer');
    }
}