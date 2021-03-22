<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kebenduman extends CI_Controller {
    public function index()
	{		
        echo "kebenduman";
    }
    public function dashboard(){
        $dtProv = array();
        $labels = array();
        $dt1 = array();
        $dt2 = array();
        $tmpProv = $this->db->query("select * from m_geo_prov_kpu order by geo_prov_id asc");        
        foreach($tmpProv->result() as $tmp){
            array_push($dtProv,$tmp->geo_code);
            $labels[$tmp->geo_code] = $tmp->geo_prov_nama;
        }
        $data1 = $this->db->query("select m_geo_prov_kpu.geo_prov_nama,sum(COALESCE(t_pembayaran.nominal,0)) total from m_geo_prov_kpu
        left join m_tagihan on m_tagihan.geo_prov_id = m_geo_prov_kpu.geo_prov_id
        left join t_pembayaran on t_pembayaran.id_bio = m_tagihan.id_user and date_format(t_pembayaran.tanggal_pembayaran,'%Y') = date_format(now(),'%Y')
        where tingkat = 'DPRDI' 
        GROUP BY m_geo_prov_kpu.geo_prov_id;");
        foreach($data1->result() as $tmp){
            array_push($dt1,$tmp->total);
        }
        
        $data2 = $this->db->query("select m_geo_prov_kpu.geo_prov_nama,sum(COALESCE(t_pembayaran.nominal,0)) total from m_geo_prov_kpu
        left join m_tagihan on m_tagihan.geo_prov_id = m_geo_prov_kpu.geo_prov_id
        left join t_pembayaran on t_pembayaran.id_bio = m_tagihan.id_user and date_format(t_pembayaran.tanggal_pembayaran,'%Y') = date_format(now(),'%Y')
        where tingkat = 'DPRDII' 
        GROUP BY m_geo_prov_kpu.geo_prov_id;");
        foreach($data2->result() as $tmp){
            array_push($dt2,$tmp->total);
        }

        $dataTagihan = $this->db->query("select sum(TIMESTAMPDIFF(month,start_pembayaran,now()) * m_tagihan.nominal) total_tagihan, sum(COALESCE(t_pembayaran.nominal,0)) total_pembayaran from m_tagihan 
        left join t_pembayaran on t_pembayaran.id_bio = m_tagihan.id_bio")->row();   

        $dataTagihan1 = $this->db->query("select sum(TIMESTAMPDIFF(month,start_pembayaran,now()) * m_tagihan.nominal) total_tagihan, sum(COALESCE(t_pembayaran.nominal,0)) total_pembayaran from m_tagihan 
        left join t_pembayaran on t_pembayaran.id_bio = m_tagihan.id_bio where tingkat = 'DPRDI'")->row(); 

        $dataTagihan2 = $this->db->query("select sum(TIMESTAMPDIFF(month,start_pembayaran,now()) * m_tagihan.nominal) total_tagihan, sum(COALESCE(t_pembayaran.nominal,0)) total_pembayaran from m_tagihan 
        left join t_pembayaran on t_pembayaran.id_bio = m_tagihan.id_bio where tingkat = 'DPRDII'")->row(); 

        $data["data_prov"] = $dtProv;
        $data["data1"] = $dt1;
        $data["data2"] = $dt2;
        $data["labels"] = $labels;
        $data["total_ditagih"] = $dataTagihan->total_tagihan;
        $data["total_dibayar"] = $dataTagihan->total_pembayaran;
        $data["total_tagihan1"] = $dataTagihan1->total_tagihan - $dataTagihan1->total_pembayaran;
        $data["total_tagihan2"] = $dataTagihan2->total_tagihan  - $dataTagihan2->total_pembayaran;
        $this->load->view("kebenduman/dashboard",$data);
    }
	public function master(){
        $data["data"] = $this->db->query("select * from m_tagihan");
		$this->load->view("kebenduman/master",$data);
    }
    public function master_detail(){
        $id = $this->input->post("id");
        $user_id = $this->input->post("user_id");        
        $data = $this->db->query("select * from m_tagihan where id_user = '$user_id' or id = '$id'")->row();
        echo json_encode($data);
    }
    public function master_add(){
        $id = $this->input->post("id");
        $user_id = $this->input->post("user_id");     
        $data["id_bio"] = $user_id;
        $data["start_pembayaran"] = $this->input->post("start_pembayaran");
        $data["end_pembayaran"] = $this->input->post("end_pembayaran");
        $data["nominal"] = $this->input->post("nominal");
        if($id==""){
            $this->db->insert("t_tagihan",$data);
        }else{
            $this->db->where("id",$id);
            $this->db->update("t_tagihan",$data);
        }
    }
    public function iuran(){        
        $data["prov"] = $this->db->get("m_geo_prov_kpu");
        $data["data"] = $this->db->query("select tingkat,geo_prov_nama,geo_kab_nama,nama,t_pembayaran.* from t_pembayaran inner join m_tagihan on m_tagihan.id_bio = t_pembayaran.id_bio");
		$this->load->view("kebenduman/iuran",$data);
    }
    public function iuran_reconcile(){        
        $data["prov"] = $this->db->get("m_geo_prov_kpu");
        $data["data"] = $this->db->query("select tingkat,geo_prov_nama,geo_kab_nama,nama,t_pembayaran.* from t_pembayaran inner join m_tagihan on m_tagihan.id_bio = t_pembayaran.id_bio");
		$this->load->view("kebenduman/iuran_reconcile",$data);
    }


    public function cash_flow(){
        $provinsi = $this->session->provinsi;
        $kabupaten = $this->session->kabupaten;
        $wilayah = "DPP Hanura";
        if($provinsi !=0){
            $tmpData = $this->db->query("select * from m_geo_prov_kpu where geo_prov_id = '$provinsi'")->row();
            $wilayah = $tmpData->geo_prov_nama;
        }
        if($kabupaten !=0){
            $tmpData = $this->db->query("select * from m_geo_kab_kpu where geo_kab_id = '$kabupaten'")->row();
            $wilayah .= " > ".$tmpData->geo_kab_nama;
        }
        $data["wilayah"] = $wilayah;
        $data["data"] = $this->db->query("select * from t_cash_flow where geo_prov_id = '$provinsi' and geo_kab_id = '$kabupaten'");
		$this->load->view("kebenduman/cash_flow",$data);
    }

    public function pembayaran_detail(){        
        $id = $this->input->post("id");
        $data = $this->db->query("select tingkat,geo_prov_nama,geo_kab_nama,nama,t_pembayaran.* from t_pembayaran inner join m_tagihan on m_tagihan.id_bio = t_pembayaran.id_bio where t_pembayaran.id ='$id'")->row();
        echo json_encode($data);
    }
    function get_kabupaten(){
        $geo_prov_id = $this->input->post("geo_prov_id");
        $this->db->where("geo_prov_id",$geo_prov_id);
        $data = $this->db->get("m_geo_kab_kpu");
        echo "<option value='' disabled selected>Pilih kabupaten</option>";
        echo "<option value='0'>DPRDI</option>";
        foreach($data->result() as $tmp){
            echo "<option value = '".$tmp->geo_kab_id."' >".$tmp->geo_kab_nama."</option>";
        }
    }
    function get_bio(){
        $geo_prov_id = $this->input->post("geo_prov_id");
        $geo_kab_id = $this->input->post("geo_kab_id");
        $sql = "select * from m_tagihan where geo_prov_id = '$geo_prov_id' and geo_kab_id = '$geo_kab_id' and nominal  <> ''";
        $data = $this->db->query($sql);
        echo "<option value='' disabled selected>Pilih Nama</option>";
        foreach($data->result() as $tmp){
            echo "<option value = '".$tmp->id_user."' >".$tmp->nama."</option>";
        }
    }
    function get_tagihan(){
        $id = $this->input->post("bio_id");
        $data = $this->db->query("select TIMESTAMPDIFF(month,start_pembayaran,now()) * m_tagihan.nominal total_tagihan, sum(COALESCE(t_pembayaran.nominal,0)) total_pembayaran from m_tagihan 
        left join t_pembayaran on t_pembayaran.id_bio = m_tagihan.id_bio
        where m_tagihan.id_bio = '$id'")->row();   
        $data->tagihan = $data->total_tagihan - $data->total_pembayaran;
        echo json_encode($data);
    }
    function iuran_add(){        
        $id = $this->input->post("id");
        $user_id = $this->input->post("user_id");     
        $data["id_bio"] = $user_id;
        $data["tanggal_pembayaran"] = $this->input->post("tanggal_pembayaran");
        $data["keterangan"] = $this->input->post("keterangan");
        $data["nominal"] = $this->input->post("nominal");
        $data["status"] = "0";
        if($id=="0"){
            $this->db->insert("t_pembayaran",$data);
        }else{
            $this->db->where("id",$id);
            $this->db->update("t_pembayaran",$data);
        }
    }
    function iuran_reconsile_save(){        
        $id = $this->input->post("id");
        $data["keterangan2"] = $this->input->post("keterangan");
        $data["status"] = $this->input->post("status");
        $data["tanggal_rekonsiliasi"] = date("d-m-y");
        $this->db->where("id",$id);
        $this->db->update("t_pembayaran",$data);
    }
    function add_cash_flow(){
        $id = $this->input->post("id");        
        $data["geo_prov_id"] = $this->session->provinsi;
        $data["geo_kab_id"] = $this->session->kabupaten;
        $data["cr"] = $this->input->post("cr");
        $data["tanggal_transaksi"] = $this->input->post("tanggal_transaksi");
        $data["deskripsi"] = $this->input->post("deskripsi");
        $data["nominal"] = $this->input->post("nominal");
        if($id=="0"){
            $this->db->insert("t_cash_flow",$data);
        }else{
            $this->db->where("id",$id);
            $this->db->update("t_cash_flow",$data);
        }
    }
} 