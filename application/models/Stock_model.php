<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Stock_model extends CI_Model {

	public function confirm_gap($locationid, $type, $amount, $employeeid, $grandtotal, $coaid, $supply)
	{
		// Kurangi Stock
		$stockAwal = $this->db->get_where('tb_actual_stock', ['locationid' => $locationid, 'tanggal' => date('Y-m-d')])->result();
		foreach ($stockAwal as $value) {
			$where = ['locationid' => $locationid, 'sparepartid' => $value->sparepartid];
		    $qtyAwal = $this->db->get_where('tb_sparepart_location', $where)->row();
		    $this->db->update('tb_sparepart_location', ['qty' => $value->actualQty], $where);	
			// mutasi kan barangnya
			$where['qty'] = $value->actualQty;	
			$where['waktu'] = date('Y-m-d H:s:i');	
			$where['type'] = 'out';
			$where['source'] = json_encode(['tb_actual_stock' => $value->id]);
			$where['terjual'] = '1';
			$this->db->insert('tb_sparepart_mutasi', $where);
		}

		// Itung Cost
		foreach ($type as $key => $value) {
			if ($value == 'biaya') {
				$data = [
					'tanggal' => date('Y-m-d'),
					'coaid'   => $coaid[$key],
					'type'    => 'dr',
					'nominal' => toFloat($amount[$key]),
					'source' => json_encode(['tb_actual_stock' => '']) 
				];
				$this->db->insert('tb_jurnal', $data);
			}else{
				$data = [
					'no' => getNoFormat('AR'),
					'amount' => toFloat($amount[$key]),
					'tanggal' => date('Y-m-d'),
				];
				$this->db->insert('tb_ar', $data);

			}
		}
		$data = [
			'tanggal' => date('Y-m-d'),
			'coaid'   => $supply,
			'type'    => 'cr',
			'nominal' => $grandtotal,
			'source' => json_encode(['tb_actual_stock' => '']) 
		];
		$this->db->insert('tb_jurnal',$data);

		$this->db->update('tb_actual_stock', ['status' => '1'], ['tanggal' => date('Y-m-d'), 'locationid' => $locationid]);
	}

	public function supply()
	{
		return $this->db->query("SELECT a.*
			FROM tb_coa a
			LEFT JOIN tb_coa_group b ON a.groupid = b.id
			WHERE b.kode LIKE '1%'")->result();
	}
	public function sales()
	{
		return $this->db->query("SELECT a.*
			FROM tb_coa a
			LEFT JOIN tb_coa_group b ON a.groupid = b.id
			WHERE b.kode LIKE '4%'")->result();
	}

	public function exist()
	{
		return $this->db->query('select * from tb_location where freeze = \'1\' and last_opname = \''.date('Y-m-d').'\'')->num_rows();
	}
	public function exist_location($id)
	{
		return $this->db->query('select * from tb_actual_stock where status = \'1\' or (locationid = '.decode($id).' and  tanggal = \''.date('Y-m-d').'\' )')->num_rows();
	}
	function getactual()
	{
		$location = $this->db->get_where('tb_location', ['freeze' => '1', 'last_opname' => date('Y-m-d')])->result();
		foreach ($location as $key => $value) {
			$location[$key]->totalItems = $this->db->get_where('tb_sparepart_location', ['locationid' => $value->id])->num_rows();
			$location[$key]->has = $this->db->get_where('tb_actual_stock', ['locationid' => $value->id, 'tanggal' => date('Y-m-d')])->num_rows();

		}
		return $location;
	}
	public function getgapnow()
	{
		$location = $this->db->get_where('tb_location', ['freeze' => '1', 'last_opname' => date('Y-m-d')])->result();
		$data = [];
		foreach ($location as $key => $value) {
			$row = $this->db->select('
							a.*,a.tanggal,
							c.nama as location, 
							sum(a.qty) as currentQty, 
							sum(a.actualQty) as newQty, 
							(sum(a.qty)-sum(a.actualQty)) as margin, 
							((sum(a.qty)-sum(a.actualQty)) * b.harga) as total
						')
						->join('tb_sparepart b', 'a.sparepartid = b.id')
						->join('tb_location c', 'a.locationid = c.id')
						->get_where('tb_actual_stock a', ['a.status' => '0', 'a.tanggal' => date('Y-m-d'), 'locationid' => $value->id]); 
			// print_ar($row->row());
			
			if ($row->row()->id) {
				$data[] = $row->row();
			}
		}
		return $data;
	}
	public function add_actual($sparepartid = [], $locationid, $id, $actual = [])
	{
		$data = [];
		foreach ($id as $key => $value) {
			$where = ['sparepartid' => decode($sparepartid[$value])];
			$row = $this->db->get_where('tb_sparepart_location', ['id' => decode($value)])->row();
			$qty = $row->qty;
			$where['qty'] = $qty;
			$where['locationid'] = $locationid;
			$where['actualQty'] = $actual[$value];
			$where['tanggal'] = date('Y-m-d');
			$where['status'] = '0';
			$data[] = $where;
		}
		// print_ar($data);die;
		$this->global_model->_insert_batch('tb_actual_stock', $data);
	}
	public function input_actual_action($input, $actual, $locationid)
	{
		$key = explode('-', $input);
		$sparepartid = decode($key[0]);
		$locationid = decode($key[1]);
		$qty = decode($key[2]);
		$data = ['sparepartid' => $sparepartid, 'locationid' => $locationid, 'tanggal' => date('Y-m-d')];
		$exist = $this->global_model->_get('tb_actual_stock', $data);
		if ($exist->num_rows()) {
			$row = $exist->row();
			$this->db->update('tb_actual_stock', ['actualQty' => $actual], ['id' => $row->id]);
		}else{
			if($qty > $actual){
				$data['qty'] = $qty;
				$data['actualQty'] = $actual;
				$this->db->insert('tb_actual_stock', $data);
				return ['status' => 2];
			}else{
				return ['status' => 1];
			}
		}
	}



	public function getservicepicking($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL, $status = null, $tanggal1 = null, $tanggal2 = null)
	{
		$where = '';

		if($status != NULL AND $status != 'all'){
			if($status == 'active'){
				$where .= ' AND a.useridpicking > 0';
			}else{
				$where .= ' AND a.useridpicking = 0';
			}
		}else if($status == null){
			$where .= ' AND a.useridpicking = 0';
		}

		if($tanggal1 != NULL && $tanggal2 != NULL)		
			$where .= " AND LEFT(a.date, 10) BETWEEN '".$tanggal1."' AND '".$tanggal2."'";
		else
			$where .= " AND MONTH(a.date) = '" . date('m') . "' AND YEAR(a.date) = '" . date('Y') . "'";

		$sql = "
			SELECT DISTINCT a.id, a.no, a.`date`, a.status,c.nama as customer, d.nama as employee, a.type, b.service_id, (SELECT COUNT(id) FROM tb_service_parts WHERE service_id = a.id) total
			FROM tb_service a
			LEFT JOIN tb_service_parts b ON a.id = b.service_id
			LEFT JOIN tb_customer c ON a.customer_id = c.id
			LEFT JOIN tb_employee d ON a.useridpicking = d.id
				WHERE 1=1 AND a.is_cancel = 0 AND (SELECT COUNT(id) FROM tb_service_parts WHERE service_id = a.id) > 0 $where
		";

		

		$data['totalData'] = $this->db->query($sql)->num_rows();

		

		if( ! empty($like_value))

		{

			$sql .= " AND ( ";    

			$sql .= "

				c.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'

			";

			$sql .= " ) ";

		}

		

		$data['totalFiltered']	= $this->db->query($sql)->num_rows();

		

		$columns_order_by = array( 

			0 => 'a.`date`',

			1 => 'a.`no`',

			2 => 'c.`nama`',

		);

		

		if($column_order != null && $column_dir != null && $limit_start != null && $limit_length != null)

		{

			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;

			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";

		}

		

		$data['query'] = $this->db->query($sql);

		return $data;

	}

	public function getpickingjson($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)

	{

		$sql = "

			SELECT DISTINCT a.id, a.no, a.`date`, a.status,c.nama as customer, d.nama as employee, a.type, b.service_id, (SELECT COUNT(id) FROM tb_service_parts WHERE service_id = a.id) total

			FROM tb_service a

			LEFT JOIN tb_service_parts b ON a.id = b.service_id

			LEFT JOIN tb_customer c ON a.customer_id = c.id

			LEFT JOIN tb_employee d ON a.useridpicking = d.id

				WHERE 1=1 AND a.is_cancel = 0 AND (SELECT COUNT(id) FROM tb_service_parts WHERE service_id = a.id) > 0

		";

		

		$data['totalData'] = $this->db->query($sql)->num_rows();

		

		if( ! empty($like_value))

		{

			$sql .= " AND ( ";    

			$sql .= "

				c.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'

			";

			$sql .= " ) ";

		}

		

		$data['totalFiltered']	= $this->db->query($sql)->num_rows();

		

		$columns_order_by = array( 

			0 => 'a.`date`',

			1 => 'a.`no`',

			2 => 'c.`nama`',

		);

		

		if($column_order != null && $column_dir != null && $limit_start != null && $limit_length != null)

		{

			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;

			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";

		}

		

		$data['query'] = $this->db->query($sql);

		return $data;

	}

	function getgaprow($id, $date)

	{

		$this->db->select('a.id as actualid, c.nama as sparepart, c.het, a.locationid, a.qty, a.actualQty, a.tanggal,(a.qty - a.actualQty) as margin , b.nama as location, ((a.qty - a.actualQty) * c.het) as subtotal');

		$this->db->from('tb_actual_stock a');

		$this->db->join('tb_location b', 'a.locationid = b.id', 'left');

		$this->db->join('tb_sparepart c', 'a.sparepartid = c.id', 'left');

		$this->db->where(['a.locationid' => decode($id), 'a.tanggal' => $date]);

		return $this->db->get();

	}

	public function getgapjson($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)

	{

		$sql = "

			select a.id, b.tanggal, a.nama as location,  b.id as actualid,(b.qty - b.actualQty) as margin, count(b.id) as totalitem 

			from tb_location a

			left join tb_actual_stock b on b.locationid = a.id

			left join tb_sparepart c on b.sparepartid = c.id

			where b.tanggal = '".date('Y-m-d')."' and b.status = '0'

		";

		

		$data['totalData'] = $this->db->query($sql)->num_rows();

		

		if( ! empty($like_value))

		{

			$sql .= " AND ( ";    

			$sql .= "

				c.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'

			";

			$sql .= " ) ";

		}

		

		$data['totalFiltered']	= $this->db->query($sql)->num_rows();

		

		$columns_order_by = array( 

			0 => 'b.`tanggal`',

			1 => 'a.`nama`',

			2 => 'count(b.id)',

		);

		

		if($column_order != null && $column_dir != null && $limit_start != null && $limit_length != null)

		{

			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;

			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";

		}

		

		$data['query'] = $this->db->query($sql);

		return $data;

	}

	function detailpicking($service_id)

	{

		$this->db->select('a.*,b.nama, c.id as slid, b.kode, b.het, d.nama as location, e.useridpicking, c.qty as stock');

		$this->db->from('tb_service_parts a');

		$this->db->join('tb_sparepart b', 'a.sparepart_id = b.id', 'left');

		$this->db->join('tb_sparepart_location c', 'c.sparepartid = a.sparepart_id', 'right');

		$this->db->join('tb_location d', 'd.id = c.locationid', 'left');

		$this->db->join('tb_service e', 'e.id = a.service_id', 'left');

		$this->db->where('service_id', $service_id);

		$data = $this->db->get();

		if ($data->num_rows()) 

			return $data->result();

		else

			return false;

	}



	function mutasi_approve($id)

	{

		$this->db->select('a.id, a.sparepart_id, b.locationid, a.pickingqty');

		$this->db->join('tb_sparepart_location b', 'a.sparepart_id = b.sparepartid', 'left');

		$this->db->join('tb_location c', 'b.sparepartid = c.id', 'left');

		$service = $this->db->get_where('tb_service_parts a', ['service_id' => $id])->result();

		foreach ($service as $key => $se) {

			$this->db->insert('tb_sparepart_mutasi', [

				'waktu'       => date('Y-m-d H:s:i'),

				'sparepartid' => $se->sparepart_id,

				'locationid'  => $se->locationid,

				'type'        => 'out',

				'qty'         => $se->pickingqty,

				'source'      => json_encode(['tb_service_parts' => $se->id]),
				'terjual'	  => '1'

			]);

		}

	} 



	function getlocation($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)

	{

		$sql = "

			SELECT *

			FROM 

				`tb_location` as a

			WHERE 1=1 

				AND a.`status` = '1'

		";

		

		$data['totalData'] = $this->db->query($sql)->num_rows();

		

		if( ! empty($like_value))

		{

			$sql .= " AND ( ";    

			$sql .= "

				a.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'

			";

			$sql .= " ) ";

		}

		

		$data['totalFiltered']	= $this->db->query($sql)->num_rows();

		

		$columns_order_by = array( 

			0 => 'a.`nama`',


		);

		

		if($column_order != NULL && $column_dir != NULL && $limit_start != NULL && $limit_length != NULL)

		{

			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;

			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";

		}

		

		$data['query'] = $this->db->query($sql);

		return $data;

	}



	function retrieveDataLocation($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL, $sparepartid = 0, $locationid = 0)

	{

		$sql = "

			SELECT a.id, a.qty, b.id sparepartid, b.kode, b.nama, c.nama as location, a.qty, b.het

			FROM 

				tb_sparepart_location a

			LEFT JOIN tb_sparepart b ON a.sparepartid = b.id

			LEFT JOIN tb_location c ON a.locationid = c.id

			WHERE 1=1 

		";



		if($sparepartid)

			$sql .= " AND b.id = $sparepartid";

		if($locationid)

			$sql .= " AND c.id = $locationid";

		

		$data['totalData'] = $this->db->query($sql)->num_rows();

		

		if( ! empty($like_value))

		{

			$sql .= " AND ( ";    

			$sql .= "

				b.`kode` LIKE '%".$this->db->escape_like_str($like_value)."%'

				OR b.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'

				OR c.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'

			";

			$sql .= " ) ";

		}

		

		$data['totalFiltered']	= $this->db->query($sql)->num_rows();

		

		$columns_order_by = array( 

			0 => 'b.`kode`',

			1 => 'b.`nama`',

			2 => 'c.`nama`',

			3 => 'a.`qty`',

		);

		

		if($column_order != NULL && $column_dir != NULL && $limit_start != NULL && $limit_length)

		{

			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;

			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";

		}

		

		$data['query'] = $this->db->query($sql);

		return $data;

	}

	function transferlocation($id, $sisaQty, $toLocation, $qty)

	{

		if($sisaQty < 1){

			$this->db->delete('tb_sparepart_location', ['id' => decode($id[0])]);

		}

		else{

			$this->db->update('tb_sparepart_location', ['qty' => $sisaQty] ,['id' => decode($id[0])]);

		}



		$newLocation = $this->db->get_where('tb_sparepart_location', ['locationid' => $toLocation, 'sparepartid' => decode($id[1])]);

		// print_r($newLocation->row()->qty + $qty);

		if ($newLocation->num_rows()) {

			$row = $newLocation->row();

			$this->db->update('tb_sparepart_location', ['qty' => $row->qty + $qty ], ['id' => $row->id ]);			

			// echo "update id=$toLocation qty=$newQty";

		}else{

			$this->db->insert('tb_sparepart_location', ['sparepartid' => decode($id[1]), 'locationid' => decode($id[1]), 'qty' => $qty ] );

		}

	}



	function getsparepartlocation($id)

	{

		$this->db->select('a.qty, a.locationid, a.sparepartid');

		$this->db->from('tb_sparepart_location a');

		$this->db->join('tb_location b', 'a.locationid = b.id', 'left');

		$this->db->join('tb_sparepart c', 'a.sparepartid = c.id', 'left');

		$this->db->where('a.id', $id);

		return $this->db->get()->row();

	}



	function getsummaryrecieve($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL, $status, $tanggal1, $tanggal2)

	{

		$cancel = '';

		$where = '';

		if($status != NULL){

			$where .= ($status != 'All') ? 'AND a.status = \''.$status.'\'' : ''; 

		}



		if($tanggal1 != NULL && $tanggal2 != NULL)		

			$where .= " AND LEFT(a.tanggal, 10) BETWEEN '".$tanggal1."' AND '".$tanggal2."'";

		else

			$where .= " AND MONTH(a.tanggal) = '" . date('m') . "' AND YEAR(a.tanggal) = '" . date('Y') . "'";



		$sql = "

			SELECT a.*, b.USE_NAMA user

			FROM 

				tb_receive a

			LEFT JOIN tb_user b ON a.receive_by = b.USE_ID

			WHERE 1=1 $where

		";



		

		$data['totalData'] = $this->db->query($sql)->num_rows();

		

		if( ! empty($like_value))

		{

			$sql .= " AND ( ";    

			$sql .= "

				a.`tanggal` LIKE '%".$this->db->escape_like_str($like_value)."%'

				OR a.`no` LIKE '%".$this->db->escape_like_str($like_value)."%'

			";

			$sql .= " ) ";

		}

		

		$data['totalFiltered']	= $this->db->query($sql)->num_rows();

		

		$columns_order_by = array( 

			0 => 'a.`no`',

			1 => 'a.`tanggal`',

		);

		

		if($column_order && $column_dir && $limit_start && $limit_length)

		{

			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;

			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";

		}

		

		$data['query'] = $this->db->query($sql);

		return $data;

	}

	function getsummaryorder($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL, $status, $tanggal1, $tanggal2)

	{

		$cancel = '';

		$where = '';

		if($status != NULL){

			$where .= ($status != 'All') ? 'AND a.status = \''.$status.'\'' : ''; 

		}



		if($tanggal1 != NULL && $tanggal2 != NULL)		

			$where .= " AND LEFT(a.order_date, 10) BETWEEN '".$tanggal1."' AND '".$tanggal2."'";

		else

			$where .= " AND MONTH(a.order_date) = '" . date('m') . "' AND YEAR(a.order_date) = '" . date('Y') . "'";

		$sql = "

			SELECT a.*, b.USE_NAMA user, c.code, d.nama as supplier

			FROM 

				tb_order a

			LEFT JOIN tb_user b ON a.order_by = b.USE_ID
			LEFT JOIN tb_abc c ON a.abcid = c.id
			LEFT JOIN tb_supplier d ON a.supplierid = d.id

			WHERE 1=1 $where

		";



		

		$data['totalData'] = $this->db->query($sql)->num_rows();

		

		if( ! empty($like_value))

		{

			$sql .= " AND ( ";    

			$sql .= "

				a.`order_date` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR a.`no` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR a.`no` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR d.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR a.`from` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR a.`status` LIKE '%".$this->db->escape_like_str($like_value)."%'

			";

			$sql .= " ) ";

		}

		

		$data['totalFiltered']	= $this->db->query($sql)->num_rows();

		

		$columns_order_by = array( 

			0 => 'a.`order_date`',
			1 => 'a.`no`',
			2 => 'd.`nama`',
			3 => 'a.`from`',
			4 => 'a.`delivery_plan`',
			5 => 'a.`status`',

		);

		

		if($column_order && $column_dir && $limit_start && $limit_length)

		{

			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;

			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";

		}

		

		$data['query'] = $this->db->query($sql);

		return $data;

	}


	function approve_summary($id)

	{

		$row = $this->db->get_where('tb_receive', ['id' => $id])->row();

		$detail = json_decode($row->detail);

		$data = [];

		foreach ($detail as $key => $value) {

			$rowData = [

				'locationid'  => $value->locationid,

				'sparepartid' => $value->sparepartid

			];

			$hasData = $this->db->get_where('tb_sparepart_location', $rowData);

			if ($hasData->num_rows() > 0) {

				$has = $hasData->row();

				$this->db->update('tb_sparepart_location', ['qty' => $has->qty + $value->qty], ['id' => $has->id]);

			}else{

				$rowData['qty'] = $value->qty;

				$this->db->insert('tb_sparepart_location', $rowData);

			}

		}

		$this->db->update('tb_receive', ['status' => '1'], ['id' => $id]);

	}

	function getdetailreceive($data)

	{

		$poid       = $this->input->post('poid');

		$qty        = $this->input->post('qty');

		$price      = $this->input->post('price');

		$locationid = $this->input->post('locationid');
		$sparepartid = $this->input->post('sparepartid');

		$data = [];

		$orderid = null;

		foreach($sparepartid as $keypoid => $valuepoid){

			$key = 0;
			foreach ($sparepartid[$keypoid] as $keyspar => $valuespar) {

				$hpp_baru = intval(toFloat($price[$keypoid][$valuespar])); 

				$query = 'update tb_sparepart set hpp_baru = '.$hpp_baru.', hpp_average = (harga + hpp_baru) / 2 where id = '.$valuespar;
				
				$this->db->query($query);
				
				$whereExist = ['locationid' => $locationid[$keypoid][$valuespar], 'sparepartid' => $valuespar ];
				$exist = $this->db->get_where('tb_sparepart_location', $whereExist);
				if ($exist->num_rows()) {
					$row = $exist->row();
					$this->db->update('tb_sparepart_location', ['qty' => $row->qty + $qty ], ['id' => $row->id ]);			
				}else{
					$whereExist['qty'] = $qty[$keypoid][$valuespar];
					$this->db->insert('tb_sparepart_location', $whereExist );
				}
				
				$orderid = $keypoid;
				$data[] = [

					'orderid'     => $keypoid, 

					'sparepartid' => $valuespar, 

					'qty'         => $qty[$keypoid][$valuespar], 

					'price'       => $price[$keypoid][$valuespar], 

					'locationid'  => $locationid[$keypoid][$valuespar]

				];
				$key++;
			}
		}

			$this->global_model->_update('tb_order', ['status' => '2'], ['id' => $orderid]);





		return json_encode($data);



	}

	function getdatasummaryedit($id)

	{

		$row = $this->db->get_where('tb_receive a', ['a.id' => $id])->row();

		$row->detail = json_decode($row->detail);

		$row->location = $this->db->get('tb_location')->result();

		foreach ($row->detail as $key => $value) {

			$this->db->select('a.*, b.code as abc');

			$this->db->from('tb_order a');

			$this->db->join('tb_abc b', 'a.abcid = b.id', 'left');

			$this->db->where(['a.id' => $value->orderid]);


			$row->detail[$key]->detail = $this->db->get()->row();

			$sparepart = $this->db->get_where('tb_sparepart', ['id' => $value->sparepartid])->row();
			
			$row->detail[$key]->detail->abcid = $sparepart->abcid;

			$row->detail[$key]->detail->abc = sql_get_var('tb_abc', 'code', ['id' => $sparepart->abcid] );

			$row->detail[$key]->nama = $sparepart->nama;

			$row->detail[$key]->kode = $sparepart->kode;

			$row->detail[$key]->detail->detail = json_decode($row->detail[$key]->detail->detail);

			$detail = $row->detail[$key]->detail->detail;
			foreach ($detail as $k => $v) {

				if ($v->sparepartid == $value->sparepartid) 

					$row->detail[$key]->detail->detail = $v;				

			}

		}
		return $row;

	}

	function getallfromlocation($type ,$id)

	{

		$where = ($type == 'location') ? 'locationid' : 'sparepartid';

 		$this->db->select('a.*, b.nama as sparepart ,c.nama as location, b.kode');

		$this->db->from('tb_sparepart_location a');

		$this->db->join('tb_sparepart b', 'a.sparepartid = b.id', 'left');

		$this->db->join('tb_location c', 'a.locationid = c.id', 'left');

		$this->db->where([ $where => $id]);

		$row = $this->db->get()->result();

		$data['row'] = $row;

		$data['select'] = $this->db->get('tb_location')->result();

		return $data;

	}

	function findsparepartlocation($id)

	{

		$this->db->select('a.id, a.kode, a.nama as sparepart, c.id as sparepartid, c.nama as location');

		$this->db->from('tb_sparepart a');

		$this->db->join('tb_sparepart_location b', 'a.id = b.sparepartid', 'left');

		$this->db->join('tb_location c', 'c.id = b.locationid', 'left');

		$this->db->where('a.id', $id);

		$data['data'] = $this->db->get()->row();

		$data['select'] = $this->db->get('tb_location')->result();

		return $data;

	}



	function add_beginning($sparepart, $location, $qty)

	{



		foreach ($sparepart as $sparepartid) {

		    foreach ($location[$sparepartid] as $key => $locationid) {

		        $exist = $this->db->get_where('tb_sparepart_location', ['sparepartid' => $sparepartid , 'locationid' => $locationid]);

		        if ($exist->num_rows()) {

		        	$row = $exist->row();

		        	$this->db->update('tb_sparepart_location', ['qty' => $row->qty + $qty[$sparepartid][$key]], ['id' => $row->id] );

		        }else{

		        	$this->db->insert('tb_sparepart_location', ['sparepartid' => $sparepartid, 'locationid' => $locationid, 'qty' => $qty[$sparepartid][$key]]);

		        }

		    }

		}



	}



	function new_transaction($sparepartLocationCurrent, $location, $qty)

	{

		foreach ($sparepartLocationCurrent as $value) {

			$rowCurrent = $this->db->get_where('tb_sparepart_location', ['id' => $value])->row();

			$sparepartid = $rowCurrent->sparepartid;

			$qtyCurrent = $rowCurrent->qty;  

			foreach ($location[$value] as $key => $locationid) {

				$where = ['locationid' => $locationid, 'sparepartid' => $sparepartid];

			    $hasData = $this->db->get_where('tb_sparepart_location', $where);

			    if ($hasData->num_rows()) {

			    	$newData = $hasData->row();

			    	$update['qty'] = $newData->qty + $qty[$value][$key];

			    	$this->db->update('tb_sparepart_location', $update, ['id' => $newData->id]);

			    	$update['sparepartid'] = $newData->sparepartid;
			    	$update['locationid'] = $newData->locationid;
			    	$update['qty'] = $qty[$value][$key];
			    	$update['type'] = 'in';
			    	$update['waktu'] = date('Y-m-d H:s:i');
			    	// print_ar($this->db->last_query());
			    	// echo "update";
			    	$update['source'] = json_encode(['tb_sparepart_location' => $newData->id]);
			    	$this->db->insert('tb_sparepart_mutasi', $where);


			    }else{

			    	$where['qty'] = $qty[$value][$key];
			    	$id = $this->global_model->_insert('tb_sparepart_location', $where);
			    	// print_ar($this->db->last_query());
			    	// echo "add";
			    	// echo $id;
			    	$where['waktu'] = date('Y-m-d H:s:i');
			    	$where['type'] = 'in';
			    	$where['source'] = json_encode(['tb_sparepart_location' => $id]);
			    	$this->db->insert('tb_sparepart_mutasi', $where);

			    }


			    $this->db->update('tb_sparepart_location', ['qty' => $qtyCurrent - $qty[$value][$key] ], ['id' => $value]);
			    $data = [
			    	'waktu' => date('Y-m-d H:s:i'),
			    	'sparepartid' => $rowCurrent->sparepartid,
			    	'locationid'  => $rowCurrent->locationid,
			    	'type'		  => 'out',
			    	'qty'         => $qty[$value][$key],
			    	'source'      => json_encode(['tb_sparepart_location' => $value])
			    ];
			}

		}

	}


}



/* End of file Stock_model.php */

/* Location: ./application/models/Stock_model.php */