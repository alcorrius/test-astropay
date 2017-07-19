<?php

/**
 * Created by PhpStorm.
 * User: alcorrius
 * Date: 18.07.17
 * Time: 10:14
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller
{
    public function index()
    {
        $this->load->view('welcome_message');
    }
}