<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardManageController extends Controller
{
    public function viewDashboard()
    {
        return view('dashboard');
    }
}
