<div class="leftside-menu">
    @php
        $perwada = Auth::user()->kantor;
    @endphp
    <!-- LOGO -->
    <a href="{{url('backend/home')}}" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{asset('assets/template/images/logo.png')}}" alt="" height="75">
        </span>
        <span class="logo-sm">
            <img src="{{asset('assets/template/images/logo.png')}}" alt="" height="30">
        </span>
    </a>

    {{-- <!-- LOGO -->
    <a href="{{url('backend/home')}}" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="{{asset('assets/template/images/logo.png')}}" alt="" height="75">
        </span>
        <span class="logo-sm">
            <img src="{{asset('assets/template/images/logo.png')}}" alt="" height="25">
        </span>
    </a> --}}

    <div class="h-100" id="leftside-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="side-nav">
                <!--li class="side-nav-title side-nav-item">Dasboard</li--> 

            <li class="side-nav-item">
                <a href="{{url('backend/home')}}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboards </span>
                </a>
            </li>

            <li class="side-nav-title side-nav-item">Users Dashboard</li>
            
            <li class="side-nav-item">
                <a href="ganti-sandi.html" class="side-nav-link">
                    <i class="uil-dialpad"></i>
                    <span> Ganti Sandi </span>
                </a>
            </li>
            
            @if($perwada !='1')
            @else
            <li class="side-nav-item">
                <a href="{{url('backend/pengaturan-akun')}}" class="side-nav-link">
                    <i class="uil-users-alt"></i>
                    <span> Pengaturan Akun </span>
                </a>
            </li>

            <li class="side-nav-title side-nav-item">MASTER</li>

            <li class="side-nav-item">
                <a href="{{url('backend/harga-emas')}}" class="side-nav-link">
                    <i class="uil-pricetag-alt"></i>
                    <span> Harga Buyback Emas </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{url('backend/jenis-jasa-gtc')}}" class="side-nav-link">
                    <i class="mdi mdi-checkbox-multiple-marked-circle-outline"></i>
                    <span> Jenis Jasa GTC </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{url('backend/whatsapp-gtc')}}" class="side-nav-link">
                    <i class="mdi mdi-checkbox-multiple-marked-circle-outline"></i>
                    <span> WhatsApp GTC </span>
                </a>
            </li>
            @endif
            
            <li class="side-nav-title side-nav-item">Get The Cash</li>
            
            <li class="side-nav-item">
                <a href="{{url('backend/pengajuan-gtc')}}" class="side-nav-link">
                    <i class="uil-receipt-alt"></i>
                    <span> Pengajuan GTC </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{url('backend/aktif-gtc')}}" class="side-nav-link">
                    <i class="uil-receipt"></i>
                    <span> Aktif GTC </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{url('backend/histori-transaksi-gtc')}}" class="side-nav-link">
                    <i class="uil-layer-group"></i>
                    <span> History Transaksi </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{url('backend/lunas-gtc')}}" class="side-nav-link">
                    <i class="uil-times-square"></i>
                    <span> Lunas GTC </span>
                </a>
            </li>
        </ul>
        
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->

</div>