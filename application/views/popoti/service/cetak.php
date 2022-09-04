<style type="text/css">
	body{
		background-color: white;
		font-family: "Lucida Console" !important; 	
		/*font-size: 2 !important;*/
	}
	th,td{
		border-bottom-color: black !important;
	}
</style>
<div class="mt-2 mx-3">

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	
	<div class="row">
		<div class="col-5 ml-2">
			<div class="row">
				<div class="col border border-dark" style="border-width: 4px !important;">
					<div class="row">
						<div class="col"><h3 style="font-family: 'Lucida Console';font-weight: bold;"> <?php echo $data['company']['title'] ?>  </h3><hr style="margin: -3px 0px 3px 0px; width: 85%;border-color: black;border-width: 1px;"></div>
					</div>
					<div class="row">
						<div class="col mb-1 text-left"><?php echo $data['company']['address'].' - '.$data['company']['phone'] ?></div>			
					</div>
				</div>
			</div>
		</div>
		<?php if ($type == 'service'): ?>	
			<div class="col-4 offset-2 text-right"><h2 style="font-family: 'Lucida Console';font-weight: bold;" class="p-3">WORK ORDER</h2></div>
		<?php else: ?>
			<div class="col-4 offset-2 text-right"><h2 style="font-family: 'Lucida Console';font-weight: bold;" class="pl-5">Retail Sparepart</h2></div>
		<?php endif ?>
	</div>

	<div class="row mt-2">
		<div class="col-6">
			<table cellpadding="3">
				<tr>
					<td>Tanggal</td>
					<td>:</td>
					<td><?php echo date('d/m/Y', strtotime($data['service']['date'])) ?></td>
				</tr>
				<tr>
					<td>No Work Order </td>
					<td>:</td>
					<td>
						<?php echo $data['service']['no_service'] ?>
					</td>
				</tr>
				<?php if ($type == 'service'): ?>
					
				<tr>
					<td>No Polisi</td>
					<td>:</td>
					<td><?php echo $data['service']['plat'] ?></td>
				</tr>
				<tr>
					<td>Teknisi</td>
					<td>:</td>
					<td><?php echo sql_get_var('tb_employee', 'nama', ['id' => $data['service']['employee_id']]) ?></td>
				</tr>
				<?php endif ?>
			</table>
		</div>
		<div class="col-4 offset-2">
			<table cellpadding="3"> 
				<tr align="">
					<td>Nama</td>
					<td>:</td>
					<td><?php echo $data['service']['customer'] ?></td>
				</tr>
				<tr>
					<td valign="top">Alamat</td>
					<td>:</td>
					<td><?php echo $data['service']['alamat'] ?></td>
				</tr>
				<tr>
					<td>Mobile</td>
					<td>:</td>
					<td><?php echo $data['service']['no_hp'] ?></td>
				</tr>			
			</table>
		</div>
	</div>


	<?php $grandtotal = 0 ?>
	<div class="row">
		<?php if ($type == 'service'): ?>
		<div class="col">
			<table bordercolor="black" style="border-color: black !important" class="table border-dark table-sm">
				<thead>
					<tr>
						<th class="border-dark">No</th>
						<th class="border-dark">Jasa</th>
						<th class="border-dark">Item Pekerjaan</th>
						<th class="border-dark">Qty</th>
						<th class="border-dark">Harga</th>
						<th class="border-dark">Estimasi Biaya</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1 ?>
					<?php foreach($data['pesanan']['item'] as $item): ?>
						<tr>
							<?php $jasa = json_decode($item['jasaharga']) ?>
							<td class="border-bottom border-dark" rowspan="<?php echo (count($jasa) + 1)  ?>"><?php echo $no++ ?></td>
							<td class="border-bottom border-dark" rowspan="<?php echo (count($jasa) + 1)  ?>"><?php echo $item['group'] ?></td>
						</tr>

						<?php foreach($jasa as $j): ?>
							<tr>
								<td class="border-bottom border-dark"><?php echo sql_get_var('tb_jasa', 'nama', ['id' => $j->itemid]) ?></td>
								<td class="border-bottom border-dark"><?php echo $j->qty ?></td>
								<td class="border-bottom border-dark"><?php echo rupiah($j->harga) ?></td>
								<td class="border-bottom border-dark" class="jum"><?php echo rupiah($j->selling_price); $grandtotal += $j->selling_price ?></td>
							</tr>
						<?php endforeach ?>
							
					<?php endforeach ?>

					
					<?php if (count($data['pesanan']['package'])): ?>
						<?php foreach($data['pesanan']['package'] as $pa): ?>
							<?php $row = json_decode($pa['jasaharga'],true) ?>
							
							<tr>
								<td class="border-bottom border-dark"><?php echo $no++ ?></td>
								<td class="border-bottom border-dark"><?php echo sql_get_var('tb_service_package', 'nama', ['id' => $row['itemid']]) ?></td>
								<td class="border-bottom border-dark"></td>
								<td class="border-bottom border-dark"><?php echo $row['qty'] ?></td>
								<td class="border-bottom border-dark"><?php echo rupiah($row['harga']) ?></td>
								<td class="border-bottom border-dark jum"><?php echo rupiah($row['selling_price']); $grandtotal += $row['selling_price']; ?></td>
							</tr>
						<?php endforeach ?>
					<?php endif ?>
					
				</tbody>
				<?php if (!count($data['pesanan']['part'])): ?>
					
				<tfoot>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td><b>Grand Total</b></td>
						<td>Rp. <?php echo rupiah($grandtotal) ?></td>
					</tr>
				</tfoot>
				<?php endif ?>
			</table>
			<p></p>
		<?php endif ?>
			<?php if (count($data['pesanan']['part'])): ?>
				
			<table class="table table-sm">
				<thead>
					<tr>
						<th class="border-dark">No</th>
						<th class="border-dark">Kode</th>
						<th class="border-dark">Item Sparepart</th>
						<th class="border-dark">Qty</th>
						<th class="border-dark">Discount</th>
						<th class="border-dark">Harga</th>
						<th class="border-dark">Estimasi Harga</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1 ?>
					<?php if (count($data['pesanan']['part'])): ?>
						<?php foreach ($data['pesanan']['part'] as $key => $value): ?>
							<tr>
								<td class="border-bottom border-dark"><?php echo $no++ ?></td>
								<td class="border-bottom border-dark"><?php echo $value['kode'] ?></td>
								<td class="border-bottom border-dark"><?php echo $value['sparepart'] ?></td>
								<?php $qty = ($value['pickingqty']) ? $value['pickingqty'] : $value['qty'] ?>
								<td class="border-bottom border-dark"><?php echo $qty ?></td>
								<td class="border-bottom border-dark"><?php echo rupiah($value['disc']) ?></td>
								<td class="border-bottom border-dark"><?php echo rupiah($value['het']) ?></td>
								<td class="border-bottom border-dark jum"><?php echo rupiah(($value['het'] * $qty) - $value['disc']); 
																				$grandtotal += ($value['het'] * $qty) - $value['disc'] ?></td>
							</tr>
						<?php endforeach ?>
					<?php endif ?>
				</tbody>
				<tfoot>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td><b>Grand Total</b></td>
						<td>Rp. <?php echo rupiah($grandtotal) ?></td>
					</tr>
				</tfoot>
			</table>
			<?php endif ?>

			<div class="my-2 ml-2 border border-dark" style="width: 40%;">
				<p class="mb-0"> <span class="ml-2 font-weight-bold">Perhatian</span> :</p>
				<ul>
					<li>Work order ini hanya sebagai ESTIMASI harga</li>
					<li>Pembayaran yang sah berupa INVOICE/FAKTUR</li>
					<li>Harap dibawa ketika pembayaran di kasir</li>
				</ul>
			</div>
			<table class="table table-sm table-borderless">
				<thead>
					<tr align="center">
						<th>Konsumen</th>
						<?php if ($type == 'service'): ?>
							<th>Teknisi</th>
							<th>Service Advisor</th>
						<?php else: ?>
							<th>Gudang</th>
						<?php endif ?>
						<th>Service Counter</th>
					</tr>
				</thead>
				<tbody>
					<tr align="center">
						<td>( <?php echo $data['service']['customer'] ?> )</td>
						<?php if ($type == 'service'): ?>					
							<td>(<span class="mx-1"><?php echo sql_get_var('tb_employee', 'nama', ['id' => $data['service']['employee_id']]) ?></span>)</td>
						<?php endif ?>
						<td>(<span class="mx-5"></span>)</td>
						<td>( <?php echo sql_get_var('tb_employee', 'nama', ['id' => $this->session->userdata('user')]) ?> )</td>
					</tr>
				</tbody>
			</table>

		</div>
	</div>

	</div>


</body>

</html>
