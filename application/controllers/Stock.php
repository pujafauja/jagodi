<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		isloggedin();
		$this->load->model(['stock_model']);
	}

	function select_coa_gap($mod)
	{
		$data = $this->db->query("
				SELECT *
				FROM tb_limit a
				LEFT JOIN tb_coa b ON a.coaid = b.id
				WHERE `mod` = '$mod'
			")->result();
		$result['coa'] = $data;
		if($mod == 'ar')
			$result['employee'] = $this->db->get_where('tb_employee', ['delete' => '0'])->result();
		echo json_encode($result);
	}

	function add_opname($is_print = false)
	{
		cekoto('stock/opname', 'add', true, false);

		$data['is_print'] = $is_print; 
		$join = [
			['tb_sparepart_location b', 'a.id = b.sparepartid', 'left'],
			['tb_location c', 'c.id = b.locationid', 'left'],
		];
		$data['company'] = $this->global_model->_get('pp_settings')->row_array();
		$data['data'] = $this->global_model->_get('tb_sparepart a', ['c.freeze' => '1'], [], [], 'a.*,b.id as locationid, c.nama as location', $join, false, 'c.id asc');
		if ($is_print) {
			$this->load->templateAdmin('stock/add-opname', $data);
		}else{
			$this->load->view('popoti/stock/add-opname', $data);
		}
	}

	function start_opname()
	{
		if ($this->input->is_ajax_request()) {
			$this->global_model->_update('tb_location', ['last_opname' => date('Y-m-d')], ['freeze' => '1']);
			echo json_encode(['status' => 1]);
		}
	}

	function opname()
	{
		cekoto('stock/opname', 'view', true, true);
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
        $this->data['js'][] = base_url('assets/custom/js/stock.js');
        $this->data['menuName'] = 'Opname';
        $data = array(
        	'location' => ordered_menu($this->global_model->_get('tb_location', ['status' => '1'])->result_array()),
        );
		$this->load->templateAdmin('stock/modul/opname', $data);
	}

	function actual_stock()
	{
		cekoto('stock/actual-stock','view', true, true);
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

        $this->data['js'][] = base_url('assets/custom/js/stock.js');
        $this->data['menuName'] = 'Actual Stock';

        $data['location'] = $this->stock_model->getactual();
        // print_ar($data);die;
		$this->load->templateAdmin('stock/modul/actual-stock', $data);
	}
	function input_actual_action()
	{
		$this->form_validation->set_rules('actual', 'Qty', 'trim|required|numeric');
		if ($this->form_validation->run() == TRUE) {
			$res = $this->stock_model->input_actual_action($this->input->post('id'), $this->input->post('actual'));
			if ($res['status'] == 1) {
				$this->query_error("Qty and Actual Qty is same");
			}
			if ($this->db->affected_rows() > 0) {
				echo json_encode(['status' => 1, 'pesan' => 'success']);
			}else{
				$this->query_error("Oops, something happends, please contact developer !");
			}
		} else {
				$this->input_error();
		}


	}
	function print_actual($id)
	{
		$data['company'] = $this->global_model->_get('pp_settings')->row_array();
		$join = [
			['tb_sparepart b', 'a.sparepartid = b.id', 'left'],
			['tb_location c', 'a.locationid = c.id', 'left']
		];
		$data['data'] = $this->global_model->_get('tb_actual_stock a', ['a.locationid' => decode($id) ,'a.tanggal' => date('Y-m-d') ], [], [], 'a.*,b.kode,b.het, b.nama as sparepart, c.nama as location', $join);
		// print_ar($data);
		$this->load->templateAdmin('stock/print_actual', $data);
	}
	function input_actual($id)
	{
        $this->data['menuName'] = 'Input Actual';
		if($id):
		cekoto('stock/input_actual', 'add', true, true);
			if($_POST):

			else:
				$join = array(
					['tb_sparepart b', 'a.sparepartid = b.id', 'left'],
					['tb_location c', 'a.locationid = c.id', 'left'],
				);
				$data = array(
					'item' => $this->global_model->_get('tb_sparepart_location a', ['a.locationid' => decode($id)], [], [], 'a.id, a.locationid, a.sparepartid, b.kode, b.nama, a.qty, c.nama location', $join),
				);
				$data['id'] = $id;
				// $this->data['js'][] = base_url("assets/libs/devbridge-autocomplete/jquery.autocomplete.min.js");
				// $this->data['js'][] = base_url("assets/libs/jquery-tabledit/jquery.tabledit.min.js");
				$this->data['js'][] = base_url('assets/custom/js/stock.js');
				$this->load->templateAdmin('stock/modul/input-actual-stock', $data);
			endif;
		else:
			$this->load->templateAdmin('errors/404');
		endif;
	}

	function confirm_actual($locationid)
	{
		// print_ar($this->input->post());die;
		$locationid = decode($locationid);
		$sparepartid = $this->input->post('sparepartid');
		$location_sparepart = $this->input->post('id');
		foreach ($location_sparepart as $key => $value) {
			$this->form_validation->set_rules('actual['.$value.']', 'Actual', 'trim|required|numeric');
		}
		if ($this->form_validation->run() == TRUE) {
			$exist = $this->global_model->_get('tb_actual_stock', ['locationid' => $locationid, 'tanggal' => date('Y-m-d')])->num_rows();
			if ($this->input->post('hassave') OR $exist) {
				$this->global_model->_delete('tb_actual_stock', ['locationid' => $locationid, 'tanggal' => date('Y-m-d')]);
			}
			$this->stock_model->add_actual($sparepartid, $locationid, $location_sparepart ,$this->input->post('actual'));
			if ($this->db->affected_rows() > 0) {
				echo json_encode(['status' => 1, 'pesan' => 'success']);
			}else{
				$this->query_error("Oops, something happends, please contact developer !");
			}
		} else {
			$this->input_error();
		}
	}

	function confirm_gap()
	{
		$locationid = decode($this->input->post('location'));
		$type = $this->input->post('type');
		$amount = $this->input->post('amount');
		$grandtotal = toFloat($this->input->post('grandtotal'));
		$coaid = $this->input->post('aliasid');
		$supply = $this->input->post('supply');

		$this->stock_model->confirm_gap($locationid, $type, $amount, (isset($_POST['employeeid']) ?? false), $grandtotal, $coaid, $supply);

		if ($this->db->affected_rows() > 0) {
			echo json_encode(['status' => 1, 'pesan' => 'success']);
		}else{
				$this->query_error($this->db->last_query());
			
			$this->query_error("Oops, something happends, please contact developer !");
		}
	}

	function bayar_gap($locationid)
	{
		$data['locationid'] = $locationid;
		$data['bill'] = $this->input->get('bil');
		$data['location'] = $this->input->get('location');
		$data['supply'] = $this->stock_model->supply();
		$data['sales'] = $this->stock_model->sales();
		// print_r($data);die;
		$this->load->view('popoti/stock/modul/bayar_gap', $data);
	}

	function gap()
	{
		cekoto('stock/gap', 'view', true, true);
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

        $this->data['js'][] = base_url('assets/custom/js/stock.js');
        $this->data['menuName'] = 'GAP';
        // print_ar($this->stock_model->getgapnow());die;
		$this->load->templateAdmin('stock/gap');

	}

	function gap_json($sparepartid = 0, $locationid = 0)
	{
		// if($this->input->is_ajax_request()):
			$requestData	= $_REQUEST;
			$fetch			= $this->stock_model->getgapjson($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length'], $sparepartid, $locationid);

			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array();  

				$nestedData[] = tgl($row->tanggal);
				$nestedData[] = $row->location;
				$nestedData[] = $row->totalitem;
				$nestedData[] = $row->margin;
				$nestedData[] = "<a href='".site_url('stock/gapview/'.encode($row->id).'~'.$row->tanggal.'~'.encode($row->actualid) )."' id='chargeview' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Charge</a>";

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
	}
	function order_json($status = null, $tanggal1 = null, $tanggal2 = null)
	{
		// if($this->input->is_ajax_request()):
			$requestData	= $_REQUEST;
			$fetch			= $this->stock_model->getsummaryorder($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length'], $status, $tanggal1, $tanggal2);

			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array();  

				$nestedData[] = tgl($row->order_date);
				$nestedData[] = $row->no;
				$nestedData[] = $row->supplier;
				$nestedData[] = tgl($row->delivery_plan);
				$kat = ($row->from == 'recommended') ? 'success' : 'info';
				$nestedData[] = '<span class="badge badge-outline-'.$kat.'">'.$row->from.'</span>';
				$status = '';
				$type = '';
				switch ($row->status) {
					case '0': $status = 'Draft';$type = 'primary';break;
					case '1': $status = 'Dikirim';$type = 'warning';break;
					case '2': $status = 'Diterima';$type = 'success';break;
					case '3': $status = 'Cancel';$type = 'danger';break;
				}
				$print = "<a id='print' href='".base_url('purchase/print-order/'.encode($row->id).'?cetak=1')."' class='btn btn-sm btn-primary'><i class='fa fa-print mr-1'></i>Print</a>";
				$nestedData[] = '<span class="badge badge-outline-'.$type.'">'.$status.'</span>';
				$button = '<div class="btn-group btn-sm">';
				if($row->status == '0'):
					$button .= '<a href="'.base_url('purchase/'.$row->from.'/'.encode($row->id)).'" class="btn btn-sm btn-warning edit-order"><i class="fas fa-edit mr-1"></i>Edit</a>';
					// $button .= '<a href="'.base_url('stock/'.$row->from.'/'.encode($row->id)).'" class="btn btn-sm btn-warning approve-order"><i class="mdi mdi-check mr-1"></i>Approve</a>';
					$button .= '<a href="'.base_url('stock/delete-order/'.encode($row->id)).'" class="btn btn-sm btn-danger delete-order"><i class="mdi mdi-delete mr-1"></i>Cancel</a>';
					$button .= $print;
				elseif($row->status == '1'):
					// $button .= '<a href="'.base_url('purchase/'.$row->from.'/'.encode($row->id)).'" class="btn btn-sm btn-danger"><i class="fa fa-edit mr-1"></i>Cancel</a>';
					$button .= $print;
				endif;
				$button .= '</div>';
				$nestedData[] = $button;

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
	}
	function delete_order($id)
	{
		if ($this->input->is_ajax_request()) {
			$this->global_model->_delete('tb_order', ['id' => decode($id)]);
		}
	}
	function addgap()
	{
		// print_r($this->input->post());
		if ($this->input->is_ajax_request()) {
			$id = decode($this->input->post('id'));
			$total = $this->input->post('total');
			$data = [
				'amount' 	=> $total,
				'tanggal'   => date('Y-m-d'),
				'duedate'   => date('Y-m-d'),
				'status'	=> '0',
				'source'	=> json_encode(['tb_coa_alias' => $this->input->post('coa')])
			];
			$this->global_model->_insert('tb_ap', $data);
			if ($this->db->affected_rows() > 0) {
				$this->global_model->_update('tb_actual_stock', ['status' => '1'], ['tanggal' => $this->input->post('tanggal')]);
				echo json_encode(['status' => 1, 'pesan' => 'success']);
			}else{
				$this->query_error("Oops, something happends, please contact developer !");
			}
		}

	}
	function gapview($del)
	{
		cekoto('stock/gap', 'add', true, false);
		$url = explode( '~' , $del);
		$data['id'] = encode($url[2]);
		$data['tanggal'] = $url[1];
		$data['data'] = $this->stock_model->getgaprow($url[0], $url[1]);
		$this->load->view('popoti/stock/modul/gapview', $data);
	}
	function freeze($id)
	{
		if($this->input->is_ajax_request()):
			if (!cekoto('stock/opname', 'edit', false, false)) {
				$this->query_error('Sorry, you can access this page');
				die;
			}
			if($id):
				$ubah = array(
					'freeze' => '1',
				);
				$this->global_model->_update('tb_location', $ubah, ['id' => decode($id)]);
				if($this->db->affected_rows() > 0):
					echo json_encode([
						'status' => '1',
						'pesan' => 'Location has been freezing.'
					]);
				else:
					echo json_encode([
						'status' => '0',
						'pesan' => 'Failed. Please contact developer'
					]);
				endif;
			else:
				$this->query_error('Please select one location');
			endif;
		endif;
	}

	function unfreeze($id)
	{
		if($this->input->is_ajax_request()):
			if($id):
				$ubah = array(
					'freeze' => '0',
				);
				$this->global_model->_update('tb_location', $ubah, ['id' => decode($id)]);
				if($this->db->affected_rows() > 0):
					echo json_encode([
						'status' => '1',
						'pesan' => 'Location opened.'
					]);
				else:
					echo json_encode([
						'status' => '0',
						'pesan' => 'Failed. Please contact developer'
					]);
				endif;
			else:
				$this->query_error('Please select one location');
			endif;
		endif;
	}

	public function picking()
	{

		cekoto('stock/picking', 'view', true, true);

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

        $this->data['js'][] = base_url('assets/custom/js/stock.js');
		$this->load->templateAdmin('stock/picking');
	}
	public function picking_json()
	{
		// if($this->input->is_ajax_request())
		// {
			$requestData	= $_REQUEST;
			$fetch			= $this->stock_model->getservicepicking($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length'], $this->input->post('status'), $this->input->post('tanggal1'), $this->input->post('tanggal2'));
			
			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{
				$nestedData = array(); 
				$nestedData[] = date('d-m-Y H:s:i', strtotime($row->date));
				$nestedData[] = $row->no;
				$nestedData[] = $row->customer;
				$nestedData[] = $row->total;
				$nestedData[] = ($row->employee) ?? '-';
				$nestedData[] = "<a href='".site_url('stock/detail/'.encode($row->id))."'  class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> detail</a>";
				// echo $this->db->last_query();

				$data[] = $nestedData; 
			}
   //          print_ar($this->db->last_query()); 
			// print_r($this->input->post());

			$json_data = array(
				"draw"            => intval( $requestData['draw'] ),  
				"recordsTotal"    => intval( $totalData ),  
				"recordsFiltered" => intval( $totalFiltered ), 
				"data"            => $data
				);

			echo json_encode($json_data);
		// }
	}

	public function detail($id)
	{
		if($id){
			cekoto('stock/picking', 'view', true, true );
		}
		$data['id'] = $id;
		$id = decode($id);
		$this->data['js'][] = base_url("assets/libs/devbridge-autocomplete/jquery.autocomplete.min.js");
		$this->data['js'][] = base_url("assets/libs/jquery-tabledit/jquery.tabledit.min.js");
		$this->data['js'][] = base_url('assets/custom/js/stock.js');
		$data['data'] = $this->stock_model->detailpicking($id);
		// print_ar($this->db->last_query());die;
		// print_ar($data);die;

		$this->load->templateAdmin('stock/detail', $data);
	}
	function editpicking()
	{
		// if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('picking', 'Picking', 'trim|required|numeric');
			if ($this->form_validation->run() == true) {
				$pic = $this->input->post('picking');
				$asalid = explode('-', $this->input->post('id'));
				$id = decode($asalid[0]);

				$row = $this->stock_model->getsparepartlocation($id);
				$sparepart = $this->global_model->_get('tb_service_parts', ['id' => decode($asalid[1])])->row();
				$stock = $row->qty;
				if ($pic > $stock) {
					echo json_encode(['status' => 0, 'pesan' => 'Melebihi kapasitas stock']);
				}else{
					$pickawal = $sparepart->pickingqty;
					$hasil = 0;
					
					if($pickawal < $pic)
						$hasil = $stock - $pic;
					elseif($pickawal > $pic)
						$hasil = ($pickawal - $pic) + $stock;
					else
						$hasil = $pickawal;

					$this->global_model->_update('tb_sparepart_location', ['qty' => $hasil], ['id' => $id]);
					$this->global_model->_update('tb_service_parts', ['pickingqty' => $pic, 'status' => 1], ['id' => decode($asalid[1])]);
					echo json_encode(['id' => $id, 'picking' => $pic]);
				}
			} else {
				$this->input_error_without_div();
			}
		// }
	}
	function delete_picking($id)
	{
		if ($this->input->is_ajax_request()) {
			if (!cekoto('stock/detail/'.$id, 'delete', false, false)) {
				$this->query_error('Sorry, you can access this condition');
				die;
			}
			$id = decode($id);
			$res = $this->db->delete('tb_service_parts', ['id' => $id]);
			if ($res) {
				return true;
			}
		}
	}
	function approve($id)
	{
		$id = decode($id);
		$this->global_model->_update('tb_service_parts', ['status' => 2], ['service_id' => $id]);
		$this->global_model->_update('tb_service', ['useridpicking' => $this->session->userdata('user'), 'status' => '2'], ['id' => $id]);
		$spt = $this->global_model->_get('tb_service_parts', ['service_id' => $id])->row();
		foreach ($spt as $value) {
		    if ($value->pickingqty == 0) {
		    	$this->db->query('update tb_service_parts set pickingqty = qty where service_id = '.$id);
		    }
		}
		$this->stock_model->mutasi_approve($id);
		redirect('stock/picking','refresh');
	}

	function receive($id = false)
	{
		$this->data['menuName'] = 'Receive';
		cekoto('stock/receive', 'view', true, true);
		if($_POST):
			if (!isset($_POST['poid'])) {
				echo json_encode(['status' => 0, 'pesan' => 'Please select order']);
				die;
			}

			$poid       = $this->input->post('poid');
			$qty        = $this->input->post('qty');
			$price      = $this->input->post('price');
			$locationid = $this->input->post('locationid');
			$sparepart  = $this->input->post('sparepartid');

			$this->form_validation->set_rules('due_date', 'Due Date', 'trim|required');

			foreach ($sparepart as $key => $value) {
				foreach ($sparepart[$key] as $ksp => $vsp) {
					$this->form_validation->set_rules('qty['.$key.']['.$vsp.']', 'Qty', 'trim|required');
					$this->form_validation->set_rules('price['.$key.']['.$vsp.']', 'Price', 'trim|required');
					$this->form_validation->set_rules('locationid['.$key.']['.$vsp.']', 'Location', 'trim|required');
				}
			}

			if ($this->form_validation->run() == TRUE) {
				if ($id) {
					$id = decode($id);
				}
				$data = [
					'no'         => getNoFormat('RCV'),
					'tanggal'    => date('Y-m-d'),
					'detail'     => $this->stock_model->getdetailreceive($this->input->post()),
					'due_date' => $this->input->post('due_date'),
					'receive_by' => $this->session->userdata('user'),
					'status'     => '0'
				];
				if ($id) {
					$receiveid = $id;
					$this->global_model->_insert('tb_receive', $data, ['id' => decode($id)]);
				}else{					
					$receiveid = $this->global_model->_insert('tb_receive', $data);
					// print_ar([$receiveid, $this->db->last_query()]);
					updateNo('RCV');
				}

				if ($this->db->affected_rows() > 0) {
					// addpayment(['tb_receive' => $receiveid], , $is_picking = false, $is_other = false, $table = null, $kategori = 'in', $customerid = 0, $supplierid = 0, $invoice = NULL);
					echo json_encode(['status' => 1, 'pesan' => 'success', 'id' => encode($receiveid)]);
				}else{
					$this->query_error("Oops, something happends, please contact developer !");
				}
			} else {
				$this->input_error();
			}
		else:
			$this->data['js'][] = base_url('assets/custom/js/receive.js');

			$this->load->templateAdmin('sparepart/purchase/receive');
		endif;
	}
	function retur_summary($id)
	{
		$id = decode($id);
		if ($_POST):
			$poid = $this->input->post('poid');
			$receive_qty = $this->input->post('receive-qty');
			$retur_qty = $this->input->post('retur-qty');
			$remainder = $this->input->post('remainder');
			$locationid = $this->input->post('locationid');

			$receive = $this->global_model->_get('tb_receive', ['id' => $id])->row();

			$detailReceive = [];
			foreach ($poid as $orderid => $value) {
			    foreach ($value as $k => $sparepartid) {
			    	$where = [
			    		'sparepartid' => $sparepartid,
			    		'locationid'  => $locationid[$orderid][$sparepartid]
			    	];
			    	$rtr = $retur_qty[$orderid][$sparepartid];
			    	$loc = $locationid[$orderid][$sparepartid];
			    	$this->db->query(
			    			"UPDATE `tb_sparepart_location` 
			    			SET `qty` = qty - $rtr 
			    			WHERE `sparepartid` = $sparepartid AND `locationid` = $loc "
			    	);
			    	$this->global_model->_insert('tb_sparepart_mutasi', [
			    			'waktu' => date('Y-m-d H:s:i'),
			    			'sparepartid' => $sparepartid,
			    			'locationid' => $loc,
			    			'type' => 'out',
			    			'qty' => $rtr,
			    			'source' => json_encode(['tb_receive' => $id])
			    	]);
			    	foreach (json_decode($receive->detail) as $keyR => $detail) {
			    	    if ($detail->sparepartid == $sparepartid) {
			    	    	if ($detail->qty > $rtr) {
			    	    		$detail->qty -= $rtr;
				    	    	$detailReceive[] = $detail;			    	    		
			    	    	}
			    	    }
			    	}
			    }
			}
	    	$this->global_model->_update('tb_receive', ['detail' => json_encode($detailReceive)], ['id' => $id]);
			echo json_encode(['status' => 1, 'pesan' => 'success', 'id' => encode($id)]);

		else:
			$this->data['menuName'] = 'Retur';
 			$data = $this->stock_model->getdatasummaryedit($id);
			$this->data['js'][] = base_url('assets/custom/js/receive.js');
			$this->load->templateAdmin('sparepart/purchase/retur', ['row' => $data]);	
		endif;

	}
	function location()
	{
		cekoto('stock/location', 'view', true, true);

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

		$this->data['js'][] = base_url("assets/libs/jquery-tabledit/jquery.tabledit.min.js");

        $this->data['js'][] = base_url('assets/custom/js/stock.js');

        $this->data['menuName'] = 'Location';

		return $this->load->templateAdmin('stock/location');
	}

	function location_detail($sparepartid = 0, $locationid = 0)
	{
		// if($this->input->is_ajax_request()):
			$requestData	= $_REQUEST;
			$fetch			= $this->stock_model->retrieveDataLocation($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length'], $sparepartid, $locationid);

			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 

				$nestedData[] = encode($row->id).'-'.encode($row->sparepartid);
				$nestedData[] = $row->kode;
				$nestedData[] = $row->nama;
				$nestedData[] = $row->location;
				$nestedData[] = $row->qty;
				$nestedData[] = '';
				$nestedData[] = '';

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
	}
	function sparepart_location_json($sparepartid = 0, $locationid = 0)
	{
		// if($this->input->is_ajax_request()):
			$requestData	= $_REQUEST;
			$fetch			= $this->stock_model->retrieveDataLocation($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length'], $sparepartid, $locationid);

			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 

				$nestedData[] = $row->kode;
				$nestedData[] = $row->nama;
				$nestedData[] = $row->location;
				$nestedData[] = $row->qty;
				$nestedData[] = 'Rp. '.rupiah($row->het);
				$nestedData[] = '<a href="'.base_url('stock/edit-location/'.encode($row->id)).'" title="Edit" class="btn btn-sm btn-primary" id="edit-location"><i class="fa fa-edit mr-2"></i>Edit</a>';

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
	}

	function edit_location($id)
	{

		if ($_POST) {
			$this->form_validation->set_rules('qty', 'Qty', 'trim|required|numeric');
			if ($this->form_validation->run() == true) {
				$this->global_model->_update('tb_sparepart_location', ['qty' => $this->input->post('qty')], ['id' => decode($id)]);
				echo json_encode(['status' => 1, 'pesan' => 'Qty has been updated']);
			} else {
				$this->input_error();
			}
		}else{
			if (!cekoto('stock/location', 'edit', true, false)) {
				$this->query_error('Sorry, you can access this page');
				die;
			}
			$data = [
				'id'  => $id,
				'qty' => sql_get_var('tb_sparepart_location', 'qty', ['id' => decode($id)])
			];
			return $this->load->view('popoti/stock/edit-location', $data);
		}

	}

	function transfer_print()
	{
		$data = [
			'no' => getNoFormat('TL'),
			'employeeid' => $this->session->userdata('user'),
			'tangal' => date('Y-m-d'),
			'detail' => json_encode($this->input->post()),
		];
		updateNo('TL');
		$id = $this->global_model->_insert('tb_transfer_location', $data);
		echo json_encode(['status' => 1, 'id' => $id]);
	}

	function printtransfer($id)
	{
		$this->data['css'][] = base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css');

		$this->db->select('a.*, b.nama');
		$this->db->from('tb_transfer_location a');
		$this->db->join('tb_employee b', 'a.employeeid = b.id', 'left');
		$this->db->where('a.id', $id);
		$data = $this->db->get()->row();
		$data->detail = json_decode($data->detail);
		$data->company = $this->global_model->_get('pp_settings')->row_array();
		// print_ar($data);
		return $this->load->templateAdmin('stock/print-transfer', ['data' => $data]);
	}

	function search_part_lok()
	{
		cekoto('stock/location', 'view', true, false);
		$data['category'] = $this->global_model->_get('tb_sparepart_category')->result();
		return $this->load->view('popoti/stock/search-part', $data);
	}
	function search_location_lok()
	{
		cekoto('stock/location', 'view', true, false);
		return $this->load->view('popoti/stock/search-location');
	}
	function location_part()
	{
		// if ($this->input->is_ajax_request()) {
			echo json_encode(['select' => $this->global_model->_get('tb_location')->result()]);
		// }
	}
	function location_json(){
		// if($this->input->is_ajax_request())
		// {
			$requestData	= $_REQUEST;
			$fetch			= $this->stock_model->getlocation($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);

			$totalData     = $fetch['totalData'];
			$totalFiltered = $fetch['totalFiltered'];
			$query         = $fetch['query'];
			// $query      = ordered_menu($query->result_array());

			/*foreach($query as $row):
				$data[] = nestedLocation($row);
				if(is_array($row['children'])):
					$data[] = nestedLocation($row['children']);
				endif;
			endforeach;

			print_ar($data);

			die();*/

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 

				$nestedData[] = $row->nama;

				$nestedData[]	= "<a href='javascript:void(0)' class='btn btn-info waves-effect waves-light choose' data-id='$row->id'><i class='mdi mdi-cursor-pointer mr-1'></i> Choose</a>";

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
	function transfer_location()
	{
		$this->form_validation->set_rules('qty', 'Qty', 'trim|required|numeric');

		if ($this->input->post('locationid') == 0) {
			echo json_encode(['status' => 0, 'pesan' => 'Location is required']);
			return;
		}

		if ($this->form_validation->run() == true) {
			$id = explode('-', $this->input->post('id'));
			$row = $this->global_model->_get('tb_sparepart_location', ['id' => decode($id[0])])->row();
			$qty = $this->input->post('qty');
			$location = $this->input->post('locationid');
			$currentQty = $row->qty;
			if($qty > $currentQty ){
				echo json_encode(['status' => 0, 'pesan' => 'Pemindahan melebihi jumlah item yang ada']);
				return;
			}
			else{
				$sisaQty = $currentQty - $qty;
				$result = $this->stock_model->transferlocation($id, $sisaQty, $location, $qty);
				echo json_encode(['status' => 1, 'pesan' => 'Item has moved']);
			}

		} else {
			$this->input_error_without_div();
		}
	}

	function receive_summary()
	{
		cekoto('stock/receive-summary', 'view', true, true);
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

        $this->data['js'][] = base_url('assets/custom/js/stock.js');
		$this->data['menuName'] = 'Receive Summary';
		$this->load->templateAdmin('stock/receive-summary');
	}
	function receive_summary_json($status = null, $tanggal1 = null, $tanggal2 = null)
	{
		// if($this->input->is_ajax_request())
		// {
			$requestData	= $_REQUEST;
			
			$fetch			= $this->stock_model->getsummaryrecieve($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length'], $status, $tanggal1, $tanggal2);

			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 


				$nestedData[] = tgl($row->tanggal);
				$nestedData[] = $row->no;

				$totalRow = 0;
				foreach (json_decode($row->detail) as $key => $value) {
					$totalRow++;
				}

				$nestedData[] = $totalRow;
				$nestedData[] = $row->user;
				$status = $row->status;

				$text = '';
				$color = '';
				switch ($status) {
					case 0: $text = 'Draft'; $color = 'warning'; break;
					case 1: $text = 'Approve'; $color = 'success'; break;
					case 2: $text = 'Retur'; $color = 'success'; break;
					case 3: $text = 'Void'; $color = 'danger'; break;
				}

				$data_id = ($status == 3) ? 'data-id='.encode($row->id) : '';
				$is_void = ($status == 3) ? 'void-message' : '';
				$nestedData[]	= "<a href='javascript:void' $data_id class='$is_void btn btn-sm btn-$color waves-effect waves-light'> $text</a>";
				$print = "<a id='print' href='".base_url('purchase/print-order/'.encode($row->id).'/1?cetak=1')."' class='btn btn-sm btn-primary'><i class='fa fa-print mr-1'></i>Print</a>";
				if($status == 0){				
					$nestedData[]	= "<div class='btn-group'><a href='".base_url('stock/edit-summary/'.encode($row->id))."' class='btn btn-sm btn-warning waves-effect waves-light'><i class='fa fa-edit mr-1'></i> Edit</a><a href='".base_url('stock/approve-summary/'.encode($row->id))."' class='approve-summary btn btn-sm btn-success waves-effect waves-light'><i class='fa fa-check mr-1'></i> Approve</a><a href='".base_url('stock/cancel-summary/'.encode($row->id))."' class='cancel-summary btn btn-sm btn-danger waves-effect waves-light'><i class='fa fa-trash mr-1'></i> Cancel</a>".$print."</div>";
				}elseif($status == 1){
					$nestedData[]	= "<div class='btn-group'><a href='".base_url('stock/void-summary/'.encode($row->id))."' class='void-summary btn btn-sm btn-danger waves-effect waves-light'><i class='fa fa-trash mr-1'></i> Void</a><a href='".base_url('stock/retur-summary/'.encode($row->id))."' class='btn btn-sm btn-warning waves-effect waves-light'><i class='fa fa-check mr-1'></i> Retur</a>".$print."</div>";
				}else{
					$nestedData[] = "<div class='btn-group'>".$print."</div>";
				}


				$data[] = $nestedData;
			}

			$json_data = array(
				// "draw"            => intval( $requestData['draw'] ),  
				"recordsTotal"    => intval( $totalData ),  
				"recordsFiltered" => intval( $totalFiltered ), 
				"data"            => $data
			);

			echo json_encode($json_data);
		// }
	}
	function order_summary_json($status = null, $tanggal1 = null, $tanggal2 = null)
	{
		// if($this->input->is_ajax_request())
		// {
			$requestData	= $_REQUEST;
			
			$fetch			= $this->stock_model->getsummaryrecieve($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length'], $status, $tanggal1, $tanggal2);

			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 


				$nestedData[] = tgl($row->tanggal);
				$nestedData[] = $row->no;

				$totalRow = 0;
				foreach (json_decode($row->detail) as $key => $value) {
					$totalRow++;
				}

				$nestedData[] = $totalRow;
				$nestedData[] = $row->user;
				$status = $row->status;

				$text = '';
				$color = '';
				switch ($status) {
					case 0: $text = 'Draft'; $color = 'warning'; break;
					case 1: $text = 'Approve'; $color = 'success'; break;
					case 2: $text = 'Retur'; $color = 'success'; break;
					case 3: $text = 'Void'; $color = 'danger'; break;
				}

				$data_id = ($status == 3) ? 'data-id='.encode($row->id) : '';
				$is_void = ($status == 3) ? 'void-message' : '';
				$nestedData[]	= "<a href='javascript:void' $data_id class='$is_void btn btn-sm btn-$color waves-effect waves-light'> $text</a>";

				if($status == 0){				
					$nestedData[]	= "<div class='btn-group'><a href='".base_url('stock/edit-summary/'.encode($row->id))."' class='btn btn-sm btn-warning waves-effect waves-light'><i class='fa fa-edit mr-1'></i> Edit</a><a href='".base_url('stock/approve-summary/'.encode($row->id))."' class='approve-summary btn btn-sm btn-success waves-effect waves-light'><i class='fa fa-check mr-1'></i> Approve</a><a href='".base_url('stock/cancel-summary/'.encode($row->id))."' class='cancel-summary btn btn-sm btn-danger waves-effect waves-light'><i class='fa fa-trash mr-1'></i> Cancel</a></div>";
				}elseif($status == 1){
					$nestedData[]	= "<div class='btn-group'><a href='".base_url('stock/void-summary/'.encode($row->id))."' class='void-summary btn btn-sm btn-danger waves-effect waves-light'><i class='fa fa-trash mr-1'></i> Void</a><a href='".base_url('stock/retur-summary/'.encode($row->id))."' class='btn btn-sm btn-danger waves-effect waves-light'><i class='fa fa-check mr-1'></i> Retur</a></div>";
				}else{
					$nestedData[] = '';
				}


				$data[] = $nestedData;
			}

			$json_data = array(
				// "draw"            => intval( $requestData['draw'] ),  
				"recordsTotal"    => intval( $totalData ),  
				"recordsFiltered" => intval( $totalFiltered ), 
				"data"            => $data
			);

			echo json_encode($json_data);
		// }
	}
	function cancel_summary($id)
	{
		if ($this->input->is_ajax_request()) {
			$this->global_model->_delete('tb_receive', ['id' => decode($id)]);
		}
	}
	function void_summary($id)
	{
		if ($this->input->is_ajax_request()) {
			$this->global_model->_update('tb_receive', ['status' => '3', 'alasan' => $this->input->post()['reason'] ] ,['id' => decode($id)]);
		}
	}
	function approve_summary($id)
	{
		$id = decode($id);
		if ($this->input->is_ajax_request()) {
			$this->stock_model->approve_summary($id);
		}

	}
	function message_void($id)
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode(sql_get_var('tb_receive', 'alasan', ['id' => decode($id)]));
		}
	}
	function edit_summary($id = false)
	{
		if($_POST):
			if (!isset($_POST['poid'])) {
				echo json_encode(['status' => 0, 'pesan' => 'Please select order']);
				die;
			}

			// print_ar($this->input->post());

			$poid       = $this->input->post('poid');
			$qty        = $this->input->post('qty');
			$price      = $this->input->post('price');
			$locationid = $this->input->post('locationid');
			$sparepart  = $this->input->post('sparepartid');

			$this->form_validation->set_rules('due_date', 'Due Date', 'trim|required');

			foreach ($sparepart as $key => $value) {
				foreach ($sparepart[$key] as $ksp => $vsp) {
					$this->form_validation->set_rules('qty['.$key.']['.$vsp.']', 'Qty', 'trim|required');
					$this->form_validation->set_rules('price['.$key.']['.$vsp.']', 'Price', 'trim|required');
					$this->form_validation->set_rules('locationid['.$key.']['.$vsp.']', 'Location', 'trim|required');
				}
			}

			if ($this->form_validation->run() == TRUE) {
				if ($id) {
					$id = decode($id);
				}
				$data = [
					'detail'     => $this->stock_model->getdetailreceive($this->input->post()),
					'due_date'  => $this->input->post('due_date')
				];

				$this->global_model->_update('tb_receive', $data, ['id' => $id]);
				$receiveid = $id;

				if ($this->db->affected_rows() > 0) {
					// addpayment(['tb_receive' => $receiveid], , $is_picking = false, $is_other = false, $table = null, $kategori = 'in', $customerid = 0, $supplierid = 0, $invoice = NULL);

					echo json_encode(['status' => 1, 'pesan' => 'success', 'id' => encode($receiveid)]);
				}else{
					echo $this->db->last_query();
					$this->query_error("Oops, something happends, please contact developer !");
				}
			} else {
				$this->input_error();
			}
		else:
			$id = decode($id);
			$data = $this->stock_model->getdatasummaryedit($id);
			$this->data['js'][] = base_url('assets/custom/js/receive.js');
			$this->load->templateAdmin('sparepart/purchase/edit-receive', ['row' => $data ]);
		endif;
	}

	function getallfromlocation($type ,$id)
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->stock_model->getallfromlocation($type,$id));
		}
	}
	function select_sparepart()
	{
		cekoto('stock/location', 'view', true, false);
		return $this->load->view('popoti/stock/popup-part.php');
	}
	function findsparepartlocation($id)
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->stock_model->findsparepartlocation(decode($id)));
		}
	}
	function sparepart_json()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->model('sparepart_model');
			$requestData	= $_REQUEST;
			$fetch			= $this->sparepart_model->getsparepart($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
			
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

				$nestedData[] = "<a href='javascript:void(0)' class='btn btn-warning btn-sm mr-1' id='retrieve-ini' data-id='".encode($row->id)."'><i class='mdi mdi-cursor-pointer mr-1'></i> Retrieve</a>";

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
	function new_transaction()
	{
		if (!cekoto('stock/location', 'add', false, false)) {
			$this->query_error('Sorry, you can access this page');
			die;
		}
		$location = ($this->input->post('locationid')) ?? false;
		$qty = ($this->input->post('qty')) ?? false;
		$sparepartLocationCurrent = [];

		if (!$location OR !$qty) {
			echo json_encode(['status' => 0, 'pesan' => 'Location Or Qty is required']);die;
		}

		foreach ($location as $sparepartLocationId => $locat) {
			$sparepartLocationCurrent[] = $sparepartLocationId;
			foreach ($locat as $key => $loc) {
				$this->form_validation->set_rules('locationid['.$sparepartLocationId.']['.$key.']', 'Location', 'trim|required');		    
			}
		}

		foreach ($qty as $sparepartLocationId => $qt) {
			foreach ($qt as $key => $q) {
				$this->form_validation->set_rules('locationid['.$sparepartLocationId.']['.$key.']', 'Location', 'trim|required');		    
			}
		}

		if ($this->form_validation->run() == true) {
			$this->stock_model->new_transaction($sparepartLocationCurrent, $location, $qty);
			if ($this->db->affected_rows()) {
				echo json_encode(['status' => 1, 'pesan' => 'data has been add']);
			}else{
				$this->query_error("Oops, something happends, please contact developer !");
			}
		} else {
			$this->input_error();
		}

	}
	function add_beginning()
	{
		$location = ($this->input->post('locationid')) ?? false;
		$qty = ($this->input->post('qty')) ?? false;
		$sparepart = [];

		if (!$location OR !$qty) {
			echo json_encode(['status' => 0, 'pesan' => 'Location Or Qty is required']);die;
		}

		foreach ($location as $sparepartid => $locat) {
			$sparepart[] = $sparepartid;
			foreach ($locat as $key => $loc) {
				$this->form_validation->set_rules('locationid['.$sparepartid.']['.$key.']', 'Location', 'trim|required');		    
			}
		}
		foreach ($qty as $sparepartid => $qt) {
			foreach ($qt as $key => $q) {
				$this->form_validation->set_rules('qty['.$sparepartid.']['.$key.']', 'Location', 'trim|required');		    
			}
		}

		if ($this->form_validation->run() == true) {
			$this->stock_model->add_beginning($sparepart, $location, $qty);
			if ($this->db->affected_rows()) {
				echo json_encode(['status' => 1, 'pesan' => 'data has been add']);
			}else{
				$this->query_error("Oops, something happends, please contact developer !");
			}
		} else {
			$this->input_error();
		}
	}
}