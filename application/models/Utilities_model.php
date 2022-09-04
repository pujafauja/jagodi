<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Sparepart Model for all tables
 * By : Puzha Fauzha
 */
class Utilities_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function useItem($id, $qty)
	{
		$this->db->query("update tb_stok set stok = stok - $qty where id = $id");
	}

	function getinventory($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
			SELECT 
				a.`id`,	
				a.`nama`,	
				a.`tanggal_pembelian`,	
				a.`keterangan_barang`,	
				a.`lokasi`,	
				a.`nilai_pembelian`,	
				a.`penyusutan`,	
				a.`nilai_buku`
			FROM 
				`tb_inventory` as a
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

}
?>