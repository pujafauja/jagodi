<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class : Service
 * By : Puzha Fauzha
 */
class Service extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('service_model');
	}

	function index()
	{
		$data = [
			'service' => $this->global_model->_get('services')
		];

		$this->load->templateFront('service/service', $data);
	}
}
?>