<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AboutController extends Controller
{
    public function index() {
        $data['title'] = 'Toko Online | About Us';

        $data['produk'] = DB::table('t_produk')->orderBy('id', 'desc')->paginate(12);

        if(Session::get('role') == 2) {
            $data['jumlahcart'] = DB::table('t_nota')->where([
                ['status_transaksi','pending'],
                ['jenis_faktur','penjualan'],
                ['id_customer', Session::get('id_user')]
            ])->count();
        } else {
            $data['jumlahcart'] = 0;
        }

        return view('user/about', $data);
    }
}
?>