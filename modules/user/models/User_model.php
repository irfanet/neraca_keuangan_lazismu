<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User_model extends CI_Model
{

	private $_table = "user";

	function __construct()
	{
		parent::__construct();
	}

	function data_list()
	{
		$this->db->where('id_user !=', $this->session->userdata('id_user'));
		$hasil = $this->db->get($this->_table);
		return $hasil->result();
	}

	function simpan_data()
	{
		$data = array(
			'email' => $this->input->post('email'),
			'username' => $this->input->post('username'),
			'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
			'level' => $this->input->post('level')
		);
		$hasil = $this->db->insert($this->_table, $data);
		return $hasil;
	}

	function get_data_by_kode($kode)
	{
		$hasil = $this->db->get_where($this->_table, array('id_user' => $kode))->row_array();
		return $hasil;
	}

	function update_data()
	{
		$id_user = $this->input->post('id_user');
		$data = array(
			'username' => $this->input->post('username'),
			'level' => $this->input->post('level'),
			'is_active' => $this->input->post('is_active')
		);
		$this->db->where('id_user', $id_user);
		$hasil = $this->db->update($this->_table, $data);
		return $hasil;
	}

	function hapus_data($kode)
	{
		$this->db->where('id_user', $kode);
		$hasil = $this->db->delete($this->_table);
		return $hasil;
	}
}
