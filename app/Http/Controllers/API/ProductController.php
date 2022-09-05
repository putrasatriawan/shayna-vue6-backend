<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //mengambil data product secara spesifik seperti range, nama, harga dll
    public function all(Request $request)
    {
        //ngambil product berdasarkan id
        $id = $request->input('id');
        //membatasi data yang akan di panggil
        $limit = $request->input('limit', 6);
        //ngambil product berdasarkan nama
        $name = $request->input('name');
        //ngambil product berdasarkan slug
        $slug = $request->input('slug');
        //ngambil product berdasarkan type
        $type = $request->input('type');
        //ngambil product berdasarkan price terendah
        $price_from = $request->input('price_from');
        //ngambil product berdasarkan price tertinggi
        $price_to = $request->input('price_to');


        //fungsi ngambil data ke respon formatter


        //mencari dengan id dengan relasi galleries
        if ($id) {
            $product = Product::with('galleries')->find($id);

            if ($product)
                //jika data product nya ada maka akan di munculkan ke respon formatter succes 
                return ResponseFormatter::success($product, 'Data Produk Berhasil Di Ambil');

            else
                //jika data product nya tidak ada maka akan di munculkan ke respon formatter error 
                return ResponseFormatter::error(null, 'Data Produk Tidak Ada', 404);
        }
        //mencari dengan slug dengan relasi galleries
        if ($slug) {
            $product = Product::with('galleries')
                ->where('slug', $slug)
                ->first();
            if ($product)
                //jika data product nya ada maka akan di munculkan ke respon formatter succes 
                return ResponseFormatter::success($product, 'Data Produk Berhasil Di Ambil');

            else
                //jika data product nya tidak ada maka akan di munculkan ke respon formatter error 
                return ResponseFormatter::error(null, 'Data Produk Tidak Ada', 404);
        }


        //mencari product berdaskan nama dll

        $product = Product::with('galleries');

        if ($name)
            $product->where('name', 'like', '%' . $name . '%');

        if ($type)
            $product->where('type', 'like', '%' . $type . '%');

        if ($price_from)
            $product->where('price', '>=', $price_from);

        if ($price_to)
            $product->where('price', '<=',  $price_to);


        return ResponseFormatter::success(
            //paginate misal kita ingin melihat halaman pertama/kedua dll di api
            $product->paginate($limit),
            'Data list product berhasil di ambil'
        );
    }
}