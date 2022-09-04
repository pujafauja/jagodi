( function ( $ ) {

    "use strict";

    var base_url = $('#base_url').val();

    /*
    * Sparepart
    */

    var dataTable = $('#sparepart-datatable').DataTable( {
        "serverSide": true,
        "stateSave" : false,
        "bAutoWidth": true,
        "oLanguage": {
            "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
            "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"sparepart/tambah-sparepart' class='btn btn-danger waves-effect waves-light ml-3' id='TambahSparepart'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
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
            url : base_url+"sparepart/sparepart-json",
            type: "post",
            error: function(){ 
                $(".sparepart-datatable-error").html("");
                $("#sparepart-datatable").append('<tbody class="sparepart-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                $("#sparepart-datatable_processing").css("display","none");
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

    $(document).on('click', '#TambahSparepart, #EditSparepart', function(e){

        e.preventDefault();

        var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SimpanSparepart'>Save</button>";
        Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').removeClass('modal-full-widt');
        $('.modal-dialog').addClass('modal-lg');

        if($(this).attr('id') == 'TambahSparepart')
        {
            $('#ModalHeader').html('Add/Update Part');
        }
        
        if($(this).attr('id') == 'EditSparepart')
        {
            $('#ModalHeader').html('Edit Sparepart');
        }

        $('#ModalContent').load($(this).attr('href'));
        $('#ModalGue').modal('show');
        $('#ModalFooter').html(Tombol);

        $('.currency').autoNumeric('init', {
            aSep: '.',
            aDec: ','
        });
    });

    $(document).on('click', '#SimpanSparepart', function(e){
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
                        $('#SimpanSparepart').html("Saving, please wait ...");
                    },
                    success: function(json){
                        if(json.status == 1){ 
                            $('.modal-dialog').removeClass('modal-lg');
                            $('.modal-dialog').addClass('modal-sm');
                            $('#ModalHeader').html('Success !');
                            $('#ModalContent').html(json.pesan);
                            $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                            $('#ModalGue').modal('show');
                            $('#sparepart-datatable').DataTable().ajax.reload( null, false );
                        }
                        else {
                            $('#ResponseInput').html(json.pesan);
                        }

                        $('#SimpanSparepart').html('Save');
                    }
                });
            }
            else
            {
                $('#ResponseInput').html('');
            }
        }
    });

    $(document).on('submit', '.tambah-sparepart', function(e){
        console.log('test');
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
                        $('#SimpanSparepart').html("Saving, please wait ...");
                    },
                    success: function(json){
                        if(json.status == 1){ 
                            $('.modal-dialog').removeClass('modal-lg');
                            $('.modal-dialog').addClass('modal-sm');
                            $('#ModalHeader').html('Success !');
                            $('#ModalContent').html(json.pesan);
                            $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                            $('#ModalGue').modal('show');
                            $('#sparepart-datatable').DataTable().ajax.reload( null, false );
                        }
                        else {
                            $('#ResponseInput').html(json.pesan);
                        }

                        $('#SimpanSparepart').html('Save');
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
    * ABC Category
    */

    var dataTable = $('#abc-datatable').DataTable( {
        "serverSide": true,
        "stateSave" : false,
        "bAutoWidth": true,
        "oLanguage": {
            "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
            "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"sparepart/new-abc-category' class='btn btn-danger waves-effect waves-light ml-3' id='TambahABC'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
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
            url : base_url+"sparepart/abc-json",
            type: "post",
            error: function(){ 
                $(".abc-datatable-error").html("");
                $("#abc-datatable").append('<tbody class="abc-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                $("#abc-datatable_processing").css("display","none");
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

    $(document).on('click', '#TambahABC, #EditABC', function(e){

        e.preventDefault();

        var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SimpanABC'>Save</button>";
        Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').removeClass('modal-full-widt');
        $('.modal-dialog').addClass('modal-lg');

        $('#ModalHeader').html('Add/Update ABC Category');

        $('#ModalContent').load($(this).attr('href'));
        $('#ModalGue').modal('show');
        $('#ModalFooter').html(Tombol);
    });

    $(document).on('click', '#SimpanABC', function(e){
        e.preventDefault();

        if($(this).hasClass('disabled'))
        {
            return false;
        }
        else
        {
            if($('.tambah-abc').serialize() !== '')
            {
                $.ajax({
                    url: $('.tambah-abc').attr('action'),
                    type: "POST",
                    cache: false,
                    data: $('.tambah-abc').serialize(),
                    dataType:'json',
                    beforeSend:function(){
                        $('#SimpanABC').html("Saving, please wait ...");
                    },
                    success: function(json){
                        if(json.status == 1){ 
                            $('#ModalGue').modal('hide');
                            Swal.fire({
                                title: "Success!",
                                html: json.pesan,
                                type: "success"
                            })
                            $('#abc-datatable').DataTable().ajax.reload( null, false );
                        }
                        else {
                            $('#ResponseInput').html(json.pesan);
                        }

                        $('#SimpanABC').html('Save');
                    }
                });
            }
            else
            {
                $('#ResponseInput').html('');
            }
        }
    });

    $(document).on('submit', '.tambah-abc', function(e){
        console.log('test');
        e.preventDefault();

        if($(this).hasClass('disabled'))
        {
            return false;
        }
        else
        {
            if($('.tambah-abc').serialize() !== '')
            {
                $.ajax({
                    url: $('.tambah-abc').attr('action'),
                    type: "POST",
                    cache: false,
                    data: $('.tambah-abc').serialize(),
                    dataType:'json',
                    beforeSend:function(){
                        $('#SimpanABC').html("Saving, please wait ...");
                    },
                    success: function(json){
                        if(json.status == 1){ 
                            $('#ModalGue').modal('hide');
                            Swal.fire({
                                title: "Success!",
                                html: json.pesan,
                                type: "success"
                            })
                            $('#abc-datatable').DataTable().ajax.reload( null, false );
                        }
                        else {
                            $('#ResponseInput').html(json.pesan);
                        }

                        $('#SimpanABC').html('Save');
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
    * Supplier
    */

    var dataTable = $('#supplier-datatable').DataTable( {
        "serverSide": true,
        "stateSave" : false,
        "bAutoWidth": true,
        "oLanguage": {
            "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
            "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"sparepart/tambah-supplier' class='btn btn-danger waves-effect waves-light ml-3' id='TambahSupplier'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
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
            url : base_url+"sparepart/supplier-json",
            type: "post",
            error: function(){ 
                $(".supplier-datatable-error").html("");
                $("#supplier-datatable").append('<tbody class="supplier-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                $("#supplier-datatable_processing").css("display","none");
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

    $(document).on('click', '#TambahSupplier, #EditSupplier', function(e){

        e.preventDefault();

        var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SimpanSupplier'>Save</button>";
        Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').removeClass('modal-full-widt');
        $('.modal-dialog').addClass('modal-lg');

        if($(this).attr('id') == 'TambahSupplier')
        {
            $('#ModalHeader').html('Add/Update Supplier');
        }
        
        if($(this).attr('id') == 'EditSupplier')
        {
            $('#ModalHeader').html('Edit Supplier');
        }

        $('#ModalContent').load($(this).attr('href'));
        $('#ModalGue').modal('show');
        $('#ModalFooter').html(Tombol);

        $('.currency').autoNumeric('init', {
            aSep: '.',
            aDec: ','
        });
    });

    $(document).on('click', '#SimpanSupplier', function(e){
        e.preventDefault();

        if($(this).hasClass('disabled'))
        {
            return false;
        }
        else
        {
            if($('.tambah-supplier').serialize() !== '')
            {
                $.ajax({
                    url: $('.tambah-supplier').attr('action'),
                    type: "POST",
                    cache: false,
                    data: $('.tambah-supplier').serialize(),
                    dataType:'json',
                    beforeSend:function(){
                        $('#SimpanSupplier').html("Saving, please wait ...");
                    },
                    success: function(json){
                        if(json.status == 1){ 
                            $('.modal-dialog').removeClass('modal-lg');
                            $('.modal-dialog').addClass('modal-sm');
                            $('#ModalHeader').html('Success !');
                            $('#ModalContent').html(json.pesan);
                            $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                            $('#ModalGue').modal('show');
                            $('#supplier-datatable').DataTable().ajax.reload( null, false );
                        }
                        else {
                            $('#ResponseInput').html(json.pesan);
                        }

                        $('#SimpanSupplier').html('Save');
                    }
                });
            }
            else
            {
                $('#ResponseInput').html('');
            }
        }
    });

    $(document).on('submit', '.tambah-supplier', function(e){
        console.log('test');
        e.preventDefault();

        if($(this).hasClass('disabled'))
        {
            return false;
        }
        else
        {
            if($('.tambah-supplier').serialize() !== '')
            {
                $.ajax({
                    url: $('.tambah-supplier').attr('action'),
                    type: "POST",
                    cache: false,
                    data: $('.tambah-supplier').serialize(),
                    dataType:'json',
                    beforeSend:function(){
                        $('#SimpanSupplier').html("Saving, please wait ...");
                    },
                    success: function(json){
                        if(json.status == 1){ 
                            $('.modal-dialog').removeClass('modal-lg');
                            $('.modal-dialog').addClass('modal-sm');
                            $('#ModalHeader').html('Success !');
                            $('#ModalContent').html(json.pesan);
                            $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                            $('#ModalGue').modal('show');
                            $('#supplier-datatable').DataTable().ajax.reload( null, false );
                        }
                        else {
                            $('#ResponseInput').html(json.pesan);
                        }

                        $('#SimpanSupplier').html('Save');
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
    * Location
    */

    var dataTable = $('#location-datatable').DataTable( {
        "serverSide": true,
        "stateSave" : false,
        "bAutoWidth": true,
        "oLanguage": {
            "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
            "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"sparepart/tambah-location' class='btn btn-danger waves-effect waves-light ml-3' id='TambahLocation'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
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
            url : base_url+"sparepart/location-json",
            type: "post",
            error: function(){ 
                $(".location-datatable-error").html("");
                $("#location-datatable").append('<tbody class="location-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                $("#location-datatable_processing").css("display","none");
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

    $(document).on('click', '#TambahLocation, #EditLocation', function(e){

        e.preventDefault();

        var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SimpanLocation'>Save</button>";
        Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').removeClass('modal-full-widt');
        $('.modal-dialog').addClass('modal-lg');

        if($(this).attr('id') == 'TambahLocation')
        {
            $('#ModalHeader').html('Add New Location');
        }
        
        if($(this).attr('id') == 'EditLocation')
        {
            $('#ModalHeader').html('Edit Location');
        }

        $('#ModalContent').load($(this).attr('href'));
        $('#ModalGue').modal('show');
        $('#ModalFooter').html(Tombol);

        $('.currency').autoNumeric('init', {
            aSep: '.',
            aDec: ','
        });
    });

    $(document).on('click', '#SimpanLocation', function(e){
        e.preventDefault();

        if($(this).hasClass('disabled'))
        {
            return false;
        }
        else
        {
            if($('.tambah-location').serialize() !== '')
            {
                $.ajax({
                    url: $('.tambah-location').attr('action'),
                    type: "POST",
                    cache: false,
                    data: $('.tambah-location').serialize(),
                    dataType:'json',
                    beforeSend:function(){
                        $('#SimpanLocation').html("Saving, please wait ...");
                    },
                    success: function(json){
                        if(json.status == 1){ 
                            $('.modal-dialog').removeClass('modal-lg');
                            $('.modal-dialog').addClass('modal-sm');
                            $('#ModalHeader').html('Success !');
                            $('#ModalContent').html(json.pesan);
                            $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                            $('#ModalGue').modal('show');
                            $('#location-datatable').DataTable().ajax.reload( null, false );
                        }
                        else {
                            $('#ResponseInput').html(json.pesan);
                        }

                        $('#SimpanLocation').html('Save');
                    }
                });
            }
            else
            {
                $('#ResponseInput').html('');
            }
        }
    });

    $(document).on('submit', '.tambah-location', function(e){
        console.log('test');
        e.preventDefault();

        if($(this).hasClass('disabled'))
        {
            return false;
        }
        else
        {
            if($('.tambah-location').serialize() !== '')
            {
                $.ajax({
                    url: $('.tambah-location').attr('action'),
                    type: "POST",
                    cache: false,
                    data: $('.tambah-location').serialize(),
                    dataType:'json',
                    beforeSend:function(){
                        $('#SimpanLocation').html("Saving, please wait ...");
                    },
                    success: function(json){
                        if(json.status == 1){ 
                            $('.modal-dialog').removeClass('modal-lg');
                            $('.modal-dialog').addClass('modal-sm');
                            $('#ModalHeader').html('Success !');
                            $('#ModalContent').html(json.pesan);
                            $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                            $('#ModalGue').modal('show');
                            $('#location-datatable').DataTable().ajax.reload( null, false );
                        }
                        else {
                            $('#ResponseInput').html(json.pesan);
                        }

                        $('#SimpanLocation').html('Save');
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
    * Penjualan
    */

    var dataTable = $('#penjualan-datatable').DataTable( {
        "serverSide": true,
        "stateSave" : false,
        "bAutoWidth": true,
        "oLanguage": {
            "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
            "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"sparepart/tambah-penjualan' class='btn btn-danger waves-effect waves-light ml-3' id='TambahPenjualan'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
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
            url : base_url+"sparepart/penjualan-json",
            type: "post",
            error: function(){ 
                $(".penjualan-datatable-error").html("");
                $("#penjualan-datatable").append('<tbody class="penjualan-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                $("#penjualan-datatable_processing").css("display","none");
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

    $(document).on('click', '#TambahPenjualan, #EditPenjualan', function(e){

        e.preventDefault();

        var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SimpanPenjualan'>Save</button>";
        Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').removeClass('modal-full-widt');
        $('.modal-dialog').addClass('modal-lg');

        if($(this).attr('id') == 'TambahPenjualan')
        {
            $('#ModalHeader').html('Add New Special Price');
        }
        
        if($(this).attr('id') == 'EditPenjualan')
        {
            $('#ModalHeader').html('Edit Special Price');
        }

        $('#ModalContent').load($(this).attr('href'));
        $('#ModalGue').modal('show');
        $('#ModalFooter').html(Tombol);

        $('.currency').autoNumeric('init', {
            aSep: '.',
            aDec: ','
        });
    });

    $(document).on('click', '#SimpanPenjualan', function(e){
        e.preventDefault();

        if($(this).hasClass('disabled'))
        {
            return false;
        }
        else
        {
            if($('.tambah-penjualan').serialize() !== '')
            {
                $.ajax({
                    url: $('.tambah-penjualan').attr('action'),
                    type: "POST",
                    cache: false,
                    data: $('.tambah-penjualan').serialize(),
                    dataType:'json',
                    beforeSend:function(){
                        $('#SimpanPenjualan').html("Saving, please wait ...");
                    },
                    success: function(json){
                        if(json.status == 1){ 
                            $('.modal-dialog').removeClass('modal-lg');
                            $('.modal-dialog').addClass('modal-sm');
                            $('#ModalHeader').html('Success !');
                            $('#ModalContent').html(json.pesan);
                            $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                            $('#ModalGue').modal('show');
                            $('#penjualan-datatable').DataTable().ajax.reload( null, false );
                        }
                        else {
                            $('#ResponseInput').html(json.pesan);
                        }

                        $('#SimpanPenjualan').html('Save');
                    }
                });
            }
            else
            {
                $('#ResponseInput').html('');
            }
        }
    });

    $(document).on('submit', '.tambah-penjualan', function(e){
        console.log('test');
        e.preventDefault();

        if($(this).hasClass('disabled'))
        {
            return false;
        }
        else
        {
            if($('.tambah-penjualan').serialize() !== '')
            {
                $.ajax({
                    url: $('.tambah-penjualan').attr('action'),
                    type: "POST",
                    cache: false,
                    data: $('.tambah-penjualan').serialize(),
                    dataType:'json',
                    beforeSend:function(){
                        $('#SimpanPenjualan').html("Saving, please wait ...");
                    },
                    success: function(json){
                        if(json.status == 1){ 
                            $('.modal-dialog').removeClass('modal-lg');
                            $('.modal-dialog').addClass('modal-sm');
                            $('#ModalHeader').html('Success !');
                            $('#ModalContent').html(json.pesan);
                            $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                            $('#ModalGue').modal('show');
                            $('#penjualan-datatable').DataTable().ajax.reload( null, false );
                        }
                        else {
                            $('#ResponseInput').html(json.pesan);
                        }

                        $('#SimpanPenjualan').html('Save');
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
    * Category
    */

    var dataTable = $('#cat-datatable').DataTable( {
        "serverSide": true,
        "stateSave" : false,
        "bAutoWidth": true,
        "oLanguage": {
            "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
            "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"sparepart/tambah-category' class='btn btn-danger waves-effect waves-light ml-3' id='TambahCat'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
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
            url : base_url+"sparepart/category-json",
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

        var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SimpanCategory'>Save</button>";
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
    });

    $(document).on('click', '#SimpanCategory', function(e){
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
                        $('#SimpanCategory').html("Saving, please wait ...");
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

                        $('#SimpanCategory').html('Save');
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
                        $('#SimpanCategory').html("Saving, please wait ...");
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

                        $('#SimpanCategory').html('Save');
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
    * Merk
    */

    var dataTable = $('#merk-datatable').DataTable( {
        "serverSide": true,
        "stateSave" : false,
        "bAutoWidth": true,
        "oLanguage": {
            "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
            "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"sparepart/tambah-merk' class='btn btn-danger waves-effect waves-light ml-3' id='Tambah'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
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
            url : base_url+"sparepart/merk-json",
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

    $(document).on('click', '#Tambah, #Edit', function(e){

        e.preventDefault();

        var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SimpanMerk'>Save</button>";
        Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').removeClass('modal-full-widt');
        $('.modal-dialog').addClass('modal-lg');

        if($(this).attr('id') == 'Tambah')
        {
            $('#ModalHeader').html('Add New Merk');
        }
        
        if($(this).attr('id') == 'Edit')
        {
            $('#ModalHeader').html('Edit Merk');
        }

        $('#ModalContent').load($(this).attr('href'));
        $('#ModalGue').modal('show');
        $('#ModalFooter').html(Tombol);
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

    $(document).on('click', '#choose', function(e){
        e.preventDefault();

        var id    = $(this).data('id');
        var value = $(this).data('value');

        $('input[name="partid"]').val(id);
        $('input[name="part"]').val(value);

        $('#PopupGue').modal('hide');
    })

    //budgeting

      var dataTable = $('#budgeting-datatable').DataTable( {
        "serverSide": true,
        "stateSave" : false,
        "bAutoWidth": true,
        "oLanguage": {
            "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ", 
            "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"Sparepart/tambah_budgeting' class='btn btn-danger waves-effect waves-light ml-3' id='TambahItem'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
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
            url : base_url+"sparepart/budgeting-json",
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
    }); 


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
                                    window.location.href = base_url+'Sparepart/budgeting';
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
                                window.location.href = base_url+'/Sparepart/budgeting';
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

      var dataTable = $('#tradein-datatable').DataTable( {
        "serverSide": true,
        "stateSave" : false,
        "bAutoWidth": true,
        "oLanguage": {
            "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
            "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"sparepart/tambah-tradein' class='btn btn-danger waves-effect waves-light ml-3' id='TambahTradein'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
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

        $(document).on('click', '#TambahTradein, #EditSparepart', function(e){

        e.preventDefault();

        var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SimpanTradein'>Save</button>";
        Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').removeClass('modal-full-widt');
        $('.modal-dialog').addClass('modal-lg');

        if($(this).attr('id') == 'TambahTradein')
        {
            $('#ModalHeader').html('Add/Update Part');
        }
        
        if($(this).attr('id') == 'EditTradein')
        {
            $('#ModalHeader').html('Edit Tradein');
        }

        $('#ModalContent').load($(this).attr('href'));
        $('#ModalGue').modal('show');
        $('#ModalFooter').html(Tombol);

        $('.currency').autoNumeric('init', {
            aSep: '.',
            aDec: ','
        });
    });

    $(document).on('click', '#detail-sparepart', function(e){

        e.preventDefault();

        // var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SimpanTradein'>Save</button>";
        var Tombol = "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').removeClass('modal-full-widt');
        // $('.modal-dialog').addClass('modal-lg');
        $('#ModalHeader').html('Detail Sparepart');
        $('#ModalContent').load($(this).attr('href'));
        $('#ModalGue').modal('show');
        $('#ModalFooter').html(Tombol);
    });

    $(document).on('click', '#SimpanTradein', function(e){
        e.preventDefault();

        if($(this).hasClass('disabled'))
        {
            return false;
        }
        else
        {
            if($('.tambah-tradein').serialize() !== '')
            {
                $.ajax({
                    url: $('.tambah-tradein').attr('action'),
                    type: "POST",
                    cache: false,
                    data: $('.tambah-tradein').serialize(),
                    dataType:'json',
                    beforeSend:function(){
                        $('#SimpanTradein').html("Saving, please wait ...");
                    },
                    success: function(json){
                        if(json.status == 1){ 
                            $('.modal-dialog').removeClass('modal-lg');
                            $('.modal-dialog').addClass('modal-sm');
                            $('#ModalHeader').html('Success !');
                            $('#ModalContent').html(json.pesan);
                            $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                            $('#ModalGue').modal('show');
                            $('#sparepart-datatable').DataTable().ajax.reload( null, false );
                        }
                        else {
                            $('#ResponseInput').html(json.pesan);
                        }

                        $('#SimpanTradein').html('Save');
                    }
                });
            }
            else
            {
                $('#ResponseInput').html('');
            }
        }
    });

    $(document).on('submit', '.tambah-tradein', function(e){
        console.log('test');
        e.preventDefault();

        if($(this).hasClass('disabled'))
        {
            return false;
        }
        else
        {
            if($('.tambah-tradein').serialize() !== '')
            {
                $.ajax({
                    url: $('.tambah-tradein').attr('action'),
                    type: "POST",
                    cache: false,
                    data: $('.tambah-tradein').serialize(),
                    dataType:'json',
                    beforeSend:function(){
                        $('#SimpanTradein').html("Saving, please wait ...");
                    },
                    success: function(json){
                        if(json.status == 1){ 
                            $('.modal-dialog').removeClass('modal-lg');
                            $('.modal-dialog').addClass('modal-sm');
                            $('#ModalHeader').html('Success !');
                            $('#ModalContent').html(json.pesan);
                            $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                            $('#ModalGue').modal('show');
                            $('#tradein-datatable').DataTable().ajax.reload( null, false );
                        }
                        else {
                            $('#ResponseInput').html(json.pesan);
                        }

                        $('#SimpanTradein').html('Save');
                    }
                });
            }
            else
            {
                $('#ResponseInput').html('');
            }
        }
    });
  

    var dataTable = $('#purchase-datatable').DataTable( {
        "serverSide": true,
        "stateSave" : false,
        "bAutoWidth": true,
        "oLanguage": {
            "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
            // "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"sparepart/tambah-sparepart' class='btn btn-danger waves-effect waves-light ml-3' id='TambahSparepart'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
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
            url : base_url+"sparepart/purchase-json",
            type: "post",
            error: function(){ 
                $(".sparepart-datatable-error").html("");
                $("#sparepart-datatable").append('<tbody class="sparepart-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                $("#sparepart-datatable_processing").css("display","none");
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

     var dataTable = $('#purchase-cancel-datatable').DataTable( {
        "serverSide": true,
        "stateSave" : false,
        "bAutoWidth": true,
        "oLanguage": {
            "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
            // "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"sparepart/tambah-sparepart' class='btn btn-danger waves-effect waves-light ml-3' id='TambahSparepart'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
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
            url : base_url+"sparepart/purchase-cancel-json",
            type: "post",
            error: function(){ 
                $(".sparepart-datatable-error").html("");
                $("#sparepart-datatable").append('<tbody class="sparepart-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                $("#sparepart-datatable_processing").css("display","none");
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




} )( jQuery );