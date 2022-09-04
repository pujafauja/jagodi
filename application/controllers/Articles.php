<?php

class Articles extends MY_Controller {

    function __construct()
    {
        parent::__construct();
    }

    function index($hlm = 1)
    {
        isloggedin();
        cekoto('articles', 'view', true, true);

        $this->data['css'][] = base_url('assets/custom/css/custom.css');
        $this->data['js'][] = base_url('assets/custom/js/articles/article-lists.js');
        
        $data = [
            'categories' => $this->global_model->_get('categories')
        ];
        
        $this->load->templateAdmin('articles/list', $data);
    }

    function tags($hlm = 1)
    {
        $this->data['jsdepan'][] = base_url('assets/mahardhika/js/article.js');
        
        $data = [
            'categories' => $this->global_model->_get('categories'),
            'recents' => $this->global_model->_get('articles', [], [], [], false, [], 3, ['id', 'DESC'])
        ];
        
        $this->load->templateFront('article/grid', $data);
    }

    function article_list($hlm = 1, $cat = NULL)
    {
        $articles = $this->global_model->_retrieve(
            'articles', 
            'id, judul, title, gambar, created_by, created_at, categories, tags, content, isi',
            [
                'id'
            ],
            [],
            NULL,
            NULL,
            0, 
            'ASC', 
            0, 
            20,
            NULL
        );

        $data = [
            'articles' => $articles,
            'start' => ($hlm * 20) - 19,
            'end' => $hlm * 20,
        ];

        $this->load->view('popoti/articles/article-lists', $data);
    }

    function post_article($id = NULL)
    {
        isloggedin();
        if($id)
            cekoto('articles/post-article', 'edit', true, true);
        else
            cekoto('articles/post-article', 'view', true, true);

        $this->data['css'][] = base_url('assets/libs/summernote/summernote-bs4.min.css');
        $this->data['css'][] = base_url("assets/libs/dropzone/min/dropzone.min.css");
        $this->data['css'][] = base_url("assets/libs/dropify/css/dropify.min.css");
        $this->data['css'][] = base_url('assets/libs/selectize/css/selectize.bootstrap3.css');
        $this->data['js'][] = base_url('assets/libs/summernote/summernote-bs4.min.js');
        $this->data['js'][] = base_url('assets/custom/js/about-us/summernote.init.js');
        $this->data['js'][] = base_url("assets/libs/dropzone/min/dropzone.min.js");
        $this->data['js'][] = base_url("assets/libs/dropify/js/dropify.min.js");
        $this->data['js'][] = base_url('assets/libs/devbridge-autocomplete/jquery.autocomplete.min.js');
        $this->data['js'][] = base_url('assets/libs/selectize/js/standalone/selectize.min.js');
        $this->data['js'][] = base_url('assets/custom/js/articles/post-article.js');

        if($id):
            $id = decode($id);

            $article = $this->global_model->_get('articles', ['id' => $id])->row();
        else:
            $article = (object) array();
        endif;
        
        $data = [
            'article' => $article
        ];
        
        $this->load->templateAdmin('articles/compose', $data);
    }

    function categories_data() {
        $query = $_REQUEST['query'];
        $categories = $this->db->like('name', $query)->get('categories');

        $cats = array();
        
        if($categories->num_rows() > 0):
            foreach($categories->result() as $cat):
                $cats[] = ['id' => $cat->id, 'value' => $cat->name];
            endforeach;
        endif;

        echo json_encode(['suggestions' => $cats]);
    }

    function add_category() {
        $data = [];
        
        $this->load->view('popoti/articles/new-category', $data);
    }

    function save_category() {
        $this->form_validation->set_rules('name', 'Category Name', 'required|max_length[50]');

        if ($this->form_validation->run() != false):
            $name = $this->input->post('name');

            if($this->input->post('id')):
                $this->global_model->_update('categories', ['name' => $name], ['id' => $this->input->post('id')]);
                $insert = $id;
            else:
                $insert = $this->global_model->_insert('categories', ['name' => $name]);
            endif;
            
            if ($this->db->affected_rows() > 0):
                echo json_encode([
                    'status' => 1,
                    'pesan' => 'New data has been added',
                    'id' => $insert,
                ]);
            else:
                echo json_encode([
                    'status' => 0,
                    'pesan' => 'System Error'
                ]);
            endif;
        else:
            $this->input_error();
        endif;
    }

