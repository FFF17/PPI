<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    function index(){
        $this->load->view("login");
        if($this->session->username){            
            redirect('/main', 'location');
        }
    }
    function submit(){
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $query = $this->db->query("select * from m_users where username = '".$username."' and password = md5('".$password."')");
        if($data = $query->row()){
            $this->session->set_userdata("username",$data->username);
            $this->session->set_userdata("name",$data->nama);
            $this->session->set_userdata("role",$data->role);
        }else{
            echo "Username atau password tidak sesuai";
        }
    }
}