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
	<div class="col-4 offset-2 text-right"><h2 style="font-family: 'Lucida Console';font-weight: bold;" class="p-3">Summary</h2></div>	
</div>

<hr class="border border-dark border-2 mb-2">

<div class="row">
	<div class="col">
		<table class="w-100" cellpadding="4">
			<thead>
				<tr class="border-top border-bottom border-dark">
					<th>Date</th>
					<th>No WO</th>
					<th>Customer</th>
					<th>Nominal</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody class="border-bottom border-dark">
				<?php foreach ($rows as $key => $value): ?>
					<tr>
						<td><?php echo $value['tgl'] ?></td>
						<td><?php echo $value['noWo'] ?></td>
						<td><?php echo $value['cst'] ?></td>
						<td><?php echo $value['nominal'] ?></td>
						<td><?php echo $value['status'] ?></td>
					</tr>
				<?php endforeach ?>

			</tbody>
		</table>
		<div class="row">
			<div class="col">
				<div class="row">
					<div class="col-2 offset-10">
						Garut, <?php echo date('d-m-Y') ?>
					</div>
				</div>

				<div class="row">
					<div class="col-9 offset-3 text-right font-weight-bold">
						<?php echo $company['title'] ?> <br>
						<span class="small" style="font-weight: normal;font-style: italic;">This payslip is printed by the system, officially without having to stamp and sign</span>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>