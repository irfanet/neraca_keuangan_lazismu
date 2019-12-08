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
		$hasil = $this->db->get("mustahik");
		return $hasil->result();
	}
	function setData()
	{
		$this->kd_data = uniqid();
		$data = array(
			'no_registrasi' => $this->input->post('no_registrasi'),
			'no_kk' => $this->input->post('no_kk'),
			'nik' => $this->input->post('nik'),
			'nama' => $this->input->post('nama'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'alamat' => $this->input->post('alamat'),
			'dusun' => $this->input->post('dusun'),
			'desa' => $this->input->post('desa'),
			'kecamatan' => $this->input->post('kecamatan'),
			'kota' => $this->input->post('kota'),
			'propinsi' => $this->input->post('propinsi'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'agama' => $this->input->post('agama'),
			'status_marital' => $this->input->post('status_marital'),
			'status_pendidikan' => $this->input->post('status_pendidikan'),
			'pekerjaan' => $this->input->post('pekerjaan'),
			'penghasilan' => $this->input->post('penghasilan'),
			'no_telp' => $this->input->post('no_telp'),
			'jumlah_keluarga' => $this->input->post('jumlah_keluarga'),
			'detail_pengajuan' => $this->input->post('detail_pengajuan'),
			'persyaratan' => $this->input->post('persyaratan'),
			'status_acc_pengurus' => 0,
			'status_acc_direktur' => 0
		);
		$hasil = $this->db->insert("mustahik", $data);
		return $hasil;
	}
	function getDataByKode($kode)
	{
		$hasil = $this->db->get_where("mustahik", array('no_registrasi' => $kode))->row();
		return $hasil;
	}

	function updateData()
	{
		$no_registrasi = $this->input->post('no_registrasi');     
		$data = array(
			'no_registrasi' => $this->input->post('no_registrasi'),
			'no_kk' => $this->input->post('no_kk'),
			'nik' => $this->input->post('nik'),
			'nama' => $this->input->post('nama'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'alamat' => $this->input->post('alamat'),
			'dusun' => $this->input->post('dusun'),
			'desa' => $this->input->post('desa'),
			'kecamatan' => $this->input->post('kecamatan'),
			'kota' => $this->input->post('kota'),
			'propinsi' => $this->input->post('propinsi'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'agama' => $this->input->post('agama'),
			'status_marital' => $this->input->post('status_marital'),
			'status_pendidikan' => $this->input->post('status_pendidikan'),
			'pekerjaan' => $this->input->post('pekerjaan'),
			'penghasilan' => $this->input->post('penghasilan'),
			'no_telp' => $this->input->post('no_telp'),
			'jumlah_keluarga' => $this->input->post('jumlah_keluarga'),
			'detail_pengajuan' => $this->input->post('detail_pengajuan'),
			'persyaratan' => $this->input->post('persyaratan'),
			'status_acc_pengurus' => 0,
			'status_acc_direktur' => 0
		);
		$this->db->where('no_registrasi', $no_registrasi);
		$hasil = $this->db->update("mustahik", $data);
		return $hasil;
	}

	function deleteData($kode)
	{
		$this->db->where('no_registrasi', $kode);
		$hasil = $this->db->delete("mustahik");
		return $hasil;
	}

	private function _uploadImage()
    {
        $config['upload_path']          = './assets/uploads/mustahik/';
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
            return array_map('unlink', glob(FCPATH."assets/uploads/mustahik/$filename.*"));
        }
    }
}
