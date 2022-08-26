<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <title>Datatables | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- third party css -->
    <link href="{{asset('assets/template/css/vendor/dataTables.bootstrap5.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/template/css/vendor/responsive.bootstrap5.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/template/css/vendor/buttons.bootstrap5.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/template/css/vendor/select.bootstrap5.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/template/css/vendor/fixedHeader.bootstrap5.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/template/css/vendor/fixedColumns.bootstrap5.css')}}" rel="stylesheet" type="text/css" />
    <!-- third party css end -->

    <!-- App css -->
    <link href="{{asset('assets/template/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/template/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style"/>
    <link href="http://www.mysite.com/Jquery/javascript.js">  
    @yield('token')
    @yield('css')
</head>
<body class="loading" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid" data-rightbar-onstart="true">
        <!-- Begin page -->
        <div class="row">
            <div class="col-12">
                <div class="card d-block">
                    <div class="card-header bg-secondary border-danger border-3" >
                        <div class=" align-items-center mb-2 text-white">
                            <h3>Form Pengajuan GTC</h3>
                        </div>
                    </div>

                    @foreach($data as $row)
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="font-14"><strong>Nomor Buku Anggota :</strong> {{$row->nomor_ba}}</p>
                            </div>
                            <div class="col-sm-4">
                                <p class="font-14"><strong>Nama Lengkap :</strong> {{$row->nama_lengkap}}</p>
                            </div><hr>
                        </div>

                        <div class="">
                            
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
                                            @php
                                                $perwada = DB::table('perwada')->where('id', $row->id_perwada)->first();
                                            @endphp
                                            <td>: {{$perwada->nama}}</td>
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
                                            @if($row->nominal_potongan == '')
                                            <td>: {{"Rp " . number_format(0,0,'.','.')}}</td>
                                            @else
                                            <td>: {{"Rp " . number_format($row->nominal_potongan,0,'.','.')}}</td>
                                            @endif
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
                                            <td>:   @if($row->aproval_bm == '')
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
                                                            @elseif($row->aproval_opr == 'Tidak Disetujui')
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
                                                            @elseif($row->aproval_opr == 'Tidak Disetujui')
                                                                @if($row->aproval_keu == 'Disetujui')
                                                                    Tidak Disetujui
                                                                @elseif($row->aproval_keu == 'Doc. Belum Lengkap')
                                                                    Tidak Disetujui
                                                                @elseif($row->aproval_keu == 'Tidak Disetujui')
                                                                    Tidak Disetujui
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif</td>
                                        </tr>
                                        <tr>
                                            <td>Aproval BM</td>
                                            <td>: {{$row->tgl_aproval_bm}}</td>
                                        </tr>
                                        <tr>
                                            <td>Aproval OPR</td>
                                            <td>: {{$row->tgl_aproval_opr}}</td>
                                        </tr>
                                        <tr>
                                            <td>Aproval Keu</td>
                                            <td>: {{$row->tgl_aproval_keu}}</td>
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
                                            <h5>Tandatangan & Aproval </h5>
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
                                                    <td style="width: 25%;"><img src="{{asset('/'.$row->tanda_tangan_bm)}}" alt="image" class="img-fluid rounded" width="350"/></td>
                                                    <td style="width: 25%;"><img src="{{asset('tandatangan_bm/'.$row->tanda_tangan_bm)}}" alt="image" class="img-fluid rounded" width="350"/></td>
                                                    <td style="width: 25%;"><img src="{{asset('/'.$row->tanda_tangan_bm)}}" alt="image" class="img-fluid rounded" width="350"/></td>
                                                    <td style="width: 25%;"><img src="{{asset('/'.$row->tanda_tangan_bm)}}" alt="image" class="img-fluid rounded" width="350"/></td>
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
        <!-- END wrapper -->
        <!-- Right Sidebar -->

        <div class="rightbar-overlay"></div>
        <!-- /End-bar -->

        <!-- bundle -->
        <script src="{{asset('assets/template/js/vendor.min.js')}}"></script>
        <script src="{{asset('assets/template/js/app.min.js')}}"></script>

        <!-- third party js -->
        <script src="{{asset('assets/template/js/vendor/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/template/js/vendor/dataTables.bootstrap5.js')}}"></script>
        <script src="{{asset('assets/template/js/vendor/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('assets/template/js/vendor/responsive.bootstrap5.min.js')}}"></script>
        <script src="{{asset('assets/template/js/vendor/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('assets/template/js/vendor/buttons.bootstrap5.min.js')}}"></script>
        <script src="{{asset('assets/template/js/vendor/buttons.html5.min.js')}}"></script>
        <script src="{{asset('assets/template/js/vendor/buttons.flash.min.js')}}"></script>
        <script src="{{asset('assets/template/js/vendor/buttons.print.min.js')}}"></script>
        <script src="{{asset('assets/template/js/vendor/dataTables.keyTable.min.js')}}"></script>
        <script src="{{asset('assets/template/js/vendor/dataTables.select.min.js')}}"></script>
        <script src="{{asset('assets/template/js/vendor/fixedColumns.bootstrap5.min.js')}}"></script>
        <script src="{{asset('assets/template/js/vendor/fixedHeader.bootstrap5.min.js')}}"></script>
        <!-- third party js ends -->

        <!-- demo app -->
        <script src="{{asset('assets/template/js/pages/demo.datatable-init.js')}}"></script>
        <!-- end demo js-->
        @stack('script')
    </body>
<script type="text/javascript">
    // window.onafterprint = window.close;
    window.print();
</script>