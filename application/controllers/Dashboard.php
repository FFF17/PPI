<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
    public function index()
    {
        $data["prov"] = $this->db->query("select distinct m_geo_prov_kpu.* from m_geo_prov_kpu inner join tb_grade on tb_grade.geo_prov_id = m_geo_prov_kpu.geo_prov_id");
        $data["kab"] = $this->db->get("m_geo_kab_kpu");
        $this->load->view("dashboard", $data);
    }
    public function admin()
    {
        $data["grade_a"] = $this->db->where("grade", "a")->get("tb_grade")->num_rows();
        $data["grade_b"] = $this->db->where("grade", "b")->get("tb_grade")->num_rows();
        $data["grade_c"] = $this->db->where("grade", "c")->get("tb_grade")->num_rows();
        $data["grade_d"] = $this->db->where("grade", "d")->get("tb_grade")->num_rows();

        $data["daftar_calon"] = $this->db->query("select * from tb_calon order by id desc");
        $data["total_st"] = $this->db->query("SELECT * from tb_calon_surat_tugas")->num_rows();
        $data["total_penilaian"] = $this->db->query("SELECT
                                                        tb_calon.nama,
                                                        CASE
                                                            WHEN kabupaten_kota > 0 THEN
                                                                ( SELECT geo_kab_nama FROM m_geo_kab_kpu WHERE geo_kab_id = kabupaten_kota ) 
                                                            ELSE 
                                                                ( SELECT geo_prov_nama FROM m_geo_prov_kpu WHERE geo_prov_id = provinsi ) 
                                                        END AS daerah,
                                                        (SELECT
                                                            SUM( tb_calon_scoring.nilai * ( bobot / 100 ) ) 
                                                        FROM
                                                            tb_scoring
                                                            INNER JOIN tb_calon_scoring ON tb_scoring.id = tb_calon_scoring.id_scoring 
                                                        WHERE
                                                            id_calon = tb_calon.id 
                                                        ) AS score 
                                                    FROM
                                                        tb_calon
                                                        JOIN tb_calon_scoring ON id_calon = tb_calon.id 
                                                    GROUP BY
                                                        tb_calon.id");

        $data["pendaftar"] = $this->db->where("status","1")->get("tb_calon")->num_rows();
        $this->load->view("dashboard_admin", $data);
    }
    public function dataCalon()
    {
        $tingat["bupati"] = "CALON BUPATI";
        $tingat["walikota"] = "CALON WALIKOTA";
        $tingat["gubernur"] = "CALON GUBERNUR";
        $tingat["wakil_bupati"] = "CALON WAKIL BUPATI";
        $tingat["wakil_walikota"] = "CALON WAKIL WALIKOTA";
        $tingat["wakil_gubernur"] = "CALON WAKIL GUBERNUR";
        $provinsi = $this->input->post("provinsi");
        if ($provinsi != "") {
            $this->db->where("provinsi", $provinsi);
        }
        $kabupaten = $this->input->post("kabupaten");
        if ($kabupaten != "") {
            $this->db->where("kabupaten_kota", $kabupaten);
        }
        $this->db->where("status", '1');
        $this->db->select("tb_calon.*, geo_prov_nama, geo_kab_nama,tb_calon_surat_tugas.id id_surat_tugas");
        $this->db->from("tb_calon");
        $this->db->join("m_geo_prov_kpu", "tb_calon.provinsi = m_geo_prov_kpu.geo_prov_id");
        $this->db->join("m_geo_kab_kpu", "tb_calon.kabupaten_kota = m_geo_kab_kpu.geo_kab_id");
        $this->db->join("tb_calon_surat_tugas", "tb_calon_surat_tugas.id_calon = tb_calon.id","left");
        $data["calon"] = $this->db->get();
        $data["tingkat"] = $tingat;
        $this->load->view("data_calon", $data);
    }
}
