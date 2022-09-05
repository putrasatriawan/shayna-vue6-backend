<?php

namespace App\Http\Controllers;


use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        //script income adalah mencari transaction status yang sukses dan menghitung nya transaction total 
        $income = Transaction::where('transaction_status', 'SUCCESS')->sum('transaction_total');

        //menghitung semua transaksi yang sukses pending atau failed di web
        $sales = Transaction::count();

        //mengambil data 5 terakhir
        $items = Transaction::orderBy('id', 'DESC')->take(5)->get();

        //menghitung data semua dari pending failed dan sukses dengan menghitung 1 1
        $pie = [
            'pending' => Transaction::where('transaction_status', 'PENDING')->count(),
            'failed' => Transaction::where('transaction_status', 'FAILED')->count(),
            'success' => Transaction::where('transaction_status', 'SUCCESS')->count(),
        ];

        return view('pages.dashboard')->with([
            'income' => $income,
            'sales' => $sales,
            'items' => $items,
            'pie' => $pie
        ]);
    }
}