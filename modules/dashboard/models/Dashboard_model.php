<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function getAktiva()
	{
		$hasil = $this->db->query("SELECT * FROM akun WHERE kd_akun LIKE 'A01.%' ")->result_array();
		return $hasil;
	}
	function getPasiva()
	{
		$hasil = $this->db->query("SELECT * FROM akun WHERE kd_akun LIKE 'A02.%' ")->result_array();
		return $hasil;
	}
	function getDetailByKode($kode)
	{
		$hasil = $this->db->get_where("jurnal", array('kd_akun' => $kode))->result();
		return $hasil;
	}

}
