@extends('layouts.base')
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{asset('customjs/backend/loading.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="container-fluid">
    
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">D'Syirkah</a></li>
                        <li class="breadcrumb-item active">Pengaturan Akun</li>
                    </ol>
                </div>
                <h4 class="page-title">Pengaturan Akun</h4>
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
                        <p>User Terdiri dari</p>
                        <p>1.Administrator = All Akses</p>
                        <p>2.Teller OPR = Full Akses ke Aktif, Reakad Nonaktif, pengaturan akun anggota, (pengajuan no edit)</p>
                        <p>3.Admin = View+export pengajuan, Aktif, Reakad, Nonaktif, pengaturan akun anggota, edit pengajuan</p>
                        <p>4.Admin IT = full Akses master, Daftar Usaha & Users Anggota</p>
                        <p>5.Manager = View+export pengajuan, Aktif, Reakad Nonaktif, Daftar Usaha</p>
                        <p>6.Admin Perwada = View pengajuan, Aktif,</p>
                    </div>

                    <div class="row mb-2">
                        <div class="col-sm-5">
                            <a href="javascript:void(0);" class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#tambahakun"><i class="mdi mdi-plus-circle me-2"></i> Akun</a>
                        </div>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="scroll-horizontal-preview">
                            <table id="list-data" class="table table-striped w-100 nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Karyawan</th>
                                        <th>User</th>
                                        <th>Email</th>
                                        <th>Jabatan</th>
                                        <th>Kantor</th>
                                        <th>Grup</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- <tr>
                                        <td>1</td>
                                        <td class="table-user">
                                            <img src="assets/images/users/avatar-4.jpg" alt="table-user" class="me-2 rounded-circle">
                                            <a href="javascript:void(0);" class="text-body fw-semibold">Paul J. Friend</a>
                                        </td>
                                        <td>nasor</td>
                                        <td>aldie.acng@gmail.com</td>
                                        <td>Karyawan</td>
                                        <td>Pusat</td>
                                        <td>Teller OPR</td>
                                        <td>
                                            <span class="badge badge-success-lighten">Active</span>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" class="action-icon" data-bs-toggle="modal" data-bs-target="#modal-editakun-admin"> <i class="mdi mdi-square-edit-outline"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td class="table-user">
                                            <img src="assets/images/users/avatar-4.jpg" alt="table-user" class="me-2 rounded-circle">
                                            <a href="javascript:void(0);" class="text-body fw-semibold">Arief</a>
                                        </td>
                                        <td>nasor</td>
                                        <td>nasorudin@gmail.com</td>
                                        <td>Karyawan</td>
                                        <td>Pusat</td>
                                        <td>Administrator</td>
                                        <td>
                                            <span class="badge badge-danger-lighten">NonActive</span>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" class="action-icon" data-bs-toggle="modal" data-bs-target="#modal-editakun-admin"> <i class="mdi mdi-square-edit-outline"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td class="table-user">
                                            <img src="assets/images/users/avatar-4.jpg" alt="table-user" class="me-2 rounded-circle">
                                            <a href="javascript:void(0);" class="text-body fw-semibold">Aldie</a>
                                        </td>
                                        <td>nasor</td>
                                        <td>aldie.acng@gmail.com</td>
                                        <td>Karyawan</td>
                                        <td>Pusat</td>
                                        <td>Admin</td>
                                        <td>
                                            <span class="badge badge-success-lighten">Active</span>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" class="action-icon" data-bs-toggle="modal" data-bs-target="#modal-editakun-admin"> <i class="mdi mdi-square-edit-outline"></i></a>
                                        </td>
                                    </tr> -->
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

</div> <!-- container -->

<!-- Modal -->
<div class="modal fade" id="tambahakun" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg loading authentication-bg">
        <div class="modal-content bg-transparent">
        <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-7 col-lg-5">
                        <div class="card">
                            <!-- Logo-->
                            <div class="modal-header" style="background-color: #afb4be">
                                <div style="color: rgb(255, 255, 255);"><h4>Tambah Akun Admin</h4></div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                            </div>
                            <div class="card-body p-4">
                                <form id="formtambahakun" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="fullname" class="form-label">Nama Karyawan</label>
                                        <input class="form-control" type="text" id="tambah_namakaryawan" name="tambah_namakaryawan" placeholder="Enter your name" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="fullname" class="form-label">User ID</label>
                                        <input class="form-control" type="text" id="tambah_userid" name="tambah_userid" placeholder="Enter your name" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="emailaddress" class="form-label">Email address</label>
                                        <input class="form-control" type="email" id="tambah_email" name="tambah_email" required placeholder="Email">
                                    </div>

                                    <div class="mb-3">
                                        <label for="fullname" class="form-label">Jabatan</label>
                                        <input class="form-control" type="text" id="tambah_jabatan" name="tambah_jabatan" placeholder="Enter your name" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-select" class="form-label">Kantor</label>
                                        @php
                                            $perwada = DB::table('perwada')->get();
                                        @endphp
                                        <select class="form-select" id="tambah_kantor" name="tambah_kantor" required>
                                            <option selected>Pilihan</option>
                                            @foreach($perwada as $row)
                                            <option value="{{$row->id}}">{{$row->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-select" class="form-label">Grup</label>
                                        @php
                                            $grup = DB::table('roles')->get();
                                        @endphp
                                        <select class="form-select" id="tambah_grup" name="tambah_grup" required>
                                            <option selected>Pilihan</option>
                                            @foreach($grup as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="tambah_password" name="tambah_password" class="form-control" placeholder="Enter your password">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Konfirmasi Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="tambah_password_confirmation" name="tambah_password_confirmation" class="form-control" placeholder="Enter your password">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-select" class="form-label">Status</label>
                                        <select class="form-select" id="tambah_status" name="tambah_status">
                                            <option value="0">Active</option>
                                            <option value="1">NonAktiv</option>
                                        </select>
                                    </div>
                                    
                                    <div class="mb-3 text-center" >
                                        <button class="btn btn-primary" id="btntambahakun" type="submit"> Daftar </button>
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

<div class="modal fade" id="editakun" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg loading authentication-bg">
        <div class="modal-content bg-transparent">
        <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-7 col-lg-5">
                        <div class="card">
                            <!-- Logo-->
                            <div class="modal-header" style="background-color: #afb4be">
                                <div style="color: rgb(255, 255, 255);"><h4>Edit Akun Admin</h4></div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                            </div>
                            <div class="card-body p-4">
                                <form id="formeditakun" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="put">
                                    <input type="hidden" id="edit_id" name="edit_id" class="form-control">
                                    <div class="mb-3">
                                        <label for="fullname" class="form-label">Nama Karyawan</label>
                                        <input class="form-control" type="text" id="edit_namakaryawan" name="edit_namakaryawan" placeholder="Enter your name" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="fullname" class="form-label">User ID</label>
                                        <input class="form-control" type="text" id="edit_userid" name="edit_userid" placeholder="Enter your name" required>
                                        <input class="form-control" type="hidden" id="old_edit_userid" name="old_edit_userid" placeholder="Enter your name" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="emailaddress" class="form-label">Email address</label>
                                        <input class="form-control" type="email" id="edit_email" name="edit_email" required placeholder="Email">
                                        <input class="form-control" type="hidden" id="old_edit_email" name="old_edit_email" required placeholder="Email">
                                    </div>

                                    <div class="mb-3">
                                        <label for="fullname" class="form-label">Jabatan</label>
                                        <input class="form-control" type="text" id="edit_jabatan" name="edit_jabatan" placeholder="Enter your name" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-select" class="form-label">Kantor</label>
                                        @php
                                            $perwada = DB::table('perwada')->get();
                                        @endphp
                                        <select class="form-select" id="edit_kantor" name="edit_kantor" required>
                                            <option selected>Pilihan</option>
                                            @foreach($perwada as $row)
                                            <option value="{{$row->id}}">{{$row->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-select" class="form-label">Grup</label>
                                        @php
                                            $grup = DB::table('roles')->get();
                                        @endphp
                                        <select class="form-select" id="edit_grup" name="edit_grup" required>
                                            <option selected>Pilihan</option>
                                            @foreach($grup as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="edit_password" name="edit_password" class="form-control" placeholder="Enter your password">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Konfirmasi Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="edit_password_confirmation" name="edit_password_confirmation" class="form-control" placeholder="Enter your password">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-select" class="form-label">Status</label>
                                        <select class="form-select" id="edit_status" name="edit_status">
                                            <option value="0">Active</option>
                                            <option value="1">NonAktiv</option>
                                        </select>
                                    </div>
                                    
                                    <div class="mb-3 text-center" >
                                        <button class="btn btn-primary" id="btneditakun" type="submit"> Daftar </button>
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
<script src="{{asset('customjs/backend/admin.js')}}"></script>
<script src="{{asset('customjs/backend/loading.js')}}"></script>
@endpush
