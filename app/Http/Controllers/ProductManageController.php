<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductHistory;
use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Models\User;

class ProductManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(ProductHistory::groupBy('kode_pasok')->get());
        
        // return view('manage_product.index', ['histories_group' => ProductHistory::groupBy('kode_pasok')->get()], ['superadmins' => User::where('user_position', 'superadmin_pabrik')->get()]);
        
        // dd(ProductHistory::groupBy('kode_pasok')->select('product_histories.*')->selectRaw('sum(jumlah*harga_beli) as total')->get());
        return view('manage_product.index', ['histories_group' => ProductHistory::groupBy('kode_pasok')->select('product_histories.*')->selectRaw('sum(jumlah*harga_beli) as total')->get()], ['superadmins' => User::where('user_position', 'superadmin_pabrik')->get()]);
    }

    public function indexPusat()
    {
        return view('manage_product.index_pusat', ['products' => Product::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage_product.create', ['types' => ProductType::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);

        $validateData = $request->validate([
            'kode_pasok' => 'required',
            'surat_jalan' => 'required',
            'tanggal_surat' => 'required',
        ]);
        
        $validateData['nama_supplier'] = 'pabrik astana';
        $validateData['tanggal_surat'] = date('Y-m-d', strtotime($request->input('tanggal_surat')));
        $validateData['admin_id'] = auth()->user()->id;
        // dd($validateData);

        for ($i = 1; $i <= 5; $i++)
        {
            if($request->input("check".$i) && $request->input("jumlah".$i) && $request->input("harga_beli".$i))
            {
                $validateData['product_type_id'] = $i;
                $validateData['jumlah'] = (int)$request->input("jumlah".$i);
                $validateData['harga_beli'] = (int)$request->input("harga_beli".$i);
                // dd($validateData);
                
                ProductHistory::create($validateData);

                $stok = Product::where('id', $i)->first();
                // dd($stok->stok);
                $updateStok = $stok->stok + $validateData['jumlah'];
                Product::where('id', $i)->update(array('stok' => $updateStok));
            }
        }

        return redirect('/manage_product/products')->with('success', 'Penambahan pasok berhasil!!');

        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // dd(ProductHistory::where('product_type_id',$product->product_type_id)->get());
        return view('manage_product.detail_pusat', ['masuk' => ProductHistory::where('product_type_id',$product->product_type_id)->get()], ['superadmins' => User::where('user_position', 'superadmin_pabrik')->get()]);
    }

    public function detailPasok($kode_pasok)
    {
        // dd($kode_pasok);
        // dd(ProductHistory::where('kode_pasok',$kode_pasok)->get());
        return view('manage_product.detail', ['details' => ProductHistory::where('kode_pasok',$kode_pasok)->get()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
