<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardManageController extends Controller
{
    public function viewDashboard()
    {
        if(auth()->user()->user_position == "superadmin_pabrik")
        {
            $distributors = User::where('user_position', 'superadmin_distributor')->get();
            // $resellers = User::join('products', 'products.id_owner', '=', 'users.id')->where('users.id_group', $distributor->id_group)->where('user_position', 'reseller')->groupBy('products.id_owner')->select('users.*')->selectRaw('sum(stok) as stock')->get();

            return view('dashboard', compact('distributors'));
        }
    }


}
