<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<table class="table table-centered mb-0" id="picking-editable">
					<thead>
						<tr>
							<th></th>
							<th>Kode Barang</th>
							<th>Parts</th>
							<th>Het</th>
							<th>Qty</th>
							<th>Disc</th>
							<th>On Hand Qty</th>
							<th>Location</th>
							<th>Picking</th>
							<th>Selling Price</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php if ($data): ?>
						<?php $hasAll = true; foreach ($data as $key => $value): ?>
							<?php $hasAll = ($value->pickingqty != 0) ? true : false ?>
							<tr>
								<td><?php echo encode($value->slid).'-'.encode($value->id) ?></td>
								<td><?php echo $value->kode ?></td>
								<td><?php echo $value->nama ?></td>
								<td><?php echo rupiah($value->het) ?></td>
								<td><?php echo $value->qty ?></td>
								<td><span><?php echo rupiah($value->disc) ?></span></td>
								<td><?php echo $value->stock ?></td>
								<td><?php echo $value->location ?></td>
								<td><?php echo ($value->pickingqty) ? $value->pickingqty : $value->qty ?></td>
								<td id="selling-<?php echo $value->id ?>"><?php echo rupiah( (($value->qty * intval($value->het)) -  $value->disc) ) ?></td>
								<td>
									<?php if (!$value->useridpicking): ?>
										<a href="<?php echo base_url() ?>stock/delete-picking/<?php echo encode($value->id) ?>" class="btn delete-picking btn-sm btn-danger"><i class="fa fa-trash"></i></a>
										<?php else: ?>
										<button class="btn btn-sm btn-success">Success</button>
									<?php endif ?>
								</td>
							</tr>
							<span id="empty"></span>
						<?php endforeach ?>
						<?php else: ?>
							<span id="empty">Data Is Empty</span>
						<?php endif ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="justify-content-around">
					<a href="<?php echo base_url() ?>stock/picking" class="btn mt-2 btn-primary">Back</a>
					<a href="<?php echo base_url() ?>stock/approve/<?php echo $id ?>" class="btn mt-2 btn-success">Approve</a>
				</div>
			</div>
		</div>
	</div>
</div>