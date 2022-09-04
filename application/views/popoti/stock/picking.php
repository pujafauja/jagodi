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
        <div id="service_information" class="collapse pt-3">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" id="" class="form-control">
                            <option value="all">All</option>
                            <option value="active">Active</option>
                            <option value="inactive" selected="">In Active</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-8">
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
                    <div class="btn-group">
                        <button type="button" name="submit" id="alldate" class="btn btn-warning"><span class="fa mr-1 fa-calendar"></span> Retrieve All</button>
                        <button type="button" name="submit" id="refresh" class="btn btn-primary"><span class="fa mr-1 fa-times"></span> Clear Filter</button>
                        <button type="button" name="submit" id="filter-picking" class="btn btn-success"><i class="fa mr-1 fa-search"></i> Filter</button>
                    </div>
                </div>
            </div>  
        </div>

    </div>
</div> <!-- end card-->
<div class="row">
	<div class="col">
		<div class="card-box">
			<div class="card-body">
				<table id="picking" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>No WO</th>
                            <th>Customer</th>
                            <th>Total Item Sparepart</th>
                            <th>User</th>
                            <th class='no-sort'>Detail</th>
                        </tr>
                    </thead>
                </table>
			</div>
		</div>
	</div>
</div>