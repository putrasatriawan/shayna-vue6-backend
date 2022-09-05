<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\CheckoutRequest;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    public function checkout(CheckoutRequest $request)
    {
        //mengambil request kecuali transaction_details
        $data = $request->except('transaction_details');
        //menggenarate angkan random mt_rand(10000, 9999) . mt_rand(100, 999);
        $data['uuid'] = 'TRX' . mt_rand(1000, 9999) . mt_rand(100, 999);
        //untuk memasukan data ke model
        $transaction = Transaction::create($data);
        //unruk melooping relasi ke transation_detail
        foreach ($request->transaction_details as $product) {
            //menambahkan data baru ke transactionsdetail dengan array
            $details[] = new TransactionDetail([
                //$transaction dapet dari transaction yang sudah di create di atas sebelumnya
                'transactions_id' => $transaction->id,
                //$product dapet dari looping foreach di atas
                'products_id' => $product,
            ]);
            // mengurangi jumlah produk yang akan di checkout dengan decrement
            Product::find($product)->decrement('quantity');
        }
        //menyimpan data relasi dari details array
        $transaction->details()->saveMany($details);

        //membalikan response transaction sukses
        return ResponseFormatter::success($transaction);
    }
}