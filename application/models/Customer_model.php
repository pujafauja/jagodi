<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Customer Model for all tables
 * By : Puzha Fauzha
 */

class Customer_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function getcat($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
			SELECT 
				a.`id`,
				a.`nama`
			FROM 
				`tb_customer_category` as a
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
		
		if($column_order != null && $column_dir != null && $limit_start != null && $limit_length != null)
		{
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		}
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}

	function addcat($data)
	{
		$this->db->insert('tb_customer_category', $data);
	}

	function updatecat($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('tb_customer_category', $data);
	}

	function rowcat($where)
	{
		$this->db->where($where);
		return $this->db->get('tb_customer_category');
	}

	function getjenis($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
			SELECT 
				a.`id`,
				a.`nama`
			FROM 
				`tb_customer_jenis` as a
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
		
		if($column_order != null && $column_dir != null && $limit_start != null && $limit_length != null)
		{
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		}
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}

	function addjenis($data)
	{
		$this->db->insert('tb_customer_jenis', $data);
	}

	function updatejenis($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('tb_customer_jenis', $data);
	}

	function rowjenis($where)
	{
		$this->db->where($where);
		return $this->db->get('tb_customer_jenis');
	}

	function getmerk($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
			SELECT 
				a.`id`,
				a.`nama`
			FROM 
				`tb_customer_merk` as a
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
		
		if($column_order != null && $column_dir != null && $limit_start != null && $limit_length != null)
		{
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		}
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}

	function addmerk($data)
	{
		$this->db->insert('tb_customer_merk', $data);
	}

	function updatemerk($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('tb_customer_merk', $data);
	}

	function rowmerk($where)
	{
		$this->db->where($where);
		return $this->db->get('tb_customer_merk');
	}

	function gettype($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
			SELECT 
				a.`id`,
				a.`nama`
			FROM 
				`tb_customer_type` as a
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
		
		if($column_order != null && $column_dir != null && $limit_start != null && $limit_length != null)
		{
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		}
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}

	function addtype($data)
	{
		$this->db->insert('tb_customer_type', $data);
	}

	function updatetype($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('tb_customer_type', $data);
	}

	function rowtype($where)
	{
		$this->db->where($where);
		return $this->db->get('tb_customer_type');
	}

	function getwarna($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
			SELECT 
				a.`id`,
				a.`nama`
			FROM 
				`tb_customer_category_unit` as a
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
		
	if($column_order != null && $column_dir != null && $limit_start != null && $limit_length != null)
		{
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		}
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}

	function addwarna($data)
	{
		$this->db->insert('tb_customer_category_unit', $data);
	}

	function updatewarna($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('tb_customer_category_unit', $data);
	}

	function rowwarna($where)
	{
		$this->db->where($where);
		return $this->db->get('tb_customer_category_unit');
	}


	function getunitajax($query)
	{
		$sql = "
			SELECT 
				a.`id`,
				a.`nama`,
				b.`nama` as merk,
				c.`nama` as jenis,
				d.`nama` as category,
				b.`id` as merkid,
				c.`id` as jenisid,
				d.`id` as catid
			FROM 
				`tb_customer_unit` as a
			LEFT JOIN `tb_customer_merk` as b ON a.`merkid` = b.`id`
			LEFT JOIN `tb_customer_jenis` as c ON a.`jenisid` = c.`id`
			LEFT JOIN `tb_customer_category_unit` as d ON a.`warnaid` = d.`id`
			WHERE 1=1 
				AND a.`status` = '1' AND a.nama lIKE '%$query%' 
		";

		return $this->db->query($sql);
	}

	function getunit($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
			SELECT 
				a.`id`,
				a.`nama`,
				b.`nama` as merk,
				c.`nama` as jenis,
				d.`nama` as category,
				b.`id` as merkid,
				c.`id` as jenisid,
				d.`id` as catid
			FROM 
				`tb_customer_unit` as a
			LEFT JOIN `tb_customer_merk` as b ON a.`merkid` = b.`id`
			LEFT JOIN `tb_customer_jenis` as c ON a.`jenisid` = c.`id`
			LEFT JOIN `tb_customer_category_unit` as d ON a.`warnaid` = d.`id`
			WHERE 1=1 
				AND a.`status` = '1' 
		";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();
		
		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				a.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR b.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR c.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR d.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}
		
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'a.`nama`',
			1 => 'b.`nama`',
			2 => 'c.`nama`',
			3 => 'd.`nama`',
		);
		
		if($column_order != NULL && $column_dir != NULL && $limit_start != NULL && $limit_length != NULL)
		{
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		}
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}

	function getcustomers($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
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
				`tb_customer` as a
			LEFT JOIN `dis_desa` as b ON a.desa_id = b.id
			LEFT JOIN `dis_kecamatan` as c ON b.kecamatan_id = c.id
			LEFT JOIN `dis_kota` as d ON c.kota_id = d.id
			WHERE 1=1
		";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();
		
		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				a.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'
				a.`no` LIKE '%".$this->db->escape_like_str($like_value)."%'
				b.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'
				c.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'
				d.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}
		
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'a.`nama`',
			1 => 'a.`no`',
			2 => 'b.`nama`',
			3 => 'a.`last_service`',
		);
		
		if($column_order != null && $column_dir != null && $limit_start != null && $limit_length != null)
		{
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		}
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}

	function getplats($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
			SELECT 
				a.id,
				a.customer_id,
				a.plat,
				a.id as unitid,
				b.id as merkid,
				c.id as jenisid,
				d.id as catid,
				b.nama unit,
				c.nama merk,
				d.nama jenis,
				e.nama kategori
			FROM 
				`tb_customer_vehicles` as a
			LEFT JOIN `tb_customer_unit` as b ON a.unit_id = b.id
			LEFT JOIN `tb_customer_merk` as c ON a.merk_id = c.id
			LEFT JOIN `tb_customer_jenis` as d ON a.jenis_id = d.id
			LEFT JOIN `tb_customer_category_unit` as e ON a.kategori_id = e.id
			WHERE 1=1
		";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();
		
		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				a.`plat` LIKE '%".$this->db->escape_like_str($like_value)."%'
				b.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'
				c.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'
				d.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'
				e.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}
		
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'a.`plat`',
			1 => 'b.`nama`',
			2 => 'c.`nama`',
			3 => 'd.`nama`',
			4 => 'e.`nama`',
		);
		
		if($column_order != null && $column_dir != null && $limit_start != null && $limit_length != null)
		{
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		}
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}

	function addunit($data)
	{
		$this->db->insert('tb_customer_unit', $data);
	}

	function updateunit($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('tb_customer_unit', $data);
	}

	function rowunit($where)
	{
		$this->db->where($where);
		return $this->db->get('tb_customer_unit');
	}
	function platjsonautocomplete($query)
	{
		$this->db->select('a.id, b.id as merkid, c.id as jenisid, d.id as catid, e.id as unitid, b.nama as merk, c.nama as jenis, d.nama as unit, e.nama as cat');
		$this->db->from('tb_customer_vehicles a');
		$this->db->join('tb_customer_merk b', 'a.merk_id = b.id');
		$this->db->join('tb_customer_jenis c', 'a.jenis_id = c.id');
		$this->db->join('tb_customer_category_unit d', 'a.kategori_id = d.id');
		$this->db->join('tb_customer_unit e', 'a.unit_id = e.id');
		$this->db->like('a.plat', $query, 'BOTH');
		return $this->db->get();
	}
}