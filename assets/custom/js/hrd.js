$(document).ready(function() {

    "use strict";

    var base_url = $('#base_url').val();


    $(document).on('click', '#DeleteItem', function(e){
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
                                window.location.href = base_url+'/hrd/bonus';
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

    $(document).on('click', '#DeleteKat', function(e){
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
                                window.location.href = base_url+'/hrd/category';
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

    $(document).on('click', '#DeleteAc', function(e){
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
                                window.location.href = base_url+'/hrd/achievment';
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



    $(document).on('click', '#TambahItem, #EditItem', function(e){
        e.preventDefault();

        var act = ''



        $('.modal-dialog').removeClass('modal-sm');

        $('.modal-dialog').addClass('modal-xl');

        if($(this).attr('id') == 'TambahItem')

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
    $(document).on('click', '#SimpanItem, #UpdateItem', function(e){
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
                    dataType:'data',
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
                                    window.location.href = base_url+'/hrd/bonus';
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

    $(document).on('click', '#TambahKat, #EditKat', function(e){
        e.preventDefault();

        var act = ''



        $('.modal-dialog').removeClass('modal-sm');

        $('.modal-dialog').addClass('modal-lg');

        if($(this).attr('id') == 'TambahKat')

        {
            act = 'Simpan'

            $('#ModalHeader').html('Add New Category');

        }

        if($(this).attr('id') == 'EditKat')

        {

            act = 'Update'

            $('#ModalHeader').html('Edit Category');

        }

        var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='"+act+"Kat'>Save</button>";

        Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('#ModalContent').load($(this).attr('href'));

        $('#ModalGue').modal('show');

        $('#ModalFooter').html(Tombol);

    });
    $(document).on('click', '#SimpanKat, #UpdateKat', function(e){
        e.preventDefault();
        if($(this).hasClass('disabled'))
        {
            return false;
        }
        else
        {
            if($('#form-category').serialize() !== '')
            {
                $.ajax({
                    url: $('#form-category').attr('action'),
                    type: "POST",
                    cache: false,
                    data: $('#form-category').serialize(),
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
                                    window.location.href = base_url+'/hrd/Category';
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

    $(document).on('click', '#TambahAc, #EditAc', function(e){
        e.preventDefault();

        var act = ''



        $('.modal-dialog').removeClass('modal-sm');

        $('.modal-dialog').addClass('modal-lg');

        if($(this).attr('id') == 'TambahAc')

        {
            act = 'Simpan'

            $('#ModalHeader').html('Add New Achievment');

        }

        if($(this).attr('id') == 'EditAc')

        {

            act = 'Update'

            $('#ModalHeader').html('Edit Achievment');

        }

        var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='"+act+"Ac'>Save</button>";

        Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('#ModalContent').load($(this).attr('href'));

        $('#ModalGue').modal('show');

        $('#ModalFooter').html(Tombol);

    });
    $(document).on('click', '#SimpanAc, #UpdateAc', function(e){
        e.preventDefault();
        if($(this).hasClass('disabled'))
        {
            return false;
        }
        else
        {
            if($('#form-achievment').serialize() !== '')
            {
                $.ajax({
                    url: $('#form-achievment').attr('action'),
                    type: "POST",
                    cache: false,
                    data: $('#form-achievment').serialize(),
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
                                    window.location.href = base_url+'/hrd/achievment';
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
    if( $.isFunction($.fn.DataTable) )
    {
        var dataTable = $('#bpjs-datatable').DataTable( {
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"hrd/tambah-bpjs' class='btn btn-danger waves-effect waves-light ml-3' id='TambahBpjs'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
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
                url : base_url+"hrd/bpjs-json",
                type: "post",
                error: function(){ 
                    $(".cat-datatable-error").html("");
                    $("#cat-datatable").append('<tbody class="cat-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#cat-datatable_processing").css("display","none");
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

    $(document).on('click', '#TambahBpjs, #EditBpjs', function(e){
        e.preventDefault();

        var act = ''



        $('.modal-dialog').removeClass('modal-sm');

        $('.modal-dialog').addClass('modal-xl');

        if($(this).attr('id') == 'TambahBpjs')

        {
            act = 'Simpan'

            $('#ModalHeader').html('Add New Insurance');

        }

        if($(this).attr('id') == 'EditBpjs')

        {

            act = 'Update'

            $('#ModalHeader').html('Edit Insurance');

        }

        var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='"+act+"Bpjs'>Save</button>";

        Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('#ModalContent').load($(this).attr('href'));

        $('#ModalGue').modal('show');

        $('#ModalFooter').html(Tombol);

    });
    $(document).on('click', '#topay, #UpdateBpjs', function(e){
        e.preventDefault();
        console.log($('#form-bpjs').attr('action'))
        if($(this).hasClass('disabled'))
        {
            return false;
        }
        else
        {
            if($('#form-bpjs').serialize() !== '')
            {
                $.ajax({
                    url: $('#form-bpjs').attr('action'),
                    type: "POST",
                    cache: false,
                    data: $('#form-bpjs').serialize(),
                    dataType:'json',
                    beforeSend:function(){
                        $('#SimpanBpjs').html("Saving, please wait ...");
                        $('#SimpanBpjs').prop('disabled', true);
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
                                    window.location.href = base_url+'/hrd/insurance';
                                }
                            })
                        }
                        else {
                            $('#ResponseInput').html(json.pesan);
                            $('#SimpanBpjs').html("Save");
                            $('#SimpanBpjs').prop('disabled', false);
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
    $(document).on('click', '#pay', function(event) {
        event.preventDefault();
        var tombol = "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";
           tombol += "<button type='button' class='btn btn-primary' id='topay'>Confirm</button>";
        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').addClass('modal-lg');
        var date = $(this).closest('tr').find('td').eq(1).text()
        date = encodeURI(date)
        $('#ModalHeader').html('Payroll');
        $('#ModalContent').load($(this).attr('href')+'?date='+date);
        $('#ModalFooter').html(tombol);
        $('#ModalGue').modal('show');
    });


    $(document).on('click', '#topay', function(event) { 
    	event.preventDefault();
    	$.ajax({
    		url: $('form').attr('action'),
    		type: 'post',
    		dataType: 'json',
    		data: $('form').serialize(),
    		beforeSend:function(){
    		    $('#topay').html("Saving, please wait ...");
    		    $('#topay').prop('disabled', true);
    		},
    		success : function(data){
    			if(data.status == 1){
    			    swal.fire({
    			        title: 'Success',
    			        text: data.pesan,
    			        type: 'success',
    			        confirmButtonColor : '#3085D6',
    			        confirmButtonText : 'OK!'
    			    }).then(function(result){
    			    	$('#payroll-datatable').DataTable().ajax.reload()
    			        $('#ModalGue').modal('hide')
    			    })
    			}
    			else {
    			    $('#response-input').html(data.pesan);
    			    $('#topay').html("Save");
    			    $('#topay').prop('disabled', false);
    			}

    			$('#topay').html('Save');
    			$('#topay').prop('disabled', false);

    		}
    	})
    	
    });

    $(document).on('click', '#fiter-payroll', function(event) {
    	event.preventDefault();
    	var status = $('#status-pay').val() 
    	var user = $('#user').val() 
    	var month = $('#month').val()

    	var summary_recieve = $('#payroll-datatable').DataTable({
    	    "ajax":
    	        {
    	            url : base_url+'hrd/payroll-json/'+status+'/'+user+'/'+month,
    	            type: "get",
    	            error: function(){ 
    	                $(".my-datatable-error").html("");
    	                $("#my-datatable").append('<tbody class="my-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
    	                $("#my-datatable_processing").css("display","none");
    	            }
    	        },
    	    "destroy": true
    	}).ajax.reload();
    });



    $(document).on('submit', '#form-payroll', function(event) {
        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: 'post',
            dataType: 'json',
            data: $(this).serializeArray(),
            beforeSend:function(){
                $('#transaction-pay').html("Saving, please wait ...");
                $('#transaction-pay').prop('disabled', true);
            },
            success : function(data){
                if(data.status == 1){
                    swal.fire({
                        title: 'Success',
                        text: data.pesan,
                        type: 'success',
                        confirmButtonColor : '#3085D6',
                        confirmButtonText : 'OK!'
                    }).then(function(result){
                        window.location.href = base_url + 'hrd/payroll?month='+data.month
                    })
                }
                else {
                    Swal.fire({
                        title: "Error",
                        html: data.pesan,
                        type: "error"
                    })
                    $('#transaction-pay').html("Save");
                    $('#transaction-pay').prop('disabled', false);
                }

                $('#transaction-pay').html('Save');
                $('#transaction-pay').prop('disabled', false);
            }
        })
    });

    $(document).on('change', '#month-payroll', function(event) {
        event.preventDefault();
        var val = $(this)
        $.ajax({
            url: base_url + 'hrd/ifexistmonth/' + val.val(),
            type: 'get',
            dataType: 'json',
            success: function(data)
            {
                if (data.status == 0) {
                    Swal.fire({
                        title: "Error",
                        html: data.pesan,
                        type: "error"
                    }).then(function(v){
                        val.val('')
                    })
                }
            }
        })
        
    });

    $(document).on('click', '#btn-pay', function(event) {
        event.preventDefault();
        var idRow = []
        var subtotalRow = []
        var total = $('input[name=total]').val()
        var id = $('.id')
        id.each(function(index, el) {
            idRow.push($(this).val())
        });
        var subtotal = $('.subtotal')
        subtotal.each(function(index, el) {
            subtotalRow.push($(this).val())
        });

        if ($(this).hasClass('disabled')) {
            return false
        }
        var data = {total: total, id: idRow, subtotal: subtotalRow}

        $.ajax({
            url: base_url + 'hrd/paysalary',
            type: 'post',
            dataType: 'json',
            data: data,
            beforeSend:function(){
                $('#transaction-pay').html("Saving, please wait ...");
                $('#transaction-pay').prop('disabled', true);
            },
            success : function(data){
                if(data.status == 1){
                    swal.fire({
                        title: 'Success',
                        text: data.pesan,
                        type: 'success',
                        confirmButtonColor : '#3085D6',
                        confirmButtonText : 'OK!'
                    }).then(function(result){
                        window.location.href = base_url + 'hrd/payroll'
                    })
                }
            }
        })
        
    });
    if( $.isFunction($.fn.DataTable) )
    {
        var payroll = $('#insentif-datatable').DataTable( {
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": '_MENU_ &nbsp;&nbsp;<a href="'+base_url+'hrd/new-transaction-insentif" class="btn btn-primary"><i class="fa fa-plus-square mr-2"></i>New Transaction</a>',
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
                url : base_url+"hrd/insentif-json",
                type: "post",
                error: function(){ 
                    $(".cat-datatable-error").html("");
                    $("#cat-datatable").append('<tbody class="cat-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#cat-datatable_processing").css("display","none");
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
    if( $.isFunction($.fn.DataTable) )
    {
        var payroll = $('#payroll-datatable').DataTable( {
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": '_MENU_ &nbsp;&nbsp;<a href="'+base_url+'hrd/new-transaction-payroll" class="btn btn-primary"><i class="fa fa-plus-square mr-2"></i>New Transaction</a>',
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
                url : base_url+"hrd/payroll2-json",
                type: "post",
                error: function(){ 
                    $(".cat-datatable-error").html("");
                    $("#cat-datatable").append('<tbody class="cat-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#cat-datatable_processing").css("display","none");
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
        var insurance = $('#insurance-datatable').DataTable( {
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": '_MENU_ &nbsp;&nbsp;',
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
                url : base_url+"hrd/payroll2-json/"+1,
                type: "post",
                error: function(){ 
                    $(".cat-datatable-error").html("");
                    $("#cat-datatable").append('<tbody class="cat-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#cat-datatable_processing").css("display","none");
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



        $(document).on('change', '#search-by-month #search-by-month-insurance', function(event) {
            event.preventDefault();
            var button = null
            var is_insurance = null
            if($(this).attr('id') == 'search-by-month') {
                is_insurance = null
                button = '<a href="'+base_url+'hrd/new-transaction-payroll" class="btn btn-primary"><i class="fa fa-plus-square mr-2"></i>New Transaction</a>'
            }else{
                is_insurance = 1
            }
            var dataTable = $('#payroll-datatable').DataTable({
                "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": '_MENU_ &nbsp;&nbsp;'+button,
                // "sInfoFiltered": "(difilter dari _MAX_ total data)", 
                // "sZeroRecords": "Pencarian tidak ditemukan", 
                // "sEmptyTable": "Data kosong", 
                // "sLoadingRecords": "Harap Tunggu...", 
                "oPaginate": {
                    "sPrevious": "Prev",
                    "sNext": "Next"
                }
            },
            "ajax":
                {
                    url : base_url+"hrd/payroll2-json/"+is_insurance +'/'+$(this).val(),
                    type: "post",
                    error: function(){ 
                        $(".my-datatable-error").html("");
                        $("#my-datatable").append('<tbody class="my-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $("#my-datatable_processing").css("display","none");
                    }
                },
                "destroy": true
            }).ajax.reload();
            
        });
        $(document).on('click', '#refresh-payroll #refresh-payroll-insurance', function(event) {
            event.preventDefault();
            var is_insurance = null
            var button = null
            if($(this).attr('id') == 'search-by-month') {
                is_insurance = null
                button = '<a href="'+base_url+'hrd/new-transaction-payroll" class="btn btn-primary"><i class="fa fa-plus-square mr-2"></i>New Transaction</a> i'
            }else{
                is_insurance = 1
            }
            $('#search-by-month').val('')
            var dataTable = $('#payroll-datatable').DataTable({
                "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": '_MENU_ &nbsp;&nbsp;'+button,
                // "sInfoFiltered": "(difilter dari _MAX_ total data)", 
                // "sZeroRecords": "Pencarian tidak ditemukan", 
                // "sEmptyTable": "Data kosong", 
                // "sLoadingRecords": "Harap Tunggu...", 
                "oPaginate": {
                    "sPrevious": "Prev",
                    "sNext": "Next"
                    }
                },
               "ajax":
                   {
                       url : base_url+"hrd/payroll2-json/"+is_insurance,
                       type: "post",
                       error: function(){ 
                           $(".my-datatable-error").html("");
                           $("#my-datatable").append('<tbody class="my-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                           $("#my-datatable_processing").css("display","none");
                       }
                   },
                   "destroy": true
               }).ajax.reload();
        });
    }
    $(document).on('click', '#calculate-pay', function(event) {
        event.preventDefault();
        $(this).text('Calculating ...')
        $(this).attr('disabled', true);
        var data = $('tbody tr').each(function(index, el) {
            var row = $(this).find('td')
            var id = $(this).data('id')
            var hadir = row.eq(2).find('input').val()
            var potongan = row.eq(4).find('input').val()
            $.ajax({
                url: base_url + 'hrd/calculate/' + id,
                type: 'post',
                dataType: 'json',
                data: {hadir : hadir, potongan: potongan},
                success: function(data)
                {
                    if (data.status == 0) {
                        Swal.fire({
                            title: "Error",
                            html: data.pesan,
                            type: "error"
                        })
                    }else{
                        row.eq(3).text(data.gajiBruto)
                        row.eq(5).text(data.subtotal)
                        $('#transaction-pay').attr('disabled', false)
                    }
                }
            })
            
            // var user = await fetch(base_url + 'hrd/row-employee/' + $(this).data('id'))
            //     user = await  user.json()
            // var pokok = user.pokok; 
            // var makan = user.makan; 
            // var transport = user.transport; 
            // var tunjangan = user.tunjangan; 
            // var another = user.another; 

            // var hadirUser = $(this).find('td').eq(2).val()

            // var gajiBruto = (hadirUser * pokok) + (hadirUser * makan) + (hadirUser * transport) + tunjangan + another;
            
            // var bpjs = await fetch(base_url + 'hrd/row-bpjs/' + user.id)
            //     bpjs = await bpjs.json()
            // var bpjsKes = 0
            // var bpjsNaker = 0
            // if (user.bpjs){
            //     bpjsKes = bpjs.kes
            //     bpjsNaker = bpjs.naker
            // } 
            // var umk = await fetch(base_url + 'hrd/get-umk/')
            //     umk = await umk.json()

            // var kesTotal = (gajiBruto < umk) ? umk * 0.05 : gajiBruto * 0.05;
            // var kesKaryawan = kesTotal * bpjsKes; 
            // var kesPerusahaan = kesTotal - kesKaryawan;
            // var kesPersen = (kesTotal / gajiBruto) * 100; 

            // var nakerKaryawan = (gajiBruto < umk) ? umk * bpjsNaker : gajiBruto * bpjsNaker; 
            // var nakerPerusahaan = (gajiBruto < umk) ? umk * 0.0489 : gajiBruto * 0.0489;
            // var nakerTotal = nakerKaryawan + nakerPerusahaan;
            // var nakerPersen = (nakerTotal / gajiBruto) * 100;

            // var potongan = $(this).find('td').eq(4).val()
            // var subtotal = (gajiBruto - kesTotal - nakerTotal) - potongan

            // console.log(subtotal)
            // console.log(gajiBruto)
            // $(this).find('td').eq(3).text(gajiBruto)
            // $(this).find('td').eq(3).text(subtotal)
        });
        $(this).text('Calculate')
        $(this).attr('disabled', false);

    });
    $(document).on('change', '#getinsentifbymonth', function(event) {
        event.preventDefault();
        var val = $(this)
        var month = val.val()
        $.ajax({
            url: base_url + 'hrd/getnewinsentif',
            type: 'post',
            dataType: 'json',
            data: {month: month},
            success: function(data){
                if (data.status == 0) {
                    Swal.fire({
                        title: "Error",
                        html: data.pesan,
                        type: "error"
                    }).then(function(v){
                        val.val('')
                    })
                }else{
                    var grandtotal = 0
                    $.each(data.data, function(index, val) {
                        var targetService = val.target.Jasa.target
                        var targetSparepart = val.target.Sparepart.target
                        var targetServiceUser = val.achieved.service 
                        var targetSparepartUser = val.achieved.sparepart 

                        var persenService = val.target.Jasa.detail
                        var persenSparepart = val.target.Sparepart.detail

                        var persentaseService = (targetServiceUser / targetService) * 100
                        var persentaseSparepart = (targetSparepartUser / targetSparepart) * 100
                        var resultService = 0
                        var resultSparepart = 0 
                        var insentifService = 0
                        var insentifSparepart = 0

                        $.each(persenService, function(i, v) {
                            if (persentaseService > v.insentif) {
                                resultService = (targetServiceUser / 100) * v.persen
                                insentifService = v.persen
                            }
                        });
                        $.each(persenSparepart, function(i, v) {
                            if (persentaseSparepart > v.insentif) {
                                resultSparepart = (targetSparepartUser / 100) * v.persen
                                insentifSparepart = v.persen
                            }
                        });

                        grandtotal += (resultService + resultSparepart)
                        $('#tb-insentif').html('\
                                <tr>\
                                    <td>'+ val.employee +'</td>\
                                    <td>'+ val.position +'</td>\
                                    <td><span class="autonumber" data-a-sep="." data-a-dec="," data-m-dec="0">'+ targetService +'</span></td>\
                                    <td><span class="autonumber" data-a-sep="." data-a-dec="," data-m-dec="0">'+ targetSparepart +'</span></td>\
                                    <td><span class="autonumber" data-a-sep="." data-a-dec="," data-m-dec="0">'+ targetServiceUser +'</span></td>\
                                    <td>' + persentaseService +'%</td>\
                                    <td><span class="autonumber" data-a-sep="." data-a-dec="," data-m-dec="0">'+ targetSparepartUser +'</span></td>\
                                    <td>' + persentaseSparepart +'%</td>\
                                    <td><span class="autonumber" data-a-sep="." data-a-dec="," data-m-dec="0">'+ resultService +'</span></td>\
                                    <td>' + insentifService +'%</td>\
                                    <td><span class="autonumber" data-a-sep="." data-a-dec="," data-m-dec="0">'+ resultSparepart +'</span></td>\
                                    <td>'+ insentifSparepart +'%</td>\
                                </tr>\
                            ')  
                    });
                    $('#grandtotal').html('Rp. <span class="autonumber" data-a-sep="." data-a-dec="," data-m-dec="0">'+ grandtotal +'</span>')
                    $('input[name=grandtotal]').val(grandtotal)
                    $('#confirm-insentif').attr('disabled', false);
                    $('.autonumber').autoNumeric('init')
                }
            }
        })
        

    });
    $(document).on('click', '#confirm-insentif', function(event) {
        event.preventDefault();
        if ($(this).attr('disabled')) {
            return false
        }

        var month = $('#getinsentifbymonth').val()
        var employee = [];
        var position = [];

        var targetJasa = []
        var targetSparepart = []

        var achievedJasaNominal = []
        var achievedJasaPersen = []
        var achievedSparepartNominal = []
        var achievedSparepartPersen = []

        var insentifJasaNominal = []
        var insentifJasaPersen = []
        var insentifSparepartNominal = []
        var insentifSparepartPersen = []
        $('#tb-insentif').find('tr').each(function(index, el) {
            employee.push($(this).find('td').eq(0).text())
            position.push($(this).find('td').eq(1).text())
            targetJasa.push($(this).find('td').eq(2).find('span').text())
            targetSparepart.push($(this).find('td').eq(3).find('span').text())
            achievedJasaNominal.push($(this).find('td').eq(4).find('span').text())
            achievedJasaPersen.push($(this).find('td').eq(5).text())
            achievedSparepartNominal.push($(this).find('td').eq(6).find('span').text())
            achievedSparepartPersen.push($(this).find('td').eq(7).text())
            insentifJasaNominal.push($(this).find('td').eq(8).find('span').text())
            insentifJasaPersen.push($(this).find('td').eq(9).text())
            insentifSparepartNominal.push($(this).find('td').eq(10).find('span').text())
            insentifSparepartPersen.push($(this).find('td').eq(11).text())
        });


        var grandtotal = $('input[name=grandtotal]').val()
        var data = { month, grandtotal, employee, 
                    position, targetJasa, 
                    targetSparepart, achievedJasaNominal, 
                    achievedJasaPersen, achievedSparepartNominal, 
                    achievedSparepartPersen, insentifJasaNominal, 
                    insentifJasaPersen, insentifSparepartNominal, 
                    insentifSparepartPersen }
        var row = $(this)
        $.ajax({
            url: base_url + 'hrd/actioninsentif',
            type: 'post',
            dataType: 'json',
            data: data,
            beforeSend:function(){
                row.html("Saving, please wait ...");
                row.prop('disabled', true);
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
                            window.location.href = base_url+'hrd/incentive';
                        }
                    })
                }
                else {
                    Swal.fire({
                       title: "Error",
                       text: data.pesan,
                       type: "error"
                   })
                }

                row.html('Save');
                row.prop('disabled', false);

            }
        
        });

    });
    $(document).on('click', '#print-pay', function(event) {
        event.preventDefault(); 
        window.open(
            $(this).attr('href') + '?cetak=1',
            'popUpWindow',
            'height=700,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
        return false
    });
    $(document).on('click', '#print-all, #print-all-thr', function(event) {
        event.preventDefault();
        window.open(
            $(this).attr('href') + '?cetak=1',
            'popUpWindow',
            'height=700,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
        return false
    });
    $(document).on('click', '#print-all-bpjs', function(event) {
        event.preventDefault();
        window.open(
            $(this).attr('href') + '/' + 'true?cetak=1' ,
            'popUpWindow',
            'height=700,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
        return false
    });

     $(document).on('click', '#print-insentif', function(event) {
        event.preventDefault();
        window.open(
            $(this).attr('href') + '?cetak=1' ,
            'popUpWindow',
            'height=700,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
        return false
    });
     function openWindowWithPost(url, data) {
         var form = document.createElement("form");
         form.target = "_blank";
         form.method = "POST";
         form.action = url;
         form.style.display = "none";

         for (var key in data) {
             var input = document.createElement("input");
             input.type = "hidden";
             input.name = key;
             input.value = data[key];
             form.appendChild(input);
         }
         document.body.appendChild(form);
         var map = window.open(
                ''
              ,
             'popUpWindow',
             'height=700,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
         if (map) {
             form.submit();
             document.body.removeChild(form);
         }

     }

      $(document).on('click', '#print-row-insentif', function(event) {
         event.preventDefault();
         var row = $(this).closest('tr').find('td')
         var data = ''
         data += '&employee='+row.eq(0).text(),
         data += '&position='+row.eq(1).text(),
         data += '&achievedJasaTarget='+row.eq(4).find('span').text(),
         data += '&achievedJasaPersen='+row.eq(5).text(),
         data += '&achievedSparepartTarget='+row.eq(6).find('span').text(),
         data += '&achievedSparepartPersen='+row.eq(7).text(),
         data += '&insentifJasaTarget='+row.eq(8).find('span').text(),
         data += '&insentifJasaPersen='+row.eq(9).text(),
         data += '&insentifSparepartTarget='+row.eq(10).find('span').text(),
         data += '&insentifSparepartPersen='+row.eq(11).text(),
         data += '&grandtotal='+$('#grandtotal').text()
         data += '&month='+$('input[name=month]').val()
         window.open(
                base_url + 'hrd/print-insentif-row' + '?cetak=1' + data,
                     'popUpWindow',
                     'height=700,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
         return false
     });
      if( $.isFunction($.fn.DataTable) )
      {
          var dataTable = $('#thr-datatable').DataTable( {
              "serverSide": true,
              "stateSave" : false,
              "bAutoWidth": true,
              "oLanguage": {
                  "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                  "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"hrd/tambah-thr' class='btn btn-danger waves-effect waves-light ml-3' id='TambahThr'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
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
                  url : base_url+"hrd/thr-json",
                  type: "post",
                  error: function(){ 
                      $(".cat-datatable-error").html("");
                      $("#cat-datatable").append('<tbody class="cat-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                      $("#cat-datatable_processing").css("display","none");
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
      $(document).on('click', '#TambahThr, #EditThr', function(e){

          e.preventDefault();

          var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SimpanThr'>Save</button>";
          Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

          $('.modal-dialog').removeClass('modal-sm');
          $('.modal-dialog').removeClass('modal-full-widt');
          $('.modal-dialog').addClass('modal-lg');

          if($(this).attr('id') == 'TambahThr')
          {
              $('#ModalHeader').html('Add/Update');
          }
          
          if($(this).attr('id') == 'EditThr')
          {
              $('#ModalHeader').html('Add/Update');
          }

          $('#ModalContent').load($(this).attr('href'));

          $('#ModalGue').modal('show');
          $('#ModalFooter').html(Tombol);

      });

      $(document).on('click', '#SimpanThr', function(e){
          e.preventDefault();

          if($(this).hasClass('disabled'))
          {
              return false;
          }
          else
          {
              if($('.tambah-sparepart').serialize() !== '')
              {
                  $.ajax({
                      url: $('.tambah-sparepart').attr('action'),
                      type: "POST",
                      cache: false,
                      data: $('.tambah-sparepart').serialize(),
                      dataType:'json',
                      beforeSend:function(){
                          $('#SimpanThr').html("Saving, please wait ...");
                      },
                      success: function(json){
                          if(json.status == 1){ 
                              $('.modal-dialog').removeClass('modal-lg');
                              $('.modal-dialog').addClass('modal-sm');
                              $('#ModalHeader').html('Success !');
                              $('#ModalContent').html(json.pesan);
                              $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                              $('#ModalGue').modal('show');
                              $('#thr-datatable').DataTable().ajax.reload( null, false );
                          }
                          else {
                              $('#ResponseInput').html(json.pesan);
                          }

                          $('#SimpanThr').html('Save');
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
          var thr_modul = $('#thr-modul-datatable').DataTable( {
              "serverSide": true,
              "stateSave" : false,
              "bAutoWidth": true,
              "oLanguage": {
                  "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                  "sLengthMenu": '_MENU_ &nbsp;&nbsp;<a href="'+base_url+'hrd/new-transaction-thr-modul" class="btn btn-primary"><i class="fa fa-plus-square mr-2"></i>New Transaction</a>',
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
                  url : base_url+"hrd/thr-modul-json",
                  type: "post",
                  error: function(){ 
                      $(".cat-datatable-error").html("");
                      $("#cat-datatable").append('<tbody class="cat-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                      $("#cat-datatable_processing").css("display","none");
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

      $(document).on('change', '#getThrByYear', function(event) {
          event.preventDefault();
          var row = $(this)
          $.ajax({
              url: base_url + 'hrd/getdatathr',
              type: 'post',
              dataType: 'json',
              data: {year : row.val()},
              success: function(data)
              {
                if (data.status == 1) {
                    var grandtotal = 0
                    var rows = ''
                    $.each(data.data.data, function(index, val) {
                        // console.log(val)
                        grandtotal += (Math.round(val.thr / 1000) * 1000)
                        var action = (val.type == 'kurang') ?
                                '<button class="btn btn-warning btn-sm" id="edit-policy"><i class="fa fa-edit mr-2"></i>Policy</button>' : ''
                        rows += '\
                                <tr>\
                                    <td>'+ val.employee +'</td>\
                                    <td>'+ val.position +'</td>\
                                    <td>'+ val.masaKerja.Y + ' Year ' + val.masaKerja.m + ' Month ' + val.masaKerja.d +' Day</td>\
                                    <td><span class="autonumber" data-a-sep="." data-a-dec="," data-m-dec="0">'+ (Math.round(val.thr / 1000) * 1000) +'</span></td>\
                                    <td>'+ action +'</td>\
                                </tr>\
                            '  
                    });
                    $('#tb-transaction-thr').html(rows)
                    $('#grandtotal').html('Rp. <span class="autonumber" data-a-sep="." data-a-dec="," data-m-dec="0">'+ grandtotal +'</span>')
                    $('input[name=grandtotal]').val(grandtotal)
                    $('#confirm-thr').attr('disabled', false);                    
                    $('.autonumber').autoNumeric('init')
                }else{
                    Swal.fire({
                        title: "Error",
                        html: data.pesan,
                        type: "error"
                    })
                    row.val('')
                }
              }
          })
          
      });
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

      function cekUlangGrandtotal(is_ = false)
      {
        if (is_) {
            var total = 0
            $('#tb-transaction-thr').find('tr').each(function(index, el) {
                $(this).find('td').eq(3).each(function(i, e) {
                    total += toFloat($(this).find('span').text())
                });
            });
            $('#grandtotal').html('<span class="autonumber" data-a-sep="." data-a-dec="," data-m-dec="0">'+ total +'</span>')
            $('.autonumber').autoNumeric('init')
        }else{
            var data = $('#tb-transaction-thr').find('tr').each(function(index, el) {
                $(this).find('td').eq(3).each(function(i, e) {
                    if ($(this).find('input').length) {
                        return false
                        console.log($(this).find('input'))
                    }
                });
            });
            return true
        }
      }

      $(document).on('click', '#edit-policy', function(event) {
          event.preventDefault();
          if ($(this).attr('disabled')) {
            return false
          }
          var row = $(this).closest('tr').find('td').eq(3)
          var nominal = toFloat(row.text())
          row.html('<input type="text" name="form-policy" class="form-control form-control-sm autonumber" data-a-sep="." data-a-dec="," data-m-dec="0" value="'+nominal+'">')
          $(this).attr('disabled', true)
          $('.autonumber').autoNumeric('init')
          $('#confirm-thr').attr('disabled', true);
      });
      $(document).on('keyup', 'input[name=form-policy]', function(e) {
          event.preventDefault();
          if (e.keyCode == 13) {
            var row = $(this).closest('tr').find('td')
            var nominal = toFloat($(this).val())
            row.eq(3).html('<span class="autonumber" data-a-sep="." data-a-dec="," data-m-dec="0">'+ (Math.round(nominal / 1000) * 1000) +'</span>')
            cekUlangGrandtotal(true)
            row.eq(4).find('button').attr('disabled', false)
            $('#confirm-thr').attr('disabled', false);
          }
          $('.autonumber').autoNumeric('init')
      });
      $(document).on('click', '#confirm-thr', function(event) {
          event.preventDefault();
          if ($(this).attr('disabled')) {
            return false
          }
          var detail = []
          $('#tb-transaction-thr').find('tr').each(function(index, el) {
              var row = {}
              row.employee = $(this).find('td').eq(0).text()
              row.position = $(this).find('td').eq(1).text()
              row.masaKerja = $(this).find('td').eq(2).text()
              row.thr = $(this).find('td').eq(3).text()
              detail[index] = row
          });
          var year = $('#getThrByYear').val()
          var grandtotal = $('#grandtotal').text()
          var data = {
            year : year,
            total : grandtotal,
            detail : detail
          }
          $.ajax({
              url: base_url + 'hrd/add_transaction_thr',
              type: 'post',
              dataType: 'json',
              data: data,
              success : function(data)
              {
                if(data.status == 1){
                    swal.fire({
                        title: 'Success',
                        text: 'Transaction has success',
                        type: 'success',
                        confirmButtonColor : '#3085D6',
                        confirmButtonText : 'OK!'
                    }).then(function(result){
                        if (result.value) {
                            window.location.href = base_url+'/hrd/detail_thr/' + data.id;
                        }
                    })
                }else{
                    Swal.fire({
                        title : 'Error',
                        text : data.pesan,
                        type : 'error'
                    })
                }
              }
          })
          
      });
       $(document).on('click', '#print-thr', function(event) {
          event.preventDefault();
          var row = $(this).closest('tr').find('td')
          var data = ''
          data += '&employee='+row.eq(0).text(),
          data += '&position='+row.eq(1).text(),
          data += '&masaKerja='+row.eq(2).text(),
          data += '&thr='+row.eq(3).text(),
          data += '&year='+$('input[name=year]').val()
          window.open(
                 base_url + 'hrd/print-thr-row' + '?cetak=1' + data,
                      'popUpWindow',
                      'height=700,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
          return false
      });
});

