<div class="row">
	<div class="col-lg-12">
		<form action="<?php base_url('stock/receive') ?>" method="post" id="receive">
			<div class="card">
				<div class="card-body">
					<div class="card-widgets">
                        <button type="button" class="btn btn-sm btn-primary mr-3 retrieve-data">
                        	<i class="fas fa-search mr-1"></i>
                        	Retrieve
                        </button>
                        <a data-toggle="collapse" href="#header" role="button" aria-expanded="false" aria-controls="header"><i class="mdi mdi-minus"></i></a>
					</div>
					<a data-toggle="collapse" href="#header" role="button" aria-expanded="false" aria-controls="header">
					    <h5 class="card-title mb-0">
					        <i class="mdi mdi-card-bulleted-settings mr-1"></i>
					        <span class="d-none d-sm-inline">Header</span>
					    </h5>
					</a>
                    <div id="header" class="collapse pt-4 show">
                    	<div class="row">
                    		<div class="col-md-6">
                    			<div class="form-group row">
                    				<label for="" class="col-md-3">Receipt No. <span class="text-danger">*</span></label>
                    				<div class="col-md-9">
                    					<input type="text" disabled="" value="<?php echo getNoFormat('RCV') ?>" name="no" class="form-control">
                    				</div>
                    			</div>
                    			<div class="form-group row">
                    				<label for="" class="col-md-3">Receipt Date. <span class="text-danger">*</span></label>
                    				<div class="col-md-9">
                    					<div class="input-group">
	                    					<input type="text" name="tanggal" disabled="" value="<?php echo date('Y-m-d') ?>" class="form-control basic-datepicker">
	                    					<div class="input-group-append">
	                    						<span class="input-group-text"><i class="fas fa-calendar"></i></span>
	                    					</div>
	                    				</div>
                    				</div>
                    			</div>
                    		</div>
                    		<div class="col-md-6">
                    			<div class="form-group row">
                    				<label for="" class="col-md-3">Purchase Order No.</label>
                    				<div class="col-md-9">
            							<a href="<?php echo base_url('purchase/popup-po?direct-retrieve=1') ?>" class="btn btn-sm btn-primary popup-po"><i class="fas fa-search mr-1"></i>Find & Retrieve</a>
                    				</div>
                    			</div>
                    			<div class="form-group row">
                    				<label for="" class="col-md-3">Due Date</label>
                    				<div class="col-md-9">
                    					<div class="input-group">
                    						<input type="text" name="due_date" class="form-control basic-datepicker">
                    					</div>
                    				</div>
                    			</div>
                    			<div class="form-group row">
                    				<label for="" class="col-md-3">Supllier</label>
                    				<div class="col-md-9">
                    					<div class="input-group">
<!--                     						<div class="input-group-prepend">
                    							<a href="<?php //echo base_url('sparepart/supplier-popup?direct-retrieve=1') ?>" class="btn btn-primary popup-supplier"><i class="fas fa-search"></i></a>
                    						</div>
 -->                    						<input type="text" name="supplier" class="form-control cari-supplier" disabled="">
	                    					<input type="hidden" name="supplierid" class="form-control">
<!-- 	                    					<div class="input-group-append">
	                    						<button class="btn btn-dangxer clear-supplier" type="button"><i class="fas fa-ban"></i></button>
	                    					</div>
 -->	                    				</div>
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
                        <button type="submit" class="btn btn-sm btn-primary mr-3" disabled="">
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
	                    			<table class="table table-bordered table-sm po-detail" id="">
	                    				<thead>
	                    					<tr>
	                    						<th>
	                    							<div class="checkbox checkbox-single checkbox-primary">
		                    							<input type="checkbox" name="" class="check-all" aria-label="Single checkbox One">
		                    							<label for=""></label>
		                    						</div>
	                    						</th>
	                    						<th colspan="2">Parts</th>
	                    						<th>ABC</th>
	                    						<th>Purchase Order No.</th>
	                    						<th>Order Date</th>
	                    						<th>Order QTY</th>
	                    						<th>Receipt QTY</th>
	                    						<th>Receipt Price</th>
                                                <th>Register Location</th>
	                    						<th>Subtotal</th>
	                    					</tr>
	                    				</thead>
	                    				<tbody></tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="10" class="text-right align-middle"><h4>Grand Total</h4></th>
                                                <th class="align-middle"><h4>Rp. <span data-a-sep="." data-a-dec="," data-m-dec="2" class="autonumber" id="grandtotal-receive"></span></h4></th>
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