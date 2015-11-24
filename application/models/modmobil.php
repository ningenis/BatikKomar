<?php

class Modmobil extends CI_Model {
	function getSemuaKaryawan() {
		return $this->db->query("SELECT *
			                     FROM karyawan")->result();
	}
}