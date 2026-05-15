<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderPhoto;

class OrderPhotoController extends Controller
{
    public function store(Request $request, $orderId)
    {
        $request->validate([

            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'photo_url' => 'nullable|url',

            'photo_type' => 'required|in:loaded,unloaded'

        ]);


        $order = Order::findOrFail($orderId);


        /*
        |--------------------------------------------------------------------------
        | DETERMINE IMAGE SOURCE
        |--------------------------------------------------------------------------
        */

        $path = null;


        // Uploaded local file
        if ($request->hasFile('photo')) {

            $path = $request
                ->file('photo')
                ->store('order_photos', 'public');

        }

        // External URL
        elseif ($request->photo_url) {

            $path = $request->photo_url;

        }

        // Nothing uploaded
        else {

            return back()->with(
                'error',
                'Please upload a photo or provide an image URL.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | SAVE PHOTO RECORD
        |--------------------------------------------------------------------------
        */

        OrderPhoto::create([

            'order_id' => $order->id,

            'photo_path' => $path,

            'photo_type' => $request->photo_type,

            'uploaded_by' => Auth::id()

        ]);


        /*
        |--------------------------------------------------------------------------
        | SUCCESS MESSAGE
        |--------------------------------------------------------------------------
        */

        return back()->with(
            'success',
            'Evidence uploaded successfully.'
        );
    }
}