<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    /*
    public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function search(Request $request)
    {
        $request->validate([
            'invoice_number' => 'required|string'
        ]);

        $order = Order::with('photos')
            ->where('invoice_number', $request->invoice_number)
            ->first();

        return view('home', compact('order'));
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
