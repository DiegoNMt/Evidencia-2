<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\OrderPhoto;

class OrderPhotoController extends Controller
{
    public function store(Request $request, $orderId)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'photo_type' => 'required|in:loaded,unloaded'
        ]);

        $order = Order::findOrFail($orderId);

        $path = $request->file('photo')->store('order_photos', 'public');

        OrderPhoto::create([
            'order_id' => $order->id,
            'photo_path' => $path,
            'photo_type' => $request->photo_type,
            'uploaded_by' => Auth::id()
        ]);

        return back()->with('success', 'Photo uploaded successfully.');
    }
}
