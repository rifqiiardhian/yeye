<!-- Header Section Begin -->
<header class="header-section">
    <div class="container-fluid">
        <div class="inner-header">
            <div class="logo">
                <a href="{{ url('/') }}"><img src="{{ url('assets/template/img/logo2.png')}}" alt=""></a>
            </div>
            <div class="header-right">
                <a href="{{ url('/profile')}}">
                    <img src="{{ url('assets/template/img/icons/man.png')}}" alt="">
                </a>&nbsp; &nbsp; &nbsp;
                <a href="{{ url('/shop/cart') }}">
                    <img src="{{ url('assets/template/img/icons/bag.png')}}" alt="">
                    <span>{{ $jumlahcart }}</span>
                </a>
            </div>
            <nav class="main-menu mobile-menu">
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/about') }}">About</a></li>
                    <li><a href="{{ url('/product') }}">Shop</a></li>
                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                    @if(empty(Session::get('role') == 2))
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    @else
                    <li><a href="{{ url('/history') }}">History</a></li>
                    <li><a href="{{ url('/logout') }}">Logout</a></li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</header>
<!-- Header Info Begin -->
<div class="header-info">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="header-item">
                    <img src="{{ url('assets/template/img/icons/delivery.png')}}" alt="">
                    <p>Free shipping on orders over $30 in USA</p>
                </div>
            </div>
            <div class="col-md-4 text-left text-lg-center">
                <div class="header-item">
                    <img src="{{ url('assets/template/img/icons/voucher.png')}}" alt="">
                    <p>20% Student Discount</p>
                </div>
            </div>
            <div class="col-md-4 text-left text-xl-right">
                <div class="header-item">
                <img src="{{ url('assets/template/img/icons/sales.png')}}" alt="">
                <p>30% off on dresses. Use code: 30OFF</p>
            </div>
            </div>
        </div>
    </div>
</div>
<!-- Header Info End -->
<!-- Header End -->
