<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index() {
        $data['title'] = 'Toko Online | Home';

        $data['kategori'] = DB::table('t_kategori')->orderBy('id', 'asc')->get();

        $data['produk'] = DB::table('t_produk')->orderBy('id', 'desc')->take(8)->get();

        if(Session::get('role') == 2) {
            $data['jumlahcart'] = DB::table('t_nota')->where([
                ['status_transaksi','pending'],
                ['jenis_faktur','penjualan'],
                ['id_customer', Session::get('id_user')]
            ])->count();
        } else {
            $data['jumlahcart'] = 0;
        }

        return view('user/home', $data);
    }
}
