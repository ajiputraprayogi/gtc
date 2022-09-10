$(function () {
    var myCondition = perwada != 1;
    var t = $('#list-data').DataTable({
        initComplete: function () {
            var api = this.api();
            
            if ( myCondition ) {
                // Hide Office column
                api.column(13).visible( false );
                api.column(14).visible( false );
            }
        },
        columnDefs: [{
          searchable: false,
          orderable: false,
          targets: 0
        }],
        processing: true,
        serverSide: false,
        scrollX:!0,
        language:{
        paginate:{
            previous:"<i class='mdi mdi-chevron-left'>",
            next:"<i class='mdi mdi-chevron-right'>",
        }
        },
        ajax: '/backend/pengajuan-gtc',
        columns: [
            
            {
                data: 'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                    // return total;
                }
            },
            { data: 'tanggal_pengajuan', name: 'tanggal_pengajuan', },
            { data: 'id_perwada', name: 'id_perwada' },
            { data: 'kode_pengajuan', name: 'kode_pengajuan' },
            { data: 'nomor_ba', name: 'nomor_ba' },
            { data: 'nama_lengkap', name: 'nama_lengkap' },
            {
                render: function (data, type, row) {
                    return row.total_gramasi.toFixed(1)
                }
            },
            { data: 'total_buyback', render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' ), name: 'total_buyback' },
            { data: 'plafond_pinjaman', render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' ), name: 'plafond_pinjaman' },
            { data: 'pengajuan', render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' ), name: 'pengajuan' },
            {
                render: function (data, type, row) {
                    if(row.status_akhir === null){
                        return 'Pengajuan'
                    }else{
                        return row.status_akhir
                    }
                }
            },
            {
                render: function(data, type, row) {
                    if(row.aproval_bm === 'Proses'){
                        if(row.aproval_opr === 'Proses'){
                            if(row.aproval_keu === 'Disetujui'){
                                return 'Disetujui'
                            }else if(row.aproval_keu === null){
                                return 'BM / OPR'
                            }else{
                                return 'Tidak disetujui'
                            }
                        }else if(row.aproval_opr === null){
                            return 'BM'
                        }else{
                            return 'Belum Lengkap'
                        }
                    }else if(row.aproval_bm === null){
                        return 'Tunggu'
                    }else{
                        return 'Belum Lengkap'
                    }
                }
            },
            { 
                render: function(data, type, row) {
                    return '<a href="/backend/aproval-bm-pengajuan-gtc/'+ row['id'] +'" class="action-icon"> <i class="mdi mdi-book-arrow-right-outline"></i></a>'
                }
            },
            {
                render: function(data, type, row){
                    return '<a href="/backend/aproval-opr-pengajuan-gtc/'+ row['id'] +'" class="action-icon"> <i class="mdi mdi-book-check"></i></a>'
                }
            },
            {
                render: function(data, type, row){
                    return '<a href="/backend/aproval-keu-pengajuan-gtc/'+ row['id'] +'" class="action-icon"> <i class="mdi mdi-book-check-outline"></i></a>'
                }
            },
            {
                render: function (data, type, row) {
                    if(perwada !== 1){
                        return '<a href="/backend/view-pengajuan-gtc/'+ row['id'] +'" class="action-icon"> <i class="mdi mdi-card-search"></i></a>'
                    }else{
                        return '<a href="/backend/view-pengajuan-gtc/'+ row['id'] +'" class="action-icon"> <i class="mdi mdi-card-search"></i></a><a href="/backend/edit-pengajuan-gtc/'+ row['id'] +'" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a><a onclick="hapusdatapengajuangtc('+ row['id'] +')" class="action-icon"> <i class="mdi mdi-delete"></i></a>'
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
    t.on('order.dt search.dt', function() {
        var rows = t.rows().count();
        t.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = rows--;
        });
    }).draw();
});

// ====================================================================
from_date = new DateTime($('#from_date'), {
    format: 'YYYY-MM-DD'
});
to_date = new DateTime($('#to_date'), {
    format: 'YYYY-MM-DD'
});

$('#filter').click(function(){ 
    var from_date = $('#from_date').val(); 
    var to_date = $('#to_date').val(); 
    console.log(from_date,to_date); 
    if(from_date != '' &&  to_date != ''){ 
        $('#list-data').DataTable().destroy(); 
        load_data(from_date, to_date); 
    } 
    else{ 
        alert('Both Date is required'); 
    } 
}); 

$('#refresh').click(function(){ 
    $('#from_date').val(''); 
    $('#to_date').val(''); 
    $('#list-data').DataTable().destroy(); 
    load_data(); 
});

function load_data(from_date = '', to_date = ''){ 
    var myCondition = perwada != 1;
    var t = $('#list-data').DataTable({
        initComplete: function () {
            var api = this.api();
            
            if ( myCondition ) {
                // Hide Office column
                api.column(13).visible( false );
                api.column(14).visible( false );
            }
        },
        columnDefs: [{
        searchable: false,
        orderable: false,
        targets: 0
        }],
        processing: true,
        serverSide: false,
        scrollX:!0,
        language:{
        paginate:{
            previous:"<i class='mdi mdi-chevron-left'>",
            next:"<i class='mdi mdi-chevron-right'>",
        }
        },
        ajax: {
            url: '/backend/pengajuan-gtc', 
            data:{from_date:from_date, to_date:to_date} 
        },
        columns: [
            
            {
                data: 'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                    // return total;
                }
            },
            { data: 'tanggal_pengajuan', name: 'tanggal_pengajuan', },
            { data: 'id_perwada', name: 'id_perwada' },
            { data: 'kode_pengajuan', name: 'kode_pengajuan' },
            { data: 'nomor_ba', name: 'nomor_ba' },
            { data: 'nama_lengkap', name: 'nama_lengkap' },
            {
                render: function (data, type, row) {
                    return row.total_gramasi.toFixed(1)
                }
            },
            { data: 'total_buyback', render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' ), name: 'total_buyback' },
            { data: 'plafond_pinjaman', render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' ), name: 'plafond_pinjaman' },
            { data: 'pengajuan', render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' ), name: 'pengajuan' },
            {
                render: function (data, type, row) {
                    if(row.status_akhir === null){
                        return 'Pengajuan'
                    }else{
                        return row.status_akhir
                    }
                }
            },
            {
                render: function(data, type, row) {
                    if(row.aproval_bm === 'Proses'){
                        if(row.aproval_opr === 'Proses'){
                            if(row.aproval_keu === 'Disetujui'){
                                return 'Disetujui'
                            }else if(row.aproval_keu === null){
                                return 'BM / OPR'
                            }else{
                                return 'Tidak disetujui'
                            }
                        }else if(row.aproval_opr === null){
                            return 'BM'
                        }else{
                            return 'Belum Lengkap'
                        }
                    }else if(row.aproval_bm === null){
                        return 'Tunggu'
                    }else{
                        return 'Belum Lengkap'
                    }
                }
            },
            { 
                render: function(data, type, row) {
                    return '<a href="/backend/aproval-bm-pengajuan-gtc/'+ row['id'] +'" class="action-icon"> <i class="mdi mdi-book-arrow-right-outline"></i></a>'
                }
            },
            {
                render: function(data, type, row){
                    return '<a href="/backend/aproval-opr-pengajuan-gtc/'+ row['id'] +'" class="action-icon"> <i class="mdi mdi-book-check"></i></a>'
                }
            },
            {
                render: function(data, type, row){
                    return '<a href="/backend/aproval-keu-pengajuan-gtc/'+ row['id'] +'" class="action-icon"> <i class="mdi mdi-book-check-outline"></i></a>'
                }
            },
            {
                render: function (data, type, row) {
                    if(perwada !== 1){
                        return '<a href="/backend/view-pengajuan-gtc/'+ row['id'] +'" class="action-icon"> <i class="mdi mdi-card-search"></i></a>'
                    }else{
                        return '<a href="/backend/view-pengajuan-gtc/'+ row['id'] +'" class="action-icon"> <i class="mdi mdi-card-search"></i></a><a href="/backend/edit-pengajuan-gtc/'+ row['id'] +'" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a><a onclick="hapusdatapengajuangtc('+ row['id'] +')" class="action-icon"> <i class="mdi mdi-delete"></i></a>'
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
    t.on('order.dt search.dt', function() {
        var rows = t.rows().count();
        t.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = rows--;
        });
    }).draw();
}

// ====================================================================
function hapusdatapengajuangtc(kode) {
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
                url: '/backend/pengajuan-gtc/' + kode,
                data: {
                    'token': $('input[name=_token]').val(),
                },
                success: function () {
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Data Berhasil Dihapus.',
                        'success'
                    );
                    $('#panel').loading('stop');
                    location.reload();
                }
            })
        }
    })
}

// var kode = 'A.1234567.1'
// $('#list-data').DataTable({
//     processing: true,
//     serverSide: true,
//     scrollX:!0,
//     language:{
//     paginate:{
//         previous:"<i class='mdi mdi-chevron-left'>",
//         next:"<i class='mdi mdi-chevron-right'>",
//     }
//     },
//     // drawCallback:function(){
//     //     $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
//     // }
//     order: [[0, "desc"]],
//     ajax: '/backend/list-transaksi/' + kode,
//     columns: [
//         {
//             data: 'id', render: function (data, type, row, meta) {
//                 return meta.row + meta.settings._iDisplayStart + 1;
//             }
//         },
//         { data: 'kode_transaksi', name: 'kode_transaksi' },
//         { data: 'jenis_transaksi', name: 'jenis_transaksi' },
//         { data: 'pilihan_jasa', name: 'pilihan_jasa' },
//         { data: 'perhitungan_jasa', name: 'perhitungan_jasa' },
//         { data: 'tgl_sebelumnya', name: 'tgl_sebelumnya' },
//         {
//             data: 'jangka_waktu_permohonan', name: 'jangka_waktu_permohonan',
//             "render": function(data, type, row, meta){
//                 if(type === 'display'){
//                     data = data + ((data == 1) ? " Bulan" : " Bulan");
//                 }
//                 return data;
//                 }
//         },
//         { data: 'jatuh_tempo', name: 'jatuh_tempo' },
//         { data: 'jasa_gtc', render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' ), name: 'jasa_gtc' },
//         { data: 'pembayaran_jasa_manual', render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' ), name: 'pembayaran_jasa_manual' },
//         { data: 'sbte', name: 'sbte' },
//         { data: 'pilihan_jasa', name: 'pilihan_jasa' },
//         {
//             render: function (data, type, row) {
//                 if(perwada !== 1){
//                     return '<a onclick="viewtransaksi('+ row['id'] +')" class="action-icon" title="View Transaksi"> <i class="mdi mdi-card-search"></i></a> <a onclick="jasadiakhir('+ row['id'] +')" class="action-icon" title="Transaksi Jasa Di akhir"> <i class="mdi mdi-receipt"></i></a> <a href="javascript:void(0);" class="action-icon" data-bs-container="#tooltip-container2" data-bs-toggle="tooltip" title="Cetak SBTE"> <i class="mdi mdi-printer-outline"></i></a>'
//                 }else{
//                     return '<a onclick="viewtransaksi('+ row['id'] +')" class="action-icon" title="View Transaksi"> <i class="mdi mdi-card-search"></i></a> <a onclick="uploadbuktitrf('+ row['id'] +')" class="action-icon" title="Upload trf"> <i class="mdi mdi-file-upload"></i></a><a onclick="edittransaksi('+ row['id'] +')" class="action-icon" title="Edit Transaksi"> <i class="mdi mdi-file-edit"></i></a> <a onclick="jasadiakhir('+ row['id'] +')" class="action-icon" title="Transaksi Jasa Di akhir"> <i class="mdi mdi-receipt"></i></a><a onclick="aprovalopr('+ row['id'] +')" class="action-icon" title="Aproval OPR"> <i class="mdi mdi-check-circle"></i></a><a onclick="aprovalkeu('+ row['id'] +')" class="action-icon" title="Aproval Kasir"> <i class="mdi mdi-check-circle"></i></a> <a href="/backend/cetak-sbte/'+ row['id'] +'/'+ row['kode_pengajuan'] +'" class="action-icon" title="Cetak SBTE"> <i class="mdi mdi-printer-outline"></i></a>'
//                 }
//             },
//             "className": 'text-center',
//             "orderable": false,
//             "data": null,
//         },
//     ],
//     pageLength: 10,
//     lengthMenu: [[5, 10, 20], [5, 10, 20]]
// });
// $('#refresh').click(function(){ 
//     $('#from_date').val(''); 
//     $('#to_date').val(''); 
//     $('#list-data').DataTable().destroy(); 
//     load_data(); 
// });

// function load_data(){
//     var kode = 'A.1234567.2'
//     $('#list-data').DataTable({
//         processing: true,
//         serverSide: true,
//         scrollX:!0,
//         language:{
//         paginate:{
//             previous:"<i class='mdi mdi-chevron-left'>",
//             next:"<i class='mdi mdi-chevron-right'>",
//         }
//         },
//         // drawCallback:function(){
//         //     $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
//         // }
//         order: [[0, "desc"]],
//         ajax: '/backend/list-transaksi/' + kode,
//         columns: [
//             {
//                 data: 'id', render: function (data, type, row, meta) {
//                     return meta.row + meta.settings._iDisplayStart + 1;
//                 }
//             },
//             { data: 'kode_transaksi', name: 'kode_transaksi' },
//             { data: 'jenis_transaksi', name: 'jenis_transaksi' },
//             { data: 'pilihan_jasa', name: 'pilihan_jasa' },
//             { data: 'perhitungan_jasa', name: 'perhitungan_jasa' },
//             { data: 'tgl_sebelumnya', name: 'tgl_sebelumnya' },
//             {
//                 data: 'jangka_waktu_permohonan', name: 'jangka_waktu_permohonan',
//                 "render": function(data, type, row, meta){
//                     if(type === 'display'){
//                         data = data + ((data == 1) ? " Bulan" : " Bulan");
//                     }
//                     return data;
//                     }
//             },
//             { data: 'jatuh_tempo', name: 'jatuh_tempo' },
//             { data: 'jasa_gtc', render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' ), name: 'jasa_gtc' },
//             { data: 'pembayaran_jasa_manual', render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' ), name: 'pembayaran_jasa_manual' },
//             { data: 'sbte', name: 'sbte' },
//             { data: 'pilihan_jasa', name: 'pilihan_jasa' },
//             {
//                 render: function (data, type, row) {
//                     if(perwada !== 1){
//                         return '<a onclick="viewtransaksi('+ row['id'] +')" class="action-icon" title="View Transaksi"> <i class="mdi mdi-card-search"></i></a> <a onclick="jasadiakhir('+ row['id'] +')" class="action-icon" title="Transaksi Jasa Di akhir"> <i class="mdi mdi-receipt"></i></a> <a href="javascript:void(0);" class="action-icon" data-bs-container="#tooltip-container2" data-bs-toggle="tooltip" title="Cetak SBTE"> <i class="mdi mdi-printer-outline"></i></a>'
//                     }else{
//                         return '<a onclick="viewtransaksi('+ row['id'] +')" class="action-icon" title="View Transaksi"> <i class="mdi mdi-card-search"></i></a> <a onclick="uploadbuktitrf('+ row['id'] +')" class="action-icon" title="Upload trf"> <i class="mdi mdi-file-upload"></i></a><a onclick="edittransaksi('+ row['id'] +')" class="action-icon" title="Edit Transaksi"> <i class="mdi mdi-file-edit"></i></a> <a onclick="jasadiakhir('+ row['id'] +')" class="action-icon" title="Transaksi Jasa Di akhir"> <i class="mdi mdi-receipt"></i></a><a onclick="aprovalopr('+ row['id'] +')" class="action-icon" title="Aproval OPR"> <i class="mdi mdi-check-circle"></i></a><a onclick="aprovalkeu('+ row['id'] +')" class="action-icon" title="Aproval Kasir"> <i class="mdi mdi-check-circle"></i></a> <a href="/backend/cetak-sbte/'+ row['id'] +'/'+ row['kode_pengajuan'] +'" class="action-icon" title="Cetak SBTE"> <i class="mdi mdi-printer-outline"></i></a>'
//                     }
//                 },
//                 "className": 'text-center',
//                 "orderable": false,
//                 "data": null,
//             },
//         ],
//         pageLength: 10,
//         lengthMenu: [[5, 10, 20], [5, 10, 20]]
//     });
// }
