<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class : Company
 * By : Puzha Fauzha
 */

class Company extends MY_Controller
{	

	function __construct()
	{
		parent::__construct();
		$this->load->model(['general_model', 'company_model']);
		isloggedin();
	}

	function index()
	{
		// print_ar(json_decode($this->session->userdata('otoritas'), true));
		cekoto('company', 'view', true, true);

		$this->data['js'][] = base_url('assets/custom/js/company.js');

		$data['general'] = $this->general_model->get(1);
		$this->load->templateAdmin('company/edit-company', $data);
	}

	function uploadImage()
	{
	    $config['upload_path']   = './upload/popoti/';
	    $config['allowed_types'] = 'gif|jpg|png';
	    $config['file_name']     = 'logo';
	    $config['overwrite']     = true;
	    $config['max_size']      = 50000; // 1MB
	    // $config['max_width']  = 1024;
	    // $config['max_height'] = 768;

	    $this->load->library('upload', $config);

	    if ($this->upload->do_upload('logo')) {
	        $logo    = $this->upload->data("file_name");
	        $status  = 1;
	        $message = 'Upload berhasil';
	        $file    = $logo;

			$this->general_model->update(['gambar' => $logo], '1');
	    } else {
	    	$status  = 0;
	    	$message = $this->upload->display_errors();
	    	$file    = '';
	    }

		echo json_encode(['status' => $status, 'message' => $message, 'file' => $file]);
	}

