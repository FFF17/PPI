<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller {
    public function index()
	{		
        $data["data"] = $this->db->query("select t_berita.*,m_anggota.nama from t_berita inner join m_anggota on m_anggota.id = t_berita.created_by order by id desc");
		$this->load->view('berita/list',$data);
    }
    public function detail()
    {
        $id = $this->input->post("id");
        $data["data"] = $this->db->query("select t_berita.*,m_anggota.nama from t_berita inner join m_anggota on m_anggota.id = t_berita.created_by where t_berita.id = '$id'")->row();
		$this->load->view('berita/detail',$data);
    }
} 