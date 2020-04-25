<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Yoga Studio Template">
    <meta name="keywords" content="Yoga, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    @include('user/include/css')
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    @include('user/include/menu')

    <!-- Page Add Section Begin -->
    <section class="page-add">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="page-breadcrumb">
                        <h2>Product Page<span>.</span></h2>
                    </div>
                </div>
                <div class="col-lg-8">
                    <img src="img/add.jpg" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- Page Add Section End -->

    <!-- Categories Page Section Begin -->
    <section class="categories-page spad">
        <div class="container">
            <div class="categories-controls">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="categories-filter">
                            <div class="cf-right">
                                <?php $produk->render() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($produk as $dataproduk)
                <div class="col-lg-3 col-md-6">
                    <div class="single-product-item">
                        <figure>
                            <img src="{{ url( $dataproduk->foto )}}" style="width: 50px;" alt="">
                            <div class="hover-icon">
                                <a href="{{ url( $dataproduk->foto )}}" class="pop-up"><img src="{{ url( $dataproduk->foto )}}" alt=""></a>
                            </div>
                        </figure>
                        <div class="product-text">
                            <a href="{{ url('/product/detail/' .$dataproduk->id) }}">
                                <h6>{{ $dataproduk->nama }}</h6>
                            </a>
                            <p>IDR. {{ intval($dataproduk->harga) }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Categories Page Section End -->

    <!-- Logo Section Begin -->
    <div class="logo-section spad">
        <div class="logo-items owl-carousel">
            <div class="logo-item">
                <img src="{{ url('assets/template/img/logos/logo-1.png')}}" alt="">
            </div>
            <div class="logo-item">
                <img src="{{ url('assets/template/img/logos/logo-2.png')}}" alt="">
            </div>
            <div class="logo-item">
                <img src="{{ url('assets/template/img/logos/logo-3.png')}}" alt="">
            </div>
            <div class="logo-item">
                <img src="{{ url('assets/template/img/logos/logo-4.png')}}" alt="">
            </div>
            <div class="logo-item">
                <img src="{{ url('assets/template/img/logos/logo-5.png')}}" alt="">
            </div>
        </div>
    </div>
    <!-- Logo Section End -->

    @include('user/include/footer')
    @include('user/include/javascript')
</body>

</html>
