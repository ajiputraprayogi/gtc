@extends('layouts.base')
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{asset('customjs/backend/loading.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('content')
    @php
        $perwada = Auth::user()->kantor;
    @endphp
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Get The Cash</a></li>
                        <li class="breadcrumb-item active">View Transaksi GTC</li>
                    </ol>
                </div>
                <h4 class="page-title">Transaksi Data GTC</h4>
            </div>
        </div>
    </div>
    <!-- end page title --> 

    <div class="row">
        <div class="col-12">
            <div class="card d-block">
                <div class="card-header bg-secondary border-danger border-3" >
                    <div class=" align-items-center mb-2 text-white">
                        <h3>Transaksi GTC</h3>
                    </div>
                </div>
                @foreach($data as $row)
                <div id="panel" class="card-body">
                    <input type="hidden" name="id_pengajuan" id="id_pengajuan" value="{{$row->kode_pengajuan}}" class="form-control">
                    <input type="hidden" name="id_anggota" id="id_anggota" value="{{$row->ida}}" class="form-control">
                    <div class="row mb-2">
                        <div class="col-4">
                            @if($perwada !='1')
                            @else
                            <a onclick="pelunasan({{$row->idp}})" class="btn btn-success mb-2"><i class="mdi mdi-calendar-check"></i>Pelunasan</a>
                            @endif
                        </div>
                        <div class="col-4">
                            <a href="aktif-gtc.html" class="btn btn-info mb-2"><i class="mdi mdi-arrow-left-bold-circle-outline"></i> Kembali</a>
                        </div>
                        <div class="col-4">
                            <a href="" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modal-view-pemohon"><i class="mdi mdi-card-search-outline"></i> Detail Pemohon</a>
                        </div><hr> 
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <p id="transaksi_nomor_ba" class="font-14"><strong>Nomor Buku Anggota :</strong> {{$row->nomor_ba}}</p>
                        </div>
                        <div class="col-sm-4">
                            <p id="transaksi_nama_lengkap" class="font-14"><strong>Nama Lengkap :</strong> {{$row->nama_lengkap}}</p>
                        </div><hr>
                    </div>

                    <div class="" data-simplebar style="max-height: 500px;">
                        
                        <div class="row">
                            <div class="col-lg-6 card">
                                <div class="table-responsive">
                                    <br><h5>Data Pengajuan</h5>
                                </div>
                                <table class="table mb-0">
                                    <thead>
                                    <tr>
                                        <th style="width: 35%;"></th>
                                        <th style="width: 65%;"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Tanggal Pengajuan</td>
                                        <td id="transaksi_tanggal_pengajuan">: {{$row->tanggal_pengajuan}}</td>
                                    </tr>
                                    <tr>
                                        <td>Perwada</td>
                                        @php
                                            $nama_perwada = DB::table('perwada')->where('id', $row->id_perwada)->first();
                                        @endphp
                                        <td id="transaksi_id_perwada">: {{$nama_perwada->nama}}</td>
                                    </tr>
                                    <tr>
                                        <td>Kode Pengajuan</td>
                                        <td id="transaksi_kode_pengajuan">: {{$row->kode_pengajuan}}</td>
                                    </tr>
                                    <tr>
                                        <td>Pinjaman Awal</td>
                                        <td id="transaksi_pinjaman_awal">: {{'Rp '. number_format($row->pengajuan,0,'.','.')}}</td>
                                    </tr>
                                    <tr>
                                        <td>Sisa Pinjaman</td>
                                        <td id="transaksi_sisa_pinjaman">: {{'Rp '. number_format($sisapinjaman,0,'.','.')}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div><br>
                            <div class="col-lg-6 card">
                                <div class="table-responsive">
                                    <br><h5>Update Transaksi Terahir</h5>
                                </div>
                                <table class="table mb-0">
                                    <thead>
                                    <tr>
                                        <th style="width: 35%;"></th>
                                        <th style="width: 65%;"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Jenis Transaksi</td>
                                        <td id="transaksi_jenis_transaksi">: {{$row->jenis_transaksi}}</td>
                                    </tr>
                                    <tr>
                                        <td>Pilihan Jasa</td>
                                        <td id="transaksi_pilihan_jasa">: {{$row->pilihan_jasa}}</td>
                                    </tr>
                                    <tr>
                                        <td>Perhitungan Jasa</td>
                                        <td id="transaksi_perhitungan_jasa">: {{$row->perhitungan_jasa}}</td>
                                    </tr>
                                    <tr>
                                        <td>Jangka Waktu</td>
                                        <td id="transaksi_jangka_waktu_permohonan">: {{$row->jangka_waktu_permohonan . " Bulan"}}</td>
                                    </tr>
                                    <tr>
                                        <td>Biaya Jasa</td>
                                        <td id="transaksi_biaya_jasa">: {{"Rp " . number_format($row->jasa_gtc,0,'.','.')}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div><br>
                            
                        </div>
                        <h5>Detail Emas GTC</h5>
                        <ul class="nav nav-tabs nav-bordered mb-3">
                            <li class="nav-item">
                                <a href="#pengajuan" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Pengajuan</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#pengambilan" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                    <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Pengambilan Sebagian</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#sisaemasgtc" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                    <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Sisa Emas</span>
                                </a>
                            </li>
                        </ul>
                        
                        <div class="tab-content">
                            <div class="tab-pane show active" id="pengajuan">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-nowrap table-centered mb-0">
                                            <h5>Detail Emas Pengajuan GTC</h5>
                                            <thead class="text-white bg-secondary ">
                                                <tr>
                                                    <th>Item emas</th>
                                                    <th>Jenis</th>
                                                    <th>Gramasi</th> 
                                                    <th>Keping</th>
                                                    <th>Jumlah Gramasi</th>
                                                </tr>
                                            </thead>
                                                @php 
                                                    $emas = DB::table('gtc_emas')->where('kode_pengajuan', $row->kode_pengajuan)->get();
                                                @endphp
                                                @foreach($emas as $row_emas)
                                                <tr>
                                                    <td id="pengajuan_item_emas">{{$row_emas ->item_emas}}</td>
                                                    <td>
                                                        <span class="badge badge-primary-lighten" id="pengajuan_jenis">{{$row_emas->jenis}}</span>
                                                    </td>
                                                    <td id="pengajuan_gramasi">{{$row_emas->gramasi}}</td>
                                                    <td id="pengajuan_keping{{$row_emas->id}}">{{$row_emas->keping}}</td>
                                                    <td id="pengajuan_sub_gramasi{{$row_emas->id}}">{{$row_emas->gramasi*$row_emas->keping . " Gram"}}</td>
                                                    
                                                </tr>
                                                @endforeach
                                                <!-- <tr>
                                                    <td>Gold 0.1 Gram</td>
                                                    <td>
                                                        <span class="badge badge-primary-lighten">Reguler</span>
                                                    </td>
                                                    <td>0.1</td>
                                                    <td>Rp 150.000</td>
                                                    <td>2</td>
                                                    <td>0.2 Gram</td>
                                                    <td>Rp 300.000</td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="action-icon"> <i
                                                                class="mdi mdi-delete"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Gold 0.1 Gram</td>
                                                    <td>
                                                        <span class="badge badge-primary-lighten">Reguler</span>
                                                    </td>
                                                    <td>0.1</td>
                                                    <td>Rp 150.000</td>
                                                    <td>2</td>
                                                    <td>0.2 Gram</td>
                                                    <td>Rp 300.000</td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="action-icon"> <i
                                                                class="mdi mdi-delete"></i></a>
                                                    </td>
                                                </tr> -->
                                            </tbody>
                                            <tfoot class="text-white bg-secondary ">
                                                <tr>
                                                    <th>Total</th>
                                                    <th></th>
                                                    <th></th>
                                                    <th id="pengajuan_total_keping">
                                                        @php
                                                            $total_keping = DB::table('gtc_emas')->where('kode_pengajuan', $row->kode_pengajuan)->sum('keping');
                                                        @endphp
                                                        {{$total_keping}}
                                                    </th>
                                                    <th id="pengajuan_total_gramasi">
                                                        @php
                                                            $total_gramasi = DB::table('gtc_emas')
                                                            ->where('kode_pengajuan', $row->kode_pengajuan)
                                                            ->select(DB::raw('sum(gramasi*keping)as total_gramasi'))
                                                            ->get();
                                                            foreach($total_gramasi as $gramasi){
                                                                $total_gramasi = $gramasi->total_gramasi;
                                                            }
                                                        @endphp
                                                        {{$total_gramasi. " Gram"}}
                                                    </th>
                                                </tr>
                                                </tfoot>
                                            <tbody>
                                        </table>
                                    </div><hr><br>
                                </div>
                            </div>
                            <div class="tab-pane" id="pengambilan">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-nowrap table-centered mb-0">
                                            <h5>Detail Emas GTC Diambil</h5>
                                            <thead class="text-white bg-secondary ">
                                                <tr>
                                                    <th>Item emas</th>
                                                    <th>Jenis</th>
                                                    <th>Gramasi</th> 
                                                    <th>Keping</th>
                                                    <th>Jumlah Gramasi</th>
                                                </tr>
                                            </thead>
                                                @php 
                                                    $emas = DB::table('gtc_emas')->where('kode_pengajuan', $row->kode_pengajuan)->get();
                                                    $keping = DB::table('gtc_histori_transaksi')->where('kode_pengajuan', $row->kode_pengajuan)->select(DB::raw('sum(keping) as total'))->groupby('id_emas')->get();
                                                    $no = 0;
                                                @endphp
                                                @foreach($emas as $row_emas)
                                                @php
                                                    $no++;
                                                @endphp
                                                <tr>
                                                    <td id="pengambilan_item_emas">{{$row_emas ->item_emas}}</td>
                                                    <td>
                                                        <span class="badge badge-primary-lighten" id="pengambilan_jenis">{{$row_emas->jenis}}</span>
                                                    </td>
                                                    <td id="pengambilan_gramasi">{{$row_emas->gramasi}}</td>
                                                    <td id="pengambilan_keping{{$row_emas->id}}">{{$keping[$no-1]->total}}</td>
                                                    <td id="pengambilan_sub_gramasi{{$row_emas->id}}">{{$row_emas->gramasi*$keping[$no-1]->total . " Gram"}}</td>
                                                    
                                                </tr>
                                                @endforeach
                                                <!-- <tr>
                                                    <td>Gold 0.1 Gram</td>
                                                    <td>
                                                        <span class="badge badge-primary-lighten">Reguler</span>
                                                    </td>
                                                    <td>0.1</td>
                                                    <td>Rp 150.000</td>
                                                    <td>2</td>
                                                    <td>0.2 Gram</td>
                                                    <td>Rp 300.000</td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="action-icon"> <i
                                                                class="mdi mdi-delete"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Gold 0.1 Gram</td>
                                                    <td>
                                                        <span class="badge badge-primary-lighten">Reguler</span>
                                                    </td>
                                                    <td>0.1</td>
                                                    <td>Rp 150.000</td>
                                                    <td>2</td>
                                                    <td>0.2 Gram</td>
                                                    <td>Rp 300.000</td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="action-icon"> <i
                                                                class="mdi mdi-delete"></i></a>
                                                    </td>
                                                </tr> -->
                                            </tbody>
                                            <tfoot class="text-white bg-secondary ">
                                                <tr>
                                                    <th>Total</th>
                                                    <th></th>
                                                    <th></th>
                                                    <th id="pengambilan_total_keping">
                                                        @php
                                                            $emas2 = DB::table('gtc_emas')->where('kode_pengajuan', $row->kode_pengajuan)->get();
                                                            $keping2 = DB::table('gtc_histori_transaksi')->where('kode_pengajuan', $row->kode_pengajuan)->select(DB::raw('sum(keping) as total'))->groupby('id_emas')->get();
                                                            $total_keping2 = 0;
                                                            foreach($keping2 as $rowkeping2){
                                                                $total_keping2 += $rowkeping2->total;
                                                            }
                                                        @endphp
                                                        {{$total_keping2}}
                                                    </th>
                                                    <th id="pengambilan_total_gramasi">
                                                        @php
                                                            $no2 = 0;
                                                            $total_gramasi2 = 0;
                                                            foreach($emas2 as $rowemas2){
                                                                $no2++;
                                                                $a = $keping2[$no2-1]->total;
                                                                $total_gramasi2 += $a*$rowemas2->gramasi;
                                                            }
                                                        @endphp
                                                        {{$total_gramasi2. " Gram"}}
                                                    </th>
                                                    
                                                </tr>
                                                </tfoot>
                                            <tbody>
                                        </table>
                                    </div><hr><br>
                                </div>
                            </div>
                            <div class="tab-pane" id="sisaemasgtc">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-nowrap table-centered mb-0">
                                            <h5>Detail Emas Sisa GTC</h5>
                                            <thead class="text-white bg-secondary ">
                                                <tr>
                                                    <th>Item emas</th>
                                                    <th>Jenis</th>
                                                    <th>Gramasi</th> 
                                                    <th>Keping</th>
                                                    <th>Jumlah Gramasi</th>
                                                </tr>
                                            </thead>
                                            @php 
                                                    $emas3 = DB::table('gtc_emas')->where('kode_pengajuan', $row->kode_pengajuan)->get();
                                                    $keping3 = DB::table('gtc_histori_transaksi')->where('kode_pengajuan', $row->kode_pengajuan)->select(DB::raw('sum(keping) as total'))->groupby('id_emas')->get();
                                                    $no3 = 0;
                                                @endphp
                                                @foreach($emas as $row_emas)
                                                @php
                                                    $no3++;
                                                @endphp
                                                <tr>
                                                    <td id="sisa_item_emas">{{$row_emas ->item_emas}}</td>
                                                    <td>
                                                        <span class="badge badge-primary-lighten" id="sisa_jenis">{{$row_emas->jenis}}</span>
                                                    </td>
                                                    <td id="sisa_gramasi">{{$row_emas->gramasi}}</td>
                                                    <td id="sisa_keping{{$row_emas->id}}">{{$row_emas->keping-$keping3[$no3-1]->total}}</td>
                                                    @php
                                                        $gramasi3 = $row_emas->keping-$keping3[$no3-1]->total;
                                                    @endphp
                                                    <td id="sisa_sub_gramasi{{$row_emas->id}}">{{$row_emas->gramasi*$gramasi3 . " Gram"}}</td>
                                                    
                                                </tr>
                                                @endforeach
                                                <!-- <tr>
                                                    <td>Gold 0.1 Gram</td>
                                                    <td>
                                                        <span class="badge badge-primary-lighten">Reguler</span>
                                                    </td>
                                                    <td>0.1</td>
                                                    <td>Rp 150.000</td>
                                                    <td>2</td>
                                                    <td>0.2 Gram</td>
                                                    <td>Rp 300.000</td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="action-icon"> <i
                                                                class="mdi mdi-delete"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Gold 0.1 Gram</td>
                                                    <td>
                                                        <span class="badge badge-primary-lighten">Reguler</span>
                                                    </td>
                                                    <td>0.1</td>
                                                    <td>Rp 150.000</td>
                                                    <td>2</td>
                                                    <td>0.2 Gram</td>
                                                    <td>Rp 300.000</td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="action-icon"> <i
                                                                class="mdi mdi-delete"></i></a>
                                                    </td>
                                                </tr> -->
                                            </tbody>
                                            <tfoot class="text-white bg-secondary ">
                                                <tr>
                                                    <th>Total</th>
                                                    <th></th>
                                                    <th></th>
                                                    <th id="sisa_total_keping">
                                                        @php
                                                            $emas4 = DB::table('gtc_emas')->where('kode_pengajuan', $row->kode_pengajuan)->get();
                                                            $keping4 = DB::table('gtc_histori_transaksi')->where('kode_pengajuan', $row->kode_pengajuan)->select(DB::raw('sum(keping) as total'))->groupby('id_emas')->get();
                                                            $no4 = 0;
                                                            $total_keping4 = 0;
                                                            foreach($keping4 as $rowkeping4){
                                                                $no4++;
                                                                $total_keping4 += $emas4[$no4-1]->keping-$rowkeping4->total;
                                                            }
                                                        @endphp
                                                        {{$total_keping4}}
                                                    </th>
                                                    <th id="sisa_total_gramasi">
                                                        @php
                                                            $emas5 = DB::table('gtc_emas')->where('kode_pengajuan', $row->kode_pengajuan)->get();
                                                            $keping5 = DB::table('gtc_histori_transaksi')->where('kode_pengajuan', $row->kode_pengajuan)->select(DB::raw('sum(keping) as total'))->groupby('id_emas')->get();
                                                            $no5 = 0;
                                                            $total_gramasi5 = 0;
                                                            foreach($emas5 as $rowemas5){
                                                                $no5++;
                                                                $a = $emas5[$no5-1]->keping-$keping5[$no5-1]->total;
                                                                $total_gramasi5 += $a*$rowemas5->gramasi;
                                                            }
                                                        @endphp
                                                        {{$total_gramasi5. " Gram"}}
                                                    </th>
                                                    
                                                </tr>
                                                </tfoot>
                                            <tbody>
                                        </table>
                                    </div><hr><br>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <!-- <button id="reload">Klik</button> -->
                            <div class="card">
                                <div class="table-responsive">
                                    <h5>Tabel Transaksi</h5>
                                    <table id="list-data" class="table table-striped w-100 nowrap">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Transaksi</th>
                                                <th>Jenis Transaksi</th>
                                                <th>Pilihan Jasa</th>
                                                <th>Perhitungan Jasa</th>
                                                <th>Tgl Sebelumnya</th>
                                                <th>Jangka Waktu</th>
                                                <th>Tgl Jatuh Tempo</th>
                                                <th>Biaya Jasa</th>
                                                <th>Pembayaran Jasa</th>
                                                <th>Nomor SBTE</th>
                                                <th>Status</th>
                                                <th>Action
                                                @php
                                                    date_default_timezone_set('Asia/Jakarta');
                                                    $jam = date('H:i');
                                                    $buka = date('09:30');
                                                    $tutup = date('10:30');
                                                @endphp
                                                @if(!($jam>=$buka && $jam<=$tutup))
                                                    <a onclick="tambahtransaksi('{{$row->kode_pengajuan}}')" class="action-icon" title="Tambah Transaksi"><i class="mdi mdi-plus-box"></i></a>
                                                @else

                                                @endif
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1; ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->

    </div> <!-- container -->


    <!-- Modal view-->
    @foreach($data as $row)
    <div class="modal fade" id="modal-view-pemohon" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #afb4be">
                    <h4 class="modal-title" style="color: rgb(255, 255, 255);" id="myLargeModalLabel">View Data CIF Anggota</h4>
                    <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <p class="font-14"><strong>Nomor Buku Anggota</strong></p>
                        </div>
                        <div class="col-8">
                            <p class="font-14" id="detail_nomor_buku_anggota"><strong>: {{$row->nomor_ba}}</strong> </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p class="font-14"><strong>Nama Lengkap</strong></p>
                        </div>
                        <div class="col-8">
                            <h class="font-14" id="detail_nama_lengkap"><strong>: </strong>{{$row->nama_lengkap}}</h>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p class="font-14"><strong>Nomor Hp</strong></p>
                        </div>
                        <div class="col-8">
                            <h class="font-14" id="detail_nomor_hp"><strong>: </strong>{{$row->no_hp}}</h>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p class="font-14"><strong>{{$row->no_hp}}</strong></p>
                        </div>
                        <div class="col-8">
                            <h class="font-14" id="detail_email"><strong>: </strong>{{$row->email}}</h>
                        </div><hr>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p class="font-14"><strong>Nomor KTP</strong></p>
                        </div>
                        <div class="col-8">
                            <h class="font-14" id="detail_nomor_ktp"><strong>: </strong>{{$row->no_ktp}}</h>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p class="font-14"><strong>Jenis Kelamin</strong></p>
                        </div>
                        <div class="col-8">
                            <h class="font-14" id="detail_jenis_kelamin"><strong>: </strong>{{$row->jenis_kelamin}}</h>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p class="font-14"><strong>Tempat Lahir</strong></p>
                        </div>
                        <div class="col-8">
                            <h class="font-14" id="detail_tempat_lahir"><strong>: </strong>{{$row->tempat_lahir}}</h>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p class="font-14"><strong>Tanggal Lahir</strong></p>
                        </div>
                        <div class="col-8">
                            <p class="font-14" id="detail_tanggal_lahir"><strong>: </strong>{{$row->tanggal_lahir}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p class="font-14"><strong>Status Pernikahan</strong></p>
                        </div>
                        <div class="col-8">
                            <p class="font-14" id="detail_status_pernikahan"><strong>: </strong>{{$row->status_nikah}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p class="font-14"><strong>Nomor NPWP</strong></p>
                        </div>
                        <div class="col-8">
                            <p class="font-14" id="detail_nomor_npwp"><strong>: </strong>{{$row->no_npwp}}</p>
                        </div><hr>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p class="font-14"><strong>Alamat Sesuai KTP</strong></p>
                        </div>
                        <div class="col-8">
                            <p class="font-14" id="detail_alamat_sesuai_ktp"><strong>: </strong>{{$row->alamat_ktp}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p class="font-14"><strong>Kecamatan</strong></p>
                        </div>
                        <div class="col-8">
                            <p class="font-14" id="detail_kecamatan"><strong>: </strong>@php $kecamatan_ktp = explode(",", $row->kecamatan_ktp); @endphp {{$kecamatan_ktp[1]}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p class="font-14"><strong>Kota / Kabupaten</strong></p>
                        </div>
                        <div class="col-8">
                            <p class="font-14" id="detail_kota_kabupaten"><strong>: </strong>@php $kota_ktp = explode(",", $row->kota_ktp); @endphp {{$kota_ktp[1]}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p class="font-14"><strong>Provinsi</strong></p>
                        </div>
                        <div class="col-8">
                            <p class="font-14" id="detail_provinsi"><strong>: </strong>@php $provinsi_ktp = explode(",", $row->provinsi_ktp); @endphp {{$provinsi_ktp[1]}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p class="font-14"><strong>Alamat Tinggal</strong></p>
                        </div>
                        <div class="col-8">
                            <p class="font-14" id="detail_alamat_tinggal"><strong>: </strong>@if($row->alamat_tinggal == 'sesuai') Sesuai KTP @elseif($row->alamat_tinggal == 'tidakSesuai') Tidak Sesuai KTP @endif</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p class="font-14"><strong>Alamat Tinggal Saat ini</strong></p>
                        </div>
                        <div class="col-8">
                            <p class="font-14" id="detail_alamat_tinggal_domisili"><strong>: </strong>{{$row->alamat_domisili}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p class="font-14"><strong>Kecamatan</strong></p>
                        </div>
                        <div class="col-8">
                            <p class="font-14" id="detail_kecamatan_domisili"><strong>: </strong>@php $kecamatan_domisili = explode(",", $row->kecamatan_domisili); @endphp {{$kecamatan_domisili[1]}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p class="font-14"><strong>Kota / Kabupaten</strong></p>
                        </div>
                        <div class="col-8">
                            <p class="font-14" id="detail_kota_kabupaten_domisili"><strong>: </strong>@php $kota_domisili = explode(",", $row->kota_domisili); @endphp {{$kota_domisili[1]}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p class="font-14"><strong>Provinsi</strong></p>
                        </div>
                        <div class="col-8">
                            <p class="font-14" id="detail_provinsi_domisili"><strong>: </strong>@php $provinsi_domisili = explode(",", $row->provinsi_domisili); @endphp {{$provinsi_domisili[1]}}</p>
                        </div><hr>
                    </div>
                    <div class="col-4">
                        <p class="font-14"><strong>Photo KTP</strong></p>
                    </div>
                    <img src="http://syirkah.eoaclubsystem.com/images/data_penting/ktp/{{$row->foto_ktp}}"  id="detail_photo_ktp" alt="image" class="img-fluid rounded" width="600"/>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @endforeach
@foreach($data as $row)
<div class="modal fade" id="modal-tambah-transaksi" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #afb4be">
                <h4 class="modal-title" style="color: rgb(255, 255, 255);" id="myLargeModalLabel">Tambah Transaksi</h4>
                <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form id="formtambahtransaksi" method="post" novalidate>
                    @csrf
                    <input type="hidden" id="tambah_id_pengajuan" name="tambah_id_pengajuan" class="form-control">
                    <div class="row g-2">
                        <div class="col-md">
                            <label for="fullname" class="form-label">Perwada (sesuai dg Akun)</label>
                            <input class="form-control" type="text" id="tambah_nama_perwada" name="tambah_nama_perwada" placeholder="KP Jakarta" readonly="">
                            <input class="form-control" type="hidden" id="tambah_id_perwada" name="tambah_id_perwada" placeholder="KP Jakarta" readonly="">
                        </div>
                        <div class="col-md">
                            <label for="fullname" class="form-label">Kode Pengajuan</label>
                            <input class="form-control" type="text" id="tambah_kode_pengajuan" name="tambah_kode_pengajuan" placeholder="CSesuai Dengan Kode Pengajuan" readonly="">
                        </div>
                        <div class="row g-2">
                            <div class="col-md">
                                <label for="fullname" class="form-label">Kode Transaksi</label>
                                <input class="form-control" type="text" id="tambah_kode_transaksi" name="tambah_kode_transaksi" placeholder="Sesuai Rumus" readonly="">
                            </div>
                            <div class="col-md">
                                <label for="example-select" class="form-label">Jenis Transaksi</label>
                                <select class="form-select" id="tambah_jenis_transaksi" name="tambah_jenis_transaksi" required>
                                    <option selected>Pilih</option>
                                    <option value="Perpanjangan">Perpanjangan</option>
                                    <option value="Pelunasan Sebagian">Pelunasan Sebagian</option>
                                    <option value="Pelunasan">Pelunasan</option>
                                </select>
                            </div>
                        </div><br><br><hr>
                        <div id="divemassebelumnya" style="display: none;">
                            <h5>EMAS Sebelumnya (Jika Pilihan Pelunasan / Pelunasan Sebagian)</h5>
                            <div class="table-responsive">
                                <table class="table table-borderless table-nowrap table-centered mb-0">
                                    <thead class="text-white bg-secondary ">
                                        <tr>
                                            <th>Item emas</th>
                                            <th>Jenis</th>
                                            <th>Gramasi</th> 
                                            <th>Keping</th>
                                            <th>Gramasi Sebelumnya</th>
                                            <th>Pengurangan</th>
                                            <th>Gramasi Pengurangan</th>
                                        </tr>
                                    </thead>
                                    <tfoot id="footemassebelumnya" class="text-white bg-secondary ">
                                        <tr>
                                            <th>Total</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th id="total_keping">0</th>
                                            <th id="total_gramasi">0</th>
                                            <th id="total_buyback">0</th>
                                        </tr>
                                        </tfoot>
                                    <tbody id="bodyemassebelumnya">
                                        <!-- <tr>
                                            <td>Gold 0.1 Gram</td>
                                            <td>
                                                <span class="badge badge-primary-lighten">Reguler</span>
                                            </td>
                                            <td>0.1</td>
                                            <td>
                                                <input type="number" min="1" value="2" class="form-control"
                                                    placeholder="Qty" style="width: 90px;" readonly>
                                            </td>
                                            <td>0.2 Gram</td>
                                            <td>
                                                <input type="text" min="1" value="2" class="form-control" data-toggle="input-mask" data-mask-format="000"
                                                    placeholder="Qty" style="width: 90px;" >
                                            </td>
                                            <td>0.2 Gram</td>
                                        </tr>
                                        <tr>
                                            <td>Gold 0.1 Gram</td>
                                            <td>
                                                <span class="badge badge-primary-lighten">Reguler</span>
                                            </td>
                                            <td>0.1</td>
                                            <td>
                                                <input type="text" min="1" value="2" class="form-control" data-toggle="input-mask" data-mask-format="000"
                                                    placeholder="Qty" style="width: 90px;" readonly>
                                            </td>
                                            <td>0.2 Gram</td>
                                            <td>
                                                <input type="text" min="1" value="2" class="form-control" data-toggle="input-mask" data-mask-format="000"
                                                    placeholder="Qty" style="width: 90px;" >
                                            </td>
                                            <td>0.2 Gram</td>
                                        </tr>
                                        <tr>
                                            <td>Gold 0.1 Gram</td>
                                            <td>
                                                <span class="badge badge-primary-lighten">Reguler</span>
                                            </td>
                                            <td>0.1</td>
                                            <td>
                                                <input type="number" min="1" value="2" class="form-control"
                                                    placeholder="Qty" style="width: 90px;" readonly>
                                            </td>
                                            <td>0.2 Gram</td>
                                            <td>
                                                <input type="text" min="1" value="2" class="form-control" data-toggle="input-mask" data-mask-format="000"
                                                    placeholder="Qty" style="width: 90px;">
                                            </td>
                                            <td>0.2 Gram</td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div><hr>
                        </div>
                        <div id="divemasselanjutnya" style="display: none;">
                            <h5>EMAS Selanjutnya </h5>
                            <div class="table-responsive">
                                <table class="table table-borderless table-nowrap table-centered mb-0">
                                    <thead class="text-white bg-secondary ">
                                        <tr>
                                            <th>Item emas</th>
                                            <th>Jenis</th>
                                            <th>Gramasi</th>
                                            <th>Harga Buyback</th> 
                                            <th>Keping</th>
                                            <th>Jumlah Gramasi</th>
                                            <th>Jumlah Buyback</th>
                                        </tr>
                                    </thead>
                                    <tfoot id="footemasselanjutnya" class="text-white bg-secondary ">
                                        <tr>
                                            <th>Total</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th id="total_keping2">0</th>
                                            <th id="total_gramasi2">0</th>
                                            <th id="total_buyback2">0</th>
                                        </tr>
                                    </tfoot>
                                    <tbody id="bodyemasselanjutnya">
                                        <!-- <tr>
                                            <td>Gold 0.1 Gram</td>
                                            <td>
                                                <span class="badge badge-primary-lighten">Reguler</span>
                                            </td>
                                            <td>0.1</td>
                                            <td>Rp 150.000</td>
                                            <td>
                                                <input type="number" min="1" value="2" class="form-control"
                                                    placeholder="Qty" style="width: 90px;" readonly>
                                            </td>
                                            <td>0.2 Gram</td>
                                            <td>Rp 300.000</td>
                                        </tr>
                                        <tr>
                                            <td>Gold 0.1 Gram</td>
                                            <td>
                                                <span class="badge badge-primary-lighten">Reguler</span>
                                            </td>
                                            <td>0.1</td>
                                            <td>Rp 150.000</td>
                                            <td>
                                                <input type="number" min="1" value="2" class="form-control"
                                                    placeholder="Qty" style="width: 90px;" readonly>
                                            </td>
                                            <td>0.2 Gram</td>
                                            <td>Rp 300.000</td>
                                        </tr>
                                        <tr>
                                            <td>Gold 0.1 Gram</td>
                                            <td>
                                                <span class="badge badge-primary-lighten">Reguler</span>
                                            </td>
                                            <td>0.1</td>
                                            <td>Rp 150.000</td>
                                            <td>
                                                <input type="number" min="1" value="2" class="form-control"
                                                    placeholder="Qty" style="width: 90px;" readonly>
                                            </td>
                                            <td>0.2 Gram</td>
                                            <td>Rp 300.000</td>
                                        </tr> -->
                                    </tbody>
                                </table>
                                <input type="hidden" class="form-control" id="total_buyback2_hidden" name="total_buyback2_hidden">
                            </div><hr>
                        </div>
                        <div id="divpelunasan" style="display: none;">
                            <div class="row g-2">
                                <h5>jika pelunasan & pelunasan sebagian</h5>
                                <div class="col-md">
                                    <label for="fullname" class="form-label">Nominal Pinjaman (RP)</label>
                                    <input class="form-control" data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true" type="text" id="tambah_nominal_pinjaman" name="tambah_nominal_pinjaman"  readonly>
                                    <input type="hidden" class="form-control" id="hidden_tambah_nominal_pinjaman" name="hidden_tambah_nominal_pinjaman">
                                </div>
                                <div class="col-md">
                                    <label for="fullname" class="form-label">Pembayaran Pinjaman (RP)</label>
                                    <input class="form-control" data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true" type="text" id="tambah_pembayaran_pinjaman" name="tambah_pembayaran_pinjaman" placeholder="0" required>
                                    <input type="hidden" class="form-control" id="hidden_tambah_pembayaran_pinjaman" name="hidden_tambah_pembayaran_pinjaman">
                                </div>
                                <div class="col-md">
                                    <label for="fullname" class="form-label">Sisa Pinjaman (RP)</label>
                                    <input class="form-control" data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true" type="text" id="tambah_sisa_pinjaman" name="tambah_sisa_pinjaman"  readonly>
                                    <input type="hidden" class="form-control" id="hidden_tambah_sisa_pinjaman" name="hidden_tambah_sisa_pinjaman">
                                </div>
                            </div><br><hr>
                        </div>
                        <div id="divtransaksi"  style="display: none;">
                            <div class="row g-2">
                                <input type="hidden" id="tambah_plafond_pinjaman" name="tambah_plafond_pinjaman" class="form-control">
                                <input type="hidden" id="tambah_plafond_pinjaman_hidden" name="tambah_plafond_pinjaman_hidden" class="form-control">
                                <div class="col-md">
                                    <label for="fullname" class="form-label">Pilihan Jasa</label>
                                    <input class="form-control" type="text" id="tambah_pilihan_jasa" name="tambah_pilihan_jasa" placeholder="Jasa diawal" readonly="">
                                </div>
                                <div class="col-md">
                                    <label for="fullname" class="form-label">Perhitungan Jasa</label>
                                    <input class="form-control" type="text" id="tambah_perhitungan_jasa" name="tambah_perhitungan_jasa" placeholder="Perhitungan Baru" readonly="">
                                    <input type="hidden" class="form-control" id="tambah_jangka_waktu_1">
                                    <input type="hidden" class="form-control" id="tambah_pengali_kurangdari_satudelapan_1">
                                    <input type="hidden" class="form-control" id="tambah_pengali_diatas_dua_1">
                                    <input type="hidden" class="form-control" id="tambah_jangka_waktu_2">
                                    <input type="hidden" class="form-control" id="tambah_pengali_kurangdari_satudelapan_2">
                                    <input type="hidden" class="form-control" id="tambah_pengali_diatas_dua_2">
                                    <input type="hidden" class="form-control" id="tambah_jangka_waktu_3">
                                    <input type="hidden" class="form-control" id="tambah_pengali_kurangdari_satudelapan_3">
                                    <input type="hidden" class="form-control" id="tambah_pengali_diatas_dua_3">
                                    <input type="hidden" class="form-control" id="tambah_jangka_waktu_4">
                                    <input type="hidden" class="form-control" id="tambah_pengali_kurangdari_satudelapan_4">
                                    <input type="hidden" class="form-control" id="tambah_pengali_diatas_dua_4">
                                </div>
                                <div class="col-md">
                                    <label for="example-select" class="form-label">Jangka Waktu Permohonan</label>
                                    <select class="form-select" id="tambah_jangka_waktu_permohonan" name="tambah_jangka_waktu_permohonan" required>
                                        <option selected>Pilih</option>
                                        <option value="0">0 Hari</option>
                                        <option value="0.5">15 Hari</option>
                                        <option value="1">1 Bulan</option>
                                        <option value="2">2 Bulan</option>
                                    </select>
                                </div>
                                
                            </div><br>
                            <div class="row g-2">
                                <div class="col-md">
                                    <label for="fullname" class="form-label">Jasa GTC(otomatis)</label>
                                    <input class="form-control" type="text" id="tambah_jasa_gtc" name="tambah_jasa_gtc" placeholder="0" readonly="">
                                </div>
                                <div class="col-md">
                                    <label for="example-select" class="form-label">Pembayaran Jasa</label>
                                    <select class="form-select" id="tambah_pembayaran_jasa" name="tambah_pembayaran_jasa" required>
                                        <option>Transfer</option>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <label for="formFile" class="form-label">Upload Bukti Transfer</label>
                                    <input class="form-control" type="file" id="tambah_upload_bukti_transfer" name="tambah_upload_bukti_transfer">
                                </div><hr>
                            </div><br>
                        </div>
                        <div id="divpembayaran" style="display: none;">
                            <div class="row g-2">
                                <div class="col-md">
                                    <label for="fullname" class="form-label">Pembayaran</label>
                                    <input class="form-control" type="text" data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true" id="tambah_pembayaran" name="tambah_pembayaran" placeholder="0">
                                    <input type="hidden" class="form-control" id="tambah_pembayaran_hidden" name="tambah_pembayaran_hidden">
                                </div>
                                <div class="col-md">
                                    <label for="fullname" class="form-label">Sisa Pembayaran</label>
                                    <input class="form-control" type="text" data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true" id="tambah_sisa_pembayaran" name="tambah_sisa_pembayaran" placeholder="0" readonly>
                                    <input type="hidden" class="form-control" id="tambah_sisa_pembayaran_hidden" name="tambah_sisa_pembayaran_hidden">
                                </div>
                            </div><br>
                            <div class="row g-2">
                                <div class="col-md">
                                    <label for="fullname" class="form-label">Catatan</label>
                                    <input type="text" class="form-control" id="tambah_catatan" name="tambah_catatan">
                                </div>
                            </div><br>
                        </div>
                        <div id="divbtnsimpan" style="display: none;">
                            <div class="mb-3 text-center" >
                                <button class="btn btn-primary" id="btntambahtransaksi" name="btntambahtransaksi" type="submit"> Simpan </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endforeach
<div class="modal fade" id="modal-view-transaksi" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #afb4be">
                <h4 class="modal-title" style="color: rgb(255, 255, 255);" id="myLargeModalLabel">Lihat Transaksi</h4>
                <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-2">
                    <div class="col-4">
                        <a class="btn btn-success mb-2" value='Print' id="viewbtncetak"><i class="mdi mdi-printer"></i>Cetak Transaksi</a>
                    </div><hr> 
                </div>
                <input type="hidden" id="view_id_transaksi" class="form-control">
                <input class="form-control" type="hidden" id="view_kode_transaksi_hidden" name="view_kode_transaksi_hidden" placeholder="Sesuai Rumus" readonly="">
                <div class="row">
                    <div class="col-4">
                        <p class="font-14"><strong>Nomor Buku Anggota</strong></p>
                    </div>
                    <div class="col-8">
                        <p class="font-14" id="view_nomor_ba"><strong>: 0.123.1234567</strong> </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <p class="font-14"><strong>Nama Lengkap</strong></p>
                    </div>
                    <div class="col-8">
                        <p class="font-14" id="view_nama_lengkap"><strong>: </strong>Mukhammad Nasorudin Maulana</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <p class="font-14"><strong>Kode Pengajuan</strong></p>
                    </div>
                    <div class="col-8">
                        <p class="font-14" id="view_kode_pengajuan"><strong>: </strong>A.1234567.1</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <p class="font-14"><strong>Kode Transaksi</strong></p>
                    </div>
                    <div class="col-8">
                        <p class="font-14" id="view_kode_transaksi"><strong>: </strong>B.1234567.1.1</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <p class="font-14"><strong>Jenis Transaksi</strong></p>
                    </div>
                    <div class="col-8">
                        <p class="font-14" id="view_jenis_transaksi"><strong>: </strong>Pengajuan Baru</p>
                    </div>
                </div><hr>
                <div id="divviewemassebelumnya" style="display: none;">
                    <h5>EMAS Sebelumnya (Ini Muncul Jika data ada)</h5>
                    <div class="table-responsive">
                        <table class="table table-borderless table-nowrap table-centered mb-0">
                            <thead class="text-white bg-secondary ">
                                <tr>
                                    <th>Item emas</th>
                                    <th>Jenis</th>
                                    <th>Gramasi</th> 
                                    <th>Keping</th>
                                    <th>Gramasi Sebelumnya</th>
                                    <th>Pengurangan</th>
                                    <th>Gramasi Pengurangan</th>
                                </tr>
                            </thead>
                            <tfoot id="viewfootemassebelumnya" class="text-white bg-secondary ">
                                <tr>
                                    <th>Total</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th id="viewtotal_keping">0</th>
                                    <th id="viewtotal_gramasi">0</th>
                                    <th id="viewtotal_buyback">0</th>
                                </tr>
                                </tfoot>
                            <tbody id="viewbodyemassebelumnya">
                                <!-- <tr>
                                    <td>Gold 0.1 Gram</td>
                                    <td>
                                        <span class="badge badge-primary-lighten">Reguler</span>
                                    </td>
                                    <td>0.1</td>
                                    <td>
                                        <input type="number" min="1" value="2" class="form-control"
                                            placeholder="Qty" style="width: 90px;" readonly>
                                    </td>
                                    <td>0.2 Gram</td>
                                    <td>
                                        <input type="text" min="1" value="2" class="form-control" data-toggle="input-mask" data-mask-format="000"
                                            placeholder="Qty" style="width: 90px;" >
                                    </td>
                                    <td>0.2 Gram</td>
                                </tr>
                                <tr>
                                    <td>Gold 0.1 Gram</td>
                                    <td>
                                        <span class="badge badge-primary-lighten">Reguler</span>
                                    </td>
                                    <td>0.1</td>
                                    <td>
                                        <input type="text" min="1" value="2" class="form-control" data-toggle="input-mask" data-mask-format="000"
                                            placeholder="Qty" style="width: 90px;" readonly>
                                    </td>
                                    <td>0.2 Gram</td>
                                    <td>
                                        <input type="text" min="1" value="2" class="form-control" data-toggle="input-mask" data-mask-format="000"
                                            placeholder="Qty" style="width: 90px;" >
                                    </td>
                                    <td>0.2 Gram</td>
                                </tr>
                                <tr>
                                    <td>Gold 0.1 Gram</td>
                                    <td>
                                        <span class="badge badge-primary-lighten">Reguler</span>
                                    </td>
                                    <td>0.1</td>
                                    <td>
                                        <input type="number" min="1" value="2" class="form-control"
                                            placeholder="Qty" style="width: 90px;" readonly>
                                    </td>
                                    <td>0.2 Gram</td>
                                    <td>
                                        <input type="text" min="1" value="2" class="form-control" data-toggle="input-mask" data-mask-format="000"
                                            placeholder="Qty" style="width: 90px;">
                                    </td>
                                    <td>0.2 Gram</td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div><hr>
                </div>
                <div id="divviewemasselanjutnya" style="display: none;">
                    <h5>EMAS Selanjutnya </h5>
                    <div class="table-responsive">
                        <table class="table table-borderless table-nowrap table-centered mb-0">
                            <thead class="text-white bg-secondary ">
                                <tr>
                                    <th>Item emas</th>
                                    <th>Jenis</th>
                                    <th>Gramasi</th>
                                    <th>Harga Buyback</th> 
                                    <th>Keping</th>
                                    <th>Jumlah Gramasi</th>
                                    <th>Jumlah Buyback</th>
                                </tr>
                            </thead>
                            <tfoot id="viewfootemasselanjutnya" class="text-white bg-secondary ">
                                <tr>
                                    <th>Total</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th id="viewtotal_keping2">0</th>
                                    <th id="viewtotal_gramasi2">0</th>
                                    <th id="viewtotal_buyback2">0</th>
                                </tr>
                            </tfoot>
                            <tbody id="viewbodyemasselanjutnya">
                                <!-- <tr>
                                    <td>Gold 0.1 Gram</td>
                                    <td>
                                        <span class="badge badge-primary-lighten">Reguler</span>
                                    </td>
                                    <td>0.1</td>
                                    <td>Rp 150.000</td>
                                    <td>
                                        <input type="number" min="1" value="2" class="form-control"
                                            placeholder="Qty" style="width: 90px;" readonly>
                                    </td>
                                    <td>0.2 Gram</td>
                                    <td>Rp 300.000</td>
                                </tr>
                                <tr>
                                    <td>Gold 0.1 Gram</td>
                                    <td>
                                        <span class="badge badge-primary-lighten">Reguler</span>
                                    </td>
                                    <td>0.1</td>
                                    <td>Rp 150.000</td>
                                    <td>
                                        <input type="number" min="1" value="2" class="form-control"
                                            placeholder="Qty" style="width: 90px;" readonly>
                                    </td>
                                    <td>0.2 Gram</td>
                                    <td>Rp 300.000</td>
                                </tr>
                                <tr>
                                    <td>Gold 0.1 Gram</td>
                                    <td>
                                        <span class="badge badge-primary-lighten">Reguler</span>
                                    </td>
                                    <td>0.1</td>
                                    <td>Rp 150.000</td>
                                    <td>
                                        <input type="number" min="1" value="2" class="form-control"
                                            placeholder="Qty" style="width: 90px;" readonly>
                                    </td>
                                    <td>0.2 Gram</td>
                                    <td>Rp 300.000</td>
                                </tr> -->
                            </tbody>
                        </table>
                        <input type="hidden" class="form-control" id="viewtotal_buyback2_hidden" name="viewtotal_buyback2_hidden">
                    </div><hr>
                </div><hr>
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th style="width: 35%;"></th>
                        <th style="width: 65%;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Nominal Pinjaman</td>
                        <td id="view_nominal_pinjaman">: Rp 10.000.000</td>
                    </tr>
                    <tr>
                        <td>Pembayaran Pinjaman</td>
                        <td id="view_pembayaran_pinjaman">: Rp 5.000.000</td>
                    </tr>
                    <tr>
                        <td>Pinjaman Saat ini/Sisa Pinjaman</td>
                        <td id="view_sisa_pinjaman">: Rp 5.000.000</td>
                    </tr>
                    <tr>
                        <td>Pilihan Jasa</td>
                        <td id="view_pilihan_jasa">: Jasa Di awal</td>
                    </tr>
                    <tr>
                        <td>Perhitungan Jasa</td>
                        <td id="view_perhitungan_jasa">: Jasa Baru</td>
                    </tr>
                    <tr>
                        <td>Jangka Waktu Permohonan</td>
                        <td id="view_jangka_waktu_permohonan">: 1 Bulan</td>
                    </tr>
                    <tr>
                        <td>Jasa GTC</td>
                        <td id="view_jasa_gtc">: Rp. 20.000</td>
                    </tr>
                    <tr>
                        <td>Pembayaran Jasa</td>
                        <td id="view_pembayaran_jasa">: Transfer</td>
                    </tr>
                    <tr>
                        <td>Pembayaran</td>
                        <td id="view_pembayaran">: Rp. 20.000</td>
                    </tr>
                    <tr>
                        <td>Sisa Pembayaran</td>
                        <td id="view_sisa_pembayaran">: Rp. 0</td>
                    </tr>
                    </tbody>
                </table><br>
                <div class="col-4">
                    <p class="font-14"><strong>Bukti Transfer (Pembayaran)</strong></p>
                </div>
                <img src="assets/images/small/small-2.jpg" id="view_bukti_transfer" alt="image" class="img-fluid rounded" width="600"/>
                <hr>
                <div class="col-4">
                    <p class="font-14"><strong>Bukti Transfer (Pinjaman)</strong></p>
                </div>
                <img src="assets/images/small/small-2.jpg" id="view_buktitrf_upload" alt="image" class="img-fluid rounded" width="600"/>
                <hr>
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th style="width: 35%;"></th>
                        <th style="width: 65%;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Catatan</td>
                        <td id="view_catatan">: -</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="modal-upload-buktitrf" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #afb4be">
                <h4 class="modal-title" style="color: rgb(255, 255, 255);" id="myLargeModalLabel">Upload Bukti Transfer (Pinjaman)</h4>
                <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form id="formbuktitrf">
                    @csrf
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="buktitrf_id_transaksi" id="buktitrf_id_transaksi" class="form-control">
                    <div class="row">
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Tanggal Transfer</label>
                            <input class="form-control datepicker" type="text" name="buktitrf_tgl" id="buktitrf_tgl" value="{{date('d/m/Y')}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Nominal Transfer (RP)</label>
                            <input class="form-control" data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true" type="text" name="buktitrf_nominal" id="buktitrf_nominal" required>
                        </div>
                        <div class="mb-3">
                            <label for="example-fileinput" class="form-label">Upload Bukti Trf</label>
                            <input type="file" name="buktitrf_upload" id="buktitrf_upload" class="form-control">
                            <input type="hidden" name="old_buktitrf_upload" id="old_buktitrf_upload" class="form-control">
                        </div>
                        <div class="mb-3 text-center" >
                            <button class="btn btn-primary" type="submit" id="btnbuktitrf"> Simpan </button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="modal-edit-transaksi" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #afb4be">
                <h4 class="modal-title" style="color: rgb(255, 255, 255);" id="myLargeModalLabel">Edit Transaksi</h4>
                <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form id="formedittransaksi" method="post" novalidate>
                    @csrf
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" id="edit_id_pengajuan" name="edit_id_pengajuan" class="form-control">
                    <input type="hidden" id="edit_id_transaksi" name="edit_id_transaksi" class="form-control">
                    <div class="row g-2">
                        <div class="col-md">
                            <label for="fullname" class="form-label">Perwada (sesuai dg Akun)</label>
                            <input class="form-control" type="text" id="edit_nama_perwada" name="edit_nama_perwada" placeholder="KP Jakarta" readonly="">
                            <input class="form-control" type="hidden" id="edit_id_perwada" name="edit_id_perwada" placeholder="KP Jakarta" readonly="">
                        </div>
                        <div class="col-md">
                            <label for="fullname" class="form-label">Kode Pengajuan</label>
                            <input class="form-control" type="text" id="edit_kode_pengajuan" name="edit_kode_pengajuan" placeholder="CSesuai Dengan Kode Pengajuan" readonly="">
                        </div>
                        <div class="row g-2">
                            <div class="col-md">
                                <label for="fullname" class="form-label">Kode Transaksi</label>
                                <input class="form-control" type="text" id="edit_kode_transaksi" name="edit_kode_transaksi" placeholder="Sesuai Rumus" readonly="">
                            </div>
                            <div class="col-md">
                                <label for="example-select" class="form-label">Jenis Transaksi</label>
                                <select class="form-select" id="edit_jenis_transaksi" name="edit_jenis_transaksi" required>
                                    <option selected>Pilih</option>
                                    <option value="Perpanjangan">Perpanjangan</option>
                                    <option value="Pelunasan Sebagian">Pelunasan Sebagian</option>
                                    <option value="Pelunasan">Pelunasan</option>
                                </select>
                                <select class="form-select" id="hidden_edit_jenis_transaksi" name="hidden_edit_jenis_transaksi" style="display: none;" required>
                                    <option selected>Pilih</option>
                                    <option value="Pengajuan Baru" selected>Pengajuan Baru</option>
                                </select>
                            </div>
                        </div><br><br><hr>
                        <div id="diveditemassebelumnya" style="display: none;">
                            <h5>EMAS Sebelumnya (Jika Pilihan Pelunasan / Pelunasan Sebagian)</h5>
                            <div class="table-responsive">
                                <table class="table table-borderless table-nowrap table-centered mb-0">
                                    <thead class="text-white bg-secondary ">
                                        <tr>
                                            <th>Item emas</th>
                                            <th>Jenis</th>
                                            <th>Gramasi</th> 
                                            <th>Keping</th>
                                            <th>Gramasi Sebelumnya</th>
                                            <th>Pengurangan</th>
                                            <th>Gramasi Pengurangan</th>
                                        </tr>
                                    </thead>
                                    <tfoot id="editfootemassebelumnya" class="text-white bg-secondary ">
                                        <tr>
                                            <th>Total</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th id="edittotal_keping">0</th>
                                            <th id="edittotal_gramasi">0</th>
                                            <th id="edittotal_buyback">0</th>
                                        </tr>
                                        </tfoot>
                                    <tbody id="editbodyemassebelumnya">
                                        <!-- <tr>
                                            <td>Gold 0.1 Gram</td>
                                            <td>
                                                <span class="badge badge-primary-lighten">Reguler</span>
                                            </td>
                                            <td>0.1</td>
                                            <td>
                                                <input type="number" min="1" value="2" class="form-control"
                                                    placeholder="Qty" style="width: 90px;" readonly>
                                            </td>
                                            <td>0.2 Gram</td>
                                            <td>
                                                <input type="text" min="1" value="2" class="form-control" data-toggle="input-mask" data-mask-format="000"
                                                    placeholder="Qty" style="width: 90px;" >
                                            </td>
                                            <td>0.2 Gram</td>
                                        </tr>
                                        <tr>
                                            <td>Gold 0.1 Gram</td>
                                            <td>
                                                <span class="badge badge-primary-lighten">Reguler</span>
                                            </td>
                                            <td>0.1</td>
                                            <td>
                                                <input type="text" min="1" value="2" class="form-control" data-toggle="input-mask" data-mask-format="000"
                                                    placeholder="Qty" style="width: 90px;" readonly>
                                            </td>
                                            <td>0.2 Gram</td>
                                            <td>
                                                <input type="text" min="1" value="2" class="form-control" data-toggle="input-mask" data-mask-format="000"
                                                    placeholder="Qty" style="width: 90px;" >
                                            </td>
                                            <td>0.2 Gram</td>
                                        </tr>
                                        <tr>
                                            <td>Gold 0.1 Gram</td>
                                            <td>
                                                <span class="badge badge-primary-lighten">Reguler</span>
                                            </td>
                                            <td>0.1</td>
                                            <td>
                                                <input type="number" min="1" value="2" class="form-control"
                                                    placeholder="Qty" style="width: 90px;" readonly>
                                            </td>
                                            <td>0.2 Gram</td>
                                            <td>
                                                <input type="text" min="1" value="2" class="form-control" data-toggle="input-mask" data-mask-format="000"
                                                    placeholder="Qty" style="width: 90px;">
                                            </td>
                                            <td>0.2 Gram</td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div><hr>
                        </div>
                        <div id="diveditemasselanjutnya" style="display: none;">
                            <h5>EMAS Selanjutnya </h5>
                            <div class="table-responsive">
                                <table class="table table-borderless table-nowrap table-centered mb-0">
                                    <thead class="text-white bg-secondary ">
                                        <tr>
                                            <th>Item emas</th>
                                            <th>Jenis</th>
                                            <th>Gramasi</th>
                                            <th>Harga Buyback</th> 
                                            <th>Keping</th>
                                            <th>Jumlah Gramasi</th>
                                            <th>Jumlah Buyback</th>
                                        </tr>
                                    </thead>
                                    <tfoot id="editfootemasselanjutnya" class="text-white bg-secondary ">
                                        <tr>
                                            <th>Total</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th id="edittotal_keping2">0</th>
                                            <th id="edittotal_gramasi2">0</th>
                                            <th id="edittotal_buyback2">0</th>
                                        </tr>
                                    </tfoot>
                                    <tbody id="editbodyemasselanjutnya">
                                        <!-- <tr>
                                            <td>Gold 0.1 Gram</td>
                                            <td>
                                                <span class="badge badge-primary-lighten">Reguler</span>
                                            </td>
                                            <td>0.1</td>
                                            <td>Rp 150.000</td>
                                            <td>
                                                <input type="number" min="1" value="2" class="form-control"
                                                    placeholder="Qty" style="width: 90px;" readonly>
                                            </td>
                                            <td>0.2 Gram</td>
                                            <td>Rp 300.000</td>
                                        </tr>
                                        <tr>
                                            <td>Gold 0.1 Gram</td>
                                            <td>
                                                <span class="badge badge-primary-lighten">Reguler</span>
                                            </td>
                                            <td>0.1</td>
                                            <td>Rp 150.000</td>
                                            <td>
                                                <input type="number" min="1" value="2" class="form-control"
                                                    placeholder="Qty" style="width: 90px;" readonly>
                                            </td>
                                            <td>0.2 Gram</td>
                                            <td>Rp 300.000</td>
                                        </tr>
                                        <tr>
                                            <td>Gold 0.1 Gram</td>
                                            <td>
                                                <span class="badge badge-primary-lighten">Reguler</span>
                                            </td>
                                            <td>0.1</td>
                                            <td>Rp 150.000</td>
                                            <td>
                                                <input type="number" min="1" value="2" class="form-control"
                                                    placeholder="Qty" style="width: 90px;" readonly>
                                            </td>
                                            <td>0.2 Gram</td>
                                            <td>Rp 300.000</td>
                                        </tr> -->
                                    </tbody>
                                </table>
                                <input type="hidden" class="form-control" id="edittotal_buyback2_hidden" name="edittotal_buyback2_hidden">
                            </div><hr>
                        </div>
                        <div id="diveditpelunasan" style="display: none;">
                            <div class="row g-2">
                                <h5>jika pelunasan & pelunasan sebagian</h5>
                                <div class="col-md">
                                    <label for="fullname" class="form-label">Nominal Pinjaman (RP)</label>
                                    <input class="form-control" data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true" type="text" id="edit_nominal_pinjaman" name="edit_nominal_pinjaman"  readonly>
                                    <input type="hidden" class="form-control" id="hidden_edit_nominal_pinjaman" name="hidden_edit_nominal_pinjaman">
                                </div>
                                <div class="col-md">
                                    <label for="fullname" class="form-label">Pembayaran Pinjaman (RP)</label>
                                    <input class="form-control" data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true" type="text" id="edit_pembayaran_pinjaman" name="edit_pembayaran_pinjaman" placeholder="0" required>
                                    <input type="hidden" class="form-control" id="hidden_edit_pembayaran_pinjaman" name="hidden_edit_pembayaran_pinjaman">
                                </div>
                                <div class="col-md">
                                    <label for="fullname" class="form-label">Sisa Pinjaman (RP)</label>
                                    <input class="form-control" data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true" type="text" id="edit_sisa_pinjaman" name="edit_sisa_pinjaman"  readonly>
                                    <input type="hidden" class="form-control" id="hidden_edit_sisa_pinjaman" name="hidden_edit_sisa_pinjaman">
                                </div>
                            </div><br><hr>
                        </div>
                        <div id="divedittransaksi"  style="display: none;">
                            <div class="row g-2">
                                <input type="hidden" id="edit_plafond_pinjaman" name="edit_plafond_pinjaman" class="form-control">
                                <input type="hidden" id="edit_plafond_pinjaman_hidden" name="edit_plafond_pinjaman_hidden" class="form-control">
                                <div class="col-md">
                                    <label for="fullname" class="form-label">Pilihan Jasa</label>
                                    <input class="form-control" type="text" id="edit_pilihan_jasa" name="edit_pilihan_jasa" placeholder="Jasa diawal" readonly="">
                                </div>
                                <div class="col-md">
                                    <label for="fullname" class="form-label">Perhitungan Jasa</label>
                                    <input class="form-control" type="text" id="edit_perhitungan_jasa" name="edit_perhitungan_jasa" placeholder="Perhitungan Baru" readonly="">
                                    <input type="hidden" class="form-control" id="edit_jangka_waktu_1">
                                    <input type="hidden" class="form-control" id="edit_pengali_kurangdari_satudelapan_1">
                                    <input type="hidden" class="form-control" id="edit_pengali_diatas_dua_1">
                                    <input type="hidden" class="form-control" id="edit_jangka_waktu_2">
                                    <input type="hidden" class="form-control" id="edit_pengali_kurangdari_satudelapan_2">
                                    <input type="hidden" class="form-control" id="edit_pengali_diatas_dua_2">
                                    <input type="hidden" class="form-control" id="edit_jangka_waktu_3">
                                    <input type="hidden" class="form-control" id="edit_pengali_kurangdari_satudelapan_3">
                                    <input type="hidden" class="form-control" id="edit_pengali_diatas_dua_3">
                                    <input type="hidden" class="form-control" id="edit_jangka_waktu_4">
                                    <input type="hidden" class="form-control" id="edit_pengali_kurangdari_satudelapan_4">
                                    <input type="hidden" class="form-control" id="edit_pengali_diatas_dua_4">
                                </div>
                                <div class="col-md">
                                    <label for="example-select" class="form-label">Jangka Waktu Permohonan</label>
                                    <select class="form-select" id="edit_jangka_waktu_permohonan" name="edit_jangka_waktu_permohonan" required>
                                        <option selected>Pilih</option>
                                        <option value="0">0 Hari</option>
                                        <option value="0.5">15 Hari</option>
                                        <option value="1">1 Bulan</option>
                                        <option value="2">2 Bulan</option>
                                    </select>
                                </div>
                                
                            </div><br>
                            <div class="row g-2">
                                <div class="col-md">
                                    <label for="fullname" class="form-label">Jasa GTC(otomatis)</label>
                                    <input class="form-control" type="text" id="edit_jasa_gtc" name="edit_jasa_gtc" placeholder="0" readonly="">
                                </div>
                                <div class="col-md">
                                    <label for="example-select" class="form-label">Pembayaran Jasa</label>
                                    <select class="form-select" id="edit_pembayaran_jasa" name="edit_pembayaran_jasa" required>
                                        <option>Transfer</option>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <label for="formFile" class="form-label">Upload Bukti Transfer</label>
                                    <input class="form-control" type="file" id="edit_upload_bukti_transfer" name="edit_upload_bukti_transfer">
                                    <input class="form-control" type="hidden" id="edit_hidden_upload_bukti_transfer" name="edit_hidden_upload_bukti_transfer" readonly>
                                </div><hr>
                            </div><br>
                        </div>
                        <div id="diveditpembayaran" style="display: none;">
                            <div class="row g-2">
                                <div class="col-md">
                                    <label for="fullname" class="form-label">Pembayaran</label>
                                    <input class="form-control" type="text" data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true" id="edit_pembayaran" name="edit_pembayaran" placeholder="0">
                                    <input type="hidden" class="form-control" id="edit_pembayaran_hidden" name="edit_pembayaran_hidden">
                                </div>
                                <div class="col-md">
                                    <label for="fullname" class="form-label">Sisa Pembayaran</label>
                                    <input class="form-control" type="text" data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true" id="edit_sisa_pembayaran" name="edit_sisa_pembayaran" placeholder="0" readonly>
                                    <input type="hidden" class="form-control" id="edit_sisa_pembayaran_hidden" name="edit_sisa_pembayaran_hidden">
                                </div>
                            </div><br>
                            <div class="row g-2">
                                <div class="col-md">
                                    <label for="fullname" class="form-label">Catatan</label>
                                    <input type="text" class="form-control" id="edit_catatan" name="edit_catatan">
                                </div>
                            </div><br>
                        </div>
                        <div id="diveditbtnsimpan" style="display: none;">
                            <div class="mb-3 text-center" >
                                <button class="btn btn-primary" id="btnedittransaksi" type="submit"> Simpan </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="modal-jasadiahir-transaksi" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document"">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #afb4be">
                <h4 class="modal-title" style="color: rgb(255, 255, 255);" id="myLargeModalLabel">Transaksi Jasa Di Akhir</h4>
                <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form id="formjasadiakhirtransaksi">
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" class="form-control" id="jasadiakhir_id_transaksi" name="jasadiakhir_id_transaksi">
                    <input type="hidden" class="form-control" id="jasadiakhir_id_pengajuan" name="jasadiakhir_id_pengajuan">
                    <div class="row g-2">
                        <div class="col-md">
                            <label for="fullname" class="form-label">Perwada (sesuai dg Akun)</label>
                            <input class="form-control" type="text" id="jasadiakhir_nama_perwada" name="jasadiakhir_nama_perwada" placeholder="KP Jakarta" readonly="">
                            <input class="form-control" type="hidden" id="jasadiakhir_id_perwada" name="jasadiakhir_id_perwada" placeholder="KP Jakarta" readonly="">
                        </div>
                        <div class="col-md">
                            <label for="fullname" class="form-label">Kode Pengajuan</label>
                            <input class="form-control" type="text" id="jasadiakhir_kode_pengajuan" name="jasadiakhir_kode_pengajuan" placeholder="CSesuai Dengan Kode Pengajuan" readonly="">
                        </div>
                        <div class="row g-2">
                            <div class="col-md">
                                <label for="fullname" class="form-label">Kode Transaksi</label>
                                <input class="form-control" type="text" id="jasadiakhir_kode_transaksi" name="jasadiakhir_kode_transaksi" placeholder="Sesuai Rumus" readonly="">
                            </div>
                        </div><br><br><hr>
                        <div class="row g-2">
                            <input type="hidden" id="jasadiakhir_plafond_pinjaman" name="jasadiakhir_plafond_pinjaman" class="form-control">
                                <input type="hidden" id="jasadiakhir_plafond_pinjaman_hidden" name="jasadiakhir_plafond_pinjaman_hidden" class="form-control">
                            <div class="col-md">
                                <label for="fullname" class="form-label">Pilihan Jasa</label>
                                <input class="form-control" type="text" id="jasadiakhir_pilihan_jasa" name="jasadiakhir_pilihan_jasa" placeholder="Jasa diawal" readonly="">
                            </div>
                            <div class="col-md">
                                <label for="fullname" class="form-label">Perhitungan Jasa</label>
                                <input class="form-control" type="text" id="jasadiakhir_perhitungan_jasa" name="jasadiakhir_perhitungan_jasa" placeholder="Perhitungan Baru" readonly="">
                                <input type="hidden" class="form-control" id="jasadiakhir_jangka_waktu_1">
                                <input type="hidden" class="form-control" id="jasadiakhir_pengali_kurangdari_satudelapan_1">
                                <input type="hidden" class="form-control" id="jasadiakhir_pengali_diatas_dua_1">
                                <input type="hidden" class="form-control" id="jasadiakhir_jangka_waktu_2">
                                <input type="hidden" class="form-control" id="jasadiakhir_pengali_kurangdari_satudelapan_2">
                                <input type="hidden" class="form-control" id="jasadiakhir_pengali_diatas_dua_2">
                                <input type="hidden" class="form-control" id="jasadiakhir_jangka_waktu_3">
                                <input type="hidden" class="form-control" id="jasadiakhir_pengali_kurangdari_satudelapan_3">
                                <input type="hidden" class="form-control" id="jasadiakhir_pengali_diatas_dua_3">
                                <input type="hidden" class="form-control" id="jasadiakhir_jangka_waktu_4">
                                <input type="hidden" class="form-control" id="jasadiakhir_pengali_kurangdari_satudelapan_4">
                                <input type="hidden" class="form-control" id="jasadiakhir_pengali_diatas_dua_4">
                            </div>
                            <div class="col-md">
                                <label for="example-select" class="form-label">Jangka Waktu Permohonan</label>
                                <select class="form-select" id="jasadiakhir_jangka_waktu_permohonan" name="jasadiakhir_jangka_waktu_permohonan" required>
                                    <option selected>Pilih</option>
                                    <option value="0.5">15 Hari</option>
                                    <option value="1">1 Bulan</option>
                                    <option value="2">2 Bulan</option>
                                </select>
                            </div>
                            
                        </div><br>
                        
                        <div class="row g-2">
                            <div class="col-md">
                                <label for="fullname" class="form-label">Jasa GTC(otomatis)</label>
                                <input class="form-control" type="text" id="jasadiakhir_jasa_gtc" name="jasadiakhir_jasa_gtc" placeholder="Rp 20.000" readonly="">
                            </div>
                            <div class="col-md">
                                <label for="example-select" class="form-label">Pembayaran Jasa</label>
                                <select class="form-select" id="jasadiakhir_pembayaranjasa" name="jasadiakhir_pembayaranjasa" required>
                                    <option>Transfer</option>
                                </select>
                            </div>
                            <div class="col-md">
                                <label for="formFile" class="form-label">Upload Bukti Transfer</label>
                                <input class="form-control" type="file" id="jasadiakhir_upload_bukti_transfer" name="jasadiakhir_upload_bukti_transfer">
                                <input class="form-control" type="hidden" id="old_jasadiakhir_upload_bukti_transfer" name="old_jasadiakhir_upload_bukti_transfer">
                            </div><hr>
                        </div><br>
                        <div class="row g-2">
                            <div class="col-md">
                                <label for="fullname" class="form-label">Pembayaran</label>
                                <input class="form-control" type="text" data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true" id="jasadiakhir_pembayaran" name="jasadiakhir_pembayaran" placeholder="0">
                                <input class="form-control" type="hidden" id="jasadiakhir_pembayaran_hidden" name="jasadiakhir_pembayaran_hidden" placeholder="0">
                            </div>
                        </div><br>
                        <div class="mb-3 text-center" >
                            <button class="btn btn-primary" id="btnsimpan_jasadiakhir" type="submit"> Simpan </button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="warning-aproval-opr" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="dripicons-warning h1 text-warning"></i>
                    <h4 class="mt-2">Perhatian</h4>
                    <p class="mt-3">Data Transaksi An. XXXXXXX Akan di <strong>Setujui</strong> Pastikan data yang akan di setujui lengkap & Sesuai</p>
                    <p> Silakan klik <strong>Aprov</strong> jika sudah yakin</p>
                    <form id="formaprovalopr">
                        @csrf
                        <input type="hidden" name="_method" value="put">
                        <input type="hidden" name="aprovalopr_id_transaksi" id="aprovalopr_id_transaksi" class="form-control">
                        <button id="btnaprovalopr" type="submit" class="btn btn-success my-2">Aprov</button>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div id="warning-aproval-keu" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="dripicons-warning h1 text-warning"></i>
                    <h4 class="mt-2">Perhatian</h4>
                    <p class="mt-3">Data Transaksi An. XXXXXXX Akan di <strong>Setujui</strong> Pastikan data yang akan di setujui lengkap & Sesuai</p>
                    <p> Silakan klik <strong>Aprov</strong> jika sudah yakin</p>
                    <form id="formaprovalkeu">
                        @csrf
                        <input type="hidden" name="_method" value="put">
                        <input type="hidden" class="form-control" name="aprovalkeu_id_transaksi" id="aprovalkeu_id_transaksi">
                        <button id="btnaprovalkeu" type="submit" class="btn btn-success my-2">Aprov</button>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

@endsection
@push('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('customjs/backend/transaksi.js')}}"></script>
<script src="{{asset('customjs/backend/loading.js')}}"></script>
<script>
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
    });
</script>
<script type="text/javascript">  
    var perwada=<?php echo $perwada; ?>;
</script>
<!-- <script>
    reload();
    function reload(){
        $('#reload').on('click', function(e){
            $('#list-data').DataTable().ajax.reload();
        })
    }
</script> -->
@endpush