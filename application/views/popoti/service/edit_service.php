<style>

    .fa{
        cursor: pointer;
    

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
                                        <input type="text" required="" value="<?php echo $data['user']['no_hp'] ?>" class="form-control" name="no-hp" id="no">
                                        <input type="hidden" name="customerid" value="<?php echo $data['user']['customer_id'] ?>">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" id="reesetcustomer"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Customer Name <span class="text-danger">*</span></label>
                                    <input type="text" required="" class="form-control" name="cust-nama" value="<?php echo $data['user']['customer'] ?>">
                                </div>
                                <input type="hidden" name="iscustomer" value="false">
                                <input type="hidden" name="isvehicle" value="false">
                                <div class="form-group">
                                    <label for="">District, Subdisctrict, City, Province <span class="text-danger">*</span></label>
                                    <input type="text" required="" class="form-control" name="district" value="<?php echo $data['user']['district'] ?>">
                                    <input type="hidden" name="district-id" value="<?php echo $data['user']['desa_id'] ?>">
                                </div>
                                <p>Last Service :  <span id="last_service"><?php echo date('d-m-Y H:s:i', strtotime($data['user']['last_service'])) ?></span> </p>
                                <p>Come To Dealer : <span id="total_come"><?php echo $data['user']['total_come'] ?></span> </p>
                            </div> <!-- end col -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">No Plat <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <button type="button" id="plats" href="<?php echo base_url('customer/plats') ?>" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                        </div>
                                        <input type="text" required="" name="no-plat" value="<?php echo $data['user']['plat'] ?>" class="form-control" id="no-plat">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" id="resetvehicle"><i class="fa fa-times"></i></button>
                                        </div>
                                        <input type="hidden" name="vehicleid" value="<?php echo $data['user']['vehicle_id'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Unit <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <button type="button" id="units" href="<?php echo base_url('customer/unit2') ?>" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                        </div>
                                        <input type="text" required="" class="form-control" id="unit" name="unit" value="<?php echo $data['user']['unit'] ?>">
                                        <input type="hidden" name="unit-id" value="<?php echo $data['user']['unitid'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Merk</label>
                                    <input type="text" required="" class="form-control" id="merk" name="merk" value="<?php echo $data['user']['merk'] ?>" disabled="">
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis</label>
                                    <input type="text" required="" class="form-control" id="jenis" name="jenis" disabled="" value="<?php echo $data['user']['jenis'] ?>">
                                    <input type="hidden" name="merkid" value="<?php echo $data['user']['merkid'] ?>">
                                    <input type="hidden" name="jenisid" value="<?php echo $data['user']['jenisid'] ?>" >
                                </div>
                                <div class="form-group">
                                    <label for="">Kategori</label>
                                    <input type="text" required="" class="form-control" id="kategori" value="<?php echo $data['user']['kategori'] ?>" name="kategori" disabled="">
                                    <input type="hidden" id="categoryid" name="category_id" value="<?php echo $data['user']['catid'] ?>">
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->                        </div>
                </div>
            </div> <!-- end card-->
            <input type="hidden" name="hassave" value="<?php echo $data['user']['id'] ?>">
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
                                <input type="text" required="" name="employee" class="form-control" id="employee" value="<?php echo $data['user']['employee'] ?>">
                                <input type="hidden" name="employeeid" value="<?php echo $data['user']['employee_id'] ?>">
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
                                <?php if (isset($data['service']['item'])): ?>
                                    <?php foreach ($data['service']['item'] as $key => $it): ?>
                                        <?php if (count($it->detail)): ?>                                            
                                            <tr class="parent" data-parent="<?php echo $it->groupid ?>">
                                                <td rowspan="<?php echo count($it->detail) + 1 ?>"><i class="mr-2 closerowcat fa fa-times text-danger" data-id="<?php echo $it->groupid ?>"></i><?php echo $it->group ?> </td>
                                                <input type="hidden" name="service_job[]" value="<?php echo $it->groupid?>"> 
                                            </tr>                                        
                                            <?php foreach ($it->detail as $key => $dt): ?>
                                                 <tr data-child="child-<?php echo $it->groupid ?>">
                                                    <td><i class="mr-2 fa fa-times closerow text-danger"></i> <?php echo sql_get_var('tb_jasa', 'nama', ['id' => $dt->itemid]) ?>    <input type="hidden" name="item_service[][<?php echo $it->groupid ?>]" value="<?php echo $dt->itemid ?>"></td>
                                                    <td>Rp. <span class="autonumber" data-a-sep='.' data-a-dec="," data-m-dec="0"><?php echo $dt->harga ?></span><input type="hidden" name="service-harga[<?php echo $dt->itemid ?>]" value="<?php echo $dt->harga ?>"></td>
                                                    <td>
                                                        <input type="text" style="width: 60px !important;" name="service-qty[<?php echo $dt->itemid ?>]" data-id="<?php echo $dt->itemid ?>" value="<?php echo $dt->qty ?>" class="form-qty form-control form-control-sm">
                                                    <td>
                                                        <div class="input-group input-group-sm">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">Rp</div>
                                                            </div>
                                                            <input type="text" value="<?php echo $dt->disc ?>" data-a-sep='.' data-a-dec="," data-m-dec="0" name="service-disc[<?php echo $dt->itemid ?>]" class="form-disc autonumber form-control">
                                                        </div>
                                                    </td>
                                                    <td>Rp. <span class="autonumber sellingpricejasa" data-a-sep='.' data-a-dec="," data-m-dec="0" id="sellingprice[<?php echo $dt->itemid ?>]"><?php echo ( (intval($dt->qty) * intval($dt->harga)) -  intval($dt->disc)) ?></span> </td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                <?php endif ?>
                                <?php if (isset($data['service']['package'])): ?>
                                    <?php foreach ($data['service']['package'] as $key => $pk): ?>
                                        <tr data-paket="<?php echo $pk->detail->itemid ?>">
                                            <td ><i class="mr-2 fa fa-times closerowpaket text-danger"></i><?php echo sql_get_var('tb_service_package', 'nama', ['id' => $pk->detail->itemid]) ?>    <input type="hidden" name="package-service[]" value="<?php echo $pk->detail->itemid ?>"></td>
                                            <td><?php echo $this->service_model->getdetailpackage($pk->detail->itemid) ?></td>
                                            <td>Rp. <span class="autonumber" data-a-sep='.' data-a-dec="," data-m-dec="0"><?php echo $pk->detail->harga ?></span><input type="hidden" name="package-harga[<?php echo $pk->detail->itemid ?>]" value="<?php echo $pk->detail->harga ?>"></td>
                                            <td>
                                                <input type="text" name="paket-qty[<?php echo $pk->detail->itemid ?>]" data-id="<?php echo $pk->detail->itemid ?>" value="<?php echo $pk->detail->qty ?>" style="width: 60px !important;" class="form-package-qty form-control form-control-sm">
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">Rp. </div>
                                                    </div>
                                                    <input type="text" data-a-sep='.' data-a-dec="," data-m-dec="0" name="paket-disc[<?php echo $pk->detail->itemid ?>]" value="<?php echo $pk->detail->disc ?>" style="width: 60px !important;" class="form-package-disc form-control autonumber form-control-sm">
                                                </div>
                                            </td>
                                            <td>Rp. <span class="autonumber sellingpricejasa" data-a-sep='.' data-a-dec="," data-m-dec="0" id="sellingprice[<?php echo $pk->detail->itemid ?>]"><?php echo ((intval($pk->detail->qty) * intval($pk->detail->harga)) - intval($pk->detail->disc) ) ?></span> </td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php endif ?>
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
                                    <button type="button" id="btn-parts" href="<?php echo base_url('service/show-parts') ?>" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                                <input type="text" readonly="" style="cursor: pointer;" name="parts" class="form-control" id="parts">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-danger"><i class="fa fa-times"></i></button>
                                </div>
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
                                    <?php if (isset($data['part']) && is_array($data['part'])): ?>
                                            <?php foreach ($data['part'] as $key => $pt): ?>
                                                <tr data-parent="<?php echo $pt->sparepart_id ?>">
                                                    <td><i class="mr-2 fa fa-times closerowpaket text-danger"></i> <?php echo $pt->kode ?></td>
                                                    <td><?php echo $pt->nama ?></td>
                                                    <td>
                                                        <?php echo nestedPrice($pt->sparepart_id, $pt->het) ?>
                                                    </td>
                                                    <td>
                                                        <input type="text" style="width: 60px;" <?php echo ($pt->pickingqty) ? 'readonly=""' : '' ?>  class="part-qty form-control form-control-sm" value="<?php echo $pt->qty ?>"  name="part-qty[<?php echo $pt->sparepart_id ?>]">
                                                        <input type="hidden" value="<?php echo $pt->sparepart_id ?>" name="parts_id[]">
                                                    </td>
                                                    <td>
                                                        <input type="text" style="width: 120px;" class="part-disc autonumber form-control form-control-sm" value="<?php echo $pt->disc ?>" name="part-disc[<?php echo $pt->sparepart_id ?>]">
                                                    </td>
                                                        <td>
                                                        <?php echo $pt->onhandqty ?>
                                                    </td>
                                                    <td>
                                                    <?php $qty = ($pt->pickingqty) ? $pt->pickingqty : $pt->qty;
                                                          $selling = ( ($qty * intval($pt->het)) - intval($pt->disc) ); ?>
                                                        <?php echo $pt->pickingqty; ?>
                                                        <input type="hidden" name="pickingqty[<?php echo $pt->sparepart_id ?>]" value="<?php echo $pt->pickingqty ?>">
                                                    </td>

                                                    <td>Rp. <span data-a-sep='.' data-a-dec="," data-m-dec="0" class="sellingpricepart autonumber" id="sellingpricepart[<?php echo $pt->sparepart_id ?>]"><?php echo $selling ?></span></td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php endif ?>
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
                    <a href="<?php echo base_url() ?>service/summary" class="btn btn-primary">Back</a>
                    <button type="submit" class="btn btn-success mr-2 save-wo" name="status" value="3">Confirm</button>
                    <button type="submit" class="btn btn-primary mr-2 save-wo" name="status" value="1">Start Job</button>
                    <button type="submit" class="btn btn-primary mr-2 save-wo" name="status" value="2">Finish Job</button>
                    <button type="submit" class="btn btn-primary mr-2 save-wo" name="status" value="0">Suspend</button>
                </div>
            </div> <!-- end card-->

        </form>
    </div>
</div>





</script>