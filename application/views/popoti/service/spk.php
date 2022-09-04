<style>

    .fa{
        cursor: pointer;
    }

</style>



<div class="row">
    <div class="col-12">

        <form method="post" action="<?php echo site_url('service/new-order') ?>" id="form-spk">

            <div class="card">
                <div class="card-body">
                    <div class="card-widgets">
                        <!-- <a href="javascript:;" data-toggle="reload"><i class="mdi mdi-refresh"></i></a> -->
                        <a data-toggle="collapse" href="#customer_information" role="button" aria-expanded="false" aria-controls="customer_information"><i class="mdi mdi-minus"></i></a>
                        <!-- <a href="#" data-toggle="remove"><i class="mdi mdi-close"></i></a> -->
                    </div>
                    <a data-toggle="collapse" href="#customer_information" role="button" aria-expanded="false" aria-controls="customer_information">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-account-circle mr-1"></i>
                            <span class="d-none d-sm-inline">Customer and Unit Information</span>
                        </h5>
                    </a>

                    <div id="customer_information" class="collapse pt-3 show">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">Mobile Phone <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <button type="button" id="customers" href="<?php echo base_url('customer/customers') ?>" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                        </div>
                                        <input type="text" required="" class="form-control" name="no-hp" id="no">
                                        <input type="hidden" name="customerid">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" id="reesetcustomer"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Customer Name <span class="text-danger">*</span></label>
                                    <input type="text" required="" class="form-control" name="cust-nama">
                                </div>
                                <input type="hidden" name="iscustomer" value="false">
                                <input type="hidden" name="isvehicle" value="false">
                                <div class="form-group">
                                    <label for="">District, Subdisctrict, City, Province <span class="text-danger">*</span></label>
                                    <input type="text" required="" class="form-control" name="district">
                                    <input type="hidden" name="district-id">
                                </div>
                                <p>Last Service :  <span id="last_service"></span> </p>
                                <p>Come To Dealer : <span id="total_come"></span> </p>
                            </div> <!-- end col -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">No Plat <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <button type="button" id="plats" href="<?php echo base_url('customer/plats') ?>" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                        </div>
                                        <input type="text" required="" name="no-plat" class="form-control" id="no-plat">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" id="resetvehicle"><i class="fa fa-times"></i></button>
                                        </div>
                                        <input type="hidden" name="vehicleid">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Unit <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <button type="button" id="units" href="<?php echo base_url('customer/unit2') ?>" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                        </div>
                                        <input type="text" required="" class="form-control" id="unit" name="unit">
                                        <input type="hidden" name="unit-id">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Merk</label>
                                    <input type="text" required="" class="form-control" id="merk" name="merk" disabled="">
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis</label>
                                    <input type="text" required="" class="form-control" id="jenis" name="jenis" disabled="">
                                    <input type="hidden" name="merkid">
                                    <input type="hidden" name="jenisid">
                                    <input type="hidden" name="catid">
                                </div>
                                <div class="form-group">
                                    <label for="">Kategori</label>
                                    <input type="text" required="" class="form-control" id="kategori" name="kategori" disabled="">
                                    <input type="hidden" id="categoryid" name="category_id">
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                    </div>
                </div>
            </div> <!-- end card-->
            <input type="hidden" name="hassave">
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
                            <span class="d-none d-sm-inline">Service Information</span>
                        </h5>

