<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {
    public function index()
	{		
        $data["data"] = $this->db->query("select * from t_event order by tanggal desc");
		$this->load->view('event/list',$data);
	}
	public function add(){
		$this->load->view("event/form");
	}
	public function edit(){
		$this->db->where("id",$this->input->post("id"));
		$user = $this->db->get("t_event")->row();
		$data["data"] = $user;
		$this->load->view("event/form_edit",$data);
	}
	public function save(){
		$data["tanggal"] = $this->input->post("tanggal");
		$data["nama"] = $this->input->post("nama");
		$data["keterangan"] = $this->input->post("keterangan");
		$data["tempat"] = $this->input->post("tempat");
		$data["jam"] = $this->input->post("jam");
		$this->db->insert("t_event",$data);

        $this->session->set_userdata("page","event");
        $this->session->set_userdata("page_header","Kegiatan");
        redirect('/main', 'location');
	}

	public function update(){
		$data["tanggal"] = $this->input->post("tanggal");
		$data["nama"] = $this->input->post("nama");
		$data["keterangan"] = $this->input->post("keterangan");
		$data["tempat"] = $this->input->post("tempat");
		$data["jam"] = $this->input->post("jam");
		$this->db->where("id",$this->input->post("id"));
		$this->db->update("t_event",$data);

        $this->session->set_userdata("page","event");
        $this->session->set_userdata("page_header","Kegiatan");
        redirect('/main', 'location');
	}
	public function delete(){
		$this->db->where("id",$this->input->post("id"));
		$this->db->delete("t_event");
	}
} 