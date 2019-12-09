<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Penyaluran_model extends CI_Model
{
	public $kd_data;
	public $tgl_penyaluran;
	public $kd_mustahik;
	public $asnaf;
	public $keterangan;
	public $sumber_dana;
	public $jenis_dana;
	public $jumlah_dana;
	public $program;
	public $kd_transaksi;

	public $nama;
	public $jenis_mustahik;
	public $nama_akunA;
	public $nama_akunP;
	public $nama_program;
	public $jenis_pembayaran;

	function __construct()
	{
		parent::__construct();
	}

	function getData()
	{
		$hasil = $this->db->get('penyaluran');
		return $hasil->result();
	}
	function setData()
	{
		// $this->kd_data = uniqid();

		$this->tgl_penyaluran = $this->input->post('tgl_penyaluran');
		$this->kd_mustahik = $this->input->post('kd_mustahik');
		$this->asnaf = $this->input->post('asnaf');
		$this->program = $this->input->post('program');
		$this->keterangan = $this->input->post('keterangan');
		$this->sumber_dana = $this->input->post('sumber_dana');
		$this->jenis_dana = $this->input->post('jenis_dana');
		$this->jumlah_dana = $this->input->post('jumlah_dana');
		$data = array(
			// 'kd_penyaluran' => $this->kd_data,
			'tgl_penyaluran' => $this->tgl_penyaluran,
			'kd_mustahik' => $this->kd_mustahik,
			'asnaf' => $this->asnaf,
			'program' => $this->program,
			'keterangan' => $this->keterangan,
			'sumber_dana' => $this->sumber_dana,
			'jenis_dana' => $this->jenis_dana,
			'jumlah_dana' => $this->jumlah_dana,
		);
		$hasil = $this->db->insert("penyaluran", $data);
		$this->kd_data = $this->db->insert_id(); // get last auto increment
		$this->kd_transaksi = 'P-'.$this->kd_data;
		$this->setJurnal($this->kd_transaksi);
		return $hasil;
	}
	function setJurnal($kd_transaksi){
		$this->getKetDetail($this->kd_mustahik,$this->jenis_dana,$this->sumber_dana,$this->program);
		$data = array(
			//pasiva
			array(
			   'tgl' => $this->tgl_penyaluran ,
			   'kd_akun' => $this->sumber_dana ,
			   'keterangan' => 'Penyaluran Dana untuk '.$this->nama.' ('. $this->jenis_mustahik.') secara '.$this->jenis_pembayaran. ' dari '.$this->nama_akunA.' , jenis dana '.$this->nama_akunP,
			   'debit' => $this->input->post('jumlah_dana'),
			   'kredit' => 0,
			   'status' => 0,
			   'kd_transaksi' => $kd_transaksi
			),
			//aktiva
			array(
				'tgl' => $this->tgl_penyaluran ,
				'kd_akun' => $this->jenis_dana ,
				'keterangan' => 'Penyaluran Dana untuk '.$this->nama.' ('. $this->jenis_mustahik.') secara '.$this->jenis_pembayaran. ' dari '.$this->nama_akunA.' , jenis dana '.$this->nama_akunP,
				'debit' => 0,
				'kredit' => $this->input->post('jumlah_dana'),
				'status' => 0,
			   	'kd_transaksi' => $kd_transaksi
			)
		);
		return $this->db->insert_batch('jurnal', $data); 
	}

	function getKetDetail($kd_mustahik,$kd_akunA,$kd_akunP,$kd_program){
		$mustahik = $this->db->get_where("mustahik", array('no_registrasi' => $kd_mustahik))->row_array();
		$ibnu_sabil = $this->db->get_where("mustahik_khusus", array('kd_mustahik_khusus' => $kd_mustahik))->row_array();
		if($mustahik){
			$this->nama = $mustahik['nama'];
			$this->jenis_mustahik = 'Mustahik';
		}else{
			$this->nama = $ibnu_sabil['nama'];
			$this->jenis_mustahik = 'Ibnu Sabil';
		}
		$aktiva = $this->db->get_where("akun", array('kd_akun' => $kd_akunA))->row_array();
		$this->nama_akunA = $aktiva['nama_akun'];
		$pasiva = $this->db->get_where("akun", array('kd_akun' => $kd_akunP))->row_array();
		$this->nama_akunP = $pasiva['nama_akun'];
		$program = $this->db->get_where("tb_program", array('kd_program' => $kd_program))->row_array();
		$this->nama_program = $program['nama'];
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
	
	function getMustahik()
	{
		$hasil = $this->db->query("SELECT * FROM mustahik")->result();
		return $hasil;
	}
	function getIbnuSabil()
	{
		$hasil = $this->db->get('mustahik_khusus')->result();
		return $hasil;
	}
	function getProgram()
	{
		$hasil = $this->db->get('tb_program')->result();
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
		$hasil = $this->db->get_where("penyaluran", array('kd_penyaluran' => $kode))->row();
		return $hasil;
	}
	function getDetailByKode($kode)
	{
		$hasil = $this->db->get_where("jurnal", array('kd_transaksi' => 'P-'.$kode))->result();
		return $hasil;
	}
	function updateData()
	{
		$this->kd_data = $this->input->post('kd_penyaluran');
		$this->tgl_penyaluran = $this->input->post('tgl_penyaluran');
		$this->kd_mustahik = $this->input->post('kd_mustahik');
		$this->asnaf = $this->input->post('asnaf');
		$this->program = $this->input->post('program');
		$this->keterangan = $this->input->post('keterangan');
		$this->sumber_dana = $this->input->post('sumber_dana');
		$this->jenis_dana = $this->input->post('jenis_dana');
		$this->jumlah_dana = $this->input->post('jumlah_dana');   
		$data = array(
			'tgl_penyaluran' => $this->tgl_penyaluran,
			'kd_mustahik' => $this->kd_mustahik,
			'asnaf' => $this->asnaf,
			'program' => $this->program,
			'keterangan' => $this->keterangan,
			'sumber_dana' => $this->sumber_dana,
			'jenis_dana' => $this->jenis_dana,
			'jumlah_dana' => $this->jumlah_dana,
		);
		$this->db->where('kd_penyaluran', $this->kd_data);
		$hasil = $this->db->update("penyaluran", $data);
		$this->kd_transaksi = 'P-'.$this->kd_data;
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
		$this->getKetDetail($this->kd_mustahik,$this->jenis_dana,$this->sumber_dana,$this->program);
		$data = array(
			//pasiva
			array(
				'id' => $id[0],
			   'tgl' => $this->tgl_penyaluran ,
			   'kd_akun' => $this->sumber_dana ,
			   'keterangan' => 'Penyaluran Dana untuk '.$this->nama.' ('. $this->jenis_mustahik.') secara '.$this->jenis_pembayaran. ' dari '.$this->nama_akunA.' , jenis dana '.$this->nama_akunP,
			   'debit' => $this->input->post('jumlah_dana'),
			   'kredit' => 0,
			   'status' => 0,
			   'kd_transaksi' => $kd_transaksi
			),
			//aktiva
			array(
				'id' => $id[1],
				'tgl' => $this->tgl_penyaluran ,
				'kd_akun' => $this->jenis_dana ,
				'keterangan' => 'Penyaluran Dana untuk '.$this->nama.' ('. $this->jenis_mustahik.') secara '.$this->jenis_pembayaran. ' dari '.$this->nama_akunA.' , jenis dana '.$this->nama_akunP,
				'debit' => 0,
				'kredit' => $this->input->post('jumlah_dana'),
				'status' => 0,
			   	'kd_transaksi' => $kd_transaksi
			)
		);
		return $this->db->update_batch('jurnal', $data , 'id'); 
	}
	function deleteData($kode)
	{
		// $this->_deleteImage($kode);
		$this->db->where('kd_penyaluran', $kode);
		$hasil = $this->db->delete("penyaluran");
		$this->deleteJurnal('P-'.$kode);
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
