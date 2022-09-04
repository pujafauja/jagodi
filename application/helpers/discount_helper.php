<?php

function getDiskon($productID = false)
{
    $ci =& get_instance();

	$discounts = $ci->global_model->_get('discounts', [
		'akhir >= ' => date('Y-m-d'),
		'awal <= ' => date('Y-m-d'),
	]);

	$discount = [];

	foreach($discounts->result() as $disc):
		if ($disc->type == 'kategori'):
			$categories = $ci->global_model->_get(
				$table    = 'category a',
				$where    = array(),
				$where_in = array('a.id' => json_decode($disc->kategoriid)),
				$or_where = array(),
				$select   = 'a.id id1, b.id id2, c.id id3',
				$join     = array(
					['category b', 'a.id = b.parentid', 'left'],
					['category c', 'b.id = c.parentid', 'left']
				),
				$limit    = false,
				$order_by = false,
				$group_by = false
			)->result();

			$allCategories = array();
			foreach($categories as $cats):
				if($cats->id1):
					array_push($allCategories, $cats->id1);
				endif;
				if($cats->id2):
					array_push($allCategories, $cats->id2);
				endif;
				if($cats->id3):
					array_push($allCategories, $cats->id3);
				endif;
			endforeach;

			foreach($allCategories as $allCats):
				$whereor['JSON_SEARCH(categories, \'all\', '.$allCats.') != '] = '';
			endforeach;

			$totalProd = $ci->global_model->_get(
				'products',
				[],
				[],
				$whereor,
				'id, price'
			);

			if($totalProd->num_rows() > 0):
				foreach($totalProd->result() as $productDisc):
					$discount[$productDisc->id][] = [$disc->typeDisc => $disc->nominal];
				endforeach;
			endif;
		elseif ($disc->type == 'product'):
			foreach(json_decode($disc->productid) as $discProds):
				$discount[decode($discProds)][] = [$disc->typeDisc => $disc->nominal];
			endforeach;
		else:
			$discount['all'][] = [$disc->typeDisc => $disc->nominal];
		endif;
	endforeach;

	return $discount;
}

?>