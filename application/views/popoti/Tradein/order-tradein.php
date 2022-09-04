<form action="<?php echo base_url('Tradein/tradein_data') ?>" method="post">

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No. Nota <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-receipt"></i>
                                    </span>
                                </div>
                                <input type="text" name="nomor_nota" id="nomor_nota" value="<?php echo strtoupper(uniqid()).$this->session->userdata('user'); ?>" readonly="" class="form-control">
                                <input type='hidden' name='userid' id="userid" class='form-control' id='userid' value="<?php echo $this->session->userdata('user') ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Date Time <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </span>
                                </div>
                                <input type='text' name='tanggal' id="tanggal" class='form-control' id='tanggal' value="<?php echo date('Y-m-d'); ?>" readonly="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row text-right">
                    <div class="col-12">
                        <button class="btn btn btn-danger popup-item" href="<?php echo base_url('Tradein/add-tradein') ?>"> <i class="fe-plus-square mr-1"></i> Add Item</button>
        
                        <a href="<?php echo base_url('Tradein/index')?>" class="btn btn-success mt-3 mb-3">
                                <i class="mdi mdi-chevron-double-left mr-1"></i> Cancel 
                        </a>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">&nbsp;</div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table table-striped table-ordered table-sm append-labor" id="tbl-transaction">
                    <thead>
                        <tr>
                            <th width="30%">Name</th>
                            <th width="20%">Price</th>
                            <th width="30%">QTY</th>
                            <th width="20%">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div id="box-total">
                    <div class="row">
                        <div class="col-md-8">
                            
                            <div class="row">
                                <div class="col-sm-6 text-right"><h4>Grandtotal</h4></div>
                                <div class="col-sm-6 text-right"><h4>Rp <span id="grand" class="autonumber" data-a-sep="." data-a-dec="," data-m-dec="0">0</span></h4></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                          
                            <button class="btn btn-tradein btn-blue" id="bayar-order">
                                <i class="fe-credit-card"></i> <br> Save
                            </button>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</form>

<style type="text/css">
    .btn-tradein {
        width: 100%;
        height: 82px;
    }
    .btn-tradein i {
        font-size: xx-large;
    }

</style>