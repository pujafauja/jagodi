<form method="post" action="<?php echo base_url('hrd/payroll_pay') ?>">
	<div class="row">
		<div class="col-md-3 col-12">
			<div class="form-group">
				<label for="">Attendance</label>
				<input type="text" name="hadir" class="form-control">
				<input type="hidden" name="bulan" value="<?php echo $bulan ?>">
				<input type="hidden" name="tahun" value="<?php echo $tahun ?>">
				<input type="hidden" name="emloyeeid" value="<?php echo $id ?>">

				<input type="hidden" name="pokok" value="<?php echo $row->pokok ?>">
				<input type="hidden" name="makan" value="<?php echo $row->makan ?>">
				<input type="hidden" name="tunjangan" value="<?php echo $row->tunjangan ?>">
				<input type="hidden" name="transport" value="<?php echo $row->transport ?>">
				<input type="hidden" name="another" value="<?php echo $row->another ?>">
			</div>
		</div>
		<div class="col-md-9 col-12">
			<div class="form-group">
				<label for="">Employee's Fee</label>
				<div class="input-group">
					<div class="input-group-append">
						<div class="input-group-text">Rp. </div>
					</div>
					<input type="text" data-a-sep='.' data-a-dec="," data-m-dec="0" name="gaji" class="autonumber form-control">
				</div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label for="">COA</label>
		<select class="form-control" name="coa" id="">
			<option value="1">Coa</option>
		</select>
	</div>
	<div id="response-input"></div>
</form>
<script src="<?php echo base_url() ?>assets/libs/flot-charts/jquery.js"></script>

<script src="<?php echo base_url('assets/libs/autonumeric/autoNumeric-min.js') ?>"></script>
<script>
	$(document).ready(function() {
		$(document).on('keyup', 'input[name=hadir]', function(event) {
			var hadir = $(this).val()
			var bulan = $('input[name=bulan]').val()
			var tahun = $('input[name=tahun]').val()
			var emloyeeid = $('input[name=emloyeeid]').val()
			var pokok = $('input[name=pokok]').val()
			var makan = $('input[name=makan]').val()
			var tunjangan = $('input[name=tunjangan]').val()
			var transport = $('input[name=transport]').val()
			var another = $('input[name=another]').val()
			var gaji = $('input[name=gaji]')
			var hasil = (hadir * pokok) + (hadir * makan) + (hadir * transport) + tunjangan + another
            $('.autonumber').autoNumeric('init')
 			gaji.autoNumeric('set',hasil)
		});		
	});
</script>				