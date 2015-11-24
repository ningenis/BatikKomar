<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gerbang extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('modgerbang');
		$this->load->model('modjual');
		$this->load->model('umum');
	}
	function FormLogin() {
		$this->load->view('gerbang/FormLogin');
	}
	function FormLogout() {
		$this->session->unset_userdata('AdminID');
		$this->session->unset_userdata('AdminNama');
		$this->session->unset_userdata('id_karyawan');
		$this->session->unset_userdata('IzinkanAksesJual');
		$this->session->sess_destroy();
		redirect('gerbang/FormLogin');
	}
	function Login() {
		$namaPengguna = $this->input->post('namaPengguna');
		$kataKunci = $this->input->post('kataKunci');

		$dataUser = $this->modgerbang->dataUser($namaPengguna);

		if ($dataUser->HashPassword == $this->umum->hashPassword($kataKunci)) {
			$data_karyawan = $this->modjual->InfoKaryawan($dataUser->id_karyawan);
			$dataBaru = array('AdminID' => $dataUser->AdminID,
							  'AdminNama' => $dataUser->AdminNama,
							  'id_karyawan' => $data_karyawan->id_karyawan ,
							  'IzinkanAksesJual' => 'NemesisMengizinkan');
			$this->session->set_userdata($dataBaru);
			redirect('jual/Index');
		} else {
			redirect('gerbang/FormLogin');
		}
	}
}

/* End of file : gerbang.php */