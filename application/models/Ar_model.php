<?php

defined('BASEPATH') OR exit('No direct script access allowed');



/**

 * Ar Model

 */

class Ar_model extends CI_Model

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

		$roots = $this->db->get('tb_ar')->result_array();



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

		$this->db->insert('tb_ar', $datas);

	}



	function savingPayment($datas) {

		$this->db->insert('tb_payment_ar', $datas);

	}



	function saveDetail($datas) {

		$this->db->insert('tb_d_payment_ar', $datas);

	}



	function update($datas, $id) {

		$this->db->where('id', $id);

		$this->db->update('tb_ar', $datas);

	}



	function deletedetailpayments($p_arid) {

		$this->db->where('p_arid', $p_arid)

				->delete('tb_d_payment_ar');

	}



	function updatePayment($datas, $id) {

		$this->db->where('id', $id);

		$this->db->update('tb_payment_ar', $datas);

	}



	function delete($id) {

		$this->db->where('id', $id);

		$this->db->delete('tb_ar');

		$this->db->where('arid', $id);

		$this->db->delete('tb_ar_detail');

		$this->db->where('arid', $id);

		$this->db->delete('tb_ar_diskon');

	}



	function deletePayment($p_arid) {

		$this->db->where('id', $p_arid);

		$this->db->delete('tb_payment_ar');

		$this->db->where('p_arid', $p_arid);

		$this->db->delete('tb_d_payment_ar');

	}



	function detailAR($arid) {

		$result = $this->db->where('arid', $arid)

						->order_by('id', 'asc')

						->get('tb_ar_detail')

						->result_array();

		return $result;

	}



	function alldiscounts($arid) {

		$result = $this->db->where('arid', $arid)

						->order_by('id', 'asc')

						->get('tb_ar_diskon')

						->result_array();

		return $result;

	}



	function savingDetail($datas) {

		$this->db->insert('tb_ar_detail', $datas);

	}



	function simpandiskon($datas) {

		$this->db->insert('tb_ar_diskon', $datas);

	}
function getAr($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL, $status= null, $tanggal1 = null, $tanggal2 = null, $duedate1 = null, $duedate2 = null)
	{

		$where = '';
		if($status != NULL){
			$where .= ($status != 'All') ? 'AND a.status = \''.$status.'\'' : ''; 
		}

		if($tanggal1 != NULL && $tanggal2 != NULL)		
			$where .= " AND a.tanggal BETWEEN '".$tanggal1."' AND '".$tanggal2."'";

		if($duedate1 != NULL && $duedate2 != NULL)		
			$where .= " AND a.duedate BETWEEN '".$duedate1."' AND '".$duedate2."'";

		$sql = "
			SELECT
				a.`id`,
				a.`no`,
				a.`nama`,
				a.`amount`,
				a.`tanggal`,
				a.`duedate`,
				a.`status`,
				a.`description`,
				a.`source`
			FROM 
				`tb_ar` as a

			WHERE 1 $where
		";
		$data['totalData'] = $this->db->query($sql)->num_rows();
		if( ! empty($like_value))
		{

			$sql .= " AND ( ";    
			$sql .= "
				a.`no` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR a.`duedate` LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		$columns_order_by = array( 

			0 => 'a.`no`',
			1 => 'a.`amount`',
		);

		if($column_order != NULL && $column_dir != NULL && $limit_start != NULL && $limit_length != NULL)
		{
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";

		}
		$data['query'] = $this->db->query($sql);
		return $data;

	}


}

?>