<?php

class Article extends MY_Controller {

    function __construct()
    {
        parent::__construct();
    }

    function index($hlm = 1)
    {
        $this->data['jsdepan'][] = base_url('assets/mahardhika/js/article.js');
        
        $data = [
            'categories' => $this->global_model->_get('categories'),
            'recents' => $this->global_model->_get('articles', [], [], [], false, [], 3, ['id', 'DESC'])
        ];
        
        $this->load->templateFront('article/grid', $data);
    }

    function category($id, $hlm = 1)
    {
        $this->data['jsdepan'][] = base_url('assets/mahardhika/js/article.js');
        
        $data = [
            'categories' => $this->global_model->_get('categories'),
            'recents' => $this->global_model->_get('articles', [], [], [], false, [], 3, ['id', 'DESC'])
        ];
        
        $this->load->templateFront('article/grid', $data);
    }

    function load_article($hlm = 1, $filterisasi = NULL)
    {
        $postPerPage = 8;
        $addWhere = '';
        
        if($this->input->post('additionalFilter')):
            $addWhere = $this->input->post('additionalFilter');
        endif;

        $data = [
            'articles' => $this->global_model->_retrieve(
                $table = 'articles',
                $select = '*',
                $colOrder     = array('id'),
                $filter       = array(),
                $where        = $addWhere,
                $like_value   = NULL, 
                $column_order = 0, 
                $column_dir   = 'DESC', 
                $limit_start  = ($hlm > 1) ? ($hlm * $postPerPage) - $postPerPage : 0, 
                $limit_length = $postPerPage,
                $group_by     = NULL
            ),
            'hlm' => $hlm,
            'postPerPage' => $postPerPage
        ];

        $this->load->view('mahardhika/article/article-list', $data);
    }

    function search()
    {
        $query = $this->input->get('q');

        $this->data['jsdepan'][] = base_url('assets/mahardhika/js/article.js');
        
        $data = [
            'categories' => $this->global_model->_get('categories'),
            'recents' => $this->global_model->_get('articles', [], [], [], false, [], 3, ['id', 'DESC'])
        ];
        
        $this->load->templateFront('article/grid', $data);
    }

}

?>