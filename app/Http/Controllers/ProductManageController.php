<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductHistory;
use App\Models\ProductType;
use App\Models\SupplyHistory;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class ProductManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(auth()->user()->group->nama_group);
        // if(auth()->user()->group->nama_group == 'pusat')
        // {
        //     return view('manage_product.main.index', ['products' => Product::where('id_group', auth()->user()->id_group)->get()]);
        // }
        return view('manage_product.main.index', ['products' => Product::where('id_group', auth()->user()->id_group)->get()]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->group->nama_group == 'pusat')
        {
            return view('manage_product.main.create', ['types' => ProductType::all()]);
        }
        return back();
        // return view('manage_product.create', ['types' => ProductType::all()]);
    }

    // public function createType()
    // {
    //     return view('manage_product.create_type');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // dd("a");
        
        // dd($request);
        $checkType = ProductType::where('kode_produk', $request->kode_produk)->count();
        
        if($checkType == 0)
        {
            $newType['kode_produk'] = $request->kode_produk;
            $newType['nama_produk'] = $request->nama_produk;
    
            ProductType::create($newType);

            $groups = Product::groupBy('id_group')->get();
            foreach($groups as $group)
            {
                $newProduct['id_productType'] = ProductType::latest()->first()->id;;
                $newProduct['id_group'] = $group->id_group;
                if($group->group->nama_group == "pusat")
                {
                    $newProduct['stok'] = $request->stok;
                    $newProduct['harga_jual'] = $request->harga_jual;
                    $newProduct['harga_modal'] = $request->harga_modal;
                    if($request->stok == null || $request->stok == 0)
                    {
                        $newProduct['keterangan'] = 'Kosong';
                    }
                    else
                    {
                        $newProduct['keterangan'] = 'Tersedia';
                    }
                }
                else
                {
                    $newProduct['stok'] = 0;
                    $newProduct['harga_jual'] = 0;
                    $newProduct['harga_modal'] = 0;
                    $newProduct['keterangan'] = 'Kosong';
                }

                Product::create($newProduct);
                // Session::flash('create_failed', 'Berhasil'); 

            }
            // Session::flash('create_failed', 'aaaa'); 
            Session::flash('create_success', 'Barang baru berhasil ditambahkan');
            return redirect('/manage_product/products');
        }
        else
        {
            Session::flash('create_failed', 'Kode barang telah digunakan'); 
            return back();
        }
        
        
    }

    // public function storeHistory(Request $request)
    // {
    //     $validateData = $request->validate([
    //         'kode_pasok' => 'required',
    //         'surat_jalan' => 'required',
    //         'tanggal_surat' => 'required',
    //     ]);
        
    //     $validateData['nama_supplier'] = 'pabrik astana';
    //     $validateData['tanggal_surat'] = date('Y-m-d', strtotime($request->input('tanggal_surat')));
    //     $validateData['admin_id'] = auth()->user()->id;

    //     for ($i = 1; $i <= 5; $i++)
    //     {
    //         if($request->input("check".$i) && $request->input("jumlah".$i) && $request->input("harga_beli".$i))
    //         {
    //             $validateData['product_type_id'] = $i;
    //             $validateData['jumlah'] = (int)$request->input("jumlah".$i);
    //             $validateData['harga_beli'] = (int)$request->input("harga_beli".$i);
                
    //             ProductHistory::create($validateData);

    //             $stok = Product::where('id', $i)->first();
    //             $updateStok = $stok->stok + $validateData['jumlah'];
    //             Product::where('id', $i)->update(array('stok' => $updateStok));
    //         }
    //     }

    //     return redirect('/manage_product/products')->with('success', 'Penambahan pasok berhasil!!');
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // dd(ProductHistory::where('product_type_id',$product->product_type_id)->get());
        return view('manage_product.main.detail', ['masuk' => SupplyHistory::where('id_product',$product->id)->get()], ['superadmins' => User::where('user_position', 'superadmin_pabrik')->get()]);
    }

    // public function detailPasok($kode_pasok)
    // {
    //     // dd($kode_pasok);
    //     // dd(ProductHistory::where('kode_pasok',$kode_pasok)->get());
    //     return view('manage_product.detail', ['details' => ProductHistory::where('kode_pasok',$kode_pasok)->get()]);
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        // dd("a");
        return view('manage_product.main.edit', ['product' => $product]);
    }

    public function editPusat(Product $product)
    {
        // dd("a");
        return view('manage_product.edit_pusat', ['product' => $product]);
    }

    // public function editPusat($id_product)
    // {
    //     return view('manage_product.edit_pusat', [Product::where('id', $id_product)]);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // dd($request);
        $checkType = ProductType::where('kode_produk', $request->kode_produk)->count();
        // dd($request->kode_produk);
        // dd($product->product_type->kode_produk);
        if($request->kode_produk == $product->product_type->kode_produk)
        {
            // dd("masuk");
            $checkType = 0;
        }
        if($checkType == 0)
        {
            $validateData['stok'] = (int)$request->input("stok");
            $validateData['harga_jual'] = (int)$request->input("harga_jual");
            $validateData['harga_modal'] = (int)$request->input("harga_modal");
            $validateData['keterangan'] = $request->keterangan;
            
            if($request->stok == null || $request->stok == 0)
            {
                $validateData['keterangan'] = 'Kosong';
            }
            else
            {
                $validateData['keterangan'] = 'Tersedia';
            }
    
            Product::where('id', $product->id)->update($validateData);
    
            ProductType::where('id', $product->id_productType)->update(array('nama_produk' => $request->nama_produk));
            ProductType::where('id', $product->id_productType)->update(array('kode_produk' => $request->kode_produk));
            
            Session::flash('update_success', 'Barang berhasil diedit');
            return redirect('/manage_product/products');
        }
        Session::flash('update_failed', 'Kode barang telah digunakan'); 
        return back();
    }

    public function updatePusat(Request $request, Product $product)
    {
        // dd($request, $product);

        $validateData['stok'] = (int)$request->input("stok");
        $validateData['harga_jual'] = (int)$request->input("harga_jual");
        $validateData['harga_modal'] = (int)$request->input("harga_modal");
        $validateData['keterangan'] = $request->keterangan;
        

        Product::where('id', $product->id)->update($validateData);

        ProductType::where('id', $product->product_type_id)->update(array('nama_produk' => $request->nama_produk));
        
        return redirect('/manage_product/pusat');
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
