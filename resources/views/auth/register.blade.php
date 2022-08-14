<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Datatables | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/template/images/favicon.ico')}}">

        <!-- third party css -->
        <link href="{{asset('assets/template/css/vendor/dataTables.bootstrap5.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/template/css/vendor/responsive.bootstrap5.css')}}" rel="stylesheet" type="text/css" />
        <!-- third party css end -->

        <!-- App css -->
        <link href="{{asset('assets/template/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/template/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style"/>

    </head>

    <body class="loading" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid" >
        <!-- <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5"> -->
        <div class="">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xxl-4 col-lg-5">
                            <div class="card">

                                <!-- Logo -->
                                <div class="card-header pt-4 pb-4 text-center bg-primary">
                                    <a href="{{url('/')}}">
                                        <span><img src="{{asset('assets/template/images/logo.png')}}" alt="" height="18"></span>
                                    </a>
                                </div>

                                <div class="card-body p-4">
                                   
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">{{ __('Nama Karyawan') }}</label>
                                            <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="Enter your name" name="nama" value="{{ old('nama') }}" required autocomplete="nama">
                                            @error('nama')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="username" class="form-label">{{ __('User ID') }}</label>
                                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Enter your username" name="username" value="{{ old('username') }}" required autocomplete="username">
                                            @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
    
                                        <div class="mb-3">
                                            <label for="emailaddress" class="form-label">{{ __('E-Mail Address') }}</label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="jabatan" class="form-label">{{ __('Jabatan') }}</label>
                                            <input id="jabatan" type="text" class="form-control @error('jabatan') is-invalid @enderror" placeholder="Enter your jabatan" name="jabatan" value="{{ old('jabatan') }}" required autocomplete="jabatan">
                                            @error('jabatan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="kantor" class="form-label">{{ __('Kantor') }}</label>
                                            @php
                                                $data = DB::table('perwada')->orderby('id','desc')->get();
                                            @endphp
                                            <select class="form-select" name="kantor" id="kantor" required>
                                                <option selected disabled>Pilihan</option>
                                                @foreach($data as $row)
                                                <option value="{{$row->id}}">{{$row->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="grup" class="form-label">{{ __('Grup') }}</label>
                                            @php
                                                $data = DB::table('roles')->orderby('id','desc')->get();
                                            @endphp
                                            <select class="form-select" name="grup" id="grup" required>
                                                <option selected disabled>Pilihan</option>
                                                @foreach($data as $row)
                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="password" class="form-label">{{ __('Password') }}</label>
                                            <div class="input-group input-group-merge">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password" name="password" required autocomplete="new-password">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <div class="input-group-text" data-password="false">
                                                    <span class="password-eye"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="password" class="form-label">{{ __('Confirm Password') }}</label>
                                            <div class="input-group input-group-merge">
                                            <input id="password-confirm" type="password" class="form-control" placeholder="Enter your password" name="password_confirmation" required autocomplete="new-password">
                                                <div class="input-group-text" data-password="false">
                                                    <span class="password-eye"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="a" class="form-label">{{ __('Status') }}</label>
                                            <select class="form-select" name="status" id="a" required>
                                                <option value="0">Active</option>
                                                <option value="1">NonAktiv</option>
                                            </select>
                                        </div>
                                        
                                        <div class="mb-3 text-center" >
                                            <button class="btn btn-primary" type="submit"> Daftar </button>
                                        </div>
    
                                    </form>
                                
                                </div> <!-- end card-body -->
                            </div>
                            <!-- end card -->

                            <!-- <div class="row mt-3">
                                <div class="col-12 text-center">
                                    <p class="text-muted">Don't have an account? <a href="pages-register.html" class="text-muted ms-1"><b>Sign Up</b></a></p>
                                </div>
                            </div> -->
                            <!-- end row -->

                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </div>

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

    </body>
</html>
