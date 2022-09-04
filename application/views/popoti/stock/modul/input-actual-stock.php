<?php $exist = $this->stock_model->exist_location($id); ?>
<div class="row">
	<div class="col">
		<div class="card-box">
			<div class="card-body">
				<table id="actual-editable" class="table table-centered mb-0" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Sparepart</th>
                            <th class="no-sort">Actual Stock</th>
                        </tr>
                    </thead>
                    <form id="form-actual">
                    <input type="hidden" name="hassave">
                    <tbody>
                        <?php if($item->num_rows() > 0): ?>
                            <?php $no = 1; foreach($item->result() as $it): ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $it->kode ?></td>
                                    <td><?php echo $it->nama ?></td>
                                    <input type="hidden" name="id[]" value="<?php echo encode($it->id) ?>">
                                    <input type="hidden" name="sparepartid[<?php echo encode($it->id) ?>]" value="<?php echo encode($it->sparepartid) ?>">
                                    <td>
                                        <input type="text" class="form-control-sm actual form-control" name="actual[<?php echo encode($it->id) ?>]" style="width: 100px">
                                    </td>
                                </tr>
                            <?php $no++; endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                    </form>
                </table>
                <div class="row">
                    <div class="col text-right">
                            <a href="<?php echo base_url('stock/actual-stock') ?>" class="btn btn-info">
                                <i class="fa fa-arrow-left mr-2"></i>Back
                            </a>
                            <a href="<?php echo base_url('stock/confirm-actual/'.$id) ?>" class="btn btn-primary" id="add-actual">
                                <i class="fa fa-check mr-2"></i>Confirm
                            </a>
                            <a href="<?php echo base_url('stock/print-actual/'.$id.'/1') ?>" class="btn btn-success" id="print-actual">
                                <i class="fa fa-print mr-2"></i>Print
                            </a> 
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>