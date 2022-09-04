<?php
/**
 * Contact Page (Front End)
 */
class Contact extends MY_Controller
{
	
	function __construct() {
		parent::__construct();
	}

	function index() {
		$this->load->helper('captcha');
		$this->data['jsdepan'][] = base_url('assets/mahardhika/js/contact-us.js');

		$vals = [
		    	// 'word' -> nantinya akan digunakan sebagai random teks yang akan keluar di captchanya
		        'word'          => substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6),
		        'img_path'      => './assets/images/captcha/',
		        'img_url'       => base_url('assets/images/captcha/'),
		        'img_width'     => 300,
		        'img_height'    => 60,
		        'expiration'    => 7200,
		        'word_length'   => 6,
		        'font_size'     => 100,
		        'img_id'        => 'Imageid',
		        'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
		        'colors'        => [
		                'background'=> [255, 255, 255],
		                'border'    => [255, 255, 255],
		                'text'      => [0, 0, 0],
		                'grid'      => [255, 40, 40]
		        ]
		    ];
		    
	    $captcha = create_captcha($vals);

        $this->session->set_userdata('captcha', $captcha['word']);

		$data = [
			'about'   => $this->global_model->_get('about', ['id' => '1'])->row(),
			'captcha' => $captcha['image']
		];
		
		$this->load->templateFront('contact-us', $data);
	}

	function send_message()
	{
		$post_code  = $this->input->post('captcha');
	    $captcha = $this->session->userdata('captcha');

		$emailSubject = 'New message from ' . $this->input->post('name');

		$this->load->config('email');
        $this->load->library('email');
        
        $from = $this->config->item('smtp_user');
        $to = 'info@mahardhika.co.id';
        $subject = $emailSubject;
        $message = 'Email from : '.$this->input->post('name') . "<br>";
        $message .= 'Please reply to his/her account : ' . $this->input->post('email') . ' ' . $this->input->post('phone') . "<br>";
        $message .= 'Following message : <br>';
        $message .= $this->input->post('message');


        if($post_code && ($post_code == $captcha)):
	        $this->email->set_newline("\r\n");
	        $this->email->from($from);
	        $this->email->to($to);
	        $this->email->subject($subject);
	        $this->email->message($message);

	        if ($this->email->send()) {
	            echo json_encode([
	            	'status' => 1,
	            	'pesan' => 'Your Email has successfully been sent.'
	            ]);
	        }  else {
		        echo json_encode([
		        	'status' => 2,
		        	'pesan' => $this->email->print_debugger()
		        ]);
	        }
	    else:
	    	echo json_encode([
	    		'status' => 2,
	    		'pesan' => 'Wrong captcha'
	    	]);
        endif;

	}
}
?>