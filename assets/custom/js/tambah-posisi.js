( function ( $ ) {

    "use strict";

    var base_url = $('#base_url').val();

    $("#summernote-pengangkatan").summernote({
        // placeholder: "Write something...",
        width: '100%',
        height: 230,
        callbacks: {
            onInit: function(e) {
                $(e.editor).find(".custom-control-description").addClass("custom-control-label").parent().removeAttr("for")
            }
        },
        hint: {
            mentions: [
                'NIK',
                'nama',
                'panggilan',
                'jk',
                'noid',
                'npwp',
                'alamat',
                'tlp',
                'email',
                'company',
                'position',
                'statusKaryawan',
                'registeredday',
                'SK',
                'perusahaan',
                'address',
                'web',
                'emailAddress',
                'phone',
                'fax',
                'pimpinan',
                'now',
            ],
            match: /\B@(\w*)$/,
            search: function(t, e) {
                e($.grep(this.mentions, function(e) {
                    return 0 == e.indexOf(t)
                }))
            },
            content: function(e) {
                return "@" + e
            }
        }
    })

    $("#rootwizard").bootstrapWizard({
        onTabShow: function(tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index+1;
            var $percent = ($current/$total) * 100;
            $('#rootwizard').find('.bar').css({width:$percent+'%'});
        
            // If it's the last tab then hide the last button and show the finish instead
            if($current >= $total) {
                $('#rootwizard').find('.list-inline-item.next').hide();
                $('#rootwizard').find('.list-inline-item.finish').show();
                $('#rootwizard').find('.list-inline-item.finish').removeClass('disabled');
            } else {
                $('#rootwizard').find('.list-inline-item.next').show();
                $('#rootwizard').find('.list-inline-item.finish').hide();
            }
        },
        onNext: function(t, r, a) {

            var o = $($(t).data("targetForm"));
            if (o && (o.addClass("was-validated"), !1 === o[0].checkValidity()))
            {
                return event.preventDefault(), event.stopPropagation(), !1
            }
        }
    })

    $('#rootwizard .finish').on('click', function(e){
        e.preventDefault();

        let formData = $('#posisi, #otoritas').serializeArray()

        $.ajax({
            url: $('#posisi').attr('action'),
            type: "POST",
            data: formData,
            dataType:'json',
            beforeSend:function(){
                $('#loading').addClass('spinner-border');
                $('.finish .btn').html('Saving ...');
                Ladda.bind('.finish .btn');
            },
            success: function(json){
                console.log(json)
                if(json.status === 1){ 
                    $('form').attr('action', base_url + 'user/tambah-posisi/' + json.id);
                    Swal.fire("New data added!", "Your data has been added.", "success");
                }
                else {
                    $('#ResponseInput').html(json.pesan);
                    $('html, body').animate({
                        scrollTop: $("#wrapper").offset().top
                    }, 2000);
                }
                $('#loading').removeClass('spinner-border');
                $('.finish .btn').html('Finish');
                Ladda.stopAll();

            }
        });
    })

    $('#posisi, #jobdesk, #pengangkatan').on('submit', function(e){
        e.preventDefault();

        $("#rootwizard").bootstrapWizard('next');
    })

} )( jQuery );

! function() {

    "use strict";

}(), 0 < $('[data-plugins="dropify"]').length && $('[data-plugins="dropify"]').dropify({
    messages: {
        default: "Drag and drop a file here or click",
        replace: "Drag and drop or click to replace",
        remove: "Remove",
        error: "Ooops, something wrong appended."
    },
    error: {
        fileSize: "The file size is too big (1M max)."
    }
});
