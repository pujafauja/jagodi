<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Retur Model
 */
class Retur_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function get($id = 0, $filter = array(), $hlm = 1, $totrows = false, $order_by = false, $limit = false, $group_by = false)
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

		if($group_by)
			$this->db->group_by($group_by);

		$this->db->order_by('id', 'desc');
		$roots = $this->db->get('tb_retur')->result_array();

		if($id > 0)
			$menus = $roots[0];
		else
			$menus = $roots;

		return $menus;
	}

	function alldetails($returid) {
		$result = $this->db->where('returid', $returid)
						->order_by('id', 'asc')
						->get('tb_retur_detail')
						->result_array();
		return $result;
	}

	function updateDetail($datas, $id) {
		$this->db->where('id', $id);
		$this->db->update('tb_retur_detail', $datas);
	}

	function deleteDetail($id) {
		$this->db->where_not_in('id', $id);
		$this->db->delete('tb_sj_detail');
	}

	function totrows($filter = array()) {
		$rows = $this->get(0, $filter, $hlm = 1, true);
		return count($rows);
	}

	function saving($datas) {
		$this->db->insert('tb_retur', $datas);
	}

	function update($datas, $id) {
		$this->db->where('id', $id);
		$this->db->update('tb_retur', $datas);
	}

	function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete('tb_retur');
		$this->db->where('returid', $id);
		$this->db->delete('tb_retur_detail');
		$this->db->where('returid', $id);
		$this->db->delete('tb_retur_diskon');
	}

	function deleteitem($returid, $barangid) {
		$this->db->where(['returid' => $returid, 'barangid' => $barangid]);
		$this->db->delete('tb_retur_detail');
	}

	function detailRetur($returid) {
		$result = $this->db->where('returid', $returid)
						->order_by('id', 'asc')
						->get('tb_retur_detail')
						->result_array();
		return $result;
	}

	function alldiscounts($arid) {
		$result = $this->db->where('arid', $arid)
						->order_by('id', 'asc')
						->get('tb_retur_diskon')
						->result_array();
		return $result;
	}

	function savingDetail($datas) {
		$this->db->insert('tb_retur_detail', $datas);
	}

	function simpandiskon($datas) {
		$this->db->insert('tb_retur_diskon', $datas);
	}
}
?>