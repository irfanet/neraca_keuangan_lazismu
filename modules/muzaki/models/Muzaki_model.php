<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Muzaki_model extends CI_Model
{
	public $kd_data;

	function __construct()
	{
		parent::__construct();
	}

	function getData()
	{
		$hasil = $this->db->get("muzaki");
		return $hasil->result();
	}
	function setData()
	{
		// $this->kd_data = uniqid();
		$data = array(
			// 'kd_muzaki' => $this->kd_data,
			'nama_muzaki' => $this->input->post('nama_muzaki'),
			'alamat' => $this->input->post('alamat'),
			'no_hp' => $this->input->post('no_hp'),
			'jenis_muzaki' => $this->input->post('jenis_muzaki'),
			'agama' => $this->input->post('agama'),
			'email' => $this->input->post('email'),
			'no_ktp' => $this->input->post('no_ktp'),
			'npwp' => $this->input->post('npwp'),
			'keterangan' => $this->input->post('keterangan'),
			'foto' => $this->_uploadImage()
		);
		$hasil = $this->db->insert("muzaki", $data);
		return $hasil;
	}
	function getDataByKode($kode)
	{
		$hasil = $this->db->get_where("muzaki", array('kd_muzaki' => $kode))->row();
		return $hasil;
	}

	function updateData()
	{
		$this->kd_data = $this->input->post('kd_muzaki');
		if (!empty($_FILES["foto"]["name"])) {
            $foto = $this->_uploadImage();
        } else {
            $foto =$this->input->post("old_image");
        }        
		$data = array(
			'nama_muzaki' => $this->input->post('nama_muzaki'),
			'alamat' => $this->input->post('alamat'),
			'no_hp' => $this->input->post('no_hp'),
			'jenis_muzaki' => $this->input->post('jenis_muzaki'),
			'agama' => $this->input->post('agama'),
			'email' => $this->input->post('email'),
			'no_ktp' => $this->input->post('no_ktp'),
			'npwp' => $this->input->post('npwp'),
			'keterangan' => $this->input->post('keterangan'),
			'foto' => $foto
		);
		$this->db->where('kd_muzaki', $this->kd_data);
		$hasil = $this->db->update("muzaki", $data);
		return $hasil;
	}

	function deleteData($kode)
	{
		$this->_deleteImage($kode);
		$this->db->where('kd_muzaki', $kode);
		$hasil = $this->db->delete("muzaki");
		return $hasil;
	}

	
	private function _uploadImage()
    {
        $config['upload_path']          = './assets/uploads/muzaki/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|bmp';
        $config['file_name']            = $this->kd_data;
		$config['overwrite']			= true;
        $config['max_size']             = 64000;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
			$gbr = $this->upload->data();
			//Compress Image
			$config['image_library']='gd2';
			$config['source_image']='./assets/uploads/muzaki/'.$gbr['file_name'];
			$config['create_thumb']= FALSE;
			$config['maintain_ratio']= TRUE;
			$config['quality']= '60%';
			$config['width']= 500;
			$config['new_image']= './assets/uploads/muzaki/'.$gbr['file_name'];
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$gambar=$gbr['file_name'];			
            return $this->upload->data('file_name');
		}else{
			return "default.jpg";
			// echo json_encode($this->upload->display_errors());
		}
        // print_r($this->upload->display_errors());
    }
    private function _deleteImage($kode)
    {
		$data = $this->getDataByKode($kode);
        if ($data->foto != "default.jpg") {
            $filename = explode(".", $data->foto)[0];
            return array_map('unlink', glob(FCPATH."assets/uploads/muzaki/$filename.*"));
        }
	}
	function uploadExcel($filename){
		
		$config['upload_path'] = './assets/uploads/excel/';
		$config['allowed_types'] = 'xls|xlsx';
		$config['max_size']  = '64000';
		$config['overwrite'] = true;
		$config['file_name'] = $filename;
	
		$this->load->library('upload', $config);
		if($this->upload->do_upload('excel')){
			$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
			return $return;
		}else{
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			return $return;
		}
	}

	function insert_multiple($data){
		$this->db->insert_batch("muzaki", $data);
	}
}
