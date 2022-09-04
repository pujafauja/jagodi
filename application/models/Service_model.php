<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Service Model for all tables
 * By : Puzha Fauzha
 */
class Service_model extends CI_Model
{

	public $dbjasa     = 'tb_jasa';
	public $dbgroup    = 'tb_jasa_group';
	public $dbcategory = 'tb_service_category';
	
	function __construct()
	{
		parent::__construct();
	}

	function getdistrict($data){
		return $this->db->select('a.*, b.name desa, c.name kecamatan, d.name kota, b.id as desa_id')
			->from('tb_customer a')
			->join('dis_desa b', 'a.desa_id = b.id', 'left')
			->join('dis_kecamatan c', 'b.kecamatan_id = c.id', 'left')
			->join('dis_kota d', 'c.kota_id = d.id', 'left')
			->like('no' , "$data")
			->limit(10)
			->get();
	}
	function getgroupservice($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
			SELECT 
				a.`id`,
				a.`nama`
			FROM 
				`tb_jasa_group` as a
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
		
		if($column_order && $column_dir && $limit_start && $limit_length)
		{
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		}
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}
	function getpartsjson($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL, $islocation, $cat = false)
	{
		$where = '';
		if ($cat) {
			$where = "AND catid = '$cat'";
		}	
		if ($islocation) {
			$sql = "
				SELECT 
					a.`id`,
					a.`nama`,
					a.`harga`,
					a.`kode`
				FROM 
					`tb_sparepart` as a
				WHERE 1=1 
					AND a.`status` = '1' $where
			";
		}else{
			$sql = "SELECT a.*, IFNULL(SUM(b.qty), 0) stock
			from tb_sparepart a
			LEFT JOIN tb_sparepart_location b on b.sparepartid = a.id
			WHERE 1 AND a.status = '1' $where
			GROUP BY a.id HAVING stock > 0";
		}
		
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
	function getjasa($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL, $groupid = NULL)
	{
		$sql = "
			SELECT 
				a.`id`,
				a.`nama`,
				a.`harga`,
				b.`nama` as category
			FROM 
				`$this->dbjasa` as a
			LEFT JOIN `$this->dbcategory` as b ON a.`catid` = b.`id`
			WHERE 1=1 
				AND a.`status` = '1' 
		";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();
		
		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				a.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR a.`harga` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR `category` LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}

		if( $groupid != NULL )
		{
			$sql .= " AND a.groupid = '$groupid'";
		}
		
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'a.`nama`',
			1 => '`category`',
			2 => 'b.`harga`',
		);
		
