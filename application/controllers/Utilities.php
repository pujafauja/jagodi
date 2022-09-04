
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class : Utilities
 * By : Puzha Fauzha
 */
class Utilities extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$this->load->model('Utilities_model');

		isloggedin();
	}

	function inventory()
	{
		cekoto('utilities/inventory', 'view', true, true);
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

        $this->data['js'][] = base_url('assets/custom/js/utilities.js');

        $this->load->templateAdmin('Utilities/inventory');
	}

	function Inventory_json()
	{
		// if($this->input->is_ajax_request())
		// {
			$requestData  = $_REQUEST;

			$fetch        = $this->global_model->_retrieve(
				$table        = 'tb_inventory a
								', 
				$select       = 'a.`id`,	
								a.`nama`,	
								a.`tanggal_pembelian`,			
								a.`nilai_pembelian`,	
								a.`penyusutan`,	
								a.`nilai_buku`,
								a.`status`,
								a.`lokasi_id`',
				$colOrder     = array('nama','tanggal_pembelian', 'keterangan_barang','lokasi_id','nilai_pembelian','penyusutan','nilai_buku','status'),
				$filter       = array('nama', 'tanggal_pembelian','lokasi_id','nilai_pembelian','penyusutan','nilai_buku','status'),
				$where        = 'AND a.status = \'1\'',
				
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
				switch ($row->status) {
					case '1':
						$status = '<span class="badge badge-outline-warning">baik</span>';
						break;
					case '2':
						$status = '<span class="badge badge-outline-danger">Rusak</span>';
						break;
					case '0':
						$status = '<span class="badge badge-outline-success">Jual</span>';
						break;
					
					default:
						// code...
						break;
				}
				$nestedData = array();

				$nestedData[] = $row->tanggal_pembelian;
				$nestedData[] = $row->nama;
				$nestedData[] = $row->lokasi_id;
				$nestedData[] = 'Rp '.rupiah($row->nilai_pembelian, 2) ;
				$nestedData[] = 'Rp ' .rupiah($row->penyusutan, 2);
				$nestedData[] = 'Rp'.rupiah($row->nilai_buku, 2);

				$nestedData[] = $status;

				$nestedData[]	= "<div class='btn-group'>
										<a href='".site_url('Utilities/tambah-inventory/'.encode($row->id))."' id='EditInventory' class='btn btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
										<a href='".site_url('Utilities/delete-inventory/'.encode($row->id))."' class='btn btn-danger waves-effect waves-light delete'><i class='fas fa-trash-alt mr-1'></i> Delete</a>
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

	function tambah_inventory($id = false)
	{
		if($id)
		{
			cekoto('utilities/inventory', 'edit', true, false);
		}
		else
		{
			cekoto('utilities/inventory', 'add', true, false);
		}
			// if ($this->input->is_ajax_request()) {
				if($this->input->post())
				{
				// echo json_encode($this->input->post());die;
					$this->form_validation->set_rules('nama','Name Item','required');
					$this->form_validation->set_rules('tanggal_pembelian','purchase date','required');
					$this->form_validation->set_rules('lokasi_id','Location','required');
					$this->form_validation->set_rules('nilai_pembelian','Purchase value','required');
					$this->form_validation->set_rules('numbercoa','Coa Number','required');
					$this->form_validation->set_rules('penyusutan', 'Depreciation','required');
					$this->form_validation->set_rules('nilai_buku','Current Book Value', 'required');
					$this->form_validation->set_rules('acumulation','Acumulation', 'required');
				
				if($this->form_validation->run() == true)
				{
					$insert = array(

						'nama' => $this->input->post('nama'),
						'tanggal_pembelian' => $this->input->post('tanggal_pembelian'),
						'lokasi_id' => $this->input->post('lokasi_id'),
						'nilai_pembelian' => $this->input->post('nilai_pembelian'),
						'numbercoa' => $this->input->post('numbercoa'),
						'penyusutan' => $this->input->post('penyusutan'),
						'nilai_buku' => toFloat($this->input->post('nilai_buku')),
						'acumulation' => toFloat($this->input->post('acumulation')),
				
						);
					if($id)

					{
						$this->global_model->_update('tb_inventory', $insert, ['id' => decode($id)]);
					}
					else
					{
						$inventoryid = $this->global_model->_insert('tb_inventory',$insert);
					}

					if($this->db->affected_rows() > 0) {
						if (!$id) {
							$source = [
								'tb_inventory' => $inventoryid,
							];
							addpayment($source, toFloat($this->input->post('acumulation')), $is_picking = false, $is_other = true, $table = 'tb_inventory', $kategori = 'in', 0, 0, 0);
						}
						echo json_encode(array(
							'status' => 1,
							'pesan' => "Data has been updated."
						));
					}
					else
					{
						echo $this->db->last_query();
						$this->query_error($this->db->last_query());die;
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
					$data['inventory'] = $this->global_model->_row('tb_inventory',['id' => decode($id)])->row();
					// echo json_encode($data['budgeting']);die;
				}
				else
				{
					$data['inventory'] = (object) array(
					'id'  					=> '',
					'nama'  		  		=> '',
					'tanggal_pembelian'     => '',
					'lokasi_id' 	  		=> '',
					'nilai_pembelian' 	  	=> '',
					'numbercoa' 	  		=> '',
					'penyusutan' 			=> '',
					'nilai_buku' 			=> '',
					'acumulation' 			=> '',
				);
				}
			    $data['alias'] = $this->global_model->_get('tb_coa', ['status' => '1']);
			    $data['location'] = $this->global_model->_get('tb_location', ['status' => '1']);
			    // $data['alias'] = $this->db->where('id' BETWEEN '1' and '3');

				$this->load->view('popoti/Utilities/add-inventory',$data);
			}
		// }	
	}

function delete_inventory($id)
	{
		if(cekoto('hrd/delete-achiev', 'delete', false, false)):
			if($this->input->is_ajax_request()):
			$this->global_model->_update('tb_inventory' ,['status' => '0'], ['id' => decode($id)]);
			endif;
		else:
			$this->query_error('Sorry you don\'t have access to delete this data');
		endif;
	}
	function memorandum($id = '')
	{
		cekoto('utilities/memorandum', 'add', true, true);
		$this->data['menuName'] = 'Memorandum';
		if($_POST):
			$this->form_validation->set_rules('no', 'No.', 'required|max_length[100]');
			$this->form_validation->set_rules('tanggal', 'Date', 'required');
			$this->form_validation->set_rules('kategori', 'Category', 'required');
			$this->form_validation->set_rules('amount', 'Amount', 'required');
			$this->form_validation->set_rules('keterangan', 'Description', 'required');

			if($this->form_validation->run() == true):
				$memo = array(
					'no'         => $this->input->post('no'),
					'tanggal'    => $this->input->post('tanggal'),
					'kategori'   => $this->input->post('kategori'),
					'pemohon'    => $this->input->post('pemohon'),
					'amount'     => toFloat($this->input->post('amount')),
					'keterangan' => $this->input->post('keterangan'),
				);

				if($id):
					$this->global_model->_update('tb_memo', $memo, ['id' => decode($id)]);
					$berhasil = 1;
					$memoid = decode($id);
				else:
					$memoid = $this->global_model->_insert('tb_memo', $memo);
					$berhasil  = $this->db->affected_rows();
				endif;

				if($berhasil):
					$kategori = ($this->input->post('kategori') == 4) ? 'in' : 'out';
					updateNo('MEMO');
					addpayment(
						['tb_memo' => $memoid], 
						toFloat($this->input->post('amount')), 
						$is_picking = false, 
						$is_other = true, 
						$table = 'tb_memo', 
						$kategori, 
						0, 
						0, 
						$this->input->post('no')
					);

					echo json_encode([
						'status' => 1,
						'pesan'  => 'Memo has been added',
					]);
				else:
					echo json_encode([
						'status' => 0,
						'pesan'  => 'Failed to insert',
					]);
				endif;
			else:
				echo json_encode([
					'status' => 0,
					'pesan'  => validation_errors(),
				]);
			endif;

		else:
			$this->data['js'][] = base_url('assets/js/pages/form-masks.init.js');
			$this->data['js'][] = base_url('assets/custom/js/memo.js');

			$this->load->templateAdmin('Utilities/memo');
		endif;
	}


	function stationery_stamp()
	{
		cekoto('utilities/stationery-stamp', 'view', true, true);
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

        $this->data['js'][] = base_url('assets/custom/js/utilities.js');

        $this->load->templateAdmin('Utilities/stationery-stamp');
	}

	function stationery_json()
	{
		if($this->input->is_ajax_request())
		{
			$requestData  = $_REQUEST;

			$fetch        = $this->global_model->_retrieve(
				$table        = 'tb_stok',
				$select       = '`id`,	
								`tanggal`,		
								`nama`,	
								`satuan`,	
								`harga_beli`,	
								`stok`,
								`status`',
				$colOrder     = array('tanggal','nama', 'satuan','harga_beli','stok'),
				$filter       = array('tanggal', 'nama','satuan','harga_beli','stok'),
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
				switch ($row->status) {	
					case '0':
						$status = '<span class="badge badge-outline-warning">baik</span>';
						break;
					case '1':
						$status = '<span class="badge badge-outline-danger">Rusak</span>';
						break;
					case '2':
						$status = '<span class="badge badge-outline-success">Jual</span>';
						break;
					
					default:
						// code...
						break;
				}
				$nestedData = array();

				$nestedData[] = $row->tanggal;
				$nestedData[] = $row->nama;
				$nestedData[] = $row->satuan;
				$nestedData[] = 'Rp '.rupiah($row->harga_beli, 2) ;
				$nestedData[] = $row->stok;
				

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

    function add_stationery($id = false)
    {
    		cekoto('utilities/stationery-stamp', 'add', true, false);
    	
		if ($this->input->is_ajax_request()) {
			if($this->input->post())
			{
				// echo json_encode($this->input->post());die;
			$this->form_validation->set_rules('tanggal','Date','required');
			$this->form_validation->set_rules('nama','Name Item','required');
			$this->form_validation->set_rules('satuan','Unit','required');
			$this->form_validation->set_rules('harga_beli','purchase price','required');
			$this->form_validation->set_rules('stok','Stock','required');
				
				if($this->form_validation->run() == true)
				{
				$insert = array(

				'tanggal' => $this->input->post('tanggal'),
				'nama' => $this->input->post('nama'),
				'satuan' => $this->input->post('satuan'),
				'harga_beli' => $this->input->post('harga_beli'),
				'stok' => $this->input->post('stok'),
				
					);
					// print_ar($insert); die
					if($id)

					{
						$this->global_model->_update('tb_stok', $insert, ['id' => decode($id)]);
					}
					else
					{
						$stationeryid = $this->global_model->_insert('tb_stok',$insert);
					}

					if($this->db->affected_rows() > 0) {
						$source = [
									'tb_stok' => $stationeryid,
								];
								
						addpayment($source, toFloat($grandtotal), $is_picking = false, $is_other = true, $table = 'tb_stok', $kategori = 'in', 0, 0, 0);
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
					$data['stationery'] = $this->global_model->_row('tb_stok',['id' => decode($id)])->row();
					// echo json_encode($data['budgeting']);die;
				}
				else
				{
					$data['stationery'] = (object) array(
					'id'  					=> '',
					'tanggal'    			 => '',
					'nama'  		  		=> '',
					'satuan' 	  			=> '',
					'harga_beli' 	  		=> '',
					'stok' 					=> '',
					// 'nilai_buku' 			=> '',
				);
				}
			    // $data['alias'] = $this->global_model->_get('tb_coa', ['status' => '1']);
			    // $data['alias'] = $this->db->where('id' BETWEEN '1' and '3');

				$this->load->view('popoti/Utilities/add-stationery',$data);
			}
		}	
	}		

	function quit_stationery()
	{
		cekoto('utilities/stationery-stamp', 'add', true, false);
		if ($_POST) 
		{
			foreach ($this->input->post('item') as $key => $value) {
				$this->form_validation->set_rules('item['.$key.']', 'Item', 'trim|required');
				$this->form_validation->set_rules('stock['.$key.']', 'Item', 'trim|required');
			}
			if ($this->form_validation->run() == true) {
				$item  = $this->input->post('item');
				$stock = $this->input->post('stock');
				foreach ($item as $key => $value) {
					$this->Utilities_model->useItem($value, $stock[$key]);
				}
				if ($this->db->affected_rows()) {
					echo json_encode(['status' => 1, 'pesan' => 'Item has used']);
				}else{
					$this->query_error("Oops, something happends, please contact developer !");
				}
			} else {
				$this->input_error();
			}
		}else{
			$data['select'] = $this->global_model->_get('tb_stok');
			$this->load->view('popoti/Utilities/quit-stationery',$data);
		}
	}	

	function cash_count()
	{
		cekoto('utilities/cash-count', 'view', true, true);
		if($_POST):
			$jurnal = $this->input->post('jurnal');
			$amount = $this->input->post('cash');

			$detail = array();
			foreach($this->input->post('nominal') as $index => $nominal):
				$detail = [
					'nominal' => $nominal,
					'qty'     => $this->input->post('qty')[$index],
					'amount'  => $this->input->post('amount')[$index],
				];
			endforeach;

			$insert = array(
				'tanggal' => date('Y-m-d'),
				'jurnal'  => $jurnal,
				'amount'  => $amount,
				'detail'  => json_encode($detail)
			);

			$this->global_model->_insert('tb_cash', $insert);

			if($this->db->affected_rows()):
				echo json_encode([
					'status' => 1,
					'pesan' => 'Cash count been saved'
				]);
			endif;
		else:
			$this->data['menuName'] = 'Cash Count';

			$select = 'b.kode, GROUP_CONCAT(DISTINCT b.kode, \' - \', b.nama) coa, GROUP_CONCAT(DISTINCT c.type, \';\', c.nominal) detail, d.normal';

			$tanggal = date('Y-m-d');

			$join = array(
				['tb_coa b', 'a.coaid = b.id', 'left'],
				['tb_jurnal c', 'a.coaid = c.coaid AND c.tanggal = \''.$tanggal.'\'', 'left'],
				['tb_coa_group d', 'b.groupid = d.id', 'left'],
			);

			$data = array(
				'kas' => $this->global_model->_get(
					$table     = 'tb_limit a', 
					$where     = [], 
					$wheren_in = ['a.mod' => ['kas-besar', 'kas-kecil']],
					$or_where  = [],
					$select,
					$join,
					$limit    = false,
					$order_by = false,
					$group_by = 'a.coaid'
				),
			);

			$this->data['js'][] = base_url('assets/custom/js/utilities.js');
			$this->load->templateAdmin('Utilities/cash-count', $data);
		endif;
	}

}

?>
