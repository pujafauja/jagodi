<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Wash Model for all tables
 * By : Puzha Fauzha
 */

class Wash_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function getprices($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL, $categoryid = NULL)
	{
		$sql = "
			SELECT a.id, a.nama, GROUP_CONCAT(CONCAT(b.catid, ':', b.harga)) detail
			FROM 
				`tb_wash_prices` as a
			LEFT JOIN tb_wash_harga b ON a.id = b.wash_id
			WHERE 1=1 
				AND a.`status` = '1' 
		";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();

		if($categoryid)
			$sql .= " AND b.catid = '$categoryid'";
		
		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				a.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}

		$sql .= 'GROUP BY a.nama';
		
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

	function addprices($data)
	{
		$this->db->insert('tb_wash_prices', $data);
	}

	function updateprices($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('tb_wash_prices', $data);
	}

	function rowprices($where)
	{
		$this->db->where($where);
		return $this->db->get('tb_wash_prices');
	}

	function getemploye($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
		{
			
		// $addWhere = ($is_bekas) ? "AND type = 'bekas'" : '';
		$sql = "
			SELECT 
			a.`id`,
			a.`NIK`,
			a.`nama`,
			a.`panggilan`,
			a.`jk`,
			a.`tempat`,
			a.`tglLahir`,
			a.`kebangsaan`,
			a.`noid`,
			a.`alamatKTP`,
			a.`alamat`,
			a.`no`,
			a.`email`,
			a.`merriage`,
			a.`status`,
			a.`subcompanyid`,
			a.`position`,
			a.`bpjs`,
			a.`last_updated`

			FROM 
				`tb_employee` as a
			-- WHERE 1=1 
				-- AND a.`status` = '1' $addWhere
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
			1 => 'a.`nama`',
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