<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ShoppingController extends Controller
{
    public function cart(Request $request) {
        if(Session::get('role') != 2) {
            return redirect('/login')->with(['error' => 'Anda harus login terlebih dahulu !']);
        } else {
            $id_customer = Session::get('id_user');
            $nama_customer = Session::get('nama');
            $id_produk = $request->get('productId');

            $nota = DB::selectOne("SELECT * FROM `t_nota` WHERE `status_transaksi` = 'pending' AND `jenis_faktur` = 'penjualan' AND `id_customer` = '$id_customer'");

            // Cek apakah nota telah dibuat atau belum
            if(!empty($nota)) {
                if ($id_produk == null) {
                    // Akses dari menu keranjang
                    // Generate array object for nota and cart
                    $datacart['cart'] = DB::table('t_keranjang')->where('id_nota', $nota->id)->get();
                    $nota = (object)array_merge((array)$nota, (array)$datacart);
                } else {
                    $sqlkeranjang = DB::table('t_keranjang')->where([
                        ['id_nota', $nota->id ],
                        ['id_produk', $id_produk]
                    ])->count();

                    // Cek apakah data sudah ada di keranjang
                    if ($sqlkeranjang > 0) {
                        // Generate array object for nota and cart
                        $datacart['cart'] = DB::table('t_keranjang')->where('id_nota', $nota->id)->get();
                        $nota = (object)array_merge((array)$nota, (array)$datacart);
                    } else {
                        $dataproduk = DB::selectOne("SELECT * FROM `t_produk` WHERE `id` = '$id_produk'");

                        // Tambah data ke keranjang
                        DB::table('t_keranjang')->insert([
                            'nama_produk' => $dataproduk->nama,
                            'harga_satuan' => $dataproduk->harga,
                            'jumlah' => 1,
                            'subtotal' => $dataproduk->harga,
                            'id_nota' => $nota->id,
                            'id_produk' => $id_produk,
                        ]);

                        // Menghitung dan mengupdate total tagihan ke nota
                        $totalnota = $nota->total;
                        $totalnotabaru = $totalnota + $dataproduk->harga;
                        $tagihanbaru = $totalnotabaru + ($totalnotabaru * 0.1);

                        DB::table('t_nota')->where('id', $nota->id)->update([
                            'total' => $totalnotabaru,
                            'tagihan' => $tagihanbaru
                        ]);

                        // Update stok ke produk
                        $stok = $dataproduk->stok;
                        $stokbaru = $stok - 1;

                        DB::table('t_produk')->where('id', $id_produk)->update([
                            'stok' => $stokbaru,
                        ]);

                        // Generate array object for nota and cart
                        $datacart['cart'] = DB::table('t_keranjang')->where('id_nota', $nota->id)->get();
                        $nota = (object)array_merge((array)$nota, (array)$datacart);
                    }
                }
            } else {
                // Membuat nota baru
                DB::table('t_nota')->insert([
                    'tanggal' => date('Y-m-d H:i:s'),
                    'total' => 0,
                    'ppn' => 10,
                    'tagihan' => 0,
                    'id_pegawai' => 0,
                    'nama_pegawai' => '',
                    'jenis_faktur' => 'penjualan',
                    'id_customer' => $id_customer,
                    'nama_customer' => $nama_customer,
                    'status_transaksi' => 'pending',
                ]);

                return redirect('/shop/cart?productId=' .$id_produk)->with(['success' => 'Data berhasil ditambahkan ke keranjang']);
            }

            // Cek jumlah keranjang untuk menampilkan button cancel
            $cart = DB::table('t_keranjang')->where('id_nota', $nota->id)->count();
            if ($cart > 0) {
                $data['cart'] = 1;
            } else {
                $data['cart'] = 0;
            }

            $data['nota'] = $nota;
            $data['cart'] = $cart;
            $data['datatotal'] = DB::table('t_nota')->where('id', $nota->id)->get();

            $data['jumlahcart'] = DB::table('t_nota')->where([
                ['status_transaksi','pending'],
                ['jenis_faktur','penjualan'],
                ['id_customer', $id_customer]
            ])->count();

            $data['title'] = 'Toko Online | Cart';

            return view('user/shopping_cart', $data);
        }
    }

    // Fungsi minus jumlah
    public function min_jumlah(Request $request) {
        $id_customer = Session::get('id_user');
        $id_produk = $request->get('productId');

        $nota = DB::selectOne("SELECT * FROM `t_nota` WHERE `status_transaksi` = 'pending' AND `jenis_faktur` = 'penjualan' AND `id_customer` = '$id_customer'");
        $keranjang = DB::selectOne("SELECT * FROM `t_keranjang` WHERE `id_nota` = '$nota->id' AND `id_produk` = '$id_produk'");
        $produk = DB::selectOne("SELECT * FROM `t_produk` WHERE `id` = '$id_produk'");

        // Menghitung subtotal baru setelah update jumlah pembelian
        $jumlahlama = $keranjang->jumlah;
        $subtotal = intval($keranjang->subtotal);

        $jumlahbaru = $jumlahlama - 1;
        $subtotalbaru = ($subtotal / $jumlahlama) * $jumlahbaru;

        // Menghitung total dan tagihan baru setelah update jumlah pembelian
        $total = $nota->total;
        $totalnotabaru = ( $total - $subtotal ) + $subtotalbaru;
        $tagihanbaru = $totalnotabaru + ($totalnotabaru * 0.1);

        DB::table('t_nota')->where('id', $nota->id)->update([
            'total' => $totalnotabaru,
            'tagihan' => $tagihanbaru
        ]);

        // Mengupdate stok produk
        $stok = $produk->stok;
        $stokbaru = $stok + 1;

        DB::table('t_produk')->where('id', $id_produk)->update([
            'stok' => $stokbaru,
        ]);

        if($jumlahbaru == 0) {
            DB::table('t_keranjang')->where([['id_nota', $nota->id], ['id_produk', $id_produk]])->delete();

            return redirect('/shop/cart');
        } else {
            DB::table('t_keranjang')->where([['id_nota', $nota->id], ['id_produk', $id_produk]])->update([
                'jumlah' => $jumlahbaru,
                'subtotal' => $subtotalbaru
            ]);

            return redirect('/shop/cart');
        }
    }

    // Fungsi plus jumlah
    public function plus_jumlah(Request $request) {
        $id_customer = Session::get('id_user');
        $id_produk = $request->get('productId');

        $nota = DB::selectOne("SELECT * FROM `t_nota` WHERE `status_transaksi` = 'pending' AND `jenis_faktur` = 'penjualan' AND `id_customer` = '$id_customer'");
        $keranjang = DB::selectOne("SELECT * FROM `t_keranjang` WHERE `id_nota` = '$nota->id' AND `id_produk` = '$id_produk'");
        $produk = DB::selectOne("SELECT * FROM `t_produk` WHERE `id` = '$id_produk'");

        $jumlahlama = $keranjang->jumlah;
        $jumlahbaru = $jumlahlama + 1;

        $stok = $produk->stok;
        $stokbaru = $stok - 1;

        if ($stokbaru < 0) {
            return redirect('/shop/cart')->with(['error' => 'maaf stok produk tidak mencukupi']);
        } else {
            $subtotal = intval($keranjang->subtotal);
            $subtotalbaru = ($subtotal / $jumlahlama) * $jumlahbaru;

            DB::table('t_keranjang')->where([['id_nota', $nota->id], ['id_produk', $id_produk]])->update([
                'jumlah' => $jumlahbaru,
                'subtotal' => $subtotalbaru
            ]);

            $total = $nota->total;
            $totalnotabaru = ( $total - $subtotal ) + $subtotalbaru;
            $tagihanbaru = $totalnotabaru + ($totalnotabaru * 0.1);

            DB::table('t_nota')->where('id', $nota->id)->update([
                'total' => $totalnotabaru,
                'tagihan' => $tagihanbaru
            ]);

            DB::table('t_produk')->where('id', $id_produk)->update([
                'stok' => $stokbaru,
            ]);

            return redirect('/shop/cart');
        }
    }

    public function delete_product(Request $request) {
        $id_customer = Session::get('id_user');
        $id_produk = $request->get('productId');

        $nota = DB::selectOne("SELECT * FROM `t_nota` WHERE `status_transaksi` = 'pending' AND `jenis_faktur` = 'penjualan' AND `id_customer` = '$id_customer'");
        $keranjang = DB::selectOne("SELECT * FROM `t_keranjang` WHERE `id_nota` = '$nota->id' AND `id_produk` = '$id_produk'");
        $produk = DB::selectOne("SELECT * FROM `t_produk` WHERE `id` = '$id_produk'");

        // Menghitung subtotal baru setelah update jumlah pembelian
        $jumlah = $keranjang->jumlah;
        $subtotal = intval($keranjang->subtotal);

        // Menghitung total dan tagihan baru setelah update jumlah pembelian
        $total = $nota->total;
        $totalnotabaru = $total - $subtotal;
        $tagihanbaru = $totalnotabaru + ($totalnotabaru * 0.1);

        DB::table('t_nota')->where('id', $nota->id)->update([
            'total' => $totalnotabaru,
            'tagihan' => $tagihanbaru
        ]);

        // Mengupdate stok produk
        $stok = $produk->stok;
        $stokbaru = $stok + $jumlah;

        DB::table('t_produk')->where('id', $id_produk)->update([
            'stok' => $stokbaru,
        ]);

        DB::table('t_keranjang')->where([['id_nota', $nota->id], ['id_produk', $id_produk]])->delete();

        return redirect('/shop/cart');
    }

    public function cancel($id) {
        DB::table('t_nota')->where('id', $id)->delete();
        DB::table('t_keranjang')->where('id_nota', $id)->delete();

        return redirect('/product');
    }

    public function checkout(Request $request) {
        $id_nota = $request->get('notaId');
        $id_customer = Session::get('id_user');

        $delivery = DB::selectOne("SELECT * FROM `t_pengiriman` WHERE `id_nota` = '$id_nota'");
        $datauser = DB::selectOne("SELECT * FROM `t_user` WHERE `id` = '$id_customer'");
        $nota = DB::selectOne("SELECT * FROM `t_nota` WHERE `id` = '$id_nota'");

        $data['jumlahcart'] = DB::table('t_nota')->where([
            ['status_transaksi','pending'],
            ['jenis_faktur','penjualan'],
            ['id_customer', $id_customer]
        ])->count();

        if(empty($delivery)) {
            DB::table('t_pengiriman')->insert([
                'id_nota' => $id_nota,
                'alamat_pengiriman' => $datauser->alamat,
                'kecamatan' => $datauser->kecamatan,
                'kota' => $datauser->kota,
                'provinsi' => $datauser->provinsi,
                'kodepos' => $datauser->kodepos,
                'telepon' => $datauser->telepon,
                'id_jasa_pengiriman' => 0,
            ]);

            return redirect('/shop/checkout?notaId=' .$id_nota);
        } else {
            $data['jasa'] = DB::table('t_jasa_pengiriman')->orderBy('nama', 'asc')->get();
            $data['delivery'] = $delivery;
            $data['datauser'] = $datauser;
            $data['nota'] = $nota;
        }

        $data['title'] = 'Toko Online | Checkout';

        return view('user/checkout', $data);
    }

    public function done(Request $request) {
        $id = $request->input('id_nota');
        $method = $request->method();

        if($method == 'POST') {
            DB::table('t_pengiriman')->where('id_nota', $id)->update([
                'alamat_pengiriman' => $request->input('alamat'),
                'kecamatan' => $request->input('kecamatan'),
                'kota' => $request->input('kota'),
                'provinsi' => $request->input('provinsi'),
                'kodepos' => $request->input('kodepos'),
                'telepon' => $request->input('telepon'),
                'id_jasa_pengiriman' => $request->input('id_jasa'),
            ]);

            DB::table('t_nota')->where('id', $id)->update([
                'status_transaksi' => 'unpaid',
            ]);

            return redirect('/shop/history/unpaid/' .$id)->with(['success' => 'Transaksi selesai, silakan lakukan pembayaran sebelum tanggal yang ditentukan']);
        } else {
            return redirect('/shop/checkout?notaId=' .$id_nota);
        }
    }

    public function unpaid($id) {
        $id_customer = Session::get('id_user');
        $nota = DB::selectOne("SELECT * FROM `t_nota` WHERE `status_transaksi` = 'unpaid' AND `jenis_faktur` = 'penjualan' AND `id` = '$id'");
        $datacart['cart'] = DB::table('t_keranjang')->where('id_nota', $nota->id)->get();
        $nota = (object)array_merge((array)$nota, (array)$datacart);

        $delivery = DB::selectOne("SELECT * FROM `t_pengiriman` WHERE `id_nota` = '$id'");

        $data['jumlahcart'] = DB::table('t_nota')->where([
            ['status_transaksi','pending'],
            ['jenis_faktur','penjualan'],
            ['id_customer', $id_customer]
        ])->count();

        $data['nota'] = $nota;
        $data['delivery'] = $delivery;
        $data['datatotal'] = DB::table('t_nota')->where('id', $nota->id)->get();
        $data['title'] = 'Toko Online | Unpaid';

        return view('user/unpaid', $data);
    }

    public function paid_process(Request $request) {
        $id_nota = $request->get('notaId');

        DB::table('t_nota')->where('id', $id_nota)->update([
            'status_transaksi' => 'success',
        ]);

        return redirect('/shop/history/paid/' .$id)->with(['success' => 'Pembayaran selesai, terimakasih !']);
    }

    public function paid($id) {
        $id_customer = Session::get('id_user');
        $nota = DB::selectOne("SELECT * FROM `t_nota` WHERE `status_transaksi` = 'success' AND `jenis_faktur` = 'penjualan' AND `id` = '$id'");
        $datacart['cart'] = DB::table('t_keranjang')->where('id_nota', $nota->id)->get();
        $nota = (object)array_merge((array)$nota, (array)$datacart);

        $delivery = DB::selectOne("SELECT * FROM `t_pengiriman` WHERE `id_nota` = '$id'");

        $data['jumlahcart'] = DB::table('t_nota')->where([
            ['status_transaksi','pending'],
            ['jenis_faktur','penjualan'],
            ['id_customer', $id_customer]
        ])->count();

        $data['nota'] = $nota;
        $data['delivery'] = $delivery;
        $data['datatotal'] = DB::table('t_nota')->where('id', $nota->id)->get();
        $data['title'] = 'Toko Online | Paid';

        return view('user/paid', $data);
    }
}
