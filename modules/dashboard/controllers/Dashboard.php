<?php

(defined('BASEPATH')) or exit('No direct script access allowed');

class Dashboard extends MY_Controller{

    function __construct()
    {
        parent::__construct();
		$this->load->model('dashboard_model');
		if($this->session->userdata('id_user') == TRUE){
            redirect('auth');
        }
    }

    function index_awal()
    {
        $this->load->template('dashboard');
	}

    function index()
    {
        $this->load->view('dashboard');
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

