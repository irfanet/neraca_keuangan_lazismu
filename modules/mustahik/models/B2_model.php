<?php
defined('BASEPATH') or exit('No direct script access allowed');
class B2_model extends CI_Model
{
	public $kd_data;

	function __construct()
	{
		parent::__construct();
	}

	function getData()
	{

		if($this->session->userdata('status')!='admin'){
			$this->db->select('*');    
			$this->db->from('mustahik a');
			$this->db->join("mustahik_b2 b", "a.no_registrasi = b.no_mustahik");
			$this->db->where('a.sekolah',$this->session->userdata('sekolah'));
			$hasil = $this->db->get();
		}else{
			$this->db->select('*');    
			$this->db->from('mustahik a');
			$this->db->join("mustahik_b2 b", "a.no_registrasi = b.no_mustahik");
			// $this->db->join("tb_b2_3 c", "b.jumlah_tanggungan_keluarga = c.kd_data");
			$hasil = $this->db->get();
		}

		return $hasil->result();
	}
	function setData()
	{
		$this->kd_data = uniqid();
		$f_1_1 = explode(',',$this->input->post('jumlah_tanggungan_keluarga'));
		$f_1_2 = explode(',',$this->input->post('jumlah_anak_yg_masih_sekolah'));
		$f_1_3 = explode(',',$this->input->post('jumlah_anak_yg_putus_sekolah'));
		$f_1_4 = explode(',',$this->input->post('jumlah_pengeluaran_bulanan'));
		$f_1_5 = explode(',',$this->input->post('obat_rutin_anggota_keluarga_yg_sakit'));
		$f_1_6 = explode(',',$this->input->post('biaya_pendidikan_yg_ditanggung'));
		$f_1_7 = explode(',',$this->input->post('riwayat_hutang_berjalan'));
		$f_1_8 = explode(',',$this->input->post('keperluan_hutang'));
		$f_2_9 = explode(',',$this->input->post('pekerjaan_kepala_keluarga'));
		$f_2_10 = explode(',',$this->input->post('merokok'));
		$f_2_11 = explode(',',$this->input->post('pekerjaan_suami_istri'));
		$f_2_12 = explode(',',$this->input->post('usia_mustahik'));
		$f_2_13 = explode(',',$this->input->post('kondisi_kepala_keluarga'));
		$f_3_14 = explode(',',$this->input->post('kepemilikan_rumah'));
		$f_3_15 = explode(',',$this->input->post('luas_rumah'));
		$f_3_16 = explode(',',$this->input->post('dinding_rumah'));
		$f_3_17 = explode(',',$this->input->post('lantai'));
		$f_3_18 = explode(',',$this->input->post('atap'));
		$f_3_19 = explode(',',$this->input->post('sumber_air_minum'));
		$f_3_20 = explode(',',$this->input->post('mck'));
		$f_3_21 = explode(',',$this->input->post('penerangan'));
		$f_3_22 = explode(',',$this->input->post('daya_terpasang'));
		$f_3_23 = explode(',',$this->input->post('kelayakan_tidur'));
		$f_4_24 = explode(',',$this->input->post('jumlah_makan_perhari'));
		$f_4_25 = explode(',',$this->input->post('ayam'));
		$f_4_26 = explode(',',$this->input->post('daging'));
		$f_4_27 = explode(',',$this->input->post('susu'));
		$f_4_28 = explode(',',$this->input->post('belanja_harian'));
		$f_5_29 = explode(',',$this->input->post('aset_tidak_bergerak_sawah_pekarangan'));
		$f_5_30 = explode(',',$this->input->post('aset_bergerak'));
		$nilai = 0;
		for($i=1;$i<=30;$i++)
		{
			if($i <= 8){
				$nilai += intval(${'f_1_'.$i}[1]);
			}
			if($i >= 9 && $i <= 13){
				$nilai += intval(${'f_2_'.$i}[1]);
			}
			if($i >= 14 && $i <= 23){
				$nilai += intval(${'f_3_'.$i}[1]);
			}
			if($i >= 24 && $i <= 28){
				$nilai += intval(${'f_4_'.$i}[1]);
			}
			if($i >= 29 && $i <= 30){
				$nilai += intval(${'f_5_'.$i}[1]);
			}
		}
		$data = array(
			'no_mustahik' => $this->input->post('no_registrasi'),
			'tgl' => $this->input->post('tgl'),
			'petugas_survey' => $this->input->post('petugas_survey'),
			'jumlah_tanggungan_keluarga' => intval($f_1_1[0]),
			'jumlah_anak_yg_masih_sekolah' => intval($f_1_2[0]),
			'jumlah_anak_yg_putus_sekolah' => intval($f_1_3[0]),
			'jumlah_pengeluaran_bulanan' => intval($f_1_4[0]),
			'obat_rutin_anggota_keluarga_yg_sakit' => intval($f_1_5[0]),
			'biaya_pendidikan_yg_ditanggung' => intval($f_1_6[0]),
			'riwayat_hutang_berjalan' => intval($f_1_7[0]),
			'keperluan_hutang' => intval($f_1_8[0]),
			'pekerjaan_kepala_keluarga' => $this->input->post('pekerjaan_kepala_keluarga'),
			'merokok' => $this->input->post('merokok'),
			'pekerjaan_suami_istri' => $this->input->post('pekerjaan_suami_istri'),
			'usia_mustahik' => $this->input->post('usia_mustahik'),
			'kondisi_kepala_keluarga' => $this->input->post('kondisi_kepala_keluarga'),
			'kepemilikan_rumah' => $this->input->post('kepemilikan_rumah'),
			'luas_rumah' => $this->input->post('luas_rumah'),
			'dinding_rumah' => $this->input->post('dinding_rumah'),
			'lantai' => $this->input->post('lantai'),
			'atap' => $this->input->post('atap'),
			'sumber_air_minum' => $this->input->post('sumber_air_minum'),
			'mck' => $this->input->post('mck'),
			'penerangan' => $this->input->post('penerangan'),
			'daya_terpasang' => $this->input->post('daya_terpasang'),
			'kelayakan_tidur' => $this->input->post('kelayakan_tidur'),
			'barang_elektronik_yg_dimiliki' => implode(',',$this->input->post('barang_elektronik_yg_dimiliki')),
			'jumlah_makan_perhari' => $this->input->post('jumlah_makan_perhari'),
			'ayam' => $this->input->post('ayam'),
			'daging' => $this->input->post('daging'),
			'susu' => $this->input->post('susu'),
			'belanja_harian' => $this->input->post('belanja_harian'),
			'aset_tidak_bergerak_sawah_pekarangan' => $this->input->post('aset_tidak_bergerak_sawah_pekarangan'),
			// 'sawah_pekarangan' => $this->input->post('sawah_pekarangan'),
			'aset_bergerak' => $this->input->post('aset_bergerak'),
			'status_bantuan_dari_lembaga_lain' => implode(',',$this->input->post('status_bantuan_dari_lembaga_lain')),
			'catatan_tambahan' => $this->input->post('catatan_tambahan'),
			'skor' => $nilai
		);
		$hasil = $this->db->insert("mustahik_b2", $data);
		if($hasil){
			$this->db->where('no_registrasi', $this->input->post('no_registrasi'));
			$this->db->update('mustahik', array('status_survey' => 1));	
		}
		return $hasil;
	}
	function getNilai($id){
		$n = $this->db->get_where("tb_b2_3", array('kd_data' => $id))->row_array();
		$nilai = $n['nilai'];
		return $nilai;
	}
	function getDataByKode($kode)
	{
		$hasil = $this->db->get_where("mustahik_b2", array('id_survey' => $kode))->row();
		return $hasil;
	}

