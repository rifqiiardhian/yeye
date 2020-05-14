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
                        <h2>History<span>.</span></h2>
                    </div>
                </div>
                <div class="col-lg-12">
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

    <section class="page-add cart-page-add">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="mb-5">Data Unpaid</h4>
                    <div class="total-info">
                        <div class="total-table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID Nota</th>
                                        <th>Tanggal</th>
                                        <th>Total Tagihan</th>
                                        <th class="total-cart">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($unpaid as $datapending)
                                    <tr>
                                        <td class="total">{{ $datapending->id }}</td>
                                        <td class="sub-total">{{ $datapending->tanggal }}</td>
                                        <td class="sub-total">IDR {{ intval($datapending->tagihan) }}</td>
                                        <td class="total-cart-p"><a href="{{ url('/shop/history/unpaid/' .$datapending->id) }}"><button class="btn btn-light btn-sm">Detail</button></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <h4 class="mt-5 mb-5">Data Paid</h4>
                    <div class="total-info">
                        <div class="total-table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID Nota</th>
                                        <th>Tanggal</th>
                                        <th>Total Tagihan</th>
                                        <th class="total-cart">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($paid as $datasuccess)
                                    <tr>
                                        <td class="total">{{ $datasuccess->id }}</td>
                                        <td class="sub-total">{{ $datasuccess->tanggal }}</td>
                                        <td class="sub-total">IDR {{ intval($datasuccess->tagihan) }}</td>
                                        <td class="total-cart-p"><a href="{{ url('/shop/history/paid/' .$datasuccess->id) }}"><button class="btn btn-light btn-sm">Detail</button></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Page Add Section End -->



    @include('user/include/footer')
    @include('user/include/javascript')
</body>

</html>
