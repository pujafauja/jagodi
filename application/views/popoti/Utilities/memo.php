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
									<input type="text" name="no" class="form-control" value="<?php echo getNoFormat('MEMO') ?>">
								</div>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-row">
								<div class="col-12 col-md-3">
									<label for="" class="form-control-label">Applicant <span class="text-danger">*</span></label>
								</div>
								<div class="col-md-9">
									<input type="text" name="pemohon" class="form-control">
								</div>
							</div>
						</div>
						
					</div>
					<div class="row mb-3">
						<div class="col-12 col-md-6">
							<div class="form-row">
								<div class="col-12 col-md-3">
									<label for="" class="form-control-label">Category <span class="text-danger">*</span></label>
								</div>
								<div class="col-md-9">
									<select name="kategori" id="" class="form-control">
										<option value="4">Income</option>
										<option value="5">Outcome</option>
									</select>
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
										<input type="text" name="tanggal" class="form-control basic-datepicker">
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
									<label for="" class="form-control-label">Description <span class="text-danger">*</span></label>
								</div>
								<div class="col-12 col-md-9">
									<textarea name="keterangan" id="" class="form-control"></textarea>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-row">
								<div class="col-12 col-md-3">
									<label for="" class="form-control-label">Amount <span class="text-danger">*</span></label>
								</div>
								<div class="col-md-9">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">Rp</span>
										</div>
										<input type="text" name="amount" class="form-control autonumber" data-a-sep="." data-a-dec=",">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="card-body text-right">
				<button class="btn btn-primary submit-memo"><i class="mdi mdi-check mr-1"></i>Save</button>
			</div>
		</div>
	</div>
</div>