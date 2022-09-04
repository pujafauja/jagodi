<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="card-widgets">
					<a href="#header" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="header"><i class="mdi mdi-minus"></i></a>
				</div>
				<a data-toggle="collapse" href="#header" role="button" aria-expanded="false" aria-controls="header">
				    <h5 class="card-title mb-0">
				        <i class="mdi mdi-clipboard-list mr-1"></i>
				        <span class="d-none d-sm-inline">Header</span>
				    </h5>
				</a>

				<div id="header" class="collapse pt-3 show">
					<div class="row mb-3">
						<div class="col-12 col-md-6">
							<div class="form-row">
								<div class="col-12 col-md-3">
									<label for="" class="form-control-label">No. <span class="text-danger">*</span></label>
								</div>
								<div class="col-md-9">
									<input type="text" name="no" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-row">
								<div class="col-12 col-md-3">
									<label for="" class="form-control-label">Date <span class="text-danger">*</span></label>
								</div>
								<div class="col-md-9">
									<div class="input-group">
										<input type="text" name="tanggal" class="form-control" id="basic-datepicker">
										<div class="input-group-append">
											<span class="input-group-text"><i class="icon-calender"></i></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-md-6">
							<div class="form-row">
								<div class="col-12 col-md-3">
									<label for="" class="form-control-label">Description</label>
								</div>
								<div class="col-12 col-md-9">
									<textarea name="keterangan" id="" class="form-control"></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<div class="card-widgets">
					<button class="btn btn-primary btn-sm submit mr-2 submit-jurnal" data-status="0" disabled=""><i class="mdi mdi-content-save mr-1"></i>Save</button>
					<button class="btn btn-warning btn-sm submit mr-2 submit-jurnal" data-status="1" disabled=""><i class="mdi mdi-content-save-alert mr-1"></i>Save & Approve</button>
					<a href="#jurnal" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="jurnal"><i class="mdi mdi-minus"></i></a>
				</div>
				<a href="#jurnal" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="jurnal">
					<h5 class="card-title mb-0">
						<i class="mdi mdi-format-list-checkbox mr-1"></i>
						<span class="d-none d-sm-inline">Journal</span>
					</h5>
				</a>

				<div id="jurnal" class="collapse pt-3 show">
					<div class="row mb-3">
						<div class="col-6">Account</div>
						<div class="col-3">Debit</div>
						<div class="col-3">Credit</div>
					</div>
					<div class="row baris mb-3">
						<div class="col-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<button class="btn btn-primary add-row"><i class="mdi mdi-plus-circle"></i></button>
									<button class="btn btn-danger remove-row"><i class="mdi mdi-minus-circle"></i></button>
								</div>
								<select name="akunid[]" id="" class="form-control">
									<option value="">Select Account</option>
									<?php
									if($coa->num_rows() > 0):
										foreach($coa->result() as $akun): ?>
											<option value="<?php echo $akun->id ?>"><?php echo "$akun->kode - $akun->nama" ?></option>
										<?php endforeach;
									endif;
									?>
								</select>
							</div>
						</div>
						<div class="col-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">Rp</span>
								</div>
								<input type="text" name="debit[]" class="form-control autonumber" data-a-sep="." data-a-dec=",">
							</div>
						</div>
						<div class="col-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">Rp</span>
								</div>
								<input type="text" name="kredit[]" class="form-control autonumber" data-a-sep="." data-a-dec=",">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-6 text-right"><strong>Total:</strong></div>
						<div class="col-3 text-right"><strong><span class="autonumber total-debit" data-a-sep="." data-a-dec="," data-a-sign="Rp ">0</span></strong></div>
						<div class="col-3 text-right"><strong><span class="autonumber total-kredit" data-a-sep="." data-a-dec="," data-a-sign="Rp ">0</span></strong></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Plugins js-->
<script src="<?php echo base_url('assets/libs/autonumeric/autoNumeric-min.js') ?>"></script>
<script src="<?php echo base_url('assets/libs/flatpickr/flatpickr.min.js') ?>"></script>
<script src="<?php echo base_url('assets/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') ?>"></script>
<script src="<?php echo base_url('assets/libs/clockpicker/bootstrap-clockpicker.min.js') ?>"></script>
<script src="<?php echo base_url('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>

<!-- Init js-->
<script src="<?php echo base_url('assets/js/pages/form-pickers.init.js') ?>"></script>

<!-- Init js-->
<script src="<?php echo base_url('assets/js/pages/form-masks.init.js') ?>"></script>