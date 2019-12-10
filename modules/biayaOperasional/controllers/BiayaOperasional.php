<?php

(defined('BASEPATH')) or exit('No direct script access allowed');

class BiayaOperasional extends MY_Controller{

    function __construct()
    {
        parent::__construct();
		$this->load->model('biayaOperasional_model');
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
		$data=$this->biayaOperasional_model->getData();
		echo json_encode($data);
	}

	function setData(){
		$data = array ('success' => false, 'messages' => array());
		$this->form_validation->set_rules('jumlah_dana','Jumlah Dana', 'required|trim|strip_tags');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = form_error($key);
			}   
		}else{
			$data['success'] = true;
			$this->biayaOperasional_model->setData();	
		}
		echo json_encode($data);
	}

	function getDataByKode()
	{
		$kode = $this->input->get('id');
		$data = $this->biayaOperasional_model->getDataByKode($kode);
		echo json_encode($data);
	}

	function updateData(){
		$data = array ('success' => false, 'messages' => array());
		$this->form_validation->set_rules('jumlah_dana', 'Jumlah Dana', 'required|trim|strip_tags');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = form_error($key);
			}   
		}else{
			$data['success'] = true;
			$this->biayaOperasional_model->updateData();	
		}
		echo json_encode($data);
	}

	function deleteData(){
		$kode=$this->input->post('kode');
		$data=$this->biayaOperasional_model->deleteData($kode);
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
			$this->biayaOperasional_model->postJurnal();	
		}
		echo json_encode($data);
	}

	function getDetailByKode()
	{
		$kode = $this->input->get('id');
		$data = $this->biayaOperasional_model->getDetailByKode($kode);
		echo json_encode($data);
	}

	function getMuzaki(){
		$data=$this->biayaOperasional_model->getMuzaki();
		echo json_encode($data);
	}

	function getKasAktiva(){
		$data=$this->biayaOperasional_model->getKasAktiva();
		echo json_encode($data);
	
	}
	function getBankAktiva(){
		$data=$this->biayaOperasional_model->getBankAktiva();
		echo json_encode($data);
	}

	function getDanaPasiva(){
		$data=$this->biayaOperasional_model->getDanaPasiva();
		echo json_encode($data);
	}
}

