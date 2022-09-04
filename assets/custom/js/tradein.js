( function ( $ ) {
    "use strict";

    var base_url = $('#base_url').val();

    /*
    * tradein
    */

    var dataTable = $('#tradein-datatable').DataTable( {
        "serverSide": true,
        "stateSave" : false,
        "bAutoWidth": true,
        "oLanguage": {
            "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
            "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"Tradein/Add-Tradein' class='btn btn-danger waves-effect waves-light ml-3' id='AddTradein'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span><a href='"+base_url+"Tradein/Add-Labor' class='btn btn-primary waves-effect waves-light ml-3' id='AddLabor'><i class='mdi mdi-plus-circle mr-1'></i> Add Labor</a><span id='Notifikasi' style='display: none;'></span>",
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
            url : base_url+"Tradein/tradein_json/",
            type: "post",
            error: function(){ 
                $(".tradein-datatable-error").html("");
                $("#tradein-datatable").append('<tbody class="tradein-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                $("#tradein-datatable_processing").css("display","none");
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

      var dataTable = $('#tradein2-datatable').DataTable( {
        "serverSide": true,
        "stateSave" : false,
        "bAutoWidth": true,
        "oLanguage": {
            "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
            "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"Tradein/order-tradein' class='btn btn-danger waves-effect waves-light ml-3'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
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
            url : base_url+"sparepart/sparepart-json/1",
            type: "post",
            error: function(){ 
                $(".tradein-datatable-error").html("");
                $("#tradein-datatable").append('<tbody class="tradein-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                $("#tradein-datatable_processing").css("display","none");
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

      
   


    $(document).on('click', '.popup-item', function(e){
        e.preventDefault();
        var tombol = "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        let categoryid = $('#categoryid').val();
        console.log(categoryid);
        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').removeClass('modal-full-width');
        $('.modal-dialog').addClass('modal-lg');

        $('#ModalHeader').html('Select Item');
        $('#ModalContent').load($(this).attr('href'));
        $('#ModalFooter').html(tombol);
        $('#ModalGue').modal('show');
    })

     $(document).on('click', '.choose', function(e){
        e.preventDefault()

        var price       = $(this).closest('tr').find('td').eq(1).text();
        var kode        = $(this).data('id');
        var item_name   = $(this).closest('tr').find('td').eq(0).text();

        let ex = 0;

        $('#tbl-transaction tbody tr').each(function(){
            if($(this).data('id') == kode)
                ex += 1;
        })

        if(ex == 0)
        {
            $('#tbl-transaction').prepend('<tr data-id="'+kode+'">\
                                            <td>\
                                                <a class="delete-item text-danger close-harga mr-1"><i class="mdi mdi-minus-circle mr-1"></i></a> \
                                                <a class="icon-item text-info append-labor mr-1" data-labor="close"><i class="mdi mdi-account-plus-outline mr-1"></i></a>\
                                                '+item_name+'\
                                                <input type="hidden" name="kode-barang[]" value="'+kode+'">\
                                            </td>\
                                            <td><input class="form-control autonumber" data-a-sep="." data-a-dec="," data-m-dec="0" type="text" data-a-sign="Rp." name="price_satuan[]" value="'+price+'"> </td>\
                                            <td><input class="form-control autonumber" data-a-sep="." data-a-dec="," data-m-dec="0" type="text" name="jumlah_beli[]" value="1"> </td>\
                                            <td class="text-right"><span class="autonumber" data-a-sep="." data-a-dec="," data-m-dec="0" data-a-sign="Rp. ">'+price+'</span><input type="hidden" name="sub_total[]" value="'+price+'"></td>\
                                        </tr>');
            $(".autonumber").autoNumeric("init");
        hitungtotal();
        }

    })

     $(document).on('keyup', '#tbl-transaction input', function(){
        hitungsub($(this).closest('tr'))
     })

     $(document).on('click', '.append-labor', function(e){
        e.preventDefault()

        var $this = $(this).closest('tr')


        if($(this).data('labor') == 'close')
        {
            $this.find('.append-labor i').removeClass('mdi-account-plus-outline')
            $this.find('.append-labor i').addClass('mdi-account-minus-outline')
            $this.after('<tr data-id="">\
                                        <td><input class="form-control type="text" name="name_item[]"> </td>\
                                        <td><input class="form-control autonumber" data-a-sep="." data-a-dec="," data-m-dec="0" type="text" data-a-sign="Rp." name="price_satuan[]"></td>\
                                        <td><input class="form-control autonumber" data-a-sep="." data-a-dec="," data-m-dec="0" type="text" name="jumlah_beli[]" value="1"> </td>\
                                        <td class="text-right"><span class="autonumber" data-a-sep="." data-a-dec="," data-m-dec="0" data-a-sign="Rp. "></span><input type="hidden" name="sub_total[]" value=""></td>\
                                    </tr>')

            $(this).data('labor', 'open')
        }
        else
        {
            $(this).data('labor', 'close')

            $this.find('.append-labor i').addClass('mdi-account-plus-outline')
            $this.find('.append-labor i').removeClass('mdi-account-minus-outline')
            $this.next('tr').remove()
        }

         hitungtotal();
     })


     $(document).on('click', '.close-harga', function(e){
        e.preventDefault()

        var $this = $(this).closest('tr')

         $(this).closest('tr').remove();
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
        let qty   = row.find('td').eq(2).find('input').val();
            qty   = toFloat(qty);
        let price = row.find('td').eq(1).find('input').val();
            price = price.replace('Rp.', '')
            price = toFloat(price);

        let beforesub = qty * price;
        let subtotal = beforesub;

        row.find('td').eq(3).find('span').autoNumeric('set', subtotal);
        row.find('td').eq(3).find('input').val(subtotal);
        hitungtotal()
    }

    $(document).on('click', '#bayar-order', function(e){
        e.preventDefault()
        var formData = $(this).closest('form')      
        $.ajax({
            url      : formData.attr('action'),
            dataType : 'json',
            method   : 'post',
            data     : formData.serializeArray(),
            success  : function(data){
                Swal.fire({
                    title : 'Error',
                    html : data.pesan,
                    type : 'error'
                })
            }
        })

    })

    function hitungtotal() 
    {
        let total  = 0;

        $('#tbl-transaction tbody tr').each(function(){
            let subtotal      = $(this).find('td').eq(3).find('input').val();
                subtotal   = toFloat(subtotal);

            total  += subtotal;
        })

        let grand = total;
        $('#grand').autoNumeric('set', grand);
        if(grand > 0)
            $('.btn-payment').prop('disabled', false);
        else
            $('.btn-payment').prop('disabled', true);
    }

    function resetForm()
    {
        $('#payment-box').modal('hide');
        $('input, select').val('');
        $('.autonumber').autoNumeric('init')
        $('.autonumber').autoNumeric('set', 0)
        $('#tbl-transaction tbody tr').each(function(){
            $(this).remove();
        })
    }

    function SimpanTransaksi()
    {
        var FormData = "nomor_nota="+encodeURI($('#nomor_nota').val());
        FormData += "&tanggal="+encodeURI($('#tanggal').val());
        FormData += "&userid="+$('#userid').val();
        FormData += "&vehicleid="+$('#vehicleid').val();
        FormData += "&" + $('#tbl-transaction tbody input').serialize();
        FormData += "&grand_total="+$('#grand').text();

        $.ajax({
            url: base_url + 'Tradein/tradein_data',
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
                            resetForm()
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

    //   $(document).on('keydown', 'body', function(e){
    //     var charCode = ( e.which ) ? e.which : event.keyCode;

    //     if(charCode == 13) {
    //         e.preventDefault();
    //         if(($("#payment-box").data('bs.modal') || {_isShown: false})._isShown)
    //         {
    //             SimpanTransaksi()
    //         }
    //         else
    //         {
    //             if($('.btn-payment').prop('disabled') == false)
    //                 $('#payment-box').modal('show');

    //         }
    //     }
    //     if(charCode == 117) { // F6
    //         SimpanTransaksi();
    //     }
    //     if(charCode == 120) { // F9
    //         $('#find-item').focus();
    //     }
    // });



    

} )( jQuery );