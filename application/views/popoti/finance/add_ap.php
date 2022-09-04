<div class="row">
    <div class="col-lg-12">

       <form action="<?php echo site_url('finance/tambah-ap/'.encode($ap->id)) ?>" method="post" id="form-item">

            <div class="form-group">
                <label for="simpleinput">Invoice Number <span class="text-danger">*</span></label>
                <input type="text" id="simpleinput" name="no" class="form-control currency" placeholder="" value="<?php echo $ap->no ?>">
            </div>

            <div class="form-group">
                <label for="simpleinput">Supplier Name <span class="text-danger">*</span></label>
                <select class="form-control" name="supplierid">
                    <option value=""> Choose One </option>
                    <?php 
                    if($suppliers->num_rows() > 0):                 
                        foreach($suppliers->result() as $c): ?>

                            <?php if ($ap->id): ?>
                                <?php if ($ap->id == $c->id): ?>
                                    <option value="<?php echo $c->id ?>" selected><?php echo $c->nama ?></option>
                                <?php else: ?>
                                    <option value="<?php echo $c->id ?>"><?php echo $c->nama ?></option>
                                <?php endif ?>
                            <?php else: ?>
                                <option value="<?php echo $c->id ?>"><?php echo $c->nama ?></option>
                            <?php endif ?>
                       
                        <?php endforeach; ?>
                    <?php endif;?>
                </select>
            </div>

            <div class="form-group">
                <label for="simpleinput">Amount <span class="text-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" id="simpleinput" name="amount" class="form-control autonumber" data-a-sep="." data-a-dec="," value="<?php echo $ap->tagihan ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="simpleinput">Invoice date <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" id="simpleinput" name="tanggal" class="form-control basic-datepicker" value="<?php echo $ap->tanggal ?>">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fe-calendar"></i></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="simpleinput">Due Date <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" id="simpleinput" name="duedate" class="form-control basic-datepicker" value="<?php echo $ap->duedate ?>">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fe-calendar"></i></span>
                    </div>
                </div>
            </div>

            <!-- <div class="form-group">
                <label for="simpleinput">Description<span class="text-danger">*</span></label>
                <input type="text" id="simpleinput" name="description" class="form-control currency" value="<?php echo $ap->description ?>">
            </div> -->

        </form>
    </div>
</div>

<div id='ResponseInput'></div>

<script src="<?php echo base_url('assets/libs/autonumeric/autoNumeric-min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/pages/form-masks.init.js') ?>"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $(".basic-datepicker").flatpickr(), $(".datetime-datepicker").flatpickr({
            enableTime: !0,
            dateFormat: "Y-m-d H:i"
        })
    })
</script>
