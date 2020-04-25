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
    <section class="page-add cart-page-add">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="page-breadcrumb">
                        <h2>Cart<span>.</span></h2>
                    </div>
                </div>
                <div class="col-lg-12 mt-4">
                    @if ($message = Session::get('success'))
                    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                        {{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @if ($message = Session::get('error'))
                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                        {{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- Page Add Section End -->

    <!-- Cart Page Section Begin -->
    <div class="cart-page">
        <div class="container">
            <div class="cart-table">
                <table>
                    <thead>
                        <tr>
                            <th class="product-h">Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nota->cart as $datanota)
                        <tr>
                            <td class="product-col">
                                <div class="p-title">
                                    <h5>{{ $datanota->nama_produk }}</h5>
                                </div>
                            </td>
                            <td class="price-col">{{ intval($datanota->harga_satuan) }}</td>
                            <td>
                                <a href="{{ url('/shop/min?productId=' .$datanota->id_produk)}}" class="btn btn-sm btn-light"><span class="fa fa-minus"></span></a> &nbsp;
                                {{ $datanota->jumlah }} &nbsp;
                                <a href="{{ url('/shop/plus?productId=' .$datanota->id_produk)}}" class="btn btn-sm btn-light"><span class="fa fa-plus"></span></a>
                            </td>
                            <td class="total">{{ intval($datanota->subtotal) }}</td>
                            <td class="product-close"><a href="{{ url('/shop/delete?productId=' .$datanota->id_produk)}}" class="btn btn-sm btn-light"><b>X</b></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="shopping-method">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="total-info">
                            <div class="total-table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Total</th>
                                            <th>PPN</th>
                                            <th class="total-cart">Total Cart</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($datatotal as $dataa)
                                        <tr>
                                            <td class="total">{{ intval($dataa->total) }}</td>
                                            <td class="sub-total">{{ $dataa->total * 0.1 }}</td>
                                            <td class="total-cart-p">{{ intval($dataa->tagihan) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-right">
                                    @if($cart == 0)
                                    <a href="{{ url('/shop/cancel/' .$nota->id)}}" class="primary-btn chechout-btn">Cancel Transaction</a>
                                    @endif
                                    <a href="{{ url('/shop/checkout?notaId=' .$nota->id)}}" class="primary-btn chechout-btn">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Page Section End -->

    @include('user/include/footer')
    @include('user/include/javascript')
</body>

</html>
