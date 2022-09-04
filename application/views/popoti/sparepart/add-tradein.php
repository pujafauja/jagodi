<div class="row">

    <div class="col-lg-12">



        <form action="<?php echo site_url('sparepart/tambah-tradein/'.encode($tradein->id)) ?>" method="post" class="tambah-tradein">



            <div class="form-group">

                <label for="simpleinput">Code <span class="text-danger">*</span></label>

                <input type="text" id="simpleinput" name="kode" class="form-control" value="<?php echo $tradein->kode ?>">

            </div>

            <div class="form-group">

                <label for="simpleinput">Part Name <span class="text-danger">*</span></label>

                <input type="text" id="simpleinput" name="nama" class="form-control" value="<?php echo $tradein->nama ?>">

            </div>

            <div class="form-group">

                <label for="simpleinput">Category <span class="text-danger">*</span></label>

                <select name="catid" id="" class="form-control">

                    <option value="">-- Choose One --</option>

                    <?php

                    if($category->num_rows() > 0)

                    {

                        foreach($category->result() as $C)

                        { ?>

                            <option value="<?php echo $C->id ?>" <?php echo ($C->id == $tradein->catid) ? 'selected=""' : '' ?>><?php echo $C->nama ?></option>

                        <?php }

                    }

                    ?>

                </select>

            </div>

            <div class="form-group">

                <label for="simpleinput">Merk</label>

                <select name="merkid" id="" class="form-control">

                    <option value="">-- Choose One --</option>

                    <?php

                    if($merk->num_rows() > 0)

                    {

                        foreach($merk->result() as $M)

                        { ?>

                            <option value="<?php echo $M->id ?>" <?php echo ($M->id == $tradein->merkid) ? 'selected=""' : '' ?>><?php echo $M->nama ?></option>

                        <?php }

                    }

                    ?>

                </select>

            </div>

            <div class="form-group">

                <label for="simpleinput">HPP <span class="text-danger">*</span></label>

                <div class="input-group">

                    <div class="input-group-prepend">

                        <span class="input-group-text">Rp.</span>

                    </div>

                    <input type="text" id="simpleinput" data-a-sep="." data-a-dec="," data-m-dec="0" name="harga" class="form-control autonumber" value="<?php echo $tradein->harga ?>">

                </div>

            </div>

            <div class="form-group">

                <label for="simpleinput">Discount</label>

                <div class="input-group">

                    <input type="text" id="simpleinput" name="discount" class="form-control" value="<?php echo $tradein->discount ?>">

                    <div class="input-group-append">

                        <span class="input-group-text">%</span>

                    </div>

                </div>

            </div>

            <div class="form-group">

                <label for="simpleinput">Program</label>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" id="simpleinput" name="program" data-a-sep="." data-a-dec="," data-m-dec="0" name="harga" class="form-control autonumber" value="<?php echo $tradein->program ?>">
                </div>

            </div>
            <div class="form-group">

                <label for="simpleinput">Margin <span class="text-danger">*</span></label>

                <div class="input-group">

                    <input type="text" id="simpleinput" name="margin" class="form-control" value="<?php echo $tradein->margin ?>">

                    <div class="input-group-append">

                        <span class="input-group-text">%</span>

                    </div>

                </div>

            </div>

            <div class="form-group">

                <label for="simpleinput">VAT Input</label>

                    <div class="input-group">

                        <div class="input-group-addon">

                            <div class="input-group-text">

                                <label for="" class="radio-inline p-0 mb-0">                                

                                    <input type="radio" name="vat_type"  value="Rp" id="" <?php echo ($tradein->vat_type == 'Rp') ? 'checked=""': ''; ?> >Rp <span class="mr-1"></span> 

                                </label>

                                <label for="" class="radio-inline p-0 mb-0">                                

                                    <input type="radio" name="vat_type"  value="%" id="" <?php echo ($tradein->vat_type == '%') ? 'checked=""': ''; ?> >%

                                </label>

                            </div>

                        </div>

                    <input type="text" id="simpleinput" name="vat" data-a-sep="." data-a-dec="," data-m-dec="2" class="form-control autonumber" value="<?php echo $tradein->vat ?>">

                </div>

            </div>

            <div class="custom-control mb-2 custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="Enable" checked="">
                <label class="custom-control-label" for="Enable">Enable VAT</label>
            </div>

            <div class="form-group">

                <label for="simpleinput">HET</label>

                <div class="input-group">

                    <div class="input-group-addon">

                        <div class="input-group-text">Rp. </div>

                    </div>

                    <input type="text" id="simpleinput" data-a-sep="." data-a-dec="," data-m-dec="0" name="het" class="form-control autonumber" value="<?php echo $tradein->het ?>">

                </div>

            </div>



        </form>

    </div>

</div>


<div id='ResponseInput'></div>

<script src="<?php echo base_url() ?>assets/js/vendor.min.js"></script>
<script src="<?php echo base_url('assets/libs/autonumeric/autoNumeric-min.js') ?>"></script>

<script src="<?php echo base_url('assets/js/pages/form-masks.init.js') ?>"></script>

<script>

    function toFloat(nominal = 0)
    {
        if(nominal == '')
        {
            nominal = 0;
            nominal = parseFloat(nominal);
        } else {
            nominal = nominal.replace(/[.]/g, '');
            nominal = nominal.replace(/[,]/g, '.');
            nominal = parseFloat(nominal);
        }

        return nominal;
    }

    $(document).ready(function() {
        function handle(event){

            var hpp = $('input[name=harga]').val();
                hpp = toFloat(hpp);
            var disc = $('input[name=discount]').val();
                disc = toFloat(disc);
            var program = $('input[name=program]').val();
                program = toFloat(program);
            var margin = $('input[name=margin]').val();
                margin = toFloat(margin);
            var vat = $('input[name=vat]').val()
                vat = toFloat(vat);

            var nominaldisc   = ((disc / 100) * hpp)
            var afterprogram  = hpp - nominaldisc - program
            var nominalmargin = (margin / 100) * hpp
            var nominalvat    = ($('.tambah-sparepart input[name="vat_type"]:checked').val() == '%') ? (vat / 100) * hpp : vat

            var het = afterprogram + nominalmargin

            $('.autonumber').autoNumeric('init');

            if ($('#Enable').prop('checked')) 
            {
                $('input[name=het]').autoNumeric('set', het + nominalvat)
            }else{
                $('input[name=het]').autoNumeric('set', het)
            }
        }
        $(document).on('click', '#Enable', function(){
            handle()
        })
        $(document).on('keyup', 'input[name=vat], input[name=harga], input[name=discount], input[name=program], input[name=margin]', function(){
            handle()
        })


        $(document). on('change', 'input[name=vat_type]', function(event) {
            event.preventDefault();
            handle()
        });

    });

</script>

