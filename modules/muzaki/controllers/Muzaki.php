<?php

(defined('BASEPATH')) or exit('No direct script access allowed');

class Muzaki extends MY_Controller{

    function __construct()
    {
        parent::__construct();
		$this->load->model('muzaki_model');
		if($this->session->userdata('id_user') == TRUE){
            redirect('auth');
        }
    }
    function index()
    {
        $this->load->view('index');
	}

    function getData(){
		$data=$this->muzaki_model->getData();
		echo json_encode($data);
	}

	function setData(){
		$data = array ('success' => false, 'messages' => array());
		$this->form_validation->set_rules('nama_muzaki','Nama', 'required|trim|strip_tags');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = form_error($key);
			}   
		}else{
			$data['success'] = true;
			$this->muzaki_model->setData();	
		}
		echo json_encode($data);
	}
	function getDataByKode()
	{
		$kode = $this->input->get('id');
		$data = $this->muzaki_model->getDataByKode($kode);
		echo json_encode($data);
	}

	function updateData(){
		$data = array ('success' => false, 'messages' => array());
		$this->form_validation->set_rules('nama_muzaki', 'Nama', 'required|trim|strip_tags');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = form_error($key);
			}   
		}else{
			$data['success'] = true;
			$this->muzaki_model->updateData();	
		}
		echo json_encode($data);
	}

	function deleteData(){
		$kode=$this->input->post('kode');
		$data=$this->muzaki_model->deleteData($kode);
		echo json_encode($data);
	}

}

