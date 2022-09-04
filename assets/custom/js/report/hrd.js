( function ( $ ) {

    "use strict";

    var base_url = $('#base_url').val();

    function CustomDataTable(id, url, destroy = false, FormData = null, Searching = false, is_default = false) 
    {
        var Data = 'post='+encodeURI('true')
        var filter = {}
        if (!FormData) {
            filter = { firstdate: $('.first-date').val(), enddate: $('.end-date').val() }
        }else{
            if (is_default) {
                filter = {status : ''}
            }else{
                filter = {status : FormData.val()}
            }
        }


        var custom = $(id).DataTable({
            "serverSide": true,
            "stateSave" : false,
            "bAutoWidth": true,
            "searching": Searching,
            "oLanguage": {
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
                url : url,
                type: "post",
                data: filter,
            },
            // lengthChange: !1,
            drawCallback: function() {
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
            },
            "destroy": destroy
        })

        if(destroy)
            custom.ajax.reload(null, false)
    }


    CustomDataTable('#employee-join', base_url+"report/employee-join/", false, $('.form-filter select'))

    $(document).on('click', '.filter', function(event) {
        event.preventDefault();
        CustomDataTable('#employee-join', base_url+"report/employee-join", true, $('.form-filter select'))
    });

    CustomDataTable('#thr', base_url+"report/thr/", false, $('.form-filter input'))

    $(document).on('click', '.filter', function(event) {
        event.preventDefault();
        CustomDataTable('#thr', base_url+"report/thr", true, $('.form-filter input'))
    });
    CustomDataTable('#payroll', base_url+"report/payroll/", false, $('.form-filter input'))

    $(document).on('click', '.filter', function(event) {
        event.preventDefault();
        CustomDataTable('#payroll', base_url+"report/payroll", true, $('.form-filter input'))
    });

     CustomDataTable('#insentif', base_url+"report/insentif/", false, $('.form-filter input'))

    $(document).on('click', '.filter', function(event) {
        event.preventDefault();
        CustomDataTable('#insentif', base_url+"report/insentif", true, $('.form-filter input'))
    });
    $(document).on('click', '#refresh-payroll', function(event) {
        event.preventDefault();
        $(this).closest('div.form-filter').find('input').val('')
        CustomDataTable('#payroll', base_url+"report/payroll", true, $('.form-filter input'), false, true)
    });
    $(document).on('click', '#refresh-insentif', function(event) {
        event.preventDefault();
        $(this).closest('div.form-filter').find('input').val('')
        CustomDataTable('#insentif', base_url+"report/insentif", true, $('.form-filter input'), false, true)
    });
    $(document).on('click', '#refresh-thr', function(event) {
        event.preventDefault();
        $(this).closest('div.form-filter').find('input').val('')
        CustomDataTable('#thr', base_url+"report/thr", true, $('.form-filter input'), false, true)
    });


    function action(type, params, id)
    {
        var data = ''
        data += params
        if (id == 'pdf-' + type) {
            data += '&pdf=yes'
        }else if(id == 'excel-' + type){
            data += '&excel=yes'
        }
        data += '&type=' + type
        if (id == 'pdf-' + type || id == 'excel-' + type) {
            window.location.href = base_url + 'report/print-item' + '?cetak=1' + data 
        }else{
            window.open(
                   base_url + 'report/print-item' + '?cetak=1' + data,
                        'popUpWindow',
                        'height=700,width=1200,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
        }
    }

    $(document).on('click', '#print-join, #pdf-join, #excel-join', function(event) {
        event.preventDefault();
        var data = ''
        $('#employee-join').find('tbody').find('tr').each(function(index, el) {
            data += '&no[]=' + $(this).find('td').eq(0).text()
            data += '&name[]=' + $(this).find('td').eq(1).text()
            data += '&position[]=' + $(this).find('td').eq(2).text()
            data += '&date[]=' + $(this).find('td').eq(3).text()
            data += '&status[]=' + $(this).find('td').eq(4).html()
        });
        action('join', data, $(this).attr('id'))
    });

    $(document).on('click', '#print-thr, #pdf-thr, #excel-thr', function(event) {
        event.preventDefault();
        var data = ''
        $('#thr').find('tbody').find('tr').each(function(index, el) {
            data += '&no[]=' + $(this).find('td').eq(0).text()
            data += '&year[]=' + $(this).find('td').eq(1).text()
            data += '&total[]=' + $(this).find('td').eq(2).text()
            data += '&status[]=' + $(this).find('td').eq(3).html()
        });
        action('thr', data, $(this).attr('id'))
    });
    $(document).on('click', '#print-payroll, #pdf-payroll, #excel-payroll', function(event) {
        event.preventDefault();
        var data = ''
        $('#payroll').find('tbody').find('tr').each(function(index, el) {
            data += '&no[]=' + $(this).find('td').eq(0).text()
            data += '&month[]=' + $(this).find('td').eq(1).text()
            data += '&fee[]=' + $(this).find('td').eq(2).text()
            data += '&potongan[]=' + $(this).find('td').eq(3).text()
            data += '&thp[]=' + $(this).find('td').eq(4).text()
            data += '&statusThp[]=' + $(this).find('td').eq(5).html()
            data += '&bpjs[]=' + $(this).find('td').eq(6).text()
            data += '&statusBpjs[]=' + $(this).find('td').eq(7).html()
        });
        action('payroll', data, $(this).attr('id'))
    });$(document).on('click', '#print-insentif, #pdf-insentif, #excel-insentif', function(event) {
        event.preventDefault();
        var data = ''
        $('#insentif').find('tbody').find('tr').each(function(index, el) {
            data += '&no[]=' + $(this).find('td').eq(0).text()
            data += '&month[]=' + $(this).find('td').eq(1).text()
            data += '&total[]=' + $(this).find('td').eq(2).text()
            data += '&statusTotal[]=' + $(this).find('td').eq(3).html()
            data += '&reward[]=' + $(this).find('td').eq(4).text()
            data += '&statusReward[]=' + $(this).find('td').eq(5).html()
        });
        action('insentif', data, $(this).attr('id'))
    });
}) ( jQuery )