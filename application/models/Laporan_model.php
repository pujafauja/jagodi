<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Laporan Model
 */
class Laporan_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function GenerateMutasi($id, $filter = array(), $hlm, $totrows = false)
	{
		if($id)
			$this->db->where('id', $id);

		// filters
		if(count($filter) > 0)
			$this->db->where($filter);

		// pagination
		if(!$totrows) {
			$start = ($hlm - 1) * $this->config->item('itemperpage');
			$this->db->limit($this->config->item('itemperpage'), $start);
		}

		$this->db->order_by('tanggal', 'asc');
		$roots = $this->db->get('tb_mutasi')->result_array();

		if($id > 0)
			$menus = $roots[0];
		else
			$menus = $roots;

		return $menus;
	}
}
?>