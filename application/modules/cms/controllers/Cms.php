<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cms extends MX_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->model('Cms_Model');
    }

    public function aboutus() {
        $data['content'] = $this->Cms_Model->get_cms('1');
        // echo $this->db->last_query();
        // echo '<pre>';print_r($data['content']);exit;
        $data['value'] = '1';
        $data['bread'] = 'About Us';
        $this->load->view('content', $data);
    }

    public function contactus() {
        $data['content'] = $this->Cms_Model->get_cms('6');
        $data['value'] = '6';
        $data['bread'] = 'Contact Us';
        $this->load->view('content', $data);
    }

    public function privacypolicy() {
        $data['content'] = $this->Cms_Model->get_cms('10');
        $data['value'] = '10';
        $data['bread'] = 'Privacy Policy';
        $this->load->view('content', $data);
    }
    public function termsandconditions() {
        $data['content'] = $this->Cms_Model->get_cms('11');
        $data['value'] = '11';
        $data['bread'] = 'Terms & Conditions';
        $this->load->view('content', $data);
    }

    public function testimonial() {
        $data['content'] = $this->Cms_Model->get_cms('5');
        $data['value'] = '5';
        $data['bread'] = 'Testimonial';
        $this->load->view('content', $data);
    }

    public function faq() {
        $data['content'] = $this->Cms_Model->get_cms('8');
        $data['value'] = '8';
        $data['bread'] = 'FAQs';
        $this->load->view('content', $data);
    }

    // public function refundpolicy() {
    //     $data['content'] = $this->Cms_Model->get_cms('7');
    //     $data['value'] = '7';
    //     $data['bread'] = 'Refund Policy';
    //     $this->load->view('content', $data);
    // }

    public function cancel_policy() {
        $data['content'] = $this->Cms_Model->get_cms('8');
        $data['value'] = '8';
        $data['bread'] = 'Cancellation Policy';
        $this->load->view('content', $data);
    }
    
    public function price_details() {
        $data['content'] = $this->Cms_Model->get_cms('23');
        $data['value'] = '23';
        $data['bread'] = 'Price Details';
        $this->load->view('content', $data);
    }
    
     public function support() {
        $data['content'] = $this->Cms_Model->get_cms('7');
        // echo $this->db->last_query();
        // echo '<pre>';print_r($data['content']);exit;
        $data['value'] = '7';
        $data['bread'] = 'Support';
        $this->load->view('content', $data);
    }
    //  public function contactus() {
    //     //$data['bread'] = 'Contact Us';
    //     $this->load->view('contactus');
    // }
    public function equire_now() {
        // echo '<pre>';print_r($_POST);exit;
        //$data['bread'] = 'Contact Us';
        $data['username'] = $_POST['username'];
        $data['useremail'] = $_POST['useremail'];
        $data['usermobile'] = $_POST['usermobile'];
        $data['usermessage'] = $_POST['usermessage'];
        $this->load->module('home/sendemail');
         if ($this->sendemail->contact_enquiry($data)) {
           // echo 123;exit;
                $message = 'Message sent successfully.';
            } else {
                $message = 'Message sending failed. Please try after some time...';
            }
        $this->session->set_flashdata('message', $message);
        //$this->Cms_Model->insert_enquiries($data);
        redirect('cms/contactus', 'refresh');
    }


   
}