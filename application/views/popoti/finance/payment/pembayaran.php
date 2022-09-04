<div class="row">
	<div class="col-12">
		<div class="form-group row">
			<input type="hidden" name="id" value="<?php echo $id ?>">
			<div class="col-12">
				<label>Bill</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text" id="">Rp</span>
					</div>
					<input type="text" name="grandtotal" id="grandtotal" value="<?php echo $bill ?>" class="form-control text-right autonumber" data-a-sep="." data-a-dec="," readonly="">
				</div>
			</div>
		</div>
		<fieldset>
			<legend><?php echo ($payment->type == 'in') ? 'Income' : 'Outcome'; ?> Payment</legend>
			<div class="row baris mb-1">
				<div class="col-md-6">
					<div class="input-group">
						<div class="input-group-prepend">
							<button class="btn btn-primary new-row">
								<i class="mdi mdi-plus"></i>
							</button>
							<button class="btn btn-danger remove-row">
								<i class="mdi mdi-minus"></i>
							</button>
						</div>
						<select name="aliasid[]" id="" class="form-control">
							<?php
							foreach($detail->result() as $alias): ?>
								<option value="<?php echo $alias->coaid ?>"><?php echo $alias->nama ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Rp</span>
						</div>
						<input type="text" name="amount[]" class="form-control autonumber" data-a-sep="." data-a-dec="," data-m-dec="2">
					</div>
				</div>
			</div>
		</fieldset>
		<div class="form-group mt-3">
			<label for="">Total Receive</label>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">Rp</span>
				</div>
				<input type="text" name="" disabled="" class="form-control" id="received" data-a-sep="." data-a-dec="," data-m-dec="2">
			</div>
		</div>
		<div class="mt-3" id="response"></div>
	</div>
</div>

<script src="<?php echo base_url('assets/libs/autonumeric/autoNumeric-min.js') ?>"></script>

<script src="<?php echo base_url('assets/js/pages/form-masks.init.js') ?>"></script>