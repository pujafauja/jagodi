<?php

/**
 * 
 */
class Customer_care_service extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		isloggedin();
	}

	function index($id)
	{
		$this->data['css'][] = base_url('assets/libs/summernote/summernote-bs4.min.css');
		$this->data['js'][] = base_url('assets/libs/summernote/summernote-bs4.min.js');
		$this->data['js'][] = base_url('assets/custom/js/static-page.js');

		$data = [
			'static' => $this->global_model->_get('static_page', ['id' => $id])->row()
		];

		$this->load->templateAdmin('static-page/edit', $data);
	}

	function save($id)
	{
		if($this->input->is_ajax_request()):
			$content = $this->input->post('content');

			$this->global_model->_update(
				'static_page',
				['content' => $content],
				['id' => decode($id)]
			);

			$this->pesan_sukses();
		endif;
	}
}

?>