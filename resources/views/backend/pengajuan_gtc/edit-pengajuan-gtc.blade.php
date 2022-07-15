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
                        <li class="breadcrumb-item active">Pengajuan GTC</li>
                    </ol>
                </div>
                <h4 class="page-title">Pengajuan GTC</h4>
            </div>
        </div>
    </div>
    <!-- end page title --> 


    <div class="row" id="panel">
        <div class="col-12">
            <div class="card d-block">
                <div class="card-header bg-secondary border-danger border-3" >
                    <div class=" align-items-center mb-2 text-white">
                        <h3>Form Pengajuan GTC</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="py-0">
                        <h5>Data Pemohon</h5>
                    </div><hr>
                    @foreach($data as $row)
                    <form id="formaddpengajuangtc" method="post" notvalidate>
                    @csrf
                        <input type="hidden" name="_method" value="put">
                        <input type="hidden" name="" id="id_pengajuan" name="id_pengajuan" value="{{$row->idp}}">
                        <div class="row g-2">
                            <div class="col-md">
                                <label class="form-label">Nomor BA</label>
                                <div class="input-group">
                                    <input type="text" id="no_ba" name="nomor_ba" class="form-control" placeholder="Cari Nomor BA" aria-label="Recipient's username" value="{{$row->nomor_ba}}" readonly>
                                    <button class="btn btn-primary" id="cari" type="button" disabled>Cari</button>
                                    <input type="hidden" name="id_anggota" id="id_anggota" class="form-control" value="{{$row->ida}}">
                                </div>
                                <!-- <div class="input-group">
                                    <input type="text" class="form-control" placeholder="x.xxx.xxxxx23" aria-label="Recipient's username" readonly>
                                    <button class="btn btn-primary" type="button">Cari</button>
                                </div> -->
                                </div>
                            <div class="col-md">
                                <label for="fullname" class="form-label">Nama Lengkap</label>
                                <input class="form-control" type="text" id="nama_lengkap" placeholder="Nama Sesuai" readonly="" value="{{$row->nama_lengkap}}">
                            </div>
                        </div><br>
                        <div class="row g-2">
                            <div class="col-md">
                                <label for="fullname" class="form-label">Nomor HP</label>
                                <input class="form-control" type="text" id="no_hp" placeholder="xxxxxxxxxx985" readonly="" value="{{$row->no_hp}}">
                            </div>
                            <div class="col-md">
                                <label for="emailaddress" class="form-label">Email address</label>
                                <input class="form-control" type="email" id="email" placeholder="xxxxx788@gmail.com" readonly="" value="{{$row->email}}"> 
                            </div>
                        </div><br>
                        <div class="row g-2">
                            <div class="col-6">
                            </div>
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modal-view-pemohon" id="detailpemohonbtn"><i class="mdi mdi-card-search-outline"></i> Detail Pemohon</button>
                                <button type="button" class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#modal-tambah-datacif" id="datacifanggotabtn"><i class="mdi mdi-plus-circle me-2"></i> Data CIF Anggota</button>
                            </div><br>
                        </div>
                        <div class="py-0">
                            <h5>Data Pengajuan</h5>
                        </div><hr>
                        <div class="row g-2">
                            <div class="col-md">
                                <label for="fullname" class="form-label">Perwada (sesuai dg Akun)</label>
                                <input class="form-control" type="text" id="perwada" value="KP Jakarta" placeholder="KP Jakarta" readonly="">
                                <input type="hidden" value="{{$row->id_perwada}}" id="id_perwada" name="id_perwada" class="form-control">
                            </div>
                            <div class="col-md">
                                <label for="fullname" class="form-label">Kode Pengajuan</label>
                                <input class="form-control" type="text" id="kode_pengajuan" name="kode_pengajuan" placeholder="Create by System" readonly="" value="{{$row->kode_pengajuan}}">
                            </div>
                            <div class="col-md">
                                <label for="example-select" class="form-label">Tujuan</label>
                                <select class="form-select" id="tujuan" name="tujuan" required>
                                    <option selected>Pilih</option>
                                    <option value="Untuk Modal Usaha" @if($row->tujuan == 'Untuk Modal Usaha') selected @endif>Untuk Modal Usaha</option>
                                    <option value="Biaya Pendidikan" @if($row->tujuan == 'Biaya Pendidikan') selected @endif>Biaya Pendidikan</option>
                                    <option value="Investasi" @if($row->tujuan == 'Investasi') selected @endif>Investasi</option>
                                    <option value="Pembelian Barang" @if($row->tujuan == 'Pembelian Barang') selected @endif>Pembelian Barang</option>
                                    <option value="Lainnya" @if($row->tujuan == 'Lainnya') selected @endif>Lainnya</option>
                                </select>
                            </div>
                        </div><hr><br>

                        <div class="col-lg-12">
                            <div class="col-sm-5">
                                <button id="btnmodaladdemasgtc" type="button" class="btn mb-2 text-white bg-primary" data-bs-toggle="modal" data-bs-target="#addemasgtc"><i class="mdi mdi-plus-circle me-2"></i> Emas GTC</button>
                            </div>
                            <div class="table-responsive">
                                    <table id="tableemasgtc" class="table table-borderless table-nowrap table-centered mb-0">
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
                                        <tfoot id="footemasgtc" class="text-white bg-secondary ">
                                            <tr>
                                                <th>Total</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th id="total_keping">0</th>
                                                <th id="total_gramasi">0</th>
                                                <th id="total_buyback">0</th>
                                                <th style="width: 50px;"></th>
                                            </tr>
                                        </tfoot>
                                        <tbody id="bodyemasgtc">
                                            <!-- <tr>
                                                <td>EOA Gold 0.1</td>
                                                <td><span class="badge badge-primary-lighten">Reguler</span></td>
                                                <td class="gramasi">0.1</td>
                                                <td class="harga_buyback">101.000</td>
                                                <td hidden class="harga_buyback_hidden">101000</td>
                                                <td><input type="number" min="1" value="0" class="keping form-control" name="keping[]" placeholder="Qty" style="width: 90px;"></td>
                                                <td class="jumlah_gramasi">0</td>
                                                <td class="jumlah_buyback">0</td>
                                                <td hidden class="jumlah_buyback_hidden">0</td>
                                            </tr>
                                            <tr>
                                                <td>EOA Gold 0.2</td>
                                                <td><span class="badge badge-primary-lighten">Reguler</span></td>
                                                <td class="gramasi">0.2</td>
                                                <td class="harga_buyback">208.500</td>
                                                <td hidden class="harga_buyback_hidden">208500</td>
                                                <td><input type="number" min="1" value="0" class="keping form-control" name="keping[]" placeholder="Qty" style="width: 90px;"></td>
                                                <td class="jumlah_gramasi">0</td>
                                                <td class="jumlah_buyback">0</td>
                                                <td hidden class="jumlah_buyback_hidden">0</td>
                                            </tr>
                                            <tr>
                                                <td>EOA Gold 0.5</td>
                                                <td><span class="badge badge-primary-lighten">Reguler</span></td>
                                                <td class="gramasi">0.5</td>
                                                <td class="harga_buyback">480.000</td>
                                                <td hidden class="harga_buyback_hidden">480000</td>
                                                <td><input type="number" min="1" value="0" class="keping form-control" name="keping[]" placeholder="Qty" style="width: 90px;"></td>
                                                <td class="jumlah_gramasi">0</td>
                                                <td class="jumlah_buyback">0</td>
                                                <td hidden class="jumlah_buyback_hidden">0</td>
                                            </tr>
                                            <tr>
                                                <th>Total</th><th></th><th></th><th></th><th id="total_keping">0</th><th id="total_gramasi">0</th><th id="total_buyback">0</th>
                                            </tr> -->
                                            <!-- <tr>
                                                <td>Gold 0.1 Gram</td>
                                                <td>
                                                    <span class="badge badge-primary-lighten">Reguler</span>
                                                </td>
                                                <td class="gramasi">0.1</td>
                                                <td class="harga_buyback">150000</td>
                                                <td>
                                                    <input type="" min="1" value="" class="keping"
                                                        placeholder="Qty" style="width: 90px;">
                                                </td>
                                                <td class="jumlah_gramasi">0</td>
                                                <td class="jumlah_buyback">0</td>
                                                <td hidden class="jumlah_buyback_hidden">0</td>
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
                                                <td class="gramasi">0.2</td>
                                                <td class="harga_buyback">300000</td>
                                                <td>
                                                    <input type="" min="1" value="" class="keping"
                                                        placeholder="Qty" style="width: 90px;">
                                                </td>
                                                <td class="jumlah_gramasi">0</td>
                                                <td class="jumlah_buyback">0</td>
                                                <td hidden class="jumlah_buyback_hidden">0</td>
                                                <td>
                                                    <a href="javascript:void(0);" class="action-icon"> <i
                                                            class="mdi mdi-delete"></i></a>
                                                </td>
                                            </tr> -->
                                            <!-- @foreach($emas_gtc as $item)
                                            <tr>
                                                <td>{{$item->item_emas}}</td>
                                                <td>
                                                    <span class="badge badge-primary-lighten">{{$item->jenis}}</span>
                                                </td>
                                                <td class="gramasi">{{$item->gramasi}}</td>
                                                <td class="harga_buyback">{{$item->harga_buyback}}</td>
                                                <td hidden class="harga_buyback_hidden">{{$item->harga_buyback}}</td>
                                                <td>
                                                    <input type="" min="1" value="" class="keping"
                                                        placeholder="Qty" style="width: 90px;">
                                                </td>
                                                <td class="jumlah_gramasi">0</td>
                                                <td class="jumlah_buyback">0</td>
                                                <td hidden class="jumlah_buyback_hidden">0</td>
                                                <td>
                                                    <a onclick="hapusdataemasgtc({{$item->id}})" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach -->
                                        </tbody>
                                    </table>
                            </div><hr><br> <!-- end table-responsive-->

                            <div class="row g-2">
                                <div class="col-md">
                                    <label for="fullname" class="form-label">Plafond Pinjaman</label>
                                    <input class="form-control" type="text" id="plafond_pinjaman" name="plafond_pinjaman" placeholder="000.000" data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true" required readonly>
                                    <input type="hidden" class="form-control" id="plafond_pinjaman_hidden">
                                </div>
                                <div class="col-md">
                                    <label for="fullname" class="form-label">Pengajuan</label>
                                    <input class="form-control" type="text" id="pengajuan" name="pengajuan" placeholder="000.000" data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true" required value="{{$row->pengajuan}}">
                                    <input type="hidden" class="form-control" id="pengajuan_hidden">
                                </div>
                            </div><br>
                            <div class="row g-2">
                                <div class="col-md">
                                    <label for="example-select" class="form-label">Pilihan Bank</label>
                                    <select class="form-select" id="pilihan_bank" name="pilihan_bank" required>
                                        <option selected>Pilih</option>
                                        <option value="Bank BSI" @if($row->pilihan_bank == 'Bank BSI') selected @endif>Bank BSI</option>
                                        <option value="Bank BRI" @if($row->pilihan_bank == 'Bank BRI') selected @endif>Bank BRI</option>
                                        <option value="Bank BNI" @if($row->pilihan_bank == 'Bank BNI') selected @endif>Bank BNI</option>
                                        <option value="Bank BTN" @if($row->pilihan_bank == 'Bank BTN') selected @endif>Bank BTN</option>
                                        <option value="Bank Mandiri" @if($row->pilihan_bank == 'Bank Mandiri') selected @endif>Bank Mandiri</option>
                                        <option value="Bank BCA" @if($row->pilihan_bank == 'Bank BCA') selected @endif>Bank BCA</option>
                                        <option value="Bank Muamalat" @if($row->pilihan_bank == 'Bank Muamalat') selected @endif>Bank Muamalat</option>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <label for="fullname" class="form-label">Nomor Rekening</label>
                                    <input class="form-control" type="text" id="nomor_rekening" name="nomor_rekening" placeholder="" required value="{{$row->nomor_rekening}}">
                                </div>
                                <div class="col-md">
                                    <label for="fullname" class="form-label">Nama Pemilik Rekening</label>
                                    <input class="form-control" type="text" id="nama_pemilik_rekening" name="nama_pemilik_rekening" placeholder="" required value="{{$row->nama_pemilik_rekening}}">
                                </div>
                            </div><br>
                            <div class="py-0">
                                <h5>Transaksi</h5>
                            </div><hr>
                            <div class="row g-2">
                                <div class="col-md">
                                    <label for="fullname" class="form-label">Kode Transaksi</label>
                                    <input class="form-control" type="text" id="kode_transaksi" name="kode_transaksi" placeholder="B.1234567.1.1" readonly="" value="{{$row->kode_transaksi}}">
                                </div>
                                <div class="col-md">
                                    <label for="fullname" class="form-label">Jenis Transaksi</label>
                                    <input class="form-control" type="text" id="jenis_transaksi" name="jenis_transaksi" placeholder="Pengajuan Baru" value="Pengajuan Baru" readonly="" value="{{$row->jenis_transaksi}}">
                                </div>
                            </div><br>
                            <div class="row g-2">
                                <div class="col-md">
                                    <label for="fullname" class="form-label">Pilihan Jasa</label>
                                    <input class="form-control" type="text" id="pilihan_jasa"  name="pilihan_jasa" placeholder="Jasa diawal" readonly="" value="{{$row->pilihan_jasa}}">
                                </div>
                                <div class="col-md">
                                    <label for="fullname" class="form-label">Perhitungan Jasa</label>
                                    <input class="form-control" type="text" id="perhitungan_jasa" name="perhitungan_jasa" value="Perhitungan Baru" placeholder="Perhitungan Baru" readonly="" value="{{$row->perhitungan_jasa}}">
                                    <input type="hidden" class="form-control" id="jangka_waktu_1" value="{{$jenis_jasa->jangka_waktu_1}}">
                                    <input type="hidden" class="form-control" id="pengali_kurangdari_satudelapan_1" value="{{$jenis_jasa->pengali_kurangdari_satudelapan_1}}">
                                    <input type="hidden" class="form-control" id="pengali_diatas_dua_1" value="{{$jenis_jasa->pengali_diatas_dua_1}}">
                                    <input type="hidden" class="form-control" id="jangka_waktu_2" value="{{$jenis_jasa->jangka_waktu_2}}">
                                    <input type="hidden" class="form-control" id="pengali_kurangdari_satudelapan_2" value="{{$jenis_jasa->pengali_kurangdari_satudelapan_2}}">
                                    <input type="hidden" class="form-control" id="pengali_diatas_dua_2" value="{{$jenis_jasa->pengali_diatas_dua_2}}">
                                    <input type="hidden" class="form-control" id="jangka_waktu_3" value="{{$jenis_jasa->jangka_waktu_3}}">
                                    <input type="hidden" class="form-control" id="pengali_kurangdari_satudelapan_3" value="{{$jenis_jasa->pengali_kurangdari_satudelapan_3}}">
                                    <input type="hidden" class="form-control" id="pengali_diatas_dua_3" value="{{$jenis_jasa->pengali_diatas_dua_3}}">
                                    <input type="hidden" class="form-control" id="jangka_waktu_4" value="{{$jenis_jasa->jangka_waktu_4}}">
                                    <input type="hidden" class="form-control" id="pengali_kurangdari_satudelapan_4" value="{{$jenis_jasa->pengali_kurangdari_satudelapan_4}}">
                                    <input type="hidden" class="form-control" id="pengali_diatas_dua_4" value="{{$jenis_jasa->pengali_diatas_dua_4}}">
                                </div>
                                <div class="col-md">
                                    <label for="example-select" class="form-label">Jangka Waktu Permohonan</label>
                                    <select class="form-select" id="jangka_waktu_permohonan" name="jangka_waktu_permohonan" required>
                                        <option selected>Pilih</option>
                                        <option value="0.5" @if($row->jangka_waktu_permohonan == '0.5') selected @endif>15 Hari</option>
                                        <option value="1" @if($row->jangka_waktu_permohonan == '1') selected @endif>1 Bulan</option>
                                        <option value="2" @if($row->jangka_waktu_permohonan == '2') selected @endif>2 Bulan</option>
                                    </select>
                                </div>
                                
                            </div><br>
                            <div class="row g-2">
                                <div class="col-md">
                                    <label for="fullname" class="form-label">Jasa GTC(otomatis)</label>
                                    <input class="form-control" type="text" id="jasa_gtc" name="jasa_gtc" placeholder="Rp 0" readonly value="{{number_format($row->jasa_gtc,0,',','.')}}">
                                </div>
                                <div class="col-md">
                                    <label for="example-select" class="form-label">Pembayaran Jasa</label>
                                    <select class="form-select" id="pembayaran_jasa" name="pembayaran_jasa" required>
                                        <option selected>Pilih</option>
                                        <option value="Transfer" @if($row->pembayaran_jasa == 'Transfer') selected @endif>Transfer</option>
                                        <option value="Dipotong dari GTC" @if($row->pembayaran_jasa == 'Dipotong dari GTC') selected @endif>Dipotong dari GTC</option>
                                    </select>
                                </div>
                                <div class="col-md" id="div_upload_bukti_transfer" @if($row->pembayaran_jasa == 'Transfer') style="display: show" @else style="display: none" @endif>
                                    <label for="formFile" class="form-label">Upload Bukti Transfer(Jika transfer)</label>
                                    <input class="form-control" type="file" id="upload_bukti_transfer" name="upload_bukti_transfer">
                                    <input type="hidden" class="form-control" id="old_upload_bukti_transfer" name="old_upload_bukti_transfer" value="{{$row->upload_bukti_transfer}}" readonly>
                                </div>
                                <div class="col-md" id="div_jumlah_transfer" @if($row->pembayaran_jasa == 'Transfer') style="display: show" @else style="display: none" @endif>
                                    <label for="fullname" class="form-label">Jumlah Transfer</label>
                                    <input class="form-control" type="text" id="jumlah_transfer" name="jumlah_transfer" placeholder="000.000" data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true" required value="{{$row->jumlah_transfer}}">
                                </div>
                                <div class="col-md" id="div_pembayaran_jasa_manual" @if($row->pembayaran_jasa == 'Transfer') style="display: none" @else style="display: show" @endif>
                                    <label for="fullname" class="form-label">Pembayaran jasa(=Jasa GTC)Manual</label>
                                    <input class="form-control" type="text" id="pembayaran_jasa_manual" name="pembayaran_jasa_manual" placeholder="000.000" data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true" required value="{{$row->pembayaran_jasa_manual}}">
                                </div>
                            </div><br>
                            <div class="row g-2">
                                <div class="col-md">
                                    <label for="example-select" class="form-label">Ket. Simp.Wa</label>
                                    <select class="form-select" id="ket_simpwa" name="ket_simpwa" required>
                                        <option selected>Pilih</option>
                                        <option value="Lunas" @if($row->ket_simpwa == 'Lunas') selected @endif>Lunas</option>
                                        <option value="Dipotong dari GTC" @if($row->ket_simpwa == 'Dipotong dari GTC') selected @endif>Dipotong dari GTC</option>
                                    </select>
                                </div>
                                <div class="col-md" id="div_nominal_potongan" @if($row->ket_simpwa == 'Dipotong dari GTC') style="display: show" @lse style="display: none" @endif>
                                    <label for="formFile" class="form-label">Nominal Potongan(Jika dr GTC)</label>
                                    <input class="form-control" type="text" id="nominal_potongan" name="nominal_potongan" placeholder="000.000" data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true" required value="{{$row->nominal_potongan}}">
                                </div>
                                <div class="col-md">
                                    <label for="fullname" class="form-label">Jumlah Yang di Transfer</label>
                                    <input class="form-control" type="text" id="jumlah_yang_di_transfer" name="jumlah_yang_di_transfer" placeholder="Jumlah Yang di Transfer" data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true" required value="{{$row->jumlah_yang_di_transfer}}">
                                </div>
                            </div><br>
                            <div class="py-0">
                                <h5>Dokument</h5>
                            </div><hr>
                            <div class="row g-2">
                                <div class="col-md">
                                    <h5>Tipe Transaksi</h5>
                                    <div class="form-check">
                                        <input type="radio" id="tipe_transaksi" name="tipe_transaksi" class="form-check-input" value="Anggota Datang Langsung" @if($row->tipe_transaksi == 'Anggota Datang Langsung') checked @endif>
                                        <label class="form-check-label" for="tipe_transaksi">Anggota Datang Langsung</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="tipe_transaksi2" name="tipe_transaksi" class="form-check-input" value="Online" @if($row->tipe_transaksi == 'Online') checked @endif>
                                        <label class="form-check-label" for="tipe_transaksi2">Online</label>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <label for="formFile" class="form-label">Upload Foto Gold</label>
                                    <input class="form-control" type="file" id="upload_foto_gold" name="upload_foto_gold"><br>
                                    <input type="hidden" class="form-control" id="old_upload_foto_gold" name="old_upload_foto_gold" value="{{$row->upload_foto_gold}}" readonly>
                                    <div id="divuploadformpengajuan" @if($row->tipe_transaksi == 'Online') style="display: show" @else style="display: none" @endif>
                                        <label for="formFile" class="form-label">Upload Form Pengajuan</label>
                                        <input class="form-control" type="file" id="upload_form_pengajuan" name="upload_form_pengajuan">
                                        <input type="hidden" class="form-control" id="old_upload_form_pengajuan" name="old_upload_form_pengajuan" value="{{$row->upload_form_pengajuan}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <label for="formFile" class="form-label">Upload Surat Terima Transfer(Tidak wajib)</label>
                                    <input class="form-control" type="file" id="upload_surat_terima_transfer" name="upload_surat_terima_transfer"><br>
                                    <input type="hidden" class="form-control" id="old_upload_surat_terima_transfer" name="old_upload_surat_terima_transfer" value="{{$row->upload_surat_terima_transfer}}" readonly>
                                    <label for="formFile" class="form-label">Surat Kuasa Penjualan Jaminan Marhun</label>
                                    <input class="form-control" type="file" id="surat_kuasa_penjualan_jaminan_marhum" name="surat_kuasa_penjualan_jaminan_marhum">
                                    <input type="hidden" class="form-control" id="old_surat_kuasa_penjualan_jaminan_marhum" name="old_surat_kuasa_penjualan_jaminan_marhum" value="{{$row->surat_kuasa_penjualan_jaminan_marhum}}" readonly>
                                </div>
                            </div><br>

                            <div class="card border-primary border">
                                <div class="card-body">
                                    <h5 class="card-title">Persetujuan : (jika Reguler)</h5>
                                    <p class="card-text">
                                        <ul class="ul-number">
                                            <li>
                                                 Simpanan berjangka dengan akad Mudharabah Muthlaqah
                                            </li>
                                            <li>
                                                Simpanan berjangka ini tidak dapat dicairkan sebelum tanggal jatuh tempo</li>
                                            <li>
                                                Simpanan Berjangka Dsyirkah minimal 100 Gram dengan jangka waktu 12 Bulan Mendapatkan Hadiah 1 Gram Gold / 100 Gram dengan jangka waktu 24 Bulan Mendapatkan Hadiah 2 Gram Gold
                                            </li>
                                            <li>
                                                Saya siap mengembalikan hadiah jika tidak sesuai dengan akad.
                                            </li>
                                        </ul>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div>

                        
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card border-secondary border">
                                    <div class="card-body">
                                        <h5 class="card-title">Catatan :</h5>
                                        <textarea name="catatan" id="catatan" cols="50" rows="10" style="height: 258px;">{{$row->catatan}}</textarea>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div>
                            <div class="col-lg-6">
                                <div class="card border-secondary border">
                                    <div class="card-body">
                                        <h5 class="card-title">Tandatangan :</h5>
                                            <br/>
                                            <div id="sig" style="display:none"></div>
                                            <img src="{{asset('tandatangan/'.$row->tanda_tangan)}}" id="tanda_tangan" name="tanda_tangan" alt="" style="width: 100% !important; height: auto;">
                                            <input type="hidden" name="old_tanda_tangan" class="form-control" id="old_tanda_tangan" value="{{$row->tanda_tangan}}">
                                            <br/>
                                            <button class="btn btn-danger" id="clear" onclick="tandatangan()">Hapus Tanda Tangan</button>
                                            <textarea id="signature64" name="signed" style="display: none"></textarea>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div>
                        </div>
                        <br><div class="mb-3 text-center" >
                            <button class="btn btn-primary" id="btnaddpengajuan" type="submit"> Simpan </button>
                        </div>
                    </form>
                    @endforeach
                </div>
                
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
@foreach($data as $row)
<div class="modal fade" id="modal-tambah-datacif" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #afb4be">
                <h4 class="modal-title" style="color: rgb(255, 255, 255);" id="myLargeModalLabel">Tambah Data CIF Anggota</h4>
                <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form id="formtambahdatacifanggota">
                @csrf
                    <input type="hidden" name="_method" value="put">
                    <h5>Data Akun</h5><hr>
                    <div class="row g-2">
                        <div class="col-md">
                            <label class="form-label">Nomor BA</label>
                            <input type="hidden" class="form-control" id="tambah_id_anggota" name="tambah_id_anggota" readonly value="{{$row->ida}}">
                            <div class="input-group">
                                <input type="text" class="form-control" id="tambah_nomor_ba" name="tambah_nomor_ba" placeholder="Cari Nomor BA" readonly value="{{$row->nomor_ba}}">
                            </div>
                        </div>
                        <div class="col-md">
                            <label for="fullname" class="form-label">Nama Lengkap</label>
                            <input class="form-control" type="text" id="tambah_nama_lengkap" name="tambah_nama_lengkap" placeholder="Enter your name" readonly value="{{$row->nama_lengkap}}">
                        </div>
                    </div><br>
                    <div class="row g-2">
                        <div class="col-md">
                            <label for="fullname" class="form-label">Nomor HP</label>
                            <input class="form-control" type="text" id="tambah_nomor_hp" name="tambah_nomor_hp" placeholder="0994538574985" readonly="" value="{{$row->no_hp}}">
                        </div>
                        <div class="col-md">
                            <label for="emailaddress" class="form-label">Email address</label>
                            <input class="form-control" type="email" id="tambah_email" name="tambah_email" placeholder="Email" readonly="" value="{{$row->email}}"> 
                        </div>
                    </div><hr><br>

                    <div class="row g-2">
                        <div class="col-md">
                            <label for="fullname" class="form-label">Nomor KTP</label>
                            <input class="form-control" type="text" id="tambah_nomor_ktp" name="tambah_nomor_ktp" placeholder="0123123456788123" data-toggle="input-mask" data-mask-format="0000000000000000" required value="{{$row->no_ktp}}">
                        </div>
                        <div class="col-md">
                            <label for="example-select" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="tambah_jenis_kelamin" name="tambah_jenis_kelamin" required>
                                <option selected>Pilih</option>
                                <option value="Laki-laki" @if($row->jenis_kelamin == 'Laki-laki') selected @endif>Laki - Laki</option>
                                <option value="Perempuan" @if($row->jenis_kelamin == 'Perempuan') selected @endif>Perempuan</option>
                            </select>
                        </div>
                    </div><br>

                    <div class="row g-2">
                        <div class="col-md">
                            <label for="fullname" class="form-label">Tempat Lahir</label>
                            <input class="form-control" type="text" id="tambah_tempat_lahir" name="tambah_tempat_lahir" placeholder="Enter your name" required  value="{{$row->tempat_lahir}}">
                        </div>
                        <div class="col-md">
                            <label for="fullname" class="form-label">Tanggal Lahir</label>
                            <input class="form-control date" type="date" id="tambah_tanggal_lahir" name="tambah_tanggal_lahir" placeholder="dd/mm/yyyy" required value="{{$row->tanggal_lahir}}">
                        </div>
                    </div><br>

                    <div class="row g-2">
                        <div class="col-md">
                            <label for="example-select" class="form-label">Status Pernikahan</label>
                            <select class="form-select" id="tambah_status_pernikahan" name="tambah_status_pernikahan" required>
                                <option selected>Pilih</option>
                                <option value="Sudah Nikah" @if($row->status_nikah == 'Sudah Nikah') selected @endif>Sudah Nikah</option>
                                <option value="Belum Nikah" @if($row->status_nikah == 'Belum Nikah') selected @endif>Belum Nikah</option>
                            </select>
                        </div>
                        <div class="col-md">
                            <label for="fullname" class="form-label">Nomor NPWP (Jika Punya)</label>
                            <input class="form-control date" type="text" id="tambah_nomor_npwp" name="tambah_nomor_npwp" placeholder="000000000" value="{{$row->no_npwp}}">
                        </div>
                    </div><hr><br>

                    <div class="col-md">
                        <label for="fullname" class="form-label">Alamat Sesuai KTP</label>
                        <input class="form-control date" type="text" id="tambah_alamat_sesuai_ktp" name="tambah_alamat_sesuai_ktp" placeholder="Jl. Raya Nommor:00 RT/RW" required value="{{$row->alamat_domisili}}">
                    </div>

                    <div class="row g-2">
                        <div class="col-md">
                            <label for="fullname" class="form-label">Provinsi</label>
                            <select class="form-control select2" id="provinsi" name="tambah_provinsi" name="tambah_provinsi" placeholder="dd/mm/yyyy">
                                <option>Provinsi</option>
                                <option>Data Masih Diproses</option>
                            </select>
                        </div>
                        <div class="col-md">
                            <label for="fullname" class="form-label">Kota / Kabupaten</label>
                            <select class="form-control" id="kota" name="tambah_kota" placeholder="Enter your name">
                                <option>Kabupaten/Kota</option>
                                <option>Pilih Provinsi Terlebih Dahulu</option>
                            </select>
                        </div>
                    </div><br>
                    
                    <div class="row g-2">
                        <div class="col-md">
                            <label for="fullname" class="form-label">Kecamatan</label>
                            <select class="form-control" id="kecamatan" name="tambah_kecamatan" placeholder="dd/mm/yyyy">
                                <option>Kecamatan</option>
                                <option>Pilih Kota / Kabupaten Terlebih Dahulu</option>
                            </select>
                        </div>
                        <div class="col-md">
                            <label for="fullname" class="form-label">Kelurahan</label>
                            <select class="form-control" id="kelurahan" name="tambah_kelurahan" placeholder="Enter your name">
                                <option>Kelurahan</option>
                                <option>Pilih Kelurahan Terlebih Dahulu</option>
                            </select>
                        </div>
                    </div><br>

                    <div class="col-md">
                        <label for="example-select" class="form-label">Alamat Tinggal</label>
                        <select class="form-select" id="tambah_alamat_tinggal" name="tambah_alamat_tinggal">
                            <option selected>Pilih</option>
                            <option id="sesuai_ktp" value="sesuai"@if($row->alamat_tinggal == 'sesuai') selected @endif>Sesuai KTP</option>
                            <option id="tidak_sesuai_ktp" value="tidakSesuai"@if($row->alamat_tinggal == 'tidakSesuai') selected @endif>Tidak Sesuai KTP</option>
                        </select>
                    </div><br>
                    <div class="" id="divtidaksesuaiktp" @if($row->alamat_tinggal == 'sesuai') style="display: none;" @else style="display: show;" @endif>
                        <div class="col-md">
                            <label for="fullname" class="form-label">Alamat Saat Ini(domisili)</label>
                            <input class="form-control date" type="text" id="tambah_alamat_domisili" name="tambah_alamat_domisili" placeholder="Jl. Raya Nommor:00 RT/RW">
                        </div>

                        <div class="row g-2">
                            <div class="col-md">
                                <label for="fullname" class="form-label">Provinsi</label>
                                <select class="form-control select2" id="tambah_provinsi_domisili" name="tambah_provinsi_domisili" placeholder="dd/mm/yyyy">
                                    <option>Provinsi</option>
                                    <option>Data Masih Diproses</option>
                                </select>
                            </div>
                            <div class="col-md">
                                <label for="fullname" class="form-label">Kota / Kabupaten</label>
                                <select class="form-control" id="tambah_kota_kabupaten_domisili" name="tambah_kota_kabupaten_domisili" placeholder="Enter your name">
                                    <option>Kabupaten/Kota</option>
                                    <option>Pilih Provinsi Terlebih Dahulu</option>
                                </select>
                            </div>
                        </div><br>
                        
                        <div class="row g-2">
                            <div class="col-md">
                                <label for="fullname" class="form-label">Kecamatan</label>
                                <select class="form-control" id="tambah_kecamatan_domisili" name="tambah_kecamatan_domisili" placeholder="dd/mm/yyyy">
                                    <option>Kecamatan</option>
                                    <option>Pilih Kota / Kabupaten Terlebih Dahulu</option>
                                </select>
                            </div>
                            <div class="col-md">
                                <label for="fullname" class="form-label">Kelurahan</label>
                                <select class="form-control" id="tambah_kelurahan_domisili" name="tambah_kelurahan_domisili" placeholder="Enter your name">
                                    <option>Kelurahan</option>
                                    <option>Pilih Kelurahan Terlebih Dahulu</option>
                                </select>
                            </div>
                            <input type="hidden" class="form-control" id="tambah_old_provinsi">
                            <input type="hidden" class="form-control" id="tambah_old_kota">
                            <input type="hidden" class="form-control" id="tambah_old_kecamatan">
                            <input type="hidden" class="form-control" id="tambah_old_kelurahan">
                            <input type="hidden" class="form-control" id="tambah_old_provinsi_domisili">
                            <input type="hidden" class="form-control" id="tambah_old_kota_domisili">
                            <input type="hidden" class="form-control" id="tambah_old_kecamatan_domisili">
                            <input type="hidden" class="form-control" id="tambah_old_kelurahan_domisili">
                        </div>
                        <hr><br>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Upload Foto KTP</label>
                        <input class="form-control" type="file" id="tambah_upload_foto_ktp" name="tambah_upload_foto_ktp">
                    </div><hr><br>

                    <br><div class="mb-3 text-center" >
                        <button class="btn btn-primary" type="submit" id="btntambahdatacifanggota"> Simpan </button>
                    </div>
                </form>
                <h5>Histori Data</h5><hr>
                <table id="scroll-horizontal-datatable" class="table table-striped w-100 nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor BA</th>
                            <th>Nama Lengkap</th>
                            <th>No HP</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>No KTP</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Status Nikah</th>
                            <th>No NPWP</th>
                            <th>Alamat KTP</th>
                            <th>Provinsi KTP</th>
                            <th>Kota KTP</th>
                            <th>Kecamatan KTP</th>
                            <th>Kelurahan KTP</th>
                            <th>Alamat Tinggal</th>
                            <th>Alamat Domisili</th>
                            <th>Provinsi Domisili</th>
                            <th>Kota Domisili</th>
                            <th>Kecamatan Domisili</th>
                            <th>Kelurahan Domisili</th>
                            <th>Updated_at</th>
                        </tr>
                    </thead>
                    @php
                        $histori_anggota = DB::table('gtc_histori_anggota')->where('id_anggota', $row->ida)->get();
                        //dd($histori_anggota);
                        $no = 1;
                    @endphp
                    <tbody id="bodyhistorianggota">
                    </tbody>
                    <!-- @foreach($histori_anggota as $row)
                    <tbody id="bodyhistorianggota">
                        <td>{{$no++}}</td>
                        <td>{{$row->nomor_ba}}</td>
                        <td>{{$row->nama_lengkap}}</td>
                        <td>{{$row->nomor_hp}}</td>
                        <td>{{$row->email}}</td>
                        <td>{{$row->status}}</td>
                        <td>{{$row->no_ktp}}</td>
                        <td>{{$row->jenis_kelamin}}</td>
                        <td>{{$row->tempat_lahir}}</td>
                        <td>{{$row->tanggal_lahir}}</td>
                        <td>{{$row->status_nikah}}</td>
                        <td>{{$row->no_npwp}}</td>
                        <td>{{$row->alamat_ktp}}</td>
                        <td>{{$row->provinsi_ktp}}</td>
                        <td>{{$row->kota_ktp}}</td>
                        <td>{{$row->kecamatan_ktp}}</td>
                        <td>{{$row->kelurahan_ktp}}</td>
                        <td>{{$row->alamat_tinggal}}</td>
                        <td>{{$row->alamat_domisili}}</td>
                        <td>{{$row->provinsi_domisili}}</td>
                        <td>{{$row->kota_domisili}}</td>
                        <td>{{$row->kecamatan_domisili}}</td>
                        <td>{{$row->kelurahan_domisili}}</td>
                        <td>{{$row->updated_at}}</td>
                    </tbody>
                    @endforeach -->
                </table>    
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endforeach
<div class="modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg loading authentication-bg">
        <div class="modal-content bg-transparent">
        <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-7 col-lg-5">
                        <div class="card">
                            <!-- Logo-->
                            <div class="modal-header" style="background-color: #afb4be">
                                <div style="color: rgb(255, 255, 255);"><h4 id="modalHeading">Tambah Item Emas</h4></div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                            </div>
                            <div class="card-body p-4" id="panel_emas_syirkah">
                                <form id="formaddemasgtc" method="post">
                                @csrf
                                    <div class="">
                                        <div class="col-md">
                                            <label for="" class="form-label">Item Emas</label>
                                            @foreach($data as $row)
                                            <input type="hidden" id="kode_pengajuan_emasgtc" name="kode_pengajuan_emasgtc" value="{{$row->kode_pengajuan}}">
                                            @endforeach
                                            <input type="text" class="form-control" id="item_emas" name="item_emas" value="{{$emas_syirkah->nama}}" readonly>
                                        </div>
                                        <div class="col-md">
                                            <label for="" class="form-label">Jenis</label>
                                            <input type="text" class="form-control" id="jenis" name="jenis" value="{{$emas_syirkah->jenis}}" readonly>
                                        </div>
                                        <div class="col-md">
                                            <label for="" class="form-label">Gramasi</label>
                                            <input type="text" class="form-control" id="gramasi" name="gramasi" value="{{$emas_syirkah->gramasi}}" readonly>
                                        </div>
                                        <div class="col-md">
                                            <label for="" class="form-label">Harga Buyback</label>
                                            <select type="text" class="form-select" id="harga_buyback" name="harga_buyback">
                                                @foreach($item_emas as $item)
                                                <option id="id_emas_syirkah" value="{{$item->id}}">{{$item->gramasi}}</option>
                                                @endforeach
                                            </select>
                                        </div><br>
                                        <div class="col-md">
                                            <button class="btn btn-warning" id="btnaddemasgtc" type="submit">Tambah</button>
                                        </div>
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
<div class="modal fade" id="addemasgtc" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #afb4be">
                <h4 class="modal-title" style="color: rgb(255, 255, 255);" id="myLargeModalLabel">Tambah Data Emas</h4>
                <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="">
                    <table id="tabelemasgtc" class="table table-borderless table-nowrap table-centered mb-0">
                        <thead class="text-white bg-secondary ">
                            <tr>
                                <th>Item emas</th>
                                <th>Jenis</th>
                                <th>Gramasi</th>
                                <th style="width: 20px;"></th>
                            </tr>
                        </thead>
                        <tbody id="tbodyemasgtc">
                        </tbody>
                    </table>
                </div><hr><br>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection
