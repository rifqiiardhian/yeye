<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        if(!Session::get('login')) {
            return redirect('/login')->with(['error' => 'Anda harus login terlebih dahulu !']);
        } else {
            $id_role = Session::get('role');
            $data['menu'] = DB::table('t_menu')
                            ->where('id_role', $id_role)
                            ->orderBy('urutan', 'asc')
                            ->get();
            $data['active'] = 'home_active';
            $data['title'] = 'Toko Online | Admin Dashboard';
            $data['welcome_title'] = 'Halaman Dashboard Admin';
            $data['breadcrumb'] = 'Dashboard';

            return view('admin/home', $data);
        }
    }
}
