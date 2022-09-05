@extends('layouts.base')
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{asset('customjs/backend/loading.css')}}">
@endsection
@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Get The Cash</a></li>
                        <li class="breadcrumb-item active">Pengajuan GTC</li>
                    </ol>
                </div>
                <h4 class="page-title">List Pengajuan</h4>
            </div>
        </div>
    </div>
    <!-- end page title --> 

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-5">
                            @php
                                date_default_timezone_set('Asia/Jakarta');
                                $jam = date('H:i');
                                $buka = date('10:30');
                                $tutup = date('22:30');
                            @endphp
                            @if($jam>=$buka && $jam<=$tutup)
                                <a href="{{url('backend/tambah-pengajuan-gtc')}}" class="btn btn-primary mb-2" ><i class="mdi mdi-plus-circle-outline"></i>Pengajuan GTC</a>
                            @else

                            @endif
                            <a href="" class="btn btn-success mb-2"><i class="mdi mdi-export"></i>Export Excel</a>
                            @php
                                $user_id = Auth::user()->kantor;
                            @endphp
                            @if($user_id != '1')
                            @else
                                <a href="{{url('backend/del-pengajuan-gtc')}}" class="btn btn-danger mb-2"><i class="mdi mdi-delete"></i></a>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"> 
                            <div class="row mb-3"> 
                                <label for="colFormLabelSm" class="col-4 col-form-label">Min. Date:</label> 
                                <div class="col-8"> 
                                    <input class="form-control form-control-sm" type="text" id="from_date" name="from_date"> 
                                </div> 
                            </div> 
                        </div> 
                        <div class="col-sm-3"> 
                            <div class="row mb-3"> 
                                <label for="colFormLabelSm" class="col-4 col-form-label">Max. Date:</label> 
                                <div class="col-8"> 
                                    <input class="form-control form-control-sm" type="text" id="to_date" name="to_date"> 
                                </div> 
                            </div> 
                        </div> 
                        <div class="col-sm-3 text-right"> 
                            <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button> 
                            <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button> 
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="scroll-horizontal-preview">
                        <table id="list-data" class="table table-striped w-100 nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th hidden>created_at</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Perwada</th>
                                    <th>Kode Pengajuan</th>
                                    <th>Nomor BA</th>
                                    <th>Nama Anggota</th>
                                    <th>Total Gramasi</th>
                                    <th>Total BuyBack</th>
                                    <th>Plafon</th>
                                    <th>Nominal Permohonan</th>
                                    <th>Status Akhir</th>
                                    <th>Status Aproval</th>
                                    <th>Apvl BM</th>
                                    @if($user_id != '1')
                                    @else
                                        <th>Apvl Opr</th>
                                        <th>Apvl Keu</th>
                                    @endif
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach($data as $row)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td hidden>{{$row->created_at}}</td>
                                    @php
                                        $tanggal = $row->tanggal_pengajuan;
                                        $bulan = array (
                                            1 =>   'Januari',
                                            'Februari',
                                            'Maret',
                                            'April',
                                            'Mei',
                                            'Juni',
                                            'Juli',
                                            'Agustus',
                                            'September',
                                            'Oktober',
                                            'November',
                                            'Desember'
                                        );
                                        $pecahkandata = explode(' ', $tanggal);
                                        $pecahkantgl = explode('-', $pecahkandata[0]);
                                        $pecahkanjam = explode(':', $pecahkandata[1]);
                                        $tglpengajuan = $pecahkantgl[2] . ' ' . $bulan[(int)$pecahkantgl[1]] . ' ' . $pecahkantgl[0] . ' ' . $pecahkanjam[0] . ':' . $pecahkanjam[1];
                                        
                                    @endphp
                                    <td>{{$tglpengajuan}}</td>
                                    @php
                                        $perwada = DB::table('perwada')->where('id', $row->id_perwada)->first();
                                    @endphp
                                    <td>{{$perwada->nama}}</td>
                                    <td>{{$row->kode_pengajuan}}</td>
                                    <td>{{$row->nomor_ba}}</td>
                                    <td>{{$row->nama_lengkap}}</td>
                                    <td>{{$row->total_gramasi}}</td>
                                    <td>{{"Rp. ".number_format($row->total_buyback,0,',','.')}}</td>
                                    <td>{{"Rp. ".number_format($row->plafond_pinjaman,0,',','.')}}</td>
                                    <td>{{"Rp. ".number_format($row->pengajuan,0,',','.')}}</td>
                                    <td>
                                        @if($row->status_akhir == '')
                                            Pengajuan
                                        @else
                                            {{$row->status_akhir}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($row->aproval_bm == '')
                                            Tunggu
                                        @else
                                            @if($row->aproval_bm == 'Proses')
                                                @if($row->aproval_opr == 'Proses')
                                                    @if($row->aproval_keu == 'Disetujui')
                                                        Disetujui
                                                    @elseif($row->aproval_keu == 'Doc. Belum Lengkap')
                                                        Belum Lengkap
                                                    @elseif($row->aproval_keu == 'Tidak Disetujui')
                                                        Tidak Disetujui
                                                    @endif
                                                @elseif($row->aproval_opr == 'Doc. Belum Lengkap')
                                                    @if($row->aproval_keu == 'Disetujui')
                                                        Belum Lengkap
                                                    @elseif($row->aproval_keu == 'Doc. Belum Lengkap')
                                                        Belum Lengkap
                                                    @elseif($row->aproval_keu == 'Tidak Disetujui')
                                                        Tidak Disetujui
                                                    @endif
                                                @elseif($row->aproval_opr == 'Tidak Disetujui')
                                                    @if($row->aproval_keu == 'Disetujui')
                                                        Tidak Disetujui
                                                    @elseif($row->aproval_keu == 'Doc. Belum Lengkap')
                                                        Tidak Disetujui
                                                    @elseif($row->aproval_keu == 'Tidak Disetujui')
                                                        Tidak Disetujui
                                                    @endif
                                                @endif
                                            @elseif($row->aproval_bm == 'Doc. Belum Lengkap')
                                                @if($row->aproval_opr == 'Proses')
                                                    @if($row->aproval_keu == 'Disetujui')
                                                        Belum Lengkap
                                                    @elseif($row->aproval_keu == 'Doc. Belum Lengkap')
                                                        Belum Lengkap
                                                    @elseif($row->aproval_keu == 'Tidak Disetujui')
                                                        Tidak Disetujui
                                                    @endif
                                                @elseif($row->aproval_opr == 'Doc. Belum Lengkap')
                                                    @if($row->aproval_keu == 'Disetujui')
                                                        Belum Lengkap
                                                    @elseif($row->aproval_keu == 'Doc. Belum Lengkap')
                                                        Belum Lengkap
                                                    @elseif($row->aproval_keu == 'Tidak Disetujui')
                                                        Tidak Disetujui
                                                    @endif
                                                @elseif($row->aproval_opt == 'Tidak Disetujui')
                                                    @if($row->aproval_keu == 'Disetujui')
                                                        Tidak Disetujui
                                                    @elseif($row->aproval_keu == 'Doc. Belum Lengkap')
                                                        Tidak Disetujui
                                                    @elseif($row->aproval_keu == 'Tidak Disetujui')
                                                        Tidak Disetujui
                                                    @endif
                                                @endif
                                            @elseif($row->aproval_bm == 'Tidak Disetujui')
                                                @if($row->aproval_opr == 'Proses')
                                                    @if($row->aproval_keu == 'Disetujui')
                                                        Tidak Disetujui
                                                    @elseif($row->aproval_keu == 'Doc. Belum Lengkap')
                                                        Tidak Disetujui
                                                    @elseif($row->aproval_keu == 'Tidak Disetujui')
                                                        Tidak Disetujui
                                                    @endif
                                                @elseif($row->aproval_opr == 'Doc. Belum Lengkap')
                                                    @if($row->aproval_keu == 'Disetujui')
                                                        Tidak Disetujui
                                                    @elseif($row->aproval_keu == 'Doc. Belum Lengkap')
                                                        Tidak Disetujui
                                                    @elseif($row->aproval_keu == 'Tidak Disetujui')
                                                        Tidak Disetujui
                                                    @endif
                                                @elseif($row->aproval_opt == 'Tidak Disetujui')
                                                    @if($row->aproval_keu == 'Disetujui')
                                                        Tidak Disetujui
                                                    @elseif($row->aproval_keu == 'Doc. Belum Lengkap')
                                                        Tidak Disetujui
                                                    @elseif($row->aproval_keu == 'Tidak Disetujui')
                                                        Tidak Disetujui
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{url('backend/aproval-bm-pengajuan-gtc/'.$row->id)}}" class="action-icon"> <i class="mdi mdi-book-arrow-right-outline"></i></a>
                                    </td>

                                    @if($user_id != '1')
                                    @else
                                    <td>
                                        @if($user_id != '1')
                                        @else
                                            <a href="{{url('backend/aproval-opr-pengajuan-gtc/'.$row->id)}}" class="action-icon"> <i class="mdi mdi-book-check"></i></a>
                                        @endif
                                    </td>
                                    @endif

                                    @if($user_id != '1')
                                    @else
                                    <td>
                                        @if($user_id != '1')
                                        @else
                                            <a href="{{url('backend/aproval-keu-pengajuan-gtc/'.$row->id)}}" class="action-icon"> <i class="mdi mdi-book-check-outline"></i></a>
                                        @endif
                                    </td>
                                    @endif
                                    <td>
                                        @if($user_id != '1')
                                            <a href="{{url('backend/view-pengajuan-gtc/'.$row->id)}}" class="action-icon"> <i class="mdi mdi-card-search"></i></a>
                                        @else
                                            <a href="{{url('backend/view-pengajuan-gtc/'.$row->id)}}" class="action-icon"> <i class="mdi mdi-card-search"></i></a>
                                            <a href="{{url('backend/edit-pengajuan-gtc/'.$row->id)}}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a onclick="hapusdatapengajuangtc({{$row->id}})" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>                                          
                                                                                   
                        </div> <!-- end preview-->
                    
                        <div class="tab-pane" id="scroll-horizontal-code">
                            <pre class="mb-0">
                                <span class="html escape">
                                    &lt;table id=&quot;scroll-horizontal-datatable&quot; class=&quot;table w-100 nowrap&quot;&gt;
                                        &lt;thead&gt;
                                            &lt;tr&gt;
                                                &lt;th&gt;No&lt;/th&gt;
                                                &lt;th&gt;Pengajuan&lt;/th&gt;
                                                &lt;th&gt;Perwada&lt;/th&gt;
                                                &lt;th&gt;Office&lt;/th&gt;
                                                &lt;th&gt;Age&lt;/th&gt;
                                                &lt;th&gt;Start date&lt;/th&gt;
                                                &lt;th&gt;Salary&lt;/th&gt;
                                                &lt;th&gt;Extn.&lt;/th&gt;
                                                &lt;th&gt;E-mail&lt;/th&gt;
                                            &lt;/tr&gt;
                                        &lt;/thead&gt;
                                        &lt;tbody&gt;
                                            &lt;tr&gt;
                                                &lt;td&gt;Tiger&lt;/td&gt;
                                                &lt;td&gt;Nixon&lt;/td&gt;
                                                &lt;td&gt;System Architect&lt;/td&gt;
                                                &lt;td&gt;Edinburgh&lt;/td&gt;
                                                &lt;td&gt;61&lt;/td&gt;
                                                &lt;td&gt;2011/04/25&lt;/td&gt;
                                                &lt;td&gt;$320,800&lt;/td&gt;
                                                &lt;td&gt;5421&lt;/td&gt;
                                                &lt;td&gt;t.nixon@datatables.net&lt;/td&gt;
                                            &lt;/tr&gt;
                                            &lt;tr&gt;
                                                &lt;td&gt;Garrett&lt;/td&gt;
                                                &lt;td&gt;Winters&lt;/td&gt;
                                                &lt;td&gt;Accountant&lt;/td&gt;
                                                &lt;td&gt;Tokyo&lt;/td&gt;
                                                &lt;td&gt;63&lt;/td&gt;
                                                &lt;td&gt;2011/07/25&lt;/td&gt;
                                                &lt;td&gt;$170,750&lt;/td&gt;
                                                &lt;td&gt;8422&lt;/td&gt;
                                                &lt;td&gt;g.winters@datatables.net&lt;/td&gt;
                                            &lt;/tr&gt;
                                        &lt;/tbody&gt;
                                    &lt;/table&gt; 
                                </span>
                            </pre> <!-- end highlight-->
                        </div> <!-- end preview code-->
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <div class="modal fade" id="modal-pengajuan-gtc" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg loading authentication-bg">
            <div class="modal-content bg-transparent">
            <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xxl-7 col-lg-5">
                            <div class="card">
                                <!-- Logo-->
                                <div class="modal-header" style="background-color: #afb4be">
                                    <div style="color: rgb(255, 255, 255);"><h4>Pengajuan GTC</h4></div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                </div>
                                <div class="card-body p-4">
                                    <form action="#">

                                        <div class="mb-3">
                                            <label for="fullname" class="form-label">Tanggal Rilis</label>
                                            <input class="form-control" type="date" placeholder="Tanggal Otomatis hari ini" id="fullname" readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label for="fullname" class="form-label">Harga Emas 0.1 Gram</label>
                                            <input class="form-control" type="text" id="fullname" placeholder="" required data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true">
                                        </div>

                                        <div class="mb-3">
                                            <label for="fullname" class="form-label">Harga Emas 0.2 Gram</label>
                                            <input class="form-control" type="text" id="fullname" placeholder="" required data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true">
                                        </div>

                                        <div class="mb-3">
                                            <label for="fullname" class="form-label">Harga Emas 0.5 Gram</label>
                                            <input class="form-control" type="text" id="fullname" placeholder="" required data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true">
                                        </div>

                                        <div class="mb-3">
                                            <label for="fullname" class="form-label">Harga Emas 1 Gram</label>
                                            <input class="form-control" type="text" id="fullname" placeholder="" required data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true">
                                        </div>

                                        <div class="mb-3">
                                            <label for="fullname" class="form-label">Harga Emas 2 Gram</label>
                                            <input class="form-control" type="text" id="fullname" placeholder="" required data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true">
                                        </div>

                                        <div class="mb-3">
                                            <label for="fullname" class="form-label">Harga Emas 5 Gram</label>
                                            <input class="form-control" type="text" id="fullname" placeholder="" required data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true">
                                        </div>

                                        <div class="mb-3">
                                            <label for="fullname" class="form-label">Harga Emas 10 Gram</label>
                                            <input class="form-control" type="text" id="fullname" placeholder="" required data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true">
                                        </div>

                                        <div class="mb-3 text-center" >
                                            <button class="btn btn-primary" type="submit"> Simpan Harga </button>
                                        </div>
    
                                    </form>
                                </div> <!-- end card-body -->
                            </div>
                            <!-- end card -->
                            <!-- end row -->
    
                        </div> <!-- end col -->
                    </div>
                    
                    <!-- end row -->
                </div>
                <!-- end container -->
            </div>
            </div>
            <!-- end page -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@push('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('customjs/backend/pengajuan_gtc.js')}}"></script>
<script src="{{asset('customjs/backend/loading.js')}}"></script>
<script>
   $('#list-data').DataTable({
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
        order: [[1, "desc"]],
        pageLength: 10,
        lengthMenu: [[5, 10, 20], [5, 10, 20]]
    });
</script>
<script>
    load_data(); 
    function load_data(from_date = '', to_date = ''){ 
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
                        return '<a onclick="viewtransaksi('+ row['id'] +')" class="action-icon" title="View Transaksi"> <i class="mdi mdi-card-search"></i></a> <a onclick="uploadbuktitrf('+ row['id'] +')" class="action-icon" title="Upload trf"> <i class="mdi mdi-file-upload"></i></a><a onclick="edittransaksi('+ row['id'] +')" class="action-icon" title="Edit Transaksi"> <i class="mdi mdi-file-edit"></i></a> <a onclick="jasadiakhir('+ row['id'] +')" class="action-icon" title="Transaksi Jasa Di akhir"> <i class="mdi mdi-receipt"></i></a><a onclick="aprovalopr('+ row['id'] +')" class="action-icon" title="Aproval OPR"> <i class="mdi mdi-check-circle"></i></a><a onclick="aprovalkeu('+ row['id'] +')" class="action-icon" title="Aproval Kasir"> <i class="mdi mdi-check-circle"></i></a> <a href="/backend/cetak-sbte/'+ row['id'] +'/'+ row['kode_pengajuan'] +'" class="action-icon" title="Cetak SBTE"> <i class="mdi mdi-printer-outline"></i></a>'
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
    } 
  
        // Refilter the table 
    $('#filter').click(function(){ 
        var from_date = $('#from_date').val(); 
        var to_date = $('#to_date').val(); 
        console.log(from_date,to_date); 
        if(from_date != '' &&  to_date != '') 
        { 
            $('.data-table').DataTable().destroy(); 
            load_data(from_date, to_date); 
        } 
        else 
        { 
            alert('Both Date is required'); 
        } 
    }); 
    $('#refresh').click(function(){ 
        $('#from_date').val(''); 
        $('#to_date').val(''); 
        $('.data-table').DataTable().destroy(); 
        load_data(); 
    });
</script>
@endpush
