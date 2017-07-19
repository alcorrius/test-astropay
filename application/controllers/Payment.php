<?php

/**
 * Created by PhpStorm.
 * User: alcorrius
 * Date: 18.07.17
 * Time: 15:55
 *
 * @property CI_Input $input
 * @property User_model $user_model
 * @property Order_model $order_model
 */
class Payment extends CI_Controller
{
    /**
     * Payment constructor.
     */
    public function __construct(){
        parent::__construct();
        $this->load->library('TestAstropayStreamline');
        $this->load->model('order_model');
    }

    /**
     *
     */
    public function index()
    {
        $user_id = 0;
        $order_id = 0;
        $user_name = $this->input->post('name');
        $user_cpf = $this->input->post('cpf');
        $user_email = $this->input->post('email');
        $amount = $this->input->post('amount');
        $currency = $this->input->post('currency');

        $this->load->model('user_model');

        if(isset($user_email) && !empty($user_email)) {
            $user = $this->user_model->check_is_user_exist($user_email);
            if (!empty($user)) {
                $this->user_model->update_user($user->id);
                $user_id = $user->id;
            } else {
                $user_id = $this->user_model->insert_user();
            }

            if (!empty($user_id)) {
                $order_id = $this->order_model->insert_order($user_id, $amount);
            }

            if (!empty($order_id)) {
                $aps = new AstroPayStreamline();

                $result = $aps->newinvoice($order_id, $amount, 'TE', 'BR', $user_id, $user_cpf, $user_name, $user_email, $currency, null, null, null, null, null, null, 'http://192.168.1.103/payment/result', 'http://192.168.1.103/payment/confirm');
                $result_encoded = json_decode($result);

                if ($result_encoded->status == 0) {
                    redirect($result_encoded->link, 'location');
                } else {
                    $this->raise_error($result_encoded->desc);
                }
            } else {
                $this->raise_error("Can not create order");
            }
        } else {
            $this->raise_error("Empty Email");
        }
    }

    /**
     *
     */
    public function result()
    {
        $result = $this->input->post('result');
        $order_id = $this->input->post('x_invoice');
        $user_id = $this->input->post('x_iduser');
        $description = $this->input->post('x_description');
        $transaction_id = $this->input->post('x_document');
        $amount = $this->input->post('x_amount');
        $control = $this->input->post('x_control');

        $control_check = TestAstropayStreamline::get_sign($result.$amount.$order_id);

        if($control == $control_check){
            $this->load->model('result_codes');
            $data['message'] = Result_codes::$codes[$result];
            $data['order_id'] = $order_id;

            if($result != Result_codes::SUCCESS_PAID){
                $this->load->view('general/header');
                $this->load->view('payment/failed', $data);
                $this->load->view('general/footer');
            } else {
                $this->order_model->update_order($order_id, $result, $transaction_id);

                $this->load->view('general/header');
                $this->load->view('payment/success', $data);
                $this->load->view('general/footer');
            }
        } else {
            $this->raise_error("Security control error");
        }
    }

    /**
     *
     */
    public function confirm()
    {
        $result = $this->input->post('result');
        $order_id = $this->input->post('x_invoice');
        $user_id = $this->input->post('x_iduser');
        $description = $this->input->post('x_description');
        $transaction_id = $this->input->post('x_document');
        $amount = $this->input->post('x_amount');
        $control = $this->input->post('x_control');

        $control_check = TestAstropayStreamline::get_sign($result.$amount.$order_id);

        if($control == $control_check){
            $this->load->model('result_codes');
            $data['message'] = Result_codes::$codes[$result];

            if($result != Result_codes::SUCCESS_PAID){
                log_message('error', "Confirmation of order {$order_id} was failed: {$data['message']}");
            } else {
                $this->order_model->update_order($order_id, null, null, $result, $transaction_id);

                log_message('notification', "Confirmation of order {$order_id} was success: {$data['message']}");
            }
        } else {
            log_message('error', "Confirmation of order {$order_id} was failed: wrong control value");
        }
    }

    public function status()
    {
        $order_id = $this->input->post('order_id');
        $aps = new AstroPayStreamline();
        $response = $aps->get_status($order_id);

        $data = array(
            'response' => $response
        );

        $this->load->view('general/header');
        $this->load->view('payment/status', $data);
        $this->load->view('general/footer');
    }

    /**
     * @param $text
     */
    private function raise_error($text)
    {
        $data = array(
            'error' => $text
        );
        $this->load->view('general/header');
        $this->load->view('cart', $data);
        $this->load->view('general/footer');
    }
}