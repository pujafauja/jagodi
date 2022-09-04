( function ( $ ) {



    "use strict";

    var base_url = $('#base_url').val();



    if( $.isFunction($.fn.DataTable) )

    {



        /*

        * Kota

        */



        var dataTable = $('#kota').DataTable( {

            "serverSide": true,

            "stateSave" : false,

            "bAutoWidth": true,

            "oLanguage": {

                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",

                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"customer/tambah-kota' class='btn btn-danger waves-effect waves-light ml-3' id='add-kota'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",

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

                url : base_url+"customer/kota-json",

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

        * Kecamatan

        */



        var dataTable = $('#kecamatan').DataTable( {

            "serverSide": true,

            "stateSave" : false,

            "bAutoWidth": true,

            "oLanguage": {

                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",

                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"customer/tambah-kecamatan' class='btn btn-danger waves-effect waves-light ml-3' id='add-kecamatan'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",

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

                url : base_url+"customer/kecamatan-json",

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

        * Desa

        */



        var dataTable = $('#desa').DataTable( {

            "serverSide": true,

            "stateSave" : false,

            "bAutoWidth": true,

            "oLanguage": {

                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",

                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"customer/tambah-desa' class='btn btn-danger waves-effect waves-light ml-3' id='add-desa'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",

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

                url : base_url+"customer/desa-json",

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

        var dataTable = $('#cat-datatable').DataTable( {
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"customer/tambah-category' class='btn btn-danger waves-effect waves-light ml-3' id='TambahCat'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
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
                url : base_url+"customer/category-json",
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

        $(document).on('click', '#TambahCat, #EditCat', function(e){

            e.preventDefault();

            var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SimpanCat'>Save</button>";
            Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

            $('.modal-dialog').removeClass('modal-sm');
            $('.modal-dialog').removeClass('modal-full-widt');
            $('.modal-dialog').addClass('modal-lg');

            if($(this).attr('id') == 'TambahCat')
            {
                $('#ModalHeader').html('Add New Category');
            }
            
            if($(this).attr('id') == 'EditCat')
            {
                $('#ModalHeader').html('Edit Category');
            }

            $('#ModalContent').load($(this).attr('href'));
            $('#ModalGue').modal('show');
            $('#ModalFooter').html(Tombol);

            $('.currency').autoNumeric('init', {
                aSep: '.',
                aDec: ','
            });
        });

        $(document).on('click', '#SimpanCat', function(e){

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
                            $('#SimpanCat').html("Saving, please wait ...");
                        },
                        success: function(json){
                            if(json.status == 1){ 
                                $('.modal-dialog').removeClass('modal-lg');
                                $('.modal-dialog').addClass('modal-sm');
                                $('#ModalHeader').html('Success !');
                                $('#ModalContent').html(json.pesan);
                                $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                                $('#ModalGue').modal('show');
                                $('#cat-datatable').DataTable().ajax.reload( null, false );
                            }
                            else {
                                $('#ResponseInput').html(json.pesan);
                            }

                            $('#SimpanCat').html('Save');
                        }
                    });
                }
                else
                {
                    $('#ResponseInput').html('');
                }
            }

        });

        $(document).on('submit', '.tambah-category', function(e){

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
                            $('#SimpanCat').html("Saving, please wait ...");
                        },
                        success: function(json){
                            if(json.status == 1){ 
                                $('.modal-dialog').removeClass('modal-lg');
                                $('.modal-dialog').addClass('modal-sm');
                                $('#ModalHeader').html('Success !');
                                $('#ModalContent').html(json.pesan);
                                $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                                $('#ModalGue').modal('show');
                                $('#cat-datatable').DataTable().ajax.reload( null, false );
                            }
                            else {
                                $('#ResponseInput').html(json.pesan);
                            }

                            $('#SimpanCat').html('Save');
                        }
                    });
                }
                else
                {
                    $('#ResponseInput').html('');
                }
            }
        });

        var dataTable = $('#jenis-datatable').DataTable( {
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"customer/tambah-jenis' class='btn btn-danger waves-effect waves-light ml-3' id='TambahJenis'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
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
                url : base_url+"customer/jenis-json",
                type: "post",
                error: function(){ 
                    $(".jenis-datatable-error").html("");
                    $("#jenis-datatable").append('<tbody class="jenis-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#jenis-datatable_processing").css("display","none");
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

        $(document).on('click', '#TambahJenis, #EditJenis', function(e){

            e.preventDefault();

            var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SimpanJenis'>Save</button>";
            Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

            $('.modal-dialog').removeClass('modal-sm');
            $('.modal-dialog').removeClass('modal-full-widt');
            $('.modal-dialog').addClass('modal-lg');

            if($(this).attr('id') == 'TambahJenis')
            {
                $('#ModalHeader').html('Add New Jenis');
            }
            
            if($(this).attr('id') == 'EditJenis')
            {
                $('#ModalHeader').html('Edit Jenis');
            }

            $('#ModalContent').load($(this).attr('href'));
            $('#ModalGue').modal('show');
            $('#ModalFooter').html(Tombol);

            $('.currency').autoNumeric('init', {
                aSep: '.',
                aDec: ','
            });
        });

        $(document).on('click', '#SimpanJenis', function(e){

            e.preventDefault();

            if($(this).hasClass('disabled'))
            {
                return false;
            }
            else
            {
                if($('.tambah-jenis').serialize() !== '')
                {
                    $.ajax({
                        url: $('.tambah-jenis').attr('action'),
                        type: "POST",
                        cache: false,
                        data: $('.tambah-jenis').serialize(),
                        dataType:'json',
                        beforeSend:function(){
                            $('#SimpanJenis').html("Saving, please wait ...");
                        },
                        success: function(json){
                            if(json.status == 1){ 
                                $('.modal-dialog').removeClass('modal-lg');
                                $('.modal-dialog').addClass('modal-sm');
                                $('#ModalHeader').html('Success !');
                                $('#ModalContent').html(json.pesan);
                                $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                                $('#ModalGue').modal('show');
                                $('#jenis-datatable').DataTable().ajax.reload( null, false );
                            }
                            else {
                                $('#ResponseInput').html(json.pesan);
                            }

                            $('#SimpanJenis').html('Save');
                        }
                    });
                }
                else
                {
                    $('#ResponseInput').html('');
                }
            }

        });

        $(document).on('submit', '.tambah-jenis', function(e){

            e.preventDefault();

            if($(this).hasClass('disabled'))
            {
                return false;
            }
            else
            {
                if($('.tambah-jenis').serialize() !== '')
                {
                    $.ajax({
                        url: $('.tambah-jenis').attr('action'),
                        type: "POST",
                        cache: false,
                        data: $('.tambah-jenis').serialize(),
                        dataType:'json',
                        beforeSend:function(){
                            $('#SimpanJenis').html("Saving, please wait ...");
                        },
                        success: function(json){
                            if(json.status == 1){ 
                                $('.modal-dialog').removeClass('modal-lg');
                                $('.modal-dialog').addClass('modal-sm');
                                $('#ModalHeader').html('Success !');
                                $('#ModalContent').html(json.pesan);
                                $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                                $('#ModalGue').modal('show');
                                $('#jenis-datatable').DataTable().ajax.reload( null, false );
                            }
                            else {
                                $('#ResponseInput').html(json.pesan);
                            }

                            $('#SimpanJenis').html('Save');
                        }
                    });
                }
                else
                {
                    $('#ResponseInput').html('');
                }
            }
        });

        var dataTable = $('#merk-datatable').DataTable( {
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"customer/tambah-merk' class='btn btn-danger waves-effect waves-light ml-3' id='TambahMerk'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
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
                url : base_url+"customer/merk-json",
                type: "post",
                error: function(){ 
                    $(".merk-datatable-error").html("");
                    $("#merk-datatable").append('<tbody class="merk-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#merk-datatable_processing").css("display","none");
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

        $(document).on('click', '#TambahMerk, #EditMerk', function(e){

            e.preventDefault();

            var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SimpanMerk'>Save</button>";
            Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

            $('.modal-dialog').removeClass('modal-sm');
            $('.modal-dialog').removeClass('modal-full-widt');
            $('.modal-dialog').addClass('modal-lg');

            if($(this).attr('id') == 'TambahMerk')
            {
                $('#ModalHeader').html('Add New Merk');
            }
            
            if($(this).attr('id') == 'EditMerk')
            {
                $('#ModalHeader').html('Edit Merk');
            }

            $('#ModalContent').load($(this).attr('href'));
            $('#ModalGue').modal('show');
            $('#ModalFooter').html(Tombol);

            $('.currency').autoNumeric('init', {
                aSep: '.',
                aDec: ','
            });
        });

        $(document).on('click', '#SimpanMerk', function(e){

            e.preventDefault();

            if($(this).hasClass('disabled'))
            {
                return false;
            }
            else
            {
                if($('.tambah-merk').serialize() !== '')
                {
                    $.ajax({
                        url: $('.tambah-merk').attr('action'),
                        type: "POST",
                        cache: false,
                        data: $('.tambah-merk').serialize(),
                        dataType:'json',
                        beforeSend:function(){
                            $('#SimpanMerk').html("Saving, please wait ...");
                        },
                        success: function(json){
                            if(json.status == 1){ 
                                $('.modal-dialog').removeClass('modal-lg');
                                $('.modal-dialog').addClass('modal-sm');
                                $('#ModalHeader').html('Success !');
                                $('#ModalContent').html(json.pesan);
                                $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                                $('#ModalGue').modal('show');
                                $('#merk-datatable').DataTable().ajax.reload( null, false );
                            }
                            else {
                                $('#ResponseInput').html(json.pesan);
                            }

                            $('#SimpanMerk').html('Save');
                        }
                    });
                }
                else
                {
                    $('#ResponseInput').html('');
                }
            }

        });

        $(document).on('submit', '.tambah-merk', function(e){

            e.preventDefault();

            if($(this).hasClass('disabled'))
            {
                return false;
            }
            else
            {
                if($('.tambah-merk').serialize() !== '')
                {
                    $.ajax({
                        url: $('.tambah-merk').attr('action'),
                        type: "POST",
                        cache: false,
                        data: $('.tambah-merk').serialize(),
                        dataType:'json',
                        beforeSend:function(){
                            $('#SimpanMerk').html("Saving, please wait ...");
                        },
                        success: function(json){
                            if(json.status == 1){ 
                                $('.modal-dialog').removeClass('modal-lg');
                                $('.modal-dialog').addClass('modal-sm');
                                $('#ModalHeader').html('Success !');
                                $('#ModalContent').html(json.pesan);
                                $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                                $('#ModalGue').modal('show');
                                $('#merk-datatable').DataTable().ajax.reload( null, false );
                            }
                            else {
                                $('#ResponseInput').html(json.pesan);
                            }

                            $('#SimpanMerk').html('Save');
                        }
                    });
                }
                else
                {
                    $('#ResponseInput').html('');
                }
            }
        });

        var dataTable = $('#type-datatable').DataTable( {
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"customer/tambah-type' class='btn btn-danger waves-effect waves-light ml-3' id='TambahType'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
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
                url : base_url+"customer/type-json",
                type: "post",
                error: function(){ 
                    $(".type-datatable-error").html("");
                    $("#type-datatable").append('<tbody class="type-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#type-datatable_processing").css("display","none");
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

        $(document).on('click', '#TambahType, #EditType', function(e){

            e.preventDefault();

            var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SimpanType'>Save</button>";
            Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

            $('.modal-dialog').removeClass('modal-sm');
            $('.modal-dialog').removeClass('modal-full-widt');
            $('.modal-dialog').addClass('modal-lg');

            if($(this).attr('id') == 'TambahType')
            {
                $('#ModalHeader').html('Add New Type');
            }
            
            if($(this).attr('id') == 'EditType')
            {
                $('#ModalHeader').html('Edit Type');
            }

            $('#ModalContent').load($(this).attr('href'));
            $('#ModalGue').modal('show');
            $('#ModalFooter').html(Tombol);

            $('.currency').autoNumeric('init', {
                aSep: '.',
                aDec: ','
            });
        });

        $(document).on('click', '#SimpanType', function(e){

            e.preventDefault();

            if($(this).hasClass('disabled'))
            {
                return false;
            }
            else
            {
                if($('.tambah-type').serialize() !== '')
                {
                    $.ajax({
                        url: $('.tambah-type').attr('action'),
                        type: "POST",
                        cache: false,
                        data: $('.tambah-type').serialize(),
                        dataType:'json',
                        beforeSend:function(){
                            $('#SimpanType').html("Saving, please wait ...");
                        },
                        success: function(json){
                            if(json.status == 1){ 
                                $('.modal-dialog').removeClass('modal-lg');
                                $('.modal-dialog').addClass('modal-sm');
                                $('#ModalHeader').html('Success !');
                                $('#ModalContent').html(json.pesan);
                                $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                                $('#ModalGue').modal('show');
                                $('#type-datatable').DataTable().ajax.reload( null, false );
                            }
                            else {
                                $('#ResponseInput').html(json.pesan);
                            }

                            $('#SimpanType').html('Save');
                        }
                    });
                }
                else
                {
                    $('#ResponseInput').html('');
                }
            }

        });

        $(document).on('submit', '.tambah-type', function(e){

            e.preventDefault();

            if($(this).hasClass('disabled'))
            {
                return false;
            }
            else
            {
                if($('.tambah-type').serialize() !== '')
                {
                    $.ajax({
                        url: $('.tambah-type').attr('action'),
                        type: "POST",
                        cache: false,
                        data: $('.tambah-type').serialize(),
                        dataType:'json',
                        beforeSend:function(){
                            $('#SimpanType').html("Saving, please wait ...");
                        },
                        success: function(json){
                            if(json.status == 1){ 
                                $('.modal-dialog').removeClass('modal-lg');
                                $('.modal-dialog').addClass('modal-sm');
                                $('#ModalHeader').html('Success !');
                                $('#ModalContent').html(json.pesan);
                                $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                                $('#ModalGue').modal('show');
                                $('#type-datatable').DataTable().ajax.reload( null, false );
                            }
                            else {
                                $('#ResponseInput').html(json.pesan);
                            }

                            $('#SimpanType').html('Save');
                        }
                    });
                }
                else
                {
                    $('#ResponseInput').html('');
                }
            }
        });

        var dataTable = $('#warna-datatable').DataTable( {
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"customer/tambah-warna' class='btn btn-danger waves-effect waves-light ml-3' id='TambahWarna'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
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
            "sPaginationWarna": "simple_numbers", 
            "iDisplayLength": 10,
            "aLengthMenu": [[10, 20, 50, 100, 150], [10, 20, 50, 100, 150]],
            "ajax":{
                url : base_url+"customer/warna-json",
                type: "post",
                error: function(){ 
                    $(".warna-datatable-error").html("");
                    $("#warna-datatable").append('<tbody class="warna-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#warna-datatable_processing").css("display","none");
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

        $(document).on('click', '#TambahWarna, #EditWarna', function(e){

            e.preventDefault();

            var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SimpanWarna'>Save</button>";
            Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

            $('.modal-dialog').removeClass('modal-sm');
            $('.modal-dialog').removeClass('modal-full-widt');
            $('.modal-dialog').addClass('modal-lg');

            if($(this).attr('id') == 'TambahWarna')
            {
                $('#ModalHeader').html('Add New Category');
            }
            
            if($(this).attr('id') == 'EditWarna')
            {
                $('#ModalHeader').html('Edit Category');
            }

            $('#ModalContent').load($(this).attr('href'));
            $('#ModalGue').modal('show');
            $('#ModalFooter').html(Tombol);

            $('.currency').autoNumeric('init', {
                aSep: '.',
                aDec: ','
            });
        });

        $(document).on('click', '#SimpanWarna', function(e){

            e.preventDefault();

            if($(this).hasClass('disabled'))
            {
                return false;
            }
            else
            {
                if($('.tambah-warna').serialize() !== '')
                {
                    $.ajax({
                        url: $('.tambah-warna').attr('action'),
                        type: "POST",
                        cache: false,
                        data: $('.tambah-warna').serialize(),
                        dataType:'json',
                        beforeSend:function(){
                            $('#SimpanWarna').html("Saving, please wait ...");
                        },
                        success: function(json){
                            if(json.status == 1){ 
                                $('.modal-dialog').removeClass('modal-lg');
                                $('.modal-dialog').addClass('modal-sm');
                                $('#ModalHeader').html('Success !');
                                $('#ModalContent').html(json.pesan);
                                $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                                $('#ModalGue').modal('show');
                                $('#warna-datatable').DataTable().ajax.reload( null, false );
                            }
                            else {
                                $('#ResponseInput').html(json.pesan);
                            }

                            $('#SimpanWarna').html('Save');
                        }
                    });
                }
                else
                {
                    $('#ResponseInput').html('');
                }
            }

        });

        $(document).on('submit', '.tambah-warna', function(e){

            e.preventDefault();

            if($(this).hasClass('disabled'))
            {
                return false;
            }
            else
            {
                if($('.tambah-warna').serialize() !== '')
                {
                    $.ajax({
                        url: $('.tambah-warna').attr('action'),
                        type: "POST",
                        cache: false,
                        data: $('.tambah-warna').serialize(),
                        dataType:'json',
                        beforeSend:function(){
                            $('#SimpanWarna').html("Saving, please wait ...");
                        },
                        success: function(json){
                            if(json.status == 1){ 
                                $('.modal-dialog').removeClass('modal-lg');
                                $('.modal-dialog').addClass('modal-sm');
                                $('#ModalHeader').html('Success !');
                                $('#ModalContent').html(json.pesan);
                                $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                                $('#ModalGue').modal('show');
                                $('#warna-datatable').DataTable().ajax.reload( null, false );
                            }
                            else {
                                $('#ResponseInput').html(json.pesan);
                            }

                            $('#SimpanWarna').html('Save');
                        }
                    });
                }
                else
                {
                    $('#ResponseInput').html('');
                }
            }
        });

        var dataTable = $('#unit-datatable').DataTable( {
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"customer/tambah-unit' class='btn btn-danger waves-effect waves-light ml-3' id='TambahUnit'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
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
            "sPaginationUnit": "simple_numbers", 
            "iDisplayLength": 10,
            "aLengthMenu": [[10, 20, 50, 100, 150], [10, 20, 50, 100, 150]],
            "ajax":{
                url : base_url+"customer/unit-json",
                type: "post",
                error: function(){ 
                    $(".unit-datatable-error").html("");
                    $("#unit-datatable").append('<tbody class="unit-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#unit-datatable_processing").css("display","none");
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

        var Customer = $('#customer').DataTable( {
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"customer/tambah-customer' class='btn btn-danger waves-effect waves-light ml-3' id='AddCustomer'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
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
            "sPaginationUnit": "simple_numbers", 
            "iDisplayLength": 10,
            "aLengthMenu": [[10, 20, 50, 100, 150], [10, 20, 50, 100, 150]],
            "ajax":{
                url : base_url+"customer",
                type: "post",
                error: function(){ 
                    $(".customer-error").html("");
                    $("#customer").append('<tbody class="customer-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#customer_processing").css("display","none");
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

        $(document).on('click', '#AddCustomer', function(e){
            e.preventDefault()

            var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SimpanCustomer'>Save</button>";
                Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>"

            $('.modal-dialog').removeClass('modal-sm');
            $('.modal-dialog').removeClass('modal-full-width');
            $('.modal-dialog').addClass('modal-lg');

            $('#ModalHeader').html('Add/Update Customer');

            $('#ModalContent').load($(this).attr('href'));
            $('#ModalGue').modal('show');
            $('#ModalFooter').html(Tombol);
        })

        $(document).on('click', '#SimpanCustomer', function(e){

            e.preventDefault();

            if($(this).hasClass('disabled'))
            {
                return false;
            }
            else
            {
                if($('.tambah-customer').serialize() !== '')
                {
                    $.ajax({
                        url: $('.tambah-customer').attr('action'),
                        type: "POST",
                        cache: false,
                        data: $('.tambah-customer').serialize(),
                        dataType:'json',
                        beforeSend:function(){
                            $('#SimpanCustomer').html("Saving, please wait ...");
                        },
                        success: function(json){
                            if(json.status == 1){ 
                                $('#customer').DataTable({
                                    "serverSide": true,
                                    "stateSave" : false,
                                    "bAutoWidth": true,
                                    "oLanguage": {
                                        "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                                        "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"customer/tambah-customer' class='btn btn-danger waves-effect waves-light ml-3' id='AddCustomer'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
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
                                    "sPaginationUnit": "simple_numbers", 
                                    "iDisplayLength": 10,
                                    "aLengthMenu": [[10, 20, 50, 100, 150], [10, 20, 50, 100, 150]],
                                    "ajax":{
                                        url : base_url+"customer",
                                        type: "post",
                                        error: function(){ 
                                            $(".customer-error").html("");
                                            $("#customer").append('<tbody class="customer-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                                            $("#customer_processing").css("display","none");
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
                                }).ajax.reload( null, false );

                                $('#ModalGue').modal('hide')

                                Swal.fire({
                                    title: 'Success!',
                                    html: json.pesan,
                                    type: 'success'
                                })
                            }
                            else {
                                Swal.fire({
                                    title: 'Ooopss!',
                                    html: json.pesan,
                                    type: 'error'
                                })
                            }

                            $('#SimpanCustomer').html('Save');
                        }
                    });
                }
                else
                {
                    $('#ResponseInput').html('');
                }
            }

        });

        $(document).on('click', '#TambahUnit, #EditUnit', function(e){

            e.preventDefault();

            var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SimpanUnit'>Save</button>";
            Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

            $('.modal-dialog').removeClass('modal-sm');
            $('.modal-dialog').removeClass('modal-full-widt');
            $('.modal-dialog').addClass('modal-lg');

            if($(this).attr('id') == 'TambahUnit')
            {
                $('#ModalHeader').html('Add New Unit');
            }
            
            if($(this).attr('id') == 'EditUnit')
            {
                $('#ModalHeader').html('Edit Unit');
            }

            $('#ModalContent').load($(this).attr('href'));
            $('#ModalGue').modal('show');
            $('#ModalFooter').html(Tombol);

            $('.currency').autoNumeric('init', {
                aSep: '.',
                aDec: ','
            });
        });

        $(document).on('click', '#SimpanUnit', function(e){

            e.preventDefault();

            if($(this).hasClass('disabled'))
            {
                return false;
            }
            else
            {
                if($('.tambah-unit').serialize() !== '')
                {
                    $.ajax({
                        url: $('.tambah-unit').attr('action'),
                        type: "POST",
                        cache: false,
                        data: $('.tambah-unit').serialize(),
                        dataType:'json',
                        beforeSend:function(){
                            $('#SimpanUnit').html("Saving, please wait ...");
                        },
                        success: function(json){
                            if(json.status == 1){ 
                                $('.modal-dialog').removeClass('modal-lg');
                                $('.modal-dialog').addClass('modal-sm');
                                $('#ModalHeader').html('Success !');
                                $('#ModalContent').html(json.pesan);
                                $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                                $('#ModalGue').modal('show');
                                $('#unit-datatable').DataTable().ajax.reload( null, false );
                            }
                            else {
                                $('#ResponseInput').html(json.pesan);
                            }

                            $('#SimpanUnit').html('Save');
                        }
                    });
                }
                else
                {
                    $('#ResponseInput').html('');
                }
            }

        });

        $(document).on('submit', '.tambah-unit', function(e){

            e.preventDefault();

            if($(this).hasClass('disabled'))
            {
                return false;
            }
            else
            {
                if($('.tambah-unit').serialize() !== '')
                {
                    $.ajax({
                        url: $('.tambah-unit').attr('action'),
                        type: "POST",
                        cache: false,
                        data: $('.tambah-unit').serialize(),
                        dataType:'json',
                        beforeSend:function(){
                            $('#SimpanUnit').html("Saving, please wait ...");
                        },
                        success: function(json){
                            if(json.status == 1){ 
                                $('.modal-dialog').removeClass('modal-lg');
                                $('.modal-dialog').addClass('modal-sm');
                                $('#ModalHeader').html('Success !');
                                $('#ModalContent').html(json.pesan);
                                $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                                $('#ModalGue').modal('show');
                                $('#unit-datatable').DataTable().ajax.reload( null, false );
                            }
                            else {
                                $('#ResponseInput').html(json.pesan);
                            }

                            $('#SimpanUnit').html('Save');
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







