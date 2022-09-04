<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3 class="header-title mb-3">Filter</h3>

                <div class="row form-filter">
                    <div class="col-6">
                        <select name="" id="" class="form-control">
                            <option value="all">All</option>
                            <option value="1">Active</option>
                            <option value="0">In Active</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-primary filter"><i class="mdi mdi-filter-outline mr-1"></i>Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <table id="employee-join" class="table dt-responsive nowrap w-100 table-sm" >
                    <thead>

                       <tr>
                            <th>No</th>
                            <th>Employee Name</th>
                            <th>Position</th>
                            <th>Registered Day</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>

                <div class="row">
                    <div class="col text-right">
                        <button type="button" id="print-join" class="btn btn-primary"><i class="fa fa-print"></i></button>
                        <button type="button" id="pdf-join" class="btn btn-danger"><i class="fa fa-file-pdf"></i></button>
                        <button type="button" id="excel-join" class="btn btn-success"><i class="fa fa-file-excel"></i></button>
                    </div>
                </div>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->