@push('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('customjs/backend/edit_pengajuan_gtc.js')}}"></script>
<script src="{{asset('customjs/backend/loading.js')}}"></script>
<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css"> -->
  
    <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>  -->
    <!-- <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">  -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  
    <script type="text/javascript" src="{{asset('assets/signature/js/jquery.signature.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/signature/css/jquery.signature.css')}}">
  
    <style>
        .kbw-signature { width: 400px; height: 200px;}
        #sig canvas{
            width: 100% !important;
            height: auto;
        }
    </style>
    <script type="text/javascript">
    var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });
    function tandatangan(){
        $('#sig').show()
        $('#tanda_tangan').hide()
    }
</script>
<!-- <script>
    getdataemasgtc();
    function getdataemasgtc(){
        $('#tabel').html('<table><thead><tr><th>QTY</th><th>PRICE</th> <th>SUM</th></tr></thead><tbody><tr><td><input class="qty" size="1"/></td><td class="price">1.25</td><td class="sum">0</td></tr><tr><td><input class="qty" size="1"/></td><td class="price">2.10</td><td class="sum">0</td></tr> <tr><td><input class="qty" size="1"/></td><td class="price">10.50</td><td class="sum">0</td></tr> <tr><td colspan="2">Total</td><td id="total"></td> </tr> </tbody></table>')
        getTotal();
        keping();
    }
    function getTotal(){
    var total = 0;
    $('.sum').each(function(){
        total += parseFloat(this.innerHTML)
    });
    $('#total').text(total);
}

