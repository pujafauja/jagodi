<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class : Sparepart
 * By : Puzha Fauzha
 */
class Sparepart extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('sparepart_model');
		isloggedin();
	}

	function abc_category()
	{

		cekoto('sparepart/abc-category', 'view', true, true);

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

        $this->data['js'][] = base_url('assets/custom/js/sparepart.js');

        $this->load->templateAdmin('sparepart/abc-category');
	}

	function abc_json()
	{
		if($this->input->is_ajax_request())
		{
			$requestData	= $_REQUEST;
			$fetch			= $this->sparepart_model->getabcdata($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
			
			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 

				$nestedData[] = $row->code;
				$nestedData[] = $row->logical;
				$nestedData[] = $row->weeks;
				$nestedData[] = $row->amount;
				$nestedData[] = $row->lower;
				$nestedData[] = $row->upper;
				$nestedData[] = $row->roq;

				$nestedData[]	= "<div class='btn-group'>
										<a href='".site_url('sparepart/new-abc-category/'.encode($row->id))."' id='TambahABC' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
										<a href='".site_url('sparepart/delete-abc-category/'.encode($row->id))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
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
		}
	}

	function index()
	{
        $this->sparepart();
	}

	function sparepart()
	{

		cekoto('sparepart', 'view', true, true);

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

        $this->data['js'][] = base_url('assets/custom/js/sparepart.js');

		$this->load->templateAdmin('sparepart/sparepart-data');
	}

	function sparepart_json($is_bekas = false)
	{
		// if($this->input->is_ajax_request())
		// {
			$requestData	= $_REQUEST;
			$fetch			= $this->sparepart_model->getsparepart($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length'], $is_bekas);
			
			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];
			// echo $this->db->last_query();
			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 

				$nestedData[] = $row->kode;
				$nestedData[] = $row->category;
				$nestedData[] = $row->nama;
				$nestedData[] = rupiah($row->harga, 0);
				// $nestedData[] = rupiah($row->hpp_baru, 0);
				// $nestedData[] = rupiah($row->hpp_average, 0);
				// $nestedData[] = rupiah($row->discount, 2);
				// $nestedData[] = rupiah($row->program);
				// $nestedData[] = rupiah($row->vat, 2);
				// $nestedData[] = rupiah($row->margin, 2);
				$nestedData[] = rupiah($row->het, 2);
				// $nestedData[] = rupiah($row->het1, 0);
				// $nestedData[] = rupiah($row->margin1, 0);
				// $nestedData[] = rupiah($row->het2, 0);
				// $nestedData[] = rupiah($row->margin2, 0);
				// $nestedData[] = rupiah($row->het3, 0);
				// $nestedData[] = rupiah($row->margin3, 0);
				// $nestedData[] = rupiah($row->grosir, 0);
				// $nestedData[] = rupiah($row->margin_grosir, 0);

				$nestedData[]	= "<div class='btn-group'>
										<a href='".site_url('sparepart/tambah-sparepart/'.encode($row->id))."' id='TambahSparepart' class='btn btn-primary waves-effect waves-light'><i class='fas fa-edit mr-1'></i> Edit</a>
										<a href='".site_url('sparepart/delete-sparepart/'.encode($row->id))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
										<a href='".site_url('sparepart/detail-sparepart/'.encode($row->id))."' id='detail-sparepart' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Detail</a>
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

	function detail_sparepart($id)
	{
		$id = decode($id);
		$data['row'] = $this->sparepart_model->detail($id);
		$this->load->view('popoti/sparepart/detail', $data);
	}

	function popup()
	{
		cekoto('sparepart', 'view', true, false);
		$data['retrieved'] = $this->input->post('exists');

		$this->load->view('popoti/sparepart/sparepart-popup', $data);
	}

	function popup_json()
	{
		if($this->input->is_ajax_request())
		{
			if($this->input->post('exists') != 'null')
				$exists = json_decode($this->input->post('exists'), true);
			else
				$exists = array();

			$requestData	= $_REQUEST;
			$fetch			= $this->sparepart_model->getsparepart($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
			
			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 
				if (count($exists) > 0) {
					if (!in_array($row->id, $exists)) {
						$nestedData[] = $row->kode;
						$nestedData[] = $row->nama;
						$nestedData[] = rupiah($row->harga);

						$nestedData[]	= "<a href='javascript:void(0)' id='choose' class='btn btn-info waves-effect waves-light' data-id='".$row->id."' data-value='".$row->kode . ' ' . $row->nama."'>Choose</a>";

						$data[] = $nestedData;
					}
				}else{
					$nestedData[] = $row->kode;
					$nestedData[] = $row->nama;
					$nestedData[] = rupiah($row->harga);

					$nestedData[]	= "<a href='javascript:void(0)' id='choose' class='btn btn-info waves-effect waves-light' data-id='".$row->id."' data-value='".$row->kode . ' ' . $row->nama."'>Choose</a>";

					$data[] = $nestedData;
				}
			}

			$json_data = array(
				"draw"            => intval( $requestData['draw'] ),  
				"recordsTotal"    => intval( $totalData ),  
				"recordsFiltered" => intval( $totalFiltered ), 
				"data"            => $data
				);
			// print_ar($exists);
			// echo $this->db->last_query();

			echo json_encode($json_data);
		}
	}

	function tambah_sparepart($id = false)
	{
		if($id)
		{
			cekoto('sparepart', 'edit', true, false);
		}
		else
		{
			cekoto('sparepart', 'add', true, false);
		}
		if($_POST)
		{
			// print_ar($this->input->post());die;
			$rules_kode = '';
			if(!$id)
				$rules_kode = '|is_unique[tb_sparepart.kode]';

			$this->form_validation->set_rules('kode', 'Code', 'required');
			$this->form_validation->set_rules('nama', 'Name', 'required');
			$this->form_validation->set_rules('catid', 'Category', 'required');
			$this->form_validation->set_rules('merkid', 'Merk', 'required');
			$this->form_validation->set_rules('harga', 'HPP', 'required');
			$this->form_validation->set_rules('het', 'HET', 'required');
			$this->form_validation->set_rules('margin', 'Margin', 'required');
			$this->form_validation->set_rules('het1', 'H1', 'required');
			$this->form_validation->set_rules('margin1', 'Margin 1', 'required');
			$this->form_validation->set_rules('het2', 'H2', 'required');
			$this->form_validation->set_rules('margin2', 'Margin 2', 'required');
			$this->form_validation->set_rules('het3', 'H3', 'required');
			$this->form_validation->set_rules('margin3', 'Margin 3', 'required');
			$this->form_validation->set_rules('grosir', 'Grosir', 'required');
			$this->form_validation->set_rules('margin_grosir', 'Margin Grosir', 'required');
			// $this->form_validation->set_rules('merkid', 'Merk', 'required');
			// $this->form_validation->set_rules('margin', 'Margin', 'required');

			if($this->form_validation->run() == true)
			{
				$kode     = $this->input->post('kode');
				$nama     = $this->input->post('nama');
				$harga    = toFloat($this->input->post('harga'));
				$catid    = $this->input->post('catid');
				$merkid   = $this->input->post('merkid');
				// $discount = toFloat($this->input->post('discount'));
				// $program  = toFloat($this->input->post('program'));
				// $vat      = toFloat($this->input->post('vat'));
				// $margin   = toFloat($this->input->post('margin'));
				$het      = toFloat($this->input->post('het'));
				$margin = toFloat($this->input->post('margin'));
				$het1 = toFloat($this->input->post('het1'));
				$margin1 = toFloat($this->input->post('margin1'));
				$het2 = toFloat($this->input->post('het2'));
				$margin2 = toFloat($this->input->post('margin2'));
				$het3 = toFloat($this->input->post('het3'));
				$margin3 = toFloat($this->input->post('margin3'));
				$grosir = toFloat($this->input->post('grosir'));
				$margin_grosir = toFloat($this->input->post('margin_grosir'));
				// $vat_type = $this->input->post('vat_type');
				$tanggal  = $this->input->post('tanggal');

				$newid = newid('tb_sparepart');

				$insert = array(
					'kode'     => $kode,
					'nama'     => $nama,
					'catid'    => $catid,
					'merkid'   => $merkid,
					'harga'    => $harga,
					'het1'   => $het1,
					'het2'   => $het2,
					'het3'   => $het3,
					'grosir'   => $grosir,
					'margin_grosir'   => $margin_grosir,
					// 'discount' => toFloat($discount),
					// 'program'  => $program,
					// 'vat'      => $vat,
					// 'vat_type' => $vat_type,
					'margin'   => $margin,
					'margin1'   => $margin1,
					'margin2'   => $margin2,
					'margin3'   => $margin3,
					'het'      => $het,
					'tanggal'  => date('Y-m-d'),
					);

				if($id)
				{
					$this->sparepart_model->updatesparepart($insert, decode($id));
				}
				else
				{
					$insert['id'] = $newid;

					$this->sparepart_model->addsparepart($insert);
					updateNo('SP');
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
			$data['category'] = $this->sparepart_model->getcategory()['query'];
			$data['merk']     = $this->sparepart_model->getmerk()['query'];
			if($id)
			{
				$data['sparepart'] = $this->sparepart_model->rowsparepart(['id' => decode($id)])->row();
			}
			else
			{
				$data['sparepart'] = (object) array(
					'id'       => '',
					// 'kode'     => '',
					// 'nama'     => '',
					// 'catid'    => '',
					// 'merkid'   => '',
					// 'discount' => '',
					// 'program'  => '',
					// 'vat'      => '',
					// 'vat_type' => '%',
					// 'margin'   => '',
					// 'het'      => '',
					// 'het1'      => '',
					// 'het2'      => '',
					// 'het3'      => '',
					// 'grosir'      => '',
					// 'harga'    => 0,

					'kode'	=> '',
					'nama'	=> '',
					'catid'	=> '',
					'merkid'	=> '',
					'harga'	=> '',
					'het1'	=> '',
					'het2'	=> '',
					'het3'	=> '',
					'grosir'	=> '',
					'margin_grosir'	=> '',
					'discount'	=> '',
					'program'	=> '',
					'vat'	=> '',
					'vat_type'	=> '',
					'margin'	=> '',
					'margin1'	=> '',
					'margin2'	=> '',
					'margin3'	=> '',
					'het'	=> '',
					'tanggal'	=> '',
					'is_tradein' => false,
				);
			}
			$data['is_tradein'] = 0;
			$this->load->view('popoti/sparepart/add-sparepart', $data);
		}
	}

	function new_abc_category($id = false)
	{
		if($id){
			cekoto('sparepart/abc-category', 'edit', true, false);
		}
		else{
			cekoto('sparepart/abc-category', 'add', true, false);
		}

		if($_POST)
		{
			$rules_kode = '';
			if(!$id)
				$rules_kode = '|is_unique[tb_abc.code]';

			$this->form_validation->set_rules('code', 'Code', 'required|max_length[1]'.$rules_kode);
			$this->form_validation->set_rules('logical', 'Logical Operator', 'required');
			$this->form_validation->set_rules('weeks', 'Total Weeks', 'required|numeric|max_length[2]');
			$this->form_validation->set_rules('amount', 'QTY', 'required|numeric|max_length[4]');
			$this->form_validation->set_rules('upper', 'Upper Stock', 'required|numeric|max_length[4]');
			$this->form_validation->set_rules('lower', 'Lower Stock', 'required|numeric|max_length[4]');

			if($this->form_validation->run() == true)
			{
				$code    = $this->input->post('code');
				$logical = $this->input->post('logical');
				$weeks   = $this->input->post('weeks');
				$amount  = $this->input->post('amount');
				$upper   = $this->input->post('upper');
				$lower   = $this->input->post('lower');
				$roq     = $this->input->post('roq');

				$newid = newid('tb_abc');

				$insert = array(
					'code'    => $code,
					'logical' => $logical,
					'weeks'   => $weeks,
					'amount'  => $amount,
					'upper'   => $upper,
					'lower'   => $lower,
					'roq'     => toFloat($roq),
				);

				if($id)
				{
					$this->global_model->_update('tb_abc', $insert, ['id' => decode($id)]);
				}
				else
				{
					$insert['id'] = $newid;

					$this->global_model->_insert('tb_abc', $insert);
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
				$data['abc'] = $this->global_model->_row('tb_abc', ['id' => decode($id)])->row();
			}
			else
			{
				$data['abc'] = (object) array(
					'id'      => '',
					'code'    => '',
					'logical' => '',
					'weeks'   => '',
					'amount'  => '',
					'upper'   => '',
					'lower'   => '',
					'roq'     => '',
				);
			}
			$this->load->view('popoti/sparepart/add-abc', $data);
		}
	}

	function delete_sparepart($id)
		{
		if(cekoto('sparepart', 'delete', false, false)):
			if($this->input->is_ajax_request()):
				$this->sparepart_model->updatesparepart(['status' => '0'], decode($id));

					echo json_encode(array(
						'status' => 1,
						'pesan' => "<i class='fa fa-check' style='color:green;'></i> Data has been updated."
					));
			endif;
		else:
			$this->query_error('Sorry you don\'t have access to delete this data');
		endif;
	}

	function delete_abc_category($id)
			{
		if(cekoto('sparepart/abc-category', 'delete', false, false)):
			if($this->input->is_ajax_request()):
			 	$this->global_model->_update('tb_abc', ['status' => '0'], ['id' => decode($id)]);

			 		echo json_encode(array(
						'status' => 1,
						'pesan' => "<i class='fa fa-check' style='color:green;'></i> Data has been updated."
					));
			endif;
		else:
			$this->query_error('Sorry you don\'t have access to delete this data');
		endif;
	}

	function supplier()
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

        $this->data['js'][] = base_url('assets/custom/js/sparepart.js');
        $this->data['menuName'] = 'Supplier';
		$this->load->templateAdmin('sparepart/supplier-data');
	}

	function supplier_popup()
	{
		if(cekoto('purchase/recommended', 'view', true, false) || cekoto('purchase/unrecommended', 'view', true, false))
		{
		$this->load->view('popoti/sparepart/supplier-popup');
			
		}
	}

	function suppliers_datatable()
	{
		if($this->input->is_ajax_request())
		{
			$requestData	= $_REQUEST;
			$fetch			= $this->sparepart_model->getsupplier($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
			
			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 

				$nestedData[] = $row->kode;
				$nestedData[] = $row->nama;

				$nestedData[]	= "<a href='javascript:void(0)' class='btn btn-primary pilih-ini' data-id='".$row->id."'><i class='mdi mdi-cursor-pointer mr-1'></i> Choose</a>";
				
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

	function supplier_autocomplete()
	{
		if($this->input->is_ajax_request())
		{
			$query = $_REQUEST['query'];

			$suppliers = $this->global_model->_get('tb_supplier', ['CONCAT(kode, \' - \', nama) like \'%'.$query.'%\'' => ''], [], [], 'id, kode, nama, CONCAT(kode, \' - \', nama) value');

			$allitems = array();
			if($suppliers->num_rows() > 0)
			{
				foreach($suppliers->result() as $b)
				{
					$allitems[] = array('value' => $b->value, 'data' => $b->id);
				}
			}

			$items['query'] = $query;
			$items['suggestions'] = $allitems;
			echo json_encode($items);
		}
	}

	function supplier_json()
	{
		if($this->input->is_ajax_request())
		{
			$requestData	= $_REQUEST;
			$fetch			= $this->sparepart_model->getsupplier($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
			
			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 

				$nestedData[] = $row->kode;
				$nestedData[] = $row->nama;
				$nestedData[] = $row->cat;
				$nestedData[] = $row->alamat;
				$nestedData[] = $row->tlp;
				$nestedData[] = $row->bank;
				$nestedData[] = $row->rek;
				$nestedData[] = $row->attn;

				$nestedData[]	= "<a href='".site_url('sparepart/tambah-supplier/'.encode($row->id))."' id='TambahSupplier' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
										<a href='".site_url('sparepart/delete-supplier/'.encode($row->id))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
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
		}
	}

	function retrieve_abc_data($abcid = NULL)
	{
		if($this->input->is_ajax_request()):
			if($abcid):
				$join = [
					['tb_abc b', 'a.abcid = b.id', 'left'],
					// ['tb_sparepart_location c', 'a.id = c.sparepartid', 'left'],
				];

				$retrieve = $this->global_model->_get('tb_sparepart a', "a.abcid = $abcid AND IFNULL((SELECT SUM(qty) FROM tb_sparepart_mutasi WHERE sparepartid = a.id), 0) <= b.lower", [], [], 'a.*, b.code as abc_code, b.lower, b.roq, IFNULL((SELECT SUM(qty) FROM tb_sparepart_mutasi WHERE sparepartid = a.id), 0) total, (SELECT SUM(qty) FROM tb_sparepart_mutasi WHERE waktu <= DATE_SUB(NOW(), INTERVAL 90 DAY) AND sparepartid = a.id) average', $join);

				if($retrieve->num_rows() > 0)
					echo json_encode(['status' => 1, 'found' => $retrieve->num_rows(), 'data' => $retrieve->result()]);
				else
					echo json_encode(['status' => 0, 'found' => $retrieve->num_rows(), 'data' => []]);

			endif;
		endif;
	}

	function tambah_supplier($id = false)
	{
		if($id)
		{
			cekoto('sparepart/supplier', 'edit', true, false);
		}
		else{
			cekoto('sparepart/supplier', 'add', true, false);
		}
		if($_POST)
		{
			$rules_kode = '';
			if(!$id)
				$rules_kode = '|is_unique[tb_supplier.kode]';

			$this->form_validation->set_rules('kode', 'Code', 'required|max_length[50]'.$rules_kode);
			$this->form_validation->set_rules('nama', 'Supplier Name', 'required');
			$this->form_validation->set_rules('alamat', 'Address', 'required');
			$this->form_validation->set_rules('tlp', 'Phone', 'required');

			if($this->form_validation->run() == true)
			{
				$nama   = $this->input->post('nama');
				$alamat = $this->input->post('alamat');
				$tlp    = $this->input->post('tlp');
				$fax    = $this->input->post('fax');
				$attn   = $this->input->post('attn');
				$kode   = $this->input->post('kode');
				$catid  = $this->input->post('catid');
				$bank   = $this->input->post('bank');
				$rek    = $this->input->post('rek');
				$alias  = $this->input->post('alias');

				$newid = newid('tb_supplier');

				$insert = array(
					'nama'   => $nama,
					'alamat' => $alamat,
					'tlp'    => $tlp,
					'fax'    => $fax,
					'attn'   => $attn,
					'kode'   => $kode,
					'catid'  => $catid,
					'bank'   => $bank,
					'rek'    => $rek,
					'alias'  => $alias,
				);

				if($id)
				{
					$this->sparepart_model->updatesupplier($insert, decode($id));
				}
				else
				{
					$insert['id'] = $newid;

					$this->sparepart_model->addsupplier($insert);
					updateNo('SPL');
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
			$data['category'] = $this->global_model->_get('tb_supplier_cat', ['status' => '1']);
			if($id)
			{
				$data['supplier'] = $this->sparepart_model->rowsupplier(['id' => decode($id)])->row();
			}
			else
			{
				$data['supplier'] = (object) array(
					'id'     => '',
					'kode'   => '',
					'nama'   => '',
					'catid'  => '',
					'alamat' => '',
					'tlp'    => '',
					'fax'    => '',
					'attn'   => '',
					'bank'   => '',
					'rek'    => '',
					'alias'  => '',
				);
			}
			$this->load->view('popoti/sparepart/add-supplier', $data);
		}
	}

	function delete_supplier($id)
	{
		if(cekoto('sparepart/supplier', 'delete', false, false)):
			if($this->input->is_ajax_request()):
				$this->sparepart_model->updatesparepart(['status' => '0'], decode($id));

					echo json_encode(array(
						'status' => 1,
						'pesan' => "<i class='fa fa-check' style='color:green;'></i> Data has been updated."
					));
			endif;
		else:
			$this->query_error('Sorry you don\'t have access to delete this data');
		endif;
	}

	function category()
	{
		cekoto('sparepart/category','view', true, true);


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

        $this->data['js'][] = base_url('assets/custom/js/sparepart.js');

		$this->load->templateAdmin('sparepart/category-sparepart');
	}

	function category_json()
	{
		if($this->input->is_ajax_request())
		{
			$requestData	= $_REQUEST;
			$fetch			= $this->sparepart_model->getcategory($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
			
			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 

				$nestedData[] = $row->nama;

				$nestedData[]	= "<div class='btn-group'>
										<a href='".site_url('sparepart/tambah-category/'.encode($row->id))."' id='EditCat' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
										<a href='".site_url('sparepart/delete-category/'.encode($row->id))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
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
		}
	}

	function tambah_category($id = false)
	{

		if($id){
			cekoto('sparepart/category','edit', true, false);
		}
		else
		{
			cekoto('sparepart/category','add', true, false);
		}

		if($_POST)
		{
			$this->form_validation->set_rules('nama', 'Category Name', 'required');

			if($this->form_validation->run() == true)
			{
				$nama = $this->input->post('nama');

				$newid = newid('tb_sparepart_category');

				$insert = array(
					'nama' => $nama,
				);

				if($id)
				{
					$this->sparepart_model->updatecategory($insert, decode($id));
				}
				else
				{
					$insert['id'] = $newid;

					$this->sparepart_model->addcategory($insert);
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
				$data['category'] = $this->sparepart_model->rowcategory(['id' => decode($id)])->row();
			}
			else
			{
				$data['category'] = (object) array(
					'id'   => '',
					'nama' => '',
				);
			}
			$this->load->view('popoti/sparepart/add-category', $data);
		}
	}

	function delete_category($id)
	{
			{
		if(cekoto('sparepart/category', 'delete', false, false)):
			if($this->input->is_ajax_request()):
				$this->sparepart_model->updatecategory(['status' => '0'], decode($id));
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

	

	function merk()
	{
		cekoto('sparepart/merk', 'view', true, true);

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

        $this->data['js'][] = base_url('assets/custom/js/sparepart.js');

		$this->load->templateAdmin('sparepart/merk-sparepart');
	}

	function merk_json()
	{
		if($this->input->is_ajax_request())
		{
			$requestData	= $_REQUEST;
			$fetch			= $this->sparepart_model->getmerk($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
			
			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 

				$nestedData[] = $row->nama;

				$nestedData[]	= "<div class='btn-group'>
										<a href='".site_url('sparepart/tambah-merk/'.encode($row->id))."' id='Edit' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
										<a href='".site_url('sparepart/delete-merk/'.encode($row->id))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
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
		}
	}

	function tambah_merk($id = false)
	{
		if($id)
		{
			cekoto('sparepart/category', 'edit', true, false);
		}
		else
		{
			cekoto('sparepart/category', 'edit', true, false);
		}
		if($_POST)
		{
			$this->form_validation->set_rules('nama', 'Category Name', 'required');

			if($this->form_validation->run() == true)
			{
				$nama = $this->input->post('nama');

				$newid = newid('tb_sparepart_merk');

				$insert = array(
					'nama' => $nama,
				);

				if($id)
				{
					$this->sparepart_model->updatemerk($insert, decode($id));
				}
				else
				{
					$insert['id'] = $newid;

					$this->sparepart_model->addmerk($insert);
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
				$data['merk'] = $this->sparepart_model->rowmerk(['id' => decode($id)])->row();
			}
			else
			{
				$data['merk'] = (object) array(
					'id'   => '',
					'nama' => '',
				);
			}
			$this->load->view('popoti/sparepart/add-merk', $data);
		}
	}

	function delete_merk($id)
	{
		if(cekoto('sparepart/merk', 'delete', false, false)):
			if($this->input->is_ajax_request()):
				$this->sparepart_model->updatemerk(['status' => '0'], decode($id));

					echo json_encode(array(
						'status' => 1,
						'pesan' => "<i class='fa fa-check' style='color:green;'></i> Data has been updated."
					));
			endif;
		else:
			$this->query_error('Sorry you don\'t have access to delete this data');
		endif;
	}

	function location_popup()
	{
		$this->load->view('popoti/sparepart/location-popup');
	}

	function location()
	{
		cekoto('sparepart/location', 'view', true, true);

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

        $this->data['js'][] = base_url('assets/custom/js/sparepart.js');

		$this->load->templateAdmin('sparepart/location');
	}

	function location_json()
	{
		if($this->input->is_ajax_request())
		{
			$requestData	= $_REQUEST;
			$fetch			= $this->sparepart_model->getlocation($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
			
			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array();

				$nestedData[] = $row->nama;

				if(!isset($_GET['popup'])):
					$nestedData[] = $row->parent;
					$nestedData[] = rupiah($row->max, 2);

					$nestedData[]	= "<div class='btn-group'>
											<a href='".site_url('sparepart/tambah-location/'.encode($row->id))."' id='EditLocation' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
											<a href='".site_url('sparepart/delete-location/'.encode($row->id))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
										</div>";
				else:
					$nestedData[] = "<a href='javascript:void(0)' class='btn btn-primary btn-sm pilih-location' data-id='".$row->id."'><i class='mdi mdi-cursor-pointer mr-1'></i>Select</a>";
				endif;

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

	function location_ajax()
	{
		if($this->input->is_ajax_request()):
			$locations = $this->global_model->_get('tb_location', ['status' => '1']);

			echo json_encode([
				'results' => $locations->num_rows(),
				'data'    => $locations->result(),
			]);
		endif;
	}

	function tambah_location($id = false)
	{
		if($id){
			cekoto('sparepart/location', 'edit', true, false);
		}
		else
		{
			cekoto('sparepart/location', 'add', true, false);
		}
		if($_POST)
		{
			$this->form_validation->set_rules('nama', 'Location Name', 'required');
			$this->form_validation->set_rules('max', 'Max. QTY', 'required');

			if($this->form_validation->run() == true)
			{
				$nama     = $this->input->post('nama');
				$parentid = $this->input->post('parentid');
				$max      = $this->input->post('max');

				$newid = newid('tb_location');
				$insert = array(
					'nama'     => $nama,
					'parentid' => $parentid,
					'max'      => $max,
				);

				if($id)
				{
					$this->sparepart_model->updatelocation($insert, decode($id));
				}
				else
				{
					$insert['id'] = $newid;

					$this->sparepart_model->addlocation($insert);
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
			$data['parent'] = $this->sparepart_model->getlocation();
			$data['parent'] = $data['parent']['query'];

			if($id)
			{
				$data['location'] = $this->sparepart_model->rowlocation(['id' => decode($id)])->row();
			}
			else
			{
				$data['location'] = (object) array(
					'id'       => '',
					'nama'     => '',
					'parentid' => '',
					'max'      => '',
				);
			}
			$this->load->view('popoti/sparepart/add-location', $data);
		}
	}

	function delete_location($id)
		{
		if(cekoto('sparepart/location', 'delete', false, false)):
			if($this->input->is_ajax_request()):
				$this->sparepart_model->updatelocation(['status' => '0'], decode($id));

					echo json_encode(array(
						'status' => 1,
						'pesan' => "<i class='fa fa-check' style='color:green;'></i> Data has been updated."
					));
			endif;
		else:
			$this->query_error('Sorry you don\'t have access to delete this data');
		endif;
	}

	function penjualan()
	{

		cekoto('sparepart/penjualan', 'view', true, true);

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

        $this->data['js'][] = base_url('assets/custom/js/sparepart.js');

		$this->load->templateAdmin('sparepart/penjualan');
	}

	function penjualan_json()
	{
		if($this->input->is_ajax_request())
		{
			$requestData	= $_REQUEST;
			$fetch			= $this->sparepart_model->getpenjualan($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
			
			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array();

				$nestedData[] = "[$row->kode_part]" . ' ' .$row->part;
				$nestedData[] = rupiah($row->nominal, 2);
				$nestedData[] = tanggalindo($row->start);
				$nestedData[] = tanggalindo($row->end);

				$nestedData[]	= "<div class='btn-group'>
										<a href='".site_url('sparepart/tambah-penjualan/'.encode($row->id))."' id='EditLocation' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
										<a href='".site_url('sparepart/delete-penjualan/'.encode($row->id))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
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
		}
	}

	function tambah_penjualan($id = false)
	{
		if($id)
		{
			cekoto('sparepart/penjualan', 'edit', true, false);
		}
		else
		{
			cekoto('sparepart/penjualan', 'add', true, false);
		}
		if($_POST)
		{
			$this->form_validation->set_rules('partid', 'Part Code', 'required');
			$this->form_validation->set_rules('nominal', 'Special Price', 'required');
			$this->form_validation->set_rules('start', 'Start Date', 'required');
			$this->form_validation->set_rules('end', 'End Date', 'required');

			if($this->form_validation->run() == true)
			{
				$partid   = $this->input->post('partid');
				$nominal  = $this->input->post('nominal');
				$start    = $this->input->post('start');
				$end      = $this->input->post('end');

				$newid = newid('tb_special_rates');
				$insert = array(
					'partid'  => $partid,
					'nominal' => $nominal,
					'start'   => $start,
					'end'     => $end,
				);

				if($id)
				{
					$this->sparepart_model->updatepenjualan($insert, decode($id));
				}
				else
				{
					$insert['id'] = $newid;

					$this->sparepart_model->addpenjualan($insert);
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
				$data['penjualan'] = $this->sparepart_model->rowpenjualan(['a.id' => decode($id)])->row();
			}
			else
			{
				$data['penjualan'] = (object) array(
					'id'      => '',
					'partid'  => '',
					'part'    => '',
					'nominal' => '',
					'start'   => '',
					'end'     => '',
				);
			}
			$this->load->view('popoti/sparepart/add-penjualan', $data);
		}
	}

	function delete_penjualan($id)
	{
		if(cekoto('sparepart/penjualan', 'delete', false, false)):
			if($this->input->is_ajax_request()):
				$this->sparepart_model->updatepenjualan(['status' => '0'], decode($id));

					echo json_encode(array(
						'status' => 1,
						'pesan' => "<i class='fa fa-check' style='color:green;'></i> Data has been updated."
					));
			endif;
		else:
			$this->query_error('Sorry you don\'t have access to delete this data');
		endif;
	}

function budgeting()
	{
		cekoto('sparepart/budgeting', 'view', true, true);

        $this->data['css'][] = base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css');
        $this->data['css'][] = base_url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css');
        $this->data['css'][] = base_url('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css');
        $this->data['css'][] = base_url('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css');
        $this->data['css'][] = base_url('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css');

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

        $this->data['js'][] = base_url('assets/custom/js/sparepart.js');

		$this->load->templateAdmin('sparepart/budgeting-view');
	}

	function budgeting_json()
	 {
        // if($this->input->is_ajax_request())
        // {
            $requestData    = $_REQUEST;
            $fetch          = $this->sparepart_model->getbudgeting($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
            
            $totalData      = $fetch['totalData'];
            $totalFiltered  = $fetch['totalFiltered'];
            $query          = $fetch['query'];

            $data   = array();
            foreach($query->result() as $row)
            { 
                $nestedData = array(); 
               
                $nestedData[] = $row->category;
                $nestedData[] = my($row->month, true);
                $nestedData[] ='Rp '.rupiah($row->budgeting, 2) ;

                $nestedData[]   = "<div class='btn-group'>
                                        <a href='".site_url('sparepart/tambah-budgeting/'.encode($row->id))."' id='EditItem' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
                                        <a href='".site_url('sparepart/delete-group/'.encode($row->id))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
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
    function tambah_budgeting($id = false)
	{
		if($id)
		{
			cekoto('sparepart/budgeting', 'edit', true, false);
		}
		else
		{
			cekoto('sparepart/budgeting', 'add', true, false);
		}
		if ($this->input->is_ajax_request()) {
			if($this->input->post())
			{
				// echo json_encode($this->input->post());die;
				$this->form_validation->set_rules('categori_id', 'Category', 'required|callback_category_check');
				$this->form_validation->set_rules('month', 'Month', 'required|trim');
				$this->form_validation->set_rules('budgeting', 'budgeting', 'required');
				
				if($this->form_validation->run() == true)
				{
					$insert = array(
						'categori_id' => $this->input->post('categori_id'),
						// 'month' 	  => date('Y-m', strtotime($this->input->post('month'))),
						'month' 	  => $this->input->post('month'),
						'budgeting'   => toFloat($this->input->post('budgeting')),
					);
					// print_ar($insert); die
					if($id)

					{
						$this->global_model->_update('tb_budgeting', $insert, ['id' => decode($id)]);
					}
					else
					{
						$this->global_model->_insert('tb_budgeting',$insert);
					}

					if($this->db->affected_rows() > 0) {
						echo json_encode(array(
							'status' => 1,
							'pesan' => "Data has been updated."
						));
					}
					else
					{
							// $this->query_error($this->db->last_query());die;
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
					$data['budgeting'] = $this->global_model->_row('tb_budgeting',['id' => decode($id)])->row();
					// echo json_encode($data['budgeting']);die;
				}
				else
				{
					$data['budgeting'] = (object) array(
						'id'     => '',
						'categori_id'   => '',
						'month'   => '',
						'budgeting'   => '',
					);
				}
				$data['category'] = $this->global_model->_get('tb_sparepart_category');
				$this->load->view('popoti/sparepart/add-budgeting2', $data);
			}
		}	
	}

	function category_check()
	{
		$categori_id = $this->input->post('categori_id');
		$month = $this->input->post('month');

		$check = sql_get_var('tb_budgeting', 'id', ['categori_id' => $categori_id, 'month' => $month], 1);

		if($check > 0)
		{
			$this->form_validation->set_message('category_check', 'Category alredy exists');
			return false;
		}

		else

		{

			return true;
		}

	}
	function delete_group($id)
	{
		if(cekoto('sparepart/budgeting', 'delete', false, false)):
			if($this->input->is_ajax_request()):
				$this->global_model->_update('tb_budgeting' ,['status' => '0'], ['id' => decode($id)]);

				echo json_encode(array(
					'status' => 1,
					'pesan' => "<i class='fa fa-check' style='color:green;'></i> Data has been deleted."
				));
			endif;
		else:
			$this->query_error('Sorry you don\'t have access to delete this data');
		endif;
	}

 	function tradein()
 	{

 		cekoto('sparepart/tradein', 'view', true, false);

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

        $this->data['js'][] = base_url('assets/custom/js/sparepart.js');

        $this->load->templateAdmin('sparepart/trade-in');
 	}

	function tradein_json()
	{
		if($this->input->is_ajax_request())
		{
			$requestData	= $_REQUEST;
			$fetch			= $this->sparepart_model->gettradein($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length'], True);
			
			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 

				$nestedData[] = $row->kode;
				$nestedData[] = $row->category;
				$nestedData[] = $row->nama;
				$nestedData[] = rupiah($row->harga, 0);
				$nestedData[] = rupiah($row->discount, 2);
				$nestedData[] = rupiah($row->program);
				$nestedData[] = rupiah($row->vat, 2);
				$nestedData[] = rupiah($row->margin, 2);
				$nestedData[] = rupiah($row->het, 2);
				$nestedData[] = tgl($row->tanggal);
		

				$nestedData[]	= "<div class='btn-group'>
										<a href='".site_url('sparepart/tambah-tradein/'.encode($row->id))."' id='TambahSparepart' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
										<a href='".site_url('sparepart/delete-tradein/'.encode($row->id))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
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
		}
	}

	function tambah_tradein($id = false)
	{
		if ($id) {
			cekoto('sparepart/tradein', 'edit', true, false);
		}
		else
		{
			cekoto('sparepart/tradein', 'add', true, false);
		}
		if($_POST)
		{
			$rules_kode = '';
			if(!$id)
				$rules_kode = '|is_unique[tb_sparepart.kode]';

			$this->form_validation->set_rules('kode', 'Code', 'required');
			$this->form_validation->set_rules('nama', 'Name', 'required');
			$this->form_validation->set_rules('catid', 'Category', 'required');
			$this->form_validation->set_rules('merkid', 'Merk', 'required');
			$this->form_validation->set_rules('harga', 'HPP', 'required');
			$this->form_validation->set_rules('het', 'HET', 'required');
			$this->form_validation->set_rules('margin', 'Margin', 'required');
			$this->form_validation->set_rules('het1', 'H1', 'required');
			$this->form_validation->set_rules('margin1', 'Margin 1', 'required');
			$this->form_validation->set_rules('het2', 'H2', 'required');
			$this->form_validation->set_rules('margin2', 'Margin 2', 'required');
			$this->form_validation->set_rules('het3', 'H3', 'required');
			$this->form_validation->set_rules('margin3', 'Margin 3', 'required');
			$this->form_validation->set_rules('grosir', 'Grosir', 'required');
			$this->form_validation->set_rules('margin_grosir', 'Margin Grosir', 'required');
			// $this->form_validation->set_rules('merkid', 'Merk', 'required');
			// $this->form_validation->set_rules('margin', 'Margin', 'required');

			if($this->form_validation->run() == true)
			{
				$kode     = $this->input->post('kode');
				$nama     = $this->input->post('nama');
				$harga    = toFloat($this->input->post('harga'));
				$catid    = $this->input->post('catid');
				$merkid   = $this->input->post('merkid');
				// $discount = toFloat($this->input->post('discount'));
				// $program  = toFloat($this->input->post('program'));
				// $vat      = toFloat($this->input->post('vat'));
				// $margin   = toFloat($this->input->post('margin'));
				$het      = toFloat($this->input->post('het'));
				$margin = toFloat($this->input->post('margin'));
				$het1 = toFloat($this->input->post('het1'));
				$margin1 = toFloat($this->input->post('margin1'));
				$het2 = toFloat($this->input->post('het2'));
				$margin2 = toFloat($this->input->post('margin2'));
				$het3 = toFloat($this->input->post('het3'));
				$margin3 = toFloat($this->input->post('margin3'));
				$grosir = toFloat($this->input->post('grosir'));
				$margin_grosir = toFloat($this->input->post('margin_grosir'));
				// $vat_type = $this->input->post('vat_type');
				$tanggal  = $this->input->post('tanggal');

				$newid = newid('tb_sparepart');

				$insert = array(
					'kode'     => $kode,
					'nama'     => $nama,
					'catid'    => $catid,
					'merkid'   => $merkid,
					'harga'    => $harga,
					'het1'   => $het1,
					'het2'   => $het2,
					'het3'   => $het3,
					'grosir'   => $grosir,
					'margin_grosir'   => $margin_grosir,
					// 'discount' => toFloat($discount),
					// 'program'  => $program,
					// 'vat'      => $vat,
					// 'vat_type' => $vat_type,
					'margin'   => $margin,
					'margin1'   => $margin1,
					'margin2'   => $margin2,
					'margin3'   => $margin3,
					'het'      => $het,
					'tanggal'  => date('Y-m-d'),
				);

				if($id)
				{
					$this->sparepart_model->updatesparepart($insert, decode($id));
				}
				else
				{
					$insert['id'] = $newid;

					$this->sparepart_model->addsparepart($insert);
					updateNo('TRD');
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
			$data['category'] = $this->sparepart_model->getcategory()['query'];
			$data['merk']     = $this->sparepart_model->getmerk()['query'];
			if($id)
			{
				$data['sparepart'] = $this->sparepart_model->rowsparepart(['id' => decode($id)])->row();
			}
			else
			{
				$data['sparepart'] = (object) array(
					'id'       => '',
					// 'kode'     => '',
					// 'nama'     => '',
					// 'catid'    => '',
					// 'merkid'   => '',
					// 'discount' => '',
					// 'program'  => '',
					// 'vat'      => '',
					// 'vat_type' => '%',
					// 'margin'   => '',
					// 'het'      => '',
					// 'het1'      => '',
					// 'het2'      => '',
					// 'het3'      => '',
					// 'grosir'      => '',
					// 'harga'    => 0,

					'kode'	=> '',
					'nama'	=> '',
					'catid'	=> '',
					'merkid'	=> '',
					'harga'	=> '',
					'het1'	=> '',
					'het2'	=> '',
					'het3'	=> '',
					'grosir'	=> '',
					'margin_grosir'	=> '',
					'discount'	=> '',
					'program'	=> '',
					'vat'	=> '',
					'vat_type'	=> '',
					'margin'	=> '',
					'margin1'	=> '',
					'margin2'	=> '',
					'margin3'	=> '',
					'het'	=> '',
					'tanggal'	=> '',
					'is_tradein' => true
				);
			}
			$data['is_tradein'] = 1;
			$this->load->view('popoti/sparepart/add-sparepart', $data);
		}
	}

	function purchase()
	{
		cekoto('sparepart/purchase', 'view', true, true);
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

        $this->data['js'][] = base_url('assets/custom/js/sparepart.js');

        $this->load->templateAdmin('sparepart/purchase/data-purchase');
	}
		

		function purchase_json()
	{
		if($this->input->is_ajax_request())
		{
			$requestData	= $_REQUEST;
			$fetch			= $this->sparepart_model->getpurchase($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
			
			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];
			// echo $this->db->last_query();
			$data	= array();
			foreach($query->result() as $row)
			{

				$nestedData = array(); 

				$nestedData[] = $row->no;	
				$nestedData[] = $row->order_date;
				$nestedData[] = $row->supplierid;
				$nestedData[] = $row->delivery_plan;
				$nestedData[] = $row->memo;
				$nestedData[] = $row->from;

				$nestedData[]	= "<div class='btn-group'>
										<a href='".site_url('sparepart/return/'.encode($row->id))."' id='#' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Return</a>
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
		}
	}

	function return($id)
	{
		print_ar($id);die;
		$id = decode($id);	
		$this->global_model->_update('tb_order', ['status' => '3'], ['id' => $id]);
		addpayment(['tb_order' => $service_id], $jumlah, true, false, 'tb_service','in' ,$customer_id, 0, getNoFormat('FAKTUR'));
		updateNo('FAKTUR');

	}

		function purchase_cancel_json()
	{
		// if($this->input->is_ajax_request())
		// {
			$requestData	= $_REQUEST;
			$fetch			= $this->sparepart_model->getpurchasecancel($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
			
			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];
			// echo $this->db->last_query();
			$data	= array();
			foreach($query->result() as $row)
			{

				$nestedData = array(); 

				$nestedData[] = $row->no;	
				$nestedData[] = $row->order_date;
				$nestedData[] = $row->supplierid;
				$nestedData[] = $row->delivery_plan;
				$nestedData[] = $row->memo;
				$nestedData[] = $row->from;

				$nestedData[]	= "<div class='btn-group'>
										<a href='".site_url('sparepart/delete-purchase/'.encode($row->id))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Cansel</a>
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

	function delete_purchase($id)
	{
			if(cekoto('sparepart/purchase', 'delete', false, false)):
			if($this->input->is_ajax_request()):
			$this->global_model->_delete('tb_order', ['id' => decode($id)]);

					echo json_encode(array(
						'status' => 1,
						'pesan' => "<i class='fa fa-check' style='color:green;'></i> Data has been updated."
					));
			endif;
		else:
			$this->query_error('Sorry you don\'t have access to delete this data');
		endif;
	}

	function delete_tradein($id)
	{
		if(cekoto('sparepart/tradein', 'delete', false, false)):
			if($this->input->is_ajax_request()):
				$this->sparepart_model->updatesparepart(['status' => '0'], decode($id));

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

?>