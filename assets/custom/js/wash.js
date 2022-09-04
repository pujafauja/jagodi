( function ( $ ) {

    "use strict";

    var base_url = $('#base_url').val();

    if( $.isFunction($.fn.autocomplete) ) {
        $('#unit').autocomplete({

            serviceUrl: base_url+"customer/ajax-unit",
            showNoSuggestionNotice: 'Unit tidak ditemukan!',
            onSelect: function(suggestion) {
                $(this).val(suggestion.value);
                $('input[name="unit-id"]').val(suggestion.id)
                $('input[name="merk"]').val(suggestion.merk)
                $('input[name="jenis"]').val(suggestion.jenis)
                $('input[name="kategori"]').val(suggestion.kategori)
                $('input[name="merkid"]').val(suggestion.merkid)
                $('input[name="jenisid"]').val(suggestion.jenisid)
                $('input[name="category_id"]').val(suggestion.catid)

            },
            select: function(event, ui) {
                return true;
            }
        });
    }

    $('input[name=cust-nama]').autocomplete({

        serviceUrl: base_url+"customer/nama-json-ajax",
        showNoSuggestionNotice: 'Kategori tidak ditemukan!',
        onSelect: function(suggestion) {
            $(this).val(suggestion.value);
        },
        select: function(event, ui) {
            return true;
        }
    });
    $('input[name=district]').autocomplete({

        serviceUrl: base_url+"customer/desa-json-ajax",
        showNoSuggestionNotice: 'Kategori tidak ditemukan!',
        onSelect: function(suggestion) {
            $(this).val(suggestion.value);
            $('input[name="district-id"]').val(suggestion.id);
        },
        select: function(event, ui) {
            return true;
        }
    });
    $('#no').autocomplete({

        serviceUrl: base_url+"customer/customer-json",
        showNoSuggestionNotice: 'Customer tidak ditemukan!',
        onSelect: function(suggestion) {
            $('#no').val(suggestion.no);
            $('input[name="customerid"]').val(suggestion.data);
            $('input[name="cust-nama"]').val(suggestion.nama);
            $('input[name="district"]').val(suggestion.district);
            $('#last_service').text(suggestion.last_service);
            $('#total_come').text(suggestion.total_come);
            $('input[name=district-id]').val(suggestion.desa_id)
        },
        select: function(event, ui) {
            return true;
        }
    });

    $(document).on('click', '#customers', function(e){
        var tombol = "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').removeClass('modal-lg');
        $('.modal-dialog').addClass('modal-full-width');

        $('#ModalHeader').html('Choose Customer');
        $('#ModalContent').load($(this).attr('href'));
        $('#ModalFooter').html(tombol);
        $('#ModalGue').modal('show');
    })

    $(document).on('click', '#units', function(e){
        var tombol = "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').removeClass('modal-lg');
        $('.modal-dialog').addClass('modal-full-width');

        $('#ModalHeader').html('Choose Unit');
        $('#ModalContent').load($(this).attr('href'));
        $('#ModalFooter').html(tombol);
        $('#ModalGue').modal('show');
    })
    $(document).on('click', '#washer', function(e){
        var tombol = "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').removeClass('modal-lg');
        $('.modal-dialog').addClass('modal-full-width');

        $('#ModalHeader').html('Choose Washer');
        $('#ModalContent').load($(this).attr('href'));
        $('#ModalFooter').html(tombol);
        $('#ModalGue').modal('show');
    })
    $(document).on('click', 'input[name=washer]', function(event) {
        event.preventDefault();
        $('#washer').trigger('click')
    });

    if( $.isFunction($.fn.DataTable) )
    {
        var dataTable = $('#prices-datatable').DataTable( {
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"wash/tambah-prices' class='btn btn-danger waves-effect waves-light ml-3' id='TambahPrices'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
                // "sInfoFiltered": "(difilter dari _MAX_ total data)", 
                // "sZeroRecords": "Pencarian tidak ditemukan", 
                // "sEmptyTable": "Data kosong", 
                // "sLoadingRecords": "Harap Tunggu...", 
                "oPaginate": {
                    "sPrevious": "Prev",
                    "sNext": "Next"
                }
            },
            "aaSorting": [[ 0, "asc" ]],
            "columnDefs": [ 
                {
                    "targets": 'no-sort',
                    "orderable": false,
                }
            ],
            "sPaginationType": "simple_numbers", 
            "iDisplayLength": 10,
            "aLengthMenu": [[10, 20, 50, 100, 150], [10, 20, 50, 100, 150]],
            "ajax":{
                url : base_url+"wash/prices-json",
                type: "post",
                error: function(){ 
                    $(".prices-datatable-error").html("");
                    $("#prices-datatable").append('<tbody class="prices-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#prices-datatable_processing").css("display","none");
                }
            },
            language: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'>",
                    next: "<i class='mdi mdi-chevron-right'>"
                }
            },
            drawCallback: function() {
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
            }
        } );
    }


    $(document).on('click', '#TambahPrices, #EditPrices', function(e){

        e.preventDefault();

        var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SimpanPrices'>Save</button>";
        Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').removeClass('modal-full-widt');
        $('.modal-dialog').addClass('modal-lg');

        if($(this).attr('id') == 'TambahPrices')
        {
            $('#ModalHeader').html('Add New Price');
        }
        
        if($(this).attr('id') == 'EditPrices')
        {
            $('#ModalHeader').html('Edit Price');
        }

        $('#ModalContent').load($(this).attr('href'));
        $('#ModalGue').modal('show');
        $('#ModalFooter').html(Tombol);

        $('.currency').autoNumeric('init', {
            aSep: '.',
            aDec: ','
        });
    });

    $(document).on('click', '#SimpanPrices', function(e){

        e.preventDefault();

        if($(this).hasClass('disabled'))
        {
            return false;
        }
        else
        {
            if($('.tambah-prices').serialize() !== '')
            {
                $.ajax({
                    url: $('.tambah-prices').attr('action'),
                    type: "POST",
                    cache: false,
                    data: $('.tambah-prices').serialize(),
                    dataType:'json',
                    beforeSend:function(){
                        $('#SimpanPrices').html("Saving, please wait ...");
                    },
                    success: function(json){
                        if(json.status == 1){ 
                            $('.modal-dialog').removeClass('modal-lg');
                            $('.modal-dialog').addClass('modal-sm');
                            $('#ModalHeader').html('Success !');
                            $('#ModalContent').html(json.pesan);
                            $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                            $('#ModalGue').modal('show');
                            $('#prices-datatable').DataTable().ajax.reload( null, false );
                        }
                        else {
                            $('#ResponseInput').html(json.pesan);
                        }

                        $('#SimpanPrices').html('Save');
                    }
                });
            }
            else
            {
                $('#ResponseInput').html('');
            }
        }

    });

    $(document).on('submit', '.tambah-prices', function(e){

        e.preventDefault();

        if($(this).hasClass('disabled'))
        {
            return false;
        }
        else
        {
            if($('.tambah-prices').serialize() !== '')
            {
                $.ajax({
                    url: $('.tambah-prices').attr('action'),
                    type: "POST",
                    cache: false,
                    data: $('.tambah-prices').serialize(),
                    dataType:'json',
                    beforeSend:function(){
                        $('#SimpanPrices').html("Saving, please wait ...");
                    },
                    success: function(json){
                        if(json.status == 1){ 
                            $('.modal-dialog').removeClass('modal-lg');
                            $('.modal-dialog').addClass('modal-sm');
                            $('#ModalHeader').html('Success !');
                            $('#ModalContent').html(json.pesan);
                            $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                            $('#ModalGue').modal('show');
                            $('#prices-datatable').DataTable().ajax.reload( null, false );
                        }
                        else {
                            $('#ResponseInput').html(json.pesan);
                        }

                        $('#SimpanPrices').html('Save');
                    }
                });
            }
            else
            {
                $('#ResponseInput').html('');
            }
        }
    });

   // mulai 

    $('#payment-box').on('show.bs.modal', function(){
        $('#cash-amount').focus();
        var grandtotal = $('#grand').text();
            grandtotal = toFloat(grandtotal);

        $('#grandtotal').autoNumeric('set', grandtotal);
    })

    $('input[name="category_id"]').on('change', function(){
        $('#find-item').autocomplete({

            serviceUrl: base_url + 'wash/data-json',
            showNoSuggestionNotice: 'Barang tidak ditemukan!',
            type: 'post',
            dataType: 'json',
            params: {categoryid: $(this).val()},
            onSelect: function(suggestion) {
                $('#find-item').val('');
                $('#find-item').focus();

                var harga       = suggestion.harga;
                var id_barang   = suggestion.data;
                var nama_barang = suggestion.value;

                let ex = 0;

                $('#tbl-transaction tbody tr').each(function(){
                    if($(this).data('id') == id_barang)
                        ex += 1;
                })

                if(ex == 0)
                {
                    $('#tbl-transaction').prepend('<tr data-id="'+id_barang+'">\
                                                    <td><a class="delete-item text-danger mr-1"><i class="fas fa-times"></i></a>'+nama_barang+'<input type="hidden" name="kode-barang[]" value="'+id_barang+'"></td>\
                                                    <td><span class="autonumber" data-a-sep="." data-a-dec="," data-m-dec="0" data-a-sign="Rp. ">'+harga+'</span><input type="hidden" name="harga_satuan[]" value="'+harga+'"></td>\
                                                    <td><input class="form-control autonumber" data-a-sep="." data-a-dec="," data-m-dec="0" type="text" name="jumlah_beli[]" value="1"> </td>\
                                                    <td>\
                                                        <div class="input-group">\
                                                            <div class="input-group-prepend">\
                                                                <span class="input-group-text">Rp</span>\
                                                            </div>\
                                                            <input class="form-control autonumber" data-a-sep="." data-a-dec="," data-m-dec="0" name="diskon[]">\
                                                        </div>\
                                                    </td>\
                                                    <td class="text-right"><span class="autonumber" data-a-sep="." data-a-dec="," data-m-dec="0" data-a-sign="Rp. ">'+harga+'</span><input type="hidden" name="sub_total[]" value="'+harga+'"></td>\
                                                </tr>');
                    $(".autonumber").autoNumeric("init");
                }

                hitungtotal();
            },
            select: function(event, ui) {
                $(this).val('');
                return true;
            }
        });

    })

    $('#find-item').on('focus', function(){
        var categoryid = $('input[name="category_id"]').val();
        if(! categoryid)
        {
            Swal.fire({
                title: "Error!",
                text: "Please select unit!",
                type: "error"
            }).then(function(t) {
                $('body').trigger('focus');
            })
        }
    })

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


    function hitungsub(row)
    {
        let qty      = row.find('td').eq(2).find('input').val();
            qty   = toFloat(qty);
        let harga    = row.find('td').eq(1).find('span').text();
            harga = harga.replace('Rp. ', '')
            harga = toFloat(harga);
        let discount = row.find('td').eq(3).find('input').val();
            discount = toFloat(discount);

        let beforediskon = qty * harga;
        // let diskon = (discount / 100) * beforediskon;
        let subtotal = beforediskon - discount;


        row.find('td').eq(4).find('span').autoNumeric('set', subtotal);
        row.find('td').eq(4).find('input').val(subtotal);
        hitungtotal()
    }

    function hitungtotal() 
    {
        let total  = 0;
        let diskon = 0;

        $('#tbl-transaction tbody tr').each(function(){
            let qty      = $(this).find('td').eq(2).find('input').val();
                qty   = toFloat(qty);
            let harga    = $(this).find('td').eq(1).find('span').text();
                harga = harga.replace('Rp. ', '')
                harga = toFloat(harga);
            let disc = $(this).find('td').eq(3).find('input').val();

            let beforediskon = qty * harga;
            let subtotal = beforediskon - diskon;

            diskon += disc;
            total  += beforediskon;
        })

        $('#Total').autoNumeric('set', total);
        $('#Discount').autoNumeric('set', diskon);

        let grand = total - diskon;

        $('#grand').autoNumeric('set', grand);

        if(grand > 0)
            $('.btn-payment').prop('disabled', false);
        else
            $('.btn-payment').prop('disabled', true);
    }

    function resetForm()
    {
        // $('#payment-box').modal('hide');
        // $('input, select').val('');
        // $('.autonumber').autoNumeric('init')
        // $('.autonumber').autoNumeric('set', 0)
        // $('#tbl-transaction tbody tr').each(function(){
        //     $(this).remove();
        // })
    }


    $(document).on('click', '#new-transaction', function(e){
        e.preventDefault();

        resetForm();
    })

    function SimpanTransaksi()
    {
        var FormData = "nomor_nota="+encodeURI($('#nomor_nota').val());
        FormData += "&tanggal="+encodeURI($('#tanggal').val());
        FormData += "&userid="+$('#userid').val();
        FormData += "&no-plat="+$('input[name=no-plat]').val();
        FormData += "&vehicleid="+$('input[name=vehicleid]').val();
        FormData += "&unit-id="+$('input[name=unit-id]').val();
        FormData += "&merkid="+$('input[name=merkid]').val();
        FormData += "&washerid="+$('input[name=washerid]').val();
        FormData += "&jenisid="+$('input[name=jenisid]').val();
        FormData += "&catid="+$('input[name=catid]').val();
        FormData += "&category_id="+$('input[name=category_id]').val();
        FormData += "&cust-nama="+$('input[name=cust-nama]').val();
        FormData += "&customerid="+$('input[name=customerid]').val();
        FormData += "&no-hp="+$('input[name=no-hp]').val();
        FormData += "&district-id="+$('input[name=district-id]').val();
        FormData += "&" + $('#tbl-transaction tbody input').serialize();
        FormData += "&cash="+$('#cash-amount').val();
        FormData += "&grand_total="+$('#grand').text();
        FormData += "&totaldisc="+$('#Discount').text();

        $.ajax({
            url: $('form').attr('action'),
            type: "POST",
            cache: false,
            data: FormData,
            dataType:'json',
            success: function(data){
                if(data.status == 1)
                {
                    Swal.fire({
                        title: "Transaksi Berhasil",
                        text: data.pesan,
                        type: "success",
                    }).then(function(result){
                        if(result.value)
                        {
                            window.open(
                                base_url + 'additional/print-wo/wash/' + data.washid + '?cetak=1',
                                'popUpWindow',
                                'height=567,width=793,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
                            if ($('form').data('type') == 'add') {                            
                                window.location.reload()
                            }else{
                                window.location.href = base_url + 'additional/summary'
                            }
                        }
                    })
                }
                else 
                {
                    Swal.fire({
                        title: "Oops !", 
                        html: data.pesan, 
                        type: "error"
                    })
                }   
            }
        });
    }

    $(document).on('click', '.btn-payment', function(e){
        e.preventDefault()

        SimpanTransaksi()
    })
    
    $(document).on('keyup keydown change', '#cash-amount', function(){
        var pembayaran = $(this).val();
            pembayaran = toFloat(pembayaran);
        var tagihan    = $('#grand').text();
            tagihan    = toFloat(tagihan);
        var kembalian  = pembayaran - tagihan;

        if(kembalian < 0 || isNaN(kembalian))
            kembalian = 0;

        if(pembayaran < tagihan)
            $('#checkout').prop('disabled', true);
        else
            $('#checkout').prop('disabled', false);

        $('#change-amount').autoNumeric('set', kembalian);
    })

    $(document).on('click', '.delete-item', function(e){
        e.preventDefault();

        $(this).closest('tr').remove();
        hitungtotal();
    })

    $(document).on('keydown', 'body', function(e){
        var charCode = ( e.which ) ? e.which : event.keyCode;

        if(charCode == 13) {
            e.preventDefault();

            SimpanTransaksi()
        }
        if(charCode == 117) { // F6
            SimpanTransaksi();
        }
        if(charCode == 120) { // F9
            $('#find-item').focus();
        }
    });

    $(document).on('keyup', 'tbody input', function(){
        var row = $(this).closest('tr');

        hitungsub(row);
    })

    $(document).on('click', '#checkout', function(e){
        e.preventDefault();

        SimpanTransaksi();
    })

    $(document).on('click', '#suspend', function(e){
        e.preventDefault();

        SimpanTransaksi();
    })

    if( $.isFunction($.fn.autocomplete) )
    {
        $('#no-plat').autocomplete({

            serviceUrl: base_url+"customer/no-plat-json",
            showNoSuggestionNotice: 'No plat tidak ditemukan!',
            onSelect: function(suggestion) {
                $('input[name="no-plat"]').val(suggestion.value);
                $('input[name="vehicleid"]').val(suggestion.id);
                $('input[name="unit"]').val(suggestion.unit);
                $('input[name="unit-id"]').val(suggestion.unitid);
                $('input[name="merk"]').val(suggestion.merk);
                $('input[name="jenis"]').val(suggestion.jenis);
                $('input[name="merkid"]').val(suggestion.merkid);
                $('input[name="jenisid"]').val(suggestion.jenisid);
                $('input[name="kategori"]').val(suggestion.kategori);
                $('input[name="category_id"]').val(suggestion.catid);
                $('input[name="category_id"]').trigger('change');
            },
            select: function(event, ui) {
                return true;
            }
        });
    }

    $(document).on('click', '#plats', function(e){
        var tombol = "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').removeClass('modal-lg');
        $('.modal-dialog').addClass('modal-full-width');

        $('#ModalHeader').html('Choose Vehicle');
        $('#ModalContent').load($(this).attr('href'));
        $('#ModalFooter').html(tombol);
        $('#ModalGue').modal('show');
    })

    $(document).on('click', '.popup-item', function(e){
        e.preventDefault();
        var tombol = "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        let categoryid = $('#categoryid').val();
        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').removeClass('modal-lg');
        $('.modal-dialog').addClass('modal-full-width');

        $('#ModalHeader').html('Select Item');
        $('#ModalContent').load($(this).attr('href')+'/'+categoryid);
        $('#ModalFooter').html(tombol);
        $('#ModalGue').modal('show');
    })

if( $.isFunction($.fn.DataTable) )
    {
       
       var dataTable = $('#employee-datatable').DataTable( {
        "serverSide": true,
        "stateSave" : false,
        "bAutoWidth": true,
        "oLanguage": {
            // "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
            // "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"sparepart/new-abc-category' class='btn btn-danger waves-effect waves-light ml-3' id='TambahABC'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
            // "sInfoFiltered": "(difilter dari _MAX_ total data)", 
            // "sZeroRecords": "Pencarian tidak ditemukan", 
            // "sEmptyTable": "Data kosong", 
            // "sLoadingRecords": "Harap Tunggu...", 
            "oPaginate": {
                "sPrevious": "Prev",
                "sNext": "Next"
            }
        },
        "aaSorting": [[ 0, "asc" ]],
        "columnDefs": [ 
            {
                "targets": 'no-sort',
                "orderable": false,
            }
        ],
        "sPaginationType": "simple_numbers", 
        "iDisplayLength": 10,
        "aLengthMenu": [[10, 20, 50, 100, 150], [10, 20, 50, 100, 150]],
        "ajax":{
            url : base_url+"wash/wash-json",
            type: "post",
            error: function(){ 
                $(".employee-datatable-error").html("");
                $("#employee-datatable").append('<tbody class="employee-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                $("#employee-datatable_processing").css("display","none");
            }
        },
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            }
        },
        drawCallback: function() {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
        }
    } );  
}

} )( jQuery );