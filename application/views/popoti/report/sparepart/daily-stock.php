<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3 class="header-title mb-3">Filter</h3>

                <div class="row form-filter">
                    <div class="col-4">
                        <select class="first-date form-control" name="" id="">
                            <option value="all">Select Category</option>
                            <option value="all">All</option>
                            <?php foreach ($this->global_model->_get('tb_sparepart_category')->result() as $key => $value): ?>
                                <option value="<?php echo $value->id ?>"><?php echo $value->nama ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-4">
                        <select class="end-date form-control" name="" id="">
                            <option value="all">Select Location</option>
                            <option value="all">All</option>
                            <?php foreach ($this->global_model->_get('tb_location')->result() as $key => $value): ?>
                                <option value="<?php echo $value->id ?>"><?php echo $value->nama ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-4">
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

                <table id="daily-stock" data-cat="daily-stock-json" class="table dt-responsive nowrap w-100" >
                    <thead>

                       <tr>
                            <th>No</th>
                            <th>Kode Part</th>
                            <th>Sparepart Name</th>
                            <th>Sparepart Category</th>
                            <th>Location</th>
                            <th>Qty </th>
                            
                        </tr>
                    </thead>
                </table>

                <div class="row">
                    <div class="col text-right">
                        <button type="button" id="print-daily" class="btn btn-primary"><i class="fa fa-print"></i></button>
                        <button type="button" id="pdf-daily" class="btn btn-danger"><i class="fa fa-file-pdf"></i></button>
                        <button type="button" id="excel-daily" class="btn btn-success"><i class="fa fa-file-excel"></i></button>
                    </div>
                </div>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->