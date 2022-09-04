<?php  

defined('BASEPATH') OR exit('No direct script access allowed');



class Hrd_model extends CI_Model {

	function getCoaAlias()
	{
		$data = $this->db->select('b.id, b.nama')
						->from('tb_coa_alias a')
						->join('tb_coa b', 'a.coaid = b.id', 'left')
						->where('kategori', '5')->get()->result();
		return $data;
	}

	function getthr($year)
	{
		$exist = $this->db->get_where('tb_thr', ['year' => $year]);
		if (!$exist->num_rows()) {
			$user = $this->db->select('a.*, b.nama as pangkat')->join('pp_otority b', 'a.position = b.id')
						->get_where('tb_employee a', ['delete' => '0', 'a.status' => '1'])->result();
			$data = [];
			$data['year'] = $year;
			$data['status'] = 1;
 		    $kalkulasi = $this->db->order_by('year', 'desc')->get_where('tb_thr_master', ['op' => '>='])->result();
			foreach ($user as $value) {
			    $tanggal = new DateTime($value->registeredday);
			    $sekarang = new DateTime();
			    $perbedaan = $tanggal->diff($sekarang);
			    $masaKerja = ['Y' => $perbedaan->y, 'm' => $perbedaan->m, 'd' => $perbedaan->d];
			    $gajiBruto = (25 * $value->pokok) + (25 * $value->makan) + (25 * $value->transport) + $value->tunjangan + $value->another;
			    $thr = 0;
			    $type = 'lebih';
			    foreach ($kalkulasi as $y) {
				    if ($masaKerja['Y'] >= $y->year) {
				    	$type = 'lebih';
				    	// print_ar($y);
				    	$thr = ($gajiBruto / 100) * intval($y->kalkulasi);
				    }else{
				    	$type = 'kurang';
				    	$thr =  ($masaKerja['m'] / 12) * $gajiBruto;
				    }
			    }
			    $data['data'][] = [
			    	'employeeid'	=> $value->id,
			    	'employee' 		=> $value->nama,
			    	'position' 		=> $value->pangkat,
			    	'masaKerja' 	=> $masaKerja,
			    	'thr'			=> $thr,
			    	'type'			=> $type
			    ];
			}
			return $data;
		}else{
			return ['status' => 0];
		}
	}

	function getthrjson($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)

	{

		$sql = "

			SELECT * FROM tb_thr_master

		";

		

		$data['totalData'] = $this->db->query($sql)->num_rows();

		

		if( ! empty($like_value))

		{

			$sql .= " AND ( ";    

			$sql .= "

				op LIKE '%".$this->db->escape_like_str($like_value)."%'

				kalkulasi LIKE '%".$this->db->escape_like_str($like_value)."%'

				years LIKE '%".$this->db->escape_like_str($like_value)."%'

			";

			$sql .= " ) ";

		}

		

		$data['totalFiltered']	= $this->db->query($sql)->num_rows();

		

		$columns_order_by = array( 

			0 => '`op`',

			1 => '`kalkulasi`',

			2 => '`tahun`',

		);

		

		if($column_order != null && $column_dir != null && $limit_start != null && $limit_length != null)

		{

			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;

			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";

		}

		

		$data['query'] = $this->db->query($sql);

		return $data;

	}
	function getprintgaji($id)
	{
		$data = (object) [];

		$this->db->select('a.*, b.nama as employee,b.pokok, b.makan, b.transport, b.tunjangan, b.another ,c.nama as position')
			->from('tb_employee_payroll a')
			->join('tb_employee b', 'a.employeeid = b.id')
			->join('pp_otority c', 'b.position = c.id')
			->where('a.id', decode($id));
		$data = $this->db->get()->row();
		$data->company = $this->db->get('pp_settings')->row_array();
		return $data;
	}

	function gethistorysalary($month)

	{

		$this->db->select('a.*, b.nama as employee, b.pokok, b.makan, b.transport, b.tunjangan, b.another, c.nama as position');

		$this->db->from('tb_employee_payroll a');

		$this->db->join('tb_employee b', 'a.employeeid = b.id', 'left');

		$this->db->join('pp_otority c', 'b.position = c.id', 'left');

		$this->db->where('a.month', $month);

		$rows = $this->db->get()->result();

		$data = [];

		$data['total'] = 0;

		foreach ($rows as $value) {

		    $data['rows'] = $rows;

		    $data['total'] += $value->subtotal;

		}



		return $data;

	}



	function insertfee($employeeid, $hadir, $amount, $month)