getTotal();
keping();
function keping(){
    $('.qty').keyup(function(){
        var parent = $(this).parents('tr');
        var price = $('.price', parent);
        var sum = $('.sum', parent);
        var value = parseInt(this.value) * parseFloat(price.get(0).innerHTML||0);
        sum.text(value);
        getTotal();
    })
}
</script> -->
<!-- <script type="text/javascript">
        $('#cari').click(function(e){
        $('#panel').loading('toggle');
        $('#id_anggota').val('')
        $('#nama_lengkap').val('')
        $('#no_hp').val('')
        $('#email').val('')
        $('#detailpemohonbtn').prop('disabled', true)
        $('#datacifanggotabtn').prop('disabled', true)
        $('#btnmodaladdemasgtc').prop('disabled', true)
        // ========================================================
        $('#detail_nomor_buku_anggota').text(': ')
        $('#detail_nama_lengkap').text(': ')
        $('#detail_nomor_hp').text(': ')
        $('#detail_email').text(': ')
        $('#detail_nomor_ktp').text(': ')
        $('#detail_jenis_kelamin').text(': ')
        $('#detail_tempat_lahir').text(': ')
        $('#detail_tanggal_lahir').text(': ')
        $('#detail_status_pernikahan').text(': ')
        $('#detail_nomor_npwp').text(': ')
        $('#detail_alamat_sesuai_ktp').text(': ')
        $('#detail_kecamatan').text(': ')
        $('#detail_kota_kabupaten').text(': ')
        $('#detail_provinsi').text(': ')
        $('#detail_alamat_tinggal').text(': ')
        $('#detail_alamat_tinggal_domisili').text(': ')
        $('#detail_kecamatan_domisili').text(': ')
        $('#detail_kota_kabupaten_domisili').text(': ')
        $('#detail_provinsi_domisili').text(': ')
        $('#detail_photo_ktp').text(': ')
        // ===============================================================
        $('#tambah_id_anggota').val('')
        $('#tambah_nomor_ba').val('')
        $('#tambah_nama_lengkap').val('')
        $('#tambah_nomor_hp').val('')
        $('#tambah_email').val('')
        $('#tambah_nomor_ktp').val('')
        $('#tambah_jenis_kelamin').val('')
        $('#tambah_tempat_lahir').val('')
        $('#tambah_tanggal_lahir').val('')
        $('#tambah_status_pernikahan').val('')
        $('#tambah_nomor_npwp').val('')
        $('#tambah_alamat_sesuai_ktp').val('')
        $('#tambah_alamat_tinggal').val('')
        $('#tambah_alamat_domisili').val('')
        $('#tambah_old_provinsi').val('')
        $('#tambah_old_kota').val('')
        $('#tambah_old_kecamatan').val('')
        $('#tambah_old_kelurahan').val('')
        $('#tambah_old_provinsi_domisili').val('')
        $('#tambah_old_kota_domisili').val('')
        $('#tambah_old_kecamatan_domisili').val('')
        $('#tambah_old_kelurahan_domisili').val('')
        // ===================================================
        $('#pilihan_jasa').val('')
        $('#perhitungan_jasa').val('')
        $('#jangka_waktu_1').val('')
        $('#pengali_kurangdari_satudelapan_1').val('')
        $('#pengali_diatas_dua_1').val('')
        $('#jangka_waktu_2').val('')
        $('#pengali_kurangdari_satudelapan_2').val('')
        $('#pengali_diatas_dua_2').val('')
        $('#jangka_waktu_3').val('')
        $('#pengali_kurangdari_satudelapan_3').val('')
        $('#pengali_diatas_dua_3').val('')
        $('#jangka_waktu_4').val('')
        $('#pengali_kurangdari_satudelapan_4').val('')
        $('#pengali_diatas_dua_4').val('')
        // ===================================================
        $('#kode_pengajuan').val('')
        $('#kode_pengajuan_emasgtc').val('')
        $('#kode_transaksi').val('')
        e.preventDefault();
        $(this).html('Mencari...');
            var kode = $('#no_ba').val();
            $.ajax({
                type: 'GET',
                url: '/backend/cari-nomor-ba/' + kode,
                success: function(data){
                    $.each(data.anggota, function(key, item){
                        $('#cari').html('Ditemukan');
                        $('#id_anggota').val(item.id)
                        $('#nama_lengkap').val(item.nama_lengkap)
                        $('#no_hp').val(item.no_hp)
                        $('#email').val(item.email)
                        $('#detailpemohonbtn').prop('disabled', false)
                        $('#datacifanggotabtn').prop('disabled', false)
                        $('#btnmodaladdemasgtc').prop('disabled', false)
                        // ========================================================
                        $('#detail_nomor_buku_anggota').text(': '+item.nomor_ba)
                        $('#detail_nama_lengkap').text(': '+item.nama_lengkap)
                        $('#detail_nomor_hp').text(': '+item.no_hp)
                        $('#detail_email').text(': '+item.email)
                        $('#detail_nomor_ktp').text(': '+item.no_ktp)
                        $('#detail_jenis_kelamin').text(': '+item.jenis_kelamin)
                        $('#detail_tempat_lahir').text(': '+item.tempat_lahir)
                        $('#detail_tanggal_lahir').text(': '+item.tanggal_lahir)
                        $('#detail_status_pernikahan').text(': '+item.status_nikah)
                        $('#detail_nomor_npwp').text(': '+item.no_npwp)
                        $('#detail_alamat_sesuai_ktp').text(': '+item.alamat_ktp)
                        $('#detail_kecamatan').text(': '+item.kecamatan_ktp)
                        $('#detail_kota_kabupaten').text(': '+item.kota_ktp)
                        $('#detail_provinsi').text(': '+item.provinsi_ktp)
                        $('#detail_alamat_tinggal').text(': '+item.alamat_tinggal)
                        $('#detail_alamat_tinggal_domisili').text(': '+item.alamat_domisili)
                        $('#detail_kecamatan_domisili').text(': '+item.kecamatan_domisili)
                        $('#detail_kota_kabupaten_domisili').text(': '+item.kota_domisili)
                        $('#detail_provinsi_domisili').text(': '+item.provinsi_domisili)
                        $('#detail_photo_ktp').text(': '+item.lokasi_foto_ktp)
                        // ===============================================================
                        $('#tambah_id_anggota').val(item.id)
                        $('#tambah_nomor_ba').val(item.nomor_ba)
                        $('#tambah_nama_lengkap').val(item.nama_lengkap)
                        $('#tambah_nomor_hp').val(item.no_hp)
                        $('#tambah_email').val(item.email)
                        $('#tambah_nomor_ktp').val(item.no_ktp)
                        $('#tambah_jenis_kelamin').val(item.jenis_kelamin)
                        $('#tambah_tempat_lahir').val(item.tempat_lahir)
                        $('#tambah_tanggal_lahir').val(item.tanggal_lahir)
                        $('#tambah_status_pernikahan').val(item.status_nikah)
                        $('#tambah_nomor_npwp').val(item.no_npwp)
                        $('#tambah_alamat_sesuai_ktp').val(item.alamat_ktp)
                        $('#tambah_alamat_tinggal').val(item.alamat_tinggal)
                        if(item.alamat_tinggal === 'tidakSesuai'){
                            $('#divtidaksesuaiktp').show();
                        }else{
                            $('#divtidaksesuaiktp').hide();
                        }
                        $('#tambah_alamat_domisili').val(item.alamat_domisili)
                        $('#tambah_old_provinsi').val(item.provinsi_ktp)
                        $('#tambah_old_kota').val(item.kota_ktp)
                        $('#tambah_old_kecamatan').val(item.kecamatan_ktp)
                        $('#tambah_old_kelurahan').val(item.kelurahan_ktp)
                        $('#tambah_old_provinsi_domisili').val(item.provinsi_domisili)
                        $('#tambah_old_kota_domisili').val(item.kota_domisili)
                        $('#tambah_old_kecamatan_domisili').val(item.kecamatan_domisili)
                        $('#tambah_old_kelurahan_domisili').val(item.kelurahan_domisili)
                    }),
                    $.each(data.jenisjasagtc, function(key, item){
                        $('#pilihan_jasa').val(item.pilihan_jasa)
                        $('#perhitungan_jasa').val(item.perhitungan_jasa)
                        $('#jangka_waktu_1').val(item.jangka_waktu_1)
                        $('#pengali_kurangdari_satudelapan_1').val(item.pengali_kurangdari_satudelapan_1)
                        $('#pengali_diatas_dua_1').val(item.pengali_diatas_dua_1)
                        $('#jangka_waktu_2').val(item.jangka_waktu_2)
                        $('#pengali_kurangdari_satudelapan_2').val(item.pengali_kurangdari_satudelapan_2)
                        $('#pengali_diatas_dua_2').val(item.pengali_diatas_dua_2)
                        $('#jangka_waktu_3').val(item.jangka_waktu_3)
                        $('#pengali_kurangdari_satudelapan_3').val(item.pengali_kurangdari_satudelapan_3)
                        $('#pengali_diatas_dua_3').val(item.pengali_diatas_dua_3)
                        $('#jangka_waktu_4').val(item.jangka_waktu_4)
                        $('#pengali_kurangdari_satudelapan_4').val(item.pengali_kurangdari_satudelapan_4)
                        $('#pengali_diatas_dua_4').val(item.pengali_diatas_dua_4)
                    })
                    $('#kode_pengajuan').val(data.finalkode)
                    $('#kode_pengajuan_emasgtc').val(data.finalkode)
                    var kodepengajuan = $('#kode_pengajuan').val();
                    $.ajax({
                        type: 'GET',
                        url: '/backend/cari-kode-pengajuan-hasil/' + kodepengajuan,
                        success: function(data){
                            var newkodepengajuan = data.finalkodetransaksi.split(".");
                            $('#kode_transaksi').val('B.'+newkodepengajuan[1]+'.'+newkodepengajuan[2]+'.'+newkodepengajuan[3])
                        },
                        complete: function () {
                            $('#panel').loading('stop');
                        }
                    })
                },
                complete: function () {
                    $('#panel').loading('stop');
                    getdataemasgtc();
                }
            })
    });
    function getdataemasgtc() {
        $('#panel').loading('toggle');
        $('#bodyemasgtc').html('');
        $('#footemasgtc').html('');
        var kode = $('#kode_pengajuan_emasgtc').val();
        $.ajax({
            type: 'GET',
            url: '/backend/cari-data-emas-gtc/' + kode,
            success: function (data) {
                var rows = '';
                var no = 0;
                $.each(data.emas, function (key, value) {
                    no += 1;
                    rows = rows + '<tr>';
                    rows = rows + '<td hidden><input type="hidden" class="form-control" value="'+ value.id +'" id="id_emas" name="id_emas[]"></td>';
                    rows = rows + '<td>' + value.item_emas + '</td>';
                    rows = rows + '<td><span class="badge badge-primary-lighten">'+ value.jenis +'</span></td>';
                    rows = rows + '<td id="gramasi">' + value.gramasi + '</td>';
                    var harga_buyback = parseFloat(value.harga_buyback);
                    rows = rows + '<td id="harga_buyback">' + (harga_buyback.toLocaleString("id-ID")) + '</td>';
                    rows = rows + '<td hidden id="harga_buyback_hidden">' + value.harga_buyback + '</td>';
                    rows = rows + '<td><input type="number" min="1" value="0" id="keping" class="form-control" name="keping[]" placeholder="Qty" style="width: 90px;"></td>';
                    rows = rows + '<td id="jumlah_gramasi">' + 0 + '</td>';
                    rows = rows + '<td id="jumlah_buyback">' + 0 + '</td>';
                    rows = rows + '<td hidden id="jumlah_buyback_hidden">' + 0 + '</td>';
                    rows = rows + '<td><a onclick="hapusdataemasgtc('+ value.id +')" class="action-icon"> <i class="mdi mdi-delete"></i></a></td>';
                    rows = rows + '</tr>';
                }
                );
                $('#bodyemasgtc').html(rows);
                $("#footemasgtc").html('<tr><th>Total</th><th></th><th></th><th></th><th id="total_keping">0</th><th id="total_gramasi">0</th><th id="total_buyback">0</th><th style="width: 50px;"></th></tr>');
            }, complete: function () {
                $('#panel').loading('stop');
                getTotal();
            }
        });
    }
    function getTotal(){
        var total_keping = 0;
        $('#keping').each(function(){
            total_keping += parseInt(this.value)
        });
        $('#total_keping').text(total_keping + " Keping");

        var total_gramasi = 0;
        $('#jumlah_gramasi').each(function(){
            total_gramasi += parseFloat(this.innerHTML)
        });
        $('#total_gramasi').text(total_gramasi + " Gram");

        var total_buyback = 0;
        $('#jumlah_buyback_hidden').each(function(){
            total_buyback += parseFloat(this.innerHTML)
            var format_total_buyback = total_buyback.toLocaleString("id-ID")
            $('#total_buyback').text("Rp "+ format_total_buyback);
        });

        $('#keping').keyup(function(){
            var parent = $(this).parents('tr');
            var gramasi = $('#gramasi', parent);
            var jumlah_gramasi = $('#jumlah_gramasi', parent);
            var value_gramasi = parseInt(this.value) * parseFloat(gramasi.get(0).innerHTML||0);
            jumlah_gramasi.text(value_gramasi);

            var harga_buyback = $('#harga_buyback_hidden', parent);
            var jumlah_buyback = $('#jumlah_buyback', parent);
            var jumlah_buyback_hidden = $('#jumlah_buyback_hidden', parent);
            var value_buyback = parseInt(this.value) * parseFloat(harga_buyback.get(0).innerHTML||0);
            jumlah_buyback_hidden.text(value_buyback);
            var format_jumlah_buyback = value_buyback.toLocaleString("id-ID")
            jumlah_buyback.text(format_jumlah_buyback);
            getTotal();
            $('#pengajuan').val('').change();
        })

        // ============================== validasi
        var newformat = format_total_buyback.replace(/[^,\d]/g, '').toString()
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
        $("#plafond_pinjaman").val(rupiah).trigger('change');
        var plafond_pinjaman = $("#plafond_pinjaman").val();
        var newplafond_pinjaman = plafond_pinjaman.split(".");
        $("#plafond_pinjaman_hidden").val(newplafond_pinjaman).trigger('change');
        var pengajuan = $("#pengajuan").val();
        var newpengajuan = pengajuan.split(".");
        $("#pengajuan_hidden").val(newpengajuan).trigger('change');
        // ============================== transaksi
        $('#pengajuan').change(function(){
            $('#jangka_waktu_permohonan').val('Pilih').change()
            $('#jangka_waktu_permohonan').change(function(){
                if($(this).val() === '0.5'){
                    if(parseFloat(total_gramasi)>=0.1 && parseFloat(total_gramasi)<=49.9){
                        jangka_waktu = $('#jangka_waktu_1').val()
                        numjangka_waktu = parseFloat(jangka_waktu)
                        pengali = $('#pengali_kurangdari_satudelapan_1').val()
                        numpengali = parseFloat(pengali)
                        hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*total_buyback).toFixed(0)
                        newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                        bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                        hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                        $('#jasa_gtc').val(hasiljasa).trigger('change')
                        $('#pembayaran_jasa').val('Pilih').trigger('change')
                    }else if(total_gramasi>=50){
                        jangka_waktu = $('#jangka_waktu_1').val()
                        numjangka_waktu = parseFloat(jangka_waktu)
                        pengali = $('#pengali_diatas_dua_1').val()
                        numpengali = parseFloat(pengali)
                        hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*total_buyback).toFixed(0)
                        newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                        bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                        hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                        $('#jasa_gtc').val(hasiljasa).trigger('change')
                        $('#pembayaran_jasa').val('Pilih').trigger('change')
                    }
                }else if($(this).val() === '1'){
                    if(parseFloat(total_gramasi)>=0.1 && parseFloat(total_gramasi)<=49.9){
                        jangka_waktu = $('#jangka_waktu_2').val()
                        numjangka_waktu = parseFloat(jangka_waktu)
                        pengali = $('#pengali_kurangdari_satudelapan_2').val()
                        numpengali = parseFloat(pengali)
                        hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*total_buyback).toFixed(0)
                        newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                        bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                        hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                        $('#jasa_gtc').val(hasiljasa).trigger('change')
                        $('#pembayaran_jasa').val('Pilih').trigger('change')
                    }else if(total_gramasi>=50){
                        jangka_waktu = $('#jangka_waktu_2').val()
                        numjangka_waktu = parseFloat(jangka_waktu)
                        pengali = $('#pengali_diatas_dua_2').val()
                        numpengali = parseFloat(pengali)
                        hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*total_buyback).toFixed(0)
                        newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                        bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                        hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                        $('#jasa_gtc').val(hasiljasa).trigger('change')
                        $('#pembayaran_jasa').val('Pilih').trigger('change')
                    }
                }else if($(this).val() === '2'){
                    if(parseFloat(total_gramasi)>=0.1 && parseFloat(total_gramasi)<=49.9){
                        jangka_waktu = $('#jangka_waktu_3').val()
                        numjangka_waktu = parseFloat(jangka_waktu)
                        pengali = $('#pengali_kurangdari_satudelapan_3').val()
                        numpengali = parseFloat(pengali)
                        hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*total_buyback).toFixed(0)
                        newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                        bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                        hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                        $('#jasa_gtc').val(hasiljasa).trigger('change')
                        $('#pembayaran_jasa').val('Pilih').trigger('change')
                    }else if(total_gramasi>=50){
                        jangka_waktu = $('#jangka_waktu_3').val()
                        numjangka_waktu = parseFloat(jangka_waktu)
                        pengali = $('#pengali_diatas_dua_3').val()
                        numpengali = parseFloat(pengali)
                        hitungjasa = Number ((numpengali/100*100)*numjangka_waktu*total_buyback).toFixed(0)
                        newhitungjasa = hitungjasa.substring (0, hitungjasa.length-2)
                        bulathitungjasa = (Math.ceil(newhitungjasa/1000)*1000)
                        hasiljasa = bulathitungjasa.toLocaleString("id-ID")
                        $('#jasa_gtc').val(hasiljasa).trigger('change')
                        $('#pembayaran_jasa').val('Pilih').trigger('change')
                    }
                }else{
                    $('#jasa_gtc').val('').trigger('change')
                    $('#pembayaran_jasa').val('Pilih').trigger('change')
                }
            })
            $('#pembayaran_jasa').change(function(){
                if($(this).val() === 'Transfer'){
                    $('#div_upload_bukti_transfer').show()
                    $('#ket_simpwa').val('Pilih').change()
                }else if($(this).val() === 'Dipotong dari GTC'){
                    $('#div_upload_bukti_transfer').hide()
                    $('#ket_simpwa').val('Pilih').change()
                }else{
                    $('#div_upload_bukti_transfer').hide()
                    $('#ket_simpwa').val('Pilih').change()
                }
                $('#ket_simpwa').change(function(){
                    if($(this).val() === 'Dipotong dari GTC'){
                        $('#div_nominal_potongan').show()
                        $('#nominal_potongan').change(function(){
                            var pengajuan = $('#pengajuan').val().replace(/[^,\d]/g, '').toString()
                            var jasa_gtc = $('#jasa_gtc').val().replace(/[^,\d]/g, '').toString()
                            var nominal_potongan = $('#nominal_potongan').val().replace(/[^,\d]/g, '').toString()
                            var jumlah_yang_di_transfer = pengajuan-jasa_gtc-nominal_potongan;
                            var jumlah_yang_di_transfer_format = jumlah_yang_di_transfer.toLocaleString("id-ID")
                            $('#jumlah_yang_di_transfer').val(jumlah_yang_di_transfer_format).change();
                        })
                        $('#jumlah_yang_di_transfer').val('').trigger();
                    }else if($(this).val() === 'Lunas'){
                        $('#div_nominal_potongan').hide()
                        $('#nominal_potongan').val('').change();
                        var pengajuan = $('#pengajuan').val().replace(/[^,\d]/g, '').toString()
                        var jasa_gtc = $('#jasa_gtc').val().replace(/[^,\d]/g, '').toString()
                        var nominal_potongan = 0
                        var jumlah_yang_di_transfer = pengajuan-jasa_gtc-nominal_potongan;
                        var jumlah_yang_di_transfer_format = jumlah_yang_di_transfer.toLocaleString("id-ID")
                        $('#jumlah_yang_di_transfer').val(jumlah_yang_di_transfer_format).trigger();
                    }else{
                        $('#div_nominal_potongan').hide()
                        $('#nominal_potongan').val('').change();
                        $('#nominal_potongan').change(function(){
                            $('#jumlah_yang_di_transfer').val('').change();
                        })
                    }
                })
            })
        })
        
        
        //=============================== 
        
        
    }
</script> -->
@endpush