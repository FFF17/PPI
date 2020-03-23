<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {


	public function index()
	{
		$this->db->select("tb_user.*,geo_prov_nama,geo_kab_nama");
		$this->db->from("tb_user");
		$this->db->join("m_geo_prov_kpu","m_geo_prov_kpu.geo_prov_id = tb_user.provinsi","left");
		$this->db->join("m_geo_kab_kpu","m_geo_kab_kpu.geo_kab_id = tb_user.kabupaten","left");
        $data["data"] = $this->db->get();
		$this->load->view('users/list',$data);
	}
	public function add(){
        $data["prov"] = $this->db->query("select distinct m_geo_prov_kpu.* from m_geo_prov_kpu inner join tb_grade on tb_grade.geo_prov_id = m_geo_prov_kpu.geo_prov_id");
		$this->load->view("users/form",$data);
	}
	public function edit(){
		$this->db->where("id",$this->input->post("id"));
		$user = $this->db->get("tb_user")->row();
		$data["data"] = $user;
        $data["prov"] = $this->db->query("select distinct m_geo_prov_kpu.* from m_geo_prov_kpu inner join tb_grade on tb_grade.geo_prov_id = m_geo_prov_kpu.geo_prov_id");
        $data["kab"] = $this->db->query("select m_geo_kab_kpu.* from m_geo_kab_kpu inner join tb_grade on tb_grade.geo_kab_id = m_geo_kab_kpu.geo_kab_id where m_geo_kab_kpu.geo_prov_id = '".$user->provinsi."'");
		$this->load->view("users/form_edit",$data);
	}
	public function save(){
        $config['upload_path']          = './foto/';
        $config['file_name']            = $this->input->post("username");
        $config['overwrite']			= true;
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            $data["foto"] = $this->upload->data("file_name");
        }else{
            //die("Upload Foto". $this->upload->display_errors());
		}
		$data["username"] = $this->input->post("username");
		$data["password"] = md5($this->input->post("password"));
		$data["nama"] = $this->input->post("nama");
		$data["jabatan"] = $this->input->post("jabatan");
		$data["role"] = $this->input->post("role");
		$data["provinsi"] = $this->input->post("provinsi");
		$data["kabupaten"] = $this->input->post("kabupaten");
		$this->db->insert("tb_user",$data);

        $this->session->set_userdata("page","users");
        $this->session->set_userdata("page_header","Users");
        redirect('/main', 'location');
	}

	public function update(){
        $config['upload_path']          = './foto/';
        $config['file_name']            = $this->input->post("username");
        $config['overwrite']			= true;
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            $data["foto"] = $this->upload->data("file_name");
        }else{
            //die("Upload Foto". $this->upload->display_errors());
		}
		$data["username"] = $this->input->post("username");
		if($this->input->post("password")!=""){
			$data["password"] = md5($this->input->post("password"));
		}
		$data["nama"] = $this->input->post("nama");
		$data["jabatan"] = $this->input->post("jabatan");
		$data["role"] = $this->input->post("role");
		$data["provinsi"] = $this->input->post("provinsi");
		$data["kabupaten"] = $this->input->post("kabupaten");
		$this->db->where("id",$this->input->post("id"));
		$this->db->update("tb_user",$data);

        $this->session->set_userdata("page","users");
        $this->session->set_userdata("page_header","Users");
        redirect('/main', 'location');
	}
	public function delete(){
		$this->db->where("id",$this->input->post("id"));
		$this->db->delete("tb_user");
	}
}
