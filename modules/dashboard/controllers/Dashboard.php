<?php

(defined('BASEPATH')) or exit('No direct script access allowed');

class Dashboard extends MY_Controller{

    function __construct()
    {
        parent::__construct();
		$this->load->model('dashboard_model');
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

	function reset(){
		// UPDATE `akun` SET `saldo` = 0 WHERE `saldo` != 0
	}

	function index_awal()
    {
        $this->load->template('index');
	}
	
	function getDetailByKode()
	{
		$kode = $this->input->get('id');
		$data = $this->dashboard_model->getDetailByKode($kode);
		echo json_encode($data);
	}
    function getAktiva(){
		$data=$this->dashboard_model->getAktiva();
		echo json_encode($data);
	}

	function getPasiva(){
		$data=$this->dashboard_model->getPasiva();
		echo json_encode($data);
	}

}

