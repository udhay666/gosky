<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class login extends CI_Controller {
    // private $supplier_id;

    public function __construct() {
        parent::__construct();
        $this->load->model('Login_Model');
        // $this->supplier_id = $this->session->userdata('supplier_id');
        // $this->is_logged_in();
    }

    private function is_logged_in() {
        if (!$this->session->userdata('supplier_logged_in')) {
            redirect('home/index');
        }
    }

    public function index() {
            // echo '<pre/>';print_r($res);exit;

        $this->form_validation->set_rules('loginEmailId', 'Email-Id', 'trim|required');
        $this->form_validation->set_rules('loginPassword', 'Password', 'trim|required');
        $data['status'] = '';
        if ($this->form_validation->run() !== FALSE) {
            $loginEmailId = $this->input->post('loginEmailId');
            $loginPassword = $this->input->post('loginPassword');
            $res = $this->Login_Model->validate_credentials($loginEmailId, $loginPassword);
            // echo '<pre/>';print_r($res);exit;
            if ($res !== false) {
                $sessionSupplierInfo = array(
                    'supplier_id' => $res->supplier_id,
                    'supplier_email' => $res->supplier_email,
                    'supplier_name' => $res->first_name,
                    'supplier_logged_in' => TRUE
                    );
                $this->session->set_userdata($sessionSupplierInfo);
                $this->Login_Model->insert_login_activity();
                redirect('home/dashboard', 'refresh');
            } else {
                $data['status'] = 'Sign-In Failed. Please check Sign-In details';
            }
        }
        $this->load->view('login', $data);
    }


    public function supplier_login() {
            // echo '<pre/>';print_r($_POST);//exit;

        $this->form_validation->set_rules('loginEmailId', 'Email-Id', 'trim|required');
        $this->form_validation->set_rules('loginPassword', 'Password', 'trim|required');
        $data['status'] = '';
        if ($this->form_validation->run() !== FALSE) {
            $loginEmailId = $this->input->post('loginEmailId');
            $loginPassword = $this->input->post('loginPassword');
            $res = $this->Login_Model->validate_credentials($loginEmailId, $loginPassword);
                    // echo '123<pre/>';print_r($res);exit;
            if ($res !== false) {
                $sessionSupplierInfo = array(
                    'supplier_id' => $res->supplier_id,
                    'supplier_no' => $res->supplier_no,
                    'supplier_email' => $res->supplier_email,
                    'supplier_name' => $res->first_name,
                    'supplier_logged_in' => TRUE
                    );
                $this->session->set_userdata($sessionSupplierInfo);
                $this->Login_Model->insert_login_activity();
                redirect('home/dashboard', 'refresh');
            } else {
                $data['status'] = 'Sign-In Failed. Please check Sign-In details';
            }
        }
        $this->load->view('login', $data);
    }

    public function supplier_logout() {
        $this->session->unset_userdata('admin_id');
        $this->session->unset_userdata('admin_email');
        $this->session->unset_userdata('admin_name');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('admin_logged_in');
        $this->session->sess_destroy();
        redirect('home', 'refresh');
    }


}