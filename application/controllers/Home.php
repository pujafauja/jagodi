<?php
/**
 * Home Page (Front End)
 */
class Home extends MY_Controller
{
	
	function __construct() {
		parent::__construct();
	}

	function init_cart() {
		if ($this->input->is_ajax_request()):
			$items = array();

			$this->load->helper('discount');

			$diskon = getDiskon();

			foreach($this->data['keranjang']->result() as $carts):
				$harga   = $carts->price;
				$totDisc = 0;

				if($diskon[$carts->productid]):
				    if(count($diskon[$carts->productid]) > 0):
				        foreach($diskon[$carts->productid] as $discounts):
				            foreach($discounts as $typeDisc => $nominal):
				                if($typeDisc == '%'):
				                    $totDisc += ($nominal / 100) * $harga;
				                    $harga -= ($nominal / 100) * $harga;
				                else:
				                    $totDisc += $nominal;
				                    $harga -= $nominal;
				                endif;
				            endforeach;
				        endforeach;
				    endif;
				endif;

				if($diskon['all']):
				    foreach($diskon['all'] as $discountsall):
				        foreach($discountsall as $typeDisc => $nominal):
				            if($typeDisc == '%'):
				                $totDisc += ($nominal / 100) * $harga;
				                $harga -= ($nominal / 100) * $harga;
				            else:
				                $totDisc += $nominal;
				                $harga -= $nominal;
				            endif;
				        endforeach;
				    endforeach;
				endif;

				$items[] = [
					'customerid' => $carts->customerid,
					'productid'  => encode($carts->productid),
					'qty'        => $carts->qty,
					'price'      => $carts->price,
					'diskon'     => $totDisc,
					'subtotal'   => rupiah($carts->qty * $harga),
					'size'       => $carts->size,
					'addItems'   => $carts->addItems,
					'status'     => $carts->status,
					'nama'       => $carts->nama,
					'images'     => $carts->images,
					'slug'       => $carts->slug
				];
			endforeach;

			echo json_encode([
				'totalItems' => $this->data['keranjang']->num_rows(),
				'items'      => $items,
				'subtotal'   => 'Rp ' . rupiah($this->data['cart']['subtotal'])
			]);
		else:
			$this->pesan_error('not found');
		endif;
	}

	function index() {
		$this->load->helper('discount');

		$diskon = getDiskon();

		// $data = array();
		$newestProducts = $this->global_model->_get(
				$table    = 'products p',
				$where    = array(),
				$where_in = array(),
				$or_where = array(),
				$select   = 'p.id, p.nama, p.slug, p.summary, p.price, p.images, c.nama category, c.id catid, c.slug catSlug',
				$join     = [['category c', 'JSON_SEARCH(p.categories, \'all\', c.id) != \'\'', 'left']],
				$limit    = 20,
				$order_by = ['p.id', 'DESC']
			);

		$newestProductsCompiled     = array();

		foreach($newestProducts->result() as $NP):
			$products = array(
				'id'      => $NP->id, 
				'nama'    => $NP->nama, 
				'slug'    => $NP->slug, 
				'summary' => $NP->summary, 
				'price'   => $NP->price, 
				'images'  => $NP->images
			);

			$newestProductsCompiled[$NP->catid][] = $NP;
		endforeach;

		$data = [
			'newestProducts' => $newestProductsCompiled,
			'featuredProducts' => $this->global_model->_get(
				$table    = 'featured f',
				$where    = array(),
				$where_in = array(),
				$or_where = array(),
				$select   = 'p.id, p.nama, p.slug, p.summary, p.price, p.images',
				$join     = [['products p', 'p.id = f.productid', 'left']],
				$limit    = 5,
				$order_by = ['p.id', 'DESC']
			),
			'topSells' => $this->global_model->_get(
				$table    = 'products p',
				$where    = array(),
				$where_in = array(),
				$or_where = array(),
				$select   = 'p.id, p.nama, p.slug, p.summary, p.price, p.images',
				$join     = array(),
				$limit    = 6,
				$order_by = ['p.sold', 'DESC']
			),
			'partners' => $this->global_model->_get(
				$table    = 'partners p',
				$where    = array(),
				$where_in = array(),
				$or_where = array(),
				$select   = 'p.id, p.nama, p.logo, p.url',
				$join     = array()
			),
			'runningTexts' => $this->global_model->_get(
				$table    = 'running_text',
				$where    = array(),
				$where_in = array(),
				$or_where = array(),
				$select   = false,
				$join     = array(),
				$limit    = false,
				$order_by = ['id', 'DESC']
			),
			'slider' => $this->global_model->_get('slider'),
			'banner' => $this->global_model->_get('banner'),
			'diskon' => $diskon
		];

		$this->load->templateFront('home', $data);
	}

	function language($lang) {
		$this->session->set_userdata(['language' => $lang]);

		redirect(base_url());
	}

	function static_page($id)
	{
		$data['static'] = $this->global_model->_get('static_page', ['id' => $id])->row();

		$this->load->templateFront('static-page/view', $data);
	}

