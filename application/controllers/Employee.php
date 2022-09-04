<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class : Employee
 * By : Puzha Fauzha
 */
class Employee extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('employee_model');

		isloggedin();
	}

	function index()
	{

		cekoto('employee','view', true,true);

		$this->data['css'][] = base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css');
		$this->data['css'][] = base_url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css');
		$this->data['css'][] = base_url('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css');
		$this->data['css'][] = base_url('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css');
        $this->data['css'][] = base_url('assets/libs/summernote/summernote-bs4.min.css');
		$this->data['css'][] = base_url('assets/libs/dropzone/min/dropzone.min.css');
		$this->data['css'][] = base_url('assets/libs/dropify/css/dropify.min.css');

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

		$this->data['js'][] = base_url('assets/custom/js/employee.js');

		$this->load->templateAdmin('employee/data-employee');
	}



	function employee_json()

	{

		if($this->input->is_ajax_request())

		{

			$requestData	= $_REQUEST;

			$fetch			= $this->employee_model->get($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);

			

			$totalData		= $fetch['totalData'];

			$totalFiltered	= $fetch['totalFiltered'];

			$query			= $fetch['query'];



			$data	= array();

			foreach($query->result() as $row)

			{ 

				$nestedData = array(); 

				$jk = ($row->jk == 'L') ? 'fa-male text-primary' : 'fa-female text-pink';



				$nestedData[] = $row->NIK;
				$nestedData[] = $row->nama . '<em class="text-muted ml-1">'.$row->panggilan.'</em> <i class="fas ' .$jk. ' ml-1"></i>';
				$nestedData[] = $row->position;
				$nestedData[] = $row->bpjs ? '<span class="badge badge-primary">Yes</span>' : '<span class="badge badge-warning">No</span>';
				// $nestedData[] = ($row->subname) ? $row->subname : 'Pusat';
				// $nestedData[] = $row->age;
				// $nestedData[] = $row->registeredday;

				if($row->status == 1)
					$button = "<a href='".site_url('employee/status/'.encode($row->id))."' id='Status' class='btn btn-sm btn-warning waves-effect waves-light'><i class='mdi mdi-account-cancel mr-1'></i> Deactivate</a>";
				else
					$button = "<a href='".site_url('employee/status/'.encode($row->id))."' id='Status' class='btn btn-sm btn-primary waves-effect waves-light'><i class='mdi mdi-account-check mr-1'></i> Activate</a>";


				$nestedData[]	= "<div class='btn-group'>
				$button
				<a href='".site_url('employee/tambah-employee/'.encode($row->id))."' id='Edit' class='btn btn-sm btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>

				<a href='".site_url('employee/delete/'.encode($row->id))."' class='btn btn-sm btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>

				</div>";

				$nestedData[] = tgl($row->last_updated);



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

	function status($id)
	{
		if($id)
			// cekoto('employee/status','edit',false,false);
		{
			$id = decode($id);

			$old = $this->employee_model->row(['a.id' => $id])->row();
			if($old->status == 0)
				$new = '1';
			else
				$new = '0';

			$this->employee_model->update(['status' => $new], $id);

			$this->session->set_flashdata('global', get_alert('success', 'Data has been changed.'));
			redirect('employee');
		}
		else
			redirect('employee');
	}



	function tambah_employee($id = false)
	{

		if($id):
			$id = decode($id);

			cekoto('employee', 'edit', true, true);
		else:
			cekoto('employee', 'add', true, true);
		endif;

		if($_POST)
		{
			if($id)
				$this->form_validation->set_rules('noid', 'No. Identity', 'required');
			else
				$this->form_validation->set_rules('noid', 'No. Identity', 'required|is_unique[tb_employee.noid]');

			$this->form_validation->set_rules('registeredday', 'Name', 'required');
			$this->form_validation->set_rules('nama', 'Name', 'required');
			$this->form_validation->set_rules('subcompanyid', 'Sub Company', 'required');
			$this->form_validation->set_rules('position', 'Position', 'required');
			$this->form_validation->set_rules('jk', 'Gender', 'required');
			$this->form_validation->set_rules('merriage', 'Merriage', 'required');
			$this->form_validation->set_rules('alamat', 'Address', 'required');
			$this->form_validation->set_rules('no', 'Phone', 'required');
			$this->form_validation->set_rules('position', 'Position', 'required');
			$this->form_validation->set_rules('subcompanyid', 'Sub Company', 'required');
			$this->form_validation->set_rules('hasAccess', 'System Access', 'required');
			$this->form_validation->set_rules('statusKaryawan', 'Status Karyawan', 'required');
			$this->form_validation->set_rules('bpjs', 'Cover BPJS', 'required');
			$this->form_validation->set_rules('pokok', 'Gaji Pokok', 'required');
			if($this->form_validation->run() == true)
			{
				$nama           = $this->input->post('nama');
				$ktp            = $_FILES['ktp']['size'];
				$photo          = $_FILES['avatar']['size'];
				$panggilan      = $this->input->post('panggilan');
				$jk             = $this->input->post('jk');
				$tempat         = $this->input->post('tempat');
				$tglLahir       = $this->input->post('tglLahir');
				$noid           = $this->input->post('noid');
				$npwp           = $this->input->post('npwp');
				$alamat         = $this->input->post('alamat');
				$no             = $this->input->post('no');
				$email          = $this->input->post('email');
				$merriage       = $this->input->post('merriage');
				$subcompanyid   = $this->input->post('subcompanyid');
				$position       = $this->input->post('position');
				$hasAccess      = $this->input->post('hasAccess');
				$statusKaryawan = $this->input->post('statusKaryawan');
				$bpjs           = $this->input->post('bpjs');
				$pokok          = toFloat($this->input->post('pokok'));
				$makan          = toFloat($this->input->post('makan'));
				$transport      = toFloat($this->input->post('transport'));
				$tunjangan      = toFloat($this->input->post('tunjangan'));
				$tunjangan      = toFloat($this->input->post('tunjangan'));
				$another        = toFloat($this->input->post('another'));
				$registeredday  = $this->input->post('registeredday');

				if($hasAccess && $this->input->post('password'))
					$password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);

				$newid = newid('tb_employee');

				$config['upload_path']   = './upload/files/';
				$config['allowed_types'] = 'png|jpg|jpeg';
				$config['max_size']      = 3000;
		 
				$this->load->library('upload', $config);

				$insert = array(
					'nama'           => $nama,
					'panggilan'      => $panggilan,
					'jk'             => $jk,
					'tempat'         => $tempat,
					'tglLahir'       => $tglLahir,
					// 'kebangsaan'     => $kebangsaan,
					'noid'           => $noid,
					'npwp'           => $npwp,
					// 'alamatKTP'      => $alamatKTP,
					'alamat'         => $alamat,
					'no'             => $no,
					'email'          => $email,
					// 'password'       => $password,
					'merriage'       => $merriage,
					'subcompanyid'   => $subcompanyid,
					'position'       => $position,
					'hasAccess'      => $hasAccess,
					'statusKaryawan' => $statusKaryawan,
					'bpjs'           => $bpjs,
					'pokok'          => $pokok,
					'makan'          => $makan,
					'transport'      => $transport,
					'tunjangan'      => $tunjangan,
					'another'        => $another,
					'last_updated'	 => date('Y-m-d'),
					'registeredday'  => $registeredday
				);

				if ($photo > 0 && ! $this->upload->do_upload('avatar')){
					$this->query_error($this->upload->display_errors());
					die();
				} else if ($photo > 0) {
					$upload_photo = $this->upload->data();
					$insert['photo'] = $upload_photo['file_name'];
				}

				if ($ktp > 0 && ! $this->upload->do_upload('ktp')){
					$this->query_error($this->upload->display_errors());
					die();
				} else if ($ktp > 0) {
					$upload_ktp = $this->upload->data();
					$insert['ktp'] = $upload_ktp['file_name'];
				}

				if($id)
				{
					$this->employee_model->update($insert, $id);
				}
				else
				{
					$insert['id'] = $newid;

					$NIK = getNoFormat('NIK', sql_get_var('pp_otority', 'kode', ['id' => $position]));
					$SK  = getNoFormat('SK');

					if($NIK)
					{
						$insert['NIK'] = $NIK;
						updateNo('NIK');
					}
					if($SK)
					{
						$insert['SK'] = $SK;
						updateNo('SK');
					}

					$this->employee_model->add($insert);
				}

				echo json_encode(array(
					'status' => 1,
					'pesan' => "<i class='fa fa-check' style='color:green;'></i> Data has been updated."
				));
			}
			else
			{
				$this->input_error();
			}
		}
		else
		{
	        $this->data['js'][] = base_url('assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js');
	        // $this->data['js'][] = base_url('assets/js/pages/form-wizard.init.js');
        	$this->data['js'][] = base_url('assets/libs/summernote/summernote-bs4.min.js');
	        $this->data['js'][] = base_url('assets/libs/dropify/js/dropify.min.js');
	        $this->data['js'][] = base_url('assets/custom/js/employee.js');

	        $this->data['css'][] = base_url('assets/libs/summernote/summernote-bs4.min.css');
			$this->data['css'][] = base_url('assets/libs/dropzone/min/dropzone.min.css');
			$this->data['css'][] = base_url('assets/libs/dropify/css/dropify.min.css');

			$this->load->model(['company_model', 'otority_model']);
			$data['sub']      = $this->company_model->getsub()['query'];
			$data['position'] = $this->global_model->_get('pp_otority', ['is_delete' => '0']);

			if($id)
			{
				$data['employee']       = $this->employee_model->row(['a.id' => $id])->row();
			}
			else
			{
				$data['employee'] = (object) array(
					'id'             => '',
					'nama'           => '',
					'ktp'            => '',
					'photo'          => '',
					'panggilan'      => '',
					'jk'             => '',
					'tempat'         => '',
					'tglLahir'       => '',
					'kebangsaan'     => '',
					'noid'           => '',
					'npwp'           => '',
					'alamatKTP'      => '',
					'alamat'         => '',
					'no'             => '',
					'email'          => '',
					'password'       => '',
					'merriage'       => '',
					'status'         => '',
					'subcompanyid'   => '',
					'position'       => '',
					'hasAccess'      => '',
					'statusKaryawan' => '',
					'bpjs'           => '',
					'pokok'          => '',
					'makan'          => '',
					'transport'      => '',
					'tunjangan'      => '',
					'another'        => '',
					'registeredday'  => date('Y-m-d'),
				);
			}
			// print_ar($data);die;
			$this->load->templateAdmin('employee/add-employee', $data);
		}
	}

	function change_avatar()
	{
		if($this->input->is_ajax_request())
		{

			if($_FILES['avatar']['size'] > 0)
			{
				$photo = $_FILES['avatar']['size'];

				$config['upload_path']   = './assets/images/img-profile/';
				$config['allowed_types'] = 'png|jpg';
				$config['max_size']      = 1024;
		 
				$this->load->library('upload', $config);

				if ($photo > 0 && ! $this->upload->do_upload('avatar')){
					$this->query_error($this->upload->display_errors());
					die();
				} else if ($photo > 0) {
					$upload_photo = $this->upload->data();
					$insert['USE_AVATAR'] = $upload_photo['file_name'];
					$this->global_model->_update('tb_user', $insert, ['USE_ID' => $this->session->userdata('user')]);
				}

				if($this->db->affected_rows() > 0) {
					echo json_encode(array(
						'status' => 1,
						'pesan' => "<i class='fa fa-check' style='color:green;'></i> Data has been updated."
					));
				}
				else
				{
					// $this->query_error("Oops, something happends, please contact developer !");
					$this->query_error($this->db->last_query());
				}
			}

		}
	}

	function delete($id)
	{
		if(cekoto('employee', 'delete', false, false)):
			if($this->input->is_ajax_request()):
				$this->employee_model->update(['delete' => '1'], decode($id));
			endif;
		else:
			$this->query_error('Sorry you don\'t have access to delete this data');
		endif;
	}

	function print($id)
	{
		// buatkan pdf surat pengangkatan:
		$id = decode($id);

		$employee = $this->employee_model->row(['a.id' => $id])->row();

		$this->load->model(['otority_model', 'general_model']);

		switch ($employee->statusKaryawan) {
			case '0':
				$statusKaryawan = 'Training';
				break;
			case '1':
				$statusKaryawan = 'Kontrak';
				break;
			case '2':
				$statusKaryawan = 'Tetap';
				break;
			
			default:
				$statusKaryawan = 'Training';
				break;
		}

		$variables = ['@NIK', '@nama', '@panggilan', '@jk', '@noid', '@npwp', '@alamat', '@tlp', '@email', '@company', '@position', '@statusKaryawan', '@registeredday', '@SK', '@perusahaan', '@address', '@web', '@emailAddress', '@phone', '@fax', '@pimpinan', '@now'];
		$replace = [
			$employee->NIK, 
			$employee->nama, 
			$employee->panggilan, 
			$employee->jk, 
			$employee->noid, 
			$employee->npwp, 
			$employee->alamat, 
			$employee->no, 
			$employee->email, 
			$employee->subcompanyid ? sql_get_var('tb_sub_company', 'nama', ['id' => $employee->subcompanyid]) : 'Pusat', 
			$employee->position, 
			$statusKaryawan, 
			tanggalindo($employee->registeredday), 
			$employee->SK, 
			tanggalindo(date('Y-m-d'))
		];

		// $data['isi'] = str_replace($variables, $replace, $position->pengangkatan);

		$this->pdf->load_view('pdf/create-pengangkatan');
		$this->pdf->render();
		// $this->pdf->stream($id.'.pdf');
		$output = $this->pdf->output();
		file_put_contents('upload/files/pengangkatan'.$employee->id.'.pdf', $output);

		// gabungkan pdf yang sudah dibuat tadi
		require_once(APPPATH . 'third_party/fpdf/fpdf_merge.php');

		$merge = new FPDF_Merge();
		// $merge->add('upload/files/pengangkatan'.$employee->id.'.pdf');
		// $merge->add('upload/files/jobdesk-hrd.pdf');
		$merge->add('upload/files/doc1.pdf');
		$merge->add('upload/files/doc2.pdf');
		$merge->output('upload/files/print-out-'.$employee->id.'.pdf');
	}

	function save_profile($id)
	{
		if($this->input->is_ajax_request())
		{
			if($id)
			{
				$id = decode($id);

				$this->form_validation->set_rules('nama', 'Name', 'required');				
				$this->form_validation->set_rules('username', 'Username', 'required');				

				$nama     = $this->input->post('nama');
				$username = $this->input->post('username');

				if($this->form_validation->run() == true)
				{
					$data = [
						'USE_NAMA' => $nama,
						'USE_USER' => $username,
					];

					$this->global_model->_update('tb_user', $data, ['USE_ID' => $id]);

					echo json_encode(array(
						'status' => 1,
						'pesan' => "<i class='fa fa-check' style='color:green;'></i> Data has been updated."
					));
				}
				else
				{
					$this->input_error();					
				}
			}
			else
			{
				echo json_encode([
					'status' => '0',
					'pesan' => 'User not found'
				]);
			}
		}
	}

	function employee_json_ajax()
	{
		if($this->input->is_ajax_request())
		{
			$query = $_REQUEST['query'];
			$customer = $this->db->like('nama', $query, 'BOTH')->get_where('tb_employee', ['position' => 9]);
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

	function employeeses()
	{
		cekoto('service/spk', 'view', true, false);
		return $this->load->view('popoti/employee/all-employee');
	}
	function employee_json_search()

	{

		if($this->input->is_ajax_request())

		{

			$requestData	= $_REQUEST;

			$fetch			= $this->employee_model->getemployeesearch($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);

			

			$totalData		= $fetch['totalData'];

			$totalFiltered	= $fetch['totalFiltered'];

			$query			= $fetch['query'];



			$data	= array();

			foreach($query->result() as $row)

			{ 
				if ($row->position_id == 9) {

					$nestedData = array(); 

					$jk = ($row->jk == 'L') ? 'fa-male text-primary' : 'fa-female text-pink';



					$nestedData[] = $row->NIK;
					$nestedData[] = $row->nama;
					$nestedData[] = $row->position;
					$nestedData[] = "<a href='javascript:void(0)' class='btn btn-info waves-effect waves-light chooseEmployee' data-id='$row->id'><i class='mdi mdi-cursor-pointer mr-1'></i> Choose</a>";;



					$data[] = $nestedData;
				}

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