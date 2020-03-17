<?php

(defined('BASEPATH')) or exit('No direct script access allowed');

class Dashboard extends MY_Controller{

    function __construct()
    {
        parent::__construct();
		$this->load->model('dashboard_model');
		if($this->session->userdata('id_user') != TRUE){
            redirect('auth');
		}
		if($this->session->userdata('status') != 'admin'){
            redirect('auth');
		}
    }

    function index()
    {
        $this->load->view('index');
	}

	function reset(){
		// UPDATE `akun` SET `saldo` = 0 WHERE `saldo` != 0
	}

	function index_awal()
    {
        $this->load->template('index');
	}
	
	function cek()
    {
		$data['aktiva_piutang'] = $this->dashboard_model->getNominal("A01.01.03.%");
		print_r($data);
	}

	function printPDF()
	{

		//aset lancar
		$aktiva_kas = $this->dashboard_model->getNominal("A01.01.01.%");
		$aktiva_bank = $this->dashboard_model->getNominal("A01.01.02.%");
		$data['aktiva_kas_n_setara'] = $aktiva_kas+$aktiva_bank;
		$data['aktiva_piutang'] = $this->dashboard_model->getNominal("A01.01.03.%");
		$data['aktiva_persediaan_barang'] = $this->dashboard_model->getNominal("A01.01.04.%");
		$data['aktiva_uang_muka_program'] = $this->dashboard_model->getNominal("A01.01.05.%");
		$data['aktiva_biaya_dimuka'] = $this->dashboard_model->getNominal("A01.01.06.%");
		$data['aktiva_investasi'] = $this->dashboard_model->getNominal("A01.01.07.%");
		$data['aktiva_jml_aset_lancar'] = $this->dashboard_model->getNominal("A01.01.%");
		//aset tetap
		$data['aktiva_aset_tetap'] = $this->dashboard_model->getNominal("A01.02.01.%");
		$data['aktiva_akumulasi_penyusutan_aset_tetap'] = $this->dashboard_model->getNominal("A01.02.02.%");
		$data['aktiva_jml_aset_tetap'] = $this->dashboard_model->getNominal("A01.02.%");
		//aset kelolaan
		$data['aktiva_aset_kelolaan'] = $this->dashboard_model->getNominal("A01.03.01.%");
		$data['aktiva_akumulasi_penyusutan_aset_kelola'] = $this->dashboard_model->getNominal("A01.03.02.%");
		$data['aktiva_jml_aset_kelolaan'] = $this->dashboard_model->getNominal("A01.03.%");
		$data['aktiva_jml'] = $this->dashboard_model->getNominal("A01.%");

		//pasiva
		$data['pasiva_hutang_penyaluran_dana_program'] = $this->dashboard_model->getNominal("A02.01.01.01");
		$data['pasiva_hutang_penyaluran_amil'] = $this->dashboard_model->getNominal("A02.01.01.02");
		$data['pasiva_titipan_dana_wakaf'] = $this->dashboard_model->getNominal("A02.01.01.03");
		$data['pasiva_hutang_dana_zis'] = $this->dashboard_model->getNominal("A02.01.01.04");
		$data['pasiva_hutang_dana_amil'] = $this->dashboard_model->getNominal("A02.01.01.05");
		$data['pasiva_hutang_jangka_pendek_lainnya'] = $this->dashboard_model->getNominal("A02.01.01.06");
		//jangka panjang
		$data['pasiva_hutang_jangka_panjang'] = $this->dashboard_model->getNominal("A02.01.02.01");
		$data['pasiva_jml_liabilitas'] = $this->dashboard_model->getNominal("A02.01.%");
		//saldo
		$data['pasiva_zakat'] = $this->dashboard_model->getNominal("A02.02.01.00");
		$data['pasiva_zakat_fitrah'] = $this->dashboard_model->getNominal("A02.02.02.00");
		$data['pasiva_infak'] = $this->dashboard_model->getNominal("A02.02.03.00");
		$data['pasiva_muqoyyad'] = $this->dashboard_model->getNominal("A02.02.04.00");
		$data['pasiva_amil'] = $this->dashboard_model->getNominal("A02.02.05.00");
		$data['pasiva_hibah'] = $this->dashboard_model->getNominal("A02.02.06.00");
		$data['pasiva_wakaf'] = $this->dashboard_model->getNominal("A02.02.07.00");
		$data['pasiva_qurban'] = $this->dashboard_model->getNominal("A02.02.08.00");
		$data['pasiva_fidyah'] = $this->dashboard_model->getNominal("A02.02.09.00");
		$data['pasiva_jizyah'] = $this->dashboard_model->getNominal("A02.02.10.00");
		$data['pasiva_hak_kelola_wilayah'] = $this->dashboard_model->getNominal("A02.02.11.00");
		$data['pasiva_jml_saldo_dana'] = $this->dashboard_model->getNominal("A02.02.%");
		$data['pasiva_jml'] = $this->dashboard_model->getNominal("A02.%");

		$nama_dokumen = "Neraca_lazismu_semarang_".date('d/m/Y');
		$mpdf = new \Mpdf\Mpdf();
        $html = $this->load->view('print',$data,true);
        $mpdf->WriteHTML($html);
        $mpdf->Output($nama_dokumen.".pdf" ,'I');
	}
	
	function getDetailByKode()
	{
		$kode = $this->input->get('id');
		$data = $this->dashboard_model->getDetailByKode($kode);
		echo json_encode($data);
	}

    function getAktiva(){
		$data=$this->dashboard_model->getAktiva();
		echo json_encode($data);
	}

	function getPasiva(){
		$data=$this->dashboard_model->getPasiva();
		echo json_encode($data);
	}

}

