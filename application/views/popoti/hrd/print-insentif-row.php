<style type="text/css">
	body{
		background-color: white;
		font-family: 'Lucida Console' !important; 	
		font-size: 24 !important;
	}
	th,td{
		border-bottom-color: black !important;
	}
</style>
<div class="mt-2 mx-3">
	<div class="row">
	<div class="col-5 ml-2">
		<div class="row">
			<div class="col border border-dark" style="border-width: 4px !important;">
				<div class="row">
					<div class="col"><h3> <?php echo $company['title'] ?>  </h3><hr style="margin: -3px 0px 3px 0px; width: 85%;border-color: black;border-width: 1px;"></div>
				</div>
				<div class="row">
					<div class="col mb-1 text-left"><?php echo $company['address'].' - '.$company['phone'] ?></div>			
				</div>
			</div>
		</div>
	</div>
</div>

<hr class="border border-dark border-2 mb-2">
<div class="row mb-2">
	<div class="col-6">
		<table cellpadding="2">
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td><?php echo $data['employee'] ?></td>
			</tr>
			<tr>
				<td>Jabatan</td>
				<td>:</td>
				<td><?php echo $data['position'] ?></td>
			</tr>
			<tr>
				<td>Periode</td>
				<td>:</td>
				<td><?php echo my($data['month'], true) ?></td>
			</tr>
		</table>
	</div>
</div>


<div class="row">
	<div class="col">
		<table class="w-100" cellpadding="4">
			<thead>
				<tr class="border-top border-bottom border-dark">
					<th>No</th>
					<th>Kategori</th>
					<th class="text-center" colspan="2">Pencapaian</th>
					<th class="text-center" colspan="2" class="text-right">Insentif</th>
				</tr>
			</thead>
			<tbody class="border-bottom border-dark">
				<?php $no = 1 ?>
				<tr>
					<td><?php echo $no++ ?></td>
					<td>Service</td>
					<td class="pl-5">Rp. <?php echo $data['achievedJasaTarget'] ?></td>
					<td class="w-25"><?php echo $data['achievedJasaPersen'] ?></td>
					<td class="pl-5">Rp. <?php echo $data['insentifJasaTarget'] ?></td>
					<td><?php echo $data['insentifJasaPersen'] ?></td>
				</tr>
				<tr>
					<td><?php echo $no++ ?></td>
					<td>Sparepart</td>
					<td class="pl-5">Rp. <?php echo $data['achievedSparepartTarget'] ?></td>
					<td class="w-25"><?php echo $data['achievedSparepartPersen'] ?></td>
					<td class="pl-5">Rp. <?php echo $data['insentifSparepartTarget'] ?></td>
					<td><?php echo $data['insentifSparepartPersen'] ?></td>
				</tr>

			</tbody>
			<tfoot>
				<tr>
					<th colspan="4" class="text-right">Grand Total</th>
					<th colspan="2" class="pl-5">Rp. <?php echo $data['grandtotal'] ?></th>
				</tr>
			</tfoot>
		</table>
		<div class="row">
			<div class="col">
				<div class="row">
					<div class="col-2 text-center mb-4">						
						Penerima,
					</div>
					<div class="col-2 offset-8">
						Garut, <?php echo date('d-m-Y') ?>
					</div>
				</div>

				<div class="row">
					<div class="col-2 text-center font-italic">
						<u><?php echo $data['employee'] ?></u><br>
						<?php echo $data['position'] ?>
					</div>
					<div class="col-7 offset-3 text-right font-weight-bold">
						<?php echo $company['title'] ?> <br>
						<span class="small" style="font-weight: normal;font-style: italic;">This payslip is printed by the system, officially without having to stamp and sign</span>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>