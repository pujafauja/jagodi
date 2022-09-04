<?php

class Contact_us extends MY_Controller 
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        isloggedin();
        cekoto('contact-us', 'view', true, true);

        // cekoto('banner', 'view', true, true);

        $this->data['css'][] = base_url('assets/libs/summernote/summernote-bs4.min.css');
        $this->data['css'][] = base_url("assets/libs/dropzone/min/dropzone.min.css");
        $this->data['css'][] = base_url("assets/libs/dropify/css/dropify.min.css");

        $this->data['js'][] = base_url("assets/libs/dropzone/min/dropzone.min.js");
        $this->data['js'][] = base_url("assets/libs/dropify/js/dropify.min.js");
        $this->data['js'][] = base_url('assets/libs/summernote/summernote-bs4.min.js');
        $this->data['js'][] = base_url('assets/custom/js/contact-us/summernote.init.js');

        $this->data['js'][] = 'https://maps.google.com/maps/api/js?key=AIzaSyDsucrEdmswqYrw0f6ej3bf4M4suDeRgNA';
        $this->data['js'][] = base_url('assets/libs/gmaps/gmaps.min.js');
        // $this->data['js'][] = base_url('/assets/js/pages/google-maps.init.js');

        
        $this->data['js'][] = base_url('assets/custom/js/contact-us/save.js');

        $data = [
            'data' => $this->global_model->_get('about', ['id' => '1'])->row()
        ];

        $this->load->templateAdmin('contact-us/edit', $data);
    }

    function save() {
        $this->form_validation->set_rules('contact-en', 'Contact Message English Version', 'required');
        $this->form_validation->set_rules('contact-ina', 'Contact Message Versi Indonesia', 'required');
        $this->form_validation->set_rules('lat', 'Address', 'required');
        $this->form_validation->set_rules('lon', 'Address', 'required');

        if($this->form_validation->run() == true):
            $gambar = $_FILES['gambar']['size'];
            
            $config['upload_path']   = './media/contact/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['max_size']      = 3000;

            $insert = [
                'contactEN' => $this->input->post('contact-en'),
                'contactINA' => $this->input->post('contact-ina'),
                'lat' => $this->input->post('lat'),
                'lon' => $this->input->post('lon'),
            ];
        
            $this->load->library('upload', $config);

            if ($gambar > 0 && ! $this->upload->do_upload('gambar')):
                $this->query_error($this->upload->display_errors());
                die();
            elseif ($gambar > 0):
                $upload_photo = $this->upload->data();
                $insert['gambar_contact'] = $upload_photo['file_name'];
            endif;

            $this->global_model->_update('about', $insert, ['id' => '1']);
            $save = $this->db->affected_rows();

            if($save > 0):
                echo json_encode([
                    'status' => true,
                    'pesan' => 'Data has been updated'
                ]);
            else:
                echo json_encode([
                    'status' => 0,
                    'pesan' => 'There is nothing to change'
                ]);
            endif;
        else:
            $this->input_error();
        endif;
    }
}


?>