	{

		$umk = $this->db->get_where('tb_umk', ['dipilih' => '1'])->row()->umk;

		foreach ($employeeid as $key => $value) {

			$user = $this->db->get_where('tb_employee', ['id' => $value])->row();

			$pokok = $user->pokok; 

			$makan = $user->makan; 

			$transport = $user->transport; 

			$tunjangan = $user->tunjangan; 

			$another = $user->another; 



			$hadirUser = $hadir[$value]; 

			$amountUser = toFloat($amount[$value]); 



			$gajiBruto = ($hadirUser * $pokok) + ($hadirUser * $makan) + ($hadirUser * $transport) + $tunjangan + $another;



			if ($gajiBruto >= $umk) {
				$bpjs = $this->db->get_where('tb_bpjs_master', ['op' => '>='])->row();	
			}else{
				$bpjs = $this->db->get_where('tb_bpjs_master', ['op' => '<'])->row();	
			}

			$bpjsKes = ($user && $user->bpjs == '1') ? $bpjs->kes_karyawan : 0;

			$bpjsNakerPerusahaan = ($user && $user->bpjs == '1') ? $bpjs->naker_perusahaan : 0;

			$bpjsNakerKaryawan = ($user && $user->bpjs == '1') ? $bpjs->naker_karyawan : 0;



			if ($bpjsKes AND $bpjsNakerPerusahaan AND $bpjsNakerKaryawan) {
				$kesTotal = ($gajiBruto < $umk) ? $umk * 0.05 : $gajiBruto * 0.05;

				$kesKaryawan = $kesTotal * $bpjsKes; 

				$kesPerusahaan = $kesTotal - $kesKaryawan;

				$kesPersen = ($kesTotal / $gajiBruto) * 100;



				$nakerKaryawan = ($gajiBruto < $umk) ? $umk * $bpjsNakerKaryawan : $gajiBruto * $bpjsNakerKaryawan; 

				$nakerPerusahaan = ($gajiBruto < $umk) ? $umk * $bpjsNakerPerusahaan : $gajiBruto * $bpjsNakerPerusahaan;

				$nakerTotal = $nakerKaryawan + $nakerPerusahaan;                



				$nakerPersen = ($nakerTotal / $gajiBruto) * 100;
			}else{
				$kesTotal = 0;
				$kesKaryawan = 0;
				$kesPerusahaan = 0;
				$kesPersen = 0;
				
				$nakerKaryawan = 0;
				$nakerPerusahaan = 0;
				$nakerTotal = 0;	
				$nakerPersen = 0;
			}



			$subtotal = ($gajiBruto - ($kesTotal - $nakerTotal)) - $amountUser;



			$row = [

				'employeeid' 		=> $value,		

				'month' 			=> $month,		

				'tanggal' 			=> date('Y-m-d'),		

				'gaji_bruto' 		=> $gajiBruto,		

				'kes_karyawan' 		=> $kesKaryawan,		

				'kes_perusahaan' 	=> $kesPerusahaan,		

				'kes_total' 		=> $kesTotal,		

				'kes_persen' 		=> $kesPersen,		

				'naker_karyawan' 	=> $nakerKaryawan,		

				'naker_perusahaan' 	=> $nakerPerusahaan,		

				'naker_total' 		=> $nakerTotal,		

				'naker_persen' 		=> $nakerPersen,		

				'amount' 			=> $amountUser,		

				'subtotal' 			=> $subtotal,	

				'hadir' 			=> $hadirUser,

				'transport' 		=> $transport,	

			];

			$this->db->insert('tb_employee_payroll', $row);

		}

	}



	function getdatatransaction()

	{

		$this->db->select('a.*, b.nama as position');

		$this->db->from('tb_employee a');

		$this->db->join('pp_otority b', 'a.position = b.id', 'left');

		$this->db->where(['delete' => 0, 'a.status' => 1]);

		return $this->db->get()->result();

	}

	function getcategory()

	{

		return $this->db->order_by('id', 'asc')->get('tb_insentif_cat')->result_array();

	}

	function getachiev()

	{

		return $this->db->order_by('nominal', 'asc')->get('tb_achievment')->result_array();

	}

	function getinsentif($id = null)

	{

		if ($id) {

			return $this->db->select('a.*, b.nama')

					->join('pp_otority b', 'b.id = a.position_id')

					->order_by('a.id', 'asc')->from('tb_insentif a')->where(['a.status' => 1 ,'a.id' => $id])->get()->row_array();	

		}else{



			return $this->db->select('a.*, b.nama')

					->join('pp_otority b', 'b.id = a.position_id')

					->order_by('a.id', 'asc')->from('tb_insentif a')->where(['a.status' => 1])->get()->result_array();

		}

	}

