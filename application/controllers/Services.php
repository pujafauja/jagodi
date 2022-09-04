<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends MY_Controller {
    function __construct()
    {
        parent::__construct();
    }

    function index() {
        isloggedin();

        cekoto('services', 'view', true, true);
        // cekoto('banner', 'view', true, true);

        $data = [
            'data' => $this->global_model->_get('services')
        ];

        $this->load->templateAdmin('services/list', $data);
    }

    function new() {
        $this->data['css'][] = base_url('assets/libs/summernote/summernote-bs4.min.css');
        $this->data['css'][] = base_url("assets/libs/dropzone/min/dropzone.min.css");
        $this->data['css'][] = base_url("assets/libs/dropify/css/dropify.min.css");

        $this->data['js'][] = base_url("assets/libs/dropzone/min/dropzone.min.js");
        $this->data['js'][] = base_url("assets/libs/dropify/js/dropify.min.js");
        $this->data['js'][] = base_url('assets/libs/summernote/summernote-bs4.min.js');
        $this->data['js'][] = base_url("assets/custom/js/services/add-new.js");
        
        isloggedin();
        cekoto('services', 'add', true, true);
        
        $this->load->templateAdmin('services/new');
    }

    function edit($id = NULL) {
        if($id):
            $id = decode($id);
        endif;

        $this->data['css'][] = base_url('assets/libs/summernote/summernote-bs4.min.css');
        $this->data['css'][] = base_url("assets/libs/dropzone/min/dropzone.min.css");
        $this->data['css'][] = base_url("assets/libs/dropify/css/dropify.min.css");

        $this->data['js'][] = base_url("assets/libs/dropzone/min/dropzone.min.js");
        $this->data['js'][] = base_url("assets/libs/dropify/js/dropify.min.js");
        $this->data['js'][] = base_url('assets/libs/summernote/summernote-bs4.min.js');
        $this->data['js'][] = base_url("assets/custom/js/services/add-new.js");
        
        isloggedin();
        cekoto('services', 'edit', true, true);

        $data = [
            'data' => $this->global_model->_get('services', ['id' => $id])->row()
        ];
        
        $this->load->templateAdmin('services/new', $data);
    }

    function delete($id = NULL) {
        cekoto('services', 'delete', true, true);
        if($id):
            $id = decode($id);
        endif;

        $this->global_model->_delete('services', ['id' => $id]);
        if($this->db->affected_rows() > 0):
			$this->session->set_flashdata('global', get_alert('success', 'Data has been removed.'));
            redirect('services');
        else:
			$this->session->set_flashdata('global', get_alert('error', 'System error'));
            redirect('services');
        endif;
    }

    function save() {
        $this->form_validation->set_rules('title-en', 'Title English Version', 'required|max_length[100]');
        $this->form_validation->set_rules('title-ina', 'Title Versi Indonesia', 'required|max_length[100]');
        $this->form_validation->set_rules('desc-en', 'Description English Version', 'required|max_length[500]');
        $this->form_validation->set_rules('desc-ina', 'Description Versi Indonesia', 'required|max_length[500]');
        $this->form_validation->set_rules('content-en', 'Content English Version', 'required');
        $this->form_validation->set_rules('content-ina', 'Content Versi Indonesia', 'required');

        if($this->form_validation->run() == true):
            $gambar = $_FILES['gambar']['size'];
            $icon = $_FILES['icon']['size'];
            
            $config['upload_path']   = './media/service/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['max_size']      = 3000;

            $insert = [
                'titleEN' => $this->input->post('title-en'),
                'titleINA' => $this->input->post('title-ina'),
                'descEN' => $this->input->post('desc-en'),
                'descINA' => $this->input->post('desc-ina'),
                'contentEN' => $this->input->post('content-en'),
                'contentINA' => $this->input->post('content-ina'),
            ];
        
            $this->load->library('upload', $config);

            if($gambar <= 0 && !$this->input->post('id')):
                $this->query_error('Please upload 1 picture');
                die();
            elseif ($gambar > 0 && ! $this->upload->do_upload('gambar')):
                $this->query_error($this->upload->display_errors());
                die();
            elseif ($gambar > 0):
                $upload_photo = $this->upload->data();
                $insert['gambar'] = $upload_photo['file_name'];
            endif;

            if($icon <= 0 && !$this->input->post('id')):
                $this->query_error('Please upload 1 icon');
                die();
            elseif ($icon > 0 && ! $this->upload->do_upload('icon')):
                $this->query_error($this->upload->display_errors());
                die();
            elseif ($icon > 0):
                $upload_photo = $this->upload->data();
                $insert['icon'] = $upload_photo['file_name'];
            endif;

            if($this->input->post('id')):
                $this->global_model->_update('services', $insert, ['id' => decode($this->input->post('id'))]);
                $save = $this->db->affected_rows();

                saveSlug('services/detail/'.$this->input->post('id'), create_slug($this->input->post('title-en')));
            else:
                $save = $this->global_model->_insert('services', $insert);

                saveSlug('services/detail/'.encode($save), create_slug($this->input->post('title-en')));
            endif;

            if($save > 0):
                echo json_encode([
                    'status' => true,
                    'pesan' => 'Data has been updated'
                ]);
            else:
                echo json_encode([
                    'status' => 0,
                    'pesan' => $this->db->last_query()
                ]);
            endif;
        else:
            $this->input_error();
        endif;
    }

    function detail($id) {
        $id = decode($id);

        $data = [
            'detail' => $this->global_model->_get('services', ['id' => $id])->row(),
            'services' => $this->global_model->_get('services')
        ];

        $this->load->templateFront('service-detail', $data);
    }
}
?>