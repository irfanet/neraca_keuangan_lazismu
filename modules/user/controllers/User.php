<?php

(defined('BASEPATH')) or exit('No direct script access allowed');

class User extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		if ($this->session->userdata('id_user') != TRUE) {
			redirect('auth');
		}
	}

	function index()
	{
		$this->load->view('user');
	}

	function get_data()
	{
		$data = $this->user_model->data_list();
		echo json_encode($data);
	}

	function get_kode()
	{
		$kode = $this->input->get('id');
		$data = $this->user_model->get_data_by_kode($kode);
		echo json_encode($data);
	}

	function simpan_data()
	{
		$data = array('success' => false, 'messages' => array());
		$this->form_validation->set_rules(
			'email',
			'lang:email',
			'valid_email|required|trim|strip_tags|is_unique[user.email]',
			[
				'is_unique' => 'Email telah digunakan user lain!'
			]
		);
		$this->form_validation->set_rules('username', 'Username', 'required|trim|strip_tags');
		$this->form_validation->set_rules('password1', 'lang:password', 'required|trim|min_length[6]|matches[password2]', [
			'matches' => 'Password dont match!',
			'min_length' => 'Password to short!'
		]);
		$this->form_validation->set_rules('password2', 'lang:password', 'required|trim|matches[password1]');
		$this->form_validation->set_rules('level', 'Level', 'required|trim');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = form_error($key);
			}
		} else {
			$data['success'] = true;
			$this->user_model->simpan_data();
		}
		echo json_encode($data);
	}

	function update_data()
	{
		$data = array('success' => false, 'messages' => array());
		$this->form_validation->set_rules('username', 'lang:username', 'required|trim');
		$this->form_validation->set_rules('level', 'Level', 'required|trim');
		$this->form_validation->set_rules('is_active', 'Status', 'required|trim');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = form_error($key);
			}
		} else {
			$data['success'] = true;
			$this->user_model->update_data();
		}
		echo json_encode($data);
	}

	function edit_profile()
	{
		$this->form_validation->set_rules('username_profile', 'Level', 'required|trim');
		$this->form_validation->set_rules('email_profile', 'Status', 'required|trim');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() == FALSE) { } else {
			$id_user = $this->input->post('id_user_profile');
			$email = $this->input->post('email_profile');
			$username = $this->input->post('username_profile');
			$this->db->where('id_user', $id_user);
			if ($this->input->post('password2_profile') != ''){
				$data = array(
					'email' => $email,
					'username' => $username,
					'password' => password_hash($this->input->post('password2_profile'), PASSWORD_DEFAULT)
				);
			}
			else{
				$data = array(
					'email' => $email,
					'username' => $username
				);
			}
			$this->db->update('user', $data);
			$data = [
				'id_user' => $id_user,
				'email' => $email,
				'username' => $username,
				'level' => $this->session->userdata('level')
			];
			$this->session->set_userdata($data);
			$this->load->template('user');
		}
	}

	function hapus_data()
	{
		$kode = $this->input->post('kode');
		$data = $this->user_model->hapus_data($kode);
		echo json_encode($data);
	}
}
