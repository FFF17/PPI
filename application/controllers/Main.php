<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
    function index(){
        if(!$this->session->username){            
            redirect('/login', 'location');
        }
        $this->load->view("main");
    }
    function logout(){
        $this->session->sess_destroy();
    }
}