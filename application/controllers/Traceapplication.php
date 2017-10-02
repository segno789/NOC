<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Traceapplication extends CI_Controller {

    /**
    * Index Page for this controller.
    *
    * Maps to the following URL
    *         http://example.com/index.php/welcome
    *    - or -
    *         http://example.com/index.php/welcome/index
    *    - or -
    * Since this controller is set as the default controller in
    * config/routes.php, it's displayed at http://example.com/
    *
    * So any other public methods not prefixed with an underscore will
    * map to /index.php/welcome/<method_name>
    * @see http://codeigniter.com/user_guide/general/urls.html
    */
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        //this condition checks the existence of session if user is not accessing  
        //login method as it can be accessed without user session
       define('HEADER_TITLE', 'ONLINE TRACE YOUR APPLICATION');
    }
    public function index()
    {
        $data = array(
            'isselected' => '3', 
        );
        $this->load->library('session');

        $error ="";

        if($this->session->flashdata('downerror'))
        {
            $error = $this->session->flashdata('downerror');
        }
        else{
            $error = "";
        }
        $this->load->view('common/commonheader_Verification.php');
        $mydata = array('error'=>$error);
        $this->load->view('Traceapplication/default.php',$mydata);
        $this->load->view('common/verfooter.php');
    }
 
}