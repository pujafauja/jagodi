( function ( $ ) {

    "use strict";

    var base_url = $('#base_url').val();

    if( $.isFunction($.fn.DataTable) )
    {
        var dataTable = $('#group-datatable').DataTable( {
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"finance/tambah-group' class='btn btn-danger waves-effect waves-light ml-3' id='TambahGroup'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
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
                url : base_url+"finance/group-json",
                type: "post",
                error: function(){ 
                    $(".group-datatable-error").html("");
                    $("#group-datatable").append('<tbody class="group-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
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

        var dataTable = $('#alias-datatable').DataTable( {
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"finance/new-alias' class='btn btn-danger waves-effect waves-light ml-3' id='AddAlias'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
                "sLoadingRecords": "Please Wait...", 
                "oPaginate": {
                    "sPrevious": "Prev",
                    "sNext": "Next"
                }
            },
            "aaSorting": [[ 1, "asc" ]],
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
                url : base_url+"finance/aliases-json",
                type: "post",
                error: function(){ 
                    $(".alias-datatable-error").html("");
                    $("#alias-datatable").append('<tbody class="alias-datatable-error"><tr><th colspan="3">Something happen, please contact developer</th></tr></tbody>');
                    $("#alias-datatable_processing").css("display","none");
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

        var Jurnal = $('#jurnal-datatable').DataTable( {
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"finance/new-jurnal' class='btn btn-danger waves-effect waves-light ml-3' id='NewJurnal'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
                "sLoadingRecords": "Please Wait...", 
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
                url : base_url+"finance/jurnal-summary",
                type: "post",
                error: function(){ 
                    $(".jurnal-datatable-error").html("");
                    $("#jurnal-datatable").append('<tbody class="jurnal-datatable-error"><tr><th colspan="4">Something happen, please contact developer</th></tr></tbody>');
                    $("#jurnal-datatable_processing").css("display","none");
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

        var bulan = $('#detail-jurnal').data('bulan')

        var Detail = $('#detail-jurnal').DataTable( {
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLoadingRecords": "Please Wait...", 
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
                url : base_url+"finance/detail-jurnal",
                type: "post",
                data: {bulan: bulan},
                error: function(){ 
                    $(".detail-jurnal-error").html("");
                    $("#detail-jurnal").append('<tbody class="detail-jurnal-error"><tr><th colspan="4">Something happen, please contact developer</th></tr></tbody>');
                    $("#detail-jurnal_processing").css("display","none");
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

        var status = $('input[name="Status"]').val()
        var tanggal1 = $('input[name="date-first"]').val()
        var tanggal2 = $('input[name="date-last"]').val()

        $('.payment-datatable').each(function() {
            var thisTable = $(this);

            $(thisTable).DataTable( {
                "serverSide": true,
                "stateSave" : false,
                "bAutoWidth": true,
                "oLanguage": {
                    "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                    "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page ",
                    "oPaginate": {
                        "sPrevious": "Prev",
                        "sNext": "Next"
                    }
                },
                "aaSorting": [[ 0, "desc" ]],
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
                    url : base_url+"finance/payment-json/"+$(thisTable).data('cat'),
                    data: {status: status, tanggal1: tanggal1, tanggal2: tanggal2, status : status},
                    type: "post",
                    error: function(){ 
                        $(".group-datatable-error").html("");
                        $("#group-datatable").append('<tbody class="group-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
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
        })

        // account receive

        var dataTable = $('#ar-datatable').DataTable( {
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"finance/tambah-ar' class='btn btn-danger waves-effect waves-light ml-3' id='TambahItemAr'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",      "sLoadingRecords": "Please Wait...", 
                "oPaginate": {
                    "sPrevious": "Prev",
                    "sNext": "Next"
                }
            },
            "aaSorting": [[ 1, "asc" ]],
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
                url : base_url+"finance/ar-json",
                type: "post",
                data: {
                    status:       $('select[name=Status]').val(),
                    invoicedate1: $('input[name="invoicedate-first"]').val(),
                    invoicedate2: $('input[name="invoicedate-last"]').val(),
                    duedate1:     $('input[name="duedate-first"]').val(),
                    duedate2:     $('input[name="duedate-last"]').val(),
                },
                error: function(){ 
                    $(".ar-datatable-error").html("");
                    $("#ar-datatable").append('<tbody class="ar-datatable-error"><tr><th colspan="3">Something happen, please contact developer</th></tr></tbody>');
                    $("#ar-datatable_processing").css("display","none");
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

        //account payment

        var dataTable = $('#ap-datatable').DataTable( {
            "searching": false,
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"finance/tambah-ap' class='btn btn-danger waves-effect waves-light ml-3' id='TambahItemAp'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",      "sLoadingRecords": "Please Wait...", 
                "oPaginate": {
                    "sPrevious": "Prev",
                    "sNext": "Next"
                }
            },
            "aaSorting": [[ 1, "asc" ]],
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
                url : base_url+"finance/ap-json",
                type: "post",
                data: {
                    supplierid: $('select[name=supplierid]').val(),
                },
                error: function(){ 
                    $(".ap-datatable-error").html("");
                    $("#ap-datatable").append('<tbody class="ap-datatable-error"><tr><th colspan="3">Something happen, please contact developer</th></tr></tbody>');
                    $("#ap-datatable_processing").css("display","none");
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

        $('#detailap-datatable').DataTable( {
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"finance/tambah-ap' class='btn btn-danger waves-effect waves-light ml-3' id='TambahItemAp'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",      "sLoadingRecords": "Please Wait...", 
                "oPaginate": {
                    "sPrevious": "Prev",
                    "sNext": "Next"
                }
            },
            "aaSorting": [[ 1, "desc" ]],
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
                url : base_url+"finance/detail-ap/"+$('#detailap-datatable').data('id'),
                type: "post",
                data: {
                    status:       $('select[name=Status]').val(),
                    invoicedate1: $('input[name="invoicedate-first"]').val(),
                    invoicedate2: $('input[name="invoicedate-last"]').val(),
                    duedate1:     $('input[name="duedate-first"]').val(),
                    duedate2:     $('input[name="duedate-last"]').val(),
                },
                error: function(){ 
                    $(".detailap-datatable-error").html("");
                    $("#detailap-datatable").append('<tbody class="detailap-datatable-error"><tr><th colspan="3">Something happen, please contact developer</th></tr></tbody>');
                    $("#detailap-datatable_processing").css("display","none");
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

        $('#detailar-datatable').DataTable( {
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"finance/tambah-ar' class='btn btn-danger waves-effect waves-light ml-3' id='TambahItemAr'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",      "sLoadingRecords": "Please Wait...", 
                "oPaginate": {
                    "sPrevious": "Prev",
                    "sNext": "Next"
                }
            },
            "aaSorting": [[ 1, "desc" ]],
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
                url : base_url+"finance/detail-ar/"+$('#detailar-datatable').data('id'),
                type: "post",
                data: {
                    status:       $('select[name=Status]').val(),
                    invoicedate1: $('input[name="invoicedate-first"]').val(),
                    invoicedate2: $('input[name="invoicedate-last"]').val(),
                    duedate1:     $('input[name="duedate-first"]').val(),
                    duedate2:     $('input[name="duedate-last"]').val(),
                },
                error: function(){ 
                    $(".detailar-datatable-error").html("");
                    $("#detailar-datatable").arpend('<tbody class="detailar-datatable-error"><tr><th colspan="3">Something happen, please contact developer</th></tr></tbody>');
                    $("#detailar-datatable_processing").css("display","none");
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

        $('#FilterDetailAp').on('click', function(e){
            e.preventDefault()

            $('#detailap-datatable').DataTable( {
                "serverSide": true,
                "stateSave" : false,
                "bAutoWidth": true,
                "oLanguage": {
                    "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                    "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"finance/tambah-ap' class='btn btn-danger waves-effect waves-light ml-3' id='TambahItemAp'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",      "sLoadingRecords": "Please Wait...", 
                    "oPaginate": {
                        "sPrevious": "Prev",
                        "sNext": "Next"
                    }
                },
                "aaSorting": [[ 1, "desc" ]],
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
                    url : base_url+"finance/detail-ap/"+$('#detailap-datatable').data('id'),
                    type: "post",
                    data: {
                        status:       $('select[name=Status]').val(),
                        invoicedate1: $('input[name="invoicedate-first"]').val(),
                        invoicedate2: $('input[name="invoicedate-last"]').val(),
                        duedate1:     $('input[name="duedate-first"]').val(),
                        duedate2:     $('input[name="duedate-last"]').val(),
                    },
                    error: function(){ 
                        $(".detailap-datatable-error").html("");
                        $("#detailap-datatable").append('<tbody class="detailap-datatable-error"><tr><th colspan="3">Something happen, please contact developer</th></tr></tbody>');
                        $("#detailap-datatable_processing").css("display","none");
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
                },
                "destroy": true
            }).ajax.reload(null, false);
        })
    }

    $(document).on('click', '#NewJurnal', function(e){
        e.preventDefault()

        var Tombol = '<button type="button" class="btn btn-primary" id="save-jurnal">Save</button>'
            Tombol += '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'

        $('.modal-dialog').removeClass('modal-sm')
        $('.modal-dialog').removeClass('modal-full-width')
        $('.modal-dialog').addClass('modal-lg')

        $('#ModalHeader').html('Add New Journal')

        $('#ModalContent').load($(this).attr('href'))

        $('#ModalGue').modal('show')
        $('ModalFooter').html(Tombol)
    })

    function hitungTotal()
    {
        let debit  = 0
        let kredit = 0

        $('input[name="debit[]"]').each(function(){
            debit += toFloat($(this).val())
        })

        $('input[name="kredit[]"]').each(function(){
            kredit += toFloat($(this).val())
        })

        $('.total-debit').autoNumeric('set', debit)
        $('.total-kredit').autoNumeric('set', kredit)

        if((debit > 0 && kredit > 0) && debit == kredit)
            $('.submit-jurnal').prop('disabled', false)
        else
            $('.submit-jurnal').prop('disabled', true)
    }

    $(document).on('click', '.add-row', function(e){
        e.preventDefault()

        var baris = $(this).closest('.baris')

        var row = baris.clone()

            row.find('select').val('')
            row.find('input').val('')
            row.find('input').prop('readonly', false)

        row.insertAfter(baris)

        $('.autonumber').autoNumeric('init')

        hitungTotal()
    })

    $(document).on('click', '.remove-row', function(e){
        e.preventDefault()

        var baris = $(this).closest('.baris')

        let allrow = $('.baris').length

        if((allrow - 1) == 0)
            Swal.fire({
                title: 'Sorry!',
                text: 'You can\'t remove the last row',
                type: 'error'
            })
        else
            baris.remove()

        hitungTotal()
    })

    $(document).on('keyup', '.baris input', function(){
        hitungTotal()

        if($(this).attr('name') == 'debit[]')
        {
            $(this).closest('.baris').find('input[name="kredit[]"]').prop('readonly', true)
        }
        else
        {
            $(this).closest('.baris').find('input[name="debit[]"]').prop('readonly', true)

        }

        if(toFloat($(this).val()) <= 0) {
            $(this).closest('.baris').find('input[name="debit[]"]').prop('readonly', false)
            $(this).closest('.baris').find('input[name="kredit[]"]').prop('readonly', false)
        }
    })

    function simpanJurnal(status)
    {
        var Formdata = 'no='+encodeURI($('input[name="no"]').val())
            Formdata += '&tanggal='+encodeURI($('input[name="tanggal"]').val())
            Formdata += '&keterangan='+encodeURI($('input[name="keterangan"]').val())
            Formdata += '&status='+status
            Formdata += '&' + $('.baris input, .baris select').serialize()

        $.ajax({
            url: base_url + 'finance/new-jurnal',
            type: 'post',
            dataType: 'json',
            data: Formdata,
            beforeSend: function(s){
                $('.submit-jurnal').html('<i class="fas fa-circle-notch fa-spin mr-1"></i>Saving')
                $('.submit-jurnal').prop('disabled', true)
            },
            success: function (data) {
                $('.submit-jurnal').each(function(){
                    if($(this).data('status') == '1')
                        $(this).html('<i class="mdi mdi-content-save-alert mr-1"></i>Save & Approve')
                    else
                        $(this).html('<i class="mdi mdi-content-save mr-1"></i>Save')
                })

                $('.submit-jurnal').prop('disabled', false)

                if(data.status == 1)
                {
                    Swal({
                        title: 'Success',
                        html: data.pesan,
                        type: 'success'
                    })
                }
                else
                {
                    Swal({
                        title: 'Error',
                        html: data.pesan,
                        type: 'error'
                    })
                }
            }
        });
    }

    $(document).on('click', '.submit-jurnal', function(e){
        e.preventDefault()

        var $this = $(this)

        let status = $this.data('status')
        console.log(status)

        if(status == 1)
        {
            Swal.fire({
                title:              'Are you sure?',
                text:               'You can not edit and delete journal after this',
                type:               'warning',
                showCancelButton:   !0,
                confirmButtonColor: '#3085d6',
                cancelButtonColor:  '#d33',
                confirmButtonText:  'Yes'
            }).then(function(t){
                if(t.dismiss !== Swal.DismissReason.cancel)
                    simpanJurnal(status)
            })
        }
        else
            simpanJurnal(status)

        $('#ModalGue').modal('hide')

        if($('#jurnal-datatable').length > 0)
        {
            var Jurnal = $('#jurnal-datatable').DataTable( {
                "serverSide": true,
                "stateSave" : false,
                "bAutoWidth": true,
                "oLanguage": {
                    "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                    "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"finance/new-jurnal' class='btn btn-danger waves-effect waves-light ml-3' id='NewJurnal'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
                    "sLoadingRecords": "Please Wait...", 
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
                    url : base_url+"finance/jurnal-summary",
                    type: "post",
                    error: function(){ 
                        $(".jurnal-datatable-error").html("");
                        $("#jurnal-datatable").append('<tbody class="jurnal-datatable-error"><tr><th colspan="4">Something happen, please contact developer</th></tr></tbody>');
                        $("#jurnal-datatable_processing").css("display","none");
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
                },
                "destroy": true
            } ).ajax.reload(null, false);
        }

        if($('#detail-jurnal').length > 0)
        {
            var bulan = $('#detail-jurnal').data('bulan')

            var Detail = $('#detail-jurnal').DataTable( {
                "serverSide": true,
                "stateSave" : false,
                "bAutoWidth": true,
                "oLanguage": {
                    "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                    "sLoadingRecords": "Please Wait...", 
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
                    url : base_url+"finance/detail-jurnal",
                    type: "post",
                    data: {bulan: bulan},
                    error: function(){ 
                        $(".detail-jurnal-error").html("");
                        $("#detail-jurnal").append('<tbody class="detail-jurnal-error"><tr><th colspan="4">Something happen, please contact developer</th></tr></tbody>');
                        $("#detail-jurnal_processing").css("display","none");
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
                },
                "destroy": true
            } ).ajax.reload(null, false);
        }
    })

    $(document).on('click', '#TambahGroup, #EditGroup', function(e){



        e.preventDefault();



        var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SimpanGroup'>Save</button>";

        Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";



        $('.modal-dialog').removeClass('modal-sm');

        $('.modal-dialog').removeClass('modal-full-widt');

        $('.modal-dialog').addClass('modal-lg');



        if($(this).attr('id') == 'TambahGroup')

        {

            $('#ModalHeader').html('Add New Account');

        }

        

        if($(this).attr('id') == 'EditGroup')

        {

            $('#ModalHeader').html('Edit Account');

        }



        $('#ModalContent').load($(this).attr('href'));

        $('#ModalGue').modal('show');

        $('#ModalFooter').html(Tombol);



        $('.currency').autoNumeric('init', {

            aSep: '.',

            aDec: ','

        });

    });

    $(document).on('click', '#AddAlias', function(e){
        e.preventDefault();

        var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SaveNewAlias'>Save</button>";
        Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').removeClass('modal-full-width');
        $('.modal-dialog').addClass('modal-lg');

        $('#ModalHeader').html('Add/Update Alias');
        
        $('#ModalContent').load($(this).attr('href'));
        $('#ModalGue').modal('show');
        $('#ModalFooter').html(Tombol);
    });

    $(document).on('click', '#SaveNewAlias', function(e){
        e.preventDefault()

        if($('.add-alias').serialize() !== '')
        {
            $.ajax({
                url: $('.add-alias').attr('action'),
                type: "POST",
                cache: false,
                data: $('.add-alias').serialize(),
                dataType:'json',
                beforeSend:function(){
                    $('#SaveNewAlias').html("Saving, please wait ...");
                },
                success: function(json){
                    if(json.status == 1){ 
                        $('.modal-dialog').removeClass('modal-lg');
                        $('.modal-dialog').addClass('modal-sm');
                        $('#ModalHeader').html('Success !');
                        $('#ModalContent').html(json.pesan);
                        $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                        $('#ModalGue').modal('show');
                        $('#alias-datatable').DataTable().ajax.reload( null, false );
                    }
                    else {
                        $('#ResponseInput').html(json.pesan);
                    }

                    $('#SaveNewAlias').html('Save');
                }
            });
        }
        else
        {
            $('#ResponseInput').html('');
        }
    })

    $(document).on('submit', '.add-alias', function(e){
        e.preventDefault()

        if($('.add-alias').serialize() !== '')
        {
            $.ajax({
                url: $('.add-alias').attr('action'),
                type: "POST",
                cache: false,
                data: $('.add-alias').serialize(),
                dataType:'json',
                beforeSend:function(){
                    $('#SaveNewAlias').html("Saving, please wait ...");
                },
                success: function(json){
                    if(json.status == 1){ 
                        $('.modal-dialog').removeClass('modal-lg');
                        $('.modal-dialog').addClass('modal-sm');
                        $('#ModalHeader').html('Success !');
                        $('#ModalContent').html(json.pesan);
                        $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                        $('#ModalGue').modal('show');
                        $('#alias-datatable').DataTable().ajax.reload( null, false );
                    }
                    else {
                        $('#ResponseInput').html(json.pesan);
                    }

                    $('#SaveNewAlias').html('Save');
                }
            });
        }
        else
        {
            $('#ResponseInput').html('');
        }
    })

    $(document).on('click', '#SimpanGroup', function(e){



        e.preventDefault();



        if($(this).hasClass('disabled'))

        {

            return false;

        }

        else

        {

            if($('.tambah-group').serialize() !== '')

            {

                $.ajax({

                    url: $('.tambah-group').attr('action'),

                    type: "POST",

                    cache: false,

                    data: $('.tambah-group').serialize(),

                    dataType:'json',

                    beforeSend:function(){

                        $('#SimpanGroup').html("Saving, please wait ...");

                    },

                    success: function(json){

                        if(json.status == 1){ 

                            $('.modal-dialog').removeClass('modal-lg');

                            $('.modal-dialog').addClass('modal-sm');

                            $('#ModalHeader').html('Success !');

                            $('#ModalContent').html(json.pesan);

                            $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");

                            $('#ModalGue').modal('show');

                            $('#group-datatable').DataTable().ajax.reload( null, false );

                        }

                        else {

                            $('#ResponseInput').html(json.pesan);

                        }



                        $('#SimpanGroup').html('Save');

                    }

                });

            }

            else

            {

                $('#ResponseInput').html('');

            }

        }



    });



    $(document).on('submit', '.tambah-group', function(e){



        e.preventDefault();



        if($(this).hasClass('disabled'))

        {

            return false;

        }

        else

        {

            if($('.tambah-group').serialize() !== '')

            {

                $.ajax({

                    url: $('.tambah-group').attr('action'),

                    type: "POST",

                    cache: false,

                    data: $('.tambah-group').serialize(),

                    dataType:'json',

                    beforeSend:function(){

                        $('#SimpanGroup').html("Saving, please wait ...");

                    },

                    success: function(json){

                        if(json.status == 1){ 

                            $('.modal-dialog').removeClass('modal-lg');

                            $('.modal-dialog').addClass('modal-sm');

                            $('#ModalHeader').html('Success !');

                            $('#ModalContent').html(json.pesan);

                            $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");

                            $('#ModalGue').modal('show');

                            $('#group-datatable').DataTable().ajax.reload( null, false );

                        }

                        else {

                            $('#ResponseInput').html(json.pesan);

                        }



                        $('#SimpanGroup').html('Save');

                    }

                });

            }

            else

            {

                $('#ResponseInput').html('');

            }

        }

    });


    if( $.isFunction($.fn.DataTable) )
    {

        var url = window.location.href.split('/');
        var mod = url[5];
        var dataTable = $('#limit-datatable').DataTable( {
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"finance/tambah-limit/"+mod+"' class='btn btn-danger waves-effect waves-light ml-3' id='TambahLimit'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
                // "sInfoFiltered": "(difilter dari _MAX_ total data)", 
                // "sZeroRecords": "Pencarian tidak ditemukan", 
                // "sEmptyTable": "Data kosong", 
                "sLoadingRecords": "Please wait...", 
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
                url : base_url+"finance/limit-json/"+mod,
                type: "post",
                error: function(){ 
                    $(".limit-datatable-error").html("");
                    $("#limit-datatable").append('<tbody class="limit-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
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

    $(document).on('click', '#TambahLimit', function(e){

        e.preventDefault();

        var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SimpanLimit'>Save</button>";
        Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').removeClass('modal-full-widt');
        $('.modal-dialog').addClass('modal-lg');

        $('#ModalHeader').html('Add New Limit');

        $('#ModalContent').load($(this).attr('href'));
        $('#ModalGue').modal('show');
        $('#ModalFooter').html(Tombol);

        $('.currency').autoNumeric('init', {
            aSep: '.',
            aDec: ','
        });
    });

    $(document).on('click', '#SimpanLimit', function(e){

        e.preventDefault();

        if($(this).hasClass('disabled'))
        {
            return false;
        }
        else
        {
            if($('.tambah-limit').serialize() !== '')
            {
                $.ajax({
                    url: $('.tambah-limit').attr('action'),
                    type: "POST",
                    cache: false,
                    data: $('.tambah-limit').serialize(),
                    dataType:'json',
                    beforeSend:function(){
                        $('#SimpanLimit').html("Saving, please wait ...");
                    },
                    success: function(json){
                        if(json.status == 1){ 
                            $('.modal-dialog').removeClass('modal-lg');
                            $('.modal-dialog').addClass('modal-sm');
                            $('#ModalHeader').html('Success !');
                            $('#ModalContent').html(json.pesan);
                            $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                            $('#ModalGue').modal('show');
                            $('#limit-datatable').DataTable().ajax.reload( null, false );
                        }
                        else {
                            $('#ResponseInput').html(json.pesan);
                        }

                        $('#SimpanLimit').html('Save');
                    }
                });
            }
            else
            {
                $('#ResponseInput').html('');
            }
        }
    });

    $(document).on('submit', '.tambah-limit', function(e){

        e.preventDefault();

        if($(this).hasClass('disabled'))
        {
            return false;
        }
        else
        {
            if($('.tambah-limit').serialize() !== '')
            {
                $.ajax({
                    url: $('.tambah-limit').attr('action'),
                    type: "POST",
                    cache: false,
                    data: $('.tambah-limit').serialize(),
                    dataType:'json',
                    beforeSend:function(){
                        $('#SimpanLimit').html("Saving, please wait ...");
                    },
                    success: function(json){
                        if(json.status == 1){ 
                            $('.modal-dialog').removeClass('modal-lg');
                            $('.modal-dialog').addClass('modal-sm');
                            $('#ModalHeader').html('Success !');
                            $('#ModalContent').html(json.pesan);
                            $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                            $('#ModalGue').modal('show');
                            $('#limit-datatable').DataTable().ajax.reload( null, false );
                        }
                        else {
                            $('#ResponseInput').html(json.pesan);
                        }

                        $('#SimpanLimit').html('Save');
                    }
                });
            }
            else
            {
                $('#ResponseInput').html('');
            }
        }
    });


    if( $.isFunction($.fn.DataTable) )

    {

        var dataTable = $('#coa-datatable').DataTable( {

            "serverSide": true,

            "stateSave" : false,

            "bAutoWidth": true,

            "oLanguage": {

                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",

                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <div class='btn-group'><a href='"+base_url+"finance/tambah-subgroup' class='btn btn-success waves-effect waves-light ml-3' id='TambahSub'><i class='mdi mdi-plus-circle mr-1'></i> Add New Sub</a><a href='"+base_url+"finance/tambah-coa' class='btn btn-danger waves-effect waves-light ml-3' id='TambahCOA'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a></div><span id='Notifikasi' style='display: none;'></span>",

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

                url : base_url+"finance/coa-json",

                type: "post",

                error: function(){ 

                    $(".coa-datatable-error").html("");

                    $("#coa-datatable").append('<tbody class="coa-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');

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



    $(document).on('click', '#TambahCOA, #EditCOA', function(e){



        e.preventDefault();



        var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SimpanCOA'>Save</button>";

        Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";



        $('.modal-dialog').removeClass('modal-sm');

        $('.modal-dialog').removeClass('modal-full-widt');

        $('.modal-dialog').addClass('modal-lg');



        if($(this).attr('id') == 'TambahCOA')

        {

            $('#ModalHeader').html('Add New COA');

        }

        

        if($(this).attr('id') == 'EditCOA')

        {

            $('#ModalHeader').html('Edit COA');

        }



        $('#ModalContent').load($(this).attr('href'));

        $('#ModalGue').modal('show');

        $('#ModalFooter').html(Tombol);



        $('.currency').autoNumeric('init', {

            aSep: '.',

            aDec: ','

        });

    });



    $(document).on('click', '#SimpanCOA', function(e){



        e.preventDefault();



        if($(this).hasClass('disabled'))

        {

            return false;

        }

        else

        {

            if($('.tambah-coa').serialize() !== '')

            {

                $.ajax({

                    url: $('.tambah-coa').attr('action'),

                    type: "POST",

                    cache: false,

                    data: $('.tambah-coa').serialize(),

                    dataType:'json',

                    beforeSend:function(){

                        $('#SimpanCOA').html("Saving, please wait ...");

                    },

                    success: function(json){

                        if(json.status == 1){ 

                            $('.modal-dialog').removeClass('modal-lg');

                            $('.modal-dialog').addClass('modal-sm');

                            $('#ModalHeader').html('Success !');

                            $('#ModalContent').html(json.pesan);

                            $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");

                            $('#ModalGue').modal('show');

                            $('#coa-datatable').DataTable().ajax.reload( null, false );

                        }

                        else {

                            $('#ResponseInput').html(json.pesan);

                        }



                        $('#SimpanCOA').html('Save');

                    }

                });

            }

            else

            {

                $('#ResponseInput').html('');

            }

        }



    });



    $(document).on('submit', '.tambah-coa', function(e){



        e.preventDefault();



        if($(this).hasClass('disabled'))

        {

            return false;

        }

        else

        {

            if($('.tambah-coa').serialize() !== '')

            {

                $.ajax({

                    url: $('.tambah-coa').attr('action'),

                    type: "POST",

                    cache: false,

                    data: $('.tambah-coa').serialize(),

                    dataType:'json',

                    beforeSend:function(){

                        $('#SimpanCOA').html("Saving, please wait ...");

                    },

                    success: function(json){

                        if(json.status == 1){ 

                            $('.modal-dialog').removeClass('modal-lg');

                            $('.modal-dialog').addClass('modal-sm');

                            $('#ModalHeader').html('Success !');

                            $('#ModalContent').html(json.pesan);

                            $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");

                            $('#ModalGue').modal('show');

                            $('#coa-datatable').DataTable().ajax.reload( null, false );

                        }

                        else {

                            $('#ResponseInput').html(json.pesan);

                        }



                        $('#SimpanCOA').html('Save');

                    }

                });

            }

            else

            {

                $('#ResponseInput').html('');

            }

        }

    });



    $(document).on('click', '#TambahSub, #EditSub', function(e){

        e.preventDefault();

        var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SimpanSub'>Save</button>";
        Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').removeClass('modal-full-widt');
        $('.modal-dialog').addClass('modal-lg');

        if($(this).attr('id') == 'TambahSub')
        {
            $('#ModalHeader').html('Add New Sub');
        }
        
        if($(this).attr('id') == 'EditSub')
        {
            $('#ModalHeader').html('Edit Sub');
        }

        $('#ModalContent').load($(this).attr('href'));
        $('#ModalGue').modal('show');
        $('#ModalFooter').html(Tombol);

        $('.currency').autoNumeric('init', {
            aSep: '.',
            aDec: ','
        });
    });

    $(document).on('click', '#SimpanSub', function(e){

        e.preventDefault();

        if($(this).hasClass('disabled'))
        {
            return false;
        }
        else
        {
            if($('.tambah-coa').serialize() !== '')
            {
                $.ajax({
                    url: $('.tambah-coa').attr('action'),
                    type: "POST",
                    cache: false,
                    data: $('.tambah-coa').serialize(),
                    dataType:'json',
                    beforeSend:function(){
                        $('#SimpanSub').html("Saving, please wait ...");
                    },
                    success: function(json){
                        if(json.status == 1){ 
                            $('.modal-dialog').removeClass('modal-lg');
                            $('.modal-dialog').addClass('modal-sm');
                            $('#ModalHeader').html('Success !');
                            $('#ModalContent').html(json.pesan);
                            $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                            $('#ModalGue').modal('show');
                            $('#coa-datatable').DataTable().ajax.reload( null, false );
                        }
                        else {
                            $('#ResponseInput').html(json.pesan);
                        }

                        $('#SimpanSub').html('Save');
                    }
                });
            }
            else
            {
                $('#ResponseInput').html('');
            }
        }

    });

    $(document).on('submit', '.tambah-coa', function(e){

        e.preventDefault();

        if($(this).hasClass('disabled'))
        {
            return false;
        }
        else
        {
            if($('.tambah-coa').serialize() !== '')
            {
                $.ajax({
                    url: $('.tambah-coa').attr('action'),
                    type: "POST",
                    cache: false,
                    data: $('.tambah-coa').serialize(),
                    dataType:'json',
                    beforeSend:function(){
                        $('#SimpanSub').html("Saving, please wait ...");
                    },
                    success: function(json){
                        if(json.status == 1){ 
                            $('.modal-dialog').removeClass('modal-lg');
                            $('.modal-dialog').addClass('modal-sm');
                            $('#ModalHeader').html('Success !');
                            $('#ModalContent').html(json.pesan);
                            $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                            $('#ModalGue').modal('show');
                            $('#coa-datatable').DataTable().ajax.reload( null, false );
                        }
                        else {
                            $('#ResponseInput').html(json.pesan);
                        }

                        $('#SimpanSub').html('Save');
                    }
                });
            }
            else
            {
                $('#ResponseInput').html('');
            }
        }
    });

    $(document).on('click', '#filter', function(e){
        e.preventDefault();
        var status = $('select[name=Status]').val()
         status = (status) ? status : null;
        var tanggal1 = $('input[name=date-first]').val()
         tanggal1 = (tanggal1) ? tanggal1 : null;
        var tanggal2 = $('input[name=date-last]').val()
         tanggal2 = (tanggal2) ? tanggal2 : null;

        if(status || (tanggal1 && tanggal2)) {
            $('.payment-datatable').each(function() {
                var thisTable = $(this);

                $(thisTable).DataTable({
                    "serverSide": true,
                    "stateSave" : false,
                    "bAutoWidth": true,
                    "oLanguage": {
                        "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                        "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page ",
                        "oPaginate": {
                            "sPrevious": "Prev",
                            "sNext": "Next"
                        }
                    },
                    "aaSorting": [[ 0, "desc" ]],
                    "columnDefs": [ 
                        {
                            "targets": 'no-sort',
                            "orderable": false,
                        }
                    ],
                    "sPaginationType": "simple_numbers", 
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 20, 50, 100, 150], [10, 20, 50, 100, 150]],
                    "ajax":
                        {
                            url : base_url+"finance/payment-json/"+$(thisTable).data('cat'),
                            data: {status: status, tanggal1: tanggal1, tanggal2: tanggal2},
                            type: "post",
                            error: function(){ 
                                $(".my-datatable-error").html("");
                                $("#my-datatable").append('<tbody class="my-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                                $("#my-datatable_processing").css("display","none");
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
                    },
                    "destroy": true
                }).ajax.reload();
            })
        }
    })

    $(document).on('click', '#alldate', function(e){
        e.preventDefault();
        var status  = $('select[name=Status]').val()
         status = (status) ? status : null;

        $('.payment-datatable').each(function() {
            var thisTable = $(this);

            $(thisTable).DataTable({
                "serverSide": true,
                "stateSave" : false,
                "bAutoWidth": true,
                "oLanguage": {
                    "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                    "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page ",
                    "oPaginate": {
                        "sPrevious": "Prev",
                        "sNext": "Next"
                    }
                },
                "aaSorting": [[ 0, "desc" ]],
                "columnDefs": [ 
                    {
                        "targets": 'no-sort',
                        "orderable": false,
                    }
                ],
                "sPaginationType": "simple_numbers", 
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 50, 100, 150], [10, 20, 50, 100, 150]],
                "ajax":
                    {
                        url : base_url+"finance/payment-json/"+$(thisTable).data('cat'),
                        data : {status : status},
                        type: "post",
                        error: function(){ 
                            $(".my-datatable-error").html("");
                            $("#my-datatable").append('<tbody class="my-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                            $("#my-datatable_processing").css("display","none");
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
                },
                "destroy": true
            }).ajax.reload();
        })
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

    $(document).on('click', '#bayar', function(e) {
        e.preventDefault()

        let bill = $(this).closest('tr').find('td').eq(2).text()
            bill = bill.replace('Rp ', '')
            bill = toFloat(bill)

        var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SavePayment' disabled=''>Save</button>";
        Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').removeClass('modal-full-width');
        $('.modal-dialog').addClass('modal-lg');

        $('#ModalHeader').html('Add New Payment');

        $('#ModalContent').load($(this).attr('href'), {bill: bill});
        $('#ModalGue').modal('show');
        $('#ModalFooter').html(Tombol);

    })

    function totalReceived()
    {
        let received = 0
        let bill = $('#grandtotal').val()
            bill = toFloat(bill)

        $('.baris').each(function(){
            let amount = $(this).find('input[name="amount[]"]').val()
                amount = toFloat(amount)

            received += amount
        })

        $('#received').autoNumeric('init')
        $('#received').autoNumeric('set', received)

        if(bill > received)
            $('#SavePayment').prop('disabled', true)
        else
            $('#SavePayment').prop('disabled', false)
    }

    $(document).on('click', '#SavePayment', function(e){
        e.preventDefault()

        let id = $('input[name="id"]').val()

        $.ajax({
            url: base_url + 'finance/bayar-payment/' + id,
            data: $('#ModalContent select, #ModalContent input').serialize(),
            type: 'post',
            dataType: 'json',
            beforeSend: function(bs) {
                $('#SavePayment').html('<i class="fas fa-circle-notch fa-spin mr-1"></i>Saving')
                $('#SavePayment').prop('disabled', true)
            },
            success: function(result) {
                $('#SavePayment').html('Save')
                $('#SavePayment').prop('disabled', false)

                var $title = ''
                var $type  = ''

                if(result.status = 1) {
                    $title = 'Success'
                    $type  = 'success'

                    $('#ModalGue').modal('hide')

                    var status = $('select[name=Status]').val()
                     status = (status) ? status : null;
                    var tanggal1 = $('input[name=date-first]').val()
                     tanggal1 = (tanggal1) ? tanggal1 : null;
                    var tanggal2 = $('input[name=date-last]').val()
                     tanggal2 = (tanggal2) ? tanggal2 : null;

                    $('.payment-datatable').each(function() {
                        var thisTable = $(this);

                        $(thisTable).DataTable({
                            "serverSide": true,
                            "stateSave" : false,
                            "bAutoWidth": true,
                            "oLanguage": {
                                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page ",
                                "oPaginate": {
                                    "sPrevious": "Prev",
                                    "sNext": "Next"
                                }
                            },
                            "aaSorting": [[ 0, "desc" ]],
                            "columnDefs": [ 
                                {
                                    "targets": 'no-sort',
                                    "orderable": false,
                                }
                            ],
                            "sPaginationType": "simple_numbers", 
                            "iDisplayLength": 10,
                            "aLengthMenu": [[10, 20, 50, 100, 150], [10, 20, 50, 100, 150]],
                            "ajax":
                                {
                                    url : base_url+"finance/payment-json/"+$(thisTable).data('cat'),
                                    data: {status: status, tanggal1: tanggal1, tanggal2: tanggal2},
                                    type: "post",
                                    error: function(){ 
                                        $(".my-datatable-error").html("");
                                        $("#my-datatable").append('<tbody class="my-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                                        $("#my-datatable_processing").css("display","none");
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
                            },
                            "destroy": true
                        }).ajax.reload();
                    })

                    window.open(
                        base_url + 'finance/print-invoice/' + id + '?cetak=1',
                        'popUpWindow',
                        'height=567,width=793,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
                    

                } else {
                    $title = 'Oooopsss'
                    $type  = 'error'
                }

                Swal.fire({
                    title: $title,
                    html: result.pesan,
                    type: $type
                })
            }
        })
    })

    $(document).on('click', '.print', function(e) {
        e.preventDefault()

        window.open(
            $(this).attr('href'),
            'popUpWindow',
            'height=567,width=793,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
    })

    $(document).on('keyup', 'input[name="amount[]"]', function(e){
        totalReceived()
    })

    $(document).on('click', '.new-row', function(e){
        e.preventDefault()

        var baris = $(this).closest('.baris')
        var NewRow = baris.clone()

        NewRow.find('input').val('')
        NewRow.find('select').val('')

        NewRow.insertAfter(baris)

        $('.autonumber').autoNumeric('init')

        totalReceived()
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
        totalReceived()
    })

    $(document).on('click', '#TambahItemAp, #EditItemAp', function(e){
        e.preventDefault();

        var act = ''



        $('.modal-dialog').removeClass('modal-sm');

        $('.modal-dialog').addClass('modal-xl');

        if($(this).attr('id') == 'TambahItemAp')

        {
            act = 'Simpan'

            $('#ModalHeader').html('Add New Item');

        }

        if($(this).attr('id') == 'EditItemAp')

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
    $(document).on('click', '#SimpanItem, #UpdateItem', function(e){
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
                        $('#SimpanItem').html("Saving, please wait ...");
                        $('#SimpanItem').prop('disabled', true);
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
                                    window.location.href = base_url+'Finance/ap';
                                }
                            })
                        }
                        else {
                            $('#ResponseInput').html(json.pesan);
                        }

                        $('#SimpanItem').html('Save');
                        $('#SimpanItem').prop('disabled', false);

                    }
                });
            }
            else
            {
                $('#ResponseInput').html('');
            }
        }
    });

     $(document).on('click', '#DeleteItemAp', function(e){
        e.preventDefault();
        var target = $(this).attr('href');
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then(function(t) {
            if(t.dismiss !== Swal.DismissReason.cancel)
            {
                $.ajax({
                    url: target,
                    success: function(s){
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            type: "success"
                        }).then(function(result){
                            if (result.value) {
                                window.location.href = base_url+'/finance/ap';
                            }
                        })
                    }
                })
            }
            else
            {
                Swal.fire({
                    title: "Cancelled",
                    text: "Your imaginary file is safe :)",
                    type: "error"
                })
            }
        })
    })

      $(document).on('click', '#alldateAp', function(e){
        e.preventDefault();
        var status  = $('select[name=Status]').val()
         status = (status) ? status : null;

        var payment = $('#ap-datatable').DataTable({
            "searching": false,
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page ",
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
            "ajax":
                {
                    url : base_url+"finance/ap-json/",
                    type: "post",
                    error: function(){ 
                        $(".my-datatable-error").html("");
                        $("#my-datatable").append('<tbody class="my-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $("#my-datatable_processing").css("display","none");
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
            },
            "destroy": true
        }).ajax.reload();
    })


    $(document).on('click', '#FilterAp', function(e){
        e.preventDefault();
        var status  = $('select[name=Status]').val()
         status = (status) ? status : null;
        var invoicedate1 = $('input[name="invoicedate-first"]').val()
        var invoicedate2 = $('input[name="invoicedate-last"]').val()
        var duedate1     = $('input[name="duedate-first"]').val()
        var duedate2     = $('input[name="duedate-last"]').val()

        var ap = $('#ap-datatable').DataTable({
            "searching": false,
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page ",
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
            "ajax":
                {
                    url : base_url+"finance/ap-json/",
                    type: "post",
                    data: {
                        supplierid: $('select[name=supplierid]').val(),
                    },
                    error: function(){ 
                        $(".my-datatable-error").html("");
                        $("#my-datatable").append('<tbody class="my-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $("#my-datatable_processing").css("display","none");
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
            },
            "destroy": true
        }).ajax.reload();
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

     $(document).on('click', '#refreshAp', function(e){
        location.reload();
    })


    $(document).on('click', '#bayarAp', function(e) {
        e.preventDefault()

        let payment = $(this).closest('tr').find('td').eq(1).text()
            payment = payment.replace('Rp ', '')
            payment = toFloat(payment)

        var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SaveAp' disabled=''>Save</button>";
        Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').removeClass('modal-full-width');
        $('.modal-dialog').addClass('modal-lg');

        $('#ModalHeader').html('Add payment');

        $('#ModalContent').load($(this).attr('href'), {payment: payment});
        $('#ModalGue').modal('show');
        $('#ModalFooter').html(Tombol);

    })

    $(document).on('click', '#TambahItemAr, #EditItemAr', function(e){
        e.preventDefault();

        var act = ''



        $('.modal-dialog').removeClass('modal-sm');

        $('.modal-dialog').addClass('modal-xl');

        if($(this).attr('id') == 'TambahItemAr')

        {
            act = 'Simpan'

            $('#ModalHeader').html('Add New Item');

        }

        if($(this).attr('id') == 'EditItemAr')

        {

            act = 'Update'

            $('#ModalHeader').html('Edit Item');

        }

        var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='"+act+"ItemAr'>Save</button>";

        Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('#ModalContent').load($(this).attr('href'));

        $('#ModalGue').modal('show');

        $('#ModalFooter').html(Tombol);

    });
    $(document).on('click', '#SimpanItemAr, #UpdateItemAr', function(e){
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
                        $('#SimpanItemAr').html("Saving, please wait ...");
                        $('#SimpanItemAr').prop('disabled', true);
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
                                    window.location.href = base_url+'Finance/ar';
                                }
                            })
                        }
                        else {
                            $('#ResponseInput').html(json.pesan);
                        }

                        $('#SimpanItemAr').html('Save');
                        $('#SimpanItemAr').prop('disabled', false);

                    }
                });
            }
            else
            {
                $('#ResponseInput').html('');
            }
        }
    });

     $(document).on('click', '#DeleteItemAr', function(e){
        e.preventDefault();
        var target = $(this).attr('href');
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then(function(t) {
            if(t.dismiss !== Swal.DismissReason.cancel)
            {
                $.ajax({
                    url: target,
                    success: function(s){
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            type: "success"
                        }).then(function(result){
                            if (result.value) {
                                window.location.href = base_url+'/finance/ar';
                            }
                        })
                    }
                })
            }
            else
            {
                Swal.fire({
                    title: "Cancelled",
                    text: "Your imaginary file is safe :)",
                    type: "error"
                })
            }
        })
    })

     $(document).on('click', '#alldateAr', function(e){
        e.preventDefault();
        var status  = $('select[name=Status]').val()
         status = (status) ? status : null;

        var payment = $('#ar-datatable').DataTable({
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page ",
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
            "ajax":
                {
                    url : base_url+"finance/ar-json/",
                    type: "post",
                    error: function(){ 
                        $(".my-datatable-error").html("");
                        $("#my-datatable").append('<tbody class="my-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $("#my-datatable_processing").css("display","none");
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
            },
            "destroy": true
        }).ajax.reload();
    })

     $(document).on('click','#refreshAr', function(e){
        location.reload();
     })


    $(document).on('click', '#filterAr', function(e){
        e.preventDefault();
        var status  = $('select[name=Status]').val()
         status = (status) ? status : null;
        var invoicedate1 = $('input[name="invoicedate-first"]').val()
        var invoicedate2 = $('input[name="invoicedate-last"]').val()
        var duedate1     = $('input[name="duedate-first"]').val()
        var duedate2     = $('input[name="duedate-last"]').val()

        var ar = $('#ar-datatable').DataTable({
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page ",
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
            "ajax":
                {
                    url : base_url+"finance/ar-json/",
                    type: "post",
                    data: {
                        status:       status,
                        invoicedate1: invoicedate1,
                        invoicedate2: invoicedate2,
                        duedate1:     duedate1,
                        duedate2:     duedate2,
                    },
                    error: function(){ 
                        $(".my-datatable-error").html("");
                        $("#my-datatable").append('<tbody class="my-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $("#my-datatable_processing").css("display","none");
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
            },
            "destroy": true
        }).ajax.reload();
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

    $(document).on('click', '#bayarAr', function(e) {
        e.preventDefault()

        let payment = $(this).closest('tr').find('td').eq(1).text()
            payment = payment.replace('Rp ', '')
            payment = toFloat(payment)

        var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SaveAr' disabled=''>Save</button>";
        Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').removeClass('modal-full-width');
        $('.modal-dialog').addClass('modal-lg');

        $('#ModalHeader').html('Add payment');

        $('#ModalContent').load($(this).attr('href'), {payment: payment});
        $('#ModalGue').modal('show');
        $('#ModalFooter').html(Tombol);

    })

    $(document).on('click', '#deleteap', function(e){
        e.preventDefault();
        var target = $(this).attr('href');
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then(function(t) {
            if(t.dismiss !== Swal.DismissReason.cancel)
            {
                $.ajax({
                    url: target,
                    success: function(s){
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            type: "success"
                        }).then(function(result){
                            if (result.value) {
                                window.location.href = base_url+'/finance/ap';
                            }
                        })
                    }
                })
            }
            else
            {
                Swal.fire({
                    title: "Cancelled",
                    text: "Your imaginary file is safe :)",
                    type: "error"
                })
            }
        })
    })

    $(document).on('click', '.popup-coa', function(e) {
        e.preventDefault()

        var target = $(this).closest('td').find('input.form-control').attr('id')

        $('.modal-dialog').removeClass('modal-sm')
        $('.modal-dialog').removeClass('modal-full-width')
        $('.modal-dialog').addClass('modal-lg')

        $('#ModalHeader').html('Select Account')
        $('#ModalContent').load($(this).attr('href'), {
            target: target
        })

        $('#ModalGue').unbind().modal()
    })

} )( jQuery );