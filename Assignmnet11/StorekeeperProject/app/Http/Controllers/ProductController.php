<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // app/Http/Controllers/ProductController.php

    public function create()
    {
        return view('create-product');
    }

    public function store(Request $request)
    {
        $product = Product::create($request->all());
        return redirect()->route('dashboard')->with('success', 'Product created successfully.');
    }

    public function sell($productId)
    {
        $product = Product::findOrFail($productId);
        $product->quantity -= 1; // Assuming one quantity is sold at a time
        $product->save();
        return redirect()->route('dashboard')->with('success', 'Product sold successfully.');
    }

    public function updatePrice($productId, $newPrice)
    {
        $product = Product::findOrFail($productId);
        $product->price = $newPrice;
        $product->save();
        return redirect()->route('dashboard')->with('success', 'Product price updated successfully.');
    }

}
