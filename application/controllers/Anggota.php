<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {
    function index(){

    }

    function baru(){
        $data["data"] = $this->db->query("select * from m_anggota where input_status = '0'");
        $this->load->view("anggota/baru",$data);
    }
    function input_detail(){
        $id = $this->input->post("id");
        $data["data"] = $this->db->query("select * from m_anggota where id = '".$id."'")->row();
        $data["agama"] = $this->db->get("m_agama");
        $data["pekerjaan"] = $this->db->get("m_pekerjaan");
        $data["pendidikan"] = $this->db->get("m_pendidikan");
        $data["prov"] = $this->db->get("m_geo_prov_kpu");
        $this->load->view("anggota/verifikasi_data",$data);
    }
    function check_nik(){
        $nomor_nik = $this->input->post("nik");
        $data = $this->db->query("select tgl_lhr,tmp_lhr,agama,concat(alamat,' rt ',rt,' rw ',rw,' ',kelurahan.kelurahan,' ', kecamatan.kecamatan,' ',kabupaten.kabupaten,' ',provinsi.provinsi) alamat, pendidikan,pekerjaan,pernikahan,jk,organisasi1 from anggota
        inner join kelurahan on kelurahan.kode = anggota.almt_kelurahan
        inner join kecamatan on kecamatan.kode = anggota.almt_kecamatan
        inner join kabupaten on kabupaten.kode = anggota.almt_kabupaten
        inner join provinsi on provinsi.kode = anggota.almt_provinsi
        where ktp = '".$nomor_nik."'")->row();
        //var_dump($data);
        echo json_encode($data);
    }
    function get_kabupaten(){
        $geo_prov_id = $this->input->post("geo_prov_id");
        $this->db->where("geo_prov_id",$geo_prov_id);
        $data = $this->db->get("m_geo_kab_kpu");
        foreach($data->result() as $tmp){
            echo "<option value = '".$tmp->geo_kab_id."' >".$tmp->geo_kab_nama."</option>";
        }
    }
    function get_kecamatan(){
        $geo_kab_id = $this->input->post("geo_kab_id");
        $this->db->where("geo_kab_id",$geo_kab_id);
        $data = $this->db->get("m_geo_kec_kpu");
        foreach($data->result() as $tmp){
            echo "<option value = '".$tmp->geo_kec_id."' >".$tmp->geo_kec_nama."</option>";
        }
    }
    function get_kelurahan(){
        $geo_kec_id = $this->input->post("geo_kec_id");
        $this->db->where("geo_kec_id",$geo_kec_id);
        $data = $this->db->get("m_geo_deskel_kpu");
        foreach($data->result() as $tmp){
            echo "<option value = '".$tmp->geo_deskel_id."' >".$tmp->geo_deskel_nama."</option>";
        }
    }
}