const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger',
    },
    buttonsStyling: true
})
// =======================================================
$(function(){
    tidaksesuaiktp();
    getTotal();
    keping();
})
// =======================================================
$('#cari').click(function(e){
    $('#panel').loading('toggle');
    $('#id_anggota').val('')
    $('#nama_lengkap').val('')
    $('#no_hp').val('')
    $('#email').val('')
    $('#detailpemohonbtn').prop('disabled', true)
    $('#datacifanggotabtn').prop('disabled', true)
    $('#btnmodaladdemasgtc').prop('disabled', true)
    // ========================================================
    $('#detail_nomor_buku_anggota').text(': ')
    $('#detail_nama_lengkap').text(': ')
    $('#detail_nomor_hp').text(': ')
    $('#detail_email').text(': ')
    $('#detail_nomor_ktp').text(': ')
    $('#detail_jenis_kelamin').text(': ')
    $('#detail_tempat_lahir').text(': ')
    $('#detail_tanggal_lahir').text(': ')
    $('#detail_status_pernikahan').text(': ')
    $('#detail_nomor_npwp').text(': ')
    $('#detail_alamat_sesuai_ktp').text(': ')
    $('#detail_kecamatan').text(': ')
    $('#detail_kota_kabupaten').text(': ')
    $('#detail_provinsi').text(': ')
    $('#detail_alamat_tinggal').text(': ')
    $('#detail_alamat_tinggal_domisili').text(': ')
    $('#detail_kecamatan_domisili').text(': ')
    $('#detail_kota_kabupaten_domisili').text(': ')
    $('#detail_provinsi_domisili').text(': ')
    $('#detail_photo_ktp').text(': ')
    // ===============================================================
    $('#tambah_id_anggota').val('')
    $('#tambah_nomor_ba').val('')
    $('#tambah_nama_lengkap').val('')
    $('#tambah_nomor_hp').val('')
    $('#tambah_email').val('')
    $('#tambah_nomor_ktp').val('')
    $('#tambah_jenis_kelamin').val('')
    $('#tambah_tempat_lahir').val('')
    $('#tambah_tanggal_lahir').val('')
    $('#tambah_status_pernikahan').val('')
    $('#tambah_nomor_npwp').val('')
    $('#tambah_alamat_sesuai_ktp').val('')
    $('#tambah_alamat_tinggal').val('')
    $('#tambah_alamat_domisili').val('')
    $('#tambah_old_provinsi').val('')
    $('#tambah_old_kota').val('')
    $('#tambah_old_kecamatan').val('')
    $('#tambah_old_kelurahan').val('')
    $('#tambah_old_provinsi_domisili').val('')
    $('#tambah_old_kota_domisili').val('')
    $('#tambah_old_kecamatan_domisili').val('')
    $('#tambah_old_kelurahan_domisili').val('')
    // ===================================================
    $('#id_jenis_jasa').val('')
    $('#pilihan_jasa').val('')
    $('#perhitungan_jasa').val('')
    $('#jangka_waktu_1').val('')
    $('#pengali_kurangdari_satudelapan_1').val('')
    $('#pengali_diatas_dua_1').val('')
    $('#jangka_waktu_2').val('')
    $('#pengali_kurangdari_satudelapan_2').val('')
    $('#pengali_diatas_dua_2').val('')
    $('#jangka_waktu_3').val('')
    $('#pengali_kurangdari_satudelapan_3').val('')
    $('#pengali_diatas_dua_3').val('')
    $('#jangka_waktu_4').val('')
    $('#pengali_kurangdari_satudelapan_4').val('')
    $('#pengali_diatas_dua_4').val('')
    // ===================================================
    $('#kode_pengajuan').val('')
    $('#kode_pengajuan_emasgtc').val('')
    $('#kode_transaksi').val('')
    e.preventDefault();
    $(this).html('Mencari...');
        var kode = $('#no_ba').val();
        $.ajax({
            type: 'GET',
            url: '/backend/cari-nomor-ba/' + kode,
            success: function(data){
                $.each(data.anggota, function(key, item){
                    $('#cari').html('Ditemukan');
                    $('#id_anggota').val(item.id)
                    $('#nama_lengkap').val(item.nama_lengkap)
                    $('#no_hp').val(item.no_hp)
                    $('#email').val(item.email)
                    $('#detailpemohonbtn').prop('disabled', false)
                    $('#datacifanggotabtn').prop('disabled', false)
                    $('#btnmodaladdemasgtc').prop('disabled', false)
                    // ========================================================
                    $('#detail_nomor_buku_anggota').text(': '+item.nomor_ba)
                    $('#detail_nama_lengkap').text(': '+item.nama_lengkap)
                    $('#detail_nomor_hp').text(': '+item.no_hp)
                    $('#detail_email').text(': '+item.email)
                    $('#detail_nomor_ktp').text(': '+item.no_ktp)
                    $('#detail_jenis_kelamin').text(': '+item.jenis_kelamin)
                    $('#detail_tempat_lahir').text(': '+item.tempat_lahir)
                    $('#detail_tanggal_lahir').text(': '+item.tanggal_lahir)
                    $('#detail_status_pernikahan').text(': '+item.status_nikah)
                    $('#detail_nomor_npwp').text(': '+item.no_npwp)
                    $('#detail_alamat_sesuai_ktp').text(': '+item.alamat_ktp)

                    if(item.kelurahan_ktp !== null){
                        var kelurahan_ktp = item.kelurahan_ktp.split(',');
                        $('#detail_kelurahan').text(': '+kelurahan_ktp[1])
                    }else{
                        $('#detail_kelurahan').text(': '+'null')
                    }

                    if(item.kecamatan_ktp !== null){
                        var kecamatan_ktp = item.kecamatan_ktp.split(',');
                        $('#detail_kecamatan').text(': '+kecamatan_ktp[1])
                    }else{
                        $('#detail_kecamatan').text(': '+'null')
                    }

                    if(item.kota_ktp !== null){
                        var kota_ktp = item.kota_ktp.split(',');
                        $('#detail_kota_kabupaten').text(': '+kota_ktp[1])
                    }else{
                        $('#detail_kota_kabupaten').text(': '+'null')
                    }

                    if(item.provinsi_ktp !== null){
                        var provinsi_ktp = item.provinsi_ktp.split(',');
                        $('#detail_provinsi').text(': '+provinsi_ktp[1])
                    }else{
                        $('#detail_provinsi').text(': '+'null')
                    }

                    $('#detail_alamat_tinggal').text(': '+item.alamat_tinggal)
                    $('#detail_alamat_tinggal_domisili').text(': '+item.alamat_domisili)

                    if(item.kelurahan_domisili !== null){
                        var kelurahan_domisili = item.kelurahan_domisili.split(',');
                        $('#detail_kelurahan_domisili').text(': '+kelurahan_domisili[1])
                    }else{
                        $('#detail_kecamatan_domisili').text(': '+'null')
                    }
                    
                    if(item.kecamatan_domisili !== null){
                        var kecamatan_domisili = item.kecamatan_domisili.split(',');
                        $('#detail_kecamatan_domisili').text(': '+kecamatan_domisili[1])
                    }else{
                        $('#detail_kecamatan_domisili').text(': '+'null')
                    }

                    if(item.kota_domisili !== null){
                        var kota_domisili = item.kota_domisili.split(',');
                        $('#detail_kota_kabupaten_domisili').text(': '+kota_domisili[1])
                    }else{
                        $('#detail_kota_kabupaten_domisili').text(': '+'null')
                    }

                    if(item.provinsi_domisili !== null){
                        var provinsi_domisili = item.provinsi_domisili.split(',');
                        $('#detail_provinsi_domisili').text(': '+provinsi_domisili[1])
                    }else{
                        $('#detail_provinsi_domisili').text(': '+'null')
                    }
                    $('#detail_photo_ktp').attr('src', 'http://syirkah.eoaclubsystem.com/images/data_penting/ktp/'+item.foto_ktp);
                    // ===============================================================
                    $('#tambah_id_anggota').val(item.id)
                    $('#tambah_nomor_ba').val(item.nomor_ba)
                    $('#tambah_nama_lengkap').val(item.nama_lengkap)
                    $('#tambah_nomor_hp').val(item.no_hp)
                    $('#tambah_email').val(item.email)
                    $('#tambah_nomor_ktp').val(item.no_ktp)
                    $('#tambah_jenis_kelamin').val(item.jenis_kelamin)
                    $('#tambah_tempat_lahir').val(item.tempat_lahir)
                    $('#tambah_tanggal_lahir').val(item.tanggal_lahir)
                    $('#tambah_status_pernikahan').val(item.status_nikah)
                    $('#tambah_nomor_npwp').val(item.no_npwp)
                    $('#tambah_alamat_sesuai_ktp').val(item.alamat_ktp)
                    $('#tambah_alamat_tinggal').val(item.alamat_tinggal)
                    if(item.alamat_tinggal === 'tidakSesuai'){
                        $('#divtidaksesuaiktp').show();
                    }else{
                        $('#divtidaksesuaiktp').hide();
                    }

                    if(item.provinsi_ktp !== null){
                        var provinsi_ktp = item.provinsi_ktp.split(',');
                        $('#provinsi').prepend("<option selected value='"+item.provinsi_ktp+"'>"+provinsi_ktp[1]+"</option>").val(item.provinsi_ktp);
                    }else{

                    }
                    
                    if(item.kota_ktp !== null){
                        var kota_ktp = item.kota_ktp.split(',');
                        $('#kota').prepend("<option selected value='"+item.kota_ktp+"'>"+kota_ktp[1]+"</option>").val(item.kota_ktp);
                    }else{

                    }

                    if(item.kecamatan_ktp !== null){
                        var kecamatan_ktp = item.kecamatan_ktp.split(',');
                        $('#kecamatan').prepend("<option selected value='"+item.kecamatan_ktp+"'>"+kecamatan_ktp[1]+"</option>").val(item.kecamatan_ktp);
                    }else{

                    }

                    if(item.kelurahan_ktp !== null){
                        var kelurahan_ktp = item.kelurahan_ktp;
                        $('#kelurahan').prepend("<option selected value='"+item.kelurahan_ktp+"'>"+kelurahan_ktp+"</option>").val(item.kelurahan_ktp);
                    }else{

                    }
                    // ==========================================
                    if(item.provinsi_domisili !== null){
                        var provinsi_domisili = item.provinsi_domisili.split(',');
                        $('#tambah_provinsi_domisili').prepend("<option selected value='"+item.provinsi_domisili+"'>"+provinsi_domisili[1]+"</option>").val(item.provinsi_domisili);
                    }else{

                    }
                    
                    if(item.kota_domisili !== null){
                        var kota_domisili = item.kota_domisili.split(',');
                        $('#tambah_kota_kabupaten_domisili').prepend("<option selected value='"+item.kota_domisili+"'>"+kota_domisili[1]+"</option>").val(item.kota_domisili);
                    }else{

                    }

                    if(item.kecamatan_domisili !== null){
                        var kecamatan_domisili = item.kecamatan_domisili.split(',');
                        $('#tambah_kecamatan_domisili').prepend("<option selected value='"+item.kecamatan_domisili+"'>"+kecamatan_domisili[1]+"</option>").val(item.kecamatan_domisili);
                    }else{

                    }

                    if(item.kelurahan_domisili !== null){
                        var kelurahan_domisili = item.kelurahan_domisili;
                        $('#tambah_kelurahan_domisili').prepend("<option selected value='"+item.kelurahan_domisili+"'>"+kelurahan_domisili+"</option>").val(item.kelurahan_domisili);
                    }else{

                    }
                    $('#tambah_alamat_domisili').val(item.alamat_domisili)
                    $('#tambah_old_provinsi').val(item.provinsi_ktp)
                    $('#tambah_old_kota').val(item.kota_ktp)
                    $('#tambah_old_kecamatan').val(item.kecamatan_ktp)
                    $('#tambah_old_kelurahan').val(item.kelurahan_ktp)
                    $('#tambah_old_provinsi_domisili').val(item.provinsi_domisili)
                    $('#tambah_old_kota_domisili').val(item.kota_domisili)
                    $('#tambah_old_kecamatan_domisili').val(item.kecamatan_domisili)
                    $('#tambah_old_kelurahan_domisili').val(item.kelurahan_domisili)
                }),
                $.each(data.jenisjasagtc, function(key, item){
                    $('#id_jenis_jasa').val(item.id)
                    $('#pilihan_jasa').val(item.pilihan_jasa)
                    $('#perhitungan_jasa').val(item.perhitungan_jasa)
                    $('#jangka_waktu_1').val(item.jangka_waktu_1)
                    $('#pengali_kurangdari_satudelapan_1').val(item.pengali_kurangdari_satudelapan_1)
                    $('#pengali_diatas_dua_1').val(item.pengali_diatas_dua_1)
                    $('#jangka_waktu_2').val(item.jangka_waktu_2)
                    $('#pengali_kurangdari_satudelapan_2').val(item.pengali_kurangdari_satudelapan_2)
                    $('#pengali_diatas_dua_2').val(item.pengali_diatas_dua_2)
                    $('#jangka_waktu_3').val(item.jangka_waktu_3)
                    $('#pengali_kurangdari_satudelapan_3').val(item.pengali_kurangdari_satudelapan_3)
                    $('#pengali_diatas_dua_3').val(item.pengali_diatas_dua_3)
                    $('#jangka_waktu_4').val(item.jangka_waktu_4)
                    $('#pengali_kurangdari_satudelapan_4').val(item.pengali_kurangdari_satudelapan_4)
                    $('#pengali_diatas_dua_4').val(item.pengali_diatas_dua_4)
                })
                $('#kode_pengajuan').val(data.finalkode)
                $('#kode_pengajuan_emasgtc').val(data.finalkode)
                var kodepengajuan = $('#kode_pengajuan').val();
                $.ajax({
                    type: 'GET',
                    url: '/backend/cari-kode-pengajuan-hasil/' + kodepengajuan,
                    success: function(data){
                        var newkodepengajuan = data.finalkodetransaksi.split(".");
                        $('#kode_transaksi').val('B.'+newkodepengajuan[1]+'.'+newkodepengajuan[2]+'.'+newkodepengajuan[3])
                    },
                    complete: function () {
                        $('#panel').loading('stop');
                    }
                })
            },
            complete: function () {
                $('#panel').loading('stop');
                gethistorianggota();
                getdataemasgtc();
                emassyirkah();
                tabelemasgtc();
            }
        })
});

