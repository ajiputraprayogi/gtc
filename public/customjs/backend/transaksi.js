const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger',
    },
    buttonsStyling: true
})
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
        ajax: '/backend/list-transaksi/' + kode,
        columns: [
            {
                data: 'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'kode_transaksi', name: 'kode_transaksi' },
            { data: 'jenis_transaksi', name: 'jenis_transaksi' },
            { data: 'pilihan_jasa', name: 'pilihan_jasa' },
            { data: 'perhitungan_jasa', name: 'perhitungan_jasa' },
            { data: 'tgl_sebelumnya', name: 'tgl_sebelumnya' },
            {
                data: 'jangka_waktu_permohonan', name: 'jangka_waktu_permohonan',
                "render": function(data, type, row, meta){
                    if(type === 'display'){
                       data = data + ((data == 1) ? " Bulan" : " Bulan");
                    }
                    return data;
                 }
            },
            { data: 'jatuh_tempo', name: 'jatuh_tempo' },
            { data: 'jasa_gtc', render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' ), name: 'jasa_gtc' },
            { data: 'pembayaran_jasa_manual', render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' ), name: 'pembayaran_jasa_manual' },
            { data: 'sbte', name: 'sbte' },
            { data: 'pilihan_jasa', name: 'pilihan_jasa' },
            {
                render: function (data, type, row) {
                    if(perwada !== 1){
                        return '<a onclick="viewtransaksi('+ row['id'] +')" class="action-icon" title="View Transaksi"> <i class="mdi mdi-card-search"></i></a> <a onclick="jasadiakhir('+ row['id'] +')" class="action-icon" title="Transaksi Jasa Di akhir"> <i class="mdi mdi-receipt"></i></a> <a href="javascript:void(0);" class="action-icon" data-bs-container="#tooltip-container2" data-bs-toggle="tooltip" title="Cetak SBTE"> <i class="mdi mdi-printer-outline"></i></a>'
                    }else{
                        return '<a onclick="viewtransaksi('+ row['id'] +')" class="action-icon" title="View Transaksi"> <i class="mdi mdi-card-search"></i></a> <a onclick="uploadbuktitrf('+ row['id'] +')" class="action-icon" title="Upload trf"> <i class="mdi mdi-file-upload"></i></a><a onclick="edittransaksi('+ row['id'] +')" class="action-icon" title="Edit Transaksi"> <i class="mdi mdi-file-edit"></i></a> <a onclick="jasadiakhir('+ row['id'] +')" class="action-icon" title="Transaksi Jasa Di akhir"> <i class="mdi mdi-receipt"></i></a><a onclick="aprovalopr('+ row['id'] +')" class="action-icon" title="Aproval OPR"> <i class="mdi mdi-check-circle"></i></a><a onclick="aprovalkeu('+ row['id'] +')" class="action-icon" title="Aproval Kasir"> <i class="mdi mdi-check-circle"></i></a> <a href="javascript:void(0);" class="action-icon" data-bs-container="#tooltip-container2" data-bs-toggle="tooltip" title="Cetak SBTE"> <i class="mdi mdi-printer-outline"></i></a>'
                    }
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
// ====================================================================================
function transaksi2(){
    $('#panel').loading('toggle');
    var kode2 = $('#id_pengajuan').val();
    $.ajax({
        type: 'GET',
        url: '/backend/transaksi2/'+ kode2,
        success: function (data) {
            var no = 0;
            $.each(data.data, function (key, value) {
                $('#transaksi_nomor_ba').val(value.nomor_ba);
                $('#transaksi_nama_lengkap').text(': '+value.nama_lengkap);
                $('#transaksi_tanggal_pengajuan').text(': '+value.tanggal_pengajuan);
                $('#transaksi_id_perwada').text(': '+value.id_perwada);
                $('#transaksi_kode_pengajuan').text(': '+value.kode_pengajuan);
                $('#transaksi_pinjaman_awal').text(': Rp '+parseInt(value.pengajuan).toLocaleString("id-ID"));
                $('#transaksi_sisa_pinjaman').text(': Rp '+data.sisapinjaman.toLocaleString("id-ID"));
                $('#transaksi_jenis_transaksi').text(': '+value.jenis_transaksi);
                $('#transaksi_pilihan_jasa').text(': '+value.pilihan_jasa);
                $('#transaksi_perhitungan_jasa').text(': '+value.perhitungan_jasa);
                $('#transaksi_jangka_waktu_permohonan').text(': '+value.jangka_waktu_permohonan+' Bulan');
                $('#transaksi_biaya_jasa').text(': Rp '+parseInt(value.jasa_gtc).toLocaleString("id-ID"));
                $
            }
            );
            $.each(data.emas, function (key, value) {
                no += 1;
                $('#pengajuan_keping'+value.id).text(value.keping);
                $('#pengajuan_sub_gramasi'+value.id).text(value.keping+' Gram');
                $('#pengajuan_total_keping').text(data.pengajuantotalkeping);
                $('#pengajuan_total_gramasi').text(data.pengajuantotalgramasi+' Gram');
                $('#pengambilan_keping'+value.id).text(data.keping[no-1].total);
                var pengambilan_gramasi = value.gramasi*data.keping[no-1].total;
                $('#pengambilan_sub_gramasi'+value.id).text(pengambilan_gramasi+' Gram');
                $('#pengambilan_total_keping').text(data.pengambilantotalkeping);
                $('#pengambilan_total_gramasi').text(data.pengambilantotalgramasi+' Gram');
                var sisa_keping = value.keping-data.keping[no-1].total;
                $('#sisa_keping'+value.id).text(sisa_keping);
                var sgramasi = value.keping-data.keping[no-1].total;
                var sisa_gramasi = value.gramasi*sgramasi;
                $('#sisa_sub_gramasi'+value.id).text(sisa_gramasi+' Gram');
                $('#sisa_total_keping').text(data.sisatotalkeping);
                $('#sisa_total_gramasi').text(data.sisatotalgramasi+' Gram');
            })
        }, complete: function () {
            $('#panel').loading('stop');
        }
    });
}
// ====================================================================================
// $("#scroll-horizontal-datatable").DataTable({
//     scrollX:!0,
//     language:{
//     paginate:{
//         previous:"<i class='mdi mdi-chevron-left'>",
//         next:"<i class='mdi mdi-chevron-right'>"
//     }
//     },
//     drawCallback:function(){
//         $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
//     }
// })
// ====================================================================================
$(function(){
    $('#tambah_jenis_transaksi').bind("change keyup", function(){
        if($(this).val() === 'Perpanjangan'){
            var kode = $('#tambah_kode_pengajuan').val();
            $('#tambah_nominal_pinjaman').val('')
            $('#hidden_tambah_nominal_pinjaman').val('')
            $('#tambah_pembayaran_pinjaman').val('')
            $('#hidden_tambah_pembayaran_pinjaman').val('')
            $('#tambah_sisa_pinjaman').val('')
            $('#tambah_plafond_pinjaman').val('')
            $('#tambah_plafond_pinjaman_hidden').val('')
            $('#tambah_jangka_waktu_permohonan').val('Pilih');
            $('#tambah_jasa_gtc').val('');
            $('#tambah_upload_bukti_transfer').val('');
            $('#tambah_pembayaran').val('');
            // ===================
            $('#tambah_jangka_waktu_1').val('')
            $('#tambah_pengali_kurangdari_satudelapan_1').val('')
            $('#tambah_pengali_diatas_dua_1').val('')
            $('#tambah_jangka_waktu_2').val('')
            $('#tambah_pengali_kurangdari_satudelapan_2').val('')
            $('#tambah_pengali_diatas_dua_2').val('')
            $('#tambah_jangka_waktu_3').val('')
            $('#tambah_pengali_kurangdari_satudelapan_3').val('')
            $('#tambah_pengali_diatas_dua_3').val('')
            $('#tambah_jangka_waktu_4').val('')
            $('#tambah_pengali_kurangdari_satudelapan_4').val('')
            $('#tambah_pengali_diatas_dua_4').val('')
            tambahtransaksi(kode);
            $('#divemasselanjutnya').show();
            $('#divtransaksi').show();
            $('#divpembayaran').show();
            $('#divbtnsimpan').show();
            $('#divemassebelumnya').hide();
            $('#divpelunasan').hide();
            getdataemasgtc();
            getdataemasgtc2();
            // ========================================================================================
            $('#panel').loading('toggle');
            var kode = $('#id_pengajuan').val();
            $.ajax({
                type: 'GET',
                url: '/backend/cari-data-emas-transaksi-gtc/' + kode,
                success: function (data) {
                    $.each(data.jenisjasagtc, function(key, item){
                        $('#tambah_jangka_waktu_1').val(item.jangka_waktu_1)
                        $('#tambah_pengali_kurangdari_satudelapan_1').val(item.pengali_kurangdari_satudelapan_1)
                        $('#tambah_pengali_diatas_dua_1').val(item.pengali_diatas_dua_1)
                        $('#tambah_jangka_waktu_2').val(item.jangka_waktu_2)
                        $('#tambah_pengali_kurangdari_satudelapan_2').val(item.pengali_kurangdari_satudelapan_2)
                        $('#tambah_pengali_diatas_dua_2').val(item.pengali_diatas_dua_2)
                        $('#tambah_jangka_waktu_3').val(item.jangka_waktu_3)
                        $('#tambah_pengali_kurangdari_satudelapan_3').val(item.pengali_kurangdari_satudelapan_3)
                        $('#tambah_pengali_diatas_dua_3').val(item.pengali_diatas_dua_3)
                        $('#tambah_jangka_waktu_4').val(item.jangka_waktu_4)
                        $('#tambah_pengali_kurangdari_satudelapan_4').val(item.pengali_kurangdari_satudelapan_4)
                        $('#tambah_pengali_diatas_dua_4').val(item.pengali_diatas_dua_4)
                    })
                    $.each(data.emas, function (key, value) {
                        var newformat = data.totalbuyback;
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
                        $("#tambah_plafond_pinjaman").val(rupiah).trigger('change');
                        var plafond_pinjaman = $("#tambah_plafond_pinjaman").val();
                        var newplafond_pinjaman = plafond_pinjaman.replace(/[^,\d]/g, '').toString();
                        $("#tambah_plafond_pinjaman_hidden").val(newplafond_pinjaman).trigger('change');
                        // ======================================================================
                        $('#tambah_jangka_waktu_permohonan').change(function(){
                            if($(this).val() === '0.5'){
                                if(parseFloat(data.fgramasi.toFixed(0))>=0.1 && parseFloat(data.fgramasi.toFixed(0))<=49.9){
                                    jangka_waktu = $('#tambah_jangka_waktu_1').val()
                                    numjangka_waktu = parseFloat(jangka_waktu)
                                    pengali = $('#tambah_pengali_kurangdari_satudelapan_1').val()
                                    numpengali = parseFloat(pengali)
                                    hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*data.totalbuyback).toFixed(0)
                                    newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                    bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                    hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                    $('#tambah_jasa_gtc').val(hasiljasa).trigger("change")
                                    $('#tambah_pembayaran_jasa').val('Transfer').trigger("change")
                                }else if(data.fgramasi.toFixed(0)>=50){
                                    jangka_waktu = $('#tambah_jangka_waktu_1').val()
                                    numjangka_waktu = parseFloat(jangka_waktu)
                                    pengali = $('#tambah_pengali_diatas_dua_1').val()
                                    numpengali = parseFloat(pengali)
                                    hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*data.totalbuyback).toFixed(0)
                                    newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                    bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                    hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                    $('#tambah_jasa_gtc').val(hasiljasa).trigger("change")
                                    $('#tambah_pembayaran_jasa').val('Transfer').trigger("change")
                                }
                            }else if($(this).val() === '1'){
                                if(parseFloat(data.fgramasi.toFixed(0))>=0.1 && parseFloat(data.fgramasi.toFixed(0))<=49.9){
                                    jangka_waktu = $('#tambah_jangka_waktu_2').val()
                                    numjangka_waktu = parseFloat(jangka_waktu)
                                    pengali = $('#tambah_pengali_kurangdari_satudelapan_2').val()
                                    numpengali = parseFloat(pengali)
                                    hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*data.totalbuyback).toFixed(0)
                                    newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                    bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                    hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                    $('#tambah_jasa_gtc').val(hasiljasa).trigger("change")
                                    $('#tambah_pembayaran_jasa').val('Transfer').trigger("change")
                                }else if(data.fgramasi.toFixed(0)>=50){
                                    jangka_waktu = $('#tambah_jangka_waktu_2').val()
                                    numjangka_waktu = parseFloat(jangka_waktu)
                                    pengali = $('#tambah_pengali_diatas_dua_2').val()
                                    numpengali = parseFloat(pengali)
                                    hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*data.totalbuyback).toFixed(0)
                                    newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                    bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                    hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                    $('#tambah_jasa_gtc').val(hasiljasa).trigger("change")
                                    $('#tambah_pembayaran_jasa').val('Transfer').trigger("change")
                                }
                            }else if($(this).val() === '2'){
                                if(parseFloat(data.fgramasi.toFixed(0))>=0.1 && parseFloat(data.fgramasi.toFixed(0))<=49.9){
                                    jangka_waktu = $('#tambah_jangka_waktu_3').val()
                                    numjangka_waktu = parseFloat(jangka_waktu)
                                    pengali = $('#tambah_pengali_kurangdari_satudelapan_3').val()
                                    numpengali = parseFloat(pengali)
                                    hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*data.totalbuyback).toFixed(0)
                                    newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                    bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                    hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                    $('#tambah_jasa_gtc').val(hasiljasa).trigger("change")
                                    $('#tambah_pembayaran_jasa').val('Transfer').trigger("change")
                                }else if(data.fgramasi.toFixed(0)>=50){
                                    jangka_waktu = $('#tambah_jangka_waktu_3').val()
                                    numjangka_waktu = parseFloat(jangka_waktu)
                                    pengali = $('#tambah_pengali_diatas_dua_3').val()
                                    numpengali = parseFloat(pengali)
                                    hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*data.totalbuyback).toFixed(0)
                                    newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                    bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                    hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                    $('#tambah_jasa_gtc').val(hasiljasa).trigger("change")
                                    $('#tambah_pembayaran_jasa').val('Transfer').trigger("change")
                                }
                            }else{
                                $('#tambah_jasa_gtc').val(0).trigger("change")
                                $('#pembayaran_jasa_manual').val('').trigger("change");
                                $('#div_nominal_potongan').hide()
                                $('#nominal_potongan').val('').trigger("change");
                                $('#jumlah_yang_di_transfer').val('').trigger("change");
                                $('#tambah_pembayaran_jasa').val('Transfer').trigger("change")
                            }
                        });
                    });
                }, complete: function () {
                    $('#panel').loading('stop');
                }
            });
            $('#tambah_pembayaran').bind("change keyup", function(){
                var pembayaran = parseInt($(this).val().replace(/[^,\d]/g, '').toString());
                var jasagtc = parseInt($('#tambah_jasa_gtc').val().replace(/[^,\d]/g, '').toString());
                var hitung = pembayaran-jasagtc;
                $('#tambah_sisa_pembayaran').val(hitung.toLocaleString("id-ID"));
                $('#tambah_sisa_pembayaran_hidden').val(hitung);
            });
        }else if($(this).val() === 'Pelunasan Sebagian'){
            var kode = $('#tambah_kode_pengajuan').val();
            $('#tambah_nominal_pinjaman').val('')
            $('#hidden_tambah_nominal_pinjaman').val('')
            $('#tambah_pembayaran_pinjaman').val('')
            $('#hidden_tambah_pembayaran_pinjaman').val('')
            $('#tambah_sisa_pinjaman').val('')
            $('#tambah_plafond_pinjaman').val('')
            $('#tambah_plafond_pinjaman_hidden').val('')
            $('#tambah_jangka_waktu_permohonan').val('Pilih');
            $('#tambah_jasa_gtc').val('');
            $('#tambah_upload_bukti_transfer').val('');
            $('#tambah_pembayaran').val('');
            // ===================
            $('#tambah_jangka_waktu_1').val('')
            $('#tambah_pengali_kurangdari_satudelapan_1').val('')
            $('#tambah_pengali_diatas_dua_1').val('')
            $('#tambah_jangka_waktu_2').val('')
            $('#tambah_pengali_kurangdari_satudelapan_2').val('')
            $('#tambah_pengali_diatas_dua_2').val('')
            $('#tambah_jangka_waktu_3').val('')
            $('#tambah_pengali_kurangdari_satudelapan_3').val('')
            $('#tambah_pengali_diatas_dua_3').val('')
            $('#tambah_jangka_waktu_4').val('')
            $('#tambah_pengali_kurangdari_satudelapan_4').val('')
            $('#tambah_pengali_diatas_dua_4').val('')
            tambahtransaksi(kode);
            $('#divemassebelumnya').show();
            $('#divemasselanjutnya').show();
            $('#divpelunasan').show();
            $('#divtransaksi').show();
            $('#divpembayaran').show();
            $('#divbtnsimpan').show();
            getdataemasgtc();
            getdataemasgtc2();
            // ======================================================================
            $('#panel').loading('toggle');
            var kode = $('#id_pengajuan').val();
            $.ajax({
                type: 'GET',
                url: '/backend/cari-data-emas-transaksi-gtc/' + kode,
                success: function (data) {
                    $.each(data.jenisjasagtc, function(key, item){
                        $('#tambah_jangka_waktu_1').val(item.jangka_waktu_1)
                        $('#tambah_pengali_kurangdari_satudelapan_1').val(item.pengali_kurangdari_satudelapan_1)
                        $('#tambah_pengali_diatas_dua_1').val(item.pengali_diatas_dua_1)
                        $('#tambah_jangka_waktu_2').val(item.jangka_waktu_2)
                        $('#tambah_pengali_kurangdari_satudelapan_2').val(item.pengali_kurangdari_satudelapan_2)
                        $('#tambah_pengali_diatas_dua_2').val(item.pengali_diatas_dua_2)
                        $('#tambah_jangka_waktu_3').val(item.jangka_waktu_3)
                        $('#tambah_pengali_kurangdari_satudelapan_3').val(item.pengali_kurangdari_satudelapan_3)
                        $('#tambah_pengali_diatas_dua_3').val(item.pengali_diatas_dua_3)
                        $('#tambah_jangka_waktu_4').val(item.jangka_waktu_4)
                        $('#tambah_pengali_kurangdari_satudelapan_4').val(item.pengali_kurangdari_satudelapan_4)
                        $('#tambah_pengali_diatas_dua_4').val(item.pengali_diatas_dua_4)
                    })
                    $.each(data.emas, function (key, value) {
                        var newformat = data.totalbuyback;
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
                        $("#tambah_plafond_pinjaman").val(rupiah).trigger('change');
                        var plafond_pinjaman = $("#tambah_plafond_pinjaman").val();
                        var newplafond_pinjaman = plafond_pinjaman.replace(/[^,\d]/g, '').toString();
                        $("#tambah_plafond_pinjaman_hidden").val(newplafond_pinjaman).trigger('change');
                        // ======================================================================
                        $('#tambah_jangka_waktu_permohonan').change(function(){
                            var totalbuyback = $('#total_buyback2_hidden').val();
                            if($(this).val() === '0.5'){
                                if(parseFloat(data.fgramasi.toFixed(0))>=0.1 && parseFloat(data.fgramasi.toFixed(0))<=49.9){
                                    jangka_waktu = $('#tambah_jangka_waktu_1').val()
                                    numjangka_waktu = parseFloat(jangka_waktu)
                                    pengali = $('#tambah_pengali_kurangdari_satudelapan_1').val()
                                    numpengali = parseFloat(pengali)
                                    hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*totalbuyback).toFixed(0)
                                    newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                    bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                    hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                    $('#tambah_jasa_gtc').val(hasiljasa).trigger("change")
                                    $('#tambah_pembayaran_jasa').val('Transfer').trigger("change")
                                }else if(data.fgramasi.toFixed(0)>=50){
                                    jangka_waktu = $('#tambah_jangka_waktu_1').val()
                                    numjangka_waktu = parseFloat(jangka_waktu)
                                    pengali = $('#tambah_pengali_diatas_dua_1').val()
                                    numpengali = parseFloat(pengali)
                                    hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*totalbuyback).toFixed(0)
                                    newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                    bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                    hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                    $('#tambah_jasa_gtc').val(hasiljasa).trigger("change")
                                    $('#tambah_pembayaran_jasa').val('Transfer').trigger("change")
                                }
                            }else if($(this).val() === '1'){
                                if(parseFloat(data.fgramasi.toFixed(0))>=0.1 && parseFloat(data.fgramasi.toFixed(0))<=49.9){
                                    jangka_waktu = $('#tambah_jangka_waktu_2').val()
                                    numjangka_waktu = parseFloat(jangka_waktu)
                                    pengali = $('#tambah_pengali_kurangdari_satudelapan_2').val()
                                    numpengali = parseFloat(pengali)
                                    hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*totalbuyback).toFixed(0)
                                    newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                    bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                    hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                    $('#tambah_jasa_gtc').val(hasiljasa).trigger("change")
                                    $('#tambah_pembayaran_jasa').val('Transfer').trigger("change")
                                }else if(data.fgramasi.toFixed(0)>=50){
                                    jangka_waktu = $('#tambah_jangka_waktu_2').val()
                                    numjangka_waktu = parseFloat(jangka_waktu)
                                    pengali = $('#tambah_pengali_diatas_dua_2').val()
                                    numpengali = parseFloat(pengali)
                                    hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*totalbuyback).toFixed(0)
                                    newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                    bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                    hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                    $('#tambah_jasa_gtc').val(hasiljasa).trigger("change")
                                    $('#tambah_pembayaran_jasa').val('Transfer').trigger("change")
                                }
                            }else if($(this).val() === '2'){
                                if(parseFloat(data.fgramasi.toFixed(0))>=0.1 && parseFloat(data.fgramasi.toFixed(0))<=49.9){
                                    jangka_waktu = $('#tambah_jangka_waktu_3').val()
                                    numjangka_waktu = parseFloat(jangka_waktu)
                                    pengali = $('#tambah_pengali_kurangdari_satudelapan_3').val()
                                    numpengali = parseFloat(pengali)
                                    hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*totalbuyback).toFixed(0)
                                    newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                    bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                    hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                    $('#tambah_jasa_gtc').val(hasiljasa).trigger("change")
                                    $('#tambah_pembayaran_jasa').val('Transfer').trigger("change")
                                }else if(data.fgramasi.toFixed(0)>=50){
                                    jangka_waktu = $('#tambah_jangka_waktu_3').val()
                                    numjangka_waktu = parseFloat(jangka_waktu)
                                    pengali = $('#tambah_pengali_diatas_dua_3').val()
                                    numpengali = parseFloat(pengali)
                                    hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*totalbuyback).toFixed(0)
                                    newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                    bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                    hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                    $('#tambah_jasa_gtc').val(hasiljasa).trigger("change")
                                    $('#tambah_pembayaran_jasa').val('Transfer').trigger("change")
                                }
                            }else{
                                $('#tambah_jasa_gtc').val(0).trigger("change")
                                $('#pembayaran_jasa_manual').val('').trigger("change");
                                $('#div_nominal_potongan').hide()
                                $('#nominal_potongan').val('').trigger("change");
                                $('#jumlah_yang_di_transfer').val('').trigger("change");
                                $('#tambah_pembayaran_jasa').val('Transfer').trigger("change")
                            }
                        });
                    });
                }, complete: function () {
                    $('#panel').loading('stop');
                }
            });
            $('#tambah_pembayaran').bind("change keyup", function(){
                var pembayaran = parseInt($(this).val().replace(/[^,\d]/g, '').toString());
                var pembayaranpinjaman = parseInt($('#tambah_pembayaran_pinjaman').val().replace(/[^,\d]/g, '').toString());
                var jasagtc = parseInt($('#tambah_jasa_gtc').val().replace(/[^,\d]/g, '').toString());
                var tambah = pembayaranpinjaman+jasagtc;
                var hitung = pembayaran-tambah;
                $('#tambah_sisa_pembayaran').val(hitung.toLocaleString("id-ID"));
                $('#tambah_sisa_pembayaran_hidden').val(hitung);
            });
        }else if($(this).val() === 'Pelunasan'){
            var kode = $('#tambah_kode_pengajuan').val();
            $('#tambah_nominal_pinjaman').val('')
            $('#hidden_tambah_nominal_pinjaman').val('')
            $('#tambah_pembayaran_pinjaman').val('')
            $('#hidden_tambah_pembayaran_pinjaman').val('')
            $('#tambah_sisa_pinjaman').val('')
            $('#tambah_plafond_pinjaman').val('')
            $('#tambah_plafond_pinjaman_hidden').val('')
            $('#tambah_jangka_waktu_permohonan').val('Pilih');
            $('#tambah_jasa_gtc').val('');
            $('#tambah_upload_bukti_transfer').val('');
            $('#tambah_pembayaran').val('');
            // ===================
            $('#tambah_jangka_waktu_1').val('')
            $('#tambah_pengali_kurangdari_satudelapan_1').val('')
            $('#tambah_pengali_diatas_dua_1').val('')
            $('#tambah_jangka_waktu_2').val('')
            $('#tambah_pengali_kurangdari_satudelapan_2').val('')
            $('#tambah_pengali_diatas_dua_2').val('')
            $('#tambah_jangka_waktu_3').val('')
            $('#tambah_pengali_kurangdari_satudelapan_3').val('')
            $('#tambah_pengali_diatas_dua_3').val('')
            $('#tambah_jangka_waktu_4').val('')
            $('#tambah_pengali_kurangdari_satudelapan_4').val('')
            $('#tambah_pengali_diatas_dua_4').val('')
            tambahtransaksi(kode);
            $('#divemassebelumnya').show();
            $('#divemasselanjutnya').show();
            $('#divpelunasan').show();
            $('#divpembayaran').show();
            $('#divbtnsimpan').show();
            $('#divtransaksi').hide();
            getdataemasgtc();
            getdataemasgtc2();
            $('#tambah_pembayaran').bind("change keyup", function(){
                var pembayaran = parseInt($(this).val().replace(/[^,\d]/g, '').toString());
                var pembayaranpinjaman = parseInt($('#tambah_pembayaran_pinjaman').val().replace(/[^,\d]/g, '').toString());
                var hitung = pembayaran-pembayaranpinjaman;
                $('#tambah_sisa_pembayaran').val(hitung.toLocaleString("id-ID"));
                $('#tambah_sisa_pembayaran_hidden').val(hitung);
            });
        }else{
            var kode = $('#tambah_kode_pengajuan').val();
            $('#tambah_nominal_pinjaman').val('')
            $('#hidden_tambah_nominal_pinjaman').val('')
            $('#tambah_pembayaran_pinjaman').val('')
            $('#hidden_tambah_pembayaran_pinjaman').val('')
            $('#tambah_sisa_pinjaman').val('')
            $('#tambah_plafond_pinjaman').val('')
            $('#tambah_plafond_pinjaman_hidden').val('')
            $('#tambah_jangka_waktu_permohonan').val('Pilih');
            $('#tambah_jasa_gtc').val('');
            $('#tambah_upload_bukti_transfer').val('');
            $('#tambah_pembayaran').val('');
            // ===================
            $('#tambah_jangka_waktu_1').val('')
            $('#tambah_pengali_kurangdari_satudelapan_1').val('')
            $('#tambah_pengali_diatas_dua_1').val('')
            $('#tambah_jangka_waktu_2').val('')
            $('#tambah_pengali_kurangdari_satudelapan_2').val('')
            $('#tambah_pengali_diatas_dua_2').val('')
            $('#tambah_jangka_waktu_3').val('')
            $('#tambah_pengali_kurangdari_satudelapan_3').val('')
            $('#tambah_pengali_diatas_dua_3').val('')
            $('#tambah_jangka_waktu_4').val('')
            $('#tambah_pengali_kurangdari_satudelapan_4').val('')
            $('#tambah_pengali_diatas_dua_4').val('')
            tambahtransaksi(kode);
            $('#divemassebelumnya').hide();
            $('#divemasselanjutnya').hide();
            $('#divpelunasan').hide();
            $('#divtransaksi').hide();
            $('#divpembayaran').hide();
            $('#divbtnsimpan').hide();
            getdataemasgtc();
            getdataemasgtc2();
        }
    });
    $('#tambah_pembayaran_pinjaman').bind("change keyup", function(){
        $('#hidden_tambah_pembayaran_pinjaman').val($(this).val().replace(/[^,\d]/g, '').toString()).trigger('change');
        var nominal_pinjaman = $('#hidden_tambah_nominal_pinjaman').val();
        var tambah_pembayaran_pinjaman = $('#hidden_tambah_pembayaran_pinjaman').val();
        var hitung = nominal_pinjaman-tambah_pembayaran_pinjaman;
        $('#hidden_tambah_sisa_pinjaman').val(hitung).trigger('change');
        $('#tambah_sisa_pinjaman').val(hitung.toLocaleString('id-ID')).trigger('change');
    });
    $('#tambah_pembayaran').bind("change keyup", function(){
        $('#tambah_pembayaran_hidden').val($(this).val().replace(/[^,\d]/g, '').toString()).trigger('change');
    });
})
// ====================================================================================
function tambahtransaksi(kode){
    $('#panel').loading('toggle');
    $.ajax({
        type: 'GET',
        url: '/backend/list-tambah-transaksi/' + kode,
        success: function (data) {
            if(data.cekaproval.aproval_keu !=='Y'){
                swalWithBootstrapButtons.fire({
                    title: 'Maaf',
                    text: 'Transaksi terakhir belum di aproval',
                    confirmButtonText: 'OK'
                });
                return false;
            }else{
                $.each(data.data, function(key, value){
                    $('#tambah_id_pengajuan').val(value.kode_pengajuan);
                    $('#tambah_id_perwada').val(value.id_perwada);
                    $('#tambah_nama_perwada').val(data.namaperwada.nama);
                    $('#tambah_kode_pengajuan').val(value.kode_pengajuan);
                    $('#tambah_nominal_pinjaman').val(data.nominalpinjaman.toLocaleString("id-ID"));
                    $('#hidden_tambah_nominal_pinjaman').val(data.nominalpinjaman);
                    $('#tambah_sisa_pinjaman').val(data.nominalpinjaman.toLocaleString("id-ID"));
                    $('#hidden_tambah_sisa_pinjaman').val(data.nominalpinjaman);
                    $('#tambah_pilihan_jasa').val(value.pilihan_jasa);
                    $('#tambah_perhitungan_jasa').val(value.perhitungan_jasa);
                }),
                $('#tambah_kode_transaksi').val(data.finalkodetransaksi);
                $('#modal-tambah-transaksi').modal('show');
                getdataemasgtc();
                getdataemasgtc2();
            }
        },
        complete: function(){
            $('#panel').loading('stop')
        }
    })
}
// ====================================================================================
$('#btntambahtransaksi').on('click', function(e){
    var pembayaranpinjaman = $('#hidden_tambah_pembayaran_pinjaman').val();
    var jasagtc = $('#tambah_jasa_gtc').val().replace(/[^,\d]/g, '').toString();
    var pembayaran = $('#tambah_pembayaran_hidden').val();
    if ($('#tambah_jenis_transaksi').val() === 'Perpanjangan') {
        if(parseInt(pembayaran)<parseInt(jasagtc)){
            swalWithBootstrapButtons.fire({
                title: 'Oops',
                text: 'Pembayaran kurang',
                confirmButtonText: 'OK'
            });
            return false;
        }else{
            $('#panel').loading('toggle');
            $('#formtambahtransaksi').on('submit', function (e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name=_token]').val()
                    }
                });
                var formData = new FormData(this);
                $.ajax({
                    url: '/backend/tambah-transaksi',
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
                        $('#list-data').DataTable().ajax.reload();
                        $('#modal-tambah-transaksi').modal('hide');
                        transaksi2();
                    }
                });
            });
        }
    }else if($('#tambah_jenis_transaksi').val() === 'Pelunasan Sebagian'){
        var totalbuyback = $('#total_buyback2_hidden').val();
        var sisapinjaman = $('#hidden_tambah_sisa_pinjaman').val();
        var persen = (totalbuyback/100)*90;
        if(parseInt(persen)<parseInt(sisapinjaman)){
            swalWithBootstrapButtons.fire({
                title: 'Oops',
                text: 'Minimal sisa pinjaman adalah 90% dari total buyback',
                confirmButtonText: 'OK'
            });
            return false;
        }else{
            hitung = parseInt(pembayaranpinjaman)+parseInt(jasagtc);
            if(parseInt(pembayaran)<parseInt(hitung)){
                swalWithBootstrapButtons.fire({
                    title: 'Oops',
                    text: 'Pembayaran kurang',
                    confirmButtonText: 'OK'
                });
                return false;
            }else{
                $('#panel').loading('toggle');
                $('#formtambahtransaksi').on('submit', function (e) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('input[name=_token]').val()
                        }
                    });
                    var formData = new FormData(this);
                    $.ajax({
                        url: '/backend/tambah-transaksi',
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
                            $('#list-data').DataTable().ajax.reload();
                            $('#modal-tambah-transaksi').modal('hide');
                            transaksi2();
                        }
                    });
                });
            }
        }
    }else if($('#tambah_jenis_transaksi').val() === 'Pelunasan'){
        var totalbuyback = $('#total_buyback2_hidden').val();
        var sisapinjaman = $('#hidden_tambah_sisa_pinjaman').val();
        var persen = (totalbuyback/100)*100;
        if(parseInt(persen)<parseInt(sisapinjaman)){
            swalWithBootstrapButtons.fire({
                title: 'Oops',
                text: 'Minimal sisa pinjaman adalah 100% dari total buyback',
                confirmButtonText: 'OK'
            });
            return false;
        }else{
            if(parseInt(pembayaran)<parseInt(pembayaranpinjaman)){
                swalWithBootstrapButtons.fire({
                    title: 'Oops',
                    text: 'Pembayaran kurang',
                    confirmButtonText: 'OK'
                });
                return false;
            }else{
                $('#panel').loading('toggle');
                $('#formtambahtransaksi').on('submit', function (e) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('input[name=_token]').val()
                        }
                    });
                    var formData = new FormData(this);
                    $.ajax({
                        url: '/backend/tambah-transaksi',
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
                            $('#list-data').DataTable().ajax.reload();
                            $('#modal-tambah-transaksi').modal('hide');
                            transaksi2();
                        }
                    });
                });
            }
        }
    }
});
// ====================================================================================
function getdataemasgtc() {
    $('#panel').loading('toggle');
    $('#bodyemassebelumnya').html('');
    $('#footemassebelumnya').html('');
    var kode = $('#id_pengajuan').val();
    $.ajax({
        type: 'GET',
        url: '/backend/cari-data-emas-transaksi-gtc/' + kode,
        success: function (data) {
            var rows = '';
            var no = 0;
            var nomor = 0;
            $.each(data.emas, function (key, value) {
                nomor += 1;
                var keping = value.keping;
                var tkeping = data.transaksi[nomor-1].total;
                var hasilkeping = keping-tkeping;
                if(hasilkeping === 0){
                    no += 1;
                    rows = rows + '<tr hidden>';
                    rows = rows + '<td hidden><input type="hidden" class="form-control" value="'+ value.id +'" id="id_emas" name="id_emas[]"></td>';
                    rows = rows + '<td>' + value.item_emas + '</td>';
                    rows = rows + '<td><span class="badge badge-primary-lighten">'+ value.jenis +'</span></td>';
                    rows = rows + '<td class="gramasi">' + value.gramasi + '</td>';
                    // rows = rows + '<td class="">' + data.transaksi[no-1].total + '</td>';
                    var keping = value.keping;
                    var tkeping = data.transaksi[no-1].total;
                    var hasilkeping = keping-tkeping;
                    rows = rows + '<td><input id="keping'+ value.id +'" type="number" max="999" min="1" value="'+ hasilkeping +'" class="keping form-control" name="keping[]" placeholder="Qty" style="width: 90px;" data-toggle="input-mask" data-mask-format="00" readonly></td>';
                    rows = rows + '<td class="jumlah_gramasi">' + (value.gramasi*value.keping).toFixed(1) +" Gram" + '</td>';
                    rows = rows + '<td><input id="pengurangan'+ value.id +'" type="number" max="999" min="1" value="'+ 0 +'" class="pengurangan form-control" name="pengurangan[]" placeholder="Qty" style="width: 90px;" data-toggle="input-mask" data-mask-format="00"></td>';
                    rows = rows + '<td class="jumlah_gramasi_pengurangan">' + 0 +" Gram"+ '</td>';
                    rows = rows + '</tr>';
                }else{
                    no += 1;
                    rows = rows + '<tr>';
                    rows = rows + '<td hidden><input type="hidden" class="form-control" value="'+ value.id +'" id="id_emas" name="id_emas[]"></td>';
                    rows = rows + '<td>' + value.item_emas + '</td>';
                    rows = rows + '<td><span class="badge badge-primary-lighten">'+ value.jenis +'</span></td>';
                    rows = rows + '<td class="gramasi">' + value.gramasi + '</td>';
                    // rows = rows + '<td class="">' + data.transaksi[no-1].total + '</td>';
                    var keping = value.keping;
                    var tkeping = data.transaksi[no-1].total;
                    var hasilkeping = keping-tkeping;
                    rows = rows + '<td><input id="keping'+ value.id +'" type="number" max="999" min="1" value="'+ hasilkeping +'" class="keping form-control" name="keping[]" placeholder="Qty" style="width: 90px;" data-toggle="input-mask" data-mask-format="00" readonly></td>';
                    rows = rows + '<td class="jumlah_gramasi">' + (value.gramasi*value.keping).toFixed(1) +" Gram" + '</td>';
                    rows = rows + '<td><input id="pengurangan'+ value.id +'" type="number" max="999" min="1" value="'+ 0 +'" class="pengurangan form-control" name="pengurangan[]" placeholder="Qty" style="width: 90px;" data-toggle="input-mask" data-mask-format="00"></td>';
                    rows = rows + '<td class="jumlah_gramasi_pengurangan">' + 0 +" Gram"+ '</td>';
                    rows = rows + '</tr>';
                }
            }
            );
            $('#bodyemassebelumnya').html(rows);
            $("#footemassebelumnya").html('<tr><th>Total</th><th></th><th></th><th id="total_keping">'+ data.fkeping +" Keping" +'</th><th id="total_gramasi">'+ data.fgramasi.toFixed(1) +" Gram" +'</th><th id="total_pengurangan">0 Keping</th><th id="total_gramasi_pengurangan">0 Gram</th></tr>');
            getTotal();
            pengurangan();
            getTotal2();
            keping();
        }, complete: function () {
            $('#panel').loading('stop');
        }
    });
}
// ====================================================================================
function getTotal(){
    total_pengurangan = 0;
    $('.pengurangan').each(function(){
        total_pengurangan += parseInt(this.value)
    });
    $('#total_pengurangan').text(total_pengurangan + " Keping");

    total_gramasi_pengurangan = 0;
    $('.jumlah_gramasi_pengurangan').each(function(){
        total_gramasi_pengurangan += parseFloat(this.innerHTML)
    });
    $('#total_gramasi_pengurangan').text(total_gramasi_pengurangan.toFixed(1) + " Gram");
}
getTotal();
pengurangan();
function pengurangan(){
    $('.pengurangan').bind("change keyup",function(){
        var len = this.value.length; 
        if (len >= 3) { 
            this.value = this.value.substring(0, 3); 
        }
        // ===============
        var kode = $('#id_pengajuan').val();
        $.ajax({
            type: 'GET',
            url: '/backend/cari-data-emas-transaksi-gtc/' + kode,
            success: function (data) {
                var no = 0;
                $.each(data.emas, function (key, value) {
                    no += 1;
                    var satu = $('#pengurangan'+value.id).val();
                    var dua = $('#keping'+value.id).val();
                    var keping = value.keping;
                    var tkeping = data.transaksi[no-1].total;
                    var hasilkeping = keping-tkeping;
                    if(parseInt(satu) > parseInt(dua)){
                        $('#pengurangan'+value.id).val(hasilkeping).trigger("change")
                    }
                    var pengurangan = $('#pengurangan'+value.id).val();
                    var keping = $('#keping'+value.id).val();
                    keping2 = keping-pengurangan;
                    $('#keping2'+value.id).val(keping2).trigger("change");
                    if(keping2 === 0){
                        $('#hidden'+value.id).hide();
                    }else{
                        $('#hidden'+value.id).show();
                    }
                    });
            }, complete: function () {

            }
        });
        // ===============
        var parent = $(this).parents('tr');
        var gramasi = $('.gramasi', parent);
        var jumlah_gramasi = $('.jumlah_gramasi_pengurangan', parent);
        var value_gramasi = parseInt(this.value) * parseFloat(gramasi.get(0).innerHTML||0);
        jumlah_gramasi.text(value_gramasi.toFixed(1) +" Gram");
        getTotal();
    })
}
// ====================================================================================
function getdataemasgtc2() {
    $('#panel').loading('toggle');
    $('#bodyemasselanjutnya').html('');
    $('#footemasselanjutnya').html('');
    var kode = $('#id_pengajuan').val();
    $.ajax({
        type: 'GET',
        url: '/backend/cari-data-emas-transaksi-gtc/' + kode,
        success: function (data) {
            var rows = '';
            var no = 0;
            $.each(data.emas, function (key, value) {
                no += 1;
                var keping = value.keping;
                var tkeping = data.transaksi[no-1].total;
                var hasilkeping = keping-tkeping;
                if(hasilkeping === 0){
                    rows = rows + '<tr id="hidden'+ value.id +'" hidden>';
                    rows = rows + '<td hidden><input type="hidden" class="form-control" value="'+ value.id +'" id="id_emas2" name="id_emas2[]"></td>';
                    rows = rows + '<td>' + value.item_emas + '</td>';
                    rows = rows + '<td><span class="badge badge-primary-lighten">'+ value.jenis +'</span></td>';
                    rows = rows + '<td class="gramasi2">' + value.gramasi + '</td>';
                    if(value.gramasi === '0.1'){
                        var harga_buyback = parseFloat(data.hargaharian.nolsatu_gram);
                        rows = rows + '<td class="harga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="harga_buyback_hidden2">' + data.hargaharian.nolsatu_gram + '</td>';
                    }else if(value.gramasi === '0.2'){
                        var harga_buyback = parseFloat(data.hargaharian.noldua_gram);
                        rows = rows + '<td class="harga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="harga_buyback_hidden2">' + data.hargaharian.noldua_gram + '</td>';
                    }else if(value.gramasi === '0.5'){
                        var harga_buyback = parseFloat(data.hargaharian.nollima_gram);
                        rows = rows + '<td class="harga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="harga_buyback_hidden2">' + data.hargaharian.nollima_gram + '</td>';
                    }else if(value.gramasi === '1'){
                        var harga_buyback = parseFloat(data.hargaharian.satu_gram);
                        rows = rows + '<td class="harga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="harga_buyback_hidden2">' + data.hargaharian.satu_gram + '</td>';
                    }else if(value.gramasi === '2'){
                        var harga_buyback = parseFloat(data.hargaharian.dua_gram);
                        rows = rows + '<td class="harga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="harga_buyback_hidden2">' + data.hargaharian.dua_gram + '</td>';
                    }else if(value.gramasi === '5'){
                        var harga_buyback = parseFloat(data.hargaharian.lima_gram);
                        rows = rows + '<td class="harga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="harga_buyback_hidden2">' + data.hargaharian.lima_gram + '</td>';
                    }else if(value.gramasi === '10'){
                        var harga_buyback = parseFloat(data.hargaharian.sepuluh_gram);
                        rows = rows + '<td class="harga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="harga_buyback_hidden2">' + data.hargaharian.sepuluh_gram + '</td>';
                    }
                    // rows = rows + '<td class="harga_buyback">' + (harga_buyback.toLocaleString("id-ID")) + '</td>';
                    // rows = rows + '<td hidden class="harga_buyback_hidden">' + value.harga_buyback + '</td>';
                    var keping = value.keping;
                    var tkeping = data.transaksi[no-1].total;
                    var hasilkeping = keping-tkeping;
                    rows = rows + '<td><input id="keping2'+ value.id +'" type="number" max="999" min="1" value="'+ hasilkeping +'" class="keping2 form-control" name="keping2[]" placeholder="Qty" style="width: 90px;" data-toggle="input-mask" data-mask-format="00" readonly></td>';
                    rows = rows + '<td class="jumlah_gramasi2">' + (value.gramasi*hasilkeping).toFixed(1) + " Gram" + '</td>';
                    rows = rows + '<td class="jumlah_buyback2">' + "Rp " + (harga_buyback*hasilkeping).toLocaleString("id-ID") + '</td>';
                    rows = rows + '<td hidden class="jumlah_buyback_hidden2">' + harga_buyback*hasilkeping + '</td>';
                    rows = rows + '</tr>';
                }else{
                    rows = rows + '<tr id="hidden'+ value.id +'">';
                rows = rows + '<td hidden><input type="hidden" class="form-control" value="'+ value.id +'" id="id_emas2" name="id_emas2[]"></td>';
                rows = rows + '<td>' + value.item_emas + '</td>';
                rows = rows + '<td><span class="badge badge-primary-lighten">'+ value.jenis +'</span></td>';
                rows = rows + '<td class="gramasi2">' + value.gramasi + '</td>';
                if(value.gramasi === '0.1'){
                    var harga_buyback = parseFloat(data.hargaharian.nolsatu_gram);
                    rows = rows + '<td class="harga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                    rows = rows + '<td hidden class="harga_buyback_hidden2">' + data.hargaharian.nolsatu_gram + '</td>';
                }else if(value.gramasi === '0.2'){
                    var harga_buyback = parseFloat(data.hargaharian.noldua_gram);
                    rows = rows + '<td class="harga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                    rows = rows + '<td hidden class="harga_buyback_hidden2">' + data.hargaharian.noldua_gram + '</td>';
                }else if(value.gramasi === '0.5'){
                    var harga_buyback = parseFloat(data.hargaharian.nollima_gram);
                    rows = rows + '<td class="harga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                    rows = rows + '<td hidden class="harga_buyback_hidden2">' + data.hargaharian.nollima_gram + '</td>';
                }else if(value.gramasi === '1'){
                    var harga_buyback = parseFloat(data.hargaharian.satu_gram);
                    rows = rows + '<td class="harga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                    rows = rows + '<td hidden class="harga_buyback_hidden2">' + data.hargaharian.satu_gram + '</td>';
                }else if(value.gramasi === '2'){
                    var harga_buyback = parseFloat(data.hargaharian.dua_gram);
                    rows = rows + '<td class="harga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                    rows = rows + '<td hidden class="harga_buyback_hidden2">' + data.hargaharian.dua_gram + '</td>';
                }else if(value.gramasi === '5'){
                    var harga_buyback = parseFloat(data.hargaharian.lima_gram);
                    rows = rows + '<td class="harga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                    rows = rows + '<td hidden class="harga_buyback_hidden2">' + data.hargaharian.lima_gram + '</td>';
                }else if(value.gramasi === '10'){
                    var harga_buyback = parseFloat(data.hargaharian.sepuluh_gram);
                    rows = rows + '<td class="harga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                    rows = rows + '<td hidden class="harga_buyback_hidden2">' + data.hargaharian.sepuluh_gram + '</td>';
                }
                // rows = rows + '<td class="harga_buyback">' + (harga_buyback.toLocaleString("id-ID")) + '</td>';
                // rows = rows + '<td hidden class="harga_buyback_hidden">' + value.harga_buyback + '</td>';
                var keping = value.keping;
                var tkeping = data.transaksi[no-1].total;
                var hasilkeping = keping-tkeping;
                rows = rows + '<td><input id="keping2'+ value.id +'" type="number" max="999" min="1" value="'+ hasilkeping +'" class="keping2 form-control" name="keping2[]" placeholder="Qty" style="width: 90px;" data-toggle="input-mask" data-mask-format="00" readonly></td>';
                rows = rows + '<td class="jumlah_gramasi2">' + (value.gramasi*hasilkeping).toFixed(1) + " Gram" + '</td>';
                rows = rows + '<td class="jumlah_buyback2">' + "Rp " + (harga_buyback*hasilkeping).toLocaleString("id-ID") + '</td>';
                rows = rows + '<td hidden class="jumlah_buyback_hidden2">' + harga_buyback*hasilkeping + '</td>';
                rows = rows + '</tr>';
                }
            }
            );
            $('#bodyemasselanjutnya').html(rows);
            $("#footemasselanjutnya").html('<tr><th>Total</th><th></th><th></th><th></th><th id="total_keping2">'+ data.fkeping +' Keping</th><th id="total_gramasi2">'+ data.fgramasi.toFixed(1) +' Gram</th><th id="total_buyback2">Rp '+ (data.totalbuyback).toLocaleString("id-ID") +'</th></tr>');
            $('#total_buyback2_hidden').val(data.totalbuyback).trigger('change')
            getTotal();
            keping();
        }, complete: function () {
            $('#panel').loading('stop');
        }
    });
}
// ====================================================================================
function getTotal2(){
    total_keping = 0;
    $('.keping2').each(function(){
        total_keping += parseInt(this.value)
    });
    $('#total_keping2').text(total_keping + " Keping");

    total_gramasi = 0;
    $('.jumlah_gramasi2').each(function(){
        total_gramasi += parseFloat(this.innerHTML)
    });
    $('#total_gramasi2').text(total_gramasi.toFixed(1) + " Gram");

    total_buyback = 0;
    $('.jumlah_buyback_hidden2').each(function(){
        total_buyback += parseFloat(this.innerHTML)
    });
    format_total_buyback = total_buyback.toLocaleString("id-ID")
    $('#total_buyback2').text("Rp "+ format_total_buyback);
    $('#total_buyback2_hidden').val(total_buyback).trigger('change');
}
// ====================================================================================
getTotal2();
keping();
function keping(){
    $('.keping2').bind("change keyup",function(){
        var len = this.value.length; 
        if (len >= 3) { 
            this.value = this.value.substring(0, 3); 
        }
        var parent = $(this).parents('tr');
        var gramasi = $('.gramasi2', parent);
        var jumlah_gramasi = $('.jumlah_gramasi2', parent);
        var value_gramasi = parseInt(this.value) * parseFloat(gramasi.get(0).innerHTML||0);
        jumlah_gramasi.text(value_gramasi.toFixed(1)+" Gram");
    
        var asli_harga_buyback_hidden = $('.harga_buyback_hidden2', parent);
        var format_harga_buyback = asli_harga_buyback_hidden.text().replace('.', '');
        var harga_buyback = asli_harga_buyback_hidden.text(format_harga_buyback)
        var jumlah_buyback = $('.jumlah_buyback2', parent);
        var jumlah_buyback_hidden = $('.jumlah_buyback_hidden2', parent);
        var value_buyback = parseInt(this.value) * parseFloat(harga_buyback.get(0).innerHTML||0);
        var format_jumlah_buyback = value_buyback.toLocaleString("id-ID")
        jumlah_buyback.text("Rp "+format_jumlah_buyback);
        jumlah_buyback_hidden.text(value_buyback);
        getTotal2();
    })
}

