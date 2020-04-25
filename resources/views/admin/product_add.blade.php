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
                                        @if ($message = Session::get('error'))
                                            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                                <span class="badge badge-pill badge-danger">Gagal</span>
                                                {{ $message }}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                        <div class="card">
                                            <form action="{{ url('/a/product/save') }}" method="post" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <div class="card-body card-block">
                                                    <div class="form-group">
                                                        <label for="foto" class=" form-control-label">Foto Thumbnail</label>
                                                        <input type="file" id="foto" name="foto" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama" class=" form-control-label">Nama Produk</label>
                                                        <input type="text" id="nama" name="nama" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="kategori" class=" form-control-label">Kategori</label>
                                                        <select name="kategori" class="form-control">
                                                            <option value="">Pilih Kategori</option>
                                                            @foreach($kategori as $data)
                                                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="harga" class=" form-control-label">Harga</label>
                                                        <input type="text" id="harga" name="harga" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="deskripsi" class=" form-control-label">Deskripsi</label>
                                                        <textarea name="deskripsi" id="deskripsi" style="height: 100px" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button type="reset" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-ban"></i> Reset
                                                    </button>
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        <i class="fa fa-check"></i> Submit
                                                    </button>
                                                </div>
                                            </form>
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
