<div class="row">

	<div class="col-12">

		<div class="form-group">

			<label>Payment</label>

			<div class="input-group input-group-lg">

				<div class="input-group-prepend">

					<span class="input-group-text" id="inputGroup-sizing-lg">Rp</span>

				</div>

				<input type="text" name="" id="grandtotal" value="<?php echo $ar->amount ?>" class="form-control text-right autonumber" data-a-sep="." data-a-dec="," data-m-dec="2" readonly="">

			</div>

		</div>

		<fieldset>

			<legend>Receive Payment</legend>

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

						<select name="aliasid" id="" class="form-control">
							<option value="">Select Account</option>
							<?php
							if($alias->num_rows() > 0):
								foreach($alias->result() as $al): ?>
									<option value="<?php echo $al->id ?>"><?php echo $al->nama ?></option>
								<?php endforeach;
							endif;
							?>
						</select>

					</div>

				</div>

				<div class="col-md-6">

					<div class="input-group">

						<div class="input-group-prepend">

							<span class="input-group-text">Rp</span>

						</div>

						<input type="text" name="" class="form-control autonumber" data-a-sep="." data-a-dec="," data-m-dec="2">

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