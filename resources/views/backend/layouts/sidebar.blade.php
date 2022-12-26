<style>
    .hamburger.is-active .hamburger-inner, .hamburger.is-active .hamburger-inner::before, .hamburger.is-active .hamburger-inner::after {
        background-color:white;
    }

    /* .pkk:hover{
        height:80px;
    } */
</style>
<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
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
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner pt-4">
            <ul class="vertical-nav-menu">
                <li>
                    <a href="{{ URL :: to('/admin/dashboard') }}">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Dashboard
                    </a>
                </li>
                <li style="height:55px">
               
                            <a href="{{ URL :: to('/admin/kinerja') }}" class="pkk" style=" height:80px;"> <i class="metismenu-icon pe-7s-upload" style="top:25%;"></i>
                           <span>Pengukuran Kinerja<br>Karyawan</span>
                            </a>
                        </li>
                        <br>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-menu"></i>
                        Laporan PKK
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li class="treeview">
                            <a href="{{ URL :: to('/admin/laporanPKK') }}">
                                <i class="metismenu-icon"></i><span> Laporan PKK Karyawan</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="{{ URL :: to('/admin/laporanPKKPribadi') }}">
                                <i class="metismenu-icon"></i><span> Laporan PKK Pribadi</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-diamond"></i>
                        Admin Settings
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                    <li>
                        <a href="{{ URL :: to('/admin/users') }}">
                            <i class="metismenu-icon pe-7s-users"></i>
                            Users
                        </a>
                    </li>
                        <li>
                            <a href="{{ URL :: to('/admin/roles') }}">
                                <i class="metismenu-icon"></i>
                                Jabatan
                            </a>
                        </li>
                        <li>
                            <a href="{{ URL :: to('/admin/departmentseksi') }}">
                                <i class="metismenu-icon"></i>
                                Department & Seksi
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ URL :: to('/admin_login/logout') }}">
                        <i class="metismenu-icon pe-7s-upload"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- /.sidebar -->
<script type="text/javascript">
    $(document).ready(function () {
        $('.app-sidebar__inner ul li').each(function () {
            if (window.location.href.indexOf($(this).find('a:first').attr('href')) > -1) {
                $(this).closest('ul').closest('li').attr('class', 'mm-active');
                $(this).addClass('mm-active').siblings().removeClass('mm-active');
            }
        });
    });
</script>