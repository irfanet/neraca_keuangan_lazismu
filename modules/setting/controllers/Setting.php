<?php

(defined('BASEPATH')) or exit('No direct script access allowed');

class Setting extends MY_Controller{

    function __construct()
    {
        parent::__construct();
		$this->load->model('setting_model');
		if($this->session->userdata('id_user') == TRUE){
            redirect('auth');
        }
    }

    function index_awal()
    {
        $this->load->template('jurnal');
	}

    function index()
    {
        $this->load->view('kd3');
	}
	function viewSegmen1(){
        $this->load->view('kd1');
	}
	function viewSegmen2(){
        $this->load->view('kd2');
	}
	function viewSegmen3(){
        $this->load->view('kd3');
	}
	function viewSegmen4(){
        $this->load->view('kd4');
	}

    function getSegmen1(){
		$data=$this->setting_model->getSegmen1();
		echo json_encode($data);
	}

	function setSegmen1(){
		$data = array ('success' => false, 'messages' => array());
		$this->form_validation->set_rules('kd_1','Kode', 'required|trim|strip_tags|is_unique[tb_kd_1.kd_1]'
		,[
            'is_unique' => 'Kode tidak boleh sama!'
        ]);
		$this->form_validation->set_rules('nama','Nama', 'required|trim|strip_tags');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = form_error($key);
			}   
		}else{
			$data['success'] = true;
			$this->setting_model->setSegmen1();	
		}
		echo json_encode($data);
	}
	function getDataByKode1()
	{
		$kode = $this->input->get('id');
		$data = $this->setting_model->getDataByKode1($kode);
		echo json_encode($data);
	}

	function updateSegmen1(){
		$data = array ('success' => false, 'messages' => array());
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = form_error($key);
			}   
		}else{
			$data['success'] = true;
			$this->setting_model->updateSegmen1();	
		}
		echo json_encode($data);
	}

	function deleteSegmen1(){
		$kode=$this->input->post('kode');
		$data=$this->setting_model->deleteSegmen1($kode);
		echo json_encode($data);
	}

	//Segemen 2
	function getSegmen2(){
		$data=$this->setting_model->getSegmen2();
		echo json_encode($data);
	}

	function setSegmen2(){
		$data = array ('success' => false, 'messages' => array());
		$this->form_validation->set_rules('kd_2','Kode', 'required|trim|strip_tags');
		$this->form_validation->set_rules('nama','Nama', 'required|trim|strip_tags');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = form_error($key);
			}   
		}else{
			$data['success'] = true;
			$this->setting_model->setSegmen2();	
		}
		echo json_encode($data);
	}
	function getDataByKode2()
	{
		$kode = $this->input->get('id');
		$data = $this->setting_model->getDataByKode2($kode);
		echo json_encode($data);
	}

	function updateSegmen2(){
		$data = array ('success' => false, 'messages' => array());
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = form_error($key);
			}   
		}else{
			$data['success'] = true;
			$this->setting_model->updateSegmen2();	
		}
		echo json_encode($data);
	}

	function deleteSegmen2(){
		$kode=$this->input->post('kode');
		$data=$this->setting_model->deleteSegmen2($kode);
		echo json_encode($data);
	}

	//Segemen 3
	function getSegmen3(){
		$data=$this->setting_model->getSegmen3();
		echo json_encode($data);
	}

	function setSegmen3(){
		$data = array ('success' => false, 'messages' => array());
		$this->form_validation->set_rules('kd_3','Kode', 'required|trim|strip_tags');
		$this->form_validation->set_rules('nama','Nama', 'required|trim|strip_tags');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = form_error($key);
			}   
		}else{
			$data['success'] = true;
			$this->setting_model->setSegmen3();	
		}
		echo json_encode($data);
	}
	function getDataByKode3()
	{
		$kode = $this->input->get('id');
		$data = $this->setting_model->getDataByKode3($kode);
		echo json_encode($data);
	}

	function updateSegmen3(){
		$data = array ('success' => false, 'messages' => array());
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = form_error($key);
			}   
		}else{
			$data['success'] = true;
			$this->setting_model->updateSegmen3();	
		}
		echo json_encode($data);
	}

	function deleteSegmen3(){
		$kode=$this->input->post('kode');
		$data=$this->setting_model->deleteSegmen3($kode);
		echo json_encode($data);
	}

	public function getSegmenById1(){
        $id=$this->input->post('id_1');
        $data=$this->setting_model->getSegmenById1($id);
        echo json_encode($data);
	}

	public function getSegmenById2(){
        $id=$this->input->post('id_2');
        $data=$this->setting_model->getSegmenById2($id);
        echo json_encode($data);
	}

	//Segmen 4
	function getSegmen4(){
		$data=$this->setting_model->getSegmen4();
		echo json_encode($data);
	}

	function setSegmen4(){
		$data = array ('success' => false, 'messages' => array());
		$this->form_validation->set_rules('kd_4','Kode', 'required|trim|strip_tags');
		$this->form_validation->set_rules('nama','Nama', 'required|trim|strip_tags');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = form_error($key);
			}   
		}else{
			$data['success'] = true;
			$this->setting_model->setSegmen4();	
		}
		echo json_encode($data);
	}
	function getDataByKode4()
	{
		$kode = $this->input->get('id');
		$data = $this->setting_model->getDataByKode4($kode);
		echo json_encode($data);
	}

	function updateSegmen4(){
		$data = array ('success' => false, 'messages' => array());
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = form_error($key);
			}   
		}else{
			$data['success'] = true;
			$this->setting_model->updateSegmen4();	
		}
		echo json_encode($data);
	}

	function deleteSegmen4(){
		$kode=$this->input->post('kode');
		$data=$this->setting_model->deleteSegmen4($kode);
		echo json_encode($data);
	}
	




}

