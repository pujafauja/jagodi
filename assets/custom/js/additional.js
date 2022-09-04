( function ( $ ) {

    "use strict";

    var base_url = $('#base_url').val();

    function customDT(id, url, destroy = false, formData = false)
    {
        if( $.isFunction($.fn.DataTable) )
        {
            var data = {}
            if (formData) {
                data = formData
            }else{
                data = {status : 'all', first_date : '', last_date : ''}
            }
            /*if (destroy) {
                var dataTable = $('#'+id).DataTable( {
                    "ajax":{
                        url : url,
                        type: "post",
                        data: data,
                        error: function(){ 
                            $("."+id+"-error").html("");
                            $("#"+id).append('<tbody class="'+id+'-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                            $("#"+id+"_processing").css("display","none");
                        }
                    },
                    "destroy": destroy
                } ).ajax.reaload(null, false);
            }else{*/
                var dataTable = $('#'+id).DataTable( {
                    "serverSide": true,
                    "stateSave" : false,
                    "bAutoWidth": true,
                    "searching": false,
                    "oLanguage": {
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
                        url : url,
                        type: "post",
                        data: data,
                        error: function(){ 
                            $("."+id+"-error").html("");
                            $("#"+id).append('<tbody class="'+id+'-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                            $("#"+id+"_processing").css("display","none");
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
                    "destroy": destroy
                } );
            // }

            if(destroy)
                dataTable.ajax.reload(null, false)
        }
    }

    $('.add-datatable').each(function(){
        var id     = $(this).attr('id')
        var type   = $(this).data('cat')
        var target = base_url + 'additional/summary/' + type

        customDT(id, target, false)
    })

    $(document).on('click', '#alldate, #filter', function(event) {
        event.preventDefault();

        /*var type = ''
        $('.tab-summary').find('li.nav-item').each(function(index, el) {
            if ($(this).find('a').hasClass('active')) {
                type = $(this).find('a').data('type')
            }
        });*/
        var status = $('select[name=Status]').val()
        var first_date = $('input[name=date-first]').val()
        var last_date = $('input[name=date-last]').val()
        var data = {}
        // console.log(type)
        if ($(this).attr('id') == 'alldate') {
            data = {status : 'all'}            
        }else{
            data = {status : status, start_date : first_date, last_date : last_date}
        }

        $('.add-datatable').each(function(){
            var id     = $(this).attr('id')
            var type   = $(this).data('cat')
            var target = base_url + 'additional/summary/' + type

            customDT(id, target, true, data)
        })

        // console.log(type)
        // customDT(type + '-dt', base_url + 'additional/summary/' + type , false, true, data)            
    });

    $(document).on('click', '.print-wo', function(e) {
        e.preventDefault()

        var target = $(this).attr('href')

        window.open(
            target,
            'popUpWindow',
            'height=567,width=793,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes'
        )
    })

    $(document).on('click', '.delete-additional', function(event) {
        event.preventDefault();
        var target = $(this).attr('href');
        var table = $(this).data('type') + '-dt'
        deleted_additional(table, target)
    });

    function deleted_additional(table, target)
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

}) ( jQuery )