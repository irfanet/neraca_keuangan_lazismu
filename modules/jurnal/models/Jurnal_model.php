<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Jurnal_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function getData()
	{
		$hasil = $this->db->get("jurnal");
		return $hasil->result();
	}
}
