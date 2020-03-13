<?php

(defined('BASEPATH')) or exit('No direct script access allowed');

class MustahikKhusus extends MY_Controller{

	private $filename = "Data_ibnu_sabil";
    function __construct()
    {
        parent::__construct();
		$this->load->model('mustahikKhusus_model');
		if($this->session->userdata('id_user') != TRUE){
            redirect('auth');
		}
		if($this->session->userdata('status') != 'admin'){
            redirect('auth');
		}
    }
    function index()
    {
        $this->load->view('index');
	}

    function getData(){
		$data=$this->mustahikKhusus_model->getData();
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
			$this->mustahikKhusus_model->setData();	
		}
		echo json_encode($data);
	}
	function getDataByKode()
	{
		$kode = $this->input->get('id');
		$data = $this->mustahikKhusus_model->getDataByKode($kode);
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
			$this->mustahikKhusus_model->updateData();	
		}
		echo json_encode($data);
	}

	function deleteData(){
		$kode=$this->input->post('kode');
		$data=$this->mustahikKhusus_model->deleteData($kode);
		echo json_encode($data);
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
			$sql = "DELETE FROM mustahik_khusus";
			$this->db->query($sql);

			$upload = $this->mustahikKhusus_model->uploadExcel($this->filename);
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
					// 'nik'=>$get[1], 
					'nama'=> $get[2],
					'alamat'=>$get[3],
					'foto' => 'default.jpg'
					));
				}
			  $numrow++; 
			}
		  
			$this->mustahikKhusus_model->insert_multiple($excel);
		}
		echo json_encode($data);
	}

}

