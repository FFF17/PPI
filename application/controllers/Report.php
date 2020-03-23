<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Report extends CI_Controller
{
    public function index()
    {
        $provinsi = $this->input->post("provinsi");
        $kabupaten = $this->input->post("kabupaten");
        $tingat["bupati"] = "CALON BUPATI";
        $tingat["walikota"] = "CALON WALIKOTA";
        $tingat["gubernur"] = "CALON GUBERNUR";
        $tingat["wakil_bupati"] = "CALON WAKIL BUPATI";
        $tingat["wakil_walikota"] = "CALON WAKIL WALIKOTA";
        $tingat["wakil_gubernur"] = "CALON WAKIL GUBERNUR";

        $data["prov"] = $this->db->query("select distinct m_geo_prov_kpu.* from m_geo_prov_kpu inner join tb_calon on m_geo_prov_kpu.geo_prov_id = provinsi");

        //$this->db->where("geo_prov_id",$provinsi);
        $data["kab"] = $this->db->query("select distinct m_geo_kab_kpu.* from m_geo_kab_kpu inner join tb_calon on m_geo_kab_kpu.geo_kab_id = kabupaten_kota where geo_prov_id = '$provinsi'");

        if ($provinsi != "") {
            $this->db->where("provinsi", $provinsi);
        } else {
            $this->db->where("provinsi", "0");
        }
        if ($kabupaten != "") {
            $this->db->where("kabupaten_kota", $kabupaten);
        } else {
            $this->db->where("kabupaten_kota", "0");
        }
        $this->db->select("tb_calon.*,(select tb_calon_organisasi.organisasi from tb_calon_organisasi where tb_calon.id = id_calon order by id desc limit 0,1) organisasi,
        (select CONCAT(tb_calon_pekerjaan.jabatan,' (',tb_calon_pekerjaan.instansi,' ',tb_calon_pekerjaan.alamat,')') from tb_calon_pekerjaan where tb_calon.id = id_calon and jabatan<>'' order by id desc limit 0,1) pekerjaan,  geo_prov_nama, geo_kab_nama,
        (select sum(tb_calon_scoring.nilai * (bobot/100)) from tb_scoring inner join tb_calon_scoring on tb_scoring.id =tb_calon_scoring.id_scoring where id_calon = tb_calon.id) nilai");
        $this->db->from("tb_calon");
        $this->db->join("m_geo_prov_kpu", "tb_calon.provinsi = m_geo_prov_kpu.geo_prov_id");
        $this->db->join("m_geo_kab_kpu", "tb_calon.kabupaten_kota = m_geo_kab_kpu.geo_kab_id");
        $this->db->where("status", "1");
        $data["calon"] = $this->db->get();

        if ($provinsi != "") {
            $this->db->where("provinsi", $provinsi);
        } else {
            $this->db->where("provinsi", "0");
        }
        if ($kabupaten != "") {
            $this->db->where("kabupaten_kota", $kabupaten);
        } else {
            $this->db->where("kabupaten_kota", "0");
        }
        $this->db->select("nama,
                            (
                            SELECT
                                SUM( nilai * ( bobot / 100 ) ) 
                            FROM
                                tb_calon_scoring
                                JOIN tb_scoring ON tb_scoring.id = tb_calon_scoring.id_scoring 
                            WHERE
                                id_calon = tb_calon.id 
                            ) AS skor,
                            (SELECT file FROM tb_calon_surat_tugas WHERE (id_calon = tb_calon.id OR id_pasangan = tb_calon.id) AND jenis_surat_tugas = 'individu') AS file_individu, 
                            (SELECT file FROM tb_calon_surat_tugas WHERE (id_calon = tb_calon.id OR id_pasangan = tb_calon.id) AND jenis_surat_tugas = 'pasangan') AS file_pasangan ");
        $this->db->from("tb_calon");
        $this->db->where("status", "1");
        $this->db->order_by('skor', 'DESC');
        $data["kesimpulan_calon"] = $this->db->get();

        if ($provinsi != "") {
            $this->db->where("id_provinsi", $provinsi);
        } else {
            $this->db->where("id_provinsi", "0");
        }
        if ($kabupaten != "") {
            $this->db->where("id_kab", $kabupaten);
        } else {
            $this->db->where("id_kab", "0");
        }
        $data["dpt"] = $this->db->get("tb_dpt");

        $data["tingkat"] = $tingat;

        $data["provinsi"] = $provinsi;
        $data["kabupaten"] = $kabupaten;

        if ($provinsi != "") {
            $this->db->where("geo_prov_id", $provinsi);
        } else {
            $this->db->where("geo_prov_id", "0");
        }
        if ($kabupaten != "") {
            $this->db->where("geo_kab_id", $kabupaten);
        } else {
            $this->db->where("geo_kab_id", "0");
        }
        $data["grade"] = @$this->db->get("tb_grade")->row()->grade;

        if ($provinsi != "") {
            $this->db->where("geo_prov_id", $provinsi);
        } else {
            $this->db->where("geo_prov_id", "0");
        }
        if ($kabupaten != "") {
            $this->db->where("geo_kab_id", $kabupaten);
        } else {
            $this->db->where("geo_kab_id", "0");
        }
        $data["syarat"] = @$this->db->get("tb_syarat")->row()->syarat;

        if ($provinsi != "") {
            $this->db->where("geo_prov_id", $provinsi);
        } else {
            $this->db->where("geo_prov_id", "0");
        }
        if ($kabupaten != "") {
            $this->db->where("geo_kab_id", $kabupaten);
        } else {
            $this->db->where("geo_kab_id", "0");
        }
        $this->db->where("partai", "hanura");
        $data["hanura"] = @$this->db->get("tb_kursi")->row()->total_kursi;


        if ($provinsi != "") {
            $this->db->where("geo_prov_id", $provinsi);
        } else {
            $this->db->where("geo_prov_id", "0");
        }
        if ($kabupaten != "") {
            $this->db->where("geo_kab_id", $kabupaten);
        } else {
            $this->db->where("geo_kab_id", "0");
        }
        $data["kursi"] = @$this->db->get("tb_kursi");

        $data["total"] = @$this->db->query("select sum(total_kursi) total_kursi from tb_kursi where geo_prov_id ='$provinsi' and geo_kab_id = '$kabupaten'")->row()->total_kursi;



        if ($provinsi != "") {
            $this->db->where("geo_prov_id", $provinsi);
        } else {
            $this->db->where("geo_prov_id", "0");
        }
        if ($kabupaten != "") {
            $this->db->where("geo_kab_id", $kabupaten);
        } else {
            $this->db->where("geo_kab_id", "0");
        }
        $data["petahana"] = @$this->db->get("tb_petahana")->row();

        $this->load->view("report/main", $data);
    }

    function print_pdf()
    {
        $provinsi = $this->input->get("provinsi");
        $kabupaten = $this->input->get("kabupaten");
        $tingat["bupati"] = "CALON BUPATI";
        $tingat["walikota"] = "CALON WALIKOTA";
        $tingat["gubernur"] = "CALON GUBERNUR";
        $tingat["wakil_bupati"] = "CALON WAKIL BUPATI";
        $tingat["wakil_walikota"] = "CALON WAKIL WALIKOTA";
        $tingat["wakil_gubernur"] = "CALON WAKIL GUBERNUR";

        $data["prov"] = $this->db->query("select distinct m_geo_prov_kpu.* from m_geo_prov_kpu inner join tb_calon on m_geo_prov_kpu.geo_prov_id = provinsi");

        //$this->db->where("geo_prov_id",$provinsi);
        $data["kab"] = $this->db->query("select distinct m_geo_kab_kpu.* from m_geo_kab_kpu inner join tb_calon on m_geo_kab_kpu.geo_kab_id = kabupaten_kota where geo_prov_id = '$provinsi'");

        if ($provinsi != "") {
            $this->db->where("provinsi", $provinsi);
        } else {
            $this->db->where("provinsi", "0");
        }
        if ($kabupaten != "") {
            $this->db->where("kabupaten_kota", $kabupaten);
        } else {
            $this->db->where("kabupaten_kota", "0");
        }
        $this->db->select("tb_calon.*,(select tb_calon_organisasi.organisasi from tb_calon_organisasi where tb_calon.id = id_calon order by id desc limit 0,1) organisasi,
        (select CONCAT(tb_calon_pekerjaan.jabatan,' (',tb_calon_pekerjaan.instansi,' ',tb_calon_pekerjaan.alamat,')') from tb_calon_pekerjaan where tb_calon.id = id_calon and jabatan<>'' order by id desc limit 0,1) pekerjaan,  geo_prov_nama, geo_kab_nama,
        (select sum(tb_calon_scoring.nilai * (bobot/100)) from tb_scoring inner join tb_calon_scoring on tb_scoring.id =tb_calon_scoring.id_scoring where id_calon = tb_calon.id) nilai");
        $this->db->from("tb_calon");
        $this->db->join("m_geo_prov_kpu", "tb_calon.provinsi = m_geo_prov_kpu.geo_prov_id");
        $this->db->join("m_geo_kab_kpu", "tb_calon.kabupaten_kota = m_geo_kab_kpu.geo_kab_id");
        $this->db->where("status", "1");
        $data["calon"] = $this->db->get();

        if ($provinsi != "") {
            $this->db->where("provinsi", $provinsi);
        } else {
            $this->db->where("provinsi", "0");
        }
        if ($kabupaten != "") {
            $this->db->where("kabupaten_kota", $kabupaten);
        } else {
            $this->db->where("kabupaten_kota", "0");
        }
        $this->db->select("nama,
                            (
                            SELECT
                                SUM( nilai * ( bobot / 100 ) ) 
                            FROM
                                tb_calon_scoring
                                JOIN tb_scoring ON tb_scoring.id = tb_calon_scoring.id_scoring 
                            WHERE
                                id_calon = tb_calon.id 
                            ) AS skor ");
        $this->db->from("tb_calon");
        $this->db->where("status", "1");
        $this->db->order_by('skor', 'DESC');
        $data["kesimpulan_calon"] = $this->db->get();

        if ($provinsi != "") {
            $this->db->where("id_provinsi", $provinsi);
        } else {
            $this->db->where("id_provinsi", "0");
        }
        if ($kabupaten != "") {
            $this->db->where("id_kab", $kabupaten);
        } else {
            $this->db->where("id_kab", "0");
        }
        $data["dpt"] = $this->db->get("tb_dpt");

        $data["tingkat"] = $tingat;

        $data["provinsi"] = $provinsi;
        $data["kabupaten"] = $kabupaten;

        if ($provinsi != "") {
            $this->db->where("geo_prov_id", $provinsi);
        } else {
            $this->db->where("geo_prov_id", "0");
        }
        if ($kabupaten != "") {
            $this->db->where("geo_kab_id", $kabupaten);
        } else {
            $this->db->where("geo_kab_id", "0");
        }
        $data["grade"] = @$this->db->get("tb_grade")->row()->grade;

        if ($provinsi != "") {
            $this->db->where("geo_prov_id", $provinsi);
        } else {
            $this->db->where("geo_prov_id", "0");
        }
        if ($kabupaten != "") {
            $this->db->where("geo_kab_id", $kabupaten);
        } else {
            $this->db->where("geo_kab_id", "0");
        }
        $data["syarat"] = @$this->db->get("tb_syarat")->row()->syarat;

        if ($provinsi != "") {
            $this->db->where("geo_prov_id", $provinsi);
        } else {
            $this->db->where("geo_prov_id", "0");
        }
        if ($kabupaten != "") {
            $this->db->where("geo_kab_id", $kabupaten);
        } else {
            $this->db->where("geo_kab_id", "0");
        }
        $this->db->where("partai", "hanura");
        $data["hanura"] = @$this->db->get("tb_kursi")->row()->total_kursi;


        if ($provinsi != "") {
            $this->db->where("geo_prov_id", $provinsi);
        } else {
            $this->db->where("geo_prov_id", "0");
        }
        if ($kabupaten != "") {
            $this->db->where("geo_kab_id", $kabupaten);
        } else {
            $this->db->where("geo_kab_id", "0");
        }
        $data["kursi"] = @$this->db->get("tb_kursi");

        $data["total"] = @$this->db->query("select sum(total_kursi) total_kursi from tb_kursi where geo_prov_id ='$provinsi' and geo_kab_id = '$kabupaten'")->row()->total_kursi;

        if ($provinsi != "") {
            $this->db->where("geo_prov_id", $provinsi);
        } else {
            $this->db->where("geo_prov_id", "0");
        }
        if ($kabupaten != "") {
            $this->db->where("geo_kab_id", $kabupaten);
        } else {
            $this->db->where("geo_kab_id", "0");
        }
        $data["petahana"] = @$this->db->get("tb_petahana")->row();

        $this->load->library("html2pdf_lib");
        ob_start();
        $this->load->view('report/pdf', $data);
        $html = ob_get_contents();
        ob_end_clean();
        $this->html2pdf_lib->converHtml2pdf($html);
    }
}
