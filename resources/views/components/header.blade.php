<header id="topnav" class="defaultscroll sticky">
    <div class="container">
        <!-- Logo container-->
        <div>
            <a class="logo" href="index.html">
                <img src="{{ asset('images/logo-dark.png') }}" height="24" alt="">
            </a>
        </div>
        <div class="buy-button">
            <a href="/" target="_blank" class="btn btn-primary">{{ __('Beli Sekarang') }}</a>
        </div>
        <!--end login button-->
        <!-- End Logo container-->
        <div class="menu-extras">
            <div class="menu-item">
                <!-- Mobile menu toggle-->
                <a class="navbar-toggle">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </div>
        </div>

        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu nav-right">
                <li><a href="/">Beranda</a></li>
                <li class="has-submenu">
                    <a href="javascript:void(0)">Akun</a><span class="menu-arrow"></span>
                    <ul class="submenu">
                        <li><a href="documentation.html">Masuk</a></li>
                        <li><a href="changelog.html">Daftar</a></li>
                    </ul>
                </li>
                <li><a href="/">Kontak</a></li>
            </ul>
            <!--end navigation menu-->
            <div class="buy-menu-btn d-none">
                <a href="/" target="_blank" class="btn btn-primary">Buy Now</a>
            </div>
            <!--end login button-->
        </div>
        <!--end navigation-->
    </div>
    <!--end container-->
</header>