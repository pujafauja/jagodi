<div class="row">
	<div class="col-12">
		<form action="<?php echo base_url() ?>service/new-retail" id="form-retail" method="post">
			<div class="card-box">
				<div class="card-body">
					<div class="row">
	                    <div class="col-12 ">
	                        <div class="form-group">
	                            <label for="">Mobile Phone <span class="text-danger">*</span></label>
	                            <div class="input-group">
	                                <div class="input-group-append">
	                                    <button type="button" id="customers" href="<?php echo base_url('customer/customers') ?>" class="btn btn-primary"><i class="fa fa-search"></i></button>
	                                </div>
	                                <input type="text" class="form-control" name="no-hp" id="no">
	                                <input type="hidden" name="customerid">
	                                <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" id="reesetcustomer"><i class="fa fa-times"></i></button>
                                    </div>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label for="">Customer Name <span class="text-danger">*</span></label>
	                            <input type="text" class="form-control" name="cust-nama">
	                            <input type="hidden" name="hassave">
	                        </div>
	                        <input type="hidden" name="iscustomer" value="false">
	                        <div class="form-group">	
	                            <label for="">District, Subdisctrict, City, Province <span class="text-danger">*</span></label>
	                            <input type="text" class="form-control" name="district">
	                            <input type="hidden" name="district-id">
	                        </div>
	                        <p>Last Service :  <span id="last_service"></span> </p>
	                        <p>Come To Dealer : <span id="total_come"></span> </p>
	                    </div> <!-- end col -->
	                </div> <!-- end row -->   
				</div>
			</div>
			<div class="card-box">
				<div class="card-body">
	                <div class="form-group">
	                    <label for="technician">Parts Detail</label>
	                    <div class="input-group">
	                        <div class="input-group-append">
	                            <button type="button" id="btn-parts" href="<?php echo base_url('service/show-parts') ?>" class="btn btn-primary"><i class="fa fa-search"></i></button>
	                        </div>
	                        <input type="text" name="parts" class="form-control" id="parts">
	                    </div>

	                </div>
	                <table class="table">
	                    <thead>
	                        <tr>
                                <th>Kode Barang</th>
                                <th>Parts</th>
                                <th>Het</th>
                                <th>Qty</th>
                                <th>Disc</th>
                                <th>On Hand Qty</th>
                                <th>Picking Qty</th>
                                <th>Selling Price</th>
                            </tr>
	                    </thead>
	                    <tbody id="spk-parts"> 
	                    </tbody>
	                </table>
					<div class="text-right">
						<button id="clear" class="btn btn-danger"><i class="fa fa-trash"></i> New Order</button>
						<button id="confirmretail" class="btn btn-success" data-status="0" type="submit">Confirm</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>