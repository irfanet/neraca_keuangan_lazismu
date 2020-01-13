<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Aset_model extends CI_Model
{
	public $kd_data;
	public $nama_aset;
	public $tgl_perolehan;
	public $sumber_dana;
	public $nilai_aset;
	public $jenis_aset;
	public $lama_penyusutan;
	public $akun_aset;
	public $kd_transaksi;

	public $akun_depresiasi;
	public $nama_muzaki;
	public $nama_akunA;
	public $nama_akunB;
	public $nama_akunAset;
	public $nama_akun_amil;
	public $jenis_pembayaran;

	function __construct()
	{
		parent::__construct();
	}

	function getData()
	{
		$this->db->select('*');    
		$this->db->from('aset a');
		$this->db->join("jurnal b", "CONCAT('A-',a.kd_aset) = b.kd_transaksi","left");
		$this->db->group_by('b.kd_transaksi','asc');
		$hasil = $this->db->get();
		return $hasil->result();
	}
	function setData()
	{
		// $this->kd_data = uniqid();
		$this->nama_aset = $this->input->post('nama_aset');
		$this->tgl_perolehan = $this->input->post('tgl_perolehan');
		$this->sumber_dana = $this->input->post('sumber_dana');
		$this->nilai_aset = $this->input->post('nilai_aset');
		$this->jenis_aset = $this->input->post('jenis_aset');
		$this->lama_penyusutan = $this->input->post('lama_penyusutan');
		$data = array(
			'nama_aset' => $this->nama_aset,
			'tgl_perolehan' => $this->tgl_perolehan,
			'sumber_dana' => $this->sumber_dana,
			'nilai_aset' => $this->nilai_aset,
			'jenis_aset' => $this->jenis_aset,
			'lama_penyusutan' => $this->lama_penyusutan,
			'nilai_saat_ini' => $this->nilai_aset
		);
		if($this->jenis_aset == "Tetap"){
			$this->akun_aset = "A01.02.01.00";
		}
		if($this->jenis_aset == "Kelolaan"){
			$this->akun_aset = "A01.03.01.00";
		}
		$hasil = $this->db->insert("aset", $data);
		$this->kd_data = $this->db->insert_id(); // get last auto increment
		$this->kd_transaksi = 'A-'.$this->kd_data;
		$this->setJurnal($this->kd_transaksi);
		return $hasil;
	}
	function setJurnal($kd_transaksi){
		$this->getKetDetail($this->sumber_dana,$this->akun_aset);
		$data = array(
			//aktiva akun aset
			array(
				'tgl' => $this->tgl_perolehan ,
				'kd_akun' => $this->akun_aset ,
				'keterangan' => 'Dana perolehan aset '.$this->nama_aset.' dari '.$this->nama_akunA.' ke '.$this->nama_akunB,
				'debit' => $this->nilai_aset,
				'kredit' => 0,
				'status' => 0,
			   	'kd_transaksi' => $kd_transaksi
			),
			//aktiva sumber dana
			array(
			   'tgl' => $this->tgl_perolehan ,
			   'kd_akun' => $this->sumber_dana ,
			   'keterangan' => 'Dana perolehan aset '.$this->nama_aset.' dari '.$this->nama_akunA.' ke '.$this->nama_akunB,
			   'debit' => 0,
			   'kredit' => $this->nilai_aset,
			   'status' => 0,
			   'kd_transaksi' => $kd_transaksi
			)
		);
		return $this->db->insert_batch('jurnal', $data); 
	}

	function getKetDetail($sumber_dana,$akun_aset){
		$aktiva = $this->db->get_where("akun", array('kd_akun' => $sumber_dana))->row_array();
		$this->nama_akunA = $aktiva['nama_akun'];
		$pasiva = $this->db->get_where("akun", array('kd_akun' => $akun_aset))->row_array();
		$this->nama_akunB = $pasiva['nama_akun'];
	}

	// function getKodeAkun($kd){
	// 	$aktiva = $this->db->get_where("jurnal", array('kd_transaksi' => $kd,'debit !=',0))->row_array();
	// 	$this->akun_aset = $aktiva['kd_akun'];
	// }
	function setDepresiasi()
	{
		// $this->kd_data = uniqid();
		$this->kd_data = $this->input->post('dep_kd_aset');
		$this->nama_aset = $this->input->post('dep_nama_aset');
		$this->tgl_perolehan = $this->input->post('dep_tgl');
		$this->nilai_aset = $this->input->post('dep_nilai');
		$this->jenis_aset = $this->input->post('dep_jenis_aset');
		if($this->jenis_aset == "Tetap"){
			$this->akun_depresiasi = "A01.02.02.00";
			$this->akun_aset = "A01.02.01.00";
		}
		if($this->jenis_aset == "Kelolaan"){
			$this->akun_depresiasi = "A01.03.02.00";
			$this->akun_aset = "A01.03.01.00";
		}
		// $this->sumber_dana = $this->input->post('de');
		$this->db->where('kd_aset', $this->kd_data);
		$this->db->set('nilai_saat_ini', 'nilai_saat_ini-'.$this->nilai_aset,FALSE);
		$hasil = $this->db->update('aset');

		$this->kd_transaksi = 'D-'.$this->kd_data;
		$this->setJurnalDepresiasi($this->kd_transaksi);
		$this->updateNeracaDepresiasi($this->kd_transaksi);
		return $hasil;
	}

	function setJurnalDepresiasi($kd_transaksi){
		$this->getKetDetail($this->sumber_dana,$this->akun_aset);
		$data = array(
			//aktiva akun aset
			array(
				'tgl' => $this->tgl_perolehan ,
				'kd_akun' => $this->akun_depresiasi ,
				'keterangan' => 'Depresiasi aset "'.$this->nama_aset.'" sebesar '.$this->nilai_aset,
				'debit' => $this->nilai_aset,
				'kredit' => 0,
				'status' => 1,
			   	'kd_transaksi' => $kd_transaksi
			),
			//aktiva sumber dana
			array(
			   'tgl' => $this->tgl_perolehan ,
			   'kd_akun' => $this->akun_aset ,
			   'keterangan' => 'Depresiasi aset "'.$this->nama_aset.'" sebesar '.$this->nilai_aset,
			   'debit' => 0,
			   'kredit' => $this->nilai_aset,
			   'status' => 1,
			   'kd_transaksi' => $kd_transaksi
			)
		);
		return $this->db->insert_batch('jurnal', $data); 
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
	function updateNeracaDepresiasi($kode){
		$this->db->select('*');
		$this->db->from('jurnal');
		$this->db->where('kd_transaksi', $kode);
		$this->db->where('status', 1);
		$this->db->order_by('id', 'DESC');
		$this->db->limit('2');
		$jurnal = $this->db->get()->result_array();
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
		$hasil = $this->db->get_where("aset", array('kd_aset' => $kode))->row();
		return $hasil;
	}
	function getDetailByKode($kode)
	{

		$this->db->where('kd_transaksi', 'A-'.$kode);
		$this->db->or_where('kd_transaksi =', 'D-'.$kode);
		$hasil = $this->db->get('jurnal')->result();
		// $hasil = $this->db->get_where("jurnal", array('kd_transaksi' => 'A-'.$kode))->result();
		return $hasil;
	}
	function updateData()
	{
		$this->kd_data = $this->input->post('kd_aset');
		$this->tgl_perolehan = $this->input->post('tgl_perolehan');
		$this->sumber_dana = $this->input->post('sumber_dana');
		$this->nilai_aset = $this->input->post('nilai_aset');
		$this->jenis_aset = $this->input->post('jenis_aset');   
		$data = array(
			'tgl_perolehan' => $this->tgl_perolehan,
			'sumber_dana' => $this->sumber_dana,
			'nilai_aset' => $this->nilai_aset,
			'jenis_aset' => $this->jenis_aset,
		);
		$this->db->where('kd_aset', $this->kd_data);
		$hasil = $this->db->update("aset", $data);
		$this->kd_transaksi = 'A-'.$this->kd_data;
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
		$this->getKetDetail($this->sumber_dana,$this->nilai_aset);
		$data = array(
			//aktiva
			array(
				'id' => $id[0],
			   'tgl' => $this->tgl_perolehan ,
			   'kd_akun' => $this->nilai_aset ,
			   'keterangan' => 'Pindah buku dari '.$this->nama_akunA.' ke Akun '.$this->nama_akunB,
			   'debit' => $this->jenis_aset,
			   'kredit' => 0,
			   'status' => 0,
			   'kd_transaksi' => $kd_transaksi
			),
			//pasiva
			array(
				'id' => $id[1],
				'tgl' => $this->tgl_perolehan ,
				'kd_akun' => $this->sumber_dana ,
				'keterangan' => 'Pindah buku dari '.$this->nama_akunA.' ke Akun '.$this->nama_akunB,
				'debit' => 0,
				'kredit' => $this->jenis_aset,
				'status' => 0,
			   	'kd_transaksi' => $kd_transaksi
			)
		);
		return $this->db->update_batch('jurnal', $data , 'id'); 
	}
	function deleteData($kode)
	{
		// $this->_deleteImage($kode);
		$this->db->where('kd_aset', $kode);
		$hasil = $this->db->delete("aset");
		$this->deleteJurnal('A-'.$kode);
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
