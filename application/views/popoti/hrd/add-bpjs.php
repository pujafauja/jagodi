<link href="<?php echo base_url() ?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>assets/libs/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>assets/libs/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
<div class="row">


    <div class="col-lg-12">


        <form action="<?php echo site_url('hrd/tambah-bpjs/'.encode($bpjs->id)) ?>" method="post" id="form-bpjs">



            <div class="form-group">

                <label for="">Logical Operator</label>
                <?php if ($bpjs->id): ?>
                    <select class="form-control" name="op" id="">
                        <?php if ($bpjs->op): ?>
                            <option value="<?php echo $bpjs->op ?>">Upah <?php echo $bpjs->op ?> UMR</option>                            
                        <?php endif ?>
                    </select>
                    <?php else: ?>
                    <select class="form-control" name="op" id="">
                        <option value="">----  Select Logical Operator ----</option>
                        <option value=">=">Upah >= UMR</option>
                        <option value="<">Upah < UMR</option>
                    </select>
                <?php endif ?>


            </div>

            <div class="form-group">

                <label >BPJS Kesehatan Karyawan<span class="text-danger">*</span></label>

                <div class="input-group">
                    <input type="text" name="kes_karyawan" class="form-control" value="<?php echo ($bpjs->kes_karyawan) ? $bpjs->kes_karyawan * 100 : '' ?>">
                    <div class="input-group-addon">
                        <div class="input-group-text">%</div>
                    </div>
                </div>

            </div>
            <div class="form-group">

                <label >BPJS Kesehatan Perusahaan<span class="text-danger">*</span></label>

                <div class="input-group">
                    <input type="text" name="kes_perusahaan" class="form-control" value="<?php echo ($bpjs->kes_perusahaan) ? $bpjs->kes_perusahaan * 100 : '' ?>">
                    <div class="input-group-addon">
                        <div class="input-group-text">%</div>
                    </div>
                </div>

            </div>
            <div class="form-group">

                <label >BPJS Ketenaga Kerjaan Karyawan<span class="text-danger">*</span></label>

                <div class="input-group">
                    <input type="text" name="naker_karyawan" class="form-control" value="<?php echo ($bpjs->naker_karyawan) ? $bpjs->naker_karyawan * 100 : '' ?>">
                    <div class="input-group-addon">
                        <div class="input-group-text">%</div>
                    </div>
                </div>

            </div>
            <div class="form-group">

                <label >BPJS Ketenaga Kerjaan Perusahaan<span class="text-danger">*</span></label>

                <div class="input-group">
                    <input type="text" name="naker_perusahaan" class="form-control" value="<?php echo ($bpjs->naker_perusahaan) ? $bpjs->naker_perusahaan * 100 : '' ?>">
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



