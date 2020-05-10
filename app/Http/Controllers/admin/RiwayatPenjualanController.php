<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use PDF;

class RiwayatPenjualanController extends Controller
{
    // Riwayat Penjualan ke Supplier
    public function index() {
        if(!Session::get('login')) {
            return redirect('/login')->with(['error' => 'Anda harus login terlebih dahulu !']);
        } else {
            $id_role = Session::get('role');
            $id_pegawai = Session::get('id_user');
            $data['menu'] = DB::table('t_menu')->where('id_role', $id_role)->orderBy('urutan', 'asc')->get();
            $data['active'] = 'riwayat-penjualan_active';

            $data['title'] = 'Toko Online | Admin Riwayat Penjualan';
            $data['welcome_title'] = 'Halaman Admin Riwayat Penjualan';
            $data['breadcrumb'] = 'Riwayat Penjualan';

            $data['unpaid'] = DB::table("t_nota")
                                ->where([
                                    ['status_transaksi', 'unpaid'],
                                    ['jenis_faktur', '=', 'penjualan']
                                ])->get();

            $data['success'] = DB::table("t_nota")
                                ->where([
                                    ['status_transaksi', '=', 'success'],
                                    ['jenis_faktur', '=', 'penjualan'],
                                ])
                                ->orderBy('id', 'desc')
                                ->get();

            return view('admin/riwayat_penjualan', $data);
        }
    }

