<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index() {

            $data['jumlahcart'] = DB::table('t_nota')->where([
                ['status_transaksi','pending'],
                ['jenis_faktur','penjualan'],
                ['id_customer', Session::get('id_user')]
            ])->count();

            $data['produk'] = DB::table('t_kontak')
                            ->orderBy('id', 'asc')
                            ->paginate(5);

            $data['title'] = 'Toko Online | Contact Us';

            return view('user/contact', $data);
    }
    
    public function success(Request $request) {
        $method = $request->method();

        if($method == "POST") {

            $sql = DB::table('t_kontak')->insert([
                    'nama' => $request->input('nama'),
                    'email' => $request->input('email'),
                    'telepon' => $request->input('telepon'),
                    'subjek' => $request->input('subjek'),
                    'pesan' => $request->input('pesan'),
            ]);

            if ($sql) {
                return redirect('/contact')->with(['success' => 'Pesan berhasil terkirim']);
            } else {
                return redirect('/contact/post')->with(['error' => 'Pesan gagal terkirim']);
            }
        } else {
            return redirect('/contact/post')->with(['error' => 'Pesan gagal terkirim']);
        }
    }

}
