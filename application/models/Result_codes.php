<?php
/**
 * Created by PhpStorm.
 * User: alcorrius
 * Date: 19.07.17
 * Time: 5:05
 */
class Result_codes
{
    const SUCCESS_PAID = 9;

    /**
     * @var array
     */
    public static $codes = array(
        6 => 'Transaction not found in the system',
        7 => 'Pending transaction awaiting approval',
        8 => 'Operation rejected by the bank',
        self::SUCCESS_PAID => 'Amount Paid. Transaction successfully concluded'
    );
}