const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger',
    },
    buttonsStyling: true
})
// =========================================================================
$(function () {
    getdatahargaharian();
});
// =========================================================================
function getdatahargaharian() {
    $('#panel').loading('toggle');
    $('#bodyhargaharian').html('');
    $.ajax({
        type: 'GET',
        url: '/backend/cari-data-harga-harian',
        success: function (data) {
            var rows = '';
            var no = 0;
            $.each(data, function (key, value) {
                no += 1;
                rows = rows + '<tr>';
                rows = rows + '<td class="text-center">' + no + '</td>';
                rows = rows + '<td>' + value.tgl_rilis + '</td>';
                rows = rows + '<td>' + value.nolsatu_gram + '</td>';
                rows = rows + '<td>' + value.noldua_gram + '</td>';
                rows = rows + '<td>' + value.nollima_gram + '</td>';
                rows = rows + '<td>' + value.satu_gram + '</td>';
                rows = rows + '<td>' + value.dua_gram + '</td>';
                rows = rows + '<td>' + value.lima_gram + '</td>';
                rows = rows + '<td>' + value.sepuluh_gram + '</td>';
                if(value.status == 'Active'){
                    rows = rows + '<td class="text-center"><input type="checkbox" id="switch('+ value.id +')" checked data-switch="success"/><label for="switch('+ value.id +')" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label></td>';
                }else{
                    rows = rows + '<td class="text-center"><input type="checkbox" id="switch('+ value.id +')" data-switch="success"/><label for="switch('+ value.id +')" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label></td>';
                }
                rows = rows + '<td><a onclick="edithargaharian(' + value.id + ')" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a></td>';
                rows = rows + '</tr>';
            });
            $('#bodyhargaharian').html(rows);
        }, complete: function () {
            $('#panel').loading('stop');
        }
    });
}
// ==========================================================================
$('#addhargaharianbtn').on('click', function (e) {
    if ($('#tgl_rilis').val() == '' || $('#nolsatu_gram').val() == '' || $('#noldua_gram').val() == '' || $('#nollima_gram').val() == '' || $('#satu_gram').val() == '' || $('#dua_gram').val() == '' || $('#lima_gram').val() == '' || $('#sepuluh_gram').val() == '') {
        swalWithBootstrapButtons.fire({
            title: 'Oops',
            text: 'Data tidak boleh kosog',
            confirmButtonText: 'OK'
        });
        return false;
    } else {
        $('#panel').loading('toggle');
        $('#formaddhargaharian').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name=_token]').val()
                }
            });
            var formData = new FormData(this);
            $.ajax({
                url: '/backend/harga-emas',
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
                    $('#nolsatu_gram').val('');
                    $('#noldua_gram').val('');
                    $('#nollima_gram').val('');
                    $('#satu_gram').val('');
                    $('#dua_gram').val('');
                    $('#lima_gram').val('');
                    $('#sepuluh_gram').val('');
                    $('#addhargaharian').modal('hide');
                    $('#panel').loading('stop');
                    getdatahargaharian();
                }
            });
        });
    }
});
// =======================================================================
function edithargaharian(kode) {
    $('#panel').loading('toggle');
    $.ajax({
        type: 'GET',
        url: '/backend/cari-data-harga-harian/' + kode +'/edit',
        success: function (data) {
            $.each(data, function (key, value) {
                $('#id_hargaharian').val(value.id);
                $('#edit_tgl_rilis').val(value.tgl_rilis);
                $('#edit_nolsatu_gram').val(value.nolsatu_gram);
                $('#edit_noldua_gram').val(value.noldua_gram);
                $('#edit_nollima_gram').val(value.nollima_gram);
                $('#edit_satu_gram').val(value.satu_gram);
                $('#edit_dua_gram').val(value.dua_gram);
                $('#edit_lima_gram').val(value.lima_gram);
                $('#edit_sepuluh_gram').val(value.sepuluh_gram);
            });
        }, complete: function () {
            $('#edithargaharian').modal('show');
            $('#panel').loading('stop');
        }
    });
}
// ====================================================================
$('#edithargaharianbtn').on('click', function (e) {
    if ($('#edit_tgl_rilis').val() == '' || $('#edit_nolsatu_gram').val() == '' || $('#edit_noldua_gram').val() == '' || $('#edit_nollima_gram').val() == '' || $('#edit_satu_gram').val() == '' || $('#edit_dua_gram').val() == '' || $('#edit_lima_gram').val() == '' || $('#edit_sepuluh_gram').val() == '') {
        swalWithBootstrapButtons.fire({
            title: 'Oops',
            text: 'Data tidak boleh kosog',
            confirmButtonText: 'OK'
        });
        return false;
    } else {
        $('#panel').loading('toggle');
        $('#formedithargaharian').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name=_token]').val()
                }
            });
            var formData = new FormData(this);
            $.ajax({
                url: '/backend/harga-emas/'+$('#id_hargaharian').val(),
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
                    $('#edit_nolsatu_gram').val('');
                    $('#edit_noldua_gram').val('');
                    $('#edit_nollima_gram').val('');
                    $('#edit_satu_gram').val('');
                    $('#edit_dua_gram').val('');
                    $('#edit_lima_gram').val('');
                    $('#edit_sepuluh_gram').val('');
                    $('#edithargaharian').modal('hide');
                    $('#panel').loading('stop');
                    getdatahargaharian();
                }
            });
        });
    }
});