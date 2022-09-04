<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Barang Model
 */
class Barang_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function get($id = 0, $filter = array(), $hlm = 1, $totrows = false, $order_by = false, $limit = false, $group_by = false, $find = '')
	{
		if($id)
			$this->db->where('id', $id);

		// filters
		if(count($filter) > 0)
			$this->db->where($filter);

		if($find) {
			$this->db->where("FIND_IN_SET('". $find[0] . "',".$find[1].")");
		}

		// pagination
		if(!$totrows) {
			$start = ($hlm - 1) * $this->config->item('itemperpage');
			$this->db->limit($this->config->item('itemperpage'), $start);
		}

		if($group_by)
			$this->db->group_by($group_by);

		$this->db->order_by('id', 'desc');
		$roots = $this->db->get('tb_barang')->result_array();

		if($id > 0)
			$menus = $roots[0];
		else
			$menus = $roots;

		return $menus;
	}

	function totrows($filter = array()) {
		$rows = $this->get(0, $filter, $hlm = 1, true);
		return count($rows);
	}

	function saving($datas) {
		$this->db->insert('tb_barang', $datas);
	}

	function update($datas, $id) {
		$this->db->where('id', $id);
		$this->db->update('tb_barang', $datas);
	}

	function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete('tb_barang');
	}
}
?>