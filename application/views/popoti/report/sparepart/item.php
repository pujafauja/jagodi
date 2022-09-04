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

                <table id="sparepart-report" data-cat="item" class="table dt-responsive nowrap w-100 table-sm" >
                    <thead>

                       <tr>
                            <th>No</th>
                            <th>Part Code</th>
                            <th>Part Name</th>
                            <th>Part Category</th>
                            <th>ABC Categori</th>
                            <th>Sales Qty </th>
                            <th>Sales Amount </th>
                            <th>Last Stock</th>
                            <th>Ratio</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>

                <div class="row">
                    <div class="col text-right">
                        <button type="button" id="print-item" class="btn btn-primary"><i class="fa fa-print"></i></button>
                        <button type="button" id="pdf-item" class="btn btn-danger"><i class="fa fa-file-pdf"></i></button>
                        <button type="button" id="excel-item" class="btn btn-success"><i class="fa fa-file-excel"></i></button>

                    </div>
                </div>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->