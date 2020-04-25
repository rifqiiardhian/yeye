<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        if(!Session::get('login')) {
            return redirect('/login')->with(['error' => 'Anda harus login terlebih dahulu !']);
        } else {
            $id_role = Session::get('role');
            $data['menu'] = DB::table('t_menu')->where('id_role', $id_role)->orderBy('urutan', 'asc')->get();
            $data['active'] = 'product_active';

            $data['title'] = 'Toko Online | Admin Produk';
            $data['welcome_title'] = 'Halaman Admin Produk';
            $data['breadcrumb'] = 'Product';

            $data['produk'] = DB::table('t_produk')
                            ->orderBy('id', 'asc')
                            ->paginate(5);

            return view('admin/product', $data);
        }
    }

    public function detail($id) {
        $id_role = Session::get('role');
        $data['menu'] = DB::table('t_menu')->where('id_role', $id_role)->orderBy('urutan', 'asc')->get();
        $data['active'] = 'product_active';

        $data['title'] = 'Toko Online | Admin Produk';
        $data['welcome_title'] = 'Halaman Admin Produk';
        $data['breadcrumb'] = 'Product - Detail';

        $data['produk'] = DB::table('t_produk')
                            ->join('t_kategori', "t_produk.id_kategori", "=", "t_kategori.id")
                            ->select('t_produk.nama as nama_produk', 't_produk.foto', 't_produk.harga', 't_produk.deskripsi', 't_produk.stok', 't_kategori.nama as kategori')
                            ->where('t_produk.id', $id)
                            ->get();

        $data['preview'] = DB::table('t_preview_produk')->where('id_produk', $id)->get();

        return view('admin/product_detail', $data);
    }

    public function add() {
        $id_role = Session::get('role');
        $data['menu'] = DB::table('t_menu')->where('id_role', $id_role)->orderBy('urutan', 'asc')->get();
        $data['active'] = 'product_active';

        $data['title'] = 'Toko Online | Admin Produk';
        $data['welcome_title'] = 'Halaman Admin Produk';
        $data['breadcrumb'] = 'Product - Add';

        $data['kategori'] = DB::table('t_kategori')
                            ->orderBy('id', 'asc')
                            ->get();

        return view('admin/product_add', $data);
    }

    public function add_preview($id) {
        $id_role = Session::get('role');
        $data['menu'] = DB::table('t_menu')->where('id_role', $id_role)->orderBy('urutan', 'asc')->get();
        $data['active'] = 'product_active';

        $data['title'] = 'Toko Online | Admin Produk';
        $data['welcome_title'] = 'Halaman Admin Produk';
        $data['breadcrumb'] = 'Product - Add Preview';

        $data['produk'] = DB::table('t_produk')->where('id', $id)->get();

        return view('admin/product_preview_add', $data);
    }

    public function save_preview(Request $request) {
        $method = $request->method();

        if($method == "POST") {
            $direktori = 'assets/produkpreview';

            $file = $request->file('file');
            $file->move($direktori, $file->getClientOriginalName());

            DB::table('t_preview_produk')->insert([
                'id_produk' => $request->input('id_produk'),
                'foto' => $direktori."/".$file->getClientOriginalName()
            ]);
        } else {
            return redirect('/a/product');
        }
    }

    public function save(Request $request) {
        $method = $request->method();

        if($method == "POST") {
            $direktori = 'assets/gambarproduk';
            $file = $request->file('foto');
            $file->move($direktori, $file->getClientOriginalName());

            $sql = DB::table('t_produk')->insert([
                    'nama' => $request->input('nama'),
                    'id_kategori' => $request->input('kategori'),
                    'foto' => $direktori."/".$file->getClientOriginalName(),
                    'harga' => $request->input('harga'),
                    'stok' => '0',
                    'deskripsi' => $request->input('deskripsi')
            ]);

            if ($sql) {
                return redirect('/a/product')->with(['success' => 'Data berhasil disimpan']);
            } else {
                return redirect('/a/product/add')->with(['error' => 'Data gagal disimpan']);
            }
        } else {
            return redirect('/a/product/add')->with(['error' => 'Data gagal disimpan']);
        }
    }

    public function edit($id) {
        $id_role = Session::get('role');
        $data['menu'] = DB::table('t_menu')->where('id_role', $id_role)->orderBy('urutan', 'asc')->get();
        $data['active'] = 'product_active';

        $data['title'] = 'Toko Online | Admin Produk';
        $data['welcome_title'] = 'Halaman Admin Produk';
        $data['breadcrumb'] = 'Product - Edit';

        $data['produk'] = DB::table('t_produk')->where('id',$id)->get();

        $data['kategori'] = DB::table('t_kategori')
                            ->orderBy('id', 'asc')
                            ->get();

        return view('admin/product_edit', $data);
    }

    public function update(Request $request) {
        $method = $request->method();

        if($method == "POST") {
            $id = $request->id;
            $direktori = 'assets/gambarproduk';
            $file = $request->file('foto');

            if($file != "") {
                $file->move($direktori, $file->getClientOriginalName());

                $sql = DB::table('t_produk')->where('id', $id )->update([
                            'nama' => $request->input('nama'),
                            'foto' => $direktori."/".$file->getClientOriginalName(),
                            'harga' => $request->input('harga'),
                            'deskripsi' => $request->input('deskripsi')
                        ]);

                if ($sql) {
                    return redirect('/a/product')->with(['success' => 'Data berhasil diupdate']);
                } else {
                    return redirect('/a/product/edit/' .$id)->with(['error' => 'Data gagal diupdate']);
                }
            } else {
                $sql = DB::table('t_produk')->where('id', $id )->update([
                            'nama' => $request->input('nama'),
                            'harga' => $request->input('harga'),
                            'deskripsi' => $request->input('deskripsi')
                        ]);

                if ($sql) {
                    return redirect('/a/product')->with(['success' => 'Data berhasil diupdate']);
                } else {
                    return redirect('/a/product/edit/' .$id)->with(['error' => 'Data gagal diupdate']);
                }
            }
        } else {
            return redirect('/a/product/edit/' .$id)->with(['error' => 'Data gagal diupdate']);
        }
    }

    public function delete($id) {
        $sql = DB::table('t_produk')->where('id',$id)->delete();

        if ($sql) {
            return redirect('/a/product')->with(['success' => 'Data berhasil dihapus']);
        } else {
            return redirect('/a/product')->with(['error' => 'Data gagal dihapus']);
        }
    }
}
