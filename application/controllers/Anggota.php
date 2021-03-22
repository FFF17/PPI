<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Anggota extends CI_Controller {
    function index(){

    }

    function baru(){
        $data["data"] = $this->db->query("select * from m_anggota where input_status = '0' ORDER BY register_date DESC");

        $this->load->view("anggota/baru",$data);
    }

    function list_data(){
        $provinsi = $this->input->post("provinsi");
        $kabupaten = $this->input->post("kabupaten");
        $sql = "select * from m_anggota where input_status = '1'";
        
        if($kabupaten!=""){
            $sql.= " and nomor_anggota like('$provinsi.".substr($kabupaten,2)."%')";
            $data["kab"] = $this->db->where("provinsi",$provinsi)->get("kabupaten");
        }else if($provinsi!=""){
            $sql.= " and nomor_anggota like('$provinsi%')";
        }
        $data["data"] = $this->db->query($sql);
        $data["prov"] = $this->db->get("provinsi");
        $data["provinsi"] = $provinsi;
        $data["kabupaten"] = $kabupaten;
        $this->load->view("anggota/list",$data);
    }
    function jabatan(){
        $provinsi = $this->input->post("provinsi");
        $kabupaten = $this->input->post("kabupaten");
        $tingkat = $this->input->post("tingkat");

        if($tingkat == "dpc"){
            $sql = "select tingkat,provinsi.kode kode_provinsi,provinsi.provinsi,kabupaten.kode kode_kabupaten,kabupaten.kabupaten, jabatan,m_anggota.nama from m_jabatan inner join provinsi inner join kabupaten on kabupaten.provinsi = provinsi.kode and kabupaten.kode = '$kabupaten'  left join t_jabatan  on t_jabatan.id_jabatan = m_jabatan.id and t_jabatan.id_provinsi = provinsi.kode and t_jabatan.id_kabupaten = kabupaten.kode left join m_anggota on m_anggota.id= t_jabatan.id_anggota  where tingkat = 'dpc'";
        }else if($tingkat == "dpd"){
            $sql = "select tingkat,provinsi.kode kode_provinsi,provinsi.provinsi,'0' kode_kabupaten,'-' kabupaten, jabatan,m_anggota.nama from m_jabatan inner join provinsi on provinsi.kode = '$provinsi'  left join t_jabatan  on t_jabatan.id_jabatan = m_jabatan.id and t_jabatan.id_provinsi = provinsi.kode left join m_anggota on m_anggota.id= t_jabatan.id_anggota  where tingkat = 'dpd'";
        } else{
            $sql = "select tingkat,'0' kode_provinsi,'-' provinsi,'0' kode_kabupaten,'-' kabupaten, jabatan,m_anggota.nama from m_jabatan left join t_jabatan  on t_jabatan.id_jabatan = m_jabatan.id left join m_anggota on m_anggota.id= t_jabatan.id_anggota  where tingkat = 'dpp' ";
        }
        if($kabupaten!=""){
            $data["kab"] = $this->db->where("provinsi",$provinsi)->get("kabupaten");
        }
        $data["data"] = $this->db->query($sql);
        $data["prov"] = $this->db->get("provinsi");
        $data["provinsi"] = $provinsi;
        $data["kabupaten"] = $kabupaten;
        $data["tingkat"] = $tingkat;
        $this->load->view("anggota/jabatan",$data);
    }
    function input_detail(){
          $id = $this->input->post("id");
        $anggota = $this->db->query("SELECT
                            m_anggota.*, provinsi.kode AS K_PROV,
                            kabupaten.kode AS K_KAB,
                            kecamatan.kode AS K_KEC,
                            kelurahan.kode AS K_KEL
                        FROM
                            m_anggota
                        LEFT JOIN provinsi ON m_anggota.provinsi = provinsi.provinsi
                        LEFT JOIN kabupaten ON m_anggota.kabupaten = kabupaten.kabupaten
                        LEFT JOIN kecamatan ON m_anggota.kecamatan = kecamatan.kecamatan
                        LEFT JOIN kelurahan ON m_anggota.kelurahan = kelurahan.kelurahan
                        WHERE
                            m_anggota.id = ".$id."
                        AND IF(kecamatan.kode IS NOT NULL, kecamatan.kode LIKE CONCAT(kabupaten.kode, '%'), m_anggota.id = ".$id.")
                        AND IF(kelurahan.kode IS NOT NULL, kelurahan.kode LIKE CONCAT(kecamatan.kode, '%'), m_anggota.id = ".$id.")")->row();
        //echo "<pre>".json_encode($anggota, JSON_PRETTY_PRINT)."</pre>"; die();
        $data["data"] = $anggota;
        $data["prov"] = $this->db->get("provinsi");

       
        $this->load->view("anggota/verifikasi_data",$data);
    }
    function approval(){

        $this->load->helper('string');
        
            $data['foto_ktp'] = $this->input->post('ktp_file_name');
            $data['nma_dpn'] = $this->input->post('nma_dpn');
            $data['nma_blkng'] = $this->input->post('nma_blkng');
            $data['nama'] = $this->input->post('nma_dpn')." ".$this->input->post('nma_blkng');
            $data["nomor_telpn"] = $this->input->post("nomor_telpn");
            $data["nomor_ktp"] = $this->input->post("nomor_ktp");
            $data["tempat_lahir"] = $this->input->post("tempat_lahir");
            $data["tanggal_lahir"] = $this->input->post("tanggal_lahir");
            $data["alamat"] = $this->input->post("alamat");
            $data["agama"] = $this->input->post("agama");
            $data["email"] = $this->input->post("email");
            $data["status_perkawinan"] = $this->input->post("status_perkawinan");
            $data["jenis_kelamin"] = $this->input->post("jenis_kelamin");
            $data["rt"] = $this->input->post("rt");
            $data["rw"] = $this->input->post("rw");
            $data["input_status"] = "1";

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
    }
    function view(){
        $id = $this->input->post("id");
        $anggota = $this->db->query("select * from m_anggota where m_anggota.id = '".$id."'")->row();
        $data["data"] = $anggota;
        $data["prov"] = $this->db->get("provinsi");

        $this->load->view("anggota/view",$data);
    }

     function set_jabatan(){
        $id = $this->input->post("id");
        $provinsi = $this->input->post("provinsi");
        $data["tingkat"] = $this->db->get("m_jabatan")->row();
        $data["prov"] = $this->db->get("provinsi");

$anggota = $this->db->query("SELECT
                            m_anggota.*, provinsi.kode AS K_PROV,
                            kabupaten.kode AS K_KAB,
                            kecamatan.kode AS K_KEC,
                            kelurahan.kode AS K_KEL
                        FROM
                            m_anggota
                        LEFT JOIN provinsi ON m_anggota.provinsi = provinsi.provinsi
                        LEFT JOIN kabupaten ON m_anggota.kabupaten = kabupaten.kabupaten
                        LEFT JOIN kecamatan ON m_anggota.kecamatan = kecamatan.kecamatan
                        LEFT JOIN kelurahan ON m_anggota.kelurahan = kelurahan.kelurahan
                        WHERE
                            m_anggota.id = ".$id."
                        AND IF(kecamatan.kode IS NOT NULL, kecamatan.kode LIKE CONCAT(kabupaten.kode, '%'), m_anggota.id = ".$id.")
                        AND IF(kelurahan.kode IS NOT NULL, kelurahan.kode LIKE CONCAT(kecamatan.kode, '%'), m_anggota.id = ".$id.")")->row();
        $data["data"] = $anggota;

        $this->load->view("anggota/set_jabatan",$data);
    }
    function edit(){
        $id = $this->input->post("id");
        $anggota = $this->db->query("SELECT
                            m_anggota.*, provinsi.kode AS K_PROV,
                            kabupaten.kode AS K_KAB,
                            kecamatan.kode AS K_KEC,
                            kelurahan.kode AS K_KEL
                        FROM
                            m_anggota
                        LEFT JOIN provinsi ON m_anggota.provinsi = provinsi.provinsi
                        LEFT JOIN kabupaten ON m_anggota.kabupaten = kabupaten.kabupaten
                        LEFT JOIN kecamatan ON m_anggota.kecamatan = kecamatan.kecamatan
                        LEFT JOIN kelurahan ON m_anggota.kelurahan = kelurahan.kelurahan
                        WHERE
                            m_anggota.id = ".$id."
                        AND IF(kecamatan.kode IS NOT NULL, kecamatan.kode LIKE CONCAT(kabupaten.kode, '%'), m_anggota.id = ".$id.")
                        AND IF(kelurahan.kode IS NOT NULL, kelurahan.kode LIKE CONCAT(kecamatan.kode, '%'), m_anggota.id = ".$id.")")->row();
        //echo "<pre>".json_encode($anggota, JSON_PRETTY_PRINT)."</pre>"; die();
        $data["data"] = $anggota;
     

        $data["prov"] = $this->db->get("provinsi");
        $this->load->view("anggota/edit",$data);
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

    public function get_jabatan(){

        $tingkat = $this->input->post("tingkat");

        if($tingkat == "PIMNAS"){

        $data = $this->db->query("SELECT * FROM m_jabatan WHERE tingkat ='PIMNAS'",$tingkat);
                echo "<option value='' disabled selected>Pilih Jabatan</option>";
                        foreach($data->result() as $tmp){
                echo "<option value = '".$tmp->id."' >".$tmp->jabatan."</option>";
            }
       
        }else if($tingkat == "PIMDA"){

        $data = $this->db->query("SELECT * FROM m_jabatan WHERE tingkat ='PIMDA'",$tingkat);
         echo "<option value='' disabled selected>Pilih Jabatan</option>";
         foreach($data->result() as $tmp){
                echo "<option value = '".$tmp->id."' >".$tmp->jabatan."</option>";
            }
        }else{

        $data = $this->db->query("SELECT * FROM m_jabatan WHERE tingkat ='PIMCAB'",$tingkat);
         echo "<option value='' disabled selected>Pilih Jabatan</option>";
      foreach($data->result() as $tmp){
                echo "<option value = '".$tmp->id."' >".$tmp->jabatan."</option>";
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
   
    function delete(){
        $this->db->where("id",$this->input->post("id"));
        $this->db->delete("m_anggota");
    }

    function add_new(){
        $data["agama"] = $this->db->get("m_agama");
        $data["pekerjaan"] = $this->db->get("m_pekerjaan");
        $data["pendidikan"] = $this->db->get("m_pendidikan");
        $data["prov"] = $this->db->get("provinsi");
        $this->load->view('anggota/add', $data);
    }

    function print_doc(){
        $id= $this->input->get('id');

        $data = $this->db->where('id', $id)
                        ->get('m_anggota')->row();

        $pdf = new FPDF();

        if($this->input->get('kta') == "YES"){

            $file_name = str_replace(".", "_", $data->nomor_anggota);

            $this->load->library('infiQr');
            QRcode::png($data->nomor_anggota, 'assets/qr_kta/' . $file_name . ".png");

            $pdf->SetMargins(1, 1, 2);
            $pdf->SetAutoPageBreak(false);
            $pdf->AddPage('L', array(86, 54));

            if(file_exists('.'.$data->foto)){
                $pdf->Image(".".$data->foto, 1, 1, 23, 27);
            }

            $pdf->Image("./assets/qr_kta/".$file_name.".png", 1, 30, 24, 24);

            $pdf->SetFont('Arial', '', 5);
            $pdf->SetX(25);
            $pdf->Cell(20, 3, "Nomor Anggota", 0, 0, 'L');
            $pdf->Cell(1, 3, ":");
            $pdf->Cell(38, 3, $data->nomor_anggota, 0, 0, 'L');
            $pdf->Ln();

            $pdf->SetX(25);
            $pdf->Cell(20, 3, "Nama", 0, 0, 'L');
            $pdf->Cell(1, 3, ":");
            $pdf->Cell(38, 3, $data->nama, 0, 0, 'L');
            $pdf->Ln();

            $pdf->SetX(25);
            $pdf->Cell(20, 3, "Tempat, Tanggal Lahir", 0, 0, 'L');
            $pdf->Cell(1, 3, ":");
            $pdf->Cell(38, 3, ucfirst(strtolower($data->tempat_lahir)).", ".date_format(date_create($data->tanggal_lahir), "d-m-Y"), 0, 0, 'L');
            $pdf->Ln();

            $pdf->SetX(25);
            $pdf->Cell(20, 3, "Alamat", 0, 0, 'L');
            $pdf->Cell(1, 3, ":");
            $pdf->Cell(38, 3, $data->alamat, 0, 0, 'L');
            $pdf->Ln();

            $pdf->SetX(25);
            $pdf->Cell(20, 3, "RT/RW", 0, 0, 'L');
            $pdf->Cell(1, 3, ":");
            $pdf->Cell(38, 3, $data->rt."/".$data->rw, 0, 0, 'L');
            $pdf->Ln();

            $pdf->SetX(25);
            $pdf->Cell(20, 3, "Kelurahan", 0, 0, 'L');
            $pdf->Cell(1, 3, ":");
            $pdf->Cell(38, 3, $data->kelurahan, 0, 0, 'L');
            $pdf->Ln();

            $pdf->SetX(25);
            $pdf->Cell(20, 3, "Kecamatan", 0, 0, 'L');
            $pdf->Cell(1, 3, ":");
            $pdf->Cell(38, 3, $data->kecamatan, 0, 0, 'L');
            $pdf->Ln();

            $pdf->SetX(25);
            $pdf->Cell(20, 3, "Kabupaten/Kota", 0, 0, 'L');
            $pdf->Cell(1, 3, ":");
            $pdf->Cell(38, 3, $data->kabupaten, 0, 0, 'L');
            $pdf->Ln();

            $pdf->SetX(25);
            $pdf->Cell(20, 3, "Provinsi", 0, 0, 'L');
            $pdf->Cell(1, 3, ":");
            $pdf->Cell(38, 3, $data->provinsi, 0, 0, 'L');
            $pdf->Ln(5);

            $pdf->SetX(25);
            $pdf->Cell(20, 3, "Dikeluarkan Sejak", 0, 0, 'L');
            $pdf->Cell(1, 3, ":");
            $pdf->Cell(38, 3, date_format(date_create($data->register_date), 'd M Y'), 0, 0, 'L');
            $pdf->Ln(4);

            $pdf->SetFont('Arial', 'B', 7);
            $pdf->SetX(25);
            $pdf->Cell(58, 5, 'DEWAN PIMPINAN PUSAT', 0, 0, 'C');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 5);
            $pdf->SetX(25);
            $pdf->Cell(21, 4, "KETUA UMUM", 0, 0, "C");
            $pdf->Cell(43, 4, "SEKRETARIS JENDERAL", 0, 0, "C");
            $pdf->Image("./assets/img/ttd_ketua.png", 30, 43, 10, 5);
            $pdf->Image("./assets/img/ttd_sekjen.png", 61, 43, 10, 5);
            $pdf->Ln(5);
            $pdf->SetFont('Arial', 'B', 5);
            $pdf->Ln(2);
            $pdf->SetX(26);
            $pdf->Cell(21, 12, "DR. OESMAN SAPTA");
            $pdf->Cell(43, 12, "GEDE PASEK SUARDIKA, SH., MH", 0, 0, "C");
            $pdf->Ln(2);
        }

        if($this->input->get('ktp') == "YES"){
            if($data->foto_ktp != null){
                $pdf->AddPage('P', 'A4');
                list($width, $height) = getimagesize(".".$data->foto_ktp);

                if($width > $height){
                    $pdf->Image(".".$data->foto_ktp, 5, 5, 80);
                }else{
                    $pdf->Image(".".$data->foto_ktp, 5, 5, 80);
                }
            }
        }

        $pdf->Output();
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