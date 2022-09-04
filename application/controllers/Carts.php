<?php

/**
 * 
 */
class Carts extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->load->helper('discount');

		$this->data['jsdepan'][] = base_url('assets/libs/autonumeric/autoNumeric-min.js');
		$this->data['jsdepan'][] = base_url('assets/duka/js/pages/cart.js');

		$data = [
			'diskon' => getDiskon()
		];

		$this->load->templateFront('transaksi/carts', $data);
	}

	function delete_product($id = false)
	{
		if($this->input->is_ajax_request()):
			if($id):
				$cart = $this->global_model->_get(
					'carts',
					[
						'productid' => decode($id),
						'ip' => $this->input->ip_address()
					]
				)->row();

				if(count($cart) > 0):
					$this->global_model->_delete('carts', ['id' => $cart->id]);

					if($this->db->affected_rows() > 0):
						$this->pesan_sukses('Produk berhasil dihapus dari keranjang Anda');
					else:
						$this->pesan_error('Produk gagal dihapus. Silakan coba beberapa saat lagi');
					endif;
				else:
					$this->pesan_error('Produk tidak ditemukan dalam keranjang Anda');
				endif;
			else:
				$this->pesan_error('Produk tidak ditemukan');
			endif;
		else:
			redirect('checkout');
		endif;
	}
}

?>