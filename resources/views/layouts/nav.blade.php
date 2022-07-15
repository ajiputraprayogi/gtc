<div class="leftside-menu">
    
    <!-- LOGO -->
    <a href="{{url('backend/home')}}" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{asset('assets/template/images/logo.png')}}" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="{{asset('assets/template/images/logo_sm.png')}}" alt="" height="16">
        </span>
    </a>

    <!-- LOGO -->
    <a href="{{url('backend/home')}}" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="{{asset('assets/template/images/logo-dark.png')}}" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="{{asset('assets/template/images/logo_sm_dark.png')}}" alt="" height="16">
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="side-nav">
                <!--li class="side-nav-title side-nav-item">Dasboard</li--> 

            <li class="side-nav-item">
                <a href="{{url('backend/home')}}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span class="badge bg-success float-end">3</span>
                    <span> Dashboards </span>
                </a>
            </li>

            <li class="side-nav-title side-nav-item">Users Dashboard</li>
            
            <li class="side-nav-item">
                <a href="ganti-sandi.html" class="side-nav-link">
                    <i class="uil-dialpad"></i>
                    <span class="badge bg-primary float-end">2</span>
                    <span> Ganti Sandi </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="pengaturan-akun-admin.html" class="side-nav-link">
                    <i class="uil-users-alt"></i>
                    <span class="badge bg-primary float-end">2</span>
                    <span> Pengaturan Akun </span>
                </a>
            </li>

            <li class="side-nav-title side-nav-item">MASTER</li>

            <li class="side-nav-item">
                <a href="{{url('backend/harga-emas')}}" class="side-nav-link">
                    <i class="uil-pricetag-alt"></i>
                    <span class="badge bg-primary float-end">1</span>
                    <span> Harga Buyback Emas </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{url('backend/jenis-jasa-gtc')}}" class="side-nav-link">
                    <i class="mdi mdi-checkbox-multiple-marked-circle-outline"></i>
                    <span class="badge bg-primary float-end">1</span>
                    <span> Jenis Jasa GTC </span>
                </a>
            </li>

            <li class="side-nav-title side-nav-item">Get The Cash</li>
            
            <li class="side-nav-item">
                <a href="{{url('backend/pengajuan-gtc')}}" class="side-nav-link">
                    <i class="uil-receipt-alt"></i>
                    <span class="badge bg-primary float-end">1</span>
                    <span> Pengajuan GTC </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{url('backend/aktif-gtc')}}" class="side-nav-link">
                    <i class="uil-receipt"></i>
                    <span class="badge bg-primary float-end">1</span>
                    <span> Aktif GTC </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="lunas-gtc.html" class="side-nav-link">
                    <i class="uil-times-square"></i>
                    <span class="badge bg-primary float-end">1</span>
                    <span> Lunas GTC </span>
                </a>
            </li>
        </ul>
        
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->

</div>