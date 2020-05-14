<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{url('/assets/library/bootstrap-4.4.1-dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('/assets/highcharts/code/css/highcharts.css')}}">
    <link rel="stylesheet" href="{{url('/assets/style.css')}}">

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
                                        <div
                                            class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                            {{ $message }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="row m-t-25">
                                        <div class="col-sm-6 col-lg-3">
                                            <div class="overview-item overview-item--c1">
                                                <div class="overview__inner">
                                                    <div class="overview-box clearfix">
                                                        <div class="icon">
                                                            <i class="zmdi zmdi-account-o"></i>
                                                        </div>
                                                        <div class="text mb-4">
                                                            <h2>{{ $jml_users[0]->jumlah }}</h2>
                                                            <span>Member Terdaftar</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-3">
                                            <div class="overview-item overview-item--c2">
                                                <div class="overview__inner">
                                                    <div class="overview-box clearfix">
                                                        <div class="icon">
                                                            <i class="zmdi zmdi-shopping-cart"></i>
                                                        </div>
                                                        <div class="text mb-4">
                                                            <h2>{{ $jml_order[0]->jumlah }}</h2>
                                                            <span>Transaksi Sukses</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-3">
                                            <div class="overview-item overview-item--c3">
                                                <div class="overview__inner">
                                                    <div class="overview-box clearfix">
                                                        <!-- <div class="icon">
                                                            <i class="zmdi zmdi-calendar-note"></i>
                                                        </div> -->
                                                        <div class="text mt-4 mb-4">
                                                            <h2>Rp. {{ number_format($jml_daily,0,',','.') }}</h2>
                                                            <span>Penjualan Hari ini</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-3">
                                            <div class="overview-item overview-item--c4">
                                                <div class="overview__inner">
                                                    <div class="overview-box clearfix">
                                                        <!-- <div class="icon">
                                                            <i class="zmdi zmdi-money"></i>
                                                        </div> -->
                                                        <div class="text mt-4 mb-4">
                                                            <h2>Rp. {{ number_format($jml_pendapatan,0,',','.') }}</h2>
                                                            <span>Total Pendapatan</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12 mt-5">
                               <div class="card">
                                   <div class="card-header">
                                          Laporan Pendapatan
                                               </div>
                                           <div class="card-body">
                                             <div id="grafik-pendapatan" style="height: 400px;"></div>
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
            </section>
        </div>

    </div>
    <!-- END PAGE CONTENT  -->
    </div>

    {{-- JAVASCRIPT --}}
    <script src="{{url('/assets/library/jquery-3.4.1.js')}}"></script>
    <script src="{{url('/assets/library/bootstrap-4.4.1-dist/js/bootstrap.js')}}"></script>
    <script src="{{url('/assets/highcharts/code/highcharts.js')}}"></script>
    <script src="{{url('/assets/app.js')}}"></script>

    @include('admin/include/javascript')

</body>

</html>
<!-- end document-->
