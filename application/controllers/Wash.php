<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class : Wash
 * By : Puzha Fauzha
 */

class Wash extends MY_Controller
{	

	function __construct()
	{
		parent::__construct();
		$this->load->model(['Wash_model','service_model']);

		isloggedin();
	}

	function washer_json()
	{
		$requestData    = $_REQUEST;
		$fetch = $this->global_model->_retrieve(
		    $table = 'tb_employee a',
		    $select = 'a.*',
		    $colOrder     = array('a.nama'),
		    $filter       = array(),
		    $where        = "and position = 22",
		    $like_value   = $requestData['search']['value'], 
		    $column_order = $requestData['order'][0]['column'], 
		    $column_dir   = $requestData['order'][0]['dir'], 
		    $limit_start  = $requestData['start'], 
		    $limit_length = $requestData['length'],
		);

		$totalData      = $fetch['totalData'];
		$totalFiltered  = $fetch['totalFiltered'];
		$query          = $fetch['query'];

		$data = array();
		$no   = 1;
		foreach($query->result() as $row)
		{ 
		    $nestedData = array(); 

		    $nestedData[] = $row->nama;
		    $nestedData[] = "<a href='javascript:void(0)' class='btn btn-info waves-effect waves-light chooseWasher' data-id='$row->id'><i class='mdi mdi-cursor-pointer mr-1'></i> Choose</a>";
		    $data[] = $nestedData;
		    $no++;
		    // print_ar($row);
		}
		  // print_ar($this->db->last_query());

		$json_data = array(
		    "draw"            => intval( $requestData['draw'] ),  
		    "recordsTotal"    => intval( $totalData ),  
		    "recordsFiltered" => intval( $totalFiltered ), 
		    "data"            => $data
		    );

		echo json_encode($json_data);
	}

	function washer()
	{
		cekoto('wash','view', true, false);
		$this->load->view('popoti/wash/washer');
	}

	function summary()
	{
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

		$this->data['js'][] = base_url('assets/custom/js/wash.js');
		$this->load->templateAdmin('additional/summary');
	}
	
	function delete_summary($id)
	{
		if ($this->input->is_ajax_request()) {
		}
	}