	function getinsentifdetail($insentif_id, $cat_id = null)

	{

		$this->db->select('a.*, b.nama');

		$this->db->order_by('a.id', 'asc');

		$this->db->join('tb_insentif_cat b', 'b.id = a.cat_id');

		if ($cat_id) {

			return $this->db->where(['insentif_id' => $insentif_id, 'cat_id' => $cat_id])->get('tb_insentif_detail a')->row_array();

		}else{

			return $this->db->where(['insentif_id' => $insentif_id])->get('tb_insentif_detail a')->result_array();

		}

	}

	function getinsentifachiev($insentif_detail_id, $achiev_id = null)

	{

		$where = ($achiev_id == null) ? ['a.insentif_detail_id' => $insentif_detail_id] : ['a.insentif_detail_id' => $insentif_detail_id, 'achiev_id' => $achiev_id];

		$this->db->order_by('a.id', 'asc')

			->select('a.id, a.nominal, c.target')

			->from('tb_insentif_achiev_detail a')

			->join('tb_achievment b', 'b.id = a.achiev_id')

			->join('tb_insentif_detail c', 'c.id = a.insentif_detail_id')

			->where($where);

		if($achiev_id)

			return $this->db->get()->row_array();

		else

			return $this->db->get()->result_array();





	}

	function inputitem($val)

	{

		$id_ket = $val['keterangan'];

		$id_insentif = $this->global_model->_insert('tb_insentif', ['position_id' => $id_ket]);

		foreach ($val['category'] as $keycat => $cat) {

			$id_detail = $this->global_model->_insert('tb_insentif_detail',[

				'insentif_id' 	=> $id_insentif,

				'cat_id'		=> $keycat,

				'target'		=> toFloat($val['nominal'][$keycat])

			]);

			foreach ($val['achiev'][$keycat] as $keyac => $ac) {

				$this->global_model->_insert('tb_insentif_achiev_detail' , [

					'insentif_id'			=> $id_insentif,

					'insentif_detail_id'	=> $id_detail,

					'achiev_id'				=> $keyac,

					'nominal'				=> $ac	

				]);

			}

		}

	}



	function updateitem($val, $id_insentif)

	{



		$this->db->delete('tb_insentif_detail' , ['insentif_id' => $id_insentif]);

		$this->db->delete('tb_insentif_achiev_detail' , ['insentif_id' => $id_insentif]);



		foreach ($val['category'] as $keycat => $cat) {

			$id_detail = $this->global_model->_insert('tb_insentif_detail',[

				'insentif_id' 	=> $id_insentif,

				'cat_id'		=> $keycat,

				'target'		=> toFloat($val['nominal'][$keycat])

			]);

			foreach ($val['achiev'][$keycat] as $keyac => $ac) {

				$this->global_model->_insert('tb_insentif_achiev_detail' , [

					'insentif_id'			=> $id_insentif,

					'insentif_detail_id'	=> $id_detail,

					'achiev_id'				=> $keyac,

					'nominal'				=> $ac	

				]);

			}

		}



	}



	function deleteitem($id)

	{

		$this->db->update('tb_insentif', ['status' => 0], ['id' => $id]);

		$this->db->delete('tb_insentif_detail' , ['insentif_id' => $id]);

		$this->db->delete('tb_insentif_achiev_detail' , ['insentif_id' => $id]);

	}



	function bpjs_json()

	{

		$this->db->select('a.id, b.nama, c.nama as position, a.kes, a.naker');

		$this->db->from('tb_bpjs_master a');

		$this->db->join('tb_employee b', 'b.id = a.user_id', 'left');

		$this->db->join('pp_otority c', 'c.id = b.position', 'left');

		return $this->db->get()->result_array();

	}



	function getbpjs($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)

