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
                        <h2>Checkout<span>.</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Page Add Section End -->

    <!-- Cart Total Page Begin -->
    <section class="cart-total-page spad">
        <div class="container">
            <form action="{{ url('/shop/checkout/process') }}" class="checkout-form" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="id_nota" value="{{ $delivery->id_nota }}">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Your Information</h3>
                        <h4 class="mb-4">Nota ID : {{ $delivery->id_nota }}</h4>
                    </div>
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-2">
                                <p class="in-name">Nama</p>
                            </div>
                            <div class="col-lg-10">
                                <input type="text" name="nama" value="{{ $datauser->nama }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <p class="in-name">Alamat</p>
                            </div>
                            <div class="col-lg-10">
                                <input type="text" name="alamat" value="{{ $delivery->alamat_pengiriman }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <p class="in-name">Kecamatan</p>
                            </div>
                            <div class="col-lg-10">
                                <input type="text" name="kecamatan" value="{{ $delivery->kecamatan }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <p class="in-name">Kota</p>
                            </div>
                            <div class="col-lg-10">
                                <input type="text" name="kota" value="{{ $delivery->kota }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <p class="in-name">Provinsi</p>
                            </div>
                            <div class="col-lg-10">
                                <input type="text" name="provinsi" value="{{ $delivery->provinsi }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <p class="in-name">Kode Pos</p>
                            </div>
                            <div class="col-lg-10">
                                <input type="text" name="kodepos" value="{{ $delivery->kodepos }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <p class="in-name">Telepon</p>
                            </div>
                            <div class="col-lg-10">
                                <input type="text" name="telepon" value="{{ $delivery->telepon }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="order-table">
                            <div class="cart-item">
                                <span>Subtotal</span>
                                <p>{{ intval($nota->total) }}</p>
                            </div>
                            <div class="cart-item">
                                <span>PPN 10%</span>
                                <p>{{ intval($nota->total * 0.1) }}</p>
                            </div>

                            <div class="cart-total">
                                <span>Total</span>
                                <p>IDR. {{ intval($nota->tagihan) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shipping-info mt-5">
                            <h3>Choose a Shipping</h3>
                            <div class="chose-shipping">
                                @foreach($jasa as $datajasa)
                                <div class="cs-item">
                                    <input type="radio" name="id_jasa" id="{{ $datajasa->id }}" value="{{ $datajasa->id }}">
                                    <label for="{{ $datajasa->id }}">
                                        {{ $datajasa->nama }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="payment-method">
                            <button type="submit">Place your order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Cart Total Page End -->

    @include('user/include/footer')
    @include('user/include/javascript')
</body>

</html>
