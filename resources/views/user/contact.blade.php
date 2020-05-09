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
                        <h2>Contact Us<span>.</span></h2>
                    </div>
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
                <div class="col-lg-8">
                    <form action="{{ url('/contact/post') }}" class="contact-form" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="text" placeholder="Nama" id="nama" name="nama" required>
                            </div>
                            <div class="col-lg-12">                              
                                <input type="email" placeholder="Email" id="email" name="email" required>
                            </div>
                            <div class="col-lg-12">
                                <input type="tel" placeholder="No Telepon" id="telepon" name="telepon" required>
                            </div>
                            <div class="col-lg-12">
                                <input type="text" placeholder="Subjek" id="subjek" name="subjek" required>
                            </div>
                            <div class="col-lg-12">
                                <textarea placeholder="Pesan" id="pesan" name="pesan" required></textarea>
                            </div>
                            <div class="col-lg-12 text-right">
                                <button type="submit">Kirim Pesan</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="contact-widget">
                        <div class="cw-item">
                            <h5>Location</h5>
                            <ul>
                                <li>Vokasi Universitas Brawijaya, </li>
                                <li>Malang, Indonesia</li>
                            </ul>
                        </div>
                        <div class="cw-item">
                            <h5>Phone</h5>
                            <ul>
                                <li>+62 (603)535-4592</li>
                                <li>+62 (603)535-4556</li>
                            </ul>
                        </div>
                        <div class="cw-item">
                            <h5>E-mail</h5>
                            <ul>
                                <li>contact@tokoonlineindonesia.com</li>
                                <li>www.tokoonlineindonesia.com</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>
    <!-- Contact Section End -->

    @include('user/include/footer')
    @include('user/include/javascript')
</body>

</html>