// ====================================================================================
// ====================================================================================
// ====================================================================================

$(function(){
    $('#edit_jenis_transaksi').bind("change keyup", function(){
        if($(this).val() === 'Perpanjangan'){
            var kode = $('#edit_id_transaksi').val();
            $('#edit_nominal_pinjaman').val('')
            $('#hidden_edit_nominal_pinjaman').val('')
            $('#edit_pembayaran_pinjaman').val('')
            $('#hidden_edit_pembayaran_pinjaman').val('')
            $('#edit_sisa_pinjaman').val('')
            $('#edit_plafond_pinjaman').val('')
            $('#edit_plafond_pinjaman_hidden').val('')
            $('#edit_jangka_waktu_permohonan').val('Pilih');
            $('#edit_jasa_gtc').val('');
            $('#edit_upload_bukti_transfer').val('');
            $('#edit_hidden_upload_bukti_transfer').val('');
            $('#edit_upload_bukti_transfer').val('');
            $('#edit_pembayaran').val('');
            // ===================
            $('#edit_jangka_waktu_1').val('')
            $('#edit_pengali_kurangdari_satudelapan_1').val('')
            $('#edit_pengali_diatas_dua_1').val('')
            $('#edit_jangka_waktu_2').val('')
            $('#edit_pengali_kurangdari_satudelapan_2').val('')
            $('#edit_pengali_diatas_dua_2').val('')
            $('#edit_jangka_waktu_3').val('')
            $('#edit_pengali_kurangdari_satudelapan_3').val('')
            $('#edit_pengali_diatas_dua_3').val('')
            $('#edit_jangka_waktu_4').val('')
            $('#edit_pengali_kurangdari_satudelapan_4').val('')
            $('#edit_pengali_diatas_dua_4').val('')
            // edittransaksi(kode);
            $('#diveditemasselanjutnya').show();
            $('#divedittransaksi').show();
            $('#diveditpembayaran').show();
            $('#diveditbtnsimpan').show();
            $('#diveditemassebelumnya').hide();
            $('#diveditpelunasan').hide();
            editgetdataemasgtc();
            editgetdataemasgtc2();
            // ========================================================================================
            $('#panel').loading('toggle');
            var kode = $('#id_pengajuan').val();
            $.ajax({
                type: 'GET',
                url: '/backend/cari-data-emas-transaksi-gtc/' + kode,
                success: function (data) {
                    $.each(data.jenisjasagtc, function(key, item){
                        $('#edit_jangka_waktu_1').val(item.jangka_waktu_1)
                        $('#edit_pengali_kurangdari_satudelapan_1').val(item.pengali_kurangdari_satudelapan_1)
                        $('#edit_pengali_diatas_dua_1').val(item.pengali_diatas_dua_1)
                        $('#edit_jangka_waktu_2').val(item.jangka_waktu_2)
                        $('#edit_pengali_kurangdari_satudelapan_2').val(item.pengali_kurangdari_satudelapan_2)
                        $('#edit_pengali_diatas_dua_2').val(item.pengali_diatas_dua_2)
                        $('#edit_jangka_waktu_3').val(item.jangka_waktu_3)
                        $('#edit_pengali_kurangdari_satudelapan_3').val(item.pengali_kurangdari_satudelapan_3)
                        $('#edit_pengali_diatas_dua_3').val(item.pengali_diatas_dua_3)
                        $('#edit_jangka_waktu_4').val(item.jangka_waktu_4)
                        $('#edit_pengali_kurangdari_satudelapan_4').val(item.pengali_kurangdari_satudelapan_4)
                        $('#edit_pengali_diatas_dua_4').val(item.pengali_diatas_dua_4)
                    })
                    $.each(data.emas, function (key, value) {
                        var newformat = data.totalbuyback;
                        var hitung = (newformat/100)*90;
                        var newhitung = hitung.toLocaleString("id-ID")
                        var number_string = newhitung.replace(/[^,\d]/g, '').toString(),
                        split   		= number_string.split(','),
                        sisa     		= split[0].length % 3,
                        rupiah     		= split[0].substr(0, sisa),
                        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
                    
                        // editkan titik jika yang di input sudah menjadi angka ribuan
                        if(ribuan){
                            separator = sisa ? '.' : '';
                            rupiah += separator + ribuan.join('.');
                        }
                    
                        rupiah = split[1] != undefined ? rupiah + '.' + split[1] : rupiah;
                        $("#edit_plafond_pinjaman").val(rupiah).trigger('change');
                        var plafond_pinjaman = $("#edit_plafond_pinjaman").val();
                        var newplafond_pinjaman = plafond_pinjaman.replace(/[^,\d]/g, '').toString();
                        $("#edit_plafond_pinjaman_hidden").val(newplafond_pinjaman).trigger('change');
                        // ======================================================================
                        $('#edit_jangka_waktu_permohonan').change(function(){
                            if($(this).val() === '0.5'){
                                if(parseFloat(data.fgramasi.toFixed(0))>=0.1 && parseFloat(data.fgramasi.toFixed(0))<=49.9){
                                    jangka_waktu = $('#edit_jangka_waktu_1').val()
                                    numjangka_waktu = parseFloat(jangka_waktu)
                                    pengali = $('#edit_pengali_kurangdari_satudelapan_1').val()
                                    numpengali = parseFloat(pengali)
                                    hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*data.totalbuyback).toFixed(0)
                                    newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                    bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                    hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                    $('#edit_jasa_gtc').val(hasiljasa).trigger("change")
                                    $('#edit_pembayaran_jasa').val('Transfer').trigger("change")
                                }else if(data.fgramasi.toFixed(0)>=50){
                                    jangka_waktu = $('#edit_jangka_waktu_1').val()
                                    numjangka_waktu = parseFloat(jangka_waktu)
                                    pengali = $('#edit_pengali_diatas_dua_1').val()
                                    numpengali = parseFloat(pengali)
                                    hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*data.totalbuyback).toFixed(0)
                                    newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                    bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                    hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                    $('#edit_jasa_gtc').val(hasiljasa).trigger("change")
                                    $('#edit_pembayaran_jasa').val('Transfer').trigger("change")
                                }
                            }else if($(this).val() === '1'){
                                if(parseFloat(data.fgramasi.toFixed(0))>=0.1 && parseFloat(data.fgramasi.toFixed(0))<=49.9){
                                    jangka_waktu = $('#edit_jangka_waktu_2').val()
                                    numjangka_waktu = parseFloat(jangka_waktu)
                                    pengali = $('#edit_pengali_kurangdari_satudelapan_2').val()
                                    numpengali = parseFloat(pengali)
                                    hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*data.totalbuyback).toFixed(0)
                                    newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                    bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                    hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                    $('#edit_jasa_gtc').val(hasiljasa).trigger("change")
                                    $('#edit_pembayaran_jasa').val('Transfer').trigger("change")
                                }else if(data.fgramasi.toFixed(0)>=50){
                                    jangka_waktu = $('#edit_jangka_waktu_2').val()
                                    numjangka_waktu = parseFloat(jangka_waktu)
                                    pengali = $('#edit_pengali_diatas_dua_2').val()
                                    numpengali = parseFloat(pengali)
                                    hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*data.totalbuyback).toFixed(0)
                                    newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                    bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                    hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                    $('#edit_jasa_gtc').val(hasiljasa).trigger("change")
                                    $('#edit_pembayaran_jasa').val('Transfer').trigger("change")
                                }
                            }else if($(this).val() === '2'){
                                if(parseFloat(data.fgramasi.toFixed(0))>=0.1 && parseFloat(data.fgramasi.toFixed(0))<=49.9){
                                    jangka_waktu = $('#edit_jangka_waktu_3').val()
                                    numjangka_waktu = parseFloat(jangka_waktu)
                                    pengali = $('#edit_pengali_kurangdari_satudelapan_3').val()
                                    numpengali = parseFloat(pengali)
                                    hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*data.totalbuyback).toFixed(0)
                                    newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                    bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                    hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                    $('#edit_jasa_gtc').val(hasiljasa).trigger("change")
                                    $('#edit_pembayaran_jasa').val('Transfer').trigger("change")
                                }else if(data.fgramasi.toFixed(0)>=50){
                                    jangka_waktu = $('#edit_jangka_waktu_3').val()
                                    numjangka_waktu = parseFloat(jangka_waktu)
                                    pengali = $('#edit_pengali_diatas_dua_3').val()
                                    numpengali = parseFloat(pengali)
                                    hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*data.totalbuyback).toFixed(0)
                                    newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                    bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                    hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                    $('#edit_jasa_gtc').val(hasiljasa).trigger("change")
                                    $('#edit_pembayaran_jasa').val('Transfer').trigger("change")
                                }
                            }else{
                                $('#edit_jasa_gtc').val('').trigger("change")
                                $('#pembayaran_jasa_manual').val('').trigger("change");
                                $('#div_nominal_potongan').hide()
                                $('#nominal_potongan').val('').trigger("change");
                                $('#jumlah_yang_di_transfer').val('').trigger("change");
                                $('#edit_pembayaran_jasa').val('Transfer').trigger("change")
                            }
                        });
                    });
                }, complete: function () {
                    $('#panel').loading('stop');
                }
            });
            // =====================
            var kode = $('#edit_id_transaksi').val();
            var kode2 = $('#id_pengajuan').val();
            var kode3 = $('#edit_kode_transaksi').val();
            $.ajax({
                type: 'GET',
                url: '/backend/cari-edit-data-emas-transaksi-gtc/' + kode2 + '/' + kode3,
                success: function (data) {
                    $.each(data.emas, function (key, value) {
                        $('#editpengurangan'+ value.id).val('0');
                    }
                    );
                }, complete: function () {

                }
            });
            $.ajax({
                type: 'GET',
                url: '/backend/list-edit-transaksi/' + kode + '/' + kode2,
                success: function (data) {
                    $.each(data.data, function(key, value){
                        $('#edit_nominal_pinjaman').val(data.nominalpinjaman.toLocaleString("id-ID"));
                        $('#hidden_edit_nominal_pinjaman').val(data.nominalpinjaman);
                        $('#edit_pembayaran_pinjaman').val('');
                        $('#hidden_edit_pembayaran_pinjaman').val('');
                        $('#edit_sisa_pinjaman').val(data.nominalpinjaman.toLocaleString("id-ID"));
                        $('#hidden_edit_sisa_pinjaman').val(data.nominalpinjaman);
                        $('#edit_pembayaran').val('');
                        $('#edit_pembayaran_hidden').val('');
                    })
                },
                complete: function(){
                    
                }
            })
            $('#edit_pembayaran').bind("change keyup", function(){
                var pembayaran = parseInt($(this).val().replace(/[^,\d]/g, '').toString());
                var jasagtc = parseInt($('#edit_jasa_gtc').val().replace(/[^,\d]/g, '').toString());
                var hitung = pembayaran-jasagtc;
                $('#edit_sisa_pembayaran').val(hitung.toLocaleString("id-ID"));
                $('#edit_sisa_pembayaran_hidden').val(hitung);
            });
        }else if($(this).val() === 'Pelunasan Sebagian'){
            var kode = $('#edit_id_transaksi').val();
            $('#edit_nominal_pinjaman').val('')
            $('#hidden_edit_nominal_pinjaman').val('')
            $('#edit_pembayaran_pinjaman').val('')
            $('#hidden_edit_pembayaran_pinjaman').val('')
            $('#edit_sisa_pinjaman').val('')
            $('#edit_plafond_pinjaman').val('')
            $('#edit_plafond_pinjaman_hidden').val('')
            $('#edit_jangka_waktu_permohonan').val('Pilih');
            $('#edit_jasa_gtc').val('');
            $('#edit_upload_bukti_transfer').val('');
            $('#edit_hidden_upload_bukti_transfer').val('');
            $('#edit_upload_bukti_transfer').val('');
            $('#edit_pembayaran').val('');
            // ===================
            $('#edit_jangka_waktu_1').val('')
            $('#edit_pengali_kurangdari_satudelapan_1').val('')
            $('#edit_pengali_diatas_dua_1').val('')
            $('#edit_jangka_waktu_2').val('')
            $('#edit_pengali_kurangdari_satudelapan_2').val('')
            $('#edit_pengali_diatas_dua_2').val('')
            $('#edit_jangka_waktu_3').val('')
            $('#edit_pengali_kurangdari_satudelapan_3').val('')
            $('#edit_pengali_diatas_dua_3').val('')
            $('#edit_jangka_waktu_4').val('')
            $('#edit_pengali_kurangdari_satudelapan_4').val('')
            $('#edit_pengali_diatas_dua_4').val('')
            // edittransaksi(kode);
            $('#diveditemassebelumnya').show();
            $('#diveditemasselanjutnya').show();
            $('#diveditpelunasan').show();
            $('#divedittransaksi').show();
            $('#diveditpembayaran').show();
            $('#diveditbtnsimpan').show();
            editgetdataemasgtc();
            editgetdataemasgtc2();
            // ======================================================================
            $('#panel').loading('toggle');
            var kode = $('#id_pengajuan').val();
            $.ajax({
                type: 'GET',
                url: '/backend/cari-data-emas-transaksi-gtc/' + kode,
                success: function (data) {
                    $.each(data.jenisjasagtc, function(key, item){
                        $('#edit_jangka_waktu_1').val(item.jangka_waktu_1)
                        $('#edit_pengali_kurangdari_satudelapan_1').val(item.pengali_kurangdari_satudelapan_1)
                        $('#edit_pengali_diatas_dua_1').val(item.pengali_diatas_dua_1)
                        $('#edit_jangka_waktu_2').val(item.jangka_waktu_2)
                        $('#edit_pengali_kurangdari_satudelapan_2').val(item.pengali_kurangdari_satudelapan_2)
                        $('#edit_pengali_diatas_dua_2').val(item.pengali_diatas_dua_2)
                        $('#edit_jangka_waktu_3').val(item.jangka_waktu_3)
                        $('#edit_pengali_kurangdari_satudelapan_3').val(item.pengali_kurangdari_satudelapan_3)
                        $('#edit_pengali_diatas_dua_3').val(item.pengali_diatas_dua_3)
                        $('#edit_jangka_waktu_4').val(item.jangka_waktu_4)
                        $('#edit_pengali_kurangdari_satudelapan_4').val(item.pengali_kurangdari_satudelapan_4)
                        $('#edit_pengali_diatas_dua_4').val(item.pengali_diatas_dua_4)
                    })
                    $.each(data.emas, function (key, value) {
                        var newformat = data.totalbuyback;
                        var hitung = (newformat/100)*90;
                        var newhitung = hitung.toLocaleString("id-ID")
                        var number_string = newhitung.replace(/[^,\d]/g, '').toString(),
                        split   		= number_string.split(','),
                        sisa     		= split[0].length % 3,
                        rupiah     		= split[0].substr(0, sisa),
                        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
                    
                        // editkan titik jika yang di input sudah menjadi angka ribuan
                        if(ribuan){
                            separator = sisa ? '.' : '';
                            rupiah += separator + ribuan.join('.');
                        }
                    
                        rupiah = split[1] != undefined ? rupiah + '.' + split[1] : rupiah;
                        $("#edit_plafond_pinjaman").val(rupiah).trigger('change');
                        var plafond_pinjaman = $("#edit_plafond_pinjaman").val();
                        var newplafond_pinjaman = plafond_pinjaman.replace(/[^,\d]/g, '').toString();
                        $("#edit_plafond_pinjaman_hidden").val(newplafond_pinjaman).trigger('change');
                        // ======================================================================
                        $('#edit_jangka_waktu_permohonan').change(function(){
                            var totalbuyback = $('#edittotal_buyback2_hidden').val();
                            if($(this).val() === '0.5'){
                                if(parseFloat(data.fgramasi.toFixed(0))>=0.1 && parseFloat(data.fgramasi.toFixed(0))<=49.9){
                                    jangka_waktu = $('#edit_jangka_waktu_1').val()
                                    numjangka_waktu = parseFloat(jangka_waktu)
                                    pengali = $('#edit_pengali_kurangdari_satudelapan_1').val()
                                    numpengali = parseFloat(pengali)
                                    hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*totalbuyback).toFixed(0)
                                    newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                    bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                    hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                    $('#edit_jasa_gtc').val(hasiljasa).trigger("change")
                                    $('#edit_pembayaran_jasa').val('Transfer').trigger("change")
                                }else if(data.fgramasi.toFixed(0)>=50){
                                    jangka_waktu = $('#edit_jangka_waktu_1').val()
                                    numjangka_waktu = parseFloat(jangka_waktu)
                                    pengali = $('#edit_pengali_diatas_dua_1').val()
                                    numpengali = parseFloat(pengali)
                                    hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*totalbuyback).toFixed(0)
                                    newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                    bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                    hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                    $('#edit_jasa_gtc').val(hasiljasa).trigger("change")
                                    $('#edit_pembayaran_jasa').val('Transfer').trigger("change")
                                }
                            }else if($(this).val() === '1'){
                                if(parseFloat(data.fgramasi.toFixed(0))>=0.1 && parseFloat(data.fgramasi.toFixed(0))<=49.9){
                                    jangka_waktu = $('#edit_jangka_waktu_2').val()
                                    numjangka_waktu = parseFloat(jangka_waktu)
                                    pengali = $('#edit_pengali_kurangdari_satudelapan_2').val()
                                    numpengali = parseFloat(pengali)
                                    hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*totalbuyback).toFixed(0)
                                    newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                    bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                    hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                    $('#edit_jasa_gtc').val(hasiljasa).trigger("change")
                                    $('#edit_pembayaran_jasa').val('Transfer').trigger("change")
                                }else if(data.fgramasi.toFixed(0)>=50){
                                    jangka_waktu = $('#edit_jangka_waktu_2').val()
                                    numjangka_waktu = parseFloat(jangka_waktu)
                                    pengali = $('#edit_pengali_diatas_dua_2').val()
                                    numpengali = parseFloat(pengali)
                                    hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*totalbuyback).toFixed(0)
                                    newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                    bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                    hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                    $('#edit_jasa_gtc').val(hasiljasa).trigger("change")
                                    $('#edit_pembayaran_jasa').val('Transfer').trigger("change")
                                }
                            }else if($(this).val() === '2'){
                                if(parseFloat(data.fgramasi.toFixed(0))>=0.1 && parseFloat(data.fgramasi.toFixed(0))<=49.9){
                                    jangka_waktu = $('#edit_jangka_waktu_3').val()
                                    numjangka_waktu = parseFloat(jangka_waktu)
                                    pengali = $('#edit_pengali_kurangdari_satudelapan_3').val()
                                    numpengali = parseFloat(pengali)
                                    hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*totalbuyback).toFixed(0)
                                    newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                    bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                    hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                    $('#edit_jasa_gtc').val(hasiljasa).trigger("change")
                                    $('#edit_pembayaran_jasa').val('Transfer').trigger("change")
                                }else if(data.fgramasi.toFixed(0)>=50){
                                    jangka_waktu = $('#edit_jangka_waktu_3').val()
                                    numjangka_waktu = parseFloat(jangka_waktu)
                                    pengali = $('#edit_pengali_diatas_dua_3').val()
                                    numpengali = parseFloat(pengali)
                                    hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*totalbuyback).toFixed(0)
                                    newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                    bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                    hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                    $('#edit_jasa_gtc').val(hasiljasa).trigger("change")
                                    $('#edit_pembayaran_jasa').val('Transfer').trigger("change")
                                }
                            }else{
                                $('#edit_jasa_gtc').val('').trigger("change")
                                $('#pembayaran_jasa_manual').val('').trigger("change");
                                $('#div_nominal_potongan').hide()
                                $('#nominal_potongan').val('').trigger("change");
                                $('#jumlah_yang_di_transfer').val('').trigger("change");
                                $('#edit_pembayaran_jasa').val('Transfer').trigger("change")
                            }
                        });
                    });
                }, complete: function () {
                    $('#panel').loading('stop');
                }
            });
            var kode = $('#edit_id_transaksi').val();
            var kode2 = $('#id_pengajuan').val();
            var kode3 = $('#edit_kode_transaksi').val();
            $.ajax({
                type: 'GET',
                url: '/backend/cari-edit-data-emas-transaksi-gtc/' + kode2 + '/' + kode3,
                success: function (data) {
                    $.each(data.emas, function (key, value) {
                        $('#editpengurangan'+ value.id).val('0');
                    }
                    );
                }, complete: function () {

                }
            });
            $.ajax({
                type: 'GET',
                url: '/backend/list-edit-transaksi/' + kode + '/' + kode2,
                success: function (data) {
                    $.each(data.data, function(key, value){
                        $('#edit_nominal_pinjaman').val(data.nominalpinjaman.toLocaleString("id-ID"));
                        $('#hidden_edit_nominal_pinjaman').val(data.nominalpinjaman);
                        $('#edit_pembayaran_pinjaman').val('');
                        $('#hidden_edit_pembayaran_pinjaman').val('');
                        $('#edit_sisa_pinjaman').val(data.nominalpinjaman.toLocaleString("id-ID"));
                        $('#hidden_edit_sisa_pinjaman').val(data.nominalpinjaman);
                        $('#edit_pembayaran').val('');
                        $('#edit_pembayaran_hidden').val('');
                    })
                },
                complete: function(){
                    
                }
            })
            $('#edit_pembayaran').bind("change keyup", function(){
                var pembayaran = parseInt($(this).val().replace(/[^,\d]/g, '').toString());
                var pembayaranpinjaman = parseInt($('#edit_pembayaran_pinjaman').val().replace(/[^,\d]/g, '').toString());
                var jasagtc = parseInt($('#edit_jasa_gtc').val().replace(/[^,\d]/g, '').toString());
                var tambah = pembayaranpinjaman+jasagtc;
                var hitung = pembayaran-tambah;
                $('#edit_sisa_pembayaran').val(hitung.toLocaleString("id-ID"));
                $('#edit_sisa_pembayaran_hidden').val(hitung);
            });
        }else if($(this).val() === 'Pelunasan'){
            var kode = $('#edit_id_transaksi').val();
            $('#edit_nominal_pinjaman').val('')
            $('#hidden_edit_nominal_pinjaman').val('')
            $('#edit_pembayaran_pinjaman').val('')
            $('#hidden_edit_pembayaran_pinjaman').val('')
            $('#edit_sisa_pinjaman').val('')
            $('#edit_plafond_pinjaman').val('')
            $('#edit_plafond_pinjaman_hidden').val('')
            $('#edit_jangka_waktu_permohonan').val('Pilih');
            $('#edit_jasa_gtc').val('');
            $('#edit_upload_bukti_transfer').val('');
            $('#edit_hidden_upload_bukti_transfer').val('');
            $('#edit_upload_bukti_transfer').val('');
            $('#edit_pembayaran').val('');
            // ===================
            $('#edit_jangka_waktu_1').val('')
            $('#edit_pengali_kurangdari_satudelapan_1').val('')
            $('#edit_pengali_diatas_dua_1').val('')
            $('#edit_jangka_waktu_2').val('')
            $('#edit_pengali_kurangdari_satudelapan_2').val('')
            $('#edit_pengali_diatas_dua_2').val('')
            $('#edit_jangka_waktu_3').val('')
            $('#edit_pengali_kurangdari_satudelapan_3').val('')
            $('#edit_pengali_diatas_dua_3').val('')
            $('#edit_jangka_waktu_4').val('')
            $('#edit_pengali_kurangdari_satudelapan_4').val('')
            $('#edit_pengali_diatas_dua_4').val('')
            // edittransaksi(kode);
            $('#diveditemassebelumnya').show();
            $('#diveditemasselanjutnya').show();
            $('#diveditpelunasan').show();
            $('#diveditpembayaran').show();
            $('#diveditbtnsimpan').show();
            $('#divedittransaksi').hide();
            editgetdataemasgtc();
            editgetdataemasgtc2();
            var kode = $('#edit_id_transaksi').val();
            var kode2 = $('#id_pengajuan').val();
            var kode3 = $('#edit_kode_transaksi').val();
            $.ajax({
                type: 'GET',
                url: '/backend/cari-edit-data-emas-transaksi-gtc/' + kode2 + '/' + kode3,
                success: function (data) {
                    $.each(data.emas, function (key, value) {
                        $('#editpengurangan'+ value.id).val('0');
                    }
                    );
                }, complete: function () {

                }
            });
            $.ajax({
                type: 'GET',
                url: '/backend/list-edit-transaksi/' + kode + '/' + kode2,
                success: function (data) {
                    $.each(data.data, function(key, value){
                        $('#edit_nominal_pinjaman').val(data.nominalpinjaman.toLocaleString("id-ID"));
                        $('#hidden_edit_nominal_pinjaman').val(data.nominalpinjaman);
                        $('#edit_pembayaran_pinjaman').val('');
                        $('#hidden_edit_pembayaran_pinjaman').val('');
                        $('#edit_sisa_pinjaman').val(data.nominalpinjaman.toLocaleString("id-ID"));
                        $('#hidden_edit_sisa_pinjaman').val(data.nominalpinjaman);
                        $('#edit_pembayaran').val('');
                        $('#edit_pembayaran_hidden').val('');
                    })
                },
                complete: function(){
                    
                }
            })
            $('#edit_pembayaran').bind("change keyup", function(){
                var pembayaran = parseInt($(this).val().replace(/[^,\d]/g, '').toString());
                var pembayaranpinjaman = parseInt($('#edit_pembayaran_pinjaman').val().replace(/[^,\d]/g, '').toString());
                var hitung = pembayaran-pembayaranpinjaman;
                $('#edit_sisa_pembayaran').val(hitung.toLocaleString("id-ID"));
                $('#edit_sisa_pembayaran_hidden').val(hitung);
            });
        }else{
            var kode = $('#edit_id_transaksi').val();
            $('#edit_nominal_pinjaman').val('')
            $('#hidden_edit_nominal_pinjaman').val('')
            $('#edit_pembayaran_pinjaman').val('')
            $('#hidden_edit_pembayaran_pinjaman').val('')
            $('#edit_sisa_pinjaman').val('')
            $('#edit_plafond_pinjaman').val('')
            $('#edit_plafond_pinjaman_hidden').val('')
            $('#edit_jangka_waktu_permohonan').val('Pilih');
            $('#edit_jasa_gtc').val('');
            $('#edit_upload_bukti_transfer').val('');
            $('#edit_hidden_upload_bukti_transfer').val('');
            $('#edit_upload_bukti_transfer').val('');
            $('#edit_pembayaran').val('');
            // ===================
            $('#edit_jangka_waktu_1').val('')
            $('#edit_pengali_kurangdari_satudelapan_1').val('')
            $('#edit_pengali_diatas_dua_1').val('')
            $('#edit_jangka_waktu_2').val('')
            $('#edit_pengali_kurangdari_satudelapan_2').val('')
            $('#edit_pengali_diatas_dua_2').val('')
            $('#edit_jangka_waktu_3').val('')
            $('#edit_pengali_kurangdari_satudelapan_3').val('')
            $('#edit_pengali_diatas_dua_3').val('')
            $('#edit_jangka_waktu_4').val('')
            $('#edit_pengali_kurangdari_satudelapan_4').val('')
            $('#edit_pengali_diatas_dua_4').val('')
            // edittransaksi(kode);
            $('#diveditemassebelumnya').hide();
            $('#diveditemasselanjutnya').hide();
            $('#diveditpelunasan').hide();
            $('#divedittransaksi').hide();
            $('#diveditpembayaran').hide();
            $('#diveditbtnsimpan').hide();
            editgetdataemasgtc();
            editgetdataemasgtc2();
            var kode2 = $('#id_pengajuan').val();
            var kode3 = $('#edit_kode_transaksi').val();
            $.ajax({
                type: 'GET',
                url: '/backend/cari-edit-data-emas-transaksi-gtc/' + kode2 + '/' + kode3,
                success: function (data) {
                    $.each(data.emas, function (key, value) {
                        $('#editpengurangan'+ value.id).val('0');
                    }
                    );
                }, complete: function () {

                }
            });
            $.ajax({
                type: 'GET',
                url: '/backend/list-edit-transaksi/' + kode + '/' + kode2,
                success: function (data) {
                    $.each(data.data, function(key, value){
                        $('#edit_nominal_pinjaman').val(data.nominalpinjaman.toLocaleString("id-ID"));
                        $('#hidden_edit_nominal_pinjaman').val(data.nominalpinjaman);
                        $('#edit_pembayaran_pinjaman').val('');
                        $('#hidden_edit_pembayaran_pinjaman').val('');
                        $('#edit_sisa_pinjaman').val(data.nominalpinjaman.toLocaleString("id-ID"));
                        $('#hidden_edit_sisa_pinjaman').val(data.nominalpinjaman);
                        $('#edit_pembayaran').val('');
                        $('#edit_pembayaran_hidden').val('');
                    })
                },
                complete: function(){
                    
                }
            })
        }
    });
    $('#edit_pembayaran_pinjaman').bind("change keyup", function(){
        $('#hidden_edit_pembayaran_pinjaman').val($(this).val().replace(/[^,\d]/g, '').toString()).trigger('change');
        var nominal_pinjaman = $('#hidden_edit_nominal_pinjaman').val();
        var edit_pembayaran_pinjaman = $('#hidden_edit_pembayaran_pinjaman').val();
        var hitung = nominal_pinjaman-edit_pembayaran_pinjaman;
        $('#hidden_edit_sisa_pinjaman').val(hitung).trigger('change');
        $('#edit_sisa_pinjaman').val(hitung.toLocaleString('id-ID')).trigger('change');
    });
    $('#edit_pembayaran').bind("change keyup", function(){
        $('#edit_pembayaran_hidden').val($(this).val().replace(/[^,\d]/g, '').toString()).trigger('change');
    });
})
// ====================================================================================
function edittransaksi(kode){
    $('#panel').loading('toggle');
    var kode2 = $('#id_pengajuan').val();
    $.ajax({
        type: 'GET',
        url: '/backend/list-edit-transaksi/' + kode + '/' + kode2,
        success: function (data) {
            $.each(data.data, function(key, value){
                $('#diveditemassebelumnya').hide();
                $('#diveditemasselanjutnya').hide();
                $('#diveditpelunasan').hide();
                $('#divedittransaksi').hide();
                $('#diveditpembayaran').hide();
                $('#diveditbtnsimpan').hide();
                $('#edit_id_transaksi').val(value.idt);
                $('#edit_id_pengajuan').val(value.kode_pengajuan);
                $('#edit_id_perwada').val(value.id_perwada);
                $('#edit_nama_perwada').val(data.namaperwada.nama);
                $('#edit_kode_pengajuan').val(value.kode_pengajuan);
                $('#edit_kode_transaksi').val(value.kode_transaksi);
                if(value.jenis_transaksi === 'Pengajuan Baru'){
                    $('#edit_jenis_transaksi').hide();
                    $('#hidden_edit_jenis_transaksi').show();
                }else{
                    $('#edit_jenis_transaksi').val(value.jenis_transaksi);
                    if(value.jenis_transaksi === 'Perpanjangan'){
                        var kode = $('#edit_id_transaksi').val();
                        // $('#edit_nominal_pinjaman').val('')
                        // $('#hidden_edit_nominal_pinjaman').val('')
                        // $('#edit_pembayaran_pinjaman').val('')
                        // $('#hidden_edit_pembayaran_pinjaman').val('')
                        // $('#edit_sisa_pinjaman').val('')
                        // $('#edit_plafond_pinjaman').val('')
                        // $('#edit_plafond_pinjaman_hidden').val('')
                        // $('#edit_jangka_waktu_permohonan').val('Pilih');
                        // $('#edit_jasa_gtc').val('');
                        // $('#edit_upload_bukti_transfer').val('');
                        // $('#edit_pembayaran').val('');
                        // ===================
                        $('#edit_jangka_waktu_1').val('')
                        $('#edit_pengali_kurangdari_satudelapan_1').val('')
                        $('#edit_pengali_diatas_dua_1').val('')
                        $('#edit_jangka_waktu_2').val('')
                        $('#edit_pengali_kurangdari_satudelapan_2').val('')
                        $('#edit_pengali_diatas_dua_2').val('')
                        $('#edit_jangka_waktu_3').val('')
                        $('#edit_pengali_kurangdari_satudelapan_3').val('')
                        $('#edit_pengali_diatas_dua_3').val('')
                        $('#edit_jangka_waktu_4').val('')
                        $('#edit_pengali_kurangdari_satudelapan_4').val('')
                        $('#edit_pengali_diatas_dua_4').val('')
                        // edittransaksi(kode);
                        $('#diveditemasselanjutnya').show();
                        $('#divedittransaksi').show();
                        $('#diveditpembayaran').show();
                        $('#diveditbtnsimpan').show();
                        $('#diveditemassebelumnya').hide();
                        $('#diveditpelunasan').hide();
                        editgetdataemasgtc();
                        editgetdataemasgtc2();
                        // ========================================================================================
                        $('#panel').loading('toggle');
                        var kode = $('#id_pengajuan').val();
                        var kode2 = $('#edit_kode_transaksi').val();
                        $.ajax({
                            type: 'GET',
                            url: '/backend/cari-edit-data-emas-transaksi-gtc/' + kode + '/' + kode2,
                            success: function (data) {
                                $.each(data.jenisjasagtc, function(key, item){
                                    $('#edit_jangka_waktu_1').val(item.jangka_waktu_1)
                                    $('#edit_pengali_kurangdari_satudelapan_1').val(item.pengali_kurangdari_satudelapan_1)
                                    $('#edit_pengali_diatas_dua_1').val(item.pengali_diatas_dua_1)
                                    $('#edit_jangka_waktu_2').val(item.jangka_waktu_2)
                                    $('#edit_pengali_kurangdari_satudelapan_2').val(item.pengali_kurangdari_satudelapan_2)
                                    $('#edit_pengali_diatas_dua_2').val(item.pengali_diatas_dua_2)
                                    $('#edit_jangka_waktu_3').val(item.jangka_waktu_3)
                                    $('#edit_pengali_kurangdari_satudelapan_3').val(item.pengali_kurangdari_satudelapan_3)
                                    $('#edit_pengali_diatas_dua_3').val(item.pengali_diatas_dua_3)
                                    $('#edit_jangka_waktu_4').val(item.jangka_waktu_4)
                                    $('#edit_pengali_kurangdari_satudelapan_4').val(item.pengali_kurangdari_satudelapan_4)
                                    $('#edit_pengali_diatas_dua_4').val(item.pengali_diatas_dua_4)
                                })
                                $.each(data.emas, function (key, value) {
                                    var newformat = data.totalbuyback;
                                    var hitung = (newformat/100)*90;
                                    var newhitung = hitung.toLocaleString("id-ID")
                                    var number_string = newhitung.replace(/[^,\d]/g, '').toString(),
                                    split   		= number_string.split(','),
                                    sisa     		= split[0].length % 3,
                                    rupiah     		= split[0].substr(0, sisa),
                                    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
                                
                                    // editkan titik jika yang di input sudah menjadi angka ribuan
                                    if(ribuan){
                                        separator = sisa ? '.' : '';
                                        rupiah += separator + ribuan.join('.');
                                    }
                                
                                    rupiah = split[1] != undefined ? rupiah + '.' + split[1] : rupiah;
                                    $("#edit_plafond_pinjaman").val(rupiah).trigger('change');
                                    var plafond_pinjaman = $("#edit_plafond_pinjaman").val();
                                    var newplafond_pinjaman = plafond_pinjaman.replace(/[^,\d]/g, '').toString();
                                    $("#edit_plafond_pinjaman_hidden").val(newplafond_pinjaman).trigger('change');
                                    // ======================================================================
                                    $('#edit_jangka_waktu_permohonan').change(function(){
                                        if($(this).val() === '0.5'){
                                            if(parseFloat(data.fgramasi.toFixed(0))>=0.1 && parseFloat(data.fgramasi.toFixed(0))<=49.9){
                                                jangka_waktu = $('#edit_jangka_waktu_1').val()
                                                numjangka_waktu = parseFloat(jangka_waktu)
                                                pengali = $('#edit_pengali_kurangdari_satudelapan_1').val()
                                                numpengali = parseFloat(pengali)
                                                hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*data.totalbuyback).toFixed(0)
                                                newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                                bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                                hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                                $('#edit_jasa_gtc').val(hasiljasa).trigger("change")
                                                $('#edit_pembayaran_jasa').val('Transfer').trigger("change")
                                            }else if(data.fgramasi.toFixed(0)>=50){
                                                jangka_waktu = $('#edit_jangka_waktu_1').val()
                                                numjangka_waktu = parseFloat(jangka_waktu)
                                                pengali = $('#edit_pengali_diatas_dua_1').val()
                                                numpengali = parseFloat(pengali)
                                                hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*data.totalbuyback).toFixed(0)
                                                newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                                bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                                hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                                $('#edit_jasa_gtc').val(hasiljasa).trigger("change")
                                                $('#edit_pembayaran_jasa').val('Transfer').trigger("change")
                                            }
                                        }else if($(this).val() === '1'){
                                            if(parseFloat(data.fgramasi.toFixed(0))>=0.1 && parseFloat(data.fgramasi.toFixed(0))<=49.9){
                                                jangka_waktu = $('#edit_jangka_waktu_2').val()
                                                numjangka_waktu = parseFloat(jangka_waktu)
                                                pengali = $('#edit_pengali_kurangdari_satudelapan_2').val()
                                                numpengali = parseFloat(pengali)
                                                hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*data.totalbuyback).toFixed(0)
                                                newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                                bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                                hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                                $('#edit_jasa_gtc').val(hasiljasa).trigger("change")
                                                $('#edit_pembayaran_jasa').val('Transfer').trigger("change")
                                            }else if(data.fgramasi.toFixed(0)>=50){
                                                jangka_waktu = $('#edit_jangka_waktu_2').val()
                                                numjangka_waktu = parseFloat(jangka_waktu)
                                                pengali = $('#edit_pengali_diatas_dua_2').val()
                                                numpengali = parseFloat(pengali)
                                                hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*data.totalbuyback).toFixed(0)
                                                newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                                bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                                hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                                $('#edit_jasa_gtc').val(hasiljasa).trigger("change")
                                                $('#edit_pembayaran_jasa').val('Transfer').trigger("change")
                                            }
                                        }else if($(this).val() === '2'){
                                            if(parseFloat(data.fgramasi.toFixed(0))>=0.1 && parseFloat(data.fgramasi.toFixed(0))<=49.9){
                                                jangka_waktu = $('#edit_jangka_waktu_3').val()
                                                numjangka_waktu = parseFloat(jangka_waktu)
                                                pengali = $('#edit_pengali_kurangdari_satudelapan_3').val()
                                                numpengali = parseFloat(pengali)
                                                hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*data.totalbuyback).toFixed(0)
                                                newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                                bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                                hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                                $('#edit_jasa_gtc').val(hasiljasa).trigger("change")
                                                $('#edit_pembayaran_jasa').val('Transfer').trigger("change")
                                            }else if(data.fgramasi.toFixed(0)>=50){
                                                jangka_waktu = $('#edit_jangka_waktu_3').val()
                                                numjangka_waktu = parseFloat(jangka_waktu)
                                                pengali = $('#edit_pengali_diatas_dua_3').val()
                                                numpengali = parseFloat(pengali)
                                                hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*data.totalbuyback).toFixed(0)
                                                newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                                bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                                hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                                $('#edit_jasa_gtc').val(hasiljasa).trigger("change")
                                                $('#edit_pembayaran_jasa').val('Transfer').trigger("change")
                                            }
                                        }else{
                                            $('#edit_jasa_gtc').val('').trigger("change")
                                            $('#pembayaran_jasa_manual').val('').trigger("change");
                                            $('#div_nominal_potongan').hide()
                                            $('#nominal_potongan').val('').trigger("change");
                                            $('#jumlah_yang_di_transfer').val('').trigger("change");
                                            $('#edit_pembayaran_jasa').val('Transfer').trigger("change")
                                        }
                                    });
                                });
                            }, complete: function () {
                                $('#panel').loading('stop');
                            }
                        });
                        $('#edit_pembayaran').bind("change keyup", function(){
                            var pembayaran = parseInt($(this).val().replace(/[^,\d]/g, '').toString());
                            var jasagtc = parseInt($('#edit_jasa_gtc').val().replace(/[^,\d]/g, '').toString());
                            var hitung = pembayaran-jasagtc;
                            $('#edit_sisa_pembayaran').val(hitung.toLocaleString("id-ID"));
                            $('#edit_sisa_pembayaran_hidden').val(hitung);
                        });
                    }else if(value.jenis_transaksi === 'Pelunasan Sebagian'){
                        var kode = $('#edit_id_transaksi').val();
                        // $('#edit_nominal_pinjaman').val('')
                        // $('#hidden_edit_nominal_pinjaman').val('')
                        // $('#edit_pembayaran_pinjaman').val('')
                        // $('#hidden_edit_pembayaran_pinjaman').val('')
                        // $('#edit_sisa_pinjaman').val('')
                        // $('#edit_plafond_pinjaman').val('')
                        // $('#edit_plafond_pinjaman_hidden').val('')
                        // $('#edit_jangka_waktu_permohonan').val('Pilih');
                        // $('#edit_jasa_gtc').val('');
                        // $('#edit_upload_bukti_transfer').val('');
                        // $('#edit_pembayaran').val('');
                        // ===================
                        $('#edit_jangka_waktu_1').val('')
                        $('#edit_pengali_kurangdari_satudelapan_1').val('')
                        $('#edit_pengali_diatas_dua_1').val('')
                        $('#edit_jangka_waktu_2').val('')
                        $('#edit_pengali_kurangdari_satudelapan_2').val('')
                        $('#edit_pengali_diatas_dua_2').val('')
                        $('#edit_jangka_waktu_3').val('')
                        $('#edit_pengali_kurangdari_satudelapan_3').val('')
                        $('#edit_pengali_diatas_dua_3').val('')
                        $('#edit_jangka_waktu_4').val('')
                        $('#edit_pengali_kurangdari_satudelapan_4').val('')
                        $('#edit_pengali_diatas_dua_4').val('')
                        // edittransaksi(kode);
                        $('#diveditemassebelumnya').show();
                        $('#diveditemasselanjutnya').show();
                        $('#diveditpelunasan').show();
                        $('#divedittransaksi').show();
                        $('#diveditpembayaran').show();
                        $('#diveditbtnsimpan').show();
                        editgetdataemasgtc();
                        editgetdataemasgtc2();
                        // ======================================================================
                        $('#panel').loading('toggle');
                        var kode = $('#id_pengajuan').val();
                        var kode2 = $('#edit_kode_transaksi').val();
                        $.ajax({
                            type: 'GET',
                            url: '/backend/cari-edit-data-emas-transaksi-gtc/' + kode + '/' + kode2,
                            success: function (data) {
                                $.each(data.jenisjasagtc, function(key, item){
                                    $('#edit_jangka_waktu_1').val(item.jangka_waktu_1)
                                    $('#edit_pengali_kurangdari_satudelapan_1').val(item.pengali_kurangdari_satudelapan_1)
                                    $('#edit_pengali_diatas_dua_1').val(item.pengali_diatas_dua_1)
                                    $('#edit_jangka_waktu_2').val(item.jangka_waktu_2)
                                    $('#edit_pengali_kurangdari_satudelapan_2').val(item.pengali_kurangdari_satudelapan_2)
                                    $('#edit_pengali_diatas_dua_2').val(item.pengali_diatas_dua_2)
                                    $('#edit_jangka_waktu_3').val(item.jangka_waktu_3)
                                    $('#edit_pengali_kurangdari_satudelapan_3').val(item.pengali_kurangdari_satudelapan_3)
                                    $('#edit_pengali_diatas_dua_3').val(item.pengali_diatas_dua_3)
                                    $('#edit_jangka_waktu_4').val(item.jangka_waktu_4)
                                    $('#edit_pengali_kurangdari_satudelapan_4').val(item.pengali_kurangdari_satudelapan_4)
                                    $('#edit_pengali_diatas_dua_4').val(item.pengali_diatas_dua_4)
                                })
                                $.each(data.emas, function (key, value) {
                                    var newformat = data.totalbuyback;
                                    var hitung = (newformat/100)*90;
                                    var newhitung = hitung.toLocaleString("id-ID")
                                    var number_string = newhitung.replace(/[^,\d]/g, '').toString(),
                                    split   		= number_string.split(','),
                                    sisa     		= split[0].length % 3,
                                    rupiah     		= split[0].substr(0, sisa),
                                    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
                                
                                    // editkan titik jika yang di input sudah menjadi angka ribuan
                                    if(ribuan){
                                        separator = sisa ? '.' : '';
                                        rupiah += separator + ribuan.join('.');
                                    }
                                
                                    rupiah = split[1] != undefined ? rupiah + '.' + split[1] : rupiah;
                                    $("#edit_plafond_pinjaman").val(rupiah).trigger('change');
                                    var plafond_pinjaman = $("#edit_plafond_pinjaman").val();
                                    var newplafond_pinjaman = plafond_pinjaman.replace(/[^,\d]/g, '').toString();
                                    $("#edit_plafond_pinjaman_hidden").val(newplafond_pinjaman).trigger('change');
                                    // ======================================================================
                                    $('#edit_jangka_waktu_permohonan').change(function(){
                                        if($(this).val() === '0.5'){
                                            if(parseFloat(data.fgramasi.toFixed(0))>=0.1 && parseFloat(data.fgramasi.toFixed(0))<=49.9){
                                                jangka_waktu = $('#edit_jangka_waktu_1').val()
                                                numjangka_waktu = parseFloat(jangka_waktu)
                                                pengali = $('#edit_pengali_kurangdari_satudelapan_1').val()
                                                numpengali = parseFloat(pengali)
                                                hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*data.totalbuyback).toFixed(0)
                                                newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                                bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                                hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                                $('#edit_jasa_gtc').val(hasiljasa).trigger("change")
                                                $('#edit_pembayaran_jasa').val('Transfer').trigger("change")
                                            }else if(data.fgramasi.toFixed(0)>=50){
                                                jangka_waktu = $('#edit_jangka_waktu_1').val()
                                                numjangka_waktu = parseFloat(jangka_waktu)
                                                pengali = $('#edit_pengali_diatas_dua_1').val()
                                                numpengali = parseFloat(pengali)
                                                hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*data.totalbuyback).toFixed(0)
                                                newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                                bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                                hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                                $('#edit_jasa_gtc').val(hasiljasa).trigger("change")
                                                $('#edit_pembayaran_jasa').val('Transfer').trigger("change")
                                            }
                                        }else if($(this).val() === '1'){
                                            if(parseFloat(data.fgramasi.toFixed(0))>=0.1 && parseFloat(data.fgramasi.toFixed(0))<=49.9){
                                                jangka_waktu = $('#edit_jangka_waktu_2').val()
                                                numjangka_waktu = parseFloat(jangka_waktu)
                                                pengali = $('#edit_pengali_kurangdari_satudelapan_2').val()
                                                numpengali = parseFloat(pengali)
                                                hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*data.totalbuyback).toFixed(0)
                                                newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                                bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                                hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                                $('#edit_jasa_gtc').val(hasiljasa).trigger("change")
                                                $('#edit_pembayaran_jasa').val('Transfer').trigger("change")
                                            }else if(data.fgramasi.toFixed(0)>=50){
                                                jangka_waktu = $('#edit_jangka_waktu_2').val()
                                                numjangka_waktu = parseFloat(jangka_waktu)
                                                pengali = $('#edit_pengali_diatas_dua_2').val()
                                                numpengali = parseFloat(pengali)
                                                hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*data.totalbuyback).toFixed(0)
                                                newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                                bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                                hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                                $('#edit_jasa_gtc').val(hasiljasa).trigger("change")
                                                $('#edit_pembayaran_jasa').val('Transfer').trigger("change")
                                            }
                                        }else if($(this).val() === '2'){
                                            if(parseFloat(data.fgramasi.toFixed(0))>=0.1 && parseFloat(data.fgramasi.toFixed(0))<=49.9){
                                                jangka_waktu = $('#edit_jangka_waktu_3').val()
                                                numjangka_waktu = parseFloat(jangka_waktu)
                                                pengali = $('#edit_pengali_kurangdari_satudelapan_3').val()
                                                numpengali = parseFloat(pengali)
                                                hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*data.totalbuyback).toFixed(0)
                                                newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                                bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                                hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                                $('#edit_jasa_gtc').val(hasiljasa).trigger("change")
                                                $('#edit_pembayaran_jasa').val('Transfer').trigger("change")
                                            }else if(data.fgramasi.toFixed(0)>=50){
                                                jangka_waktu = $('#edit_jangka_waktu_3').val()
                                                numjangka_waktu = parseFloat(jangka_waktu)
                                                pengali = $('#edit_pengali_diatas_dua_3').val()
                                                numpengali = parseFloat(pengali)
                                                hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*data.totalbuyback).toFixed(0)
                                                newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                                                bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                                                hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                                                $('#edit_jasa_gtc').val(hasiljasa).trigger("change")
                                                $('#edit_pembayaran_jasa').val('Transfer').trigger("change")
                                            }
                                        }else{
                                            $('#edit_jasa_gtc').val('').trigger("change")
                                            $('#pembayaran_jasa_manual').val('').trigger("change");
                                            $('#div_nominal_potongan').hide()
                                            $('#nominal_potongan').val('').trigger("change");
                                            $('#jumlah_yang_di_transfer').val('').trigger("change");
                                            $('#edit_pembayaran_jasa').val('Transfer').trigger("change")
                                        }
                                    });
                                });
                            }, complete: function () {
                                $('#panel').loading('stop');
                            }
                        });
                        $('#edit_pembayaran').bind("change keyup", function(){
                            var pembayaran = parseInt($(this).val().replace(/[^,\d]/g, '').toString());
                            var pembayaranpinjaman = parseInt($('#edit_pembayaran_pinjaman').val().replace(/[^,\d]/g, '').toString());
                            var jasagtc = parseInt($('#edit_jasa_gtc').val().replace(/[^,\d]/g, '').toString());
                            var tambah = pembayaranpinjaman+jasagtc;
                            var hitung = pembayaran-tambah;
                            $('#edit_sisa_pembayaran').val(hitung.toLocaleString("id-ID"));
                            $('#edit_sisa_pembayaran_hidden').val(hitung);
                        });
                    }else if(value.jenis_transaksi === 'Pelunasan'){
                        var kode = $('#edit_id_transaksi').val();
                        // $('#edit_nominal_pinjaman').val('')
                        // $('#hidden_edit_nominal_pinjaman').val('')
                        // $('#edit_pembayaran_pinjaman').val('')
                        // $('#hidden_edit_pembayaran_pinjaman').val('')
                        // $('#edit_sisa_pinjaman').val('')
                        // $('#edit_plafond_pinjaman').val('')
                        // $('#edit_plafond_pinjaman_hidden').val('')
                        // $('#edit_jangka_waktu_permohonan').val('Pilih');
                        // $('#edit_jasa_gtc').val('');
                        // $('#edit_upload_bukti_transfer').val('');
                        // $('#edit_pembayaran').val('');
                        // ===================
                        $('#edit_jangka_waktu_1').val('')
                        $('#edit_pengali_kurangdari_satudelapan_1').val('')
                        $('#edit_pengali_diatas_dua_1').val('')
                        $('#edit_jangka_waktu_2').val('')
                        $('#edit_pengali_kurangdari_satudelapan_2').val('')
                        $('#edit_pengali_diatas_dua_2').val('')
                        $('#edit_jangka_waktu_3').val('')
                        $('#edit_pengali_kurangdari_satudelapan_3').val('')
                        $('#edit_pengali_diatas_dua_3').val('')
                        $('#edit_jangka_waktu_4').val('')
                        $('#edit_pengali_kurangdari_satudelapan_4').val('')
                        $('#edit_pengali_diatas_dua_4').val('')
                        // edittransaksi(kode);
                        $('#diveditemassebelumnya').show();
                        $('#diveditemasselanjutnya').show();
                        $('#diveditpelunasan').show();
                        $('#diveditpembayaran').show();
                        $('#diveditbtnsimpan').show();
                        $('#divedittransaksi').hide();
                        editgetdataemasgtc();
                        editgetdataemasgtc2();
                        $('#edit_pembayaran').bind("change keyup", function(){
                            var pembayaran = parseInt($(this).val().replace(/[^,\d]/g, '').toString());
                            var pembayaranpinjaman = parseInt($('#edit_pembayaran_pinjaman').val().replace(/[^,\d]/g, '').toString());
                            var hitung = pembayaran-pembayaranpinjaman;
                            $('#edit_sisa_pembayaran').val(hitung.toLocaleString("id-ID"));
                            $('#edit_sisa_pembayaran_hidden').val(hitung);
                        });
                    }else{
                        var kode = $('#edit_id_transaksi').val();
                        // $('#edit_nominal_pinjaman').val('')
                        // $('#hidden_edit_nominal_pinjaman').val('')
                        // $('#edit_pembayaran_pinjaman').val('')
                        // $('#hidden_edit_pembayaran_pinjaman').val('')
                        // $('#edit_sisa_pinjaman').val('')
                        // $('#edit_plafond_pinjaman').val('')
                        // $('#edit_plafond_pinjaman_hidden').val('')
                        // $('#edit_jangka_waktu_permohonan').val('Pilih');
                        // $('#edit_jasa_gtc').val('');
                        // $('#edit_upload_bukti_transfer').val('');
                        // $('#edit_pembayaran').val('');
                        // ===================
                        $('#edit_jangka_waktu_1').val('')
                        $('#edit_pengali_kurangdari_satudelapan_1').val('')
                        $('#edit_pengali_diatas_dua_1').val('')
                        $('#edit_jangka_waktu_2').val('')
                        $('#edit_pengali_kurangdari_satudelapan_2').val('')
                        $('#edit_pengali_diatas_dua_2').val('')
                        $('#edit_jangka_waktu_3').val('')
                        $('#edit_pengali_kurangdari_satudelapan_3').val('')
                        $('#edit_pengali_diatas_dua_3').val('')
                        $('#edit_jangka_waktu_4').val('')
                        $('#edit_pengali_kurangdari_satudelapan_4').val('')
                        $('#edit_pengali_diatas_dua_4').val('')
                        // edittransaksi(kode);
                        $('#diveditemassebelumnya').hide();
                        $('#diveditemasselanjutnya').hide();
                        $('#diveditpelunasan').hide();
                        $('#divedittransaksi').hide();
                        $('#diveditpembayaran').hide();
                        $('#diveditbtnsimpan').hide();
                        editgetdataemasgtc();
                        editgetdataemasgtc2();
                    }
                    $('#edit_jenis_transaksi').show();
                    $('#hidden_edit_jenis_transaksi').hide();
                }
                $('#edit_nominal_pinjaman').val(data.nominalpinjaman.toLocaleString("id-ID"));
                $('#hidden_edit_nominal_pinjaman').val(data.nominalpinjaman);
                $('#edit_pembayaran_pinjaman').val(data.fpembayaran_pinjaman2.toLocaleString("id-ID"));
                $('#hidden_edit_pembayaran_pinjaman').val(data.fpembayaran_pinjaman2);
                $('#edit_sisa_pinjaman').val(data.sisapinjaman.toLocaleString("id-ID"));
                $('#hidden_edit_sisa_pinjaman').val(data.sisapinjaman);
                $('#edit_pilihan_jasa').val(value.pilihan_jasa);
                $('#edit_perhitungan_jasa').val(value.perhitungan_jasa);
                $('#edit_jangka_waktu_permohonan').val(value.jangka_waktu_permohonan);
                $('#edit_jasa_gtc').val(parseInt(value.jasa_gtc).toLocaleString("id-ID"));
                $('#edit_hidden_upload_bukti_transfer').val(value.upload_bukti_transfer);
                var pembayaran = parseInt(data.fpembayaran_pinjaman2)+parseInt(value.jumlah_transfer);
                $('#edit_pembayaran').val(pembayaran.toLocaleString("id-ID"));
                $('#edit_pembayaran_hidden').val(pembayaran);
                $('#edit_sisa_pembayaran').val(parseInt(value.sisa_pembayaran).toLocaleString("id-ID"));
                $('#edit_sisa_pembayaran_hidden').val(parseInt(value.sisa_pembayaran));
                $('#edit_catatan').val(value.catatan2);
            })
        },
        complete: function(){
            $('#modal-edit-transaksi').modal('show');
            editgetdataemasgtc();
            editgetdataemasgtc2();
            $('#panel').loading('stop')
        }
    })
}
// ====================================================================================
$('#btnedittransaksi').on('click', function(e){
    var pembayaranpinjaman = $('#hidden_edit_pembayaran_pinjaman').val();
    var jasagtc = $('#edit_jasa_gtc').val().replace(/[^,\d]/g, '').toString();
    var pembayaran = $('#edit_pembayaran_hidden').val();
    if ($('#edit_jenis_transaksi').val() === 'Perpanjangan') {
        if(parseInt(pembayaran)<parseInt(jasagtc)){
            swalWithBootstrapButtons.fire({
                title: 'Oops',
                text: 'Pembayaran kurang',
                confirmButtonText: 'OK'
            });
            return false;
        }else{
            $('#panel').loading('toggle');
            $('#formedittransaksi').on('submit', function (e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name=_token]').val()
                    }
                });
                var id_transaksi = $('#edit_id_transaksi').val();
                var formData = new FormData(this);
                $.ajax({
                    url: '/backend/edit-transaksi/' + id_transaksi,
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
                        $('#list-data').DataTable().ajax.reload();
                        $('#modal-edit-transaksi').modal('hide');
                        transaksi2();
                        $('#edit_id_transaksi').val('');
                        $('#edit_id_pengajuan').val('');
                        $('#edit_id_perwada').val('');
                        $('#edit_kode_pengajuan').val('');
                        $('#edit_kode_transaksi').val('');
                        $('#edit_nominal_pinjaman').val('');
                        $('#hidden_edit_nominal_pinjaman').val('');
                        $('#edit_pembayaran_pinjaman').val('');
                        $('#hidden_edit_pembayaran_pinjaman').val('');
                        $('#edit_sisa_pinjaman').val('');
                        $('#hidden_edit_sisa_pinjaman').val('');
                        $('#edit_pilihan_jasa').val('');
                        $('#edit_perhitungan_jasa').val('');
                        $('#edit_jangka_waktu_permohonan').val('');
                        $('#edit_jasa_gtc').val('');
                        $('#edit_hidden_upload_bukti_transfer').val('');
                        // var pembayaran = parseInt(data.fpembayaran_pinjaman2)+parseInt(value.jumlah_transfer);
                        $('#edit_pembayaran').val('');
                        $('#edit_pembayaran_hidden').val('');
                    }
                });
            });
        }
    }else if($('#edit_jenis_transaksi').val() === 'Pelunasan Sebagian'){
        var totalbuyback = $('#edittotal_buyback2_hidden').val();
        var sisapinjaman = $('#hidden_edit_sisa_pinjaman').val();
        var persen = (totalbuyback/100)*90;
        if(parseInt(persen)<parseInt(sisapinjaman)){
            swalWithBootstrapButtons.fire({
                title: 'Oops',
                text: 'Minimal sisa pinjaman adalah 90% dari total buyback',
                confirmButtonText: 'OK'
            });
            return false;
        }else{
            hitung = parseInt(pembayaranpinjaman)+parseInt(jasagtc);
            if(parseInt(pembayaran)<parseInt(hitung)){
                swalWithBootstrapButtons.fire({
                    title: 'Oops',
                    text: 'Pembayaran kurang',
                    confirmButtonText: 'OK'
                });
                return false;
            }else{
                $('#panel').loading('toggle');
                $('#formedittransaksi').on('submit', function (e) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('input[name=_token]').val()
                        }
                    });
                    var id_transaksi = $('#edit_id_transaksi').val();
                    var formData = new FormData(this);
                    $.ajax({
                        url: '/backend/edit-transaksi/' + id_transaksi,
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
                            $('#list-data').DataTable().ajax.reload();
                            $('#modal-edit-transaksi').modal('hide');
                            transaksi2();
                            $('#edit_id_transaksi').val('');
                            $('#edit_id_pengajuan').val('');
                            $('#edit_id_perwada').val('');
                            $('#edit_kode_pengajuan').val('');
                            $('#edit_kode_transaksi').val('');
                            $('#edit_nominal_pinjaman').val('');
                            $('#hidden_edit_nominal_pinjaman').val('');
                            $('#edit_pembayaran_pinjaman').val('');
                            $('#hidden_edit_pembayaran_pinjaman').val('');
                            $('#edit_sisa_pinjaman').val('');
                            $('#hidden_edit_sisa_pinjaman').val('');
                            $('#edit_pilihan_jasa').val('');
                            $('#edit_perhitungan_jasa').val('');
                            $('#edit_jangka_waktu_permohonan').val('');
                            $('#edit_jasa_gtc').val('');
                            $('#edit_hidden_upload_bukti_transfer').val('');
                            // var pembayaran = parseInt(data.fpembayaran_pinjaman2)+parseInt(value.jumlah_transfer);
                            $('#edit_pembayaran').val('');
                            $('#edit_pembayaran_hidden').val('');
                        }
                    });
                });
            }
        }
    }else if($('#edit_jenis_transaksi').val() === 'Pelunasan'){
        var totalbuyback = $('#edittotal_buyback2_hidden').val();
        var sisapinjaman = $('#hidden_edit_sisa_pinjaman').val();
        var persen = (totalbuyback/100)*100;
        if(parseInt(persen)<parseInt(sisapinjaman)){
            swalWithBootstrapButtons.fire({
                title: 'Oops',
                text: 'Minimal sisa pinjaman adalah 100% dari total buyback',
                confirmButtonText: 'OK'
            });
            return false;
        }else{
            if(parseInt(pembayaran)<parseInt(pembayaranpinjaman)){
                swalWithBootstrapButtons.fire({
                    title: 'Oops',
                    text: 'Pembayaran kurang',
                    confirmButtonText: 'OK'
                });
                return false;
            }else{
                $('#panel').loading('toggle');
                $('#formedittransaksi').on('submit', function (e) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('input[name=_token]').val()
                        }
                    });
                    var id_transaksi = $('#edit_id_transaksi').val();
                    var formData = new FormData(this);
                    $.ajax({
                        url: '/backend/edit-transaksi/' + id_transaksi,
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
                            $('#list-data').DataTable().ajax.reload();
                            $('#modal-edit-transaksi').modal('hide');
                            transaksi2();
                            $('#edit_id_transaksi').val('');
                            $('#edit_id_pengajuan').val('');
                            $('#edit_id_perwada').val('');
                            $('#edit_kode_pengajuan').val('');
                            $('#edit_kode_transaksi').val('');
                            $('#edit_nominal_pinjaman').val('');
                            $('#hidden_edit_nominal_pinjaman').val('');
                            $('#edit_pembayaran_pinjaman').val('');
                            $('#hidden_edit_pembayaran_pinjaman').val('');
                            $('#edit_sisa_pinjaman').val('');
                            $('#hidden_edit_sisa_pinjaman').val('');
                            $('#edit_pilihan_jasa').val('');
                            $('#edit_perhitungan_jasa').val('');
                            $('#edit_jangka_waktu_permohonan').val('');
                            $('#edit_jasa_gtc').val('');
                            $('#edit_hidden_upload_bukti_transfer').val('');
                            // var pembayaran = parseInt(data.fpembayaran_pinjaman2)+parseInt(value.jumlah_transfer);
                            $('#edit_pembayaran').val('');
                            $('#edit_pembayaran_hidden').val('');
                        }
                    });
                });
            }
        }
    }
    
});
// ====================================================================================
function editgetdataemasgtc() {
    $('#panel').loading('toggle');
    $('#editbodyemassebelumnya').html('');
    $('#editfootemassebelumnya').html('');
    var kode = $('#id_pengajuan').val();
    var kode2 = $('#edit_kode_transaksi').val();
    $.ajax({
        type: 'GET',
        url: '/backend/cari-edit-data-emas-transaksi-gtc/' + kode + '/' + kode2,
        success: function (data) {
            var rows = '';
            var no = 0;
            $.each(data.emas, function (key, value) {
                no += 1;
                var keping = value.keping;
                var tkeping = data.transaksi[no-1].total;
                var hasilkeping = keping-tkeping;
                if(hasilkeping === 0){
                    rows = rows + '<tr hidden>';
                    rows = rows + '<td hidden><input type="hidden" class="form-control" value="'+ value.id +'" id="editid_emas" name="editid_emas[]"></td>';
                    rows = rows + '<td>' + value.item_emas + '</td>';
                    rows = rows + '<td><span class="badge badge-primary-lighten">'+ value.jenis +'</span></td>';
                    rows = rows + '<td class="editgramasi">' + value.gramasi + '</td>';
                    // rows = rows + '<td class="">' + data.transaksi[no-1].total + '</td>';
                    // var keping = value.keping;
                    // var tkeping = data.transaksi[no-1].total;
                    // var hasilkeping = keping-tkeping;
                    rows = rows + '<td><input id="editkeping'+ value.id +'" type="number" max="999" min="1" value="'+ hasilkeping +'" class="editkeping form-control" name="editkeping[]" placeholder="Qty" style="width: 90px;" data-toggle="input-mask" data-mask-format="00" readonly></td>';
                    rows = rows + '<td class="editjumlah_gramasi">' + (value.gramasi*value.keping).toFixed(1) +" Gram" + '</td>';
                    rows = rows + '<td><input id="editpengurangan'+ value.id +'" type="number" max="999" min="1" value="'+ data.historikeping[no-1].keping +'" class="editpengurangan form-control" name="editpengurangan[]" placeholder="Qty" style="width: 90px;" data-toggle="input-mask" data-mask-format="00"></td>';
                    rows = rows + '<td class="editjumlah_gramasi_pengurangan">' + 0 +" Gram"+ '</td>';
                    rows = rows + '</tr>';
                }else{
                    rows = rows + '<tr>';
                    rows = rows + '<td hidden><input type="hidden" class="form-control" value="'+ value.id +'" id="editid_emas" name="editid_emas[]"></td>';
                    rows = rows + '<td>' + value.item_emas + '</td>';
                    rows = rows + '<td><span class="badge badge-primary-lighten">'+ value.jenis +'</span></td>';
                    rows = rows + '<td class="editgramasi">' + value.gramasi + '</td>';
                    // rows = rows + '<td class="">' + data.transaksi[no-1].total + '</td>';
                    // var keping = value.keping;
                    // var tkeping = data.transaksi[no-1].total;
                    // var hasilkeping = keping-tkeping;
                    rows = rows + '<td><input id="editkeping'+ value.id +'" type="number" max="999" min="1" value="'+ hasilkeping +'" class="editkeping form-control" name="editkeping[]" placeholder="Qty" style="width: 90px;" data-toggle="input-mask" data-mask-format="00" readonly></td>';
                    rows = rows + '<td class="editjumlah_gramasi">' + (value.gramasi*value.keping).toFixed(1) +" Gram" + '</td>';
                    rows = rows + '<td><input id="editpengurangan'+ value.id +'" type="number" max="999" min="1" value="'+ data.historikeping[no-1].keping +'" class="editpengurangan form-control" name="editpengurangan[]" placeholder="Qty" style="width: 90px;" data-toggle="input-mask" data-mask-format="00"></td>';
                    rows = rows + '<td class="editjumlah_gramasi_pengurangan">' + (value.gramasi*data.historikeping[no-1].keping).toFixed(1) +" Gram"+ '</td>';
                    rows = rows + '</tr>';
                }
                
            }
            );
            $('#editbodyemassebelumnya').html(rows);
            $("#editfootemassebelumnya").html('<tr><th>Total</th><th></th><th></th><th id="edittotal_keping">'+ data.fkeping +" Keping" +'</th><th id="edittotal_gramasi">'+ data.fgramasi.toFixed(1) +" Gram" +'</th><th id="edittotal_pengurangan">0 Keping</th><th id="edittotal_gramasi_pengurangan">0 Gram</th></tr>');
            editgetTotal();
            editpengurangan();
            editgetTotal2();
            editkeping();
        }, complete: function () {
            $('#panel').loading('stop');
        }
    });
}
// ====================================================================================
function editgetTotal(){
    total_pengurangan = 0;
    $('.editpengurangan').each(function(){
        total_pengurangan += parseInt(this.value)
    });
    $('#edittotal_pengurangan').text(total_pengurangan + " Keping");

    total_gramasi_pengurangan = 0;
    $('.editjumlah_gramasi_pengurangan').each(function(){
        total_gramasi_pengurangan += parseFloat(this.innerHTML)
    });
    $('#edittotal_gramasi_pengurangan').text(total_gramasi_pengurangan.toFixed(1) + " Gram");
}
editgetTotal();
editpengurangan();
function editpengurangan(){
    $('.editpengurangan').bind("change keyup",function(){
        var len = this.value.length; 
        if (len >= 3) { 
            this.value = this.value.substring(0, 3); 
        }
        // ===============
        var kode = $('#id_pengajuan').val();
        $.ajax({
            type: 'GET',
            url: '/backend/cari-data-emas-transaksi-gtc/' + kode,
            success: function (data) {
                var no = 0;
                $.each(data.emas, function (key, value) {
                    no += 1;
                    var satu = $('#editpengurangan'+value.id).val();
                    var dua = $('#editkeping'+value.id).val();
                    var keping = value.keping;
                    var tkeping = data.transaksi[no-1].total;
                    var hasilkeping = keping-tkeping;
                    if(parseInt(satu) > parseInt(dua)){
                        $('#editpengurangan'+value.id).val(hasilkeping).trigger("change")
                    }
                    var pengurangan = $('#editpengurangan'+value.id).val();
                    var keping = $('#editkeping'+value.id).val();
                    keping2 = keping-pengurangan;
                    $('#editkeping2'+value.id).val(keping2).trigger("change");
                    if(keping2 === 0){
                        $('#edithidden'+value.id).hide();
                    }else{
                        $('#edithidden'+value.id).show();
                    }
                    });
            }, complete: function () {

            }
        });
        // ===============
        var parent = $(this).parents('tr');
        var gramasi = $('.editgramasi', parent);
        var jumlah_gramasi = $('.editjumlah_gramasi_pengurangan', parent);
        var value_gramasi = parseInt(this.value) * parseFloat(gramasi.get(0).innerHTML||0);
        jumlah_gramasi.text(value_gramasi.toFixed(1) +" Gram");
        editgetTotal();
    })
}
// ====================================================================================
function editgetdataemasgtc2() {
    $('#panel').loading('toggle');
    $('#editbodyemasselanjutnya').html('');
    $('#editfootemasselanjutnya').html('');
    var kode = $('#id_pengajuan').val();
    var kode2 = $('#edit_kode_transaksi').val();
    $.ajax({
        type: 'GET',
        url: '/backend/cari-edit-data-emas-transaksi-gtc/' + kode + '/' + kode2,
        success: function (data) {
            var rows = '';
            var no = 0;
            $.each(data.emas, function (key, value) {
                no += 1;
                var keping = value.keping;
                var tkeping = data.transaksi[no-1].total;
                var hkeping = data.historikeping[no-1].keping;
                var hasilkeping = keping-tkeping-hkeping;
                if(hasilkeping === 0){
                    rows = rows + '<tr id="edithidden'+ value.id +'" hidden>';
                    rows = rows + '<td hidden><input type="hidden" class="form-control" value="'+ value.id +'" id="editid_emas2" name="editid_emas2[]"></td>';
                    rows = rows + '<td>' + value.item_emas + '</td>';
                    rows = rows + '<td><span class="badge badge-primary-lighten">'+ value.jenis +'</span></td>';
                    rows = rows + '<td class="editgramasi2">' + value.gramasi + '</td>';
                    if(value.gramasi === '0.1'){
                        var harga_buyback = parseFloat(data.hargaharian.nolsatu_gram);
                        rows = rows + '<td class="editharga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="editharga_buyback_hidden2">' + data.hargaharian.nolsatu_gram + '</td>';
                    }else if(value.gramasi === '0.2'){
                        var harga_buyback = parseFloat(data.hargaharian.noldua_gram);
                        rows = rows + '<td class="editharga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="editharga_buyback_hidden2">' + data.hargaharian.noldua_gram + '</td>';
                    }else if(value.gramasi === '0.5'){
                        var harga_buyback = parseFloat(data.hargaharian.nollima_gram);
                        rows = rows + '<td class="editharga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="editharga_buyback_hidden2">' + data.hargaharian.nollima_gram + '</td>';
                    }else if(value.gramasi === '1'){
                        var harga_buyback = parseFloat(data.hargaharian.satu_gram);
                        rows = rows + '<td class="editharga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="editharga_buyback_hidden2">' + data.hargaharian.satu_gram + '</td>';
                    }else if(value.gramasi === '2'){
                        var harga_buyback = parseFloat(data.hargaharian.dua_gram);
                        rows = rows + '<td class="editharga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="editharga_buyback_hidden2">' + data.hargaharian.dua_gram + '</td>';
                    }else if(value.gramasi === '5'){
                        var harga_buyback = parseFloat(data.hargaharian.lima_gram);
                        rows = rows + '<td class="editharga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="editharga_buyback_hidden2">' + data.hargaharian.lima_gram + '</td>';
                    }else if(value.gramasi === '10'){
                        var harga_buyback = parseFloat(data.hargaharian.sepuluh_gram);
                        rows = rows + '<td class="editharga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="editharga_buyback_hidden2">' + data.hargaharian.sepuluh_gram + '</td>';
                    }
                    // rows = rows + '<td class="harga_buyback">' + (harga_buyback.toLocaleString("id-ID")) + '</td>';
                    // rows = rows + '<td hidden class="harga_buyback_hidden">' + value.harga_buyback + '</td>';
                    var keping = value.keping;
                    var tkeping = data.transaksi[no-1].total;
                    var hkeping = data.historikeping[no-1].keping;
                    var hasilkeping = keping-tkeping-hkeping;
                    rows = rows + '<td><input id="editkeping2'+ value.id +'" type="number" max="999" min="1" value="'+ hasilkeping +'" class="editkeping2 form-control" name="editkeping2[]" placeholder="Qty" style="width: 90px;" data-toggle="input-mask" data-mask-format="00" readonly></td>';
                    rows = rows + '<td class="editjumlah_gramasi2">' + (value.gramasi*hasilkeping).toFixed(1) + " Gram" + '</td>';
                    rows = rows + '<td class="editjumlah_buyback2">' + "Rp " + (harga_buyback*hasilkeping).toLocaleString("id-ID") + '</td>';
                    rows = rows + '<td hidden class="editjumlah_buyback_hidden2">' + harga_buyback*hasilkeping + '</td>';
                    rows = rows + '</tr>';
                }else{
                    rows = rows + '<tr id="edithidden'+ value.id +'">';
                    rows = rows + '<td hidden><input type="hidden" class="form-control" value="'+ value.id +'" id="editid_emas2" name="editid_emas2[]"></td>';
                    rows = rows + '<td>' + value.item_emas + '</td>';
                    rows = rows + '<td><span class="badge badge-primary-lighten">'+ value.jenis +'</span></td>';
                    rows = rows + '<td class="editgramasi2">' + value.gramasi + '</td>';
                    if(value.gramasi === '0.1'){
                        var harga_buyback = parseFloat(data.hargaharian.nolsatu_gram);
                        rows = rows + '<td class="editharga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="editharga_buyback_hidden2">' + data.hargaharian.nolsatu_gram + '</td>';
                    }else if(value.gramasi === '0.2'){
                        var harga_buyback = parseFloat(data.hargaharian.noldua_gram);
                        rows = rows + '<td class="editharga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="editharga_buyback_hidden2">' + data.hargaharian.noldua_gram + '</td>';
                    }else if(value.gramasi === '0.5'){
                        var harga_buyback = parseFloat(data.hargaharian.nollima_gram);
                        rows = rows + '<td class="editharga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="editharga_buyback_hidden2">' + data.hargaharian.nollima_gram + '</td>';
                    }else if(value.gramasi === '1'){
                        var harga_buyback = parseFloat(data.hargaharian.satu_gram);
                        rows = rows + '<td class="editharga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="editharga_buyback_hidden2">' + data.hargaharian.satu_gram + '</td>';
                    }else if(value.gramasi === '2'){
                        var harga_buyback = parseFloat(data.hargaharian.dua_gram);
                        rows = rows + '<td class="editharga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="editharga_buyback_hidden2">' + data.hargaharian.dua_gram + '</td>';
                    }else if(value.gramasi === '5'){
                        var harga_buyback = parseFloat(data.hargaharian.lima_gram);
                        rows = rows + '<td class="editharga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="editharga_buyback_hidden2">' + data.hargaharian.lima_gram + '</td>';
                    }else if(value.gramasi === '10'){
                        var harga_buyback = parseFloat(data.hargaharian.sepuluh_gram);
                        rows = rows + '<td class="editharga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="editharga_buyback_hidden2">' + data.hargaharian.sepuluh_gram + '</td>';
                    }
                    // rows = rows + '<td class="harga_buyback">' + (harga_buyback.toLocaleString("id-ID")) + '</td>';
                    // rows = rows + '<td hidden class="harga_buyback_hidden">' + value.harga_buyback + '</td>';
                    var keping = value.keping;
                    var tkeping = data.transaksi[no-1].total;
                    var hkeping = data.historikeping[no-1].keping;
                    var hasilkeping = keping-tkeping-hkeping;
                    rows = rows + '<td><input id="editkeping2'+ value.id +'" type="number" max="999" min="1" value="'+ hasilkeping +'" class="editkeping2 form-control" name="editkeping2[]" placeholder="Qty" style="width: 90px;" data-toggle="input-mask" data-mask-format="00" readonly></td>';
                    rows = rows + '<td class="editjumlah_gramasi2">' + (value.gramasi*hasilkeping).toFixed(1) + " Gram" + '</td>';
                    rows = rows + '<td class="editjumlah_buyback2">' + "Rp " + (harga_buyback*hasilkeping).toLocaleString("id-ID") + '</td>';
                    rows = rows + '<td hidden class="editjumlah_buyback_hidden2">' + harga_buyback*hasilkeping + '</td>';
                    rows = rows + '</tr>';
                }
            }
            );
            $('#editbodyemasselanjutnya').html(rows);
            $("#editfootemasselanjutnya").html('<tr><th>Total</th><th></th><th></th><th></th><th id="edittotal_keping2">0 Keping</th><th id="edittotal_gramasi2">0 Gram</th><th id="edittotal_buyback2">Rp 0</th></tr>');
            $('#edittotal_buyback2_hidden').val(data.totalbuyback).trigger('change')
            editgetTotal2();
            editkeping();
        }, complete: function () {
            $('#panel').loading('stop');
        }
    });
}
// ====================================================================================
function editgetTotal2(){
    total_keping = 0;
    $('.editkeping2').each(function(){
        total_keping += parseInt(this.value)
    });
    $('#edittotal_keping2').text(total_keping + " Keping");

    total_gramasi = 0;
    $('.editjumlah_gramasi2').each(function(){
        total_gramasi += parseFloat(this.innerHTML)
    });
    $('#edittotal_gramasi2').text(total_gramasi.toFixed(1) + " Gram");

    total_buyback = 0;
    $('.editjumlah_buyback_hidden2').each(function(){
        total_buyback += parseFloat(this.innerHTML)
    });
    format_total_buyback = total_buyback.toLocaleString("id-ID")
    $('#edittotal_buyback2').text("Rp "+ format_total_buyback);
    $('#edittotal_buyback2_hidden').val(total_buyback).trigger('change');
}
// ====================================================================================
editgetTotal2();
editkeping();
function editkeping(){
    $('.editkeping2').bind("change keyup",function(){
        var len = this.value.length; 
        if (len >= 3) { 
            this.value = this.value.substring(0, 3); 
        }
        var parent = $(this).parents('tr');
        var gramasi = $('.editgramasi2', parent);
        var jumlah_gramasi = $('.editjumlah_gramasi2', parent);
        var value_gramasi = parseInt(this.value) * parseFloat(gramasi.get(0).innerHTML||0);
        jumlah_gramasi.text(value_gramasi.toFixed(1)+" Gram");
    
        var asli_harga_buyback_hidden = $('.editharga_buyback_hidden2', parent);
        var format_harga_buyback = asli_harga_buyback_hidden.text().replace('.', '');
        var harga_buyback = asli_harga_buyback_hidden.text(format_harga_buyback)
        var jumlah_buyback = $('.editjumlah_buyback2', parent);
        var jumlah_buyback_hidden = $('.editjumlah_buyback_hidden2', parent);
        var value_buyback = parseInt(this.value) * parseFloat(harga_buyback.get(0).innerHTML||0);
        var format_jumlah_buyback = value_buyback.toLocaleString("id-ID")
        jumlah_buyback.text("Rp "+format_jumlah_buyback);
        jumlah_buyback_hidden.text(value_buyback);
        editgetTotal2();
    })
}

