<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Penerimaan Model
 */
class Penerimaan_model extends CI_Model
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
		$roots = $this->db->get('tb_penerimaan')->result_array();

		if($id > 0)
			$menus = $roots[0];
		else
			$menus = $roots;

		return $menus;
	}

	function alldetails($penerimaanid) {
		$result = $this->db->where('penerimaanid', $penerimaanid)
						->order_by('id', 'asc')
						->get('tb_penerimaan_detail')
						->result_array();
		return $result;
	}

	function alldiscounts($penerimaanid) {
		$result = $this->db->where('penerimaanid', $penerimaanid)
						->order_by('id', 'asc')
						->get('tb_penerimaan_diskon')
						->result_array();
		return $result;
	}

	function totrows($filter = array()) {
		$rows = $this->get(0, $filter, $hlm = 1, true);
		return count($rows);
	}

	function savingrevisi($datas) {
		$this->db->insert('tb_penerimaan_revisi', $datas);
	}

	function saving($datas) {
		$this->db->insert('tb_penerimaan', $datas);
	}

	function simpandiskon($datas) {
		$this->db->insert('tb_penerimaan_diskon', $datas);
	}

	function update($datas, $id) {
		$this->db->where('id', $id);
		$this->db->update('tb_penerimaan', $datas);
	}

	function savingDetail($datas) {
		$this->db->insert('tb_penerimaan_detail', $datas);
	}

	function updateDetail($datas, $id) {
		$this->db->where('id', $id);
		$this->db->update('tb_penerimaan_detail', $datas);
	}

	function deleteDetail($id) {
		$this->db->where_not_in('id', $id);
		$this->db->delete('tb_penerimaan_detail');
	}

	function deleteitem($penerimaanid, $barangid) {
		$this->db->where(['penerimaanid' => $penerimaanid, 'barangid' => $barangid]);
		$this->db->delete('tb_penerimaan_detail');
	}

	function deleteAllDetail($penerimaanid, $barangid = array()) {
		$this->db->where(
			array(
				'penerimaanid' => $penerimaanid,
			)
		);
		if(count($barangid) > 0)
			$this->db->where_in('barangid', $barangid);
		$this->db->delete('tb_penerimaan_detail');
	}

	function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete('tb_penerimaan');
		$this->db->where('penerimaanid', $id);
		$this->db->delete('tb_penerimaan_detail');
	}

	function hapusdiskon($penerimaanid) {
		$this->db->where('penerimaanid', $penerimaanid)->delete('tb_penerimaan_diskon');
	}
}
?>