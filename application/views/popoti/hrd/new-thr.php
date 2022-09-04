	<div class="row">
	    <div class="col">
	        <div class="card">
	            <div class="card-body">
	                <div class="row">
	                    <div class="col-4">
	                        <div class="form-group">
	                            <label for=""> Year </label>
	                            <div class="input-group">
	                                <input type="text" name="month" id="getThrByYear" class="form-control" data-provide="datepicker" data-date-min-view-mode="2" />
	                                <div class="input-group-addon">
	                                    <button id="refresh-thr" class="btn btn-primary"><i class="fa fa-sync"></i></button>
	                                </div>                                    
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>Employee</th>
								<th>Position</th>
								<th>Years Of Service</th>
								<th>Total THR</th>
								<th>Policy</th>
							</tr>
						</thead>
						<tbody id="tb-transaction-thr">
							
						</tbody>
						<tfoot>
							<tr>
								<th colspan="3" class="text-right">Grand Total</th>
								<th colspan="2" id="grandtotal"></th>
							</tr>
						</tfoot>
					</table>
					<div class="row">
						<div class="col text-right">
							<button id="confirm-thr" class="btn btn-success" disabled=""><i class="fa fa-check mr-2"></i>Confirm</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