// =======================================================
$("#btnaddpengajuan").on('click', function(e){
    if (parseInt($('#pengajuan_hidden').val()) > parseInt($('#plafond_pinjaman_hidden').val())) {
        swalWithBootstrapButtons.fire({
            title: 'Oops',
            text: 'Pengajuan Lebih Dari Plafond Pinjaman',
            confirmButtonText: 'OK'
        });
        return false;
    }else if($('#nomor_ba').val() == ''
    || $('#id_anggota').val() == ''
    || $('#nama_lengkap').val() == ''
    || $('#no_hp').val() ==''
    || $('#email').val() == ''
    || $('#perwada').val() == ''
    || $('#id_perwada').val() == ''
    || $('#kode_pengajuan').val() == ''
    || $('#tujuan').val() == ''
    || $('#plafond_pinjaman').val() == ''
    || $('#pengajuan').val() == ''
    || $('#pilihan_bank').val() == ''
    || $('#nomor_rekening').val() == ''
    || $('#nama_pemilik_rekening').val() == ''
    || $('#kode_transaksi').val() == ''
    || $('#jenis_transaksi').val() == ''
    || $('#id_jenis_jasa').val() == ''
    || $('#pilihan_jasa').val() == ''
    || $('#perhitungan_jasa').val() == ''
    || $('#jangka_waktu_permohonan').val() == ''
    || $('#jasa_gtc').val() == ''
    || $('#pembayaran_jasa').val() == ''
    || $('#id_emas').val() == ''
    || $('#keping').val() == ''){
        swalWithBootstrapButtons.fire({
            title: 'Oops',
            text: 'Data tidak boleh kosog',
            confirmButtonText: 'OK'
        });
        return false;
    }else {
        $('#panel').loading('toggle');
        $('#formaddpengajuangtc').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name=_token]').val()
                }
            });
            var formData = new FormData(this);
            $.ajax({
                url: '/backend/pengajuan-gtc',
                type: 'post',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function () {
                    swalWithBootstrapButtons.fire({
                        title: 'Info',
                        text: 'Data Berhasil disimpan',
                        confirmButtonText: 'OK',
                        reverseButtons: true
                    });
                }, complete: function () {
                    $('#panel').loading('stop');
                    window.location.replace("/backend/pengajuan-gtc");
                }
            });
        });
    }
})
// ===============================================================
function tidaksesuaiktp(){
    $('#tambah_alamat_tinggal').change(function(){
        var val = $(this).val();
        if(val === 'tidakSesuai'){
            $('#divtidaksesuaiktp').show();
        }else{
            $('#divtidaksesuaiktp').hide();
        }
    })
}
// ===============================================================
function emassyirkah(){
    $('#harga_buyback').change(function(){
        $('#panel_emas_syirkah').loading('toggle');
        $('#btnaddemasgtc').prop('disabled', true)
        var id_emas = $('#harga_buyback').val();
        $.ajax({
            url: '/backend/item-emas-syirkah/'+ id_emas,
            type: 'GET',
            success: function (data){
                $.each(data.emas_syirkah, function(key, item){
                    $('#id_emas_syirkah').val(item.id)
                    $('#item_emas').val(item.nama)
                    $('#jenis').val(item.jenis)
                    $('#gramasi').val(item.gramasi)
                })
            },
            complete: function () {
                $('#panel_emas_syirkah').loading('stop');
                $('#btnaddemasgtc').prop('disabled', false)
            }
        })
    })
}
// ===============================================================
$('#btntambahdatacifanggota').on('click', function (e) {
        $('#panel').loading('toggle');
        $('#formtambahdatacifanggota').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name=_token]').val()
                }
            });
            var formData = new FormData(this);
            $.ajax({
                url: '/backend/tambah-data-cif-anggota/'+$('#tambah_id_anggota').val(),
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
                    $('#panel').loading('stop');
                    gettambahdatacifanggota();
                }
            });
        });
    });
