<!-- HEADER DESKTOP-->
<header class="header-desktop4">
    <div class="container">
        <div class="header4-wrap">
            <div class="header__logo">
                <a href="#">
                    <img src="{{ url('assets/template/img/logo2.png')}}" alt="CoolAdmin" />
                </a>
            </div>
            <div class="header__tool">
                <div class="account-wrap">
                    <div class="account-item account-item--style2 clearfix js-item-menu">
                        <div class="content">
                            <a class="js-acc-btn" href="#">{{ Session::get('nama') }}</a>
                        </div>
                        <div class="account-dropdown js-dropdown">
                            <div class="info clearfix">
                                <h5 class="name">{{ Session::get('nama') }}</h5>
                                <span class="email">{{ Session::get('email') }}</span>
                            </div>
                            <div class="account-dropdown__footer">
                                <a href="{{ url('/logout') }}">
                                    <i class="zmdi zmdi-power"></i>Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- END HEADER DESKTOP -->
