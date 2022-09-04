<div class="row">

    <div class="col-lg-12">

       <form action="<?php echo site_url('finance/tambah-ar/'.encode($ar->id)) ?>" method="post" id="form-item">

            <div class="form-group">
                <label for="simpleinput">Invoice Number <span class="text-danger">*</span></label>
                <input type="text" id="simpleinput" name="no" class="form-control currency" placeholder="" value="<?php echo $ar->no ?>">
            </div>

            <div class="form-group">
                <label for="simpleinput">Customer name <span class="text-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <a href="<?php echo base_url('customer/?popup=1') ?>" class="btn btn-primary customer-popup"><i class="fas fa-search"></i></a>
                    </div>
                    <input type="text" id="simpleinput" name="nama" class="form-control currency" value="<?php echo $ar->no ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="simpleinput">Amount <span class="text-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" id="simpleinput" name="amount" class="form-control autonumber" data-a-sep="." data-a-dec="," value="<?php echo $ar->amount ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="simpleinput">Invoice date <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" id="simpleinput" name="tanggal" class="form-control basic-datepicker" value="<?php echo $ar->tanggal ?>">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fe-calendar"></i></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="simpleinput">Due Date <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" id="simpleinput" name="duedate" class="form-control basic-datepicker" value="<?php echo $ar->duedate ?>">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fe-calendar"></i></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="simpleinput">Description<span class="text-danger">*</span></label>
                <input type="text" id="simpleinput" name="description" class="form-control currency" value="<?php echo $ar->description ?>">
            </div>

        </form>

    </div>

</div>

<div id='ResponseInput'></div>

<script type="text/javascript">
    $(".basic-datepicker").flatpickr(), $(".datetime-datepicker").flatpickr({
        enableTime: !0,
        dateFormat: "Y-m-d H:i"
    })
</script>
<script src="<?php echo base_url('assets/libs/autonumeric/autoNumeric-min.js') ?>"></script>

<script src="<?php echo base_url('assets/js/pages/form-masks.init.js') ?>"></script>
