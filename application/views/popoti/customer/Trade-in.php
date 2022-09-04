<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class : Sparepart
 * By : Puzha Fauzha
 */
class Tradein extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Tradein_model');
		isloggedin();
	}
		function index()
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

        $this->load->templateAdmin('Tradein/trade-in');
 	}

	function tradein_json()
	{
		if($this->input->is_ajax_request())
		{
			$requestData	= $_REQUEST;
			$fetch			= $this->sparepart_model->gettradein($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
			
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
				$nestedData[] = rupiah($row->harga_satuan, 2);
				$nestedData[] = rupiah($row->harga_jasa, 2);

				$nestedData[]	= "<div class='btn-group'>
										<a href='".site_url('sparepart/tambah-sparepart/'.encode($row->id))."' id='TambahSparepart' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
										<a href='".site_url('sparepart/delete-sparepart/'.encode($row->id))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
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
		}
	}

	function tambah_tradein($id = false)
	{
		if($_POST)
		{
			$rules_kode = '';
			if(!$id)
				$rules_kode = '|is_unique[tb_sparepart.kode]';

			$this->form_validation->set_rules('kode', 'Code', 'required|max_length[50]'.$rules_kode);
			$this->form_validation->set_rules('nama', 'Part Name', 'required');
			$this->form_validation->set_rules('harga', 'Price', 'required');
			$this->form_validation->set_rules('catid', 'Category', 'required');
			// $this->form_validation->set_rules('merkid', 'Merk', 'required');
			$this->form_validation->set_rules('margin', 'Margin', 'required');

			if($this->form_validation->run() == true)
			{
				$kode     = $this->input->post('kode');
				$nama     = $this->input->post('nama');
				$harga    = toFloat($this->input->post('harga'));
				$catid    = $this->input->post('catid');
				$merkid   = $this->input->post('merkid');
				$discount = toFloat($this->input->post('discount'));
				$program  = toFloat($this->input->post('program'));
				$vat      = toFloat($this->input->post('vat'));
				$margin   = toFloat($this->input->post('margin'));
				$het      = toFloat($this->input->post('het'));
				$vat_type = $this->input->post('vat_type');
				$tanggal  = $this->input->post('tanggal');

				$newid = newid('tb_sparepart');

				$insert = array(
					'kode'     => $kode,
					'nama'     => $nama,
					'catid'    => $catid,
					'merkid'   => $merkid,
					'harga'    => toFloat($harga),
					'discount' => toFloat($discount),
					'program'  => $program,
					'vat'      => $vat,
					'vat_type' => $vat_type,
					'margin'   => toFloat($margin),
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
					'kode'     => '',
					'nama'     => '',
					'catid'    => '',
					'merkid'   => '',
					'discount' => '',
					'program'  => '',
					'vat'      => '',
					'vat_type' => '%',
					'margin'   => '',
					'het'      => '',
					'harga'    => 0,
				);
			}
			$this->load->view('popoti/sparepart/add-tradein', $data);
		}
	}

}

?>