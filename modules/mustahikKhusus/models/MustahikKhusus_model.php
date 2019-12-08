<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MustahikKhusus_model extends CI_Model
{
	public $kd_data;

	function __construct()
	{
		parent::__construct();
	}

	function getData()
	{
		$hasil = $this->db->get("mustahik_khusus");
		return $hasil->result();
	}
	function setData()
	{
		$this->kd_data = uniqid();
		$data = array(
			'kd_mustahik_khusus' => $this->kd_data,
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'foto' => $this->_uploadImage(),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tgl_lahir' => $this->input->post('tgl_lahir')
		);
		$hasil = $this->db->insert("mustahik_khusus", $data);
		return $hasil;
	}
	function getDataByKode($kode)
	{
		$hasil = $this->db->get_where("mustahik_khusus", array('kd_mustahik_khusus' => $kode))->row();
		return $hasil;
	}

	function updateData()
	{
		$this->kd_data = $this->input->post('kd_mustahik_khusus');
		if (!empty($_FILES["foto"]["name"])) {
            $foto = $this->_uploadImage();
        } else {
            $foto =$this->input->post("old_image");
        }        
		$data = array(
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'foto' => $foto,
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tgl_lahir' => $this->input->post('tgl_lahir')
		);
		$this->db->where('kd_mustahik_khusus', $this->kd_data);
		$hasil = $this->db->update("mustahik_khusus", $data);
		return $hasil;
	}

	function deleteData($kode)
	{
		$this->_deleteImage($kode);
		$this->db->where('kd_mustahik_khusus', $kode);
		$hasil = $this->db->delete("mustahik_khusus");
		return $hasil;
	}

	private function _uploadImage()
    {
        $config['upload_path']          = './assets/uploads/mustahik_khusus/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|bmp';
        $config['file_name']            = $this->kd_data;
		$config['overwrite']			= true;
        $config['max_size']             = 64000;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
			$gbr = $this->upload->data();
			//Compress Image
			$config['image_library']='gd2';
			$config['source_image']='./assets/uploads/mustahik_khusus/'.$gbr['file_name'];
			$config['create_thumb']= FALSE;
			$config['maintain_ratio']= TRUE;
			$config['quality']= '60%';
			$config['width']= 500;
			$config['new_image']= './assets/uploads/mustahik_khusus/'.$gbr['file_name'];
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$gambar=$gbr['file_name'];			
            return $this->upload->data('file_name');
		}else{
			// return "default.jpg";
			echo json_encode($this->upload->display_errors());
		}
        // print_r($this->upload->display_errors());
    }

    private function _deleteImage($kode)
    {
		$data = $this->getDataByKode($kode);
        if ($data->foto != "default.jpg") {
            $filename = explode(".", $data->foto)[0];
            return array_map('unlink', glob(FCPATH."assets/uploads/mustahik_khusus/$filename.*"));
        }
	}
	
	public function resizeImage($filename){
		$source_path = $_SERVER['DOCUMENT_ROOT'] . 'assets/uploads/mustahik_khusus/'.$filename;
		$target_path = $_SERVER['DOCUMENT_ROOT'] . 'assets/uploads/mustahik_khusus/';
		$config_manip = array(
			'image_library' => 'gd2',
			'source_image' => $source_path,
			'new_image' => $target_path,
			'maintain_ratio' => TRUE,
			'quality' => 50,
		);

		$this->load->library('image_lib', $config_manip);
		if(!$this->image_lib->resize()){
			echo $this->image_lib->display_errors();
		}
		$this->image_lib->clear();
	}
}