	function index($id = false)
	{
		// print_ar($this->input->post());
		cekoto('wash', 'view', true, true);
		if($_POST)
		{
			if( ! empty($_POST['kode-barang']))
			{
				$total = COUNT($_POST['kode-barang']);

				if($total > 0)
				{
					$this->load->library('form_validation');
					$this->form_validation->set_rules('nomor_nota','Nomor Nota','trim|required|max_length[40]|alpha_numeric');
					$this->form_validation->set_rules('tanggal','Date Time','trim|required');
					$this->form_validation->set_rules('washerid','Wahser','trim|required');
					$this->form_validation->set_rules('cust-nama', 'Customer Name', 'trim|required|min_length[3]');
					$this->form_validation->set_rules('no-hp', 'No HP', 'trim|required|min_length[3]');
					$this->form_validation->set_rules('district-id', 'Disrict', 'trim|required');

					$no = 0;
					foreach($_POST['kode-barang'] as $d)
					{
						if( ! empty($d))
						{
							$this->form_validation->set_rules('kode-barang['.$no.']','Item #'.($no + 1), 'trim|required');
							$this->form_validation->set_rules('jumlah_beli['.$no.']','Qty #'.($no + 1), 'trim|numeric|required');
						}

						$no++;
					}
					
					// $this->form_validation->set_rules('cash','Cash Amount', 'trim|numeric|required|max_length[17]');

					if($this->form_validation->run() == TRUE)
					{
						// print_ar($this->input->post());	
						$nomor_nota = $this->input->post('nomor_nota');
						$tanggal    = $this->input->post('tanggal');
						$userid     = $this->input->post('userid');
						$vehicleid  = $this->input->post('vehicleid');
						$customer_id     = $this->input->post('customerid');

						// $bayar      = toFloat($this->input->post('cash'));
						$subtotal   = toFloat($this->input->post('subtotal'));
						$totaldisc  = toFloat($this->input->post('totaldisc'));
						$grandtotal = toFloat($this->input->post('grand_total'));
						$status     = $this->input->post('status');

						// if($bayar < $grandtotal)
						// {
						// 	$this->query_error("Cash Kurang");
						// }
						// else
						// {
							$no_array = 0;
							$details  = array();
							foreach($_POST['kode-barang'] as $k)
							{
								if( ! empty($k))
								{
									$kode_barang  = $_POST['kode-barang'][$no_array];
									$jumlah_beli  = $_POST['jumlah_beli'][$no_array];
									$harga_satuan = $_POST['harga_satuan'][$no_array];
									$discount     = $_POST['diskon'][$no_array];
									$sub_total    = $_POST['sub_total'][$no_array];
									
									$details[] = array(
										'washid'   => $kode_barang,
										'qty'      => $jumlah_beli,
										'harga'    => $harga_satuan,
										'diskon'   => toFloat($discount),
										'subtotal' => $sub_total,
									);
								}

								$no_array++;
							}

							if (!$customer_id) {
								$dataCustomer['nama']       = $this->input->post('cust-nama'); 
								$dataCustomer['no']         = $this->input->post('no-hp');
								$dataCustomer['desa_id']    = intval($this->input->post('district-id'));
								$dataCustomer['total_come'] = 1;
								$dataCustomer['last_service']  = date('Y-m-d H:s:i');
								$customer_id                = $this->global_model->_insert('tb_customer', $dataCustomer);
							} else {
								$dataCustomer         = [];
								$dataCustomer['nama'] = $this->input->post('cust-nama');
								$dataCustomer['no']   = $this->input->post('no-hp');
								if ($this->input->post('district-id')) {
									$dataCustomer['desa_id'] = intval($this->input->post('district-id'));
								}
							}

							$vehicle = [
								'customer_id' => $customer_id,
								'plat'        => $this->input->post('no-plat'),
								'unit_id'     => $this->input->post('unit-id'),
								'merk_id'     => $this->input->post('merkid'),
								'jenis_id'    => $this->input->post('jenisid'),
								'kategori_id' => $this->input->post('category_id'),
							];

							if (!$vehicleid) {
								$vehicleid = $this->global_model->_insert('tb_customer_vehicles', $vehicle);	
							} else {	
								$this->global_model->_update('tb_customer_vehicles', $vehicle, ['id' => $vehicleid]);
							}

							$washdata = array(
								'nota'       => $nomor_nota,
								'tanggal'    => $tanggal,
								'userid'     => $userid,
								'washerid'     => $this->input->post('washerid'),
								'vehicleid'  => $vehicleid,
								'subtotal'   => toFloat($subtotal),
								'discount'   => toFloat($totaldisc),
								'grandtotal' => toFloat($grandtotal),
								// 'cash'       => toFloat($bayar),
								'detail'     => json_encode($details),

							);

							if ($id) {
								$washid = decode($id);
								$this->global_model->_update('tb_wash', $washdata, ['id' => decode($id)]);
							}else{
								$washid = $this->global_model->_insert('tb_wash', $washdata);	
								$this->service_model->incretotalcome($customer_id,$dataCustomer);

								updateNo('WSH');							
							}

							// print_ar($this->db->last_query());


							if($this->db->affected_rows() > 0)
							{
								$source = [
									'tb_wash' => $washid,
								];

								if ($id) {
									$query = "UPDATE tb_payments set tagihan = '".toFloat($grandtotal)."' WHERE JSON_EXTRACT(source, '$.tb_wash') = '".decode($id)."'";
	                                $this->db->query($query);
								}else{
									addpayment($source, $grandtotal, $is_picking = false, $is_other = true, $table = 'tb_wash', $kategori = 'in', 0, 0, $nomor_nota);
								}
								echo json_encode(array('status' => 1, 'pesan' => "Transaksi berhasil disimpan !", 'washid' => encode($washid)));
							}
							else
							{
								$this->query_error($this->db->last_query());
							}
						// }
					}
					else
					{
						echo json_encode(array('status' => 0, 'pesan' => validation_errors("<font color='red'>- ","</font><br />")));
					}
				}
				else
				{
					$this->query_error("Harap masukan minimal 1 kode barang !");
				}
			}
			else
			{
				$this->query_error("Harap masukan minimal 1 kode barang !");
			}
		}
		else
		{
			$this->data['js'][] = base_url('assets/libs/jquery-mask-plugin/jquery.mask.min.js');
			$this->data['js'][] = base_url('assets/libs/autonumeric/autoNumeric-min.js');
			$this->data['js'][] = base_url('assets/js/pages/form-masks.init.js');
			$this->data['js'][] = base_url('assets/libs/devbridge-autocomplete/jquery.autocomplete.min.js');
			$this->data['js'][] = base_url('assets/custom/js/wash.js');

			$data = array(
				'category' => $this->global_model->_get('tb_customer_category_unit')
			);
			$this->load->templateAdmin('additional/wash', $data);
		}
	}

	function data_json()
	{
		if($this->input->is_ajax_request())
		{
			$query      = $_REQUEST['query'];
			$categoryid = $this->input->post('categoryid');

			$join = array(
				['tb_wash_harga b', 'a.id = b.wash_id AND b.catid = ' . $categoryid, 'left'],
			);

			$data = $this->global_model->_get('tb_wash_prices a', ['a.nama LIKE \'%'.$query.'%\'' => ''], [], [], 'a.id, a.nama, b.harga', $join);

			$result = array();
			if($data->num_rows() > 0)
			{
				foreach($data->result() as $items)
				{
					$result[] = array(
						'value' => $items->nama,
						'data' => $items->id,
						'harga' => $items->harga,
					);
				}
			}

			$results = array(
				'query' => $query,
				'suggestions' => $result,
			);

			echo json_encode($results);
		}
	}

	function prices()
	{
		cekoto('wash/prices', 'view', true, true);

		$this->load->model('customer_model');

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

        $this->data['js'][] = base_url('assets/custom/js/wash.js');

        $data = array(
        	'category'  => $this->customer_model->getwarna()['query'],
        );

		$this->load->templateAdmin('wash/prices', $data);
	}

