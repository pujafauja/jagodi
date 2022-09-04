<?php
/**
 * About Page (Front End)
 */
class About extends MY_Controller
{
	
	function __construct() {
		parent::__construct();
	}

	function index() {
        $about = $this->global_model->_get('about', ['id' => '1'])->row();
        $about_lang = $this->lang->line('about');
        $visimisi_lang = $this->lang->line('visi-misi');
        $history_lang = $this->lang->line('history');
        
		$data = [
            'about' => $about,
			'aboutText' => $about->$about_lang,
			'visimisi' => $about->$visimisi_lang,
			'history' => $about->$history_lang,
            'team' => $this->global_model->_get('team'),
		];
		
		$this->load->templateFront('about', $data);
	}

    function our_team() {
        $data = [
            'team' => $this->global_model->_get('team'),
        ];
        
        $this->load->templateFront('our-team', $data);
    }

    function team($id) {
        $data = [
            'team' => $this->global_model->_get('team', ['id' => decode($id)])->row()
        ];

        $this->load->templateFront('team-detail', $data);
    }
}
?>