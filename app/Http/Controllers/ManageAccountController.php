<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ManageAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(request('search'));
        if(request('search'))
        {
            // $comp = User::select(DB::raw("CONCAT('firstname','lastname') AS display_name"),'id')->get()->pluck('display_name','id');
            // $comp = User::select(DB::raw("CONCAT('firstname','lastname') AS complete_name"))->get();
            // dd($comp);
            $search = User::where(DB::raw("CONCAT(firstname,' ',lastname)"), 'like', '%' . request('search') . '%')->get();
            // dd($search);
        }
        else
        {
            $search = User::all();
        }

        if(auth()->user()->user_position === 'superadmin_distributor')
        {
            return view('manage_account.index', ['users' => User::where('id_input',auth()->user()->id)->get()]);
        }
        else
        {
            return view('manage_account.index', ['users' => $search->whereIn('user_position', ['superadmin_pabrik', 'accounting_pabrik', 'cashier_pabrik', 'superadmin_distributor'])], ['superadmins' => User::where('user_position', 'superadmin_pabrik')->get()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage_account.create', ['user' => auth()->user()], ['provinces' => Province::all()]);
    }
    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where('province_id',$request->province_id)->get(["id", "name"]);
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->user_position === "superadmin_distributor")
        {
            $validateData = $request->validate([
                'user_position' => 'required',
                'username' => 'required|min:3|max:255|unique:users',
                'image' => 'image|file|max:1024',
                'firstname' => 'required|max:255',
                'lastname' => 'required|max:255',
                'ktp' => 'required',
                'email' => 'required|email:dns|unique:users',
                'province_id' => 'required',
                'city_id' => 'required',
                'address' => 'required',
                'postcode' => 'required',
            ]);
            $validateData['id_group'] = auth()->user()->id_group;        

        }
        else
        {   
            $validateData = $request->validate([
                'user_position' => 'required',
                'username' => 'required|min:3|max:255|unique:users',
                'image' => 'image|file|max:1024',
                'firstname' => 'required|max:255',
                'lastname' => 'required|max:255',
                'ktp' => 'required',
                'email' => 'required|email:dns|unique:users',
                'province_id' => 'required',
                'city_id' => 'required',
                'address' => 'required',
                'postcode' => 'required',
            ]);

            if($validateData['user_position'] == "superadmin_pabrik")
            {
                $validateData['id_group'] = auth()->user()->id_group;        
            }
            else
            {
                $validateData['id_group'] = $validateData['username'];        
            }

            if($validateData['user_position'] == "superadmin_distributor")
            {
                $validateData['cluster'] = $request->cluster;
            }
        }

        if($request->file('image'))
        {
            $validateData['image'] = $request->file('image')->store('manage_account/users');
        }

        $validateData['password'] = Hash::make($request->password);

        $validateData['id_input'] = auth()->user()->id;

        if(!$request->password)
        {
            $validateData['password'] = Hash::make("12345");
        }

        if($request->tokopedia){
            $validateData['tokopedia'] = $request->tokopedialink;
        }
        if($request->shopee){
            $validateData['shopee'] = $request->shopeelink;
        }
        if($request->lazada){
            $validateData['lazada'] = $request->lazadalink;
        }
        if($request->bukalapak){
            $validateData['bukalapak'] = $request->bukalapaklink;
        }
        if($request->blibli){
            $validateData['blibli'] = $request->bliblilink;
        }

        User::create($validateData);
        return redirect('/manage_account/users')->with('success', 'Penambahan pegawai berhasil!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('manage_account.edit', ['user' => $user], ['provinces' => Province::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if(auth()->user()->user_position === "superadmin_distributor")
        {
            $validateData = $request->validate([
                'user_position' => 'required',
                // 'username' => 'required|min:3|max:255|unique:users',
                'image' => 'image|file|max:1024',
                'firstname' => 'required|max:255',
                'lastname' => 'required|max:255',
                'ktp' => 'required',
                'province_id' => 'required',
                'city_id' => 'required',
                'address' => 'required',
                'postcode' => 'required',
                // 'email' => 'required|email:dns|unique:users',
            ]);
            // $validateData['id_group'] = auth()->user()->id_group;        

        }
        else
        {   
            $validateData = $request->validate([
                'user_position' => 'required',
                // 'username' => 'required|min:3|max:255|unique:users',
                'image' => 'image|file|max:1024',
                'firstname' => 'required|max:255',
                'lastname' => 'required|max:255',
                'ktp' => 'required',
                'province_id' => 'required',
                'city_id' => 'required',
                'address' => 'required',
                'postcode' => 'required',
                // 'email' => 'required|email:dns|unique:users',
            ]);

            // if($validateData['user_position'] == "superadmin_pabrik")
            // {
            //     $validateData['id_group'] = auth()->user()->id_group;        
            // }
            // else
            // {
            //     $validateData['id_group'] = $validateData['username'];        
            // }

            if($validateData['user_position'] == "superadmin_distributor")
            {
                $validateData['cluster'] = $request->cluster;
            }
        }

        if($request->username != $user->username) {
            $validateData['username'] = 'required|min:3|max:255|unique:users';
        }

        if($request->email != $user->email) {
            $validateData['email'] = 'required|email:dns|unique:users';
        }

        

        // $valid = $request->validate($validateData);

        if($request->file('image')) {
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            // kalo ada gambar baru = hapus gambar lama lalu upload yg baru
            $validateData['image'] = $request->file('image')->store('manage_account/users');
        }

        

        $validateData['id_input'] = auth()->user()->id;

        if($request->password)
        {
            $validateData['password'] = Hash::make($request->password);
            // $validateData['password'] = Hash::make("12345");
        }

        if($request->tokopedia){
            $validateData['tokopedia'] = $request->tokopedialink;
        }
        else{
            $validateData['tokopedia'] = null;
        }

        if($request->shopee){
            $validateData['shopee'] = $request->shopeelink;
        }
        else{
            $validateData['shopee'] = null;
        }

        if($request->lazada){
            $validateData['lazada'] = $request->lazadalink;
        }
        else{
            $validateData['lazada'] = null;
        }

        if($request->bukalapak){
            $validateData['bukalapak'] = $request->bukalapaklink;
        }
        else{
            $validateData['bukalapak'] = null;
        }

        if($request->blibli){
            $validateData['blibli'] = $request->bliblilink;
        }
        else{
            $validateData['blibli'] = null;
        }


        User::where('id', $user->id)
            ->update($validateData);

        return redirect('/manage_account/users')->with('success', 'Post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // dd($user);
        if($user->image){
            Storage::delete($user->image);
        }

        User::destroy($user->id);

        return redirect('/manage_account/users')->with('success', 'User has been deleted!');
    }
}
