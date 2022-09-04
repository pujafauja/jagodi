<div class="row">
    <div class="col-lg-12">

        <form action="<?php echo site_url('Utilities/add-stationery/'.encode($stationery->id)) ?>" method="post" id="form-item">

               <div class="form-group">
                            <label for="simpleinput"> Date <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" id="simpleinput" name="tanggal" value="<?php echo $stationery->tanggal ?>" class="form-control basic-datepicker">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fe-calendar"></i></span>
                                </div>
                            </div>
                        </div>
            
            <div class="form-group">
                <label for="simpleinput">Item Name <span class="text-danger">*</span></label>
                <input type="text" id="simpleinput" name="nama" value="<?php echo $stationery->nama ?>"  class="form-control">
            </div>
        
         <div class="form-group">
                <label for="simpleinput">Unit <span class="text-danger">*</span></label>
                <input type="text" id="simpleinput" name="satuan" value="<?php echo $stationery->satuan ?>" class="form-control">
            </div>

            <div class="form-group">
                <label for="simpleinput">purchase price <span class="text-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" id="simpleinput" name="harga_beli" value="<?php echo $stationery->harga_beli ?>"  class="form-control currency">
                </div>
            </div>  


         <div class="form-group">
                <label for="simpleinput">Stock <span class="text-danger">*</span></label>
                <input type="text" id="simpleinput" name="stok" value="<?php echo $stationery->stok ?>"  class="form-control">
            </div>


       

          <div id='ResponseInput'></div>


<script type="text/javascript">

    $(".basic-datepicker").flatpickr(), $(".datetime-datepicker").flatpickr({

        enableTime: !0,

        dateFormat: "Y-m-d H:i"

    })

</script>
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

    // $(document).ready(function() {
    //     function handle(event){

    //         var hpp = $('input[name=harga]').val();
    //             hpp = toFloat(hpp);
    //         var disc = $('input[name=discount]').val();
    //             disc = toFloat(disc);
    //         var program = $('input[name=program]').val();
    //             program = toFloat(program);
    //         var margin = $('input[name=margin]').val();
    //             margin = toFloat(margin);
    //         var vat = $('input[name=vat]').val()
    //             vat = toFloat(vat);

    //         var nominaldisc   = ((disc / 100) * hpp)
    //         var afterprogram  = hpp - nominaldisc - program
    //         var nominalmargin = (margin / 100) * hpp
    //         var nominalvat    = ($('.tambah-sparepart input[name="vat_type"]:checked').val() == '%') ? (vat / 100) * hpp : vat

    //         var het = afterprogram + nominalmargin

    //         $('.autonumber').autoNumeric('init');

    //         if ($('#Enable').prop('checked')) 
    //         {
    //             $('input[name=het]').autoNumeric('set', het + nominalvat)
    //         }else{
    //             $('input[name=het]').autoNumeric('set', het)
    //         }
    //     }
    //     $(document).on('click', '#Enable', function(){
    //         handle()
    //     })
    //     $(document).on('keyup', 'input[name=vat], input[name=harga], input[name=discount], input[name=program], input[name=margin]', function(){
    //         handle()
    //     })


    //     $(document). on('change', 'input[name=vat_type]', function(event) {
    //         event.preventDefault();
    //         handle()
    //     });

    // });

</script>
