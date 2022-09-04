<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Po_factory Model
 */
class Po_factory_model extends CI_Model
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
		$roots = $this->db->get('tb_pof')->result_array();

		if($id > 0)
			$menus = $roots[0];
		else
			$menus = $roots;

		return $menus;
	}

	function alldetails($pofid) {
		$result = $this->db->where('pofid', $pofid)
						->order_by('id', 'asc')
						->get('tb_pof_detail')
						->result_array();
		return $result;
	}

	function alldiscounts($pofid) {
		$result = $this->db->where('pofid', $pofid)
						->order_by('id', 'asc')
						->get('tb_pof_diskon')
						->result_array();
		return $result;
	}

	function totrows($filter = array()) {
		$rows = $this->get(0, $filter, $hlm = 1, true);
		return count($rows);
	}

	function savingrevisi($datas) {
		$this->db->insert('tb_pof_revisi', $datas);
	}

	function saving($datas) {
		$this->db->insert('tb_pof', $datas);
	}

	function simpandiskon($datas) {
		$this->db->insert('tb_pof_diskon', $datas);
	}

	function update($datas, $id) {
		$this->db->where('id', $id);
		$this->db->update('tb_pof', $datas);
	}

	function savingDetail($datas) {
		$this->db->insert('tb_pof_detail', $datas);
	}

	function updateDetail($datas, $id) {
		$this->db->where('id', $id);
		$this->db->update('tb_pof_detail', $datas);
	}

	function deleteDetail($id) {
		$this->db->where_not_in('id', $id);
		$this->db->delete('tb_pof_detail');
	}

	function deleteitem($pofid, $barangid) {
		$this->db->where(['pofid' => $pofid, 'barangid' => $barangid]);
		$this->db->delete('tb_pof_detail');
	}

	function deleteAllDetail($pofid, $barangid = array()) {
		$this->db->where(
			array(
				'pofid' => $pofid,
			)
		);
		if(count($barangid) > 0)
			$this->db->where_in('barangid', $barangid);
		$this->db->delete('tb_pof_detail');
	}

	function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete('tb_pof');
		$this->db->where('pofid', $id);
		$this->db->delete('tb_pof_detail');
	}

	function hapusdiskon($pofid) {
		$this->db->where('pofid', $pofid)->delete('tb_pof_diskon');
	}

	function hapusrevisi($pofid) {
		$this->db->where('pofid', $pofid)->delete('tb_pof_revisi');
	}
}
?>