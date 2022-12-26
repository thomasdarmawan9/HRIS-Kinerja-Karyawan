<style>
    .hamburger-inner, .hamburger-inner::before, .hamburger-inner::after {
        background-color:white;
    }
</style>
<div class="app-header" style="background:#4C6FBF;height:60px;">
    <div class="app-header__logo" style="background:#4C6FBF;width:270px">
        <div class="logo-src" style="width:auto;height:45px"> 
        <h5 style="color:white;text-align:left;font-weight: bold;line-height:20px;">
        <img class="rounded-circle" src="{{ asset('assets/images/users/logo.png') }}" alt="" width="50">
       PT. AGH
        </h5></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                        data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
                <span>
                    <button type="button"
                            class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
    </div>
    <div class="app-header__content">
        <div class="app-header-right">
            <div class="header-btn-lg pr-0">
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="btn-group">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                    <img class="rounded-circle" src="{{ asset('assets/images/users/default.png') }}"
                                         alt="" width="42">
                                    <!-- <i class="fa fa-angle-down ml-2 opacity-8"></i> -->
                                </a>
                                <!-- <div tabindex="-1" role="menu" aria-hidden="true"
                                     class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ URL :: to('/admin/profile') }}"> <i
                                                class="fa fa-user fa-1x fa-fw"></i> Profile</a>
                                    <a class="dropdown-item" href="{{ URL :: to('/admin/change_password') }}"> <i
                                                class="fa fa-lock fa-1x fa-fw"></i> Change Password</a>
                                    <a class="dropdown-item" href="{{ URL :: to('/admin_login/logout') }}"> <i
                                                class="fa fa-sign-out-alt fa-1x fa-fw"></i> Logout</a>
                                </div> -->
                            </div>
                        </div>
                        <div class="widget-content-left  ml-3 header-user-info">
                            <div class="widget-heading text-white">
                                {{ Auth::user()->name }}
                            </div>
                            <div class="widget-subheading text-white">
                                {{ Auth::user()->email }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
