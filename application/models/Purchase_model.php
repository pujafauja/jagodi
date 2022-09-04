<?php

/**
 * 
 */
class Purchase_model extends CI_Model
{
	
	function getpo($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL, $from = NULL, $exists = array())
	{
		$sql = "
			SELECT 
				a.`id`,
				a.`no`,
				a.`order_date`,
				a.`supplierid`,
				a.`delivery_plan`,
				a.`abcid`,
				a.`memo`,
				a.`detail`,
				a.`from`,
				a.`status`,
				a.`order_by`,
				b.nama supplier,
				c.USE_NAMA user
			FROM 
				`tb_order` as a
			LEFT JOIN `tb_supplier` as b ON a.`supplierid` = b.`id`
			LEFT JOIN `tb_user` as c ON a.`order_by` = c.`USE_ID`
			WHERE 1=1 
				AND a.`status` = '0' 
		";

		if($from != NULL)
			$sql .= " AND a.from = '$from'";

		if(is_array($exists) && count($exists) > 0)
			$sql .= " AND a.id NOT IN (".implode(",", $exists).")";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();
		
		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				a.`no` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR b.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}
		
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'a.`no`',
			1 => 'a.`order_date`',
		);
		
		if($column_order && $column_dir && $limit_start && $limit_length)
		{
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		}
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}

}

?>