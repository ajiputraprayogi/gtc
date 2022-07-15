@extends('layouts.base')
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('customjs/backend/loading.css')}}">
@endsection
@section('content') 
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Get The Cash</a></li>
                            <li class="breadcrumb-item active">Aproval Pengajuan GTC</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Aproval Data GTC</h4>
                </div>
            </div>
        </div>
        <!-- end page title --> 

        <div class="row">
            <div class="col-12">
                <div class="card d-block">
                    <div class="card-header bg-secondary border-danger border-3" >
                        <div class=" align-items-center mb-2 text-white">
                            <h3>Aproval Pengajuan GTC</h3>
                        </div>
                    </div>
                    @foreach($data as $row)
                    <div class="card-body">
                            
                        <div class="row mb-2">
                                <div class="col-4">
                                    <a class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#aproval-bm-modal"><i class="mdi mdi-bookmark-check"></i>Aproval BM</a>
                                    <!-- <a class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#aproval-opr-modal"><i class="mdi mdi-bookmark-check"></i>Aproval OPR</a>
                                    <a class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#aproval-keu-modal"><i class="mdi mdi-bookmark-check"></i>Aproval KEU</a> -->
                                </div>
                                <div class="col-4">
                                    <a href="{{url('backend/pengajuan-gtc')}}" class="btn btn-info mb-2"><i class="mdi mdi-arrow-left-bold-circle-outline"></i> Kembali</a>
                                </div>
                                <div class="col-4">
                                    <a href="" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modal-view-pemohon"><i class="mdi mdi-card-search-outline"></i> Detail Pemohon</a>
                                </div><hr> 
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="font-14"><strong>Nomor Buku Anggota :</strong> {{$row->nomor_ba}}</p>
                            </div>
                            <div class="col-sm-4">
                                <p class="font-14"><strong>Nama Lengkap :</strong> {{$row->nama_lengkap}}</p>
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
                                            <td>: {{$row->tanggal_pengajuan}}</td>
                                        </tr>
                                        <tr>
                                            <td>Perwada</td>
                                            <td>: {{$row->id_perwada}}</td>
                                        </tr>
                                        <tr>
                                            <td>Kode Pengajuan</td>
                                            <td>: {{$row->kode_pengajuan}}</td>
                                        </tr>
                                        <tr>
                                            <td>Tujuan</td>
                                            <td>: {{$row->tujuan}}</td>
                                        </tr>
                                        <tr>
                                            @php
                                                $total_keping = DB::table('gtc_emas')->where('kode_pengajuan', $row->kode_pengajuan)->sum('keping');
                                            @endphp
                                            <td>Total Keping</td>
                                            <td>: {{$total_keping . " Keping"}}</td>
                                        </tr>
                                        <tr>
                                            @php
                                                $total_gramasi = DB::table('gtc_emas')
                                                ->where('kode_pengajuan', $row->kode_pengajuan)
                                                ->select(DB::raw('sum(gramasi*keping)as total_gramasi'))
                                                ->get();
                                                foreach($total_gramasi as $gramasi){
                                                    $total_gramasi = $gramasi->total_gramasi;
                                                }
                                            @endphp
                                            <td>Jumlah Gramasi</td>
                                            <td>: {{$total_gramasi . " Gram"}}</td>
                                        </tr>
                                        <tr>
                                            @php
                                                $total_buyback = DB::table('gtc_emas')
                                                ->where('kode_pengajuan', $row->kode_pengajuan)
                                                ->select(DB::raw('sum(harga_buyback*keping)as total_buyback'))
                                                ->get();
                                                foreach($total_buyback as $harga_buyback){
                                                    $total_buyback = $harga_buyback->total_buyback;
                                                }
                                            @endphp
                                            <td>Total Buyback</td>
                                            <td>: {{"Rp " . number_format($total_buyback,0,'.','.')}}</td>
                                        </tr>
                                        <tr>
                                            <td>Plafond Pinjaman</td>
                                            <td>: {{"Rp " . number_format($row->plafond_pinjaman,0,'.','.')}}</td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <div class="table-responsive">
                                        <br><h5>Transaksi & Transfer</h5>
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
                                            <td>Pengajuan</td>
                                            <td>: {{"Rp " . number_format($row->pengajuan,0,'.','.')}}</td>
                                        </tr>
                                        <tr>
                                            <td>Pembayaran Jasa</td>
                                            <td>: {{$row->pembayaran_jasa}}</td>
                                        </tr>
                                        <tr>
                                            <td>Nominal Potongan Simp.Wa</td>
                                            <td>: {{"Rp " . number_format($row->nominal_potongan,0,'.','.')}}</td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Yang di Transfer</td>
                                            <td>: {{"Rp " . number_format($row->jumlah_yang_di_transfer,0,'.','.')}}</td>
                                        </tr>
                                        <tr>
                                            <td>Bank Transfer</td>
                                            <td>: {{$row->pilihan_bank}}</td>
                                        </tr>
                                        <tr>
                                            <td>Nomor Rekening</td>
                                            <td>: {{$row->nomor_rekening}}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama Pemilik Rekening</td>
                                            <td>: {{$row->nama_pemilik_rekening}}</td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <div class="table-responsive">
                                        <br><h5>Status Aproval</h5>
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
                                            <td>Status Aproval</td>
                                            <td>: Proses</td>
                                        </tr>
                                        <tr>
                                            <td>Aproval BM</td>
                                            <td>: 20 Mei 2022 13:30</td>
                                        </tr>
                                        <tr>
                                            <td>Aproval OPR</td>
                                            <td>: 20 Mei 2022 13:30</td>
                                        </tr>
                                        <tr>
                                            <td>Aproval Keu</td>
                                            <td>: 20 Mei 2022 13:30</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div><br>
                                <div class="col-lg-6 card">
                                    <div class="table-responsive">
                                        <br><h5>Dokumen</h5>
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
                                            <td>: {{$row->jenis_transaksi}}</td>
                                        </tr>
                                        <tr>
                                            <td>Foto Emas</td>
                                            <td>: <img src="{{asset('img/foto_gold/'.$row->upload_foto_gold)}}" alt="image" class="img-fluid rounded" width="350"/></td>
                                        </tr>
                                        <tr @if($row->tipe_transaksi == 'Online') @else hidden @endif>
                                            <td>Foto Pengajuan</td>
                                            <td>: <img src="{{asset('img/form_pengajuan/'.$row->upload_form_pengajuan)}}" alt="image" class="img-fluid rounded" width="350"/></td>
                                        </tr>
                                        <tr>
                                            <td>Tandatangan</td>
                                            <td>: <img src="{{asset('tandatangan/'.$row->tanda_tangan)}}" alt="image" class="img-fluid rounded" width="350"/></td>
                                        </tr>
                                        <tr>
                                            <td>Surat Terima Transfer</td>
                                            <td>: <img src="{{asset('img/surat_terima_transfer/'.$row->upload_surat_terima_transfer)}}" alt="image" class="img-fluid rounded" width="350"/></td>
                                        </tr>
                                        <tr>
                                            <td>Surat Kuasa</td>
                                            <td>: <img src="{{asset('img/surat_kuasa/'.$row->surat_kuasa_penjualan_jaminan_marhum)}}" alt="image" class="img-fluid rounded" width="350"/></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    
                                </div><br>
                                
                                

                                
                            </div>
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-borderless table-nowrap table-centered mb-0">
                                        <h5>Detail Emas Pengajuan GTC</h5>
                                        <thead class="text-white bg-secondary ">
                                            <tr>
                                                <th>Item emas</th>
                                                <th>Jenis</th>
                                                <th>Gramasi</th>
                                                <th>Harga Buyback</th> 
                                                <th>Keping</th>
                                                <th>Jumlah Gramasi</th>
                                                <th>Jumlah Buyback</th>
                                                <th style="width: 50px;"></th>
                                            </tr>
                                        </thead>
                                        <tfoot class="text-white bg-secondary ">
                                            <tr>
                                                <th>Total</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>{{$total_keping . " Keping"}}</th>
                                                <th>{{$total_gramasi . " Gram"}}</th>
                                                <th>{{"Rp " . number_format($total_buyback,0,'.','.')}}</th>
                                                <th style="width: 50px;"></th>
                                            </tr>
                                            </tfoot>
                                        <tbody>
                                            @php
                                                $detail_emas = DB::table('gtc_emas')->where('kode_pengajuan', $row->kode_pengajuan)->get();
                                            @endphp
                                            @foreach($detail_emas as $d_emas)
                                            <tr>
                                                <td>{{$d_emas->item_emas}}</td>
                                                <td>
                                                    <span class="badge badge-primary-lighten">{{$d_emas->jenis}}</span>
                                                </td>
                                                <td>{{$d_emas->gramasi}}</td>
                                                <td>{{"Rp " . number_format($d_emas->harga_buyback,0,'.','.')}}</td>
                                                <td>{{$d_emas->keping . " Keping"}}</td>
                                                <td>{{$d_emas->gramasi*$d_emas->keping . " Gram"}}</td>
                                                <td>{{"Rp " . number_format($d_emas->harga_buyback*$d_emas->keping,0,'.','.')}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div><hr><br>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="table-responsive">
                                            <h5>Tabel Transaksi</h5>
                                            <table class="table mb-0">
                                                <thead class="table-light">
                                                <tr>
                                                    <th>Tandatangan Admin</th>
                                                    <th>Tandatangan BM</th>
                                                    <th>Tandatangan OPR</th>
                                                    <th>Tandatangan Keuangan</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tbody>
                                            </table>
                                        </div>
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


    <div id="aproval-bm-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-m">
            <div class="modal-content modal-filled bg-danger">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="dripicons-warning h1 text-warning"></i>
                        <h4 class="mt-2">Aproval BM</h4><br><br>
                        @foreach($data as $row)
                        <form id="formeditaprovalbm">
                            @csrf
                            <input type="hidden" name="_method" value="put">
                            <input type="hidden" class="form-control" name="id_pengajuan" id="id_pengajuan" value="{{$row->idp}}">
                            <div class="mb-3">
                                <label for="example-select" class="form-label">Status</label>
                                <select class="form-select" id="example-select" name="status">
                                    <option>Proses</option>
                                    <option>Doc. Belum Lengkap</option>
                                    <option>Tidak Disetujui</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="fullname" class="form-label">Catatan</label>
                                <input class="form-control" type="text" placeholder="" id="fullname" name="catatan" required>
                            </div>
                            <button type="submit" id="btneditaprovalbm" class="btn btn-warning my-2">Simpan</button>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div id="aproval-opr-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-m">
            <div class="modal-content modal-filled bg-danger">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="dripicons-warning h1 text-warning"></i>
                        <h4 class="mt-2">Aproval OPR</h4><br><br>
                        <form action="#">
                            <div class="mb-3">
                                <label for="example-select" class="form-label">Status</label>
                                <select class="form-select" id="example-select">
                                    <option>Proses</option>
                                    <option>Doc. Belum Lengkap</option>
                                    <option>Tidak Disetujui</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="fullname" class="form-label">Catatan</label>
                                <input class="form-control" type="text" placeholder="" id="fullname" required>
                            </div>
                        </form>
                        <button type="button" class="btn btn-warning my-2" data-bs-dismiss="modal">Simpan</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


        <div id="aproval-keu-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-m">
                <div class="modal-content modal-filled bg-danger">
                    <div class="modal-body p-4">
                        <div class="text-center">
                            <i class="dripicons-warning h1 text-warning"></i>
                            <h4 class="mt-2">Aproval OPR</h4><br><br>
                            <form action="#">
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Status</label>
                                    <select class="form-select" id="example-select">
                                        <option>Disetujui</option>
                                        <option>Doc. Belum Lengkap</option>
                                        <option>Tidak Disetujui</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">Catatan</label>
                                    <input class="form-control" type="text" placeholder="" id="fullname" required>
                                </div>
                            </form>
                            <button type="button" class="btn btn-warning my-2" data-bs-dismiss="modal">Simpan</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
@endsection
@push('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('customjs/backend/aproval-bm-pengajuan-gtc.js')}}"></script>
<script src="{{asset('customjs/backend/loading.js')}}"></script>
@endpush