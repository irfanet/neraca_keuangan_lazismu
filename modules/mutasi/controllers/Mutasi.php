<?php

(defined('BASEPATH')) or exit('No direct script access allowed');

class Mutasi extends MY_Controller{

    function __construct()
    {
        parent::__construct();
		$this->load->model('mutasi_model');
		if($this->session->userdata('id_admin') != TRUE){
            redirect('auth');
        }
	}
	
    function index()
    {
        $this->load->view('index');
	}

    function getData(){
		$data=$this->mutasi_model->getData();
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
			$this->mutasi_model->setData();	
		}
		echo json_encode($data);
	}

	function getDataByKode()
	{
		$kode = $this->input->get('id');
		$data = $this->mutasi_model->getDataByKode($kode);
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
			$this->mutasi_model->updateData();	
		}
		echo json_encode($data);
	}

	function deleteData(){
		$kode=$this->input->post('kode');
		$data=$this->mutasi_model->deleteData($kode);
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
			$this->mutasi_model->postJurnal();	
		}
		echo json_encode($data);
	}

	function getDetailByKode()
	{
		$kode = $this->input->get('id');
		$data = $this->mutasi_model->getDetailByKode($kode);
		echo json_encode($data);
	}

	function getMuzaki(){
		$data=$this->mutasi_model->getMuzaki();
		echo json_encode($data);
	}

	function getCash(){
		$data=$this->mutasi_model->getCash();
		echo json_encode($data);
	
	}
	function getBank(){
		$data=$this->mutasi_model->getBank();
		echo json_encode($data);
	}

	function getAsetLancar(){
		$data=$this->mutasi_model->getAsetLancar();
		echo json_encode($data);
	}
}

