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
	public $akun_wilayah;
	public $kd_transaksi;

	public $nama_muzaki;
	public $nama_akunA;
	public $nama_akunP;
	public $nama_akun_amil;
	public $nama_akun_wilayah;
	public $jenis_pembayaran;

	function __construct()
	{
		parent::__construct();
	}

	function getData()
	{
		$this->db->select('*,a.keterangan AS ket');    
		$this->db->from('donasi_masuk a');
		$this->db->join("jurnal b", "CONCAT('DM-',a.kd_donasi) = b.kd_transaksi","left");
		$this->db->group_by('b.kd_transaksi','asc');
		$hasil = $this->db->get();
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
		$this->jenis_nominal = $this->input->post('jenis_nominal');
		// $this->potongan_amil = $this->input->post('potongan_amil');
		$this->potongan_wilayah = $this->input->post('potongan_wilayah');

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
		$this->kd_transaksi = 'DM-'.$this->kd_data;
		$this->setJurnal($this->kd_transaksi);
		return $hasil;
	}
	function setJurnal($kd_transaksi){
		$this->akun_amil = 'A02.02.05.00';
		$this->akun_wilayah = 'A02.02.11.00';

		// $this->potongan_amil = $this->potongan_amil/100;
		$this->potongan_wilayah = $this->potongan_wilayah/100; 
		//zakat = potongan 12.5%
		if($this->jenis_donasi == "A02.02.01.00" || $this->jenis_donasi == "A02.02.02.00"){
			// $dana_donasi = 0.825*$this->jumlah_dana;
			// $dana_amil = 0.125*$this->jumlah_dana;
			// $dana_hak_kelola_wilayah = 0.05*$this->jumlah_dana;
			$this->potongan_amil = 0.125;
		}
		//lain-lain potongan 20%
		else{
			// $dana_donasi = 0.75*$this->jumlah_dana;
			// $dana_amil = 0.2*$this->jumlah_dana;
			// $dana_hak_kelola_wilayah = 0.05*$this->jumlah_dana;
			$this->potongan_amil = 0.2;
		}

		$this->getKetDetail($this->kd_muzaki,$this->jenis_dana,$this->jenis_donasi,$this->akun_amil,$this->akun_wilayah);

		if($this->potongan_amil == 0){
			$dana_donasi = (1-$this->potongan_wilayah)*$this->jumlah_dana;
			$dana_hak_kelola_wilayah = $this->potongan_wilayah*$this->jumlah_dana;

			$data = array(
				//aktiva
				array(
				   'tgl' => $this->tgl_donasi ,
				   'kd_akun' => $this->jenis_dana ,
				   'keterangan' => 'Donasi dari '.$this->nama_muzaki.' secara '.$this->jenis_pembayaran. ' ke '.$this->nama_akunA.' untuk '.$this->nama_akunP,
				   'debit' => $dana_donasi,
				   'kredit' => 0,
				   'status' => 0,
				   'kd_transaksi' => $kd_transaksi
				),
				//aktiva hak wilayah
				array(
					'tgl' => $this->tgl_donasi ,
					'kd_akun' => "A01.01.01.11" ,
					'keterangan' => 'Donasi dari '.$this->nama_muzaki.' secara '.$this->jenis_pembayaran. ' ke '.$this->nama_akunA.' untuk '.$this->nama_akun_wilayah,
					'debit' => $dana_hak_kelola_wilayah,
					'kredit' => 0, 
					'status' => 0,
					'kd_transaksi' => $kd_transaksi
				 ),
				//pasiva
				array(
					'tgl' => $this->tgl_donasi ,
					'kd_akun' => $this->jenis_donasi ,
					'keterangan' => 'Donasi dari '.$this->nama_muzaki.' secara '.$this->jenis_pembayaran. ' ke '.$this->nama_akunA.' untuk '.$this->nama_akunP,
					'debit' => 0,
					'kredit' => $dana_donasi,
					'status' => 0,
					   'kd_transaksi' => $kd_transaksi
				),
				//pasiva hak kelola wilayah
				array(
					'tgl' => $this->tgl_donasi,
					'kd_akun' => $this->akun_wilayah,
					'keterangan' => 'Donasi dari '.$this->nama_muzaki.' secara '.$this->jenis_pembayaran. ' ke '.$this->nama_akunA.' untuk '.$this->nama_akun_wilayah,
					'debit' => 0,
					'kredit' => $dana_hak_kelola_wilayah,
					'status' => 0,
					'kd_transaksi' => $kd_transaksi
				)
			);
		}else if($this->potongan_wilayah == 0){
			$dana_donasi = (1-$this->potongan_amil)*$this->jumlah_dana;
			$dana_amil = $this->potongan_amil*$this->jumlah_dana;	

			$data = array(
				//aktiva
				array(
				   'tgl' => $this->tgl_donasi ,
				   'kd_akun' => $this->jenis_dana ,
				   'keterangan' => 'Donasi dari '.$this->nama_muzaki.' secara '.$this->jenis_pembayaran. ' ke '.$this->nama_akunA.' untuk '.$this->nama_akunP,
				   'debit' => $dana_donasi,
				   'kredit' => 0,
				   'status' => 0,
				   'kd_transaksi' => $kd_transaksi
				),
				//aktiva amil
				array(
					'tgl' => $this->tgl_donasi ,
					'kd_akun' => "A01.01.01.05" ,
					'keterangan' => 'Donasi dari '.$this->nama_muzaki.' secara '.$this->jenis_pembayaran. ' ke '.$this->nama_akunA.' untuk '.$this->nama_akun_amil,
					'debit' => $dana_amil,
					'kredit' => 0,
					'status' => 0,
					'kd_transaksi' => $kd_transaksi
				),
				//pasiva
				array(
					'tgl' => $this->tgl_donasi ,
					'kd_akun' => $this->jenis_donasi ,
					'keterangan' => 'Donasi dari '.$this->nama_muzaki.' secara '.$this->jenis_pembayaran. ' ke '.$this->nama_akunA.' untuk '.$this->nama_akunP,
					'debit' => 0,
					'kredit' => $dana_donasi,
					'status' => 0,
					   'kd_transaksi' => $kd_transaksi
				),
				//pasiva amil
				array(
					'tgl' => $this->tgl_donasi,
					'kd_akun' => $this->akun_amil,
					'keterangan' => 'Donasi dari '.$this->nama_muzaki.' secara '.$this->jenis_pembayaran. ' ke '.$this->nama_akunA.' untuk '.$this->nama_akun_amil,
					'debit' => 0,
					'kredit' => $dana_amil,
					'status' => 0,
					   'kd_transaksi' => $kd_transaksi
				)
			);

		}else if( ($this->potongan_wilayah == 0 && $this->potongan_amil == 0) || $this->jenis_nominal == 100){
			$dana_donasi = $this->jumlah_dana;

			$data = array(
				//aktiva
				array(
				   'tgl' => $this->tgl_donasi ,
				   'kd_akun' => $this->jenis_dana ,
				   'keterangan' => 'Donasi dari '.$this->nama_muzaki.' secara '.$this->jenis_pembayaran. ' ke '.$this->nama_akunA.' untuk '.$this->nama_akunP,
				   'debit' => $dana_donasi,
				   'kredit' => 0,
				   'status' => 0,
				   'kd_transaksi' => $kd_transaksi
				),
				//pasiva
				array(
					'tgl' => $this->tgl_donasi ,
					'kd_akun' => $this->jenis_donasi ,
					'keterangan' => 'Donasi dari '.$this->nama_muzaki.' secara '.$this->jenis_pembayaran. ' ke '.$this->nama_akunA.' untuk '.$this->nama_akunP,
					'debit' => 0,
					'kredit' => $dana_donasi,
					'status' => 0,
					'kd_transaksi' => $kd_transaksi
				)			
			);
		}else{
			$dana_donasi = (1-$this->potongan_amil-$this->potongan_wilayah)*$this->jumlah_dana;
			$dana_amil = $this->potongan_amil*$this->jumlah_dana;
			$dana_hak_kelola_wilayah = $this->potongan_wilayah*$this->jumlah_dana;	
			
			$data = array(
				//aktiva
				array(
				   'tgl' => $this->tgl_donasi ,
				   'kd_akun' => $this->jenis_dana ,
				   'keterangan' => 'Donasi dari '.$this->nama_muzaki.' secara '.$this->jenis_pembayaran. ' ke '.$this->nama_akunA.' untuk '.$this->nama_akunP,
				   'debit' => $dana_donasi,
				   'kredit' => 0,
				   'status' => 0,
				   'kd_transaksi' => $kd_transaksi
				),
				//aktiva amil
				array(
					'tgl' => $this->tgl_donasi ,
					'kd_akun' => "A01.01.01.05" ,
					'keterangan' => 'Donasi dari '.$this->nama_muzaki.' secara '.$this->jenis_pembayaran. ' ke '.$this->nama_akunA.' untuk '.$this->nama_akun_amil,
					'debit' => $dana_amil,
					'kredit' => 0,
					'status' => 0,
					'kd_transaksi' => $kd_transaksi
				 ),
				 //aktiva hak wilayah
				array(
					'tgl' => $this->tgl_donasi ,
					'kd_akun' => "A01.01.01.11" ,
					'keterangan' => 'Donasi dari '.$this->nama_muzaki.' secara '.$this->jenis_pembayaran. ' ke '.$this->nama_akunA.' untuk '.$this->nama_akun_wilayah,
					'debit' => $dana_hak_kelola_wilayah,
					'kredit' => 0, 
					'status' => 0,
					'kd_transaksi' => $kd_transaksi
				 ),
				//pasiva
				array(
					'tgl' => $this->tgl_donasi ,
					'kd_akun' => $this->jenis_donasi ,
					'keterangan' => 'Donasi dari '.$this->nama_muzaki.' secara '.$this->jenis_pembayaran. ' ke '.$this->nama_akunA.' untuk '.$this->nama_akunP,
					'debit' => 0,
					'kredit' => $dana_donasi,
					'status' => 0,
					'kd_transaksi' => $kd_transaksi
				),
				//pasiva amil
				array(
					'tgl' => $this->tgl_donasi,
					'kd_akun' => $this->akun_amil,
					'keterangan' => 'Donasi dari '.$this->nama_muzaki.' secara '.$this->jenis_pembayaran. ' ke '.$this->nama_akunA.' untuk '.$this->nama_akun_amil,
					'debit' => 0,
					'kredit' => $dana_amil,
					'status' => 0,
					'kd_transaksi' => $kd_transaksi
				),
				//pasiva hak kelola wilayah
				array(
					'tgl' => $this->tgl_donasi,
					'kd_akun' => $this->akun_wilayah,
					'keterangan' => 'Donasi dari '.$this->nama_muzaki.' secara '.$this->jenis_pembayaran. ' ke '.$this->nama_akunA.' untuk '.$this->nama_akun_wilayah,
					'debit' => 0,
					'kredit' => $dana_hak_kelola_wilayah,
					'status' => 0,
					'kd_transaksi' => $kd_transaksi
				)
			);
		}
		return $this->db->insert_batch('jurnal', $data); 
	}

	function getKetDetail($kd_muzaki,$kd_akunA,$kd_akunP,$kd_akun_amil,$kd_akun_wilayah){
		$muzaki = $this->db->get_where("muzaki", array('kd_muzaki' => $kd_muzaki))->row_array();
		$this->nama_muzaki = $muzaki['nama_muzaki'];
		$aktiva = $this->db->get_where("akun", array('kd_akun' => $kd_akunA))->row_array();
		$this->nama_akunA = $aktiva['nama_akun'];
		$pasiva = $this->db->get_where("akun", array('kd_akun' => $kd_akunP))->row_array();
		$this->nama_akunP = $pasiva['nama_akun'];
		$amil = $this->db->get_where("akun", array('kd_akun' => $kd_akun_amil))->row_array();
		$this->nama_akun_amil = $amil['nama_akun'];
		$wilayah = $this->db->get_where("akun", array('kd_akun' => $kd_akun_wilayah))->row_array();
		$this->nama_akun_wilayah = $wilayah['nama_akun'];
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
			if(strpos($kd_akun,$aktiva) !== false){
				$nominal = $j['debit'];
			}else{
				$nominal = $j['kredit'];
			}
			$this->db->where('kd_akun', $kd_akun);
			$this->db->set('saldo', 'saldo+'.$nominal, FALSE);
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
		$hasil = $this->db->get_where("donasi_masuk", array('kd_donasi' => $kode))->row();
		return $hasil;
	}
	function getDetailByKode($kode)
	{
		$hasil = $this->db->get_where("jurnal", array('kd_transaksi' => 'DM-'.$kode))->result();
		return $hasil;
	}
	function updateData()
	{
		$this->kd_data = $this->input->post('kd_donasi');
		$this->tgl_donasi = $this->input->post('tgl_donasi');
		$this->kd_muzaki = $this->input->post('kd_muzaki');
		$this->keterangan = $this->input->post('keterangan');
		$this->jenis_donasi = $this->input->post('jenis_donasi');
		$this->jenis_dana = $this->input->post('jenis_dana');
		$this->jumlah_dana = $this->input->post('jumlah_dana');   
		$this->jenis_nominal = $this->input->post('jenis_nominal');
		$this->potongan_wilayah = $this->input->post('potongan_wilayah');
		$data = array(
			'tgl_donasi' => $this->tgl_donasi,
			'kd_muzaki' => $this->kd_muzaki,
			'keterangan' => $this->keterangan,
			'jenis_donasi' => $this->jenis_donasi,
			'jenis_dana' => $this->jenis_dana,
			'jumlah_dana' => $this->jumlah_dana,
		);
		$this->db->where('kd_donasi', $this->kd_data);
		$hasil = $this->db->update("donasi_masuk", $data);
		$this->kd_transaksi = 'DM-'.$this->kd_data;
		// $this->updateJurnal($this->kd_transaksi);
		$this->deleteJurnalLawas($this->kd_transaksi);
		$this->setJurnal($this->kd_transaksi);
		return $hasil;
	}
	function deleteJurnalLawas($kd_transaksi){
		$hasil = $this->db->delete("jurnal", array('kd_transaksi' => $kd_transaksi));
		return $hasil;
	}

	function deleteData($kode)
	{
		// $this->_deleteImage($kode);
		$this->db->where('kd_donasi', $kode);
		$hasil = $this->db->delete("donasi_masuk");
		$this->deleteJurnal('DM-'.$kode);
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

	function deprecatedFunction(){
		// function getIdJurnal($kd_transaksi){
		// 	$i = 0;
		// 	$jurnal = $this->db->get_where("jurnal", array('kd_transaksi' => $kd_transaksi))->result_array();
		// 	foreach($jurnal as $j){
		// 		$id_jurnal[$i] = $j['id'];
		// 		$i++;
		// 	}
		// 	return $id_jurnal;
		// }

		// function updateJurnalLawas($kd_transaksi){
		// 	$id = $this->getIdJurnal($this->kd_transaksi);
		// 	$this->akun_amil = 'A02.02.05.00';
		// 	$this->akun_wilayah = 'A02.02.11.00';
		// 	//zakat = potongan 12.5%
		// 	if($this->jenis_donasi == "A02.02.01.00" || $this->jenis_donasi == "A02.02.02.00"){
		// 		$dana_donasi = 0.825*$this->jumlah_dana;
		// 		$dana_amil = 0.125*$this->jumlah_dana;
		// 		$dana_hak_kelola_wilayah = 0.05*$this->jumlah_dana;
		// 	}
		// 	//lain-lain potongan 20%
		// 	else{
		// 		$dana_donasi = 0.75*$this->jumlah_dana;
		// 		$dana_amil = 0.2*$this->jumlah_dana;
		// 		$dana_hak_kelola_wilayah = 0.05*$this->jumlah_dana;
		// 	}
		// 	$this->getKetDetail($this->kd_muzaki,$this->jenis_dana,$this->jenis_donasi,$this->akun_amil,$this->akun_wilayah);
		// 	$data = array(
		// 		//aktiva
		// 		array(
		// 			'id' => $id[0],
		// 			'tgl' => $this->tgl_donasi,
		// 			'kd_akun' => $this->jenis_dana,
		// 			'keterangan' => 'Donasi dari ' . $this->nama_muzaki . ' secara ' . $this->jenis_pembayaran . ' ke ' . $this->nama_akunA . ' untuk ' . $this->nama_akunP,
		// 			'debit' => $this->input->post('jumlah_dana'),
		// 			'kredit' => 0,
		// 			'status' => 0,
		// 			'kd_transaksi' => $kd_transaksi
		// 		),
		// 		//aktiva amil
		// 		array(
		// 			'id' => $id[1],
		// 			'tgl' => $this->tgl_donasi ,
		// 			'kd_akun' => "A01.01.01.05" ,
		// 			'keterangan' => 'Donasi dari '.$this->nama_muzaki.' secara '.$this->jenis_pembayaran. ' ke '.$this->nama_akunA.' untuk '.$this->nama_akun_amil,
		// 			'debit' => $dana_amil,
		// 			'kredit' => 0,
		// 			'status' => 0,
		// 			'kd_transaksi' => $kd_transaksi
		// 		 ),
		// 		 //aktiva hak wilayah
		// 		array(
		// 			'id' => $id[2],
		// 			'tgl' => $this->tgl_donasi ,
		// 			'kd_akun' => "A01.01.01.11" ,
		// 			'keterangan' => 'Donasi dari '.$this->nama_muzaki.' secara '.$this->jenis_pembayaran. ' ke '.$this->nama_akunA.' untuk '.$this->nama_akun_wilayah,
		// 			'debit' => $dana_hak_kelola_wilayah,
		// 			'kredit' => 0, 
		// 			'status' => 0,
		// 			'kd_transaksi' => $kd_transaksi
		// 		 ),
		// 		//pasiva
		// 		array(
		// 			'id' => $id[3],
		// 			'tgl' => $this->tgl_donasi ,
		// 			'kd_akun' => $this->jenis_donasi ,
		// 			'keterangan' => 'Donasi dari '.$this->nama_muzaki.' secara '.$this->jenis_pembayaran. ' ke '.$this->nama_akunA.' untuk '.$this->nama_akunP,
		// 			'debit' => 0,
		// 			'kredit' => $dana_donasi,
		// 			'status' => 0,
		// 		   	'kd_transaksi' => $kd_transaksi
		// 		),
		// 		//pasiva amil
		// 		array(
		// 			'id' => $id[4],
		// 			'tgl' => $this->tgl_donasi,
		// 			'kd_akun' => $this->akun_amil,
		// 			'keterangan' => 'Donasi dari '.$this->nama_muzaki.' secara '.$this->jenis_pembayaran. ' ke '.$this->nama_akunA.' untuk '.$this->nama_akun_amil,
		// 			'debit' => 0,
		// 			'kredit' => $dana_amil,
		// 			'status' => 0,
		// 		   	'kd_transaksi' => $kd_transaksi
		// 		),
		// 		//pasiva hak kelola wilayah
		// 		array(
		// 			'id' => $id[5],
		// 			'tgl' => $this->tgl_donasi,
		// 			'kd_akun' => $this->akun_wilayah,
		// 			'keterangan' => 'Donasi dari '.$this->nama_muzaki.' secara '.$this->jenis_pembayaran. ' ke '.$this->nama_akunA.' untuk '.$this->nama_akun_wilayah,
		// 			'debit' => 0,
		// 			'kredit' => $dana_hak_kelola_wilayah,
		// 			'status' => 0,
		// 		   	'kd_transaksi' => $kd_transaksi
		// 		)
		// 	);
		// 	return $this->db->update_batch('jurnal', $data , 'id'); 
		// }

	}

}
