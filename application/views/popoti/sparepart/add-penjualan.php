<div class="row">
    <div class="col-lg-12">

        <form action="<?php echo site_url('sparepart/tambah-penjualan/'.encode($penjualan->id)) ?>" method="post" class="tambah-penjualan">

            <div class="form-group">
                <label for="simpleinput">Part Name <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="hidden" name="partid" class="form-control" readonly="" value="<?php echo $penjualan->partid ?>">
                    <input type="text" name="part" class="form-control" readonly="" value="<?php echo $penjualan->part ?>">
                    <div class="input-group-append">
                        <a href="<?php echo site_url('sparepart/popup') ?>" class="btn btn-primary find" data-table="#popup-datatable" data-url="<?php echo base_url('penjualan/popup') ?>">...</a>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="simpleinput">Special Price <span class="text-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" id="simpleinput" name="nominal" class="form-control autonumber" data-a-sep="." data-a-dec="," value="<?php echo $penjualan->nominal ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="simpleinput">Start Date <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" id="simpleinput" name="start" class="form-control basic-datepicker" value="<?php echo $penjualan->start ?>">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fe-calendar"></i></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="simpleinput">End Date <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" id="simpleinput" name="end" class="form-control basic-datepicker" value="<?php echo $penjualan->end ?>">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fe-calendar"></i></span>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>

<div id='ResponseInput'></div>


<script src="<?php echo base_url() ?>assets/libs/jquery-mask-plugin/jquery.mask.min.js"></script>
<script src="<?php echo base_url() ?>assets/libs/autonumeric/autoNumeric-min.js"></script>
<script src="<?php echo base_url() ?>assets/libs/flatpickr/flatpickr.min.js"></script>

<!-- Init js-->
<script src="<?php echo base_url() ?>assets/js/pages/form-masks.init.js"></script>

<script type="text/javascript">
    $(".basic-datepicker").flatpickr(), $(".datetime-datepicker").flatpickr({
        enableTime: !0,
        dateFormat: "Y-m-d H:i"
    })
</script>