<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class : Chat
 * By : Puzha Fauzha
 */
class Chat extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('employee_model');

		isloggedin();
	}

	function index()
	{

		$this->load->templateAdmin('chat/chat');
	}

}



?>