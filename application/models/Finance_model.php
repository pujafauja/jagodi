<?php

defined('BASEPATH') OR exit('No direct script access allowed');



/**

 * Finance Model for all tables

 * By : Puzha Fauzha

 */

class Finance_model extends CI_Model

{



	function __construct()

	{

		parent::__construct();

	}

	function getpayment($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL, $status= null, $tanggal1 = null, $tanggal2 = null, $type = 'in')
	{
		$where = ' AND a.type = \''.$type.'\'';
		if($status != NULL){
			$where .= ($status != 'All') ? 'AND a.status = \''.$status.'\'' : ''; 
		}

		if($tanggal1 != NULL && $tanggal2 != NULL)		
			$where .= " AND LEFT(a.tanggal, 10) BETWEEN '".$tanggal1."' AND '".$tanggal2."'";

		$sql = "

			SELECT
				a.id,
				a.no,
				a.tanggal,
				a.duedate,
				a.userid,
				a.tagihan,
				a.pembayaran,
				a.detail,
				a.type,
				a.credit_detail,
				a.supplierid,
				a.customerid,
				a.status,
				a.source sumber,
				b.nama customer,
				c.nama supplier
			FROM 
				`tb_payments` as a
			LEFT JOIN tb_customer b ON a.customerid = b.id
			LEFT JOIN tb_supplier c ON a.supplierid = c.id

			WHERE 1=1 $where

		";

		

		$data['totalData'] = $this->db->query($sql)->num_rows();

		

		if( ! empty($like_value))

		{

			$sql .= " AND ( ";    

			$sql .= "

				a.`tanggal` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR a.`tagihan` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR a.`pembayaran` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR a.`type` LIKE '%".$this->db->escape_like_str($like_value)."%'

			";

			$sql .= " ) ";

		}

		

		$data['totalFiltered']	= $this->db->query($sql)->num_rows();

		

		$columns_order_by = array( 

			0 => 'a.`tanggal`',

			1 => 'a.`tagihan`',
			2 => 'a.`pembayaran`',
			3 => 'a.`type`',

		);

		

		if($column_order != NULL && $column_dir != NULL && $limit_start != NULL && $limit_length != NULL)

		{

			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;

			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";

		}

		

		$data['query'] = $this->db->query($sql);

		return $data;

	}

	function getgroup($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)

	{

		$sql = "

			SELECT 

				a.`id`,

				a.`kode`,
				a.`normal`,

				a.`nama`

			FROM 

				`tb_coa_group` as a

			WHERE 1=1 

				AND a.`status` = '1' 

		";

		

		$data['totalData'] = $this->db->query($sql)->num_rows();

		

		if( ! empty($like_value))

		{

			$sql .= " AND ( ";    

			$sql .= "

				a.`kode` LIKE '%".$this->db->escape_like_str($like_value)."%'

				OR a.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'

			";

			$sql .= " ) ";

		}

		

		$data['totalFiltered']	= $this->db->query($sql)->num_rows();

		

		$columns_order_by = array( 

			0 => 'a.`kode`',

			1 => 'a.`nama`',

		);

		

		if($column_order != NULL && $column_dir != NULL && $limit_start != NULL && $limit_length != NULL)

		{

			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;

			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";

		}

		

		$data['query'] = $this->db->query($sql);

		return $data;

	}

	function getalias($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
			SELECT 
				a.`id`,
				a.`coaid`,
				a.`nama`,
				CONCAT('[', b.`kode`, '] ', b.`nama`) as coa
			FROM 
				`tb_coa_alias` as a
			LEFT JOIN `tb_coa` as b ON a.coaid = b.id
			WHERE 1=1 
				AND a.`status` = '1'
		";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();
		
		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				a.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR b.`kode` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR b.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}
		
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'a.`kode`',
			1 => 'a.`nama`',
		);
		
		if($column_order != NULL && $column_dir != NULL && $limit_start != NULL && $limit_length != NULL)
		{
			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		}
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}

	function addgroup($data)

	{

		$this->db->insert('tb_coa_group', $data);

	}



	function updategroup($data, $id)

	{

		$this->db->where('id', $id);

		$this->db->update('tb_coa_group', $data);

	}



	function rowgroup($where)

	{

		$this->db->where($where);

		return $this->db->get('tb_coa_group');

	}



	function getcoa($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL, $groupid = NULL)

	{

		$sql = "

			SELECT 

				a.`id`,

				a.`kode`,

				a.`nama`,

				a.`dr_awal`,

				a.`cr_awal`,
				a.`parentid`,

				b.`nama` as `group`,
				a.`issub`

			FROM 

				`tb_coa` as a

			LEFT JOIN `tb_coa_group` b ON a.`groupid` = b.`id`

			WHERE 1=1 

				AND a.`status` = '1' 

		";

		

		$data['totalData'] = $this->db->query($sql)->num_rows();

		

		if( ! empty($like_value))

		{

			$sql .= " AND ( ";    

			$sql .= "

				a.`kode` LIKE '%".$this->db->escape_like_str($like_value)."%'

				OR a.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'

				OR a.`dr_awal` LIKE '%".$this->db->escape_like_str($like_value)."%'

				OR a.`cr_awal` LIKE '%".$this->db->escape_like_str($like_value)."%'

				OR b.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'

			";

			$sql .= " ) ";

		}

		if( ! empty($groupid))
		{
			$sql .= "AND b.id = '$groupid'";
		}

		

		$columns_order_by = array( 

			0 => 'a.`kode`',

			1 => 'b.`nama`',

			2 => 'a.`nama`',

		);

		

		if(!is_null($column_order) && !is_null($column_dir) && !is_null($limit_start) && !is_null($limit_length))

		{

			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;

			// $sql .= " LIMIT ".$limit_start." ,".$limit_length." ";

		}

		

		$data['totalFiltered']	= $this->db->query($sql)->num_rows();

		

		$data['query'] = $this->db->query($sql);

		return $data;

	}



	function addcoa($data)

	{

		$this->db->insert('tb_coa', $data);

	}



	function updatecoa($data, $id)

	{

		$this->db->where('id', $id);

		$this->db->update('tb_coa', $data);

	}



	function rowcoa($where)

	{

		$this->db->where($where);
		$this->db->where('status', '1');

		return $this->db->get('tb_coa');

	}

	function getkehadiran($type, $like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
			SELECT 
				a.`id`,
				a.`mod`,
				a.`coaid`,
				a.`periode`,
				a.`type`,
				a.`limit`,
				b.`kode`,
				b.`nama`
			FROM 
				`tb_limit` as a
			LEFT JOIN `tb_coa` as b ON a.`coaid` = b.`id`
			WHERE 1=1 
				AND a.`status` = '1' 
				AND a.`mod` = '$type' 
		";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();
		
		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				a.`kode` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR a.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}
		
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'b.`kode`',
			1 => 'a.`periode`',
			2 => 'a.`type`',
			3 => 'a.`limit`',
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