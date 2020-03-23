<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Sr extends CI_Controller{
    public function index(){
        $provinsi = $this->input->post("provinsi");
        $kabupaten = $this->input->post("kabupaten");
        $tanggal_rekomendasi = $this->input->post("tanggal_rekomendasi");
        $tingat["bupati"] = "CALON BUPATI";
        $tingat["walikota"] = "CALON WALIKOTA";
        $tingat["gubernur"] = "CALON GUBERNUR";
        $tingat["wakil_bupati"] = "CALON WAKIL BUPATI";
        $tingat["wakil_walikota"] = "CALON WAKIL WALIKOTA";
        $tingat["wakil_gubernur"] = "CALON WAKIL GUBERNUR";
        $data["prov"] = $this->db->query("select distinct m_geo_prov_kpu.* from m_geo_prov_kpu inner join tb_calon on m_geo_prov_kpu.geo_prov_id = provinsi");
        $data["kab"] = $this->db->query("select distinct m_geo_kab_kpu.* from m_geo_kab_kpu inner join tb_calon on m_geo_kab_kpu.geo_kab_id = kabupaten_kota where geo_prov_id = '$provinsi'");
        $where ="";
        if ($provinsi != "") {
            $where .=" and provinsi = '$provinsi'";
        }
        if ($kabupaten != "") {
            $where .=" and kabupaten_kota = '$kabupaten'";
        }
        if ($tanggal_rekomendasi != "") {
            $where .=" and date_format(tanggal_rekomendasi,'%Y-%m-%d')  = '$tanggal_rekomendasi'";
        }
        $data["data"] = $this->db->query("select tb_rekomendasi.*,tb_calon.mencalonkan, tb_calon.nama nama_calon,(SELECT nama FROM tb_calon WHERE id = tb_rekomendasi.id_pasangan ) AS nama_pasangan,tb_calon_surat_tugas.no_surat_tugas,tb_calon_surat_tugas.start_date,tb_calon_surat_tugas.jenis_surat_tugas,tb_calon_surat_tugas.masa_berlaku,geo_prov_nama,geo_kab_nama from tb_rekomendasi inner join tb_calon on tb_calon.id = tb_rekomendasi.id_calon inner join m_geo_prov_kpu on m_geo_prov_kpu.geo_prov_id = provinsi inner join m_geo_kab_kpu on m_geo_kab_kpu.geo_kab_id = kabupaten_kota  left join tb_calon_surat_tugas on tb_calon_surat_tugas.id = tb_rekomendasi.id_sk where 1=1 $where order by no_batch");
        $data["provinsi"] = $provinsi;
        $data["kabupaten"] = $kabupaten;
        $data["tingkat"] = $tingat;
        $data["tanggal_rekomendasi"] = $tanggal_rekomendasi;
        $this->load->view("rekomendasi/list",$data);
    }
    public function add_sk(){        
        $this->db->select("tb_calon.*, tb_calon_surat_tugas.*, (SELECT nama FROM tb_calon WHERE id = tb_calon_surat_tugas.id_pasangan ) AS nama_pasangan, geo_prov_nama, geo_kab_nama");
        $this->db->from("tb_calon");
        $this->db->join("tb_calon_surat_tugas", "tb_calon_surat_tugas.id_calon = tb_calon.id");
        $this->db->join("m_geo_prov_kpu", "tb_calon.provinsi = m_geo_prov_kpu.geo_prov_id");
        $this->db->join("m_geo_kab_kpu", "tb_calon.kabupaten_kota = m_geo_kab_kpu.geo_kab_id");
        $this->db->order_by('tb_calon_surat_tugas.id', 'DESC');
        $data["data_surat_tugas"] = $this->db->get();
        $this->load->view("rekomendasi/add_sk",$data);
    }
    public function add_non_sk(){        
        $provinsi = $this->input->post("provinsi");
        $kabupaten = $this->input->post("kabupaten");
        $data["prov"] = $this->db->query("select distinct m_geo_prov_kpu.* from m_geo_prov_kpu inner join tb_calon on m_geo_prov_kpu.geo_prov_id = provinsi");
        $data["kab"] = $this->db->query("select distinct m_geo_kab_kpu.* from m_geo_kab_kpu inner join tb_calon on m_geo_kab_kpu.geo_kab_id = kabupaten_kota where geo_prov_id = '$provinsi'");
        if ($provinsi != "") {
            $this->db->where("provinsi", $provinsi);
        }
        if ($kabupaten != "") {
            $this->db->where("kabupaten_kota", $kabupaten);
        }
        $this->db->where("status","1");
        $data["calon"] = $this->db->get("tb_calon");
        if ($provinsi != "") {
            $this->db->where("provinsi", $provinsi);
        }
        if ($kabupaten != "") {
            $this->db->where("kabupaten_kota", $kabupaten);
        }
        $this->db->where("status","1");
        $data["pasangan"] = $this->db->get("tb_calon");
        $data["provinsi"] = $provinsi;
        $data["kabupaten"] = $kabupaten;
        $this->load->view("rekomendasi/add_non_sk",$data);
    }
    public function save_sk(){
        $id_surat_tugas = $this->input->post("id_surat_tugas");
        $no_rekomendasi = $this->input->post("no_rekomendasi");
        $no_batch = $this->input->post("no_batch");
        $tanggal_rekomendasi = $this->input->post("tanggal_rekomendasi");
        $data = $this->db->where("id",$id_surat_tugas)->get("tb_calon_surat_tugas");
        foreach($data->result() as $tmp){
            $tmpData["id_calon"] = $tmp->id_calon;
            $tmpData["id_pasangan"] = $tmp->id_pasangan;
            $tmpData["id_sk"] = $id_surat_tugas;
            $tmpData["tanggal_rekomendasi"] = $tanggal_rekomendasi;
            $tmpData["no_rekomendasi"] = $no_rekomendasi;
            $tmpData["no_batch"] = $no_batch;
            $tmpData["created_by"] = $this->session->username;
            $tmpData["created_date"] = date('Y-m-d H:i:s');
            $this->db->insert("tb_rekomendasi",$tmpData);
        }
        echo "1";
    }
    public function save_non_sk(){
        $no_rekomendasi = $this->input->post("no_rekomendasi");
        $no_batch = $this->input->post("no_batch");
        $tanggal_rekomendasi = $this->input->post("tanggal_rekomendasi");
        $tmpData["id_calon"] = $this->input->post("id_calon");
        $tmpData["id_pasangan"] = $this->input->post("id_pasangan");
        $tmpData["tanggal_rekomendasi"] = $tanggal_rekomendasi;
        $tmpData["no_rekomendasi"] = $no_rekomendasi;
        $tmpData["no_batch"] = $no_batch;
        $tmpData["created_by"] = $this->session->username;
        $tmpData["created_date"] = date('Y-m-d H:i:s');
        $this->db->insert("tb_rekomendasi",$tmpData);
        echo "1";
    }
}