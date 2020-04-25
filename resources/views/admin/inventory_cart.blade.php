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
                                        <a href="{{url('/a/inventory')}}" class="mb-4"><p><span class="fas fa-arrow-left"></span> Kembali</p></a>
                                        <h2>Faktur Pembelian</h2>
                                        <hr>
                                        @if(empty($nota))
                                        <p class="text-center m-5">Tidak ada pembelian</p>
                                        @else
                                        <table class="mt-4 mb-4">
                                            <tr>
                                                <td>ID</td><td> : </td><td>{{ $nota->id }}</td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal</td><td> : </td><td>{{ $tanggal }}</td>
                                            </tr>
                                            <tr>
                                                <td>Pegawai</td><td> : </td><td>{{ $nama_pegawai }}</td>
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
                                                        <td class="text-center" style="width: 200px">
                                                            <a href="{{ url('/a/inventory/min?productId=' .$datanota->id_produk)}}" class="btn btn-sm btn-light"><span class="fas fa-minus"></span></a> &nbsp;
                                                            {{ $datanota->jumlah }} &nbsp;
                                                            <a href="{{ url('/a/inventory/plus?productId=' .$datanota->id_produk)}}" class="btn btn-sm btn-light"><span class="fas fa-plus"></span></a>
                                                        </td>
                                                        <td class="text-center" style="width: 150px">{{ intval($datanota->subtotal) }}</td>
                                                    </tr>
                                                    @endforeach
                                                    <tr style="height: 50px">
                                                    @foreach($datatotal as $dataa)
                                                    </tr>
                                                        <td class="text-right" colspan="4"><b>Total</b></td>
                                                        <td class="text-center">{{ intval($dataa->total) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right" colspan="4"><b>PPN 10%</b></td>
                                                        <td class="text-center">{{ $dataa->total * 0.1 }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right" colspan="4"><b>Total Tagihan</b></td>
                                                        <td class="text-center">{{ intval($dataa->tagihan) }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-md-12">
                                                <form action="{{ url('/a/inventory/checkout') }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id_nota" value="{{ $nota->id }}">
                                                <div class="form-group">
                                                    <label for="supplier" class=" form-control-label">Pilih Supplier Pembelian Barang</label>
                                                    <select name="supplier" class="form-control">
                                                        <option value="">Pilih Supplier</option>
                                                        @foreach($supplier as $datasupplier)
                                                        <option value="{{ $datasupplier->id }}">{{ $datasupplier->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group text-center mt-5">
                                                    <button type="submit" class="btn btn-lg btn-success mb-2">CHECKOUT</button>
                                                    </form>
                                                    <br/>
                                                    @if($cart == 0)
                                                    <a href="{{ url('/a/inventory/cancel/' .$nota->id)}}"><button class="btn btn-lg btn-danger">CANCEL</button></a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @endif
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
