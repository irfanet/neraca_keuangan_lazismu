<?php
defined('BASEPATH') or exit('No direct script access allowed');
class DonasiMasuk_model extends CI_Model
{
	public $kd_data;

	function __construct()
	{
		parent::__construct();
	}

	function getData()
	{
		$hasil = $this->db->get("donasi_masuk");
		return $hasil->result();
	}
	function setData()
	{
		// $this->kd_data = uniqid();
		$data = array(
			// 'kd_donasi' => $this->kd_data,
			'tgl_donasi' => $this->input->post('tgl_donasi'),
			'kd_muzaki' => $this->input->post('kd_muzaki'),
			'keterangan' => $this->input->post('keterangan'),
			'jenis_donasi' => $this->input->post('jenis_donasi'),
			'jenis_dana' => $this->input->post('jenis_dana'),
			'jumlah_dana' => $this->input->post('jumlah_dana'),
			'kd_muzaki' => $this->input->post('kd_muzaki')
		);
		$hasil = $this->db->insert("donasi_masuk", $data);
		$this->kd_data = $this->db->insert_id(); // get last auto increment
		return $hasil;
	}
	function getDataByKode($kode)
	{
		$hasil = $this->db->get_where("donasi_masuk", array('kd_donasi' => $kode))->row();
		return $hasil;
	}

	function updateData()
	{
		$this->kd_data = $this->input->post('kd_donasi');
		if (!empty($_FILES["foto"]["name"])) {
            $foto = $this->_uploadImage();
        } else {
            $foto =$this->input->post("old_image");
        }        
		$data = array(
			'tgl_donasi' => $this->input->post('tgl_donasi'),
			'kd_muzaki' => $this->input->post('kd_muzaki'),
			'keterangan' => $this->input->post('keterangan'),
			'jenis_donasi' => $this->input->post('jenis_donasi'),
			'jenis_dana' => $this->input->post('jenis_dana'),
			'jumlah_dana' => $this->input->post('jumlah_dana'),
		);
		$this->db->where('kd_donasi', $this->kd_data);
		$hasil = $this->db->update("donasi_masuk", $data);
		return $hasil;
	}

	function deleteData($kode)
	{
		// $this->_deleteImage($kode);
		$this->db->where('kd_donasi', $kode);
		$hasil = $this->db->delete("donasi_masuk");
		return $hasil;
	}

	private function _uploadImage()
    {
        $config['upload_path']          = './assets/uploads/';
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
            return array_map('unlink', glob(FCPATH."assets/uploads/$filename.*"));
        }
    }
}
