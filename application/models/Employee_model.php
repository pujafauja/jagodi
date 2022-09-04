<?php

defined('BASEPATH') OR exit('No direct script access allowed');



/**

 * Employee Model for all tables

 * By : Puzha Fauzha

 */

class Employee_model extends CI_Model

{



	public $dbname = 'tb_employee';

	

	function __construct()

	{

		parent::__construct();

	}



	function get($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)

	{

		$sql = "

			SELECT 

				a.`id`,

				a.`NIK`,
				a.`nama`,

				a.`panggilan`,

				a.`jk`,

				a.`tempat`,

				a.`tglLahir`,

				a.`kebangsaan`,

				a.`noid`,

				a.`alamatKTP`,

				a.`alamat`,

				a.`no`,

				a.`email`,

				a.`merriage`,

				a.`status`,

				a.`subcompanyid`,

				a.`position`,
				a.`bpjs`,
				a.`last_updated`,

				DATE_FORMAT(a.`registeredday`, '%Y/%m/%d') as `registeredday`,

				b.`nama` as subname,
				c.`nama` as position,

				YEAR(CURRENT_TIMESTAMP) - YEAR(a.`tglLahir`) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(a.`tglLahir`, 5)) as age

			FROM 

				`$this->dbname` as a

				LEFT JOIN `tb_subcompany` AS b ON a.`subcompanyid` = b.`id` 
				LEFT JOIN `pp_otority` AS c ON a.`position` = c.`id` 

			WHERE 1=1 

				AND a.`delete` = '0' 

		";

		

		$data['totalData'] = $this->db->query($sql)->num_rows();

		

		if( ! empty($like_value))

		{

			$sql .= " AND ( ";    

			$sql .= "

				`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'

				OR a.`panggilan` LIKE '%".$this->db->escape_like_str($like_value)."%'

				OR a.`jk` LIKE '%".$this->db->escape_like_str($like_value)."%'

				OR a.`tempat` LIKE '%".$this->db->escape_like_str($like_value)."%'

				OR a.`tglLahir` LIKE '%".$this->db->escape_like_str($like_value)."%'

				OR a.`kebangsaan` LIKE '%".$this->db->escape_like_str($like_value)."%'

				OR a.`noid` LIKE '%".$this->db->escape_like_str($like_value)."%'

				OR a.`alamatKTP` LIKE '%".$this->db->escape_like_str($like_value)."%'

				OR a.`alamat` LIKE '%".$this->db->escape_like_str($like_value)."%'

				OR a.`no` LIKE '%".$this->db->escape_like_str($like_value)."%'

				OR a.`email` LIKE '%".$this->db->escape_like_str($like_value)."%'

				OR a.`merriage` LIKE '%".$this->db->escape_like_str($like_value)."%'

				OR a.`status` LIKE '%".$this->db->escape_like_str($like_value)."%'

				OR a.`subcompanyid` LIKE '%".$this->db->escape_like_str($like_value)."%'

				OR a.`position` LIKE '%".$this->db->escape_like_str($like_value)."%'

				OR a.`registeredday` LIKE '%".$this->db->escape_like_str($like_value)."%'

				OR `subname` LIKE '%".$this->db->escape_like_str($like_value)."%'

			";

			$sql .= " ) ";

		}

		

		$data['totalFiltered']	= $this->db->query($sql)->num_rows();

		

		$columns_order_by = array( 

			0 => 'a.`nama`',

			1 => 'a.`position`',

			2 => 'b.`subname`',

			3 => '`age`',

			4 => '`registeredday`',

		);

		

		if($column_order && $column_dir && $limit_start && $limit_length) {
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;

			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		}

		

		$data['query'] = $this->db->query($sql);

		return $data;

	}

	function getemployeesearch($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)

	{

		$sql = "

			SELECT 

				a.`id`,

				a.`NIK`,
				a.`nama`,

				a.`panggilan`,

				a.`jk`,

				a.`tempat`,

				a.`tglLahir`,

				a.`kebangsaan`,

				a.`noid`,

				a.`alamatKTP`,

				a.`alamat`,

				a.`no`,

				a.`email`,

				a.`merriage`,

				a.`status`,

				a.`subcompanyid`,

				a.`position`,
				a.`bpjs`,
				a.position as position_id,

				DATE_FORMAT(a.`registeredday`, '%Y/%m/%d') as `registeredday`,

				b.`nama` as subname,
				c.`nama` as position,

				YEAR(CURRENT_TIMESTAMP) - YEAR(a.`tglLahir`) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(a.`tglLahir`, 5)) as age

			FROM 

				`$this->dbname` as a

				LEFT JOIN `tb_subcompany` AS b ON a.`subcompanyid` = b.`id` 
				LEFT JOIN `pp_otority` AS c ON a.`position` = c.`id` 

			WHERE 1=1 

				AND a.`delete` = '0' 

		";

		

		$data['totalData'] = $this->db->query($sql)->num_rows();

		

		if( ! empty($like_value))

		{

			$sql .= " AND ( ";    

			$sql .= "

				a.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'

				OR a.`panggilan` LIKE '%".$this->db->escape_like_str($like_value)."%'

				OR a.`jk` LIKE '%".$this->db->escape_like_str($like_value)."%'


				OR a.`position` LIKE '%".$this->db->escape_like_str($like_value)."%'

			";

			$sql .= " ) ";

		}

		

		$data['totalFiltered']	= $this->db->query($sql)->num_rows();

		

		$columns_order_by = array( 

			0 => 'a.`nama`',

			1 => 'a.`position`',

			2 => 'b.`subname`',

			3 => '`age`',

			4 => '`registeredday`',

		);

		if($column_order && $column_dir && $limit_start && $limit_length) {
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		}
		$data['query'] = $this->db->query($sql);
		return $data;
	}
	function add($data)
	{
		$this->db->insert($this->dbname, $data);
	}
	function update($data, $id)
	{
		// $where = '';
		// foreach ($data as $key => $value) {
		//     $where .= $value[$]
		// }
		$this->db->get_compiled_select();
		$this->db->where(['id' => $id])->update($this->dbname, $data);
	}
	function row($where)
	{
		$this->db
		->select('a.*, b.id as positionid, b.nama as position, c.nama as company')
		->from($this->dbname . ' a')
		->join('pp_otority b', 'a.position = b.id', 'left')
		->join('tb_subcompany c', 'a.subcompanyid = c.id', 'left')
		->where($where);
		return $this->db->get();
	}
}



?>