// ====================================================================================
// ====================================================================================
// ====================================================================================
$('#viewbtncetak').on('click', function(e){
    var print = $('#view_id_transaksi').val();
    var print2 = $('#id_pengajuan').val();
    window.open("/backend/print-transaksi/"+ print + "/" + print2);
})
// ====================================================================================
function viewtransaksi(kode){
    $('#panel').loading('toggle');
    var kode2 = $('#id_pengajuan').val();
    $.ajax({
        type: 'GET',
        url: '/backend/list-edit-transaksi/' + kode + '/' + kode2,
        success: function (data) {
            $.each(data.data, function (key, value) {
                $('#view_id_transaksi').val(value.idt);
                $('#view_kode_transaksi_hidden').val(value.kode_transaksi);
                $('#view_nomor_ba').text(': '+value.nomor_ba);
                $('#view_nama_lengkap').text(': '+value.nama_lengkap);
                $('#view_kode_pengajuan').text(': '+value.kode_pengajuan);
                $('#view_kode_transaksi').text(': '+value.kode_transaksi);
                $('#view_jenis_transaksi').text(': '+value.jenis_transaksi);
                // =====================================================
                if(value.jenis_transaksi === 'Pengajuan Baru'){
                    $('#divviewemassebelumnya').hide();
                    $('#divviewemasselanjutnya').show();
                }else if(value.jenis_transaksi === 'Perpanjangan'){
                    $('#divviewemassebelumnya').hide();
                    $('#divviewemasselanjutnya').show();
                }else if(value.jenis_transaksi === 'Pelunasan Sebagian'){
                    $('#divviewemassebelumnya').show();
                    $('#divviewemasselanjutnya').show();
                }else if(value.jenis_transaksi === 'Pelunasan'){
                    $('#divviewemassebelumnya').show();
                    $('#divviewemasselanjutnya').show();
                }
                // =====================================================
                $('#view_nominal_pinjaman').text(': Rp '+data.nominalpinjaman.toLocaleString("id-ID"));
                $('#view_pembayaran_pinjaman').text(': Rp '+data.fpembayaran_pinjaman2.toLocaleString("id-ID"));
                $('#view_sisa_pinjaman').text(': Rp '+data.sisapinjaman.toLocaleString("id-ID"));
                $('#view_pilihan_jasa').text(': '+value.pilihan_jasa);
                $('#view_perhitungan_jasa').text(': '+value.perhitungan_jasa);
                $('#view_jangka_waktu_permohonan').text(': '+value.jangka_waktu_permohonan+' Bulan');
                $('#view_jasa_gtc').text(': Rp '+parseInt(value.jasa_gtc).toLocaleString("id-ID"));
                $('#view_pembayaran_jasa').text(': '+value.pembayaran_jasa);
                var pembayaran = parseInt(data.fpembayaran_pinjaman2)+parseInt(value.jumlah_transfer);
                $('#view_pembayaran').text(': Rp '+pembayaran.toLocaleString("id-ID"));
                $('#view_sisa_pembayaran').text(': Rp '+parseInt(value.sisa_pembayaran).toLocaleString("id-ID"));
                $('#view_bukti_transfer').attr('src', '/img/bukti_transfer/'+value.upload_bukti_transfer);
                $('#view_buktitrf_upload').attr('src', '/img/buktitrf_upload/'+value.buktitrf_upload);
                $('#view_catatan').text(': '+value.catatan2);
            }
            );
        }, complete: function () {
            $('#panel').loading('stop');
            viewgetdataemasgtc();
            viewgetdataemasgtc2();
            $('#modal-view-transaksi').modal('show');
        }
    });
}
// ====================================================================================
function viewgetdataemasgtc() {
    $('#panel').loading('toggle');
    $('#viewbodyemassebelumnya').html('');
    $('#viewfootemassebelumnya').html('');
    var kode = $('#id_pengajuan').val();
    var kode2 = $('#view_kode_transaksi_hidden').val();
    $.ajax({
        type: 'GET',
        url: '/backend/cari-view-data-emas-transaksi-gtc/' + kode + '/' + kode2,
        success: function (data) {
            var rows = '';
            var no = 0;
            $.each(data.emas, function (key, value) {
                no += 1;
                var keping = value.keping;
                var tkeping = data.transaksi[no-1].total;
                var hasilkeping = keping-tkeping;
                if(hasilkeping === 0){
                    rows = rows + '<tr hidden>';
                    rows = rows + '<td hidden><input type="hidden" class="form-control" value="'+ value.id +'" id="viewid_emas" name="viewid_emas[]"></td>';
                    rows = rows + '<td>' + value.item_emas + '</td>';
                    rows = rows + '<td><span class="badge badge-primary-lighten">'+ value.jenis +'</span></td>';
                    rows = rows + '<td class="viewgramasi">' + value.gramasi + '</td>';
                    // rows = rows + '<td class="">' + data.transaksi[no-1].total + '</td>';
                    // var keping = value.keping;
                    // var tkeping = data.transaksi[no-1].total;
                    // var hasilkeping = keping-tkeping;
                    rows = rows + '<td><input id="viewkeping'+ value.id +'" type="number" max="999" min="1" value="'+ hasilkeping +'" class="viewkeping form-control" name="viewkeping[]" placeholder="Qty" style="width: 90px;" data-toggle="input-mask" data-mask-format="00" readonly></td>';
                    rows = rows + '<td class="viewjumlah_gramasi">' + (value.gramasi*value.keping).toFixed(1) +" Gram" + '</td>';
                    rows = rows + '<td><input id="viewpengurangan'+ value.id +'" type="number" max="999" min="1" value="'+ data.historikeping[no-1].keping +'" class="viewpengurangan form-control" name="viewpengurangan[]" placeholder="Qty" style="width: 90px;" data-toggle="input-mask" data-mask-format="00" readonly></td>';
                    rows = rows + '<td class="viewjumlah_gramasi_pengurangan">' + 0 +" Gram"+ '</td>';
                    rows = rows + '</tr>';
                }else{
                    rows = rows + '<tr>';
                    rows = rows + '<td hidden><input type="hidden" class="form-control" value="'+ value.id +'" id="viewid_emas" name="viewid_emas[]"></td>';
                    rows = rows + '<td>' + value.item_emas + '</td>';
                    rows = rows + '<td><span class="badge badge-primary-lighten">'+ value.jenis +'</span></td>';
                    rows = rows + '<td class="viewgramasi">' + value.gramasi + '</td>';
                    // rows = rows + '<td class="">' + data.transaksi[no-1].total + '</td>';
                    // var keping = value.keping;
                    // var tkeping = data.transaksi[no-1].total;
                    // var hasilkeping = keping-tkeping;
                    rows = rows + '<td><input id="viewkeping'+ value.id +'" type="number" max="999" min="1" value="'+ hasilkeping +'" class="viewkeping form-control" name="viewkeping[]" placeholder="Qty" style="width: 90px;" data-toggle="input-mask" data-mask-format="00" readonly></td>';
                    rows = rows + '<td class="viewjumlah_gramasi">' + (value.gramasi*value.keping).toFixed(1) +" Gram" + '</td>';
                    rows = rows + '<td><input id="viewpengurangan'+ value.id +'" type="number" max="999" min="1" value="'+ data.historikeping[no-1].keping +'" class="viewpengurangan form-control" name="viewpengurangan[]" placeholder="Qty" style="width: 90px;" data-toggle="input-mask" data-mask-format="00" readonly></td>';
                    rows = rows + '<td class="viewjumlah_gramasi_pengurangan">' + (value.gramasi*data.historikeping[no-1].keping).toFixed(1) +" Gram"+ '</td>';
                    rows = rows + '</tr>';
                }
                
            }
            );
            $('#viewbodyemassebelumnya').html(rows);
            $("#viewfootemassebelumnya").html('<tr><th>Total</th><th></th><th></th><th id="viewtotal_keping">'+ data.fkeping +" Keping" +'</th><th id="viewtotal_gramasi">'+ data.fgramasi.toFixed(1) +" Gram" +'</th><th id="viewtotal_pengurangan">0 Keping</th><th id="viewtotal_gramasi_pengurangan">0 Gram</th></tr>');
            viewgetTotal();
            viewpengurangan();
            viewgetTotal2();
            viewkeping();
        }, complete: function () {
            $('#panel').loading('stop');
        }
    });
}
// ====================================================================================
function viewgetTotal(){
    total_pengurangan = 0;
    $('.viewpengurangan').each(function(){
        total_pengurangan += parseInt(this.value)
    });
    $('#viewtotal_pengurangan').text(total_pengurangan + " Keping");

    total_gramasi_pengurangan = 0;
    $('.viewjumlah_gramasi_pengurangan').each(function(){
        total_gramasi_pengurangan += parseFloat(this.innerHTML)
    });
    $('#viewtotal_gramasi_pengurangan').text(total_gramasi_pengurangan.toFixed(1) + " Gram");
}
viewgetTotal();
viewpengurangan();
function viewpengurangan(){
    $('.viewpengurangan').bind("change keyup",function(){
        var len = this.value.length; 
        if (len >= 3) { 
            this.value = this.value.substring(0, 3); 
        }
        // ===============
        var kode = $('#id_pengajuan').val();
        $.ajax({
            type: 'GET',
            url: '/backend/cari-data-emas-transaksi-gtc/' + kode,
            success: function (data) {
                var no = 0;
                $.each(data.emas, function (key, value) {
                    no += 1;
                    var satu = $('#viewpengurangan'+value.id).val();
                    var dua = $('#viewkeping'+value.id).val();
                    var keping = value.keping;
                    var tkeping = data.transaksi[no-1].total;
                    var hasilkeping = keping-tkeping;
                    if(parseInt(satu) > parseInt(dua)){
                        $('#viewpengurangan'+value.id).val(hasilkeping).trigger("change")
                    }
                    var pengurangan = $('#viewpengurangan'+value.id).val();
                    var keping = $('#viewkeping'+value.id).val();
                    keping2 = keping-pengurangan;
                    $('#viewkeping2'+value.id).val(keping2).trigger("change");
                    if(keping2 === 0){
                        $('#viewhidden'+value.id).hide();
                    }else{
                        $('#viewhidden'+value.id).show();
                    }
                    });
            }, complete: function () {

            }
        });
        // ===============
        var parent = $(this).parents('tr');
        var gramasi = $('.viewgramasi', parent);
        var jumlah_gramasi = $('.viewjumlah_gramasi_pengurangan', parent);
        var value_gramasi = parseInt(this.value) * parseFloat(gramasi.get(0).innerHTML||0);
        jumlah_gramasi.text(value_gramasi.toFixed(1) +" Gram");
        viewgetTotal();
    })
}
// ====================================================================================
function viewgetdataemasgtc2() {
    $('#panel').loading('toggle');
    $('#viewbodyemasselanjutnya').html('');
    $('#viewfootemasselanjutnya').html('');
    var kode = $('#id_pengajuan').val();
    var kode2 = $('#view_kode_transaksi_hidden').val();
    $.ajax({
        type: 'GET',
        url: '/backend/cari-view-data-emas-transaksi-gtc/' + kode + '/' + kode2,
        success: function (data) {
            var rows = '';
            var no = 0;
            $.each(data.emas, function (key, value) {
                no += 1;
                var keping = value.keping;
                var tkeping = data.transaksi[no-1].total;
                var hkeping = data.historikeping[no-1].keping;
                var hasilkeping = keping-tkeping-hkeping;
                if(hasilkeping === 0){
                    rows = rows + '<tr id="viewhidden'+ value.id +'" hidden>';
                    rows = rows + '<td hidden><input type="hidden" class="form-control" value="'+ value.id +'" id="viewid_emas2" name="viewid_emas2[]"></td>';
                    rows = rows + '<td>' + value.item_emas + '</td>';
                    rows = rows + '<td><span class="badge badge-primary-lighten">'+ value.jenis +'</span></td>';
                    rows = rows + '<td class="viewgramasi2">' + value.gramasi + '</td>';
                    if(value.gramasi === '0.1'){
                        var harga_buyback = parseFloat(data.hargaharian.nolsatu_gram);
                        rows = rows + '<td class="viewharga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="viewharga_buyback_hidden2">' + data.hargaharian.nolsatu_gram + '</td>';
                    }else if(value.gramasi === '0.2'){
                        var harga_buyback = parseFloat(data.hargaharian.noldua_gram);
                        rows = rows + '<td class="viewharga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="viewharga_buyback_hidden2">' + data.hargaharian.noldua_gram + '</td>';
                    }else if(value.gramasi === '0.5'){
                        var harga_buyback = parseFloat(data.hargaharian.nollima_gram);
                        rows = rows + '<td class="viewharga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="viewharga_buyback_hidden2">' + data.hargaharian.nollima_gram + '</td>';
                    }else if(value.gramasi === '1'){
                        var harga_buyback = parseFloat(data.hargaharian.satu_gram);
                        rows = rows + '<td class="viewharga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="viewharga_buyback_hidden2">' + data.hargaharian.satu_gram + '</td>';
                    }else if(value.gramasi === '2'){
                        var harga_buyback = parseFloat(data.hargaharian.dua_gram);
                        rows = rows + '<td class="viewharga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="viewharga_buyback_hidden2">' + data.hargaharian.dua_gram + '</td>';
                    }else if(value.gramasi === '5'){
                        var harga_buyback = parseFloat(data.hargaharian.lima_gram);
                        rows = rows + '<td class="viewharga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="viewharga_buyback_hidden2">' + data.hargaharian.lima_gram + '</td>';
                    }else if(value.gramasi === '10'){
                        var harga_buyback = parseFloat(data.hargaharian.sepuluh_gram);
                        rows = rows + '<td class="viewharga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="viewharga_buyback_hidden2">' + data.hargaharian.sepuluh_gram + '</td>';
                    }
                    // rows = rows + '<td class="harga_buyback">' + (harga_buyback.toLocaleString("id-ID")) + '</td>';
                    // rows = rows + '<td hidden class="harga_buyback_hidden">' + value.harga_buyback + '</td>';
                    var keping = value.keping;
                    var tkeping = data.transaksi[no-1].total;
                    var hkeping = data.historikeping[no-1].keping;
                    var hasilkeping = keping-tkeping-hkeping;
                    rows = rows + '<td><input id="viewkeping2'+ value.id +'" type="number" max="999" min="1" value="'+ hasilkeping +'" class="viewkeping2 form-control" name="viewkeping2[]" placeholder="Qty" style="width: 90px;" data-toggle="input-mask" data-mask-format="00" readonly></td>';
                    rows = rows + '<td class="viewjumlah_gramasi2">' + (value.gramasi*hasilkeping).toFixed(1) + " Gram" + '</td>';
                    rows = rows + '<td class="viewjumlah_buyback2">' + "Rp " + (harga_buyback*hasilkeping).toLocaleString("id-ID") + '</td>';
                    rows = rows + '<td hidden class="viewjumlah_buyback_hidden2">' + harga_buyback*hasilkeping + '</td>';
                    rows = rows + '</tr>';
                }else{
                    rows = rows + '<tr id="viewhidden'+ value.id +'">';
                    rows = rows + '<td hidden><input type="hidden" class="form-control" value="'+ value.id +'" id="viewid_emas2" name="viewid_emas2[]"></td>';
                    rows = rows + '<td>' + value.item_emas + '</td>';
                    rows = rows + '<td><span class="badge badge-primary-lighten">'+ value.jenis +'</span></td>';
                    rows = rows + '<td class="viewgramasi2">' + value.gramasi + '</td>';
                    if(value.gramasi === '0.1'){
                        var harga_buyback = parseFloat(data.hargaharian.nolsatu_gram);
                        rows = rows + '<td class="viewharga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="viewharga_buyback_hidden2">' + data.hargaharian.nolsatu_gram + '</td>';
                    }else if(value.gramasi === '0.2'){
                        var harga_buyback = parseFloat(data.hargaharian.noldua_gram);
                        rows = rows + '<td class="viewharga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="viewharga_buyback_hidden2">' + data.hargaharian.noldua_gram + '</td>';
                    }else if(value.gramasi === '0.5'){
                        var harga_buyback = parseFloat(data.hargaharian.nollima_gram);
                        rows = rows + '<td class="viewharga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="viewharga_buyback_hidden2">' + data.hargaharian.nollima_gram + '</td>';
                    }else if(value.gramasi === '1'){
                        var harga_buyback = parseFloat(data.hargaharian.satu_gram);
                        rows = rows + '<td class="viewharga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="viewharga_buyback_hidden2">' + data.hargaharian.satu_gram + '</td>';
                    }else if(value.gramasi === '2'){
                        var harga_buyback = parseFloat(data.hargaharian.dua_gram);
                        rows = rows + '<td class="viewharga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="viewharga_buyback_hidden2">' + data.hargaharian.dua_gram + '</td>';
                    }else if(value.gramasi === '5'){
                        var harga_buyback = parseFloat(data.hargaharian.lima_gram);
                        rows = rows + '<td class="viewharga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="viewharga_buyback_hidden2">' + data.hargaharian.lima_gram + '</td>';
                    }else if(value.gramasi === '10'){
                        var harga_buyback = parseFloat(data.hargaharian.sepuluh_gram);
                        rows = rows + '<td class="viewharga_buyback2">' + ("Rp "+harga_buyback.toLocaleString("id-ID")) + '</td>';
                        rows = rows + '<td hidden class="viewharga_buyback_hidden2">' + data.hargaharian.sepuluh_gram + '</td>';
                    }
                    // rows = rows + '<td class="harga_buyback">' + (harga_buyback.toLocaleString("id-ID")) + '</td>';
                    // rows = rows + '<td hidden class="harga_buyback_hidden">' + value.harga_buyback + '</td>';
                    var keping = value.keping;
                    var tkeping = data.transaksi[no-1].total;
                    var hkeping = data.historikeping[no-1].keping;
                    var hasilkeping = keping-tkeping-hkeping;
                    rows = rows + '<td><input id="viewkeping2'+ value.id +'" type="number" max="999" min="1" value="'+ hasilkeping +'" class="viewkeping2 form-control" name="viewkeping2[]" placeholder="Qty" style="width: 90px;" data-toggle="input-mask" data-mask-format="00" readonly></td>';
                    rows = rows + '<td class="viewjumlah_gramasi2">' + (value.gramasi*hasilkeping).toFixed(1) + " Gram" + '</td>';
                    rows = rows + '<td class="viewjumlah_buyback2">' + "Rp " + (harga_buyback*hasilkeping).toLocaleString("id-ID") + '</td>';
                    rows = rows + '<td hidden class="viewjumlah_buyback_hidden2">' + harga_buyback*hasilkeping + '</td>';
                    rows = rows + '</tr>';
                }
            }
            );
            $('#viewbodyemasselanjutnya').html(rows);
            $("#viewfootemasselanjutnya").html('<tr><th>Total</th><th></th><th></th><th></th><th id="viewtotal_keping2">0 Keping</th><th id="viewtotal_gramasi2">0 Gram</th><th id="viewtotal_buyback2">Rp 0</th></tr>');
            $('#viewtotal_buyback2_hidden').val(data.totalbuyback).trigger('change')
            viewgetTotal2();
            viewkeping();
        }, complete: function () {
            $('#panel').loading('stop');
        }
    });
}
// ====================================================================================
function viewgetTotal2(){
    total_keping = 0;
    $('.viewkeping2').each(function(){
        total_keping += parseInt(this.value)
    });
    $('#viewtotal_keping2').text(total_keping + " Keping");

    total_gramasi = 0;
    $('.viewjumlah_gramasi2').each(function(){
        total_gramasi += parseFloat(this.innerHTML)
    });
    $('#viewtotal_gramasi2').text(total_gramasi.toFixed(1) + " Gram");

    total_buyback = 0;
    $('.viewjumlah_buyback_hidden2').each(function(){
        total_buyback += parseFloat(this.innerHTML)
    });
    format_total_buyback = total_buyback.toLocaleString("id-ID")
    $('#viewtotal_buyback2').text("Rp "+ format_total_buyback);
    $('#viewtotal_buyback2_hidden').val(total_buyback).trigger('change');
}
// ====================================================================================
viewgetTotal2();
viewkeping();
function viewkeping(){
    $('.viewkeping2').bind("change keyup",function(){
        var len = this.value.length; 
        if (len >= 3) { 
            this.value = this.value.substring(0, 3); 
        }
        var parent = $(this).parents('tr');
        var gramasi = $('.viewgramasi2', parent);
        var jumlah_gramasi = $('.viewjumlah_gramasi2', parent);
        var value_gramasi = parseInt(this.value) * parseFloat(gramasi.get(0).innerHTML||0);
        jumlah_gramasi.text(value_gramasi.toFixed(1)+" Gram");
    
        var asli_harga_buyback_hidden = $('.viewharga_buyback_hidden2', parent);
        var format_harga_buyback = asli_harga_buyback_hidden.text().replace('.', '');
        var harga_buyback = asli_harga_buyback_hidden.text(format_harga_buyback)
        var jumlah_buyback = $('.viewjumlah_buyback2', parent);
        var jumlah_buyback_hidden = $('.viewjumlah_buyback_hidden2', parent);
        var value_buyback = parseInt(this.value) * parseFloat(harga_buyback.get(0).innerHTML||0);
        var format_jumlah_buyback = value_buyback.toLocaleString("id-ID")
        jumlah_buyback.text("Rp "+format_jumlah_buyback);
        jumlah_buyback_hidden.text(value_buyback);
        viewgetTotal2();
    })
}

