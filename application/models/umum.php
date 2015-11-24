<?php

class Umum extends CI_Model {
	function hashPassword($password) {
		return sha1(md5(md5($password) . sha1($password))) . md5(sha1(sha1($password) . md5($password)));
	}
}

/* End of file : umum.php */