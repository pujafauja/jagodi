<?php if ($is_print): ?>
	
<div class="mt-2 mx-3">
	<div class="row">
	<div class="col-5 ml-2">
		<div class="row">
			<div class="col border border-dark" style="border-width: 4px !important;">
				<div class="row">
					<div class="col"><h3> <?php echo $company['title'] ?>  </h3><hr style="margin: -3px 0px 3px 0px; width: 85%;border-color: black;border-width: 1px;"></div>
				</div>
				<div class="row">
					<div class="col mb-1 text-left"><?php echo $company['address'].' - '.$company['phone'] ?></div>			
				</div>
			</div>
		</div>
	</div>

	<div class="col-4 offset-2 text-right">
		<h2 class="pt-3 pb-0 pl-3 pr-0 text-right">Opname</h2>
		<h3 class=""><?php echo date('d/m/Y') ?></h3>
	</div>

</div>
<?php endif ?>

<hr class="border border-dark border-2 mb-2">

<table class="table">
	<thead>
		<tr>
			<th>No</th>
			<th>Kode</th>
			<th>Sparepart</th>
			<th>Location</th>
			<th>Actual Stock</th>
		</tr>
	</thead>
	<tbody>
		<?php if ($data->num_rows()): ?>
			<?php $no = 1;foreach ($data->result() as $key => $value): ?>
				<tr>
					<td><?php echo $no++ ?></td>
					<td><?php echo $value->kode ?></td>
					<td><?php echo $value->nama ?></td>
					<td><?php echo $value->location ?></td>
					<td>(. . . . . . . . . . .)</td>
				</tr>
			<?php endforeach ?>
			<?php else: ?>
				<tr>
					<td colspan="4" class="text-center">Data is empty</td>
				</tr>
		<?php endif ?>
	</tbody>
</table>