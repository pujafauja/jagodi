<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Hrd extends MY_Controller {



	function __construct()

	{

		parent::__construct();

		$this->load->model(['hrd_model' => 'hrd']);

		isloggedin();

	}



	function index()

	{

		$this->unit();

	}

	function detail_thr($id, $is_print = false)
	{
		if($id)
		{
		cekoto('hrd/thr', 'view', true, true);
		$this->data['js'][] = base_url('assets/custom/js/hrd.js');		
		$data['is_print'] = $is_print;
		$data['company'] = $this->global_model->_get('pp_settings')->row_array();
		$data['data'] = $this->global_model->_get('tb_thr', ['id' => decode($id)])->row_array();
		$this->data['menuName'] = 'Detail THR';		
		$this->load->templateAdmin('hrd/detail-thr', $data);
		}
	}

	// function ubahpw()
	// {
	// 	foreach ($this->db->get('tb_employee')->result() as $key => $value) {
	// 		$this->db->update('tb_employee', ['password' =>  password_hash( '123' , PASSWORD_BCRYPT )] ,['id' => $value->id]);
	// 	}
	// }
	function print_thr_row()
	{
		$data['company'] = $this->global_model->_get('pp_settings')->row_array();
		$data['data'] = $this->input->get();
		$this->load->templateAdmin('hrd/print-thr', $data);
	}
	function add_transaction_thr()
	{
		$data = $this->input->post();
		$data['total'] = toFloat(substr($data['total'], 4));
		$data['year'] = substr($data['year'], 6, 4);
		$data['detail'] = json_encode($data['detail']);
		$id = $this->global_model->_insert('tb_thr', $data);
		if ($this->db->affected_rows()) {
			addPayment(['tb_thr' => $id], $data['total'], false, true, 'tb_thr', 'out', 0, 0, getNoFormat('FAKTUR'));
			echo json_encode(['status' => 1, 'id' => $id]);			
			updateNo('FAKTUR');
		}else{
			$this->query_error('Oops something happends please contact developer !');
		}
	}

	function new_transaction_thr_modul()
	{
		cekoto('hrd/new_transaction_thr_modul', 'add', true, true);
        $this->data['css'][] = base_url('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css');
		$this->data['js'][] = base_url('assets/js/pages/form-masks.init.js');
		$this->data['js'][] = base_url('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js');		
		$this->data['js'][] = base_url('assets/custom/js/hrd.js');		
		$this->data['menuName'] = 'New Transaction THR';
		$this->load->templateAdmin('hrd/new-thr');
	}
	function thr_modul_json()
	{
		if($this->input->is_ajax_request())
		{
			$requestData  = $_REQUEST;

			$fetch        = $this->global_model->_retrieve(
				$table        = 'tb_thr',
				$select       = '`id`,	
								`year`,	
								`total`',
				$colOrder     = array('year', 'total'),
				$filter       = array('year', 'total'),
				$where        = '',
				
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
				$nestedData[] = $row->year;
				$nestedData[] = 'Rp. '.rupiah($row->total, 2);
				$nestedData[] = "<a href='".site_url('hrd/detail-thr/'.encode($row->id))."' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Detail</a>";
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

	function thr()
	{
		cekoto('hrd/thr', 'view', true, true);
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

        $this->data['css'][] = base_url('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css');

		$this->data['js'][] = base_url('assets/js/pages/form-masks.init.js');

		$this->data['js'][] = base_url('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js');		

		$this->data['js'][] = base_url('assets/custom/js/hrd.js');		

		$this->data['menuName'] = 'THR';

		$this->load->templateAdmin('hrd/thr');
	}

	function getdatathr()
	{
		$data = $this->hrd->getthr($this->input->post('year'));
		if ($data['status'] == 1) {
			echo json_encode(['status' => 1, 'data' => $data]);
		}else{
			$this->query_error('THR transaction has been done this year');
		}
	}

	function mthr()
	{
		cekoto('hrd/mthr', 'view', true, true);
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

        $this->data['css'][] = base_url('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css');

		$this->data['js'][] = base_url('assets/js/pages/form-masks.init.js');

		$this->data['js'][] = base_url('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js');		

		$this->data['js'][] = base_url('assets/custom/js/hrd.js');

		$this->data['menuName'] = 'THR';

		$this->load->templateAdmin('hrd/mthr');


	}

	function tambah_thr($id = false)

	{
		if($id)
		{
			cekoto('hrd/mthr', 'edit', true, false);
		}
		else
		{
			cekoto('hrd/mthr', 'add', true, false);
		}

		// if ($this->input->is_ajax_request()) {

			if($this->input->post())

			{
				$this->form_validation->set_rules('op', 'Logical Operator', 'required');

				$this->form_validation->set_rules('tahun', 'Years', 'required|numeric');

				$this->form_validation->set_rules('kalkulasi', 'Kalkulasi Gaji', 'required');



				if($this->form_validation->run() == true)

				{

					$insert = array(

						'op'   => $this->input->post('op'),

						'kalkulasi'   => $this->input->post('kalkulasi'),

						'tahun'   => $this->input->post('tahun'),
						

					);



					if($id)

					{

						$this->hrd->global_model->_update('tb_thr_master', $insert, ['id' => decode($id)]);

					}

					else

					{

						$this->global_model->_insert('tb_thr_master',$insert);

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

					$data['thr'] = $this->global_model->_row('tb_thr_master',['id' => decode($id)])->row();

					// echo json_encode($data['thr']);die;

				}

				else

				{

					$data['thr'] = (object) array(

						'id'     => '',

						'op'   => '',

						'kalkulasi'  => '',

						'tahun'  => '',

					);

				}

				$this->load->view('popoti/hrd/add-thr', $data);

			}

		// }

		

	}



	function delete_thr($id)

	{
		if(cekoto('hrd/mthr', 'delete', false, false)):
			if($this->input->is_ajax_request()):
			$this->global_model->_update( 'tb_thr_master' ,['status' => '0'], ['id' => decode($id)]);

				echo json_encode(array(
						'status' => 1,
						'pesan' => "<i class='fa fa-check' style='color:green;'></i> Data has been updated."
					));
			endif;
		else:
			$this->query_error('Sorry you don\'t have access to delete this data');
		endif;
	}

	function actioninsentif()
	{
		$this->form_validation->set_rules('month', 'Month', 'trim|required');
		$this->form_validation->set_rules('grandtotal', 'Grand Total', 'trim|required');

		if ($this->form_validation->run() == false) {
			$this->input_error();
		} else {
			// print_ar($this->input->post());die;
			$detail = [];
			foreach ($this->input->post('employee') as $key => $value) {
				$detail[] = [
					'employee'				=> $this->input->post('employee')[$key],
					'position'				=> $this->input->post('position')[$key],
					'targetJasa'			=> $this->input->post('targetJasa')[$key],
					'targetSparepart'		=> $this->input->post('targetSparepart')[$key],
					'achievedJasaNominal'	=> $this->input->post('achievedJasaNominal')[$key],
					'achievedJasaPersen'	=> $this->input->post('achievedJasaPersen')[$key],
					'achievedSparepartNominal'	=> $this->input->post('achievedSparepartNominal')[$key],
					'achievedSparepartPersen'	=> $this->input->post('achievedSparepartPersen')[$key],
					'insentifJasaNominal'	=> $this->input->post('insentifJasaNominal')[$key],
					'insentifJasaPersen'	=> $this->input->post('insentifJasaPersen')[$key],
					'insentifSparepartNominal'	=> $this->input->post('insentifSparepartNominal')[$key],
					'insentifSparepartPersen'	=> $this->input->post('insentifSparepartPersen')[$key],
				];
			}
			$data = [
				'month' => $this->input->post('month'),
				'jml_insentif' => $this->input->post('grandtotal'),
				'detail' => json_encode($detail)
			];
			$id = $this->global_model->_insert('tb_insentif_transaction', $data);
			addPayment(['tb_insentif_transaction' => $id], $this->input->post('grandtotal'), false, true, 'tb_insentif_transaction', 'out', 0, 0, getNoFormat('FAKTUR'));
			if ($this->db->affected_rows()) {			
				updateNo('FAKTUR');
				echo json_encode(['status' => 1, 'pesan' => 'transaction is successful']);
			}else{
				$this->query_error("Oops, something happends, please contact developer !");
			}
		}
		
	}
	function incentive()

	{

		cekoto('hrd/incentive', 'view', true, true);
		$data['insentif'] = '';

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

        $this->data['css'][] = base_url('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css');

		$this->data['js'][] = base_url('assets/js/pages/form-masks.init.js');

		$this->data['js'][] = base_url('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js');		

		$this->data['js'][] = base_url('assets/custom/js/hrd.js');

		$this->data['menuName'] = 'Incentive';

		$this->load->templateAdmin('hrd/insentifmodul', $data, FALSE);



	}



	function thr_json()

	{

		// if($this->input->is_ajax_request())

		// {

			$requestData	= $_REQUEST;

			$fetch			= $this->hrd->getthrjson($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);

			// print_ar($this->db->last_query());

			$totalData		= $fetch['totalData'];

			$totalFiltered	= $fetch['totalFiltered'];

			$query			= $fetch['query'];
			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 
				$nestedData[] = 'Year Of Service '.$row->op;
				$nestedData[] = $row->year.' year';
				$nestedData[] = $row->kalkulasi.'%';
				if ($row->op == '<') {
					$nestedData[] = '';
				}else{
					$nestedData[]	= "<div class='btn-group'>
										<a href='".site_url('hrd/tambah-thr/'.encode($row->id))."' id='EditThr' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
										<a href='".site_url('hrd/delete-thr/'.encode($row->id))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
									</div>";
				}
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


	function getnewinsentif()

	{

		$month = $this->input->post('month');

		$data = $this->hrd->getnewinsentif($month);

		if ($data['status'] == 1) {

			echo json_encode(['status' => 1, 'pesan' => 'success', 'data' => $data['data']]);

		}else{

			echo json_encode(['status' => 0, 'pesan' => 'Incentive transaction has been done this month']);

		}

	}



	function new_transaction_insentif()

	{
		cekoto('hrd/incentive', 'view', true, true);

	    $this->data['css'][] = base_url('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css');

		$this->data['js'][] = base_url('assets/js/pages/form-masks.init.js');

		$this->data['js'][] = base_url('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js');		

		$this->data['js'][] = base_url('assets/custom/js/hrd.js');

		$data['achiev'] = $this->hrd->getachiev();

		$data['category'] = $this->hrd->getcategory();

		$this->data['menuName'] = 'New Transaction Incentive';

		$this->load->templateAdmin('hrd/new-insentif', $data, FALSE);

	}

	function print_insentif_row()
	{
		$data['data'] = $this->input->get();
		$data['company'] = $this->global_model->_get('pp_settings')->row_array(); 
		// print_ar($data);die;
		$this->load->templateAdmin('hrd/print-insentif-row', $data);
	}

	function detail_insentif($month, $is_print = false)
	{	
		cekoto('hrd/incentive', 'view', true, true);
		$data['month'] = $month;
		$data['is_print'] = $is_print;
		$data['rows'] = $this->global_model->_get('tb_insentif_transaction', ['month' => $month])->row();
		$data['achiev'] = $this->hrd->getachiev();
		$data['company'] = $this->global_model->_get('pp_settings')->row_array(); 

		$data['category'] = $this->hrd->getcategory();
		$this->data['js'][] = base_url('assets/custom/js/hrd.js');

		// print_ar($data);die;

		$this->load->templateAdmin('hrd/detail-insentif', $data);
	}


	function insentif_json($month = null)

	{

		// if($this->input->is_ajax_request())

		// {

			$requestData	= $_REQUEST;

			$fetch			= $this->hrd->getinsentifmodul($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length'], $month);

			// print_ar($this->db->last_query());

			$totalData		= $fetch['totalData'];

			$totalFiltered	= $fetch['totalFiltered'];

			$query			= $fetch['query'];



			$data	= array();

			foreach($query->result() as $row)

			{ 

				$nestedData = array(); 



				$nestedData[] = my($row->month, true);

				$nestedData[] = 'Rp. '.rupiah($row->jml_insentif, 2);

				$nestedData[] = "<a href='".site_url('hrd/detail-insentif/'.$row->month)."' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Detail</a>";



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



	function paysalary()

	{

		$id = $this->input->post('id');

		$subtotal = $this->input->post('subtotal');

		foreach ($id as $key => $value) {

			addPayment(['tb_employee_payroll' => $value], $subtotal[$key], false, true, 'tb_employee_payroll', 'out', 0, 0, getNoFormat('FAKTUR'));
			
			updateNo('FAKTUR');
		}

		if ($this->db->affected_rows()) {

			echo json_encode(['status' => 1, 'pesan' => 'salary is successful']);

		}else{

			$this->query_error("Oops, something happends, please contact developer !");

		}

	}



	function payroll()

	{
		cekoto('hrd/payroll','view', true, true);

		if (isset($_GET['month'])) {

			$month = $this->input->get('month');

			$employe['salary'] = $this->hrd->gethistorysalary($month);

		}else{

			$employe['salary'] = '';

		}

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

        $this->data['css'][] = base_url('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css');

		$this->data['js'][] = base_url('assets/js/pages/form-masks.init.js');

		$this->data['js'][] = base_url('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js');		

		$this->data['js'][] = base_url('assets/custom/js/hrd.js');

		$this->data['menuName'] = 'Payroll';

		$employe['employe'] = $this->global_model->_get('tb_employee', ['delete' => 0, 'status' => '1'])->result();

		$this->load->templateAdmin('hrd/payroll', $employe);

	}

	function payroll_pay()

	{

		$this->form_validation->set_rules('gaji', 'Employee\'s Fee', 'trim|required');

		$this->form_validation->set_rules('coa', 'COA', 'trim|required');



		if ($this->form_validation->run() == true) {

			$gaji = $this->input->post('gaji');

			$bulan = $this->input->post('bulan');

			$tahun = $this->input->post('tahun');

			$employeeid = decode($this->input->post('emloyeeid'));

			$coa = $this->input->post('coa');

			$data = [

				'employeeid' => $employeeid,

				'bulan'	=> $bulan,

				'tahun'	=> $tahun,

				'tanggal'=> date('Y-m-d'),

				'nominal' => toFloat($gaji),

				'coaid'	=> $coa,

			];

			$this->global_model->_insert('tb_employee_payroll', $data);

			if ($this->db->affected_rows()) {

				echo json_encode(['status' => 1, 'pesan' => 'Fee has been pay']);

			}else{

				$this->query_error("Oops, something happends, please contact developer !");

			}

		} else {

			$this->input_error();

		}

	}



	function payroll_json()

	{

		// if($this->input->is_ajax_request())

		// {

			$requestData	= $_REQUEST;

			$fetch			= $this->hrd->getpayroll($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);

			

			$totalData		= $fetch['totalData'];

			$totalFiltered	= $fetch['totalFiltered'];

			$query			= $fetch['query'];



			$data	= array();

			foreach($query as $row)

			{ 

				$nestedData = array(); 



				$nestedData[] = $row['nama'];

				$nestedData[] = $row['ExistingGaji'];

				$nestedData[] = $row['position'];

				$nestedData[] = $row['fee'];

				$nestedData[] = $row['status'];



				$nestedData[] = $row['action'];



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

	function payroll2_json($is_insurance = null, $month = null)

	{

		// if($this->input->is_ajax_request())

		// {

			$requestData	= $_REQUEST;

			$fetch			= $this->hrd->getpayroll2($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length'], $month);

			// print_ar($this->db->last_query());

			$totalData		= $fetch['totalData'];

			$totalFiltered	= $fetch['totalFiltered'];

			$query			= $fetch['query'];



			$data	= array();

			foreach($query->result() as $row)

			{ 

				$nestedData = array(); 



				$nestedData[] = my($row->month, true);

				if ($is_insurance) {

					$nestedData[] = "<a href='".site_url('hrd/detail-payroll/'.$row->month)."/1' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Detail</a>";

				}else{

					$nestedData[] = 'Rp. '.rupiah($row->total, 2);

					$nestedData[] = "<a href='".site_url('hrd/detail-payroll/'.$row->month)."' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Detail</a>";

				}



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

	function print_all($month, $is_bpjs = false)
	{
		$data['is_bpjs'] = $is_bpjs;
		// var_dump($is_bpjs);die;
		$data['salary'] = $this->hrd->gethistorysalary($month);
		$data['company'] = $this->global_model->_get('pp_settings')->row_array(); 
		$data['month'] = $month;

		$this->load->templateAdmin('hrd/print-all', $data);		
	}

	function detail_payroll($month, $is_insurance = false)

	{

		cekoto('hrd/payroll', 'view', true, true);
		$data['salary'] = $this->hrd->gethistorysalary($month);
		$data['month'] = $month;
		$this->data['js'][] = base_url('assets/custom/js/hrd.js');		

		if ($is_insurance) {

			$this->data['menuName'] = 'Detail Insurance';

			$this->load->templateAdmin('hrd/detail-insurance', $data);	

		}else{

			$this->data['menuName'] = 'Detail Payroll';

			$this->load->templateAdmin('hrd/detail-payroll', $data);	

		}

	}



	function bonus()

	{

		cekoto('hrd/bonus', 'view', true, true);



        $this->data['js'][] = base_url('assets/libs/autonumeric/autoNumeric-min.js');

        $this->data['js'][] = base_url('assets/js/pages/form-masks.init.js');

        $this->data['js'][] = base_url('assets/custom/js/hrd.js');

        $data['achiev'] = $this->hrd->getachiev();

        $data['category'] = $this->hrd->getcategory();

		$this->load->templateAdmin('hrd/bonus', $data);

	}

	function category()

	{

		cekoto('hrd/category','view', true, true);
        $this->data['js'][] = base_url('assets/custom/js/hrd.js');

        $data['category'] = $this->hrd->getcategory();

		$this->load->templateAdmin('hrd/category', $data);



	}

	function add_cat($id = false)
	{
		if($id)
		{
			cekoto('hrd/category', 'edit', true, false);
		}
		else
		{
			cekoto('hrd/category', 'add', true, false);
		}

		if($_POST)

		{

			$this->form_validation->set_rules('nama', 'Category Name', 'required');



			if($this->form_validation->run() == true)

			{

				$nama = $this->input->post('nama');



				$insert = array(

					'nama' => $nama,

				);

				$act = '';

				if($id)

				{

					$act = 'updated.';

					$this->global_model->_update('tb_insentif_cat',$insert, ['id' => $id]);

				}

				else

				{

					$act = 'added.';

					$this->global_model->_insert('tb_insentif_cat' ,$insert);

				}



				if($this->db->affected_rows() > 0) {

					echo json_encode(array(

						'status' => 1,

						'pesan' => "Data has been ".$act

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

				$data['id'] = $id;

				$data['category'] = $this->global_model->_row('tb_insentif_cat',['id' => $id])->row();

			}

			else

			{

				$data['category'] = (object) array(

					'id'   => '',

					'nama' => '',

				);

			}

			$this->load->view('popoti/hrd/input-cat', $data);

		}

	}

	function delete_kat($id)

	{
		if(cekoto('hrd/category', 'delete', false, false)):
			if($this->input->is_ajax_request()):

				$this->db->delete('tb_insentif_cat', ['id' => $id]);
				$this->db->delete('tb_insentif_detail', ['cat_id' => $id]);

					echo json_encode(array(
						'status' => 1,
						'pesan' => "<i class='fa fa-check' style='color:green;'></i> Data has been updated."
					));

			endif;
		else:
			$this->query_error('Sorry you don\'t have access to delete this data');
		endif;
	}

	function achievment()

	{

		cekoto('hrd/achievment', 'view', true, true);
        $this->data['js'][] = base_url('assets/custom/js/hrd.js');

        $data['achiev'] = $this->hrd->getachiev();

		$this->load->templateAdmin('hrd/achiev', $data);



	}

	function add_achiev($id = null)

	{

		if($id)
		{
			cekoto('hrd/achievment', 'edit', true, false);
		}
		else
		{
			cekoto('hrd/achievment', 'add', true, false);
		}


		if($_POST)

		{

			$this->form_validation->set_rules('nama', 'Achievment nominal', 'required');



			if($this->form_validation->run() == true)

			{

				$nama = $this->input->post('nama');



				$insert = array(

					'nominal' => $nama,

				);

				$act = '';

				if($id)

				{

					$act = 'updated.';

					$this->db->update('tb_achievment',$insert, ['id' => intval($id)]);

				}

				else

				{

					$act = 'added.';

					$this->global_model->_insert('tb_achievment' ,$insert);

				}



				if($this->db->affected_rows() > 0) {

					echo json_encode(array(

						'status' => 1,

						'pesan' => "Data has been ".$act

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

				$data['id'] = $id;

				$data['achiev'] = $this->global_model->_row('tb_achievment',['id' => $id])->row();

			}

			else

			{

				$data['achiev'] = (object) array(

					'id'   => '',

					'nama' => '',

				);

			}

			// print_ar($data);

			// echo "string";die;

			$this->load->view('popoti/hrd/add-achiev', $data);

		}

	}

	function delete_achiev($id)

		{
		if(cekoto('hrd/achievment', 'delete', false, false)):
			if($this->input->is_ajax_request()):
				$this->db->delete('tb_achievment', ['id' => $id]);

					echo json_encode(array(
						'status' => 1,
						'pesan' => "<i class='fa fa-check' style='color:green;'></i> Data has been updated."
					));
			endif;
		else:
			$this->query_error('Sorry you don\'t have access to delete this data');
		endif;
	}



	function getcategory()

	{

		echo json_encode($this->hrd->getcategory());

	}

	function getachiev()

	{

		echo json_encode($this->hrd->getachiev());

	}

	function getinsentif()

	{

		echo json_encode($this->hrd->getinsentif());

	}

	function getinsentifdetail($id)

	{

		echo json_encode($this->hrd->getinsentifdetail($id));

	}

	function getinsentifachiev($id)

	{

		echo json_encode($this->hrd->getinsentifachiev($id));

		echo $this->db->last_query();

	}





	function fakedata()

	{

		$category = [['id' =>1, 'nama' => 'Mekanik'], ['id' =>2, 'nama' => 'Service Advisor']];

		$achiev = [['id' => 1,'nominal' => 70] ,['id' => 2,'nominal' =>80], ['id' => 3,'nominal' =>100]];

		$insentif = [

				['position_id' => 7, 'status' => 1],

				['position_id' => 8, 'status' => 1],

		];

		$insentif_detail = [

				['insentif_id' => 1, 'cat_id' => 1,'target' => 7000000],

				['insentif_id' => 1, 'cat_id' => 2,'target' => 1000000],

				['insentif_id' => 2, 'cat_id' => 1,'target' => 2100000],

				['insentif_id' => 2, 'cat_id' => 2,'target' => 3000000],

		];

		$insentif_achiev = [

				['insentif_id' => 1, 'insentif_detail_id' => 1, 'achiev_id' => 1, 'nominal' => 7],

				['insentif_id' => 1, 'insentif_detail_id' => 2, 'achiev_id' => 1, 'nominal' => 8],

				['insentif_id' => 1, 'insentif_detail_id' => 1, 'achiev_id' => 2, 'nominal' => 8],

				['insentif_id' => 1, 'insentif_detail_id' => 2, 'achiev_id' => 2, 'nominal' => 10],

				['insentif_id' => 1, 'insentif_detail_id' => 1, 'achiev_id' => 3, 'nominal' => 11],

				['insentif_id' => 1, 'insentif_detail_id' => 2, 'achiev_id' => 3, 'nominal' => 12],

				['insentif_id' => 2, 'insentif_detail_id' => 3, 'achiev_id' => 1, 'nominal' => 7],

				['insentif_id' => 2, 'insentif_detail_id' => 4, 'achiev_id' => 1, 'nominal' => 8],

				['insentif_id' => 2, 'insentif_detail_id' => 3, 'achiev_id' => 2, 'nominal' => 8],

				['insentif_id' => 2, 'insentif_detail_id' => 4, 'achiev_id' => 2, 'nominal' => 10],

				['insentif_id' => 2, 'insentif_detail_id' => 3, 'achiev_id' => 3, 'nominal' => 11],

				['insentif_id' => 2, 'insentif_detail_id' => 4, 'achiev_id' => 3, 'nominal' => 12],

		];

		// if($this->loopdata('tb_insentif_cat' ,$category))

		// 	echo 'success tb_insentif_cat';

		// if($this->loopdata('tb_achievment',$achiev))

		// 	echo 'success tb_achievment';

		if($this->loopdata('tb_insentif' ,$insentif))

			echo 'success tb_insentif';

		if($this->loopdata('tb_insentif_detail' ,$insentif_detail))

			echo 'success tb_insentif_detail';

		if($this->loopdata('tb_insentif_achiev_detail', $insentif_achiev))

			echo 'success tb_insentif_achiev_detail';



	}

	function loopdata($table, $data)

	{

		for ($i=0; $i < count($data); $i++) { 

			$this->db->insert($table, $data[$i]);

		}

	}



	function delete_item($id)

	{
		if(cekoto('hrd/bonus', 'delete', false, false)):
			if($this->input->is_ajax_request()):

					echo json_encode(array(
						'status' => 1,
						'pesan' => "<i class='fa fa-check' style='color:green;'></i> Data has been updated."
					));
				$this->global_model->_delete('tb_insentif',['id' => $id]);
				echo $this->db->last_query();
			endif;
		else:
			$this->query_error('Sorry you don\'t have access to delete this data');
		endif;
	}



	function add_item($id = null)

	{     
		if($id)
		{
			cekoto('hrd/bonus','edit', true, false);
		}
		else
		{
			cekoto('hrd/bonus','add', true, false);
		}

		if ($this->input->is_ajax_request()) {

		  	if ($this->input->post()) {



				$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');



				$category = $this->input->post('category');

				$achiev = $this->input->post('achiev');



				foreach ($category as $keycat => $cat) {

					$this->form_validation->set_rules('category['.$keycat.']', 'kategori '.strtolower($cat), 'trim|required');			

					$this->form_validation->set_rules('nominal['.$keycat.']', 'nominal '.strtolower($cat), 'trim|required');			

					foreach ($achiev[$keycat] as $keyac => $ac) {

						$achiev = $this->global_model->_row('tb_achievment' , ['id' => $keyac])->row_array()['nominal'];

						$this->form_validation->set_rules('achiev['.$keycat.']['.$keyac.']',  'insentif '.strtolower($cat).' '.$achiev.'%', 'trim|required');			

					}

				}	



				if ($this->form_validation->run() == true) {

					$pesan = '';

					if ($id) {

						$pesan = 'updatted';

						$this->hrd->updateitem($this->input->post(), $id);

					}else{

						$pesan = 'added';

						$this->hrd->inputitem($this->input->post());

					}

						if($this->db->affected_rows() > 0) {

							echo json_encode(array(

								'status' => 1,

								'pesan' => "Data has been ".$pesan

							));

						}else{

							// $this->query_error($this->db->last_query());die;



							$this->query_error("Oops, something happends, please contact developer !");

						}

				} else {

					$this->input_error();			

				}

			}else{

				$data['category'] = $this->hrd->getcategory();

				$data['achiev'] = $this->hrd->getachiev();

				$data['position'] = $this->global_model->_get('pp_otority')->result_array();

				if ($id) {

					$data['id'] = $id;

					$data['position_id'] = $this->hrd->getinsentif($id);

					$this->load->view('popoti/hrd/edit-item', $data, FALSE);

				}else{

					$this->load->view('popoti/hrd/add-item', $data, FALSE);

				}



			}

		}   

		

	}



	function insurance()

	{
		cekoto('hrd/insurance', 'view', true, true);

		$this->load->helper('directory');

		

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



        $this->data['js'][] = base_url('assets/libs/autonumeric/autoNumeric-min.js');

        $this->data['js'][] = base_url('assets/js/pages/form-masks.init.js');

        $this->data['js'][] = base_url('assets/custom/js/hrd.js');

        $this->data['menuName'] = 'BPJS Kesehatan & Ketenaga Kerjaan';

		$this->load->templateAdmin('hrd/insurance');

	

	}





	function bpjs_json()

	{

		// if($this->input->is_ajax_request())

		// {

			$requestData	= $_REQUEST;

			$fetch			= $this->hrd->getbpjs($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);

			

			$totalData		= $fetch['totalData'];

			$totalFiltered	= $fetch['totalFiltered'];

			$query			= $fetch['query'];



			$data	= array();

			foreach($query->result() as $row)

			{ 

				$nestedData = array(); 



				$nestedData[] = $row->op;


				$nestedData[] = ($row->kes_karyawan * 100).'%';
				$nestedData[] = ($row->kes_perusahaan * 100).'%';
				$nestedData[] = ($row->naker_karyawan * 100).'%';
				$nestedData[] = ($row->naker_perusahaan * 100).'%';



				$nestedData[]	= "<div class='btn-group'>

										<a href='".site_url('hrd/tambah-bpjs/'.encode($row->id))."' id='EditBpjs' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>

										<a href='".site_url('hrd/delete-bpjs/'.encode($row->id))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>

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



	function tambah_bpjs($id = false)

	{
	if($id):
			cekoto('hrd/insurance', 'edit', true, false);
		else:
			cekoto('hrd/insurance', 'add', true, false);
		endif;


		// if ($this->input->is_ajax_request()) {

			if($this->input->post())

			{

				// echo json_encode($this->input->post());die;

				$this->form_validation->set_rules('op', 'Logical Operator', 'required');

				$this->form_validation->set_rules('naker_karyawan', 'BPJS Ketenaga Kerjaan Karyawan', 'required');

				$this->form_validation->set_rules('naker_perusahaan', 'BPJS Ketenaga Kerjaan Perusahaan', 'required');
				$this->form_validation->set_rules('kes_karyawan', 'BPJS Kesehatan Karyawan', 'required');

				$this->form_validation->set_rules('kes_perusahaan', 'BPJS Kesehatan Perusahaan', 'required');



				if($this->form_validation->run() == true)

				{

					$insert = array(

						'op'   => $this->input->post('op'),


						'kes_karyawan'   => ($this->input->post('kes_karyawan') / 100),
						
						'kes_perusahaan'   => ($this->input->post('kes_perusahaan') / 100),
						'naker_karyawan'   => ($this->input->post('naker_karyawan') / 100),
						
						'naker_perusahaan'   => ($this->input->post('naker_perusahaan') / 100),

					);



					if($id)

					{

						$this->hrd->global_model->_update('tb_bpjs_master', $insert, ['id' => decode($id)]);

					}

					else

					{

						$this->global_model->_insert('tb_bpjs_master',$insert);

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

					$data['bpjs'] = $this->global_model->_row('tb_bpjs_master',['id' => decode($id)])->row();

					// echo json_encode($data['bpjs']);die;

				}

				else

				{

					$data['bpjs'] = (object) array(

						'id'     => '',

						'op'   => '',

						'naker_perusahaan'  => '',
						'naker_karyawan'  => '',
						'kes_perusahaan'  => '',
						'kes_karyawan'  => '',

					);

				}

				$this->load->view('popoti/hrd/add-bpjs', $data);

			}

		// }

		

	}



	function delete_bpjs($id)

	{
		if(cekoto('hrd/insurance', 'delete', false, false)):
			if($this->input->is_ajax_request()):

				$this->global_model->_update( 'tb_bpjs_master' ,['status' => '0'], ['id' => decode($id)]);
					echo json_encode(array(
						'status' => 1,
						'pesan' => "<i class='fa fa-check' style='color:green;'></i> Data has been updated."
					));
			endif;
		else:
			$this->query_error('Sorry you don\'t have access to delete this data');
		endif;
	}



	function fake_bpjs()

	{

		for ($i=1; $i <= 4; $i++) { 

			$this->db->insert('tb_bpjs_master', [

				'user_id' => $i,

				'kes'	=> $i * 0.3,

				'naker'	=> $i * 1.3

			]);

		}

	}

	function pay($id)

	{

		$date = $this->input->get('date');

		$date = explode(' ', $date);

		$data['id'] = $id;

		$data['bulan'] = decodemonth($date[0]);

		$data['tahun'] = $date[1];

			$data['row'] = $this->global_model->_get('tb_employee', ['id' => decode($id)])->row();

		$this->load->view('popoti/hrd/pay', $data);

	}

	function new_transaction_payroll()

	{

		cekoto('hrd/payroll', 'view', true, true);


        $this->data['css'][] = base_url('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css');

		$this->data['js'][] = base_url('assets/js/pages/form-masks.init.js');

		$this->data['js'][] = base_url('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js');

        $this->data['js'][] = base_url('assets/custom/js/hrd.js');



		$this->data['menuName'] = 'New Transaction Payroll';

		$data['user'] = $this->hrd->getdatatransaction();

		$this->load->templateAdmin('hrd/new-transaction', $data);

	}

	function inputdataumk()

	{

		$data = [

			['provinsi' => 'jawa barat', 'daerah' => 'Kabupaten Karawang','umk' =>  4798312  ],

			['provinsi' => 'jawa barat', 'daerah' => 'Kota Bekasi','umk' =>  4782935.64  ],

			['provinsi' => 'jawa barat', 'daerah' => 'Kabupaten Bekasi','umk' =>  4791843.90  ],

			['provinsi' => 'jawa barat', 'daerah' => 'Kota Depok','umk' =>  4339514.73  ],

			['provinsi' => 'jawa barat', 'daerah' => 'Kota Bogor','umk' =>  4169806  ],

			['provinsi' => 'jawa barat', 'daerah' => 'Kabupaten Bogor','umk' =>  4217206  ],

			['provinsi' => 'jawa barat', 'daerah' => 'Kabupaten Purwakarta','umk' =>  4173568.61  ],

			['provinsi' => 'jawa barat', 'daerah' => 'Kabupaten Kota Bandung','umk' =>  3742276.48  ],

			['provinsi' => 'jawa barat', 'daerah' => 'Bandung Barat','umk' =>  3248283.28  ],

			['provinsi' => 'jawa barat', 'daerah' => 'Kabupaten Sumedang','umk' =>  3241929.67  ],

			['provinsi' => 'jawa barat', 'daerah' => 'Kabupaten Bandung','umk' =>  3241929.67  ],

			['provinsi' => 'jawa barat', 'daerah' => 'Kota Cimahi','umk' =>  3241929.00  ],

			['provinsi' => 'jawa barat', 'daerah' => 'Kabupaten Sukabumi','umk' =>  3125444.72  ],

			['provinsi' => 'jawa barat', 'daerah' => 'Kabupaten Subang','umk' =>  3064218  ],

			['provinsi' => 'jawa barat', 'daerah' => 'Kabupaten Cianjur','umk' =>  2534798  ],

			['provinsi' => 'jawa barat', 'daerah' => 'Kota Sukabumi','umk' =>  2530182.63  ],

			['provinsi' => 'jawa barat', 'daerah' => 'Kabupaten Indramayu','umk' =>  2373073.46  ],

			['provinsi' => 'jawa barat', 'daerah' => 'Kota Tasikmalaya','umk' =>  2264093.28  ],

			['provinsi' => 'jawa barat', 'daerah' => 'Kabupaten Tasikmalaya','umk' =>  2251787.92  ],

			['provinsi' => 'jawa barat', 'daerah' => 'Kota Cirebon','umk' =>  2271201.73  ],

			['provinsi' => 'jawa barat', 'daerah' => 'Kabupaten Cirebon','umk' =>  2269556.75  ],

			['provinsi' => 'jawa barat', 'daerah' => 'Kabupaten Garut','umk' =>  1961085.70  ],

			['provinsi' => 'jawa barat', 'daerah' => 'Kabupaten Majalengka','umk' =>  2009000.00  ],

			['provinsi' => 'jawa barat', 'daerah' => 'Kabupaten Kuningan','umk' =>  1882642.36  ],

			['provinsi' => 'jawa barat', 'daerah' => 'Kabupaten Ciamis','umk' =>  1880654.54  ],

			['provinsi' => 'jawa barat', 'daerah' => 'Kabupaten Pangandaran','umk' =>  1860591.33  ],

			['provinsi' => 'jawa barat', 'daerah' => 'Kota Banjar','umk' =>  1831884.83 ],

		];

		foreach ($data as $key => $value) {

			$this->db->insert('tb_umk', $value);

		}



	}

	function row_employee($id)

	{

		if ($this->input->is_ajax_request()) {

			echo json_encode($this->global_model->_get('tb_employee', ['id' => decode($id)])->row() );

		}

	}

	function get_umk()

	{

		if ($this->input->is_ajax_request()) {

			echo json_encode($this->db->get_where('tb_umk', ['dipilih' => '1'])->row()->umk);

		}

	}

	function row_bpjs($id)

	{

		if ($this->input->is_ajax_request()) {

			echo json_encode($this->global_model->_get('tb_bpjs_master', ['user_id' => $id])->row() );

		}

	}

	function print_gaji($id)
 
	{
		$data['company'] = $this->global_model->_get('pp_settings')->row_array();
		
		$data['data'] = $this->hrd->getprintgaji($id);
		$this->load->templateAdmin('hrd/print-gaji', $data, FALSE);


	}

	function calculate($id)

	{

		$this->form_validation->set_rules('hadir', 'Attendance', 'trim|required');

		if ($this->form_validation->run() == true) {

		

			$umk = $this->db->get_where('tb_umk', ['dipilih' => '1'])->row()->umk;



			$user = $this->db->get_where('tb_employee', ['id' => decode($id)])->row();

			$pokok = $user->pokok; 

			$makan = $user->makan; 

			$transport = $user->transport; 

			$tunjangan = $user->tunjangan; 

			$another = $user->another; 



			$hadirUser = $this->input->post('hadir'); 



			$gajiBruto = ($hadirUser * $pokok) + ($hadirUser * $makan) + ($hadirUser * $transport) + $tunjangan + $another;


			if ($gajiBruto >= $umk) {
				$bpjs = $this->db->get_where('tb_bpjs_master', ['op' => '>='])->row();	
			}else{
				$bpjs = $this->db->get_where('tb_bpjs_master', ['op' => '<'])->row();	
			}

			$bpjsKes = ($user && $user->bpjs == '1') ? $bpjs->kes_karyawan : 0;

			$bpjsNakerPerusahaan = ($user && $user->bpjs == '1') ? $bpjs->naker_perusahaan : 0;

			$bpjsNakerKaryawan = ($user && $user->bpjs == '1') ? $bpjs->naker_karyawan : 0;



			$kesTotal = ($gajiBruto < $umk) ? $umk * 0.05 : $gajiBruto * 0.05;

			$kesKaryawan = $kesTotal * $bpjsKes; 

			$kesPerusahaan = $kesTotal - $kesKaryawan;

			$kesPersen = ($kesTotal / $gajiBruto) * 100;



			$nakerKaryawan = ($gajiBruto < $umk) ? $umk * $bpjsNakerKaryawan : $gajiBruto * $bpjsNakerKaryawan; 

			$nakerPerusahaan = ($gajiBruto < $umk) ? $umk * $bpjsNakerPerusahaan : $gajiBruto * $bpjsNakerPerusahaan;

			$nakerTotal = $nakerKaryawan + $nakerPerusahaan;                



			$nakerPersen = ($nakerTotal / $gajiBruto) * 100;



			$subtotal = ($gajiBruto - $kesTotal - $nakerTotal) - toFloat($this->input->post('potongan'));



			echo json_encode([

					'status' => 1, 

					'gajiBruto' => 'Rp. '.rupiah($gajiBruto) , 

					'subtotal' => 'Rp. '.rupiah(abs(bulatKeRatusan($subtotal)))

				]); 



		} else {

			$this->input_error();

		}

	}

	function insert_fee()

	{

		$employeeid = $this->input->post('employeeid');

		$hadir = $this->input->post('hadir');

		$amount = $this->input->post('amount');

		$month = $this->input->post('month');



		$this->form_validation->set_rules('month', 'Month', 'trim|required');

		foreach ($employeeid as $key => $value) {

			$this->form_validation->set_rules('hadir['.$value.']', 'Attendance', 'trim|required|numeric');

			// $this->form_validation->set_rules('amount['.$value.']', 'Amount', 'trim|required');

		}



		if ($this->form_validation->run() == TRUE) {

			$this->hrd->insertfee($employeeid, $hadir, $amount, $month);

			if ($this->db->affected_rows()) {

				echo json_encode(['status' => 1, 'message' => 'Give fee is success', 'month' => $month]);

			}else{

				$this->query_error("Oops, something happends, please contact developer !");

			}

		} else {

			$this->input_error();

		}



	}

	function ifexistmonth($month)

	{

		$exist = $this->global_model->_get('tb_employee_payroll', ['month' => $month]);

		if ($exist->num_rows() > 0) {

			echo json_encode(['status' => 0, 'pesan' => 'Salary transaction has been done this month']);

		}else{

			echo json_encode(['status' => 1, 'pesan' => '']);

		}

	}



	function insurancemodul()

	{
		cekoto('hrd/insurancemodul', 'view', true, true);

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

        $this->data['css'][] = base_url('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css');

		$this->data['js'][] = base_url('assets/js/pages/form-masks.init.js');

		$this->data['js'][] = base_url('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js');		

		$this->data['js'][] = base_url('assets/custom/js/hrd.js');		

		$this->data['menuName'] = 'Insurance';

		$this->load->templateAdmin('hrd/insurancemodul');	

	}



}



/* End of file HRDphp */

/* Location: ./application/controllers/HRD.php */



 

























































