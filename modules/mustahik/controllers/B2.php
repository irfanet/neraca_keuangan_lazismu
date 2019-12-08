<?php

(defined('BASEPATH')) or exit('No direct script access allowed');

class B2 extends MY_Controller{

    function __construct()
    {
        parent::__construct();
		$this->load->model('b2_model');
		if($this->session->userdata('id_admin') != TRUE){
            redirect('auth');
        }
    }
    function index()
    {
		// $data['penghasilan'] = $this->getDataStatis('data_keluarga');
        $this->load->view('form_b2');
	}

    function getData(){
		$data=$this->b2_model->getData();
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
			$this->b2_model->setData();	
		}
		echo json_encode($data);
	}
	function getDataByKode()
	{
		$kode = $this->input->get('id');
		$data = $this->b2_model->getDataByKode($kode);
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
			$this->b2_model->updateData();	
		}
		echo json_encode($data);
	}

	function deleteData(){
		$kode=$this->input->post('kode');
		$data=$this->b2_model->deleteData($kode);
		echo json_encode($data);
	}

	function getMustahik(){
		$this->db->from('mustahik');
		$this->db->where('status_acc_pengurus',0);
		$this->db->or_where('status_acc_direktur',0);
		$hasil = $this->db->get();
		echo json_encode($hasil->result());
	}

	function getField($id){
		$this->db->from('tb_b2_2');
		$this->db->where('kategori',$id);
		$hasil = $this->db->get();
		echo json_encode($hasil->result());
	}

	function getKetField($id)
	{
		$hasil = $this->db->get_where('tb_b2_2', ['kd_data' => $id])->row_array();
		echo json_encode($hasil);
	}

	function getRadio($data,$id)
	{
		$this->db->from($data);
		$this->db->where('kategori',$id);
		$hasil = $this->db->get();
		echo json_encode($hasil->result());
	}


}

