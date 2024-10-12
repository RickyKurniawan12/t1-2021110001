<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $product_name = 'Jeruk';

        return view('resource', compact('product_name'));
    }
    public function getProducts($id , $serial_number = -1)
    {
        // if($id <0){
        //     abort(404);
        // }
        return view('product-detail',compact('id','serial_number'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:10'
        ]);


        return $request->product_name;
    }
}
