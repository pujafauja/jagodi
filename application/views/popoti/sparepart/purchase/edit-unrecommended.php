<div class="row">
	<div class="col-lg-12">
		<form action="<?php base_url('purchase/unrecommended/'.encode($purchase->id)) ?>" method="post" id="recommended-order">
			<div class="card">
				<div class="card-body">
					<div class="card-widgets">
                        <a data-toggle="collapse" href="#header" role="button" aria-expanded="false" aria-controls="header"><i class="mdi mdi-minus"></i></a>
					</div>
					<a data-toggle="collapse" href="#header" role="button" aria-expanded="false" aria-controls="header">
					    <h5 class="card-title mb-0">
					        <i class="mdi mdi-card-bulleted-settings mr-1"></i>
					        <span class="d-none d-sm-inline">Header</span>
					    </h5>
					</a>
                    <div id="header" class="collapse pt-3 show">
                    	<div class="row">
                    		<div class="col-md-6">
                    			<div class="form-group row">
                    				<label for="" class="col-md-3">Purchase No. <span class="text-danger">*</span></label>
                    				<div class="col-md-9">
                						<input type="text" name="no" value="<?php echo getNoFormat('NPO') ?>" readonly class="form-control">
                    				</div>
                    			</div>
                    			<div class="form-group row">
                    				<label for="" class="col-md-3">Supplier <span class="text-danger">*</span></label>
                    				<div class="col-md-9">
                    					<div class="input-group">
                    						<div class="input-group-prepend">
                    							<a href="<?php echo base_url('sparepart/supplier-popup') ?>" class="btn btn-primary popup-supplier"><i class="fas fa-search"></i></a>
                    						</div>
                    						<input type="text" name="supplier" class="form-control cari-supplier">
	                    					<input type="hidden" name="supplierid" class="form-control">
	                    				</div>
                    				</div>
                    			</div>                    			
                    		</div>
                    		<div class="col-md-6">
                    			<div class="form-group row">
                    				<label for="" class="col-md-3">Delivery Plan Date <span class="text-danger">*</span></label>
                    				<div class="col-md-9">
                    					<div class="input-group">
                    						<input type="text" name="date-plan" class="form-control basic-datepicker">
                    						<div class="input-group-append">
                    							<span class="input-group-text"><i class="fas fa-calendar"></i></span>
                    						</div>
                    					</div>
                    				</div>
                    			</div>
                    			<div class="form-group row">
                    				<label for="" class="col-md-3">Memo</label>
                    				<div class="col-md-9">
                    					<input type="text" name="memo" class="form-control">
                    				</div>
                    			</div>
                    		</div>
                    	</div>
                    </div>
				</div>
			</div>

			<div class="card">
				<div class="card-body">
					<div class="card-widgets">
						<a class="popup-item btn btn-sm btn-danger text-light mr-3" href="<?php echo base_url('sparepart/popup') ?>">
							<i class="mdi mdi-plus"></i>
						</a>
                        <button type="submit" class="btn btn-sm btn-primary mr-3" disabled="" data-back="<?php echo base_url('purchase/unrecommended') ?>">
                        	<i class="mdi mdi-check mr-1"></i>
                        	Confirm
                        </button>
                        <a data-toggle="collapse" href="#detail" role="button" aria-expanded="false" aria-controls="detail"><i class="mdi mdi-minus"></i></a>
					</div>
					<a data-toggle="collapse" href="#detail" role="button" aria-expanded="false" aria-controls="detail">
					    <h5 class="card-title mb-0">
					        <i class="mdi mdi-clipboard-list mr-1"></i>
					        <span class="d-none d-sm-inline">Detail</span>
					    </h5>
					</a>
                    <div id="detail" class="collapse pt-4 show">
                    	<div class="row">
                    		<div class="col-lg-12">
                    			<div class="table-responsive">
	                    			<table class="table table-bordered table-sm po-detail" id="inline-editable">
	                    				<thead>
	                    					<tr>
	                    						<th>
	                    							<div class="checkbox checkbox-single checkbox-primary">
		                    							<input type="checkbox" name="" class="check-all" aria-label="Single checkbox One">
		                    							<label for=""></label>
		                    						</div>
	                    						</th>
	                    						<th colspan="2">Parts</th>
	                    						<th>Price</th>
                                                <th>QTY</th>
                                                <th>Subtotal</th>
	                    					</tr>
	                    				</thead>
	                    				<tbody></tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-right" style="vertical-align: middle;" colspan="5"><h4>Grand Total</h4></th>
                                                <th><h4 data-a-sep="." data-a-dec="," data-m-dec="0" class="autonumber" id="grandtotal" data-a-sign="Rp "></h4></th>
                                            </tr>
                                        </tfoot>
	                    			</table>
	                    		</div>
                    		</div>
                    	</div>
                    </div>
				</div>
			</div>
		</form>
	</div>
</div>