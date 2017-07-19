<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: alcorrius
 * Date: 18.07.17
 * Time: 11:42
 */
class TestAstropayStreamline
{
    private static $x_login = 'YIVgtLkT4c';
    private static $secret_key = 'te4QZabbxpLKuwuUJvHTkvvr8PxWm3LML';

    public function __construct()
    {
        require_once APPPATH . 'third_party/astropay/AstroPayStreamline.class.php';
    }

    public static function get_sign($message)
    {
        $message = self::$x_login.$message;
        return strtoupper(hash_hmac('sha256', pack('A*', $message), pack('A*', self::$secret_key)));
    }
}