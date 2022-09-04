<div class="row">
	<div class="col-sm-4">
		<div class="card">
			<div class="card-body">
				<h4 class="header-title mb-3">Total Cash <span id="day">Today</span></h4>
				<table class="table table-striped table-sm">
					<thead>
						<tr>
							<td>Account</td>
							<td>Amount</td>
						</tr>
					</thead>
					<tbody>
						<?php
						$grandtotal = 0;
						if($kas->num_rows()):
							foreach($kas->result() as $coa): ?>
								<tr>
									<td><a href="<?php echo base_url('finance/ledger/'.$coa->kode) ?>"><?php echo $coa->coa ?></a></td>
									<td class="text-right">
										<?php
										$debit  = 0;
										$kredit = 0;
										$total  = 0;

										if(strpos($coa->detail, ',') !== FALSE):
											foreach(explode(',', $coa->detail) as $detail):
												$details = explode(';', $detail);
												$type    = $details[0];
												$nominal = $details[1];

												if($type == 'dr'):
													$debit += $nominal;
												else:
													$kredit += $nominal;
												endif;
											endforeach;
										else:
											$details = explode(';', $coa->detail);
											$type    = $details[0];
											$nominal = $details[1];

											if($type == 'debit'):
												$debit += $nominal;
											else:
												$kredit += $nominal;
											endif;
										endif;

										if($coa->normal == 'debit'):
											$total = $debit - $kredit;
										else:
											$total = $kredit - $debit;
										endif;

										echo rupiah($total, 2);
										$grandtotal += $total;
										?>
									</td>
								</tr>
							<?php endforeach;
						endif;
						?>
					</tbody>
					<tfoot>
						<tr>
							<td class="text-right">Total:</td>
							<td class="text-right" id="totalJurnal"><?php echo rupiah($grandtotal, 2) ?></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>

	<div class="col-sm-8">
		<div class="card">
			<div class="card-body">
				<div class="card-widgets">
					<button class="btn btn-primary btn-sm" disabled="" id="save-cash-count"><i class="mdi mdi-check mr-1"></i>Save</button>
				</div>
				<h4 class="header-title mb-3">Cash Count</h4>

				<div class="row mb-3">
					<div class="col-5">Denomination</div>
					<div class="col-3">QTY</div>
					<div class="col-4">Amount</div>
				</div>

				<div class="row mb-2 baris">
					<div class="col-5">
						<div class="input-group">
							<div class="input-group-prepend">
								<a href="JavaScript:void(0)" class="btn btn-primary add-row"><i class="mdi mdi-plus-circle"></i></a>
								<a href="JavaScript:void(0)" class="btn btn-danger remove-row"><i class="mdi mdi-minus-circle"></i></a>
								<span class="input-group-text">
									Rp
								</span>
							</div>
							<input type="text" name="nominal[]" class="form-control autonumber text-right" data-a-sep="." data-a-dec="," data-m-dec="0">
						</div>
					</div>
					<div class="col-3">
						<input type="text" name="qty[]" class="form-control">
					</div>
					<div class="col-4">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Rp</span>
							</div>
							<input type="text" name="amount[]" class="form-control autonumber text-right" data-a-sep="." data-a-dec="," data-m-dec="2" readonly="">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-8 text-right">
						<strong>Total:</strong>
					</div>
					<div class="col-4 text-right autonumber" data-a-sep="." data-a-dec="," data-m-dec="2" data-a-sign="Rp " id="total"></div>
				</div>
			</div>
		</div>
	</div>
</div>