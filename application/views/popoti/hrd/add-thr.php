<link href="<?php echo base_url() ?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>assets/libs/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>assets/libs/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
<div class="row">


    <div class="col-lg-12">


        <form action="<?php echo site_url('hrd/tambah-bpjs/'.encode($thr->id)) ?>" method="post" class=".tambah-sparepart">


            <div class="row">
                <div class="col-9">
                    <div class="form-group">

                        <label for="">Logical Operator</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Years Of Service</div>
                            </div>
                            <?php if ($thr->id): ?>
                                <select class="form-control" name="op" id="">
                                    <?php if ($thr->op): ?>
                                        <option value="<?php echo $thr->op ?>"> <?php echo $thr->op ?></option>                            
                                    <?php endif ?>
                                </select>
                                <?php else: ?>
                                <select class="form-control" name="op" id="">
                                    <option value="">----  Select Logical Operator ----</option>
                                    <option value=">="> >=</option>
                                    <option value="<"> <</option>
                                </select>
                            <?php endif ?>
                        </div>
                    </div>
                    
                </div>
                <div class="col-3">
                    <div class="from-group">
                        <label for="">Years</label>
                        <div class="input-group">
                            <input type="text" class="form-control">
                            <div class="input-group-append">
                                <div class="input-group-text">Year</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">

                <label >Kalkulasi Dari Gaji Bruto<span class="text-danger">*</span></label>

                <div class="input-group">
                    <input type="text" name="kalkulasi" class="form-control" value="<?php echo ($thr->kalkulasi) ? $thr->kalkulasi * 100 : '' ?>">
                    <div class="input-group-addon">
                        <div class="input-group-text">%</div>
                    </div>
                </div>

            </div>

        </form>

    </div>

</div>


<div id='ResponseInput'></div>


<script src="<?php echo base_url() ?>assets/libs/select2/js/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/pages/form-advanced.init.js"></script>



