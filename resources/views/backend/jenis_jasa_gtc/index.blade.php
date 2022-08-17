@extends('layouts.base')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
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
                        <li class="breadcrumb-item active">Jenis Jasa GTC</li>
                    </ol>
                </div>
                <h4 class="page-title">List Jenis Jasa GTC</h4>
            </div>
        </div>
    </div>
    <!-- end page title --> 


    <div class="row" id="panel">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-5">
                            <a href="javascript:void(0);" class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#addjenisjasagtc"><i class="mdi mdi-plus-circle me-2"></i> Jenis Jasa</a>
                        </div>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="scroll-horizontal-preview">
                            <table id="scroll-horizontal-datatable" class="table table-striped w-100 nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pilihan Jasa</th>
                                        <th>Perhitungan Jasa</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="bodyjenisjasagtc">   
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
    <!-- end row -->
    <div class="modal fade" id="addjenisjasagtc" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #afb4be">
                    <div style="color: rgb(255, 255, 255);"><h4>Tambah Jenis Jasa GTC</h4></div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="card-body p-4">
                    <form id="formaddjenisjasagtc" method="post">
                    @csrf
                        <div class="mb-3">
                            <label for="example-select" class="form-label">Pilihan Jasa</label>
                            <select class="form-select" id="pilihan_jasa" name="pilihan_jasa" required>
                                <option selected>Pilih</option>
                                <option value="Jasa diawal">Jasa diawal</option>
                                <option value="Jasa diakhir">Jasa diakhir</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="fullname" class="form-label">Perhitungan Jasa</label>
                            <input class="form-control" type="text" id="perhitungan_jasa" name="perhitungan_jasa" placeholder="text" required>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <label for="fullname" class="form-label">Jangka Waktu (Bulan)</label>
                                <input class="form-control" type="text" id="jangka_waktu_1" name="jangka_waktu_1" placeholder="00" required>
                            </div>
                            <div class="col-lg-4">
                                <label for="fullname" class="form-label">Pengali kurang dari 50gr (%) </label>
                                <input class="form-control" type="text" id="pengali_kurangdari_satudelapan_1" name="pengali_kurangdari_satudelapan_1" placeholder="1.8" required>
                            </div>
                            <div class="col-lg-4">
                                <label for="fullname" class="form-label">Pengali diatas 50gr (%)</label>
                                <input class="form-control" type="text" id="pengali_diatas_dua_1" name="pengali_diatas_dua_1" placeholder="2" required>
                            </div>
                        </div><br>
                        
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="fullname" class="form-label">Jangka Waktu (Bulan)</label>
                                <input class="form-control" type="text" id="jangka_waktu_2" name="jangka_waktu_2" placeholder="00" data-toggle="input-mask" data-mask-format="00" required>
                            </div>
                            <div class="col-lg-4">
                                <label for="fullname" class="form-label">Pengali kurang dari 50gr (%) </label>
                                <input class="form-control" type="text" id="pengali_kurangdari_satudelapan_2" name="pengali_kurangdari_satudelapan_2" placeholder="1.8" required>
                            </div>
                            <div class="col-lg-4">
                                <label for="fullname" class="form-label">Pengali diatas 50gr (%)</label>
                                <input class="form-control" type="text" id="pengali_diatas_dua_2" name="pengali_diatas_dua_2" placeholder="2" required>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-lg-4">
                                <label for="fullname" class="form-label">Jangka Waktu (Bulan)</label>
                                <input class="form-control" type="text" id="jangka_waktu_3" name="jangka_waktu_3" placeholder="00" data-toggle="input-mask" data-mask-format="00" required>
                            </div>
                            <div class="col-lg-4">
                                <label for="fullname" class="form-label">Pengali kurang dari 50gr (%) </label>
                                <input class="form-control" type="text" id="pengali_kurangdari_satudelapan_3" name="pengali_kurangdari_satudelapan_3" placeholder="1.8" required>
                            </div>
                            <div class="col-lg-4">
                                <label for="fullname" class="form-label">Pengali diatas 50gr (%)</label>
                                <input class="form-control" type="text" id="pengali_diatas_dua_3" name="pengali_diatas_dua_3" placeholder="2" required>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-lg-4">
                                <label for="fullname" class="form-label">Jangka Waktu (Bulan)</label>
                                <input class="form-control" type="text" id="jangka_waktu_4" name="jangka_waktu_4" placeholder="00" data-toggle="input-mask" data-mask-format="00" required>
                            </div>
                            <div class="col-lg-4">
                                <label for="fullname" class="form-label">Pengali kurang dari 50gr (%) </label>
                                <input class="form-control" type="text" id="pengali_kurangdari_satudelapan_4" name="pengali_kurangdari_satudelapan_4" placeholder="1.8" required>
                            </div>
                            <div class="col-lg-4">
                                <label for="fullname" class="form-label">Pengali diatas 50gr (%)</label>
                                <input class="form-control" type="text" id="pengali_diatas_dua_4" name="pengali_diatas_dua_4" placeholder="2" required>
                            </div>
                        </div><br>

                        <div class="mb-3">
                            <label for="example-select" class="form-label">Status</label>
                            <select class="form-select" id="status_1" name="status_1">
                                <option value="Active">Active</option>
                                <option value="NonAktif">NonAktif</option>
                            </select>
                        </div>
                        
                        <div class="mb-3 text-center" >
                            <button id="addjenisjasagtcbtn" class="btn btn-primary" type="submit"> Simpan </button>
                        </div>

                    </form>
                </div> <!-- end card-body -->
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" id="editjenisjasagtc" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #afb4be">
                    <div style="color: rgb(255, 255, 255);"><h4>Tambah Jenis Jasa GTC</h4></div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="card-body p-4">
                    <form id="formeditjenisjasagtc" method="post">
                    @csrf
                        <input type="hidden" name="_method" value="put">
                        <input type="hidden" id="id_jenisjasagtc" name="id_jenisjasagtc" class="form-control">
                        <div class="mb-3">
                            <label for="example-select" class="form-label">Pilihan Jasa</label>
                            <select class="form-select" id="edit_pilihan_jasa" name="edit_pilihan_jasa" required>
                                <option selected>Pilih</option>
                                <option value="Jasa diawal">Jasa diawal</option>
                                <option value="Jasa diakhir">Jasa diakhir</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="fullname" class="form-label">Perhitungan Jasa</label>
                            <input class="form-control" type="text" id="edit_perhitungan_jasa" name="edit_perhitungan_jasa" placeholder="text" required>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <label for="fullname" class="form-label">Jangka Waktu (Bulan)</label>
                                <input class="form-control" type="text" id="edit_jangka_waktu_1" name="edit_jangka_waktu_1" placeholder="00" required>
                            </div>
                            <div class="col-lg-4">
                                <label for="fullname" class="form-label">Pengali kurang dari 50gr (%) </label>
                                <input class="form-control" type="text" id="edit_pengali_kurangdari_satudelapan_1" name="edit_pengali_kurangdari_satudelapan_1" placeholder="1.8" required>
                            </div>
                            <div class="col-lg-4">
                                <label for="fullname" class="form-label">Pengali diatas 50gr (%)</label>
                                <input class="form-control" type="text" id="edit_pengali_diatas_dua_1" name="edit_pengali_diatas_dua_1" placeholder="2" required>
                            </div>
                        </div><br>
                        
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="fullname" class="form-label">Jangka Waktu (Bulan)</label>
                                <input class="form-control" type="text" id="edit_jangka_waktu_2" name="edit_jangka_waktu_2" placeholder="00" data-toggle="input-mask" data-mask-format="00" required>
                            </div>
                            <div class="col-lg-4">
                                <label for="fullname" class="form-label">Pengali kurang dari 50gr (%) </label>
                                <input class="form-control" type="text" id="edit_pengali_kurangdari_satudelapan_2" name="edit_pengali_kurangdari_satudelapan_2" placeholder="1.8" required>
                            </div>
                            <div class="col-lg-4">
                                <label for="fullname" class="form-label">Pengali diatas 50gr (%)</label>
                                <input class="form-control" type="text" id="edit_pengali_diatas_dua_2" name="edit_pengali_diatas_dua_2" placeholder="2" required>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-lg-4">
                                <label for="fullname" class="form-label">Jangka Waktu (Bulan)</label>
                                <input class="form-control" type="text" id="edit_jangka_waktu_3" name="edit_jangka_waktu_3" placeholder="00" data-toggle="input-mask" data-mask-format="00" required>
                            </div>
                            <div class="col-lg-4">
                                <label for="fullname" class="form-label">Pengali kurang dari 50gr (%) </label>
                                <input class="form-control" type="text" id="edit_pengali_kurangdari_satudelapan_3" name="edit_pengali_kurangdari_satudelapan_3" placeholder="1.8" required>
                            </div>
                            <div class="col-lg-4">
                                <label for="fullname" class="form-label">Pengali diatas 50gr (%)</label>
                                <input class="form-control" type="text" id="edit_pengali_diatas_dua_3" name="edit_pengali_diatas_dua_3" placeholder="2" required>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-lg-4">
                                <label for="fullname" class="form-label">Jangka Waktu (Bulan)</label>
                                <input class="form-control" type="text" id="edit_jangka_waktu_4" name="edit_jangka_waktu_4" placeholder="00" data-toggle="input-mask" data-mask-format="00" required>
                            </div>
                            <div class="col-lg-4">
                                <label for="fullname" class="form-label">Pengali kurang dari 50gr (%) </label>
                                <input class="form-control" type="text" id="edit_pengali_kurangdari_satudelapan_4" name="edit_pengali_kurangdari_satudelapan_4" placeholder="1.8" required>
                            </div>
                            <div class="col-lg-4">
                                <label for="fullname" class="form-label">Pengali diatas 50gr (%)</label>
                                <input class="form-control" type="text" id="edit_pengali_diatas_dua_4" name="edit_pengali_diatas_dua_4" placeholder="2" required>
                            </div>
                        </div><br>

                        <div class="mb-3">
                            <label for="example-select" class="form-label">Status</label>
                            <select class="form-select" id="edit_status_1" name="edit_status_1">
                                <option value="Active">Active</option>
                                <option value="NonAktif">NonAktif</option>
                            </select>
                        </div>
                        
                        <div class="mb-3 text-center" >
                            <button id="editjenisjasagtcbtn" class="btn btn-primary" type="submit"> Simpan </button>
                        </div>

                    </form>
                </div> <!-- end card-body -->
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" id="modal-tambah-versidsyirkah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg loading authentication-bg">
            <div class="modal-content bg-transparent">
            <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xxl-7 col-lg-5">
                            <div class="card">
                                <!-- Logo-->
                                <div class="modal-header" style="background-color: #afb4be">
                                    <div style="color: rgb(255, 255, 255);"><h4>Tambah Jenis Jasa GTC</h4></div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                </div>
                                <div class="card-body p-4">
                                    <form action="#">
                                        <div class="mb-3">
                                            <label for="example-select" class="form-label">Pilihan Jasa</label>
                                            <select class="form-select" id="example-select" required>
                                                <option selected>Pilih</option>
                                                <option>Jasa diawal</option>
                                                <option>Jasa diakhir</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="fullname" class="form-label">Perhitungan Jasa</label>
                                            <input class="form-control" type="text" id="fullname" placeholder="text" required>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="fullname" class="form-label">Jangka Waktu</label>
                                                <input class="form-control" type="text" id="fullname" placeholder="00" data-toggle="input-mask" data-mask-format="00" required>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="fullname" class="form-label">Pengali kurang dari 50gr </label>
                                                <input class="form-control" type="text" id="fullname" placeholder="50% anggota : 50% club" required>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="fullname" class="form-label">Pengali dibawah 50</label>
                                                <input class="form-control" type="text" id="fullname" placeholder="50% anggota : 50% club" required>
                                            </div>
                                        </div><br>
                                        
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="fullname" class="form-label">Jangka Waktu</label>
                                                <input class="form-control" type="text" id="fullname" placeholder="00" data-toggle="input-mask" data-mask-format="00" required>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="fullname" class="form-label">Nisbah</label>
                                                <input class="form-control" type="text" id="fullname" placeholder="50% anggota : 50% club" required>
                                            </div>
                                        </div><br>

                                        <div class="row lg-5">
                                            <div class="col-lg-6">
                                                <label for="fullname" class="form-label">Jangka Waktu</label>
                                                <input class="form-control" type="text" id="fullname" placeholder="00" data-toggle="input-mask" data-mask-format="00" required>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="fullname" class="form-label">Nisbah</label>
                                                <input class="form-control" type="text" id="fullname" placeholder="50% anggota : 50% club" required>
                                            </div>
                                        </div><br>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="fullname" class="form-label">Jangka Waktu</label>
                                                <input class="form-control" type="text" id="fullname" placeholder="00" data-toggle="input-mask" data-mask-format="00" required>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="fullname" class="form-label">Jangka Waktu</label>
                                                <input class="form-control" type="text" id="fullname" placeholder="50% anggota : 50% club" required>
                                            </div>
                                        </div><br>
                                        <div class="mb-3">
                                            <label for="example-select" class="form-label">Status</label>
                                            <select class="form-select" id="example-select">
                                                <option>Active</option>
                                                <option>NonAktif</option>
                                            </select>
                                        </div>
                                        
                                        <div class="mb-3 text-center" >
                                            <button class="btn btn-primary" type="submit"> Simpan </button>
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

    <div class="modal fade" id="modal-edit-versidsyirkah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg loading authentication-bg">
            <div class="modal-content bg-transparent">
            <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xxl-7 col-lg-5">
                            <div class="card">
                                <!-- Logo-->
                                <div class="modal-header" style="background-color: #afb4be">
                                    <div style="color: rgb(255, 255, 255);"><h4>Edit versi Dsyirkah</h4></div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                </div>
                                <div class="card-body p-4">
                                    <form action="#">
                                        <div class="mb-3">
                                            <label for="fullname" class="form-label">Jenis Syirkah</label>
                                            <input class="form-control" type="text" placeholder="Mutlaqah" data-toggle="input-mask" data-mask-format="Mutlaqah" id="fullname" readonly="">
                                        </div>

                                        <div class="mb-3">
                                            <label for="fullname" class="form-label">Versi Syirkah</label>
                                            <input class="form-control" type="text" id="fullname" placeholder="0.0" data-toggle="input-mask" data-mask-format="0.0" readonly="">
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="fullname" class="form-label">Bulan</label>
                                                <input class="form-control" type="text" id="fullname" placeholder="00" data-toggle="input-mask" data-mask-format="00" required>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="fullname" class="form-label">Nisbah</label>
                                                <input class="form-control" type="text" id="fullname" placeholder="50% anggota : 50% club" required>
                                            </div>
                                        </div><br>
                                        
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="fullname" class="form-label">Bulan</label>
                                                <input class="form-control" type="text" id="fullname" placeholder="00" data-toggle="input-mask" data-mask-format="00" required>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="fullname" class="form-label">Nisbah</label>
                                                <input class="form-control" type="text" id="fullname" placeholder="50% anggota : 50% club" required>
                                            </div>
                                        </div><br>

                                        <div class="row lg-5">
                                            <div class="col-lg-6">
                                                <label for="fullname" class="form-label">Bulan</label>
                                                <input class="form-control" type="text" id="fullname" placeholder="00" data-toggle="input-mask" data-mask-format="00" required>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="fullname" class="form-label">Nisbah</label>
                                                <input class="form-control" type="text" id="fullname" placeholder="50% anggota : 50% club" required>
                                            </div>
                                        </div><br>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="fullname" class="form-label">Bulan</label>
                                                <input class="form-control" type="text" id="fullname" placeholder="00" data-toggle="input-mask" data-mask-format="00" required>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="fullname" class="form-label">Nisbah</label>
                                                <input class="form-control" type="text" id="fullname" placeholder="50% anggota : 50% club" required>
                                            </div>
                                        </div><br>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="fullname" class="form-label">Bulan</label>
                                                <input class="form-control" type="text" id="fullname" placeholder="00" data-toggle="input-mask" data-mask-format="00" required>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="fullname" class="form-label">Nisbah</label>
                                                <input class="form-control" type="text" id="fullname" placeholder="50% anggota : 50% club" required>
                                            </div>
                                        </div><br>

                                        <div class="mb-3">
                                            <label for="example-select" class="form-label">Status</label>
                                            <select class="form-select" id="example-select">
                                                <option>Active</option>
                                                <option>NonAktif</option>
                                            </select>
                                        </div>
                                        
                                        <div class="mb-3 text-center" >
                                            <button class="btn btn-primary" type="submit"> Simpan </button>
                                        </div>
    
                                    </form>
                                </div> 
                                
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
    <script src="{{asset('customjs/backend/loading.js')}}"></script>
    <script src="{{asset('customjs/backend/jenis_jasa_gtc.js')}}"></script>
@endpush