( function ( $ ) {

    "use strict";

    var base_url = $('#base_url').val();

    $(".summernote").summernote({
        placeholder:"Write something...",
        height:230,
    })
}) ( jQuery ), 0 < $('[data-plugins="dropify"]').length && $('[data-plugins="dropify"]').dropify({
    messages: {
        default: "Drag and drop a file here or click",
        replace: "Drag and drop or click to replace",
        remove: "Remove",
        error: "Ooops, something wrong appended."
    },
    error: {
        fileSize: "The file size is too big (3M max)."
    }
});