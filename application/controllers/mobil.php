<?php

class Mobil extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('modmobil');
		echo 'controller mobil dipanggil!';
	}
	function index() {

	}
}