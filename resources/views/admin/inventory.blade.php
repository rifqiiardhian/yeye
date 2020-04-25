<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>{{ $title }}</title>
    @include('admin/include/css')
</head>

<body class="animsition">
    <div class="page-wrapper">

        @include('admin/include/header')

        <!-- WELCOME-->
        <section class="welcome2 p-t-40 p-b-55">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="welcome2-inner m-t-60">
                            <div class="welcome2-greeting">
                                <h1 class="title-6">{{ $welcome_title }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="au-breadcrumb3">
                            <div class="au-breadcrumb-left">
                                <ul class="list-unstyled list-inline au-breadcrumb__list">
                                    <li class="list-inline-item active">
                                        <a href="#">Admin</a>
                                    </li>
                                    <li class="list-inline-item seprate">
                                        <span>/</span>
                                    </li>
                                    <li class="list-inline-item">{{ $breadcrumb }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END WELCOME-->

        <!-- PAGE CONTENT-->
        <div class="page-container3">
            <section class=" p-t-70 p-b-70">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3">
                            @include('admin/include/menu')
                        </div>
                        <div class="col-xl-9">
                            <div class="page-content">
                                <!-- MAIN CONTENT -->
                                <div class="row">
                                    <div class="col-md-12">
                                        @if ($message = Session::get('success'))
                                            <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                                <span class="badge badge-pill badge-success">Sukses</span>
                                                {{ $message }}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                        @if ($message = Session::get('error'))
                                            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                                <span class="badge badge-pill badge-danger">Gagal</span>
                                                {{ $message }}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                        <h3 class="mt-4 mb-2">Pembelian Barang Pending</h3>
                                        <div class="table-responsive table--no-card m-b-30">
                                            <table class="table table-borderless table-striped table-earning">
                                                <thead>
                                                    <tr>
                                                        <th>No Nota</th>
                                                        <th>Total Tagihan</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($pending as $datapending)
                                                    @if(!empty($pending))
                                                    <tr>
                                                        <td>{{ $datapending->id }}</td>
                                                        <td>IDR. {{ intval($datapending->tagihan) }}</td>
                                                        <td class="text-danger">{{ $datapending->status_transaksi }}</td>
                                                        <td>
                                                            <a href="{{ url('/a/inventory/cart') }}">
                                                                <button type="button" class="btn btn-info btn-sm">
                                                                    Detail
                                                                </button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @else
                                                    <tr><td colspan="4" class="text-center"></td></tr>
                                                    @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <h3 class="mb-2">Pembelian Barang Sukses</h3>
                                        <div class="table-responsive table--no-card m-b-30">
                                            <table class="table table-borderless table-striped table-earning">
                                                <thead>
                                                    <tr>
                                                        <th>No Nota</th>
                                                        <th>Produk</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($success as $datasuccess)
                                                    @if(!empty($datasuccess))
                                                    <tr>
                                                        <td>{{ $datasuccess->id }}</td>
                                                        <td>IDR. {{ intval($datasuccess->tagihan) }}</td>
                                                        <td class="text-success">{{ $datasuccess->status_transaksi }}</td>
                                                        <td>
                                                            <a href="{{ url('/a/inventory/detail/' .$datasuccess->id) }}">
                                                                <button type="button" class="btn btn-info btn-sm">
                                                                    Detail
                                                                </button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    @if(empty($datasuccess))
                                                    <tr><td colspan="4" class="text-center"></td></tr>
                                                    @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- END MAIN CONTENT -->

                                <!-- FOOTER -->
                                <div class="row">
                                    <div class="col-md-12">
                                        @include('admin/include/footer')
                                    </div>
                                </div>
                                <!-- END FOOTER -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- END PAGE CONTENT  -->
    </div>

    @include('admin/include/javascript')

</body>

</html>
<!-- end document-->