// ===============================================================
function gettambahdatacifanggota() {
    $('#panel').loading('toggle');
        var kode = $('#id_anggota').val();
        $.ajax({
            type: 'GET',
            url: '/backend/cari-nomor-ba-hasil/' + kode,
            success: function(data){
                $.each(data.anggota, function(key, item){
                    $('#id_anggota').val(item.id)
                    $('#nama_lengkap').val(item.nama_lengkap)
                    $('#no_hp').val(item.no_hp)
                    $('#email').val(item.email)
                    // ========================================================
                    $('#detail_nomor_buku_anggota').text(': '+item.nomor_ba)
                    $('#detail_nama_lengkap').text(': '+item.nama_lengkap)
                    $('#detail_nomor_hp').text(': '+item.no_hp)
                    $('#detail_email').text(': '+item.email)
                    $('#detail_nomor_ktp').text(': '+item.no_ktp)
                    $('#detail_jenis_kelamin').text(': '+item.jenis_kelamin)
                    $('#detail_tempat_lahir').text(': '+item.tempat_lahir)
                    $('#detail_tanggal_lahir').text(': '+item.tanggal_lahir)
                    $('#detail_status_pernikahan').text(': '+item.status_nikah)
                    $('#detail_nomor_npwp').text(': '+item.no_npwp)
                    $('#detail_alamat_sesuai_ktp').text(': '+item.alamat_ktp)

                    if(item.kelurahan_ktp !== null){
                        var kelurahan_ktp = item.kelurahan_ktp.split(',');
                        $('#detail_kelurahan').text(': '+kelurahan_ktp[1])
                    }else{
                        $('#detail_kelurahan').text(': '+'null')
                    }

                    if(item.kecamatan_ktp !== null){
                        var kecamatan_ktp = item.kecamatan_ktp.split(',');
                        $('#detail_kecamatan').text(': '+kecamatan_ktp[1])
                    }else{
                        $('#detail_kecamatan').text(': '+'null')
                    }

                    if(item.kota_ktp !== null){
                        var kota_ktp = item.kota_ktp.split(',');
                        $('#detail_kota_kabupaten').text(': '+kota_ktp[1])
                    }else{
                        $('#detail_kota_kabupaten').text(': '+'null')
                    }

                    if(item.provinsi_ktp !== null){
                        var provinsi_ktp = item.provinsi_ktp.split(',');
                        $('#detail_provinsi').text(': '+provinsi_ktp[1])
                    }else{
                        $('#detail_provinsi').text(': '+'null')
                    }

                    $('#detail_alamat_tinggal').text(': '+item.alamat_tinggal)
                    $('#detail_alamat_tinggal_domisili').text(': '+item.alamat_domisili)

                    if(item.kelurahan_domisili !== null){
                        var kelurahan_domisili = item.kelurahan_domisili.split(',');
                        $('#detail_kelurahan_domisili').text(': '+kelurahan_domisili[1])
                    }else{
                        $('#detail_kecamatan_domisili').text(': '+'null')
                    }
                    
                    if(item.kecamatan_domisili !== null){
                        var kecamatan_domisili = item.kecamatan_domisili.split(',');
                        $('#detail_kecamatan_domisili').text(': '+kecamatan_domisili[1])
                    }else{
                        $('#detail_kecamatan_domisili').text(': '+'null')
                    }

                    if(item.kota_domisili !== null){
                        var kota_domisili = item.kota_domisili.split(',');
                        $('#detail_kota_kabupaten_domisili').text(': '+kota_domisili[1])
                    }else{
                        $('#detail_kota_kabupaten_domisili').text(': '+'null')
                    }

                    if(item.provinsi_domisili !== null){
                        var provinsi_domisili = item.provinsi_domisili.split(',');
                        $('#detail_provinsi_domisili').text(': '+provinsi_domisili[1])
                    }else{
                        $('#detail_provinsi_domisili').text(': '+'null')
                    }
                    $('#detail_photo_ktp').attr('src', 'http://syirkah.eoaclubsystem.com/images/data_penting/ktp/'+item.foto_ktp);

                    // ===============================================================
                    $('#tambah_id_anggota').val(item.id)
                    $('#tambah_nomor_ba').val(item.nomor_ba)
                    $('#tambah_nama_lengkap').val(item.nama_lengkap)
                    $('#tambah_nomor_hp').val(item.no_hp)
                    $('#tambah_email').val(item.email)
                    $('#tambah_nomor_ktp').val(item.no_ktp)
                    $('#tambah_jenis_kelamin').val(item.jenis_kelamin)
                    $('#tambah_tempat_lahir').val(item.tempat_lahir)
                    $('#tambah_tanggal_lahir').val(item.tanggal_lahir)
                    $('#tambah_status_pernikahan').val(item.status_nikah)
                    $('#tambah_nomor_npwp').val(item.no_npwp)
                    $('#tambah_alamat_sesuai_ktp').val(item.alamat_ktp)
                    $('#tambah_alamat_tinggal').val(item.alamat_tinggal)
                    if(item.alamat_tinggal === 'tidakSesuai'){
                        $('#divtidaksesuaiktp').show();
                    }else{
                        $('#divtidaksesuaiktp').hide();
                    }
                    $('#tambah_alamat_domisili').val(item.alamat_domisili)
                    $('#tambah_old_provinsi').val(item.provinsi_ktp)
                    $('#tambah_old_kota').val(item.kota_ktp)
                    $('#tambah_old_kecamatan').val(item.kecamatan_ktp)
                    $('#tambah_old_kelurahan').val(item.kelurahan_ktp)
                    $('#tambah_old_provinsi_domisili').val(item.provinsi_domisili)
                    $('#tambah_old_kota_domisili').val(item.kota_domisili)
                    $('#tambah_old_kecamatan_domisili').val(item.kecamatan_domisili)
                    $('#tambah_old_kelurahan_domisili').val(item.kelurahan_domisili)
                })
            },
            complete: function () {
                $('#panel').loading('stop');
                gethistorianggota();
            }
        })
}
// ===============================================================
function gethistorianggota(){
    $('#panel').loading('toggle');
    var kode = $('#id_anggota').val();
    $('#bodyhistorianggota').html('');
    $.ajax({
        type: 'GET',
        url: '/backend/cari-data-histori-anggota/' + kode,
        success: function (data) {
            var rows = '';
            var no = 0;
            $.each(data, function (key, value) {
                no += 1;
                rows = rows + '<tr>';
                rows = rows + '<td class="text-center">' + no + '</td>';
                rows = rows + '<td>' + value.nomor_ba + '</td>';
                rows = rows + '<td>' + value.nama_lengkap + '</td>';
                rows = rows + '<td>' + value.nomor_hp + '</td>';
                rows = rows + '<td>' + value.email + '</td>';
                rows = rows + '<td>' + value.status + '</td>';
                rows = rows + '<td>' + value.no_ktp + '</td>';
                rows = rows + '<td>' + value.jenis_kelamin + '</td>';
                rows = rows + '<td>' + value.tempat_lahir + '</td>';
                rows = rows + '<td>' + value.tanggal_lahir + '</td>';
                rows = rows + '<td>' + value.status_nikah + '</td>';
                rows = rows + '<td>' + value.no_npwp + '</td>';
                rows = rows + '<td>' + value.alamat_ktp + '</td>';
                rows = rows + '<td>' + value.provinsi_ktp + '</td>';
                rows = rows + '<td>' + value.kota_ktp + '</td>';
                rows = rows + '<td>' + value.kecamatan_ktp + '</td>';
                rows = rows + '<td>' + value.kelurahan_ktp + '</td>';
                rows = rows + '<td>' + value.alamat_tinggal + '</td>';
                rows = rows + '<td>' + value.alamat_domisili + '</td>';
                rows = rows + '<td>' + value.provinsi_domisili + '</td>';
                rows = rows + '<td>' + value.kota_domisili + '</td>';
                rows = rows + '<td>' + value.kecamatan_domisili + '</td>';
                rows = rows + '<td>' + value.kelurahan_domisili + '</td>';
                rows = rows + '<td>' + value.updated_at + '</td>';
                rows = rows + '</tr>';
            });
            $('#bodyhistorianggota').html(rows);
        }, complete: function () {
            $('#panel').loading('stop');
        }
    });
}
// ===============================================================
$(document).ready(function(){
    $.ajax({
        type: "GET",
        url: "https://dev.farizdotid.com/api/daerahindonesia/provinsi",
        success: function(hasil){
            hasil = hasil.provinsi
            hasilAkhir = []
            hasilAkhir.push("<option value=''>Provinsi</option>");
            hasil.forEach(element => {
                var name = element.nama
                value = `${element.id},${name}`
                hasilAkhir.push("<option value='"+value+"'>"+element.nama+"</option>");
            });
            $("#provinsi").html(hasilAkhir);
        }
    })
    $("body").on("change","#provinsi",function(){
        var value = $(this).val()
        const myArray = value.split(",")
        let id = myArray[0]
        console.log(id)
        $.ajax({
            type: "GET",
            url: "https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi="+id,
            ajaxSend: function(){
                hasilAkhir.push("<option value=''>Kabupaten/Kota</option>");
                hasilAkhir.push("<option>Data Masih Diproses</option>");
            },
            success: function(hasil){
                hasil = hasil.kota_kabupaten
                hasilAkhir = []
                hasilAkhir.push("<option value=''>Kabupaten/Kota</option>");
                hasil.forEach(element => {
                    var name = element.nama
                    value = `${element.id},${name}`
                    hasilAkhir.push("<option value='"+value+"'>"+element.nama+"</option>");
                });
                $("#kota").html(hasilAkhir);
            }
        })
        
    })
    $("body").on("change","#kota",function(){
        var value = $(this).val()
        const myArray = value.split(",")
        let id = myArray[0]
        console.log(id)
        $.ajax({
            type: "GET",
            url: "https://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota="+id,
            ajaxSend: function(){
                hasilAkhir.push("<option value=''>Kecamatan</option>");
                hasilAkhir.push("<option>Data Masih Diproses</option>");
            },
            success: function(hasil){
                hasil = hasil.kecamatan
                hasilAkhir = []
                hasilAkhir.push("<option value=''>Kecamatan</option>");
                hasil.forEach(element => {
                    var name = element.nama
                    value = `${element.id},${name}`
                    hasilAkhir.push("<option value='"+value+"'>"+element.nama+"</option>");
                });
                $("#kecamatan").html(hasilAkhir);
            }
        })
        
    })
    $("body").on("change","#kecamatan",function(){
        var value = $(this).val()
        const myArray = value.split(",")
        let id = myArray[0]
        console.log(id)
        $.ajax({
            type: "GET",
            url: "https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan="+id,
            ajaxSend: function(){
                hasilAkhir.push("<option value=''>Kelurahan</option>");
                hasilAkhir.push("<option>Data Masih Diproses</option>");
            },
            success: function(hasil){
                hasil = hasil.kelurahan
                hasilAkhir = []
                hasilAkhir.push("<option value=''>Kelurahan</option>");
                hasil.forEach(element => {
                    var name = element.nama
                    value = `${element.id},${name}`
                    hasilAkhir.push("<option value='"+value+"'>"+element.nama+"</option>");
                });
                // $("#kelurahan").html(hasilAkhir);
            }
        })
        
    })
})
$(document).ready(function(){
    $.ajax({
        type: "GET",
        url: "https://dev.farizdotid.com/api/daerahindonesia/provinsi",
        success: function(hasil){
            hasil = hasil.provinsi
            hasilAkhir = []
            hasilAkhir.push("<option value=''>Provinsi</option>");
            hasil.forEach(element => {
                var name = element.nama
                value = `${element.id},${name}`
                hasilAkhir.push("<option value='"+value+"'>"+element.nama+"</option>");
            });
            $("#tambah_provinsi_domisili").html(hasilAkhir);
        }
    })
    $("body").on("change","#tambah_provinsi_domisili",function(){
        var value = $(this).val()
        const myArray = value.split(",")
        let id = myArray[0]
        console.log(id)
        $.ajax({
            type: "GET",
            url: "https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi="+id,
            ajaxSend: function(){
                hasilAkhir.push("<option value=''>Kabupaten/Kota</option>");
                hasilAkhir.push("<option>Data Masih Diproses</option>");
            },
            success: function(hasil){
                hasil = hasil.kota_kabupaten
                hasilAkhir = []
                hasilAkhir.push("<option value=''>Kabupaten/Kota</option>");
                hasil.forEach(element => {
                    var name = element.nama
                    value = `${element.id},${name}`
                    hasilAkhir.push("<option value='"+value+"'>"+element.nama+"</option>");
                });
                $("#tambah_kota_kabupaten_domisili").html(hasilAkhir);
            }
        })
        
    })
    $("body").on("change","#tambah_kota_kabupaten_domisili",function(){
        var value = $(this).val()
        const myArray = value.split(",")
        let id = myArray[0]
        console.log(id)
        $.ajax({
            type: "GET",
            url: "https://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota="+id,
            ajaxSend: function(){
                hasilAkhir.push("<option value=''>Kecamatan</option>");
                hasilAkhir.push("<option>Data Masih Diproses</option>");
            },
            success: function(hasil){
                hasil = hasil.kecamatan
                hasilAkhir = []
                hasilAkhir.push("<option value=''>Kecamatan</option>");
                hasil.forEach(element => {
                    var name = element.nama
                    value = `${element.id},${name}`
                    hasilAkhir.push("<option value='"+value+"'>"+element.nama+"</option>");
                });
                $("#tambah_kecamatan_domisili").html(hasilAkhir);
            }
        })
        
    })
    $("body").on("change","#tambah_kecamatan_domisili",function(){
        var value = $(this).val()
        const myArray = value.split(",")
        let id = myArray[0]
        console.log(id)
        $.ajax({
            type: "GET",
            url: "https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan="+id,
            ajaxSend: function(){
                hasilAkhir.push("<option value=''>Kelurahan</option>");
                hasilAkhir.push("<option>Data Masih Diproses</option>");
            },
            success: function(hasil){
                hasil = hasil.kelurahan
                hasilAkhir = []
                hasilAkhir.push("<option value=''>Kelurahan</option>");
                hasil.forEach(element => {
                    var name = element.nama
                    value = `${element.id},${name}`
                    hasilAkhir.push("<option value='"+value+"'>"+element.nama+"</option>");
                });
                $("#tambah_kelurahan_domisili").html(hasilAkhir);
            }
        })
        
    })
})
// ================================================================================
function getdataemasgtc() {
    $('#panel').loading('toggle');
    $('#bodyemasgtc').html('');
    $('#footemasgtc').html('');
    var kode = $('#kode_pengajuan_emasgtc').val();
    $.ajax({
        type: 'GET',
        url: '/backend/cari-data-emas-gtc/' + kode,
        success: function (data) {
            var rows = '';
            var no = 0;
            $.each(data.emas, function (key, value) {
                no += 1;
                rows = rows + '<tr>';
                rows = rows + '<td hidden><input type="hidden" class="form-control" value="'+ value.id +'" id="id_emas" name="id_emas[]"></td>';
                rows = rows + '<td>' + value.item_emas + '</td>';
                rows = rows + '<td><span class="badge badge-primary-lighten">'+ value.jenis +'</span></td>';
                rows = rows + '<td class="gramasi">' + value.gramasi + '</td>';
                if(value.gramasi === '0.1'){
                    var harga_buyback = parseFloat(data.hargaharian.nolsatu_gram);
                    rows = rows + '<td class="harga_buyback">' + (harga_buyback.toLocaleString("id-ID")) + '</td>';
                    rows = rows + '<td hidden class="harga_buyback_hidden">' + data.hargaharian.nolsatu_gram + '</td>';
            }else if(value.gramasi === '0.2'){
                    var harga_buyback = parseFloat(data.hargaharian.noldua_gram);
                    rows = rows + '<td class="harga_buyback">' + (harga_buyback.toLocaleString("id-ID")) + '</td>';
                    rows = rows + '<td hidden class="harga_buyback_hidden">' + data.hargaharian.noldua_gram + '</td>';
            }else if(value.gramasi === '0.5'){
                    var harga_buyback = parseFloat(data.hargaharian.nollima_gram);
                    rows = rows + '<td class="harga_buyback">' + (harga_buyback.toLocaleString("id-ID")) + '</td>';
                    rows = rows + '<td hidden class="harga_buyback_hidden">' + data.hargaharian.nollima_gram + '</td>';
            }else if(value.gramasi === '1'){
                    var harga_buyback = parseFloat(data.hargaharian.satu_gram);
                    rows = rows + '<td class="harga_buyback">' + (harga_buyback.toLocaleString("id-ID")) + '</td>';
                    rows = rows + '<td hidden class="harga_buyback_hidden">' + data.hargaharian.satu_gram + '</td>';
            }else if(value.gramasi === '2'){
                    var harga_buyback = parseFloat(data.hargaharian.dua_gram);
                    rows = rows + '<td class="harga_buyback">' + (harga_buyback.toLocaleString("id-ID")) + '</td>';
                    rows = rows + '<td hidden class="harga_buyback_hidden">' + data.hargaharian.dua_gram + '</td>';
            }else if(value.gramasi === '5'){
                    var harga_buyback = parseFloat(data.hargaharian.lima_gram);
                    rows = rows + '<td class="harga_buyback">' + (harga_buyback.toLocaleString("id-ID")) + '</td>';
                    rows = rows + '<td hidden class="harga_buyback_hidden">' + data.hargaharian.lima_gram + '</td>';
            }else if(value.gramasi === '10'){
                    var harga_buyback = parseFloat(data.hargaharian.sepuluh_gram);
                    rows = rows + '<td class="harga_buyback">' + (harga_buyback.toLocaleString("id-ID")) + '</td>';
                    rows = rows + '<td hidden class="harga_buyback_hidden">' + data.hargaharian.sepuluh_gram + '</td>';
            }
                // rows = rows + '<td class="harga_buyback">' + (harga_buyback.toLocaleString("id-ID")) + '</td>';
                // rows = rows + '<td hidden class="harga_buyback_hidden">' + value.harga_buyback + '</td>';
                rows = rows + '<td><input type="number" max="999" min="1" value="0" class="keping form-control" name="keping[]" placeholder="Qty" style="width: 90px;" data-toggle="input-mask" data-mask-format="00"></td>';
                rows = rows + '<td class="jumlah_gramasi">' + 0 + '</td>';
                rows = rows + '<td class="jumlah_buyback">' + 0 + '</td>';
                rows = rows + '<td hidden class="jumlah_buyback_hidden">' + 0 + '</td>';
                rows = rows + '<td><a onclick="hapusdataemasgtc('+ value.id +')" class="action-icon"> <i class="mdi mdi-delete"></i></a></td>';
                rows = rows + '</tr>';
            }
            );
            $('#bodyemasgtc').html(rows);
            $("#footemasgtc").html('<tr><th>Total</th><th></th><th></th><th></th><th id="total_keping">0</th><th id="total_gramasi">0</th><th hidden><input type="hidden" class="form-control" name="total_gramasi_hidden" id="total_gramasi_hidden"></th><th id="total_buyback">0</th><th style="width: 50px;"></th></tr>');
            getTotal();
            keping();
        }, complete: function () {
            hiddenbtnaddtabelemasgtc();
            $('#panel').loading('stop');
        }
    });
}
// function getdataemasgtc() {
//     $('#panel').loading('toggle');
//     $('#panel').loading('stop');
//     $('#bodyemasgtc').reload();
// }
// ================================================================================
function getTotal(){
    total_keping = 0;
    $('.keping').each(function(){
        total_keping += parseInt(this.value)
    });
    $('#total_keping').text(total_keping + " Keping");

    total_gramasi = 0;
    $('.jumlah_gramasi').each(function(){
        total_gramasi += parseFloat(this.innerHTML)
    });
    $('#total_gramasi').text(total_gramasi.toFixed(1) + " Gram");
    $('#total_gramasi_hidden').val(total_gramasi.toFixed(1));

    total_buyback = 0;
    $('.jumlah_buyback_hidden').each(function(){
        total_buyback += parseFloat(this.innerHTML)
    });
    format_total_buyback = total_buyback.toLocaleString("id-ID")
    $('#total_buyback').text("Rp "+ format_total_buyback);
    //=============================== 
    var newformat = format_total_buyback.replace(/[^,\d]/g, '').toString()
    var hitung = (newformat/100)*90;
    var newhitung = hitung.toLocaleString("id-ID")
    var number_string = newhitung.replace(/[^,\d]/g, '').toString(),
	split   		= number_string.split(','),
	sisa     		= split[0].length % 3,
	rupiah     		= split[0].substr(0, sisa),
	ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
	// tambahkan titik jika yang di input sudah menjadi angka ribuan
	if(ribuan){
		separator = sisa ? '.' : '';
		rupiah += separator + ribuan.join('.');
	}
 
	rupiah = split[1] != undefined ? rupiah + '.' + split[1] : rupiah;
    $("#plafond_pinjaman").val(rupiah).trigger('change');
    var plafond_pinjaman = $("#plafond_pinjaman").val();
    var newplafond_pinjaman = plafond_pinjaman.replace(/[^,\d]/g, '').toString();
    $("#plafond_pinjaman_hidden").val(newplafond_pinjaman).trigger('change');
    // var pengajuan = $("#pengajuan").val();
    // var newpengajuan = pengajuan.split(".");
    // $("#pengajuan_hidden").val(newpengajuan).trigger('change');
    $('#pengajuan').keyup(function(){
        $('#pengajuan_hidden').val($(this).val().replace(/[^,\d]/g, '').toString()).trigger("change")
        $('#jangka_waktu_permohonan').val('Pilih').trigger("change")
        // $('#jangka_waktu_permohonan').change(function(){
        //     if($(this).val() === '0.5'){
        //         if(parseFloat(total_gramasi)>=0.1 && parseFloat(total_gramasi)<=49.9){
        //             jangka_waktu = $('#jangka_waktu_1').val()
        //             numjangka_waktu = parseFloat(jangka_waktu)
        //             pengali = $('#pengali_kurangdari_satudelapan_1').val()
        //             numpengali = parseFloat(pengali)
        //             hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*total_buyback).toFixed(0)
        //             newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
        //             bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
        //             hasiljasa = bulathitungjasa.toLocaleString("id-ID")
        //             $('#jasa_gtc').val(hasiljasa).trigger
        //             $('#pembayaran_jasa').val('Pilih').trigger
        //         }else if(total_gramasi>=50){
        //             jangka_waktu = $('#jangka_waktu_1').val()
        //             numjangka_waktu = parseFloat(jangka_waktu)
        //             pengali = $('#pengali_diatas_dua_1').val()
        //             numpengali = parseFloat(pengali)
        //             hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*total_buyback).toFixed(0)
        //             newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
        //             bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
        //             hasiljasa = bulathitungjasa.toLocaleString("id-ID")
        //             $('#jasa_gtc').val(hasiljasa).trigger
        //             $('#pembayaran_jasa').val('Pilih').trigger
        //         }
        //     }else if($(this).val() === '1'){
        //         if(parseFloat(total_gramasi)>=0.1 && parseFloat(total_gramasi)<=49.9){
        //             jangka_waktu = $('#jangka_waktu_2').val()
        //             numjangka_waktu = parseFloat(jangka_waktu)
        //             pengali = $('#pengali_kurangdari_satudelapan_2').val()
        //             numpengali = parseFloat(pengali)
        //             hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*total_buyback).toFixed(0)
        //             newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
        //             bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
        //             hasiljasa = bulathitungjasa.toLocaleString("id-ID")
        //             $('#jasa_gtc').val(hasiljasa).trigger
        //             $('#pembayaran_jasa').val('Pilih').trigger
        //         }else if(total_gramasi>=50){
        //             jangka_waktu = $('#jangka_waktu_2').val()
        //             numjangka_waktu = parseFloat(jangka_waktu)
        //             pengali = $('#pengali_diatas_dua_2').val()
        //             numpengali = parseFloat(pengali)
        //             hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*total_buyback).toFixed(0)
        //             newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
        //             bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
        //             hasiljasa = bulathitungjasa.toLocaleString("id-ID")
        //             $('#jasa_gtc').val(hasiljasa).trigger
        //             $('#pembayaran_jasa').val('Pilih').trigger
        //         }
        //     }else if($(this).val() === '2'){
        //         if(parseFloat(total_gramasi)>=0.1 && parseFloat(total_gramasi)<=49.9){
        //             jangka_waktu = $('#jangka_waktu_3').val()
        //             numjangka_waktu = parseFloat(jangka_waktu)
        //             pengali = $('#pengali_kurangdari_satudelapan_3').val()
        //             numpengali = parseFloat(pengali)
        //             hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*total_buyback).toFixed(0)
        //             newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
        //             bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
        //             hasiljasa = bulathitungjasa.toLocaleString("id-ID")
        //             $('#jasa_gtc').val(hasiljasa).trigger
        //             $('#pembayaran_jasa').val('Pilih').trigger
        //         }else if(total_gramasi>=50){
        //             jangka_waktu = $('#jangka_waktu_3').val()
        //             numjangka_waktu = parseFloat(jangka_waktu)
        //             pengali = $('#pengali_diatas_dua_3').val()
        //             numpengali = parseFloat(pengali)
        //             hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*total_buyback).toFixed(0)
        //             newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
        //             bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
        //             hasiljasa = bulathitungjasa.toLocaleString("id-ID")
        //             $('#jasa_gtc').val(hasiljasa).trigger
        //             $('#pembayaran_jasa').val('Pilih').trigger
        //         }
        //     }else{
        //         $('#jasa_gtc').val('').trigger
        //         $('#pembayaran_jasa').val('Pilih').trigger
        //     }
        // })
        // $('#pembayaran_jasa').change(function(){
        //     if($(this).val() === 'Transfer'){
        //         $('#div_upload_bukti_transfer').show()
        //         $('#ket_simpwa').val('Pilih').change()
        //     }else if($(this).val() === 'Dipotong dari GTC'){
        //         $('#div_upload_bukti_transfer').hide()
        //         $('#ket_simpwa').val('Pilih').change()
        //     }else{
        //         $('#div_upload_bukti_transfer').hide()
        //         $('#ket_simpwa').val('Pilih').change()
        //     }
        //     $('#ket_simpwa').change(function(){
        //         if($(this).val() === 'Dipotong dari GTC'){
        //             $('#div_nominal_potongan').show()
        //             $('#nominal_potongan').change(function(){
        //                 var pengajuan = $('#pengajuan').val().replace(/[^,\d]/g, '').toString()
        //                 var jasa_gtc = $('#jasa_gtc').val().replace(/[^,\d]/g, '').toString()
        //                 var nominal_potongan = $('#nominal_potongan').val().replace(/[^,\d]/g, '').toString()
        //                 var jumlah_yang_di_transfer = pengajuan-jasa_gtc-nominal_potongan;
        //                 var jumlah_yang_di_transfer_format = jumlah_yang_di_transfer.toLocaleString("id-ID")
        //                 $('#jumlah_yang_di_transfer').val(jumlah_yang_di_transfer_format).change();
        //             })
        //             $('#jumlah_yang_di_transfer').val('').trigger();
        //         }else if($(this).val() === 'Lunas'){
        //             $('#div_nominal_potongan').hide()
        //             $('#nominal_potongan').val('').change();
        //             var pengajuan = $('#pengajuan').val().replace(/[^,\d]/g, '').toString()
        //             var jasa_gtc = $('#jasa_gtc').val().replace(/[^,\d]/g, '').toString()
        //             var nominal_potongan = 0
        //             var jumlah_yang_di_transfer = pengajuan-jasa_gtc-nominal_potongan;
        //             var jumlah_yang_di_transfer_format = jumlah_yang_di_transfer.toLocaleString("id-ID")
        //             $('#jumlah_yang_di_transfer').val(jumlah_yang_di_transfer_format).trigger();
        //         }else{
        //             $('#div_nominal_potongan').hide()
        //             $('#nominal_potongan').val('').change();
        //             $('#nominal_potongan').change(function(){
        //                 $('#jumlah_yang_di_transfer').val('').change();
        //             })
        //         }
        //     })
        // })
    });
    $('#jangka_waktu_permohonan').change(function(){
        if($(this).val() === '0.5'){
            if(parseFloat(total_gramasi)>=0.1 && parseFloat(total_gramasi)<=49.9){
                jangka_waktu = $('#jangka_waktu_1').val()
                numjangka_waktu = parseFloat(jangka_waktu)
                pengali = $('#pengali_kurangdari_satudelapan_1').val()
                numpengali = parseFloat(pengali)
                hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*total_buyback).toFixed(0)
                newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                $('#jasa_gtc').val(hasiljasa).trigger("change")
                $('#pembayaran_jasa').val('Pilih').trigger("change")
            }else if(total_gramasi>=50){
                jangka_waktu = $('#jangka_waktu_1').val()
                numjangka_waktu = parseFloat(jangka_waktu)
                pengali = $('#pengali_diatas_dua_1').val()
                numpengali = parseFloat(pengali)
                hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*total_buyback).toFixed(0)
                newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                $('#jasa_gtc').val(hasiljasa).trigger("change")
                $('#pembayaran_jasa').val('Pilih').trigger("change")
            }
        }else if($(this).val() === '1'){
            if(parseFloat(total_gramasi)>=0.1 && parseFloat(total_gramasi)<=49.9){
                jangka_waktu = $('#jangka_waktu_2').val()
                numjangka_waktu = parseFloat(jangka_waktu)
                pengali = $('#pengali_kurangdari_satudelapan_2').val()
                numpengali = parseFloat(pengali)
                hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*total_buyback).toFixed(0)
                newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                $('#jasa_gtc').val(hasiljasa).trigger("change")
                $('#pembayaran_jasa').val('Pilih').trigger("change")
            }else if(total_gramasi>=50){
                jangka_waktu = $('#jangka_waktu_2').val()
                numjangka_waktu = parseFloat(jangka_waktu)
                pengali = $('#pengali_diatas_dua_2').val()
                numpengali = parseFloat(pengali)
                hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*total_buyback).toFixed(0)
                newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                $('#jasa_gtc').val(hasiljasa).trigger("change")
                $('#pembayaran_jasa').val('Pilih').trigger("change")
            }
        }else if($(this).val() === '2'){
            if(parseFloat(total_gramasi)>=0.1 && parseFloat(total_gramasi)<=49.9){
                jangka_waktu = $('#jangka_waktu_3').val()
                numjangka_waktu = parseFloat(jangka_waktu)
                pengali = $('#pengali_kurangdari_satudelapan_3').val()
                numpengali = parseFloat(pengali)
                hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*total_buyback).toFixed(0)
                newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                $('#jasa_gtc').val(hasiljasa).trigger("change")
                $('#pembayaran_jasa').val('Pilih').trigger("change")
            }else if(total_gramasi>=50){
                jangka_waktu = $('#jangka_waktu_3').val()
                numjangka_waktu = parseFloat(jangka_waktu)
                pengali = $('#pengali_diatas_dua_3').val()
                numpengali = parseFloat(pengali)
                hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*total_buyback).toFixed(0)
                newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                $('#jasa_gtc').val(hasiljasa).trigger("change")
                $('#pembayaran_jasa').val('Pilih').trigger("change")
            }
        }else{
            $('#jasa_gtc').val('').trigger("change")
            $('#pembayaran_jasa_manual').val('').trigger("change");
            $('#div_nominal_potongan').hide()
            $('#nominal_potongan').val('').trigger("change");
            $('#jumlah_yang_di_transfer').val('').trigger("change");
            $('#pembayaran_jasa').val('Pilih').trigger("change")
        }
    });
    $('#pembayaran_jasa').change(function(){
        if($(this).val() === 'Transfer'){
            $('#div_upload_bukti_transfer').show()
            $('#div_jumlah_transfer').show()
            $('#div_pembayaran_jasa_manual').hide()
            $('#ket_simpwa').val('Pilih').trigger()
        }else if($(this).val() === 'Dipotong dari GTC'){
            $('#div_upload_bukti_transfer').hide()
            $('#div_jumlah_transfer').hide()
            $('#div_pembayaran_jasa_manual').show()
            $('#ket_simpwa').val('Pilih').trigger()
        }else{
            $('#div_upload_bukti_transfer').hide()
            $('#div_jumlah_transfer').hide()
            $('#div_pembayaran_jasa_manual').show()
            $('#ket_simpwa').val('Pilih').trigger()
            $('#div_nominal_potongan').hide()
            $('#nominal_potongan').val('').trigger("change");
            $('#jumlah_yang_di_transfer').val('').trigger("change");
            $('#pembayaran_jasa').val('Pilih').trigger("change")
        }
        // $('#ket_simpwa').change(function(){
        //     if($(this).val() === 'Dipotong dari GTC'){
        //         $('#div_nominal_potongan').show()
        //         $('#nominal_potongan').change(function(){
        //             var pengajuan = $('#pengajuan').val().replace(/[^,\d]/g, '').toString()
        //             var jasa_gtc = $('#jasa_gtc').val().replace(/[^,\d]/g, '').toString()
        //             var nominal_potongan = $('#nominal_potongan').val().replace(/[^,\d]/g, '').toString()
        //             var jumlah_yang_di_transfer = pengajuan-jasa_gtc-nominal_potongan;
        //             var jumlah_yang_di_transfer_format = jumlah_yang_di_transfer.toLocaleString("id-ID")
        //             $('#jumlah_yang_di_transfer').val(jumlah_yang_di_transfer_format).change();
        //         })
        //         $('#jumlah_yang_di_transfer').val('').trigger();
        //     }else if($(this).val() === 'Lunas'){
        //         $('#div_nominal_potongan').hide()
        //         $('#nominal_potongan').val('').change();
        //         var pengajuan = $('#pengajuan').val().replace(/[^,\d]/g, '').toString()
        //         var jasa_gtc = $('#jasa_gtc').val().replace(/[^,\d]/g, '').toString()
        //         var nominal_potongan = 0
        //         var jumlah_yang_di_transfer = pengajuan-jasa_gtc-nominal_potongan;
        //         var jumlah_yang_di_transfer_format = jumlah_yang_di_transfer.toLocaleString("id-ID")
        //         $('#jumlah_yang_di_transfer').val(jumlah_yang_di_transfer_format).trigger();
        //     }else{
        //         $('#div_nominal_potongan').hide()
        //         $('#nominal_potongan').val('').change();
        //         $('#nominal_potongan').change(function(){
        //             $('#jumlah_yang_di_transfer').val('').change();
        //         })
        //     }
        // })
    });
    $('#ket_simpwa').change(function(){
        if($('#pembayaran_jasa').val() === 'Transfer'){
            if($(this).val() === 'Dipotong dari GTC'){
                $('#div_nominal_potongan').show()
                $('#nominal_potongan').keyup(function(){
                    var pengajuan = $('#pengajuan').val().replace(/[^,\d]/g, '').toString()
                    var jasa_gtc = $('#jasa_gtc').val().replace(/[^,\d]/g, '').toString()
                    var nominal_potongan = $('#nominal_potongan').val().replace(/[^,\d]/g, '').toString()
                    var jumlah_yang_di_transfer = pengajuan-nominal_potongan;
                    var jumlah_yang_di_transfer_format = jumlah_yang_di_transfer.toLocaleString("id-ID")
                    $('#jumlah_yang_di_transfer').val(jumlah_yang_di_transfer_format).trigger("change");
                })
                $('#jumlah_yang_di_transfer').val('').trigger("change");
            }else if($(this).val() === 'Lunas'){
                $('#div_nominal_potongan').hide()
                $('#nominal_potongan').val('').trigger("change");
                var pengajuan = $('#pengajuan').val().replace(/[^,\d]/g, '').toString()
                var jasa_gtc = $('#jasa_gtc').val().replace(/[^,\d]/g, '').toString()
                var nominal_potongan = 0
                var jumlah_yang_di_transfer = pengajuan-nominal_potongan;
                var jumlah_yang_di_transfer_format = jumlah_yang_di_transfer.toLocaleString("id-ID")
                $('#jumlah_yang_di_transfer').val(jumlah_yang_di_transfer_format).trigger("change");
            }else{
                $('#div_nominal_potongan').hide()
            }
        }else if($('#pembayaran_jasa').val() === 'Dipotong dari GTC'){
            if($(this).val() === 'Dipotong dari GTC'){
                $('#div_nominal_potongan').show()
                $('#nominal_potongan').keyup(function(){
                    var pengajuan = $('#pengajuan').val().replace(/[^,\d]/g, '').toString()
                    var jasa_gtc = $('#jasa_gtc').val().replace(/[^,\d]/g, '').toString()
                    var nominal_potongan = $('#nominal_potongan').val().replace(/[^,\d]/g, '').toString()
                    var jumlah_yang_di_transfer = pengajuan-jasa_gtc-nominal_potongan;
                    var jumlah_yang_di_transfer_format = jumlah_yang_di_transfer.toLocaleString("id-ID")
                    $('#jumlah_yang_di_transfer').val(jumlah_yang_di_transfer_format).trigger("change");
                })
                $('#jumlah_yang_di_transfer').val('').trigger("change");
            }else if($(this).val() === 'Lunas'){
                $('#div_nominal_potongan').hide()
                $('#nominal_potongan').val('').trigger("change");
                var pengajuan = $('#pengajuan').val().replace(/[^,\d]/g, '').toString()
                var jasa_gtc = $('#jasa_gtc').val().replace(/[^,\d]/g, '').toString()
                var nominal_potongan = 0
                var jumlah_yang_di_transfer = pengajuan-jasa_gtc-nominal_potongan;
                var jumlah_yang_di_transfer_format = jumlah_yang_di_transfer.toLocaleString("id-ID")
                $('#jumlah_yang_di_transfer').val(jumlah_yang_di_transfer_format).trigger("change");
            }else{
                $('#div_nominal_potongan').hide()
            }
        }else{
            if($(this).val() === 'Dipotong dari GTC'){
                $('#jumlah_yang_di_transfer').val('').trigger("change");
            }else if($(this).val() === 'Lunas'){
                $('#jumlah_yang_di_transfer').val('').trigger("change");
            }else{
                $('#div_nominal_potongan').hide()
            }
        }
    });
    $('#tipe_transaksi2').click(function(){
        $('#divuploadformpengajuan').show()
    })
    $('#tipe_transaksi').click(function(){
        $('#divuploadformpengajuan').hide()
    });
    // $('#nominal_potongan').keyup(function(){
    //     $('#jumlah_yang_di_transfer').val('').trigger("change");
    // })
}
getTotal();
keping();
function keping(){
    $('.keping').bind("change keyup",function(){
        var len = this.value.length; 
        if (len >= 3) { 
            this.value = this.value.substring(0, 3); 
        }
        var parent = $(this).parents('tr');
        var gramasi = $('.gramasi', parent);
        var jumlah_gramasi = $('.jumlah_gramasi', parent);
        var value_gramasi = parseInt(this.value) * parseFloat(gramasi.get(0).innerHTML||0);
        jumlah_gramasi.text(value_gramasi.toFixed(1));
    
        var asli_harga_buyback_hidden = $('.harga_buyback_hidden', parent);
        var format_harga_buyback = asli_harga_buyback_hidden.text().replace('.', '');
        var harga_buyback = asli_harga_buyback_hidden.text(format_harga_buyback)
        var jumlah_buyback = $('.jumlah_buyback', parent);
        var jumlah_buyback_hidden = $('.jumlah_buyback_hidden', parent);
        var value_buyback = parseInt(this.value) * parseFloat(harga_buyback.get(0).innerHTML||0);
        var format_jumlah_buyback = value_buyback.toLocaleString("id-ID")
        jumlah_buyback.text(format_jumlah_buyback);
        jumlah_buyback_hidden.text(value_buyback);
        getTotal();
        $('#pengajuan').val('').keyup();
    })
}
    

    // ============================== validasi
    
    // ============================== transaksi
    // $('#pengajuan').change(function(){
    //     $('#jangka_waktu_permohonan').val('Pilih').change()
    //     $('#jangka_waktu_permohonan').change(function(){
    //         if($(this).val() === '0.5'){
    //             if(parseFloat(total_gramasi)>=0.1 && parseFloat(total_gramasi)<=49.9){
    //                 jangka_waktu = $('#jangka_waktu_1').val()
    //                 numjangka_waktu = parseFloat(jangka_waktu)
    //                 pengali = $('#pengali_kurangdari_satudelapan_1').val()
    //                 numpengali = parseFloat(pengali)
    //                 hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*total_buyback).toFixed(0)
    //                 newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
    //                 bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
    //                 hasiljasa = bulathitungjasa.toLocaleString("id-ID")
    //                 $('#jasa_gtc').val(hasiljasa).trigger('change')
    //                 $('#pembayaran_jasa').val('Pilih').trigger('change')
    //             }else if(total_gramasi>=50){
    //                 jangka_waktu = $('#jangka_waktu_1').val()
    //                 numjangka_waktu = parseFloat(jangka_waktu)
    //                 pengali = $('#pengali_diatas_dua_1').val()
    //                 numpengali = parseFloat(pengali)
    //                 hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*total_buyback).toFixed(0)
    //                 newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
    //                 bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
    //                 hasiljasa = bulathitungjasa.toLocaleString("id-ID")
    //                 $('#jasa_gtc').val(hasiljasa).trigger('change')
    //                 $('#pembayaran_jasa').val('Pilih').trigger('change')
    //             }
    //         }else if($(this).val() === '1'){
    //             if(parseFloat(total_gramasi)>=0.1 && parseFloat(total_gramasi)<=49.9){
    //                 jangka_waktu = $('#jangka_waktu_2').val()
    //                 numjangka_waktu = parseFloat(jangka_waktu)
    //                 pengali = $('#pengali_kurangdari_satudelapan_2').val()
    //                 numpengali = parseFloat(pengali)
    //                 hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*total_buyback).toFixed(0)
    //                 newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
    //                 bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
    //                 hasiljasa = bulathitungjasa.toLocaleString("id-ID")
    //                 $('#jasa_gtc').val(hasiljasa).trigger('change')
    //                 $('#pembayaran_jasa').val('Pilih').trigger('change')
    //             }else if(total_gramasi>=50){
    //                 jangka_waktu = $('#jangka_waktu_2').val()
    //                 numjangka_waktu = parseFloat(jangka_waktu)
    //                 pengali = $('#pengali_diatas_dua_2').val()
    //                 numpengali = parseFloat(pengali)
    //                 hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*total_buyback).toFixed(0)
    //                 newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
    //                 bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
    //                 hasiljasa = bulathitungjasa.toLocaleString("id-ID")
    //                 $('#jasa_gtc').val(hasiljasa).trigger('change')
    //                 $('#pembayaran_jasa').val('Pilih').trigger('change')
    //             }
    //         }else if($(this).val() === '2'){
    //             if(parseFloat(total_gramasi)>=0.1 && parseFloat(total_gramasi)<=49.9){
    //                 jangka_waktu = $('#jangka_waktu_3').val()
    //                 numjangka_waktu = parseFloat(jangka_waktu)
    //                 pengali = $('#pengali_kurangdari_satudelapan_3').val()
    //                 numpengali = parseFloat(pengali)
    //                 hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*total_buyback).toFixed(0)
    //                 newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
    //                 bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
    //                 hasiljasa = bulathitungjasa.toLocaleString("id-ID")
    //                 $('#jasa_gtc').val(hasiljasa).trigger('change')
    //                 $('#pembayaran_jasa').val('Pilih').trigger('change')
    //             }else if(total_gramasi>=50){
    //                 jangka_waktu = $('#jangka_waktu_3').val()
    //                 numjangka_waktu = parseFloat(jangka_waktu)
    //                 pengali = $('#pengali_diatas_dua_3').val()
    //                 numpengali = parseFloat(pengali)
    //                 hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*total_buyback).toFixed(0)
    //                 newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
    //                 bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
    //                 hasiljasa = bulathitungjasa.toLocaleString("id-ID")
    //                 $('#jasa_gtc').val(hasiljasa).trigger('change')
    //                 $('#pembayaran_jasa').val('Pilih').trigger('change')
    //             }
    //         }else{
    //             $('#jasa_gtc').val('').trigger('change')
    //             $('#pembayaran_jasa').val('Pilih').trigger('change')
    //         }
    //     })
    //     $('#pembayaran_jasa').change(function(){
    //         if($(this).val() === 'Transfer'){
    //             $('#div_upload_bukti_transfer').show()
    //             $('#ket_simpwa').val('Pilih').change()
    //         }else if($(this).val() === 'Dipotong dari GTC'){
    //             $('#div_upload_bukti_transfer').hide()
    //             $('#ket_simpwa').val('Pilih').change()
    //         }else{
    //             $('#div_upload_bukti_transfer').hide()
    //             $('#ket_simpwa').val('Pilih').change()
    //         }
    //         $('#ket_simpwa').change(function(){
    //             if($(this).val() === 'Dipotong dari GTC'){
    //                 $('#div_nominal_potongan').show()
    //                 $('#nominal_potongan').change(function(){
    //                     var pengajuan = $('#pengajuan').val().replace(/[^,\d]/g, '').toString()
    //                     var jasa_gtc = $('#jasa_gtc').val().replace(/[^,\d]/g, '').toString()
    //                     var nominal_potongan = $('#nominal_potongan').val().replace(/[^,\d]/g, '').toString()
    //                     var jumlah_yang_di_transfer = pengajuan-jasa_gtc-nominal_potongan;
    //                     var jumlah_yang_di_transfer_format = jumlah_yang_di_transfer.toLocaleString("id-ID")
    //                     $('#jumlah_yang_di_transfer').val(jumlah_yang_di_transfer_format).change();
    //                 })
    //                 $('#jumlah_yang_di_transfer').val('').trigger();
    //             }else if($(this).val() === 'Lunas'){
    //                 $('#div_nominal_potongan').hide()
    //                 $('#nominal_potongan').val('').change();
    //                 var pengajuan = $('#pengajuan').val().replace(/[^,\d]/g, '').toString()
    //                 var jasa_gtc = $('#jasa_gtc').val().replace(/[^,\d]/g, '').toString()
    //                 var nominal_potongan = 0
    //                 var jumlah_yang_di_transfer = pengajuan-jasa_gtc-nominal_potongan;
    //                 var jumlah_yang_di_transfer_format = jumlah_yang_di_transfer.toLocaleString("id-ID")
    //                 $('#jumlah_yang_di_transfer').val(jumlah_yang_di_transfer_format).trigger();
    //             }else{
    //                 $('#div_nominal_potongan').hide()
    //                 $('#nominal_potongan').val('').change();
    //                 $('#nominal_potongan').change(function(){
    //                     $('#jumlah_yang_di_transfer').val('').change();
    //                 })
    //             }
    //         })
    //     })
    // })
    