	function updateData()
	{
		$id_survey = $this->input->post('id_survey');     
		$this->kd_data = uniqid();
		$f_1_1 = explode(',',$this->input->post('jumlah_tanggungan_keluarga'));
		$f_1_2 = explode(',',$this->input->post('jumlah_anak_yg_masih_sekolah'));
		$f_1_3 = explode(',',$this->input->post('jumlah_anak_yg_putus_sekolah'));
		$f_1_4 = explode(',',$this->input->post('jumlah_pengeluaran_bulanan'));
		$f_1_5 = explode(',',$this->input->post('obat_rutin_anggota_keluarga_yg_sakit'));
		$f_1_6 = explode(',',$this->input->post('biaya_pendidikan_yg_ditanggung'));
		$f_1_7 = explode(',',$this->input->post('riwayat_hutang_berjalan'));
		$f_1_8 = explode(',',$this->input->post('keperluan_hutang'));
		$f_2_9 = explode(',',$this->input->post('pekerjaan_kepala_keluarga'));
		$f_2_10 = explode(',',$this->input->post('merokok'));
		$f_2_11 = explode(',',$this->input->post('pekerjaan_suami_istri'));
		$f_2_12 = explode(',',$this->input->post('usia_mustahik'));
		$f_2_13 = explode(',',$this->input->post('kondisi_kepala_keluarga'));
		$f_3_14 = explode(',',$this->input->post('kepemilikan_rumah'));
		$f_3_15 = explode(',',$this->input->post('luas_rumah'));
		$f_3_16 = explode(',',$this->input->post('dinding_rumah'));
		$f_3_17 = explode(',',$this->input->post('lantai'));
		$f_3_18 = explode(',',$this->input->post('atap'));
		$f_3_19 = explode(',',$this->input->post('sumber_air_minum'));
		$f_3_20 = explode(',',$this->input->post('mck'));
		$f_3_21 = explode(',',$this->input->post('penerangan'));
		$f_3_22 = explode(',',$this->input->post('daya_terpasang'));
		$f_3_23 = explode(',',$this->input->post('kelayakan_tidur'));
		$f_4_24 = explode(',',$this->input->post('jumlah_makan_perhari'));
		$f_4_25 = explode(',',$this->input->post('ayam'));
		$f_4_26 = explode(',',$this->input->post('daging'));
		$f_4_27 = explode(',',$this->input->post('susu'));
		$f_4_28 = explode(',',$this->input->post('belanja_harian'));
		$f_5_29 = explode(',',$this->input->post('aset_tidak_bergerak_sawah_pekarangan'));
		$f_5_30 = explode(',',$this->input->post('aset_bergerak'));
		$nilai = 0;
		for($i=1;$i<=30;$i++)
		{
			if($i <= 8){
				$nilai += intval(${'f_1_'.$i}[1]);
			}
			if($i >= 9 && $i <= 13){
				$nilai += intval(${'f_2_'.$i}[1]);
			}
			if($i >= 14 && $i <= 23){
				$nilai += intval(${'f_3_'.$i}[1]);
			}
			if($i >= 24 && $i <= 28){
				$nilai += intval(${'f_4_'.$i}[1]);
			}
			if($i >= 29 && $i <= 30){
				$nilai += intval(${'f_5_'.$i}[1]);
			}
		}
		$data = array(
			'no_mustahik' => $this->input->post('no_registrasi'),
			'tgl' => $this->input->post('tgl'),
			'petugas_survey' => $this->input->post('petugas_survey'),
			'jumlah_tanggungan_keluarga' => intval($f_1_1[0]),
			'jumlah_anak_yg_masih_sekolah' => intval($f_1_2[0]),
			'jumlah_anak_yg_putus_sekolah' => intval($f_1_3[0]),
			'jumlah_pengeluaran_bulanan' => intval($f_1_4[0]),
			'obat_rutin_anggota_keluarga_yg_sakit' => intval($f_1_5[0]),
			'biaya_pendidikan_yg_ditanggung' => intval($f_1_6[0]),
			'riwayat_hutang_berjalan' => intval($f_1_7[0]),
			'keperluan_hutang' => intval($f_1_8[0]),
			'pekerjaan_kepala_keluarga' => $this->input->post('pekerjaan_kepala_keluarga'),
			'merokok' => $this->input->post('merokok'),
			'pekerjaan_suami_istri' => $this->input->post('pekerjaan_suami_istri'),
			'usia_mustahik' => $this->input->post('usia_mustahik'),
			'kondisi_kepala_keluarga' => $this->input->post('kondisi_kepala_keluarga'),
			'kepemilikan_rumah' => $this->input->post('kepemilikan_rumah'),
			'luas_rumah' => $this->input->post('luas_rumah'),
			'dinding_rumah' => $this->input->post('dinding_rumah'),
			'lantai' => $this->input->post('lantai'),
			'atap' => $this->input->post('atap'),
			'sumber_air_minum' => $this->input->post('sumber_air_minum'),
			'mck' => $this->input->post('mck'),
			'penerangan' => $this->input->post('penerangan'),
			'daya_terpasang' => $this->input->post('daya_terpasang'),
			'kelayakan_tidur' => $this->input->post('kelayakan_tidur'),
			'barang_elektronik_yg_dimiliki' => implode(',',$this->input->post('barang_elektronik_yg_dimiliki')),
			'jumlah_makan_perhari' => $this->input->post('jumlah_makan_perhari'),
			'ayam' => $this->input->post('ayam'),
			'daging' => $this->input->post('daging'),
			'susu' => $this->input->post('susu'),
			'belanja_harian' => $this->input->post('belanja_harian'),
			'aset_tidak_bergerak_sawah_pekarangan' => $this->input->post('aset_tidak_bergerak_sawah_pekarangan'),
			// 'sawah_pekarangan' => $this->input->post('sawah_pekarangan'),
			'aset_bergerak' => $this->input->post('aset_bergerak'),
			'status_bantuan_dari_lembaga_lain' => implode(',',$this->input->post('status_bantuan_dari_lembaga_lain')),
			'catatan_tambahan' => $this->input->post('catatan_tambahan'),
			'skor' => $nilai
		);
		$this->db->where('id_survey', $id_survey);
		$hasil = $this->db->update("mustahik_b2", $data);
		return $hasil;
	}

	function deleteData($kode)
	{
		$this->db->where('id_survey', $kode);
		$hasil = $this->db->delete("mustahik_b2");
		return $hasil;
	}

	private function _uploadImage()
    {
        $config['upload_path']          = './assets/uploads/mustahik_b2/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = $this->kd_data;
        $config['overwrite']			= true;
        $config['max_size']             = 1024; // 1MB

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            return $this->upload->data("file_name");
		}else{
			return "default.jpg";
		}
        // print_r($this->upload->display_errors());
    }

    private function _deleteImage($kode)
    {
		$data = $this->getDataByKode($kode);
        if ($data->foto != "default.jpg") {
            $filename = explode(".", $data->foto)[0];
            return array_map('unlink', glob(FCPATH."assets/uploads/mustahik_b2/$filename.*"));
        }
    }
}
