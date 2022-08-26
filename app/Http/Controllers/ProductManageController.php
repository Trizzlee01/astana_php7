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
        // dd(Product::join('users', 'users.id', '=', 'products.id_owner')->where('id_group', auth()->user()->id_group)->where('user_position', auth()->user()->user_position)->get());
        
        // untuk user superadmin_pabrik, superadmin_distributor, reseller
        // dd(Product::join('users', 'users.id', '=', 'products.id_owner')->where('products.id_group', auth()->user()->id_group)->where('user_position', auth()->user()->user_position)->get());
        if(auth()->user()->user_position == "superadmin_pabrik" || auth()->user()->user_position == "superadmin_distributor")
        {
            return view('manage_product.main.index', ['products' => Product::join('users', 'users.id', '=', 'products.id_owner')->where('products.id_group', auth()->user()->id_group)->where('user_position', auth()->user()->user_position)->select('products.*')->get()]);
        }
        else if(auth()->user()->user_position == "reseller")
        {
            return view('manage_product.main.index', ['products' => Product::join('users', 'users.id', '=', 'products.id_owner')->where('products.id_owner', auth()->user()->id)->select('products.*')->get()]);
        }
    }

    public function indexSecond()
    {
        if(auth()->user()->user_position == "superadmin_pabrik")
        {
            // dd(Product::join('users', 'users.id', '=', 'products.id_owner')->where('products.id_group', '!=', auth()->user()->id_group)->where('users.user_position', "superadmin_distributor")->orderBy('products.id_group', 'ASC')->orderBy('products.id_productType', 'ASC')->get());
            return view('manage_product.second.index', ['products' => Product::join('users', 'users.id', '=', 'products.id_owner')->where('products.id_group', '!=', auth()->user()->id_group)->where('users.user_position', "superadmin_distributor")->orderBy('products.id_group', 'ASC')->orderBy('products.id_productType', 'ASC')->select('products.*')->get()]);
        }
        else if(auth()->user()->user_position == "superadmin_distributor")
        {
            return view('manage_product.second.index', ['products' => Product::join('users', 'users.id', '=', 'products.id_owner')->where('products.id_group', auth()->user()->id_group)->where('users.user_position', "reseller")->orderBy('products.id_owner', 'ASC')->orderBy('products.id_productType', 'ASC')->select('products.*')->get()]);
        }
        else
        {
            return back();
        }
        // return view('manage_product.second.index', ['products' => Product::where('id_group', '!=', auth()->user()->id_group)->orderBy('id_group', 'ASC')->orderBy('id_productType', 'ASC')->get()]);

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
                $newProduct['id_productType'] = ProductType::latest()->first()->id;
                $newProduct['id_group'] = $group->id_group;

                $owner = User::where('id_group', $group->id_group)->first();
                $newProduct['id_owner'] = $owner->id;

// CREATE NEW PRODUCT PUSAT
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
// CREATE NEW PRODUCT DISTRIBUTOR, HARGA MODAL = HARGA JUAL PUSAT
                else if($owner->user_position == "superadmin_distributor")
                {
                    $newProduct['stok'] = 0;
                    $newProduct['harga_jual'] = 0;
                    $newProduct['harga_modal'] = $request->harga_jual;
                    $newProduct['keterangan'] = 'Kosong';

                    
                }

                Product::create($newProduct);

                $resellers = User::where('id_group', $owner->id_group)->where('user_position', 'reseller')->get();
                // dd($resellers);

// CREATE NEW PRODUCT RESELLER, HARGA MODAL = 0
                foreach($resellers as $reseller)
                {
                    $newProductReseller['id_productType'] = ProductType::latest()->first()->id;
                    $newProductReseller['id_group'] = $owner->id_group;
                    $newProductReseller['id_owner'] = $reseller->id;
                    $newProductReseller['stok'] = 0;
                    $newProductReseller['harga_jual'] = 0;
                    $newProductReseller['harga_modal'] = 0;
                    $newProductReseller['keterangan'] = 'Kosong';

                    Product::create($newProductReseller);
                }
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


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // dd(User::where('user_position', 'superadmin_pabrik')->get());

        // return view('manage_product.main.detail', ['product' => $product], ['masuk' => SupplyHistory::where('id_product',$product->id)->get()], ['superadmins' => User::where('user_position', 'superadmin_pabrik')->get()]);
        
        $masuk = SupplyHistory::where('id_product',$product->id)->get();
        $superadmins = User::where('user_position', 'superadmin_pabrik')->get();
        return view('manage_product.main.detail', compact(['product', 'masuk', 'superadmins']));
    }

   

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

    public function editSecond($product)
    {
        // dd($product);
        return view('manage_product.second.edit', ['product' => Product::where('id', $product)->first()]);
    }

    // public function editPusat(Product $product)
    // {
    //     // dd("a");
    //     return view('manage_product.edit_pusat', ['product' => $product]);
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
        if(auth()->user()->user_position == "superadmin_pabrik")
        {
            $checkType = ProductType::where('kode_produk', $request->kode_produk)->count();
            if($request->kode_produk == $product->product_type->kode_produk)
            {
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
    
// PERUBAHAN HARGA JUAL PUSAT -> HARGA MODAL DISTRIBUTOR BERUBAH
                if(Product::where('id', $product->id)->first()->harga_jual != $validateData['harga_jual'])
                {
                    // dd("perubahan harga jual");
                    $productDistributors = Product::join('users', 'users.id', '=', 'products.id_owner')->where('id_productType', $product->id_productType)->where('users.user_position', 'superadmin_distributor')->select('products.*')->get();
                    // dd($productDistributor);
                    foreach($productDistributors as $productDistributor)
                    {
                        $productDistributor->update(array('harga_modal' => $validateData['harga_jual']));
                    }
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
        else if(auth()->user()->user_position == "superadmin_distributor")
        {
            // dd("edit distributor");
            $validateData['harga_jual'] = $request->harga_jual;
// PERUBAHAN HARGA JUAL DISTRIBUTOR -> HARGA MODAL RESELLER BERUBAH
            if(Product::where('id', $product->id)->first()->harga_jual != $validateData['harga_jual'])
            {
                // dd("perubahan harga jual");
                $productDistributor = Product::where('id', $product->id)->first();
                $productResellers = Product::join('users', 'users.id', '=', 'products.id_owner')->where('products.id_group', $productDistributor->id_group)->where('id_productType', $product->id_productType)->where('users.user_position', 'reseller')->select('products.*')->get();
                // dd($productDistributor);
                foreach($productResellers as $productReseller)
                {
                    $productReseller->update(array('harga_modal' => $validateData['harga_jual']));
                }
            }
            Product::where('id', $product->id)->update($validateData);
            Session::flash('update_success', 'Barang berhasil diedit');
            return redirect('/manage_product/products');
        }
        else if(auth()->user()->user_position == "reseller")
        {
            // dd("reseller");
            $validateData['harga_jual'] = $request->harga_jual;
            Product::where('id', $product->id)->update($validateData);
            Session::flash('update_success', 'Barang berhasil diedit');
            return redirect('/manage_product/products');
        }

        return back();
    }

    public function updateSecond(Request $request, $product)
    {
        // dd($product);

        if(auth()->user()->user_position == "superadmin_pabrik")
        {
            $validateData['stok'] = (int)$request->input("stok");
            $validateData['harga_jual'] = (int)$request->input("harga_jual");
            $validateData['keterangan'] = $request->keterangan;
    
            if($request->stok == null || $request->stok == 0)
            {
                $validateData['keterangan'] = 'Kosong';
            }
            else
            {
                $validateData['keterangan'] = 'Tersedia';
            }
    
    
// PERUBAHAN HARGA JUAL DISTRIBUTOR -> HARGA MODAL RESELLER BERUBAH
            if(Product::where('id', $product)->first()->harga_jual != $validateData['harga_jual'])
            {
                // dd("perubahan harga jual");
                $productDistributor = Product::where('id', $product)->first();
                $productResellers = Product::join('users', 'users.id', '=', 'products.id_owner')->where('products.id_group',$productDistributor->id_group)->where('id_productType', $productDistributor->id_productType)->where('users.user_position', 'reseller')->select('products.*')->get();
                // dd($productResellers);
                foreach($productResellers as $productReseller)
                {
                    $productReseller->update(array('harga_modal' => $validateData['harga_jual']));
                }
            }
    
            Product::where('id', $product)->update($validateData);
    
            Session::flash('update_success', 'Barang distributor berhasil diedit');
            return redirect('/manage_product/distributor/products');
        }
        else if (auth()->user()->user_position == "superadmin_distributor")
        {
            // dd("edit reseller");
            $validateData['stok'] = (int)$request->input("stok");
            $validateData['harga_jual'] = (int)$request->input("harga_jual");
            $validateData['keterangan'] = $request->keterangan;
    
            if($request->stok == null || $request->stok == 0)
            {
                $validateData['keterangan'] = 'Kosong';
            }
            else
            {
                $validateData['keterangan'] = 'Tersedia';
            }

            Product::where('id', $product)->update($validateData);
            Session::flash('update_success', 'Barang reseller berhasil diedit');
            return redirect('/manage_product/reseller/products');
        }
        return back();
        
    }

    // public function updatePusat(Request $request, Product $product)
    // {
    //     // dd($request, $product);

    //     $validateData['stok'] = (int)$request->input("stok");
    //     $validateData['harga_jual'] = (int)$request->input("harga_jual");
    //     $validateData['harga_modal'] = (int)$request->input("harga_modal");
    //     $validateData['keterangan'] = $request->keterangan;
        

    //     Product::where('id', $product->id)->update($validateData);

    //     ProductType::where('id', $product->product_type_id)->update(array('nama_produk' => $request->nama_produk));
        
    //     return redirect('/manage_product/pusat');
    // }

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