	function account()
	{
		/*$emailTemplate = $this->global_model->_get('pp_email_template', ['id' => 1])->row();

		$emailSubject = 'Verifikasi akun Anda di ' . $this->data['webtitle'];

		$this->load->config('email');
        $this->load->library('email');
        
        $from    = $this->config->item('smtp_user');
        $to      = 'puzhafauzha@gmail.com';
        $subject = $emailSubject;
        $message = $emailTemplate->message;

        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);


        if ($this->email->send()) {
			$this->pesan_sukses('Anda berhasil daftar, Silakan cek email Anda untuk aktivasi akun Anda');
        }  else {
        	$this->pesan_error($this->email->print_debugger());
        }*/

		$this->load->templateFront('account/login');
	}

	function register()
	{
		if($this->input->is_ajax_request()):
			$rules = [
				[
					'field' => 'username',
					'label' => 'Username',
					'rules' => 'required|is_unique[customers.username]|min_length[5]|max_length[10]',
					'errors' => [
						'required' => '%s tidak boleh kosong',
						'is_unique' => '%s ini sudah digunakan.',
						'min_length' => '%s tidak boleh kurang dari 5 karakter',
						'max_length' => '%s tidak boleh lebih dari 10 karakter',
					]
				],
				[
					'field' => 'email',
					'label' => 'Alamat Email',
					'rules' => 'required|valid_email|is_unique[customers.email]|max_length[50]',
					'errors' => [
						'required' => '%s tidak boleh kosong',
						'is_unique' => '%s ini sudah digunakan.',
						'valid_email' => '%s tidak valid',
						'max_length' => '%s tidak boleh lebih dari 50 karakter',
					]
				],
				[
					'field' => 'userpass',
					'label' => 'Password',
					'rules' => 'required',
					'errors' => [
						'required' => '%s tidak boleh kosong'
					]
				],
			];

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run() === true):
				$username = $this->input->post('username');
				$email    = $this->input->post('email');
				$password = $this->input->post('userpass');

				$register = [
					'username' => $username,
					'email'    => $email,
					'password' => md5($password)
				];

				$customerid = $this->global_model->_insert('customers', $register);

				if($this->db->affected_rows() > 0):
					$emailTemplate = $this->global_model->_get('pp_email_template', ['id' => 1])->row();

					$emailSubject = 'Verifikasi akun Anda di ' . $this->data['webtitle'];

					$this->load->config('email');
			        $this->load->library('email');
			        
			        $from    = $this->config->item('smtp_user');
			        $to      = $email;
			        $subject = $emailSubject;
			        $message = $emailTemplate->message;

			        $message = str_replace('{link-aktifasi}', base_url('account/activation/'.encode($customerid)), $message);

			        $this->email->set_newline("\r\n");
			        $this->email->from($from);
			        $this->email->to($to);
			        $this->email->subject($subject);
			        $this->email->message($message);

			        if ($this->email->send()) {
						$this->pesan_sukses('Anda berhasil daftar, Silakan cek email Anda untuk aktivasi akun Anda');
			        }  else {
			        	$this->pesan_error('Akun Anda berhasil disimpan, tapi link aktifasi gagal dikirimkan');
			        }
				else:
					$this->pesan_error('Data gagal disimpan. Silakan coba lagi lain waktu');
				endif;
			else:
				$this->input_error_without_div();
			endif;

		else:
			redirect(base_url('account'));
		endif;
	}

	function login()
	{
		if($this->input->is_ajax_request()):
			$rules = [
				[
					'field' => 'name',
					'label' => 'Username / Email',
					'rules' => 'required|min_length[5]|max_length[10]',
					'errors' => [
						'required' => '%s tidak boleh kosong',
						'min_length' => '%s tidak boleh kurang dari 5 karakter',
						'max_length' => '%s tidak boleh lebih dari 10 karakter',
					]
				],
				[
					'field' => 'pass',
					'label' => 'Password',
					'rules' => 'required',
					'errors' => [
						'required' => '%s tidak boleh kosong'
					]
				],
			];

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run() === true):
				$username = $this->input->post('name');
				$password = md5($this->input->post('pass'));

				// authentication
				$customer = $this->global_model->_get('customers', [], [], ['username' => $username, 'email' => $username]);

				if($customer->num_rows() > 0):
					$customerData = $customer->row();

					$status = $customerData->status;
					$passwd = $customerData->password;

					if($password != $passwd):
						$this->pesan_error('Password yang Anda masukkan salah!');
					elseif($status != '1'):
						$this->pesan_error('Akun Anda belum aktif. Harap lakukan aktifasi terlebih dahulu');
					else:
						unset($customerData->password);

						echo json_encode([
							'status' => 1,
							'pesan'  => 'Anda telah berhasil login',
							'data'   => $customerData
						]);

						$this->session->set_userdata(['customerid' => $customerData->id]);
					endif;
				else:
					$this->pesan_error('Akun tidak ditemukan');
				endif;
			else:
				$this->input_error_without_div();
			endif;

		else:
			redirect(base_url('account'));
		endif;
	}
}
?>