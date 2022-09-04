( function ( $ ) {

    "use strict";

    var base_url = $('#base_url').val();

    function CustomDataTable(id, url, destroy = false, FormData = null, Searching = false) 
    {
        var Data = 'post='+encodeURI('true')

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
                data: { firstdate: $('.first-date').val(), enddate: $('.end-date').val() },
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

    var kategori = $('#sparepart-report').data('cat')

    CustomDataTable('#sparepart-report', base_url+"report/sparepart/"+kategori, false, $('.form-filter input'))

    CustomDataTable('#daily-stock', base_url+"report/daily-stock-json", false, $('.form-filter select'))

    CustomDataTable('#recommended-order', base_url+"report/recommended-order-json", false, $('.form-filter input'), true)

    $(document).on('click', '.filter', function(event) {
        event.preventDefault();
        CustomDataTable('#daily-stock', base_url+"report/daily-stock-json", true, $('.form-filter input'))
    });
    $(document).on('click', '.filter', function(event) {
        event.preventDefault();
        var kategori = $('#sparepart-report').data('cat')
        CustomDataTable('#sparepart-report', base_url+"report/sparepart/"+kategori, false, $('.form-filter input'))
    });

    $(document).on('click', '#print-item, #pdf-item, #excel-item', function(event) {
        event.preventDefault();
        var data = ''
        if ($(this).attr('id') == 'pdf-item') {
            data = '&pdf=yes'
        }else if($(this).attr('id') == 'excel-item'){
            data = '&excel=yes'
        }
        $('#sparepart-report').find('tbody').find('tr').each(function(index, el) {
            data += '&partCode[]=' + $(this).find('td').eq(1).text()
            data += '&partName[]=' + $(this).find('td').eq(2).text()
            data += '&partCat[]=' + $(this).find('td').eq(3).text()
            data += '&abcCat[]=' + $(this).find('td').eq(4).text()
            data += '&salesQty[]=' + $(this).find('td').eq(5).text()
            data += '&salesAmount[]=' + $(this).find('td').eq(6).text()
            data += '&lastStock[]=' + $(this).find('td').eq(7).text()
            data += '&ratio[]=' + $(this).find('td').eq(8).text()
        });
        data += '&type=item'
        if ($(this).attr('id') == 'pdf-item' || $(this).attr('id') == 'excel-item') {
            window.location.href = base_url + 'report/print-item' + '?cetak=1' + data 
        }else{
            window.open(
                   base_url + 'report/print-item' + '?cetak=1' + data,
                        'popUpWindow',
                        'height=700,width=1200,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
        }

    });
    $(document).on('click', '#print-daily, #pdf-daily, #excel-daily', function(event) {
        event.preventDefault();
        var data = ''
        if ($(this).attr('id') == 'pdf-daily') {
            data = '&pdf=yes'
        }else if($(this).attr('id') == 'excel-daily'){
            data = '&excel=yes'
        }
        $('#daily-stock').find('tbody').find('tr').each(function(index, el) {
            data += '&no[]=' + $(this).find('td').eq(0).text()
            data += '&partCode[]=' + $(this).find('td').eq(1).text()
            data += '&partName[]=' + $(this).find('td').eq(2).text()
            data += '&partCat[]=' + $(this).find('td').eq(3).text()
            data += '&partLoc[]=' + $(this).find('td').eq(4).text()
            data += '&partQty[]=' + $(this).find('td').eq(5).text()
        });
        data += '&type=daily'
        if ($(this).attr('id') == 'pdf-daily' || $(this).attr('id') == 'excel-daily') {
            window.location.href = base_url + 'report/print-item' + '?cetak=1' + data 
        }else{
            window.open(
                   base_url + 'report/print-item' + '?cetak=1' + data,
                        'popUpWindow',
                        'height=700,width=1200,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
        }

    });
    $(document).on('click', '#print-recommended, #pdf-recommended, #excel-recommended', function(event) {
        event.preventDefault();
        var data = ''
        if ($(this).attr('id') == 'pdf-recommended') {
            data = '&pdf=yes'
        }else if($(this).attr('id') == 'excel-recommended'){
            data = '&excel=yes'
        }
        $('#recommended-order').find('tbody').find('tr').each(function(index, el) {
            data += '&no[]=' + $(this).find('td').eq(0).text()
            data += '&partCode[]=' + $(this).find('td').eq(1).text()
            data += '&partName[]=' + $(this).find('td').eq(2).text()
            data += '&partCat[]=' + $(this).find('td').eq(3).text()
            data += '&abcCat[]=' + $(this).find('td').eq(4).text()
            data += '&recomd[]=' + $(this).find('td').eq(5).text()
        });
        data += '&type=recommended'
        if ($(this).attr('id') == 'pdf-recommended' || $(this).attr('id') == 'excel-recommended') {
            window.location.href = base_url + 'report/print-item' + '?cetak=1' + data 
        }else{
            window.open(
                   base_url + 'report/print-item' + '?cetak=1' + data,
                        'popUpWindow',
                        'height=700,width=1200,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
        }

    });



}) ( jQuery )