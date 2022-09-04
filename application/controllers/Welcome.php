<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct() {
		parent::__construct();

		isloggedin();
		// $this->load->model(array(
		// ));
	}
	public function index()
	{
		cekoto('dashboard','view', true, true);
		$this->session->unset_userdata('filter_data');

        $this->data['css'][] = base_url('assets/libs/flatpickr/flatpickr.min.css"');
        $this->data['css'][] = base_url('assets/libs/selectize/css/selectize.bootstrap3.css"');

        $this->data['js'][] = base_url('assets/libs/flatpickr/flatpickr.min.js');
        $this->data['js'][] = base_url('assets/libs/apexcharts/apexcharts.min.js');
        $this->data['js'][] = base_url('assets/libs/selectize/js/standalone/selectize.min.js');
        $this->data['js'][] = base_url('assets/js/pages/dashboard-1.init.js');

		$data = array(
			// 'favorit' => $this->db->where(['userid' => $this->session->userdata('user')])->get('tb_favorit')->result_array(),
		);

		$this->load->templateAdmin('dashboard', $data);
	}
}
