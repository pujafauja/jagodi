<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class : Finance
 * By : Puzha Fauzha
 */
class Finance extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('finance_model');
		$this->load->model('Ap_model');
		$this->load->model('Ar_model');
		isloggedin();
	}

	function index()
	{
		cekoto('finance', 'view', true, true);
		$this->coa();
	}

	function coa_group()
	{
		cekoto('finance/coa-group', 'view', true, true);
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

        $this->data['js'][] = base_url('assets/custom/js/finance.js');

		$this->load->templateAdmin('finance/group-coa');
	}

	function coa_aliases()
	{
		cekoto('finance/coa-aliases', 'view', true, true);
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

        $this->data['js'][] = base_url('assets/custom/js/finance.js');

		$this->load->templateAdmin('finance/coa-alias');
	}

	function group_json()
	{
		if($this->input->is_ajax_request())
		{
			$requestData	= $_REQUEST;
			$fetch			= $this->finance_model->getgroup($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
			
			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 

				$nestedData[] = $row->kode;
				$nestedData[] = $row->nama;
				$nestedData[] = ($row->normal == 'dr') ? 'Debit' : 'Kredit';

				$nestedData[]	= "<div class='btn-group'>
										<a href='".site_url('finance/tambah-group/'.encode($row->id))."' id='EditGroup' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
										<a href='".site_url('finance/delete-group/'.encode($row->id))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
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

	function aliases_json()
	{
		if($this->input->is_ajax_request())
		{
			$requestData = $_REQUEST;
			$fetch       = $this->global_model->_retrieve(
				$table = 'tb_coa_alias a LEFT JOIN tb_coa b ON a.coaid = b.id',
				$select = 'a.id, a.nama, a.kategori, CONCAT(\'[\', b.kode, \'] \', b.nama) coa',
				$colOrder     = array('b.kode', 'a.nama', 'a.kategori'),
				$filter       = array('b.kode', 'a.nama'),
				$where        = ' AND a.status = \'1\'',
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

				switch ($row->kategori) {
					case '4':
						$kategori = 'Income';
						$class    = 'badge-outline-success';
						break;
					case '5':
						$kategori = 'Outcome';
						$class    = 'badge-outline-warning';
						break;
					
					default:
						$kategori = 'Others';
						$class    = 'badge-outline-info';
						break;
				}

				$nestedData[] = $row->coa;
				$nestedData[] = $row->nama;
				$nestedData[] = '<span class="badge '.$class.'">'.$kategori.'</span>';

				$nestedData[]	= "<div class='btn-group btn-sm'>
										<a href='".site_url('finance/new-alias/'.encode($row->id))."' id='AddAlias' class='btn btn-sm btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
										<a href='".site_url('finance/delete-alias/'.encode($row->id))."' class='btn btn-sm btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
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

	function tambah_group($id = false)
	{
		if($id)
		{
			cekoto('finance/coa-group', 'edit', true, false);
		}
		else
		{
			cekoto('finance/coa-group', 'edit', true, false);
		}
		if($_POST)
		{
			$this->form_validation->set_rules('nama', 'Group Name', 'required');
			$this->form_validation->set_rules('normal', 'Saldo Normal', 'required');
			$this->form_validation->set_rules('kode', 'Code', 'required|max_length[10]');

			if($this->form_validation->run() == true)
			{
				$nama   = $this->input->post('nama');
				$kode   = $this->input->post('kode');
				$normal = $this->input->post('normal');

				$newid = newid('tb_coa_group');

				$insert = array(
					'nama'   => $nama,
					'kode'   => $kode,
					'normal' => $normal,
				);

				if($id)
				{
					$this->finance_model->updategroup($insert, decode($id));
				}
				else
				{
					$insert['id'] = $newid;

					$this->finance_model->addgroup($insert);
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
				$data['group'] = $this->finance_model->rowgroup(['id' => decode($id)])->row();
			}
			else
			{
				$data['group'] = (object) array(
					'id'    => '',
					'nama'  => '',
					'harga' => 0,
				);
			}
			$this->load->view('popoti/finance/add-group', $data);
		}
	}

	function new_alias($id = false)
	{
		if($id)
		{
			cekoto('finance/coa-aliases', 'edit', true, false);
		}
		else{
			cekoto('finance/coa-aliases', 'add', true, false);
		}
		if($_POST)
		{
			$this->form_validation->set_rules('coaid', 'COA', 'required');
			$this->form_validation->set_rules('nama', 'Alias Name', 'required|max_length[50]');
			$this->form_validation->set_rules('kategori', 'Category', 'required');

			if($this->form_validation->run() == true)
			{
				$nama     = $this->input->post('nama');
				$coaid    = $this->input->post('coaid');
				$kategori = $this->input->post('kategori');

				$insert = array(
					'nama'     => $nama,
					'coaid'    => $coaid,
					'kategori' => $kategori,
				);

				if($id)
				{
					$this->global_model->_update('tb_coa_alias', $insert, ['id' => decode($id)]);
				}
				else
				{
					$this->global_model->_insert('tb_coa_alias', $insert);
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
			$data['coa'] = $this->global_model->_get('tb_coa', ['status' => '1']);
			if($id)
			{
				$data['alias'] = $this->global_model->_row('tb_coa_alias', ['id' => decode($id)])->row();
			}
			else
			{
				$data['alias'] = (object) array(
					'id'       => '',
					'coaid'    => 0,
					'kategori' => '0',
					'nama'     => '',
				);
			}
			$this->load->view('popoti/finance/new-alias', $data);
		}
	}

	function delete_group($id)
	{
		if(cekoto('finance/coa-group', 'delete', false, false)):
			if($this->input->is_ajax_request()):
				$this->finance_model->updategroup(['status' => '0'], decode($id));

					echo json_encode(array(
						'status' => 1,
						'pesan' => "<i class='fa fa-check' style='color:green;'></i> Data has been updated."
					));
			endif;
		else:
			$this->query_error('Sorry you don\'t have access to delete this data');
		endif;
	}

	function delete_alias($id)
	{
		if(cekoto('finance/coa-aliases', 'delete', false, false)):
			// if($this->input->is_ajax_request()):
			$this->global_model->_update('tb_coa_alias' ,['status' => '0'], ['id' => decode($id)]);

				echo json_encode(array(
						'status' => 1,
						'pesan' => "<i class='fa fa-check' style='color:green;'></i> Data has been updated."
					));
			// endif;
		else:
			$this->query_error('Sorry you don\'t have access to delete this data');
		endif;
	}

	function coa()
	{
		cekoto('finance/coa', 'view', true, true);
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

        $this->data['js'][] = base_url('assets/custom/js/finance.js');

		$this->load->templateAdmin('finance/coa');
	}

	function coa_json()
	{

		// if($this->input->is_ajax_request())

		// {

			$requestData = $_REQUEST;
			$group       = $this->finance_model->getgroup($requestData['search']['value'], $requestData['order'][0]['column']);

			$data      = array();
			$subandcoa = array();

			foreach($group['query']->result_array() as $gr)
			{
				$parents     = array();
				$nestedGroup = array();
				$nestedCOA   = array();
				$nestedGROUP = array();
				$nestedcoa   = array();

				$nestedGroup[] = '<strong>'.$gr['kode'].'</strong>';
				$nestedGroup[] = '<strong>'.$gr['nama'].'</strong>';
				$nestedGroup[] = '';
				$nestedGroup[] = '';
				$nestedGroup[] = '';
				$nestedGroup[] = '';

				$nestedGROUP = $nestedGroup;

				$fetch = $this->finance_model->getcoa($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length'], $gr['id']);
				// echo $this->db->last_query() . "<br>";

				$totalData		= $fetch['totalData'];
				$totalFiltered	= $fetch['totalFiltered'];
				$query			= $fetch['query'];

				$result = ordered_menu($query->result_array());

				$subandcoa = explode('~', nestedCOA($result));
				foreach($subandcoa as $coas)
				{
					$coa = explode('|', $coas);
					$coa[3] = $coa[3];
					$coa[4] = $coa[4];
					$coa[5] = (!$coa[5]) ? '' : "<div class='btn-group'>
										<a href='".site_url('finance/tambah-coa/'.encode($coa[5]))."' id='EditCOA' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
										<a href='".site_url('finance/delete-coa/'.encode($coa[5]))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
									</div>";
					$nestedCOA[] = $coa;
				}
				// print_ar($nestedGROUP);
				// print_ar($subandcoa);
				$parents[] = $nestedGROUP;

				foreach(array_merge($parents, $nestedCOA) as $dt)
				{
					$data[] = $dt;
				}

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



	function tambah_coa($id = false, $issub = false)

	{
		if($id)
		{
			cekoto('finance/coa-aliases', 'edit', true, false);
		}
		else
		{
			cekoto('finance/coa-aliases', 'add', true, false);
		}

		if($_POST)

		{
			$this->form_validation->set_rules('nama', 'Account Name', 'required');
			$this->form_validation->set_rules('kode', 'Code', 'required|max_length[10]');
			$this->form_validation->set_rules('groupid', 'Group Name', 'required|max_length[10]');
			if($this->form_validation->run() == true)
			{
				$nama    = $this->input->post('nama');
				$kode    = $this->input->post('kode');
				$groupid = $this->input->post('groupid');
				$dr_awal = $this->input->post('dr_awal');
				$cr_awal  = $this->input->post('cr_awal');
				$parentid = $this->input->post('parentid');
				$newid = newid('tb_coa');
				$insert = array(
					'nama'    => $nama,
					'kode'    => $kode,
					'groupid' => $groupid,
					'dr_awal' => $dr_awal,
					'cr_awal'  => $cr_awal,
					'parentid' => $parentid,
				);
				if($issub)
					$insert['issub'] = '1';
				if($id && decode($id) != 0)
				{
					$this->finance_model->updatecoa($insert, decode($id));
				}
				else
				{
					$insert['id'] = $newid;
					$this->finance_model->addcoa($insert);
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
			$data['group'] = $this->finance_model->getgroup()['query'];
			$data['sub']   = $this->global_model->_get('tb_coa', ['issub' => '1', 'status' => '1']);

			if($id)

			{

				$data['coa'] = $this->finance_model->rowcoa(['id' => decode($id)])->row();

			}

			else

			{

				$data['coa'] = (object) array(

					'id'       => '',
					'groupid'  => '',
					'parentid' => '',
					'kode'     => '',
					'nama'     => '',
					'dr_awal'  => '0',
					'cr_awal'  => '0',

				);

			}
			$data['issub'] = $issub;

			$this->load->view('popoti/finance/add-coa', $data);

		}

	}



	function tambah_subgroup($id = false)

	{
		
		cekoto('finance/tambah_subgroup','add', true, false);
		$this->tambah_coa($id, true);


	}



	function delete_coa($id)
		{
		if(cekoto('finance/delete_coa', 'delete', false, false)):
			if($this->input->is_ajax_request()):
			$this->finance_model->updatecoa(['status' => '0'], decode($id));
			endif;
		else:
			$this->query_error('Sorry you don\'t have access to delete this data');
		endif;
	}
	function limitation($type = FALSE)
	{
		cekoto('finance/limitation/'.$type, 'view', true, true);

		if(! $type)
		{
			$this->session->set_flashdata('global', get_alert('danger', 'Sorry, forbidden access'));
			redirect('dashboard');
			exit();
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

        $this->data['js'][] = base_url('assets/custom/js/finance.js');

		$this->load->templateAdmin('finance/limitation');
	}

	function limit_json($type = FALSE)
	{
		if($this->input->is_ajax_request())
		{
			$requestData	= $_REQUEST;
			$fetch			= $this->finance_model->getkehadiran($type, $requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);

			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 

				$nestedData[] = '['.$row->kode.'] ' . $row->nama;
				$nestedData[] = strtoupper($row->periode);
				$nestedData[] = $row->type;
				$nestedData[] = rupiah($row->limit, 2);

				$nestedData[]	= "<div class='btn-group'>
										<a href='".site_url('finance/tambah-limit/'.$row->mod.'/'.encode($row->id))."' id='TambahLimit' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
										<a href='".site_url('finance/delete-limit/'.encode($row->id))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
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

	function tambah_limit($mod, $id = FALSE)
	{
		if($id):
			cekoto('finance/limitation/'.$mod, 'edit', true, false);
		else:
			cekoto('finance/limitation/'.$mod, 'add', true, false);
		endif;

		if($_POST)
		{
			$this->form_validation->set_rules('coaid', 'Account', 'required');
			$this->form_validation->set_rules('periode', 'Periode', 'required');
			$this->form_validation->set_rules('type', 'Type', 'required');
			$this->form_validation->set_rules('limit', 'Nominal Limit', 'required');

			if($this->form_validation->run() == true)
			{
				$mod     = $mod;
				$coaid   = $this->input->post('coaid');
				$periode = $this->input->post('periode');
				$type    = $this->input->post('type');
				$limit   = $this->input->post('limit');

				$newid = newid('tb_limit');

				$insert = array(
					'mod'     => $mod,
					'coaid'   => $coaid,
					'periode' => $periode,
					'type'    => $type,
					'limit'   => $limit,
				);

				if($id && decode($id) != 0)
				{
					$this->global_model->_update('tb_limit', $insert, ['id' => decode($id)]);
				}
				else
				{
					$insert['id'] = $newid;

					$this->global_model->_insert('tb_limit', $insert);
				}

				if($this->db->affected_rows() > 0) {
					echo json_encode(array(
						'status' => 1,
						'pesan' => "<i class='fa fa-check' style='color:green;'></i> Data has been updated."
					));
				}
				else
				{
					echo $this->db->last_query();
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
			$data['coa']   = $this->global_model->_get('tb_coa', ['issub' => '0', 'status' => '1']);
			if($id)
			{
				$data['limit'] = $this->global_model->_row('tb_limit', ['id' => decode($id), 'status' => '1'])->row();
			}
			else
			{
				$data['limit'] = (object) array(
					'id'      => '0',
					'mod'     => $mod,
					'coaid'   => '',
					'periode' => '',
					'type'    => '',
					'limit'   => '',
				);
			}
			$this->load->view('popoti/finance/add-limit', $data);
		}
	}
	function payment()
	{
		cekoto('finance/payment', 'view', true, true);

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

        $this->data['js'][] = base_url('assets/custom/js/finance.js');
        $this->data['menuName'] = 'Payment';
		$this->load->templateAdmin('finance/payment');		
	}

	function payment_json($type)
	{
		// if($this->input->is_ajax_request())
		// {
			$status   = $this->input->post('status');
			$tanggal1 = $this->input->post('tanggal1');
			$tanggal2 = $this->input->post('tanggal2');

			switch ($type) {
				case 'receive':
					$type = 'in';
					break;
				
				default:
					$type = 'out';
					break;
			}
			// print_ar($this->input->post());
			$requestData	= $_REQUEST;
			$fetch			= $this->finance_model->getpayment($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length'], $status, $tanggal1, $tanggal2, $type);
			$last_query = $this->db->last_query();

			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];


			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array();

				$source = json_decode($row->sumber, true);
				$sumber = (is_array($source) && count($source)) ? ucfirst(str_replace(['tb_', '_'], ['', ' '], key($source))) : '';

				$customer = $row->customer;
				$supplier = $row->supplier;

				$nestedData[] = tgl($row->tanggal);
				$nestedData[] = $row->no;
				$nestedData[] = 'Rp '.rupiah($row->tagihan, 2);
				$nestedData[] = 'Rp '.rupiah($row->pembayaran, 2);

				if($type == 'out')
					$nestedData[] = $supplier;
				if($type == 'in')
					$nestedData[] = $customer;

				$nestedData[] = $sumber;

				if ($row->status == '0') {
					$nestedData[] = '<span class="badge badge-outline-primary"><i class="far fa-list-alt mr-1"></i> Draft</span>';
					$nestedData[] = '<a href="'.base_url('finance/bayar-payment/'.encode($row->id)).'" class="btn btn-sm btn-success" id="bayar"><span class="fas fa-money-bill mr-1"></span>Pay</a>';
				}elseif($row->status == '1'){
					$nestedData[] = '<span class="badge badge-outline-success"><i class="fas fa-check mr-1"></i> Paid</span>';
					// $nestedData[] = '<a href="'.base_url('finance/edit-payment/'.encode($row->id)).'" class="btn btn-sm btn-warning"><span class="fa fa-edit mr-1"></span>Edit</a>';
					$nestedData[] = '<a href="'.base_url('finance/print-invoice/'.encode($row->id)).'?cetak=1" class="btn btn-sm btn-primary print"><span class="fa fa-print mr-1"></span>Print</a>';
				}else{
					$nestedData[] = '';
					$nestedData[] = '';
				}
				$data[] = $nestedData;
			}

			$json_data = array(
				"draw"            => intval( $requestData['draw'] ),  
				"recordsTotal"    => intval( $totalData ),  
				"recordsFiltered" => intval( $totalFiltered ), 
				"query"           => $last_query,
				"data"            => $data
			);
			echo json_encode($json_data);
		// }
	}
	function bayar_payment($id)
	{
		cekoto('finance/payment','edit', true, false);

		// if ($this->input->is_ajax_request()) {
			if(isset($_POST['grandtotal'])):
				$id   = decode($id);
				$bill = toFloat($this->input->post('grandtotal'));

				// if($bill <= 0):
				// 	$this->query_error('Bill is required');
				// 	return false;
				// endif;
				if( ! $id):
					$this->query_error('Please select one bill');
					return false;
				endif;
				// $this->form_validation->set_rules('coaid', 'journal account', 'required');
				foreach($this->input->post('aliasid') as $index => $alias):
					$no = $index + 1;
					$this->form_validation->set_rules('aliasid['.$index.']', 'COA #'.$no, 'required');
					$this->form_validation->set_rules('amount['.$index.']', 'Amount #'.$no, 'required');
				endforeach;

				if($this->form_validation->run() == true):
					$pembayaran = 0;
					$detail = [];
					foreach($this->input->post('aliasid') as $index => $alias):
						$coaid       = $alias;
						$pembayaran += toFloat($this->input->post('amount['.$index.']'));

						$detail[] = [
							// 'tanggal' => $this->input->post('tanggal['.$index.']'),
							'tanggal' => date('Y-m-d'),
							'coaid'   => $coaid,
							'aliasid' => $alias,
							'nominal' => toFloat($this->input->post('amount['.$index.']'))
						];
					endforeach;

					if($pembayaran < $bill):
						$status = '0';
					elseif($pembayaran > $bill):
						$this->query_error('Total Payment can not more than bill');
						return false;
					else:
						$status = '1';
					endif;

					$updateData = array(
						'userid'     => $this->session->userdata('user'),
						'pembayaran' => $pembayaran,
						'coaid'      => $this->input->post('coaid'),
						'detail'     => json_encode($detail),
						'status'     => $status,
					);

					$this->global_model->_update('tb_payments', $updateData, ['id' => $id]);

					if($this->db->affected_rows() > 0):
						$paymentdata = $this->global_model->_row('tb_payments', ['id' => $id])->row();
						$type        = $paymentdata->type;
						$source      = json_decode($paymentdata->source, true);

						$namatable = key($source);

						if($namatable == 'tb_service'):
							// cek data job
							$job = $this->global_model->_get('tb_job_detail', ['service_id' => $source[$namatable]]);
							if($job->num_rows()):
								foreach($job->result() as $j):
									$harga = json_decode($j->jasaharga);
									$totaljob = 0;
									if(isset($harga->selling_price)):
										$totaljob += $harga->selling_price;
									else:
										foreach($harga as $h):
											$totaljob += $h->selling_price;
											echo $totaljob;
										endforeach;
									endif;
								endforeach;

								if($totaljob > 0):								
									$jurnal[] = array(
										'tanggal' => date('Y-m-d'),
										'coaid'   => sql_get_var('pp_auto_jurnal', 'coaid', ['source' => 'wo']),
										'nominal' => $totaljob,
										'type'    => 'cr',
										'status'  => '0',
										'source'  => json_encode(['tb_payments' => $id])
									);
								endif;
							endif;

							// cek data sparepart
							$parts = $this->global_model->_get(
								'tb_service_parts a', 
								['a.service_id' => $source[$namatable]], 
								[], 
								[], 
								'a.sparepart_id, a.het, a.disc, a.pickingqty, c.id catid',
								[
									['tb_sparepart b', 'a.sparepart_id = b.id', 'left'],
									['tb_sparepart_category c', 'b.catid = c.id', 'left']
								]
							);
							if($parts->num_rows()):
								$partjurnal = array();
								foreach($parts->result() as $p):
									$sparepart_id = $p->sparepart_id;
									$het          = $p->het;
									$disc         = $p->disc;
									$pickingqty   = $p->pickingqty;
									$catid        = $p->catid;

									$partjurnal[$catid][] = ($het * $pickingqty) - (($disc / 100) * ($het * $pickingqty));
								endforeach;

								foreach($partjurnal as $cat => $jurnalpart):
									$totalparts = 0;
									foreach($jurnalpart as $jp):
										$totalparts += $jp;
									endforeach;

									// jurnal penjualan
									if($totalparts > 0):
										$jurnal[] = array(
											'tanggal' => date('Y-m-d'),
											'coaid'   => sql_get_var('pp_auto_jurnal', 'coaid', ['source' => 'expense-'.encode($cat)]),
											'nominal' => $totalparts,
											'type'    => 'cr',
											'status'  => '0',
											'source'  => json_encode(['tb_payments' => $id])
										);
									endif;

									// jurnal persediaan
									/*$jurnal[] = array(
										'tanggal' => date('Y-m-d'),
										'coaid'   => sql_get_var('pp_auto_jurnal', 'coaid', ['source' => 'supply-'.encode($cat)]),
										'nominal' => $totalparts,
										'type'    => 'cr',
										'status'  => '0',
										'source'  => json_encode(['tb_payments' => $id])
									);*/
								endforeach;
							endif;
						elseif($namatable == 'tb_wash'):
							// jurnal penjualan
							$jurnal[] = array(
								'tanggal' => date('Y-m-d'),
								'coaid'   => sql_get_var('pp_auto_jurnal', 'coaid', ['source' => 'wash']),
								'nominal' => $bill,
								'type'    => 'cr',
								'status'  => '0',
								'source'  => json_encode(['tb_payments' => $id])
							);
						endif;

						$join = array(
							['tb_coa_group b', 'a.groupid = b.id', 'left'],
						);

						if($this->input->post('coaid')):
							$dataCOA = $this->global_model->_get('tb_coa a', ['a.id' => $this->input->post('coaid')], [], [], 'b.normal', $join)->row();
							$saldonormal = $dataCOA->normal;

							$jurnal = array();

							$jurnal[] = [
								'tanggal' => date('Y-m-d'),
								'coaid'   => $this->input->post('coaid'),
								'nominal' => $bill,
								'type'    => $saldonormal,
								'status'  => '0',
								'source'  => json_encode(['tb_payments' => $id]),
							];
						endif;

						foreach($detail as $det):
							$dataCOA = $this->global_model->_get('tb_coa a', ['a.id' => $det['coaid']], [], [], 'b.normal', $join)->row();
							$saldonormal = $dataCOA->normal;

							if($type == 'in'):
								$jurnaltype = $saldonormal;
							else:
								if($saldonormal == 'cr'):
									$jurnaltype = 'dr';
								else:
									$jurnaltype = 'cr';
								endif;
							endif;

							$jurnal[] = [
								'tanggal' => $det['tanggal'],
								'coaid'   => $det['coaid'],
								'nominal' => $det['nominal'],
								'type'    => $jurnaltype,
								'status'  => '0',
								'source'  => json_encode(['tb_payments' => $id]),
							];
						endforeach;

						$this->global_model->_insert_batch('tb_jurnal', $jurnal);

						echo json_encode([
							'status' => '1',
							'pesan'  => 'Data has been updated',
							'type'   => $type
						]);
					else:
						$this->query_error();
					endif;
				else:
					$this->input_error();
				endif;

			else:
				$data = array(
					'bill'    => $this->input->post('bill'),
					'payment' => $this->global_model->_row('tb_payments', ['id' => decode($id)])->row(),
					'detail'  => $this->global_model->_get('tb_coa_alias'),
					'id'      => $id,
				);

				$data['source'] = ($data['payment']->source != '') ? key(json_decode($data['payment']->source)) : '';

				if($data['payment']->type == 'in')
					$data['alias'] = $this->global_model->_get('tb_coa_alias a', ['a.kategori' => '4']);
				else
					$data['alias'] = $this->global_model->_get('tb_coa_alias a', ['a.kategori' => '5']);

				$this->load->view('popoti/finance/payment/pembayaran', $data);
			endif;
		// }
	}

	function ap()
	{
		cekoto('finance/ap', 'view', true, true);
		$this->data['menuName'] = 'Account Payable';

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

        $this->data['js'][] = base_url('assets/custom/js/finance.js');

        $data = array(
        	'supplier' => $this->global_model->_get('tb_supplier', ['status' => '1']),
        );

		$this->load->templateAdmin('finance/ap', $data);
	}

	function ap_json()
		{
		// if($this->input->is_ajax_request())
		// {
			$supplierid   = $this->input->post('supplierid');

			$requestData  = $_REQUEST;

			$where = ' AND a.type = \'out\'';

			if($supplierid && $supplierid != 'All')
				$where .= ' AND b.id = \''.$supplierid.'\'';

			$fetch = $this->global_model->_retrieve(
				$table        = 'tb_payments a
					LEFT JOIN tb_supplier b ON a.supplierid = b.id',
				$select       = 'IFNULL(b.id, 0) supplierid, a.tanggal, a.duedate, a.no, SUM(a.pembayaran) debit, SUM(a.tagihan) kredit, IFNULL(b.nama, \'Other\') supplier',
				$colOrder     = array('b.nama', 'SUM(a.tagihan) - SUM(a.pembayaran)'),
				$filter       = array('b.nama'),
				$where,
				$requestData['search']['value'], 
				$requestData['order'][0]['column'], 
				$requestData['order'][0]['dir'], 
				$requestData['start'], 
				$requestData['length'],
				'b.id'
			);
			
			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{
				$nestedData = array(); 

				$nestedData[] = '<a href="'.base_url('finance/detail-ap/'.encode($row->supplierid)).'">'.$row->supplier.'</a>';
				// $nestedData[] = 'Rp '.rupiah($row->debit, 2);
				// $nestedData[] = 'Rp '.rupiah($row->kredit, 2);
				$nestedData[] = 'Rp '.rupiah($row->kredit - $row->debit, 2);

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

	function detail_ap($id = false)
	{

		cekoto('finance/ap', 'view', true, true);
		if($_POST):
			$status       = $this->input->post('status');
			$invoicedate1 = $this->input->post('invoicedate1');
			$invoicedate2 = $this->input->post('invoicedate2');
			$duedate1     = $this->input->post('duedate1');
			$duedate2     = $this->input->post('duedate2');

			$requestData  = $_REQUEST;

			$where = ' AND a.type = \'out\'';
			$where .= ' AND a.supplierid = \''.decode($id).'\'';

			if($status && $status != 'All')
				$where .= ' AND a.status = \''.$status.'\'';
			if($invoicedate1 && $invoicedate2)
				$where .= ' AND a.tanggal BETWEEN \''.$invoicedate1.'\' AND \''.$invoicedate2.'\'';
			if($duedate1 && $duedate2)
				$where .= ' AND a.tanggal BETWEEN \''.$duedate1.'\' AND \''.$duedate2.'\'';

			$fetch = $this->global_model->_retrieve(
				$table        = 'tb_payments a
					LEFT JOIN tb_supplier b ON a.supplierid = b.id',
				$select       = 'a.id, a.tanggal, a.duedate, a.no, a.pembayaran debit, a.tagihan kredit',
				$colOrder     = array('a.no', 'a.tanggal', 'a.duedate', 'a.pembayaran', 'a.tagihan'),
				$filter       = array('a.no'),
				$where,
				$requestData['search']['value'], 
				$requestData['order'][0]['column'], 
				$requestData['order'][0]['dir'], 
				$requestData['start'], 
				$requestData['length'],
				'a.id'
			);
			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{
				$nestedData = array(); 

				$nestedData[] = $row->no;
				$nestedData[] = tgl($row->tanggal);
				$nestedData[] = ($row->duedate != '0000-00-00 00:00:00') ? tgl($row->duedate) : '-';
				$nestedData[] = 'Rp '.rupiah($row->debit, 2);
				$nestedData[] = 'Rp '.rupiah($row->kredit, 2);
				$nestedData[] = 'Rp '.rupiah($row->kredit - $row->debit, 2);

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
			cekoto('finance/ap', 'view', true, true);

			$this->data['menuName'] = 'Account Payable';

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

	        $this->data['js'][] = base_url('assets/custom/js/finance.js');

	        $data = array(
	        	'id' => $id,
	        );

			$this->load->templateAdmin('finance/detail-ap', $data);
		endif;
	}

	function tambah_ap($id = false)
	{
		if($id)
		{
			cekoto('finance/ap', 'edit', true, false);
		}
		else
		{
			cekoto('finance/ap', 'add', true, false);
		}
		if ($this->input->is_ajax_request()) {
			if($this->input->post())
			{
				// echo json_encode($this->input->post());die;
				$this->form_validation->set_rules('no', 'No Invoice', 'required|max_length[100]');
				$this->form_validation->set_rules('supplierid', 'Supplier Name', 'required|max_length[50]');
				$this->form_validation->set_rules('tanggal', 'Invoice Date', 'required');
				$this->form_validation->set_rules('duedate', 'Due Date', 'required');
				// $this->form_validation->set_rules('description', 'Description', 'required');
				$this->form_validation->set_rules('amount', 'Amount', 'required');
				
				if($this->form_validation->run() == true)
				{
					$insert = array(
						'no'             => $this->input->post('no'),
						'supplierid'     => $this->input->post('supplierid'),
						'tanggal'        => $this->input->post('tanggal'),
						'duedate'        => $this->input->post('duedate'),
						// 'description' => $this->input->post('description'),
						'tagihan'        => toFloat($this->input->post('amount')),
						'type'           => 'out',
					);
					if($id)
					{
						$this->global_model->_update('tb_payments', $insert, ['id' => decode($id)]);
					}
					else
					{
						$this->global_model->_insert('tb_payments',$insert);
					}

					if($this->db->affected_rows() > 0) {
						echo json_encode(array(
							'status' => 1,
							'pesan' => "Data has been updated."
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
					$data['ap'] = $this->global_model->_row('tb_payments',['id' => decode($id)])->row();
				}
				else
				{
					$data['ap'] = (object) array(
						'id'  		  => '',
						'no'  		  => '',
						'supplierid'  => '',
						'tanggal'     => '',
						'duedate' 	  => '',
						'tagihan' 	  => '',
						// 'description' => '',
					);
				}
				// print_ar($data);die;
				$data['suppliers'] = $this->global_model->_get('tb_supplier');
				$this->load->view('popoti/finance/add_ap',$data);
			}
		}	
	}

	function delete_limit($id)
	{
		if ($this->input->is_ajax_request()) {
			$this->global_model->_delete('tb_limit', ['id' => decode($id)]);
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
	}

	function delete_ap($id)
	{
		
		$source = $this->db->get_where('tb_ap',['id' => decode($id)])->row()->source;
		if($source)
		{
			$this->query_error('Sorry item didn\'t delete');
		}
		else
		{
			$this->global_model->_delete('tb_ap', ['id' => decode($id)]);
			echo json_encode(['status' => 1]);
		}
	}

	function bayar_ap($id)
	{
		$data = $this->db->get_where('tb_ap',['id' => decode($id)])->row_array();
		

		if($this->form_validation->run() == false ){
			$this->load->view('popoti/finance/pembayaran-ap', $data);
		}else{
			$this->load->view('popoti/finance/ap');
		}

	}
 
//  account receive


	function ar()
	{
		cekoto('finance/ar', 'view', true, true);
		$this->data['menuName'] = 'Account Receivable';

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

        $this->data['js'][] = base_url('assets/custom/js/finance.js');

        $data = array(
        	'customer' => $this->global_model->_get('tb_customer'),
        );

		$this->load->templateAdmin('finance/ar', $data);
	}

	function ar_json()
	{
		// if($this->input->is_ajax_request())
		// {
			$customerid = $this->input->post('customerid');

			$requestData  = $_REQUEST;

			$where = ' AND a.type = \'in\'';

			if($customerid && $customerid != 'All')
				$where .= ' AND a.customerid = \''.$customerid.'\'';

			$fetch = $this->global_model->_retrieve(
				$table        = 'tb_payments a
					LEFT JOIN tb_customer b ON a.customerid = b.id',
				$select       = 'IFNULL(b.id, 0) customerid, a.tanggal, a.duedate, a.no, SUM(a.tagihan) debit, SUM(a.pembayaran) kredit, IFNULL(b.nama, \'Other\') customer',
				$colOrder     = array('b.nama'),
				$filter       = array('b.nama'),
				$where,
				$requestData['search']['value'], 
				$requestData['order'][0]['column'], 
				$requestData['order'][0]['dir'], 
				$requestData['start'], 
				$requestData['length'],
				'b.id'
			);
			
			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 

				$nestedData[] = '<a href="'.base_url('finance/detail-ar/'.encode($row->customerid)).'">'.$row->customer.'</a>';
				// $nestedData[] = 'Rp '.rupiah($row->debit, 2);
				// $nestedData[] = 'Rp '.rupiah($row->kredit, 2);
				$nestedData[] = 'Rp '.rupiah($row->debit - $row->kredit, 2);

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

	function detail_ar($id = false)
	{
		cekoto('finance/ar','view', true , true);
		if($_POST):
			$status       = $this->input->post('status');
			$invoicedate1 = $this->input->post('invoicedate1');
			$invoicedate2 = $this->input->post('invoicedate2');
			$duedate1     = $this->input->post('duedate1');
			$duedate2     = $this->input->post('duedate2');

			$requestData  = $_REQUEST;

			$where = ' AND a.type = \'in\'';
			$where = ' AND a.customerid = \''.decode($id).'\'';

			if($status && $status != 'All')
				$where .= ' AND a.status = \''.$status.'\'';
			if($invoicedate1 && $invoicedate2)
				$where .= ' AND a.tanggal BETWEEN \''.$invoicedate1.'\' AND \''.$invoicedate2.'\'';
			if($duedate1 && $duedate2)
				$where .= ' AND a.tanggal BETWEEN \''.$duedate1.'\' AND \''.$duedate2.'\'';

			$fetch = $this->global_model->_retrieve(
				$table        = 'tb_payments a',
				$select       = 'a.id, a.tanggal, a.duedate, a.no, a.pembayaran kredit, a.tagihan debit',
				$colOrder     = array('a.no', 'a.tanggal', 'a.duedate', 'a.pembayaran', 'a.tagihan'),
				$filter       = array('a.no'),
				$where,
				$requestData['search']['value'], 
				$requestData['order'][0]['column'], 
				$requestData['order'][0]['dir'], 
				$requestData['start'], 
				$requestData['length'],
				'a.id'
			);
			
			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{
				$nestedData = array(); 

				$nestedData[] = $row->no;
				$nestedData[] = tgl($row->tanggal);
				$nestedData[] = ($row->duedate != '0000-00-00 00:00:00') ? tgl($row->duedate) : '-';
				$nestedData[] = 'Rp '.rupiah($row->debit, 2);
				$nestedData[] = 'Rp '.rupiah($row->kredit, 2);
				$nestedData[] = 'Rp '.rupiah($row->debit - $row->kredit, 2);

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
			cekoto('finance/ar', 'view', true, true);

			$this->data['menuName'] = 'Account Receivable';

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

	        $this->data['js'][] = base_url('assets/custom/js/finance.js');

	        $data = array(
	        	'id' => $id,
	        );

			$this->load->templateAdmin('finance/detail-ar', $data);
		endif;
	}


	function tambah_ar($id = false)
	{
		if($id)
		{
			cekoto('finance/ar', 'edit', true, false);
		}
		else
		{
			cekoto('finance/ar', 'add', true, false);
		}
		if ($this->input->is_ajax_request()) {
			if($this->input->post())
			{
				// echo json_encode($this->input->post());die;
			$this->form_validation->set_rules('no', 'No Invoice', 'required|max_length[100]');
			$this->form_validation->set_rules('tanggal', 'Invoice Date', 'required');
			$this->form_validation->set_rules('duedate', 'Due Date', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');
			$this->form_validation->set_rules('amount', 'Amount', 'required');
				
				if($this->form_validation->run() == true)
				{
				$insert = array(

				'no' => $this->input->post('no'),
				'nama' => $this->input->post('nama'),
				'tanggal' => $this->input->post('tanggal'),
				'duedate' => $this->input->post('duedate'),
				'description' => $this->input->post('description'),
				'amount' => toFloat($this->input->post('amount')),
					);
					// print_ar($insert); die
					if($id)

					{
						$this->global_model->_update('tb_ar', $insert, ['id' => decode($id)]);
					}
					else
					{
						$this->global_model->_insert('tb_ar',$insert);
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
					$data['ar'] = $this->global_model->_row('tb_ar',['id' => decode($id)])->row();
					// echo json_encode($data['ap']);die;
				}
				else
				{
					$data['ar'] = (object) array(
					'id'  		  => '',
					'no'  		  => '',
					'nama'  		  => '',
					'tanggal'     => '',
					'duedate' 	  => '',
					'amount' 	  => '',
					'description' => '',
				);
				}
				// $data['ap'] = $this->global_model->_get('tb_ap');
				$this->load->view('popoti/finance/add-ar',$data);
			}
		}	
	}

	function receive_ar($id)
	{
		$data['ar'] = $this->global_model->_get('tb_ap', ['id' => decode($id)])->row();
		$data['alias'] = $this->global_model->_get('tb_coa_alias', ['status' => '1']);
		// $status = $this->db->get_where('tb_ap',['id' => decode($id)])->row_array();

		// $this->form_validation->set_rules('amount', 'Amount', 'required');

		// if($this->form_validation->run() == false ){

		$this->load->view('popoti/finance/receive-ar', $data);
		// }else{
		// 	$this->load->view('popoti/finance/ap');
		// }

	}

	function delete_ar($id)
	{
		// $source = sql_get_var('tb_ap', 'source', ['id' => $id]);
		$source = $this->db->get_where('tb_ar',['id' => decode($id)])->row()->source;
		if($source)
		{
			$this->query_error('Sorry item didn\'t delete');
		}
		else
		{
			$this->global_model->_delete('tb_ar', ['id' => decode($id)]);
			echo json_encode(['status' => 1]);
		}
	}

	function jurnal()
	{
		cekoto('finance/jurnal', 'add', true, true);
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

        $this->data['js'][] = base_url('assets/custom/js/finance.js');

		$this->load->templateAdmin('finance/jurnal/data');
	}

	function jurnal_summary()
	{
		if($this->input->is_ajax_request()):
			$requestData  = $_REQUEST;

			$fetch        = $this->global_model->_retrieve(
				$table        = 'tb_jurnal,
								(SELECT @debit := 0) dr,
								(SELECT @kredit := 0) cr',
				$select       = 'tanggal, 
								@debit := SUM(CASE WHEN type = \'dr\' THEN nominal ELSE 0 END) debit, 
								@kredit := SUM(CASE WHEN type = \'cr\' THEN nominal ELSE 0 END) kredit,
								@debit - @kredit balance',
				$colOrder     = array('tanggal', '', '', '@balance'),
				$filter       = array(),
				$where        = NULL,
				$like_value   = $requestData['search']['value'],
				$column_order = $requestData['order'][0]['column'],
				$column_dir   = $requestData['order'][0]['dir'],
				$limit_start  = $requestData['start'],
				$limit_length = $requestData['length'],
				$group_by     = 'MONTH(tanggal)'
			);
			
			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array();

				$pecah = explode('-', $row->tanggal);
				$bulan = $pecah[1].'-'.$pecah[0];

				$nestedData[] = '<a href="'.base_url('finance/detail-jurnal/'.$bulan).'">'.my($bulan).'</a>';
				$nestedData[] = 'Rp '.rupiah($row->debit, 2);
				$nestedData[] = 'Rp '.rupiah($row->kredit, 2);
				$nestedData[] = 'Rp '.rupiah($row->balance, 2);

				$data[] = $nestedData;
			}

			$json_data = array(
				"draw"            => intval( $requestData['draw'] ),  
				"recordsTotal"    => intval( $totalData ),  
				"recordsFiltered" => intval( $totalFiltered ), 
				"data"            => $data
				);

			echo json_encode($json_data);
		endif;
	}

	function detail_jurnal($bulan = '')
	{
		cekoto('finance/jurnal','view', true, true);
		if($_POST):
			// if($this->input->is_ajax_request()):
				$requestData  = $_REQUEST;

				$fetch        = $this->global_model->_retrieve(
					$table        = 'tb_jurnal a LEFT JOIN tb_coa b ON a.coaid = b.id,
									(SELECT @row := 0) r',
					$select       = '(@row := @row + 1) nomor, 
									a.id,
									a.tanggal, 
									a.coaid,
									CONCAT(\'[\', b.kode, \'] \', b.nama) akun,
									a.type, 
									a.nominal, 
									a.status',
					$colOrder     = array('@nomor', 'tanggal', 'coaid'),
					$filter       = array('CONCAT(\'[\', b.kode, \'] \', b.nama)', 'a.nominal'),
					$where        = ' AND LEFT(tanggal, 7) = \''.$this->input->post('bulan').'\'',
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

					$nestedData[] = $row->nomor;
					$nestedData[] = tgl($row->tanggal);
					$nestedData[] = $row->akun;
					$nestedData[] = ($row->type == 'dr') ? rupiah($row->nominal, 2) : '';
					$nestedData[] = ($row->type == 'cr') ? rupiah($row->nominal, 2) : '';

					switch ($row->status) {
						case '0':
							$icon  = 'fas fa-list-alt mr-1';
							$class = 'badge badge-outline-primary';
							$text  = 'Draft';
							break;
						
						default:
							$icon  = 'fas fa-check mr-1';
							$class = 'badge badge-outline-success';
							$text  = 'Approved';
							break;
					}

					$nestedData[] = '<span class="'.$class.'"><i class="'.$icon.'"></i>'.$text.'</span>';

					$button = '<div class="btn-group btn-sm">';

					if($row->status == '0'):
						$button .= '<a href="'.base_url('finance/edit-jurnal/'.encode($row->id)).'" class="btn btn-sm btn-primary edit-jurnal"><i class="fas fa-edit mr-1"></i>Edit<a>';
						$button .= '<a href="'.base_url('finance/delete-jurnal/'.encode($row->id)).'" class="btn btn-sm btn-danger delete"><i class="fas fa-trash-alt mr-1"></i>Delete<a>';
						$button .= '<a href="'.base_url('finance/approve-jurnal/'.encode($row->id)).'" class="btn btn-sm btn-success approve-jurnal"><i class="fas fa-check mr-1"></i>Approve<a>';
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
		else:
			$pecah = explode('-', $bulan);
			$bulan = $pecah[1].'-'.$pecah[0];

			$data = array(
				'bulan' => $bulan
			);

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

	        $this->data['js'][] = base_url('assets/custom/js/finance.js');

			$this->load->templateAdmin('finance/jurnal/detail', $data);
		endif;
	}

	function new_jurnal($id = '')
	{
		cekoto('finance/jurnal', 'add', true, false);
		if($_POST):
			$this->form_validation->set_rules('no', 'No.', 'required|max_length[100]');
			$this->form_validation->set_rules('tanggal', 'Date', 'required');
			$this->form_validation->set_rules('keterangan', 'Description', 'max_length[250]');

			$no = 1;
			foreach($this->input->post('akunid') as $i => $coaid):
				$this->form_validation->set_rules('akunid['.$i.']', 'Account no. ' . $no, 'required');

				$no++;
			endforeach;

			if($this->form_validation->run()):
				$voucher = array(
					'no'         => $this->input->post('no'),
					'tanggal'    => $this->input->post('tanggal'),
					'keterangan' => $this->input->post('keterangan'),
					'status'     => $this->input->post('status'),
				);

				if($id):
					$id = decode($id);
					$this->global_model->_update('tb_voucher', $voucher);
					$voucherid = $id;
				else:
					$voucherid = $this->global_model->_insert('tb_voucher', $voucher);
				endif;

				$details = [];
				foreach($this->input->post('akunid') as $i => $coaid):
					if($this->input->post('debit')[$i]):
						$type = 'dr';
						$nominal = toFloat($this->input->post('debit')[$i]);
					else:
						$type = 'cr';
						$nominal = toFloat($this->input->post('kredit')[$i]);
					endif;


					$details[] = array(
						'tanggal'    => $this->input->post('tanggal'),
						'coaid'      => $coaid,
						'type'       => $type,
						'nominal'    => $nominal,
						'status'     => $this->input->post('status'),
						'keterangan' => $this->input->post('keterangan'),
						'source'     => json_encode('tb_voucher', $voucherid),
					);

					$this->global_model->_insert_batch('tb_jurnal', $details);

				endforeach;
				echo json_encode([
					'status' => 1,
					'pesan'  => 'Journal has been added / updated',
				]);
			else:
				$this->input_error();
			endif;
		else:
			$data = array(
				'coa' => $this->global_model->_get('tb_coa', ['status' => '1'], $where_in = array(), $or_where = array(), $select = false, $join = array(), $limit = false, $order_by = 'kode ASC'),
			);

			$this->load->view('popoti/finance/jurnal/new', $data);
		endif;
	}

	public function auto_jurnal()
	{

		cekoto('finance/auto-jurnal', 'view', true, true);

		$this->data['js'][] = base_url('assets/custom/js/finance.js');

		$data = (object) array(
			'sparepartCat' => $this->global_model->_get('tb_sparepart_category', ['status' => '1']),
		);

		$this->load->templateAdmin('finance/jurnal/auto-jurnal/data', $data);
	}

	function coa_popup()
	{
		cekoto('finance', 'view', true, false);

		if($this->input->post('coaid')):
			$coaid  = $this->input->post('coaid');
			$source = $this->input->post('source');

			// check existing data
			$count = $this->global_model->_get('pp_auto_jurnal', ['source' => $source])->num_rows();

			// if data existed
			if($count):
				$this->global_model->_update('pp_auto_jurnal', ['coaid' => decode($coaid)], ['source' => $source]);
			else:
				$this->global_model->_insert('pp_auto_jurnal', ['coaid' => decode($coaid), 'source' => $source]);
			endif;

			echo json_encode(['status' => 1]);
		else:
			$data = array(
				'coa' => $this->global_model->_get(
					'tb_coa_group a', 
					['b.status' => '1'], 
					[], 
					[], 
					'a.kode, a.nama, CONCAT(\'[\', GROUP_CONCAT(CONCAT(\'{"id":"\', b.id, \'","kode":"\', b.kode, \'","nama":"\', b.nama, \'","parentid":"\', IFNULL(b.parentid, 0), \'"}\')), \']\') coa',
					[
						['tb_coa b', 'a.id = b.groupid', 'left']
					],
					false,
					false,
					'a.id'
				),
				'target' => $this->input->post('target')
			);

			$this->load->view('popoti/finance/coa/popup', $data);
		endif;
	}

	function print_invoice($id)
	{
		$data = array(
			'company' => $this->global_model->_get('pp_settings')->row(),
			'payment' => $this->global_model->_get(
				'tb_payments a',
				['a.id' => decode($id)],
				[],
				[],
				'a.id, a.no, a.tanggal, a.duedate, a.userid, d.nama user, a.tagihan, a.pembayaran, a.detail, a.type, a.credit_detail, a.supplierid, a.customerid, a.coaid, a.status, a.source, b.nama supplier, c.nama customer',
				[
					['tb_supplier b', 'a.supplierid = b.id', 'left'],
					['tb_customer c', 'a.customerid = c.id', 'left'],
					['tb_employee d', 'a.userid = d.id', 'left']
				]
			)->row()
		);

		$this->load->templateAdmin('finance/invoice/cetak', $data);
	}
}

?>