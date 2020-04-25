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
                        <h2>Product Detail<span>.</span></h2>
                    </div>
                </div>
                <div class="col-lg-8">
                    <img src="img/add.jpg" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- Page Add Section End -->

    @foreach($produk as $data)
    <!-- Product Page Section Beign -->
    <section class="product-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-slider owl-carousel">
                        <div class="product-img">
                            <figure>
                                <img src="{{ url($data->foto) }}" alt="">
                            </figure>
                        </div>
                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="product-content">
                        <h2>{{ $data->nama_produk }}</h2>
                        <div class="pc-meta">
                            <h5>IDR. {{ intval($data->harga) }}</h5>
                        </div>
                        <p class="text-justify">{{ $data->deskripsi }}</p>
                        <ul class="tags">
                            <li><span>Kategori :</span> {{ $data->kategori }}</li>
                            <li><span>Stok :</span> {{ $data->stok }}</li>
                        </ul>
                        <a href="{{ url('/shop/cart?productId=' .$data->id)}}" class="primary-btn pc-btn">Add to cart</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Page Section End -->
    @endforeach

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
