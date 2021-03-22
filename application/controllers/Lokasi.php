<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi extends CI_Controller {
    public function index()
	{		
        $data["data"] = $this->db->query("select * from m_building order by id desc");
		$this->load->view('lokasi/list',$data);
	}
	public function add(){
		$this->load->view("lokasi/form");
	}
	public function edit(){
		$this->db->where("id",$this->input->post("id"));
		$user = $this->db->get("m_building")->row();
		$data["data"] = $user;
		$this->load->view("lokasi/form_edit",$data);
	}
	public function save(){
		$data["geo_lat"] = $this->input->post("geo_lat");
		$data["geo_long"] = $this->input->post("geo_long");
		$data["nama"] = $this->input->post("nama");
		$data["alamat"] = $this->input->post("alamat");
		$this->db->insert("m_building",$data);

        $this->session->set_userdata("page","lokasi");
        $this->session->set_userdata("page_header","Kantor");
        redirect('/main', 'location');
	}

	public function update(){
		$data["geo_lat"] = $this->input->post("geo_lat");
		$data["geo_long"] = $this->input->post("geo_long");
		$data["nama"] = $this->input->post("nama");
		$data["alamat"] = $this->input->post("alamat");
		$this->db->where("id",$this->input->post("id"));
		$this->db->update("m_building",$data);

        $this->session->set_userdata("page","lokasi");
        $this->session->set_userdata("page_header","Kantor");
        redirect('/main', 'location');
	}
	public function delete(){
		$this->db->where("id",$this->input->post("id"));
		$this->db->delete("m_building");
	}
} 