<form method="post" id="form-item" action="<?php echo site_url('hrd/add_item') ?>">
	<div class="form-group">
		<label for="ket">Position</label>
		<select name="keterangan" id="" class="form-control">
			<?php foreach ($position as $key => $ps): ?>			
				<option value="<?php echo $ps['id'] ?>"><?php echo $ps['nama'] ?></option>
			<?php endforeach ?>
		</select>
	</div>
	<table class="table">
		<thead>
			<tr>
				<th>Category Insetif</th>
				<th>Target</th>
				<?php foreach ($achiev as $key => $ac): ?>
					<th>Insentif <?php echo $ac['nominal'] ?>%</th>
				<?php endforeach ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($category as $cat): ?>
			<tr>
				<td>
					<input type="text" class="form-control" name="category[<?php echo $cat['id'] ?>]" readonly value="<?php echo $cat['nama'] ?>">
				</td>
				<td>					
					<div class="input-group">
						<div class="input-group-addon">
							<div class="input-group-text">Rp. </div>
						</div>
						<input type="text" class="form-control autonumber" data-a-sep="." data-a-dec="," data-m-dec="0" name="nominal[<?php echo $cat['id'] ?>]" >						
					</div>
				</td>
				<?php foreach ($achiev as  $ac): ?>
					<td>
						<div class="input-group">
							<input type="text" name="achiev[<?php echo $cat['id'] ?>][<?php echo $ac['id'] ?>]" class="form-control">
							<div class="input-group-addon">
								<div class="input-group-text">%</div>
							</div>
						</div>
					</td>
				<?php endforeach ?>
			</tr>
		<?php endforeach ?>
		</tbody>
		
	</table>
	<div id="ResponseInput"></div>
</form>

<script src="<?php echo base_url('assets/libs/autonumeric/autoNumeric-min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/pages/form-masks.init.js') ?>"></script>
