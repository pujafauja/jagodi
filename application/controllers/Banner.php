<?php

class Banner extends MY_Controller {

	function __construct() {
		parent::__construct();

		isloggedin();
	}

	function index() {
		$this->banner();
	}

	function banner() {
		cekoto('banner', 'view', true, true);

        $this->data['css'][] = base_url("assets/libs/dropify/css/dropify.min.css");

        $this->data['js'][] = base_url("assets/libs/dropify/js/dropify.min.js");

		$this->data['js'][] = base_url('assets/custom/js/banner/banner.js');

		$data = array();

		$this->load->templateAdmin('banner/list-data', $data);
	}

	function banner_lists() {
		$data = [
			'banner' => $this->global_model->_get('banner')
		];

		$this->load->view('popoti/banner/banner-lists', $data);
	}

	function edit_banner($id = false) {
		if($id):
			cekoto('banner', 'edit', true, true);

			$id = decode($id);

	        $this->data['css'][] = base_url("assets/libs/dropify/css/dropify.min.css");

	        $this->data['js'][] = base_url("assets/libs/dropify/js/dropify.min.js");

			$this->data['js'][] = base_url('assets/custom/js/banner/banner.js');

			$data = [
				'banner' => $this->global_model->_get('banner')->row()
			];

			$this->load->templateAdmin('banner/edit-banner', $data);
		else:
			redirect('errors/notfound');
		endif;
	}

	function delete_banner($id = false) {
		if($id):
			$id = decode($id);
			$data = $this->global_model->_get('banner', ['id' => $id])->row();

			$this->global_model->_delete('banner', ['id' => $id]);

			if($this->db->affected_rows() > 0):
				unlink('./media/banner/'.$data->gambar);
				unlink('./media/banner/sm/'.$data->gambar);
				unlink('./media/banner/md/'.$data->gambar);
				unlink('./media/banner/lg/'.$data->gambar);

				$this->pesan_sukses('Your data has been deleted');
			else:
				$this->pesan_error('System error, your data not deleted');
			endif;
		else:
			$this->pesan_error('Data not found');
		endif;
	}

	function save_banner($id = false) {
		$this->form_validation->set_rules('desc', 'Description', 'required|max_length[250]');
		$this->form_validation->set_rules('position', 'Position', 'required');
		$this->form_validation->set_rules('url', 'URL', 'required|max_length[250]');

		if($this->form_validation->run() == true):
			$desc     = $this->input->post('desc');
			$position = $this->input->post('position');
			$url      = $this->input->post('url');

			$gambar = $_FILES['gambar']['size'];

			$data = [
				'desc'     => $desc,
				'position' => $position,
				'url'      => $url
			];

			$config['upload_path']   = './media/banner/';
			$config['allowed_types'] = 'png|jpg|jpeg';
			$config['max_size']      = 5000;
			$config['encrypt_name']  = true;

			$this->load->library('upload', $config);

			if($gambar <= 0 && ! $id):
				$this->pesan_error('Please select a picture');
				die();
			elseif($gambar > 0 && ! $this->upload->do_upload('gambar')):
				$this->pesan_error($this->upload->display_errors());
				die();
			elseif($gambar > 0):
				$uploadImage = $this->upload->data();

				$this->_create_thumbs($uploadImage, $path = './media/banner');

				$data['gambar'] = $uploadImage['file_name'];
			endif;

			if($id):
				$this->global_model->_update('banner', $data, ['id' => decode($id)]);
			else:
				$this->global_model->_insert('banner', $data);
			endif;

			if($this->db->affected_rows() > 0):
				$this->pesan_sukses('Data has been saved');
			else:
				$this->pesan_error('There is no data to change');
			endif;
		else:
			$this->input_error();
		endif;
	}

	function slider() {
		cekoto('banner/slider', 'view', true, true);

		$this->data['css'][] = base_url('assets/libs/dropzone/min/dropzone.min.css');
		$this->data['js'][] = base_url('assets/libs/dropzone/min/dropzone.min.js');
		$this->data['js'][] = base_url('assets/custom/js/banner/slider.js');

		$data = [
			'slider' => $this->global_model->_get('slider')
		];

		$this->load->templateAdmin('banner/slider/list-data', $data);
	}

	function save_slider() {
		// initiate uploading pictures
		$imageCount = count($_FILES['file']['name']);

		for ($i=0; $i < $imageCount; $i++):
			$no = $i + 1;

			$_FILES['picture']['name']     = $_FILES['file']['name'];
			$_FILES['picture']['type']     = $_FILES['file']['type'];
			$_FILES['picture']['tmp_name'] = $_FILES['file']['tmp_name'];
			$_FILES['picture']['error']    = $_FILES['file']['error'];
			$_FILES['picture']['size']     = $_FILES['file']['size'];

			$gambar = $_FILES['picture']['size'];

			$config['upload_path']   = './media/sliders/';
			$config['allowed_types'] = 'png|jpg|jpeg';
			$config['max_size']      = 3000;
			// $config['file_name']     = $slug . ' ' . $no;
			$config['remove_spaces'] = true;
			$config['encrypt_name']  = true;

			$this->load->library('upload', $config);
			$this->upload->overwrite = true;

			if ($gambar > 0 && ! $this->upload->do_upload('picture')):
			    $this->query_error($this->upload->display_errors());
			    die();
			elseif ($gambar > 0):
				$uploadImage = $this->upload->data();

				$this->_create_thumbs($uploadImage, $path = './media/sliders');

				$this->global_model->_insert('slider', ['gambar' => $uploadImage['file_name']]);
			endif;
		endfor;
	}

	function delete_slider($id = false) {
		if(cekoto('banner/slider', 'delete')):
			if($id):
				$id = decode($id);

				$slider = $this->global_model->_get('slider', ['id' => $id])->row();

				$this->global_model->_delete('slider', ['id' => $id]);

				if($this->db->affected_rows() > 0):
					// delete image files
					unlink('./media/sliders/'.$slider->gambar);
					unlink('./media/sliders/sm/'.$slider->gambar);
					unlink('./media/sliders/md/'.$slider->gambar);
					unlink('./media/sliders/lg/'.$slider->gambar);

					$this->pesan_sukses('Data has been removed');
				endif;
			else:
				$this->pesan_error('Please select one image');
			endif;
		else:
			$this->pesan_error('You don\'t have access to delete this data');
		endif;
	}

	function running_text() {
		cekoto('banner/running-text', 'view', true, true);

		$this->data['js'][] = base_url('assets/custom/js/banner/running-text.js');

		$data = [];

		$this->load->templateAdmin('banner/running-text/list-data', $data);
	}

	function running_text_lists() {
		$data = [
			'words' => $this->global_model->_get('running_text')
		];

		$this->load->view('popoti/banner/running-text/running-text-lists', $data);
	}

	function save_running_text($id = false) {
		if($_POST):
			if($id):
				$id = decode($id);
			endif;

			$this->form_validation->set_rules('words', 'Running text', 'required|max_length[250]');

			if($this->form_validation->run() != false):
				$words = $this->input->post('words');

				$data = [
					'words' => $words
				];

				if($id):
					$this->global_model->_update('running_text', $data, ['id' => $id]);
				else:
					$this->global_model->_insert('running_text', $data);
				endif;

				if($this->db->affected_rows() > 0):
					$this->pesan_sukses();
				else:
					$this->pesan_error();
				endif;
			else:
				$this->input_error();
			endif;
		else:
			$this->pesan_error();
		endif;
	}

}