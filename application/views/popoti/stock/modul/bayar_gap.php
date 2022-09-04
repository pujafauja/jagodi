<form id="input-cost">
<div class="row">
	<div class="col-12">
		<div class="form-group">
			<label>Bill</label>
			<div class="input-group input-group-lg">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroup-sizing-lg">Rp</span>
				</div>
				<input type="text" name="grandtotal" id="grandtotal" value="<?php echo $bill ?>" class="form-control text-right autonumber" data-a-sep="." data-a-dec="," data-m-dec="2" readonly="">
			</div>
		</div>
		<fieldset>
			<legend>Choose </legend>
			<div class="row">
				<div class="col">
					<div class="form-group">
					 	<div class="input-group">
						 	<select name="" id="choose" class="form-control">
						 		<option value="biaya">Cost</option>
						 		<option value="ar">Recievable</option>
						 	</select>
					 		<div class="input-group-addon">
					 			<button class="btn btn-success add-row">
					 				<i class="mdi mdi-plus"></i>
					 			</button>
					 		</div>
					 	</div>
					 </div>
				</div>
			</div>
			<div  id="form-cost">
			
			</div>
		</fieldset>
		<div class="form-group mt-3">
			<label for="">Total Cost</label>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">Rp</span>
				</div>
				<input type="text" name="" disabled="" class="form-control text-right" id="received" data-a-sep="." data-a-dec="," data-m-dec="2">
			</div>
		</div>
		<input type="hidden" name="location" value="<?php echo $location ?>">
		<label for="">Supply <span class="text-danger">*</span></label>
		<div class="row mb-2">
			<div class="col-md-8">
				<select name="supply" id="choose" class="form-control">
			 		<option value="" class="text-center">>----------- Select Supply -----------<</option>
			 		<?php foreach ($supply as $key => $value): ?>
			 			<option value="<?php echo $value->id ?>"><?php echo $value->nama ?></option>
			 		<?php endforeach ?>
			 	</select>
			</div>
			<div class="col-md-4">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Rp</span>
					</div>
					<input type="text" name="amount-supply" value="<?php echo $bill ?>" readonly class="form-control autonumber" data-a-sep="." data-a-dec="," data-m-dec="2">
				</div>
			</div>
		</div>

		<div class="mt-3" id="response"></div>
	</div>
</div>
</form>
<script src="<?php echo base_url('assets/libs/autonumeric/autoNumeric-min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/pages/form-masks.init.js') ?>"></script> 
