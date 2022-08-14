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
        <div class="wrapper">
            <!-- ========== Left Sidebar Start ========== -->
                @include('layouts.nav')
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

                    <!-- Topbar Start -->
                    <!-- end Topbar -->
                
                <!-- Start Content-->

                    <!-- Start Content-->
                    <div class="content-page">
                        <div class="content">
                            <div class="container-fluid">
                                @foreach($data as $row)
                                <div class="col-md-12">
                                    <input type="hidden" id="view_id_transaksi" class="form-control">
                                    <input class="form-control" type="hidden" id="view_kode_transaksi_hidden" name="view_kode_transaksi_hidden" placeholder="Sesuai Rumus" readonly="">
                                    <div class="row">
                                        <div class="col-4">
                                            <p class="font-14"><strong>Nomor Buku Anggota</strong></p>
                                        </div>
                                        <div class="col-8">
                                            <p class="font-14" id="view_nomor_ba"><strong>: {{$row->nomor_ba}}</strong> </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <p class="font-14"><strong>Nama Lengkap</strong></p>
                                        </div>
                                        <div class="col-8">
                                            <p class="font-14" id="view_nama_lengkap"><strong>: </strong>{{$row->nama_lengkap}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <p class="font-14"><strong>Kode Pengajuan</strong></p>
                                        </div>
                                        <div class="col-8">
                                            <p class="font-14" id="view_kode_pengajuan"><strong>: </strong>{{$row->kode_pengajuan}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <p class="font-14"><strong>Kode Transaksi</strong></p>
                                        </div>
                                        <div class="col-8">
                                            <p class="font-14" id="view_kode_transaksi"><strong>: </strong>{{$row->kode_transaksi}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <p class="font-14"><strong>Jenis Transaksi</strong></p>
                                        </div>
                                        <div class="col-8">
                                            <p class="font-14" id="view_jenis_transaksi"><strong>: </strong>{{$row->jenis_transaksi}}</p>
                                        </div>
                                    </div><hr>
                                    <div id="divviewemassebelumnya" @if($row->jenis_transaksi == 'Pengajuan Baru') style="display: none;" @elseif($row->jenis_transaksi == 'Perpanjangan') style="display: none;" @elseif($row->jenis_transaksi == 'Pelunasan Sebagian') style="display: show;" @elseif($row->jenis_transaksi == 'Pelunasan') style="display: show;" @endif>
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
                                                    @php
                                                        $fpengurangan = 0;
                                                        foreach($historikeping as $rowhistori){
                                                            $fpengurangan += $rowhistori->keping;
                                                        }
                                                        $no = 0;
                                                        $fpgramasi = 0;
                                                        foreach($emas as $rowemas){
                                                            $no++;
                                                            $fpgramasi += $rowemas->gramasi*$historikeping[$no-1]->keping;
                                                        }
                                                    @endphp
                                                    <tr>
                                                        <th>Total</th>
                                                        <th></th>
                                                        <th></th>
                                                        <th>{{$fkeping . " Keping"}}</th>
                                                        <th>{{number_format((float)$fgramasi, 1, '.', '') . " Gram"}}</th>
                                                        <th>{{$fpengurangan . " Keping"}}</th>
                                                        <th>{{$fpgramasi . " Keping"}}</th>
                                                    </tr>
                                                </tfoot>
                                                @php
                                                    $no = 0;
                                                @endphp
                                                @foreach($emas as $rowemas)
                                                @php
                                                    $no++;
                                                    $keping = $rowemas->keping;
                                                    $tkeping = $transaksi[$no-1]->total;
                                                    $hasilkeping = $keping-$tkeping;
                                                @endphp
                                                <tbody id="viewbodyemassebelumnya">
                                                    <tr @if($hasilkeping == '0') hidden @endif>
                                                        <td>{{$rowemas->item_emas}}</td>
                                                        <td>
                                                            <span class="badge badge-primary-lighten">{{$rowemas->jenis}}</span>
                                                        </td>
                                                        <td>{{$rowemas->gramasi}}</td>
                                                        <td>
                                                            <input type="number" min="1" value="{{$hasilkeping}}" class="form-control"
                                                                placeholder="Qty" style="width: 90px;" readonly>
                                                        </td>
                                                        @php
                                                            $gramasi = $rowemas->gramasi*$rowemas->keping;
                                                        @endphp
                                                        <td>{{number_format((float)$gramasi, 1, '.', '') . " Gram"}}</td>
                                                        <td>
                                                            <input type="text" min="1" value="{{$historikeping[$no-1]->keping}}" class="form-control" data-toggle="input-mask" data-mask-format="000"
                                                                placeholder="Qty" style="width: 90px;" readonly>
                                                        </td>
                                                        @php
                                                            $sgramasi = $rowemas->gramasi*$historikeping[$no-1]->keping;
                                                        @endphp
                                                        <td>{{number_format((float)$sgramasi, 1, '.', '') . " Gram"}}</td>
                                                    </tr>
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
                                                @endforeach
                                            </table>
                                        </div><hr>
                                    </div>
                                    <div id="divviewemasselanjutnya" @if($row->jenis_transaksi == 'Pengajuan Baru') style="display: none;" @elseif($row->jenis_transaksi == 'Perpanjangan') style="display: none;" @elseif($row->jenis_transaksi == 'Pelunasan Sebagian') style="display: show;" @elseif($row->jenis_transaksi == 'Pelunasan') style="display: show;" @endif>
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
                                                    @php
                                                        $no3 = 0;
                                                        $fhasilkeping3 = 0;
                                                        $sgramasi3 = 0;
                                                        $hasil_buyback2 = 0;
                                                        foreach($emas as $rowemas){
                                                            $no3++;
                                                            $keping3 = $rowemas->keping;
                                                            $tkeping3 = $transaksi[$no3-1]->total;
                                                            $hkeping3 = $historikeping[$no3-1]->keping;
                                                            $hasilkeping3 = $keping3-$tkeping3-$hkeping3;
                                                            $fhasilkeping3 += $keping3-$tkeping3-$hkeping3;
        
                                                            $sgramasi3 += $rowemas->gramasi*$hasilkeping3;
        
                                                            if($rowemas->gramasi == '0.1'){
                                                                $harga_buyback2 = $hargaharian->nolsatu_gram;
                                                            }elseif($rowemas->gramasi == '0.2'){
                                                                $harga_buyback2 = $hargaharian->noldua_gram;
                                                            }elseif($rowemas->gramasi == '0.5'){
                                                                $harga_buyback2 = $hargaharian->nollima_gram;
                                                            }elseif($rowemas->gramasi == '1'){
                                                                $harga_buyback2 = $hargaharian->satu_gram;
                                                            }elseif($rowemas->gramasi == '2'){
                                                                $harga_buyback2 = $hargaharian->dua_gram;
                                                            }elseif($rowemas->gramasi == '5'){
                                                                $harga_buyback2 = $hargaharian->lima_gram;
                                                            }elseif($rowemas->gramasi == '10'){
                                                                $harga_buyback2 = $hargaharian->sepuluh_gram;
                                                            }
        
                                                            $hasil_buyback2 += $harga_buyback2*$hasilkeping3;
                                                        }
                                                    @endphp
                                                    <tr>
                                                        <th>Total</th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th>{{$fhasilkeping3 . " Keping"}}</th>
                                                        <th>{{number_format((float)$sgramasi3, 1, '.', '') . " Gram"}}</th>
                                                        <th>{{"Rp " . number_format($hasil_buyback2,0,'.','.')}}</th>
                                                    </tr>
                                                </tfoot>
                                                @php
                                                    $no2 = 0;
                                                @endphp
                                                @foreach($emas as $rowemas)
                                                @php
                                                    $no2++;
                                                    $keping2 = $rowemas->keping;
                                                    $tkeping2 = $transaksi[$no2-1]->total;
                                                    $hkeping2 = $historikeping[$no2-1]->keping;
                                                    $hasilkeping2 = $keping2-$tkeping2-$hkeping2;
                                                @endphp
                                                <tbody id="viewbodyemasselanjutnya">
                                                    <tr @if($hasilkeping2 == '0') hidden @endif>
                                                        <td>{{$rowemas->item_emas}}</td>
                                                        <td>
                                                            <span class="badge badge-primary-lighten">{{$rowemas->jenis}}</span>
                                                        </td>
                                                        <td>{{$rowemas->gramasi}}</td>
                                                        <td>
                                                            @if($rowemas->gramasi == '0.1')
                                                                @php
                                                                    $harga_buyback = $hargaharian->nolsatu_gram;
                                                                @endphp
                                                                {{"Rp " . number_format($harga_buyback,0,'.','.')}}
                                                            @elseif($rowemas->gramasi == '0.2')
                                                                @php
                                                                    $harga_buyback = $hargaharian->noldua_gram;
                                                                @endphp
                                                                {{"Rp " . number_format($harga_buyback,0,'.','.')}}
                                                            @elseif($rowemas->gramasi == '0.5')
                                                                @php
                                                                    $harga_buyback = $hargaharian->nollima_gram;
                                                                @endphp
                                                                {{"Rp " . number_format($harga_buyback,0,'.','.')}}
                                                            @elseif($rowemas->gramasi == '1')
                                                                @php
                                                                    $harga_buyback = $hargaharian->satu_gram;
                                                                @endphp
                                                                {{"Rp " . number_format($harga_buyback,0,'.','.')}}
                                                            @elseif($rowemas->gramasi == '2')
                                                                @php
                                                                    $harga_buyback = $hargaharian->dua_gram;
                                                                @endphp
                                                                {{"Rp " . number_format($harga_buyback,0,'.','.')}}
                                                            @elseif($rowemas->gramasi == '5')
                                                                @php
                                                                    $harga_buyback = $hargaharian->lima_gram;
                                                                @endphp
                                                                {{"Rp " . number_format($harga_buyback,0,'.','.')}}
                                                            @elseif($rowemas->gramasi == '10')
                                                                @php
                                                                    $harga_buyback = $hargaharian->sepuluh_gram;
                                                                @endphp
                                                                {{"Rp " . number_format($harga_buyback,0,'.','.')}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <input type="number" min="1" value="{{$hasilkeping2}}" class="form-control"
                                                                placeholder="Qty" style="width: 90px;" readonly>
                                                        </td>
                                                        @php
                                                            $sgramasi2 = $rowemas->gramasi*$hasilkeping2;
                                                        @endphp
                                                        <td>{{number_format((float)$sgramasi2, 1, '.', '') . " Gram"}}</td>
                                                        @php
                                                            $hasil_buyback = $harga_buyback*$hasilkeping2;
                                                        @endphp
                                                        <td>{{"Rp " . number_format($hasil_buyback,0,'.','.')}}</td>
                                                    </tr>
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
                                                @endforeach
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
                                            <td id="view_nominal_pinjaman">: {{"Rp " . number_format($nominalpinjaman,0,'.','.')}}</td>
                                        </tr>
                                        <tr>
                                            <td>Pembayaran Pinjaman</td>
                                            <td id="view_pembayaran_pinjaman">: {{"Rp " . number_format($fpembayaran_pinjaman2,0,'.','.')}}</td>
                                        </tr>
                                        <tr>
                                            <td>Pinjaman Saat ini/Sisa Pinjaman</td>
                                            <td id="view_sisa_pinjaman">: {{"Rp " . number_format($sisapinjaman,0,'.','.')}}</td>
                                        </tr>
                                        <tr>
                                            <td>Pilihan Jasa</td>
                                            <td id="view_pilihan_jasa">: {{$row->pilihan_jasa}}</td>
                                        </tr>
                                        <tr>
                                            <td>Perhitungan Jasa</td>
                                            <td id="view_perhitungan_jasa">: {{$row->perhitungan_jasa}}</td>
                                        </tr>
                                        <tr>
                                            <td>Jangka Waktu Permohonan</td>
                                            <td id="view_jangka_waktu_permohonan">: {{$row->jangka_waktu_permohonan . " Bulan"}}</td>
                                        </tr>
                                        <tr>
                                            <td>Jasa GTC</td>
                                            <td id="view_jasa_gtc">: {{"Rp " . number_format($row->jasa_gtc,0,'.','.')}}</td>
                                        </tr>
                                        <tr>
                                            <td>Pembayaran Jasa</td>
                                            <td id="view_pembayaran_jasa">: {{$row->pembayaran_jasa}}</td>
                                        </tr>
                                        <tr>
                                            <td>Pembayaran</td>
                                            @php
                                                $pembayaran = $fpembayaran_pinjaman2+$row->jumlah_transfer;
                                            @endphp
                                            <td id="view_pembayaran">: {{"Rp " . number_format($pembayaran,0,'.','.')}}</td>
                                        </tr>
                                        </tbody>
                                    </table><br>
                                    <div class="col-4">
                                        <p class="font-14"><strong>Bukti Transfer (Pembayaran)</strong></p>
                                    </div>
                                    <img src="{{asset('img/bukti_transfer/'.$row->upload_bukti_transfer)}}" id="view_bukti_transfer" alt="image" class="img-fluid rounded" width="600"/>
                                    <hr>
                                    <div class="col-4">
                                        <p class="font-14"><strong>Bukti Transfer (Pinjaman)</strong></p>
                                    </div>
                                    <img src="{{asset('img/buktitrf_upload/'.$row->buktitrf_upload)}}" id="view_bukti_transfer" alt="image" class="img-fluid rounded" width="600"/>
                                    <hr>
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
                                            <td>: {{$row->status_akhir}}</td>
                                        </tr>
                                        <tr>
                                            <td>Aproval BM</td>
                                            <td>: {{$row->tgl_aproval_bm}} (Akun Aproval)</td>
                                        </tr>
                                        <tr>
                                            <td>Aproval OPR</td>
                                            <td>: {{$row->tgl_aproval_opr}} (Akun Aproval)</td>
                                        </tr>
                                        <tr>
                                            <td>Aproval Keu</td>
                                            <td>: {{$row->tgl_aproval_keu}} (Akun Aproval)</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div><!-- content -->
                                @endforeach
                            </div>
                        </div>
                    </div>
                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>document.write(new Date().getFullYear())</script> © KSPPS Simpul Berkah Sinergi - eoaclub.id
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->



            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


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