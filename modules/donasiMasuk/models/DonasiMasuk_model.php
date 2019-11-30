<?php
defined('BASEPATH') or exit('No direct script access allowed');
class DonasiMasuk_model extends CI_Model
{
	public $kd_data;
	public $tgl_donasi;
	public $kd_muzaki;
	public $keterangan;
	public $jenis_donasi;
	public $jenis_dana;
	public $jumlah_dana;
	public $akun_amil;

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

		$this->tgl_donasi = $this->input->post('tgl_donasi');
		$this->kd_muzaki = $this->input->post('kd_muzaki');
		$this->keterangan = $this->input->post('keterangan');
		$this->jenis_donasi = $this->input->post('jenis_donasi');
		$this->jenis_dana = $this->input->post('jenis_dana');
		$this->jumlah_dana = $this->input->post('jumlah_dana');
		$data = array(
			// 'kd_donasi' => $this->kd_data,
			'tgl_donasi' => $this->tgl_donasi,
			'kd_muzaki' => $this->kd_muzaki,
			'keterangan' => $this->keterangan,
			'jenis_donasi' => $this->jenis_donasi,
			'jenis_dana' => $this->jenis_dana,
			'jumlah_dana' => $this->jumlah_dana,
		);
		$hasil = $this->db->insert("donasi_masuk", $data);
		$this->kd_data = $this->db->insert_id(); // get last auto increment
		$this->setJurnal($this->kd_data);
		return $hasil;
	}
	function setJurnal($kode){
		$this->akun_amil = 'A02.02.04.00';
		//zakat = potongan 12.5%
		if($this->jenis_donasi == "A02.02.01.00" || $this->jenis_donasi == "A02.02.02.00"){
			$dana_donasi = 0.875*$this->jumlah_dana;
			$dana_amil = 0.125*$this->jumlah_dana;
		}
		//infak = potongan 20%
		else if($this->jenis_donasi == "A02.02.03.00" ){
			$dana_donasi = 0.8*$this->jumlah_dana;
			$dana_amil = 0.2*$this->jumlah_dana;
		}
		//lain-lain
		else{
			$dana_donasi = $this->jumlah_dana;
			$dana_amil = $this->jumlah_dana;	
		}
		$data = array(
			//aktiva
			array(
			   'tgl' => $this->tgl_donasi ,
			   'kd_akun' => $this->jenis_dana ,
			   'keterangan' => 'Donasi dari '.$this->kd_muzaki.' secara '.$this->jenis_dana.' untuk '.$this->jenis_donasi,
			   'debit' => $this->input->post('jumlah_dana'),
			   'kredit' => 0,
			   'status' => $kode
			),
			//pasiva
			array(
				'tgl' => $this->tgl_donasi ,
				'kd_akun' => $this->jenis_donasi ,
				'keterangan' => 'Donasi dari '.$this->kd_muzaki.' secara '.$this->jenis_dana.' untuk '.$this->jenis_donasi,
				'debit' => 0,
				'kredit' => $dana_donasi,
				'status' => $kode
			),
			//pasiva amil
			array(
				'tgl' => $this->tgl_donasi,
				'kd_akun' => $this->akun_amil,
				'keterangan' => 'Donasi dari '.$this->kd_muzaki.' secara '.$this->jenis_dana.' untuk '.$this->akun_amil,
				'debit' => 0,
				'kredit' => $dana_amil,
				'status' => $kode
			)
		);
		return $this->db->insert_batch('jurnal', $data); 
	}
	function getMuzaki()
	{
		$hasil = $this->db->query("SELECT * FROM muzaki")->result();
		return $hasil;
	}
	function getKasAktiva()
	{
		$hasil = $this->db->query("SELECT * FROM akun WHERE kd_akun LIKE 'A01.01.01.%' AND NOT kd_akun='A01.01.01.00' ")->result();
		return $hasil;
	}
	function getBankAktiva()
	{
		$hasil = $this->db->query("SELECT * FROM akun WHERE kd_akun LIKE 'A01.01.02.%' AND NOT kd_akun='A01.01.02.00' ")->result();
		return $hasil;
	}
	function getDanaPasiva()
	{
		$hasil = $this->db->query("SELECT * FROM akun WHERE kd_akun LIKE 'A02.02.%' AND NOT kd_akun='A02.02.00.00' ")->result();
		return $hasil;
	}
	function getDataByKode($kode)
	{
		$hasil = $this->db->get_where("donasi_masuk", array('kd_donasi' => $kode))->row();
		return $hasil;
	}
	function getDetailByKode($kode)
	{
		$hasil = $this->db->get_where("jurnal", array('status' => $kode))->result();
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
