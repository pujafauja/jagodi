<?php

/**
 * 
 */
class Purchase extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(['Purchase_model']);
		isloggedin();
	}

	function index()
	{

	}
	function retrieve_abc_data($abcid = NULL)
	{
		if($abcid):
			$join = [
				['tb_abc b', 'a.abcid = b.id', 'left'],
				// ['tb_sparepart_location c', 'a.id = c.sparepartid', 'left'],
			];

			$retrieve = $this->global_model->_get(
				'tb_sparepart a', 
				"a.abcid = $abcid AND IFNULL((SELECT SUM(qty) FROM tb_sparepart_mutasi WHERE sparepartid = a.id), 0) <= b.lower", 
				[], 
				[], 
				'a.*, b.code as abc_code, b.lower, b.roq, IFNULL((SELECT SUM(qty) FROM tb_sparepart_mutasi WHERE sparepartid = a.id), 0) total, (SELECT SUM(qty) FROM tb_sparepart_mutasi WHERE waktu <= DATE_SUB(NOW(), INTERVAL 90 DAY) AND sparepartid = a.id) average', $join);
			return $retrieve->result();
		endif;
	}
	function recommended($id = false)
	{
		cekoto('purchase/recommended', 'view', true, true);
		if($_POST):
			if(! isset($_POST['action'])):
				$this->form_validation->set_rules('no', 'Purchase No.', 'required|max_length[100]');
				$this->form_validation->set_rules('supplierid', 'Supplier', 'required');
				$this->form_validation->set_rules('date-plan', 'Delivery Plan Date', 'required');

				foreach($this->input->post('sparepartid') as $index => $sparepartid):
					$sparepartName = sql_get_var('tb_sparepart', 'nama', ['id' => $sparepartid]);

					$this->form_validation->set_rules('qty['.$index.']', 'QTY ' . $sparepartName, 'required|numeric');					

					$index++;
				endforeach;

				if($this->form_validation->run() == true):
					$order_date    = date('Y-m-d H:i:s');
					$no            = $this->input->post('no');
					$supplierid    = $this->input->post('supplierid');
					$delivery_plan = $this->input->post('date-plan');
					$abcid         = $this->input->post('abcid');
					$memo          = $this->input->post('memo');
					$price         = $this->input->post('price');
					$qty           = $this->input->post('qty');
					$from          = 'recommended';
					$status        = '0';
					$order_by      = $this->session->userdata('user');

					$details = array();
					foreach($this->input->post('sparepartid') as $index => $sparepartid):
						$details[] = [
							'sparepartid' => $sparepartid,
							'price'       => $price[$index],
							'qty'         => $qty[$index],
							'status'       => '0', // 0: belum diterima; 1: sudah diterima; 2: cancel / retur
						];
					endforeach;

					$detail = json_encode($details);

					$insert = array(
						'order_date'    => $order_date,
						'no'            => $no,
						'supplierid'    => $supplierid,
						'delivery_plan' => $delivery_plan,
						'abcid'         => $abcid,
						'memo'          => $memo,
						'detail'        => $detail,
						'from'          => $from,
						'status'        => $status,
						'order_by'      => $order_by,
					);

					if ($id) {
						$id = decode($id);
						$this->global_model->_update('tb_order', $insert, ['id' => $id]);
					}else{					
						$id = $this->global_model->_insert('tb_order', $insert);
						updateNo('PO');
					}


					if($this->db->affected_rows() > 0):

						echo json_encode([
							'status' => 1,
							'pesan'  => 'Data has been added',
							'id' => encode($id)
						]);
					endif;
				else:
					$this->input_error();
				endif;
			else:
				echo json_encode(['status' => 1]);
			endif;
		else:
			$this->data['js'][] = base_url("assets/libs/devbridge-autocomplete/jquery.autocomplete.min.js");
			$this->data['js'][] = base_url("assets/libs/jquery-tabledit/jquery.tabledit.min.js");
			$this->data['js'][] = base_url('assets/custom/js/purchase.js');
			$this->data['menuName'] = "Recommendation Order";

			if ($id) {
				$order = $this->global_model->_get('tb_order', ['id' => decode($id)])->row();
				$abcData = $this->retrieve_abc_data($order->abcid);
				$detail = json_decode($order->detail);

				$resultData = [];
				foreach ($detail as $key => $value) {
				    foreach ($abcData as $abcKey => $abcValue) {
				        if ($value->sparepartid == $abcValue->id) {
				        	$abcValue->price = $value->price;
				        	$abcValue->qty = $value->qty;
				        	$resultData[] = $abcValue; 
				        }
				    }
				}

				$order->detail = $resultData;
				$order->supplier = sql_get_var('tb_supplier', 'nama', ['id' => $order->supplierid]);
				$data['purchase'] = $order;
				// print_ar($data);die;
			}else{
				$data['purchase'] = (object) array(
					'id' => '',
					'no' => '',
					'order_date' => '',
					'supplierid' => '',
					'supplier' => '',
					'delivery_plan' => '',
					'abcid' => '',
					'memo' => '',
					'detail' => [],
				);
			}

			// print_ar($data);
			$data['abc'] = $this->global_model->_get('tb_abc');
			$this->load->templateAdmin('sparepart/purchase/recommended', $data);
		endif;
	}

	function unrecommended($id = false)
	{
		cekoto('purchase/unrecommended', 'view', true, true);
		$this->data['menuName'] = "Non Recommendation Order";
		if($_POST):
			if(! isset($_POST['action'])):
				$this->form_validation->set_rules('no', 'Purchase No.', 'required|max_length[100]');
				$this->form_validation->set_rules('supplierid', 'Supplier', 'required');
				$this->form_validation->set_rules('date-plan', 'Delivery Plan Date', 'required');

				foreach($this->input->post('sparepartid') as $index => $sparepartid):
					$sparepartName = sql_get_var('tb_sparepart', 'nama', ['id' => $sparepartid]);

					$this->form_validation->set_rules('qty['.$index.']', 'QTY ' . $sparepartName, 'required|numeric');					

					$index++;
				endforeach;

				if($this->form_validation->run() == true):
					$order_date    = date('Y-m-d H:i:s');
					$no            = $this->input->post('no');
					$supplierid    = $this->input->post('supplierid');
					$delivery_plan = $this->input->post('date-plan');
					$memo          = $this->input->post('memo');
					$price         = $this->input->post('price');
					$qty           = $this->input->post('qty');
					$from          = 'unrecommended';
					$status        = '0';
					$order_by      = $this->session->userdata('user');

					$details = array();
					foreach($this->input->post('sparepartid') as $index => $sparepartid):
						$details[] = [
							'sparepartid' => $sparepartid,
							'qty'         => $qty[$index],
							'price'         => $price[$index],
							'status'       => '0', // 0: belum diterima; 1: sudah diterima; 2: cancel / retur
						];
					endforeach;

					$detail = json_encode($details);
					// print_ar($detail);die;
					$insert = array(
						'order_date'    => $order_date,
						'no'            => $no,
						'supplierid'    => $supplierid,
						'delivery_plan' => $delivery_plan,
						'memo'          => $memo,
						'detail'        => $detail,
						'from'          => $from,
						'status'        => $status,
						'order_by'      => $order_by,
					);
					if ($id) {
						$this->global_model->_update('tb_order', $insert, ['id' => decode($id)]);
					}else{
						$id = $this->global_model->_insert('tb_order', $insert);
						updateNo('NPO');
						$id = encode($id);
					}

					if($this->db->affected_rows() > 0):
						echo json_encode([
							'status' => 1,
							'pesan'  => 'Data has been added',
							'id' => $id
						]);
					endif;
				else:
					$this->input_error();
				endif;
			else:
				echo json_encode(['status' => 1]);
			endif;
		else:
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
	        
			$this->data['js'][] = base_url("assets/libs/devbridge-autocomplete/jquery.autocomplete.min.js");
			$this->data['js'][] = base_url("assets/libs/jquery-tabledit/jquery.tabledit.min.js");
			$this->data['js'][] = base_url('assets/custom/js/purchase.js');

			if ($id) {
				$data['purchase'] = $this->global_model->_get('tb_order', ['id' => decode($id)])->row();
				// print_ar($data);die;
			}else{
				$data['purchase'] = (object) array(
					'id'	 		=> '',
					'order_date'    => '',
					'no'            => '',
					'supplierid'    => '',
					'delivery_plan' => '',
					'memo'          => '',
					'detail'        => '',
					'from'          => '',
					'status'        => '',
					'order_by'      => '',
				);
			}

			$data['abc'] = $this->global_model->_get('tb_abc');
			$this->load->templateAdmin('sparepart/purchase/unrecommended', $data);
		endif;
	}

	function print_order($id, $is_receive = false)
	{
		if (!$is_receive) {
			$this->db->join('tb_supplier b', 'a.supplierid = b.id', 'left');
			$row = $this->global_model->_get('tb_order a', ['a.id' => decode($id)], [], [], 'a.*, b.nama as supplier')->row();
			$data['is_receive'] = 0;
		}else{
			$row = $this->global_model->_get('tb_receive a', ['a.id' => decode($id)])->row();
			$data['is_receive'] = 1;
		}
		$data['data'] = $row;
		$data['company'] = $this->global_model->_get('pp_settings')->row_array();
		// print_ar($row);
		$this->load->templateAdmin('sparepart/purchase/print-order', $data);
	}

	function popup_po()
	{
		cekoto('stock/receive-summary', 'view', true, false);
		$data['exists'] = $this->input->post('exists');

		$this->load->view('popoti/sparepart/purchase/po-popup', $data);
	}

	function po_datatable($from = NULL)
	{
		if($this->input->is_ajax_request())
		{
			if($this->input->post('exists') != 'null')
				$exists = json_decode($this->input->post('exists'), true);
			else
				$exists = array();

			$requestData	= $_REQUEST;
			$fetch			= $this->Purchase_model->getpo($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length'], $from, $exists);
			
			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 

				$nestedData[] = $row->no;
				$nestedData[] = $row->supplier;
				$nestedData[] = tgl($row->order_date);

				$button = "<div class='btn-group btn-sm'>";
				if(isset($_GET['direct-retrieve']))
					$button .= "<a href='javascript:void(0)' class='btn btn-warning btn-sm mr-1' id='retrieve-ini' data-id='".$row->id."'><i class='mdi mdi-cursor-pointer mr-1'></i> Retrieve</a>";
				else
					$button .= "<a href='javascript:void(0)' class='btn btn-primary pilih-ini btn-sm mr-1' data-id='".$row->id."'><i class='mdi mdi-cursor-pointer mr-1'></i> Choose</a>";

				$button .= "</div>";

				$nestedData[]	= $button;
				
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

	function po_detail($id = NULL)
	{
		if($id):
			// if($this->input->is_ajax_request()):
				$po = $this->global_model->_row('tb_order', ['id' => $id]);
				if($po->num_rows() > 0):
					$details = $po->row();

					if($details->detail):
						$newDetail = [];
						foreach(json_decode($details->detail) as $d):
							$sparepartid = $d->sparepartid;
							$price       = $d->price;
							$qty         = $d->qty;

							$join = array(
								['tb_abc b', 'a.abcid = b.id', 'left'],
							);

							$sparepart = $this->global_model->_get('tb_sparepart a', ['a.id' => $sparepartid], array(), array(), 'a.kode, a.nama, b.code', $join)->row();

							$newDetail[] = (object) array(
								'id'    => $sparepartid,
								'kode'  => $sparepart->kode,
								'nama'  => $sparepart->nama,
								'abc'   => $sparepart->code,
								'price' => $d->price,
								'qty'   => $d->qty,
							);
						endforeach;

						unset($details->detail);
						$details->detail = $newDetail;
					endif;
					$details->order_date_default = date('Y-m-d', strtotime($details->order_date));
					$details->order_date = tgl($details->order_date_default);
					$details->supplier = sql_get_var('tb_supplier', 'nama', ['id' => $details->supplierid]);

					echo json_encode($details);
				endif;
			// endif;
		endif;
	}

	function retrieve_order()
	{
		// if($this->input->is_ajax_request()):
			$startdate  = $this->input->post('startdate');
			$enddate    = $this->input->post('enddate');
			$supplierid = $this->input->post('supplierid');

			$where = '1';

			if($startdate && !$enddate)
				$where .= ' AND LEFT(order_date, 10) = \''.$startdate.'\'';
			elseif(!$startdate && $enddate)
				$where .= ' AND LEFT(order_date, 10) = \''.$enddate.'\'';
			elseif($startdate && $enddate)
			{
				$where .= ' AND LEFT(order_date, 10) => \''.$startdate.'\'';
				$where .= ' AND LEFT(order_date, 10) <= \''.$enddate.'\'';
			}

			if($supplierid)
				$where .= ' AND supplierid = \''.$supplierid.'\'';


			if(isset($_POST['exists']) && count($_POST['exists']) > 0)
				$where .= ' AND id NOT IN ('.implode(',', $_POST['exists']).')';

			$po                = $this->global_model->_get('tb_order', $where);
			$result            = array();
			$result['results'] = $po->num_rows();

			if($po->num_rows() > 0):
				foreach($po->result() as $purchase):
					if($purchase->detail):
						$newDetail = [];
						foreach(json_decode($purchase->detail) as $d):
							$sparepartid = $d->sparepartid;
							$price       = $d->price;
							$qty         = $d->qty;

							$join = array(
								['tb_abc b', 'a.abcid = b.id', 'left'],
							);

							$sparepart = $this->global_model->_get('tb_sparepart a', ['a.id' => $sparepartid], array(), array(), 'a.kode, a.nama, b.code', $join)->row();

							$newDetail[] = (object) array(
								'id'    => $sparepartid,
								'kode'  => $sparepart->kode,
								'nama'  => $sparepart->nama,
								'abc'   => $sparepart->code,
								'price' => $d->price,
								'qty'   => $d->qty,
							);
						endforeach;

						unset($purchase->detail);
						$purchase->detail = $newDetail;
					endif;
					$purchase->order_date = tgl($purchase->order_date);

					$result['data'][] = $purchase;
				endforeach;
			endif;

			echo json_encode($result);
		// endif;
	}
}

?>