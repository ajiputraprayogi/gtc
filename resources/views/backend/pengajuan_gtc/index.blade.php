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
                    <!-- Hanya Sementara -->
                    <div class="card-body col-lg-7">
                        <h6>Keterangan</h6>
                        <p>Yang muncul di tabel hanya hari ini selain itu bisa di searcing</p>
                        <p>tambahkan pencarian tanggal periode</p>
                        <p>Kode pengajuan A.7digitNomorBA.Pengajuan ke berapa</p>
                        <p>Status Akhir Mengikuti menu</p>
                        <p>Status Aproval sesuai Aproval</p>
                    </div>

                    <div class="row mb-2">
                        <div class="col-sm-5">
                            <a href="{{url('backend/tambah-pengajuan-gtc')}}" class="btn btn-primary mb-2" ></i>Pengajuan GTC</a>
                            <a href="" class="btn btn-success mb-2"><i class="mdi mdi-export"></i>Export Excel</a>
                            <a href="{{url('backend/del-pengajuan-gtc')}}" class="btn btn-danger mb-2"><i class="mdi mdi-delete"></i></a>
                        </div>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="scroll-horizontal-preview">
                        <table id="scroll-horizontal-datatable" class="table table-striped w-100 nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
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
                                    <th>Apvl Opr</th>
                                    <th>Apvl Keu</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach($data as $row)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$row->tanggal_pengajuan}}</td>
                                    <td>{{$row->id_perwada}}</td>
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
                                    <td>
                                        <a href="{{url('backend/aproval-opr-pengajuan-gtc/'.$row->id)}}" class="action-icon"> <i class="mdi mdi-book-check"></i></a>
                                    </td>
                                    <td>
                                        <a href="{{url('backend/aproval-keu-pengajuan-gtc/'.$row->id)}}" class="action-icon"> <i class="mdi mdi-book-check-outline"></i></a>
                                    </td>
                                    <td>
                                        <a href="{{url('backend/view-pengajuan-gtc/'.$row->id)}}" class="action-icon"> <i class="mdi mdi-card-search"></i></a>
                                        <a href="{{url('backend/edit-pengajuan-gtc/'.$row->id)}}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                        <a onclick="hapusdatapengajuangtc({{$row->id}})" class="action-icon"> <i class="mdi mdi-delete"></i></a>
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
@endpush
