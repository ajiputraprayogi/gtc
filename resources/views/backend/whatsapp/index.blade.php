@extends('layouts.base')
@section('content')
    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Get The Cash</a></li>
                                            <li class="breadcrumb-item active">Whatsapp GTC</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Customs WA GTC</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h3>Info</h3>
                                        <p>
                                            Untuk membuat pesan menjadi dinamis pastikan tambahkan keyword dibawah ini:
                                        </p>
                                        <div class="row">
                                            <div class="col-6">
                                                <p>
                                                 <?php 
                                                 echo '{{nama_anggota}}'
                                                 ?> : Nama Anggota
                                                </p>
                                                <p>
                                                <?php 
                                                 echo '{{tgl_pengajuan}}'
                                                 ?> : Tanggal Pengajuan
                                                </p>
                                                <p>
                                                <?php 
                                                 echo '{{tgl_jam_aproval}}'
                                                 ?> : Tanggal & Jam Aproval
                                                </p>
                                                <p>
                                                <?php 
                                                 echo '{{no_sbte}}'
                                                 ?> : No SBTE
                                                </p>
                                                <p>
                                                <?php 
                                                 echo '{{jagka_waktu}}'
                                                 ?> : Jangka Waktu
                                                </p>
                                                <p>
                                                <?php 
                                                 echo '{{tgl_jatuh_tempo}}'
                                                 ?> : Tanggal Jatuh Tempo
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <p>
                                                <?php 
                                                 echo '{{tgl_pelunasan}}'
                                                 ?> : Tanggal Pelunasan
                                                </p>
                                                <p>
                                                <?php 
                                                 echo '{{nominal_pengajuan}}'
                                                 ?> : Nominal Pengajuan
                                                </p>
                                                <p>
                                                <?php 
                                                 echo '{{jumlah_transfer}}'
                                                 ?> : Jumlah Yang Di Transfer
                                                </p>
                                                <p>
                                                <?php 
                                                 echo '{{jumlah_gramasi}}'
                                                 ?> : Jumlah Gramasi
                                                </p>
                                                <p>
                                                <?php 
                                                 echo '{{jenis_transaksi}}'
                                                 ?> : Jenis Transaksi
                                                </p>
                                            </div>
                                        </div>
                                        
                                        <h3>Konten WA</h3>
                                        <ul class="nav nav-tabs mb-3">
                                            <li class="nav-item">
                                                <a href="#formdaftar" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                                    <span class="d-none d-md-block">+Pengajuan GTC</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#aprovalpengajuan" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                                    <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                                    <span class="d-none d-md-block">Aproval Keuangan</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#konfirmasi" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                    <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                                                    <span class="d-none d-md-block">Aproval Kasir</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#aproved" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                    <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                                                    <span class="d-none d-md-block">Save Transaksi</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#stopakad" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                    <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                                                    <span class="d-none d-md-block">Pelunasan</span>
                                                </a>
                                            </li>
                                        </ul>
                                        
                                        <div class="tab-content">
                                            @foreach($wa as $wa)
                                            <div class="tab-pane" id="formdaftar">
                                                <form action="{{route('edit-konten-wa')}}" method="post">
                                                @csrf
                                                <div class="form-floating">
                                                    <textarea class="form-control" placeholder="Leave a comment here" name="pengajuan_gtc" id="floatingTextarea" style="height: 250px;">{{$wa->pengajuan_gtc}}</textarea>
                                                    <br>
                                                    <button class="btn btn-primary" id="BtnWa" name="action" value="pengajuan_gtc" type="submit" >Edit</button>
                                                    <label for="floatingTextarea">Pada Saat +Pengajuan Disimpan</label>
                                                </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane show active" id="aprovalpengajuan">
                                            <form action="{{route('edit-konten-wa')}}" method="post">
                                                @csrf
                                                <div class="form-floating">
                                                    <textarea class="form-control" placeholder="Leave a comment here"  name="aproval_keuangan" id="floatingTextarea" style="height: 250px;">{{$wa->aproval_keuangan}}</textarea>
                                                    <br>
                                                    <button class="btn btn-primary" id="BtnWa" name="action" value="aproval_keuangan" type="submit" >Edit</button>
                                                    <label for="floatingTextarea">Pada Saat Aproval Keuangan</label>
                                                </div>
                                            </form>
                                            </div>
                                            <div class="tab-pane" id="konfirmasi">
                                            <form action="{{route('edit-konten-wa')}}" method="post">
                                                @csrf
                                                <div class="form-floating">
                                                    <textarea class="form-control" placeholder="Leave a comment here" name="aproval_kasir" id="floatingTextarea" style="height: 250px;">{{$wa->aproval_kasir}}</textarea>
                                                    <br>
                                                    <button class="btn btn-primary" id="BtnWa" name="action" value="aproval_kasir" type="submit" >Edit</button>
                                                    <label for="floatingTextarea">Pada Saat Aproval Kasir</label>
                                                </div>
                                            </form>
                                            </div>
                                            <div class="tab-pane" id="aproved">
                                            <form action="{{route('edit-konten-wa')}}" method="post">
                                                @csrf
                                                <div class="form-floating">
                                                    <textarea class="form-control" placeholder="Leave a comment here"  name="save_transaksi" id="floatingTextarea" style="height: 250px;">{{$wa->save_transaksi}}</textarea>
                                                    <br>
                                                    <button class="btn btn-primary" id="BtnWa" name="action" value="save_transaksi" type="submit" >Edit</button>
                                                    <label for="floatingTextarea">PAda Saat Save Transaksi</label>
                                                </div>
                                            </form>
                                            </div>
                                            <div class="tab-pane" id="stopakad">
                                            <form action="{{route('edit-konten-wa')}}" method="post">
                                                @csrf
                                                <div class="form-floating">
                                                    <textarea class="form-control" placeholder="Leave a comment here" name="pelunasan" id="floatingTextarea" style="height: 250px;">{{$wa->pelunasan}}</textarea>
                                                    <br>
                                                    <button class="btn btn-primary" id="BtnWa" name="action" value="pelunasan" type="submit" >Edit</button>
                                                    <label for="floatingTextarea"> Buttom Pelunasan</label>
                                                </div>
                                            </form>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>

                    </div> <!-- container -->
@endsection