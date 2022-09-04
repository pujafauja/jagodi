( function ( $ ) {

    "use strict";

    var base_url = $('#base_url').val();

    if( $.isFunction($.fn.DataTable) )
    {
        var dataTable = $('#categories-datatable').DataTable( {
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "oLanguage": {
                "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
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
                url : base_url+"articles/categories",
                type: "post",
                error: function(){ 
                    $(".categories-datatable-error").html("");
                    $("#categories-datatable").append('<tbody class="categories-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
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

        $('.category-form').on('submit', function(e){
            e.preventDefault()

            let name = $(this).find('input[name="name"]').val()

            let ini = $(this)

            $.ajax({
                url: ini.attr('action'),
                type: 'post',
                dataType: 'json',
                data: ini.serializeArray(),
                beforeSend: function() {
                    ini.find('button[type="submit"]').prop('disabled', true)
                },
                success: function() {
                    ini.find('button[type="submit"]').prop('disabled', false)

                    ini.find('input[name="name"]').val('')

                    var dataTable = $('#categories-datatable').DataTable( {
                        "serverSide": true,
                        "stateSave" : false,
                        "bAutoWidth": true,
                        "oLanguage": {
                            "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
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
                            url : base_url+"articles/categories",
                            type: "post",
                            error: function(){ 
                                $(".categories-datatable-error").html("");
                                $("#categories-datatable").append('<tbody class="categories-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
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
                        },
                        destroy: true
                    }).ajax.reload(null, false)
                }
            })
        })
    }

    $(document).on('click', '.edit-category', function(e){
        e.preventDefault()

        var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='update-category'>Save</button>";
        Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";

        $('.modal-dialog').removeClass('modal-lg');
        $('.modal-dialog').removeClass('modal-full-width');
        $('.modal-dialog').addClass('modal-sm');

        $('#ModalHeader').html('Edit Category');

        $('#ModalContent').load($(this).attr('href'));
        $('#ModalGue').modal('show');
        $('#ModalFooter').html(Tombol);
    })

    const saveCat = (ini) => {
        $.ajax({
            url: ini.attr('action'),
            data: ini.serializeArray(),
            dataType: 'json',
            type: 'post',
            beforeSend: function() {
                $('#update-category').prop('disabled', true)
            },
            success: function(){
                $('#update-category').prop('disabled', false)

                swal.fire({
                    title: 'Success',
                    text: 'Data has been updated',
                    type: 'success',
                    confirmButtonColor : '#3085D6',
                    confirmButtonText : 'OK!'
                })

                $('#ModalGue').modal('hide')
                
                var dataTable = $('#categories-datatable').DataTable( {
                    "serverSide": true,
                    "stateSave" : false,
                    "bAutoWidth": true,
                    "oLanguage": {
                        "sSearch": "<i class='fa fa-search fa-fw'></i> Search : ",
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
                        url : base_url+"articles/categories",
                        type: "post",
                        error: function(){ 
                            $(".categories-datatable-error").html("");
                            $("#categories-datatable").append('<tbody class="categories-datatable-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
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
                    },
                    destroy: true
                }).ajax.reload(null, false)
            }
        })
    }

    $(document).on('submit', '#edit-category', function(e){
        e.preventDefault()

        let ini = $(this)

        saveCat(ini)
    })

    $(document).on('click', '#update-category', function(e){
        e.preventDefault()

        let ini = $('#edit-category')

        saveCat(ini)
    })

})(jQuery)