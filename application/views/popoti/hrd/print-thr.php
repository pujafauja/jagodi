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
		
	</div>
</div>


<div class="row">
	<div class="col">
		<table class="w-100" cellpadding="4">
			<thead>
				<tr class="border-top border-bottom border-dark">
					<th>Nama</th>
					<th>Position</th>
					<th>Periode</th>
					<th>Year Of Service</th>
					<th>THR</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo $data['employee'] ?></td>
					<td><?php echo $data['position'] ?></td>
					<td><?php echo $data['year'] ?></td>
					<td><?php echo $data['masaKerja']  ?></td>
					<th><?php echo $data['thr']  ?></th>
				</tr>
			</tbody>
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
					<div class="col-3 text-center font-italic">
						<u><?php echo $data['employee'] ?></u><br>
						<?php echo $data['position'] ?>
					</div>
					<div class="col-7 offset-2 text-right font-weight-bold">
						<?php echo $company['title'] ?> <br>
						<span class="small" style="font-weight: normal;font-style: italic;">This payslip is printed by the system, officially without having to stamp and sign</span>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>