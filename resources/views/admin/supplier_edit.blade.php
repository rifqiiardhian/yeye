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
                                            <form action="{{ url('/a/supplier/update') }}" method="post">
                                                {{ csrf_field() }}
                                                @foreach($supplier as $data)
                                                <div class="card-body card-block">
                                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                                    <div class="form-group">
                                                        <label for="nama" class=" form-control-label">Nama Supplier</label>
                                                        <input type="text" id="nama" name="nama" value="{{ $data->nama }}" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="telepon" class=" form-control-label">Telepon</label>
                                                        <input type="text" id="telepon" name="telepon" value="{{ $data->telepon }}" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alamat" class=" form-control-label">Alamat</label>
                                                        <textarea name="alamat" id="alamat" class="form-control">{{ $data->alamat }}</textarea>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-6">
                                                            <label for="kecamatan" class=" form-control-label">Kecamatan</label>
                                                            <input type="text" id="kecamatan" name="kecamatan" value="{{ $data->kecamatan }}" class="form-control">
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="kota" class=" form-control-label">Kota</label>
                                                            <input type="text" id="kota" name="kota" value="{{ $data->kota }}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-6">
                                                            <label for="provinsi" class=" form-control-label">Provinsi</label>
                                                            <input type="text" id="provinsi" name="provinsi" value="{{ $data->provinsi }}" class="form-control">
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="kodepos" class=" form-control-label">Kode Pos</label>
                                                            <input type="text" id="kodepos" name="kodepos" value="{{ $data->kodepos }}" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
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
