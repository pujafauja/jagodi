<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Nota_retur Model
 */
class Nota_retur_model extends CI_Model
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
		$roots = $this->db->get('tb_nota_retur')->result_array();

		if($id > 0)
			$menus = $roots[0];
		else
			$menus = $roots;

		return $menus;
	}

	function getPayments($id = 0, $filter = array(), $hlm = 1, $totrows = false, $order_by = false, $limit = false, $group_by = false)
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
		$roots = $this->db->get('tb_payment_ar')->result_array();

		if($id > 0)
			$menus = $roots[0];
		else
			$menus = $roots;

		return $menus;
	}

	function alldetails($id = 0, $filter = array(), $hlm = 1, $totrows = false, $order_by = false, $limit = false, $group_by = false)
	{
		if($id)
			$this->db->where('id', $id);

		// filters
		if(count($filter) > 0)
			$this->db->where($filter);

		if($group_by)
			$this->db->group_by($group_by);

		$this->db->order_by('id', 'asc');
		$roots = $this->db->get('tb_d_payment_ar')->result_array();

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
		$this->db->insert('tb_nota_retur', $datas);
	}

	function savingPayment($datas) {
		$this->db->insert('tb_payment_ar', $datas);
	}

	function saveDetail($datas) {
		$this->db->insert('tb_d_payment_ar', $datas);
	}

	function update($datas, $id) {
		$this->db->where('id', $id);
		$this->db->update('tb_nota_retur', $datas);
	}

	function updatePayment($datas, $id) {
		$this->db->where('id', $id);
		$this->db->update('tb_payment_ar', $datas);
	}

	function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete('tb_nota_retur');
		$this->db->where('notareturid', $id);
		$this->db->delete('tb_nota_retur_detail');
		$this->db->where('notareturid', $id);
		$this->db->delete('tb_nota_retur_diskon');
	}

	function deletePayment($notareturid) {
		$this->db->where('id', $notareturid);
		$this->db->delete('tb_payment_ar');
		$this->db->where('notareturid', $notareturid);
		$this->db->delete('tb_d_payment_ar');
	}

	function detailAR($notareturid) {
		$result = $this->db->where('notareturid', $notareturid)
						->order_by('id', 'asc')
						->get('tb_nota_retur_detail')
						->result_array();
		return $result;
	}

	function alldiscounts($notareturid) {
		$result = $this->db->where('notareturid', $notareturid)
						->order_by('id', 'asc')
						->get('tb_nota_retur_diskon')
						->result_array();
		return $result;
	}

	function savingDetail($datas) {
		$this->db->insert('tb_nota_retur_detail', $datas);
	}

	function simpandiskon($datas) {
		$this->db->insert('tb_nota_retur_diskon', $datas);
	}
}
?>