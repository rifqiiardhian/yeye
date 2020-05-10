<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use PDF;

class ListUserController extends Controller
{
    public function index() {
        if(!Session::get('login')) {
            return redirect('/login')->with(['error' => 'Anda harus login terlebih dahulu !']);
        } else {
            $id_role = Session::get('role');
            $data['menu'] = DB::table('t_menu')->where('id_role', $id_role)->orderBy('urutan', 'asc')->get();
            $data['active'] = 'list-user_active';

            $data['title'] = 'Toko Online | Admin List User';
            $data['welcome_title'] = 'Halaman Admin List User';
            $data['breadcrumb'] = 'List User';

            $data['user'] = DB::table('t_user')
                            ->orderBy('id', 'asc')
                            ->paginate(5);

            return view('admin/list_user', $data);
        }
    }
}
