 ( function ( $ ) {

    "use strict";

    var base_url = $('#base_url').val();

    /*
    * utilities
    */

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

    if( $.isFunction($.fn.DataTable) )
    {
        var dataTable = $('#inventory-datatable').DataTable( {
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"Utilities/tambah-inventory' class='btn btn-danger waves-effect waves-light ml-3' id='TambahItem'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
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
                url : base_url+"Utilities/inventory-json",
                type: "post",
                data: {
                    status : $('select[name=status]').val(),
                },
                error: function(){ 
                    $(".inventory-datatable-error").html("");
                    $("#inventory-datatable").append('<tbody class="sparepart-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#inventory-datatable_processing").css("display","none");
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

       $(document).on('click', '#TambahItem, #EditInventory', function(e){
        e.preventDefault();

        var act = ''



        $('.modal-dialog').removeClass('modal-sm');

        $('.modal-dialog').addClass('modal-xl');

        if($(this).attr('id') == 'TambahItem')

        {
            act = 'Simpan'

            $('#ModalHeader').html('Add New Item');

        }

        if($(this).attr('id') == 'EditInventory')

        {

            act = 'Update'

            $('#ModalHeader').html('Edit Item');

        }

        var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='"+act+"Inventory'>Save</button>";

        Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('#ModalContent').load($(this).attr('href'));

        $('#ModalGue').modal('show');

        $('#ModalFooter').html(Tombol);

    });
    $(document).on('click', '#SimpanInventory, #UpdateInventory', function(e){
        e.preventDefault();
    
        if($(this).hasClass('disabled'))
        {
            return false;
        }
        else
        {
            if($('#form-item').serialize() !== '')
            {
                $.ajax({
                    url: $('#form-item').attr('action'),
                    type: "POST",
                    cache: false,
                    data: $('#form-item').serialize(),
                    dataType:'json',
                    beforeSend:function(){
                        $('#SimpanInventory').html("Saving, please wait ...");
                        $('#SimpanInventory').prop('disabled', true);
                    },
                    success: function(json){
                        if(json.status == 1){
                            Swal.fire({
                                title: 'Success',
                                text: json.pesan,
                                type: 'success',
                                confirmButtonColor : '#3085D6',
                                confirmButtonText : 'OK!'
                            }).then(function(result){
                                if (result.value) {
                                    console.log('finish')
                                    window.location.href = base_url+'Utilities/inventory';
                                }
                            })
                        }
                        else {
                            $('#ResponseInput').html(json.pesan);
                        }

                        $('#SimpanInventory').html('Save');
                        $('#SimpanInventory').prop('disabled', false);

                    }
                });
            }
            else
            {
                $('#ResponseInput').html('');
            }
        }
    });


   $(document).on('keyup','#nilai_pembelian, #penyusutan', function(e){
        e.preventDefault()

        var nilai = $('#nilai_pembelian').val()
            nilai = toFloat(nilai)
            // console.log('nilai = ' + nilai)
        var penyusutan = $('#penyusutan').val()
            penyusutan = toFloat(penyusutan)
            // console.log('penyusutan = ' + penyusutan)

        var total = nilai - penyusutan;
        // console.log(total)
        $('#jumlah').autoNumeric('init');

        $('#jumlah').autoNumeric('set',total);

    })

    if( $.isFunction($.fn.DataTable) )
    {
        var dataTable = $('#stationery-datatable').DataTable( {
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"Utilities/add-stationery' class='btn btn-danger waves-effect waves-light ml-3' id='TambahItemStationery'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>, <a href='"+base_url+"Utilities/quit_stationery' class='btn btn-primary waves-effect waves-light ml-3' id='QuitStationery'><i class='mdi mdi-plus-circle mr-1'></i> Item Used</a>",
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
                url : base_url+"Utilities/stationery_json",
                type: "post",
                data: {
                    status : $('select[name=status]').val(),
                },
                error: function(){ 
                    $(".stationery-datatable-error").html("");
                    $("#stationery-datatable").append('<tbody class="sparepart-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#stationery-datatable_processing").css("display","none");
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

    $(document).on('click', '#TambahItemStationery, #EditItem', function(e){
        e.preventDefault();

        var act = ''



        $('.modal-dialog').removeClass('modal-sm');

        $('.modal-dialog').addClass('modal-xl');

        if($(this).attr('id') == 'TambahItemStationery')

        {
            act = 'Simpan'

            $('#ModalHeader').html('Add New Item');

        }

        if($(this).attr('id') == 'EditItem')

        {

            act = 'Update'

            $('#ModalHeader').html('Edit Item');

        }

        var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='"+act+"Item'>Save</button>";

        Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('#ModalContent').load($(this).attr('href'));

        $('#ModalGue').modal('show');

        $('#ModalFooter').html(Tombol);

    });
    $(document).on('click', '#SimpanItemstationery, #UpdateItem', function(e){
        e.preventDefault();
        console.log($('#form-item').serialize())
        if($(this).hasClass('disabled'))
        {
            return false;
        }
        else
        {
            if($('#form-item').serialize() !== '')
            {
                $.ajax({
                    url: $('#form-item').attr('action'),
                    type: "POST",
                    cache: false,
                    data: $('#form-item').serialize(),
                    dataType:'json',
                    beforeSend:function(){
                        $('#SimpanItemstationery').html("Saving, please wait ...");
                        $('#SimpanItemstationery').prop('disabled', true);
                    },
                    success: function(json){
                        if(json.status == 1){
                            swal.fire({
                                title: 'Success',
                                text: json.pesan,
                                type: 'success',
                                confirmButtonColor : '#3085D6',
                                confirmButtonText : 'OK!'
                            }).then(function(result){
                                if (result.value) {
                                    window.location.href = base_url+'Utilities/Stationery-stamp';
                                }
                            })
                        }
                        else {
                            $('#ResponseInput').html(json.pesan);
                        }

                        $('#SimpanItemstationery').html('Save');
                        $('#SimpanItemstationery').prop('disabled', false);

                    }
                });
            }
            else
            {
                $('#ResponseInput').html('');
            }
        }
    });

 $(document).on('click', '#QuitStationery, #EditItem', function(e){
        e.preventDefault();
        var act = ''
        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').addClass('modal-xl');
        if($(this).attr('id') == 'QuitStationery')
        {
            act = 'Simpan'
            $('#ModalHeader').html('Add New Item');
        }
        if($(this).attr('id') == 'EditItem')
        {
            act = 'Update'
            $('#ModalHeader').html('Edit Item');
        }
        var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='"+act+"Stationery'>Save</button>";
        Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";
        $('#ModalContent').load($(this).attr('href'));

        $('#ModalGue').modal('show');

        $('#ModalFooter').html(Tombol);

    });
    $(document).on('click', '#SimpanStationery, #UpdateItem', function(e){
        e.preventDefault();
        console.log($('#form-item').serialize())
        if($(this).hasClass('disabled'))
        {
            return false;
        }
        else
        {
            if($('#form-item').serialize() !== '')
            {
                $.ajax({
                    url: $('#form-item').attr('action'),
                    type: "POST",
                    cache: false,
                    data: $('#form-item').serializeArray(),
                    dataType:'json',
                    beforeSend:function(){
                        $('#SimpanStationery').html("Saving, please wait ...");
                        $('#SimpanStationery').prop('disabled', true);
                    },
                    success: function(json){
                        if(json.status == 1){
                            Swal.fire({
                                title: 'Success',
                                html: json.pesan,
                                type: 'success',
                                confirmButtonColor : '#3085D6',
                                confirmButtonText : 'OK!'
                            }).then(function(result){
                                if (result.value) {
                                    window.location.href = base_url+'Utilities/Stationery-stamp';
                                }
                            })
                        }   
                        else {
                            $('#ResponseInput').html(json.pesan);
                        }

                        $('#SimpanStationery').html('Save');
                        $('#SimpanStationery').prop('disabled', false);

                    }
                });
            }
            else
            {
                $('#ResponseInput').html('');
            }
        }
    });    


    $(document).on('click', '.new-row', function(e){
        e.preventDefault()

        var baris = $(this).closest('.baris')
        var NewRow = baris.clone()

        NewRow.find('input').val('')
        NewRow.find('select').val('')

        NewRow.insertAfter(baris)

        $('.autonumber').autoNumeric('init')

    })

    $(document).on('click', '.remove-row', function(e){
        e.preventDefault()

        let rows = $('.baris').length

        if((rows - 1) < 1) {
            Swal.fire({
                title: "Oops !", 
                html: 'You can\'t remove the last row', 
                type: "error"
            })
        } else {
            var baris = $(this).closest('.baris')
                baris.remove()            
        }
    })

    function CalculateCash(row)
    {
        let pecahan = row.find('input[name="nominal[]"]').val()
            pecahan = toFloat(pecahan)
        let qty = row.find('input[name="qty[]"]').val()
            qty = toFloat(qty)

        let sub = pecahan * qty

        row.find('input[name="amount[]"]').autoNumeric('set', sub)

        let total = 0
        $('input[name="amount[]"]').each(function(){
            let amount = $(this).val()
                amount = toFloat(amount)

            total += amount
        })

        $('#total').autoNumeric('set', total)

        let totalJurnal = $('#totalJurnal').text()
            totalJurnal = toFloat(totalJurnal)

        if(total == totalJurnal)
            $('#save-cash-count').prop('disabled', false)
        else
            $('#save-cash-count').prop('disabled', true)
    }

    $(document).on('click', '#save-cash-count', function(e){
        e.preventDefault()

        let totalJurnal = $('#totalJurnal').text()
            totalJurnal = toFloat(totalJurnal)
        let amount = $('#total').autoNumeric('get')

        var Data = ''
            Data += "jurnal="+totalJurnal
            Data += "&cash="+amount
            Data += "&"+$('.baris input').serialize()

        $.ajax({
            url: base_url + 'utilities/cash-count',
            dataType: 'json',
            type: 'post',
            data: Data,
            beforeSend: function(b) {
                $('#save-cash-count').html('<i class="fas fa-circle-notch fa-spin mr-1"></i> Saving')
                $('#save-cash-count').prop('disabled', true)
            },
            success: function (data) {
                $('#save-cash-count').html('<i class="mdi mdi-check mr-1"></i> Save')
                $('#save-cash-count').prop('disabled', false)

                if(data.status == 1)
                    Swal.fire({
                        title: 'Saved',
                        html: data.pesan,
                        type: 'success'
                    })
            }
        });
    })

    $(document).on('keyup', '.baris input', function(){
        CalculateCash($(this).closest('.baris'))
    })

    $(document).on('click', '.add-row', function(e){
        e.preventDefault()

        var baris = $(this).closest('.baris')
        var clone = baris.clone()
            clone.find('input').val('')

        clone.insertAfter(baris)
        $('.autonumber').autoNumeric('init')
    })

    $(document).on('click', '.remove-row', function(e){
        e.preventDefault()

        let length = $('.baris').length

        var baris = $(this).closest('.baris')

        if(length - 1 < 1)
            Swal.fire({
                title: 'Ooopsss!',
                text:  'You can\'t remove the last row',
                type:  'error'
            })
        else
            baris.remove()
    })

}) (jQuery)