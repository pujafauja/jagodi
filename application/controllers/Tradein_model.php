<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Sparepart Model for all tables
 * By : Puzha Fauzha
 */
class Tradein_model extends CI_Model
{

	public $dbname     = 'tb_sparepart';
	public $dbcategory = 'tb_sparepart_category';
	
	function __construct()
	{
		parent::__construct();
	}
		function gettradein($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL,$is_bekas = true)
	{
		$addWhere = ($is_bekas) ? "AND catid = 9" : '';

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
				AND a.`status` = '1' 
		";
		
		$sql .= $addWhere;
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
		function addtradein($data)
	{
		$this->db->insert($this->dbname, $data);
	}

	function updatetradein($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update($this->dbname, $data);
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

	function gettradein2($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		{
		$sql = "
			SELECT 
			a.`id`,
			a.`nota`,	
			a.`tanggal`,
			a.`userid`,	
			a.`vehicleid`,	
			a.`detail`,	
			a.`sparepartid`,	
			a.`subtotal`,	
			a.`grandtotal`,	
			a.`harga_beli`,	
			a.`harga_jasa`,	
			a.`hpp`,	
			a.`harga_jual`,	
			a.`qty_barang`,	
			a.`qty_labor`,	
			a.`status_pengerjaan`,
			a.`status_stock`
			FROM 
				`tb_tradein` as a
			WHERE 1=1 
				AND a.`status` = '1' 
		";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();
		
		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				`nota` LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}
		
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'a.`nota`',
		);
		
		if($column_order != null && $column_dir !=null && $limit_start !=null && $limit_length !=null)
		{
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		}
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}
	}
}
?>