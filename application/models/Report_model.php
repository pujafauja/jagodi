<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Report_model extends CI_Model{
	
	public function getserivicejson($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)

	{

		$sql = "

			SELECT DISTINCT a.id, a.no, a.`date`, a.status,c.nama as customer, d.nama as employee, a.type, b.service_id, (SELECT COUNT(id) FROM tb_service_parts WHERE service_id = a.id) total

			FROM tb_service a

			LEFT JOIN tb_service_parts b ON a.id = b.service_id

			LEFT JOIN tb_customer c ON a.customer_id = c.id

			LEFT JOIN tb_employee d ON a.useridpicking = d.id

				WHERE 1=1 AND a.is_cancel = 0 AND (SELECT COUNT(id) FROM tb_service_parts WHERE service_id = a.id) > 0

		";

		

		$data['totalData'] = $this->db->query($sql)->num_rows();

		

		if( ! empty($like_value))

		{

			$sql .= " AND ( ";    

			$sql .= "

				c.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'

			";

			$sql .= " ) ";

		}

		

		$data['totalFiltered']	= $this->db->query($sql)->num_rows();

		

		$columns_order_by = array( 

			0 => 'a.`date`',

			1 => 'a.`no`',

			2 => 'c.`nama`',

		);

		

		if($column_order != null && $column_dir != null && $limit_start != null && $limit_length != null)

		{

			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;

			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";

		}

		

		$data['query'] = $this->db->query($sql);

		return $data;

	}

}

 ?>