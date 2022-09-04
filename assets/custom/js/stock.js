$(document).ready(function() {
	var base_url = $('#base_url').val();

    var locations = []
        locations[0] = ''
    function t() {}
    t.prototype.send = function(t, i, o, e, n, a, s, r) {
        var c = {
            heading: t,
            text: i,
            position: o,
            loaderBg: e,
            icon: n,
            hideAfter: a = a || 3e3,
            stack: s = s || 1
        };
        r && (c.showHideTransition = r), $.toast().reset("all"), $.toast(c)
    }, $.NotificationApp = new t, $.NotificationApp.Constructor = t


    $.ajax({
        url: base_url + 'sparepart/location-ajax',
        dataType: 'json',
        success: function(l)
        {
            if(l.results > 0)
            {
                $.each(l.data, function(index, data){
                    // console.log()
                    locations[data.id] = data.nama
                    // locations.push(data.id : data.nama)
                })
            }
        }
    })

    /*
    * Jasa
    */
    if( $.isFunction($.fn.DataTable) )
    {
        var opname = $('#opnameLocation').DataTable({
            // "serverSide": true,
            // "stateSave" : false,
            "bAutoWidth": true,
            // "oLanguage": {
            //     "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
            //     "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page",
            //     // "sInfoFiltered": "(difilter dari _MAX_ total data)", 
            //     // "sZeroRecords": "Pencarian tidak ditemukan", 
            //     "sEmptyTable": "Data Empty", 
            //     "sLoadingRecords": "Loading ... Please wait !", 
            //     "oPaginate": {
            //         "sPrevious": "Prev",
            //         "sNext": "Next"
            //     }
            // },
            // "aaSorting": [[ 0, "asc" ]],
            "columnDefs": [ 
                {
                    "targets": 'no-sort',
                    "orderable": false,
                }
            ],
            "sPaginationType": "simple_numbers", 
            "iDisplayLength": 10,
            "aLengthMenu": [[10, 20, 50, 100, 150], [10, 20, 50, 100, 150]],
            // "ajax":{
            //     url : base_url+"stock/picking-json",
            //     type: "post",
            //     error: function(){ 
            //         $(".my-datatable-error").html("");
            //         $("#my-datatable").append('<tbody class="my-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
            //         $("#my-datatable_processing").css("display","none");
            //     }
            // },
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
        if( $.isFunction($.fn.DataTable) )
        {
            var picking = $('#picking').DataTable({
                "serverSide": true,
                "stateSave" : false,
                "bAutoWidth": true,
                "oLanguage": {
                    "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                    "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page",
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
                    url : base_url+"stock/picking-json",
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
        }
        if( $.isFunction($.fn.DataTable) )
        {
            
            var gap = $('#gap-datatable').DataTable({
                "serverSide": true,
                "stateSave" : false,
                "bAutoWidth": true,
                "oLanguage": {
                    "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                    "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page",
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
                    url : base_url+"stock/gap-json",
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
        }
        if( $.isFunction($.fn.DataTable) )
        {

            var location = $('#location-data').DataTable({
                "serverSide": true,
                "stateSave" : false,
                "bAutoWidth": true,
                "oLanguage": {
                    "sSearch": "<button id='refresh-location' class='btn btn-primary btn-sm mr-2'> <i class='mdi mdi-refresh'></i> </button><i class='fa fa-search fa-fw'></i> Search : ",
                    "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page",
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
                    url : base_url+"stock/location-detail",
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

            location.on( 'draw', function () {
                var partid     = $('input[name=part-location-id').val()
                var locationid = $('input[name=location-a-id').val()

                $("#location-data").Tabledit({
                    url : base_url+'stock/transfer-location',
                    buttons: {
                        edit: {
                            class: "btn btn-success",
                            html: '<span class="mdi mdi-pencil"></span>',
                            action: "edit"
                        }
                    },
                    inputClass: "form-control form-control-sm",
                    deleteButton: !1,
                    saveButton: !1,
                    autoFocus: !1,
                    hideIdentifier : true,
                    columns: {
                        identifier: [0, "id"],
                        editable: [
                            [5, "locationid", JSON.stringify(locations)],
                            [6, "qty"],
                        ]
                    },
                    onSuccess: function(data, textStatus, jqXHR) {

                        if(data.status === 0) {
                            Swal.fire({
                                title: "Errors",
                                html: data.pesan,
                                type: "error"
                            })
                            return false
                        }else{
                            $.NotificationApp.send("Well Done!", data.pesan , "top-right", "#5ba035", "success")
                        }
                    },
                })

            } );
        }
    }

    $(document).on('click', '.change-status', function(e){
        e.preventDefault();
        var url = $(this).attr('href')
        var status = $(this).text()

        if(status == 'Open')
        {
            Swal.fire({
                title: "Are you sure?",
                text: "Freezing location will stop every transaction in this location",
                type: 'warning',
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, freeze it!"
            }).then(function(t) {
                if(t.dismiss !== Swal.DismissReason.cancel)
                {
                    $.ajax({
                        url: url,
                        success: function(s){
                            Swal.fire({
                                title: "Success!",
                                html: s.pesan,
                                type: "success"
                            }).then(function(t) {
                                window.location.href = base_url + 'stock/opname'                                
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
        } else {
            $.ajax({
                url: url,
                success: function(s){
                    Swal.fire({
                        title: "Success",
                        text: "Location opened",
                        type: "success"
                    }).then(function(t) {
                        window.location.href = base_url + 'stock/opname'
                    })
                }
            })
        }
    })

    $(document).on('click', '#refresh-location', function(e) {
        e.preventDefault()
        location.ajax.reload()
    })

    

    let initialized = 0;

    $(document).on( 'init.dt', function ( e, settings ) {
        if(e.target.id == 'location-data')
            initialized += 1
    } );

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

    if($("#picking-editable").length){
        $("#picking-editable").Tabledit({
            inputClass: "form-control form-control-sm",
            url : base_url+'stock/editpicking',
            editButton: !1,
            deleteButton: !1,
            hideIdentifier : true,
            columns: {
                identifier: [0, "id"],
                editable: [
                    [8, "picking"],
                ]
            },
            onSuccess: function(data, textStatus, jqXHR) {
                if(data.status === 0) {
                    Swal.fire({
                        title: "Error",
                        text: data.pesan,
                        type: "error"
                    })
                    return false
                }else{
                    window.location.reload()
                }
            },
        })
    }
    


    $(document).on('click', '.delete-picking', function (e) {
        var url = $(this).attr('href')
        e.preventDefault();
        Swal.fire({
            title: "Warning",
            text: "are you sure you want to cancel this transaction!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Sure!"
        }).then(function(t){
            $.ajax({
                url: url,
                type: 'post',
                success: function(data)
                {
                    location.reload()
                }
            })
        })
    });

    if ($('span#empty').text() == 'Data Is Empty') {
        location.href = base_url + 'stock/picking'
    }

    $(document).on('click', '#filter-picking', function(e){
        e.preventDefault();

        var status  = $('select[name=status]').val()

        var data = {};

        var tanggal1 = $('input[name=date-1]').val()
        var tanggal2 = $('input[name=date-2]').val()

        if(status)
            data.status = encodeURI(status)
        if(tanggal1 && tanggal2){
            data.tanggal1 = encodeURI(tanggal1)
            data.tanggal2 = encodeURI(tanggal2)
        }

        if(status || (tanggal1 && tanggal2)) {
            var picking = $('#picking').DataTable({
                "ajax":
                    {
                        url : base_url+"stock/picking-json",
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

        var picking = $('#picking').DataTable({
            "ajax":
                {
                    url : base_url+"stock/picking-json",
                    type: "post",
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

        var picking = $('#picking').DataTable({
            "ajax":
                {
                    url : base_url+"stock/picking-json",
                    type: "post",
                    data : {status : $('select[name=status]').val()},
                    error: function(){ 
                        $(".my-datatable-error").html("");
                        $("#my-datatable").append('<tbody class="my-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                        $("#my-datatable_processing").css("display","none");
                    }
                },
            "destroy": true
        }).ajax.reload();
    })


    $(document).on('click', '#search-part-lok', function(e){
        e.preventDefault();
        // alert('sdfa')
        var tombol = "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";
        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').addClass('modal-lg') 
        $('#ModalHeader').html('Choose Parts');
        $('#ModalContent').load($(this).attr('href'));
        $('#ModalFooter').html(tombol);
        $('#ModalGue').modal('show');
    })
    $(document).on('click', '#search-location-lok', function(e){
        e.preventDefault();
        // alert('sdfa')
        var tombol = "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";
        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').addClass('modal-lg') 
        $('#ModalHeader').html('Choose Location');
        $('#ModalContent').load($(this).attr('href'));
        $('#ModalFooter').html(tombol);
        $('#ModalGue').modal('show');
    })

    $(document).on('click', '#print', function(event) {
        event.preventDefault();
        window.open(
            $(this).attr('href'),
            'popUpWindow',
            'height=567,width=793,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
    });

    $(document).on('click', '#reset-part', function (e) {
        $('input[name=part-location').val(null)
        $('input[name=part-location-id').val(0)
    })
    $(document).on('click', '#reset-location', function (e) {
        $('input[name=location-a').val(null)
        $('input[name=location-a-id').val(0)
    })
    $(document).on('click', 'input[name=location-a]', function (e) {
        $('#search-location-lok').trigger('click')
    })
    $(document).on('click', 'input[name=part-location]', function (e) {
        $('#search-part-lok').trigger('click')
    })

    $(document).on('click', '#edit-location', function(e){
        e.preventDefault();
        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').addClass('modal-xl');
        $('#ModalHeader').html('Edit Qty');
        var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='UpdateQty'>Save</button>";
        Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";
        $('#ModalContent').load($(this).attr('href'));
        $('#ModalGue').modal('show');
        $('#ModalFooter').html(Tombol);
    });
    $(document).on('click', '#UpdateQty', function(e){
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
                        $('#UpdateQty').html("Saving, please wait ...");
                        $('#UpdateQty').prop('disabled', true);
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
                                    window.location.href = base_url+'stock/location';
                                }
                            })
                        }
                        else {
                            $('#ResponseInput').html(json.pesan);
                        }

                        $('#UpdateQty').html('Save');
                        $('#UpdateQty').prop('disabled', false);

                    }
                });
            }
            else
            {
                $('#ResponseInput').html('');
            }
        }
    });

    $(document).on('click', '#confirm-filter', function (e) {
        e.preventDefault()

        var partid     = $('input[name=part-location-id').val()
        var locationid = $('input[name=location-a-id').val()

        var location = $('#location-data').DataTable({
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<button id='refresh-location' class='btn btn-primary btn-sm mr-2'> <i class='mdi mdi-refresh'></i> </button><i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page",
                "sEmptyTable": "Data Empty", 
                "sLoadingRecords": "Loading ... Please wait !", 
                "oPaginate": {
                    "sPrevious": "Prev",
                    "sNext": "Next",
                }
            },
            "aaSorting": [[ 0, "asc" ]],
            "columnDefs": [ 
                {
                    "targets": 'no-sort',
                    "orderable": false,
                }
            ],
            "ajax":
            {
                url: base_url+'stock/location-detail/'+partid+'/'+locationid,
                type: 'post',
                error: function(){ 
                    $(".my-datatable-error").html("");
                    $("#my-datatable").append('<tbody class="my-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#my-datatable_processing").css("display","none");
                }
            },
            "sPaginationType": "simple_numbers", 
            "iDisplayLength": 10,
            "aLengthMenu": [[10, 20, 50, 100, 150], [10, 20, 50, 100, 150]],
            language: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'>",
                    next: "<i class='mdi mdi-chevron-right'>"
                }
            },
            drawCallback: function() {
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
            }
        }).ajax.reload()
    })

    $('#ModalGue').on('shown.bs.modal', function(){
        var location = $('#location-data').DataTable().clear()
        var location = $('#location-data').DataTable().destroy()
    })

    if( $.isFunction($.fn.DataTable) )
    {
        var summary_recieve = $('#tb-summary-recieve').DataTable({
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "searching": false,
            "oLanguage": {
                // "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page",
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
                url : base_url+"stock/receive-summary-json",
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
    }

    $(document).on('click', '.cancel-summary', function(e) {
           var url = $(this).attr('href')
           e.preventDefault()
           Swal.fire({
               title : 'Warning !',
               text: "Are you sure for cancel this receive?",
               type: "warning",
               showCancelButton: !0,
               confirmButtonColor: "#3085d6",
               cancelButtonColor: "#d33",
               confirmButtonText: "Yes, delete it!"
           }).then(function(t){
               return $.ajax({
                  url: url,
                  data : {reason : t},
                  type: 'post',
                  success: function(data)
                  {
                      window.location.reload()
                  }
           })
       })
    })

    $(document).on('click', '.approve-summary', function(e) {
           e.preventDefault()
           var url = $(this).attr('href')
           return $.ajax({
              url: url,
              type: 'post',
              success: function(data)
              {
                Swal.fire({
                    title:"Success!",
                    text:"Approved is success!",
                    type:"success",confirmButtonClass:
                    "btn btn-confirm mt-2"
                }).then(function(t){                
                      window.location.reload()
                })
              }
       })
    })

   $(document).on('click', '.void-summary', function (e) {
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
                           window.location.reload()
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
    })
    $(document).on('click', '#summary-recieve', function(e){
       e.preventDefault();

       var status = $('select[name=Status]').val()
        status = (status) ? status : null;
       var tanggal1 = $('input[name=date-as-1]').val()
        tanggal1 = (tanggal1) ? tanggal1 : null;
       var tanggal2 = $('input[name=date-as-2]').val()
        tanggal2 = (tanggal2) ? tanggal2 : null;

       if(status || (tanggal1 && tanggal2)) {
           var summary_recieve = $('#tb-summary-recieve').DataTable({
               "ajax":
                   {
                       url : base_url+"stock/receive-summary-json/"+status+'/'+tanggal1+'/'+tanggal2,
                       type: "post",
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

       var summary_recieve = $('#tb-summary-recieve').DataTable({
           "ajax":
               {
                   url : base_url+"stock/receive-summary-json/",
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
       var status  = $('select[name=Status]').val()
        status = (status) ? status : null;
       var summary_recieve = $('#tb-summary-recieve').DataTable({
           "ajax":
               {
                   url : base_url+"stock/receive-summary-json/"+status,
                   type: "post",
                   error: function(){ 
                       $(".my-datatable-error").html("");
                       $("#my-datatable").append('<tbody class="my-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                       $("#my-datatable_processing").css("display","none");
                   }
               },
               "destroy": true
       }).ajax.reload();
   })

    $(document).on('click', '.void-message', function(e) {
        e.preventDefault()
        var id =  $(this).data('id')
        var url = base_url + 'stock/message-void/'+id
        return $.ajax({
           url: url,
           type: 'get',
           success: function(data)
           {
            // console.log(data)
             Swal.fire({
                 title:"Void!",
                 html: data,
                 type:"info",
                 confirmButtonClass: "btn btn-confirm mt-2"
             })
           }
        })
     })  

    function tbLocationMaster(){
        var location = $('#table-location')
            location.html('<table id="datatable-location" class="table table-sm">\
                        <thead>\
                            <tr>\
                                <th>Kode</th>\
                                <th>Sparepart</th>\
                                <th>Location</th>\
                                <th>Qty</th>\
                                <th>Selling Price</th>\
                                <th class="no-sort">Edit</th>\
                            </tr>\
                        </thead>\
                        <tbody>\
                        </tbody>\
                    </table>')
        if( $.isFunction($.fn.DataTable) )
        {
            var locationDatatable = $('#datatable-location').DataTable({
                "serverSide": true,
                "stateSave" : false,
                "bAutoWidth": true,
                "oLanguage": {
                    "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                    "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page",
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
                    url : base_url+"stock/sparepart_location_json",
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
        }
    }
    tbLocationMaster()
    function cekfooter(is_enable = false){
        var enable = ''
        if (is_enable) {
            enable = 'disabled'
        }
        if ($('#newTransaction').length || $('#newItem').length) {
            $('#table-footer').html('<div class="btn-group">\
                    <button id="back-location" class="btn btn-primary"><i class="fa fa-undo"></i> Back</button>\
                    <button id="submit-location" '+ enable +' class="btn btn-primary"><i class="fa fa-check mr-1"></i>Confirm</button>\
                    <button id="print-location" class="btn btn-primary"><i class="fa fa-print mr-1">Print</i></button>\
                    </form>\
                </div>')
        }else{
            $('#table-footer').html(' ')
        }
    }
    $(document).on('click', '#back-location', function(event) {
        event.preventDefault();
        tbLocationMaster()
        $('#table-footer').html(' ')
        if(!$('#filter-location').hasClass('d-none')){
            $('#filter-location').addClass('d-none');
        }
    });

    $(document).on('click', '#newTransaction', function(event) {
        event.preventDefault();
        $('#filter-location').removeClass('d-none');
        var location = $('#table-location')
        location.html('\
            <form action="'+base_url+'stock/new-transaction" method="post">\
            <table class="table table-sm">\
                    <thead>\
                        <tr>\
                            <th>#</th>\
                            <th>Kode</th>\
                            <th>Sparepart</th>\
                            <th>Current Location</th>\
                            <th>Qty</th>\
                            <th>New Location</th>\
                            <th>Qty</th>\
                            <th></th>\
                        </tr>\
                    </thead>\
                    <tbody id="tbNewTransaction">\
                    </tbody>\
                </table>')
        cekfooter()
    });
    $(document).on('click', '#newItem', function(event) {
        event.preventDefault();
        if(!$('#filter-location').hasClass('d-none')){ 
            $('#filter-location').addClass('d-none');
        }

        var location = $('#table-location')
        location.html('\
            <form action="'+base_url+'stock/add-beginning" method="post">\
            <div class="row mb-2">\
                <div class="col"><button class="btn btn-primary" id="selectpartlocation"><i class="fa fa-plus-square mr-2"></i> Select Parts</button></div>\
            </div>\
            <table class="table table-sm">\
                    <thead>\
                        <tr>\
                            <th>#</th>\
                            <th>Kode</th>\
                            <th>Sparepart</th>\
                            <th>Location</th>\
                            <th>Qty</th>\
                            <th></th>\
                        </tr>\
                    </thead>\
                    <tbody id="tbnewItem">\
                    </tbody>\
                </table>')
        cekfooter()
    });

    $(document).on('click', '.close-location-part', function(event) {
        event.preventDefault();
        var id = $(this).data('close')
        $(this).closest('tbody').find('tr').each(function(index, el) {
            if (id == $(this).data('child')) {
                $(this).remove()
            }
        });
    });
    $(document).on('click', '.close-location', function(event) {
        event.preventDefault();
        $(this).closest('tr').remove()
    });

    $(document).on('click', '#add-location', async function(event) {
        event.preventDefault();
        
        let select = ''
        let response = await fetch(base_url + 'stock/location_part')
        let data = await response.json()
        $.each(data.select, function(i, v) {
             select = select + '<option value="'+ v.id +'">'+ v.nama +'</option>';
        }); 

        var id = $(this).data('id')
        $(this).closest('tr').after('\
            <tr data-child="'+ id +'">\
                <td></td>\
                <td></td>\
                <td></td>\
                <td></td>\
                <td></td>\
                <td>\
                    <select name="locationid['+ id +'][]" class="form-control form-control-sm">\
                        <option value=""></option>\
                        '+select+'\
                    </select>\
                </td>\
                <td>\
                    <input style="width : 70px !important" type="text" class="form-control form-control-sm" name="qty['+ id +'][]">\
                </td>\
                <td>\
                    <i class="fa fa-plus text-success ml-2 mr-1" data-id="'+ id +'" id="add-location"></i>\
                    <i class="close-location fa fa-times text-danger ml-1 mr-1"></i>\
                </td>\
            </tr>')
    });
    $(document).on('click', '#add-part', async function(event) {
        event.preventDefault();
        
        let select = ''
        let response = await fetch(base_url + 'stock/location_part')
        let data = await response.json()
        $.each(data.select, function(i, v) {
             select = select + '<option value="'+ v.id +'">'+ v.nama +'</option>';
        }); 

        var id = $(this).data('id')
        $(this).closest('tr').after('\
            <tr data-child="'+ id +'">\
                <td></td>\
                <td></td>\
                <td></td>\
                <td>\
                    <select name="locationid['+ id +'][]" class="form-control form-control-sm">\
                        <option value=""></option>\
                        '+select+'\
                    </select>\
                </td>\
                <td>\
                    <input style="width : 70px !important" type="text" class="form-control form-control-sm" name="qty['+ id +'][]">\
                </td>\
                <td>\
                    <i class="fa fa-plus text-success ml-2 mr-1" data-id="'+ id +'" id="add-part"></i>\
                    <i class="close-location fa fa-times text-danger ml-1 mr-1"></i>\
                </td>\
            </tr>')
    });

    $(document).on('click', '#selectpartlocation', function(event) {
        event.preventDefault();
        var tombol = "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";
        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').addClass('modal-lg') 
        $('#ModalHeader').html('Choose Parts');
        $('#ModalContent').load(base_url + 'stock/select-sparepart');
        $('#ModalFooter').html(tombol);
        $('#ModalGue').modal('show');
    });
    $(document).on('click', '#retrieve-ini', function(event) {
        event.preventDefault();
        var id = $(this).data('id')
        $.ajax({
            url: base_url + 'stock/findsparepartlocation/'+id,
            type: 'get',
            dataType: 'json',
            success : function(data){
                var { data, select } = data
                var option = ''

                $.each(select, function(index, val) {
                    option += '<option value="'+ val.id +'">'+ val.nama +'</option>';
                });
                var isAda = true
                $('#tbnewItem').find('tr').each(function(index, el) {
                    if (data.id == $(this).data('child')) {
                        isAda = false
                    }
                });
                if(isAda){
                    $('tbody#tbnewItem').append('\
                    <tr data-child="'+ data.id +'">\
                        <td><i data-close="'+ data.id +'" class="close-location-part text-danger fa fa-times"></i></td>\
                        <input type="hidden" name"sparepartid[]" value="'+ data.id +'">\
                        <td>'+data.kode+'</td>\
                        <td>'+data.sparepart+'</td>\
                        <td>\
                            <select name="locationid['+ data.id +'][]" class="form-control form-control-sm">\
                                <option dataue=""></option>\
                                '+option+'\
                            </select>\
                        </td>\
                        <td>\
                            <input style="width : 70px !important" type="text" class="form-control form-control-sm" name="qty['+ data.id +'][]">\
                        </td>\
                        <td>\
                            <i class="fa fa-plus text-success ml-2 mr-1" data-id="'+ data.id +'" id="add-part"></i>\
                        </td>\
                    </tr>');
                }

            }
        })
        
        $('#ModalGue').modal('hide');
    });

    $(document).on('click', '#submit-location', function(event) {
        event.preventDefault();
        if ($(this).attr('disabled')) {
            return false
        }
        var data = $('form').serializeArray()
        $.ajax({
            url: $('form').attr('action'),
            type: 'post',
            dataType: 'json',
            data: data,
            success: function(data){
                if(data.status === 0) {
                    Swal.fire({
                        title: "Error",
                        html: data.pesan,
                        type: "error"
                    })
                    return false
                }else{
                    Swal.fire({
                        title:"Success!",
                        text: data.pesan,
                        type:"success",
                        confirmButtonClass : "btn btn-confirm mt-2"
                    }).then(function(t){                
                        cekfooter(true)
                    })
                }
            }
        })
        
    });
    if (typeof Tabledit !== 'undefined') {
        $("#actual-editable").Tabledit({
            url : base_url+'stock/input-actual-action',
            buttons: {
                edit: {
                    class: "btn btn-success",
                    html: '<span class="mdi mdi-pencil"></span>',
                    action: "edit"
                }
            },
            inputClass: "form-control form-control-sm",
            deleteButton: !1,
            saveButton: !1,
            autoFocus: !1,
            hideIdentifier : true,
            columns: {
                identifier: [0, "id"],
                editable: [
                    [5, "actual"],
                ]
            },
            onSuccess: function(data, textStatus, jqXHR) {

                if(data.status != 1) {
                    Swal.fire({
                        title: "Errors",
                        html: data.pesan,
                        type: "error"
                    })
                    return false
                }else{
                    $.NotificationApp.send("Well Done!", data.pesan , "top-right", "#5ba035", "success")
                }
            },
        })
    }
    $(document).on('click', '#print-location', function(event) {
        event.preventDefault();
        var id = $('input[name=hassave]').val()
        if (id) {
            window.open(
                base_url + 'stock/printtransfer/' + id + '?cetak=1',
                'popUpWindow',
                'height=700,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
            return false
        }
        var kode = [];
        var sparepart = [];
        var currentLocation = [];
        var currentQty = [];
        var newLocation = [];
        var newQty = []; 

        var row = $('#tbNewTransaction').find('tr').each(function(index, el) {
            $(this).find('td').eq(1).each(function(index, el) {
                kode.push($(this).text())
            });
            $(this).find('td').eq(2).each(function(index, el) {
                sparepart.push($(this).text())
            });
            $(this).find('td').eq(3).each(function(index, el) {
                currentLocation.push($(this).text())
            });
            $(this).find('td').eq(4).each(function(index, el) {
                currentQty.push($(this).text())
            });
            $(this).find('td').eq(5).each(function(index, el) {
                newLocation.push($(this).find('select').val())
            });
            $(this).find('td').eq(6).each(function(index, el) {
                newQty.push($(this).find('input').val())
            });
        });

        var data = {}
        data.kode = kode;
        data.sparepart = sparepart;
        data.currentLocation = currentLocation;
        data.currentQty = currentQty;
        data.newLocation = newLocation;
        data.newQty = newQty;

        $.ajax({
            url: base_url + 'stock/transfer-print',
            type: 'post',
            dataType: 'json',
            data: data,
            success: function(data){
                if (data.status == 1) {
                    $('input[name=hassave]').val(data.id)
                    window.open(
                        base_url + 'stock/printtransfer/' + data.id + '?cetak=1',
                        'popUpWindow',
                        'height=700,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
                }
            }
        })
        
    });

    $(document).on('click', '#chargeview', function(event) {
         event.preventDefault();
       var tombol = "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";
           tombol += "<button type='button' class='btn btn-success' id='charge'>Confirm</button>";
       $('.modal-dialog').removeClass('modal-sm');
       $('.modal-dialog').addClass('modal-full-width') 
       $('#ModalHeader').html('Charge');
       $('#ModalContent').load($(this).attr('href'));
       $('#ModalFooter').html(tombol);
       $('#ModalGue').modal('show'); 
    });

    $(document).on('click', '#charge', function(event) {
        event.preventDefault();
        $.ajax({
            url: $('#form-gap').attr('action'),
            type: 'post',
            dataType: 'json',
            data: $('#form-gap').serialize(),
            beforeSend:function(){
                $('#charge').html("Saving, please wait ...");
                $('#charge').prop('disabled', true);
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
                            window.location.href = base_url+'/stock/gap';
                        }
                    })
                }
                else {
                    $('#ResponseInput').html(json.pesan);
                }

                $('#charge').html('Save');
                $('#charge').prop('disabled', false);

            }
        });
        
    });

    $(document).on('click', '#add-opname', function(e){
        e.preventDefault();
        var tombol = "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";
            tombol += "<button type='button' class='btn btn-primary' id='simpan-opname'>Start Opname</button>";
        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').addClass('modal-lg') 
        $('#ModalHeader').html('List Sparepart');
        $('#ModalContent').load($(this).attr('href'));
        $('#ModalFooter').html(tombol);
        $('#ModalGue').modal('show');
    })

    $(document).on('click', '#simpan-opname', function(event) {
        event.preventDefault();
        $.ajax({
            url: base_url + 'stock/start-opname',
            dataType: 'json',
            success: function(data){
                console.log(data)
                if (data.status) {
                    window.location.href = base_url + 'stock/opname'
                }
            }
        })
        
    });

    if( $.isFunction($.fn.DataTable) )
    {
        var summary_order = $('#tb-order').DataTable({
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
                "sLengthMenu": "_MENU_ &nbsp;&nbsp;per Page",
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
                url : base_url+"stock/order-json",
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
         $(document).on('click', '#summary-order', function(e){
            e.preventDefault();

            var status = $('select[name=status-order]').val()
             status = (status) ? status : null;
            var tanggal1 = $('input[name=date-order-1]').val()
             tanggal1 = (tanggal1) ? tanggal1 : null;
            var tanggal2 = $('input[name=date-order-2]').val()
             tanggal2 = (tanggal2) ? tanggal2 : null;

            if(status || (tanggal1 && tanggal2)) {
                var summary_recieve = $('#tb-order').DataTable({
                    "ajax":
                        {
                            url : base_url+"stock/order-json/"+status+'/'+tanggal1+'/'+tanggal2,
                            type: "post",
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

        $(document).on('click', '#refresh-order', function(e){
            e.preventDefault();

            var summary_recieve = $('#tb-order').DataTable({
                "ajax":
                    {
                        url : base_url+"stock/order-json",
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
        $(document).on('click', '#alldate-order', function(e){
            e.preventDefault();
            var status  = $('select[name=Status]').val()
             status = (status) ? status : null;
            var summary_recieve = $('#tb-order').DataTable({
                "ajax":
                    {
                        url : base_url+"stock/order-json/"+status,
                        type: "post",
                        error: function(){ 
                            $(".my-datatable-error").html("");
                            $("#my-datatable").append('<tbody class="my-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                            $("#my-datatable_processing").css("display","none");
                        }
                    },
                    "destroy": true
            }).ajax.reload();
        })

    }
    $(document).on('click', '#print-opname, #print-actual', function(event) {
        event.preventDefault(); 
        window.open(
            $(this).attr('href') + '?cetak=1',
            'popUpWindow',
            'height=700,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
        return false
    });

    $(document).on('click', '#add-actual', function(event) {
        event.preventDefault();
        var url = $(this).attr('href')
        // console.log(url)
        var data = $('#form-actual').serializeArray()
        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            data: data,
            success: function(data)
            {
                if (data.status) {
                    Swal.fire({
                        title:"Success!",
                        text:"Input actual is success!",
                        type:"success"
                    }).then(function(data){
                        $('input[name=hassave]').val(1)
                        $('.actual').val('')
                    })
                }else{
                    Swal.fire({
                        title:"Error!",
                        html: data.pesan,
                        type:"error"
                    })
                }
            }
        })
    });

    $(document).on('click', '#bayar-gap', function(e){
        e.preventDefault();
        // alert('sdfa')
        var tombol = "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";
            tombol += "<button type='button' class='btn btn-success' id='confirm-gap' disabled>Confirm</button>";
        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').addClass('modal-lg') 
        $('#ModalHeader').html('Choose Cost');
        $('#ModalContent').load($(this).attr('href') + '?bil=' + $(this).data('bil') + '&location=' + $(this).data('location'));
        $('#ModalFooter').html(tombol);
        $('#ModalGue').modal('show');
    })

        $(document).on('click', '.add-row', function(event) {
            event.preventDefault();


            var choose = $('select#choose').val()
            $.ajax({
                url: base_url + 'stock/select_coa_gap/' + choose,
                type: 'post',
                dataType: 'json',
                success: function(result){
                    var option = ''
                    $.each(result.coa, function(index, val) {
                        option += "<option value=" + val.coaid + ">" + val.nama + "</option>"
                    });
                    if (choose == 'biaya') {
                        var value = `
                            <div class="row baris mb-2">
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-danger remove-gap">
                                                <i class="mdi mdi-minus"></i>
                                            </button>
                                        </div>
                                        <select name="aliasid[]" id="" class="form-control">${option}</select>
                                    </div>
                                </div>
                                <input type="hidden" name="type[]" value="biaya">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" name="amount[]" class="form-control amount autonumber" data-a-sep="." data-a-dec="," data-m-dec="2">
                                    </div>
                                </div>
                            </div>
                        `

                    }else{
                        var employee = ''
                        $.each(result.employee, function(index, val) {
                            employee += "<option value=" + val.id + ">" + val.nama + "</option>"
                        });
                        var value = `
                            <div class="row baris mb-2">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-danger remove-gap">
                                                <i class="mdi mdi-minus"></i>
                                            </button>
                                        </div>
                                        <select name="aliasid[]" id="" class="form-control">${option}</select>
                                    </div>
                                </div>
                                <input type="hidden" name="type[]" value="ar">
                                <div class="col-md-4">
                                    <select name="employeeid[]" id="" class="form-control">${employee}</select>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" name="amount[]" class="form-control amount autonumber" data-a-sep="." data-a-dec="," data-m-dec="2">
                                    </div>
                                </div>
                            </div>
                        `
                    }

                    $('#form-cost').append(value)
                    $('.autonumber').autoNumeric('init')
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

        function pengecekan()
        {
            var grandtotal = $('input[name=grandtotal]').val()
            var totalss = $('input[name=totalss]').val()
            var total = 0
            var row = $('.amount').each(function(index, el) {
                total += toFloat($(this).val())
            });
            var supply = $('select[name=supply]').val()
            $('#received').autoNumeric('init')
            $('#received').autoNumeric('set', total)

            if ((toFloat(grandtotal) == total) && supply) {
                $('#confirm-gap').attr('disabled', false);
            }else{
                $('#confirm-gap').attr('disabled', true);
            }
        }

        $(document).on('change', 'select[name=supply]', function(event) {
            event.preventDefault();
            pengecekan()
        });

        // function cektotalss(){
        //  var grandtotal = toFloat($('input[name=grandtotal]').val())
        //  var amountSales = toFloat($('input[name=amount-sales]').val())
        //  var amountSupply = toFloat($('input[name=amount-supply]').val())
        //  var totalss = amountSupply + amountSales

     //     $('#totalss').autoNumeric('init')
        //  $('#totalss').autoNumeric('set', totalss)

        //  if ((toFloat(grandtotal) == total) && toFloat(totalss) == total) {
        //      $('#confirm-gap').attr('disabled', false);
        //  }else{
        //      $('#confirm-gap').attr('disabled', true);
        //  }

        // }

        $(document).on('keyup', '.amount', function(event) {
            event.preventDefault();
            pengecekan()
            
        });

        $(document).on('keyup', 'input[name=amount-supply], input[name=amount-sales]', function(event) {
            event.preventDefault();
            cektotalss()
            
        });
        $(document).on('click', '.remove-gap', function(event) {
            event.preventDefault();
            $(this).closest('div.baris').remove()
            pengecekan()
        });
        $(document).on('click', '#confirm-gap', function(event) {
            event.preventDefault();
            var data = $('#input-cost').serializeArray()
            var url = base_url + 'stock/confirm-gap'
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: data,
                success: function(data){
                    if (data.status == 1) {
                        Swal.fire({
                            title: 'Success',
                            html : 'Gap has been success',
                            type : 'success'
                        }).then(function(result){
                            window.location.reload()
                        })
                    }else{
                        Swal.fire({
                            title: 'Error',
                            html : data.pesan,
                            type : 'error'
                        })
                    }
                }
            })
            
        });

        $(document).on('click', '.delete-order', function(event) {
            event.preventDefault();
            var target = $(this).attr('href');
            var table = 'tb-order'
            deleted_oder(table, target)
        });

        function deleted_oder(table, target)
        {
            var idtable = table;
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
                        dataType: 'json',
                        success: function(s){
                            if(s.status == 1) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your file has been deleted.",
                                    type: "success"
                                })

                                $('#'+idtable).DataTable().ajax.reload( null, false );
                            } else {
                                Swal.fire({
                                    title: "Sorry!",
                                    html: s.pesan,
                                    type: "error"
                                })
                            }
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
        }



});