	function save_company()
	{
		$this->form_validation->set_rules('title', 'Company Name', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('email', 'Address', 'required');
		$this->form_validation->set_rules('phone', 'Address', 'required');
		$this->form_validation->set_rules('fax', 'Address', 'required');
		$this->form_validation->set_rules('npwp', 'Address', 'required');

		if($this->form_validation->run() != false) {
			$title     = $this->input->post('title');
			$address   = $this->input->post('address');
			$email     = $this->input->post('email');
			$phone     = $this->input->post('phone');
			$fax       = $this->input->post('fax');
			$npwp      = $this->input->post('npwp');
			$facebook  = $this->input->post('facebook');
			$twitter   = $this->input->post('twitter');
			$instagram = $this->input->post('instagram');
			$linkedin  = $this->input->post('linkedin');
			$namaBank  = $this->input->post('nama-bank');
			$noRek     = $this->input->post('noRek');
			$atasNama  = $this->input->post('atasNama');
			$hpWa      = $this->input->post('hpWa');

			$update = [
				'title'     => $title,
				'address'   => $address,
				'email'     => $email,
				'phone'     => $phone,
				'fax'       => $fax,
				'npwp'      => $npwp,
				'facebook'  => $facebook,
				'twitter'   => $twitter,
				'instagram' => $instagram,
				'linkedin'  => $linkedin,
				'namaBank'  => $namaBank,
				'noRek'     => $noRek,
				'atasNama'  => $atasNama,
				'hpWa'      => $hpWa,
			];

			$this->general_model->update($update, '1');
			$this->session->set_flashdata('global', get_alert('success', 'Data berhasil disimpan.'));
			redirect('company');
		}
		else
		{
			$this->data['js'][] = base_url('assets/custom/js/company.js');
			$data['general'] = $this->general_model->get(1);

			$data['general'] = array(
				'title'   => $this->input->post('title'),
				'address' => $this->input->post('address'),
				'email'   => $this->input->post('email'),
				'phone'   => $this->input->post('phone'),
				'fax'     => $this->input->post('fax'),
				'npwp'    => $this->input->post('npwp'),
				'gambar'  => $data['general']['gambar'],
			);


			$this->load->templateAdmin('company/edit-company', $data);
		}
	}

	function category()
	{
		cekoto('company/category', 'view', true, true);

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

        $this->data['js'][] = base_url('assets/custom/js/company.js');

		$this->load->templateAdmin('company/category-company');
	}

	function category_json()
	{
		if($this->input->is_ajax_request())
		{
			$requestData	= $_REQUEST;
			$fetch			= $this->company_model->getcat($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);

			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 

				$nestedData[] = $row->nama;

				$nestedData[]	= "<div class='btn-group'>
										<a href='".site_url('company/tambah-category/'.encode($row->id))."' id='Edit' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
										<a href='".site_url('company/delete-category/'.encode($row->id))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
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
		if($id):
			cekoto('company/tambah-category', 'edit', true, false);
		else:
			cekoto('company/tambah-category', 'add', true, false);
		endif;
		if($_POST)
		{
			$this->form_validation->set_rules('nama', 'Category Name', 'required');

			if($this->form_validation->run() == true)
			{
				$nama = $this->input->post('nama');

				$newid = newid('tb_cat_comp');

				$insert = array(
					'nama' => $nama,
				);

				if($id)
				{
					$this->company_model->updatecat($insert, decode($id));
				}
				else
				{
					$insert['id'] = $newid;

					$this->company_model->addcat($insert);
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
				$data['company'] = $this->company_model->rowcat(['id' => decode($id)])->row();
			}
			else
			{
				$data['company'] = (object) array(
					'id'   => '',
					'nama' => '',
				);
			}
			$this->load->view('popoti/company/add-category', $data);
		}
	}

	function delete_category($id)
	{
		if(cekoto('company/delete-cat', 'delete', false, false)):
			if($this->input->is_ajax_request()):
				$this->company_model->updatecat(['status' => '0'], decode($id));
			endif;
		else:
			$this->query_error('Sorry you don\'t have access to delete this data');
		endif;
	}

	function sub_company()
	{
		cekoto('company/sub-company', 'view', true, true);

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

        $this->data['js'][] = base_url('assets/custom/js/company.js');

		$this->load->templateAdmin('company/sub-company');
	}

	function sub_json()
	{
		if($this->input->is_ajax_request())
		{
			$requestData	= $_REQUEST;
			$fetch			= $this->company_model->getsub($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);

			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 

				$nestedData[] = $row->nama;
				$nestedData[] = $row->category;
				$nestedData[] = $row->address;

				$nestedData[]	= "<div class='btn-group'>
										<a href='".site_url('company/tambah-sub/'.encode($row->id))."' id='EditSub' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
										<a href='".site_url('company/delete-sub/'.encode($row->id))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
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

	function tambah_sub($id = false)
	{
		if($id):
			cekoto('company/tambah-sub', 'edit', true, false);
		else:
			cekoto('company/tambah-sub', 'add', true, false);
		endif;

		if($_POST)
		{
			$this->form_validation->set_rules('nama', 'Sub Company Name', 'required');
			$this->form_validation->set_rules('address', 'Address', 'required');
			$this->form_validation->set_rules('id_cat', 'Category Name', 'required');

			if($this->form_validation->run() == true)
			{
				$nama    = $this->input->post('nama');
				$address = $this->input->post('address');
				$id_cat  = $this->input->post('id_cat');

				$newid = newid('tb_subcompany');

				$insert = array(
					'nama'    => $nama,
					'address' => $address,
					'id_cat'  => $id_cat,
				);

				if($id)
				{
					$this->company_model->updatesub($insert, decode($id));
				}
				else
				{
					$insert['id'] = $newid;

					$this->company_model->addsub($insert);
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
			$data['category'] = $this->company_model->getcat();

			if($id)
			{
				$data['company'] = $this->company_model->rowsub(['id' => decode($id)])->row();
			}
			else
			{
				$data['company'] = (object) array(
					'id'      => '',
					'nama'    => '',
					'address' => '',
					'id_cat'  => '',
				);
			}
			$this->load->view('popoti/company/add-sub', $data);
		}
	}

	function delete_sub($id)
	{
		if(cekoto('company/delete-sub', 'delete', false, false)):
			if($this->input->is_ajax_request()):
				$this->company_model->updatesub(['status' => '0'], decode($id));
			endif;
		else:
			$this->query_error('Sorry you don\'t have access to delete this data');
		endif;
	}

	function calendar()
	{

		cekoto('company/calendar','view',true,true);

        $this->data['css'][] = base_url('assets/libs/@fullcalendar/core/main.min.css');
        $this->data['css'][] = base_url('assets/libs/@fullcalendar/daygrid/main.min.css');
        $this->data['css'][] = base_url('assets/libs/@fullcalendar/bootstrap/main.min.css');
        $this->data['css'][] = base_url('assets/libs/@fullcalendar/timegrid/main.min.css');
        $this->data['css'][] = base_url('assets/libs/@fullcalendar/list/main.min.css');

        $this->data['js'][] = base_url('assets/libs/moment/min/moment.min.js');
        $this->data['js'][] = base_url('assets/libs/@fullcalendar/core/main.min.js');
        $this->data['js'][] = base_url('assets/libs/@fullcalendar/bootstrap/main.min.js');
        $this->data['js'][] = base_url('assets/libs/@fullcalendar/daygrid/main.min.js');
        $this->data['js'][] = base_url('assets/libs/@fullcalendar/timegrid/main.min.js');
        $this->data['js'][] = base_url('assets/libs/@fullcalendar/list/main.min.js');
        $this->data['js'][] = base_url('assets/libs/@fullcalendar/interaction/main.min.js');
        $this->data['js'][] = base_url('assets/js/pages/calendar.init.js');

		$this->load->templateAdmin('company/calendar.php');
	}

}



?>