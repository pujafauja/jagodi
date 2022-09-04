<div class="row">
    <div class="col-lg-12">

        <form action="<?php echo site_url('Utilities/quit-stationery/') ?>" method="post" id="form-item">

               <div class="form-group">
                            <label for="simpleinput"> Date <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" id="simpleinput" readonly="" name="tanggal" value="<?php echo date("d-m-Y"); ?>" class="form-control basic-datepicker">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fe-calendar"></i></span>
                                </div>
                            </div>
                        </div>
            

			<legend>Chosee Item</legend>

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

						<select name="item[]" id="" class="form-control">
							<option value="">Select Item</option>
							<?php
							if($select->num_rows() > 0):
								foreach($select->result() as $al): ?>
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

						</div>

						<input type="text" name="stock[]" class="form-control">

					</div>

				</div>

			</div>
       

          <div id='ResponseInput'></div>


<script src="<?php echo base_url() ?>assets/js/vendor.min.js"></script>
<script src="<?php echo base_url('assets/libs/autonumeric/autoNumeric-min.js') ?>"></script>

<!-- <script src="<?php echo base_url('assets/js/pages/form-masks.init.js') ?>"></script> -->

