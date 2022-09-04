<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Cafe Model for all tables
 * By : Puzha Fauzha
 */

class Cafe_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function getprices($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
			SELECT 
				a.`id`,
				a.`kode_barang`,
				a.`nama`,
				a.`harga_beli`,
				a.`harga`,
				a.`tanggal`
			FROM 
				`tb_cafe_prices` as a
			WHERE 1=1 
				AND a.`status` = '1' 
		";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();
		
		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				a.`kode_barang` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR a.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR a.`harga` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR a.`harga_beli` LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}
		
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'a.`kode_barang`',
			1 => 'b.`nama`',
		);
		
		if($column_order != null && $column_dir != null && $limit_start != null && $limit_length != null)
		{
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		}
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}

	function addprices($data)
	{
		$this->db->insert('tb_cafe_prices', $data);
	}

	function updateprices($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('tb_cafe_prices', $data);
	}

	function rowprices($where)
	{
		$this->db->where($where);
		return $this->db->get('tb_cafe_prices');
	}

		function getfoods($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
			SELECT 
				a.`id`,
				a.`nama`,
				a.`harga`
			FROM 
				`tb_cafe_prices` as a
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
			";
			$sql .= " ) ";
		}
		
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'a.`nama`',
			2 => 'a.`harga`',
		);
		
		if($column_order && $column_dir && $limit_start && $limit_length)
		{
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		}
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}
}