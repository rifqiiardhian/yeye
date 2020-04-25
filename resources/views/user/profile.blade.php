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
                        <h2>Profile<span>.</span></h2>
                    </div>
                </div>
                <div class="col-lg-8">
                    <img src="img/add.jpg" alt="">
                </div>
                <div class="col-lg-12 mt-5">
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

    <!-- Contact Section Begin -->
    <div class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ url('/profile/update') }}" class="contact-form" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_user" value="{{ $profile->id }}">
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="text" placeholder="Nama" name="nama" value="{{ $profile->nama }}">
                            </div>
                            <div class="col-lg-6">
                                <input type="email  " placeholder="Email" name="email" value="{{ $profile->email }}">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" placeholder="Telepon" name="telepon" value="{{ $profile->telepon }}">
                            </div>
                            <div class="col-lg-12">
                                <textarea placeholder="Alamat" name="alamat">{{ $profile->alamat }}</textarea>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" placeholder="Kecamatan" name="kecamatan" value="{{ $profile->kecamatan }}">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" placeholder="Kota" name="kota" value="{{ $profile->kota }}">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" placeholder="Provinsi" name="provinsi" value="{{ $profile->provinsi }}">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" placeholder="Kode Pos" name="kodepos" @if($profile->kodepos != 0)  value="{{ $profile->kodepos }}" @endif>
                            </div>
                            <div class="col-lg-12 text-right">
                                <button type="submit">Update Profil</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Section End -->

    @include('user/include/footer')
    @include('user/include/javascript')
</body>

</html>