// ================================================================================
function hapusdataemasgtc(kode) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger',
        },
        buttonsStyling: true
    })
    swalWithBootstrapButtons.fire({
        title: 'Hapus Data ?',
        text: "Data tidak dapat dipulihkan kembali!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!',
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
                url: '/backend/delete-emas-gtc/' + kode,
                data: {
                    'token': $('input[name=_token]').val(),
                },
                success: function () {
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Data Berhasil Dihapus.',
                        'success'
                    );
                    getdataemasgtc();
                    tabelemasgtc();
                    $('#panel').loading('stop');
                }
            })
        }
    })
}
// ================================================================================
$('#btnaddemasgtc').on('click', function (e) {
    if ($('#kode_pengajuan_emasgtc').val() == '' 
    || $('#item_emas').val() == '' 
    || $('#jenis').val() == '' 
    // || $('#gramasi').val() == '' 
    || $('#id_harga_buyback').val() == '' 
    || $('#harga_buyback').val() == '') {
        swalWithBootstrapButtons.fire({
            title: 'Oops',
            text: 'Data tidak boleh kosog',
            confirmButtonText: 'OK'
        });
        return false;
    } else {
        $('#panel').loading('toggle');
        $('#formaddemasgtc').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name=_token]').val()
                }
            });
            var formData = new FormData(this);
            $.ajax({
                url: '/backend/add-emas-gtc',
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
                    $('#addemasgtc').modal('hide');
                    $('#panel').loading('stop');
                    getdataemasgtc();
                }
            });
        });
    }
});
// ================================================================
function jumlahGram(id_input)
    {
        var gramasi = document.getElementsByClassName(`gramasi-${id_input}`);
        var x = document.getElementById(`input-keping-emas-${id_input}`).value;
        gramasi = parseFloat(gramasi[0].value)
        var total = x*gramasi;
        total = total.toFixed(1);
        document.getElementById(`jumlah-keping-${id_input}`).innerHTML = total;
        document.getElementById(`input-jumlah-keping-${id_input}`).value = total;
        var length = $("#form_tambah_emas tr").length;
        var total = 0;
        var test_number = 0;
        for(let i = 1; i<=length; i++)
        {
            test_number += parseFloat(document.getElementById(`jumlah-keping-${i}`).innerText)
        }
        total = parseFloat(total).toFixed(1);
        document.getElementById(`total_jumlah_emas`).innerHTML = test_number;
        document.getElementById(`input_total_jumlah_emas`).value = test_number;
    }
