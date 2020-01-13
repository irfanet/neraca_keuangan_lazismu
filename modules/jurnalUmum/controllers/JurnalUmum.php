<?php

(defined('BASEPATH')) or exit('No direct script access allowed');

class JurnalUmum extends MY_Controller{

    function __construct()
    {
        parent::__construct();
		$this->load->model('jurnalUmum_model');
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
		$data=$this->jurnalUmum_model->getData();
		echo json_encode($data);
	}

	function setData(){
		$data = array ('success' => false, 'messages' => array());
		$this->form_validation->set_rules('nominal','Nominal', 'required|trim|strip_tags');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = form_error($key);
			}   
		}else{
			$data['success'] = true;
			$this->jurnalUmum_model->setData();	
		}
		echo json_encode($data);
	}

	function getDataByKode()
	{
		$kode = $this->input->get('id');
		$data = $this->jurnalUmum_model->getDataByKode($kode);
		echo json_encode($data);
	}

	function updateData(){
		$data = array ('success' => false, 'messages' => array());
		$this->form_validation->set_rules('nominal', 'Nominal', 'required|trim|strip_tags');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = form_error($key);
			}   
		}else{
			$data['success'] = true;
			$this->jurnalUmum_model->updateData();	
		}
		echo json_encode($data);
	}

	function deleteData(){
		$kode=$this->input->post('kode');
		$data=$this->jurnalUmum_model->deleteData($kode);
		echo json_encode($data);
	}

	function postJurnal(){
		$data = array ('success' => false, 'messages' => array());
		$this->form_validation->set_rules('jml_data', 'Jumlah Data', 'required|trim');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = form_error($key);
			}   
		}else{
			$data['success'] = true;
			$this->jurnalUmum_model->postJurnal();	
		}
		echo json_encode($data);
	}

	function getDetailByKode()
	{
		$kode = $this->input->get('id');
		$data = $this->jurnalUmum_model->getDetailByKode($kode);
		echo json_encode($data);
	}

	function getMuzaki(){
		$data=$this->jurnalUmum_model->getMuzaki();
		echo json_encode($data);
	}

	function getCash(){
		$data=$this->jurnalUmum_model->getCash();
		echo json_encode($data);
	
	}
	function getBank(){
		$data=$this->jurnalUmum_model->getBank();
		echo json_encode($data);
	}

	function getAsetLancar(){
		$data=$this->jurnalUmum_model->getAsetLancar();
		echo json_encode($data);
	}

	function getLiabilitas(){
		$data=$this->jurnalUmum_model->getLiabilitas();
		echo json_encode($data);
	}
}

