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
                                        <a href="{{url('/a/inventory')}}" class="mb-4"><p><span class="fas fa-arrow-left"></span> Kembali</p></a>
                                        <h2>Faktur Pembelian</h2>
                                        <p>PT Toko Online Indonesia Tbk.</p>
                                        <hr>
                                        <table class="mt-4 mb-4">
                                            <tr>
                                                <td>No Faktur</td><td class="text-center" style="width: 50px"> : </td><td>{{ $nota->id }}</td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal</td><td class="text-center" style="width: 50px"> : </td><td>{{ $nota->tanggal }}</td>
                                            </tr>
                                            <tr>
                                                <td>Pegawai</td><td class="text-center" style="width: 50px"> : </td><td>{{ $nota->nama_pegawai }}</td>
                                            </tr>
                                            <tr>
                                                <td>Status</td><td class="text-center" style="width: 50px"> : </td><td><b>{{ $nota->status_transaksi }}</b></td>
                                            </tr>
                                        </table>
                                        <table class="mt-4 mb-4">
                                            <tr>
                                                <td>ID Supplier</td><td class="text-center" style="width: 50px"> : </td><td>{{ $nota->id_customer }}</td>
                                            </tr>
                                            <tr>
                                                <td>Nama Supplier</td><td class="text-center" style="width: 50px"> : </td><td>{{ $nota->nama_customer }}</td>
                                            </tr>
                                        </table>
                                        <div class="row">
                                            <div class="col-12">
                                                <table>
                                                    <tr class="text-center" style="height: 50px">
                                                        <th style="width: 100px">No</th>
                                                        <th style="width: 400px">Nama Produk</th>
                                                        <th style="width: 150px">Harga</th>
                                                        <th style="width: 200px">Jumlah</th>
                                                        <th style="width: 150px">Subtotal</th>
                                                    </tr>
                                                    @php($no=1)
                                                    @foreach($nota->cart as $datanota)
                                                    <tr style="height: 50px">
                                                        <td class="text-center" style="width: 50px">{{ $no++ }}</td>
                                                        <td style="width: 400px">{{ $datanota->nama_produk }}</td>
                                                        <td class="text-center" style="width: 150px">{{ intval($datanota->harga_satuan) }}</td>
                                                        <td class="text-center" style="width: 200px">{{ $datanota->jumlah }} &nbsp;</td>
                                                        <td class="text-center" style="width: 150px">{{ intval($datanota->subtotal) }}</td>
                                                    </tr>
                                                    @endforeach
                                                    <tr style="height: 50px">
                                                    </tr>
                                                        <td class="text-right" colspan="4"><b>Subtotal</b></td>
                                                        <td class="text-center">{{ intval($nota->total) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right" colspan="4"><b>PPN 10%</b></td>
                                                        <td class="text-center">{{ $nota->total * 0.1 }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right" colspan="4"><b>Total</b></td>
                                                        <td class="text-center">{{ intval($nota->tagihan) }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row m-5">
                                            <div class="col-md-12 text-center">
                                                <a href="{{ url('/a/inventory/print/' .$nota->id) }}"><button class="btn btn-outline-secondary mb-2">CETAK FAKTUR</button></a>
                                                <a href="{{ url('/a/inventory/download/' .$nota->id) }}"><button class="btn btn-outline-info mb-2">DOWNLOAD</button></a>
                                            </div>
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
