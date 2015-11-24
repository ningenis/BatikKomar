<?php

class MY_Loader extends CI_Loader {
	public function tmpJual($template_name, $vars = array(), $return = FALSE) {
		$direktoriMan = 'jual/';
		$content  = $this->view($direktoriMan . 'utama_atas', $vars, $return);
		$content .= $this->view($direktoriMan . $template_name, $vars, $return);
		$content .= $this->view($direktoriMan . 'utama_bawah', $vars, $return);

		if($return) {
			return $content;
		}
	}
}