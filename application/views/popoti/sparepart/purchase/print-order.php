<style type="text/css">
	body{
		background-color: white;
		/*font-family: "Lucida Console" !important; 	*/
		/*font-size: 2 !important;*/
	}
	th,td{
		border-bottom-color: black !important;
	}
</style>

<div class="mt-2 mx-2">
	<div class="row">
		<div class="col-5 ml-2">
			<div class="row">
				<div class="col border border-dark" style="border-width: 4px !important;">
					<div class="row">
						<div class="col"><h3 style="font-weight: bold;"> <?php echo $company['title'] ?>  </h3><hr style="margin: -3px 0px 3px 0px; width: 85%;border-color: black;border-width: 1px;"></div>
					</div>
					<div class="row">
						<div class="col mb-1 text-left"><?php echo $company['address'].' - '.$company['phone'] ?></div>			
					</div>
				</div>
			</div>
		</div>
		<div class="col-4 offset-2 text-right"><h2 style="font-weight: bold;" class="p-3"><?php echo ($is_receive) ? "Receive" : "Purchase Order" ?></h2></div>
		<?php //if ($data->from == 'recommended'): ?>	
			<!-- <div class="col-4 offset-2 text-right"><h2 style="font-weight: bold;" class="p-3">Recommendation Order</h2></div> -->
		<?php //else: ?>
			<!-- <div class="col-4 offset-2 text-right"><h2 style="font-weight: bold;" class="pl-5">Non Recommendation Order</h2></div> -->
		<?php //endif ?>
	</div>

	<div class="row mt-2">
		<div class="col-6">
			<table cellpadding="3">
				<tr>
					<td>Date</td>
					<td>:</td>
					<td><?php echo date('d/m/Y', strtotime(($is_receive) ? $data->tanggal : $data->order_date)) ?></td>
				</tr>
				<tr>
					<td><?php echo (!$is_receive) ? "No Order" : "No Receive" ?> </td>
					<td>:</td>
					<td>
						<?php echo $data->no ?>
					</td>
				</tr>
			</table>
		</div>
		<?php if (!$is_receive): ?>
			
		<div class="col-4 offset-2">
			<table cellpadding="3"> 
				<tr align="">
					<td>To</td>
					<td>:</td>
					<td><?php echo $data->supplier ?></td>
				</tr>
			</table>
		</div>

		<?php endif ?>
	</div>

	<?php if($is_receive): ?>
		<table bordercolor="black" style="border-color: black !important" class="table border-dark table-sm">
			<thead>
				<tr>
					<th>Date</th>
					<th>Code Parts</th>
					<th>Part Name</th>
					<th>Qty</th>
					<th>Location</th>
					<th>Price</th>
					<th>Subtotal</th>
				</tr>
			</thead>
			<body>
				<tbody>
					<?php $no = 1;$grandtotal = 0;foreach (json_decode($data->detail) as $key => $value): ?>
						<tr>
							<?php $row = $this->global_model->_get('tb_sparepart', ['id' => $value->sparepartid])->row() ?>
							<td><?php echo $no++ ?></td>
							<td><?php echo $row->kode ?></td>
							<td><?php echo $row->nama ?></td>
							<td><?php echo $value->qty ?></td>
							<td><?php echo sql_get_var('tb_location', 'nama' , ['id' => $value->locationid]) ?></td>
							<td><?php echo ($is_receive) ? $value->price : rupiah($value->price) ?></td>
							<td><?php $subtotal = $value->qty * (($is_receive ? intval(toFloat($value->price)) : $value->price ));echo rupiah($subtotal);$grandtotal += $subtotal; ?></td>
						</tr>			
					<?php endforeach ?>
				</tbody>
				<tfoot>
					<tr>
						<th style="vertical-align: middle;" colspan="6" class="text-right"><h4>Grandtotal</h4></th>
						<th><h4>Rp <?php echo rupiah($grandtotal) ?> </h4></th>
					</tr>
				</tfoot>
			</body>
		</table>
	<?php else: ?>
		<table bordercolor="black" style="border-color: black !important" class="table border-dark table-sm">
			<thead>
				<tr>
					<th>No</th>
					<th>Code Parts</th>
					<th>Category</th>
					<th>Part Name</th>
					<!-- <th>Price</th> -->
					<th>Qty</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1;$grandtotal = 0;foreach (json_decode($data->detail) as $key => $value): ?>
					<tr>
						<?php $row = $this->global_model->_get('tb_sparepart', ['id' => $value->sparepartid])->row() ?>
						<td><?php echo $no++ ?></td>
						<td><?php echo $row->kode ?></td>
						<td><?php echo sql_get_var('tb_sparepart_category', 'nama' , ['id' => $row->catid]) ?></td>
						<td><?php echo $row->nama ?></td>
						<?php echo ($is_receive) ? "<td>".$value->price."<td>" : '' ?>
						<td><?php echo $value->qty ?></td>
					</tr>			
				<?php endforeach ?>
			</tbody>
		</table>	
	<?php endif ?>

	<div class="row">
		<div class="col">
			<div class="row">
				<div class="col-2 text-center mb-4">						
					
				</div>
				<div class="col-2 offset-8">
					Garut, <?php echo date('d-m-Y') ?>
				</div>
			</div>

		</div>
	</div>
</div>
       