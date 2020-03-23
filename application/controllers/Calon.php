<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Calon extends CI_Controller
{
    public function index()
    {
    }
    public function pendaftar()
    {
        $provinsi = $this->input->post("provinsi");
        $kabupaten = $this->input->post("kabupaten");
        $tingat["bupati"] = "CALON BUPATI";
        $tingat["walikota"] = "CALON WALIKOTA";
        $tingat["gubernur"] = "CALON GUBERNUR";
        $tingat["wakil_bupati"] = "CALON WAKIL BUPATI";
        $tingat["wakil_walikota"] = "CALON WAKIL WALIKOTA";
        $tingat["wakil_gubernur"] = "CALON WAKIL GUBERNUR";

        $data["prov"] = $this->db->get("m_geo_prov_kpu");

        $this->db->where("geo_prov_id", $provinsi);
        $data["kab"] = $this->db->get("m_geo_kab_kpu");

        if ($provinsi != "") {
            $this->db->where("provinsi", $provinsi);
        }
        if ($kabupaten != "") {
            $this->db->where("kabupaten_kota", $kabupaten);
        }
        $this->db->select("tb_calon.*, (SELECT file FROM tb_calon_surat_tugas WHERE (id_calon = tb_calon.id OR id_pasangan = tb_calon.id) AND jenis_surat_tugas = 'individu') AS file_individu, (SELECT file FROM tb_calon_surat_tugas WHERE (id_calon = tb_calon.id OR id_pasangan = tb_calon.id) AND jenis_surat_tugas = 'pasangan') AS file_pasangan, geo_prov_nama, geo_kab_nama");
        $this->db->from("tb_calon");
        $this->db->join("m_geo_prov_kpu", "tb_calon.provinsi = m_geo_prov_kpu.geo_prov_id");
        $this->db->join("m_geo_kab_kpu", "tb_calon.kabupaten_kota = m_geo_kab_kpu.geo_kab_id");
        $data["calon"] = $this->db->get();

        $data["tingkat"] = $tingat;

        $data["provinsi"] = $provinsi;
        $data["kabupaten"] = $kabupaten;
        $this->load->view("calon/pendaftar", $data);
    }
    function detail()
    {
        $tingat["bupati"] = "CALON BUPATI";
        $tingat["walikota"] = "CALON WALIKOTA";
        $tingat["gubernur"] = "CALON GUBERNUR";
        $tingat["wakil_bupati"] = "CALON WAKIL BUPATI";
        $tingat["wakil_walikota"] = "CALON WAKIL WALIKOTA";
        $tingat["wakil_gubernur"] = "CALON WAKIL GUBERNUR";

        $id = $this->input->post("id");
        $this->db->where("id", $id);
        $this->db->select("tb_calon.*, geo_prov_nama, geo_kab_nama");
        $this->db->from("tb_calon");
        $this->db->join("m_geo_prov_kpu", "tb_calon.provinsi = m_geo_prov_kpu.geo_prov_id");
        $this->db->join("m_geo_kab_kpu", "tb_calon.kabupaten_kota = m_geo_kab_kpu.geo_kab_id");
        $data["data"] = $this->db->get()->row();

        $this->db->where("id_calon", $id);
        $data["pendidikan"] = $this->db->get("tb_calon_pendidikan");

        $this->db->where("id_calon", $id);
        $data["diklat"] = $this->db->get("tb_calon_diklat");

        $this->db->where("id_calon", $id);
        $data["organisasi"] = $this->db->get("tb_calon_organisasi");

        $this->db->where("id_calon", $id);
        $data["pekerjaan"] = $this->db->get("tb_calon_pekerjaan");

        $this->db->where("id_calon", $id);
        $data["penghargaan"] = $this->db->get("tb_calon_penghargaan");

        $this->db->where("id_calon", $id);
        $data["sosial"] = $this->db->get("tb_calon_sosial");
        $data["tingkat"] = $tingat;

        $provinsi = $this->input->post("provinsi");
        $kabupaten = $this->input->post("kabupaten");
        $data["provinsi"] = $provinsi;
        $data["kabupaten"] = $kabupaten;

        $this->load->view("calon/detail", $data);
    }

    function edit()
    {
        $tingat["bupati"] = "CALON BUPATI";
        $tingat["walikota"] = "CALON WALIKOTA";
        $tingat["gubernur"] = "CALON GUBERNUR";
        $tingat["wakil_bupati"] = "CALON WAKIL BUPATI";
        $tingat["wakil_walikota"] = "CALON WAKIL WALIKOTA";
        $tingat["wakil_gubernur"] = "CALON WAKIL GUBERNUR";

        $id = $this->input->post("id");
        $this->db->where("id", $id);
        $this->db->select("tb_calon.*, geo_prov_nama, geo_kab_nama");
        $this->db->from("tb_calon");
        $this->db->join("m_geo_prov_kpu", "tb_calon.provinsi = m_geo_prov_kpu.geo_prov_id");
        $this->db->join("m_geo_kab_kpu", "tb_calon.kabupaten_kota = m_geo_kab_kpu.geo_kab_id");
        $data["data"] = $this->db->get()->row();

        $this->db->where("id_calon", $id);
        $data["pendidikan"] = $this->db->get("tb_calon_pendidikan");

        $this->db->where("id_calon", $id);
        $data["diklat"] = $this->db->get("tb_calon_diklat");

        $this->db->where("id_calon", $id);
        $data["organisasi"] = $this->db->get("tb_calon_organisasi");

        $this->db->where("id_calon", $id);
        $data["pekerjaan"] = $this->db->get("tb_calon_pekerjaan");

        $this->db->where("id_calon", $id);
        $data["penghargaan"] = $this->db->get("tb_calon_penghargaan");

        $this->db->where("id_calon", $id);
        $data["sosial"] = $this->db->get("tb_calon_sosial");
        $data["tingkat"] = $tingat;

        $provinsi = $data['data']->provinsi;
        $kabupaten = $data['data']->kabupaten_kota;

        $this->db->where("geo_prov_id", $provinsi);
        $data["kab"] = $this->db->get("m_geo_kab_kpu");
        $data["prov"] = $this->db->get("m_geo_prov_kpu");

        $data["provinsi"] = $provinsi;
        $data["kabupaten"] = $kabupaten;

        $this->load->view("calon/edit", $data);
    }

    function update()
    {
        $id = $this->input->post('id_calon');
        $nama = $this->input->post('nama_calon');
        $provinsi_select = $this->input->post('provinsi_select');
        $kabupaten_select = $this->input->post('kabupaten_select');
        $mencalonkan = $this->input->post('mencalonkan');
        $tempat_lahir = $this->input->post('tempat_lahir');
        $tgl_lahir = $this->input->post('tgl_lahir');
        $no_nik = $this->input->post('no_nik');
        $no_kta = $this->input->post('no_kta');
        $jk = $this->input->post('jk');
        $agama = $this->input->post('agama');
        $alamat = $this->input->post('alamat');
        $telp = $this->input->post('telp');
        $email = $this->input->post('email');
        $sm_fb = $this->input->post('sm_fb');
        $sm_twitter = $this->input->post('sm_twitter');
        $sm_instagram = $this->input->post('sm_instagram');
        $status_perkawinan = $this->input->post('status_perkawinan');
        $nama_istri = $this->input->post('nama_istri');

        $this->db->where('id_calon', $id);
        $this->db->delete('tb_calon_pendidikan');
        $pendidikan = ['SD', 'SMP', 'SMA', 'S1', 'S2'];

        for ($i = 0; $i < 5; $i++) {
            ${$pendidikan[$i] . '_ALAMAT'} = $this->input->post($pendidikan[$i] . '_ALAMAT');
            ${$pendidikan[$i] . '_TAHUN'} = $this->input->post($pendidikan[$i] . '_TAHUN');

            $data_pendidikan = [
                'id_calon' => $id,
                'tingkat' => $pendidikan[$i],
                'alamat' => ${$pendidikan[$i] . '_ALAMAT'},
                'tahun' => ${$pendidikan[$i] . '_TAHUN'}
            ];

            $this->db->insert('tb_calon_pendidikan', $data_pendidikan);
        }

        $this->db->where('id_calon', $id);
        $this->db->delete('tb_calon_diklat');
        for ($i = 1; $i < 6; $i++) {
            ${'jp_jenis_pelatihan' . $i} = $this->input->post('jp_jenis_pelatihan' . $i);
            ${'jp_instansi' . $i} = $this->input->post('jp_instansi' . $i);
            ${'jp_tahun' . $i} = $this->input->post('jp_tahun' . $i);

            $data_pelatihan = [
                'id_calon' => $id,
                'jenis_pelatihan' => ${'jp_jenis_pelatihan' . $i},
                'instansi' => ${'jp_instansi' . $i},
                'tahun' => ${'jp_tahun' . $i}
            ];

            $this->db->insert('tb_calon_diklat', $data_pelatihan);
        }

        $this->db->where('id_calon', $id);
        $this->db->delete('tb_calon_organisasi');
        for ($i = 1; $i < 6; $i++) {
            ${'o_organisasi' . $i} = $this->input->post('o_organisasi' . $i);
            ${'o_alamat' . $i} = $this->input->post('o_alamat' . $i);
            ${'o_jabatan' . $i} = $this->input->post('o_jabatan' . $i);

            $data_organisasi = [
                'id_calon' => $id,
                'organisasi' => ${'o_organisasi' . $i},
                'alamat' => ${'o_alamat' . $i},
                'jabatan' => ${'o_jabatan' . $i}
            ];

            $this->db->insert('tb_calon_organisasi', $data_organisasi);
        }

        $this->db->where('id_calon', $id);
        $this->db->delete('tb_calon_pekerjaan');
        for ($i = 1; $i < 6; $i++) {
            ${'p_instansi' . $i} = $this->input->post('p_instansi' . $i);
            ${'p_alamat' . $i} = $this->input->post('p_alamat' . $i);
            ${'p_jabatan' . $i} = $this->input->post('p_jabatan' . $i);

            $data_pekerjaan = [
                'id_calon' => $id,
                'instansi' => ${'p_instansi' . $i},
                'alamat' => ${'p_alamat' . $i},
                'jabatan' => ${'p_jabatan' . $i}
            ];

            $this->db->insert('tb_calon_pekerjaan', $data_pekerjaan);
        }

        $this->db->where('id_calon', $id);
        $this->db->delete('tb_calon_penghargaan');
        for ($i = 1; $i < 6; $i++) {
            ${'pe_penghargaan' . $i} = $this->input->post('pe_penghargaan' . $i);
            ${'pe_instansi' . $i} = $this->input->post('pe_instansi' . $i);
            ${'pe_tahun' . $i} = $this->input->post('pe_tahun' . $i);

            $data_penghargaan = [
                'id_calon' => $id,
                'penghargaan' => ${'pe_penghargaan' . $i},
                'instansi' => ${'pe_instansi' . $i},
                'tahun' => ${'pe_tahun' . $i}
            ];

            $this->db->insert('tb_calon_penghargaan', $data_penghargaan);
        }

        $this->db->where('id_calon', $id);
        $this->db->delete('tb_calon_sosial');
        for ($i = 1; $i < 6; $i++) {
            ${'k_kegiatan' . $i} = $this->input->post('k_kegiatan' . $i);
            ${'k_lokasi' . $i} = $this->input->post('k_lokasi' . $i);
            ${'k_tahun' . $i} = $this->input->post('k_tahun' . $i);

            $data_sosial = [
                'id_calon' => $id,
                'kegiatan' => ${'k_kegiatan' . $i},
                'lokasi' => ${'k_lokasi' . $i},
                'tahun' => ${'k_tahun' . $i}
            ];

            $this->db->insert('tb_calon_sosial', $data_sosial);
        }

        if ($_FILES['foto']['name'] != "") {
            $config['upload_path']          = './foto/';
            $config['file_name']            = $no_nik;
            $config['overwrite']            = true;
            $config['allowed_types']        = 'gif|jpg|png';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                $foto = $this->upload->data("file_name");
                $this->db->where('id', $id);
                $this->db->update('tb_calon', ['foto' => $foto]);
            }
        }

        $data_calon = [
            'nama' => $nama,
            'provinsi' => $provinsi_select,
            'kabupaten_kota' => $kabupaten_select,
            'mencalonkan' => $mencalonkan,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $tgl_lahir,
            'nomor_nik' => $no_nik,
            'nomor_kta' => $no_kta,
            'jenis_kelamin' => $jk,
            'agama' => $agama,
            'alamat' => $alamat,
            'telp' => $telp,
            'email' => $email,
            'sm_fb' => $sm_fb,
            'sm_twitter' => $sm_twitter,
            'sm_instagram' => $sm_instagram,
            'status_perkawinan' => $status_perkawinan,
            'nama_istri' => $nama_istri
        ];

        $this->db->where('id', $id);
        $this->db->update('tb_calon', $data_calon);

        $this->session->set_userdata("page", "calon[slash]pendaftar");
        $this->session->set_userdata("page_header", "PENDAFTARAN");
        redirect('/main', 'location');
    }

    function profile()
    {
        $tingat["bupati"] = "CALON BUPATI";
        $tingat["walikota"] = "CALON WALIKOTA";
        $tingat["gubernur"] = "CALON GUBERNUR";
        $tingat["wakil_bupati"] = "CALON WAKIL BUPATI";
        $tingat["wakil_walikota"] = "CALON WAKIL WALIKOTA";
        $tingat["wakil_gubernur"] = "CALON WAKIL GUBERNUR";

        $id = $this->input->post("id");
        $this->db->where("id", $id);
        $this->db->select("tb_calon.*, geo_prov_nama, geo_kab_nama");
        $this->db->from("tb_calon");
        $this->db->join("m_geo_prov_kpu", "tb_calon.provinsi = m_geo_prov_kpu.geo_prov_id");
        $this->db->join("m_geo_kab_kpu", "tb_calon.kabupaten_kota = m_geo_kab_kpu.geo_kab_id");
        $data["data"] = $this->db->get()->row();

        $this->db->where("id_calon", $id);
        $data["pendidikan"] = $this->db->get("tb_calon_pendidikan");

        $this->db->where("id_calon", $id);
        $data["diklat"] = $this->db->get("tb_calon_diklat");

        $this->db->where("id_calon", $id);
        $data["organisasi"] = $this->db->get("tb_calon_organisasi");

        $this->db->where("id_calon", $id);
        $data["pekerjaan"] = $this->db->get("tb_calon_pekerjaan");

        $this->db->where("id_calon", $id);
        $data["penghargaan"] = $this->db->get("tb_calon_penghargaan");

        $this->db->where("id_calon", $id);
        $data["sosial"] = $this->db->get("tb_calon_sosial");
        $data["tingkat"] = $tingat;

        $provinsi = $this->input->post("provinsi");
        $kabupaten = $this->input->post("kabupaten");
        $data["provinsi"] = $provinsi;
        $data["kabupaten"] = $kabupaten;

        $this->load->view("calon/profile", $data);
    }

    function delete()
    {
        $id = $this->input->post("id");
        $this->db->where("id", $id);
        $this->db->delete("tb_calon");
        $this->db->where("id_calon", $id);
        $this->db->delete("tb_calon_diklat");
        $this->db->where("id_calon", $id);
        $this->db->delete("tb_calon_organisasi");
        $this->db->where("id_calon", $id);
        $this->db->delete("tb_calon_pekerjaan");
        $this->db->where("id_calon", $id);
        $this->db->delete("tb_calon_pendidikan");
        $this->db->where("id_calon", $id);
        $this->db->delete("tb_calon_penghargaan");
        $this->db->where("id_calon", $id);
        $this->db->delete("tb_calon_sosial");
    }
    function approve()
    {
        $id = $this->input->post("id");
        $this->db->where("id", $id);
        $data["status"] = "1";
        $this->db->update("tb_calon", $data);
    }
    function approve_all()
    {
        $id = $this->input->post("id");
        $this->db->query("update tb_calon set status = '1' where id in(" . $id . ")");
    }
    function profiling()
    {
        $provinsi = $this->input->post("provinsi");
        $kabupaten = $this->input->post("kabupaten");
        $id = $this->input->post("id");
        $tingat["bupati"] = "CALON BUPATI";
        $tingat["walikota"] = "CALON WALIKOTA";
        $tingat["gubernur"] = "CALON GUBERNUR";
        $tingat["wakil_bupati"] = "CALON WAKIL BUPATI";
        $tingat["wakil_walikota"] = "CALON WAKIL WALIKOTA";
        $tingat["wakil_gubernur"] = "CALON WAKIL GUBERNUR";

        $data["prov"] = $this->db->query("select m_geo_prov_kpu.*,count(DISTINCT kabupaten_kota) total , (select count(DISTINCT kabupaten_kota) from tb_calon a where a.review != '' and a.provinsi = tb_calon.provinsi) diisi from m_geo_prov_kpu inner join tb_calon on m_geo_prov_kpu.geo_prov_id = provinsi  and `status` = '1' GROUP BY m_geo_prov_kpu.geo_prov_id;");

        //$this->db->where("geo_prov_id",$provinsi);
        $data["kab"] = $this->db->query("select m_geo_kab_kpu.*,count(DISTINCT tb_calon.id) total, (select count(DISTINCT a.id) from tb_calon a where a.review != '' and a.`status` = '1' and a.kabupaten_kota = tb_calon.kabupaten_kota) diisi from m_geo_kab_kpu inner join tb_calon on m_geo_kab_kpu.geo_kab_id = kabupaten_kota where geo_prov_id = '$provinsi' and `status` = '1' GROUP BY m_geo_kab_kpu.geo_kab_id");

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
        $this->db->select("tb_calon.*, (SELECT file FROM tb_calon_surat_tugas WHERE (id_calon = tb_calon.id OR id_pasangan = tb_calon.id) AND jenis_surat_tugas = 'individu') AS file_individu, (SELECT file FROM tb_calon_surat_tugas WHERE (id_calon = tb_calon.id OR id_pasangan = tb_calon.id) AND jenis_surat_tugas = 'pasangan') AS file_pasangan, (select tb_calon_organisasi.organisasi from tb_calon_organisasi where tb_calon.id = id_calon order by id desc limit 0,1) organisasi,
        (select CONCAT(tb_calon_pekerjaan.jabatan,' (',tb_calon_pekerjaan.instansi,' ',tb_calon_pekerjaan.alamat,')') from tb_calon_pekerjaan where tb_calon.id = id_calon and jabatan<>''  order by id desc limit 0,1) pekerjaan,  geo_prov_nama, geo_kab_nama,
        (select sum(tb_calon_scoring.nilai * (bobot/100)) from tb_scoring inner join tb_calon_scoring on tb_scoring.id =tb_calon_scoring.id_scoring where id_calon = tb_calon.id) nilai,
        (SELECT file FROM tb_calon_surat_tugas WHERE (id_calon = tb_calon.id OR id_pasangan = tb_calon.id) AND jenis_surat_tugas = 'individu') AS file_individu, 
        (SELECT file FROM tb_calon_surat_tugas WHERE (id_calon = tb_calon.id OR id_pasangan = tb_calon.id) AND jenis_surat_tugas = 'pasangan') AS file_pasangan ");
        $this->db->from("tb_calon");
        $this->db->join("m_geo_prov_kpu", "tb_calon.provinsi = m_geo_prov_kpu.geo_prov_id");
        $this->db->join("m_geo_kab_kpu", "tb_calon.kabupaten_kota = m_geo_kab_kpu.geo_kab_id");
        $this->db->where("status", "1");
        if ($id != "") {
            $this->db->where("tb_calon.id", $id);
        }
        $this->db->order_by('nilai', 'DESC');
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
        $this->db->select("tb_calon.*, (SELECT file FROM tb_calon_surat_tugas WHERE (id_calon = tb_calon.id OR id_pasangan = tb_calon.id) AND jenis_surat_tugas = 'individu') AS file_individu, (SELECT file FROM tb_calon_surat_tugas WHERE (id_calon = tb_calon.id OR id_pasangan = tb_calon.id) AND jenis_surat_tugas = 'pasangan') AS file_pasangan, (select tb_calon_organisasi.organisasi from tb_calon_organisasi where tb_calon.id = id_calon order by id desc limit 0,1) organisasi,
        (select CONCAT(tb_calon_pekerjaan.jabatan,' (',tb_calon_pekerjaan.instansi,' ',tb_calon_pekerjaan.alamat,')') from tb_calon_pekerjaan where tb_calon.id = id_calon and jabatan<>''  order by id desc limit 0,1) pekerjaan,  geo_prov_nama, geo_kab_nama,
        (select sum(tb_calon_scoring.nilai * (bobot/100)) from tb_scoring inner join tb_calon_scoring on tb_scoring.id =tb_calon_scoring.id_scoring where id_calon = tb_calon.id) nilai,
        (SELECT file FROM tb_calon_surat_tugas WHERE (id_calon = tb_calon.id OR id_pasangan = tb_calon.id) AND jenis_surat_tugas = 'individu') AS file_individu, 
        (SELECT file FROM tb_calon_surat_tugas WHERE (id_calon = tb_calon.id OR id_pasangan = tb_calon.id) AND jenis_surat_tugas = 'pasangan') AS file_pasangan ");
        $this->db->from("tb_calon");
        $this->db->join("m_geo_prov_kpu", "tb_calon.provinsi = m_geo_prov_kpu.geo_prov_id");
        $this->db->join("m_geo_kab_kpu", "tb_calon.kabupaten_kota = m_geo_kab_kpu.geo_kab_id");
        $this->db->where("status", "1");
        $data["select_calon"] = $this->db->get();

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
        $this->db->where("partai !=", "hanura");
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
        $data["petahana"] = @$this->db->get("tb_petahana");

        $data["data_dashboard"] = $this->db->query("select count(distinct id) calon,count(distinct kabupaten_kota) kabupaten_kota ,count(distinct provinsi) provinsi from tb_calon where review is null and `status` = '1' and mencalonkan not in('gubernur','wakil_gubernur') ")->row();
        $data["data_dashboard_prov"] = $this->db->query("select count(distinct id) calon,count(distinct kabupaten_kota) kabupaten_kota ,count(distinct provinsi) provinsi from tb_calon where review is null and `status` = '1' and mencalonkan in('gubernur','wakil_gubernur')")->row();

        $this->load->view("calon/profiling", $data);
    }
    function review()
    {
        $id = $this->input->post("id");
        $data["review"] = $this->input->post("review");
        $this->db->where("id", $id);
        $this->db->update("tb_calon", $data);
    }

    function kabupaten_pemilihan()
    {
        $page = $this->input->post("page");
        $jenis = $this->input->post("jenis");
        $kabupaten = $this->input->post("kabupaten");

        $provinsi = $this->input->post("provinsi");
        $query = $this->db->query("select distinct m_geo_kab_kpu.* from m_geo_kab_kpu inner join tb_calon on m_geo_kab_kpu.geo_kab_id = kabupaten_kota where geo_prov_id = '$provinsi'");
        if ($query->row()->geo_kab_nama != 'ALL') {
            echo '<option value="0">ALL </option>';
        }
        foreach ($query->result() as $tmp) {
            if ($page == '') {
                echo "<option value='" . $tmp->geo_kab_id . "'>" . $tmp->geo_kab_nama . "</option>";
            } else if ($page == 'edit') {
                echo "<option " . ($tmp->geo_kab_id == $kabupaten ? 'selected' : '') . " value='" . $tmp->geo_kab_id . "'>" . $tmp->geo_kab_nama  . "</option>";
            } else {
                $count = $this->db->query("SELECT
                                        COUNT(tb_calon.id) AS count
                                    FROM
                                        tb_calon_surat_tugas
                                        JOIN tb_calon ON tb_calon.id = tb_calon_surat_tugas.id_calon 
                                    WHERE
                                        kabupaten_kota = $tmp->geo_kab_id
                                        AND jenis_surat_tugas = '$jenis'
                                        ")->row()->count;
                if ($count < 3) {
                    echo "<option " . ($tmp->geo_kab_id == $kabupaten ? 'selected' : '') . " value='" . $tmp->geo_kab_id . "'>" . $tmp->geo_kab_nama  . "</option>";
                }
            }
        }
    }

    function calon_pemilihan()
    {
        $data['jenis'] = $this->input->post('jenis');
        $action = $this->input->post('action');
        $nama = $this->input->post('nama');
        $calon = $this->input->post('calon');
        $provinsi = $this->input->post("provinsi");
        $kabupaten = $this->input->post("kabupaten");
        echo '<option value="" disabled selected>PILIH CALON </option>';
        if ($action == 'edit') {
            $query = $this->db->query("select *, tb_calon.id AS calon_id from tb_calon LEFT JOIN tb_calon_surat_tugas ON id_calon = tb_calon.id AND jenis_surat_tugas = '" . $data['jenis'] . "' where id_calon IS NULL AND provinsi = '$provinsi' AND kabupaten_kota = '$kabupaten' AND tb_calon.status = '1' ");
            echo "<option selected value='" . $nama . "'>" . strtoupper($calon) . "</option>";
            foreach ($query->result() as $tmp) {
                echo "<option  value='" . $tmp->calon_id . "'>" . strtoupper($tmp->nama) . "</option>";
            }
        } else {
            $query = $this->db->query("select *, tb_calon.id AS calon_id from tb_calon LEFT JOIN tb_calon_surat_tugas ON id_calon = tb_calon.id AND jenis_surat_tugas = '" . $data['jenis'] . "' where id_calon IS NULL AND provinsi = '$provinsi' AND kabupaten_kota = '$kabupaten' AND tb_calon.status = '1' ");
            foreach ($query->result() as $tmp) {
                echo "<option value='" . $tmp->calon_id . "'>" . strtoupper($tmp->nama) . "</option>";
            }
        }
    }

    function calon_pasangan_jabatan()
    {
        $data['jenis'] = $this->input->post('jenis');
        $action = $this->input->post('action');
        $nama = $this->input->post('nama');
        $calon = $this->input->post('calon');
        $provinsi = $this->input->post("provinsi");
        $kabupaten = $this->input->post("kabupaten");
        echo '<option value="" disabled selected>PILIH CALON </option>';
        if ($action == 'edit') {
            $query = $this->db->query("select *, tb_calon.id AS calon_id from tb_calon LEFT JOIN tb_calon_surat_tugas ON id_calon = tb_calon.id AND jenis_surat_tugas = '" . $data['jenis'] . "' where id_calon IS NULL AND provinsi = '$provinsi' AND kabupaten_kota = '$kabupaten' AND tb_calon.status = '1' AND mencalonkan NOT LIKE '%wakil%'");
            echo "<option selected value='" . $nama . "'>" . strtoupper($calon) . "</option>";
            foreach ($query->result() as $tmp) {
                echo "<option value='" . $tmp->calon_id . "'>" . strtoupper($tmp->nama) . "</option>";
            }
        } else {
            $query = $this->db->query("select *, tb_calon.id AS calon_id from tb_calon LEFT JOIN tb_calon_surat_tugas ON id_calon = tb_calon.id AND jenis_surat_tugas = '" . $data['jenis'] . "' where id_calon IS NULL AND provinsi = '$provinsi' AND kabupaten_kota = '$kabupaten' AND tb_calon.status = '1' AND mencalonkan NOT LIKE '%wakil%'");
            foreach ($query->result() as $tmp) {
                echo "<option value='" . $tmp->calon_id . "'>" . strtoupper($tmp->nama) . "</option>";
            }
        }
    }

    function calon_pasangan_wakil()
    {
        $data['jenis'] = $this->input->post('jenis');
        $action = $this->input->post('action');
        $nama = $this->input->post('nama');
        $calon = $this->input->post('calon');
        $provinsi = $this->input->post("provinsi");
        $kabupaten = $this->input->post("kabupaten");
        echo '<option value="" disabled selected>PILIH PASANGAN </option>';
        if ($action == 'edit') {
            $query = $this->db->query("select *, tb_calon.id AS calon_id from tb_calon LEFT JOIN tb_calon_surat_tugas ON id_pasangan = tb_calon.id AND jenis_surat_tugas = '" . $data['jenis'] . "' where id_pasangan IS NULL AND provinsi = '$provinsi' AND kabupaten_kota = '$kabupaten' AND tb_calon.status = '1' AND mencalonkan LIKE '%wakil%'");
            echo "<option selected value='" . $nama . "'>" . strtoupper($calon) . "</option>";
            foreach ($query->result() as $tmp) {
                echo "<option value='" . $tmp->calon_id . "'>" . strtoupper($tmp->nama) . "</option>";
            }
        } else {
            $query = $this->db->query("select *, tb_calon.id AS calon_id from tb_calon LEFT JOIN tb_calon_surat_tugas ON id_pasangan = tb_calon.id AND jenis_surat_tugas = '" . $data['jenis'] . "' where id_pasangan IS NULL AND provinsi = '$provinsi' AND kabupaten_kota = '$kabupaten' AND tb_calon.status = '1' AND mencalonkan LIKE '%wakil%'");
            foreach ($query->result() as $tmp) {
                echo "<option value='" . $tmp->calon_id . "'>" . strtoupper($tmp->nama) . "</option>";
            }
        }
    }

    function calon_selected()
    {
        $id = $this->input->post("id");
        $jenis = $this->input->post("jenis");

        if ($jenis == 'pasangan') {
            $id_pasangan = $this->input->post("id_pasangan");
            $query = "SELECT
                            tb_calon.id,
                            UPPER( tb_calon.nama ) AS nama,
                            (SELECT nama FROM tb_calon WHERE id = $id_pasangan) As nama_pasangan,
                        CASE            
                            WHEN mencalonkan = 'gubernur' 
                            OR mencalonkan = 'wakil_gubernur' THEN
                                'Provinsi' 
                            WHEN mencalonkan = 'walikota' 
                            OR mencalonkan = 'wakil_walikota' THEN
                                'Kota' 
                            WHEN mencalonkan = 'bupati' 
                            OR mencalonkan = 'wakil_bupati' THEN
                                'Kabupaten' 
                            END AS prov_kota_kab,
                        CASE                        
                            WHEN mencalonkan = 'gubernur' 
                            OR mencalonkan = 'wakil_gubernur' THEN
                                SUBSTRING_INDEX( geo_prov_nama, 'PROVINSI ',- 1 ) 
                            WHEN mencalonkan = 'walikota' 
                            OR mencalonkan = 'wakil_walikota' THEN
                                SUBSTRING_INDEX( geo_kab_nama, 'KOTA ',- 1 ) 
                            WHEN mencalonkan = 'bupati' 
                            OR mencalonkan = 'wakil_bupati' THEN
                                SUBSTRING_INDEX( geo_kab_nama, 'KABUPATEN ',- 1 ) 
                            END AS prov_kota_kab_nama,
                        CASE                                    
                            WHEN mencalonkan = 'gubernur' THEN
                                'Gubernur' 
                            WHEN mencalonkan = 'wakil_gubernur' THEN
                                'Wakil Gubernur' 
                            WHEN mencalonkan = 'walikota' THEN
                                'Walikota' 
                            WHEN mencalonkan = 'wakil_walikota' THEN
                                'Wakil Walikota' 
                            WHEN mencalonkan = 'bupati' THEN
                                'Bupati' 
                            WHEN mencalonkan = 'wakil_bupati' THEN
                                'Wakil Bupati' 
                            END AS sebagai,
                        CASE                                    
                            WHEN mencalonkan = 'gubernur' THEN
                                'Wakil Gubernur' 
                            WHEN mencalonkan = 'wakil_gubernur' THEN
                                'Gubernur' 
                            WHEN mencalonkan = 'walikota' THEN
                                'Wakil Walikota' 
                            WHEN mencalonkan = 'wakil_walikota' THEN
                                'Walikota' 
                            WHEN mencalonkan = 'bupati' THEN
                                'Wakil Bupati' 
                            WHEN mencalonkan = 'wakil_bupati' THEN
                                'Bupati' 
                            END AS pasangan,
                        CASE                                    
                            WHEN mencalonkan = 'gubernur' 
                            OR mencalonkan = 'wakil_gubernur' THEN
                                'Gubernur dan Wakil Gubernur' 
                            WHEN mencalonkan = 'walikota' 
                            OR mencalonkan = 'wakil_walikota' THEN
                                'Walikota dan Wakil Walikota' 
                            WHEN mencalonkan = 'bupati' 
                            OR mencalonkan = 'wakil_bupati' THEN
                                'Bupati dan Wakil Bupati' 
                            END AS berpasangan 
                    FROM
                        tb_calon
                        JOIN m_geo_kab_kpu ON m_geo_kab_kpu.geo_kab_id = tb_calon.kabupaten_kota
                        JOIN m_geo_prov_kpu ON m_geo_prov_kpu.geo_prov_id = tb_calon.provinsi 
                    WHERE tb_calon.id = $id";
        } else {
            $query = "SELECT
                            tb_calon.id,
                            UPPER( tb_calon.nama ) AS nama,
                        CASE            
                            WHEN mencalonkan = 'gubernur' 
                            OR mencalonkan = 'wakil_gubernur' THEN
                                'PROVINSI' 
                            WHEN mencalonkan = 'walikota' 
                            OR mencalonkan = 'wakil_walikota' THEN
                                'KOTA' 
                            WHEN mencalonkan = 'bupati' 
                            OR mencalonkan = 'wakil_bupati' THEN
                                'KABUPATEN' 
                            END AS prov_kota_kab,
                        CASE                        
                            WHEN mencalonkan = 'gubernur' 
                            OR mencalonkan = 'wakil_gubernur' THEN
                                SUBSTRING_INDEX( geo_prov_nama, 'PROVINSI ',- 1 ) 
                            WHEN mencalonkan = 'walikota' 
                            OR mencalonkan = 'wakil_walikota' THEN
                                SUBSTRING_INDEX( geo_kab_nama, 'KOTA ',- 1 ) 
                            WHEN mencalonkan = 'bupati' 
                            OR mencalonkan = 'wakil_bupati' THEN
                                SUBSTRING_INDEX( geo_kab_nama, 'KABUPATEN ',- 1 ) 
                            END AS prov_kota_kab_nama,
                        CASE                                    
                            WHEN mencalonkan = 'gubernur' THEN
                                'Gubernur' 
                            WHEN mencalonkan = 'wakil_gubernur' THEN
                                'Wakil Gubernur' 
                            WHEN mencalonkan = 'walikota' THEN
                                'Walikota' 
                            WHEN mencalonkan = 'wakil_walikota' THEN
                                'Wakil Walikota' 
                            WHEN mencalonkan = 'bupati' THEN
                                'Bupati' 
                            WHEN mencalonkan = 'wakil_bupati' THEN
                                'Wakil Bupati' 
                            END AS sebagai,
                        CASE                                    
                            WHEN mencalonkan = 'gubernur' THEN
                                'Wakil Gubernur' 
                            WHEN mencalonkan = 'wakil_gubernur' THEN
                                'Gubernur' 
                            WHEN mencalonkan = 'walikota' THEN
                                'Wakil Walikota' 
                            WHEN mencalonkan = 'wakil_walikota' THEN
                                'Walikota' 
                            WHEN mencalonkan = 'bupati' THEN
                                'Wakil Bupati' 
                            WHEN mencalonkan = 'wakil_bupati' THEN
                                'Bupati' 
                            END AS pasangan,
                        CASE                                    
                            WHEN mencalonkan = 'gubernur' 
                            OR mencalonkan = 'wakil_gubernur' THEN
                                'Gubernur dan Wakil Gubernur' 
                            WHEN mencalonkan = 'walikota' 
                            OR mencalonkan = 'wakil_walikota' THEN
                                'Walikota dan Wakil Walikota' 
                            WHEN mencalonkan = 'bupati' 
                            OR mencalonkan = 'wakil_bupati' THEN
                                'Bupati dan Wakil Bupati' 
                            END AS berpasangan 
                    FROM
                        tb_calon
                        JOIN m_geo_kab_kpu ON m_geo_kab_kpu.geo_kab_id = tb_calon.kabupaten_kota
                        JOIN m_geo_prov_kpu ON m_geo_prov_kpu.geo_prov_id = tb_calon.provinsi 
                    WHERE tb_calon.id = $id";
        }
        $calon = $this->db->query($query)->row();
        echo json_encode($calon);
    }

    function kabupaten_pemilihan_plus()
    {
        $provinsi = $this->input->post("provinsi");
        $query = $this->db->query("select m_geo_kab_kpu.*,count(DISTINCT tb_calon.id) total, (select count(DISTINCT a.id) from tb_calon a where a.review != '' and a.`status` = '1' and a.kabupaten_kota = tb_calon.kabupaten_kota) diisi from m_geo_kab_kpu inner join tb_calon on m_geo_kab_kpu.geo_kab_id = kabupaten_kota where geo_prov_id = '$provinsi' and `status` = '1' GROUP BY m_geo_kab_kpu.geo_kab_id");
        echo '<option value="">ALL </option>';
        foreach ($query->result() as $tmp) {
            echo "<option value='" . $tmp->geo_kab_id . "'>" . $tmp->geo_kab_nama . " (" . $tmp->diisi . "/" . $tmp->total . ")</option>";
        }
    }

    function survey()
    {
        $data["data"] = $this->db->query("select  tb_survey.id,geo_prov_nama,geo_kab_nama,nama_surveyor,survey_date from tb_survey
        inner join m_geo_prov_kpu on m_geo_prov_kpu.geo_prov_id = tb_survey.geo_prov_id
        inner join m_geo_kab_kpu on m_geo_kab_kpu.geo_kab_id = tb_survey.geo_kab_id");
        $this->load->view("calon/survey", $data);
    }

    function form_survey()
    {
        $provinsi = $this->input->post("provinsi");
        $kabupaten = $this->input->post("kabupaten");
        $data["prov"] = $this->db->query("select distinct m_geo_prov_kpu.* from m_geo_prov_kpu inner join tb_calon on m_geo_prov_kpu.geo_prov_id = provinsi");
        $data["kab"] = $this->db->query("select distinct m_geo_kab_kpu.* from m_geo_kab_kpu inner join tb_calon on m_geo_kab_kpu.geo_kab_id = kabupaten_kota where geo_prov_id = '$provinsi'");
        $this->db->select("tb_calon.*, geo_prov_nama, geo_kab_nama");
        $this->db->from("tb_calon");
        $this->db->join("m_geo_prov_kpu", "tb_calon.provinsi = m_geo_prov_kpu.geo_prov_id");
        $this->db->join("m_geo_kab_kpu", "tb_calon.kabupaten_kota = m_geo_kab_kpu.geo_kab_id");
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
        $this->db->where("status", "1");

        $data["calon"] = $this->db->get();

        $data["provinsi"] = $provinsi;
        $data["kabupaten"] = $kabupaten;
        $this->load->view("calon/form_survey", $data);
    }

    function edit_survey()
    {
        $id_survey = $this->input->post("id_survey");
        $data["calon"] = $this->db->query("SELECT
                                            tb_calon_survey.*,
                                            nama_surveyor,
                                            survey_date 
                                        FROM
                                            tb_survey
                                            JOIN tb_calon_survey ON tb_calon_survey.id_survey = tb_survey.id 
                                        WHERE
                                            id_survey = $id_survey");
        $this->load->view("calon/edit_survey", $data);
    }

    function view_survey()
    {
        $id_survey = $this->input->post("id_survey");
        $data["calon"] = $this->db->query("SELECT
                                            nama_surveyor,
                                            survey_date,
                                            nama_calon,
                                            survey
                                        FROM
                                            tb_survey
                                            JOIN tb_calon_survey ON tb_calon_survey.id_survey = tb_survey.id 
                                        WHERE
                                            id_survey = $id_survey
                                        ORDER BY TRUNCATE (survey, 3) DESC");
        $this->load->view("calon/view_survey", $data);
    }

    function update_survey()
    {
        $id_survey = $this->input->post("id_survey");
        $data["nama_surveyor"] = $this->input->post("nama_surveyor");
        $data["survey_date"] = $this->input->post("survey_date");
        $data["update_date"] = date('Y-m-d H:i:s');
        $data["update_by"] = $this->session->username;
        $this->db->where('id', $id_survey);
        $this->db->update("tb_survey", $data);

        $nama = $this->input->post('nama');
        $id = $this->input->post('id');
        $survey = $this->input->post('survey');
        for ($i = 0; $i < count($nama); $i++) :
            if ($nama[$i] != "") {
                $subData["nama_calon"] = $nama[$i];
                $subData["survey"] = $survey[$i];

                $this->db->where('id_survey', $id_survey);
                $this->db->where('id', $id[$i]);
                $this->db->update("tb_calon_survey", $subData);
            }
        endfor;

        $nama_add = $this->input->post('nama_add');
        $id_add = $this->input->post('id_add');
        $survey_add = $this->input->post('survey_add');
        for ($i = 0; $i < count($nama_add); $i++) :
            if ($nama_add[$i] != "") {
                $subData_add["id_survey"] = $id_survey;
                $subData_add["id_calon"] = $id_add[$i];
                $subData_add["nama_calon"] = $nama_add[$i];
                $subData_add["survey"] = $survey_add[$i];
                $this->db->insert("tb_calon_survey", $subData_add);
            }
        endfor;

        $this->session->set_userdata("page", "calon[slash]survey");
        $this->session->set_userdata("page_header", "SURVEY");
        redirect('/main', 'location');
    }


    function save_survey()
    {
        $data["nama_surveyor"] = $this->input->post("nama_surveyor");
        $data["survey_date"] = $this->input->post("survey_date");
        $data["geo_prov_id"] = $this->input->post("provinsi");
        $data["geo_kab_id"] = $this->input->post("kabupaten_kota");
        $data["created_date"] = date('Y-m-d H:i:s');
        $data["created_by"] = $this->session->username;
        $this->db->insert("tb_survey", $data);
        $insert_id = $this->db->insert_id();

        $nama = $this->input->post('nama');
        $id = $this->input->post('id');
        $survey = $this->input->post('survey');
        for ($i = 0; $i < count($nama); $i++) :
            if ($nama[$i] != "") {
                $subData["id_survey"] = $insert_id;
                $subData["id_calon"] = $id[$i];
                $subData["nama_calon"] = $nama[$i];
                $subData["survey"] = $survey[$i];
                $this->db->insert("tb_calon_survey", $subData);
            }
        endfor;
        $this->session->set_userdata("page", "calon[slash]survey");
        $this->session->set_userdata("page_header", "SURVEY");
        redirect('/main', 'location');
    }

    function delete_survey()
    {
        $this->db->where('id', $this->input->post("id"));
        $this->db->delete("tb_survey");
        $this->db->where('id_survey', $this->input->post("id"));
        $this->db->delete("tb_calon_survey");
    }

    public function surat_tugas()
    {
        $data['jenis'] = $this->input->post('jenis');
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
        }
        if ($kabupaten != "") {
            $this->db->where("kabupaten_kota", $kabupaten);
        }
        $this->db->where("status", "1");
        if ($data['jenis'] != "") {
            $this->db->where("jenis_surat_tugas", $data['jenis']);
        }
        $this->db->select("tb_calon.*, tb_calon_surat_tugas.*, (SELECT nama FROM tb_calon WHERE id = tb_calon_surat_tugas.id_pasangan ) AS nama_pasangan, geo_prov_nama, geo_kab_nama");
        $this->db->from("tb_calon");
        $this->db->join("tb_calon_surat_tugas", "tb_calon_surat_tugas.id_calon = tb_calon.id");
        $this->db->join("m_geo_prov_kpu", "tb_calon.provinsi = m_geo_prov_kpu.geo_prov_id");
        $this->db->join("m_geo_kab_kpu", "tb_calon.kabupaten_kota = m_geo_kab_kpu.geo_kab_id");
        $this->db->order_by('tb_calon_surat_tugas.id', 'DESC');
        $data["calon"] = $this->db->get();

        $data["tingkat"] = $tingat;

        $data["provinsi"] = $provinsi;
        $data["kabupaten"] = $kabupaten;
        $this->load->view("calon/surat_tugas", $data);
    }

    public function getSuratTugasByNomor()
    {
        $jenis = $this->input->post('jenis');
        $action = $this->input->post('action');
        $no_surat_before = $this->input->post('no_surat_before');
        $no_surat = $this->input->post('no_surat');

        if ($action == 'edit') {
            $query = "SELECT
                        no_surat_tugas 
                    FROM
                        tb_calon_surat_tugas 
                    WHERE
                        no_surat_tugas = '$no_surat'
                        AND no_surat_tugas != '$no_surat_before'";
        } else {
            $query = "SELECT
                        no_surat_tugas 
                    FROM
                        tb_calon_surat_tugas 
                    WHERE
                        no_surat_tugas = '$no_surat'";
        }
        $data = $this->db->query($query)->num_rows();

        if ($data > 0) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function add_surat_tugas()
    {
        $data['jenis'] = $this->input->post('jenis');
        if ($data['jenis'] == "") {
            $data['jenis'] = 'individu';
        }

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
        $this->db->where("provinsi", $provinsi);
        $this->db->where("kabupaten_kota", $kabupaten);
        $this->db->where("status", "1");
        $this->db->where("tb_calon_surat_tugas.id_calon IS NULL", null, false);
        $this->db->select("tb_calon.*, geo_prov_nama, geo_kab_nama, (select sum(tb_calon_scoring.nilai * (bobot/100)) from tb_scoring inner join tb_calon_scoring on tb_scoring.id =tb_calon_scoring.id_scoring where id_calon = tb_calon.id) nilai");
        $this->db->from("tb_calon");
        if ($data['jenis'] == 'individu') {
            $this->db->join("tb_calon_surat_tugas", "tb_calon_surat_tugas.id_calon = tb_calon.id AND jenis_surat_tugas = 'individu'", "left");
        } else {
            $this->db->join("tb_calon_surat_tugas", "tb_calon_surat_tugas.id_calon = tb_calon.id AND jenis_surat_tugas = 'pasangan'", "left");
        }
        $this->db->join("m_geo_prov_kpu", "tb_calon.provinsi = m_geo_prov_kpu.geo_prov_id");
        $this->db->join("m_geo_kab_kpu", "tb_calon.kabupaten_kota = m_geo_kab_kpu.geo_kab_id");
        $data["calon"] = $this->db->get();

        $data["tingkat"] = $tingat;

        $data["provinsi"] = $provinsi;
        $data["kabupaten"] = $kabupaten;

        if ($data['jenis'] == 'individu') {
            $data['redaksi'] = $this->db->get_where('tb_surat_tugas', ['id', 1])->row()->individu;
        } else {
            $data['redaksi'] = $this->db->get_where('tb_surat_tugas', ['id', 1])->row()->pasangan;
        }
        $data['sekertaris'] = $this->db->get_where('tb_surat_tugas', ['id', 1])->row()->sekertaris;

        $this->load->view("calon/add_surat_tugas", $data);
    }

    public function edit_surat_tugas()
    {
        $id = $this->input->post('id');
        $query = "SELECT
                            * ,
                            (SELECT nama FROM tb_calon WHERE id = id_pasangan) AS nama_pasangan,
                            tb_calon_surat_tugas.id AS id_surat
                        FROM
                            tb_calon_surat_tugas
                            JOIN tb_calon ON tb_calon.id = tb_calon_surat_tugas.id_calon
                            JOIN m_geo_kab_kpu ON m_geo_kab_kpu.geo_kab_id = kabupaten_kota
                            JOIN m_geo_prov_kpu ON m_geo_prov_kpu.geo_prov_id = provinsi 
                        WHERE
                            tb_calon_surat_tugas.id = $id";
        $data['st'] = $this->db->query($query)->row();
        $data['jenis'] = $data['st']->jenis_surat_tugas;

        $provinsi = $data['st']->provinsi;
        $kabupaten = $data['st']->kabupaten_kota;

        $data["prov"] = $this->db->query("select distinct m_geo_prov_kpu.* from m_geo_prov_kpu inner join tb_calon on m_geo_prov_kpu.geo_prov_id = provinsi");

        $data["kab"] = $this->db->query("select distinct m_geo_kab_kpu.* from m_geo_kab_kpu inner join tb_calon on m_geo_kab_kpu.geo_kab_id = kabupaten_kota where geo_prov_id = '$provinsi'");
        $this->db->where("provinsi", $provinsi);
        $this->db->where("kabupaten_kota", $kabupaten);
        $this->db->where("status", "1");
        $this->db->where("tb_calon_surat_tugas.id_calon IS NULL", null, false);
        $this->db->select("tb_calon.*, geo_prov_nama, geo_kab_nama, (select sum(tb_calon_scoring.nilai * (bobot/100)) from tb_scoring inner join tb_calon_scoring on tb_scoring.id =tb_calon_scoring.id_scoring where id_calon = tb_calon.id) nilai");
        $this->db->from("tb_calon");
        if ($data['jenis'] == 'individu') {
            $this->db->join("tb_calon_surat_tugas", "tb_calon_surat_tugas.id_calon = tb_calon.id AND jenis_surat_tugas = 'individu'", "left");
        } else {
            $this->db->join("tb_calon_surat_tugas", "tb_calon_surat_tugas.id_calon = tb_calon.id AND jenis_surat_tugas = 'pasangan'", "left");
        }
        $this->db->join("m_geo_prov_kpu", "tb_calon.provinsi = m_geo_prov_kpu.geo_prov_id");
        $this->db->join("m_geo_kab_kpu", "tb_calon.kabupaten_kota = m_geo_kab_kpu.geo_kab_id");
        $data["calon"] = $this->db->get();

        $data["provinsi"] = $provinsi;
        $data["kabupaten"] = $kabupaten;

        if ($data['jenis'] == 'individu') {
            $data['redaksi'] = $this->db->get_where('tb_surat_tugas', ['id', 1])->row()->individu;
        } else {
            $data['redaksi'] = $this->db->get_where('tb_surat_tugas', ['id', 1])->row()->pasangan;
        }

        $this->load->view("calon/edit_surat_tugas", $data);
    }

    public function surat_tugas_pdf()
    {
        $id = $this->input->post('calon');
        $data['sekertaris'] = $this->input->post('sekertaris');
        $data['masa_berlaku'] = $this->input->post('masa_berlaku');
        $data['start_date'] = $this->input->post('start_date');
        $data['no_surat'] = $this->input->post('no_surat');
        $str = $this->input->post('redaksi');
        $this->db->where('id', 1);
        $this->db->update('tb_surat_tugas', ['individu' => $str, 'sekertaris' => $data['sekertaris']]);

        $data_surat_tugas = [
            'id_calon' => $id,
            'no_surat_tugas' => $data['no_surat'],
            'jenis_surat_tugas' => 'individu',
            'masa_berlaku' => $data['masa_berlaku'],
            'start_date' => $data['start_date'],
            'redaksi' => $str,
            'sekertaris' => $data['sekertaris'],
            'file' => 'surat_tugas_individu_' . $data['no_surat'] . '.pdf',
            'created_by' => $this->session->userdata('username'),
            'created_at' => time()
        ];
        $this->db->insert('tb_calon_surat_tugas', $data_surat_tugas);
        echo 1;
    }

    public function surat_tugas_create_pdf($id, $jenis, $id_pasangan = 0)
    {
        $this->load->library("html2pdf_lib");
        ob_start();
        $query = "SELECT
                        tb_calon.id,
                        tb_calon_surat_tugas.*,
                        (SELECT nama FROM tb_calon WHERE id = $id_pasangan) As nama_pasangan,
                        UPPER( tb_calon.nama ) AS nama,
                    CASE            
                        WHEN mencalonkan = 'gubernur' 
                        OR mencalonkan = 'wakil_gubernur' THEN
                            'Provinsi' 
                        WHEN mencalonkan = 'walikota' 
                        OR mencalonkan = 'wakil_walikota' THEN
                            'Kota' 
                        WHEN mencalonkan = 'bupati' 
                        OR mencalonkan = 'wakil_bupati' THEN
                            'Kabupaten' 
                        END AS prov_kota_kab,
                    CASE                        
                        WHEN mencalonkan = 'gubernur' 
                        OR mencalonkan = 'wakil_gubernur' THEN
                            SUBSTRING_INDEX( geo_prov_nama, 'PROVINSI ',- 1 ) 
                        WHEN mencalonkan = 'walikota' 
                        OR mencalonkan = 'wakil_walikota' THEN
                            SUBSTRING_INDEX( geo_kab_nama, 'KOTA ',- 1 ) 
                        WHEN mencalonkan = 'bupati' 
                        OR mencalonkan = 'wakil_bupati' THEN
                            SUBSTRING_INDEX( geo_kab_nama, 'KABUPATEN ',- 1 ) 
                        END AS prov_kota_kab_nama,
                    CASE                                    
                        WHEN mencalonkan = 'gubernur' THEN
                            'Gubernur' 
                        WHEN mencalonkan = 'wakil_gubernur' THEN
                            'Wakil Gubernur' 
                        WHEN mencalonkan = 'walikota' THEN
                            'Walikota' 
                        WHEN mencalonkan = 'wakil_walikota' THEN
                            'Wakil Walikota' 
                        WHEN mencalonkan = 'bupati' THEN
                            'Bupati' 
                        WHEN mencalonkan = 'wakil_bupati' THEN
                            'Wakil Bupati' 
                        END AS sebagai,
                    CASE                                    
                        WHEN mencalonkan = 'gubernur' THEN
                            'Wakil Gubernur' 
                        WHEN mencalonkan = 'wakil_gubernur' THEN
                            'Gubernur' 
                        WHEN mencalonkan = 'walikota' THEN
                            'Wakil Walikota' 
                        WHEN mencalonkan = 'wakil_walikota' THEN
                            'Walikota' 
                        WHEN mencalonkan = 'bupati' THEN
                            'Wakil Bupati' 
                        WHEN mencalonkan = 'wakil_bupati' THEN
                            'Bupati' 
                        END AS pasangan,
                    CASE                                    
                        WHEN mencalonkan = 'gubernur' 
                        OR mencalonkan = 'wakil_gubernur' THEN
                            'Gubernur dan Wakil Gubernur' 
                        WHEN mencalonkan = 'walikota' 
                        OR mencalonkan = 'wakil_walikota' THEN
                            'Walikota dan Wakil Walikota' 
                        WHEN mencalonkan = 'bupati' 
                        OR mencalonkan = 'wakil_bupati' THEN
                            'Bupati dan Wakil Bupati' 
                        END AS berpasangan,
						geo_prov_nama,
						geo_kab_nama
                FROM
                    tb_calon
                    JOIN tb_calon_surat_tugas ON tb_calon_surat_tugas.id_calon = tb_calon.id
                    JOIN m_geo_kab_kpu ON m_geo_kab_kpu.geo_kab_id = tb_calon.kabupaten_kota
                    JOIN m_geo_prov_kpu ON m_geo_prov_kpu.geo_prov_id = tb_calon.provinsi 
                WHERE tb_calon_surat_tugas.id = $id";
        $data['calon'] = $this->db->query($query)->row();
        $this->load->view($jenis == 'individu' ? 'calon/surat_tugas_pdf' : 'calon/surat_tugas_pasangan_pdf', $data);
        $html = ob_get_contents();
        ob_end_clean();

        $this->html2pdf_lib->converHtml2pdf($html);
    }

    public function surat_tugas_pasangan_pdf()
    {
        $id = $this->input->post('calon');
        $data['sekertaris'] = $this->input->post('sekertaris');
        $data['masa_berlaku'] = $this->input->post('masa_berlaku');
        $data['start_date'] = $this->input->post('start_date');
        $data['no_surat'] = $this->input->post('no_surat');
        $id_pasangan = $this->input->post('pasangan');
        $str = $this->input->post('redaksi');
        $this->db->where('id', 1);
        $this->db->update('tb_surat_tugas', ['pasangan' => $str, 'sekertaris' => $data['sekertaris']]);

        $data_surat_tugas = [
            'id_calon' => $id,
            'id_pasangan' => $id_pasangan,
            'no_surat_tugas' => $data['no_surat'],
            'jenis_surat_tugas' => 'pasangan',
            'masa_berlaku' => $data['masa_berlaku'],
            'start_date' => $data['start_date'],
            'redaksi' => $str,
            'sekertaris' => $data['sekertaris'],
            'file' => 'surat_tugas_pasangan_' . $data['no_surat'] . '.pdf',
            'created_by' => $this->session->userdata('username'),
            'created_at' => time()
        ];
        $this->db->insert('tb_calon_surat_tugas', $data_surat_tugas);
        echo 1;
    }

    public function update_surat_tugas_pdf()
    {
        $id_st = $this->input->post('id_st');
        $id = $this->input->post('calon');
        $data['masa_berlaku'] = $this->input->post('masa_berlaku');
        $data['start_date'] = $this->input->post('start_date');
        $data['no_surat'] = $this->input->post('no_surat');
        $data['sekertaris'] = $this->input->post('sekertaris');
        $str = $this->input->post('redaksi');
        $this->db->where('id', 1);
        $this->db->update('tb_surat_tugas', ['individu' => $str, 'sekertaris' => $data['sekertaris']]);

        $data_surat_tugas = [
            'id_calon' => $id,
            'no_surat_tugas' => $data['no_surat'],
            'jenis_surat_tugas' => 'individu',
            'masa_berlaku' => $data['masa_berlaku'],
            'start_date' => $data['start_date'],
            'redaksi' => $str,
            'sekertaris' => $data['sekertaris'],
            'file' => 'surat_tugas_individu_' . $data['no_surat'] . '.pdf',
            'created_by' => $this->session->userdata('username'),
            'created_at' => time()
        ];
        $this->db->where('id', $id_st);
        $this->db->update('tb_calon_surat_tugas', $data_surat_tugas);
        echo 1;
    }

    public function update_surat_tugas_pasangan_pdf()
    {
        $id_st = $this->input->post('id_st');
        $id = $this->input->post('calon');
        $data['masa_berlaku'] = $this->input->post('masa_berlaku');
        $data['start_date'] = $this->input->post('start_date');
        $data['no_surat'] = $this->input->post('no_surat');
        $id_pasangan = $this->input->post('pasangan');
        $data['sekertaris'] = $this->input->post('sekertaris');
        $str = $this->input->post('redaksi');
        $this->db->where('id', 1);
        $this->db->update('tb_surat_tugas', ['pasangan' => $str, 'sekertaris' => $data['sekertaris']]);

        $data_surat_tugas = [
            'id_calon' => $id,
            'id_pasangan' => $id_pasangan,
            'no_surat_tugas' => $data['no_surat'],
            'jenis_surat_tugas' => 'pasangan',
            'masa_berlaku' => $data['masa_berlaku'],
            'start_date' => $data['start_date'],
            'redaksi' => $str,
            'sekertaris' => $data['sekertaris'],
            'file' => 'surat_tugas_pasangan_' . $data['no_surat'] . '.pdf',
            'created_by' => $this->session->userdata('username'),
            'created_at' => time()
        ];
        $this->db->where('id', $id_st);
        $this->db->update('tb_calon_surat_tugas', $data_surat_tugas);
        echo 1;
    }

    public function penilaian()
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
        }
        if ($kabupaten != "") {
            $this->db->where("kabupaten_kota", $kabupaten);
        }
        $this->db->where("status", "1");
        $this->db->select("tb_calon.*, (SELECT file FROM tb_calon_surat_tugas WHERE (id_calon = tb_calon.id OR id_pasangan = tb_calon.id) AND jenis_surat_tugas = 'individu') AS file_individu, (SELECT file FROM tb_calon_surat_tugas WHERE (id_calon = tb_calon.id OR id_pasangan = tb_calon.id) AND jenis_surat_tugas = 'pasangan') AS file_pasangan, geo_prov_nama, geo_kab_nama, (select sum(tb_calon_scoring.nilai * (bobot/100)) from tb_scoring inner join tb_calon_scoring on tb_scoring.id =tb_calon_scoring.id_scoring where id_calon = tb_calon.id) nilai");
        $this->db->from("tb_calon");
        $this->db->join("m_geo_prov_kpu", "tb_calon.provinsi = m_geo_prov_kpu.geo_prov_id");
        $this->db->join("m_geo_kab_kpu", "tb_calon.kabupaten_kota = m_geo_kab_kpu.geo_kab_id");
        $data["calon"] = $this->db->get();

        $data["tingkat"] = $tingat;

        $data["provinsi"] = $provinsi;
        $data["kabupaten"] = $kabupaten;
        $this->load->view("calon/penilaian", $data);
    }

    function form_penilaian()
    {
        $id = $this->input->post("id");
        $tingat["bupati"] = "CALON BUPATI";
        $tingat["walikota"] = "CALON WALIKOTA";
        $tingat["gubernur"] = "CALON GUBERNUR";
        $tingat["wakil_bupati"] = "CALON WAKIL BUPATI";
        $tingat["wakil_walikota"] = "CALON WAKIL WALIKOTA";
        $tingat["wakil_gubernur"] = "CALON WAKIL GUBERNUR";

        $id = $this->input->post("id");

        $provinsi = $this->input->post("provinsi");
        $kabupaten = $this->input->post("kabupaten");
        $data["provinsi"] = $provinsi;
        $data["kabupaten"] = $kabupaten;
        $data["tingkat"] = $tingat;
        $this->db->select("tb_calon.*,(select tb_calon_organisasi.organisasi from tb_calon_organisasi where tb_calon.id = id_calon order by id desc limit 0,1) organisasi,
        (select tb_calon_pekerjaan.jabatan from tb_calon_pekerjaan where tb_calon.id = id_calon  order by id desc limit 0,1) pekerjaan,  geo_prov_nama, geo_kab_nama,
        (select sum(tb_calon_scoring.nilai * (bobot/100)) from tb_scoring inner join tb_calon_scoring on tb_scoring.id =tb_calon_scoring.id_scoring where id_calon = tb_calon.id) nilai");
        $this->db->from("tb_calon");
        $this->db->join("m_geo_prov_kpu", "tb_calon.provinsi = m_geo_prov_kpu.geo_prov_id");
        $this->db->join("m_geo_kab_kpu", "tb_calon.kabupaten_kota = m_geo_kab_kpu.geo_kab_id");
        $this->db->where("id", $id);
        $data["data"] = $this->db->get()->row();
        $data["penilaian"] = $this->db->query("select tb_scoring.*,nilai from tb_scoring left join tb_calon_scoring on tb_scoring.id = tb_calon_scoring.id_scoring and id_calon = '$id'");
        $this->load->view("calon/form_penilaian", $data);
    }
    function save_penilaian()
    {
        $penilaian_id = $this->input->post('penilaian_id');
        $id = $this->input->post('id');
        $nilai = $this->input->post('nilai');
        $this->db->where("id_calon", $id);
        $this->db->delete("tb_calon_scoring");
        for ($i = 0; $i < count($nilai); $i++) :
            if ($nilai[$i] != "") {
                $subData["id_scoring"] = $penilaian_id[$i];
                $subData["nilai"] = $nilai[$i];
                $subData["id_calon"] = $id;
                $this->db->insert("tb_calon_scoring", $subData);
            }
        endfor;
        $this->session->set_userdata("page", "calon[slash]penilaian");
        $this->session->set_userdata("page_header", "PENILAIAN");
        redirect('/main', 'location');
    }
    function delete_penilaian()
    {
        $id = $this->input->post("id");
        $this->db->where("id_calon", $id);
        $this->db->delete("tb_calon_scoring");
    }

    function dokumen()
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
        }
        if ($kabupaten != "") {
            $this->db->where("kabupaten_kota", $kabupaten);
        }
        $this->db->select("tb_calon.*, geo_prov_nama, geo_kab_nama");
        $this->db->from("tb_calon");
        $this->db->join("m_geo_prov_kpu", "tb_calon.provinsi = m_geo_prov_kpu.geo_prov_id");
        $this->db->join("m_geo_kab_kpu", "tb_calon.kabupaten_kota = m_geo_kab_kpu.geo_kab_id");
        $this->db->where("status", "1");
        $data["calon"] = $this->db->get();

        $data["tingkat"] = $tingat;

        $data["provinsi"] = $provinsi;
        $data["kabupaten"] = $kabupaten;
        $this->load->view("calon/dokumen", $data);
    }
    function cek_document()
    {
        $data["id_document"] = $this->input->post("id_dokumen");
        $data["id_calon"] = $this->input->post("id_calon");
        $data["tgl_kirim"] = $this->input->post("tgl_kirim");
        $data["kirim_by"] = $this->input->post("kirim_by");
        $this->db->insert("tb_calon_document", $data);
    }
    function uncek_document()
    {
        $data["id_document"] = $this->input->post("id_dokumen");
        $data["id_calon"] = $this->input->post("id_calon");
        $this->db->where($data);
        $this->db->delete("tb_calon_document");
    }
}