    function save() {
        $this->form_validation->set_rules('judul', 'Judul', 'required|max_length[200]');
        $this->form_validation->set_rules('title', 'Title', 'required|max_length[200]');
        $this->form_validation->set_rules('content', 'Content English Version', 'required');
        $this->form_validation->set_rules('isi', 'Content Indonesia Versi', 'required');
        $this->form_validation->set_rules('categories', 'Category', 'required');
        $this->form_validation->set_rules('tags', 'Tags', 'required');

        if($this->form_validation->run() == true):
            $gambar = $_FILES['gambar']['size'];
            
            $config['upload_path']   = './media/article/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['max_size']      = 3000;

            $tags = explode(',', $this->input->post('tags'));

            $insert = [
                'judul' => $this->input->post('judul'),
                'title' => $this->input->post('title'),
                'content' => $this->input->post('content'),
                'isi' => $this->input->post('isi'),
                'categories' => $this->input->post('categories'),
                'tags' => json_encode($tags),
                'created_by' => $this->session->userdata('user'),
                'created_at' => date('Y-m-d H:i:s')
            ];
        
            $this->load->library('upload', $config);

            if ($gambar <= 0 && !$this->input->post('id')):
                $this->query_error('Please upload 1 gambar');
                die();
            elseif ($gambar > 0 && ! $this->upload->do_upload('gambar')):
                $this->query_error($this->upload->display_errors());
                die();
            elseif ($gambar > 0):
                $upload_photo = $this->upload->data();
                $insert['gambar'] = $upload_photo['file_name'];
            endif;

            if ($this->input->post('id')):
                $this->global_model->_update('articles', $insert, ['id' => decode($this->input->post('id'))]);
                $save = $this->db->affected_rows();
                saveSlug('articles/detail/'.$this->input->post('id'), create_slug($this->input->post('title')));
                saveSlug('articles/detail/'.$this->input->post('id'), create_slug($this->input->post('judul')));
            else:
                $save = $this->global_model->_insert('articles', $insert);
                saveSlug('articles/detail/'.encode($save), create_slug($this->input->post('title')));
                saveSlug('articles/detail/'.encode($save), create_slug($this->input->post('judul')));
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

    function detail($id = NULL) {
        if ($id):
            $id = decode($id);

            $detail = $this->global_model->_get(
                'articles a', 
                ['id' => $id],
                [],
                [],
                'a.id, a.judul, a.title, a.gambar, a.created_by, a.created_at, a.categories, a.tags, a.content, a.isi, u.USE_NAMA',
                [
                    ['tb_user u', 'a.created_by = u.USE_ID', 'left']
                ]
            )->row();

            $whererelated = [];
            foreach(json_decode($detail->tags) as $tag):
                $whererelated[] = 'JSON_CONTAINS(tags, \'["'.$tag.'"]\')';
            endforeach;

            $data = array(
                'article' => $detail,
                'categories' => $this->global_model->_get('categories'),
                'recents' => $this->global_model->_get('articles', [], [], [], false, [], 3, ['id', 'DESC']),
                'related' => $this->db->query("select * from articles WHERE id != $detail->id and (" . implode(' OR ', $whererelated) . ") ORDER BY RAND() LIMIT 2")
            );

            $this->load->templateFront('article/single', $data);
        endif;
    }

    function categories()
    {
        if($_POST):
            if($this->input->is_ajax_request()):
                $requestData = $_REQUEST;
                $fetch       = $this->global_model->_retrieve(
                    $table = 'categories',
                    $select = 'id, name',
                    $colOrder     = array('name'),
                    $filter       = array('name'),
                    $where        = '',
                    $like_value   = $requestData['search']['value'],
                    $column_order = $requestData['order'][0]['column'],
                    $column_dir   = $requestData['order'][0]['dir'],
                    $limit_start  = $requestData['start'],
                    $limit_length = $requestData['length'],
                    $group_by     = NULL
                );
                
                $totalData		= $fetch['totalData'];
                $totalFiltered	= $fetch['totalFiltered'];
                $query			= $fetch['query'];

                $data	= array();
                foreach($query->result() as $row)
                { 
                    $nestedData = array(); 

                    $nestedData[] = $row->name;

                    $nestedData[]	= "<div class='btn-group btn-sm'>
                                            <a href='".site_url('articles/edit-category/'.encode($row->id))."' class='btn btn-sm btn-info waves-effect waves-light edit-category'><i class='fas fa-pen-square mr-1'></i> Edit</a>
                                            <a href='".site_url('articles/delete-category/'.encode($row->id))."' class='btn btn-sm btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
                                        </div>";

                    $data[] = $nestedData;
                }

                $json_data = array(
                    "draw"            => intval( $requestData['draw'] ),  
                    "recordsTotal"    => intval( $totalData ),  
                    "recordsFiltered" => intval( $totalFiltered ), 
                    "data"            => $data
                    );

                echo json_encode($json_data);
            endif;
        else:
            isloggedin();
            cekoto('articles/categories', 'view', true, true);

            $this->data['css'][] = base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css');
            $this->data['css'][] = base_url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css');
            $this->data['css'][] = base_url('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css');
            $this->data['css'][] = base_url('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css');

            $this->data['js'][] = base_url('assets/libs/datatables.net/js/jquery.dataTables.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.html5.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.flash.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.print.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-select/js/dataTables.select.min.js');
            $this->data['js'][] = base_url('assets/libs/pdfmake/build/pdfmake.min.js');
            $this->data['js'][] = base_url('assets/libs/pdfmake/build/vfs_fonts.js');

            $this->data['js'][] = base_url('assets/custom/js/articles/categories/getdata.js');
            
            $data = array();
            
            $this->load->templateAdmin('articles/categories/list', $data);
        endif;
    }

    function delete_category($id)
    {
        $this->global_model->_delete('categories', ['id' => decode($id)]);

        if($this->db->affected_rows() > 0):
            echo json_encode([
                'status' => 1,
                'pesan' => 'Data has been deleted'
            ]);
        else:
            echo json_encode([
                'status' => 2,
                'pesan' => 'System Error'
            ]);
        endif;
    }

    function edit_category($id)
    {
        isloggedin();
        cekoto('articles/categories', 'edit');

        $data = [
            'category' => $this->global_model->_get('categories', ['id' => decode($id)])->row()
        ];
        
        $this->load->view('popoti/articles/categories/edit', $data);
    }

    function delete($id)
    {
        $this->global_model->_delete('articles', ['id' => decode($id)]);

        if($this->db->affected_rows() > 0):
             echo json_encode([
                'status' => 1,
                'pesan' => 'Data has been deleted'
            ]);
        else:
            echo json_encode([
                'status' => 2,
                'pesan' => 'System Error'
            ]);
        endif;
    }
    
}

?>