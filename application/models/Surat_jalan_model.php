<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Surat_jalan Model
 */
class Surat_jalan_model extends CI_Model
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
		
		if($order_by || is_array($order_by))
			$this->db->order_by($order_by);
		else
			$this->db->order_by('id', 'desc');

		$roots = $this->db->get('tb_sj')->result_array();

		if($id > 0)
			$menus = $roots[0];
		else
			$menus = $roots;

		return $menus;
	}

	function alldetails($sjid) {
		$result = $this->db->where('sjid', $sjid)
						->order_by('id', 'asc')
						->get('tb_sj_detail')
						->result_array();
		return $result;
	}

	function alldiscounts($sjid) {
		$result = $this->db->where('sjid', $sjid)
						->order_by('id', 'asc')
						->get('tb_sj_diskon')
						->result_array();
		return $result;
	}

	function totrows($filter = array()) {
		$rows = $this->get(0, $filter, $hlm = 1, true);
		return count($rows);
	}

	function savingrevisi($datas) {
		$this->db->insert('tb_sj_revisi', $datas);
	}

	function saving($datas) {
		$this->db->insert('tb_sj', $datas);
	}

	function simpandiskon($datas) {
		$this->db->insert('tb_sj_diskon', $datas);
	}

	function update($datas, $id) {
		$this->db->where('id', $id);
		$this->db->update('tb_sj', $datas);
	}

	function savingDetail($datas) {
		$this->db->insert('tb_sj_detail', $datas);
	}

	function updateDetail($datas, $id) {
		$this->db->where('id', $id);
		$this->db->update('tb_sj_detail', $datas);
	}

	function deleteDetail($id) {
		$this->db->where_not_in('id', $id);
		$this->db->delete('tb_sj_detail');
	}

	function deleteitem($sjid, $barangid) {
		$this->db->where(['sjid' => $sjid, 'barangid' => $barangid]);
		$this->db->delete('tb_sj_detail');
	}

	function deleteAllDetail($sjid, $barangid = array()) {
		$this->db->where(
			array(
				'sjid' => $sjid,
			)
		);
		if(count($barangid) > 0)
			$this->db->where_in('barangid', $barangid);
		$this->db->delete('tb_sj_detail');
	}

	function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete('tb_sj');
		$this->db->where('sjid', $id);
		$this->db->delete('tb_sj_detail');
	}

	function hapusdiskon($sjid) {
		$this->db->where('sjid', $sjid)->delete('tb_sj_diskon');
	}
}
?>