<div class="row">
    <div class="col-lg-12">

        <form action="<?php echo site_url('customer/tambah-customer/'.encode($customer->id)) ?>" method="post" class="tambah-customer">

            <div class="form-group">
                <label for="">Customer Name <span class="text-danger">*</span></label>
                <input type="text" id="" name="nama" class="form-control" value="<?php echo $customer->nama ?>">
            </div>
            <div class="form-group">
                <label for="">Phone Number <span class="text-danger">*</span></label>
                <input type="text" id="" name="no" class="form-control" value="<?php echo $customer->no ?>">
            </div>
            <div class="form-group">
                <label for="">Address <span class="text-danger">*</span></label>
                <input type="text" id="" name="address" class="form-control" value="<?php echo $customer->address ?>">
                <input type="hidden" name="desaid" value="<?php echo $customer->desaid ?>">
            </div>

        </form>
    </div>
</div>

<div id='ResponseInput'></div>

<script type="text/javascript" src="<?php echo base_urL('assets/libs/devbridge-autocomplete/jquery.autocomplete.min.js') ?>"></script>

<script type="text/javascript">
    ( function ( $ ) {

        "use strict";

        $('input[name="address"]').autocomplete({

            serviceUrl: "<?php echo base_url('customer/desa-json-ajax') ?>",
            showNoSuggestionNotice: 'Data not found!',
            onSelect: function(suggestion) {
                $(this).val(suggestion.value);
                $('input[name="desaid"]').val(suggestion.id);
            },
            select: function(event, ui) {
                return true;
            }
        });

    }) ( jQuery )
</script>