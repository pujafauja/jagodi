<div class="row">

    <div class="col-lg-12">



        <form action="<?php echo site_url('tradein/add-labor/'.encode($sparepart->id)) ?>" method="post" class="tambah-tradein">




            

            <div class="form-group">

                <label for="simpleinput">Item Name <span class="text-danger">*</span></label>

                <select name="nama" id="" class="form-control">
                            <option value="">Select Item</option>
                            <?php
                            if($select->num_rows() > 0):
                                foreach($select->result() as $al): ?>
                                    <option value="<?php echo $al->id ?>"><?php echo $al->nama ?></option>
                                <?php endforeach;
                            endif;
                            ?>
                        </select>

            </div> 
               



              <div class="form-group">

                <label for="simpleinput">Unit Price <span class="text-danger">*</span></label>

                <div class="input-group">

                    <div class="input-group-prepend">

                        <span class="input-group-text">Rp.</span>

                    </div>

                    <input type="text" id="simpleinput" data-a-sep="." data-a-dec="," data-m-dec="0" name="harga" class="form-control autonumber" value="<?php echo $sparepart->harga ?>">

                </div>

            </div>

              <div class="form-group">

                <label for="simpleinput">Price Service <span class="text-danger">*</span></label>

                <div class="input-group">

                    <div class="input-group-prepend">

                        <span class="input-group-text">Rp.</span>

                    </div>

                    <input type="text" id="simpleinput" data-a-sep="." data-a-dec="," data-m-dec="0" name="harga" class="form-control autonumber" value="<?php echo $sparepart->harga ?>">

                </div>

            </div>

               <div class="form-group">

                <label for="simpleinput">Location <span class="text-danger">*</span></label>

                <input type="text" id="simpleinput" name="kode" class="form-control" value="<?php echo $sparepart->kode ?>">

            </div>

              <div class="form-group">

                <label for="simpleinput">Stock / Qty <span class="text-danger">*</span></label>

                <input type="text" id="simpleinput" name="kode" class="form-control" value="<?php echo $sparepart->kode ?>">

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

