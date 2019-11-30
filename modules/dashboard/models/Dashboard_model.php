<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard_model extends CI_Model
{

	private $_table = "gaji";

	function __construct()
	{
		parent::__construct();
	}

	function getAktiva()
	{
		$hasil = $this->db->query("SELECT * FROM akun")->result();
		return $hasil;
	}
	function getPasiva()
	{
		$hasil = $this->db->query("SELECT *, a.nama as nama_1, b.nama as nama_2, c.nama as nama_3, d.nama as nama_4 FROM tb_kd_1 a, tb_kd_2 b, tb_kd_3 c, tb_kd_4 d WHERE a.id_1='2' AND b.id_2=c.id_2 AND c.id_3=d.id_3")->result();
		return $hasil;
	}
	function getSegmenById2($id)
	{
		$hasil = $this->db->get_where("tb_kd_3", array('id_2' => $id))->result();
		return $hasil;
	}


	function get_aktif()
	{
		return $this->db->select("count(nik) as pegawai_aktif")->from("pegawai")->where("is_active=1")->get()->row();
	}

	function get_non_aktif()
	{
		return $this->db->select("count(nik) as pegawai_non_aktif")->from("pegawai")->where("is_active=0")->get()->row();
	}

	function get_hari_kerja()
	{
		return $this->db->select("count(tgl) as hari_kerja")->from("kalender_detail")->where("tgl>=(SELECT tgl_mulai FROM kalender ORDER BY id_periode DESC LIMIT 1)")->where("tgl<=(SELECT tgl_selesai FROM kalender ORDER BY id_periode DESC LIMIT 1)")->get()->row();
	}

	function get_honor()
	{
		return $this->db->select("honor")->from("honor_lembur")->get()->row();
	}

	function get_aktif_dep()
	{
		$this->db->select("departemen.kd_departemen, departemen.nama_departemen, count(pegawai.nik) as hitung")->from("departemen, pegawai");
		$this->db->where("pegawai.kd_departemen = departemen.kd_departemen");
		$this->db->where("pegawai.is_active = 1");
		$this->db->group_by("departemen.kd_departemen");
		return $this->db->get()->result();
	}
}
