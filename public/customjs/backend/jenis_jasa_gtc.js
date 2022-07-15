const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger',
    },
    buttonsStyling: true
})
// =========================================================================
$(function () {
    getdatajenisjasagtc();
});
// =========================================================================
function getdatajenisjasagtc() {
    $('#panel').loading('toggle');
    $('#bodyjenisjasagtc').html('');
    $.ajax({
        type: 'GET',
        url: '/backend/cari-data-jenis-jasa-gtc',
        success: function (data) {
            var rows = '';
            var no = 0;
            $.each(data, function (key, value) {
                no += 1;
                rows = rows + '<tr>';
                rows = rows + '<td class="text-center">' + no + '</td>';
                rows = rows + '<td>' + value.pilihan_jasa + '</td>';
                rows = rows + '<td>' + value.perhitungan_jasa + '</td>';
                if(value.status == 'Active'){
                    rows = rows + '<td><span class="badge badge-success-lighten">Active</span></td>';
                }else{
                    rows = rows + '<td><span class="badge badge-danger-lighten">NonActif</span></td>';
                }
                rows = rows + '<td><a class="action-icon" onclick="editjenisjasagtc(' + value.id + ')"> <i class="mdi mdi-square-edit-outline"></i></a></td>';
                rows = rows + '</tr>';
            });
            $('#bodyjenisjasagtc').html(rows);
        }, complete: function () {
            $('#panel').loading('stop');
        }
    });
}
// ==========================================================================
$('#addjenisjasagtcbtn').on('click', function (e) {
    if ($('#pilihan_jasa').val() == '' || $('#perhitungan_jasa').val() == '' || $('#jangka_waktu_1').val() == '' || $('#pengali_kurangdari_satudelapan_1').val() == '' || $('#pengali_diatas_dua_1').val() == '' || $('#jangka_waktu_2').val() == '' || $('#pengali_kurangdari_satudelapan_2').val() == '' || $('#pengali_diatas_dua_2').val() == '' || $('#jangka_waktu_3').val() == '' || $('#pengali_kurangdari_satudelapan_3').val() == '' || $('#pengali_diatas_dua_3').val() == '' || $('#jangka_waktu_4').val() == '' || $('#pengali_kurangdari_satudelapan_4').val() == '' || $('#pengali_diatas_dua_4').val() == '' || $('#status_1').val() == '') {
        swalWithBootstrapButtons.fire({
            title: 'Oops',
            text: 'Data tidak boleh kosog',
            confirmButtonText: 'OK'
        });
        return false;
    } else {
        $('#panel').loading('toggle');
        $('#formaddjenisjasagtc').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name=_token]').val()
                }
            });
            var formData = new FormData(this);
            $.ajax({
                url: '/backend/jenis-jasa-gtc',
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
                    $('#pilihan_jasa').val('Pilih');
                    $('#perhitungan_jasa').val('');
                    $('#jangka_waktu_1').val('');
                    $('#pengali_kurangdari_satudelapan_1').val('');
                    $('#pengali_diatas_dua_1').val('');
                    $('#jangka_waktu_2').val('');
                    $('#pengali_kurangdari_satudelapan_2').val('');
                    $('#pengali_diatas_dua_2').val('');
                    $('#jangka_waktu_3').val('');
                    $('#pengali_kurangdari_satudelapan_3').val('');
                    $('#pengali_diatas_dua_3').val('');
                    $('#jangka_waktu_4').val('');
                    $('#pengali_kurangdari_satudelapan_4').val('');
                    $('#pengali_diatas_dua_4').val('');
                    $('#status_1').val('Active');
                    $('#addjenisjasagtc').modal('hide');
                    $('#panel').loading('stop');
                    getdatajenisjasagtc();
                }
            });
        });
    }
});
// =======================================================================
function editjenisjasagtc(kode) {
    $('#panel').loading('toggle');
    $.ajax({
        type: 'GET',
        url: '/backend/cari-data-jenis-jasa-gtc/' + kode +'/edit',
        success: function (data) {
            $.each(data, function (key, value) {
                    $('#id_jenisjasagtc').val(value.id);
                    $('#edit_pilihan_jasa').val(value.pilihan_jasa);
                    $('#edit_perhitungan_jasa').val(value.perhitungan_jasa);
                    $('#edit_jangka_waktu_1').val(value.jangka_waktu_1);
                    $('#edit_pengali_kurangdari_satudelapan_1').val(value.pengali_kurangdari_satudelapan_1);
                    $('#edit_pengali_diatas_dua_1').val(value.pengali_diatas_dua_1);
                    $('#edit_jangka_waktu_2').val(value.jangka_waktu_2);
                    $('#edit_pengali_kurangdari_satudelapan_2').val(value.pengali_kurangdari_satudelapan_2);
                    $('#edit_pengali_diatas_dua_2').val(value.pengali_diatas_dua_2);
                    $('#edit_jangka_waktu_3').val(value.jangka_waktu_3);
                    $('#edit_pengali_kurangdari_satudelapan_3').val(value.pengali_kurangdari_satudelapan_3);
                    $('#edit_pengali_diatas_dua_3').val(value.pengali_diatas_dua_3);
                    $('#edit_jangka_waktu_4').val(value.jangka_waktu_4);
                    $('#edit_pengali_kurangdari_satudelapan_4').val(value.pengali_kurangdari_satudelapan_4);
                    $('#edit_pengali_diatas_dua_4').val(value.pengali_diatas_dua_4);
                    $('#edit_status_1').val(value.status);
            });
        }, complete: function () {
            $('#editjenisjasagtc').modal('show');
            $('#panel').loading('stop');
        }
    });
}
// ====================================================================
$('#editjenisjasagtcbtn').on('click', function (e) {
    if ($('#edit_pilihan_jasa').val() == '' || $('#edit_perhitungan_jasa').val() == '' || $('#edit_jangka_waktu_1').val() == '' || $('#edit_pengali_kurangdari_satudelapan_1').val() == '' || $('#edit_pengali_diatas_dua_1').val() == '' || $('#edit_jangka_waktu_2').val() == '' || $('#edit_pengali_kurangdari_satudelapan_2').val() == '' || $('#edit_pengali_diatas_dua_2').val() == '' || $('#edit_jangka_waktu_3').val() == '' || $('#edit_pengali_kurangdari_satudelapan_3').val() == '' || $('#edit_pengali_diatas_dua_3').val() == '' || $('#edit_jangka_waktu_4').val() == '' || $('#edit_pengali_kurangdari_satudelapan_4').val() == '' || $('#edit_pengali_diatas_dua_4').val() == '' || $('#edit_status_1').val() == '') {
        swalWithBootstrapButtons.fire({
            title: 'Oops',
            text: 'Data tidak boleh kosog',
            confirmButtonText: 'OK'
        });
        return false;
    } else {
        $('#panel').loading('toggle');
        $('#formeditjenisjasagtc').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name=_token]').val()
                }
            });
            var formData = new FormData(this);
            $.ajax({
                url: '/backend/jenis-jasa-gtc/'+$('#id_jenisjasagtc').val(),
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
                    $('#pilihan_jasa').val('Pilih');
                    $('#perhitungan_jasa').val('');
                    $('#jangka_waktu_1').val('');
                    $('#pengali_kurangdari_satudelapan_1').val('');
                    $('#pengali_diatas_dua_1').val('');
                    $('#jangka_waktu_2').val('');
                    $('#pengali_kurangdari_satudelapan_2').val('');
                    $('#pengali_diatas_dua_2').val('');
                    $('#jangka_waktu_3').val('');
                    $('#pengali_kurangdari_satudelapan_3').val('');
                    $('#pengali_diatas_dua_3').val('');
                    $('#jangka_waktu_4').val('');
                    $('#pengali_kurangdari_satudelapan_4').val('');
                    $('#pengali_diatas_dua_4').val('');
                    $('#status_1').val('Active');
                    $('#editjenisjasagtc').modal('hide');
                    $('#panel').loading('stop');
                    getdatajenisjasagtc();
                }
            });
        });
    }
});