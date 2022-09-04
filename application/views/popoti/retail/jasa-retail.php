<form action="<?php echo base_url('Retail/retail-data') ?>" id="add" method="POST">

<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>No. Nota <span class="text-danger">*</span></label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<i class="fas fa-receipt"></i>
									</span>
								</div>
								<input type="text" name="nomor_nota" id="nomor_nota" value="<?php echo getNoFormat('RTL'); ?>" readonly="" class="form-control">
								<input type='hidden' name='userid' id="userid" class='form-control' id='userid' value="<?php echo $this->session->userdata('user') ?>">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Date Time <span class="text-danger">*</span></label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<i class="fas fa-calendar"></i>
									</span>
								</div>
								<input type='text' name='tanggal' id="tanggal" class='form-control' id='tanggal' value="<?php echo date('Y-m-d H:i:s'); ?>" readonly="">
							</div>
						</div>
					</div>
				</div>
				<div class="row text-right">
					<div class="col-12">
						<button class="btn btn-success mt-3 mb-3" id="new-transaction"><i class="fe-plus-square"></i> New Transaction (F4)</button>						
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">&nbsp;</div>
					<div class="col-md-6">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<a class="btn btn-primary popup-item" href="<?php echo base_url('Retail/retail') ?>"><i class="fas fa-search"></i></a>
							</div>
							<input type="text" name="" class="form-control" placeholder="Type something or click button on side (F9)" id="find-item">
						</div>
					</div>
				</div>

				<table class="table table-striped table-ordered table-sm" id="tbl-transaction">
					<thead>
						<tr>
							<th width="30%">Name</th>
							<th width="20%">Price</th>
							<th width="10%">QTY</th>
							<th width="20%">Discount</th>
							<th width="20%">Subtotal</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
				<div id="box-total">
					<div class="row">
						<div class="col-md-8">
							<div class="row">
								<div class="col-sm-6 text-right">Total:</div>
								<div class="col-sm-6 text-right">Rp <span class="autonumber" id="Total" data-a-sep="." data-a-dec="," data-m-dec="0">0</span></div>
							</div>
							<div class="row border-bottom">
								<div class="col-sm-6 text-right">Discount:</div>
								<div class="col-sm-6 text-right text-danger">Rp <span class="autonumber" id="Discount" data-a-sep="." data-a-dec="," data-m-dec="0">0</span></div>
							</div>
							<div class="row">
								<div class="col-sm-6 text-right"><h4>Grandtotal</h4></div>
								<div class="col-sm-6 text-right"><h4>Rp <span id="grand" class="autonumber" data-a-sep="." data-a-dec="," data-m-dec="0">0</span></h4></div>
							</div>
						</div>
						<div class="col-md-4">
							<button class="btn btn-payment btn-blue" disabled="">
								<i class="fe-credit-card"></i> <br> Save (Enter)
							</button>
	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

</div>

<style type="text/css">
	.btn-payment {
		width: 100%;
		height: 82px;
	}
	.btn-payment i {
		font-size: xx-large;
	}

</style>