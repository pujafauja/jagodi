<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Sparepart Model for all tables
 * By : Puzha Fauzha
 */
class Sparepart_model extends CI_Model
{

	public $dbname     = 'tb_sparepart';
	public $dbcategory = 'tb_sparepart_category';
	
	function __construct()
	{
		parent::__construct();
	}

	function detail($id)
	{
		$sql = "
			SELECT 
				a.*,
				b.`nama` as category,
				c.`nama` as merk
			FROM 
				`$this->dbname` as a
			LEFT JOIN `$this->dbcategory` as b ON a.`catid` = b.`id`
			LEFT JOIN `tb_sparepart_merk` as c ON a.`merkid` = c.`id`
			WHERE 1=1 
				AND a.`status` = '1' AND a.id = $id
		";
		return $this->db->query($sql)->row();
	}

	function getsparepart($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL, $is_bekas = false)
	{
		$addWhere = ($is_bekas) ? "AND b.id = 9" : '';
		$sql = "
			SELECT 
				a.`id`,
				a.`kode`,
				a.`nama`,
				a.`harga`,
				a.`discount`,
				a.`program`,
				a.`vat`,
				a.`margin`,
				a.`het`,
				a.`tanggal`,
				b.`nama` as category,
				c.`nama` as merk
			FROM 
				`$this->dbname` as a
			LEFT JOIN `$this->dbcategory` as b ON a.`catid` = b.`id`
			LEFT JOIN `tb_sparepart_merk` as c ON a.`merkid` = c.`id`
			WHERE 1=1 
				AND a.`status` = '1' $addWhere
		";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();
		
		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				a.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR a.`harga` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR b.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR c.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}
		
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'a.`kode`',
			1 => 'b.`nama`',
			2 => 'a.`nama`',
			3 => 'a.`harga`',
			4 => 'a.`hpp_baru`',
			5 => 'a.`hpp_average`',
			6 => 'a.`het`',
			7 => 'a.`het1`',
			8 => 'a.`margin1`',
			9 => 'a.`het2`',
			10 => 'a.`margin2`',
			11 => 'a.`het3`',
			12 => 'a.`margin3`',
			13 => 'a.`grosir`',
			14 => 'a.`margin_grosir`',
			15 => 'a.`tanggal`',
		);
		
		if($column_order != null && $column_dir != null && $limit_start != null && $limit_length != null)
		{
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		}
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}

	function getabcdata($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
			SELECT 
				a.`id`,
				a.`code`,
				a.`logical`,
				a.`weeks`,
				a.`amount`,
				a.`upper`,
				a.`lower`,
				a.`roq`
			FROM 
				`tb_abc` as a
			WHERE 1=1 
				AND a.`status` = '1' 
		";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();
		
		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				a.`code` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR a.`logical` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR a.`weeks` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR a.`amount` LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}
		
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'a.`code`',
			1 => 'a.`logical`',
			2 => 'a.`weeks`',
			3 => 'a.`amount`',
		);
		
		if($column_order != NULL && $column_dir != NULL && $limit_start != NULL && $limit_length != NULL)
		{
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		}
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}

	function addsparepart($data)
	{
		$this->db->insert($this->dbname, $data);
	}

	function updatesparepart($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update($this->dbname, $data);
	}

	function rowsparepart($where)
	{
		$this->db->where($where);
		return $this->db->get($this->dbname);
	}

	function getsupplier($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
			SELECT 
				a.`id`,
				a.`kode`,
				a.`nama`,
				a.`alamat`,
				a.`tlp`,
				a.`fax`,
				a.`attn`,
				a.`bank`,
				a.`rek`,
				a.`alias`,
				b.`nama` as cat
			FROM 
				`tb_supplier` as a
			LEFT JOIN `tb_supplier_cat` b ON a.`catid` = b.`id`
			WHERE 1=1 
				AND a.`status` = '1' 
		";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();
		
		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				a.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR a.`alamat` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR a.`tlp` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR a.`fax` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR a.`attn` LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}
		
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'a.`nama`',
			1 => 'a.`alamat`',
			2 => 'a.`tlp`',
			3 => 'a.`fax`',
			4 => 'a.`attn`',
		);
		
		if($column_order && $column_dir && $limit_start && $limit_length)
		{
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		}
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}

	function addsupplier($data)
	{
		$this->db->insert('tb_supplier', $data);
	}

	function updatesupplier($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('tb_supplier', $data);
	}

	function rowsupplier($where)
	{
		$this->db->where($where);
		return $this->db->get('tb_supplier');
	}

	function getlocation($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
			SELECT 
				a.`id`,
				a.`nama`,
				a.`max`,
				(SELECT nama FROM tb_location WHERE id = a.parentid) as parent
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
				OR `parent` LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}
		
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'a.`nama`',
			1 => '`parent`',
			2 => 'a.`max`',
		);
		
		if($column_order != null && $column_dir != null && $limit_start != null && $limit_length != null)
		{
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		}
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}

	function addlocation($data)
	{
		$this->db->insert('tb_location', $data);
	}

	function updatelocation($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('tb_location', $data);
	}

	function rowlocation($where)
	{
		$this->db->where($where);
		return $this->db->get('tb_location');
	}

	function getpenjualan($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
			SELECT 
				a.`id`,
				a.`partid`,
				a.`nominal`,
				a.`start`,
				a.`end`,
				b.`kode` as kode_part,
				b.`nama` as part
			FROM 
				`tb_special_rates` as a
			LEFT JOIN `tb_sparepart` as b ON a.`partid` = b.`id`
			WHERE 1=1 
				AND a.`status` = '1' 
		";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();
		
		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				b.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR a.`nominal` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR a.`start` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR a.`end` LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}
		
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'b.`nama`',
			1 => 'a.`nominal`',
			2 => 'a.`start`',
			3 => 'a.`end`',
		);
		
		if($column_order != NULL && $column_dir != NULL && $limit_start != NULL && $limit_length != NULL)
		{
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		}
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}

	function addpenjualan($data)
	{
		$this->db->insert('tb_special_rates', $data);
	}

	function updatepenjualan($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('tb_special_rates', $data);
	}

	function rowpenjualan($where)
	{
		$this->db->select('a.*, CONCAT(b.kode, " ", b.nama) as part');
		$this->db->from('tb_special_rates a');
		$this->db->join('tb_sparepart b', 'a.partid = b.id', 'left');
		$this->db->where($where);
		return $this->db->get();
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
		if($column_order != null && $column_dir != null && $limit_start != null && $limit_length != null)
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

	function getmerk($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
			SELECT 
				a.`id`,
				a.`nama`
			FROM 
				`tb_sparepart_merk` as a
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
		
		if($column_order != null && $column_dir !=null && $limit_start !=null && $limit_length !=null)
		{
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		}
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}

	function addmerk($data)
	{
		$this->db->insert('tb_sparepart_merk', $data);
	}

	function updatemerk($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('tb_sparepart_merk', $data);
	}

	function rowmerk($where)
	{
		$this->db->where($where);
		return $this->db->get('tb_sparepart_merk');
	}

	// sparepat-budgeting_model

	function getbudgeting($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
			SELECT 
			a.`id`,
			a.`categori_id`,	
			a.`month`,	
			a.`budgeting`,
			b.`nama` as category	
			FROM 
				`tb_budgeting` a
			LEFT JOIN `tb_sparepart_category` b ON a.`categori_id` = b.`id`
			WHERE 1=1 
				AND a.`status` = 1 
		";
		$data['totalData'] = $this->db->query($sql)->num_rows();
		if( ! empty($like_value))
		{

			$sql .= " AND ( ";    
			$sql .= "
				a.`categori_id` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR a.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		$columns_order_by = array( 

			0 => 'a.`categori_id`',
			1 => 'b.`month`',

		);

		if($column_order != null && $column_dir != null && $limit_start != null && $limit_length != null)
		{
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";

		}
		$data['query'] = $this->db->query($sql);
		return $data;

	}

	function deletebudgeting($id)
	{
		$this->db->update('tb_budgeting', ['status' => 0], ['id' => $id]);
	}
	function addbudgeting($data)
	{
		$this->db->insert('tb_budgeting', $data);
	}

	function updatebudgeting($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('tb_budgeting', $data);
	}

	function rowbudgeting($where)
	{
		$this->db->where($where);
		return $this->db->get('tb_budgeting');
	}

	function getbudgetingcategory($id)

	{

		$this->db->select('a.*, b.category ');

		$this->db->from('tb_budgeting a');

		$this->db->join('tb_sparepart_category b', 'a.categori_id = b.id', 'left');

		return $this->db->get()->result();

	}

		function gettradein($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL, $is_bekas = false)
		{
			
		$addWhere = ($is_bekas) ? "AND type = 'bekas'" : '';
		$sql = "
			SELECT 
				a.`id`,
				a.`kode`,
				a.`nama`,
				a.`harga`,
				a.`discount`,
				a.`program`,
				a.`vat`,
				a.`margin`,
				a.`het`,
				a.`tanggal`,
				b.`nama` as category,
				c.`nama` as merk
			FROM 
				`$this->dbname` as a
			LEFT JOIN `$this->dbcategory` as b ON a.`catid` = b.`id`
			LEFT JOIN `tb_sparepart_merk` as c ON a.`merkid` = c.`id`
			WHERE 1=1 
				AND a.`status` = '1' $addWhere
		";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();
		
		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				a.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR a.`harga` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR b.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR c.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}
		
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'a.`kode`',
			1 => 'a.`nama`',
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

	function getpurchase($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL, $status= NULL)
	{

		$where = '';
		if($status != NULL){
			$where .= ($status != 'All') ? 'AND a.status = \''.$status.'\'' : ''; 
		}

		$sql = "
			SELECT 
				a.`id`,	
				a.`no`,	
				a.`order_date`,	
				a.`delivery_plan`,	
				a.`memo`,	
				a.`from`,	
				a.`status`,
				b.`nama` as supplierid
			FROM 
				`tb_order` as a
				LEFT JOIN `tb_supplier` as b ON a.`supplierid` = b.`id`
			WHERE 1=1 
				AND a.`status` = '1'
		";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();
		
		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				a.`no` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR a.`order_date` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR b.`supplierid` LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}
		
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'a.`no`',
			1 => 'b.`order_date`',
		);
		
		if($column_order != null && $column_dir != null && $limit_start != null && $limit_length != null)
		{
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		}
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}

		function getpurchasecancel($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL, $status= NULL)
	{

		$where = '';
		if($status != NULL){
			$where .= ($status != 'All') ? 'AND a.status = \''.$status.'\'' : ''; 
		}

		$sql = "
			SELECT 
				a.`id`,	
				a.`no`,	
				a.`order_date`,	
				a.`delivery_plan`,	
				a.`memo`,	
				a.`from`,	
				a.`status`,
				b.`nama` as supplierid
			FROM 
				`tb_order` as a
				LEFT JOIN `tb_supplier` as b ON a.`supplierid` = b.`id`
			WHERE 0=0 
				AND a.`status` = '0'
		";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();
		
		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				a.`no` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR a.`order_date` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR b.`supplierid` LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}
		
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'a.`no`',
			1 => 'b.`order_date`',
		);
		
		if($column_order != null && $column_dir != null && $limit_start != null && $limit_length != null)
		{
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		}
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}
}



?>