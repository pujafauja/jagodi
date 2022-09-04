<form action="<?php echo site_url('Utilities/other-inventory/'.$id) ?>" method="post" id="form-item">
	<div class="form-group">
		<label for="">Action <span class="text-danger">*</span></label>
		<select name="type" id="" class="form-control">
			<option value=""> >----------------- Select Option -----------------< </option>
			<option value="soldout">Sold Out</option>
			<option value="damaged">Damaged</option>
		</select>
	</div>
	<div class="form-group">
		<label for="">COA <span class="text-danger">*</span></label>
		<select name="coa" id="" class="form-control">
			<option value=""> >----------------- Select COA -----------------< </option>
			<?php if ($alias->num_rows()): ?>
				<?php foreach ($alias->result() as $key => $value): ?>
					<option value="<?php echo $value->id ?>"><?php echo $value->kode.' '.$value->nama ?></option>
				<?php endforeach ?>
			<?php endif ?>
			
		</select>
	</div>
	<div class="form-group">
	    <label for="simpleinput">Nominal <span class="text-danger">*</span></label>
	    <div class="input-group">
	        <div class="input-group-prepend">
	            <span class="input-group-text">Rp</span>
	        </div>
	        <input type="text" name="nominal"  class="form-control autonumber" data-a-sep='.' data-a-dec="," data-m-dec="0" >
	    </div>
	</div>  
</form>
<div id='ResponseInput'></div>
<script src="<?php echo base_url() ?>assets/js/vendor.min.js"></script>

<script src="<?php echo base_url('assets/libs/autonumeric/autoNumeric-min.js') ?>"></script>
