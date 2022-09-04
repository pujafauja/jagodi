<?php

class Ecommerce extends MY_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		isloggedin();

		$this->products();
	}

	function categories() {
		isloggedin();

		cekoto('ecommerce/categories', 'view', true, true);

		$this->data['css'][] = base_url('assets/libs/nestable2/jquery.nestable.min.css');
		$this->data['js'][] = base_url('assets/libs/nestable2/jquery.nestable.min.js');
		$this->data['js'][] = base_url('assets/js/pages/nestable.init.js');
		$this->data['js'][] = base_url('assets/custom/js/ecommerce/categories.js');

		$kategori = $this->global_model->_get('category')->result_array();

		$data = [
			'category' => ordered_menu($kategori)
		];

		$this->load->templateAdmin('ecommerce/categories/data', $data);
	}

	function save_category($id = false) {
		isloggedin();

		if($_POST):
			$nama     = $this->input->post('name');
			$parentid = $this->input->post('parentid');

			if($id):
				$id = decode($id);
			endif;

			$this->form_validation->set_rules('name', 'Category Name', 'required|max_length[50]');

			if($this->form_validation->run() == true):
				$slug = create_slug($nama);

				$data = [
					'nama'     => $nama,
					'parentid' => $parentid,
					'slug'     => $slug
				];

				if($id):
					$this->global_model->_update('category', $data, ['id' => $id]);
					$dataid = $id;
				else:
					$dataid = $this->global_model->_insert('category', $data);
				endif;

				if($this->db->affected_rows() > 0):
					saveSlug('produk/kategori/'.$dataid, 'produk/kategori/'.$slug);

					echo json_encode(['status' => 1, 'pesan' => 'Data has been saved']);
				else:
					$this->query_error('Error in saving. There is no data to change');
				endif;

			else:
				$this->input_error();
			endif;
		else:
			redirect(base_url('ecommerce/categories'));
		endif;
	}

	function edit_category($id) {
		isloggedin();

		cekoto('ecommerce/categories', 'edit', true, true);

		$kategori = $this->global_model->_get('category')->result_array();

		$data = [
			'category' => $this->global_model->_get('category', ['id' => decode($id)])->row(),
			'categories' => ordered_menu($kategori)
		];

		$this->load->view('popoti/ecommerce/categories/edit', $data);
	}

	function delete_category($id) {
		isloggedin();

		$id = decode($id);

		if(cekoto('ecommerce/categories', 'delete')):
			$delete = $this->global_model->_delete('category', ['id' => $id]);

			if($this->db->affected_rows() > 0):
				echo json_encode([
					'status' => 1,
					'pesan' => ''
				]);
			else:
				$this->query_error('Error in deleting. There is no data to delete');
			endif;
		else:
			$this->query_error('You don\'t have acces to delete this data');
		endif;
	}

	function products() {
		isloggedin();

		cekoto('ecommerce/products', 'view', true, true);

		$this->data['js'][] = base_url('assets/custom/js/ecommerce/products.js');

		$this->load->templateAdmin('ecommerce/products/data');
	}

	function product_lists($hlm = 1) {
		isloggedin();

		cekoto('ecommerce/products', 'view', true, false);

		if($this->input->post('col-order')):
			if($this->input->post('colorder') == 'price-low'):
				$colorder = 'price';
				$coldir   = 'ASC';
			elseif($this->input->post('colorder') == 'price-high'):
				$colorder = 'price';
				$coldir   = 'DESC';
			else:
				$colorder = $this->input->post('col-order');
				$coldir   = 'DESC';
			endif;
		else:
			$colorder = 0;
			$coldir   = 'DESC';
		endif;

		$itemperpage = 8;

		$products = $this->global_model->_retrieve(
			$table = 'products',
			$select = 'id, nama, star, stocks, price, images',
			$colOrder     = array('id', 'clicked', 'price', 'sold'),
			$filter       = array('nama'),
			$where        = NULL,
			$like_value   = $this->input->post('search'), 
			$column_order = array_search($colorder, $colOrder), 
			$column_dir   = $coldir, 
			$limit_start  = ($hlm - 1) * $itemperpage, 
			$limit_length = $itemperpage,
			$group_by     = NULL
		);

		$this->load->helper('discount');

		$discount = getDiskon();

		$data = [
			'products'    => $products,
			'diskon'      => $discount,
			'hlm'         => $hlm,
			'itemperpage' => $itemperpage
		];

		$this->load->view('popoti/ecommerce/products/product-lists', $data);
	}

	function product_modal_lists($hlm = 1) {
		isloggedin();

		$wheres = $this->input->post('wheres');
		$insertedItems = $this->input->post('insertedItems');

		$alreadyInserted = [];

		if($insertedItems):
			if(count($insertedItems) > 0):
				foreach($insertedItems as $inserted):
					$alreadyInserted[] = decode($inserted);
				endforeach;
			endif;
		endif;

		if(count($alreadyInserted) > 0):
			$wheres .= " AND id NOT IN (".implode(',', $alreadyInserted).")";
		endif;

		cekoto('ecommerce/products', 'view', true, false);

		if($this->input->post('col-order')):
			if($this->input->post('colorder') == 'price-low'):
				$colorder = 'price';
				$coldir   = 'ASC';
			elseif($this->input->post('colorder') == 'price-high'):
				$colorder = 'price';
				$coldir   = 'DESC';
			else:
				$colorder = $this->input->post('col-order');
				$coldir   = 'DESC';
			endif;
		else:
			$colorder = 0;
			$coldir   = 'DESC';
		endif;

		$itemperpage = 8;

		$products = $this->global_model->_retrieve(
			$table = 'products',
			$select = 'id, nama, star, stocks, price, images',
			$colOrder     = array('id', 'clicked', 'price', 'sold'),
			$filter       = array('nama'),
			$where        = $wheres,
			$like_value   = $this->input->post('search'), 
			$column_order = array_search($colorder, $colOrder), 
			$column_dir   = $coldir, 
			$limit_start  = ($hlm - 1) * $itemperpage, 
			$limit_length = $itemperpage,
			$group_by     = NULL
		);

		$this->load->helper('discount');

		$diskon = getDiskon();

		$data = [
			'products'    => $products,
			'diskon'      => $diskon,
			'hlm'         => $hlm,
			'itemperpage' => $itemperpage
		];

		$this->load->view('popoti/ecommerce/products/product-modal-lists', $data);
	}

	function new_product() {
		isloggedin();

		cekoto('ecommerce/products', 'add', true, true);

		$this->data['css'][] = base_url('assets/libs/summernote/summernote-bs4.min.css');
        $this->data['css'][] = base_url("assets/libs/dropify/css/dropify.min.css");

        $this->data['js'][] = base_url('assets/libs/summernote/summernote-bs4.min.js');
        $this->data['js'][] = base_url('assets/libs/select2/js/select2.min.js');
        $this->data['js'][] = base_url("assets/libs/dropify/js/dropify.min.js");
        $this->data['js'][] = base_url('assets/js/pages/add-product.init.js');

        $this->data['js'][] = base_url('assets/custom/js/ecommerce/products.js');

        $kategori = $this->global_model->_get('category')->result_array();

        $data = [
        	'category' => ordered_menu($kategori)
        ];

		$this->load->templateAdmin('ecommerce/products/add-new', $data);
	}

	function edit_product($id = false) {
		isloggedin();

		if($id):
			cekoto('ecommerce/products', 'edit', true, true);

			$id = decode($id);
			$detail = $this->global_model->_get('products', ['id' => $id]);

			if($detail->num_rows() > 0):
				$this->data['css'][] = base_url('assets/libs/summernote/summernote-bs4.min.css');
		        $this->data['css'][] = base_url("assets/libs/dropify/css/dropify.min.css");

		        $this->data['js'][] = base_url('assets/libs/summernote/summernote-bs4.min.js');
		        $this->data['js'][] = base_url('assets/libs/select2/js/select2.min.js');
		        $this->data['js'][] = base_url("assets/libs/dropify/js/dropify.min.js");
		        $this->data['js'][] = base_url('assets/js/pages/add-product.init.js');

		        $this->data['js'][] = base_url('assets/custom/js/ecommerce/products.js');

		        $kategori = $this->global_model->_get('category')->result_array();

		        $data = [
		        	'category' => ordered_menu($kategori),
		        	'detail'   => $detail->row()
		        ];

				$this->load->templateAdmin('ecommerce/products/add-new', $data);
			endif;
		else:
			redirect(base_url('errors/notfound'));
		endif;
	}

	function product_detail($id = false) {
		$source = $this->uri->segment(1);
		$this->load->helper('discount');

		if($source == 'produk'):
			$data = [
				'detail' => $this->global_model->_get('products', ['id' => $id])->row(),
				'diskon' => getDiskon()
			];

			$this->load->templateFront('products/detail', $data);
		else:
			isloggedin();

			if($id):
				cekoto('ecommerce/products', 'view', true, true);

				$id = decode($id);
				$detail = $this->global_model->_get('products', ['id' => $id]);

				if($detail->num_rows() > 0):
					$data = [
						'detail' => $detail->row(),
						'diskon' => getDiskon($id)
					];

					$this->load->templateAdmin('ecommerce/products/detail', $data);
				endif;
			else:
				redirect(base_url('errors/notfound'));
			endif;
		endif;
	}

	function save_product($id = false) {
		isloggedin();

		if($_POST):

			$nama            = $this->input->post('nama');
			$description     = $this->input->post('description');
			$summary         = $this->input->post('summary');
			$price           = $this->input->post('price');
			$comment         = $this->input->post('comment');
			$sizes           = $this->input->post('sizes');
			$stocks          = $this->input->post('stocks');
			$categories      = $this->input->post('categories');
			$file            = $this->input->post('file');
			$metaTitle       = $this->input->post('metaTitle');
			$metaKeywords    = $this->input->post('metaKeywords');
			$metaDescription = $this->input->post('metaDescription');

			$addItems = [];

			if(count($this->input->post('addTitles')) > 0 && $_POST['addTitles'][0] != ''):
				foreach($this->input->post('addTitles') as $titleKey => $addTitle):
					$addItems[$addTitle] = $_POST['addValues'][$titleKey];
				endforeach;
			endif;

			if($id):
				$id = decode($id);
			endif;

			$this->form_validation->set_rules('nama', 'Product Name', 'required|max_length[100]');
			$this->form_validation->set_rules('description', 'Product Description', 'required');
			$this->form_validation->set_rules('price', 'Price', 'required');

			if(count($categories) < 1 || $categories[0] == ''):
				$this->query_error('Please select at least 1 category');
				exit();
			endif;

			if(count($sizes) < 1 || $sizes[0] == ''):
				$this->pesan_error('Sizes can not be empty');
				exit();
			endif;

			$stockEmpty = array();
			$stok = [];
			for($ii = 0; $ii < count($sizes); $ii++):
				if($stocks[$ii] == ''):
					$stockEmpty[] = $ii;
				endif;

				$stok[$sizes[$ii]] = $stocks[$ii];
			endfor;

			if(count($stockEmpty) > 0):
				$errorStock = '';
				foreach($stockEmpty as $em):
					$errorStock .= '<p>Stock for size <strong>'.$sizes[$em].'</strong> can not be blank</p>';
				endforeach;

				$this->pesan_error($errorStock);
				exit();
			endif;

			if($this->form_validation->run() == true):
				// data preparation
				$slug = create_slug($nama);
				$data = [
					'nama'            => $nama,
					'description'     => $description,
					'summary'         => $summary,
					'price'           => $price,
					'comment'         => $comment,
					'sizes'           => json_encode($sizes),
					'stocks'          => json_encode($stok),
					'categories'      => json_encode($categories),
					'metaTitle'       => $metaTitle,
					'metaKeywords'    => $metaKeywords,
					'metaDescription' => $metaDescription,
					'slug'            => $slug,
					'addItems'        => json_encode($addItems)
				];

				// initiate uploading pictures
				$images = [];

				$imageCount = count($_FILES['pictures']['name']);

				for ($i=0; $i < $imageCount; $i++):
					$no = $i + 1;

					$_FILES['picture']['name']     = $_FILES['pictures']['name'][$i];
					$_FILES['picture']['type']     = $_FILES['pictures']['type'][$i];
					$_FILES['picture']['tmp_name'] = $_FILES['pictures']['tmp_name'][$i];
					$_FILES['picture']['error']    = $_FILES['pictures']['error'][$i];
					$_FILES['picture']['size']     = $_FILES['pictures']['size'][$i];

					$gambar = $_FILES['picture']['size'];
					
					$config['upload_path']   = './media/products/';
					$config['allowed_types'] = 'png|jpg|jpeg';
					$config['max_size']      = 3000;
					// $config['file_name']     = $slug . ' ' . $no;
					$config['remove_spaces'] = true;
					$config['encrypt_name']  = true;

					$this->load->library('upload', $config);
					$this->upload->overwrite = true;

					if ($gambar > 0 && ! $this->upload->do_upload('picture')):
					    $this->query_error($this->upload->display_errors());
					    die();
					elseif ($gambar > 0):
						$uploadImage = $this->upload->data();

						$this->_create_thumbs($uploadImage);

						$images[] = $uploadImage['file_name'];
					endif;
				endfor;

				// mention images data to insert
				if(count($images) > 0):
					$data['images'] = json_encode($images);
				endif;

				if($id):
					$this->global_model->_update('products', $data, ['id' => $id]);
					$dataid = $id;
				else:
					$dataid = $this->global_model->_insert('products', $data);
				endif;

				if($this->db->affected_rows() > 0):
					saveSlug('ecommerce/product-detail/'.$dataid, 'produk/'.$slug);

					echo json_encode(['status' => 1, 'pesan' => 'Data has been saved']);
				else:
					// $this->query_error('Error in saving. There is no data to change');
					$this->query_error($this->db->last_query());
				endif;

			else:
				$this->input_error();
			endif;
		endif;
	}

	function delete_product($id = false) {
		isloggedin();

		if($id):
			if(cekoto('ecommerce/products', 'delete')):
				$id = decode($id);

				$this->global_model->_delete('products', ['id' => $id]);

				if($this->db->affected_rows() > 0):
					echo json_encode([
						'status' => 1,
						'pesan' => 'Data has been deleted'
					]);
				else:
					$this->query_error('System error');
				endif;
			else:
				$this->query_error('Yout don\'t have access to delete this data');
			endif;
		else:
			$this->query_error('Data not found');
		endif;
	}

	function discounts() {
		isloggedin();

		cekoto('ecommerce/discounts', 'view', true, true);

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

        $this->data['js'][] = base_url('assets/custom/js/ecommerce/discounts.js');

		$this->load->templateAdmin('ecommerce/discounts/data');
	}

	function retrieve_discounts() {
		isloggedin();

		// if($this->input->is_ajax_request())
		// {
			$requestData	= $_REQUEST;

			$fetch			= $this->global_model->_retrieve(
				$table = 'discounts',
				$select = 'id, nama, awal, akhir, type, typeDisc, nominal, productid, kategoriid',
				$colOrder     = array('nama', 'awal', '', 'nominal'),
				$filter       = array('nama'),
				$where        = NULL,
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

				$totalProd = 0;

				if($row->type == 'all'):
					$totalProd = $this->global_model->_get('products')->num_rows();
				elseif($row->type == 'product'):
					$totalProd = count(json_decode($row->productid));
				elseif($row->type == 'kategori'):
					$categories = $this->global_model->_get(
						$table    = 'category a',
						$where    = array(),
						$where_in = array('a.id' => json_decode($row->kategoriid)),
						$or_where = array(),
						$select   = 'a.id id1, b.id id2, c.id id3',
						$join     = array(
							['category b', 'a.id = b.parentid', 'left'],
							['category c', 'b.id = c.parentid', 'left']
						),
						$limit    = false,
						$order_by = false,
						$group_by = false
					)->result();

					// print_ar($this->db->last_query());
					// die();

					$allCategories = array();
					foreach($categories as $cats):
						if($cats->id1):
							array_push($allCategories, $cats->id1);
						endif;
						if($cats->id2):
							array_push($allCategories, $cats->id2);
						endif;
						if($cats->id3):
							array_push($allCategories, $cats->id3);
						endif;
					endforeach;

					foreach($allCategories as $allCats):
						$whereor['JSON_SEARCH(categories, \'all\', '.$allCats.') != '] = '';
					endforeach;

					$totalProd = $this->global_model->_get(
						'products',
						[],
						[],
						$whereor
					)->num_rows();

				endif;

				$nestedData[] = $row->nama;
				$nestedData[] = tanggalindo($row->awal) . ' - ' . tanggalindo($row->akhir);
				$nestedData[] = $totalProd;
				$nestedData[] = $row->typeDisc == '%' ? $row->nominal . ' %' : 'Rp ' . rupiah($row->nominal);

				$nestedData[]	= "<div class='btn-group'>
										<a href='".site_url('ecommerce/edit-discount/'.encode($row->id))."' id='EditDiscount' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
										<a href='".site_url('ecommerce/delete-discount/'.encode($row->id))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
									</div>";
				
				$nestedData[] = tgl($row->tanggal);

				$data[] = $nestedData;
			}

			$json_data = array(
				"draw"            => intval( $requestData['draw'] ),  
				"recordsTotal"    => intval( $totalData ),  
				"recordsFiltered" => intval( $totalFiltered ), 
				"data"            => $data
				);

			echo json_encode($json_data);
		// }
	}

	function add_discount($id = false) {
		isloggedin();

		cekoto('ecommerce/discounts', 'add', true, true);

		$this->data['js'][] = base_url('assets/custom/js/ecommerce/discounts.js');

		$kategori = $this->global_model->_get('category')->result_array();

		$data = [
			'discount' => $this->global_model->_get('discounts', ['id' => decode($id)])->row(),
			'category' => ordered_menu($kategori)
		];

		$this->load->templateAdmin('ecommerce/discounts/add-new', $data);
	}

	function edit_discount($id = false) {
		isloggedin();

		if($id):
			$this->add_discount($id);
		else:
			redirect(base_url('errors/notfound'));
		endif;
	}

	function save_discount($id = false) {
		isloggedin();

		if($_POST):
			$nama     = $this->input->post('nama');
			$awal     = $this->input->post('awal');
			$akhir    = $this->input->post('akhir');
			$type     = $this->input->post('type');
			$typeDisc = $this->input->post('typeDisc');
			$nominal  = toFloat($this->input->post('nominal'));

			if($id):
				$id = decode($id);
			endif;

			$this->form_validation->set_rules('nama', 'Product Name', 'required|max_length[200]');
			$this->form_validation->set_rules('awal', 'Periode', 'required');
			$this->form_validation->set_rules('akhir', 'Periode', 'required');
			$this->form_validation->set_rules('type', 'Discount For', 'required');
			$this->form_validation->set_rules('typeDisc', 'Discount Type', 'required');
			$this->form_validation->set_rules('nominal', 'Disc. Amount', 'required');

			if ($type == 'kategori'):
				if(count($this->input->post('categories')) < 1):
					$this->pesan_error('Please select at least one category');
					die();
				else:
					$categories = $this->input->post('categories');
				endif;
			endif;

			if ($type == 'product'):
				if(count($this->input->post('products')) < 1):
					$this->pesan_error('Please select at least one product');
					die();
				else:
					$products = $this->input->post('products');
				endif;
			endif;

			if($this->form_validation->run() == true):
				// data preparation
				$data = [
					'nama'     => $nama,
					'awal'     => $awal,
					'akhir'    => $akhir,
					'type'     => $type,
					'typeDisc' => $typeDisc,
					'typeDisc' => $typeDisc,
					'nominal'  => $nominal,
				];

				if($type == 'kategori'):
					$data['kategoriid'] = json_encode($categories);
				endif;

				if($type == 'product'):
					$data['productid'] = json_encode($products);
				endif;

				if($id):
					$this->global_model->_update('discounts', $data, ['id' => $id]);
					$dataid = $id;
				else:
					$dataid = $this->global_model->_insert('discounts', $data);
				endif;

				if($this->db->affected_rows() > 0):
					echo json_encode(['status' => 1, 'pesan' => 'Data has been saved']);
				else:
					$this->query_error('Error in saving. There is no data to change');
					// $this->query_error($this->db->last_query());
				endif;

			else:
				$this->input_error();
			endif;
		endif;
	}

	function featured() {
		isloggedin();

		cekoto('ecommerce/featured', 'view', true, true);

		$this->data['js'][] = base_url('assets/custom/js/ecommerce/featured.js');

		$data = [];

		$this->load->templateAdmin('ecommerce/featured/data', $data);
	}

	function featured_lists($hlm = 1) {
		isloggedin();

		cekoto('ecommerce/featured', 'view', true, false);

		if($this->input->post('col-order')):
			if($this->input->post('colorder') == 'price-low'):
				$colorder = 'p.price';
				$coldir   = 'ASC';
			elseif($this->input->post('colorder') == 'price-high'):
				$colorder = 'p.price';
				$coldir   = 'DESC';
			else:
				$colorder = $this->input->post('col-order');
				$coldir   = 'DESC';
			endif;
		else:
			$colorder = 0;
			$coldir   = 'DESC';
		endif;

		$itemperpage = 8;

		$products = $this->global_model->_retrieve(
			$table = 'featured f LEFT JOIN products p ON f.productid = p.id',
			$select = 'f.id featuredID, p.id, p.nama, p.star, p.stocks, p.price, p.images',
			$colOrder     = array('p.id', 'p.clicked', 'p.price', 'p.sold'),
			$filter       = array('p.nama'),
			$where        = NULL,
			$like_value   = $this->input->post('search'), 
			$column_order = array_search($colorder, $colOrder), 
			$column_dir   = $coldir, 
			$limit_start  = ($hlm - 1) * $itemperpage, 
			$limit_length = $itemperpage,
			$group_by     = NULL
		);

		$this->load->helper('discount');

		$diskon = getDiskon();

		$data = [
			'products'    => $products,
			'diskon'      => $diskon,
			'hlm'         => $hlm,
			'itemperpage' => $itemperpage
		];

		$this->load->view('popoti/ecommerce/featured/featured-lists', $data);
	}

	function products_modal() {
		isloggedin();

		cekoto('ecommerce/products', 'view', true, false);

		$data = [];

		$this->load->view('popoti/ecommerce/products/products-modal', $data);
	}

	function new_featured() {
		isloggedin();


		$data = [];

		$this->products_modal();
	}

	function add_new_featured() {
		isloggedin();

		if($this->input->post('id')):
			$this->global_model->_insert('featured', ['productid' => decode($this->input->post('id'))]);
			if($this->db->affected_rows() > 0):
				$this->pesan_sukses();
			else:
				$this->pesan_error();
			endif;
		else:
			$this->pesan_error('Please select one product');
		endif;
	}

	function delete_featured($id = false) {
		isloggedin();

		if($id):
			$id = decode($id);

			if(cekoto('ecommerce/featured', 'delete')):
				$this->global_model->_delete('featured', ['id' => $id]);
				if($this->db->affected_rows() > 0):
					$this->pesan_sukses('Your data has been removed');
				else:
					$this->pesan_error($this->db->last_query());
				endif;
			else:
				$this->pesan_error('You don\'t have access to delete this data');
			endif;
		else:
			$this->pesan_error('Please select one product');
		endif;
	}

	function partners() {
		isloggedin();

		cekoto('ecommerce/partners', 'view', true, true);

        $this->data['css'][] = base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css');
        $this->data['css'][] = base_url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css');
        $this->data['css'][] = base_url('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css');
        $this->data['css'][] = base_url('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css');
        $this->data['css'][] = base_url("assets/libs/dropify/css/dropify.min.css");


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
        $this->data['js'][] = base_url("assets/libs/dropify/js/dropify.min.js");

        $this->data['js'][] = base_url('assets/custom/js/ecommerce/partners.js');

		$this->load->templateAdmin('ecommerce/partners/view');
	}

	function retrieve_partners() {
		isloggedin();

		if($this->input->is_ajax_request())
		{
			$requestData	= $_REQUEST;

			$fetch			= $this->global_model->_retrieve(
				$table = 'partners',
				$select = 'id, nama, logo, url',
				$colOrder     = array('nama'),
				$filter       = array('nama'),
				$where        = NULL,
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

				$totalProd = 0;

				if($row->type == 'all'):
					$totalProd = $this->global_model->_get('products')->num_rows();
				elseif($row->type == 'product'):
					$totalProd = count(json_decode($row->productid));
				elseif($row->type == 'kategori'):

				endif;

				$nestedData[] = '<img src="'.base_url('media/partners/sm/'.$row->logo).'" class="mr-2">' . $row->nama;
				$nestedData[] = $row->url;

				$nestedData[]	= "<div class='btn-group'>
										<a href='".site_url('ecommerce/edit-partner/'.encode($row->id))."' id='Editpartner' class='btn btn-sm btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
										<a href='".site_url('ecommerce/delete-partner/'.encode($row->id))."' class='btn btn-sm btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
									</div>";
				
				$nestedData[] = tgl($row->tanggal);

				$data[] = $nestedData;
			}

			$json_data = array(
				"draw"            => intval( $requestData['draw'] ),  
				"recordsTotal"    => intval( $totalData ),  
				"recordsFiltered" => intval( $totalFiltered ), 
				"data"            => $data
				);

			echo json_encode($json_data);
		}
	}

	function add_partner($id = false) {
		isloggedin();

		cekoto('ecommerce/partners', 'add', true, false);

		$partner = $this->global_model->_get('partners', ['id' => decode($id)]);

		$data = [
			'partner' => $partner->row()
		];

		$this->load->view('popoti/ecommerce/partners/add-new', $data);
	}

	function edit_partner($id = false) {
		isloggedin();

		cekoto('ecommerce/partners', 'edit', true, false);

		$this->add_partner($id);
	}

	function save_partner($id = false) {
		isloggedin();

		if($_POST):
			$nama            = $this->input->post('nama');
			$url             = $this->input->post('url');

			if($id):
				$id = decode($id);
			endif;

			$this->form_validation->set_rules('nama', 'Partner Name', 'required|max_length[100]');
			$this->form_validation->set_rules('url', 'URL / Website', 'required|max_length[250]');

			if($this->form_validation->run() == true):
				// data preparation
				$data = [
					'nama' => $nama,
					'url'  => $url,
				];

				// initiate uploading pictures
				$gambar = $_FILES['logo']['size'];
				
				$config['upload_path']   = './media/partners/';
				$config['allowed_types'] = 'png|jpg|jpeg';
				$config['max_size']      = 3000;
				$config['remove_spaces'] = true;
				$config['encrypt_name']  = true;

				$this->load->library('upload', $config);
				$this->upload->overwrite = true;

				if ($gambar > 0 && ! $this->upload->do_upload('logo')):
				    $this->query_error($this->upload->display_errors());
				    die();
				elseif ($gambar > 0):
					$uploadImage = $this->upload->data();

					$this->_create_thumbs($uploadImage, './media/partners');

					$data['logo'] = $uploadImage['file_name'];
				endif;

				if($id):
					$this->global_model->_update('partners', $data, ['id' => $id]);
					$dataid = $id;
				else:
					$dataid = $this->global_model->_insert('partners', $data);
				endif;

				if($this->db->affected_rows() > 0):
					$this->pesan_sukses('Data has been saved');
				else:
					$this->pesan_error('Error in saving. There is no data to change');
				endif;

			else:
				$this->input_error();
			endif;
		endif;
	}

	function delete_partner($id = false) {
		isloggedin();

		if(cekoto('ecommerce/partners', 'delete')):
			$id = decode($id);

			$data = $this->global_model->_get('partners', ['id' => $id])->row();
			$logo = $data->logo;

			$this->global_model->_delete('partners', ['id' => $id]);

			if($this->db->affected_rows() > 0):
				unlink('./media/partners/'.$logo); // remove original logo
				unlink('./media/partners/sm/'.$logo); // remove small logo
				unlink('./media/partners/md/'.$logo); // remove medium logo
				unlink('./media/partners/lg/'.$logo); // remove large logo

				$this->pesan_sukses('Your data has been removed');
			else:
				$this->pesan_error();
			endif;
		else:
			$this->pesan_error('You don\'t have access to delete this data');
		endif;
	}

	function orders() {
		isloggedin();

		cekoto('ecommerce/orders', 'view', true, true);

		if($this->input->is_ajax_request()):
			$requestData	= $_REQUEST;

			$fetch			= $this->global_model->_retrieve(
				$table        = 'orders',
				$select       = 'id, noPembelian, tanggal, waktu, details, grandtotal, status',
				$colOrder     = array('noPembelian', 'tanggal', 'grandtotal', 'status'),
				$filter       = array('noPembelian', 'tanggal', 'grandtotal', 'status'),
				$where        = NULL,
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

				switch ($row->status) {
					case '1':
						$status = '<h5><span class="badge badge-default">Order Placed</span></h5>';
						break;
					case '2':
						$status = '<h5><span class="badge badge-info">Paid</span></h5>';
						break;
					case '3':
						$status = '<h5><span class="badge badge-primary">Shipped</span></h5>';
						break;
					case '4':
						$status = '<h5><span class="badge badge-primary">Delivered</span></h5>';
						break;
					
					default:
						// code...
						break;
				}

				$nestedData[] = '<a href="'.base_url('ecommerce/order-detail/'.encode($row->id)).'">#'.$row->noPembelian.'</a>';
				$nestedData[] = tanggalindo($row->tanggal) . ' <small class="text-muted">' . $row->waktu . '</small>';
				$nestedData[] = 'Rp ' . rupiah($row->grandtotal);
				$nestedData[] = '<a href="'.base_url('ecommerce/order-status/'.encode($row->id)).'">'.$status.'</a>';

				$nestedData[]	= '<a class="action-icon" href="'.base_url('ecommerce/order-detail/'.encode($row->id)).'"><i class="mdi mdi-eye"></i></a>';
				
				$data[] = $nestedData;
			}

			$json_data = array(
				"draw"            => intval( $requestData['draw'] ),  
				"recordsTotal"    => intval( $totalData ),  
				"recordsFiltered" => intval( $totalFiltered ), 
				"data"            => $data
				);

			echo json_encode($json_data);

		else:
			$this->data['css'][] = base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css');
			$this->data['css'][] = base_url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css');
			$this->data['css'][] = base_url('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css');
			$this->data['css'][] = base_url('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css');
			$this->data['css'][] = base_url("assets/libs/dropify/css/dropify.min.css");

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
			$this->data['js'][] = base_url("assets/libs/dropify/js/dropify.min.js");

			$this->data['js'][] = base_url('assets/custom/js/ecommerce/orders.js');

			$this->load->templateAdmin('ecommerce/orders/data');
		endif;
	}

	function order_detail($id = false)
	{
		isloggedin();

		cekoto('ecommerce/orders', 'view', true, true);

		if($id):
			$order = $this->global_model->_get('orders', ['id' => decode($id)])->row();

			if(count($order) > 0):
				$data = [
					'order' => $order
				];

				$this->load->templateAdmin('ecommerce/orders/detail', $data);
			else:
				redirect(base_url('orders'));
			endif;
		endif;
	}

}