$(document).ready(function(){
$(".tambah_emas").click(function(){
            hasilAkhir = [];
            item = $(this)[0].dataset.item;
            jenis = $(this)[0].dataset.jenis;
            gramasi = $(this)[0].dataset.gramasi;
            id_emas = $(this)[0].dataset.id_emas;
            var length = $("#form_tambah_emas tr").length;
            let index_emas = 1;
            if(length != 0){
                index_emas++;
            }
            $("#form_tambah_emas").append(`
            <tr id="item-emas-${index_emas}">
                <td>${item}</td>
                <input type="hidden" value="${item}" class="form-control" name="item_emas[]">
                <td>
                    <span class="badge badge-primary-lighten">${jenis}</span>
                    <input type="hidden" value="${jenis}" class="form-control" name="jenis_emas[]">
                </td>
                <td>${gramasi}</td>
                <input type="hidden" value="${gramasi}" class="form-control gramasi-${index_emas}" name="gramasi_emas[]">
                <td>
                    <input id="input-keping-emas-${index_emas}" type="number" min="1" value="" oninput="jumlahGram(${index_emas})" name="keping_emas[]" class="form-control" placeholder="Qty" style="width: 90px;" required>
                </td>
                <td>
                    <span id="jumlah-keping-${index_emas}">
                       0
                    </span>
                    Gram
                    <input id="input-jumlah-keping-${index_emas}" type="hidden" value="${jenis}" class="form-control" name="jumlah_keping[]">
                </td>
                <td>
                    <a href="javascript:void(0);" id="removeRow" data-index_emas="${index_emas}" data-id_emas="${id_emas}" class="action-icon"> <i
                            class="mdi mdi-delete"></i></a>
                </td>
            </tr>
            `)
            $(`#tambah-emas-${id_emas}`).css("display","none");
        });
        $(document).on('click', '#removeRow', function () {
            index_emas = $(this)[0].dataset.index_emas;
            id_emas = $(this)[0].dataset.id_emas;
            var jumlah_terhapus = $(`#jumlah-keping-${index_emas}`)[0].innerText; 
            var input_total_jumlah = document.getElementById(`input_total_jumlah_emas`).value;
            var nilai_akhir = parseFloat(input_total_jumlah)-parseFloat(jumlah_terhapus);
            nilai_akhir = parseFloat(nilai_akhir).toFixed(1);
            if(nilai_akhir == 0.0){
                nilai_akhir = 0;
            }
            document.getElementById(`total_jumlah_emas`).innerHTML = nilai_akhir;
            document.getElementById(`input_total_jumlah_emas`).value = nilai_akhir;
            $(this).closest(`#item-emas-${index_emas}`).remove();
            $(`#tambah-emas-${id_emas}`).css("display","block");
        });
    })

