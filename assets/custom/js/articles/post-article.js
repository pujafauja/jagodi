( function ( $ ) {

    "use strict";

    let base_url = $('#base_url').val();

    $(".article-content").summernote({
        placeholder:"Write something...",
        height:500,
    })

    $('[data-plugins="dropify"]').dropify({
        messages: {
            default: "Drag and drop a file here or click",
            replace: "Drag and drop or click to replace",
            remove: "Remove",
            error: "Ooops, something wrong appended."
        },
        error: {
            fileSize: "The file size is too big (3M max)."
        }
    })

    let cats = new Array();

    function arrayRemove(arr, value) { 
    
        return arr.filter(function(ele){ 
            return ele != value; 
        });
    }

    let catsOri = $('#categories').val()
    
    if(catsOri != '') {
        catsOri = JSON.parse(catsOri)
        catsOri.forEach(cat => {
            $('#selected-category').append('<span data-catid="'+cat.id+'" class="badge badge-outline-primary badge-pill mr-2">'+cat.name+' <a class="remove-category" href=""><i class="fe-x"></i></a></span>')
        });
    } else {
        catsOri = new Array()
    }

    $(document).on('click', '.remove-category', function(e){
        e.preventDefault()
        let id = $(this).parent('span').data('catid')

        let cats = arrayRemove(catsOri, id)
        $('#categories').val(JSON.stringify(cats))
        $(this).parent('span').remove()
    })
    
    // var result = arrayRemove(array, 6);

    $('#find-category').autocomplete({
        serviceUrl: base_url + 'articles/categories-data/',
        onSelect: function (suggestion) {
            $('#find-category').val('')
            if (catsOri.indexOf(suggestion.id) < 0) {
                $('#selected-category').append('<span data-catid="'+suggestion.id+'" class="badge badge-outline-primary badge-pill mr-2">'+suggestion.value+' <a class="remove-category" href=""><i class="fe-x"></i></a></span>')
                catsOri.push({
                    id: suggestion.id,
                    name: suggestion.value
                })
                $('#categories').val(JSON.stringify(catsOri))
            }
        }
    })

    $('.new-category').on('click', function(e){
        e.preventDefault()

        $('.modal-dialog').removeClass('modal-md');
        $('.modal-dialog').removeClass('modal-full-width');
        $('.modal-dialog').addClass('modal-sm');

        $('#ModalHeader').html('Add New Category');
        $('#ModalContent').load($(this).attr('href'));
        $('#ModalGue').modal('show');

        var Tombol = "<button type='button' class='btn btn-primary waves-effect waves-light' id='SimpanCategory'>Save</button>";
        Tombol += "<button type='button' class='btn btn-default waves-effect waves-light' data-dismiss='modal'>Close</button>";
        
        $('#ModalFooter').html(Tombol);

    })

    $(document).on('click', '#SimpanCategory', function(e){
        e.preventDefault()

        const nama = $('input[name="name"]').val()

        $.ajax({
            url: base_url + 'articles/save-category',
            data: $('#new-category').serializeArray(),
            type: 'post',
            dataType: 'json',
            beforeSend: function() {
                $('#SimpanCategory').html('<i class="fas fa-spin fa-circle-notch mr-1"></i>Saving ...')
                $('#SimpanCategory').prop('disabled', true)
            },
            success: function(result) {
                $('#SimpanCategory').html('Save')
                $('#SimpanCategory').prop('disabled', false)

                if(result.status === 1) {
                    Swal.fire({
                        title: "Success!",
                        html: result.pesan,
                        type: "success"
                    })

                    $('#selected-category').append('<span data-catid="'+result.id+'" class="badge badge-outline-primary badge-pill mr-2">'+result.nama+' <a class="remove-category" href=""><i class="fe-x"></i></a></span>')
                    catsOri.push({
                        id: result.id,
                        name: nama
                    })
                    $('#categories').val(JSON.stringify(catsOri))

                    $('#ModalGue').modal('hide')
                } else {
                    Swal.fire({
                        title: "Error!",
                        html: result.pesan,
                        type: "error"
                    })
                }
            }
        })
    })

    $(".selectize-close-btn").selectize({
        plugins:["remove_button"],
        persist:!1,
        create:!0,
        render: {
            item:function(e,a){
                return'<div>"'+a(e.text)+'"</div>'
            }
        },
        onDelete:function(e){
            return confirm(1<e.length?"Are you sure you want to remove these "+e.length+" items?":'Are you sure you want to remove "'+e[0]+'"?')
        }
    })

    $('.save-article').on('click', (e) => {
        e.preventDefault()

        let data = new FormData($('#myAwesomeDropzone')[0])
        
        let contentEN = $('#contentEN').summernote('code')
        let contentINA = $('#contentINA').summernote('code')

        data.append('content', contentEN)
        data.append('isi', contentINA)
        data.append('title', $('input[name="title"]').val())
        data.append('judul', $('input[name="judul"]').val())
        data.append('categories', $('input[name="categories"]').val())
        data.append('tags', $('input[name="tags"]').val())
        data.append('id', $('input[name="id"]').val())

        $.ajax({
            url: base_url + '/articles/save',
            type: 'POST',
            cache: false,
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('.save-article').html('<i class="fas fa-spin fa-circle-notch mr-1"></i>Publishing ...')
                $('.save-article').prop('disabled', true)
            },
            success: function(res) {
                $('.save-article').html('Publish')
                $('.save-article').prop('disabled', false)

                if(res.status === true) {
                    window.location.href = base_url + 'articles'
                } else {
                    Swal.fire({
                        title: "Error!",
                        html: res.pesan,
                        type: "error"
                    })
                }
            }
        })
    })

})(jQuery)