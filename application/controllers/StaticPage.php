<?php

/**
 * 
 */
class StaticPage extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function about() {
		$this->load->templateFront('static-page/about');
	}

	function kontak() {
		$this->load->templateFront('static-page/kontak');
	}
}

?>