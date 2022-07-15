function restoredatapengajuan(kode) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger',
        },
        buttonsStyling: true
    })
    swalWithBootstrapButtons.fire({
        title: 'Pulihkan Data ?',
        text: "Data yang dipulihkan akan tampil di pengajuan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Pulihkan!',
        cancelButtonText: 'Tidak',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $('#panel').loading('toggle');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                type: 'DELETE',
                url: '/backend/restore-histori-pengajuan/' + kode,
                data: {
                    'token': $('input[name=_token]').val(),
                },
                success: function () {
                    swalWithBootstrapButtons.fire(
                        'Pemulihan!',
                        'Data Berhasil Dipulihkan.',
                        'success'
                    );
                    $('#panel').loading('stop');
                    window.location.replace("/backend/del-pengajuan-gtc");
                }
            })
        }
    })
}