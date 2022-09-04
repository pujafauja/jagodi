<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**

 * Class : Customer
 * By : Puzha Fauzha

 */

class Customer extends MY_Controller
{	

	function __construct()
	{
		parent::__construct();
		$this->load->model(['district_model', 'customer_model']);
		isloggedin();
	}

	function index()
	{
		$this->customer();
	}

	function customer()
	{
		if($_POST):
			// if($this->input->is_ajax_request()):
				$requestData	= $_REQUEST;
				$fetch			= $this->global_model->_retrieve(
					$table        = 'tb_customer a
						LEFT JOIN dis_desa b ON a.desa_Id = b.id
						LEFT JOIN dis_kecamatan c ON b.kecamatan_id = c.id
						LEFT JOIN dis_kota d ON c.kota_id = d.id
						, (SELECT @no := 0) r
					',
					$select       = '(@no := @no + 1) nomor, a.id, a.nama, a.no, CONCAT(b.name, \', \', c.name, \', \', d.name) Address',
					$colOrder     = array('nomor', 'a.nama', 'a.no'),
					$filter       = array('a.nama', 'a.no', 'b.name', 'c.name', 'd.name'),
					$where        = NULL,
					$like_value   = $requestData['search']['value'], 
					$column_order = $requestData['order'][0]['column'], 
					$column_dir   = $requestData['order'][0]['dir'], 
					$limit_start  = $requestData['start'], 
					$limit_length = $requestData['length']
				);

				$totalData		= $fetch['totalData'];
				$totalFiltered	= $fetch['totalFiltered'];
				$query			= $fetch['query'];
				// echo $this->db->last_query();
				$data	= array();
				foreach($query->result() as $row)
				{ 
					$nestedData = array(); 

					$nestedData[] = $row->nomor;
					$nestedData[] = $row->nama;
					$nestedData[] = $row->no;
					$nestedData[] = $row->Address;

					$nestedData[]	= "<div class='btn-group'>
											<a href='".site_url('customer/tambah-customer/'.encode($row->id))."' id='AddCustomer' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
											<a href='".site_url('customer/delete-customer/'.encode($row->id))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
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
			// endif;
		else:
			cekoto('customer', 'view', true, true);

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

			$this->data['js'][] = base_url('assets/custom/js/customer.js');

			$this->load->templateAdmin('customer/customer/list');
		endif;
	}

	function tambah_customer($id = '')
	{
		if($id)
		{
			cekoto('customer','edit', true, false);
		}
		else
		{
			cekoto('customer', 'add', true, false);
		}
		if($_POST):
			$this->form_validation->set_rules('nama', 'Customer Name', 'required');
			$this->form_validation->set_rules('no', 'Phone Number', 'required');
			$this->form_validation->set_rules('desaid', 'Address', 'required');

			if($this->form_validation->run() == true):
				$nama   = $this->input->post('nama');
				$no     = $this->input->post('no');
				$desaid = $this->input->post('desaid');

				$data = array(
					'nama'   => $nama,
					'no'     => $no,
					'desa_Id' => $desaid,
				);

				if($id):
					$this->global_model->_update('tb_customer', $data, ['id' => decode($id)]);
				else:
					$this->global_model->_insert('tb_customer', $data);
				endif;

				if($this->db->affected_rows()):
					echo json_encode([
						'status' => 1,
						'pesan' => 'Data has been saved'
					]);
				else:
					echo json_encode([
						'status' => 0,
						'pesan' => 'Please contact developer'
					]);
				endif;
			else:
				$this->input_error();
			endif;
		else:
			if($id):
				$data =  array(
					'customer' => $this->global_model->_get('tb_customer a', ['a.id' => decode($id)], [], [], 'a.id, a.desa_Id desaid, a.nama, a.no, CONCAT(b.name, \', \', c.name, \', \', d.name) address', [
						['dis_desa b', 'a.desa_Id = b.id', 'left'],
						['dis_kecamatan c', 'b.kecamatan_id = c.id', 'left'],
						['dis_kota d', 'c.kota_id = d.id', 'left'],
					])->row()
				);
			else:
				$data =  array(
					'customer' => (object) [
						'id'      => '',
						'nama'    => '',
						'no'      => '',
						'address' => '',
						'desaid'  => '',
					]
				);
			endif;
			$this->load->view('popoti/customer/customer/tambah', $data);
		endif;
	}

	function delete_customer()
	{
		if(cekoto('customer', 'delete', false, false)):
			if($this->input->is_ajax_request()):
				$this->global_model->_update(['status' => '0'], decode($id));
			endif;
		else:
			$this->query_error('Sorry you don\'t have access to delete this data');
		endif;
	}

	function kota()
	{

		cekoto('customer/kota', 'view', true, true);

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

        $this->data['js'][] = base_url('assets/custom/js/customer.js');

		$this->load->templateAdmin('customer/kota');
	}

	function no_plat_json()
	{
		if($this->input->is_ajax_request())
		{
			$query = $_REQUEST['query'];
			$join = array(
				['tb_customer_merk b', 'a.merk_id = b.id', 'left'],
				['tb_customer_jenis c', 'a.jenis_id = c.id', 'left'],
				['tb_customer_category_unit d', 'a.kategori_id = d.id', 'left'],
				['tb_customer_unit e', 'a.unit_id = e.id', 'left'],
			);
			$customer = $this->global_model->_get('tb_customer_vehicles a', ['a.plat like \'%'.$query.'%\'' => ''], array(), array(), 'a.id, a.plat, b.id merkid, b.nama merk, c.id jenisid, c.nama jenis, d.id catid, d.nama cat, e.id unitid, e.nama unit', $join);
			// $customer = $this->customer_model->platjsonautocomplete($query);
			// echo json_encode($customer->result_array());die;
			$allitems = array();
			if($customer->num_rows() > 0)
			{
				foreach($customer->result() as $b)
				{
					$allitems[] = array('value' => $b->plat, 'id' => $b->id, 'merk' => $b->merk, 'unit' => $b->unit, 'jenis' => $b->jenis, 'kategori' => $b->cat, 'merkid' => $b->merkid, 'jenisid' => $b->jenisid, 'catid' => $b->catid, 'unitid' => $b->unitid);
				}
			}

			$items['query'] = $query;
			$items['suggestions'] = $allitems;
			echo json_encode($items);
		}
	}

	function nama_json_ajax()
	{
		if($this->input->is_ajax_request())
		{
			$query = $_REQUEST['query'];
			$customer = $this->db->like('nama', $query, 'BOTH')->get('tb_customer');
			// echo $this->db->last_query();die;
			$allitems = array();
			if($customer->num_rows() > 0)
			{
				foreach($customer->result() as $b)
				{
					$allitems[] = array('value' => $b->nama, 'id' => $b->id);
				}
			}

			$items['query'] = $query;
			$items['suggestions'] = $allitems;
			echo json_encode($items);
		}
	}

	function desa_json_ajax()
	{
		if($this->input->is_ajax_request())
		{
			$query = $_REQUEST['query'];
			$join = array(
				['dis_kecamatan b', 'a.kecamatan_id = b.id', 'left'],
				['dis_kota c', 'b.kota_id = c.id', 'left'],
			);
			$customer = $this->global_model->_get('dis_desa a', [], [], ['a.name LIKE \'%'.$query.'%\'' => '', 'b.name LIKE \'%'.$query.'%\'' => '', 'c.name LIKE \'%'.$query.'%\'' => ''], 'a.id, a.name, b.name kecamatan, c.name kota', $join, 50);
			// echo $this->db->last_query();die;
			$allitems = array();
			if($customer->num_rows() > 0)
			{
				foreach($customer->result() as $b)
				{
					$allitems[] = array('value' => "$b->name, $b->kecamatan, $b->kota", 'id' => $b->id);
				}
			}

			$items['query'] = $query;
			$items['suggestions'] = $allitems;
			echo json_encode($items);
		}
	}

	function merk_json_ajax()
	{
		if($this->input->is_ajax_request())
		{
			$query = $_REQUEST['query'];
			$customer = $this->db->like('nama', $query, 'BOTH')->get('tb_customer_merk');
			// echo $this->db->last_query();die;
			$allitems = array();
			if($customer->num_rows() > 0)
			{
				foreach($customer->result() as $b)
				{
					$allitems[] = array('value' => $b->nama, 'id' => $b->id);
				}
			}

			$items['query'] = $query;
			$items['suggestions'] = $allitems;
			echo json_encode($items);
		}
	}
	function jenis_json_ajax()
	{
		if($this->input->is_ajax_request())
		{
			$query = $_REQUEST['query'];
			$customer = $this->db->like('nama', $query, 'BOTH')->get('tb_customer_jenis');
			$allitems = array();
			if($customer->num_rows() > 0)
			{
				foreach($customer->result() as $b)
				{
					$allitems[] = array('value' => $b->nama, 'id' => $b->id);
				}
			}

			$items['query'] = $query;
			$items['suggestions'] = $allitems;
			echo json_encode($items);
		}
	}
	function kategori_json_ajax()
	{
		if($this->input->is_ajax_request())
		{
			$query = $_REQUEST['query'];
			$customer = $this->db->like('nama', $query, 'BOTH')->get('tb_customer_category');
			$allitems = array();
			if($customer->num_rows() > 0)
			{
				foreach($customer->result() as $b)
				{
					$allitems[] = array('value' => $b->nama, 'id' => $b->id);
				}
			}

			$items['query'] = $query;
			$items['suggestions'] = $allitems;
			echo json_encode($items);
		}
	}

	function customer_json()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->model('service_model');
			$query = $_REQUEST['query'];
			$customer = $this->service_model->getdistrict($query);
			$allitems = array();
			if($customer->num_rows() > 0)
			{
				foreach($customer->result() as $b)
				{
					$last_service = $b->last_service;
					// $last_service = date('d-m-Y H:s:i', strtotime($last_service));
					$allitems[] = array('value' => "$b->no ($b->nama)", 'data' => $b->id,'desa_id' => $b->desa_id, 'no' => $b->no, 'nama' => $b->nama, 'district' => $b->desa.' - '.$b->kecamatan.' - '.$b->kota, 'total_come' => $b->total_come, 'last_service' => $last_service);
				}
			}

			$items['query'] = $query;
			$items['suggestions'] = $allitems;
			echo json_encode($items);
		}
	}

	function kota_json()
	{
		if($this->input->is_ajax_request())
		{
			$requestData	= $_REQUEST;
			$fetch			= $this->district_model->fetchkota($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);

			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 

				$nestedData[] = $row->provinsi;
				$nestedData[] = $row->name;

				$nestedData[]	= "<div class='btn-group'>
										<a href='".site_url('company/tambah-kota/'.encode($row->id))."' id='Edit' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
										<a href='".site_url('company/delete-kota/'.encode($row->id))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
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

	function kecamatan()
	{

		cekoto('customer/kecamatan', 'view', true, true);

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

        $this->data['js'][] = base_url('assets/custom/js/customer.js');

		$this->load->templateAdmin('customer/kecamatan');
	}

	function kecamatan_json()
	{
		if($this->input->is_ajax_request())
		{
			$requestData	= $_REQUEST;
			$fetch			= $this->district_model->fetchkecamatan($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);

			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 

				$nestedData[] = $row->provinsi;
				$nestedData[] = $row->kota;
				$nestedData[] = $row->name;

				$nestedData[]	= "<div class='btn-group'>
										<a href='".site_url('company/tambah-kecamatan/'.encode($row->id))."' id='edit-kecamatan' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
										<a href='".site_url('company/delete-kecamatan/'.encode($row->id))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
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

	function kelurahan()
	{

		cekoto('customer/kelurahan', 'view', true, true);

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

        $this->data['js'][] = base_url('assets/custom/js/customer.js');

		$this->load->templateAdmin('customer/desa');
	}

	function desa_json()
	{
		if($this->input->is_ajax_request())
		{
			$requestData	= $_REQUEST;
			$fetch			= $this->district_model->fetchdesa($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);

			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 

				$nestedData[] = $row->provinsi;
				$nestedData[] = $row->kota;
				$nestedData[] = $row->kecamatan;
				$nestedData[] = $row->name;

				$nestedData[]	= "<div class='btn-group'>
										<a href='".site_url('company/tambah-desa/'.encode($row->id))."' id='edit-desa' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
										<a href='".site_url('company/delete-desa/'.encode($row->id))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
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

	function jenis()
	{

		cekoto('customer/jenis', 'view', true, true);
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

        $this->data['js'][] = base_url('assets/custom/js/customer.js');

		$this->load->templateAdmin('customer/jenis-customer');
	}

	function jenis_json()
	{
		if($this->input->is_ajax_request())
		{
			$requestData	= $_REQUEST;
			$fetch			= $this->customer_model->getjenis($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);

			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 

				$nestedData[] = $row->nama;

				$nestedData[]	= "<div class='btn-group'>
										<a href='".site_url('customer/tambah-jenis/'.encode($row->id))."' id='EditJenis' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
										<a href='".site_url('customer/delete-jenis/'.encode($row->id))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
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

	function tambah_jenis($id = false)
	{
		if($id)
		{
			cekoto('customer/jenis', 'edit', true, false);
		}
		else
		{
			cekoto('customer/jenis', 'add', true, false);
		}

		if($_POST)
		{
			$this->form_validation->set_rules('nama', 'Nama Jenis', 'required');

			if($this->form_validation->run() == true)
			{
				$nama = $this->input->post('nama');

				$newid = newid('tb_customer_jenis');

				$insert = array(
					'nama' => $nama,
				);

				if($id)
				{
					$this->customer_model->updatejenis($insert, decode($id));
				}
				else
				{
					$insert['id'] = $newid;

					$this->customer_model->addjenis($insert);
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
					// $this->query_error($this->db->last_query());
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
				$data['jenis'] = $this->customer_model->rowjenis(['id' => decode($id)])->row();
			}
			else
			{
				$data['jenis'] = (object) array(
					'id'   => '',
					'nama' => '',
				);
			}
			$this->load->view('popoti/customer/add-jenis', $data);
		}
	}

	function delete_jenis($id)
{
		if(cekoto('customer/jenis', 'delete', false, false)):
			if($this->input->is_ajax_request()):
				$this->customer_model->updatejenis(['status' => '0'], decode($id));
			endif;
		else:
			$this->query_error('Sorry you don\'t have access to delete this data');
		endif;
	}

	function category()
	{
		cekoto('customer/category', 'view', true, true);

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

        $this->data['js'][] = base_url('assets/custom/js/customer.js');

		$this->load->templateAdmin('customer/category-customer');
	}

	function category_json()
	{
		if($this->input->is_ajax_request())
		{
			$requestData	= $_REQUEST;
			$fetch			= $this->customer_model->getcat($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);

			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 

				$nestedData[] = $row->nama;

				$nestedData[]	= "<div class='btn-group'>
										<a href='".site_url('customer/tambah-category/'.encode($row->id))."' id='EditCat' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
										<a href='".site_url('customer/delete-category/'.encode($row->id))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
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
		if($id)
		{
			cekoto('customer/category', 'edit', true, false);
		}
		else
		{
			cekoto('customer/category', 'add', true, false);
		}
		if($_POST)
		{
			$this->form_validation->set_rules('nama', 'Category Name', 'required');

			if($this->form_validation->run() == true)
			{
				$nama = $this->input->post('nama');

				$newid = newid('tb_customer_category');

				$insert = array(
					'nama' => $nama,
				);

				if($id)
				{
					$this->customer_model->updatecat($insert, decode($id));
				}
				else
				{
					$insert['id'] = $newid;

					$this->customer_model->addcat($insert);
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
					// $this->query_error($this->db->last_query());
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
				$data['category'] = $this->customer_model->rowcat(['id' => decode($id)])->row();
			}
			else
			{
				$data['category'] = (object) array(
					'id'   => '',
					'nama' => '',
				);
			}
			$this->load->view('popoti/customer/add-category', $data);
		}
	}

	function delete_category($id)
	{
			{
		if(cekoto('customer/category', 'delete', false, false)):
			if($this->input->is_ajax_request()):
				$this->customer_model->updatecat(['status' => '0'], decode($id));
			endif;
		else:
			$this->query_error('Sorry you don\'t have access to delete this data');
		endif;
	}
	}

	function merk()
	{
		cekoto('customer/merk', 'view', true, true);

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

        $this->data['js'][] = base_url('assets/custom/js/customer.js');

		$this->load->templateAdmin('customer/merk-customer');
	}

	function merk_json()
	{
		if($this->input->is_ajax_request())
		{
			$requestData	= $_REQUEST;
			$fetch			= $this->customer_model->getmerk($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);

			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 

				$nestedData[] = $row->nama;

				$nestedData[]	= "<div class='btn-group'>
										<a href='".site_url('customer/tambah-merk/'.encode($row->id))."' id='EditMerk' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
										<a href='".site_url('customer/delete-merk/'.encode($row->id))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
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
			cekoto('customer/merk', 'edit', true, false);
		}
		else
		{
			cekoto('customer/merk', 'add', true, false);
		}
		if($_POST)
		{
			$this->form_validation->set_rules('nama', 'Category Name', 'required');

			if($this->form_validation->run() == true)
			{
				$nama = $this->input->post('nama');

				$newid = newid('tb_customer_merk');

				$insert = array(
					'nama' => $nama,
				);

				if($id)
				{
					$this->customer_model->updatemerk($insert, decode($id));
				}
				else
				{
					$insert['id'] = $newid;

					$this->customer_model->addmerk($insert);
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
					// $this->query_error($this->db->last_query());
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
				$data['merk'] = $this->customer_model->rowmerk(['id' => decode($id)])->row();
			}
			else
			{
				$data['merk'] = (object) array(
					'id'   => '',
					'nama' => '',
				);
			}
			$this->load->view('popoti/customer/add-merk', $data);
		}
	}

	function delete_merk($id)
		{
		if(cekoto('customer/merk', 'delete', false, false)):
			if($this->input->is_ajax_request()):
				$this->customer_model->updatemerk(['status' => '0'], decode($id));
			endif;
		else:
			$this->query_error('Sorry you don\'t have access to delete this data');
		endif;
	}

	function type()
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

        $this->data['js'][] = base_url('assets/custom/js/customer.js');

		$this->load->templateAdmin('customer/type-customer');
	}

	function type_json()
	{
		if($this->input->is_ajax_request())
		{
			$requestData	= $_REQUEST;
			$fetch			= $this->customer_model->gettype($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);

			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 

				$nestedData[] = $row->nama;

				$nestedData[]	= "<div class='btn-group'>
										<a href='".site_url('customer/tambah-type/'.encode($row->id))."' id='EditType' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
										<a href='".site_url('customer/delete-type/'.encode($row->id))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
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

	function tambah_type($id = false)
	{
		if($_POST)
		{
			$this->form_validation->set_rules('nama', 'Category Name', 'required');

			if($this->form_validation->run() == true)
			{
				$nama = $this->input->post('nama');

				$newid = newid('tb_customer_type');

				$insert = array(
					'nama' => $nama,
				);

				if($id)
				{
					$this->customer_model->updatetype($insert, decode($id));
				}
				else
				{
					$insert['id'] = $newid;

					$this->customer_model->addtype($insert);
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
					// $this->query_error($this->db->last_query());
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
				$data['type'] = $this->customer_model->rowtype(['id' => decode($id)])->row();
			}
			else
			{
				$data['type'] = (object) array(
					'id'   => '',
					'nama' => '',
				);
			}
			$this->load->view('popoti/customer/add-type', $data);
		}
	}

	function delete_type($id)
	{
		if($this->input->is_ajax_request())
		{
			$this->customer_model->updatetype(['status' => '0'], decode($id));
		}
	}

	function warna()
	{
		cekoto('customer/warna', 'view', true, true);
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

        $this->data['js'][] = base_url('assets/custom/js/customer.js');

		$this->load->templateAdmin('customer/warna-customer');
	}

	function warna_json()
	{
		if($this->input->is_ajax_request())
		{
			$requestData	= $_REQUEST;
			$fetch			= $this->customer_model->getwarna($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);

			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 

				$nestedData[] = $row->nama;

				$nestedData[]	= "<div class='btn-group'>
										<a href='".site_url('customer/tambah-warna/'.encode($row->id))."' id='EditWarna' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
										<a href='".site_url('customer/delete-warna/'.encode($row->id))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
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

	function tambah_warna($id = false)
	{
		if($id)
		{
			cekoto('customer/warna','edit', true, false);
		}
		else
		{
			cekoto('customer/warna','add', true, false);
		}
		if($_POST)
		{
			$this->form_validation->set_rules('nama', 'Category Name', 'required');

			if($this->form_validation->run() == true)
			{
				$nama = $this->input->post('nama');

				$newid = newid('tb_customer_category_unit');

				$insert = array(
					'nama' => $nama,
				);

				if($id)
				{
					$this->customer_model->updatewarna($insert, decode($id));
				}
				else
				{
					$insert['id'] = $newid;

					$this->customer_model->addwarna($insert);
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
					// $this->query_error($this->db->last_query());
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
				$data['warna'] = $this->customer_model->rowwarna(['id' => decode($id)])->row();
			}
			else
			{
				$data['warna'] = (object) array(
					'id'   => '',
					'nama' => '',
				);
			}
			$this->load->view('popoti/customer/add-warna', $data);
		}
	}

	function delete_warna($id)
	{
		if(cekoto('company/warna', 'delete', false, false)):
			if($this->input->is_ajax_request()):
				$this->customer_model->updatejenis(['status' => '0'], decode($id));
			endif;
		else:
			$this->query_error('Sorry you don\'t have access to delete this data');
		endif;
	}

	function unit()
	{
		cekoto('customer/unit', 'view', true, true);
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

        $this->data['js'][] = base_url('assets/custom/js/customer.js');

		$this->load->templateAdmin('customer/unit-customer');
	}

	function unit2()
	{
		if(cekoto('service/spk', 'view', true, false) || cekoto('wash', 'view', true, false))
		{
		$this->load->view('popoti/customer/unit2-customer');
		}
	}

	function unit_json()
	{
		if($this->input->is_ajax_request())
		{
			// print_ar($_GET);
			// $popup       = $_GET['popup'];
			$requestData = $_REQUEST;
			$fetch       = $this->customer_model->getunit($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);

			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 

				$nestedData[] = $row->jenis;
				$nestedData[] = $row->merk;
				$nestedData[] = $row->nama;
				$nestedData[] = $row->category;

				if(isset($_GET['popup']))
					$nestedData[] = "<a href='javascript:void(0)' class='btn btn-info waves-effect waves-light chooseUnit' data-merk='$row->merkid' data-jenis='$row->jenisid' data-category='$row->catid' data-id='$row->id'><i class='mdi mdi-cursor-pointer mr-1'></i> Choose</a>";
				else
					$nestedData[] = "<div class='btn-group'>
										<a href='".site_url('customer/tambah-unit/'.encode($row->id))."' id='EditUnit' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
										<a href='".site_url('customer/delete-unit/'.encode($row->id))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
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

	function ajax_unit()
	{
		if($this->input->is_ajax_request())
		{

			$query = $_REQUEST['query'];
			$query = $this->customer_model->getunitajax($query);
			$allitems = array();
			foreach($query->result() as $b)
			{ 
				$allitems[] = array('value' => $b->nama, 'id' => $b->id, 'merkid' => $b->merkid,'merk' => $b->merk, 'jenisid' => $b->jenisid,'jenis' => $b->jenis, 'catid' => $b->catid,'kategori' => $b->category);
			}

			$items['query'] = $query;
			$items['suggestions'] = $allitems;
			echo json_encode($items);
		}
	}

	function tambah_unit($id = false)
	{
		if($id)
		{
			cekoto('customer/unit', 'edit', true, false);
		}
		else
		{
			cekoto('customer/unit', 'add', true, false);
		}
		if($_POST)
		{
			$this->form_validation->set_rules('nama', 'Category Name', 'required');
			$this->form_validation->set_rules('merkid', 'Merk', 'required');
			$this->form_validation->set_rules('typeid', 'Type', 'required');
			// $this->form_validation->set_rules('warnaid', 'Color', 'required');

			if($this->form_validation->run() == true)
			{
				$nama  = $this->input->post('nama');
				$merk  = $this->input->post('merkid');
				$type  = $this->input->post('typeid');
				$warna = $this->input->post('warnaid');

				$newid = newid('tb_customer_unit');

				$insert = array(
					'nama'    => $nama,
					'merkid'  => $merk,
					'typeid'  => $type,
					'warnaid' => $warna,
				);

				if($id)
				{
					$this->customer_model->updateunit($insert, decode($id));
				}
				else
				{
					$insert['id'] = $newid;

					$this->customer_model->addunit($insert);
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
					// $this->query_error($this->db->last_query());
				}
			}
			else
			{
				$this->input_error();
			}
		}
		else
		{
			$data['merk']  = $this->customer_model->getmerk()['query'];
			$data['jenis'] = $this->customer_model->getjenis()['query'];
			$data['warna'] = $this->customer_model->getwarna()['query'];
			if($id)
			{
				$data['unit'] = $this->customer_model->rowunit(['id' => decode($id)])->row();
			}
			else
			{
				$data['unit'] = (object) array(
					'id'      => '',
					'nama'    => '',
					'merkid'  => '',
					'typeid'  => '',
					'warnaid' => '',
				);
			}
			$this->load->view('popoti/customer/add-unit', $data);
		}
	}

	function delete_unit($id)
	{
		if(cekoto('customer/unit', 'delete', false, false)):
			if($this->input->is_ajax_request()):
				$this->customer_model->updateunit(['status' => '0'], decode($id));
			endif;
		else:
			$this->query_error('Sorry you don\'t have access to delete this data');
		endif;
	}


	function customers()
	{
		cekoto('service/spk', 'view', true);

		$this->load->view('popoti/customer/all-customers');
	}

	function all_customers_json()
	{
		if($this->input->is_ajax_request())
		{
			$requestData	= $_REQUEST;
			$fetch			= $this->customer_model->getcustomers($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);

			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 

				$nestedData[] = $row->nama;
				$nestedData[] = $row->no;
				$nestedData[] = "$row->desa - $row->kecamatan - $row->kota";
				$nestedData[] = $row->last_service;

				$nestedData[]	= "<a href='javascript:void(0)' class='btn btn-info waves-effect waves-light choose-customer' data-desa='$row->desa_id' data-id='$row->id' data-come='$row->total_come'><i class='mdi mdi-cursor-pointer mr-1'></i> Choose</a>";

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

	function plats()
	{
		if(cekoto('service/spk', 'view', true, false) || cekoto('wash', 'view', true, false))
		{
		$this->load->view('popoti/customer/all-plats');
		}
	}

	function all_plats_json()
	{
		if($this->input->is_ajax_request())
		{
			$requestData	= $_REQUEST;
			$fetch			= $this->customer_model->getplats($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);

			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 

				$nestedData[] = $row->plat;
				$nestedData[] = $row->unit;
				$nestedData[] = $row->merk;
				$nestedData[] = $row->jenis;
				$nestedData[] = $row->kategori;

				$nestedData[]	= "<a href='javascript:void(0)' class='btn btn-info waves-effect waves-light choose' data-cat='$row->catid' data-jenis='$row->jenisid' data-merk='$row->merkid' data-unit='$row->unitid' data-id='$row->id'><i class='mdi mdi-cursor-pointer mr-1'></i> Choose</a>";

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

}

?>