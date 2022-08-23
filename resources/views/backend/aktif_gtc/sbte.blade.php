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
    <div class="container-fluid">
        
        <!-- start page title -->
        
        <!-- end page title --> 

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <!-- Invoice Logo-->
                        <div class="clearfix">
                            <div class="float-start mb-3">
                                <img src="assets/images/logo_koperasi.png" alt="" height="75">
                                <img src="assets/images/logosbs.png" alt="" height="75">
                            </div>
                            <div class="float-end">
                                <h4 class="m-0 d-print-none">SURAT BUKTI TERIMA EMAS</h4>
                                <p class="font-13"><span class="float-end">Jan 17, 2018</span></p>
                            </div>
                        </div>

                        <!-- Invoice Detail-->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="float-end">
                                    <h3><b>KSPPS Simpul Berkah Sinergi</b></h3>
                                    <p class="text-muted font-13">No. 013865/BH/M.KUKM.2/VII/2019 tanggal 01 Juli 2019
                                        </p>
                                    <p class="text-muted font-13">Ruko Puribeta 1, Puribeta Town Square, Lot I Nomor 30, Kelurahan Larangan Utara, Kecamatan Larangan, Kota Tangerang – Banten
                                        Call Center : (+62) 81219974532 / (+62) 81219974534</p>
                                </div>

                            </div><!-- end col -->
                            <div class="col-sm-4 offset-sm-2">
                                <div class="mt-4 float-sm-end">
                                    
                                    <p class="font-13"><strong>Perwada: </strong> <span class="float-end">KP Jakarta</span></p>
                                    <p class="font-13"><strong>Nomor Pengajuan: </strong> <span class="float-end">A.1234567.1</span></p>
                                    <p class="font-13"><strong>Nomor SBTE: </strong> <span class="float-end"> 062.13.12000003-04</span></p>
                                </div>
                            </div><!-- end col -->
                        </div>
                        <div class="row mt-0">
                            <div class="col-sm-6">
                                <table class="table mb-0">
                                    <thead>
                                    <tr>
                                        <th style="width: 35%;"></th>
                                        <th style="width: 65%;"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Nama Anggota</td>
                                        <td>: Nasorudin</td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Buku Anggota</td>
                                        <td>: 0.001.1234567 </td>
                                    </tr>
                                    <tr>
                                        <td>Nomor HP</td>
                                        <td>: 085724977769</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div> <!-- end col-->

                            <div class="col-sm-6">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 35%;"></th>
                                            <th style="width: 65%;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>: Jln. Raya jalan jalan No rt rw</td>
                                        </tr>
                                        <tr>
                                            <td>Kelurahan</td>
                                            <td>: Kelurahan mana </td>
                                        </tr>
                                        <tr>
                                            <td>Kecamatan</td>
                                            <td>: Kecamatan ok</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> <!-- end col-->
                        </div>
                        <!-- end row --> 
                        
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="table-responsive">
                                    <table class="table table-borderless table-nowrap table-centered mb-0">
                                        <thead class="text-white bg-secondary ">
                                            <tr>
                                                <th>Item emas</th>
                                                <th>Jenis</th>
                                                <th>Gramasi</th>
                                                <th>Keping</th>
                                                <th>Jumlah Gramasi</th>
                                            </tr>
                                        </thead>
                                        <tfoot class="text-white bg-secondary ">
                                            <tr>
                                                <th>Total</th>
                                                <th></th>
                                                <th></th>
                                                <th>6 Keping</th>
                                                <th>0.6 Gram</th>
                                            </tr>
                                            </tfoot>
                                        <tbody>
                                            <tr>
                                                <td>Gold 0.1 Gram</td>
                                                <td>
                                                    <span class="badge badge-primary-lighten">Reguler</span>
                                                </td>
                                                <td>0.1</td>
                                                <td>2</td>
                                                <td>0.2 Gram</td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div><hr><br>
                            </div>
                            <div class="col-lg-4">
                                <div class="card-body border-secondary border">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th style="width: 50%;"></th>
                                                    <th style="width: 50%;"></th>
                                                </tr>
                                                
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Tanggal Jatuh Tempo</td>
                                                    <td>: 29 Juli 2022</td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Jual Barang Jaminan</td>
                                                    <td>: 12 Juli 2022 </td>
                                                </tr>
                                                <tr>
                                                    <td>Taksiran Marhun</td>
                                                    <td>: Rp</td>
                                                </tr>
                                                <tr>
                                                    <td>Biaya Admin</td>
                                                    <td>: Rp 20.000</td>
                                                </tr>
                                                <tr>
                                                    <td>Biaya Jasa</td>
                                                    <td>: Rp</td>
                                                </tr>
                                                <tr>
                                                    <td>Marhun Bih</td>
                                                    <td>: Rp 20.000</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3 my-3">
                                <div class="card-body border-secondary border">
                                    <div class="my-2">
                                        <small>
                                            <h6 class="text-center"><b>WAKALAH PENGAMBILAN JAMINAN</b></h6>
                                            <p>Saya yang bertanda tangan di bawah ini</p>
                                            <p>Nama :</p>
                                            <p>No. KTP :</p>
                                            <p>Pemegang Surat Bukti Terima Emas dengan ini memberikan kuasa kepada :</p>
                                            <p>Nama :</p>
                                            <p>No. KTP :</p>
                                            <p>Untuk mengambil barang jaminan saya sesuai dengan yang tertera pada Surat Bukti Terima Emas ini.</p>
                                            <div class="row text-center">
                                                <div class="col-sm-6">
                                                    <p>materai</p><br><br>
                                                    <hr>
                                                    <p>Pemberi Kuasa</p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="text-white">materai</p><br><br>
                                                    <hr>
                                                    <p>Penerima kuasa</p>
                                                </div>
                                            </div>
                                        </small>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <div class="col-sm-3 my-3">
                                <div class="card-body border-secondary border text-center">
                                    <small>
                                        <h6>Pemberian Kuasa Penjualan Marhun</h6>
                                        <p>Dengan ini saya memberikan kuasa kepada KSPPS
                                        Simpul Berkah Sinergi untuk menjualkan Marhun yang
                                        telah jatuh tempo</p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <br><br>
                                                <hr>
                                                <p>Pemberi Kuasa</p>
                                            </div>
                                            <div class="col-sm-6">
                                                <br><br>
                                                <hr>
                                                <p>Penerima Kuasa</p>
                                            </div>
                                        </div>
                                    </small>
                                </div>
                                <div class="card-body border-secondary border text-center">
                                    <small>
                                        <h6>Bukti Penyerahan Marhun / Uang Kelebihan</h6>
                                        <br><br><br>
                                        <hr>
                                        <p>Penerima Kuasa</p>
                                    </small>
                                </div>
                            </div>
                            <div class="col-sm-3 my-3">
                                <div class="card-body border-secondary border text-center">
                                    <h5><b>SLIP PENGAMBILAN</b></h5>
                                </div>
                                <div class="card-body border-secondary border text-center">
                                    <p>Barang Jaminan</p><br><br><br><br><br><br>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p>Yang Menyerahkan</p><br><br>
                                            <hr>
                                            <p>Petugas</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <p>Yang Menyerahkan</p><br><br>
                                            <hr>
                                            <p>Anggota</p>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-sm-3">
                                <div class="clearfix pt-3">
                                    <h6 class="text-muted">Syarat & Ketentuan :</h6>
                                    <small>
                                        <ol>
                                            <li>
                                                SBTE tidak berlaku apabila pembayaran 
                                        sudah lunas.
                                            </li>
                                            <li>
                                                SBTE harap disimpan baik oleh anggota 
                                        sehingga apabila terjadi penyalahgunaan 
                                        terhadap SBTE ini merupakan tanggung 
                                        jawab anggota.
                                            </li>
                                            <li>
                                                EOA Club memberikan 
                                        tenggang waktu 2 minggu setelah jatuh 
                                        tempo. Apabila setelah melewati masa 
                                        tenggang tersebut maka, anggota dapat 
                                        memberikan kuasa kepada EOA Club untuk 
                                        menjualkan marhun. Nilai penjualan Marhun 
                                        dapat memenuhi kewajiban anggota kepada 
                                        EOA Club.
                                            </li>
                                            <li>Pengambilan Marhun harus dengan 
                                                menyerahkan SBTE Asli dan menunjukan 
                                                kartu identitas (KTP / SIM). Apabila SBTE 
                                                rusak / hilang maka harus ada surat 
                                                keterangan hilang dari pihak kepolisian, dan 
                                                kami tidak akan menerbitkan bukti SBTE 
                                                baru
                                            </li>
                                            <li>
                                                Anggota wajib mentaati syarat dan 
                                        ketentuan serta isi perjanjian yang tertera 
                                        dalam SBTE berserta addendumnya.
                                            </li>
                                        </ol>
                                    </small>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row-->

                        <div class="d-print-none mt-4">
                            <div class="text-end">
                                <a href="javascript:window.print()" class="btn btn-primary"><i class="mdi mdi-printer"></i> Print</a>
                                
                            </div>
                        </div>   
                        <!-- end buttons -->

                    </div> <!-- end card-body-->
                </div> <!-- end card -->
            </div> <!-- end col-->
        </div>
        <!-- end row -->
        
    </div> <!-- container -->
            

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
    // window.print();
</script>