		if($column_order && $column_dir && $limit_start && $limit_length)
		{
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		}
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}

	function getgroup($groupid = NULL)
	{
		if($groupid)
			$this->db->where('id', $groupid);
		return $this->db->get($this->dbgroup);
	}

	function addjasa($data)
	{
		$this->db->insert($this->dbjasa, $data);
	}

	function deleteharga($jasaid)
	{
		$this->db->where('jasaid', $jasaid);
		$this->db->delete('tb_jasa_harga');
	}

	function addharga($data)
	{
		$this->db->insert('tb_jasa_harga', $data);
	}

	function updatejasa($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update($this->dbjasa, $data);
	}

	function rowjasa($where)
	{
		$this->db->where($where);
		return $this->db->get($this->dbjasa);
	}

	function addgroup($data)
	{
		$this->db->insert($this->dbgroup, $data);
	}

	function updategroup($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update($this->dbgroup, $data);
	}

	function rowgroup($where)
	{
		$this->db->where($where);
		return $this->db->get($this->dbgroup);
	}

	function getcategory($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
			SELECT 
				a.`id`,
				a.`nama`
			FROM 
				`$this->dbcategory` as a
			WHERE 1=1 
				AND a.`status` = '1' 
		";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();
		
		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}
		
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'a.`nama`',
		);
		
		if($column_order && $column_dir && $limit_start && $limit_length)
		{
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		}
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}

	function addcategory($data)
	{
		$this->db->insert($this->dbcategory, $data);
	}

	function updatecategory($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update($this->dbcategory, $data);
	}

	function rowcategory($where)
	{
		$this->db->where($where);
		return $this->db->get($this->dbcategory);
	}

	function getpackage($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
			SELECT 
				a.`id`,
				a.`nama`,
				a.`detail`,
				a.`harga`
			FROM 
				`tb_service_package` as a
			WHERE 1=1 
				AND a.`status` = '1' 
		";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();
		
		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}
		
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'a.`nama`',
		);
		
		if($column_order != null && $column_dir != null && $limit_start != null && $limit_length != null)
		{
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		}
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}

	function addpackage($data)
	{
		$this->db->insert('tb_service_package', $data);
	}

	function updatepackage($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('tb_service_package', $data);
	}

	function rowpackage($where)
	{
		$this->db->where($where);
		return $this->db->get('tb_service_package');
	}

	function getpackagejson($where, $categoryid)
	{
		$items = [];
		$index = 0;
		foreach ($this->db->like('nama', $where, 'BOTH')->get('tb_jasa_group')->result() as $key => $value) {
			// echo print_ar($this->db->last_query());
			
			$jasa = $this->db->select('a.id, a.nama, b.harga')->from('tb_jasa a')
				->join('tb_jasa_harga b', 'a.id = b.jasaid and b.categoryid = \''.$categoryid.'\'')->where(['groupid' => $value->id, 'a.status' => '1'])->get();
			$items[$index]['id'] = $value->id;
			$items[$index]['value'] = $value->nama;
			$items[$index]['row'] = $jasa->num_rows();
			$items[$index]['query'] = $this->db->last_query();
			$items[$index]['detail'] = $jasa->result_array();
			$index++;

		}

		return $items;
		
	}
	function getpackagejsonfrommodal($where, $categoryid)
	{
		$items = [];
		$value = $this->db->where('id', $where)->get('tb_jasa_group')->row_array();
		$jasa = $this->db->select('a.id, a.nama, b.harga')->from('tb_jasa a')
			->join('tb_jasa_harga b', 'a.id = b.jasaid and b.categoryid = \''.$categoryid.'\'')->where(['groupid' => $value['id'], 'a.status' => '1'])->get();
		$items['id'] = $value['id'];
		$items['value'] = $value['nama'];
		$items['row'] = $jasa->num_rows();
		$items['query'] = $this->db->last_query();
		$items['detail'] = $jasa->result_array();


		return $items;
		
	}
	function incretotalcome($cus_id, $data)
	{
		$jum_lama = $this->db->get_where('tb_customer', ['id' => $cus_id])->row_array()['total_come'];
		$update = array_merge($data, ['total_come' => $jum_lama + 1, 'last_service' => date('Y-m-d H:s:i')]);
		$this->db->update('tb_customer', $update, ['id' => $cus_id]);
	}

	function addservice($service, $item, $harga ,$qty, $disc, $type, $service_id)
	{
		if ($type === 'item') {
			$jumlah = 0;	
			foreach ($service as $vse) {
				$detail = [];
				foreach ($item as $kit => $vit) {
					if (array_key_exists($vse, $vit)) {
				 		$vit = $vit[$vse];
				 		$hasil = (($qty[$vit] * $harga[$vit]) - toFloat($disc[$vit]) );
				 		$jumlah += $hasil;
				 		$detail[] = ['itemid' => $vit, 'harga' => $harga[$vit],'disc' => toFloat($disc[$vit]), 'qty' => $qty[$vit], 'selling_price' => $hasil];
					}
				}
			 	$data = [
			 		'groupid' => $vse,
			 		'service_id' => $service_id,
			 		'jasaharga' => json_encode($detail),
			 		'type' => 'item'
			 	];
			 	$this->db->insert('tb_job_detail', $data);
			}
		 	return $jumlah;	
		}else{
			$jumlah = 0;	
			foreach ($service as $value) {
				$hasil = (($qty[$value] * $harga[$value]) - toFloat($disc[$value]) );
				$jumlah += $hasil;
				$data = [
			 		'groupid' => 0,
			 		'service_id' => $service_id,
			 		'jasaharga' => json_encode(['itemid' => $value, 'harga' => $harga[$value], 'qty' => $qty[$value], 'disc' => toFloat($disc[$value]), 'selling_price' => $hasil]),
			 		'type'  => 'package'
			 	];
			 	$this->db->insert('tb_job_detail', $data);
			}
		 	return $jumlah;	

		}

	}

	function addparts($parts, $harga, $qty, $disc, $cus_id, $service_id = '', $pickingqty = false)
	{
		$jumlah = 0;
		foreach ($parts as $it) {
			// print_ar($harga[$it]);
			// print_ar($disc);
			// print_ar($disc);
			$hasil = (( (($pickingqty[$it]) ? $pickingqty[$it] : $qty[$it]) * $harga[$it]) - toFloat($disc[$it]) );

			$data = [
				'service_id'	=> $service_id,
				'sparepart_id' => $it,
				'het' => $harga[$it],
				'qty' => $qty[$it],
				'disc' => toFloat($disc[$it]),
				'onhandqty' => '',
				'pickingqty' => ($pickingqty) ? $pickingqty[$it] : 0,
				'status' => 0,
				'customer_id' => $cus_id
			];
			// print_ar($qty);
			// print_ar($pickingqty);
			// print_ar($data);
			$jumlah += $hasil;

		 	$this->db->insert('tb_service_parts', $data);

		}
		// print_ar($this->db->last_query());
		return $jumlah;
	}
	function increenoservice()
	{
		$noawal = $this->db->order_by('id', 'desc')->get('tb_service');
		if ($noawal->num_rows() > 0) {
			$noawal = $noawal->row_array()['no'];
			return sprint_f(4, intval($noawal) + 1);
		}else{
			return '00001';
		}
	}
	function deleteservice($id)
	{
		$this->db->delete('tb_job_detail', ['service_id' => $id]);
		$this->db->delete('tb_service_parts', ['service_id' => $id]);
	}
	function selectservice($id)
	{
		$data = [];

		$data['company'] = $this->db->get('pp_settings')->row_array();
		
		$service = $this->db->select('a.id,c.no as no_hp, c.id as customer_id, d.nama as employee, a.no as no_service, a.date, b.plat, c.nama as customer, c.desa_id, e.nama as unit, a.employee_id')
					->join('tb_customer_vehicles b', 'a.vehicle_id = b.id', 'left')
					->join('tb_customer c', 'a.customer_id = c.id', 'left')
					->join('tb_employee d', 'a.employee_id = d.id', 'left')
					->join('tb_customer_unit e', 'b.unit_id = e.id', 'left')
					->where('a.id', $id)
					->get('tb_service a')->row_array();

		$data['service'] = array_merge($service, ['alamat' => $this->getalamat($service['desa_id'], $service['customer_id'])]);
		// return print_ar($data['service']);
		$job = $this->db->select('a.id, b.nama as group, a.jasaharga')->join('tb_jasa_group b', 'b.id = a.groupid')
						->get_where('tb_job_detail a', ['a.service_id' => $id, 'type' => 'item'])->result_array();
		$data['pesanan']['item'] = $job;

		$data['pesanan']['package'] = $this->db->get_where('tb_job_detail a', ['a.service_id' => $id, 'type' => 'package'])->result_array();	
		
		$data['pesanan']['part'] = $this->db->select('a.*, b.nama as sparepart, b.kode')->join('tb_sparepart b', 'a.sparepart_id = b.id')
									->get_where('tb_service_parts a', ['service_id' => $id])->result_array();

		return $data;
	}

	function getalamat($id, $cus_id)
	{
		$sql = "
			SELECT 
				a.`id`,
				a.`nama`,
				a.`no`,
				a.`total_come`,
				a.`desa_id`,
				a.`last_service`, b.name desa, c.name kecamatan, d.name kota
			FROM 
				`tb_customer` a
			LEFT JOIN `dis_desa` as b ON a.desa_id = b.id
			LEFT JOIN `dis_kecamatan` as c ON b.kecamatan_id = c.id
			LEFT JOIN `dis_kota` as d ON c.kota_id = d.id
			WHERE a.desa_id = $id AND a.id = $cus_id
		";
		$row = $this->db->query($sql)->row();
		return "$row->desa - $row->kecamatan - $row->kota";
	}

	function gettotalpart($service_id)
	{
		$data = $this->db->get_where('tb_service_parts', ['service_id' => $service_id]);
		$jmlh = 0;
		foreach($data->result() as $item){
			$jmlh += (($item->pickingqty * $item->harga) - ( ($item->disc / 100) * ($item->pickingqty * $item->harga))) ;
		}
		return $jmlh;
	}


	function summary_data_json($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL,$status =null, $tanggal1 = null, $tanggal2 = null)
	{
		$cancel = '';
		$where = '';
		if($status != NULL){
			if($status == 'cancel'){
				$cancel = 'AND a.is_cancel = 1';
			}
			else{
				$where .= ($status != 'All') ? 'AND a.status = \''.$status.'\'' : ''; 
				$cancel = ($status != 'All') ? 'AND a.is_cancel = 0' : '';
			}
		}
		$now = date('Y-m-d');

		if($tanggal1 != NULL && $tanggal2 != NULL)		
			$where .= " AND LEFT(a.date, 10) BETWEEN '".$tanggal1."' AND '".$tanggal2."'";
		else
			$where .= " AND LEFT(a.date, 10) = '$now'";

		$sql = "
			SELECT 
				a.id,
				a.no,
				a.`date`,
				a.status,c.nama as customer,
				a.type,
				a.is_cancel,
				IFNULL(d.status, 0) as paid,
				GROUP_CONCAT(DISTINCT b.jasaharga, ';') detail,
				(SELECT GROUP_CONCAT(het,'-',concat(qty,'-',disc)) FROM tb_service_parts where service_id = a.id) parts
			FROM tb_service a
			LEFT JOIN tb_job_detail b ON a.id = b.service_id
			LEFT JOIN tb_customer c ON a.customer_id = c.id
			LEFT JOIN tb_payments d ON a.id = JSON_EXTRACT(source, '$.tb_service')
				WHERE 1=1 $cancel $where
			GROUP BY a.no
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
	function getuserservice($service_id, $type)
	{

		$addcolumn = ($type == 'service') ? ',f.id as vehicle_id, f.plat,g.id as unitid, h.id as merkid, i.id as jenisid, j.id as catid, g.nama unit, h.nama merk, i.nama jenis, j.nama kategori' : ' ';

		$this->db->select("a.id, a.customer_id,z.id as employee_id, z.nama as employee, b.last_service, b.total_come, b.desa_id, b.nama as customer, b.no as no_hp, CONCAT_WS(' - ',c.name, d.name, e.name) as district $addcolumn")
				->from('tb_service a')
				->join('tb_customer b', 'a.customer_id = b.id', 'left')
				->join('dis_desa c', 'b.desa_id = c.id', 'left')
				->join('dis_kecamatan d', 'c.kecamatan_id = d.id', 'left')
				->join('tb_employee z', 'a.employee_id = z.id', 'left')
				->join('dis_kota e', 'd.kota_id = e.id', 'left');

		if ($type == 'service') {
			$this->db->join('tb_customer_vehicles f', 'f.customer_id = b.id', 'left')
						->join('tb_customer_unit g', 'f.unit_id = g.id', 'left')
						->join('tb_customer_merk h', 'f.merk_id = h.id', 'left')
						->join('tb_customer_jenis i', 'f.jenis_id = i.id', 'left')
						->join('tb_customer_category_unit j', 'f.kategori_id = j.id', 'left');
		}

		return $this->db->where('a.id', $service_id)->get()->row_array();
	}

	function getservicejasa($service_id)
	{
		$this->db->select('a.*, b.nama as group, a.jasaharga');
		$query = $this->db->from('tb_job_detail a')
					->join('tb_jasa_group b', 'a.groupid = b.id', 'left');

		$result = [];	
		foreach($query->where(['a.service_id' => $service_id, 'type' => 'item'])->get()->result() as $item){
			if ($item->jasaharga) {
				$pecah = explode(';,', $item->jasaharga);
				$jumlah = 0;
				$nesteditem = [];
				foreach($pecah as $det)
				{
					$det = str_replace(';', '', $det);
					$jumrow = json_decode($det);
					$nesteditem = $jumrow;
				}

				$item->detail = $nesteditem;
				$result['item'][] = $item;
			}else{
				$result['item'] = false;
			}
		}

		$this->db->select('a.id, b.nama as group, a.jasaharga');
		$query = $this->db->from('tb_job_detail a')
					->join('tb_jasa_group b', 'a.groupid = b.id', 'left');

		foreach ($query->where(['a.service_id' => $service_id, 'type' => 'package'])->get()->result() as $value) {
			if ($value) {
				$value->detail = json_decode($value->jasaharga);
				$result['package'][] = $value;
			}else{
				$result['package'] = false;
			}
		}

		return $result;

	}
	function getservicepart($service_id)
	{
		$this->db->select('a.* ,b.nama, b.kode');
		$this->db->from('tb_service_parts a');
		$this->db->join('tb_sparepart b', 'a.sparepart_id = b.id', 'left');
		$this->db->where('service_id', $service_id);
		$data = $this->db->get();
		if ($data->num_rows()){
			$return = []; 
			foreach ($data->result() as $value) {
				$value->onhandqty = $this->db->select('sum(qty) as onhandqty')->get_where('tb_sparepart_location', ['sparepartid' => $value->id])->row()->onhandqty;
			    $return[] = $value;
			}
			return $return;
		}
		else
			return false;
	}
	function getdetailpackage($id)
	{
		$detail = $this->db->get_where('tb_service_package', ['id' => $id])->row()->detail;
		$jasa = '';
		foreach(json_decode($detail) as $jasaid)
		{
			$jasa = sql_get_var('tb_jasa', 'nama', ['id' => $jasaid]).', '.$jasa;
		}
		return $jasa;
	}


}

?>