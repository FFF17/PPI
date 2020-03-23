<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Sk extends CI_Controller{
    function index(){
        $data["total_tpc"] = $this->db->query("select * from tb_grade where geo_kab_id is not null")->num_rows();
        $data["total_tpd"] = $this->db->query("select * from tb_grade where geo_kab_id is null")->num_rows();

        $data["total_sk_tpc"] = $this->db->query("select * from tb_sk where geo_kab_id <> 0")->num_rows();
        $data["total_sk_tpd"] = $this->db->query("select * from tb_sk where geo_kab_id = 0")->num_rows();

        $this->db->select("tb_sk.*, geo_prov_nama, geo_kab_nama");
        $this->db->from("tb_sk");
        $this->db->join("m_geo_prov_kpu","tb_sk.geo_prov_id = m_geo_prov_kpu.geo_prov_id");
        $this->db->join("m_geo_kab_kpu","tb_sk.geo_kab_id = m_geo_kab_kpu.geo_kab_id","left");
        $this->db->join("tb_grade","tb_grade.geo_kab_id = tb_sk.geo_kab_id and tb_grade.geo_prov_id = tb_sk.geo_prov_id","left");
        $this->db->order_by("tb_grade.grade asc");
        $data["data"] = $this->db->get();
        $this->load->view("sk/list",$data);
    }
    function add(){        
        $data["prov"] = $this->db->query("select distinct m_geo_prov_kpu.* from m_geo_prov_kpu inner join tb_grade on tb_grade.geo_prov_id = m_geo_prov_kpu.geo_prov_id");
        $this->load->view("sk/form",$data);
    }
    function edit(){
        $this->db->where("id",$this->input->post("id"));
        $sk = $this->db->get("tb_sk")->row();
        $data["data"] = $sk;
        $data["prov"] = $this->db->query("select distinct m_geo_prov_kpu.* from m_geo_prov_kpu inner join tb_grade on tb_grade.geo_prov_id = m_geo_prov_kpu.geo_prov_id");
        $data["kab"] = $this->db->query("select m_geo_kab_kpu.* from m_geo_kab_kpu inner join tb_grade on tb_grade.geo_kab_id = m_geo_kab_kpu.geo_kab_id where m_geo_kab_kpu.geo_prov_id = '".$sk->geo_prov_id."'");
        $this->load->view("sk/form_edit",$data);
    }
    function save(){
        $config['upload_path']          = './file/';
        $config['file_name']            = $this->input->post("provinsi")."_".$this->input->post("kabupaten_kota");
        $config['overwrite']			= true;
        $config['allowed_types']        = 'pdf';
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file')) {
            $data["dokumen"] = $this->upload->data("file_name");
        }else{
            $this->session->set_userdata("msg","");
            $this->session->set_userdata("page","sk");
            //redirect('/main', 'location');
            die("Upload Document". $this->upload->display_errors());
        }

        $config['upload_path']          = './foto/';
        $config['file_name']            = $this->input->post("provinsi")."_".$this->input->post("kabupaten_kota");
        $config['overwrite']			= true;
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $this->upload->initialize($config);

        if ($this->upload->do_upload('foto')) {
            $data["foto"] = $this->upload->data("file_name");
        }else{
            //die("Upload Foto". $this->upload->display_errors());
        }


        $data["geo_prov_id"] = $this->input->post("provinsi");
        $data["geo_kab_id"] = $this->input->post("kabupaten_kota");
        $data["ketua"] = $this->input->post("ketua");
        $data["ketua_hp"] = $this->input->post("ketua_hp");
        $data["ketua_email"] = $this->input->post("ketua_email");
        $data["seketaris"] = $this->input->post("seketaris");
        $data["seketaris_hp"] = $this->input->post("seketaris_hp");
        $data["seketaris_email"] = $this->input->post("seketaris_email");
        $data["bendahara"] = $this->input->post("bendahara");
        $data["bendahara_hp"] = $this->input->post("bendahara_hp");
        $data["bendahara_email"] = $this->input->post("bendahara_email");
        $data["no_sk"] = $this->input->post("no_sk");
        $data["created_date"] = date('Y-m-d H:i:s');
        $data["created_by"] = $this->session->username;
        $this->db->insert("tb_sk",$data);
        $this->session->set_userdata("page","sk");
        $this->session->set_userdata("page_header","SK");
        redirect('/main', 'location');
    }
    function update(){
        $config['upload_path']          = './file/';
        $config['file_name']            = $this->input->post("provinsi")."_".$this->input->post("kabupaten_kota");
        $config['overwrite']			= true;
        $config['allowed_types']        = 'pdf';
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file')) {
            $data["dokumen"] = $this->upload->data("file_name");
        }else{
            $this->session->set_userdata("msg","");
            $this->session->set_userdata("page","sk");
            //redirect('/main', 'location');
            //die("Upload Document". $this->upload->display_errors());
        }

        $config['upload_path']          = './foto/';
        $config['file_name']            = $this->input->post("provinsi")."_".$this->input->post("kabupaten_kota");
        $config['overwrite']			= true;
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $this->upload->initialize($config);

        if ($this->upload->do_upload('foto')) {
            $data["foto"] = $this->upload->data("file_name");
        }else{
            //die("Upload Foto". $this->upload->display_errors());
        }


        $data["geo_prov_id"] = $this->input->post("provinsi");
        $data["geo_kab_id"] = $this->input->post("kabupaten_kota");
        $data["ketua"] = $this->input->post("ketua");
        $data["ketua_hp"] = $this->input->post("ketua_hp");
        $data["ketua_email"] = $this->input->post("ketua_email");
        $data["seketaris"] = $this->input->post("seketaris");
        $data["seketaris_hp"] = $this->input->post("seketaris_hp");
        $data["seketaris_email"] = $this->input->post("seketaris_email");
        $data["bendahara"] = $this->input->post("bendahara");
        $data["bendahara_hp"] = $this->input->post("bendahara_hp");
        $data["bendahara_email"] = $this->input->post("bendahara_email");
        $data["no_sk"] = $this->input->post("no_sk");
        $data["update_date"] = date('Y-m-d h:i:s');
        $data["update_by"] = $this->session->username;
        $this->db->where("id",$this->input->post("id"));
        $this->db->update("tb_sk",$data);
        $this->session->set_userdata("page","sk");
        $this->session->set_userdata("page_header","SK");
        redirect('/main', 'location');
    }
    function delete(){
        $this->db->where('id',$this->input->post("id"));
        $this->db->delete("tb_sk");
    }
}