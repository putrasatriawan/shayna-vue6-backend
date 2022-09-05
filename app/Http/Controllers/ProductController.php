<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\ProductGallery;
use Illuminate\Support\Str;

// str adalah fungsi support string yang di bawa oleh laravel

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // penjelasan items : $items adalah variable untuk item product dan sintax Product::all(); gunanya untuk memanggil seluruh data product

        $items = Product::all();
        return view('pages.products.index')->with([
            'items' => $items
            //gunanya with adalah sintax pemanggil data yang di atas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        // sintax di bawah yaitu mengambil semua request yang ada di productrequest
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        //gunanya slug yaitu untuk mengubah link yang seperti ini Zara Basic jadi zara-basic
        Product::create($data);
        return redirect()->route('products.index');
        //sintax dimana setelah tambah produk akan di redirect ke view product.index 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Product::findOrFail($id);

        return view('pages.products.edit')->with([
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        // sintax di bawah yaitu mengambil semua request yang ada di productrequest
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        //gunanya slug yaitu untuk mengubah link yang seperti ini Zara Basic jadi zara-basic
        $item = Product::findOrFail($id);
        $item->update($data);
        return redirect()->route('products.index');
        //sintax dimana setelah tambah produk akan di redirect ke view product.index 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Product::findOrFail($id);
        $item->delete();

        ProductGallery::where('products_id', $id)->delete();

        return redirect()->route('products.index');
    }

    //function melihat foto product dari list product

    public function  gallery(Request $request, $id)
    //$id kenapa karena ingin mengambil galeri berdasarkan product nya
    {
        $product = Product::findorFail($id);
        //mengecek product nya ada atau engga, kalau engga 404

        $items = ProductGallery::with('product')
            ->where('products_id', $id)
            ->get();

        return view('pages.products.gallery')->with([
            'product' => $product,
            'items' => $items,
        ]);
    }
}