<div class="row">
	<div class="col">
		<div class="card-box">
			<!-- <div class="card-header">Intensive & Reward</div> -->
			<div class="card-body">
				<div class="d-inline mb-2">
					<a href="<?php echo site_url() ?>hrd/add-item" id="TambahItem" class="btn btn-primary waves-effect waves-light ml-3"><i class="mdi mdi-plus-circle mr-1"></i> Add Item</a>
				</div>
				<p></p>
				<div class="table-responsive">
					<table id="bonus" class="table table-sm w-100">
					<thead>
						<tr>
							<th style="vertical-align: center" rowspan="2">Keterangan</th>
							<th colspan="<?php echo count($category) ?>">Target</th>
							<?php foreach ($this->hrd->getachiev() as $key => $value): ?>								
								<th colspan="4">Insentif <?php echo $value['nominal'] ?>%</th>  
							<?php endforeach ?>
							<th rowspan="2">Action</th>
						</tr>
						<tr>
							<?php foreach ($category as $key => $value): ?>
								<th><?php echo $value['nama'] ?></th>
							<?php endforeach ?>
							<?php for($i = 1; $i <= count($this->hrd->getachiev()); $i++): ?>
								<?php foreach ($category as $key => $value): ?>
									<th colspan="2"><?php echo $value['nama'] ?></th>
								<?php endforeach ?>
							<?php endfor ?>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($this->hrd->getinsentif() as $key => $value): ?>
							<tr>
								<td><?php echo $value['nama'] ?></td>
								<?php $insdet = $this->hrd->getinsentifdetail($value['id']); ?>
								<?php foreach ($insdet as $key => $detailint): ?>								
									<td>Rp. <?php echo rupiah($detailint['target']) ?></td>
								<?php endforeach ?>
								<?php foreach($achiev as $ach): ?>
									<?php foreach ($insdet as $key => $dint): ?>								
										<?php $insentif = sql_get_var('tb_insentif_achiev_detail', 'nominal', ['insentif_detail_id' => $dint['id'], 'achiev_id' => $ach['id']]); ?>
										<td><?php echo rupiah(($insentif / 100) * $dint['target']) ?></td>
										<td><?php echo $insentif ?>%</td>
									<?php endforeach ?>
								<?php endforeach ?>
								<td>
									<div class="btn-group-sm btn-group">
										<a href="<?php echo base_url() ?>hrd/add-item/<?php echo $value['id'] ?>" id="EditItem" class="btn btn-sm btn-info waves-effect waves-light"><i class="fas fa-pen-square mr-1"></i></a>
										<a href="<?php echo base_url() ?>hrd/delete_item/<?php echo $value['id'] ?>" id="DeleteItem" class="btn btn-sm btn-danger waves-effect waves-light"><i class="fas fa-trash-alt mr-1"></i></a>
									</div>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
				</div>
				
			</div>
		</div>
	</div>
</div>

