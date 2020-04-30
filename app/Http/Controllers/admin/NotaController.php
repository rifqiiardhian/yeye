<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class NotaController extends Controller{
    public function total_pesanan(){
        $total_pesanan =   DB::table('t_nota')->select('count(status_transaksi)')->where([
            ['status_transaksi', '=', 'success']]);
        
    }
}