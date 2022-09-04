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
 		cekoto('Tradein', 'view', true, true);
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

        $this->data['js'][] = base_url('assets/custom/js/tradein.js');

        $this->load->templateAdmin('Tradein/trade-in');
 	}

		function order_tradein()
 	{
 		cekoto('Tradein', 'tambah', true, true);
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

        $this->data['js'][] = base_url('assets/custom/js/tradein.js');

        $this->load->templateAdmin('Tradein/order-tradein');
 	}



function tradein_json()
	{
		if($this->input->is_ajax_request())
		{
			$requestData	= $_REQUEST;
			$fetch			= $this->Tradein_model->gettradein($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
			
			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 

				$nestedData[] = $row->no;
				$nestedData[] = $row->tgl_beli;
				$nestedData[] = $row->kode;
				$nestedData[] = $row->nama;
				$nestedData[] = $row->harga_beli;
				$nestedData[] = $row->harga_jasa;
				$nestedData[] = $row->stock;
				$nestedData[] = $row->lokasi;


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

	function tradein_json2()
	{
		if($this->input->is_ajax_request())
		{
			$requestData	= $_REQUEST;
			$fetch			= $this->Tradein_model->gettradein2($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
			
			$totalData		= $fetch['totalData'];
			$totalFiltered	= $fetch['totalFiltered'];
			$query			= $fetch['query'];

			$data	= array();
			foreach($query->result() as $row)
			{ 
				$nestedData = array(); 

				$nestedData[] = $row->nota;
				$nestedData[] = $row->tanggal;
				$nestedData[] = $row->detail;
				$nestedData[] = $row->sparepartid;
				$nestedData[] = $row->harga_beli;
				$nestedData[] = $row->harga_jasa;
				$nestedData[] = $row->hpp;
				$nestedData[] = $row->harga_jual;
				$nestedData[] = $row->qty_barang;
				


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

function add_tradein()
		{
		$this->load->view('popoti/Tradein/add-tradein');
		}	

 function add_tradein_json()
    {
        if($this->input->is_ajax_request())
        {
            $requestData    = $_REQUEST;
            $fetch          = $this->Tradein_model->gettradein($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);

            $totalData      = $fetch['totalData'];
            $totalFiltered  = $fetch['totalFiltered'];
            $query          = $fetch['query'];

            $data   = array();
            foreach($query->result() as $row)
            { 
                $nestedData = array(); 

                // $nestedData[] = $row->tgl_beli;
                $nestedData[] = $row->nama;
                $nestedData[] = $row->harga;
                // $nestedData[] = $row->stock;

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


	function tradein_data()
		{
		if($_POST)
				print_ar($this->input->post());
		{
			if( ! empty($_POST['kode-barang']))
			{
				$total = COUNT($_POST['kode-barang']);

				if($total > 0)
				{
					$this->load->library('form_validation');
					$this->form_validation->set_rules('nomor_nota','Nomor Nota','trim|required|max_length[40]|alpha_numeric');
					$this->form_validation->set_rules('tanggal','Date Time','trim|required');
					$this->form_validation->set_rules('subtotal','Subtotal','trim|required');
					$this->form_validation->set_rules('grandtotal','Subtotal','trim|required');
					
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
					if($this->form_validation->run() == TRUE)
					{
						$nomor_nota = $this->input->post('nomor_nota');
						$tanggal    = $this->input->post('tanggal');
						$userid     = $this->input->post('userid');
						// $vehicleid  = $this->input->post('vehicleid');
						$subtotal   = toFloat($this->input->post('subtotal'));
						$grandtotal = toFloat($this->input->post('grandtotal'));
						$status     = $this->input->post('status');

						if($subtotal < $grandtotal)
						{
							$no_array = 0;
							$details  = array();
							foreach($_POST['kode-barang'] as $k)
							{
								if( ! empty($k))
								{
									$kode_barang  = $_POST['kode-barang'][$no_array];
									$jumlah_beli  = $_POST['jumlah_beli'][$no_array];
									$sub_total    = $_POST['sub_total'][$no_array];
									$details[] = array(
										'tradeinid'   => $kode_barang,
										'qty'      => $jumlah_beli,
 										'subtotal' => $sub_total,
									);
								}

								$no_array++;
							}

							$tradeindata = array(
								'nota'       => $nomor_nota,
								'tanggal'    => $tanggal,
								'userid'     => $userid,
								// 'vehicleid'  => $vehicleid,
								'subtotal'   => toFloat($subtotal),
								'grandtotal' => toFloat($grandtotal),
								// 'cash'       => toFloat($bayar),
								'detail'     => json_encode($details),

							);

							$id = $this->global_model->_insert('tb_tradein', $tradeindata);
							addPayment(['tb_tradein' => $id], $grandtotal , false, true, 'tb_tradein', 'in', 0, 0, getNoFormat('FAKTUR'));
							updateNo('FAKTUR');

							if($this->db->affected_rows() > 0)
							{
								echo json_encode(array('status' => 1, 'pesan' => "Transaksi berhasil disimpan !"));
							}
							else
							{
								$this->query_error($this->db->last_query());
							}
						}
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


}

?>