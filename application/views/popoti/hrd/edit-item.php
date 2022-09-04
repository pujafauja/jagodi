<form method="post" id="form-item" action="<?php echo site_url('hrd/add_item/'.$id) ?>">
	<div class="form-group">
		<label for="ket">Keterangan</label>
		<select name="keterangan" id="" class="form-control">
			<?php foreach ($position as $key => $ps): ?>			
				<?php if ($position_id['position_id'] === $ps['id']): ?>
					<option value="<?php echo $ps['id'] ?>" selected><?php echo $ps['nama'] ?></option>
				<?php else: ?>
				<?php endif ?>
			<?php endforeach ?>
		</select>
	</div>
	<table class="table">
		<thead>
			<tr>
				<th>Keterangan</th>
				<th>Target</th>
				<?php foreach ($achiev as $key => $ac): ?>
					<th>Intensif <?php echo $ac['nominal'] ?>%</th>
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
						<?php $detail = $this->hrd->getinsentifdetail($id,$cat['id']) ?>
						<input type="text" class="form-control autonumber" data-a-sep="." data-a-dec="," data-m-dec="0" value="<?php echo $detail['target'] ?>" name="nominal[<?php echo $cat['id'] ?>]" >						
					</div>
				</td>
				<?php foreach ($achiev as  $ac): ?>
					<td>
						<div class="input-group">
							<input type="text" name="achiev[<?php echo $cat['id'] ?>][<?php echo $ac['id'] ?>]" value="<?php echo $this->hrd->getinsentifachiev($detail['id'],$ac['id'])['nominal'] ?>" class="form-control">
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
