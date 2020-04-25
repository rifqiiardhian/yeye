<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Category Table
    public function index() {
        if(!Session::get('login')) {
            return redirect('/login')->with(['error' => 'Anda harus login terlebih dahulu !']);
        } else {
            $id_role = Session::get('role');
            $data['menu'] = DB::table('t_menu')->where('id_role', $id_role)->orderBy('urutan', 'asc')->get();
            $data['active'] = 'category_active';

            $data['title'] = 'Toko Online | Admin Kategori';
            $data['welcome_title'] = 'Halaman Admin Kategori';
            $data['breadcrumb'] = 'Category';

            $data['kategori'] = DB::table('t_kategori')
                            ->orderBy('id', 'asc')
                            ->paginate(5);

            return view('admin/category', $data);
        }
    }

    // Add Category
    public function add() {
        $id_role = Session::get('role');
        $data['menu'] = DB::table('t_menu')->where('id_role', $id_role)->orderBy('urutan', 'asc')->get();
        $data['active'] = 'category_active';

        $data['title'] = 'Toko Online | Admin Kategori';
        $data['welcome_title'] = 'Halaman Admin Kategori';
        $data['breadcrumb'] = 'Category - Add';

        return view('admin/category_add', $data);
    }

    // Save Category
    public function save(Request $request) {
        $method = $request->method();

        if( $method == "POST" ) {
            $sql = DB::table('t_kategori')->insert([
                        'nama' => $request->input('nama')
                    ]);

            if ($sql) {
                return redirect('/a/category')->with(['success' => 'Data berhasil disimpan']);
            } else {
                return redirect('/a/category/add')->with(['error' => 'Data gagal disimpan']);
            }
        } else {
            return redirect('/a/category/add')->with(['error' => 'Data gagal disimpan']);
        }
    }

    // Edit Category
    public function edit($id) {
        $id_role = Session::get('role');
        $data['menu'] = DB::table('t_menu')->where('id_role', $id_role)->orderBy('urutan', 'asc')->get();
        $data['active'] = 'category_active';

        $data['title'] = 'Toko Online | Admin Kategori';
        $data['welcome_title'] = 'Halaman Admin Kategori';
        $data['breadcrumb'] = 'Category - Edit';

        $data['kategori'] = DB::table('t_kategori')
                            ->where('id', $id)
                            ->get();

        return view('admin/category_edit', $data);
    }

    // Update Category
    public function update(Request $request) {
        $method = $request->method();

        if ( $method == "POST" ) {
            $id = $request->input('id');

            $sql = DB::table('t_kategori')->where('id', $id)->update([
                        'nama' => $request->input('nama')
                    ]);

            if ($sql) {
                return redirect('/a/category')->with(['success' => 'Data berhasil diubah !']);
            } else {
                return redirect('/a/category/edit/$id')->with(['error' => 'Data gagal diupdate !']);
            }
        } else {
            return redirect('/a/category/edit/$id')->with(['error' => 'Data gagal diupdate !']);
        }
    }

    // Delete Category
    public function delete($id) {
        $sql = DB::table('t_kategori')->where('id',$id)->delete();

        if ($sql) {
            return redirect('/a/category')->with(['success' => 'Data berhasil dihapus !']);
        } else {
            return redirect('/a/category')->with(['error' => 'Data gagal dihapus !']);
        }
    }
}
