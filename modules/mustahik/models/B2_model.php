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
		$this->db->select('*');    
		$this->db->from('mustahik a');
		$this->db->join("mustahik_b2 b", "a.no_registrasi = b.no_mustahik");
		$hasil = $this->db->get();
		return $hasil->result();
	}
	function setData()
	{
		$this->kd_data = uniqid();
		$data = array(
			'no_mustahik' => $this->input->post('no_registrasi'),
			'tgl' => $this->input->post('tgl'),
			'petugas_survey' => $this->input->post('petugas_survey'),
			'jumlah_tanggungan_keluarga' => $this->input->post('jumlah_tanggungan_keluarga'),
			'jumlah_anak_yg_masih_sekolah' => $this->input->post('jumlah_anak_yg_masih_sekolah'),
			'jumlah_anak_yg_putus_sekolah' => $this->input->post('jumlah_anak_yg_putus_sekolah'),
			'jumlah_pengeluaran_bulanan' => $this->input->post('jumlah_pengeluaran_bulanan'),
			'obat_rutin_anggota_keluarga_yg_sakit' => $this->input->post('obat_rutin_anggota_keluarga_yg_sakit'),
			'biaya_pendidikan_yg_ditanggung' => $this->input->post('biaya_pendidikan_yg_ditanggung'),
			'riwayat_hutang_berjalan' => $this->input->post('riwayat_hutang_berjalan'),
			'keperluan_hutang' => $this->input->post('keperluan_hutang'),
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
			'aset_tidak_bergerak' => $this->input->post('aset_tidak_bergerak'),
			'sawah_pekarangan' => $this->input->post('sawah_pekarangan'),
			'aset_bergerak' => $this->input->post('aset_bergerak'),
			'status_bantuan_dari_lembaga_lain' => implode(',',$this->input->post('status_bantuan_dari_lembaga_lain')),
			'catatan_tambahan' => $this->input->post('catatan_tambahan'),
		);
		$hasil = $this->db->insert("mustahik_b2", $data);
		$this->db->where('no_registrasi', $this->input->post('no_registrasi'));
		$this->db->update('mustahik', array('status_survey' => 1));
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
		$no_registrasi = $this->input->post('no_registrasi');     
		$data = array(
			'no_mustahik' => $this->input->post('no_registrasi'),
			'tgl' => $this->input->post('tgl'),
			'petugas_survey' => $this->input->post('petugas_survey'),
			'jumlah_tanggungan_keluarga' => $this->input->post('jumlah_tanggungan_keluarga'),
			'jumlah_anak_yg_masih_sekolah' => $this->input->post('jumlah_anak_yg_masih_sekolah'),
			'jumlah_anak_yg_putus_sekolah' => $this->input->post('jumlah_anak_yg_putus_sekolah'),
			'jumlah_pengeluaran_bulanan' => $this->input->post('jumlah_pengeluaran_bulanan'),
			'obat_rutin_anggota_keluarga_yg_sakit' => $this->input->post('obat_rutin_anggota_keluarga_yg_sakit'),
			'biaya_pendidikan_yg_ditanggung' => $this->input->post('biaya_pendidikan_yg_ditanggung'),
			'riwayat_hutang_berjalan' => $this->input->post('riwayat_hutang_berjalan'),
			'keperluan_hutang' => $this->input->post('keperluan_hutang'),
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
			'barang_elektronik_yg_dimiliki' => $this->input->post('barang_elektronik_yg_dimiliki'),
			'jumlah_makan_perhari' => $this->input->post('jumlah_makan_perhari'),
			'ayam' => $this->input->post('ayam'),
			'daging' => $this->input->post('daging'),
			'susu' => $this->input->post('susu'),
			'belanja_harian' => $this->input->post('belanja_harian'),
			'aset_tidak_bergerak' => $this->input->post('aset_tidak_bergerak'),
			'sawah_pekarangan' => $this->input->post('sawah_pekarangan'),
			'aset_bergerak' => $this->input->post('aset_bergerak'),
			'status_bantuan_dari_lembaga_lain' => $this->input->post('status_bantuan_dari_lembaga_lain'),
			'catatan_tambahan' => $this->input->post('catatan_tambahan'),

		);
		$this->db->where('no_registrasi', $no_registrasi);
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
