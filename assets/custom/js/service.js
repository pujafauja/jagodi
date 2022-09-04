( function ( $ ) {
    

    "use strict";

    var base_url = $('#base_url').val();

    /*
    * Jasa
    */
    var spktable = $('#spk-datatable').DataTable({
        "serverSide": true,
        "stateSave" : false,
        "bAutoWidth": true,
        "oLanguage": {
            "sSearch": "<a href='"+base_url+"service/import' class='btn btn-success waves-effect waves-light mr-3' id='import'><i class='mdi mdi-plus'></i> Import</a><i class='fa fa-search fa-fw'></i> Search : ",
            "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"service/tambah-jasa' class='btn btn-danger waves-effect waves-light ml-3' id='TambahJasa'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><a href='"+base_url+"service/tambah-group' class='btn btn-primary waves-effect waves-light ml-1' id='TambahGroup'><i class='mdi mdi-plus-circle mr-1'></i> Add New Group</a><span id='Notifikasi' style='display: none;'></span>",
            // "sInfoFiltered": "(difilter dari _MAX_ total data)", 
            // "sZeroRecords": "Pencarian tidak ditemukan", 
            "sEmptyTable": "Data Empty", 
            "sLoadingRecords": "Loading ... Please wait !", 
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
            url : base_url+"service/jasa-json",
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

    })

    $(document).on('change', '#typePrice', function(event) {
        event.preventDefault();
        $(document).on('change', '#typePrice', function(event) {
            event.preventDefault();
            var value = $(this).val()
            $('.autonumber').autoNumeric('init')

            $(this).closest('td').find('div').find('input').val(value)

            // console.log('new')

            cektotalpart($(this))
        });
    });
    var dataTable = $('#my-datatable').DataTable( {
        "serverSide": true,
        "stateSave" : false,
        "bAutoWidth": true,
        "oLanguage": {
            "sSearch": "<a href='"+base_url+"service/import' class='btn btn-success waves-effect waves-light mr-3' id='import'><i class='mdi mdi-plus'></i> Import</a><i class='fa fa-search fa-fw'></i> Search : ",
            "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"service/tambah-jasa' class='btn btn-danger waves-effect waves-light ml-3' id='TambahJasa'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><a href='"+base_url+"service/tambah-group' class='btn btn-primary waves-effect waves-light ml-1' id='TambahGroup'><i class='mdi mdi-plus-circle mr-1'></i> Add New Group</a><span id='Notifikasi' style='display: none;'></span>",
            // "sInfoFiltered": "(difilter dari _MAX_ total data)", 
            // "sZeroRecords": "Pencarian tidak ditemukan", 
            "sEmptyTable": "Data Empty", 
            "sLoadingRecords": "Loading ... Please wait !", 
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
            url : base_url+"service/jasa-json",
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

    $(document).on('click', '#import', function(e){
        e.preventDefault();

        var tombol = "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').removeClass('modal-lg');
        $('.modal-dialog').addClass('modal-full-width');

        $('#ModalHeader').html('Import Jasa');
        $('#ModalContent').load($(this).attr('href'));
        $('#ModalFooter').html(tombol);
        $('#ModalGue').modal('show');

    })

    $(document).on('click', '#TambahJasa, #EditJasa, #TambahGroup, #EditGroup', function(e){

        e.preventDefault();

        var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SimpanJasa'>Save</button>";
        Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').removeClass('modal-full-width');
        $('.modal-dialog').addClass('modal-lg');

        if($(this).attr('id') == 'TambahJasa')
        {
            $('.modal-dialog').removeClass('modal-sm');
            $('.modal-dialog').removeClass('modal-lg');
            $('.modal-dialog').addClass('modal-full-width');

            $('#ModalHeader').html('Tambah Jasa Baru');
        }
        
        if($(this).attr('id') == 'EditJasa')
        {
            $('.modal-dialog').removeClass('modal-sm');
            $('.modal-dialog').removeClass('modal-lg');
            $('.modal-dialog').addClass('modal-full-width');

            $('#ModalHeader').html('Edit Jasa');
        }
        
        if($(this).attr('id') == 'TambahGroup')
        {

            var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SimpanGroup'>Save</button>";
            Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

            $('#ModalHeader').html('Add New Group');
        }
        
        if($(this).attr('id') == 'EditGroup')
        {

            var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SimpanGroup'>Save</button>";
            Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

            $('#ModalHeader').html('Edit Group');
        }

        $('#ModalContent').load($(this).attr('href'));
        $('#ModalGue').modal('show');
        $('#ModalFooter').html(Tombol);

        $('.currency').autoNumeric('init', {
            aSep: '.',
            aDec: ','
        });
    });


    $(document).on('click', '.chooseGroup', function(e){
        var group     = $(this).closest('tr').find('td').eq(0).text();
        var categoryid = $('input[name=category_id]').val()
        // alert(categoryid)
        $.ajax({
            url: base_url+"service/selectservecemodal",
            type: 'post',
            dataType: 'json',
            data: {categoryid: categoryid, groupid: $(this).data('id')},
            success: function(suggestion)
            {
                var id = suggestion.id
                var isAda = true
                $('#package-table tr').each(function(index, el) {
                    if($(this).data('parent') == id){
                        isAda = false
                    }                    
                });
                if (isAda) {
                    var detail = suggestion.detail;
                    $('#package-table').append(`
                        <tr class="parent" data-parent="`+suggestion.id+`">
                            <td rowspan="${suggestion.row+1}"><i class="mr-2 closerowcat fa fa-times text-danger" data-id="${suggestion.id}"></i> ${suggestion.value}   <input type="hidden" name="service_job[]" value="${suggestion.id}"></td>
                        </tr>
                        `)
                    $.each(detail, function(index, val) {
                        $('#package-table').append(

                            `
                            <tr data-child="child-${suggestion.id}">
                                <td><i class="mr-2 fa fa-times closerow text-danger"></i> ${val.nama}    <input type="hidden" name="item_service[][${suggestion.id}]" value="${val.id}">
                                <td>Rp. <span class="autonumber" data-a-sep='.' data-a-dec="," data-m-dec="0">${val.harga}</span><input type="hidden" name="service-harga[${val.id}]" value="${val.harga}"></td>
                                <td>
                                    <input type="text" style="width: 60px !important;" name="service-qty[${val.id}]" data-id="${val.id}" value="1" class="form-qty form-control form-control-sm">
                                <td>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Rp. </div>
                                        </div>
                                        <input type="text" style="width: 120px !important;" data-a-sep='.' data-a-dec="," data-m-dec="0" name="service-disc[${val.id}]" class="form-disc form-control autonumber">
                                    </div>
                                </td>
                                <td>Rp. <span class="sellingpricejasa autonumber" data-a-sep='.' data-a-dec="," data-m-dec="0" id="sellingprice[${val.id}]">${val.harga} </span> </td>
                            </tr>
                            `
                        );
                   })
                    $('.autonumber').autoNumeric('init')

                }
            }
        })

        hitungtotal()
        $('#ModalGue').modal('hide');
    })

    $(document).on('click', '#print-summary', function(event) {
        event.preventDefault();
        var tgl = ''
        var noWo = ''
        var cst = ''
        var nominal = []
        var status = []
        $('#summary').find('tbody').find('tr').each(function(index, el) {
            tgl += '&tgl[]=' + $(this).find('td').eq(0).text()
            noWo += '&noWo[]=' + $(this).find('td').eq(1).text()
            cst += '&cst[]=' + $(this).find('td').eq(2).text()
            nominal += '&nominal[]=' + $(this).find('td').eq(3).text()
            status += '&status[]=' + $(this).find('td').eq(4).find('button').text()
        });

        var header = tgl + noWo + cst + nominal + status

        window.open(
            base_url + 'service/printsummary/?cetak=1' + header,
            'popUpWindow',
            'height=567,width=793,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')

    });

    $(document).on('click', '.choosePaket', function(e){

        $.ajax({
            url: base_url+"service/selectpaketservice",
            type: 'post',
            data: {id : $(this).data('id')},
            dataType: 'json',
            success: function(suggestion)
            {
                var id = suggestion.id
                var isAda = true
                $('#package-table tr').each(function(index, el) {
                    if($(this).data('paket') == id){
                        isAda = false
                    }                    
                });
                if(isAda)
                {

                    $('#package-table').append(

                        `
                        <tr data-paket="${suggestion.id}">
                            <td ><i class="mr-2 fa fa-times closerowpaket text-danger"></i>${suggestion.nama}    <input type="hidden" name="package-service[]" value="${suggestion.id}"></td>
                            <td>${suggestion.detail2}</td>
                            <td>Rp. <span class="autonumber" data-a-sep='.' data-a-dec="," data-m-dec="0">${suggestion.harga}</span><input type="hidden" name="package-harga[${suggestion.id}]" value="${suggestion.harga}"></td>
                            <td>
                                <input type="text" style="width: 60px !important;" name="paket-qty[${suggestion.id}]" data-id="${suggestion.id}" value="1" class="form-package-qty form-control form-control-sm">
                            <td>
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp. </div>
                                    </div>
                                    <input type="text" style="width: 60px !important;" data-a-sep='.' data-a-dec="," data-m-dec="0" name="paket-disc[${suggestion.id}]" class="form-package-disc form-control autonumber">
                                </div>
                            </td>
                            <td>Rp. <span class="autonumber sellingpricejasa" data-a-sep='.' data-a-dec="," data-m-dec="0" id="sellingprice[${suggestion.id}]">${suggestion.harga}</span> </td>
                        </tr>
                        `
                    );
                }
                $('.autonumber').autoNumeric('init')
                hitungtotal()
            }
        })
        

        $('#ModalGue').modal('hide');
    })

    $(document).on('click', '.choosePart', function(e){
        console.log('choose part')
        $.ajax({
            url: base_url+"service/selectpartsjson",
            type: 'post',
            data: {id : $(this).data('id')},
            dataType: 'json',
            success: function(suggestion)
            {
                var isAda = true
                $('#spk-parts tr').each(function(index, el) {
                    if ($(this).data('parent') == suggestion.id) {
                        isAda = false
                    }
                });
                if (isAda) {
                    var option = '<option value='+ suggestion.het +'>HET</option>'
                        option += '<option value='+ suggestion.het1 +'>H1</option>'
                        option += '<option value='+ suggestion.het2 +'>H2</option>'
                        option += '<option value='+ suggestion.het3 +'>H3</option>'
                        option += '<option value='+ suggestion.grosir +'>Grosir</option>'

                        $('#spk-parts').append(`
                            <tr data-parent="${suggestion.id}">
                                <td><i class="mr-2 fa fa-times closerowpaket text-danger"></i>${suggestion.kode}</td>

                                <td>  ${suggestion.nama} </td>
                                <td>
                                    <div class="input-group input-group-sm">
                                        <select class="form-control" style="width=20px !important" id="typePrice" name="part-harga[${suggestion.id}]">
                                            ${option}
                                        </select>
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">-</div>
                                        </div>
                                        <input type="text" data-a-sep='.' data-a-dec="," style="width=40px !important" data-m-dec="0" id="dataPrice" class="form-control autonumber" value="${suggestion.het}">
                                    </div>

                                </td>
                                <td>
                                    <input type="text" style="width: 60px !important;" class="part-qty form-control form-control-sm" value="1"  name="part-qty[${suggestion.id}]">
                                    <input type="hidden" value="${suggestion.id}" name="parts_id[]">
                                </td>
                                <td>
                                    <input type="text" style="width: 120px !important;" data-a-sep='.' data-a-dec="," data-m-dec="0" class="part-disc autonumber form-control form-control-sm" name="part-disc[${suggestion.id}]">
                                </td>
                                <td>
                                    ${suggestion.onhandqty}
                                </td>
                                <td>
                                </td>
                                <td>Rp. <span data-a-sep='.' data-a-dec="," data-m-dec="0" class="sellingpricepart autonumber" id"sellingpricepart[${suggestion.id}]">${suggestion.het}</span></td>
                            </tr>
                        `)
                    }
                    hitungtotal()
                    $(this).val('');
                    $('.autonumber').autoNumeric('init')
                }
            })
        

            $('#ModalGue').modal('hide');
        })

    $(document).on('click', '#SimpanJasa', function(e){
        e.preventDefault();

        if($(this).hasClass('disabled'))
        {
            return false;
        }
        else
        {
            if($('.tambah-jasa').serialize() !== '')
            {
                $.ajax({
                    url: $('.tambah-jasa').attr('action'),
                    type: "POST",
                    cache: false,
                    data: $('.tambah-jasa').serialize(),
                    dataType:'json',
                    beforeSend:function(){
                        $('#SimpanJasa').html("Saving, please wait ...");
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

                        $('#SimpanJasa').html('Save');
                    }
                });
            }
            else
            {
                $('#ResponseInput').html('');
            }
        }
    });

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
                            $('#my-datatable').DataTable().ajax.reload( null, false );
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

    $(document).on('submit', '.tambah-jasa', function(e){
        e.preventDefault();

        if($(this).hasClass('disabled'))
        {
            return false;
        }
        else
        {
            if($('.tambah-jasa').serialize() !== '')
            {
                $.ajax({
                    url: $('.tambah-jasa').attr('action'),
                    type: "POST",
                    cache: false,
                    data: $('.tambah-jasa').serialize(),
                    dataType:'json',
                    beforeSend:function(){
                        $('#SimpanJasa').html("Saving, please wait ...");
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

                        $('#SimpanJasa').html('Save');
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
                            $('#my-datatable').DataTable().ajax.reload( null, false );
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

    $(document).on('change', ':file', function(e){
        e.preventDefault();

        var file = this.files[0];

        $('#filename').val('');
        $('#filename').val(file.name);

        $('#response').html('');

        $('.progress').addClass('d-none');        
        $('.progress-bar').attr('aria-valuenow', 0).css('width', 0 + '%').text(0 + '%');

        var form = new FormData();
        form.append('file', file);

        $.ajax({
            url: $('#Import').attr('action'),
            type: "POST",
            cache: false,
            data: form,
            dataType:'json',
            contentType: false,
            processData: false,
            xhr : function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function(e){
                    if(e.lengthComputable){                        
                        var percent = Math.round((e.loaded / e.total) * 100);

                        $('.progress').removeClass('d-none');
                        
                        $('.progress-bar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
                    }
                });
                return xhr;
            },
            success : function(data)
            {
                $('.progress').addClass('d-none');
                if(data.status === 1)
                {
                    $('#response').html(data.pesan);
                    if(data.error > 0)
                        $('#init-import').prop('disabled', true);
                    else {
                        $('#init-import').attr('data-file', data.file_name);
                        $('#init-import').prop('disabled', false);
                    }
                }
                else
                {
                    $('#response').html(data.pesan);
                }
            }
        });

    })

    $(document).on('click', '#init-import', function(e){
        e.preventDefault();
        var filename = $(this).data('file');
        var tombol = $(this);

        if($(this).data('file'))
        {
            $.ajax({
                url: base_url + 'service/init-import',
                data: {filename : filename},
                type: 'post',
                dataType: 'json',
                beforeSend: function() {
                    tombol.html('<i class="fas fa-spinner fa-spin mr-1"></i> Importing');
                },
                success: function(s) {
                    tombol.html('<i class="mdi mdi-progress-download mr-1"></i> Import');
                    if(s.status === 1) {
                        Swal.fire({
                            title: "Imported!",
                            text: "Your file has been imported.",
                            type: "success"
                        })
                        $('#ModalGue').modal('hide');
                        window.location.href = base_url + 'service/jasa';
                    } else {
                        $('#responseImport').html(data.pesan);
                    }
                }
            })
        }
    })

    $(document).on('submit', '.tambah-jasa', function(e){
        e.preventDefault();

        if($(this).hasClass('disabled'))
        {
            return false;
        }
        else
        {
            if($('.tambah-jasa').serialize() !== '')
            {
                $.ajax({
                    url: $('.tambah-jasa').attr('action'),
                    type: "POST",
                    cache: false,
                    data: $('.tambah-jasa').serialize(),
                    dataType:'json',
                    beforeSend:function(){
                        $('#SimpanJasa').html("Saving, please wait ...");
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

                        $('#SimpanJasa').html('Save');
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
            "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"service/tambah-category' class='btn btn-danger waves-effect waves-light ml-3' id='Tambah'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
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
            url : base_url+"service/category-json",
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

    $(document).on('click', '#Tambah, #Edit', function(e){

        e.preventDefault();

        var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SimpanCategory'>Save</button>";
        Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').removeClass('modal-full-width');
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
    * Category
    */

    var dataTable = $('#package-datatable').DataTable( {
        "serverSide": true,
        "stateSave" : false,
        "bAutoWidth": true,
        "oLanguage": {
            "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
            "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <a href='"+base_url+"service/tambah-package' class='btn btn-danger waves-effect waves-light ml-3' id='TambahPackage'><i class='mdi mdi-plus-circle mr-1'></i> Add New</a><span id='Notifikasi' style='display: none;'></span>",
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
            url : base_url+"service/package-json",
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

    $(document).on('click', '#TambahPackage, #EditPackage', function(e){

        e.preventDefault();

        var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SimpanPackage'>Save</button>";
        Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').removeClass('modal-full-width');
        $('.modal-dialog').addClass('modal-lg');

        if($(this).attr('id') == 'Tambah')
        {
            $('#ModalHeader').html('Add New Package');
        }
        
        if($(this).attr('id') == 'Edit')
        {
            $('#ModalHeader').html('Edit Package');
        }

        $('#ModalContent').load($(this).attr('href'));
        $('#ModalGue').modal('show');
        $('#ModalFooter').html(Tombol);
    });

    $(document).on('click', '#SimpanPackage', function(e){
        e.preventDefault();

        if($(this).hasClass('disabled'))
        {
            return false;
        }
        else
        {
            if($('.tambah-package').serialize() !== '')
            {
                $.ajax({
                    url: $('.tambah-package').attr('action'),
                    type: "POST",
                    cache: false,
                    data: $('.tambah-package').serialize(),
                    dataType:'json',
                    beforeSend:function(){
                        $('#SimpanPackage').html("Saving, please wait ...");
                    },
                    success: function(json){
                        if(json.status == 1){ 
                            $('.modal-dialog').removeClass('modal-lg');
                            $('.modal-dialog').addClass('modal-sm');
                            $('#ModalHeader').html('Success !');
                            $('#ModalContent').html(json.pesan);
                            $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                            $('#ModalGue').modal('show');
                            $('#package-datatable').DataTable().ajax.reload( null, false );
                        }
                        else {
                            $('#ResponseInput').html(json.pesan);
                        }

                        $('#SimpanPackage').html('Save');
                    }
                });
            }
            else
            {
                $('#ResponseInput').html('');
            }
        }
    });

    $(document).on('submit', '.tambah-package', function(e){
        e.preventDefault();

        if($(this).hasClass('disabled'))
        {
            return false;
        }
        else
        {
            if($('.tambah-package').serialize() !== '')
            {
                $.ajax({
                    url: $('.tambah-package').attr('action'),
                    type: "POST",
                    cache: false,
                    data: $('.tambah-package').serialize(),
                    dataType:'json',
                    beforeSend:function(){
                        $('#SimpanPackage').html("Saving, please wait ...");
                    },
                    success: function(json){
                        if(json.status == 1){ 
                            $('.modal-dialog').removeClass('modal-lg');
                            $('.modal-dialog').addClass('modal-sm');
                            $('#ModalHeader').html('Success !');
                            $('#ModalContent').html(json.pesan);
                            $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
                            $('#ModalGue').modal('show');
                            $('#package-datatable').DataTable().ajax.reload( null, false );
                        }
                        else {
                            $('#ResponseInput').html(json.pesan);
                        }

                        $('#SimpanPackage').html('Save');
                    }
                });
            }
            else
            {
                $('#ResponseInput').html('');
            }
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
        },
        select: function(event, ui) {
            return true;
        }
    });
    $('#merk').autocomplete({

        serviceUrl: base_url+"customer/merk-json-ajax",
        showNoSuggestionNotice: 'Merk tidak ditemukan!',
        onSelect: function(suggestion) {
            $(this).val(suggestion.value);
            $('input[name="merk-id"]').val(suggestion.id);
        },
        select: function(event, ui) {
            return true;
        }
    });
    $('#jenis').autocomplete({

        serviceUrl: base_url+"customer/jenis-json-ajax",
        showNoSuggestionNotice: 'jenis tidak ditemukan!',
        onSelect: function(suggestion) {
            $(this).val(suggestion.value);
            $('input[name="jenis-id"]').val(suggestion.id);
        },
        select: function(event, ui) {
            return true;
        }
    });
    $('#kategori').autocomplete({

        serviceUrl: base_url+"customer/kategori-json-ajax",
        showNoSuggestionNotice: 'Kategori tidak ditemukan!',
        onSelect: function(suggestion) {
            $(this).val(suggestion.value);
            $('input[name="kategori-id"]').val(suggestion.id);
        },
        select: function(event, ui) {
            return true;
        }
    });
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
    $('input[name=employee]').autocomplete({

        serviceUrl: base_url+"employee/employee_json_ajax",
        showNoSuggestionNotice: 'Employee tidak ditemukan!',
        onSelect: function(suggestion) {
            $(this).val(suggestion.value);
            $('input[name="employeeid"]').val(suggestion.id);
        },
        select: function(event, ui) {
            return true;
        }
    });
    /* Fungsi formatRupiah */
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
    $(document).on('click', '.closerow', function () {
        var child = $(this).closest('tr').data('child');
            child = child.replace('child-', '');

        var rows = $(this).closest('tbody').find('tr');
        $(this).closest('tr').remove();
        rows.each(function(){
            if($(this).hasClass('parent') && $(this).data('parent') == child)
            {
                var rowspan = $(this).find('td').attr('rowspan');
                    rowspan = parseInt(rowspan);
                    rowspan -= 1;

                if(rowspan <= 1)
                    $('.closerowcat').trigger('click');
                else
                    $(this).find('td').attr('rowspan', rowspan);
            }
        })
        hitungtotal()

    });
    $(document).on('click', '.closerowcat', function () {
        let id = $(this).closest('tr').data('parent')
        $(this).closest('tr').remove()
        $('tbody tr').each(function(index, el) {
            if ($(this).data('child') == 'child-' + id) {
                $(this).remove()
            }
        });
        hitungtotal()

    });

    function hitungtotal()
    {
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

        var totaljasa = 0;
        var totalpart = 0
        var jumtotal = 0
        $('.sellingpricejasa').each(function(index, el) {
            var awaljasa = toFloat($(this).text())
            totaljasa += awaljasa
        });


        $('.autonumber').autoNumeric('init')

        $('#totalservice').autoNumeric('set',totaljasa)
        var part = $('.sellingpricepart')

        if (part.length) {
            part.each(function(index, el) {
                var awalpart = toFloat($(this).text())
                totalpart += awalpart
            });
            $('#totalpart').autoNumeric('set', totalpart)

            jumtotal += totalpart
        }

        jumtotal += totaljasa
        $('#jumtotal').autoNumeric('set', jumtotal)




    }
    $(document).on('click', '#reesetcustomer', function(event) {
        event.preventDefault();
        $('input[name=no-hp]').val('')
        $('input[name=customerid]').val('')
        $('input[name=span]').val('')
        $('input[name=cust-nama]').val('')
        $('input[name=iscustomer]').val('')
        $('input[name=isvehicle]').val('')
        $('input[name=district]').val('')
        $('input[name=district-id]').val('')
        $('#last_service').text('')
        $('#total_come').text('')
    });

    $(document).on('click', '#resetvehicle', function(event) {
        event.preventDefault();
        $('input[name=no-plat]').val('')
        $('input[name=vehicleid]').val('')
        $('input[name=unit]').val('')
        $('input[name=unit-id]').val('')
        $('input[name=merk]').val('')
        $('input[name=jenis]').val('')
        $('input[name=merkid]').val('')
        $('input[name=jenisid]').val('')
        $('input[name=catid]').val('')
        $('input[name=kategori]').val('')
        $('input[name=category_id]').val('')
    });
    function cektotal(data, type)
    {

        var harga = ''
        var row = '';
        var qty = ''
        var disc = ''
        if(type == 'item'){
            harga = data.closest('tr').find('td').eq(1).find('span').text();
            qty = data.closest('tr').find('td').eq(2).find('input').val()
            disc = data.closest('tr').find('td').eq(3).find('input').val()
            row = data.closest('tr').find('td').eq(4).find('span')
        }
        else{
            harga = data.closest('tr').find('td').eq(2).find('span').text();
            qty = data.closest('tr').find('td').eq(3).find('input').val()
            disc = data.closest('tr').find('td').eq(4).find('input').val()
            row = data.closest('tr').find('td').eq(5).find('span')
        }
        
        harga = toFloat(harga)
        disc = toFloat(disc)
        var result = ((qty * harga) - disc );  

        $('.autonumber').autoNumeric('init')
        if (result) {
            row.autoNumeric('set', result);
        }else{
            row.text('0')
        }
        hitungtotal()
        
    }

    function cektotalpart(data)
    {
        $('.autonumber').autoNumeric('init')

        var harga = data.closest('tr').find('td').eq(2).find('select').val();
        var qty   = data.closest('tr').find('td').eq(3).find('input').val()
        var disc  = data.closest('tr').find('td').eq(4).find('input').val()
        var row   = data.closest('tr').find('td').eq(7).find('span')
        
        // harga = toFloat(harga)
        // console.log(harga)
        var result = ((qty * harga) - toFloat(disc) );  

        if (result) {
            row.autoNumeric('set', result);
        }else{
            row.text('0')
        }


        hitungtotal()
        
    }


    $(document).on('keyup', '.part-qty', function(){ cektotalpart($(this)) });
    $(document).on('keyup', '.part-disc', function(){ cektotalpart($(this)) });




    // $(document).on('keyup', '.form-qty', function(event) {
    //     var id = $(this).data('id')
    //     var harga = $(this).closest('tr').find('td').eq(1).find('span').text();
    //     var elhasil = $(this).closest('tr').find('td').eq(4).find('span')
    //     if (hasil) {
    //         elhasil.text(hasil)
    //     }else{
    //         elhasil.text('0')
    //     }
    // });
    // $(document).on('keyup', '#package-table input', function(){ cektotal($(this)) });
    $(document).on('keyup', '.form-disc', function(){ cektotal($(this), 'item') });
    $(document).on('keyup', '.form-qty', function(){ cektotal($(this), 'item') });
    $(document).on('keyup', '.form-package-qty', function(){ cektotal($(this), 'package') });
    $(document).on('keyup', '.form-package-disc', function(){ cektotal($(this), 'package') });
    var iscategory = false

    $(document).on('click', 'input[name="package"]', function(){
        var categoryid = $('input[name=category_id]').val();
        if(! categoryid)
        {
            Swal.fire({
                title: "Error!",
                text: "Please select Service Category",
                type: "error"
            }).then(function(t) {
                if(t.dismiss !== Swal.DismissReason.cancel)
                {
                    $('input[name="package"]').val('')
                }
            })
        }else{
            $('#service-group').trigger('click')    	
        }
    })

    $(document).on('click', 'input[name=package]', function(event) {
        event.preventDefault();
        $('#service-group').trigger('click')
    });
    $(document).on('click', 'input[name=paket-service]', function(event) {
        event.preventDefault();
        $('#service-paket').trigger('click')
    });
    // $(document).on('click', 'input[name=parts]', function(event) {
    //     event.preventDefault();
    //     $('#btn-parts').trigger('click')
    // });


   //  $(document).on('change', 'input[name="category_id"]', function(){
	  //  var categoryid = $(this).val()
   //  	if (categoryid) {
			// $('input[name=package]').autocomplete({

			//     serviceUrl: base_url+"service/package-json-autocomplete",
			//     type: 'post',
			//     dataType: 'json',
			//     params: {categoryid: categoryid},
			//     showNoSuggestionNotice: 'Package tidak ditemukan!',
			//     onSelect: function(suggestion) {
			//         $(this).val('');
			//         var detail = suggestion.detail;
			//         var id = suggestion.id
			//         var isAda = true
			//         $('#package-table tr').each(function(index, el) {
			//             if($(this).data('parent') == id){
			//                 isAda = false
			//             }                    
			//         });
			//         if(isAda){
			//            $('#package-table').append(`
			//             <tr class="parent" data-parent="`+suggestion.id+`">
			//                 <td rowspan="${suggestion.row+1}"><i class="mr-2 closerowcat fa fa-times text-danger" data-id="${suggestion.id}"></i>${suggestion.value} </td>
			//                 <input type="hidden" name="service_job[]" value="${suggestion.id}"> 
			//             </tr>
			//             `)
			//             $.each(detail, function(index, val) {
			//                 $('#package-table').append(

			//                     `
			//                     <tr data-child="child-${suggestion.id}">
			//                         <td><i class="mr-2 fa fa-times closerow text-danger"></i> ${val.nama}    <input type="hidden" name="item_service[][${suggestion.id}]" value="${val.id}"></td>
			//                         <td>Rp. <span class="autonumber" data-a-sep='.' data-a-dec="," data-m-dec="0">${val.harga}</span><input type="hidden" name="service-harga[${val.id}]" value="${val.harga}"></td>
			//                         <td>
			//                             <input type="text" style="width: 60px !important;" name="service-qty[${val.id}]" data-id="${val.id}" value="1" class="form-qty form-control">
			//                         <td>
			//                             <div class="input-group">
			//                                 <input type="text" style="width: 60px !important;" name="service-disc[${val.id}]" class="form-disc form-control">
			//                                 <div class="input-group-addon">
			//                                     <div class="input-group-text">%</div>
			//                                 </div>
			//                             </div>
			//                         </td>
			//                         <td>Rp. <span class="autonumber sellingpricejasa" data-a-sep='.' data-a-dec="," data-m-dec="0" id="sellingprice[${val.id}]">${val.harga}</span> </td>
			//                     </tr>
			//                     `
			//                 );
			//                 $('.autonumber').autoNumeric('init')
			//            }) 

			//             hitungtotal()
			//         }

			        
			//     },
			//     select: function(event, ui) {
			//         $(this).val('');
			//     }
			// });   
   //  	}
   //  })
    
    $('input[name=parts]').autocomplete({

        serviceUrl: base_url+"service/parts-json-ajax",
        showNoSuggestionNotice: 'Sparepart tidak ditemukan!',
        onSelect: function(suggestion) {
            var isAda = true
            $('#spk-parts tr').each(function(index, el) {
                if ($(this).data('parent') == suggestion.id) {
                    isAda = false
                }
            });
            if (isAda) {
                var option = '<option value='+ suggestion.het +'>HET</option>'
                    option += '<option value='+ suggestion.het1 +'>H1</option>'
                    option += '<option value='+ suggestion.het2 +'>H2</option>'
                    option += '<option value='+ suggestion.het3 +'>H3</option>'
                    option += '<option value='+ suggestion.grosir +'>Grosir</option>'

                $('#spk-parts').append(`
                    <tr data-parent="${suggestion.id}">
                        <td><i class="mr-2 fa fa-times closerowpaket text-danger"></i>${suggestion.kode}</td>

                        <td>  ${suggestion.value} </td>
                        <td>
                            <div class="input-group input-group-sm">
                                <select class="form-control" style="width=20px !important" id="typePrice" name="part-harga[${suggestion.id}]">
                                    ${option}
                                </select>
                                <div class="input-group-prepend">
                                    <div class="input-group-text">-</div>
                                </div>
                                <input type="text" data-a-sep='.' data-a-dec="," style="width=40px !important" data-m-dec="0" id="dataPrice" class="form-control autonumber" value="${suggestion.het}">
                            </div>

                        </td>
                        <td>
                            <input type="text" style="width: 60px !important;" class="part-qty form-control form-control-sm" value="1"  name="part-qty[${suggestion.id}]">
                            <input type="hidden" value="${suggestion.id}" name="parts_id[]">
                        </td>
                        <td>
                            <input type="text" style="width: 120px !important;" data-a-sep='.' data-a-dec="," data-m-dec="0" class="part-disc autonumber form-control form-control-sm" name="part-disc[${suggestion.id}]">
                        </td>
                        <td>
                            ${suggestion.onhandqty}
                        </td>
                        <td>
                        </td>
                        <td>Rp. <span data-a-sep='.' data-a-dec="," data-m-dec="0" class="sellingpricepart autonumber" id"sellingpricepart[${suggestion.id}]">${suggestion.het}</span></td>
                    </tr>
                `)
            }
            hitungtotal()
            $(this).val('');
            $('.autonumber').autoNumeric('init')
        },
        select: function(event, ui) {
            return true;
        }
    });
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

    // $('input[name=paket-service]').autocomplete({

    //     serviceUrl: base_url+"service/autocomplete-paket-service",
    //     showNoSuggestionNotice: 'paket tidak ditemukan!',
    //     onSelect: function(suggestion) {
    //         $(this).val(suggestion.value);
    //         var id = suggestion.id
    //         var isAda = true
    //         $('#package-table tr').each(function(index, el) {
    //             if($(this).data('paket') == id){
    //                 isAda = false
    //             }                    
    //         });
    //         if (isAda) {
    //             $('#package-table').append(
    //                     `
    //                     <tr data-paket="${suggestion.id}">
    //                         <td ><i class="mr-2 fa fa-times closerowpaket text-danger"></i>${suggestion.value}    <input type="hidden" name="package-service[]" value="${suggestion.id}"></td>
    //                         <td>${suggestion.detail}</td>
    //                         <td>Rp. <span class="autonumber" data-a-sep='.' data-a-dec="," data-m-dec="0">${suggestion.harga}</span><input type="hidden" name="package-harga[${suggestion.id}]" value="${suggestion.harga}"></td>
    //                         <td>
    //                             <input type="text" style="width: 60px !important;" name="paket-qty[${suggestion.id}]" data-id="${suggestion.id}" value="1" class="form-package-qty form-control">
    //                         <td>
    //                             <div class="input-group">
    //                                 <input type="text" style="width: 60px !important;" name="paket-disc[${suggestion.id}]" class="form-package-disc form-control">
    //                                 <div class="input-group-addon">
    //                                     <div class="input-group-text">%</div>
    //                                 </div>
    //                             </div>
    //                         </td>
    //                         <td>Rp. <span class="autonumber sellingpricejasa" data-a-sep='.' data-a-dec="," data-m-dec="0" id="sellingprice[${suggestion.id}]">${suggestion.harga}</span> </td>
    //                     </tr>
    //                     `
    //                     );
    //         }
    //         $('.autonumber').autoNumeric('init')
    //         hitungtotal()
    //         $(this).val('')
    //     },
    //     select: function(event, ui) {
    //         return true;
    //     }
    // });
    $(document).on('click', '.closerowpaket', function(e){
        $(this).closest('tr').remove()
        hitungtotal()

    })
    $(document).on('click', '#service-paket', function(e){
        var tombol = "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').removeClass('modal-lg');
        $('.modal-dialog').addClass('modal-full-width');

        $('#ModalHeader').html('Choose Paket Service');
        $('#ModalContent').load($(this).attr('href'));
        $('#ModalFooter').html(tombol);
        $('#ModalGue').modal('show');
    })

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

    $(document).on('click', '#plats', function(e){
        var tombol = "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').removeClass('modal-lg');
        $('.modal-dialog').addClass('modal-full-width');

        $('#ModalHeader').html('Choose Kendaraan');
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
    $(document).on('click', '#employee_btn', function(e){
        var tombol = "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";
        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').removeClass('modal-lg');
        $('.modal-dialog').addClass('modal-full-width');

        $('#ModalHeader').html('Choose Technical');
        $('#ModalContent').load($(this).attr('href'));
        $('#ModalFooter').html(tombol);
        $('#ModalGue').modal('show');
    })
    $(document).on('click', '#btn-parts', function(e){
        var tombol = "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";
        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').removeClass('modal-lg');
        $('.modal-dialog').addClass('modal-full-width');

        $('#ModalHeader').html('Choose Parts');
        $('#ModalContent').load($(this).attr('href'));
        $('#ModalFooter').html(tombol);
        $('#ModalGue').modal('show');
    })

    $(document).on('click', '#suspend', function(e){
        var tombol = "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";
        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').removeClass('modal-lg');
        $('.modal-dialog').addClass('modal-full-width');

        $('#ModalHeader').html('Suspend');
        $('#ModalContent').load(base_url + 'service/suspen_view');
        $('#ModalFooter').html(tombol);
        $('#ModalGue').modal('show');
    })

    $(document).on('click', '#service-group', function(e){
        var categoryid = $('input[name=category_id]').val();

        if(! categoryid)
        {
            Swal.fire({
                title: "Error!",
                text: "Please select Service Category",
                type: "error"
            })
        }else{        
            var tombol = "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";
            $('.modal-dialog').removeClass('modal-sm');
            $('.modal-dialog').removeClass('modal-lg');
            $('.modal-dialog').addClass('modal-full-width');

            $('#ModalHeader').html('Choose Service Group');
            $('#ModalContent').load($(this).attr('href'));
            $('#ModalFooter').html(tombol);
            $('#ModalGue').modal('show');
        }
    })

    $(document).on('click', '.save-wo', function(e) {
        e.preventDefault();
        if ($(this).prop('disabled')) {
            return false
        }
        if ($(this).val() == '0') {
                var tombol = "<button type='button' id='btn-suspend' class='btn btn-primary waves-effect'>Confirm</button>";
                    tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";
                $('.modal-dialog').removeClass('modal-sm');
                $('.modal-dialog').removeClass('modal-lg');
                $('.modal-dialog').addClass('modal-lg');

                $('#ModalHeader').html('Suspend');
                $('#ModalContent').load(base_url + 'service/suspend_view');
                $('#ModalFooter').html(tombol);
                $('#ModalGue').modal('show');

                return 
            }
            var data = $(this).closest('form').serializeArray();
            data.push({name : 'state', 'value' : $(this).val()})
            $.ajax({
                url: $(this).closest('form').attr('action'),
                type: 'post',
                dataType: 'json',
                data: data,
                success: function(data){
                    if (data.status == 0) {
                        Swal.fire({
                            title: "Error!",
                            html: data.pesan,
                            type: "error"
                        })

                    }else{
                        $('input[name=hassave]').val(data.service_id)
                        window.open(
                            base_url + 'service/printservice/' + data.service_id + '/service?cetak=1',
                            'popUpWindow',
                            'height=567,width=793,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
                        // JavaScript:newPopup(base_url + 'service/printservice/' + data.service_id + '?cetak=1')
                    }
                }
            })
    });

    $(document).on('click', '#btn-suspend', function(event) {
        event.preventDefault();
        if($(this).hasClass('disabled'))
        {
            return false;
        }
        var data = $('#form-spk').serializeArray();
        var add = [
            {name: 'state' , value : '0' },
            {name : 'suspend', value: $('#form-add-suspend').find('textarea').val()},
        ]
        Array.prototype.push.apply(data,add);
        $.ajax({
            url: base_url + 'service/new-order',
            type: 'post',
            dataType: 'json',
            data: data,
            beforeSend: function() {
                $(this).text('Saving data, please wait.....')
                $(this).prop('disabled', true)
            },
            success: function(data){
                if (data.status == 0) {
                    Swal.fire({
                        title: "Error!",
                        text: data.pesan,
                        type: "error"
                    })

                }else{
                    $('input[name=hassave]').val(data.service_id)
                    window.open(
                        base_url + 'service/printservice/' + data.service_id + '/service?cetak=1',
                        'popUpWindow',
                        'height=700,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
                    // JavaScript:newPopup(base_url + 'service/printservice/' + data.service_id + '?cetak=1')
                }
                $('#ModalGue').modal('hide');
            }
        })
    });

    $('#confirmretail').submit(function(e){
        e.preventDefault()
    })
    $(document).on('click', '#confirmretail', function(e){
        e.preventDefault()
        var data = $(this).closest('form').serializeArray()
        data.push({name: 'status' , value: $(this).data('status')})
        $.ajax({
            url: $(this).closest('form').attr('action'),
            type: 'post',
            data: data,
            dataType: 'json',
            success: function(data) {
                console.log(data)
                if(data.status == 0)
                {
                    Swal.fire({
                        title: "Error!",
                        html: data.pesan,
                        type: "error"
                    })
                } else {
                    $('input[name=hassave]').val(data.service_id)
                    window.open(
                        base_url + 'service/printservice/' + data.service_id  + '/part?cetak=1',
                        'popUpWindow',
                        'height=700,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
                }
            }
        })        
    })

    $('#form-spk').submit(function(event) {
        /* Act on the event */
        event.preventDefault()
    });
    $('#clear').click(function (e) {
        e.preventDefault();
        if (!$('hassave').val()) {
            Swal.fire({
                title: "Warning",
                text: "are you sure you want to continue this transaction!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Sure!"
        }).then(function(t){
            $('input').each(function(index, el) {
                $(this).val('')
            });        
            $('tbody#package-table').text(' ')
            $('tbody#spk-parts').text(' ')
            $('#totalservice').text('0')
            $('#totalpart').text('0')
            $('#jumtotal').text('0')
            $('#last_service').text('')
            $('#total_come').text('')

            

            })
        }else{
            $('input').each(function(index, el) {
                $(this).val('')
            });        
            $('tbody#package-table').text(' ')
            $('tbody#spk-parts').text(' ')
        }
    });

    var summary = $('#summary').DataTable({
        "serverSide": true,
        "stateSave" : false,
        "bAutoWidth": true,
        "oLanguage": {
            "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
            "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page <div class='btn-group'><a href='"+base_url+"service/spk' class='btn btn-danger waves-effect waves-light ml-3'><i class='mdi mdi-plus-circle mr-1'></i> New Order</a><a href='"+base_url+"service/retail-sparepart' class='btn btn-danger waves-effect waves-light ml-3'><i class='mdi mdi-plus-circle mr-1'></i> New Retail Order</a></div>",
            // "sInfoFiltered": "(difilter dari _MAX_ total data)", 
            // "sZeroRecords": "Pencarian tidak ditemukan", 
            "sEmptyTable": "Data Empty", 
            "sLoadingRecords": "Loading ... Please wait !", 
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
            url : base_url+"service/summary-json",
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

    })

    summary.on( 'draw', function () {
        console.log('drawn')

    } );

    $(document).on( 'init.dt', function ( e, settings ) {
        var api = new $.fn.dataTable.Api( settings );

        console.log( 'New DataTable created:', api.table().node() );
    } );

    $(document).on('click', '.cancel-order', function (e) {
        e.preventDefault();
        var url = $(this).attr('href')
        Swal.fire({
            title: "Alasan Cancel",
            input: "text",
            inputAttributes: {
                autocapitalize: "off"
            },
            showCancelButton: !0,
            confirmButtonText: "Look up",
            showLoaderOnConfirm: !0,
            preConfirm: function(t) {
                if(t){
                     return $.ajax({
                        url: url,
                        data : {reason : t},
                        type: 'post',
                        success: function(data)
                        {
                            window.location.href = base_url + "service/summary"
                            // location.reload()
                        }
                    })
                }else{
                    return Swal.showValidationMessage("Reason Is Required")
                }
            },
            allowOutsideClick: function() {
                Swal.isLoading()
            }
        })
        // Swal.fire({
        //     title: "Warning",
        //     text: "are you sure you want to cancel this transaction!",
        //     type: "warning",
        //     showCancelButton: !0,
        //     confirmButtonColor: "#3085d6",
        //     cancelButtonColor: "#d33",
        //     confirmButtonText: "Yes, Sure!"
        // }).then(function(t){
        //     $.ajax({
        //         url: url,
        //         type: 'post',
        //         success: function(data)
        //         {
        //             location.reload()
        //         }
        //     })
        // })
    });

    if ($('.sellingpricejasa').length || $('.sellingpricepart').length) {
        hitungtotal()
    }

    $(document).on('click', '#filter-summary', function(e){
        e.preventDefault();

        var status  = $('select[name=Status]').val()
        var tanggal1 = $('input[name=date-1]').val()
        var tanggal2 = $('input[name=date-2]').val()

        var data = {};

        if(status)
            data.status = encodeURI(status)
        if(tanggal1 && tanggal2){
            data.tanggal1 = encodeURI(tanggal1)
            data.tanggal2 = encodeURI(tanggal2)
        }

        if(status || (tanggal1 && tanggal2)) {
            var summary = $('#summary').DataTable({
                "ajax":
                    {
                        url : base_url+"service/summary-json",
                        type: "post",
                        data: data,
                        error: function(){ 
                            $(".my-datatable-error").html("");
                            $("#my-datatable").append('<tbody class="my-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                            $("#my-datatable_processing").css("display","none");
                        }
                    },
                "destroy": true
            }).ajax.reload();
        }
    })
    $(document).on('click', '#refresh', function(e){
        e.preventDefault();

        var summary = $('#summary').DataTable({
            "ajax":
                {
                    url : base_url+"service/summary-json",
                    type: "get",
                    error: function(){ 
                        $(".my-datatable-error").html("");
                        $("#my-datatable").append('<tbody class="my-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $("#my-datatable_processing").css("display","none");
                    }
                },
            "destroy": true
        }).ajax.reload();
    })
    $(document).on('click', '#alldate', function(e){
        e.preventDefault();

        var summary = $('#summary').DataTable({
            "ajax":
                {
                    url : base_url+"service/summary-json",
                    type: "post",
                    data : {status : $('select[name=Status]').val()},
                    error: function(){ 
                        $(".my-datatable-error").html("");
                        $("#my-datatable").append('<tbody class="my-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $("#my-datatable_processing").css("display","none");
                    }
                },
            "destroy": true
        }).ajax.reload();
    })


} )( jQuery );

 

