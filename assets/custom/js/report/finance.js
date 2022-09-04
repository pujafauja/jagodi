( function ( $ ) {

    "use strict";

    var base_url = $('#base_url').val();

    var updateOutput = function(t){
        var e = t.length ? t : $(t.target),
            a = e.data('output')

        // console.log(e.find('.dd-item').length)
    }

    function customDT(id, url, destroy = false, formData = false)
    {
        if( $.isFunction($.fn.DataTable) )
        {
            if(formData)
                var data = formData
            else
                var data = []

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

            if(destroy)
                dataTable.ajax.reload(null, false)
        }
        else
            console.log('Please turn on datatable plugins')
    }

    $('#nestable_list_1').nestable({
        group: 1,
        maxDepth: 7,
    }).on('change', updateOutput)

    $("div")
        .mousedown(function(e) {
            var that = e.length ? e : $(e.target)
            var postable = that.closest('.dd-item').data('postable')
            var id = that.closest('.dd-item').data('id')

            if(postable == true)
            {
                var date     = new Date();
                var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
                var lastDay  = new Date(date.getFullYear(), date.getMonth() + 1, 0);

                var dd   = String(firstDay. getDate()). padStart(2, '0');
                var mm   = String(firstDay. getMonth() + 1). padStart(2, '0');
                var yyyy = firstDay. getFullYear();

                var DD   = String(lastDay. getDate()). padStart(2, '0');
                var MM   = String(lastDay. getMonth() + 1). padStart(2, '0');
                var YYYY = lastDay. getFullYear();

                $.ajax({
                    url: base_url + 'report/coa-detail/' + id,
                    dataType: 'json',
                    success: function(response) {
                        if($('#filter-location').find('.alert').length)
                        {
                            $('#filter-location').html('<input type="hidden" name="coaid" value="'+id+'">\
                                <div class="form-group">\
                                    <label>Periode</label>\
                                    <div class="input-group">\
                                        <input type="text" name="first-date" class="form-control basic-datepicker" value="'+ yyyy + '-' + mm + '-' + dd +'">\
                                        <div class="input-group-append">\
                                            <span class="input-group-text">-</span>\
                                        </div>\
                                        <input type="text" name="last-date" class="form-control basic-datepicker" value="'+ YYYY + '-' + MM + '-' + DD +'">\
                                    </div>\
                                </div>\
                                <div class="row mb-2 text-right">\
                                    <div class="col-12">\
                                        <button class="btn btn-primary filter-ledger"><i class="fas fa-filter mr-1"></i>Filter</button>\
                                    </div>\
                                </div>\
                                <h4 class="text-center header-title">'+response.kode+' '+response.nama+'</h4>\
                                <p class="text-center sub-header">Periode '+dd+'/'+ mm +'/'+yyyy+' - '+DD+'/'+ MM +'/'+YYYY+'</p>\
                            ')

                            $(".basic-datepicker").flatpickr()
                        } else {
                            $('input[name="coaid"]').val(id)
                            $('.header-title').text(response.kode+' '+response.nama)
                            $('.sub-header').text('Periode '+dd+'/'+ mm +'/'+yyyy+' - '+DD+'/'+ MM +'/'+YYYY)
                        }
                    }
                })

                var data = {
                    coaid:    id,
                    firstday: yyyy + '-' + mm + '-' + dd,
                    lastday:  YYYY + '-' + MM + '-' + DD,
                }

                if(! $.fn.dataTable.isDataTable('#ledger-data') )
                    customDT('ledger-data', base_url + 'report/ledger', false, data)
                else
                    customDT('ledger-data', base_url + 'report/ledger', true, data)
            }

            e.stopPropagation()
        });

    $(document).on('click', '.filter-ledger', function(e){
        e.preventDefault()

        let coaid    = $('input[name="coaid"]').val()
        var firstday = $('input[name="first-date"]').val()
        var lastday  = $('input[name="last-date"]').val()

        var firstDay = new Date(firstday)
        var lastDay = new Date(lastday)

        var dd   = String(firstDay. getDate()). padStart(2, '0');
        var mm   = String(firstDay. getMonth() + 1). padStart(2, '0');
        var yyyy = firstDay. getFullYear();

        var DD   = String(lastDay. getDate()). padStart(2, '0');
        var MM   = String(lastDay. getMonth() + 1). padStart(2, '0');
        var YYYY = lastDay. getFullYear();

        $('.sub-header').text('Periode '+dd+'/'+ mm +'/'+yyyy+' - '+DD+'/'+ MM +'/'+YYYY)

        var data = {
            coaid:    coaid,
            firstday: firstday,
            lastday:  lastday,
        }

        customDT('ledger-data', base_url + 'report/ledger', true, data)
    })

    customDT('cash-data', base_url + 'report/cash-flow', false, false)

}) (jQuery)