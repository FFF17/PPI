<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    public function index()
    {
        $data["prov"] = $this->db->query("select distinct m_geo_prov_kpu.* from m_geo_prov_kpu inner join tb_grade on tb_grade.geo_prov_id = m_geo_prov_kpu.geo_prov_id");
        $this->load->view('register',$data);
    }
    public function jsom_provinsi(){
        $data = $this->db->query("select distinct m_geo_prov_kpu.* from m_geo_prov_kpu inner join tb_grade on tb_grade.geo_prov_id = m_geo_prov_kpu.geo_prov_id");
        echo json_encode($data->result());
    }
    public function jsom_kabupaten(){
        $data = $this->db->query("select distinct m_geo_kab_kpu.* from m_geo_kab_kpu inner join tb_grade on tb_grade.geo_kab_id = m_geo_kab_kpu.geo_kab_id where tb_grade.geo_prov_id = '".$this->input->get("id")."' order by geo_kab_id asc");
        echo json_encode($data->result());
    }
    public function tambah_calon(){        
        $data["prov"] = $this->db->query("select distinct m_geo_prov_kpu.* from m_geo_prov_kpu inner join tb_grade on tb_grade.geo_prov_id = m_geo_prov_kpu.geo_prov_id");
        $this->load->view('tambah_calon',$data);
    }
    public function save(){
        $data["foto"] = $this->input->post("foto");

        $config['upload_path']          = './foto/';
        $config['file_name']            = $this->input->post("nomor_nik");
        $config['overwrite']			= true;
        $config['allowed_types']        = 'gif|jpg|png';
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            $data["foto"] = $this->upload->data("file_name");
        }else{
            //die($this->upload->display_errors());
        }


        $data["provinsi"] = $this->input->post("provinsi");
        $data["kabupaten_kota"] = $this->input->post("kabupaten_kota");
        $data["nama"] = $this->input->post("nama");
        $data["tempat_lahir"] = $this->input->post("tempat_lahir");
        $data["tanggal_lahir"] = $this->input->post("tanggal_lahir");
        $data["nomor_nik"] = $this->input->post("nomor_nik");
        $data["nomor_kta"] = $this->input->post("nomor_kta");
        $data["jenis_kelamin"] = $this->input->post("jenis_kelamin");
        $data["agama"] = $this->input->post("agama");
        $data["alamat"] = $this->input->post("alamat");
        $data["telp"] = $this->input->post("telp");
        $data["email"] = $this->input->post("email");
        $data["sm_fb"] = $this->input->post("sm_fb");
        $data["sm_twitter"] = $this->input->post("sm_twitter");
        $data["sm_instagram"] = $this->input->post("sm_instagram");
        $data["status_perkawinan"] = $this->input->post("status_perkawinan");
        $data["nama_istri"] = $this->input->post("nama_istri");
        $data["mencalonkan"] = $this->input->post("mencalonkan");
        $data["created_date"] = date('Y-m-d h:i:s');
        $this->db->insert("tb_calon",$data);
        $id = $this->db->insert_id();

        $data = array();
        $data["id_calon"] = $id;
        $data["tingkat"] = "SD";
        $data["alamat"] = $this->input->post("SD_ALAMAT");
        $data["tahun"] = $this->input->post("SD_YEAR");
        $this->db->insert("tb_calon_pendidikan",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["tingkat"] = "SMP";
        $data["alamat"] = $this->input->post("SMP_ALAMAT");
        $data["tahun"] = $this->input->post("SMP_YEAR");
        $this->db->insert("tb_calon_pendidikan",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["tingkat"] = "SMA";
        $data["alamat"] = $this->input->post("SMA_ALAMAT");
        $data["tahun"] = $this->input->post("SMA_YEAR");
        $this->db->insert("tb_calon_pendidikan",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["tingkat"] = "S1";
        $data["alamat"] = $this->input->post("S1_ALAMAT");
        $data["tahun"] = $this->input->post("S1_YEAR");
        $this->db->insert("tb_calon_pendidikan",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["tingkat"] = "S2";
        $data["alamat"] = $this->input->post("S2_ALAMAT");
        $data["tahun"] = $this->input->post("S2_YEAR");
        $this->db->insert("tb_calon_pendidikan",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["jenis_pelatihan"] = $this->input->post("jp_jenis_pelatihan1");
        $data["instansi"] = $this->input->post("jp_instansi1");
        $data["tahun"] = $this->input->post("jp_tahun1");
        $this->db->insert("tb_calon_diklat",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["jenis_pelatihan"] = $this->input->post("jp_jenis_pelatihan2");
        $data["instansi"] = $this->input->post("jp_instansi2");
        $data["tahun"] = $this->input->post("jp_tahun2");
        $this->db->insert("tb_calon_diklat",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["jenis_pelatihan"] = $this->input->post("jp_jenis_pelatihan3");
        $data["instansi"] = $this->input->post("jp_instansi3");
        $data["tahun"] = $this->input->post("jp_tahun3");
        $this->db->insert("tb_calon_diklat",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["jenis_pelatihan"] = $this->input->post("jp_jenis_pelatihan4");
        $data["instansi"] = $this->input->post("jp_instansi4");
        $data["tahun"] = $this->input->post("jp_tahun4");
        $this->db->insert("tb_calon_diklat",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["jenis_pelatihan"] = $this->input->post("jp_jenis_pelatihan5");
        $data["instansi"] = $this->input->post("jp_instansi5");
        $data["tahun"] = $this->input->post("jp_tahun5");
        $this->db->insert("tb_calon_diklat",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["organisasi"] = $this->input->post("o_organisasi1");
        $data["alamat"] = $this->input->post("o_alamat1");
        $data["jabatan"] = $this->input->post("o_jabatan1");
        $this->db->insert("tb_calon_organisasi",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["organisasi"] = $this->input->post("o_organisasi2");
        $data["alamat"] = $this->input->post("o_alamat2");
        $data["jabatan"] = $this->input->post("o_jabatan2");
        $this->db->insert("tb_calon_organisasi",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["organisasi"] = $this->input->post("o_organisasi3");
        $data["alamat"] = $this->input->post("o_alamat3");
        $data["jabatan"] = $this->input->post("o_jabatan3");
        $this->db->insert("tb_calon_organisasi",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["organisasi"] = $this->input->post("o_organisasi4");
        $data["alamat"] = $this->input->post("o_alamat4");
        $data["jabatan"] = $this->input->post("o_jabatan4");
        $this->db->insert("tb_calon_organisasi",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["organisasi"] = $this->input->post("o_organisasi5");
        $data["alamat"] = $this->input->post("o_alamat5");
        $data["jabatan"] = $this->input->post("o_jabatan5");
        $this->db->insert("tb_calon_organisasi",$data);


        $data = array();
        $data["id_calon"] = $id;
        $data["instansi"] = $this->input->post("p_instansi1");
        $data["alamat"] = $this->input->post("p_alamat1");
        $data["jabatan"] = $this->input->post("p_jabatan1");
        $this->db->insert("tb_calon_pekerjaan",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["instansi"] = $this->input->post("p_instansi2");
        $data["alamat"] = $this->input->post("p_alamat2");
        $data["jabatan"] = $this->input->post("p_jabatan2");
        $this->db->insert("tb_calon_pekerjaan",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["instansi"] = $this->input->post("p_instansi3");
        $data["alamat"] = $this->input->post("p_alamat3");
        $data["jabatan"] = $this->input->post("p_jabatan3");
        $this->db->insert("tb_calon_pekerjaan",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["instansi"] = $this->input->post("p_instansi4");
        $data["alamat"] = $this->input->post("p_alamat4");
        $data["jabatan"] = $this->input->post("p_jabatan4");
        $this->db->insert("tb_calon_pekerjaan",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["instansi"] = $this->input->post("p_instansi5");
        $data["alamat"] = $this->input->post("p_alamat5");
        $data["jabatan"] = $this->input->post("p_jabatan5");
        $this->db->insert("tb_calon_pekerjaan",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["penghargaan"] = $this->input->post("pe_penghargaan1");
        $data["instansi"] = $this->input->post("pe_instansi1");
        $data["tahun"] = $this->input->post("pe_tahun1");
        $this->db->insert("tb_calon_penghargaan",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["penghargaan"] = $this->input->post("pe_penghargaan2");
        $data["instansi"] = $this->input->post("pe_instansi2");
        $data["tahun"] = $this->input->post("pe_tahun2");
        $this->db->insert("tb_calon_penghargaan",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["penghargaan"] = $this->input->post("pe_penghargaan3");
        $data["instansi"] = $this->input->post("pe_instansi3");
        $data["tahun"] = $this->input->post("pe_tahun3");
        $this->db->insert("tb_calon_penghargaan",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["penghargaan"] = $this->input->post("pe_penghargaan4");
        $data["instansi"] = $this->input->post("pe_instansi4");
        $data["tahun"] = $this->input->post("pe_tahun4");
        $this->db->insert("tb_calon_penghargaan",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["penghargaan"] = $this->input->post("pe_penghargaan5");
        $data["instansi"] = $this->input->post("pe_instansi5");
        $data["tahun"] = $this->input->post("pe_tahun5");
        $this->db->insert("tb_calon_penghargaan",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["kegiatan"] = $this->input->post("k_kegiatan1");
        $data["lokasi"] = $this->input->post("k_lokasi1");
        $data["tahun"] = $this->input->post("k_tahun1");
        $this->db->insert("tb_calon_sosial",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["kegiatan"] = $this->input->post("k_kegiatan2");
        $data["lokasi"] = $this->input->post("k_lokasi2");
        $data["tahun"] = $this->input->post("k_tahun2");
        $this->db->insert("tb_calon_sosial",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["kegiatan"] = $this->input->post("k_kegiatan3");
        $data["lokasi"] = $this->input->post("k_lokasi3");
        $data["tahun"] = $this->input->post("k_tahun3");
        $this->db->insert("tb_calon_sosial",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["kegiatan"] = $this->input->post("k_kegiatan4");
        $data["lokasi"] = $this->input->post("k_lokasi4");
        $data["tahun"] = $this->input->post("k_tahun4");
        $this->db->insert("tb_calon_sosial",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["kegiatan"] = $this->input->post("k_kegiatan5");
        $data["lokasi"] = $this->input->post("k_lokasi5");
        $data["tahun"] = $this->input->post("k_tahun5");
        $this->db->insert("tb_calon_sosial",$data);

        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'hanura2020@gmail.com';
        $config['smtp_pass']    = 'Indonesia123';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'text'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not

        $this->email->initialize($config);
        $this->email->from('hanura2020@gmail.com', 'Hanura');
        $this->email->to($this->input->post("email"));
        $this->email->cc('hanura2020@gmail.com');

        $this->email->subject('Konfirmasi pendaftaran');
        $this->email->message('Terimakasih bapak / ibu data akan di verifikasi oleh TPC terkait');

        $this->email->send();
        $this->load->view('success',$data);
    }
    public function save_tambah(){
        $data["foto"] = $this->input->post("foto");

        $config['upload_path']          = './foto/';
        $config['file_name']            = $this->input->post("nomor_nik");
        $config['overwrite']			= true;
        $config['allowed_types']        = 'gif|jpg|png';
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            $data["foto"] = $this->upload->data("file_name");
        }else{
            //die($this->upload->display_errors());
        }


        $data["provinsi"] = $this->input->post("provinsi");
        $data["kabupaten_kota"] = $this->input->post("kabupaten_kota");
        $data["nama"] = $this->input->post("nama");
        $data["tempat_lahir"] = $this->input->post("tempat_lahir");
        $data["tanggal_lahir"] = $this->input->post("tanggal_lahir");
        $data["nomor_nik"] = $this->input->post("nomor_nik");
        $data["nomor_kta"] = $this->input->post("nomor_kta");
        $data["jenis_kelamin"] = $this->input->post("jenis_kelamin");
        $data["agama"] = $this->input->post("agama");
        $data["alamat"] = $this->input->post("alamat");
        $data["telp"] = $this->input->post("telp");
        $data["email"] = $this->input->post("email");
        $data["sm_fb"] = $this->input->post("sm_fb");
        $data["sm_twitter"] = $this->input->post("sm_twitter");
        $data["sm_instagram"] = $this->input->post("sm_instagram");
        $data["status_perkawinan"] = $this->input->post("status_perkawinan");
        $data["nama_istri"] = $this->input->post("nama_istri");
        $data["mencalonkan"] = $this->input->post("mencalonkan");
        $data["created_by"] =  "TPP";
        $data["created_date"] = date('Y-m-d h:i:s');
        $this->db->insert("tb_calon",$data);
        $id = $this->db->insert_id();

        $data = array();
        $data["id_calon"] = $id;
        $data["tingkat"] = "SD";
        $data["alamat"] = $this->input->post("SD_ALAMAT");
        $data["tahun"] = $this->input->post("SD_YEAR");
        $this->db->insert("tb_calon_pendidikan",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["tingkat"] = "SMP";
        $data["alamat"] = $this->input->post("SMP_ALAMAT");
        $data["tahun"] = $this->input->post("SMP_YEAR");
        $this->db->insert("tb_calon_pendidikan",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["tingkat"] = "SMA";
        $data["alamat"] = $this->input->post("SMA_ALAMAT");
        $data["tahun"] = $this->input->post("SMA_YEAR");
        $this->db->insert("tb_calon_pendidikan",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["tingkat"] = "S1";
        $data["alamat"] = $this->input->post("S1_ALAMAT");
        $data["tahun"] = $this->input->post("S1_YEAR");
        $this->db->insert("tb_calon_pendidikan",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["tingkat"] = "S2";
        $data["alamat"] = $this->input->post("S2_ALAMAT");
        $data["tahun"] = $this->input->post("S2_YEAR");
        $this->db->insert("tb_calon_pendidikan",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["jenis_pelatihan"] = $this->input->post("jp_jenis_pelatihan1");
        $data["instansi"] = $this->input->post("jp_instansi1");
        $data["tahun"] = $this->input->post("jp_tahun1");
        $this->db->insert("tb_calon_diklat",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["jenis_pelatihan"] = $this->input->post("jp_jenis_pelatihan2");
        $data["instansi"] = $this->input->post("jp_instansi2");
        $data["tahun"] = $this->input->post("jp_tahun2");
        $this->db->insert("tb_calon_diklat",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["jenis_pelatihan"] = $this->input->post("jp_jenis_pelatihan3");
        $data["instansi"] = $this->input->post("jp_instansi3");
        $data["tahun"] = $this->input->post("jp_tahun3");
        $this->db->insert("tb_calon_diklat",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["jenis_pelatihan"] = $this->input->post("jp_jenis_pelatihan4");
        $data["instansi"] = $this->input->post("jp_instansi4");
        $data["tahun"] = $this->input->post("jp_tahun4");
        $this->db->insert("tb_calon_diklat",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["jenis_pelatihan"] = $this->input->post("jp_jenis_pelatihan5");
        $data["instansi"] = $this->input->post("jp_instansi5");
        $data["tahun"] = $this->input->post("jp_tahun5");
        $this->db->insert("tb_calon_diklat",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["organisasi"] = $this->input->post("o_organisasi1");
        $data["alamat"] = $this->input->post("o_alamat1");
        $data["jabatan"] = $this->input->post("o_jabatan1");
        $this->db->insert("tb_calon_organisasi",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["organisasi"] = $this->input->post("o_organisasi2");
        $data["alamat"] = $this->input->post("o_alamat2");
        $data["jabatan"] = $this->input->post("o_jabatan2");
        $this->db->insert("tb_calon_organisasi",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["organisasi"] = $this->input->post("o_organisasi3");
        $data["alamat"] = $this->input->post("o_alamat3");
        $data["jabatan"] = $this->input->post("o_jabatan3");
        $this->db->insert("tb_calon_organisasi",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["organisasi"] = $this->input->post("o_organisasi4");
        $data["alamat"] = $this->input->post("o_alamat4");
        $data["jabatan"] = $this->input->post("o_jabatan4");
        $this->db->insert("tb_calon_organisasi",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["organisasi"] = $this->input->post("o_organisasi5");
        $data["alamat"] = $this->input->post("o_alamat5");
        $data["jabatan"] = $this->input->post("o_jabatan5");
        $this->db->insert("tb_calon_organisasi",$data);


        $data = array();
        $data["id_calon"] = $id;
        $data["instansi"] = $this->input->post("p_instansi1");
        $data["alamat"] = $this->input->post("p_alamat1");
        $data["jabatan"] = $this->input->post("p_jabatan1");
        $this->db->insert("tb_calon_pekerjaan",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["instansi"] = $this->input->post("p_instansi2");
        $data["alamat"] = $this->input->post("p_alamat2");
        $data["jabatan"] = $this->input->post("p_jabatan2");
        $this->db->insert("tb_calon_pekerjaan",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["instansi"] = $this->input->post("p_instansi3");
        $data["alamat"] = $this->input->post("p_alamat3");
        $data["jabatan"] = $this->input->post("p_jabatan3");
        $this->db->insert("tb_calon_pekerjaan",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["instansi"] = $this->input->post("p_instansi4");
        $data["alamat"] = $this->input->post("p_alamat4");
        $data["jabatan"] = $this->input->post("p_jabatan4");
        $this->db->insert("tb_calon_pekerjaan",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["instansi"] = $this->input->post("p_instansi5");
        $data["alamat"] = $this->input->post("p_alamat5");
        $data["jabatan"] = $this->input->post("p_jabatan5");
        $this->db->insert("tb_calon_pekerjaan",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["penghargaan"] = $this->input->post("pe_penghargaan1");
        $data["instansi"] = $this->input->post("pe_instansi1");
        $data["tahun"] = $this->input->post("pe_tahun1");
        $this->db->insert("tb_calon_penghargaan",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["penghargaan"] = $this->input->post("pe_penghargaan2");
        $data["instansi"] = $this->input->post("pe_instansi2");
        $data["tahun"] = $this->input->post("pe_tahun2");
        $this->db->insert("tb_calon_penghargaan",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["penghargaan"] = $this->input->post("pe_penghargaan3");
        $data["instansi"] = $this->input->post("pe_instansi3");
        $data["tahun"] = $this->input->post("pe_tahun3");
        $this->db->insert("tb_calon_penghargaan",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["penghargaan"] = $this->input->post("pe_penghargaan4");
        $data["instansi"] = $this->input->post("pe_instansi4");
        $data["tahun"] = $this->input->post("pe_tahun4");
        $this->db->insert("tb_calon_penghargaan",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["penghargaan"] = $this->input->post("pe_penghargaan5");
        $data["instansi"] = $this->input->post("pe_instansi5");
        $data["tahun"] = $this->input->post("pe_tahun5");
        $this->db->insert("tb_calon_penghargaan",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["kegiatan"] = $this->input->post("k_kegiatan1");
        $data["lokasi"] = $this->input->post("k_lokasi1");
        $data["tahun"] = $this->input->post("k_tahun1");
        $this->db->insert("tb_calon_sosial",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["kegiatan"] = $this->input->post("k_kegiatan2");
        $data["lokasi"] = $this->input->post("k_lokasi2");
        $data["tahun"] = $this->input->post("k_tahun2");
        $this->db->insert("tb_calon_sosial",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["kegiatan"] = $this->input->post("k_kegiatan3");
        $data["lokasi"] = $this->input->post("k_lokasi3");
        $data["tahun"] = $this->input->post("k_tahun3");
        $this->db->insert("tb_calon_sosial",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["kegiatan"] = $this->input->post("k_kegiatan4");
        $data["lokasi"] = $this->input->post("k_lokasi4");
        $data["tahun"] = $this->input->post("k_tahun4");
        $this->db->insert("tb_calon_sosial",$data);

        $data = array();
        $data["id_calon"] = $id;
        $data["kegiatan"] = $this->input->post("k_kegiatan5");
        $data["lokasi"] = $this->input->post("k_lokasi5");
        $data["tahun"] = $this->input->post("k_tahun5");
        $this->db->insert("tb_calon_sosial",$data);

        $data = array();
        $data["prov"] = $this->db->query("select distinct m_geo_prov_kpu.* from m_geo_prov_kpu inner join tb_grade on tb_grade.geo_prov_id = m_geo_prov_kpu.geo_prov_id");
        $this->load->view('tambah_calon',$data);
    }

    function kabupaten(){
        $provinsi = $this->input->post("provinsi");
        $this->db->where("geo_prov_id",$provinsi);
        $query = $this->db->get("m_geo_kab_kpu");
        echo '<option value="">ALL </option>';
        foreach($query->result() as $tmp){
            echo "<option value='".$tmp->geo_kab_id."'>".$tmp->geo_kab_nama."</option>";
        }
    }
    function kabupaten_pemilihan(){
        $provinsi = $this->input->post("provinsi");
				$query = $this->db->query("select m_geo_kab_kpu.* from m_geo_kab_kpu inner join tb_grade on tb_grade.geo_kab_id = m_geo_kab_kpu.geo_kab_id where m_geo_kab_kpu.geo_prov_id = '".$provinsi."'");
        echo '<option value="">ALL </option>';
        foreach($query->result() as $tmp){
            echo "<option value='".$tmp->geo_kab_id."'>".$tmp->geo_kab_nama."</option>";
        }
    }
    function upload(){
        $base64Image = $this->input->post("image");
        $filename = $this->input->post("name");
        $decoded=base64_decode($base64Image);
        //file_put_contents($filename,$decoded);
        //echo FCPATH."/foto/".$filename;
        file_put_contents(FCPATH."foto/".$filename,$decoded);
    }
}
