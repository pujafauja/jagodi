<?php
header('Access-Control-Allow-Origin: *');

/**
 * 
 */
class Produk extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->kategori();
	}

	function sold()
	{
		$this->kategori();
	}

	function featured()
	{
		$this->kategori();
	}

	function modal($id = false) {
		$id = decode($id);
		$this->load->helper('discount');

		$data = [
			'detailProduk' => $this->global_model->_get('products', ['id' => $id])->row(),
			'diskon' => getDiskon()
		];

		$this->load->view('duka/products/product-modal', $data);
	}

	function get_stok($id, $size) {
		$id = decode($id);

		$produk = $this->global_model->_get('products', ['id' => $id])->row();

		$stoks = json_decode($produk->stocks, true);

		echo $stoks[$size];
	}

	function add_to_cart() {
		if ($this->input->is_ajax_request()):
			if($this->input->post('product')):
				$produk = $this->global_model->_get('products', ['id' => decode($this->input->post('product'))])->row();
				$this->load->helper('discount');

				$diskon = getDiskon();

				if(count($produk) > 0):
					$size     = $this->input->post('size');
					$qty      = $this->input->post('qty');
					$addItems = $this->input->post('addItems');

					// check existing products
					$existingProducts = $this->global_model->_get(
						'carts', 
						[
							'productid' => decode($this->input->post('product')),
							'ip' => $this->input->ip_address()
						]
					)->row();

					$harga = $produk->price;
					$totDisc = 0;

					$harga = $harga < 1 ? 0 : $harga;

					$cart = [
						'ip'        => $this->input->ip_address(),
						'productid' => decode($this->input->post('product')),
						'price'     => $harga,
						'qty'       => $qty,
						'size'      => $size,
						'subtotal'  => $qty * $harga,
						'addItems'  => json_encode($addItems),
						'tanggal'   => date('Y-m-d H:i:s')
					];

					if(count($existingProducts) > 0):
						$qty += $existingProducts->qty;

						$cart['qty']      = $qty;
						$cart['subtotal'] = $qty * $produk->price;

						$this->global_model->_update('carts', $cart, ['id' => $existingProducts->id]);
					else:
						$this->global_model->_insert('carts', $cart);
					endif;

					if($this->db->affected_rows() > 0):
						$this->pesan_sukses('Produk berhasil ditambahkan ke keranjang');
					else:
						$this->pesan_error('Produk gagal ditambahkan, silakan coba lagi!');
						// $this->pesan_error($this->db->last_query());
					endif;
				else:
					$this->pesan_error('Produk tidak ditemukan');
				endif;
			else:
				$this->pesan_error('Produk tidak ditemukan');
			endif;
		else:
			redirect(base_url());
		endif;
	}

	function update_cart() {
		$productID = decode($this->input->post('product'));
		$qty       = $this->input->post('qty');
		$price     = $this->input->post('price');
		$discount  = $this->input->post('discount');
		$subtotal  = $this->input->post('subtotal');

		// check existing product in cart
		$existing = $this->global_model->_get('carts', ['productid' => $productID, 'ip' => $this->input->ip_address()])->row();

		if(count($existing) > 0):
			$this->global_model->_update(
				'carts',
				[
					'qty'      => $qty,
					'price'    => $price,
					'diskon'   => $discount,
					'subtotal' => $subtotal
				],
				[
					'id' => $existing->id
				]
			);

			if($this->db->affected_rows() > 0):
				$this->pesan_sukses('Produk berhasil diubah');
			else:
				$this->pesan_error('Produk gagal diubah');
			endif;
		else:
			$this->pesan_error('Produk tidak ditemukan dalam keranjang Anda');
		endif;
	}

	function checkout() {
		if($_POST && $this->input->is_ajax_request()):
			$rules = [
				[
					'field' => 'country',
					'label' => 'Negara / Wilayah',
					'rules' => 'required',
					'errors' => [
						'required' => '%s tidak boleh kosong'
					]
				],
				[
					'field' => 'namaDepan',
					'label' => 'Nama Depan',
					'rules' => 'required',
					'errors' => [
						'required' => '%s tidak boleh kosong'
					]
				],
				[
					'field' => 'namaBelakang',
					'label' => 'Nama Belakang',
					'rules' => 'required',
					'errors' => [
						'required' => '%s tidak boleh kosong'
					]
				],
				[
					'field' => 'alamat',
					'label' => 'Alamat Rumah',
					'rules' => 'required',
					'errors' => [
						'required' => '%s tidak boleh kosong'
					]
				],
				[
					'field' => 'kabupaten',
					'label' => 'Kota / Kabupaten',
					'rules' => 'required',
					'errors' => [
						'required' => '%s tidak boleh kosong'
					]
				],
				[
					'field' => 'provinsi',
					'label' => 'Provinsi',
					'rules' => 'required',
					'errors' => [
						'required' => '%s tidak boleh kosong'
					]
				],
				[
					'field' => 'kode',
					'label' => 'Kode POS',
					'rules' => 'required',
					'errors' => [
						'required' => '%s tidak boleh kosong'
					]
				],
				[
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'required',
					'errors' => [
						'required' => '%s tidak boleh kosong'
					]
				],
				[
					'field' => 'hp',
					'label' => 'No HP / WA',
					'rules' => 'required',
					'errors' => [
						'required' => '%s tidak boleh kosong'
					]
				]
			];

			$this->form_validation->set_rules($rules);

			if($this->form_validation->run() == false):
				$this->input_error_without_div();
			else:
				$country        = $this->input->post('country');
				$namaDepan      = $this->input->post('namaDepan');
				$namaBelakang   = $this->input->post('namaBelakang');
				$namaPerusahaan = $this->input->post('namaPerusahaan');
				$alamat         = $this->input->post('alamat');
				$alamat2        = $this->input->post('alamat2');
				$kabupaten      = $this->input->post('kabupaten');
				$provinsi       = $this->input->post('provinsi');
				$kode           = $this->input->post('kode');
				$email          = $this->input->post('email');
				$hp             = $this->input->post('hp');
				$catatan        = $this->input->post('catatan');
				$pembelianNo    = $this->input->post('pembelianNo');

				$checkout = [
					'tanggal'         => date('Y-m-d'),
					'noPembelian'     => $pembelianNo,
					'waktu'           => date('H:i:s'),
					'customerid'      => 0,
					'ip'              => $this->input->ip_address(),
					'details'         => json_encode($this->data['keranjang']->result()),
					'customerDetails' => json_encode([
						'namaDepan'      => $namaDepan,
						'namaBelakang'   => $namaBelakang,
						'namaPerusahaan' => $namaPerusahaan,
						'alamat'         => $alamat,
						'alamat2'        => $alamat2,
						'kabupaten'      => $kabupaten,
						'provinsi'       => $provinsi,
						'kode'           => $kode,
						'email'          => $email,
						'hp'             => $hp,
					]),
					'catatan'      => $catatan,
					'address'      => $alamat . ' ' . $alamat2,
					'subtotal'     => $this->data['cart']['subtotal'],
					'discount'     => 0,
					'kode_voucher' => '',
					'grandtotal'   => $this->data['cart']['subtotal']
				];

				$this->global_model->_insert('orders', $checkout);

				if($this->db->affected_rows() > 0):
					$this->global_model->_delete('carts', ['ip' => $this->input->ip_address()]);

					// kurangin stok nya
					foreach($this->data['keranjang']->result() as $cart):
						$qty            = $cart->qty;
						$availableStock = $this->global_model->_get('products', ['id' => $cart->productid], [], [], 'JSON_UNQUOTE(JSON_EXTRACT(stocks, \'$.'.$cart->size.'\')) stok')->row();

						$sisastok = $availableStock - $qty;

						$this->db->set('stocks', 'JSON_SET(stocks, \'$.'.$cart->size.'\', \''.$sisastok.'\')', false)
								->set('sold', 'sold + 1', false)
								->where('id', $cart->productid)
								->update('products');
					endforeach;

					$this->pesan_sukses('Pesanan berhasil disimpan');
				else:
					// $this->pesan_error('Pesanan gagal disimpan. Silakan coba lagi nanti!');
					$this->pesan_error($this->db->last_query());
				endif;
			endif;
		else:
			$this->data['jsdepan'][] = base_url('assets/custom/raja-ongkir/index.js');
			$this->data['jsdepan'][] = base_url('assets/duka/js/pages/checkout.js');

			$data = [
				'setting' => $this->global_model->_get('pp_settings', ['id' => 1])->row()
			];

			$this->load->templateFront('transaksi/checkout', $data);
		endif;
	}

	function kategori($id = false) {
		$this->data['cssdepan'][] = base_url('assets/duka/css/ui-range-slider.css');
		$this->data['jsdepan'][] = base_url('assets/duka/js/ui-slider-range.js');

		$this->data['jsdepan'][] = base_url('assets/duka/js/pages/shop.js');

		$data = [
			'kategoriid' => array($id)
		];

		$this->load->templateFront('products/shop', $data);
	}

	function search() {
		$this->data['jsdepan'][] = base_url('assets/duka/js/pages/shop.js');

		$data = [
		];

		$this->load->templateFront('products/shop', $data);
	}

	function shop_products($hlm = 1) {
		$dataFilter = '';

		if($this->input->post('kategoriid')):
			$kats = [];

			foreach($this->input->post('kategoriid') as $kat):
				if(!in_array(decode($kat), $kats)):
					$kats[] = decode($kat);
				endif;
			endforeach;

			$dataFilter .= " AND c.id IN (".implode(', ', $kats).")";
		endif;

		if($this->input->post('sizes')):
			if(count($this->input->post('sizes'))):
				$dataFilter .= ' AND (';

				$jj = 1;
				foreach($this->input->post('sizes') as $size):
					if($jj > 1):
						$dataFilter .= ' OR ';
					endif;

					$dataFilter .= 'JSON_EXTRACT(p.stocks, \'$.'.$size.'\') > 0';
					$jj++;
				endforeach;

				$dataFilter .= ')';
			endif;
		endif;

		if($this->input->post('s') != ''):
			$search = $this->input->post('s');
		else:
			$search = null;
		endif;

		$perPage = $this->input->post('perPage');

		$order = 0;

		if($this->input->post('segment')):
			if($this->input->post('segment') == 'produk-terlaris'):
				$order = 2;
			endif;
		endif;

		$products = $this->global_model->_retrieve(
				$table        = 'products p LEFT JOIN `category` `c` ON JSON_SEARCH(p.categories, \'all\', c.id) != \'\'',
				$select       = 'p.id, p.nama, p.slug, p.summary, p.price, p.images, c.nama category, c.id catid, c.slug catSlug',
				$colOrder     = array('p.id', 'p.nama', 'p.sold'),
				$filter       = array('p.nama'),
				$where        = $dataFilter,
				$like_value   = $search, 
				$column_order = $order, 
				$column_dir   = 'DESC', 
				$limit_start  = ($hlm - 1) * $perPage, 
				$limit_length = $perPage,
				$group_by     = NULL
			);

		if($this->input->post('segment')):
			if($this->input->post('segment') == 'produk-unggulan'):
				$products = $this->global_model->_retrieve(
						$table        = 'featured f INNER JOIN products p ON f.productid = p.id LEFT JOIN `category` `c` ON JSON_SEARCH(p.categories, \'all\', c.id) != \'\'',
						$select       = 'p.id, p.nama, p.slug, p.summary, p.price, p.images, c.nama category, c.id catid, c.slug catSlug',
						$colOrder     = array('p.id', 'p.nama', 'p.sold'),
						$filter       = array('p.nama'),
						$where        = $dataFilter,
						$like_value   = $search, 
						$column_order = $order, 
						$column_dir   = 'DESC', 
						$limit_start  = ($hlm - 1) * $perPage, 
						$limit_length = $perPage,
						$group_by     = NULL
					);
			endif;
		endif;

		$this->load->helper('discount');

		$data = [
			'products'    => $products,
			'diskon'      => getDiskon(),
			'itemperpage' => $perPage,
			'hlm'         => $hlm
		];

		// print_ar($this->db->last_query());

		$this->load->view('duka/products/shop-products', $data);
	}

	function kurangi_stok()
	{
		// kurangin stok nya
		foreach($this->data['keranjang']->result() as $cart):
			$qty            = $cart->qty;
			$availableStock = $this->global_model->_get('products', ['id' => $cart->productid], [], [], 'JSON_UNQUOTE(JSON_EXTRACT(stocks, \'$.'.$cart->size.'\')) stok')->row();

			$sisastok = $availableStock->stok - $qty;

			$this->db->set('stocks', 'JSON_SET(stocks, \'$.'.$cart->size.'\', \''.$sisastok.'\')', false)
					->where('id', $cart->productid)
					->update('products');
					print_ar($this->db->last_query());
		endforeach;
	}
}

?>