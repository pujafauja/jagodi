<div class="card">
    <div class="card-body">
        <div class="card-widgets">
            <!-- <a href="javascript:;" data-toggle="reload"><i class="mdi mdi-refresh"></i></a> -->
            <a data-toggle="collapse" href="#service_information" role="button" aria-expanded="false" aria-controls="service_information"><i class="mdi mdi-minus"></i></a>
            <!-- <a href="#" data-toggle="remove"><i class="mdi mdi-close"></i></a> -->
        </div> 
        <a data-toggle="collapse" href="#service_information" role="button" aria-expanded="false" aria-controls="service_information">
            <h5 class="card-title mb-0">
                <i class="mdi mdi-cog-clockwise mr-1"></i>
                <span class="d-none d-sm-inline">Filter</span>
            </h5>
        </a>
        <!-- <a href="#" class="btn-link bor">test</a> -->
        <div id="service_information" class="collapse show pt-3">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="Status" id="" class="form-control">
                            <option value="All">All</option>
                            <option value="0">Pending</option>
                            <option value="1">Paid</option>
                            <!-- <option value="2">Jurnal</option> -->
                        </select>
                    </div>
                </div>  

                <div class="col-12 col-md-4">
                     <div class="form-group">
                       <label for="">Invoice Date</label>
                      <div class="input-group">
                          <input type="date" class="basic-datepicker form-control" name="invoicedate-first" value="<?php echo date('Y-m-01') ?>">
                           <div class="input-group-addon">
                               <div class="input-group-text">-</div>
                            </div>
                            <input type="date" class="basic-datepicker form-control" name="invoicedate-last" value="<?php echo date('Y-m-t') ?>">
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                     <div class="form-group">
                       <label for="">Due Date</label>
                      <div class="input-group">
                          <input type="date" class="basic-datepicker form-control" name="duedate-first" value="">
                           <div class="input-group-addon">
                               <div class="input-group-text">-</div>
                            </div>
                            <input type="date" class="basic-datepicker form-control" name="duedate-last" value="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col text-right">
                   <button type="button" name="submit" id="FilterDetailAp" class="btn btn-success"><i class="fa mr-1 fa-search"></i> Filter</button>
                </div>
            </div>  
        </div>
    </div>
</div> <!-- end card-->

<div class="row">
    <div class="col-12">
        <div class="card">
           <div class="card-body">
                <table id="detailar-datatable" class="table dt-responsive nowrap w-100" data-id="<?php echo $id ?>">
                    <thead>
                        <tr>
                            <th class="">Invoice Number</th>
                            <th class="">Date</th>
                            <th class="">Due Date</th>
                            <th class="no-sort">Debit</th>
                            <th class="no-sort">Credit</th>
                            <th class="no-sort">Balance</th>
                        </tr>
                    </thead>
                </table>
          </div> <!-- end card body-->
       </div> <!-- end card -->
    </div><!-- end col-->
</div>

<!-- end row-->