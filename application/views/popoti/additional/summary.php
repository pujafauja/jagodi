<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs nav-bordered tab-summary">
            <li class="nav-item">
                <a href="#wash" data-type="wash" data-toggle="tab" aria-expanded="true" class="nav-link active">Wash</a>
            </li>
            <li class="nav-item">
                <a href="#retail" data-type="retail" data-toggle="tab" aria-expanded="false" class="nav-link">Retail</a>
            </li>
            <li class="nav-item">
                <a href="#cafe" data-type="cafe" data-toggle="tab" aria-expanded="false" class="nav-link">Cafe</a>
            </li>
        </ul>

        <div class="row mt-3">
            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="">Status</label>
                    <select name="Status" id="" class="form-control">
                        <option value="all">All</option>
                        <option value="0">Pending</option>
                        <option value="1">Paid</option>
                        <!-- <option value="2">Jurnal</option> -->
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="">Date</label>
                    <div class="input-group">
                        <input type="date" class="basic-datepicker form-control" name="date-first" value="<?php echo date('Y-m-01') ?>">
                        <div class="input-group-addon">
                            <div class="input-group-text">-</div>
                        </div>
                        <input type="date" class="basic-datepicker form-control" name="date-last" value="<?php echo date('Y-m-t') ?>">
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="btn-group mt-3">
                    <button type="button" name="submit" id="alldate" class="btn btn-warning"><span class="fa mr-1 fa-calendar"></span> Retrieve All</button>
                    <button type="button" name="submit" id="filter" class="btn btn-success"><i class="fa mr-1 fa-search"></i> Filter</button>
                </div>
            </div>
        </div>
    </div>
</div> <!-- end card-->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane show active" id="wash">
                        <table id="wash-dt" data-cat="wash" class="add-datatable table dt-responsive nowrap w-100">
                            <caption>Wash Summary</caption>

                            <thead>

                                <tr>

                                    <th>Date</th>
                                    <th>Invoice No.</th>
                                    <th>Bill</th>
                                    <th class="no-sort">Status</th>
                                    <th class="no-sort">Action</th>
                                </tr>

                            </thead>

                        </table>
                    </div>

                    <div class="tab-pane" id="retail">
                        <table id="retail-dt" data-cat="retail" class="add-datatable table dt-responsive nowrap w-100">
                            <caption>Retail Summary</caption>

                            <thead>

                                <tr>

                                    <th>Date</th>
                                    <th>Invoice No.</th>
                                    <th>Bill</th>
                                    <th class="no-sort">Status</th>
                                    <th class="no-sort">Action</th>
                                </tr>

                            </thead>

                        </table>
                    </div>

                    <div class="tab-pane" id="cafe">
                        <table id="cafe-dt" data-cat="cafe" class="add-datatable table dt-responsive nowrap w-100">
                            <caption>Cafe Summary</caption>

                            <thead>

                                <tr>

                                    <th>Date</th>
                                    <th>Invoice No.</th>
                                    <th>Bill</th>
                                    <th class="no-sort">Status</th>
                                    <th class="no-sort">Action</th>
                                </tr>

                            </thead>

                        </table>
                    </div>

                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->