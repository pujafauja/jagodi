<?php

defined('BASEPATH') OR exit('No direct script access allowed');



/**

 * Ap Model

 */

class Ap_model extends CI_Model

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
		$roots = $this->db->get('tb_ap')->result_array();
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

		$roots = $this->db->get('tb_payment_ap')->result_array();



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

		$roots = $this->db->get('tb_d_payment_ap')->result_array();



		if($id > 0)

			$menus = $roots[0];

		else

			$menus = $roots;



		return $menus;

	}



	function detailAP($apid) {

		$result = $this->db->where('apid', $apid)

						->order_by('id', 'asc')

						->get('tb_ap_detail')

						->result_array();

		return $result;

	}



	function alldiscounts($apid) {

		$result = $this->db->where('apid', $apid)

						->order_by('id', 'asc')

						->get('tb_ap_diskon')

						->result_array();

		return $result;

	}



	function totrows($filter = array()) {

		$rows = $this->get(0, $filter, $hlm = 1, true);

		return count($rows);

	}



	function saving($datas) {

		$this->db->insert('tb_ap', $datas);

	}



	function savingPayment($datas) {

		$this->db->insert('tb_payment_ap', $datas);

	}



	function saveDetail($datas) {

		$this->db->insert('tb_d_payment_ap', $datas);

	}



	function update($datas, $id) {

		$this->db->where('id', $id);

		$this->db->update('tb_ap', $datas);

	}



	function updatePayment($datas, $id) {

		$this->db->where('id', $id);

		$this->db->update('tb_payment_ap', $datas);

	}



	function savingDetail($datas) {

		$this->db->insert('tb_ap_detail', $datas);

	}



	function updateDetail($datas, $id) {

		$this->db->where('id', $id);

		$this->db->update('tb_ap_detail', $datas);

	}



	function deleteAllDetail($apid, $barangid = array()) {

		$this->db->where(

			array(

				'apid' => $apid,

			)

		);

		if(count($barangid) > 0)

			$this->db->where_in('barangid', $barangid);

		$this->db->delete('tb_ap_detail');

	}



	function simpandiskon($datas) {

		$this->db->insert('tb_ap_diskon', $datas);

	}



	function hapusdiskon($apid) {

		$this->db->where('apid', $apid)->delete('tb_ap_diskon');

	}



	function delete($id) {

		$this->db->where('id', $id);

		$this->db->delete('tb_ap');

	}



	function deletePayment($p_arid) {

		$this->db->where('id', $p_arid);

		$this->db->delete('tb_payment_ap');

		$this->db->where('p_arid', $p_arid);

		$this->db->delete('tb_d_payment_ap');

	}

	function getap($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL, $status= null, $tanggal1 = null, $tanggal2 = null, $duedate1 = null, $duedate2 = null)
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
				a.`supplierid`,
				a.`amount`,
				a.`tanggal`,
				a.`duedate`,
				a.`status`,
				a.`description`,
				a.`source`,
				b.`nama` as supplierid 
			FROM 
				`tb_ap` as a
			LEFT JOIN `tb_supplier` b ON a.`supplierid` = b.`id`
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