    // Fungsi Transaksi
    public function add_facture(Request $request) {
        $id_pegawai = Session::get('id_user');
        $nama_pegawai = Session::get('nama');
        $id_produk = $request->get('productId');

        $nota = DB::selectOne("SELECT * FROM `t_nota` WHERE `status_transaksi` = 'unpaid' AND `jenis_faktur` = 'Penjualan' AND `id_pegawai` = '$id_pegawai'");

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
                    $stokbaru = $stok + 1;

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
                'id_customer' => 0,
                'nama_customer' => '',
                'jenis_faktur' => 'Penjualan',
                'id_pegawai' => $id_pegawai,
                'nama_pegawai' => $nama_pegawai,
                'status_transaksi' => 'unpaid',
            ]);

            return redirect('/a/riwayat_penjualan/cart?productId=' .$id_produk)->with(['success' => 'Data berhasil ditambahkan ke keranjang']);
        }

        // Cek jumlah keranjang untuk menampilkan button cancel
        $cart = DB::table('t_keranjang')->where('id_nota', $nota->id)->count();
        if ($cart > 0) {
            $data['cart'] = 1;
        } else {
            $data['cart'] = 0;
        }

        // Panggil data supplier
        $data['supplier'] = DB::table('t_supplier')->orderBy('id', 'asc')->get();

        $id_role = Session::get('role');
        $id_pegawai = Session::get('id_user');
        $data['menu'] = DB::table('t_menu')->where('id_role', $id_role)->orderBy('urutan', 'asc')->get();
        $data['active'] = 'inventory_active';

        $data['title'] = 'Toko Online | Admin Inventory';
        $data['welcome_title'] = 'Halaman Admin Inventory';
        $data['breadcrumb'] = 'Inventory - Cart';

        $data['nota'] = $nota;
        $data['cart'] = $cart;
        $data['tanggal'] = date('d M Y H:i:s');
        $data['nama_pegawai'] = $nama_pegawai;
        $data['datatotal'] = DB::table('t_nota')->where('id', $nota->id)->get();

        return view('admin/inventory_cart', $data);
    }

    // Fungsi minus jumlah
    public function min_jumlah(Request $request) {
        $id_pegawai = Session::get('id_user');
        $id_produk = $request->get('productId');

        $nota = DB::selectOne("SELECT * FROM `t_nota` WHERE `status_transaksi` = 'unpaid' AND `jenis_faktur` = 'Penjualan' AND `id_pegawai` = '$id_pegawai'");
        $keranjang = DB::selectOne("SELECT * FROM `t_keranjang` WHERE `id_nota` = '$nota->id' AND `id_produk` = '$id_produk'");
        $produk = DB::selectOne("SELECT * FROM `t_produk` WHERE `id` = '$id_produk'");

        // Menghitung subtotal baru setelah update jumlah Penjualan
        $jumlahlama = $keranjang->jumlah;
        $subtotal = intval($keranjang->subtotal);

        $jumlahbaru = $jumlahlama - 1;
        $subtotalbaru = ($subtotal / $jumlahlama) * $jumlahbaru;

        // Menghitung total dan tagihan baru setelah update jumlah Penjualan
        $total = $nota->total;
        $totalnotabaru = ( $total - $subtotal ) + $subtotalbaru;
        $tagihanbaru = $totalnotabaru + ($totalnotabaru * 0.1);

        DB::table('t_nota')->where('id', $nota->id)->update([
            'total' => $totalnotabaru,
            'tagihan' => $tagihanbaru
        ]);

        // Mengupdate stok produk
        $stok = $produk->stok;
        $stokbaru = $stok - 1;

        DB::table('t_produk')->where('id', $id_produk)->update([
            'stok' => $stokbaru,
        ]);

        if($jumlahbaru == 0) {
            DB::table('t_keranjang')->where([['id_nota', $nota->id], ['id_produk', $id_produk]])->delete();

            return redirect('/a/riwayat_penjualan/cart');
        } else {
            DB::table('t_keranjang')->where([['id_nota', $nota->id], ['id_produk', $id_produk]])->update([
                'jumlah' => $jumlahbaru,
                'subtotal' => $subtotalbaru
            ]);

            return redirect('/a/riwayat_penjualan/cart');
        }

    }

    // Fungsi plus jumlah
    public function plus_jumlah(Request $request) {
        $id_pegawai = Session::get('id_user');
        $id_produk = $request->get('productId');

        $nota = DB::selectOne("SELECT * FROM `t_nota` WHERE `status_transaksi` = 'unpaid' AND `jenis_faktur` = 'Penjualan' AND `id_pegawai` = '$id_pegawai'");
        $keranjang = DB::selectOne("SELECT * FROM `t_keranjang` WHERE `id_nota` = '$nota->id' AND `id_produk` = '$id_produk'");
        $produk = DB::selectOne("SELECT * FROM `t_produk` WHERE `id` = '$id_produk'");

        // Menghitung subtotal baru setelah update jumlah Penjualan
        $jumlahlama = $keranjang->jumlah;
        $subtotal = intval($keranjang->subtotal);

        $jumlahbaru = $jumlahlama + 1;
        $subtotalbaru = ($subtotal / $jumlahlama) * $jumlahbaru;

        DB::table('t_keranjang')->where([['id_nota', $nota->id], ['id_produk', $id_produk]])->update([
            'jumlah' => $jumlahbaru,
            'subtotal' => $subtotalbaru
        ]);

        // Menghitung total dan tagihan baru setelah update jumlah Penjualan
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

        return redirect('/a/riwayat_penjualan/cart');
    }

    // Fungsi Checkout Transaksi
    public function checkout(Request $request) {
        $method = $request->method();
        $id_nota = $request->input('id_nota');
        $id_supplier = $request->input('supplier');

        $supplier = DB::selectOne("SELECT * FROM `t_supplier` WHERE `id` = '$id_supplier'");
        $nama_supplier = $supplier->nama;

        DB::table('t_nota')->where('id', $id_nota)->update([
            'status_transaksi' => 'success',
            'id_customer' => $id_supplier,
            'nama_customer' => $nama_supplier
        ]);

        return redirect('/a/inventory')->with(['success' => 'Penjualan barang sukses !']);

    }

    // Fungsi Cancel Transaksi
    public function cancel($id) {
        DB::table('t_nota')->where('id', $id)->delete();
        DB::table('t_keranjang')->where('id_nota', $id)->delete();

        return redirect('/a/product')->with(['success' => 'Penjualan barang dibatalkan']);
    }

    public function detail($id) {
        $id_role = Session::get('role');
        $id_pegawai = Session::get('id_user');
        $data['menu'] = DB::table('t_menu')->where('id_role', $id_role)->orderBy('urutan', 'asc')->get();
        $data['active'] = 'riwayat-penjualan_active';

        $data['title'] = 'Toko Online | Admin Riwayat Penjualan';
        $data['welcome_title'] = 'Halaman Admin Riwayat Penjualan';
        $data['breadcrumb'] = 'Riwayat Penjualan';

        $nota = DB::selectOne("SELECT * FROM `t_nota` WHERE `status_transaksi` = 'success' AND `jenis_faktur` = 'penjualan' AND `id` = '$id'");
        $datacart['cart'] = DB::table('t_keranjang')->where('id_nota', $nota->id)->get();
        $nota = (object)array_merge((array)$nota, (array)$datacart);

        $data['nota'] = $nota;

        return view('admin/riwayat_penjualan_detail', $data);
    }

    // Fungsi Download Faktur
    public function download($id) {
        $nota = DB::selectOne("SELECT * FROM `t_nota` WHERE `status_transaksi` = 'success' AND `jenis_faktur` = 'penjualan' AND `id` = '$id'");
        $datacart['cart'] = DB::table('t_keranjang')->where('id_nota', $nota->id)->get();
        $nota = (object)array_merge((array)$nota, (array)$datacart);

        $data['nota'] = $nota;
        $data['title'] = 'Faktur Penjualan No.' .$id;

        $pdf = PDF::loadview('admin/inventory_preview', $data);
        return $pdf->download('faktur-penjualan-no-'.$id.'.pdf');

        return redirect('/a/riwayat-penjualan/detail/' .$id);
    }

    // Fungsi print faktur
    public function print($id) {
        $nota = DB::selectOne("SELECT * FROM `t_nota` WHERE `status_transaksi` = 'success' AND `jenis_faktur` = 'penjualan' AND `id` = '$id'");
        $datacart['cart'] = DB::table('t_keranjang')->where('id_nota', $nota->id)->get();
        $nota = (object)array_merge((array)$nota, (array)$datacart);

        $data['nota'] = $nota;
        $data['title'] = 'Riwayat Penjualan No.' .$id;

        $pdf = PDF::loadview('admin/riwayat_penjualan_preview', $data);
        return $pdf->stream();
    }
}
