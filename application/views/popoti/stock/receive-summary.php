<div class="row">
	<div class="col">
		<div class="card-box">
			<div class="card-body">

				<ul class="nav nav-tabs nav-bordered">
					<li class="nav-item">
						<a href="#receive" data-toggle="tab" aria-expanded="true" class="nav-link active">Receive Summary</a>
					</li>
					<li class="nav-item">
						<a href="#order" data-toggle="tab" aria-expanded="false" class="nav-link">Order Summary</a>
					</li>
				</ul>

				<div class="tab-content">
					<div class="tab-pane show active" id="receive">
			            <div class="row mb-4">
							<div class="col-12 col-md-3">
								<div class="form-group">
									<label for="">Status</label>
									<select name="Status" id="" class="form-control">
										<option value="All">All</option>
										<option value="3">Cancel</option>
										<option value="0">Draft</option>
										<option value="1">Approve</option>
										<option value="2">Retur</option>
									</select>
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="">Date</label>
									<div class="input-group">
										<input type="date" class="basic-datepicker form-control" name="date-as-1">
										<div class="input-group-addon">
											<div class="input-group-text">-</div>
										</div>
										<input type="date" class="basic-datepicker form-control" name="date-as-2">
									</div>
								</div>
							</div>
							<div class="col-12 col-md-3">
								<div class="btn-group">
									<button type="button" name="submit" id="alldate" class="btn btn-warning"><span class="fa mr-1 fa-calendar"></span> Retrieve All</button>
									<button type="button" name="submit" id="refresh" class="btn btn-primary"><span class="fa mr-1 fa-times"></span> Clear Filter</button>
									<button type="button" name="submit" id="summary-recieve" class="btn btn-success"><i class="fa mr-1 fa-search"></i> Filter</button>
								</div>
							</div>
						</div>
						<table class="table dt-responsive nowrap w-100 table-sm" id="tb-summary-recieve">
							<thead>
								<tr>
									<th>Recieve Date</th>
									<th>No</th>
									<th>Total Items</th>
									<th>User</th>
									<th class="no-sort">Status</th>
									<th class="no-sort">Action</th>
								</tr>
							</thead>
						</table>
					</div>
					<div class="tab-pane" id="order">
			            <div class="row mb-4">
							<div class="col-12 col-md-3">
								<div class="form-group">
									<label for="">Status</label>
									<select name="status-order" id="" class="form-control">
										<option value="All">All</option>
										<option value="3">Cancel</option>
										<option value="0">Draft</option>
										<option value="1">Send</option>
										<option value="2">Receive</option>
									</select>
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="">Date</label>
									<div class="input-group">
										<input type="date" class="basic-datepicker form-control" name="date-order-1">
										<div class="input-group-addon">
											<div class="input-group-text">-</div>
										</div>
										<input type="date" class="basic-datepicker form-control" name="date-order-2">
									</div>
								</div>
							</div>
							<div class="col-12 col-md-3">
								<div class="btn-group">
									<button type="button" name="submit" id="alldate-order" class="btn btn-warning"><span class="fa mr-1 fa-calendar"></span> Retrieve All</button>
									<button type="button" name="submit" id="refresh-order" class="btn btn-primary"><span class="fa mr-1 fa-times"></span> Clear Filter</button>
									<button type="button" name="submit" id="summary-order" class="btn btn-success"><i class="fa mr-1 fa-search"></i> Filter</button>
								</div>
							</div>
						</div>
						<table class="table dt-responsive nowrap w-100 table-sm" id="tb-order">
							<thead>
								<tr>
									<th>Order Date</th>
									<th>No</th>
									<th>Supplier</th>
									<th>Delivery Plan</th>
									<th>Category</th>
									<th class="no-sort">Status</th>
									<th class="no-sort">Action</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


