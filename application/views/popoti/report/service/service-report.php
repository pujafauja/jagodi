<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3 class="header-title mb-3">Filter</h3>

                <div class="row form-filter">
                    <div class="col-6">
                        <div class="input-group">
                            <input type="text" class="form-control basic-datepicker first-date" name="first-date" value="<?php echo date('Y-m-01') ?>">
                            <div class="input-group-addon">
                                <span class="input-group-text">-</span>
                            </div>
                            <input type="text" class="form-control basic-datepicker end-date" name="end-date" value="<?php echo date('Y-m-d') ?>">
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
                <h3 class="header-title mb-3">Daily Report</h3>

                <table id="RiportSparepart" class="table dt-responsive nowrap w-100 table-sm" >
                    <thead>

                        <tr>    
                            <th valign="middle" rowspan="2">No</th>
                            <th rowspan="2">Invoice No</th>
                            <th class="no-sort" colspan="4">Customer Information</th>
                            <th class="" rowspan="2">Service Category</th>
                            <th class="no-sort" rowspan="2">Parts No</th>
                            <th class="no-sort" rowspan="2">Parts Name</th>
                            <th class="no-sort" rowspan="2">Parts Qty</th>
                            <th class="no-sort" rowspan="2">Parts Price</th>
                            <th class="no-sort" rowspan="2">Total Labor</th>
                            <th class="no-sort" rowspan="2">Total Parts</th>
                            <th class="no-sort" rowspan="2">Total Amount</th>
                            <th class="no-sort" rowspan="2">Technician</th>
                            <th class="no-sort" rowspan="2">Invoice By</th>
                            <!-- <th rowspan="2">last updated</th>
                            <th rowspan="2" class='no-sort'>Options</th> -->

                        </tr>           
                        <tr>
                            <th class="">Name</th>
                            <th class="no-sort">No Plat</th>
                            <th class="no-sort">Unit</th>
                            <th class="no-sort">No Telp</th>
                        </tr>
                    </thead>
                </table>

                <div class="row">
                    <div class="col text-right">
                        <button type="button" id="print-daily-report" class="btn btn-primary"><i class="fa fa-print"></i></button>
                        <button type="button" id="pdf-daily-report" class="btn btn-danger"><i class="fa fa-file-pdf"></i></button>
                        <button type="button" id="excel-daily-report" class="btn btn-success"><i class="fa fa-file-excel"></i></button>
                    </div>
                </div>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3 class="header-title mb-3">Technician Performance</h3>

                <table id="DailyRiport" class="table dt-responsive nowrap w-100 table-sm" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Technician Name</th>
                            <th>Working day</th>
                            <th>Total SVC  Qty</th>
                            <th>Service AMT</th>
                            <th>Part AMT</th>
                            <th>OIL AMT</th>
                            <th>Grand Total</th>
                            <!-- <th>Option </th> -->
                        </tr>
                    </thead>
                </table>

                <div class="row">
                    <div class="col text-right">
                        <button type="button" id="print-teknisi" class="btn btn-primary"><i class="fa fa-print"></i></button>
                        <button type="button" id="pdf-teknisi" class="btn btn-danger"><i class="fa fa-file-pdf"></i></button>
                        <button type="button" id="excel-teknisi" class="btn btn-success"><i class="fa fa-file-excel"></i></button>
                    </div>
                </div>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->