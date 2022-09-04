<?php if ($is_print): ?>
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

		<div class="col-4 offset-2 text-right">
			<h2 class="pt-3 pb-0 pl-3 pr-0 text-right">Rekapitulasi THR</h2>
			<h3 class=""><?php echo $data['year'] ?></h3>
		</div>

	</div>

	<hr class="border border-dark border-2 mb-2">
	<table class="table">
		<thead>
			<tr>
				<th>Employee</th>
				<th>Posisi</th>
				<th>Years Of Service</th>
				<th>THR</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach(json_decode($data['detail']) as $value): ?>
				<tr>
					<td><?php echo $value->employee ?></td>
					<td><?php echo $value->position ?></td>
					<td><?php echo $value->masaKerja ?></td>
					<td><?php echo $value->thr ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="3" class="text-right">Grand Total</th>
				<th>Rp. <?php echo rupiah($data['total']) ?></th>
			</tr>
		</tfoot>
	</table>
	<div class="row">
		<div class="col">
			<table class="" cellpadding="7">
				<thead>
					<tr align="center">
						<th>Dicek Oleh,</th>
					</tr>
				</thead>
				<tbody>	
					<tr align="center">
						<td class="pt-4">( <?php echo sql_get_var('tb_employee', 'nama', ['id' => $this->session->userdata('user')]) ?> )</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

<?php else: ?>
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body">
					<h3>THR <?php echo $data['year'] ?></h3>
					<table class="table">
						<thead>
							<tr>
								<th>Employee</th>
								<th>Posisi</th>
								<th>Years Of Service</th>
								<th>THR</th>
								<th>Print</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach(json_decode($data['detail']) as $value): ?>
								<tr>
									<td><?php echo $value->employee ?></td>
									<td><?php echo $value->position ?></td>
									<td><?php echo $value->masaKerja ?></td>
									<td><?php echo $value->thr ?></td>
									<td><button class="btn btn-primary btn-sm" id="print-thr"><i class="fa fa-print"></i></button></td>
								</tr>
							<?php endforeach ?>
						</tbody>
						<tfoot>
							<tr>
								<th colspan="3" class="text-right">Grand Total</th>
								<th>Rp. <?php echo rupiah($data['total']) ?></th>
							</tr>
						</tfoot>
					</table>
					<div class="row">
						<input type="hidden" name="year" value="<?php echo $data['year'] ?>">
						<div class="col text-right">
							<a href="<?php echo base_url() ?>hrd/thr" class="btn btn-primary"><i class="fa fa-arrow-circle-left mr-2"></i> Back</a>
							<a href="<?php echo base_url() ?>hrd/detail-thr/<?php echo encode($data['id']).'/'.true ?>" id="print-all-thr" class="btn btn-success"><i class="fa fa-print mr-2"></i> Print All</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
<?php endif ?>
