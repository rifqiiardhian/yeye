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

            $data['jml_order'] = $this->total_pesanan();
            $data['jml_users'] = $this->total_users();
            $data['jml_daily'] = $this->daily_revenue();
            $data['jml_pendapatan'] = $this->total_pendapatan();
            return view('admin/home', $data);

        }
    }

    //total user (role customers)
    public function total_users(){
        $total_user =   DB::table('t_user')
                        ->select(DB::raw('count(*) as jumlah'))
                        ->where('id_role', '=', 2)
                        ->get();
            return $total_user;
    }

    //total pesanan
    public function total_pesanan(){
        $total_order =   DB::table('t_nota')
                        ->select(DB::raw('count(*) as jumlah'))
                        ->where('status_transaksi', '=', 'success')
                        ->Where('jenis_faktur', '=', 'penjualan')
                        ->get();
            return $total_order;
    }

    //weekly revenue
    public function daily_revenue(){
            $daily_rev = DB::table('t_nota')
                                ->where('status_transaksi', '=', 'success')
                                ->whereRaw('Date(tanggal) = CURDATE()')
                                ->sum('tagihan');

                                return $daily_rev;

    }

    //total revenue
    public function total_pendapatan(){
        $total_revenue = DB::table('t_nota')
                            ->where('status_transaksi', '=', 'success')
                            ->SUM('tagihan');
                            return $total_revenue;
    }

    public function __construct()
    {

    }

    public function getLaporanPendapatan(Request $request)
    {
        $result = DB::select("SELECT DATE_FORMAT(tanggal, '%M') AS `bulan`, SUM(`total`) AS `total`
             FROM `t_nota` WHERE `jenis_faktur` = 'penjualan' AND `status_transaksi` = 'success' GROUP BY `bulan` ORDER BY `id` ASC", []);
        return response($result);
    }
}
