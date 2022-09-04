<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Fasilitas Model
 */
class Fasilitas_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function get($id = 0, $filter = array(), $hlm = 1, $totrows = false, $order_by = false, $limit = false)
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

		$this->db->order_by('id', 'desc');
		$roots = $this->db->get('tb_kategori_fasilitas')->result_array();

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
		$this->db->insert('tb_kategori_fasilitas', $datas);
	}

	function update($datas, $id) {
		$this->db->where('id', $id);
		$this->db->update('tb_kategori_fasilitas', $datas);
	}

	function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete('tb_kategori_fasilitas');
	}

	/*
	* list dari kategori
	*/

	function getFasilitas($id = 0, $filter = array(), $hlm = 1, $totrows = false, $order_by = false, $limit = false)
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

		$this->db->order_by('id', 'desc');
		$roots = $this->db->get('tb_fasilitas')->result_array();

		if($id > 0)
			$menus = $roots[0];
		else
			$menus = $roots;

		return $menus;
	}

	function totrowsFasilitas($filter = array()) {
		$rows = $this->getFasilitas(0, $filter, $hlm = 1, true);
		return count($rows);
	}

	function savingFasilitas($datas) {
		$this->db->insert('tb_fasilitas', $datas);
	}

	function updateFasilitas($datas, $id) {
		$this->db->where('id', $id);
		$this->db->update('tb_fasilitas', $datas);
	}

	function deleteFasilitas($id) {
		$this->db->where('id', $id);
		$this->db->delete('tb_fasilitas');
	}
}
?>