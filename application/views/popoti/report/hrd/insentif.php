<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3 class="header-title mb-3">Filter</h3>

                <div class="row form-filter">
                    <div class="col-6">
                        <div class="input-group">
                        <input type="text" name="month" id="search-by-month" class="form-control" data-provide="datepicker" data-date-format="yyyy-mm" data-date-min-view-mode="1" />
                        <div class="input-group-addon">
                            <button id="refresh-insentif" class="btn btn-primary"><i class="fa fa-sync"></i></button>
                        </div>                                    
                    </div>
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

                <table id="insentif" class="table dt-responsive nowrap w-100 table-sm" >
                    <thead>

                       <tr>
                            <th>No</th>
                            <th>Periode</th>
                            <th>Total Insentif</th>
                            <th>Status</th>
                            <th>Total Reward</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>

                <div class="row">
                    <div class="col text-right">
                        <button type="button" id="print-insentif" class="btn btn-primary"><i class="fa fa-print"></i></button>
                        <button type="button" id="pdf-insentif" class="btn btn-danger"><i class="fa fa-file-pdf"></i></button>
                        <button type="button" id="excel-insentif" class="btn btn-success"><i class="fa fa-file-excel"></i></button>
                    </div>
                </div>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->