<div class="row">
	<div class="col">
		<div class="card-box">
			<div class="card-body">
				<table id="opnameLocation" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="no-sort">Location</th>
                            <th class="no-sort">Status</th> 
                            <th>Last Opname</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo nestedLocation($location); ?>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col text-right mt-3">
                        <?php $exist = $this->stock_model->exist(); ?>
                        <?php $existPrint = ($exist) ? false : true ?>
                        <?php $existAdd = ($exist) ? true : false ?>

                            <a href="<?php echo base_url('stock/add-opname') ?>" class="btn btn-primary <?php echo ($existAdd) ? 'disabled' : '' ?> mb-2" id="add-opname"><i class="fa fa-plus mr-2"></i>Add Opname</a>

                            
                            <a href="<?php echo base_url('stock/add-opname/1') ?>" class="btn <?php echo ($existPrint) ? 'disabled' : '' ?> btn-success mb-2" id="print-opname"><i class="fa fa-print mr-2"></i>Print</a>                        
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>