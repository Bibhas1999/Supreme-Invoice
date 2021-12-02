<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\InvoiceDetails;
use App\Model\Invoice;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {  if (Auth::check()) {

        $today = date('Y-m-d');
        $allData = InvoiceDetails::where('date',$today)->limit(6)->get();
        return view('backend.layouts.home',compact('allData'));
    }
        return redirect()->route('login');
    }
}
