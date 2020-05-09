<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ContactController extends Controller
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
            $data['active'] = 'contact_active';
            $data['title'] = 'Toko Online | Admin Contact Us';
            $data['welcome_title'] = 'Halaman Contact Us Admin';
            $data['breadcrumb'] = 'Contact Us';

            $data['kontak'] = DB::table('t_kontak')
                            ->orderBy('id', 'asc')
                            ->paginate(5);


            return view('admin/contact', $data);
        }
    }

    //Detail Contact
    public function detail($id) {
        $id_role = Session::get('role');
        $data['menu'] = DB::table('t_menu')->where('id_role', $id_role)->orderBy('urutan', 'asc')->get();
        $data['active'] = 'contact_active';

        $data['title'] = 'Toko Online | Admin Produk';
        $data['welcome_title'] = 'Halaman Admin Produk';
        $data['breadcrumb'] = 'Contact - Detail';

        $data['kontak'] =   DB::table('t_kontak')->where('id', $id)->get();

        return view('admin/contact_detail', $data);
    }

    // Delete Contact
    public function delete($id) {
        $sql = DB::table('t_kontak')->where('id',$id)->delete();

        if ($sql) {
            return redirect('/a/contact')->with(['success' => 'Data berhasil dihapus !']);
        } else {
            return redirect('/a/contact')->with(['error' => 'Data gagal dihapus !']);
        }
    }
}
