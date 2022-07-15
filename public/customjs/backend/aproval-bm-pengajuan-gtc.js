const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger',
    },
    buttonsStyling: true
})
$('#btneditaprovalbm').on('click', function (e) {
    $('#panel').loading('toggle');
    $('#formeditaprovalbm').on('submit', function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('input[name=_token]').val()
            }
        });
        var formData = new FormData(this);
        $.ajax({
            url: '/backend/edit-aproval-bm-pengajuan-gtc/'+$('#id_pengajuan').val(),
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function () {
                swalWithBootstrapButtons.fire({
                    title: 'Info',
                    text: 'Aproval BM berhasil diperbaharui',
                    confirmButtonText: 'OK'
                });
            }, complete: function () {
                $('#panel').loading('stop');
                window.location.replace("/backend/pengajuan-gtc");
            }
        });
    });
});