function tabelemasgtc() {
    $('#panel').loading('toggle');
    $('#tbodyemasgtc').html('');
    $.ajax({
        type: 'GET',
        url: '/backend/tabel-emas-gtc',
        success: function (data) {
            var rows = '';
            var no = 0;
            $.each(data.emas_syirkah, function (key, item) {
                no += 1;
                rows = rows + '<tr>';
                rows = rows + '<td>' + item.nama + '</td>';
                rows = rows + '<td><span class="badge badge-primary-lighten">'+ item.jenis +'</span></td>';
                rows = rows + '<td>' + item.gramasi + '</td>';
                rows = rows + '<td><a id="btnaddtabelemasgtc'+item.id+'" onclick="addtabelemasgtc('+ item.id +')" class="action-icon"> <i class="mdi mdi-plus-box"></i></a></td>';
                rows = rows + '</tr>';
            }
            );
            $('#tbodyemasgtc').html(rows);
        }, complete: function () {
            $('#panel').loading('stop');
            getTotal();
        }
    });
}
function addtabelemasgtc(kode){
    var pengajuan = $('#kode_pengajuan').val()
    $.ajax({
        url: '/backend/add-tabel-emas-gtc/' + kode + '/' + pengajuan,
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
            $('#addemasgtc').modal('hide');
            $('#panel').loading('stop');
            getdataemasgtc();
        }
    });
}
function hiddenbtnaddtabelemasgtc(){
    var kode = $('#kode_pengajuan').val();
    $.ajax({
        type: 'GET',
        url: '/backend/cari-data-emas-gtc/' + kode,
        success: function (data) {
            $.each(data.emas, function (key, value) {
                $('#btnaddtabelemasgtc'+value.id_item_emas_syirkah).hide();
            }
            );
        }, complete: function () {
            getTotal();
            $('#panel').loading('stop');
        }
    });
}