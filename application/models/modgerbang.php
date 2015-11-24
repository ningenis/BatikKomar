<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modgerbang extends CI_Model {
	function dataUser($namaPengguna) {
		return $this->db->query("SELECT * 
								 FROM admin 
								 WHERE AdminNama = ? ", $namaPengguna)->row();
	}
}

/* End of file : modgerbang.php */