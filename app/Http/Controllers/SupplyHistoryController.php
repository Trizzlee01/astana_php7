<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use App\Models\SupplyHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class SupplyHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(SupplyHistory::join('products', 'products.id', '=', 'supply_histories.id_product')->groupBy('kode_pasok')->select('supply_histories.*')->selectRaw('sum(jumlah*harga_modal) as total')->get());
        return view('manage_product.input_supply.index', ['histories_group' => SupplyHistory::join('products', 'products.id', '=', 'supply_histories.id_product')->groupBy('kode_pasok')->select('supply_histories.*')->selectRaw('sum(jumlah*harga_modal) as total')->get()], ['superadmins' => User::where('user_position', 'superadmin_pabrik')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(Product::where('id_group',auth()->user()->id_group)->get());
        return view('manage_product.input_supply.create', ['products' => Product::where('id_group',auth()->user()->id_group)->get()], ['types' => ProductType::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(count($request->all()));

        $validateData = $request->validate([
            'kode_pasok' => 'required',
            'surat_jalan' => 'required',
        ]);
        
        $validateData['nama_supplier'] = 'pabrik astana';
        $validateData['id_input'] = auth()->user()->id;
        $validateData['nama_input'] = auth()->user()->firstname . " " . auth()->user()->lastname;

        $length = (count($request->all()) - 3) / 3;

        // dd($length);
        for ($i = 1; $i <= $length; $i++)
        {
            if($request->input("id_product".$i) && $request->input("jumlah".$i))
            {
                $produk = Product::where('id', $request->input("id_product".$i))->first();
                // dd($produk->product_type->nama_produk);
                $validateData['id_product'] = $produk->id;
                $validateData['jumlah'] = (int)$request->input("jumlah".$i);
                // $validateData['harga_beli'] = (int)$request->input("harga_beli".$i);
                
                SupplyHistory::create($validateData);

                $stok = Product::where('id', $request->input("id_product".$i))->first();
                $updateStok = $stok->stok + $validateData['jumlah'];
                Product::where('id', $request->input("id_product".$i))->update(array('stok' => $updateStok));
                if($updateStok > 0)
                {
                    $keteranganStok = 'Tersedia';
                }
                else
                {
                    $keteranganStok = 'Kosong';
                }
                Product::where('id', $request->input("id_product".$i))->update(array('keterangan' => $keteranganStok));
                
            }
        }

        Session::flash('create_success', 'Input pasok berhasil ditambahkan');
        return redirect('/manage_product/input_pasok/supplyhistories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupplyHistory  $supplyHistory
     * @return \Illuminate\Http\Response
     */
    public function show(SupplyHistory $supplyHistory)
    {
        // dd($supplyHistory);
    }

    public function detail($kode_pasok)
    {
        // dd($kode_pasok);
        return view('manage_product.input_supply.detail', ['details' => SupplyHistory::where('kode_pasok',$kode_pasok)->get()]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupplyHistory  $supplyHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(SupplyHistory $supplyHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SupplyHistory  $supplyHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupplyHistory $supplyHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupplyHistory  $supplyHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupplyHistory $supplyHistory)
    {
        //
    }
}
