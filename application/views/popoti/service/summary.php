<div class="card">
    <div class="card-body">
        <div class="card-widgets">
            <!-- <a href="javascript:;" data-toggle="reload"><i class="mdi mdi-refresh"></i></a> -->
            <a data-toggle="collapse" href="#service_information" role="button" aria-expanded="false" aria-controls="service_information"><i class="mdi mdi-plus"></i></a>
            <!-- <a href="#" data-toggle="remove"><i class="mdi mdi-close"></i></a> -->
        </div>
        <a data-toggle="collapse" href="#service_information" role="button" aria-expanded="false" aria-controls="service_information">
            <h5 class="card-title mb-0">
                <i class="mdi mdi-cog-clockwise mr-1"></i>
                <span class="d-none d-sm-inline">Filter</span>
            </h5>

        </a>
        <!-- <a href="#" class="btn-link bor">test</a> -->
        <div id="service_information" class="collapse pt-3">
            <div class="row">
				<div class="col-12 col-md-6">
					<div class="form-group">
						<label for="">Status</label>
						<select name="Status" id="" class="form-control">
							<option value="All">All</option>
							<option value="cancel">Cancel</option>
							<option value="0">Suspend</option>
							<option value="3">Waiting For Start</option>
							<option value="1">Waiting For Finish</option>
							<option value="2">Waiting For Payment</option>
							<option value="4">Success</option>
						</select>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<label for="">Date</label>
						<div class="input-group">
							<input type="date" class="basic-datepicker form-control" name="date-1">
							<div class="input-group-addon">
								<div class="input-group-text">-</div>
							</div>
							<input type="date" class="basic-datepicker form-control" name="date-2">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col text-right">
					<button type="button" name="submit" id="alldate" class="btn btn-warning"><span class="fa mr-1 fa-calendar"></span> Retrieve All</button>
					<button type="button" name="submit" id="refresh" class="btn btn-primary"><span class="fa mr-1 fa-times"></span> Clear Filter</button>
					<button type="button" name="submit" id="filter-summary" class="btn btn-success"><i class="fa mr-1 fa-search"></i> Filter</button>
				</div>
			</div>	
        </div>

    </div>
</div> <!-- end card-->

<div class="row">
	<div class="col">
		<div class="card-box">
			<div class="card-body">

				<table class="table dt-responsive nowrap w-100 table-sm" id="summary">
					<thead>
						<tr>
							<th>Tanggal</th>
							<th>No WO</th>
							<th>Customer</th>
							<th class="no-sort">Nominal</th>
							<th class="no-sort">Status</th>
							<th class="no-sort">Action</th>
						</tr>
					</thead>
				</table>
				<div class="text-right mt-3">
					<button class="btn btn-primary" id="print-summary">
						<i class="fa fa-print mr-2"></i> Print Preview
					</button>
				</div>
			</div>
		</div>
	</div>
</div>


