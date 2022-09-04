<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class : Retail
 * By : Puzha Fauzha
 */

class Retail extends MY_Controller
{	

	function __construct()
	{
		parent::__construct();
		$this->load->model('Retail_model');
		isloggedin();
	}

	function index()
	{
        cekoto('retail', 'view', true, true);
        $this->data['js'][] = base_url('assets/libs/devbridge-autocomplete/jquery.autocomplete.min.js');

        $this->data['js'][] = base_url('assets/custom/js/retail.js');

		$this->load->templateAdmin('retail/jasa-retail');
	}

	function retail_data()
		{
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
						// $vehicleid  = $this->input->post('vehicleid');
						// $bayar      = toFloat($this->input->post('cash'));
						$subtotal   = toFloat($this->input->post('subtotal'));
						$totaldisc  = toFloat($this->input->post('totaldisc'));
						$grandtotal = toFloat($this->input->post('grand_total'));
						// echo $grandtotal;
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
										'retailid'   => $kode_barang,
										'qty'      => $jumlah_beli,
										'harga'    => $harga_satuan,
										'diskon'   => toFloat($discount),
										'subtotal' => $sub_total,
									);
								}

								$no_array++;
							}

							$retaildata = array(
								'nota'       => $nomor_nota,
								'tanggal'    => $tanggal,
								'userid'     => $userid,
								// 'vehicleid'  => $vehicleid,
								'subtotal'   => toFloat($subtotal),
								'discount'   => toFloat($totaldisc),
								'grandtotal' => toFloat($grandtotal),
								// 'cash'       => toFloat($bayar),
								'detail'     => json_encode($details),

							);

							$retailid = $this->global_model->_insert('tb_retail', $retaildata);

							if($this->db->affected_rows() > 0)
							{
								$source = [
									'tb_retail' => $retailid,
								];
								updateNo('RTL');
								addpayment($source, toFloat($grandtotal), $is_picking = false, $is_other = true, $table = 'tb_retail', $kategori = 'in', 0, 0, $nomor_nota);
								echo json_encode(array('status' => 1, 'pesan' => "Transaksi berhasil disimpan !", 'retailid' => encode($retailid)));
							}
							else
							{
								echo $this->db->lastquery();
								// $this->query_error($this->db->last_query());
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
	}

	function retail()
	{
		cekoto('retail', 'view', true, false);
		$this->load->view('popoti/retail/all-retail');
	}

	function all_retail_json()
    {
        if($this->input->is_ajax_request())
        {
            $requestData    = $_REQUEST;
            $fetch          = $this->Retail_model->getretail($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);

            $totalData      = $fetch['totalData'];
            $totalFiltered  = $fetch['totalFiltered'];
            $query          = $fetch['query'];

            $data   = array();
            foreach($query->result() as $row)
            { 
                $nestedData = array(); 

                $nestedData[] = $row->nama;
                $nestedData[] = $row->harga;

                $nestedData[]   = "<a href='javascript:void(0)' class='btn btn-info waves-effect waves-light choose' data-id='$row->id'><i class='mdi mdi-cursor-pointer mr-1'></i> Choose</a>";

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

  function data_json()
	{
		if($this->input->is_ajax_request())
		{
			$query      = $_REQUEST['query'];

			$data = $this->db->like('nama',$query, 'BOTH')->get('tb_retail_prices');

			$result = array();
			if($data->num_rows() > 0)
			{
				foreach($data->result() as $items)
				{
					$result[] = array(
						'id' => $items->id,
						'value' => $items->nama,
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

		cekoto('retail/prices', 'view', true, true);

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

        $this->data['js'][] = base_url('assets/custom/js/retail.js');

		$this->load->templateAdmin('retail/prices');
	}

	function prices_json()
	{
		if($this->input->is_ajax_request())
		{
			$requestData	= $_REQUEST;
			$fetch			= $this->Retail_model->getprices($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
			
			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 
				$nestedData[] = $row->kode_barang;
				$nestedData[] = $row->nama;
				$nestedData[] = rupiah($row->harga_beli, 2);
				$nestedData[] = rupiah($row->harga, 2);

				$nestedData[]	= "<div class='btn-group'>
										<a href='".site_url('retail/tambah-prices/'.encode($row->id))."' id='EditPrices' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
										<a href='".site_url('retail/delete-prices/'.encode($row->id))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
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

	function tambah_prices($id = false)
	{
		if($id)
		{
			cekoto('retail/prices', 'edit', true, false);
		}
		else
		{
			cekoto('retail/prices', 'add', true, false);
		}
		if($_POST)
		{
			$this->form_validation->set_rules('nama', 'Name', 'required');
			$this->form_validation->set_rules('harga_beli', 'Purchase prices', 'required');
			$this->form_validation->set_rules('harga', 'Harga', 'required');

			if($this->form_validation->run() == true)
			{
				$nama  = $this->input->post('nama');
				$harga_beli = $this->input->post('harga_beli');
				$harga = $this->input->post('harga');

				$newid = newid('tb_retail_prices');

				$insert = array(
					'nama'  => $nama,
					'harga_beli' => toFloat($harga_beli),
					'harga' => toFloat($harga),
					'tanggal'  => date('Y-m-d'),
				);

				if($id)
				{
					$this->Retail_model->updateprices($insert, decode($id));
				}
				else
				{
					$insert['id'] = $newid;
					$insert['kode_barang'] = getNoFormat('RT');
					$this->Retail_model->addprices($insert);
					updateNo('RT');
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
				$data['prices'] = $this->Retail_model->rowprices(['id' => decode($id)])->row();
			}
			else
			{
				$data['prices'] = (object) array(
					'id'    => '',
					'nama'  => '',
					'harga' => 0,
				);
			}
			$this->load->view('popoti/retail/add-prices', $data);
		}
	}

	function delete_prices($id)
	{
		if(cekoto('retail/prices', 'delete', false, false)):
			if($this->input->is_ajax_request()):
				$this->Retail_model->updateprices(['status' => '0'], decode($id));

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