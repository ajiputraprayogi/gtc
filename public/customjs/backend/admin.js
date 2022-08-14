const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger',
    },
    buttonsStyling: true
});

$(function () {
    var kode = $('#id_pengajuan').val()
    $('#list-data').DataTable({
        processing: true,
        serverSide: true,
        scrollX:!0,
        language:{
        paginate:{
            previous:"<i class='mdi mdi-chevron-left'>",
            next:"<i class='mdi mdi-chevron-right'>",
        }
        },
        // drawCallback:function(){
        //     $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
        // }
        order: [[0, "desc"]],
        ajax: '/backend/data-admin',
        columns: [
            {
                data: 'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'nama', name: 'nama' },
            { data: 'username', name: 'username' },
            { data: 'email', name: 'email' },
            { data: 'jabatan', name: 'jabatan' },
            { data: 'kantor', name: 'kantor' },
            { data: 'grup', name: 'grup' },
            {
                render: function (data, type, row) {
                    if(row.sts === 1){
                        return '<span class="badge badge-danger-lighten">NonActive</span>'
                    }else{
                        return '<span class="badge badge-success-lighten">Active</span>'
                    }
                },
                "className": 'text-center',
                "orderable": false,
                "data": null,
            },
            {
                render: function (data, type, row) {
                    return '<a onclick="editakun('+ row['idu'] +')" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>'
                },
                "className": 'text-center',
                "orderable": false,
                "data": null,
            },
        ],
        pageLength: 10,
        lengthMenu: [[5, 10, 20], [5, 10, 20]]
    });
});

// ===============================================================
$('#btntambahakun').on('click', function (e) {
    // if ($('#tgl_rilis').val() == '' || $('#nolsatu_gram').val() == '' || $('#noldua_gram').val() == '' || $('#nollima_gram').val() == '' || $('#satu_gram').val() == '' || $('#dua_gram').val() == '' || $('#lima_gram').val() == '' || $('#sepuluh_gram').val() == '') {
    //     swalWithBootstrapButtons.fire({
    //         title: 'Oops',
    //         text: 'Data tidak boleh kosog',
    //         confirmButtonText: 'OK'
    //     });
    //     return false;
    // } else {
        $('#panel').loading('toggle');
        $('#formtambahakun').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name=_token]').val()
                }
            });
            var formData = new FormData(this);
            $.ajax({
                url: '/backend/pengaturan-akun',
                type: 'post',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function () {
                    swalWithBootstrapButtons.fire({
                        title: 'Info',
                        text: 'Data Berhasil disimpan',
                        confirmButtonText: 'OK'
                    });
                }, complete: function () {
                    $('#tambah_namakaryawan').val('');
                    $('#tambah_userid').val('');
                    $('#tambah_email').val('');
                    $('#tambah_jabatan').val('');
                    $('#tambah_kantor').val('Pilihan');
                    $('#tambah_grup').val('Pilihan');
                    $('#tambah_password').val('');
                    $('#tambah_password_confirmation').val('');
                    $('#tambah_status').val('0');
                    $('#tambahakun').modal('hide');
                    $('#panel').loading('stop');
                    $('#list-data').DataTable().ajax.reload();
                }
            });
        });
    // }
});
// ===============================================================
function editakun(kode){
    $('#panel').loading('toggle');
    $.ajax({
        type: 'GET',
        url: '/backend/cari-pengaturan-akun/' + kode +'/edit',
        success: function (data) {
            $.each(data.data, function (key, value) {
                $('#edit_id').val(value.id);
                $('#edit_namakaryawan').val(value.nama);
                $('#edit_userid').val(value.username);
                $('#old_edit_userid').val(value.username);
                $('#edit_email').val(value.email);
                $('#old_edit_email').val(value.email);
                $('#edit_jabatan').val(value.jabatan);
                $('#edit_kantor').val(value.kantor);
                $('#edit_grup').val(value.role);
                $('#edit_password').val('');
                $('#edit_password_confirmation').val('');
                $('#edit_status').val(value.status);
            });
        }, complete: function () {
            $('#editakun').modal('show');
            $('#panel').loading('stop');
        }
    });
}
// ===============================================================
$('#btneditakun').on('click', function (e) {
    // if ($('#edit_tgl_rilis').val() == '' || $('#edit_nolsatu_gram').val() == '' || $('#edit_noldua_gram').val() == '' || $('#edit_nollima_gram').val() == '' || $('#edit_satu_gram').val() == '' || $('#edit_dua_gram').val() == '' || $('#edit_lima_gram').val() == '' || $('#edit_sepuluh_gram').val() == '') {
    //     swalWithBootstrapButtons.fire({
    //         title: 'Oops',
    //         text: 'Data tidak boleh kosog',
    //         confirmButtonText: 'OK'
    //     });
    //     return false;
    // } else {
        $('#panel').loading('toggle');
        $('#formeditakun').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name=_token]').val()
                }
            });
            var formData = new FormData(this);
            $.ajax({
                url: '/backend/pengaturan-akun/'+$('#edit_id').val(),
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function () {
                    swalWithBootstrapButtons.fire({
                        title: 'Info',
                        text: 'Data Berhasil diperbarui',
                        confirmButtonText: 'OK'
                    });
                }, complete: function () {
                    $('#edit_namakaryawan').val('');
                    $('#edit_userid').val('');
                    $('#edit_email').val('');
                    $('#edit_jabatan').val('');
                    $('#edit_kantor').val('Pilihan');
                    $('#edit_grup').val('Pilihan');
                    $('#edit_password').val('');
                    $('#edit_password_confirmation').val('');
                    $('#edit_status').val('0');
                    $('#editakun').modal('hide');
                    $('#panel').loading('stop');
                    $('#list-data').DataTable().ajax.reload();
                }
            });
        });
    // }
});
// ===============================================================
function hapusdata(kode) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: true
    })
    swalWithBootstrapButtons.fire({
        title: 'Hapus Data ?',
        text: "Data tidak dapat di pulihkan kembali!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Tidak',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'DELETE',
                url: '/backend/admin/' + kode,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function () {
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    $('#list-data').DataTable().ajax.reload();
                }
            });
        }
    })
}
window.hapusdata = hapusdata;