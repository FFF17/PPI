<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Register extends CI_Controller {
   
    function index(){
    $data["prov"] = $this->db->get("provinsi");
        $this->load->view('register', $data);
    }

    function add_new(){


    }
    function check_nik(){
        $nomor_nik = $this->input->post("nik");
        $data = $this->db->query("select kode_anggota, tgl_lhr,tmp_lhr,agama,concat(alamat,' rt ',rt,' rw ',rw,' ',kelurahan.kelurahan,' ', kecamatan.kecamatan,' ',kabupaten.kabupaten,' ',provinsi.provinsi) alamat, pendidikan,pekerjaan,pernikahan,jk,organisasi1 from anggota
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
        $kab = (null !== $this->input->post('kab_selected'))?$this->input->post('kab_selected'):null;
        $this->db->where("provinsi",$geo_prov_id);
        $data = $this->db->get("kabupaten");
        echo "<option value='' disabled selected>Pilih kabupaten</option>";
        foreach($data->result() as $tmp){
            if($kab != null && $tmp->kabupaten == $kab){
                echo "<option value = '".$tmp->kode."' selected>".$tmp->kabupaten."</option>";
            }else{
                echo "<option value = '".$tmp->kode."' >".$tmp->kabupaten."</option>";
            }
        }
    }
    function get_kecamatan(){
        $geo_kab_id = $this->input->post("geo_kab_id");
        $this->db->where("kabupaten",$geo_kab_id);
        $data = $this->db->get("kecamatan");
        echo "<option value='' disabled selected>Pilih kecamatan</option>";
        foreach($data->result() as $tmp){
            echo "<option value = '".$tmp->kode."' >".$tmp->kecamatan."</option>";
        }
    }
    function get_kelurahan(){
        $geo_kec_id = $this->input->post("geo_kec_id");
        $this->db->where("kecamatan",$geo_kec_id);
        $data = $this->db->get("kelurahan");
        echo "<option value='' disabled selected>Pilih kelurahan</option>";
        foreach($data->result() as $tmp){
            echo "<option value = '".$tmp->kode."' >".$tmp->kelurahan."</option>";
        }
    }
      function save(){
            $this->load->helper('string');
            $this->load->library('form_validation');
            $this->form_validation->set_message('is_unique', '%s is already taken');

                        $this->form_validation->set_rules('nomor_telpn', 'Nomor Telepon','required|is_unique[m_anggota.nomor_telpn]');
 if ($this->form_validation->run()) {
                
    
            $data['foto_ktp'] = $this->input->post('ktp_file_name');
            $data['nma_dpn'] = $this->input->post('nma_dpn');
            $data['nma_blkng'] = $this->input->post('nma_blkng');
            $data['nama'] = $this->input->post('nma_dpn')." ".$this->input->post('nma_blkng');


            $data["nomor_ktp"] = $this->input->post("nomor_ktp");
            $data["nomor_telpn"] = $this->input->post("nomor_telpn");
            $data["tempat_lahir"] = $this->input->post("tempat_lahir");
            $data["tanggal_lahir"] = $this->input->post("tanggal_lahir");
            $data["alamat"] = $this->input->post("alamat");
            $data["agama"] = $this->input->post("agama");
            $data["email"] = $this->input->post("email");
            $data["status_perkawinan"] = $this->input->post("status_perkawinan");
            $data["jenis_kelamin"] = $this->input->post("jenis_kelamin");
            $data["rt"] = $this->input->post("rt");
            $data["rw"] = $this->input->post("rw");
            $data["input_status"] = "0";
            $data["register_date"] = date("y-m-d");

            $provinsi = $this->input->post("provinsi");

            $data["provinsi"] = $this->db->where("kode",$this->input->post("provinsi"))->get("provinsi")->row()->provinsi;
            $data["kabupaten"] = $this->db->where("kode",$this->input->post("kabupaten"))->get("kabupaten")->row()->kabupaten;
            $data["kecamatan"] = $this->db->where("kode",$this->input->post("kecamatan"))->get("kecamatan")->row()->kecamatan;
            $data["kelurahan"] = $this->db->where("kode",$this->input->post("kelurahan"))->get("kelurahan")->row()->kelurahan;
            if(null === $this->input->post('nomor_anggota') || $this->input->post('nomor_anggota') == ""){
                $last = 0;
                $this->db->where("prefix",$this->input->post("prefix"));
                $tmpIndex = $this->db->get("t_index");

                foreach($tmpIndex->result() as $tmp){
                    $last = $tmp->last_index;
                }
                $last++;
                if($last == 1){
                    $tmpData["prefix"]  = $this->input->post("prefix");
                    $tmpData["last_index"] = $last;
                    $this->db->insert("t_index",$tmpData);
                }else{
                    $this->db->where("prefix",$this->input->post("prefix"));
                    $tmpData["last_index"] = $last;
                    $this->db->update("t_index",$tmpData);
                }
                if($last < 9){
                    $data["nomor_anggota"] = $this->input->post("prefix").".10000".$last;
                }else if($last < 99){
                    $data["nomor_anggota"] = $this->input->post("prefix").".1000".$last;
                }else if($last < 999){
                    $data["nomor_anggota"] = $this->input->post("prefix").".100".$last;
                }else if($last < 9999){
                    $data["nomor_anggota"] = $this->input->post("prefix").".10".$last;
                }else{
                    $data["nomor_anggota"] = $this->input->post("prefix").".1".$last;
                }
            }else{
                $data['nomor_anggota'] = $this->input->post('nomor_anggota');
            }

            $data["update_date"] = date("y-m-d");
            $data["update_by"] = $this->session->username;
            if(null !== $this->input->post('id')){
                $this->db->where("id",$this->input->post("id"));
                $this->db->update("m_anggota",$data);
            }else{

                $this->db->insert("m_anggota",$data);
            }
        }else{
                echo validation_errors();

        } 
    }
     function save_ktp_add(){
        $arr = [];
        $config['upload_path'] = './foto/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = time()."_".$_FILES["file"]['name'];

        $this->load->library("upload", $config);

        if(!$this->upload->do_upload('file')){
            $arr['status'] = "failed";
            $arr['message'] = $this->upload->display_errors();
        }else{
            $data = $this->upload->data();
            $arr['status'] = "success";
            $arr['data'] = $data;
            $arr['data']['fixed_file_name'] = "/foto/".$data['file_name'];
        }

        echo json_encode($arr);

    }
}

