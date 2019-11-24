<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Setting_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function getSegmen1()
	{
		$hasil = $this->db->get("tb_kd_1");
		return $hasil->result();
	}
	function setSegmen1()
	{
		$data = array(
			'kd_1' => $this->input->post('kd_1'),
			'nama' => $this->input->post('nama')
		);
		$hasil = $this->db->insert("tb_kd_1", $data);
		return $hasil;
	}
	function getDataByKode1($kode)
	{
		$hasil = $this->db->get_where("tb_kd_1", array('id_1' => $kode))->row_array();
		return $hasil;
	}

	function updateSegmen1()
	{
		$id_1 = $this->input->post('id_1');
		$data = array(
			'kd_1' => $this->input->post('kd_1'),
			'nama' => $this->input->post('nama')
		);
		$this->db->where('id_1', $id_1);
		$hasil = $this->db->update("tb_kd_1", $data);
		return $hasil;
	}

	function deleteSegmen1($kode)
	{
		$this->db->where('id_1', $kode);
		$hasil = $this->db->delete("tb_kd_1");
		return $hasil;
	}

	//Segemen 2
	function getSegmen2()
	{
		$hasil = $this->db->get("tb_kd_2");
		return $hasil->result();
	}
	function setSegmen2()
	{
		$data = array(
			'kd_2' => $this->input->post('kd_2'),
			'nama' => $this->input->post('nama'),
			'id_1' => $this->input->post('id_1')
		);
		$hasil = $this->db->insert("tb_kd_2", $data);
		return $hasil;
	}
	function getDataByKode2($kode)
	{
		$hasil = $this->db->get_where("tb_kd_2", array('id_2' => $kode))->row_array();
		return $hasil;
	}

	function updateSegmen2()
	{
		$id = $this->input->post('id_2');
		$data = array(
			'kd_2' => $this->input->post('kd_2'),
			'nama' => $this->input->post('nama')
		);
		$this->db->where('id_2', $id);
		$hasil = $this->db->update("tb_kd_2", $data);
		return $hasil;
	}

	function deleteSegmen2($kode)
	{
		$this->db->where('id_2', $kode);
		$hasil = $this->db->delete("tb_kd_2");
		return $hasil;
	}

	//Segmen 3
	function getSegmen3()
	{
		$hasil = $this->db->get("tb_kd_3");
		return $hasil->result();
	}
	function setSegmen3()
	{
		$data = array(
			'kd_3' => $this->input->post('kd_3'),
			'nama' => $this->input->post('nama'),
			'id_2' => $this->input->post('id_2')
		);
		$hasil = $this->db->insert("tb_kd_3", $data);
		return $hasil;
	}
	function getDataByKode3($kode)
	{
		$hasil = $this->db->get_where("tb_kd_3", array('id_3' => $kode))->row_array();
		return $hasil;
	}

	function updateSegmen3()
	{
		$id = $this->input->post('id_3');
		$data = array(
			'kd_3' => $this->input->post('kd_3'),
			'nama' => $this->input->post('nama')
		);
		$this->db->where('id_3', $id);
		$hasil = $this->db->update("tb_kd_3", $data);
		return $hasil;
	}

	function deleteSegmen3($kode)
	{
		$this->db->where('id_3', $kode);
		$hasil = $this->db->delete("tb_kd_3");
		return $hasil;
	}

	function getSegmenById1($id)
	{
		$hasil = $this->db->get_where("tb_kd_2", array('id_1' => $id))->result();
		return $hasil;
	}
	function getSegmenById2($id)
	{
		$hasil = $this->db->get_where("tb_kd_3", array('id_2' => $id))->result();
		return $hasil;
	}

	//segmen 4
	function getSegmen4()
	{
		$hasil = $this->db->get("tb_kd_4");
		return $hasil->result();
	}
	function setSegmen4()
	{
		$data = array(
			'kd_4' => $this->input->post('kd_4'),
			'nama' => $this->input->post('nama'),
			'id_3' => $this->input->post('id_3')
		);
		$hasil = $this->db->insert("tb_kd_4", $data);
		return $hasil;
	}
	function getDataByKode4($kode)
	{
		$hasil = $this->db->get_where("tb_kd_4", array('id_4' => $kode))->row_array();
		return $hasil;
	}

	function updateSegmen4()
	{
		$id = $this->input->post('id_4');
		$data = array(
			'kd_4' => $this->input->post('kd_4'),
			'nama' => $this->input->post('nama')
		);
		$this->db->where('id_4', $id);
		$hasil = $this->db->update("tb_kd_4", $data);
		return $hasil;
	}

	function deleteSegmen4($kode)
	{
		$this->db->where('id_4', $kode);
		$hasil = $this->db->delete("tb_kd_4");
		return $hasil;
	}

}