	{

		$sql = "

			SELECT *  FROM `tb_bpjs_master` `a` where status = '1'


		";

		

		$data['totalData'] = $this->db->query($sql)->num_rows();

		

		if( ! empty($like_value))

		{

			$sql .= " AND ( ";    

			$sql .= "

				nama LIKE '%".$this->db->escape_like_str($like_value)."%'

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

	function getpayroll2($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL, $month)

	{

		$where = ($month) ? "WHERE month = '".$month."'" : '';

		$sql = "

			SELECT month, sum(subtotal) as total FROM tb_employee_payroll $where group by month

		";

		

		$data['totalData'] = $this->db->query($sql)->num_rows();

		

		if( ! empty($like_value))

		{

			$sql .= " AND ( ";    

			$sql .= "

				month LIKE '%".$this->db->escape_like_str($like_value)."%'

				total LIKE '%".$this->db->escape_like_str($like_value)."%'

			";

			$sql .= " ) ";

		}

		

		$data['totalFiltered']	= $this->db->query($sql)->num_rows();

		

		$columns_order_by = array( 

			0 => '`month`',

			1 => '`total`',

		);

		

		if($column_order != null && $column_dir != null && $limit_start != null && $limit_length != null)

		{

			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;

			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";

		}

		

		$data['query'] = $this->db->query($sql);

		return $data;

	}

	function getinsentifmodul($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL, $month)

	{

		$where = ($month) ? "WHERE month = '".$month."'" : '';

		$sql = "

			SELECT * FROM tb_insentif_transaction $where

		";

		

		$data['totalData'] = $this->db->query($sql)->num_rows();

		

		if( ! empty($like_value))

		{

			$sql .= " AND ( ";    

			$sql .= "

				month LIKE '%".$this->db->escape_like_str($like_value)."%'

				total LIKE '%".$this->db->escape_like_str($like_value)."%'

			";

			$sql .= " ) ";

		}

		

		$data['totalFiltered']	= $this->db->query($sql)->num_rows();

		

		$columns_order_by = array( 

			0 => '`month`',

			1 => '`total_insentif`',

		);

		

		if($column_order && $column_dir && $limit_start && $limit_length)

		{

			$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;

			$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";

		}

		

		$data['query'] = $this->db->query($sql);

		return $data;

	}

	function position()

	{

		$in = $this->db->select('user_id')->get('tb_bpjs_master')->result();

		$where = [];

		foreach ($in as $v) {

			$where[] = $v->user_id;

		}

		$this->db->where_not_in('id', $where);

		return $this->db->get('tb_employee')->result();

	}

	function getnewinsentif($month)

	{

		$exist = $this->db->get_where('tb_insentif_transaction', ['month' => $month]);

		if ($exist->num_rows()) {

			return ['status' => 0];

		}else{

			$data['status'] = 1;

			$data['data'] = [];



			$target = $this->db->select('b.nama as position, c.id as insentifid, d.id as insentif_detail_id, d.target, e.nama as category')

				->from('pp_otority b')

				->join('tb_insentif c', 'c.position_id = b.id', 'left')

				->join('tb_insentif_detail d', 'd.insentif_id = c.id', 'left')

				->join('tb_insentif_cat e', 'd.cat_id = e.id', 'left')

				->order_by('category', 'asc')

				->where('b.nama' , 'Mekanik')->get()->result();

			$dataTarget = [];
			foreach ($target as $key => $value) {
				// echo $value->category;
				// $keyVal = $value->category;
				// echo $keyVal;



				$dataTarget[$value->category] = $value;	



				$detailInsentif = $this->db->select('a.nominal persen, b.nominal as insentif')

						->from('tb_insentif_achiev_detail a')

						->join('tb_achievment b', 'b.id = a.achiev_id', 'left')->order_by('b.nominal', 'asc')->where('insentif_detail_id', $value->insentif_detail_id)->get()->result();

				// print_ar($detailInsentif);



				foreach ($detailInsentif as $kd => $v) {

					$dataTarget[$value->category]->detail[$kd] = $v;		

					$dataTarget[$value->category]->detail[$kd]->insentif_target = ($value->target/100) * $v->insentif;		

				}

			}	

			

			$user = $this->db->select('a.*, b.nama as posisi')->join('pp_otority b', 'a.position = b.id')->get_where('tb_employee a', ['position' => 9])->result();

			$exclude = $this->db->get('tb_insentif_cat')->result();

			foreach ($user as $key => $value) {

				$data['data'][$key]['id'] = $value->id;

				$data['data'][$key]['employee'] = $value->nama;

				$data['data'][$key]['position'] = $value->posisi;

				$data['data'][$key]['target'] = $dataTarget;



				$jumService = 0;

				$service = $this->db->select('a.*, b.jasaharga')->join('tb_job_detail b', 'a.id = b.service_id', 'right')

							->like('a.date', $month , 'BOTH')->get_where('tb_service a', ['employee_id' => $value->id])->result();

				foreach ($service as  $se) {

					if (is_array(json_decode($se->jasaharga))) {

						foreach (json_decode($se->jasaharga) as $s) {

							if (is_array($exclude[0]->exclude)) {

								foreach (json_decode($exclude[0]->exclude) as $e) {

								    if ($e->id != $se->itemid) {

										$jumService += $s->selling_price;		

								    }

								}

							}else{

								$jumService += $s->selling_price;							

							}

						}

					}else{

						$ser = json_decode($se->jasaharga);

						if (is_array($exclude[0]->exclude)) {

							foreach (json_decode($exclude[0]->exclude) as $e) {

							    if ($e->id != $se->itemid) {

									$jumService += $s->selling_price;		

							    }

							}

						}else{

							$jumService += $s->selling_price;							

						}

					}

				}



				$jumSparepart = 0;

				$sparepart = $this->db->select('a.*')->join('tb_service b' ,'a.service_id = b.id','right')->like('b.date', $month, 'BOTH')

										->get_where('tb_service_parts a', ['employee_id' => $value->id])->result();

				foreach ($sparepart as  $se) {

					if (is_array($exclude[1]->exclude)) {

						foreach (json_decode($exclude[1]->exclude) as $e) {

						    if ($e->id != $se->sparepart_id) {

								$jumSparepart += (($se->qty * $se->het) - ($se->disc / 100) * $se->het);

						    }

						}

					}else{

						$jumSparepart += (($se->qty * $se->het) - ($se->disc / 100) * $se->het);							

					}

				}



				$data['data'][$key]['achieved']['service'] = $jumService;

				$data['data'][$key]['achieved']['sparepart'] = $jumSparepart;

			}

			return $data;

		}

	}

	function fake_bpjs()

	{



	}



	function getpayroll($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL, $filtered = true)

	{

		$query = $this->db->select('

					a.id,

					a.nama,

					b.nama `position`,

					a.registeredday,

					IFNULL( ( SELECT CONCAT( MAX(tahun), \'-\', MAX(bulan) ) FROM tb_employee_payroll WHERE employeeid = a.id ), 0 ) lastGaji,

					IFNULL( ( SELECT CONCAT(\'[\', GROUP_CONCAT( CONCAT(\'{"tahun":"\', tahun, \'", "bulan":"\', bulan, \'", "gaji":"\', nominal, \'"}\') ), \']\' ) FROM tb_employee_payroll WHERE employeeid = a.id GROUP BY employeeid ), 0 ) GajiDibayar,



					now() ExistingDate

				')

				->from('tb_employee a')

				->join('pp_otority b', 'a.position = b.id', 'left')

				->where('a.delete', '0')

				->where('a.status', '1')

				->get();



		$data['totalData']     = $query->num_rows();

		$data['totalFiltered'] = $data['totalData'];



		$queries = array();



		// print_ar($query->result());die;

		

		if($data['totalData'] > 0):

			foreach($query->result() as $q):

				if($q->lastGaji > 0 && $filtered) {

					$lastGaji  = strtotime($q->lastGaji);

					$beginning = strtotime('+1 month', $lastGaji);

				}

				else if($q->lastGaji > 0 && ! $filtered)

					$beginning = strtotime($q->registeredday);

				else

					$beginning = strtotime($q->registeredday);



				if($q->GajiDibayar != '0')

					$paid = json_decode($q->GajiDibayar, true);

				else

					$paid = array();



				$end = strtotime($q->ExistingDate);



				while($beginning < $end):

					$bulan = date('m', $beginning);

					$tahun = date('Y', $beginning);



					$status = '<button class="btn btn-primary btn-sm"><i class="fa fa-times mr-2"></i>Unpaid</button>';

					$action = "<a href='".site_url('hrd/pay/'.encode($q->id))."' id='pay' class='btn btn-sm btn-success waves-effect waves-light'><i class='fas fa-money mr-1'></i> Pay</a>";

					$ExistingGaji = date('m-Y', $beginning);

					$fee = 0;

					if (count($paid)) {

						foreach ($paid as $p) {

							$hasPay = sprint_f(2, $p['bulan']).'-'.$p['tahun'];

							

							if($ExistingGaji == $hasPay){

								$status = '<button class="btn btn-success btn-sm"><i class="fa fa-check mr-2"></i>Paid</button>';

								$action = '<button class="btn btn-success btn-sm"><i class="fa fa-check mr-2"></i>Success</button>';

								$fee = $p->gaji;

							}		

						}

					}



					$queries[] = array(

						'id'           => $q->id,

						'nama'         => $q->nama,

						'position'     => $q->position,

						'lastGaji'     => $q->lastGaji,

						'status'	   => $status,

						'ExistingGaji' => my($ExistingGaji),

						'fee'		   => $fee,

						'action'	   => $action

					);



					$beginning = strtotime('+1 month', $beginning);



				endwhile;

			endforeach;	

		endif;



		// print_ar($queries);die;



		$data['query'] = $queries;



		return $data;

	}



}



/* End of file Hrd_model.php */

/* Location: ./application/models/Hrd_model.php */