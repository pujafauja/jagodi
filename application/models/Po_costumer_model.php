<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Po_costumer Model
 */
class Po_costumer_model extends CI_Model
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
		$roots = $this->db->get('tb_poc')->result_array();

		if($id > 0)
			$menus = $roots[0];
		else
			$menus = $roots;

		return $menus;
	}

	function getDetails($id = 0, $filter = array(), $hlm = 1, $totrows = false, $order_by = false, $limit = false, $group_by = false)
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
		$roots = $this->db->get('tb_poc_detail')->result_array();

		if($id > 0)
			$menus = $roots[0];
		else
			$menus = $roots;

		return $menus;
	}

	function alldetails($pocid) {
		$result = $this->db->where('pocid', $pocid)
						->order_by('id', 'asc')
						->get('tb_poc_detail')
						->result_array();
		return $result;
	}

	function alldiscounts($pocid) {
		$result = $this->db->where('pocid', $pocid)
						->order_by('id', 'asc')
						->get('tb_poc_diskon')
						->result_array();
		return $result;
	}

	function totrows($filter = array()) {
		$rows = $this->get(0, $filter, $hlm = 1, true);
		return count($rows);
	}

	function savingrevisi($datas) {
		$this->db->insert('tb_poc_revisi', $datas);
	}

	function saving($datas) {
		$this->db->insert('tb_poc', $datas);
	}

	function simpandiskon($datas) {
		$this->db->insert('tb_poc_diskon', $datas);
	}

	function update($datas, $id) {
		$this->db->where('id', $id);
		$this->db->update('tb_poc', $datas);
	}

	function savingDetail($datas) {
		$this->db->insert('tb_poc_detail', $datas);
	}

	function updateDetail($datas, $id) {
		$this->db->where('id', $id);
		$this->db->update('tb_poc_detail', $datas);
	}

	function deleteDetail($id) {
		$this->db->where_not_in('id', $id);
		$this->db->delete('tb_poc_detail');
	}

	function deleteitem($pocid, $barangid) {
		$this->db->where(['pocid' => $pocid, 'barangid' => $barangid]);
		$this->db->delete('tb_poc_detail');
	}

	function deleteAllDetail($pocid, $barangid = array()) {
		$this->db->where(
			array(
				'pocid' => $pocid,
			)
		);
		if(count($barangid) > 0)
			$this->db->where_in('barangid', $barangid);
		$this->db->delete('tb_poc_detail');
	}

	function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete('tb_poc');
		$this->db->where('pocid', $id);
		$this->db->delete('tb_poc_detail');
	}

	function hapusdiskon($pocid) {
		$this->db->where('pocid', $pocid)->delete('tb_poc_diskon');
	}
}
?>