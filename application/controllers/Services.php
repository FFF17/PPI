<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Services extends CI_Controller{
  function index(){
    echo "ini api";
  }
  public function json_provinsi(){
      $data = $this->db->query("select distinct m_geo_prov_kpu.* from m_geo_prov_kpu inner join tb_grade on tb_grade.geo_prov_id = m_geo_prov_kpu.geo_prov_id");
      echo json_encode($data->result());
  }
  public function json_kabupaten(){
      $data = $this->db->query("select distinct m_geo_kab_kpu.* from m_geo_kab_kpu inner join tb_grade on tb_grade.geo_kab_id = m_geo_kab_kpu.geo_kab_id where tb_grade.geo_prov_id = '".$this->input->get("id")."' order by geo_kab_id asc");
      echo json_encode($data->result());
  }
  function calon(){
    $provinsi = $this->input->get("provinsi");
    $kabupaten = $this->input->get("kabupaten");
    if($provinsi != ""){
        $this->db->where("provinsi",$provinsi);
    }
    if($kabupaten != ""){
        $this->db->where("kabupaten_kota",$kabupaten);
    }
    $this->db->where("status",'1');
    $this->db->select("tb_calon.*, geo_prov_nama provinsi, geo_kab_nama kabupaten, (YEAR(now()) - YEAR(tanggal_lahir)) umur");
    $this->db->from("tb_calon");
    $this->db->join("m_geo_prov_kpu","tb_calon.provinsi = m_geo_prov_kpu.geo_prov_id");
    $this->db->join("m_geo_kab_kpu","tb_calon.kabupaten_kota = m_geo_kab_kpu.geo_kab_id");
    $data = $this->db->get();
    echo json_encode($data->result());
  }
  function kursi(){
    $provinsi = $this->input->get("provinsi");
    $kabupaten = $this->input->get("kabupaten");
    if($provinsi != ""){
        $this->db->where("geo_prov_id",$provinsi);
    }
    if($kabupaten != ""){
        $this->db->where("geo_kab_id",$kabupaten);
    }else{
      $this->db->where("geo_kab_id",'0');
    }
    $data = $this->db->get("tb_kursi");
    echo json_encode($data->result());
  }
  function grade(){
    $provinsi = $this->input->get("provinsi");
    $kabupaten = $this->input->get("kabupaten");
    if($provinsi != ""){
        $this->db->where("geo_prov_id",$provinsi);
    }
    if($kabupaten != ""){
        $this->db->where("geo_kab_id",$kabupaten);
    }else{
      $this->db->where("geo_kab_id",'0');
    }
    $data = $this->db->get("tb_grade");
    echo @$data->row()->grade;
  }
  function syarat(){
    $provinsi = $this->input->get("provinsi");
    $kabupaten = $this->input->get("kabupaten");
    if($provinsi != ""){
        $this->db->where("geo_prov_id",$provinsi);
    }
    if($kabupaten != ""){
        $this->db->where("geo_kab_id",$kabupaten);
    }else{
      $this->db->where("geo_kab_id",'0');
    }
    $data = $this->db->get("tb_syarat");
    echo @$data->row()->syarat;
  }
  function acara(){
    $query = $this->db->query("select distinct tanggal from tb_event");
    $data = array();
    foreach($query->result() as $tmp){
      $item["tanggal"] = $tmp->tanggal;
      $qacara = $this->db->query("select * from tb_event where tanggal = '".$tmp->tanggal."'");
      $item["acara"] = $qacara->result();
      array_push($data,$item);
    }
    echo json_encode($data);
  }
}
