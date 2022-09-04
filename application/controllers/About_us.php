<?php
/**
 * About Us Page 
 */
class About_us extends MY_Controller
{
	
	function __construct() {
		parent::__construct();
	}

	function index() {
		isloggedin();

        cekoto('about-us', 'view', true, true);
        // cekoto('banner', 'view', true, true);

        $this->data['css'][] = base_url('assets/libs/summernote/summernote-bs4.min.css');
        $this->data['css'][] = base_url("assets/libs/dropzone/min/dropzone.min.css");
        $this->data['css'][] = base_url("assets/libs/dropify/css/dropify.min.css");

        $this->data['js'][] = base_url("assets/libs/dropzone/min/dropzone.min.js");
        $this->data['js'][] = base_url("assets/libs/dropify/js/dropify.min.js");
        $this->data['js'][] = base_url('assets/libs/summernote/summernote-bs4.min.js');
        $this->data['js'][] = base_url('assets/custom/js/about-us/summernote.init.js');
        $this->data['js'][] = base_url('assets/custom/js/about-us/save.js');

        $data = [
            'data' => $this->global_model->_get('about', ['id' => '1'])->row()
        ];

        $this->load->templateAdmin('about/edit', $data);
	}

    function save() {
        $this->form_validation->set_rules('about-en', 'About English Version', 'required');
        $this->form_validation->set_rules('about-ina', 'About Versi Indonesia', 'required');
        $this->form_validation->set_rules('short-about-en', 'Short About English Version', 'required');
        $this->form_validation->set_rules('short-about-ina', 'Short About Versi Indonesia', 'required');

        if($this->form_validation->run() == true):
            $gambar = $_FILES['gambar']['size'];
            
            $config['upload_path']   = './media/about/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['max_size']      = 3000;

            $insert = [
                'shortAboutEN' => $this->input->post('short-about-en'),
                'shortAboutINA' => $this->input->post('short-about-ina'),
                'aboutEN' => $this->input->post('about-en'),
                'aboutINA' => $this->input->post('about-ina'),
            ];
        
            $this->load->library('upload', $config);

            if ($gambar > 0 && ! $this->upload->do_upload('gambar')):
                $this->query_error($this->upload->display_errors());
                die();
            elseif ($gambar > 0):
                $upload_photo = $this->upload->data();
                $insert['gambar'] = $upload_photo['file_name'];
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

    function save_visi_misi() {
        $this->form_validation->set_rules('visimisi-en', 'Vision & Mision English Version', 'required');
        $this->form_validation->set_rules('visimisi-ina', 'Vision & Mision Versi Indonesia', 'required');

        if($this->form_validation->run() == true):
            $insert = [
                'visimisiEN' => $this->input->post('visimisi-en'),
                'visimisiINA' => $this->input->post('visimisi-ina'),
            ];
        
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

    function visi_misi() {
		isloggedin();

        cekoto('about-us/visi-misi', 'view', true, true);
        // cekoto('banner', 'view', true, true);

        $this->data['css'][] = base_url('assets/libs/summernote/summernote-bs4.min.css');
        $this->data['css'][] = base_url("assets/libs/dropzone/min/dropzone.min.css");
        $this->data['css'][] = base_url("assets/libs/dropify/css/dropify.min.css");

        $this->data['js'][] = base_url("assets/libs/dropzone/min/dropzone.min.js");
        $this->data['js'][] = base_url("assets/libs/dropify/js/dropify.min.js");
        $this->data['js'][] = base_url('assets/libs/summernote/summernote-bs4.min.js');
        $this->data['js'][] = base_url('assets/custom/js/about-us/summernote.init.js');
        $this->data['js'][] = base_url('assets/custom/js/about-us/save.js');

        $data = [
            'data' => $this->global_model->_get('about', ['id' => '1'])->row()
        ];

        $this->load->templateAdmin('about/visi-misi', $data);
    }

    function save_history() {
        $this->form_validation->set_rules('history-en', 'Company Historyhome English Version', 'required');
        $this->form_validation->set_rules('history-ina', 'Company Historyhome Versi Indonesia', 'required');

        if($this->form_validation->run() == true):
            $insert = [
                'historyEN' => $this->input->post('history-en'),
                'historyINA' => $this->input->post('history-ina'),
            ];
        
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

    function history() {
		isloggedin();

        cekoto('about-us/history', 'view', true, true);
        // cekoto('banner', 'view', true, true);

        $this->data['css'][] = base_url('assets/libs/summernote/summernote-bs4.min.css');
        $this->data['css'][] = base_url("assets/libs/dropzone/min/dropzone.min.css");
        $this->data['css'][] = base_url("assets/libs/dropify/css/dropify.min.css");

        $this->data['js'][] = base_url("assets/libs/dropzone/min/dropzone.min.js");
        $this->data['js'][] = base_url("assets/libs/dropify/js/dropify.min.js");
        $this->data['js'][] = base_url('assets/libs/summernote/summernote-bs4.min.js');
        $this->data['js'][] = base_url('assets/custom/js/about-us/summernote.init.js');
        $this->data['js'][] = base_url('assets/custom/js/about-us/save.js');

        $data = [
            'data' => $this->global_model->_get('about', ['id' => '1'])->row()
        ];

        $this->load->templateAdmin('about/history', $data);
    }

    function team() {
        isloggedin();
        cekoto('about-us/team', 'view', true, true);
        
        $this->data['css'][] = base_url("assets/libs/dropzone/min/dropzone.min.css");
        $this->data['css'][] = base_url("assets/libs/dropify/css/dropify.min.css");

        $this->data['js'][] = base_url("assets/libs/dropzone/min/dropzone.min.js");
        $this->data['js'][] = base_url("assets/libs/dropify/js/dropify.min.js");
        $this->data['js'][] = base_url("assets/custom/js/about-us/team.js");

        $data = [
            'team' => $this->global_model->_get('team')
        ];
        
        $this->load->templateAdmin('about/team', $data);
    }

    function team_member() {
        $data = [
            'team' => $this->global_model->_get('team')
        ];

        $this->load->view('popoti/about/team-members', $data);
    }

    function save_team() {
        $this->form_validation->set_rules('nama', 'Name', 'required|max_length[100]');
        $this->form_validation->set_rules('position', 'Position', 'required|max_length[50]');
        $this->form_validation->set_rules('facebook', 'Facebook', 'max_length[100]');
        $this->form_validation->set_rules('twitter', 'Twitter', 'max_length[100]');
        $this->form_validation->set_rules('instagram', 'Instagram', 'max_length[100]');
        $this->form_validation->set_rules('linkedin', 'Linkedin', 'max_length[100]');
        $this->form_validation->set_rules('bio', 'Biography English Version', 'max_length[1000]');
        $this->form_validation->set_rules('bioINA', 'Biography Versi Indonesia', 'max_length[1000]');

        if($this->form_validation->run() == true):
            $picture = $_FILES['picture']['size'];
            
            $config['upload_path']   = './media/team/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['max_size']      = 1000;

            $insert = [
                'nama'      => $this->input->post('nama'),
                'position'  => $this->input->post('position'),
                'facebook'  => $this->input->post('facebook'),
                'twitter'   => $this->input->post('twitter'),
                'instagram' => $this->input->post('instagram'),
                'linkedin'  => $this->input->post('linkedin'),
                'bio'       => $this->input->post('bio'),
                'bioINA'    => $this->input->post('bioINA'),
            ];
        
            $this->load->library('upload', $config);

            if ($picture <= 0 && !$this->input->post('id')):
                $this->query_error('Please upload 1 picture');
                die();
            elseif ($picture > 0 && ! $this->upload->do_upload('picture')):
                $this->query_error($this->upload->display_errors());
                die();
            elseif ($picture > 0):
                $upload_photo = $this->upload->data();
                $insert['picture'] = $upload_photo['file_name'];
            endif;

            if ($this->input->post('id')):
                $this->global_model->_update('team', $insert, ['id' => decode($this->input->post('id'))]);
                $save = $this->db->affected_rows();
            else:
                $save = $this->global_model->_insert('team', $insert);
            endif;

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

    function edit_team($id = null) {
        if($id):
            $id = decode($id);

            $data = $this->global_model->_get('team', ['id' => $id]);

            if($data->num_rows() > 0):
                $team = $data->row();
                echo json_encode([
                    'status'    => true,
                    'id'        => encode($team->id),
                    'picture'   => $team->picture, 
                    'nama'      => $team->nama, 
                    'position'  => $team->position, 
                    'facebook'  => $team->facebook, 
                    'twitter'   => $team->twitter, 
                    'instagram' => $team->instagram, 
                    'linkedin'  => $team->linkedin,
                    'bio'       => $team->bio,
                    'bioINA'    => $team->bioINA,
                ]);
            else:
                echo json_encode([
                    'status' => 0,
                    'pesan' => 'Data not found'
                ]);
            endif;
        else:
            echo json_encode([
                'status' => 0,
                'pesan' => 'Data not found'
            ]);
        endif;
    }

    function delete_team($id = null) {
        if($id):
            $id = decode($id);

            $this->global_model->_delete('team', ['id' => $id]);

            if($this->db->affected_rows() > 0):
                echo json_encode([
                    'status' => true,
                ]);
            else:
                echo json_encode([
                    'status' => 0,
                    'pesan' => 'Data not found'
                ]);
            endif;
        else:
            echo json_encode([
                'status' => 0,
                'pesan' => 'Data not found'
            ]);
        endif;
    }
}
?>