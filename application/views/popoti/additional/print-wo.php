<style type="text/css">
	body{
		background-color: white;
		font-family: 'Lucida Console' !important; 	
		font-size: 24 !important;
		padding: 15px;
	}
	th,td{
		border-bottom-color: black !important;
	}

	@media print {
	  #print {
	    display: none;
	  }
	}
</style>

<?php $typed = ['retail', 'cafe']; if (in_array($type, $typed)): ?>
	<div style="width: 35%">
		<div class="row text-center">
			<div class="col">
				<div class="row">
					<div class="col"><h3 style="font-family: 'Lucida Console';"> <?php echo $company->title ?>  </h3><hr style="margin: -3px 0px 3px 0px;border-color: black;border-width: 1px;"></div>
				</div>
				<div class="row">
					<div class="col mb-1"><?php echo $company->address.' - '.$company->phone ?></div>			
				</div>
			</div>
		</div>
		<hr style="border-bottom: 3px dashed black;" class="mt-0 pt-0">
		<table cellpadding="5" class="w-100">
			<thead>
				<tr>
					<th>No</th>
					<th>Item</th>
					<th>Qty</th>
					<th>Price</th>
				</tr>
			</thead>
			<tbody>
				<?php $total = 0; $no = 1; foreach(json_decode($data->detail) as $detail): ?>	
				<?php 
					$id = null;
					switch ($type) {
						case 'wash': $id = $detail->washid;break;
						case 'retail': $id = $detail->retailid;break;
						case 'cafe': $id = $detail->cafeid;break;
					}
				?>
				<tr>
					<td><?php echo $no ?></td>
					<td><?php echo sql_get_var('tb_'.$type.'_prices', 'nama', ['id' => $id]) ?></td>
					<td><?php echo rupiah(intval(toFloat($detail->qty))) ?></td	>
					<td><?php echo rupiah(intval(toFloat($detail->harga))) ?></td	>
				</tr>
				<?php $total += intval(toFloat($detail->subtotal)); ?>
				<?php $no++; endforeach; ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="2" class="text-right">Grand Total :</td>
					<td><?php echo rupiah($total, 2) ?></td>
				</tr>
			</tfoot>
		</table>
		<h2 class="text-center">TERIMA KASIH</h2>
	</div>
<?php else: ?>
	<div class="row">
		<div class="col-6">
			<div class="row">
				<div class="col border border-dark" style="border-width: 4px !important;">
					<div class="row">
						<div class="col"><h3 style="font-family: 'Lucida Console';"> <?php echo $company->title ?>  </h3><hr style="margin: -3px 0px 3px 0px; width: 85%;border-color: black;border-width: 1px;"></div>
					</div>
					<div class="row">
						<div class="col mb-1 text-left"><?php echo $company->address.' - '.$company->phone ?></div>			
					</div>
				</div>
			</div>
		</div>
		<div class="col-6 text-right"><h3 style="font-family: 'Lucida Console';" class="p-3"><?php echo $type ?></h3></div>
	</div>
	<div class="row mt-2">
		<div class="col-6">
		<?php if ($type == 'wash'): ?>
			<div class="row">
				<div class="col-3">Kendaraan</div>
				<div class="col-9">: <?php echo $data->kendaraan ?></div>
			</div>
			<div class="row">
				<div class="col-3">No. Polisi</div>
				<div class="col-9">: <?php echo $data->plat ?></div>
			</div>
			<div class="row">
				<div class="col-3">Washer</div>
				<div class="col-9">: <?php echo sql_get_var('tb_employee', 'nama', ['id' => $data->washerid]) ?></div>
			</div>
		<?php endif ?>
			<div class="row">
				<div class="col-3">No. Order</div>
				<div class="col-9">: <?php echo $data->nota ?></div>
			</div>
		</div>
		<?php if ($type == 'wash'): ?>
		<div class="col-6">
			<table cellpadding="3"> 
				<tr align="">
					<td>Nama</td>
					<td>:</td>
					<td><?php echo $data->customer ?></td>
				</tr>
				<tr>
					<td valign="top">Alamat</td>
					<td>:</td>
					<td><?php echo $this->service_model->getalamat($data->desa_id, $data->customer_id) ?></td>
				</tr>
				<tr>
					<td>Mobile</td>
					<td>:</td>
					<td><?php echo $data->no_hp ?></td>
				</tr>			
			</table>
		</div>
		<?php endif ?>
	</div>


	<div class="row mt-3">
		<table border="1" cellpadding="5" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>No.</th>
					<th>Item</th>
					<th>Price</th>
					<th>Discount</th>
					<th>Subtotal</th>
				</tr>
			</thead>
			<tbody>
				<?php $total = 0; $no = 1; foreach(json_decode($data->detail) as $detail): ?>	
				<tr>
					<td><?php echo $no ?></td>
					<?php 
						$id = null;
						switch ($type) {
							case 'wash': $id = $detail->washid;break;
							case 'retail': $id = $detail->retailid;break;
							case 'cafe': $id = $detail->cafeid;break;
						}
					?>
					<td><?php echo rupiah(intval(toFloat($detail->harga))) ?></td	>
					<td><?php echo rupiah(intval(toFloat($detail->diskon))) ?></td	>
					<td><?php echo sql_get_var('tb_'.$type.'_prices', 'nama', ['id' => $id]) ?></td>
					<td><?php echo rupiah(intval(toFloat($detail->subtotal))) ?></td>
				</tr>
				<?php $total += intval(toFloat($detail->subtotal)); ?>
				<?php $no++; endforeach; ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4" class="text-right">Grand Total :</td>
					<td><?php echo rupiah($total, 2) ?></td>
				</tr>
			</tfoot>
		</table>
		<div class="row">
			<div class="col text-center font-italic">
				<u>Dibuat Oleh</u><br>
				<div class="mt-5"></div>
				<?php echo sql_get_var('tb_employee', 'nama', ['id' => $this->session->userdata('user')]) ?>
			</div>
		</div>
	</div>
<?php endif ?>
