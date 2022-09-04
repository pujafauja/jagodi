
    <?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class : Report
 * By : M Ridwan
 */
class Catalog extends MY_Controller
{
    
    function __construct()
    {
        parent::__construct();
        // $this->load->model('Report_model');
        isloggedin();
    }

    function index($hal = 0)
    {
       	$this->data['js'][] = base_url('assets/custom/js/catalog.js');
       	$this->db->select('a.*, b.nama');

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->db->join('tb_sparepart b', 'a.sparepartid = b.id', 'left');
       	if (isset($_GET['search'])) {
          $this->db->like('b.nama', $this->input->get('search'), 'BOTH');
        }
        $rows = $this->db->get('tb_catalog a', 4, $data['page']);
        

        if (isset($_GET['search'])) {
           $this->db->join('tb_sparepart b', 'a.sparepartid = b.id', 'left');
           $this->db->like('b.nama', $this->input->get('search'), 'BOTH');
           $total_rows = $this->db->get('tb_catalog a')->num_rows();
        }
        else{
          $total_rows = $this->db->get('tb_catalog')->num_rows();
        }
         
        $this->load->library('pagination');
     	  $config['base_url'] = site_url('catalog/index'); //site url
        $config['total_rows'] = $total_rows; //total row
        $config['per_page'] = 5;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);
        $data['count'] = $total_rows;      

        // Membuat Style pagination untuk BootStrap v4
        
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<nav><ul class="pagination pagination-rounded justify-content-end">';
        $config['full_tag_close']   = '</ul></nav>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
      
        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
     	  $data['rows'] = $rows->result();
       	// print_ar($data);die;
    	$this->load->templateAdmin('catalog/index', $data);
    }

    function delete_catalog($id)
    {
    	if ($this->input->is_ajax_request()) {
    		$id = decode($id);
    		$this->global_model->_delete('tb_catalog', ['id' => $id]);
    		if ($this->db->affected_rows()) {
    			echo json_encode(['status' => 1, 'pesan' => 'Deleted catalogue is success']);
    		}else{
    			$this->query_error('Oops, Something happens please contact programmer !!');
    		}
    	}
    }
    function detail($id)
    {
    	$id = decode($id);
    	$data['rows'] = $this->global_model->_get('tb_catalog', ['id' => $id])->row();
    	$this->load->templateAdmin('catalog/detail', $data);

    }
    function new_catalog()
    {
    	if ($_POST) {
    		$this->form_validation->set_rules('cateogryid', 'sparepart', 'trim|required');
    		if ($this->form_validation->run() == true) {
	    		$config['upload_path'] = './upload/files';
	    		$config['allowed_types'] = 'jpg|png';
	    		$config['max_size']  = 3000;
	    		
	    		$this->load->library('upload', $config);
	    		
	    		if ( ! $this->upload->do_upload('foto-1')){
	    			$this->query_error($this->upload->display_errors());
	    		}
	    		else{
	    			$data['sparepartid'] = $this->input->post('cateogryid');
	    			$json = [];
	    			if($_FILES['foto-1']['name'])
	    				$json[] = ['foto-1' => $_FILES['foto-1']['name']];
	    			if($_FILES['foto-2']['name'])
	    				$json[] = ['foto-2' => $_FILES['foto-2']['name']];
	    			if($_FILES['foto-3']['name'])
	    				$json[] = ['foto-3' => $_FILES['foto-3']['name']];
	    			$data['detail_picture'] = json_encode($json);
	    			$this->db->insert('tb_catalog', $data);
	    			if ($this->db->affected_rows()) {
	    				echo json_encode(['status' => 1, 'pesan' => 'Catalogue Has Been Added.']);
	    			}else{
	    				$this->query_error('Opps, Something Happens Please Contact Programmer.');
	    			}
	    		}
    		} else {
    			$this->input_errors();
    		}
    	}else{

			$this->data['css'][] = base_url('assets/libs/dropzone/min/dropzone.min.css');
			$this->data['css'][] = base_url('assets/libs/dropify/css/dropify.min.css');

	        $this->data['js'][] = base_url('assets/libs/dropzone/min/dropzone.min.js');
	        $this->data['js'][] = base_url('assets/libs/dropify/js/dropify.min.js');
	       	$this->data['js'][] = base_url('assets/custom/js/catalog.js');

	       	$data['category'] = $this->global_model->_get('tb_sparepart_category')->result();
	    	$this->load->view('popoti/catalog/new-catalog', $data);
    	}


    }

}