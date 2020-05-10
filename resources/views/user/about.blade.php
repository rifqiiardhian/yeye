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

    <style>
html {
  box-sizing: border-box;
}

*, *:before, *:after {
  box-sizing: inherit;
}

.foto {
    margin: auto;
    border-radius: 20px;
}

.column {
  float: left;
  width: 33%;
  margin: auto;
  padding: 0 8px;
}

.card {
  border-radius: 20px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  margin: 5px;
}

.about-section {
  text-align: center;
  background-color: white;
}

.title {
    color: yellow;
}

.container {
  border-radius: 50px;
  padding: 0 16px;
}

.container::after, .row::after {
  content: "";
  clear: both;
  display: table;
}

.title {
  color: black;
}

@media screen and (max-width: 650px) {
  .column {
    width: 100%;
    display: block;
  }
}
</style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    @include('user/include/menu')

    <!-- Page Add Section Begin -->
    <div class="about-section"><br>
        <h1 class="title">About Us.</h1><br>
        <p>Kami percaya pada kekuatan era digital pada jaman sekarang</p>
        <p>menjadi lebih baik dengan menyediakan platform untuk</p>
        <p>menghubungkan pembeli dan penjual dalam satu komunitas</p>
        <p>dan memudahkan dalam mencari segala kebutuhan </p><br>
    </div>

<h2 style="text-align:center"><u>Our Team.</u></h2><br>
    <div class="row">
        <div class="column">
            <div class="card">
            <img class="foto" src="assets/foto/orang2.jpg" style="width:100%">
            <div class="container">
                <h2>M. Rifqi Ardhian</h2>
                <p class="title">CEO & Founder</p>
                <p>Hidup adalah uang</p>
                <p>rifqiardhian@gmail.com</p>
            </div>
        </div>
    </div>

  <div class="column">
    <div class="card">
      <img class="foto" src="assets/foto/orang3.jpg" style="width:100%">
      <div class="container">
        <h2>Muhammad Faruq</h2>
        <p class="title">CTO (Chief Technology Officer)</p>
        <p>Hidup memang tidak adil, biasakanlah dirimu</p>
        <p>mfaruq@gmail.com</p>
      </div>
    </div>
  </div>
  
  <div class="column">
    <div class="card">
      <img class="foto" src="assets/foto/orang4.jpg" style="width:100%">
      <div class="container">
        <h2>Chaerfansyah N.H</h2>
        <p class="title">CFO (Chief Financial Officer)</p>
        <p>Mawar itu merah, violet itu biru</p>
        <p>chaernh@gmail..com</p>
      </div>
    </div>
  </div>

  <div class="column">
    <div class="card">
      <img class="foto" src="assets/foto/orang1.jpg" style="width:100%">
      <div class="container">
        <h2>Robbi M.P</h2>
        <p class="title">CMO (Chief Marketing Officer)</p>
        <p>Teman adalah kekuatan</p>
        <p>robbimp@gmail.com</p>
      </div>
    </div>
  </div>

  <div class="column">
    <div class="card">
      <img class="foto" src="assets/foto/orang6.jpg" style="width:100%">
      <div class="container">
        <h2>Berliana A.I</h2>
        <p class="title">WP Pemasaran</p>
        <p>Pengetahuan tidak dapat menggantikan persahabatan</p>
        <p>berliana@gmail.com</p>
      </div>
    </div>
  </div>

  <div class="column">
    <div class="card">
      <img class="foto" src="assets/foto/orang5.jpg" style="width:100%">
      <div class="container">
        <h2>Kelvin Irawan</h2>
        <p class="title">COO (Chief Operating Officer)</p>
        <p>Aku jelek dan aku bangga</p>
        <p>kelvinirawan@gmail.com</p>
      </div>
    </div>
  </div>

</div>
<br><br>
    <!-- Logo Section End -->

    @include('user/include/footer')
    @include('user/include/javascript')
</body>

</html>
