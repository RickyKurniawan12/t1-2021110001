<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
        $products = Product::all();
        $totalQuantity = Product::sum('quantity');
        $cheapestProduct = Product::orderBy('retail_price', 'asc')->first();
        $mostSoldProduct = Product::orderBy('quantity', 'desc')->first();
        return view('products.index', compact('products', 'totalQuantity', 'cheapestProduct', 'mostSoldProduct'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dump($request->all());
        $validated = $request->validate([
            'id'=> 'required|string|max:12',
            'product_name' => 'required',
            'description' => 'required',
            'retail_price' => 'required|numeric',
            'wholesale_price' => 'required|numeric',
            'origin' => 'required|max:2',
            'quantity' => 'required|numeric',
            'product_image' => 'nullable|image',
        ]);

        if($request->hasFile('product_image')){
            $request->validate([
                'product_image'=> 'image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            ]);
            $imagePath = $request->file('product_image')->storePublicly('public/image');
            $validated['product_image'] = $imagePath;
        }

        Product::create([
            'id' => $validated ['id'],
            'product_name' => $validated ['product_name'],
            'description' => $validated['description'],
            'retail_price' => $validated['retail_price'],
            'wholesale_price' => $validated['wholesale_price'],
            'origin' => $validated['origin'],
            'quantity' => $validated ['quantity'],
       ]);

       return redirect()->route('products.index')->with('success','Product added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $products)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $products)
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $products)
        {
            $validated = $request->validate([
                'id' => 'required|string|max:12',
                'product_name' => 'required',
                'description' => 'required',
                'retail_price' => 'required|numeric',
                'wholesale_price' => 'required|numeric',
                'origin' => 'required|max:2',
                'quantity' => 'required|numeric',
                'product_image' => 'nullable|image',
            ]);
    
                if($request->hasFile('product_image')){
                    $request->validate([
                        'product_image'=> 'image|mimes:jpeg,jpg,png,gif,svg|max:2048',
                    ]);

                    $imagePath = $request->file('prduct_image')->storePublicly('public/image');

                    // hapus file existing
                    if($products->product_image){
                        Storage::delete($products->avatar);
                    }

                    $validated['product_image'] = $imagePath;
                }
        
        $products->update([
            'id' => $validated ['id'],
            'product_name' => $validated ['product_name'],
            'description' => $validated['description'],
            'retail_price' => $validated['retail_price'],
            'wholesale_price' => $validated['wholesale_price'],
            'origin' => $validated['origin'],
            'quantity' => $validated ['quantity'],
            'product_image'=> $validated['product_image']?? $products->product_image,
        ]);
        
            return redirect()->route('products.index')->with('success','product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $products)
    {
        if($products->avatar){
            Storage::delete($products->avatar);
        }
        $products->delete();
        return redirect()->route('products.index')->with('success','product deleted successfully');
    }
}
