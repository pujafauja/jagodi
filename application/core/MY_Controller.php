<?php
class MY_Controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		// $site_lang = $this->session->userdata('language');
		// if ($site_lang) {
		// 	if ($site_lang == 'EN'):
		// 		$site_lang = 'english';
		// 	else:
		// 		$site_lang = 'indonesia';
		// 	endif;

		// 	$this->lang->load('message', $site_lang);
		// } else {
		// 	$this->lang->load('message','english');
		// }

		$this->data['categories'] = $this->global_model->_get('category');
		$this->data['cssdepan'][] = base_url('assets/libs/sweetalert2/sweetalert2.min.css');

		$this->data['jsdepan'][] = base_url('assets/libs/sweetalert2/sweetalert2.min.js');
		$this->data['jsdepan'][] = base_url('assets/duka/js/pages/main.js');

		$this->data['frontTitle'] = "Jagodi - Online shop";

		$this->data['keranjang'] = $this->global_model->_get(
			$table    = 'carts c',
			$where    = array(),
			$where_in = array(),
			$or_where = array('customerid' => $this->session->userdata('customerid'), 'ip' => $this->input->ip_address()),
			$select   = 'c.customerid, c.productid, SUM(c.qty) qty, c.price, SUM(c.subtotal) subtotal, c.size, c.addItems, c.status, p.nama, p.images, p.slug',
			$join     = array(
				['products p', 'p.id = c.productid', 'left']
			),
			$limit    = false,
			$order_by = false,
			$group_by = 'p.id'
		);

		$this->data['cart']['subtotal'] = 0;
		$this->load->helper('discount');
		$diskon   = getDiskon();
		$discount = 0;

		foreach($this->data['keranjang']->result() as $carts):
			$qty      = $carts->qty;
			$price    = $carts->price;
			$subtotal = $carts->subtotal;

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

			$price = $harga < 1 ? 0 : $harga;

			$this->data['cart']['subtotal'] += $carts->qty * $price;
		endforeach;
		$this->data['diskon'] = $diskon;

		$this->data['general'] = $this->global_model->_get('pp_settings', ['id' => '1'])->row();

		if($this->session->userdata('customerid')):
			$this->data['customer-data'] = $this->global_model->_get('customers', ['id' => $this->session->userdata('customerid')])->row();
		else:
			$this->data['customer-data'] = (object) array();
		endif;
		// $this->data['service'] = $this->global_model->_get('services');
		// $this->data['social'] = $this->global_model->_get('pp_settings', ['id' => 1])->row();
	}

	function query_error($pesan = "Terjadi kesalahan, coba lagi !")
	{
		$json['status'] = 2;
		$json['pesan'] 	= "<div class='alert alert-danger' role='danger'><i class='mdi mdi-block-helper mr-2'></i>".$pesan."</div>";
		echo json_encode($json);
	}

	function pesan_error($pesan = "System Error!")
	{
		$json['status'] = 2;
		$json['pesan'] 	= $pesan;
		echo json_encode($json);
	}

	function pesan_sukses($pesan = "Data has been added")
	{
		$json['status'] = 1;
		$json['pesan'] 	= $pesan;
		echo json_encode($json);
	}
	
	function input_error()
	{
		$json['status'] = 0;
		$json['pesan'] 	= "<div class=\"alert alert-warning\" role=\"alert\">".validation_errors()."</div>";
		echo json_encode($json);
	}
	function input_error_without_div()
	{
		$json['status'] = 0;
		$json['pesan'] 	= validation_errors();
		echo json_encode($json);
	}

	function clean_tag_input($str)
	{
		$t = preg_replace('/<[^<|>]+?>/', '', htmlspecialchars_decode($str));
		$t = htmlentities($t, ENT_QUOTES, "UTF-8");
		$t = trim($t);
		return $t;
	}

	function _create_thumbs($image_data, $path = './media/products'){
		// Image resizing config
		$config = array(
			// Large Image
			array(
				'image_library' => 'GD2',
				'source_image'  => $path.'/'.$image_data['file_name'],
				'maintain_ratio'=> FALSE,
				'width'         => 700,
				'height'        => 467,
				'new_image'     => $path.'/lg/'.$image_data['file_name']
				),
			// Medium Image
			array(
				'image_library' => 'GD2',
				'source_image'  => $path.'/'.$image_data['file_name'],
				'maintain_ratio'=> FALSE,
				'width'         => 600,
				'height'        => 400,
				'new_image'     => $path.'/md/'.$image_data['file_name']
				),
			// Small Image
			array(
				'image_library' => 'GD2',
				'source_image'  => $path.'/'.$image_data['file_name'],
				'maintain_ratio'=> FALSE,
				'width'         => 100,
				'height'        => 67,
				'new_image'     => $path.'/sm/'.$image_data['file_name']
			)
		);

		$this->load->library('image_lib', $config[0]);
		foreach ($config as $item){

			$w = $image_data['image_width']; // original image's width
			$h = $image_data['image_height']; // original images's height
			
			$n_w = $item['width']; // destination image's width
			$n_h = $item['height']; // destination image's height
			
			$source_ratio = $w / $h;
			$new_ratio    = $n_w / $n_h;

			if($source_ratio != $new_ratio){
			
				if($new_ratio > $source_ratio || (($new_ratio == 1) && ($source_ratio < 1))){
					$item['width']  = $n_w;
					$item['height'] = round($n_w/$new_ratio);
					$item['y_axis'] = round(($n_h - $item['height'])/2);
					$item['x_axis'] = 0;
				} else {
					$item['width']         = round($n_h * $new_ratio);
					$item['height']        = $n_h;
					$size_config['x_axis'] = round(($n_w - $item['width'])/2);
					$size_config['y_axis'] = 0;
				}
			
				$this->image_lib->initialize($item);
				$this->image_lib->crop();
				$this->image_lib->clear();
			}

			$item['maintain_ratio'] = TRUE;

			$this->image_lib->initialize($item);

			if(!$this->image_lib->resize())
				return false;

			$this->image_lib->clear();
		}
	}
}