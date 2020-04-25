<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index() {
        if(!Session::get('login')) {
            return redirect('/login')->with(['error' => 'Anda harus login terlebih dahulu !']);
        } else {
            $id_role = Session::get('role');
            $data['menu'] = DB::table('t_menu')->where('id_role', $id_role)->orderBy('urutan', 'asc')->get();
            $data['active'] = 'supplier_active';

            $data['title'] = 'Toko Online | Admin Supplier';
            $data['welcome_title'] = 'Halaman Admin Supplier';
            $data['breadcrumb'] = 'Supplier';

            $data['supplier'] = DB::table('t_supplier')->orderBy('nama', 'asc')->paginate(5);

            return view('admin/supplier', $data);
        }
    }

    public function detail() {

    }

    public function add() {
        $id_role = Session::get('role');
        $data['menu'] = DB::table('t_menu')->where('id_role', $id_role)->orderBy('urutan', 'asc')->get();
        $data['active'] = 'supplier_active';

        $data['title'] = 'Toko Online | Admin Supplier';
        $data['welcome_title'] = 'Halaman Admin Supplier';
        $data['breadcrumb'] = 'Supplier - Add';

        return view('admin/supplier_add', $data);
    }

    public function save(Request $request) {
        $method = $request->method();

        if ($method == 'POST') {
            $sql = DB::table('t_supplier')->insert([
                'nama' => $request->input('nama'),
                'telepon' => $request->input('telepon'),
                'provinsi' => $request->input('provinsi'),
                'kota' => $request->input('kota'),
                'kecamatan' => $request->input('kecamatan'),
                'kodepos' => $request->input('kodepos'),
                'alamat' => $request->input('alamat'),
            ]);

            if ($sql) {
                return redirect('/a/supplier')->with(['success' => 'Data berhasil disimpan']);
            } else {
                return redirect('/a/supplier/add')->with(['error' => 'Data gagal disimpan']);
            }
        } else {
            return redirect('/a/supplier/add')->with(['error' => 'Data gagal disimpan']);
        }
    }

    public function edit($id) {
        $id_role = Session::get('role');
        $data['menu'] = DB::table('t_menu')->where('id_role', $id_role)->orderBy('urutan', 'asc')->get();
        $data['active'] = 'supplier_active';

        $data['title'] = 'Toko Online | Admin Supplier';
        $data['welcome_title'] = 'Halaman Admin Supplier';
        $data['breadcrumb'] = 'Supplier - Add';

        $data['supplier'] = DB::table('t_supplier')->where('id', $id)->get();

        return view('admin/supplier_edit', $data);
    }

    public function update(Request $request) {
        $method = $request->method();

        if ($method == 'POST') {
            $id = $request->input('id');

            $sql = DB::table('t_supplier')->where('id', $id)->update([
                'nama' => $request->input('nama'),
                'telepon' => $request->input('telepon'),
                'provinsi' => $request->input('provinsi'),
                'kota' => $request->input('kota'),
                'kecamatan' => $request->input('kecamatan'),
                'kodepos' => $request->input('kodepos'),
                'alamat' => $request->input('alamat'),
            ]);

            if ($sql) {
                return redirect('/a/supplier')->with(['success' => 'Data berhasil diupdate']);
            } else {
                return redirect('/a/supplier/edit/' .$id)->with(['error' => 'Data gagal diupdate']);
            }
        } else {
            return redirect('/a/supplier/edit/' .$id)->with(['error' => 'Data gagal diupdate']);
        }
    }

    public function delete($id) {
        $sql = DB::table('t_supplier')->where('id', $id)->delete();

        if ($sql) {
            return redirect('/a/supplier')->with(['success' => 'Data berhasil dihapus']);
        } else {
            return redirect('/a/supplier')->with(['error' => 'Data gagal dihapus']);
        }
    }

}