 function wash_json()
	{
		if($this->input->is_ajax_request())
		{
			$requestData	= $_REQUEST;
			$fetch			= $this->wash_model->getemploye($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
			
			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 

				$nestedData[] = $row->nama;

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

	function prices_json()
	{
		// if($this->input->is_ajax_request())
		// {
			$requestData	= $_REQUEST;
			$fetch			= $this->Wash_model->getprices($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
			
			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$this->load->model('customer_model');
			$category = $this->customer_model->getwarna()['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array();

				$detail = $row->detail;
				$harga = array();
				if($detail):
					$break = explode(",", $detail);
					foreach($break as $item):
						$it = explode(':', $item);
						$harga[$it[0]] = $it[1];
					endforeach;
				endif;

				$nestedData[] = $row->nama;
				$price = 0;
				foreach($category->result() as $cat):
					$price = $harga[$cat->id];
					if(! $price)
						$price = 0;
					$nestedData[] = rupiah($price, 2);
				endforeach;
				// $nestedData[] = rupiah($row->harga, 2);

				$nestedData[]	= "<div class='btn-group'>
										<a href='".site_url('wash/tambah-prices/'.encode($row->id))."' id='EditPrices' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
										<a href='".site_url('wash/delete-prices/'.encode($row->id))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
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
		// }
	}

	function items($categoryid = '')
	{
		if($categoryid)
		{
			$data = array(
				'categoryid' => $categoryid,
			);
			$this->load->view('popoti/wash/popup-items', $data);
		}
		else
			echo json_encode([
				'status' => 0,
				'pesan'  => 'Please select one unit',
			]);
	}

	function ajax_items($categoryid)
	{
		if($this->input->is_ajax_request())
		{
			$requestData = $_REQUEST;

			$fetch			= $this->Wash_model->getprices($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length'], $categoryid);

			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array();

				$detail = $row->detail;
				$harga = array();
				if($detail):
					$break = explode(",", $detail);
					foreach($break as $item):
						$it = explode(':', $item);
						$harga[$it[0]] = $it[1];
					endforeach;
				endif;

				$nestedData[] = $row->nama;
				foreach ($harga as $catid => $price) {
					$nestedData[] = rupiah($price, 2);
				}

				$nestedData[]	= "<a href='javascript:void(0)' id='' class='btn btn-info waves-effect waves-light pilih' data-id='".$row->id."'><i class='mdi mdi-cursor-pointer mr-1'></i> Choose</a>";

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

	function tambah_prices($id = false)
	{
		if($id)
		{
			cekoto('wash/prices', 'edit', true, false);
		}
		else
		{
			cekoto('wash/prices', 'add', true, false);
		}
		$this->load->model('customer_model');
		$category = $this->customer_model->getwarna()['query'];

		if($_POST)
		{
			$this->form_validation->set_rules('nama', 'Name', 'required');
			// $this->form_validation->set_rules('harga', 'Harga', 'required');

			if($this->form_validation->run() == true)
			{
				$nama  = $this->input->post('nama');

				$newid = newid('tb_wash_prices');

				$insert = array(
					'nama'  => $nama,
				);

				if($id)
				{
					$wash_id = decode($id);

					$this->Wash_model->updateprices($insert, decode($id));
				}
				else
				{
					$insert['id'] = $newid;
					$wash_id      = $newid;

					$this->Wash_model->addprices($insert);
				}

				$this->global_model->_delete('tb_wash_harga', ['wash_id' => $wash_id]);

				foreach($_POST['harga'] as $catid => $harga)
				{
					$newhargaid = newid('tb_wash_harga');

					$this->global_model->_insert('tb_wash_harga', [
						'id'      => $newhargaid,
						'wash_id' => $wash_id,
						'catid'   => $catid,
						'harga'   => toFloat($harga),
					]);
				}

				if($this->db->affected_rows() > 0) {
					echo json_encode(array(
						'status' => 1,
						'pesan' => "<i class='fa fa-check' style='color:green;'></i> Data has been updated."
					));
				}
				else
				{
					$this->query_error("Oops, something happends, please contact developer !");
				}
			}
			else
			{
				$this->input_error();
			}
		}
		else
		{
			if($id)
			{
				$data['prices'] = $this->Wash_model->rowprices(['id' => decode($id)])->row();
			}
			else
			{
				$data['prices'] = (object) array(
					'id'    => '',
					'nama'  => '',
					'harga' => 0,
				);
			}

			$data['category'] = $category;

			$this->load->view('popoti/wash/add-prices', $data);
		}
	}

	function delete_prices($id)
		{
		if(cekoto('wash/prices', 'delete', false, false)):
			if($this->input->is_ajax_request()):
				$this->Wash_model->updateprices(['status' => '0'], decode($id));
				
				echo json_encode(array(
						'status' => 1,
						'pesan' => "<i class='fa fa-check' style='color:green;'></i> Data has been updated."
					));
			endif;
		else:
			$this->query_error('Sorry you don\'t have access to delete this data');
		endif;
	}
}