<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {
    public function index()
	{		
        $data["data"] = $this->db->query("select * from m_jabatan order by tingkat,jabatan");
		$this->load->view('jabatan/list',$data);
	}
	public function add(){
		$this->load->view("jabatan/form");
	}
	public function edit(){
		$this->db->where("id",$this->input->post("id"));
		$user = $this->db->get("m_jabatan")->row();
		$data["data"] = $user;
		$this->load->view("jabatan/form_edit",$data);
	}
	public function save(){
		$data["tingkat"] = $this->input->post("tingkat");
		$data["jabatan"] = $this->input->post("jabatan");
		$this->db->insert("m_jabatan",$data);

        $this->session->set_userdata("page","jabatan");
        $this->session->set_userdata("page_header","Jabatan");
        redirect('/main', 'location');
	}

	public function update(){
		$data["tingkat"] = $this->input->post("tingkat");
		$data["jabatan"] = $this->input->post("jabatan");
		$this->db->where("id",$this->input->post("id"));
		$this->db->update("m_jabatan",$data);

        $this->session->set_userdata("page","jabatan");
        $this->session->set_userdata("page_header","Jabatan");
        redirect('/main', 'location');
	}
	public function delete(){
		$this->db->where("id",$this->input->post("id"));
		$this->db->delete("m_jabatan");
	}
} 