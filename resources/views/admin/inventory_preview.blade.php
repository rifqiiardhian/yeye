<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>{{ $title }}</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <p class="mb-2">PT. Toko Online Indonesia Tbk.</p>
                    <h2>FAKTUR PEMBELIAN</h2>
                    <hr/>
                    <table class="mt-5 mb-4">
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
                    <table class="mt-4 mb-5">
                        <tr>
                            <td>ID Supplier</td><td class="text-center" style="width: 50px"> : </td><td>{{ $nota->id_customer }}</td>
                        </tr>
                        <tr>
                            <td>Nama Supplier</td><td class="text-center" style="width: 50px"> : </td><td>{{ $nota->nama_customer }}</td>
                        </tr>
                    </table>
                    <table border="1">
                        <tr class="text-center" style="height: 70px">
                            <th style="width: 30px">No</th>
                            <th style="width: 300px">Nama Produk</th>
                            <th style="width: 125px">Harga</th>
                            <th>Jumlah</th>
                            <th style="width: 125px">Subtotal</th>
                        </tr>
                        @php($no = 1)
                        @foreach($nota->cart as $datanota)
                        <tr style="height: 50px">
                            <td class="text-center">{{ $no++ }}</td>
                            <td>{{ $datanota->nama_produk }}</td>
                            <td class="text-center">{{ intval($datanota->harga_satuan) }}</td>
                            <td class="text-center">{{ $datanota->jumlah }}</td>
                            <td class="text-center">{{ intval($datanota->subtotal) }}</td>
                        </tr>
                        @endforeach
                        <tr>
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
        </div>

    </body>
</html>
