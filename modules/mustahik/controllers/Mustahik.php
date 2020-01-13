<?php

(defined('BASEPATH')) or exit('No direct script access allowed');

class Mustahik extends MY_Controller{

	private $filename = "Data_mustahik";
    function __construct()
    {
        parent::__construct();
		$this->load->model('mustahik_model');
		if($this->session->userdata('id_user') != TRUE){
			redirect('auth');
        }
	}
	
    function index()
    {
		$data['penghasilan'] = $this->getDataStatis('penghasilan');
		$data['detail_pengajuan'] = $this->getDataStatis('detail_pengajuan');
		$data['pendidikan'] =  $this->getDataStatis('pendidikan');
		$data['pekerjaan'] =  $this->getDataStatis('pekerjaan');
        $this->load->view('index',$data);
	}
	function index_awal()
    {
		$data['penghasilan'] = $this->getDataStatis('penghasilan');
		$data['detail_pengajuan'] = $this->getDataStatis('detail_pengajuan');
		$data['pendidikan'] =  $this->getDataStatis('pendidikan');
		$data['pekerjaan'] =  $this->getDataStatis('pekerjaan');
        $this->load->template("index", $data);
	}
    function getData(){
		$data=$this->mustahik_model->getData();
		echo json_encode($data);
	}

	function setData(){
		$data = array ('success' => false, 'messages' => array());
		$this->form_validation->set_rules('nama','Nama', 'required|trim|strip_tags');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = form_error($key);
			}   
		}else{
			$data['success'] = true;
			$this->mustahik_model->setData();	
		}
		echo json_encode($data);
	}
	function getDataByKode()
	{
		$kode = $this->input->get('id');
		$data = $this->mustahik_model->getDataByKode($kode);
		echo json_encode($data);
	}

	function updateData(){
		$data = array ('success' => false, 'messages' => array());
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim|strip_tags');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = form_error($key);
			}   
		}else{
			$data['success'] = true;
			$this->mustahik_model->updateData();	
		}
		echo json_encode($data);
	}

	function deleteData(){
		$kode=$this->input->post('kode');
		$data=$this->mustahik_model->deleteData($kode);
		echo json_encode($data);
	}

	function getDataStatis($data){
		if($data == 'penghasilan'){
			$data = [
				'Tidak berpenghasilan',
				'0 - 500rb',
				'500rb - 1jt',
				'1jt - 1,5jt',
				'1,5jt - 2jt',
				'2jt - 2,5jt',
				'2,5jt - 3jt',
				'3jt lebih'];
		}
		if($data == 'detail_pengajuan'){
			$data = [
				'Bantuan Makan',
				'Biaya Pendidikan',
				'Biaya Berobat',
				'Modal Usaha',
				'Pelunasan Hutang',
				'Benah Rumah',
				'Bedah Rumah',
				'Biaya Perjalanan Pulang',
				'Kegiatan Dakwah',
				'Pengadaan Sarana Umum',
				'Lain-lain'
			];
		}
		if($data == 'pendidikan'){
			$data = [
				'SD',
				'SMP',
				'SMA/SMK',
				'Diploma/Sederajat',
				'Lain'
			];
		}
		if($data =='pekerjaan'){
			$data = [
				'Tidak bekerja',
				'PNS',
				'Petani',
				'Ibu Rumah Tangga',
				'Pelajar',
				'Karyawan BUMN',
				'Peternak',
				'Karyawan Swasta',
				'TNI/Polisi',
				'Nelayan',
				'Lain-lain'
			];
		}

		return $data;
	}

	function importData(){
		include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

		$data = array ('success' => false, 'messages' => array());
		$this->form_validation->set_rules('dummy', 'Dummy', 'required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = form_error($key);
			}   
		}else{
			$data['success'] = true;
			
			error_reporting(E_ALL ^ E_NOTICE);
			$sql = "DELETE FROM mustahik";
			$this->db->query($sql);

			$upload = $this->mustahik_model->uploadExcel($this->filename);
			if ($upload['result'] == 'failed') {
			  $excel['upload_error'] = $upload['error'];
			}

			// XLSX
			$excelreader = PHPExcel_IOFactory::createReader("Excel2007");
			$loadexcel = $excelreader->load('assets/uploads/excel/'.$this->filename.'.xlsx'); 
	
			//XLS
			// $excelreader =  new PHPExcel_Reader_Excel5();
			// $loadexcel = $excelreader->load('upload/excel/'.$this->filename.'.xlsx'); 
			$sheet = $loadexcel->getActiveSheet()->getRowIterator();
			 
			$excel = array();
	
			$numrow = 0;
			foreach($sheet as $row){
			   if ($numrow>1){
				$cellIterator = $row->getCellIterator();
				$cellIterator->setIterateOnlyExistingCells(false); 
				
				$get = array(); 
				foreach ($cellIterator as $cell) {
					array_push($get, $cell->getValue()); 
				}           
						
				array_push($excel, array(
					'nik'=>$get[1], 
					'nama'=> $get[2],
					'alamat'=>$get[3],
					'detail_pengajuan'=>$get[7],
					));
				}
			  $numrow++; 
			}
		  
			$this->mustahik_model->insert_multiple($excel);
		}
		echo json_encode($data);
	}


}

