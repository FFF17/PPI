<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
    function index(){
        if(!$this->session->username){            
            redirect('/login', 'location');
        }
        if($this->session->role == "admin"){
            $menu["dashboard"] = "1";
            $menu["anggota"] ="1";
            $menu["anggota_new"] ="1";
            $menu["anggota_list"] ="1";
            $menu["anggota_jabatan"] ="1";
            $menu["anggota_berita"] ="1";
            $menu["kebenduman"] ="1";
            $menu["kebenduman_dashboard"] ="1";
            $menu["kebenduman_iuran"] ="1";
            $menu["kebenduman_konfirmasi"] ="1";
            $menu["kebenduman_kas"] ="1";
            $menu["kebenduman_master"] ="1";
            $menu["master"] ="1";
            $menu["master_kegiatan"] ="1";
            $menu["master_jabatan"] ="1";
            $menu["master_gedung"] ="1";
        }else if($this->session->role == "dpc"){
            $menu["kebenduman"] = "1";
            $menu["kebenduman_kas"] ="1";
        }else if($this->session->role == "dpd"){
            $menu["kebenduman"] = "1";
            $menu["kebenduman_kas"] ="1";
        }else if($this->session->role == "staff_bendum"){
            $menu["kebenduman"] = "1";
            $menu["kebenduman_iuran"] ="1";
            $menu["kebenduman_kas"] ="1";
        }else if($this->session->role == "sekretaris_bendum"){
            $menu["kebenduman"] = "1";
            $menu["kebenduman_iuran"] ="1";
            $menu["kebenduman_kas"] ="1";
            $menu["kebenduman_konfirmasi"] ="1";
            $menu["kebenduman_master"] ="1";
        }else if($this->session->role == "bendum"){
            $menu["kebenduman"] = "1";
            $menu["kebenduman_dashboard"] ="1";
            $menu["kebenduman_iuran"] ="1";
            $menu["kebenduman_kas"] ="1";
            $menu["kebenduman_konfirmasi"] ="1";
            $menu["kebenduman_master"] ="1";
        }
        $data["menu"] = $menu;
        $this->load->view("main",$data);
    }
    function logout(){
        $this->session->sess_destroy();
    }
}