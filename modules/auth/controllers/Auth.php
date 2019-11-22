<?php

(defined('BASEPATH')) or exit('No direct script access allowed');

class Auth extends MY_Controller{

    function __construct()
    {
        parent::__construct();
		// $this->load->model('divisi_model');
    }

    function index()
    {
        if($this->session->userdata('id_user') == TRUE){
			redirect('dashboard/index_awal');
		}
		
		$this->form_validation->set_rules('email','Email','valid_email|trim|required|strip_tags');
		$this->form_validation->set_rules('password','Password','trim|required');

		if($this->form_validation->run()==FALSE){
			$this->load->view('login');
		}else{
			// validasinya success
			$this->_login();
		}

    }
    public function _login(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		
		if($user){
			if($user['is_active']==1){
				if(password_verify($password, $user['password'])){
					$data= [
						'id_user' => $user['id_user'],
						'email' => $user['email'],
						'username' => $user['username'],
						'level' => $user['level']
					];
					$this->session->set_userdata($data);
                    redirect('dashboard/index_awal');	
				}else{
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
					Login failed! Wrong password.</div>');
					redirect('auth');
				}
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
			This Account has not been activited</div>');
				redirect('auth');
			}
		}else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
			Account is not registered</div>');
			redirect('auth');
		}
    }
    public function logout(){

		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('email');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('level');

		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
			  You have been logout</div>');
			redirect('auth');
	}

}