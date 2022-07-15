<div class="navbar-custom">
    <ul class="list-unstyled topbar-menu float-end mb-0">
        <li class="dropdown notification-list d-lg-none">
            
            <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                <form class="p-3">
                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                </form>
            </div>
    

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="dripicons-bell noti-icon"></i>
                <span class="noti-icon-badge"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg">

                <!-- item-->
                <div class="dropdown-item noti-title px-3">
                    <h5 class="m-0">
                        <span class="float-end">
                            <a href="javascript: void(0);" class="text-dark">
                                <small>Clear All</small>
                            </a>
                        </span>Notification
                    </h5>
                </div>

                <div class="px-3" style="max-height: 300px;" data-simplebar>

                    <h5 class="text-muted font-13 fw-normal mt-0">Today</h5>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-2">
                        <div class="card-body">
                            <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>   
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="notify-icon bg-primary">
                                        <i class="mdi mdi-comment-account-outline"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 text-truncate ms-2">
                                    <h5 class="noti-item-title fw-semibold font-14">Datacorp <small class="fw-normal text-muted ms-1">1 min ago</small></h5>
                                    <small class="noti-item-subtitle text-muted">Caleb Flakelar commented on Admin</small>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-2">
                        <div class="card-body">
                            <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>   
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="notify-icon bg-info">
                                        <i class="mdi mdi-account-plus"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 text-truncate ms-2">
                                    <h5 class="noti-item-title fw-semibold font-14">Admin <small class="fw-normal text-muted ms-1">1 hours ago</small></h5>
                                    <small class="noti-item-subtitle text-muted">New user registered</small>
                                </div>
                            </div>
                        </div>
                    </a>

                    <h5 class="text-muted font-13 fw-normal mt-0">Yesterday</h5>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-2">
                        <div class="card-body">
                            <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>   
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="notify-icon">
                                        <img src="{{asset('assets/template/images/users/avatar-2.jpg')}}" class="img-fluid rounded-circle" alt="" />
                                    </div>
                                </div>
                                <div class="flex-grow-1 text-truncate ms-2">
                                    <h5 class="noti-item-title fw-semibold font-14">Cristina Pride <small class="fw-normal text-muted ms-1">1 day ago</small></h5>
                                    <small class="noti-item-subtitle text-muted">Hi, How are you? What about our next meeting</small>
                                </div>
                            </div>
                        </div>
                    </a>

                    <h5 class="text-muted font-13 fw-normal mt-0">30 Dec 2021</h5>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-2">
                        <div class="card-body">
                            <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>   
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="notify-icon bg-primary">
                                        <i class="mdi mdi-comment-account-outline"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 text-truncate ms-2">
                                    <h5 class="noti-item-title fw-semibold font-14">Datacorp</h5>
                                    <small class="noti-item-subtitle text-muted">Caleb Flakelar commented on Admin</small>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-2">
                        <div class="card-body">
                            <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>   
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="notify-icon">
                                        <img src="{{asset('assets/template/images/users/avatar-4.jpg')}}" class="img-fluid rounded-circle" alt="" />
                                    </div>
                                </div>
                                <div class="flex-grow-1 text-truncate ms-2">
                                    <h5 class="noti-item-title fw-semibold font-14">Karen Robinson</h5>
                                    <small class="noti-item-subtitle text-muted">Wow ! this admin looks good and awesome design</small>
                                </div>
                            </div>
                        </div>
                    </a>

                    <div class="text-center">
                        <i class="mdi mdi-dots-circle mdi-spin text-muted h3 mt-0"></i>
                    </div>
                </div>

                <!-- All-->
                <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item border-top border-light py-2">
                    View All
                </a>

            </div>
        </li>

        <li class="dropdown notification-list d-none d-sm-inline-block">
            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="dripicons-view-apps noti-icon"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg p-0">

                <div class="p-2">
                    <div class="row g-0">
                        <div class="col">
                            <a class="dropdown-icon-item" href="#">
                                <img src="{{asset('assets/template/images/brands/slack.png')}}" alt="slack">
                                <span>DSyirkah</span>
                            </a>
                        </div>
                        <div class="col">
                            <a class="dropdown-icon-item" href="#">
                                <img src="{{asset('assets/template/images/brands/github.png')}}" alt="Github">
                                <span>GTC</span>
                            </a>
                        </div>
                        <div class="col">
                            <a class="dropdown-icon-item" href="#">
                                <img src="{{asset('assets/template/images/brands/dribbble.png')}}" alt="dribbble">
                                <span>Pembiayaan</span>
                            </a>
                        </div>
                    </div>

                    <div class="row g-0">
                        <div class="col">
                            <a class="dropdown-icon-item" href="#">
                                <img src="{{asset('assets/template/images/brands/bitbucket.png')}}" alt="bitbucket">
                                <span>Email</span>
                            </a>
                        </div>
                        <div class="col">
                            <a class="dropdown-icon-item" href="#">
                                <img src="{{asset('assets/template/images/brands/dropbox.png')}}" alt="dropbox">
                                <span>Website</span>
                            </a>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div>
        </li>

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                aria-expanded="false">
                <span class="account-user-avatar"> 
                    <img src="{{asset('assets/template/images/users/avatar-1.jpg')}}" alt="user-image" class="rounded-circle">
                </span>
                <span>
                    <span class="account-user-name">Dominic Keller</span>
                    <span class="account-position">Founder</span>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                <!-- item-->
                <div class=" dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Welcome !</h6>
                </div>
                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="mdi mdi-logout me-1"></i>
                    <span>Logout</span>
                </a>
            </div>
        </li>
    </ul>
    <button class="button-menu-mobile open-left">
        <i class="mdi mdi-menu"></i>
    </button>
</div>