</a>
                    <div id="service_information" class="collapse pt-3">
                        <div class="form-group">
                            <label for="technician">Technician <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <button type="button" id="employee_btn" href="<?php echo base_url('employee/employeeses') ?>" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                                <input type="text" required="" name="employee" class="form-control" id="employee">
                                <input type="hidden" name="employeeid">
                            </div>

                        </div>
                    </div>
                </div>
            </div> <!-- end card-->
            <div class="card">
                <div class="card-body">
                    <div class="card-widgets">
                        <!-- <a href="javascript:;" data-toggle="reload"><i class="mdi mdi-refresh"></i></a> -->
                        <a data-toggle="collapse" href="#job_detail" role="button" aria-expanded="false" aria-controls="job_detail"><i class="mdi mdi-minus"></i></a>
                        <!-- <a href="#" data-toggle="remove"><i class="mdi mdi-close"></i></a> -->
                    </div>
                    <a data-toggle="collapse" href="#job_detail" role="button" aria-expanded="false" aria-controls="job_detail">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-hammer-wrench mr-1"></i>
                            <span class="d-none d-sm-inline">Job Detail</span>

                        </h5>
                    </a>

                    <div id="job_detail" class="collapse pt-3">
                        <div class="row">
                            <div class="col-md-6">                        
                                <div class="form-group">
                                    <label for="technician">Service Item</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <button type="button" id="service-group" href="<?php echo base_url('service/group_service') ?>" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                        </div>
                                        <input type="text" readonly="" style="cursor: pointer;" name="package" class="form-control">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-danger"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">                        
                                <div class="form-group">
                                    <label for="technician">Service Package</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <button type="button" id="service-paket" href="<?php echo base_url('service/show_paket_service') ?>" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                        </div>
                                        <input type="text" readonly="" style="cursor: pointer;" name="paket-service" class="form-control">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-danger"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Package</th>
                                    <th>Service Job</th>
                                    <th>STd. Price</th>
                                    <th>Qty</th>
                                    <th>Disc</th>
                                    <th>Selling Price</th>
                                </tr>
                            </thead>
                            <tbody id="package-table">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end card-->
            <div class="card">
                <div class="card-body">
                    <div class="card-widgets">
                        <!-- <a href="javascript:;" data-toggle="reload"><i class="mdi mdi-refresh"></i></a> -->
                        <a data-toggle="collapse" href="#parts_detail" role="button" aria-expanded="false" aria-controls="parts_detail"><i class="mdi mdi-minus"></i></a>
                        <!-- <a href="#" data-toggle="remove"><i class="mdi mdi-close"></i></a> -->
                    </div>
                    <a data-toggle="collapse" href="#parts_detail" role="button" aria-expanded="false" aria-controls="parts_detail">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-clipboard-list mr-1"></i>
                            <span class="d-none d-sm-inline">Parts Detail</span>
                        </h5>

</a>
                    <div id="parts_detail" class="collapse pt-3">
                        <div class="form-group">
                            <label for="technician">Parts Detail</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <button type="button" style="cursor: pointer;" id="btn-parts" href="<?php echo base_url('service/show-parts') ?>" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                                <input type="text" name="parts" class="form-control" id="parts">
                            </div>

                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm w-100">
                                <thead>
                                    <tr>
                                        <th>Kode Barang</th>
                                        <th>Parts</th>
                                        <th>Het</th>
                                        <th>Qty</th>
                                        <th>Disc</th>
                                        <th>On Hand Qty</th>
                                        <th>Picking Qty</th>
                                        <th>Selling Price</th>
                                    </tr>
                                </thead>
                                <tbody id="spk-parts"> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- end card-->


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Total Service</th>
                                        <th>Total Sparepart</th>
                                        <th>Jumlah Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Rp. <span data-a-sep='.' data-a-dec="," data-m-dec="0" class="autonumber" id="totalservice"></span></td>
                                        <td>Rp. <span data-a-sep='.' data-a-dec="," data-m-dec="0" class="autonumber" id="totalpart"></span></td>
                                        <td>Rp. <span data-a-sep='.' data-a-dec="," data-m-dec="0" class="autonumber" id="jumtotal"></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>                
                </div>
            </div>
        
            <div class="card">
                <div class="card-body text-sm-right">
                    <button id="clear" class="btn btn-danger text-right mr-2"> New Order</button>
                    <button type="submit" class="btn btn-success mr-2 save-wo" name="status" value="3">Confirm</button>
                </div>
            </div> <!-- end card-->

        </form>
    </div>
</div>