<form action="<?php echo base_url('hrd/insert_fee') ?>" method="post" id="form-payroll">
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-4">
							<div class="form-group">
								<label for=""> Month </label>
								<input type="text" name="month" id="month-payroll" class="form-control" data-provide="datepicker" data-date-format="yyyy-mm" data-date-min-view-mode="1" />
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body">
					<table class="table tabel-sm">
						<thead>
							<tr>
								<th>Name</th>
								<th>Position</th>
								<th>Attendance</th>
								<th>Gaji Bruto</th>
								<th>Potongan</th>
								<th>Take Home Pay</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($user as $key => $value): ?>
								<tr data-id="<?php echo encode($value->id) ?>">
									<input type="hidden" name="employeeid[]" value="<?php echo $value->id ?>">
									<td><?php echo $value->nama ?></td>
									<td><?php echo $value->position ?></td>
									<td>
										<input style="width: 50px" type="text" name="hadir[<?php echo $value->id ?>]" class="form-control form-control-sm">
									</td>
									<td></td>
									<td>
										<div class="input-group input-group-sm">
											<div class="input-group-prepend">
												<div class="input-group-text">Rp.</div>
											</div>
										    <input style="width: 70px !important" type="text" data-a-sep="." data-a-dec="," data-m-dec="0" name="amount[<?php echo $value->id ?>]" class="autonumber form-control form-control-sm">
										</div>
									</td>
									<td></td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
					<div class="row">
						<div class="col text-right">
							<a href="<?php echo base_url() ?>hrd/payroll" class="btn btn-primary"><i class="fa fa-arrow-circle-left mr-2"></i> Back</a>
							<button type="submit" id="calculate-pay" class="btn btn-warning"><i class="fa fa-calculator mr-2"></i>Calculate</button>
							<button disabled="" type="submit" id="transaction-pay" class="btn btn-success"><i class="fa fa-check mr-2"></i>Confirm</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>'


