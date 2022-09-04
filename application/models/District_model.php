<?php
/**
 * District Model
 */
class District_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}	

	function fetchkota($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
			SELECT 
				a.`id`,
				a.`provinsi_id`,
				a.`name`,
				b.`name` as provinsi
			FROM 
				`dis_kota` as a
			LEFT JOIN dis_provinsi as b ON a.provinsi_id = b.id
			WHERE 1=1 
		";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();
		
		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				a.`name` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR b.`name` LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}
		
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => '`provinsi`',
			1 => 'a.`name`',
		);
		
		if($column_order != NULL && $column_dir != NULL && $limit_start != NULL && $limit_length != NULL)
		{
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		}
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}

	function fetchkecamatan($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
			SELECT 
				a.`id`,
				a.`kota_id`,
				a.`name`,
				b.`name` as kota,
				c.`name` as provinsi
			FROM 
				`dis_kecamatan` as a
			LEFT JOIN dis_kota as b ON a.kota_id = b.id
			LEFT JOIN dis_provinsi as c ON b.provinsi_id = c.id
			WHERE 1=1 
		";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();
		
		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				a.`name` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR b.`name` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR c.`name` LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}
		
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => '`provinsi`',
			1 => '`kota`',
			2 => 'a.`name`',
		);
		
		if($column_order != NULL && $column_dir != NULL && $limit_start != NULL && $limit_length != NULL)
		{
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		}
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}

	function fetchdesa($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
			SELECT 
				a.`id`,
				a.`name`,
				b.`name` as kecamatan,
				c.`name` as kota,
				d.`name` as provinsi
			FROM 
				`dis_desa` as a
			LEFT JOIN dis_kecamatan as b ON a.kecamatan_id = b.id
			LEFT JOIN dis_kota as c ON b.kota_id = c.id
			LEFT JOIN dis_provinsi as d ON c.provinsi_id = d.id
			WHERE 1=1 
		";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();
		
		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				a.`name` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR b.`name` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR c.`name` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR d.`name` LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}
		
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => '`provinsi`',
			1 => '`kota`',
			2 => '`kecamatan`',
			3 => 'a.`name`',
		);
		
		if($column_order != NULL && $column_dir != NULL && $limit_start != NULL && $limit_length != NULL)
		{
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		}
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}
}
?>