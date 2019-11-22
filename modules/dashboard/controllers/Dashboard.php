<?php

(defined('BASEPATH')) or exit('No direct script access allowed');

class Dashboard extends MY_Controller{

    function __construct()
    {
        parent::__construct();
		$this->load->library('Pdf');
		$this->load->model('dashboard_model');
		if($this->session->userdata('id_user') == TRUE){
            redirect('auth');
        }
    }

    function index_awal()
    {
		$data['pegawai_aktif'] = $this->dashboard_model->get_aktif();
		$data['pegawai_non_aktif'] = $this->dashboard_model->get_non_aktif();
		$data['hari_kerja'] = $this->dashboard_model->get_hari_kerja();
		$data['honor'] = $this->dashboard_model->get_honor();
		$data['aktif_dep'] = $this->dashboard_model->get_aktif_dep();
        $this->load->template('dashboard', $data);
	}

    function index()
    {
		$data['pegawai_aktif'] = $this->dashboard_model->get_aktif();
		$data['pegawai_non_aktif'] = $this->dashboard_model->get_non_aktif();
		$data['hari_kerja'] = $this->dashboard_model->get_hari_kerja();
		$data['honor'] = $this->dashboard_model->get_honor();
		$data['aktif_dep'] = $this->dashboard_model->get_aktif_dep();
        $this->load->view('dashboard', $data);
	}

    function get_data(){
		$data=$this->dashboard_model->data_list();
		echo json_encode($data);
	}

	function get_kode(){
		$kode=$this->input->get('id');
		$data=$this->dashboard_model->get_data_by_kode($kode);
		echo json_encode($data);
	}

	function simpan_data(){
		$data = array ('success' => false, 'messages' => array());
		$this->form_validation->set_rules('kode_bagian','Kode Bagian', 'required|trim|strip_tags|is_unique[bagian.kode_bagian]'
		,[
            'is_unique' => 'Kode bagian tidak boleh sama!'
        ]);
		$this->form_validation->set_rules('nama_bagian','Nama Bagian', 'required|trim|strip_tags');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = form_error($key);
			}   
		}else{
			$data['success'] = true;
			$this->dashboard_model->simpan_data();	
		}
		echo json_encode($data);
	}

	function update_data(){
		$data = array ('success' => false, 'messages' => array());
		$this->form_validation->set_rules('nama_bagian', 'Nama bagian', 'required|trim');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = form_error($key);
			}   
		}else{
			$data['success'] = true;
			$this->dashboard_model->update_data();	
		}
		echo json_encode($data);
	}

	function hapus_data(){
		$kode=$this->input->post('kode');
		$data=$this->dashboard_model->hapus_data($kode);
		echo json_encode($data);
	}

	function form_upload(){
		$this->load->view('import');
	}
	
	function import_excel(){
		error_reporting(E_ALL ^ E_NOTICE);
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
        $upload = $this->dashboard_model->upload_file($this->filename);
        if ($upload['result'] == 'failed') {
          $data['upload_error'] = $upload['error'];
        }
        $excelreader =  new PHPExcel_Reader_Excel5();
        $loadexcel = $excelreader->load('upload/excel/'.$this->filename.'.xls'); 
        $sheet = $loadexcel->getActiveSheet()->getRowIterator();

	
        $data = array();
        
        $numrow = 0;
        foreach($sheet as $row){
        //    if ($numrow>0){
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false); 
            
            $get = array(); 
            foreach ($cellIterator as $cell) {
            	array_push($get, $cell->getValue()); 
            }           
            array_push($data, array(
                'kode_bagian'=>$get[0], 
                'nama_bagian'=>$get[1],
            	));
            }        
          $numrow++; 
        // }
      
        $this->dashboard_model->insert_multiple($data);
        $this->session->set_flashdata('flash','Pegawai Berhasil ditambahkan');
        redirect("bagian");
    }

}

