<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login() {
        $data['title'] = 'Toko Online | Login';

        return view('autentikasi/login', $data);
    }

    public function register() {
        $data['title'] = 'Toko Online | Register';

        return view('autentikasi/register', $data);
    }

    public function cek_login(Request $request) {
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required',
        ]);

        $email = $request->email;
        $password = $request->password;
        $hash = md5($password);

        $check = DB::select("SELECT * FROM `t_user` WHERE `email` = '$email' AND `password` = '$hash'");

        if (!empty($check)) {
            foreach( $check as $data ) {
                $id = $data->id;
                $nama = $data->nama;
                $email = $data->email;
                $id_role = $data->id_role;
            }

            Session::put('id_user', $id);
            Session::put('nama', $nama);
            Session::put('email', $email);
            Session::put('role', $id_role);
            Session::put('login',TRUE);

            if ($id_role == 1) {
                return redirect('a/home')->with(['success' => 'Selamat datang ' .$nama.' !']);
            } elseif ($id_role == 2) {
                return redirect('/')->with(['success' => 'Selamat datang ' .$nama.' !']);
            }

        } else {
            return redirect('/login')->with(['error' => 'Email atau password anda Salah !']);
        }
    }

    public function register_post(Request $request) {
        $this->validate($request,[
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password_konfirm' => 'required',
        ]);

        $nama = $request->input('nama');
        $email = $request->input('email');
        $password_konfirm = $request->input('password_konfirm');
        $hash = md5($password_konfirm);
        $method = $request->method();

        if ($method == 'POST') {
            $sql = DB::table('t_user')->insert([
                'nama' => $nama,
                'email' => $email,
                'password' => $hash,
                'telepon' => '',
                'provinsi' => '',
                'kota' => '',
                'kecamatan' => '',
                'kodepos' => 0,
                'alamat' => '',
                'id_role' => 2,
            ]);

            if ($sql) {
                return redirect('/register')->with(['success' => 'Register berhasil !']);
            } else {
                return redirect('/register')->with(['error' => 'Register gagal !']);
            }
        } else {
            return redirect('/register')->with(['error' => 'Register gagal !']);
        }
    }

    public function profile() {
        if (Session::get('role') == 2) {
            $id_user = Session::get('id_user');
            $id_role = Session::get('role');

            $data['profile'] = DB::selectOne("SELECT * FROM `t_user` WHERE `id` = '$id_user'");
            $data['title'] = 'Toko Online | Profile';
            $data['jumlahcart'] = DB::table('t_nota')->where([
                ['status_transaksi','pending'],
                ['jenis_faktur','penjualan'],
                ['id_customer', Session::get('id_user')]
            ])->count();

            return view('user/profile', $data);
        } else {
            return redirect('/login')->with(['error' => 'Anda harus login terlebih dahulu !']);
        }
    }

    public function update_profile(Request $request) {
        $id = $request->input('id_user');
        $nama = $request->input('nama');
        $email = $request->input('email');
        $telepon = $request->input('telepon');
        $alamat = $request->input('alamat');
        $kecamatan = $request->input('kecamatan');
        $kota = $request->input('kota');
        $provinsi = $request->input('provinsi');
        $kodepos = $request->input('kodepos');

        $method = $request->method();

        if( $method == 'POST') {
            $sql = DB::table('t_user')->where('id', $id)->update([
                        'nama' => $nama,
                        'email' => $email,
                        'telepon' => $telepon,
                        'alamat' => $alamat,
                        'kecamatan' => $kecamatan,
                        'kota' => $kota,
                        'provinsi' => $provinsi,
                        'kodepos' => $kodepos,
                    ]);

            if ($sql) {
                return redirect('/profile')->with(['success' => 'Data berhasil diupdate !']);
            } else {
                return redirect('/profile')->with(['error' => 'Data gagal diupdate !']);
            }
        } else {
            return redirect('/profile')->with(['error' => 'Data gagal diupdate !']);
        }
    }

    public function logout(){
        Session::flush();
        return redirect('/login')->with(['success' => 'Anda telah logout']);
    }
}
