<?php

defined('BASEPATH') OR exit('No direct script access allowed');



/**

 * Company Model for all tables

 * By : Puzha Fauzha

 */

class Company_model extends CI_Model

{



	public $dbcat = 'tb_cat_comp';

	public $dbsub = 'tb_subcompany';

	

	function __construct()

	{

		parent::__construct();

	}



	function getcat($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)

	{

		$sql = "

			SELECT 

				a.`id`,

				a.`nama`

			FROM 

				`$this->dbcat` as a

			WHERE 1=1 

				AND a.`status` = '1' 

		";

		

		$data['totalData'] = $this->db->query($sql)->num_rows();

		

		if( ! empty($like_value))

		{

			$sql .= " AND ( ";    

			$sql .= "

				`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'

			";

			$sql .= " ) ";

		}

		

		$data['totalFiltered']	= $this->db->query($sql)->num_rows();

		

		$columns_order_by = array( 

			0 => 'a.`nama`',

		);

		

		if($column_order && $column_dir && $limit_start && $limit_length)

		{

			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;

			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";

		}

		

		$data['query'] = $this->db->query($sql);

		return $data;

	}



	function addcat($data)

	{

		$this->db->insert($this->dbcat, $data);

	}



	function updatecat($data, $id)

	{

		$this->db->where('id', $id);

		$this->db->update($this->dbcat, $data);

	}



	function rowcat($where)

	{

		$this->db->where($where);

		return $this->db->get($this->dbcat);

	}



	function getsub($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)

	{

		$sql = "

			SELECT 

				a.`id`,

				a.`nama`,

				a.`address`,

				b.`nama` as category

			FROM 

				`$this->dbsub` as a

				LEFT JOIN `$this->dbcat` as b ON a.`id_cat` = b.`id`

			WHERE 1=1 

				AND a.`status` = '1' 

		";

		

		$data['totalData'] = $this->db->query($sql)->num_rows();

		

		if( ! empty($like_value))

		{

			$sql .= " AND ( ";    

			$sql .= "

				a.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'

				a.`address` LIKE '%".$this->db->escape_like_str($like_value)."%'

				`category` LIKE '%".$this->db->escape_like_str($like_value)."%'

			";

			$sql .= " ) ";

		}

		

		$data['totalFiltered']	= $this->db->query($sql)->num_rows();

		

		$columns_order_by = array( 

			0 => 'a.`nama`',

			1 => '`category`',

			2 => 'a.`address`',

		);

		

		if($column_order && $column_dir && $limit_start && $limit_length) {
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;

			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		}

		

		$data['query'] = $this->db->query($sql);

		return $data;

	}



	function addsub($data)

	{

		$this->db->insert($this->dbsub, $data);

	}



	function updatesub($data, $id)

	{

		$this->db->where('id', $id);

		$this->db->update($this->dbsub, $data);

	}



	function rowsub($where)

	{

		$this->db->where($where);

		return $this->db->get($this->dbsub);

	}

}



?>