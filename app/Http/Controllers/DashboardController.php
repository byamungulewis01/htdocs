<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\marital;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        return $this->middleware('adminauth');
    }

    public function index()
    {
        $active_adv = User::where('practicing',2)->where('status',1)->count();
        $inactive_adv = User::where('practicing',3)->where('status',1)->count();
        $suspended_adv = User::where('practicing',4)->where('status',1)->count();
        $struckOff_adv = User::where('practicing',5)->where('status',1)->count();
        $deceased_adv = User::where('practicing',6)->where('status',1)->count();

        $active_intern = User::where('practicing',2)->where('status',2)->count();
        $inactive_intern = User::where('practicing',3)->where('status',2)->count();
        $suspended_intern = User::where('practicing',4)->where('status',2)->count();
        $struckOff_intern = User::where('practicing',5)->where('status',2)->count();
        $deceased_intern = User::where('practicing',6)->where('status',2)->count();
        
        return view('dashboards.admin',compact('active_adv','inactive_adv','suspended_adv','struckOff_adv','deceased_adv','active_intern','inactive_intern','suspended_intern','struckOff_intern','deceased_intern'));
    }
    
}
