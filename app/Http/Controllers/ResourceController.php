<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
    $validated = $request->validate([
        'id'=> 'required|string|max:12',
        'product_name' => 'required|string|max:255',
        'description' => 'nullable|string',
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
        $imagePath = $request->file('product_image')->store('images'); // Update this line
        $validated['product_image'] = $imagePath;
    }

    Product::create([
        'id' => $validated['id'],
        'product_name' => $validated['product_name'],
        'description' => $validated['description'],
        'retail_price' => $validated['retail_price'],
        'wholesale_price' => $validated['wholesale_price'],
        'origin' => $validated['origin'],
        'quantity' => $validated['quantity'],
        'product_image' => $validated['product_image'] ?? null, // Add this line
    ]);

    
   Log::info('Product created: ', [$validated['product_name']]);

    return redirect()->route('products.index')->with('success', 'Product added successfully');
}

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
{
    $validated = $request->validate([
        'product_name' => 'required|string|max:255',
        'description' => 'required|string',
        'retail_price' => 'required|numeric',
        'wholesale_price' => 'required|numeric',
        'origin' => 'required|max:2',
        'quantity' => 'required|numeric',
        'product_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
    ]);

    // Handle file upload
    if ($request->hasFile('product_image')) {
        // Delete the existing image if it exists
        if ($product->product_image) {
            Storage::delete($product->product_image);
        }

        // Store the new image and add the path to validated data
        $validated['product_image'] = $request->file('product_image')->storePublicly('public/image');
    }

    // Update the product, excluding the id
    $product->update([
        'product_name' => $validated['product_name'],
        'description' => $validated['description'],
        'retail_price' => $validated['retail_price'],
        'wholesale_price' => $validated['wholesale_price'],
        'origin' => $validated['origin'],
        'quantity' => $validated['quantity'],
        'product_image' => $validated['product_image'] ?? $product->product_image,
    ]);

    return redirect()->route('products.index')->with('success', 'Product updated successfully');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if($product->avatar){
            Storage::delete($product->avatar);
        }
        $product->delete();
        return redirect()->route('products.index')->with('success','product deleted successfully');
    }
}
