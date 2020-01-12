<?php

(defined('BASEPATH')) or exit('No direct script access allowed');

class B2 extends MY_Controller{

    function __construct()
    {
        parent::__construct();
		$this->load->model('b2_model');
		if($this->session->userdata('id_user') != TRUE){
            redirect('auth');
        }
    }
    function index()
    {
		// $data['penghasilan'] = $this->getDataStatis('data_keluarga');
        $this->load->view('form_b2');
	}
	
	function index_awal()
    {
        $this->load->template('form_b2');
	}

    function getData(){
		$data=$this->b2_model->getData();
		echo json_encode($data);
	}

	function check_default($post_string)
	{
		return $post_string == '0' ? FALSE : TRUE;
	}

	function setData(){
		$data = array ('success' => false, 'messages' => array());
		$this->form_validation->set_rules('no_registrasi','No Registrasi', 'required|callback_check_default');
		$this->form_validation->set_message('check_default', 'You need to select something other than the default');
		$this->form_validation->set_rules('tgl','Tanggal', 'required');
		$this->form_validation->set_rules('petugas_survey','Petugas Survey', 'required');
		$this->form_validation->set_rules('jumlah_tanggungan_keluarga','Jumlah Tanggungan Keluarga', 'required');
		$this->form_validation->set_rules('jumlah_anak_yg_masih_sekolah','Jumlah Anak yg Masih Sekolah', 'required');
		$this->form_validation->set_rules('jumlah_anak_yg_putus_sekolah','Jumlah Anak yg Putus Sekolah', 'required');
		$this->form_validation->set_rules('jumlah_pengeluaran_bulanan','Jumlah Pengeluaran Bulanan', 'required');
		$this->form_validation->set_rules('obat_rutin_anggota_keluarga_yg_sakit','Obat Rutin Anggota Keluarga yg Sakit', 'required');
		$this->form_validation->set_rules('biaya_pendidikan_yg_ditanggung','Biaya Pendidikan yg Ditanggung', 'required');
		$this->form_validation->set_rules('riwayat_hutang_berjalan','Riwayat Hutang Berjalan', 'required');
		$this->form_validation->set_rules('keperluan_hutang','Keperluan Hutang', 'required');
		// $this->form_validation->set_rules('pekerjaan_kepala_keluarga','Jumlah Tanggungan Keluarga', 'required');
		// $this->form_validation->set_rules('merokok','Jumlah Tanggungan Keluarga', 'required');
		// $this->form_validation->set_rules('pekerjaan_suami_istri','Jumlah Tanggungan Keluarga', 'required');
		// $this->form_validation->set_rules('usia_mustahik','Jumlah Tanggungan Keluarga', 'required');
		// $this->form_validation->set_rules('kondisi_kepala_keluarga','Jumlah Tanggungan Keluarga', 'required');
		// $this->form_validation->set_rules('kepemilikan_rumah','Jumlah Tanggungan Keluarga', 'required');
		// $this->form_validation->set_rules('luas_rumah','Jumlah Tanggungan Keluarga', 'required');
		// $this->form_validation->set_rules('dinding_rumah','Jumlah Tanggungan Keluarga', 'required');
		// $this->form_validation->set_rules('lantai','Jumlah Tanggungan Keluarga', 'required');
		// $this->form_validation->set_rules('atap','Jumlah Tanggungan Keluarga', 'required');
		// $this->form_validation->set_rules('sumber_air_minum','Jumlah Tanggungan Keluarga', 'required');
		// $this->form_validation->set_rules('mck','Jumlah Tanggungan Keluarga', 'required');
		// $this->form_validation->set_rules('penerangan','Jumlah Tanggungan Keluarga', 'required');
		// $this->form_validation->set_rules('daya_terpasang','Jumlah Tanggungan Keluarga', 'required');
		// $this->form_validation->set_rules('kelayakan_tidur','Jumlah Tanggungan Keluarga', 'required');
		$this->form_validation->set_rules('barang_elektronik_yg_dimiliki','Jumlah Tanggungan Keluarga', 'required');
		// $this->form_validation->set_rules('jumlah_makan_perhari','Jumlah Tanggungan Keluarga', 'required');
		// $this->form_validation->set_rules('ayam','Jumlah Tanggungan Keluarga', 'required');
		// $this->form_validation->set_rules('daging','Jumlah Tanggungan Keluarga', 'required');
		// $this->form_validation->set_rules('susu','Jumlah Tanggungan Keluarga', 'required');
		// $this->form_validation->set_rules('belanja_harian','Jumlah Tanggungan Keluarga', 'required');
		// $this->form_validation->set_rules('aset_tidak_bergerak_sawah_pekarangan','Jumlah Tanggungan Keluarga', 'required');
		// $this->form_validation->set_rules('aset_bergerak','Jumlah Tanggungan Keluarga', 'required');
		$this->form_validation->set_rules('status_bantuan_dari_lembaga_lain','Jumlah Tanggungan Keluarga', 'required');
		$this->form_validation->set_rules('catatan_tambahan','Catatan Tambahan', 'required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = form_error($key);
			}   
		}else{
			$data['success'] = true;
			$this->b2_model->setData();	
		}
		echo json_encode($data);
	}
	function getDataByKode()
	{
		$kode = $this->input->get('id');
		$data = $this->b2_model->getDataByKode($kode);
		echo json_encode($data);
	}

	function updateData(){
		$data = array ('success' => false, 'messages' => array());
		$this->form_validation->set_rules('no_registrasi', 'No Registrasi', 'required|trim|strip_tags');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = form_error($key);
			}   
		}else{
			$data['success'] = true;
			$this->b2_model->updateData();	
		}
		echo json_encode($data);
	}

	function deleteData(){
		$kode=$this->input->post('kode');
		$data=$this->b2_model->deleteData($kode);
		echo json_encode($data);
	}

	function getMustahik(){
		if($this->session->userdata('status')!='admin'){
			$this->db->select('*');    
			$this->db->from('mustahik');
			$this->db->where('sekolah',$this->session->userdata('sekolah'));
			$this->db->where('status_survey',0);
			$hasil = $this->db->get();
		}else{
			$this->db->select('*');   
			$this->db->from('mustahik');
			$this->db->where('status_survey',0);
			$hasil = $this->db->get();				
		}
		echo json_encode($hasil->result());
	}

	function getField($id){
		$this->db->from('tb_b2_2');
		$this->db->where('kategori',$id);
		$hasil = $this->db->get();
		echo json_encode($hasil->result());
	}

	function getKetField($id)
	{
		$hasil = $this->db->get_where('tb_b2_2', ['kd_data' => $id])->row_array();
		echo json_encode($hasil);
	}

	function getRadio($data,$id)
	{
		$this->db->from($data);
		$this->db->where('kategori',$id);
		$hasil = $this->db->get();
		echo json_encode($hasil->result());
	}

	function getScore(){
		$kode = $this->input->get('id');
		$this->db->select('*');    
		$this->db->from('mustahik_b2 a');
		$this->db->join("tb_kd_3 b", "a.no_registrasi = b.no_mustahik");
		$hasil = $this->db->get();
		return $hasil->result();
	}

	function getNilai($id){
		$n = $this->db->get_where("tb_b2_3", array('kd_data' => $id))->row_array();
		$nilai = $n['nilai'];
		return $nilai;
	}


}

