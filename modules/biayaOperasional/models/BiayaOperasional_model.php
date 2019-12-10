<?php
defined('BASEPATH') or exit('No direct script access allowed');
class BiayaOperasional_model extends CI_Model
{
	public $kd_data;
	public $tgl_dana_keluar;
	public $jenis_biaya;
	public $keterangan;
	public $jenis_donasi;
	public $jenis_dana;
	public $jumlah_dana;
	public $akun_amil;
	public $kd_transaksi;

	public $nama_muzaki;
	public $nama_akunA;
	public $nama_akunP;
	public $nama_akun_amil;
	public $jenis_pembayaran;

	function __construct()
	{
		parent::__construct();
	}

	function getData()
	{
		$this->db->select('*,a.keterangan AS ket');    
		$this->db->from('biaya_operasional a');
		$this->db->join("jurnal b", "CONCAT('BO-',a.kd_operasional) = b.kd_transaksi","left");
		$this->db->group_by('b.kd_transaksi','asc');
		$hasil = $this->db->get();
		return $hasil->result();
	}
	function setData()
	{
		// $this->kd_data = uniqid();

		$this->tgl_dana_keluar = $this->input->post('tgl_dana_keluar');
		$this->jenis_biaya = $this->input->post('jenis_biaya');
		$this->keterangan = $this->input->post('keterangan');
		$this->jenis_dana = $this->input->post('jenis_dana');
		$this->jumlah_dana = $this->input->post('jumlah_dana');
		$data = array(
			// 'kd_operasional' => $this->kd_data,
			'tgl_dana_keluar' => $this->tgl_dana_keluar,
			'jenis_biaya' => $this->jenis_biaya,
			'keterangan' => $this->keterangan,
			'jenis_dana' => $this->jenis_dana,
			'jumlah_dana' => $this->jumlah_dana,
		);
		$hasil = $this->db->insert("biaya_operasional", $data);
		$this->kd_data = $this->db->insert_id(); // get last auto increment
		$this->kd_transaksi = 'BO-'.$this->kd_data;
		$this->setJurnal($this->kd_transaksi);
		return $hasil;
	}
	function setJurnal($kd_transaksi){
		$this->akun_amil = 'A02.02.05.00';
		$this->getKetDetail($this->jenis_dana,$this->akun_amil);
		$data = array(
			//pasiva
			array(
			   'tgl' => $this->tgl_dana_keluar ,
			   'kd_akun' => $this->akun_amil ,
			   'keterangan' => 'Biaya untuk '.$this->jenis_biaya.' secara '.$this->jenis_pembayaran. ' dari '.$this->nama_akun_amil,
			   'debit' => $this->input->post('jumlah_dana'),
			   'kredit' => 0,
			   'status' => 0,
			   'kd_transaksi' => $kd_transaksi
			),
			//aktiva
			array(
				'tgl' => $this->tgl_dana_keluar ,
				'kd_akun' => $this->jenis_dana ,
				'keterangan' => 'Biaya untuk '.$this->jenis_biaya.' secara '.$this->jenis_pembayaran. ' ke '.$this->nama_akunA,
				'debit' => 0,
				'kredit' =>  $this->input->post('jumlah_dana'),
				'status' => 0,
			   	'kd_transaksi' => $kd_transaksi
			)
		);
		return $this->db->insert_batch('jurnal', $data); 
	}

	function getKetDetail($kd_akunA,$kd_akun_amil){
		$aktiva = $this->db->get_where("akun", array('kd_akun' => $kd_akunA))->row_array();
		$this->nama_akunA = $aktiva['nama_akun'];
		$amil = $this->db->get_where("akun", array('kd_akun' => $kd_akun_amil))->row_array();
		$this->nama_akun_amil = $amil['nama_akun'];
		$bank = 'A01.01.02';
		if(strpos($kd_akunA,$bank) !== false){
			$this->jenis_pembayaran = 'Transfer';
		}else{
			$this->jenis_pembayaran = 'Cash';
		}
	}

	function postJurnal(){
		$jml_data = $this->input->post('jml_data');
		$kd_transaksi =  $this->input->post('kd_transaksi');
		for($i = 0; $i<$jml_data; $i++){ 
			$data[] = array( 
				'kd_transaksi' => $kd_transaksi,
				'status' => 1
			); 
		}
		$this->db->update_batch('jurnal', $data, 'kd_transaksi');
		$this->updateNeraca($kd_transaksi);
	}