// ====================================================================================
// ====================================================================================
// ====================================================================================

function uploadbuktitrf(kode){
    $('#panel').loading('toggle');
    $.ajax({
        type: 'GET',
        url: '/backend/cari-data-transaksi/' + kode,
        success: function (data) {
            $.each(data, function(key, value){
                $('#buktitrf_id_transaksi').val(value.id)
                var now = new Date();
                var day = ("0" + now.getDate()).slice(-2);
                var month = ("0" + (now.getMonth() + 1)).slice(-2);
                var today = (day)+"/"+(month)+"/"+now.getFullYear();
                $('#buktitrf_tgl').val(today);
                $('#old_buktitrf_upload').val(value.buktitrf_upload);
            })
        },
        complete: function(){
            $('#modal-upload-buktitrf').modal('show')
            $('#panel').loading('stop')
        }
    })
}
$('#btnbuktitrf').on('click', function(e){
    if ($('#buktitrf_tgl').val() == '' || $('#buktitrf_nominal').val() == '' || $('#buktitrf_upload').val() == '') {
        swalWithBootstrapButtons.fire({
            title: 'Oops',
            text: 'Data tidak boleh kosog',
            confirmButtonText: 'OK'
        });
        return false;
    } else {
        $('#panel').loading('toggle');
        $('#formbuktitrf').on('submit', function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name=_token]').val()
                }
            });
            var formData = new FormData(this);
            var kode = $('#buktitrf_id_transaksi').val();
                $.ajax({
                url: '/backend/upload-buktitrf/'+kode,
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function () {
                    swalWithBootstrapButtons.fire({
                        title: 'Info',
                        text: 'Berhasil Upload Bukti Transfer',
                        confirmButtonText: 'OK'
                    });
                }, complete: function () {
                    var now = new Date();
                    var day = ("0" + now.getDate()).slice(-2);
                    var month = ("0" + (now.getMonth() + 1)).slice(-2);
                    var today = (day)+"/"+(month)+"/"+now.getFullYear();
                    $('#buktitrf_tgl').val(today);
                    $('#buktitrf_nominal').val('');
                    $('#buktitrf_upload').val('');
                    $('#modal-upload-buktitrf').modal('hide');
                    $('#panel').loading('stop');
                    $('#list-data').DataTable().ajax.reload();
                }
            });
        })
    }
})
// ========================================================================
$(function(){
    $('#jasadiakhir_pembayaran').bind("change keyup", function(){
        $('#jasadiakhir_pembayaran_hidden').val($(this).val().replace(/[^,\d]/g, '').toString()).trigger('change');
    });
})
// ========================================================================
function jasadiakhir(kode){
    $('#panel').loading('toggle');
    var kode2 = $('#id_pengajuan').val();
    $.ajax({
        type: 'GET',
        url: '/backend/jasadiakhir-transaksi/' + kode + '/' + kode2,
        success: function (data) {
            $.each(data.jenisjasagtc, function(key, item){
                $('#jasadiakhir_jangka_waktu_1').val(item.jangka_waktu_1)
                $('#jasadiakhir_pengali_kurangdari_satudelapan_1').val(item.pengali_kurangdari_satudelapan_1)
                $('#jasadiakhir_pengali_diatas_dua_1').val(item.pengali_diatas_dua_1)
                $('#jasadiakhir_jangka_waktu_2').val(item.jangka_waktu_2)
                $('#jasadiakhir_pengali_kurangdari_satudelapan_2').val(item.pengali_kurangdari_satudelapan_2)
                $('#jasadiakhir_pengali_diatas_dua_2').val(item.pengali_diatas_dua_2)
                $('#jasadiakhir_jangka_waktu_3').val(item.jangka_waktu_3)
                $('#jasadiakhir_pengali_kurangdari_satudelapan_3').val(item.pengali_kurangdari_satudelapan_3)
                $('#jasadiakhir_pengali_diatas_dua_3').val(item.pengali_diatas_dua_3)
                $('#jasadiakhir_jangka_waktu_4').val(item.jangka_waktu_4)
                $('#jasadiakhir_pengali_kurangdari_satudelapan_4').val(item.pengali_kurangdari_satudelapan_4)
                $('#jasadiakhir_pengali_diatas_dua_4').val(item.pengali_diatas_dua_4)
            })
            $.each(data.data, function(key, value){
                // $('#divjasadiakhiremassebelumnya').hide();
                // $('#divjasadiakhiremasselanjutnya').hide();
                // $('#divjasadiakhirpelunasan').hide();
                // $('#divjasadiakhirtransaksi').hide();
                // $('#divjasadiakhirpembayaran').hide();
                // $('#divjasadiakhirbtnsimpan').hide();
                $('#jasadiakhir_id_transaksi').val(value.idt);
                $('#jasadiakhir_id_pengajuan').val(value.kode_pengajuan);
                $('#jasadiakhir_id_perwada').val(value.id_perwada);
                $('#jasadiakhir_nama_perwada').val(data.namaperwada.nama);
                $('#jasadiakhir_kode_pengajuan').val(value.kode_pengajuan);
                $('#jasadiakhir_kode_transaksi').val(value.kode_transaksi);
                // ======================================================================
                $('#jasadiakhir_jangka_waktu_permohonan').change(function(){
                    if($(this).val() === '0.5'){
                        if(parseFloat(value.total_gramasi)>=0.1 && parseFloat(value.total_gramasi)<=49.9){
                            jangka_waktu = $('#jasadiakhir_jangka_waktu_1').val()
                            numjangka_waktu = parseFloat(jangka_waktu)
                            pengali = $('#jasadiakhir_pengali_kurangdari_satudelapan_1').val()
                            numpengali = parseFloat(pengali)
                            hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*data.totalbuyback).toFixed(0)
                            newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                            bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                            hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                            $('#jasadiakhir_jasa_gtc').val(hasiljasa).trigger("change")
                            $('#jasadiakhir_pembayaran_jasa').val('Transfer').trigger("change")
                        }else if(value.total_gramasi>=50){
                            jangka_waktu = $('#jasadiakhir_jangka_waktu_1').val()
                            numjangka_waktu = parseFloat(jangka_waktu)
                            pengali = $('#jasadiakhir_pengali_diatas_dua_1').val()
                            numpengali = parseFloat(pengali)
                            hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*data.totalbuyback).toFixed(0)
                            newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                            bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                            hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                            $('#jasadiakhir_jasa_gtc').val(hasiljasa).trigger("change")
                            $('#jasadiakhir_pembayaran_jasa').val('Transfer').trigger("change")
                        }
                    }else if($(this).val() === '1'){
                        if(parseFloat(value.total_gramasi)>=0.1 && parseFloat(value.total_gramasi)<=49.9){
                            jangka_waktu = $('#jasadiakhir_jangka_waktu_2').val()
                            numjangka_waktu = parseFloat(jangka_waktu)
                            pengali = $('#jasadiakhir_pengali_kurangdari_satudelapan_2').val()
                            numpengali = parseFloat(pengali)
                            hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*data.totalbuyback).toFixed(0)
                            newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                            bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                            hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                            $('#jasadiakhir_jasa_gtc').val(hasiljasa).trigger("change")
                            $('#jasadiakhir_pembayaran_jasa').val('Transfer').trigger("change")
                        }else if(value.total_gramasi>=50){
                            jangka_waktu = $('#jasadiakhir_jangka_waktu_2').val()
                            numjangka_waktu = parseFloat(jangka_waktu)
                            pengali = $('#jasadiakhir_pengali_diatas_dua_2').val()
                            numpengali = parseFloat(pengali)
                            hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*data.totalbuyback).toFixed(0)
                            newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                            bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                            hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                            $('#jasadiakhir_jasa_gtc').val(hasiljasa).trigger("change")
                            $('#jasadiakhir_pembayaran_jasa').val('Transfer').trigger("change")
                        }
                    }else if($(this).val() === '2'){
                        if(parseFloat(value.total_gramasi)>=0.1 && parseFloat(value.total_gramasi)<=49.9){
                            jangka_waktu = $('#jasadiakhir_jangka_waktu_3').val()
                            numjangka_waktu = parseFloat(jangka_waktu)
                            pengali = $('#jasadiakhir_pengali_kurangdari_satudelapan_3').val()
                            numpengali = parseFloat(pengali)
                            hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*data.totalbuyback).toFixed(0)
                            newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                            bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                            hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                            $('#jasadiakhir_jasa_gtc').val(hasiljasa).trigger("change")
                            $('#jasadiakhir_pembayaran_jasa').val('Transfer').trigger("change")
                        }else if(value.total_gramasi>=50){
                            jangka_waktu = $('#jasadiakhir_jangka_waktu_3').val()
                            numjangka_waktu = parseFloat(jangka_waktu)
                            pengali = $('#jasadiakhir_pengali_diatas_dua_3').val()
                            numpengali = parseFloat(pengali)
                            hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*data.totalbuyback).toFixed(0)
                            newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                            bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                            hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                            $('#jasadiakhir_jasa_gtc').val(hasiljasa).trigger("change")
                            $('#jasadiakhir_pembayaran_jasa').val('Transfer').trigger("change")
                        }
                    }else{
                        $('#jasadiakhir_jasa_gtc').val('').trigger("change")
                        $('#pembayaran_jasa_manual').val('').trigger("change");
                        $('#div_nominal_potongan').hide()
                        $('#nominal_potongan').val('').trigger("change");
                        $('#jumlah_yang_di_transfer').val('').trigger("change");
                        $('#jasadiakhir_pembayaran_jasa').val('Transfer').trigger("change")
                    }
                });
                // ==========================================================================
                $('#jasadiakhir_jenis_transaksi').show();
                $('#hidden_jasadiakhir_jenis_transaksi').hide();
                // $('#jasadiakhir_nominal_pinjaman').val(data.nominalpinjaman.toLocaleString("id-ID"));
                // $('#hidden_jasadiakhir_nominal_pinjaman').val(data.nominalpinjaman);
                // $('#jasadiakhir_pembayaran_pinjaman').val(data.fpembayaran_pinjaman2.toLocaleString("id-ID"));
                // $('#hidden_jasadiakhir_pembayaran_pinjaman').val(data.fpembayaran_pinjaman2);
                // $('#jasadiakhir_sisa_pinjaman').val(data.sisapinjaman.toLocaleString("id-ID"));
                // $('#hidden_jasadiakhir_sisa_pinjaman').val(data.sisapinjaman);
                $('#jasadiakhir_plafond_pinjaman').val(parseInt(value.jasa_gtc).toLocaleString("id-ID"));
                $('#jasadiakhir_plafond_pinjaman_hidden').val(value.plafond_pinjaman);
                $('#jasadiakhir_pilihan_jasa').val(value.pilihan_jasa);
                $('#jasadiakhir_perhitungan_jasa').val(value.perhitungan_jasa);
                $('#jasadiakhir_jangka_waktu_permohonan').val(value.jangka_waktu_permohonan);
                $('#jasadiakhir_jasa_gtc').val(parseInt(value.jasa_gtc).toLocaleString("id-ID"));
                $('#old_jasadiakhir_upload_bukti_transfer').val(value.upload_bukti_transfer);
                // var pembayaran = parseInt(data.fpembayaran_pinjaman2)+parseInt(value.jumlah_transfer);
                // $('#jasadiakhir_pembayaran').val(pembayaran.toLocaleString("id-ID"));
                // $('#jasadiakhir_pembayaran_hidden').val(pembayaran);
            })
        },
        complete: function(){
            $('#modal-jasadiahir-transaksi').modal('show');
            $('#panel').loading('stop')
        }
    })
}
// ========================================================================
$('#btnsimpan_jasadiakhir').on('click', function(e){
    var jasagtc = $('#jasadiakhir_jasa_gtc').val().replace(/[^,\d]/g, '').toString();
    var pembayaran = $('#jasadiakhir_pembayaran_hidden').val();
    if(parseInt(pembayaran)<parseInt(jasagtc)){
        swalWithBootstrapButtons.fire({
            title: 'Oops',
            text: 'Pembayaran kurang',
            confirmButtonText: 'OK'
        });
        return false;
    }else{
        $('#panel').loading('toggle');
        $('#formjasadiakhirtransaksi').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name=_token]').val()
                }
            });
            var id_transaksi = $('#jasadiakhir_id_transaksi').val();
            var formData = new FormData(this);
            $.ajax({
                url: '/backend/simpan-jasadiakhir-transaksi/' + id_transaksi,
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
                    $('#list-data').DataTable().ajax.reload();
                    $('#modal-jasadiahir-transaksi').modal('hide');
                    $('#jasadiakhir_id_transaksi').val('');
                    $('#jasadiakhir_id_pengajuan').val('');
                    $('#jasadiakhir_id_perwada').val('');
                    $('#jasadiakhir_kode_pengajuan').val('');
                    $('#jasadiakhir_kode_transaksi').val('');
                    $('#jasadiakhir_nominal_pinjaman').val('');
                    $('#hidden_jasadiakhir_nominal_pinjaman').val('');
                    $('#jasadiakhir_pembayaran_pinjaman').val('');
                    $('#hidden_jasadiakhir_pembayaran_pinjaman').val('');
                    $('#jasadiakhir_sisa_pinjaman').val('');
                    $('#hidden_jasadiakhir_sisa_pinjaman').val('');
                    $('#jasadiakhir_pilihan_jasa').val('');
                    $('#jasadiakhir_perhitungan_jasa').val('');
                    $('#jasadiakhir_jangka_waktu_permohonan').val('');
                    $('#jasadiakhir_jasa_gtc').val('');
                    $('#jasadiakhir_hidden_upload_bukti_transfer').val('');
                    // var pembayaran = parseInt(data.fpembayaran_pinjaman2)+parseInt(value.jumlah_transfer);
                    $('#jasadiakhir_pembayaran').val('');
                    $('#jasadiakhir_pembayaran_hidden').val('');
                }
            });
        });
    }
})
// ========================================================================
function aprovalopr(kode){
    $('#panel').loading('toggle');
    $.ajax({
        type: 'GET',
        url: '/backend/cari-data-transaksi/' + kode,
        success: function (data) {
            $.each(data, function(key, value){
                $('#aprovalopr_id_transaksi').val(value.id)
            })
        },
        complete: function(){
            $('#warning-aproval-opr').modal('show')
            $('#panel').loading('stop')
        }
    })
}
$('#btnaprovalopr').on('click', function(e){
    if ($('#aprovalopr_id_transaksi').val() == '') {
        swalWithBootstrapButtons.fire({
            title: 'Oops',
            text: 'Data tidak boleh kosog',
            confirmButtonText: 'OK'
        });
        return false;
    } else {
        $('#panel').loading('toggle');
        $('#formaprovalopr').on('submit', function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name=_token]').val()
                }
            });
            var formData = new FormData(this);
            var kode = $('#aprovalopr_id_transaksi').val();
                $.ajax({
                url: '/backend/aproval-opr/'+kode,
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function () {
                    swalWithBootstrapButtons.fire({
                        title: 'Info',
                        text: 'Berhasil Approval OPR',
                        confirmButtonText: 'OK'
                    });
                }, complete: function () {
                    $('#warning-aproval-opr').modal('hide');
                    $('#panel').loading('stop');
                    $('#list-data').DataTable().ajax.reload();
                }
            });
        })
    }
})
// =======================================================================
function aprovalkeu(kode){
    $('#panel').loading('toggle');
    $.ajax({
        type: 'GET',
        url: '/backend/cari-data-transaksi/' + kode,
        success: function (data) {
            $.each(data, function(key, value){
                $('#aprovalkeu_id_transaksi').val(value.id)
            })
        },
        complete: function(){
            $('#warning-aproval-keu').modal('show')
            $('#panel').loading('stop')
        }
    })
}
$('#btnaprovalkeu').on('click', function(e){
    if ($('#aprovalkeu_id_transaksi').val() == '') {
        swalWithBootstrapButtons.fire({
            title: 'Oops',
            text: 'Data tidak boleh kosog',
            confirmButtonText: 'OK'
        });
        return false;
    } else {
        $('#panel').loading('toggle');
        $('#formaprovalkeu').on('submit', function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name=_token]').val()
                }
            });
            var formData = new FormData(this);
            var kode = $('#aprovalkeu_id_transaksi').val();
            var id_anggota = $('#id_anggota').val();
                $.ajax({
                url: '/backend/aproval-keu/'+kode +'/'+id_anggota,
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function () {
                    swalWithBootstrapButtons.fire({
                        title: 'Info',
                        text: 'Berhasil Approval KEU',
                        confirmButtonText: 'OK'
                    });
                }, complete: function () {
                    $('#warning-aproval-keu').modal('hide');
                    $('#panel').loading('stop');
                    $('#list-data').DataTable().ajax.reload();
                }
            });
        })
    }
})

function pelunasan(kode){
    $('#panel').loading('toggle');
    $.ajax({
        type: 'GET',
        url: '/backend/cek-pelunasan-gtc/' + kode,
        success: function (data) {
            if(!data.pelunasan){
                swalWithBootstrapButtons.fire({
                    title: 'Peringatan',
                    text: 'Belum Ada Transaksi "Pelunasan"',
                    confirmButtonText: 'OK'
                });
                return false;
            }else{
                swalWithBootstrapButtons.fire({
                    title: 'Konfirmasi Pelunasan',
                    text: "Klik Ya Untuk Lanjut!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Lunas!',
                    cancelButtonText: 'Tidak',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: '/backend/pelunasan-gtc/' + kode,
                            success: function () {
                                swalWithBootstrapButtons.fire(
                                    'Success!',
                                    'Pelunasan Berhasil.',
                                    'success'
                                )
                                $('#list-data').DataTable().ajax.reload();
                            }
                        });
                    }
                })
            }
        },
        complete: function(){
            $('#panel').loading('stop');
            $('#list-data').DataTable().ajax.reload();
        }
    })
}