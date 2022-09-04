( function ( $ ) {

    "use strict";
    var base_url = $('#base_url').val();

    /*
    * General Settings
    */

    $('#upload').on('click', function(e){
        $('#logo-upload').trigger('click');
    })

    $('#logo-upload').on('change', function(e){
        e.preventDefault();

        $('.progress-bar').attr('aria-valuenow', 0).css('width', 0 + '%').text(0 + '%');

        $.ajax({
            // Your server script to process the upload
            url: base_url + 'company/uploadImage',
            type: 'POST',
            dataType: 'JSON',

            // Form data
            data: new FormData($('#upload-logo')[0]),

            // Tell jQuery not to process data or worry about content-type
            // You *must* include these options!
            cache: false,
            contentType: false,
            processData: false,

            // Custom XMLHttpRequest
            xhr : function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function(e){
                    if(e.lengthComputable){                        
                        var percent = Math.round((e.loaded / e.total) * 100);

                        $('#logo-upload').attr('disabled', true);

                        $('.progress').removeClass('hide');                        

                        $('.progress-bar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
                    }
                });
                return xhr;
            },
            success: function(r){
                if(r.status == 1) {
                    $('#company-logo').attr('src', base_url + 'upload/popoti/'+r.file);
                    $('#responseMessage').html(r.message);
                } else {
                    $('#responseMessage').html(r.message);
                }

                $('#logo-upload').attr('disabled', false);
                $('.progress').addClass('hide');
                $('.progress-bar').attr('aria-valuenow', 0).css('width', 0 + '%').text(0 + '%');
            }
        })
    })

    $('#save').on('click', function (e) {
        // e.preventDefault();
        $('#form-company').trigger('submit');
    })

    if( $.isFunction($.fn.DataTable) )
    {

        /*
        * Category
        */

        var dataTable = $('#my-datatable').DataTable( {
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"company/tambah-category' class='btn btn-danger waves-effect waves-light ml-3' id='Tambah'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
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
                url : base_url+"company/category-json",
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
            }
        } );
        
        $(document).on('click', '#Tambah, #Edit', function(e){
            e.preventDefault();

            var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SimpanCatCompany'>Save</button>";
            Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

            $('.modal-dialog').removeClass('modal-sm');
            $('.modal-dialog').addClass('modal-lg');
            if($(this).attr('id') == 'Tambah')
            {
                $('#ModalHeader').html('Add New Category');
            }
            if($(this).attr('id') == 'Edit')
            {
                $('#ModalHeader').html('Edit Category');
            }
            $('#ModalContent').load($(this).attr('href'));
            $('#ModalGue').modal('show');
            $('#ModalFooter').html(Tombol);
        });

        $(document).on('click', '#SimpanCatCompany', function(e){
            e.preventDefault();

            if($(this).hasClass('disabled'))
            {
                return false;
            }
            else
            {
                if($('.tambah-category').serialize() !== '')
                {
                    $.ajax({
                        url: $('.tambah-category').attr('action'),
                        type: "POST",
                        cache: false,
                        data: $('.tambah-category').serialize(),
                        dataType:'json',
                        beforeSend:function(){
                            $('#SimpanCatCompany').html("Saving, please wait ...");
                        },
                        success: function(json){
                            if(json.status == 1){ 
                                $('.modal-dialog').removeClass('modal-lg');
                                $('.modal-dialog').addClass('modal-sm');
                                $('#ModalHeader').html('Success !');
                                $('#ModalContent').html(json.pesan);
                                $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                                $('#ModalGue').modal('show');
                                $('#my-datatable').DataTable().ajax.reload( null, false );
                            }
                            else {
                                $('#ResponseInput').html(json.pesan);
                            }

                            $('#SimpanCatCompany').html('Save');
                        }
                    });
                }
                else
                {
                    $('#ResponseInput').html('');
                }
            }
        });

        /*
        * Sub Company
        */

        var dataTable = $('#sub-company').DataTable( {
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"company/tambah-sub' class='btn btn-danger waves-effect waves-light ml-3' id='TambahSub'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
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
                url : base_url+"company/sub-json",
                type: "post",
                error: function(){ 
                    $(".sub-company-error").html("");
                    $("#sub-company").append('<tbody class="sub-company-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#sub-company_processing").css("display","none");
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
        
        $(document).on('click', '#TambahSub, #EditSub', function(e){
            e.preventDefault();

            var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SimpanSubCompany'>Save</button>";
            Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

            $('.modal-dialog').removeClass('modal-sm');
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
        });

        $(document).on('click', '#SimpanSubCompany', function(e){
            e.preventDefault();

            if($(this).hasClass('disabled'))
            {
                return false;
            }
            else
            {
                if($('.tambah-sub').serialize() !== '')
                {
                    $.ajax({
                        url: $('.tambah-sub').attr('action'),
                        type: "POST",
                        cache: false,
                        data: $('.tambah-sub').serialize(),
                        dataType:'json',
                        beforeSend:function(){
                            $('#SimpanSubCompany').html("Saving, please wait ...");
                        },
                        success: function(json){
                            if(json.status == 1){ 
                                $('.modal-dialog').removeClass('modal-lg');
                                $('.modal-dialog').addClass('modal-sm');
                                $('#ModalHeader').html('Success !');
                                $('#ModalContent').html(json.pesan);
                                $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                                $('#ModalGue').modal('show');
                                $('#sub-company').DataTable().ajax.reload( null, false );
                            }
                            else {
                                $('#ResponseInput').html(json.pesan);
                            }

                            $('#SimpanSubCompany').html('Save');
                        }
                    });
                }
                else
                {
                    $('#ResponseInput').html('');
                }
            }
        });

    }

} )( jQuery );