	function updateNeraca($kode){
		$jurnal = $this->db->get_where("jurnal", array('kd_transaksi' => $kode))->result_array();
		foreach($jurnal as $j){
			$kd_akun = $j['kd_akun'];
			$aktiva = 'A01';
			$pasiva = 'A02';
			if(strpos($kd_akun,$pasiva) !== false){
				$nominal = $j['debit'];
			}else{
				$nominal = $j['kredit'];
			}
			$this->db->where('kd_akun', $kd_akun);
			$this->db->set('saldo', 'saldo-'.$nominal, FALSE);
			$this->db->update('akun');
		}
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
		$hasil = $this->db->get_where("biaya_operasional", array('kd_operasional' => $kode))->row();
		return $hasil;
	}
	function getDetailByKode($kode)
	{
		$hasil = $this->db->get_where("jurnal", array('kd_transaksi' => 'BO-'.$kode))->result();
		return $hasil;
	}
	function updateData()
	{
		$this->kd_data = $this->input->post('kd_operasional');
		$this->tgl_dana_keluar = $this->input->post('tgl_dana_keluar');
		$this->jenis_biaya = $this->input->post('jenis_biaya');
		$this->keterangan = $this->input->post('keterangan');
		$this->jenis_dana = $this->input->post('jenis_dana');
		$this->jumlah_dana = $this->input->post('jumlah_dana');   
		$data = array(
			'tgl_dana_keluar' => $this->tgl_dana_keluar,
			'jenis_biaya' => $this->jenis_biaya,
			'keterangan' => $this->keterangan,
			'jenis_dana' => $this->jenis_dana,
			'jumlah_dana' => $this->jumlah_dana,
		);
		$this->db->where('kd_operasional', $this->kd_data);
		$hasil = $this->db->update("biaya_operasional", $data);
		$this->kd_transaksi = 'BO-'.$this->kd_data;
		$this->updateJurnal($this->kd_transaksi);
		return $hasil;
	}
	function getIdJurnal($kd_transaksi){
		$i = 0;
		$jurnal = $this->db->get_where("jurnal", array('kd_transaksi' => $kd_transaksi))->result_array();
		foreach($jurnal as $j){
			$id_jurnal[$i] = $j['id'];
			$i++;
		}
		return $id_jurnal;
	}
	function updateJurnal($kd_transaksi){
		$id = $this->getIdJurnal($this->kd_transaksi);
		$this->akun_amil = 'A02.02.05.00';
		$this->getKetDetail($this->jenis_dana,$this->akun_amil);
		$data = array(
			//pasiva
			array(
				'id' => $id[0],
			   'tgl' => $this->tgl_dana_keluar ,
			   'kd_akun' => $this->akun_amil ,
			   'keterangan' => 'Biaya untuk '.$this->jenis_biaya.' secara '.$this->jenis_pembayaran. ' dari '.$this->nama_akun_amil,
			   'debit' => $this->input->post('jumlah_dana'),
			   'kredit' => 0,
			   'status' => 0,
			   'kd_transaksi' => $kd_transaksi
			),
			//aktiva
			array(
				'id' => $id[1],
				'tgl' => $this->tgl_dana_keluar ,
				'kd_akun' => $this->jenis_dana ,
				'keterangan' => 'Biaya untuk '.$this->jenis_biaya.' secara '.$this->jenis_pembayaran. ' ke '.$this->nama_akunA,
				'debit' => 0,
				'kredit' =>  $this->input->post('jumlah_dana'),
				'status' => 0,
			   	'kd_transaksi' => $kd_transaksi
			)
		);
		return $this->db->update_batch('jurnal', $data , 'id'); 
	}
	function deleteData($kode)
	{
		// $this->_deleteImage($kode);
		$this->db->where('kd_operasional', $kode);
		$hasil = $this->db->delete("biaya_operasional");
		$this->deleteJurnal('BO-'.$kode);
		return $hasil;
	}
	function deleteJurnal($kd_transaksi){
		$this->db->where('kd_transaksi', $kd_transaksi);
		$this->db->delete("jurnal");
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
