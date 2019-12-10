<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mutasi_model extends CI_Model
{
	public $kd_data;
	public $tgl_mutasi;
	public $dari_akun;
	public $ke_akun;
	public $nominal;
	public $jumlah_dana;
	public $akun_amil;
	public $kd_transaksi;

	public $nama_muzaki;
	public $nama_akunA;
	public $nama_akunB;
	public $nama_akun_amil;
	public $jenis_pembayaran;

	function __construct()
	{
		parent::__construct();
	}

	function getData()
	{
		$this->db->select('*');    
		$this->db->from('mutasi a');
		$this->db->join("jurnal b", "CONCAT('M-',a.kd_mutasi) = b.kd_transaksi","left");
		$this->db->group_by('b.kd_transaksi','asc');
		$hasil = $this->db->get();
		return $hasil->result();
	}
	function setData()
	{
		// $this->kd_data = uniqid();

		$this->tgl_mutasi = $this->input->post('tgl_mutasi');
		$this->dari_akun = $this->input->post('dari_akun');
		$this->ke_akun = $this->input->post('ke_akun');
		$this->nominal = $this->input->post('nominal');
		$data = array(
			// 'kd_mutasi' => $this->kd_data,
			'tgl_mutasi' => $this->tgl_mutasi,
			'dari_akun' => $this->dari_akun,
			'ke_akun' => $this->ke_akun,
			'nominal' => $this->nominal,
		);
		$hasil = $this->db->insert("mutasi", $data);
		$this->kd_data = $this->db->insert_id(); // get last auto increment
		$this->kd_transaksi = 'M-'.$this->kd_data;
		$this->setJurnal($this->kd_transaksi);
		return $hasil;
	}
	function setJurnal($kd_transaksi){
		$this->getKetDetail($this->dari_akun,$this->ke_akun);
		$data = array(
			//aktiva
			array(
			   'tgl' => $this->tgl_mutasi ,
			   'kd_akun' => $this->ke_akun ,
			   'keterangan' => 'Pindah Buku '.$this->nama_akunA.' ke '.$this->nama_akunB,
			   'debit' => $this->nominal,
			   'kredit' => 0,
			   'status' => 0,
			   'kd_transaksi' => $kd_transaksi
			),
			//pasiva
			array(
				'tgl' => $this->tgl_mutasi ,
				'kd_akun' => $this->dari_akun ,
				'keterangan' => 'Pindah Buku '.$this->nama_akunA.' ke '.$this->nama_akunB,
				'debit' => 0,
				'kredit' => $this->nominal,
				'status' => 0,
			   	'kd_transaksi' => $kd_transaksi
			)
		);
		return $this->db->insert_batch('jurnal', $data); 
	}

	function getKetDetail($dari_akun,$ke_akun){
		$aktiva = $this->db->get_where("akun", array('kd_akun' => $dari_akun))->row_array();
		$this->nama_akunA = $aktiva['nama_akun'];
		$pasiva = $this->db->get_where("akun", array('kd_akun' => $ke_akun))->row_array();
		$this->nama_akunB = $pasiva['nama_akun'];
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
			$debit = $j['debit'];
			$kredit = $j['kredit'];
			//check saldo akun
			$s = $this->db->get_where("akun", array('kd_akun' => $kode))->row_array();
			$saldo = $s['saldo'];
			if ($debit != 0) {
				$this->db->where('kd_akun', $kd_akun);
				$this->db->set('saldo', 'saldo+' . $debit, FALSE);
				$this->db->update('akun');
			} else {
				$this->db->where('kd_akun', $kd_akun);
				$this->db->set('saldo', 'saldo-' . $kredit, FALSE);
				$this->db->update('akun');
			}
		}
	}
	
	function getMuzaki()
	{
		$hasil = $this->db->query("SELECT * FROM muzaki")->result();
		return $hasil;
	}
	function getCash()
	{
		$hasil = $this->db->query("SELECT * FROM akun WHERE kd_akun LIKE 'A01.01.01.%' AND NOT kd_akun='A01.01.01.00' ")->result();
		return $hasil;
	}
	function getBank()
	{
		$hasil = $this->db->query("SELECT * FROM akun WHERE kd_akun LIKE 'A01.01.02.%' AND NOT kd_akun='A01.01.02.00' ")->result();
		return $hasil;
	}
	function getAsetLancar()
	{
		$hasil = $this->db->query("SELECT * FROM akun WHERE kd_akun LIKE 'A01.01.%.00' AND NOT kd_akun='A01.01.00.00' AND NOT kd_akun='A01.01.01.00' AND NOT kd_akun='A01.01.02.00' ")->result();
		return $hasil;
	}
	function getDanaPasiva()
	{
		$hasil = $this->db->query("SELECT * FROM akun WHERE kd_akun LIKE 'A02.02.%' AND NOT kd_akun='A02.02.00.00' ")->result();
		return $hasil;
	}
	function getDataByKode($kode)
	{
		$hasil = $this->db->get_where("mutasi", array('kd_mutasi' => $kode))->row();
		return $hasil;
	}
	function getDetailByKode($kode)
	{
		$hasil = $this->db->get_where("jurnal", array('kd_transaksi' => 'M-'.$kode))->result();
		return $hasil;
	}
	function updateData()
	{
		$this->kd_data = $this->input->post('kd_mutasi');
		$this->tgl_mutasi = $this->input->post('tgl_mutasi');
		$this->dari_akun = $this->input->post('dari_akun');
		$this->ke_akun = $this->input->post('ke_akun');
		$this->nominal = $this->input->post('nominal');   
		$data = array(
			'tgl_mutasi' => $this->tgl_mutasi,
			'dari_akun' => $this->dari_akun,
			'ke_akun' => $this->ke_akun,
			'nominal' => $this->nominal,
		);
		$this->db->where('kd_mutasi', $this->kd_data);
		$hasil = $this->db->update("mutasi", $data);
		$this->kd_transaksi = 'M-'.$this->kd_data;
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
		$this->getKetDetail($this->dari_akun,$this->ke_akun);
		$data = array(
			//aktiva
			array(
				'id' => $id[0],
			   'tgl' => $this->tgl_mutasi ,
			   'kd_akun' => $this->ke_akun ,
			   'keterangan' => 'Pindah buku dari '.$this->nama_akunA.' ke Akun '.$this->nama_akunB,
			   'debit' => $this->nominal,
			   'kredit' => 0,
			   'status' => 0,
			   'kd_transaksi' => $kd_transaksi
			),
			//pasiva
			array(
				'id' => $id[1],
				'tgl' => $this->tgl_mutasi ,
				'kd_akun' => $this->dari_akun ,
				'keterangan' => 'Pindah buku dari '.$this->nama_akunA.' ke Akun '.$this->nama_akunB,
				'debit' => 0,
				'kredit' => $this->nominal,
				'status' => 0,
			   	'kd_transaksi' => $kd_transaksi
			)
		);
		return $this->db->update_batch('jurnal', $data , 'id'); 
	}
	function deleteData($kode)
	{
		// $this->_deleteImage($kode);
		$this->db->where('kd_mutasi', $kode);
		$hasil = $this->db->delete("mutasi");
		$this->deleteJurnal('M-'.$kode);
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
